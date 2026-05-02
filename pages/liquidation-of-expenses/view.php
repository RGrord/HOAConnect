<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$role = $_SESSION['role'] ?? 0;
$liq_id = intval($_GET['id']);

$sql = "SELECT 
            l.*, 
            r.project_resolution_title,
            r.estimated_budget
        FROM liquidation_of_expenses l
        LEFT JOIN resolution r ON l.project_resolution_id = r.id
        WHERE l.id = ?"; 

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $liq_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Liquidation record not found.");
}

$liq = $result->fetch_assoc();
$pageTitle = 'View Liquidation';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-6 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Liquidation Details</h3>
            <p class="text-gray-600">Complete expense breakdown and audit result</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Project Resolution</h4>
                <div class="text-xl font-bold text-teal-700">
                    <?= htmlspecialchars($liq['project_resolution_title']) ?>
                </div>
            </div>

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Summary</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Released Budget:</span>
                        <div class="font-bold text-xl text-teal-700">₱<?= number_format($liq['estimated_budget'], 2) ?></div>
                    </div>
                    <div>
                        <span class="text-gray-600">Total Expenses:</span>
                        <div class="font-bold text-xl text-yellow-700">₱<?= number_format($liq['total_expenses'], 2) ?></div>
                    </div>
                    <div>
                        <span class="text-gray-600">Remaining:</span>
                        <div class="font-bold text-xl <?= $liq['total_expenses'] > $liq['estimated_budget'] ? 'text-red-700' : 'text-blue-700' ?>">
                            ₱<?= number_format($liq['estimated_budget'] - $liq['total_expenses'], 2) ?>
                        </div>
                    </div>
                    </div>
                    <div>
                        <span class="text-gray-600">Status:</span>
                        <?php
                        $status = $liq['status'];
                        $badge = match($status) {
                            0 => '<span class="inline-flex px-4 py-2 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">Pending Review</span>',
                            1 => '<span class="inline-flex px-4 py-2 rounded-full text-xs font-bold bg-green-100 text-green-800">Approved</span>',
                            2 => '<span class="inline-flex px-4 py-2 rounded-full text-xs font-bold bg-red-100 text-red-800">Rejected</span>',
                            default => '<span class="text-gray-500">Unknown</span>'
                        };
                        echo $badge;
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm mb-6">
            <h4 class="text-xl font-semibold text-gray-900 mb-6">Expense Breakdown</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Particular</th>
                            <th class="px-6 py-3 text-right">Amount</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $detail_sql = "SELECT * FROM liquidation_expenses_details WHERE liquidation_id = ? ORDER BY id";
                        $detail_stmt = $conn->prepare($detail_sql);
                        $detail_stmt->bind_param("i", $liq['id']);
                        $detail_stmt->execute();
                        $details = $detail_stmt->get_result();

                        $first_row = true;
                        while ($d = $details->fetch_assoc()):
                        ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium"><?= htmlspecialchars($d['particular']) ?></td>
                            <td class="px-6 py-4 text-right font-bold text-gray-800">₱<?= number_format($d['amount'], 2) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($d['quantity']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars(date("Y/m/d", strtotime($d['expense_date']))) ?></td>
                        </tr>
                        <?php 
                        if ($first_row) {
                            $audit_result = $d['audit_result'] ?? 'Balanced';
                            $remarks = $d['remarks'] ?? '';
                            $first_row = false;
                        }
                        endwhile; 
                        ?>
                    </tbody>
                    <tfoot class="bg-gray-50 font-bold">
                        <tr>
                            <td class="px-6 py-4 text-right">TOTAL:</td>
                            <td class="px-6 py-4 text-right text-xl text-teal-700">₱<?= number_format($liq['total_expenses'], 2) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">Audit Result</h4>
                <?php
                $color = match($audit_result ?? 'Balanced') {
                    'Overspent' => 'bg-red-100 text-red-800',
                    'Underspent' => 'bg-blue-100 text-blue-800',
                    default => 'bg-green-100 text-green-800'
                };
                ?>
                <div class="inline-flex px-6 py-3 rounded-full text-lg font-bold <?= $color ?>">
                    <?= $audit_result ?? 'Balanced' ?>
                </div>
            </div>

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">Remarks</h4>
                <p class="text-gray-700 whitespace-pre-wrap">
                    <?= nl2br(htmlspecialchars($remarks ?? 'No remarks')) ?>
                </p>
            </div>
        </div>

        <div class="flex justify-end gap-3 items-center mt-8 pt-6 border-t-2 border-gray-200">
            <a href="list.php" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                ← Back to List
            </a>
            <?php if($role == 1):?>
            <?php if ($liq['status'] == 0): ?>
            <div class="flex gap-3">
                <button onclick="rejectLiquidation(<?= $liq['id'] ?>)" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                    Reject
                </button>
                <button onclick="approveLiquidation(<?= $liq['id'] ?>)" 
                        class="px-8 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Approve Liquidation
                </button>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
<script>
function approveLiquidation(id) {
    if (!confirm("Approve this liquidation? This action cannot be undone.")) return;

    fetch("/hoa_system/app/api/liquidation/approve.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({id: id})
    })
    .then(r => r.json())
    .then(res => {
        alert(res.message);
        if (res.success) location.reload();
    })
    .catch(() => alert("Network error"));
}

function rejectLiquidation(id) {
    if (!confirm("Reject this liquidation?")) return;

    fetch("/hoa_system/app/api/liquidation/reject.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({id: id})
    })
    .then(r => r.json())
    .then(res => {
        alert(res.message);
        if (res.success) location.reload();
    })
    .catch(() => alert("Network error"));
}
</script>
';

require_once BASE_PATH . '/pages/layout.php';
?>