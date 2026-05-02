<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request — Missing or invalid user ID.");
}

$user_id = intval($_GET['id']);

// Fetch unpaid fees + user name
$sql = "
    SELECT 
        fa.id AS fee_id,
        fa.amount,
        fa.due_date,
        fa.status,
        ft.fee_name,
        ft.description,
        CONCAT(TRIM(CONCAT(i.first_name, ' ', COALESCE(i.middle_name, ''), ' ', i.last_name))) AS full_name
    FROM fee_assignments fa
    LEFT JOIN fee_type ft ON fa.fee_type_id = ft.id
    LEFT JOIN user_info i ON fa.user_id = i.user_id
    WHERE fa.user_id = ? AND fa.status = 0
    ORDER BY fa.due_date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$userName = 'Unknown User';
$fees = [];

while ($row = $result->fetch_assoc()) {
    $fees[] = $row;
    $userName = $row['full_name'];
}

$pageTitle = 'Unpaid Fees';
ob_start();
?>

<div class="mt-1">
    <h3 class="text-2xl font-medium text-gray-900 mb-4"><?= $pageTitle ?></h3>

    <div class="p-4 mb-6 bg-teal-50 border border-teal-200 rounded-lg">
        <p class="text-sm">
            Viewing unpaid fees for: <strong><?= htmlspecialchars($userName) ?></strong>
            <span class="text-gray-600">(User ID: <?= $user_id ?>)</span>
        </p>
    </div>

    <?php if (!empty($fees)): ?>

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
                <?php foreach ($fees as $fee): ?>
                <tr class="hover:bg-gray-50 border-b">
                    <td class="px-4 py-3">
                        <input 
                            type="checkbox" 
                            class="fee-check"
                            value="<?= $fee['fee_id'] ?>"
                            data-name="<?= htmlspecialchars($fee['fee_name']) ?>"
                            data-amount="<?= $fee['amount'] ?>"
                        >
                    </td>
                    <td class="px-4 py-3 font-medium"><?= htmlspecialchars($fee['fee_name']) ?></td>
                    <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($fee['description'] ?? '-') ?></td>
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
            <a href="list.php" class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                Back
            </a>
            <button type="button" id="walkInBtn" disabled
                    class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                Walk-In Payment
            </button>
        </div>
    </div>

    <?php else: ?>
        <p class="text-center py-10 text-gray-500 text-lg">No unpaid fees found for this user.</p>
    <?php endif; ?>
</div>

<!-- Walk-In Payment Modal -->
<div id="walkInPaymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg w-full max-w-2xl shadow-2xl flex flex-col max-h-screen">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-2xl font-semibold text-gray-900">Walk-In Payment</h2>
            <p class="text-sm text-gray-600 mt-1">Record payment for selected fees</p>
        </div>

        <div class="flex-1 overflow-y-auto px-6 py-5">
            <div id="selected-fees-details" class="space-y-3 mb-6"></div>

            <form id="walk-in-payment-form" class="space-y-5">
                <input type="hidden" id="user_id" value="<?= $user_id ?>">

                <div>
                    <label class="text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" class="mt-1 input input-bordered w-full bg-gray-50" 
                           value="<?= htmlspecialchars($userName) ?>" readonly>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Total Amount</label>
                    <input type="text" id="amount" class="mt-1 input input-bordered w-full font-bold text-lg text-green-600 bg-gray-50" readonly>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="payment-method" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required>
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="GCash">GCash</option>
                        <option value="Maya">Maya</option>
                        <option value="Check">Check</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Payment Date</label>
                    <input type="date" id="payment-date" value="<?= date('Y-m-d') ?>" 
                           class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Receipt / Reference No.</label>
                    <input type="text" id="receipt-name" placeholder="e.g. OR#12345, GCash Ref#..." 
                           class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full" required>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Remarks (Optional)</label>
                    <textarea id="remarks" rows="3" class="mt-1 border border-gray-300 py-2.5 px-4 rounded-lg w-full"></textarea>
                </div>
            </form>
        </div>

        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end gap-3">
            <button type="button" id="closeModal"
                    class="px-6 py-2.5 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </button>
            <button type="submit" form="walk-in-payment-form"
                    class="px-8 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                Submit Payment
            </button>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '<script src="/hoa_system/ui/modules/fee-assignation/payment-form.js"></script>';

require_once BASE_PATH . '/pages/layout.php';
?>