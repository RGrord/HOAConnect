<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$fee_id = intval($_GET['id']);

$sql = "SELECT 
            fa.id,
            fa.amount,
            fa.due_date,
            ft.fee_name,
            CONCAT(ui.first_name, ' ', COALESCE(ui.middle_name,''), ' ', ui.last_name) AS homeowner_name
        FROM fee_assignments fa
        LEFT JOIN fee_type ft ON fa.fee_type_id = ft.id
        LEFT JOIN user_info ui ON fa.user_id = ui.user_id
        WHERE fa.id = ? AND fa.user_id = ? AND fa.status = 0";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $fee_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Fee not found or already paid.");
}

$fee = $result->fetch_assoc();
$pageTitle = 'Pay HOA Fee';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Pay HOA Fee</h3>
            <p class="text-gray-600">Submit payment for your dues</p>
        </div>

          
        <form id="payHoaForm" method="POST" class="space-y-4" enctype="multipart/form-data">
            <div class="flex gap-2 justify-end">
            <div class="grid items-center bg-gray-200 p-5 w-100 rounded-lg">
              <p class="block text-md font-medium text-gray-700">Gcash:</p>
              <p class="block text-sm font-medium text-gray-700">GCash#: 0927 123 4567</p>
              <p class="block text-sm font-medium text-gray-700">GCash Name: Mabuhay Homes 2000 HOA</p>
            </div>
            <div class="grid items-center bg-gray-200 p-5 w-100 rounded-lg">
              <p class="block text-sm font-medium text-gray-700">Bank Details</p>
              <p class="block text-sm font-medium text-gray-700">Bank: BDO</p>
              <p class="block text-sm font-medium text-gray-700">Acc. No.: 1234 5678 9012</p>
              <p class="block text-sm font-medium text-gray-700">Acc. Name: Mabuhay Homes 2000 HOA</p>
            </div>
          </div>
            <input type="hidden" name="fee_assignment_id" value="<?= $fee['id'] ?>">

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Payment Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Homeowner Name</label>
                        <input type="text" value="<?= htmlspecialchars($fee['homeowner_name']) ?>" readonly
                               class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                    </div>
              

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Fee Description</label>
                        <input type="text" value="<?= htmlspecialchars($fee['fee_name']) ?>" readonly
                               class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Due Date</label>
                        <input type="text" value="<?= date('F j, Y', strtotime($fee['due_date'])) ?>" readonly
                               class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Amount to Pay <span class="text-red-500">*</span></label>
                        <input type="text" value="₱<?= number_format($fee['amount'], 2) ?>" readonly
                               class="mt-1 block w-full rounded-lg border border-gray-300 bg-teal-50 px-3 py-2 font-bold text-teal-700 text-xl">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Payment Method <span class="text-red-500">*</span>
                        </label>
                        <select name="payment_method" required
                                class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            <option value="">-- Select Payment Method --</option>
                            <option value="gcash">GCash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Reference / OR Number
                        </label>
                        <input type="text" name="ref_no" placeholder="e.g. GCash Ref# 1234567890"
                               class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-start">
                        <label class="block text-sm font-medium text-gray-700">
                            Proof of Payment <span class="text-red-500">*</span>
                            <span class="text-xs block text-gray-500 mt-1">JPG, PNG, PDF • Max 5MB</span>
                        </label>
                        <input type="file" name="attachment" required accept=".jpg,.jpeg,.png,.pdf"
                               class="mt-1 block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="my-fees.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <button type="submit"
                        class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium flex items-center gap-2">
                    <i class="ri-send-plane-fill"></i>
                    Submit Payment
                </button>
            </div>

        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("payHoaForm");

    form?.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        // Optional: show loading
        const btn = form.querySelector("button[type=submit]");
        const original = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<i class="ri-loader-4-line animate-spin"></i> Submitting...`;

        try {
            const response = await fetch("process-payment.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert("Payment submitted successfully! Waiting for approval.");
                window.location.href = "list.php";
            } else {
                alert("Error: " + result.message);
            }
        } catch (error) {
            console.error(error);
            alert("Network error. Please try again.");
        } finally {
            btn.disabled = false;
            btn.innerHTML = original;
        }
    });
});
</script>
';

require_once BASE_PATH . '/pages/layout.php';
?>