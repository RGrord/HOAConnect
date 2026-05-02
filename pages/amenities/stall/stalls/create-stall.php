<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Add New Stall';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Create Stall</h3>
            <p class="text-gray-600">Add a new stall to the system</p>
        </div>

        <form id="createStallForm" class="space-y-4">
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Stall Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Stall Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="stall_no" required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                            focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                            focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                            <option value="Available">Available</option>
                            <option value="Occupied">Occupied</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Remarks
                        </label>
                        <input type="text" name="remarks"
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm 
                            focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>

                <button type="submit" id="createBtn"
                    class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageScripts = '
<script type="module" src="' . BASE_URL . 'ui/modules/amenities/stall/post.stall.js"></script>
';
require_once BASE_PATH . '/pages/layout.php';
?>
