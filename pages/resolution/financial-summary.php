<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    echo "<script>window.location.href = 'list.php';</script>";
}
$project_id = intval($_GET['id']);
$user_id    = $_SESSION['user_id'] ?? 0;
$role = $_SESSION['role'] ?? 0;
$upload_message   = '';
$already_uploaded = false;
$has_validated    = 0;

if (isset($_POST['upload']) || isset($_POST['verify'])) {

    if (isset($_POST['upload'])) {
        $stmt = $conn->prepare("SELECT id FROM financial_summary WHERE project_id = ?");
        $stmt->bind_param("i", $project_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $already_uploaded = $result->num_rows > 0;
        $result->free();
        $stmt->close();

        if (!$already_uploaded) {
            if (!empty($_FILES['upload_receipt']['name']) && $_FILES['upload_receipt']['error'] === 0) {
                $upload_dir = $root . 'uploads/financial_summary/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

                $original_name = $_FILES['upload_receipt']['name'];
                $safe_name     = time() . '_' . preg_replace("/[^a-zA-Z0-9_.-]/", "_", $original_name);
                $target_path   = $upload_dir . $safe_name;

                if (move_uploaded_file($_FILES['upload_receipt']['tmp_name'], $target_path)) {
                    $stmt = $conn->prepare("
                        INSERT INTO financial_summary (project_id, file, created_by, has_validated, date_created) 
                        VALUES (?, ?, ?, 0, NOW())
                    ");
                    $stmt->bind_param("isi", $project_id, $safe_name, $user_id);
                    $stmt->execute();
                    $stmt->close();

                    // Mark resolution as has financial summary
                    $upd = $conn->prepare("UPDATE resolution SET has_financial_summary = 1 WHERE id = ?");
                    $upd->bind_param("i", $project_id);
                    $upd->execute();
                    $upd->close();

                    header("Location: financial-summary.php?id=$project_id&success=upload");
                    exit;
                } else {
                    $upload_message = "<p class='text-red-600'>Failed to save file. Check folder permissions.</p>";
                }
            } else {
                $upload_message = "<p class='text-red-600'>Please select a valid file.</p>";
            }
        }
    }

    if (isset($_POST['verify'])) {
        $stmt = $conn->prepare("UPDATE financial_summary SET has_validated = 1, date_updated = NOW() WHERE project_id = ?");
        $stmt->bind_param("i", $project_id);
        if ($stmt->execute()) {
            $has_validated = 1;
            // $upd = $conn->prepare("UPDATE resolution SET status = 3 WHERE id = ?");
            // $upd->bind_param("i", $project_id);
            // $upd->execute();
            // $upd->close();
        }
        $stmt->close();
    }
}

if (isset($_GET['success']) && $_GET['success'] === 'upload') {
    $upload_message = "<p class='text-green-600 font-medium'>Financial summary uploaded successfully!</p>";
}

$stmt = $conn->prepare("SELECT id, has_validated FROM financial_summary WHERE project_id = ? LIMIT 1");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $already_uploaded = true;
    $row = $result->fetch_assoc();
    $has_validated = (int)$row['has_validated'];
}
$result->free();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM resolution WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();
$result->free();
$stmt->close();
if (!$project) die("Project not found.");

$stmt = $conn->prepare("
    SELECT r.project_resolution_title, r.estimated_budget, l.total_expenses, l.status,
           d.audit_result, d.remaning_budget, d.remarks
    FROM resolution r
    JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
    JOIN liquidation_expenses_details d ON l.id = d.liquidation_id
    WHERE r.id = ? LIMIT 1
");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$liq_info = $result->fetch_assoc();
$result->free();
$stmt->close();
if (!$liq_info) {
    echo "<script>alert('No Liquidation Record yet.')</script>";
    echo "<script>window.location.href = 'list.php';</script>";
};

$stmt = $conn->prepare("
    SELECT particular, amount, receipt 
    FROM liquidation_expenses_details 
    WHERE liquidation_id = (SELECT id FROM liquidation_of_expenses WHERE project_resolution_id = ? LIMIT 1)
    ORDER BY id ASC
");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result_exp = $stmt->get_result();

$stmt = $conn->prepare("
    SELECT file, has_validated
    FROM financial_summary 
    WHERE project_id = ?
    ORDER BY id ASC
");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$res_fs = $stmt->get_result();

$res_fs_info = $res_fs->fetch_assoc();  


$pageTitle = 'Financial Summary';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-6 border-b-2 border-gray-300 pb-5">
            <h3 class="text-2xl font-semibold text-gray-900">Financial Summary</h3>
            <p class="text-gray-600 mt-1">Viewing liquidation report and financial summary</p>
        </div>

        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm mb-6 bg-gradient-to-br from-teal-50 to-white">
            <h2 class="text-xl font-semibold text-gray-900 mb-5">Project Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-medium text-gray-700">Project Resolution Title</label>
                    <input type="text" readonly value="<?= htmlspecialchars($project['project_resolution_title']) ?>"
                           class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Estimated Budget</label>
                    <input type="text" readonly value="₱<?= number_format($project['estimated_budget'], 2) ?>"
                           class="mt-1 block w-full rounded-lg border border-gray-300 bg-teal-50 px-4 py-3 font-bold text-teal-700">
                </div>
            </div>
        </div>

        <div class="border-2 border-gray-200 rounded-lg shadow-sm overflow-hidden mb-6">
            <div class="px-8 py-5 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Expense Line Items</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Particular</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Receipt</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $count = 1; while ($row = $result_exp->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900"><?= $count++ ?></td>
                            <td class="px-6 py-4 text-sm text-gray-800"><?= htmlspecialchars($row['particular']) ?></td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">₱<?= number_format($row['amount'], 2) ?></td>
                            <td class="px-6 py-4 text-sm">
                                <?php if (!empty($row['receipt'])): ?>
                                    <a href="/hoa_system/uploads/liquidation_expenses/<?= htmlspecialchars($row['receipt']) ?>" target="_blank"
                                       class="text-blue-600 hover:text-blue-800 underline font-medium">View Receipt</a>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">No receipt</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm mb-6 bg-gradient-to-br from-indigo-50 to-white">
            <h2 class="text-xl font-semibold text-gray-900 mb-5">Liquidation Summary</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div><span class="font-medium text-gray-700">Total Expenses:</span> <span class="ml-3 font-bold">₱<?= number_format($liq_info['total_expenses'], 2) ?></span></div>
                <div><span class="font-medium text-gray-700">Remaining Budget:</span> <span class="ml-3 font-bold text-teal-600">₱<?= number_format($liq_info['remaning_budget'], 2) ?></span></div>
                <div><span class="font-medium text-gray-700">Audit Result:</span> <span class="ml-3 <?= $liq_info['audit_result'] === 'Approved' ? 'text-green-600' : 'text-red-600' ?> font-medium"><?= htmlspecialchars($liq_info['audit_result']) ?></span></div>
                <div class="md:col-span-2"><span class="font-medium text-gray-700">Remarks:</span> <p class="mt-1 text-gray-800 italic"><?= nl2br(htmlspecialchars($liq_info['remarks'] ?? 'None')) ?></p></div>
            </div>
        </div> 
        <?php if ($liq_info['status'] == 1): ?>
        <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm bg-gradient-to-br from-amber-50 to-white">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Financial Summary Attachment</h2>
            <?php if (!$already_uploaded && $role == 5): ?>
                <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Consolidated Financial Summary (PDF/Image)</label>
                        <input type="file" name="upload_receipt" accept=".pdf,.jpg,.jpeg,.png" required
                               class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 px-3 rounded-lg">
                    </div>
                    <button type="submit" name="upload"
                            class="px-4 py-2 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition shadow">
                        Upload Financial Summary
                    </button>
                </form>
            <?php else: 
             if ($res_fs_info): ?>
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <a href="/hoa_system/uploads/financial_summary/<?= htmlspecialchars($res_fs_info['file']) ?>" target="_blank">
                        View Document
                    </a>
                </div>
            <?php else: ?>
                <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
                    No financial summary uploaded yet.
                </div>
            <?php endif;
              endif; ?>
        </div>
        <?php endif; ?>
        <div class="mt-8 flex justify-end gap-4 items-center">
            <a href="list.php" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                Back to List
            </a>
            
            <?php 
            if($role == 4) :
              if ($already_uploaded && $has_validated !== 1): ?>
                  <form action="" method="POST" class="inline">
                      <button type="submit" name="verify"
                              class="px-6 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition shadow">
                          Verify Financial Summary
                      </button>
                  </form>
            <?php 
              endif; 
            endif; ?>
        </div>
    </div>
</div>

<?php
$result_exp->free();
$content = ob_get_clean();
require_once BASE_PATH . '/pages/layout.php';
?>