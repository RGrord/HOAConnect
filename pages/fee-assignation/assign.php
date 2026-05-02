<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

if (!isset($_GET['id'])) {
    die("Invalid request — Missing user ID.");
}

$user_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT CONCAT(TRIM(CONCAT(first_name, ' ', COALESCE(middle_name,''), ' ', last_name))) AS full_name FROM user_info WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$userName = $user['full_name'] ?? 'Unknown User';

$sql = "SELECT id, fee_name, description, amount 
        FROM fee_type 
        WHERE is_recurring = 2 AND status = 1 
        ORDER BY fee_name";
$result = $conn->query($sql);
$recurringFees = $result->fetch_all(MYSQLI_ASSOC);

$pageTitle = 'Assign Fees';
ob_start();
?>

<div class="mt-1">
    <h3 class="text-2xl font-medium text-gray-900 mb-4"><?= $pageTitle ?></h3>
    
    <div class="p-4 mb-6 bg-teal-50 border border-teal-200 rounded-lg">
        <p class="text-sm">
            Assigning fees to: <strong><?= htmlspecialchars($userName) ?></strong> 
            <span class="text-gray-600">(User ID: <?= $user_id ?>)</span>
        </p>
    </div>

    <?php if (!empty($recurringFees)): ?>
    <form id="assignForm" action="post.assign.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">

        <div class="bg-gray-100 rounded-lg p-5 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-3"><input type="checkbox" id="selectAll"></th>
                        <th class="px-4 py-3">Fee Name</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recurringFees as $fee): ?>
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="px-4">
                            <input type="checkbox" name="fees[]" value="<?= $fee['id'] ?>" class="fee-check" data-amount="<?= $fee['amount'] ?>">
                        </td>
                        <td class="px-4 py-3 font-medium"><?= htmlspecialchars($fee['fee_name']) ?></td>
                        <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($fee['description'] ?? '—') ?></td>
                        <td class="px-4 py-3 text-green-600 font-bold">₱<?= number_format($fee['amount'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center bg-gray-50 p-4 rounded-lg">
            <div>
                <span class="text-sm text-gray-600">Selected: <strong id="count">0</strong> fees</span> 
                <span class="ml-4 text-sm">Total: <strong id="total" class="text-green-600">₱0.00</strong></span>
            </div>

            <div class="flex gap-3">
                <a href="list.php" class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Cancel</a>
                <button type="submit" id="submitBtn" disabled class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                    Assign Selected Fees
                </button>
            </div>
        </div>
    </form>
    <?php else: ?>
        <p class="text-center py-10 text-gray-500">No active recurring fees to assign.</p>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const checks = document.querySelectorAll('.fee-check');
    const selectAll = document.getElementById('selectAll');
    const countEl = document.getElementById('count');
    const totalEl = document.getElementById('total');
    const submitBtn = document.getElementById('submitBtn');

    const update = () => {
        let count = 0;
        let total = 0;
        checks.forEach(c => {
            if (c.checked) {
                count++;
                total += parseFloat(c.dataset.amount);
            }
        });
        countEl.textContent = count;
        totalEl.textContent = '₱' + total.toLocaleString('en-PH', {minimumFractionDigits: 2});
        submitBtn.disabled = count === 0;
    };

    selectAll.onchange = () => checks.forEach(c => c.checked = selectAll.checked) || update();
    checks.forEach(c => c.onchange = () => {
        update();
        selectAll.checked = [...checks].every(c => c.checked);
    });

    update();
});
</script>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/pages/layout.php';
?>