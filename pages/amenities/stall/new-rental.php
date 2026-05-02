<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Add New Stall Rental';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">

        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Create Stall Rental</h3>
            <p class="text-gray-600">Record a new stall rental</p>
        </div>

        <form id="createStallRentalForm" class="space-y-4" enctype="multipart/form-data">

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Renter Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Renter Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="renter_name" 
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Contact Number <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            name="contact_no" 
                            required 
                            pattern="09[0-9]{9}"
                            placeholder="09123456789"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                </div>
            </div>

            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">

                <h2 class="text-xl font-semibold text-gray-900 mb-6">Rental Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Stall Number <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="stall_id" 
                            id="stallSelect"
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            <option value="">Loading stalls...</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Rental Amount <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="amount" 
                            required 
                            min="0"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Rental Duration
                        </label>
                        <input 
                            type="text" 
                            name="rental_duration" 
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2" value="Monthly" readonly>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Start Date <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="start_date" 
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            End Date
                        </label>
                        <input 
                            type="date" 
                            name="end_date"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Contract
                        </label>
                        <div class="flex flex-col items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium">
                                <div class="flex flex-col items-center justify-center text-body pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <p id="file-name" class="mt-2 text-sm text-gray-700"></p>
                                <input id="dropzone-file" type="file" name="contract" class="hidden" />
                            </label>
                            <!-- Display selected file name -->
                        </div>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="status" 
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Remarks
                        </label>
                        <input 
                            type="text" 
                            name="remarks"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                                   focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" 
                   class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>

                <button 
                    type="submit" 
                    id="createBtn" 
                    class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Create Rental
                </button>
            </div>

        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="/hoa_system/ui/modules/amenities/stall/get.stall-item.js"></script>
  <script type="module" src="/hoa_system/ui/modules/amenities/stall/post.rental.js"></script>
  <script type="module" src="/hoa_system/ui/modules/amenities/stall/validations.js"></script>
  <script>
    const fileInput = document.getElementById("dropzone-file");
    const fileNameDisplay = document.getElementById("file-name");

    fileInput.addEventListener("change", function() {
        if (fileInput.files.length > 0) {
        fileNameDisplay.textContent = ` ${fileInput.files[0].name}`;
        } else {
        fileNameDisplay.textContent = "";
        }
    })
  </script>
';

require_once BASE_PATH . '/pages/layout.php';
?>
