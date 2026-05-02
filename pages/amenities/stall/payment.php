<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$booking_id = intval($_GET['id']);

$sql = "SELECT * FROM stall_renter WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Booking not found.");
}

$booking = $result->fetch_assoc();

$check_sql = "
    SELECT id 
    FROM stall_renter_fees 
    WHERE id = ? 
      AND YEAR(date_created) = YEAR(CURRENT_DATE())
      AND MONTH(date_created) = MONTH(CURRENT_DATE())
    LIMIT 1
";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("i", $booking_id);
$check_stmt->execute();
$fee_result = $check_stmt->get_result();

$has_paid_this_month = $fee_result->num_rows > 0;

$pageTitle = 'Stall Fee';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Pay Stall Fee</h3>
            <p class="text-gray-600">Stall fee payment</p>
        </div>

        <form id="updateRentalForm" method="POST" class="space-y-4">
            
            <input type="hidden" name="id" value="<?= $booking['id'] ?>">

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
              <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Rental Information</h2>
                <span class="px-4 py-2 rounded-lg bg-<?= $has_paid_this_month > 0 ? 'green-200 text-green-500' : 'red-200 text-red-500' ?>"><?= $has_paid_this_month > 0 ? 'Paid' : 'Unpaid' ?></span>
              </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Renter Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            name="renter_name"
                            value="<?= htmlspecialchars($booking['renter_name']) ?>"
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Amount <span class="text-red-500">*</span></label>
                        <input 
                            type="number"
                            name="amount"
                            min="0"
                            required
                            value="<?= htmlspecialchars($booking['amount']) ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Attachment (Proof of Payment)
                            <span class="text-xs block text-gray-500">JPG, PNG, PDF • Max 5MB</span>
                        </label>
                        <input 
                            type="file" 
                            name="attachment" 
                            accept=".jpg,.jpeg,.png,.pdf"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                  focus:ring-teal-500 focus:border-teal-500 px-3 py-2 text-sm">
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <?php if ($has_paid_this_month <= 0): ?>
                <button type="submit"
                        id="editBtn"
                        class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Submit
                </button>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("updateRentalForm");

    form?.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("/hoa_system/pages/amenities/stall/new-payment.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert("Payment success!");
                window.location.href = "/hoa_system/pages/amenities/stall/list.php";
            } else {
                alert("Update failed: " + result.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong. Please try again.");
        }
    });
});
</script>
';

require_once BASE_PATH . '/pages/layout.php';
?>
