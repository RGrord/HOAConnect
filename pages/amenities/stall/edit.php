<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

// GET rental ID
if (!isset($_GET['id'])) {
    die("Invalid request — Missing ID.");
}

$rental_id = intval($_GET['id']);

$sql = "SELECT * FROM stall_renter WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $rental_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Rental record not found.");
}

$rental = $result->fetch_assoc();

$pageTitle = 'Edit Stall Rental';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">

        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Edit Stall Rental</h3>
            <p class="text-gray-600">Modify stall rental information</p>
        </div>

        <form id="updateStallRentalForm" method="POST" enctype="multipart/form-data" class="space-y-4">

            <input type="hidden" name="rental_id" value="<?= $rental['id'] ?>">

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Renter Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Renter Name <span class="text-red-500">*</span></label>
                        <input 
                            type="text" 
                            name="renter_name" 
                            value="<?= htmlspecialchars($rental['renter_name']) ?>"
                            required 
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Contact Number <span class="text-red-500">*</span></label>
                        <input 
                            type="tel"
                            name="contact_no"
                            value="<?= htmlspecialchars($rental['contact_no']) ?>"
                            required 
                            pattern="09[0-9]{9}"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                </div>
            </div>

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Rental Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Stall Number <span class="text-red-500">*</span></label>

                        <select 
                            name="stall_id"
                            id="stallSelect"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2"
                            required>
                            
                            <option value="">Loading stalls...</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Rental Amount <span class="text-red-500">*</span></label>
                        <input 
                            type="number"
                            name="amount"
                            value="<?= htmlspecialchars($rental['amount']) ?>"
                            required 
                            min="0" 
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                        <input 
                            type="date" 
                            name="date_start"
                            value="<?= $rental['start_date'] ?>"
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">End Date</label>
                        <input 
                            type="date" 
                            name="date_end"
                            value="<?= $rental['end_date'] ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Contract
                        </label>

                        <div class="flex flex-col items-center justify-center w-full">
                            <label for="contract-file" 
                                class="flex flex-col items-center justify-center w-full h-64 
                                    bg-neutral-secondary-medium border border-dashed border-default-strong 
                                    rounded-base cursor-pointer hover:bg-neutral-tertiary-medium">

                                <div class="flex flex-col items-center justify-center text-body pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/>
                                    </svg>

                                    <p class="mb-2 text-sm">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>

                                    <p class="text-xs">PDF, DOC, DOCX (MAX 5MB)</p>
                                </div>

                                <p id="contract-file-name" class="mt-2 text-sm text-gray-700"></p>

                                <input id="contract-file" type="file" name="contract" class="hidden" accept=".pdf,.doc,.docx"/>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select 
                            name="status"
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            
                            <option value="1"   <?= $rental['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $rental['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>

                <button 
                    type="submit"
                    class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Save Changes
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
    const form = document.getElementById("updateStallRentalForm");

    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("edit-rental.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert("Stall rental updated successfully!");
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
<script>
document.getElementById("contract-file").addEventListener("change", function () {
    const fileNameText = document.getElementById("contract-file-name");
    fileNameText.textContent = this.files.length ? this.files[0].name : "";
});
</script>

  <script type="module" src="/hoa_system/ui/modules/amenities/stall/get.stall-item.js"></script>
  <script type="module" src="/hoa_system/ui/modules/amenities/stall/validations.js"></script>

';

require_once BASE_PATH . '/pages/layout.php';
?>
