<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
include_once($root . 'app/core/init.php');

if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$booking_id = intval($_GET['id']);

$sql = "SELECT * FROM court WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Booking not found.");
}

$booking = $result->fetch_assoc();

$pageTitle = 'Edit Court Booking';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">View Court Fees</h3>
            <p class="text-gray-600">Overview court fee</p>
        </div>

        <form id="updateRentalForm" method="POST" class="space-y-4">
            
            <input type="hidden" name="id" value="<?= $booking['id'] ?>">

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Rental Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Renter Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            name="renter_name"
                            value="<?= htmlspecialchars($booking['renter_name']) ?>"
                            readonly
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Contact Number <span class="text-red-500">*</span></label>
                        <input 
                            type="tel"
                            name="contact_no"
                            readonly
                            pattern="09[0-9]{9}"
                            value="<?= htmlspecialchars($booking['contact_no']) ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Amount <span class="text-red-500">*</span></label>
                        <input 
                            type="number"
                            name="amount"
                            min="0"
                            readonly
                            value="<?= htmlspecialchars($booking['amount']) ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                        <input 
                            type="datetime-local"
                            name="start_date"
                            readonly
                            value="<?= date('Y-m-d\TH:i', strtotime($booking['start_date'])) ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">End Date <span class="text-red-500">*</span></label>
                        <input 
                            type="datetime-local"
                            name="end_date"
                            readonly
                            value="<?= date('Y-m-d\TH:i', strtotime($booking['end_date'])) ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Number of Participants</label>
                        <input 
                            type="number"
                            name="no_of_participants"
                            min="1"
                            readonly
                            value="<?= htmlspecialchars($booking['no_of_participants']) ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Purpose</label>
                        <input 
                            type="text"
                            name="purpose"
                            readonly
                            value="<?= htmlspecialchars($booking['purpose']) ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select name="status" disabled
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            <option value="Active" <?= $booking['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= $booking['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '';

require_once BASE_PATH . '/pages/layout.php';
?>
