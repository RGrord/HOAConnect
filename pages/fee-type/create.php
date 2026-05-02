<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Add New Fee';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none"><?= $pageTitle ?></h3>
            <p class="text-gray-600">Add a new fee for the homeowners association</p>
        </div>

        <form id="createDueForm" class="space-y-4">
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Due Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Fee Name <span class="text-red-500">*</span></label>
                        <input type="text" name="due_name" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2" placeholder="e.g. Monthly Association Dues" required>
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700"> Description <span class="text-red-500">*</span></label>
                        <input type="text" name="description" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2" placeholder="...">
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Amount (₱) <span class="text-red-500">*</span></label>
                        <input type="number" name="amount" step="0.01" min="0" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2" placeholder="0.00" required>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700"> Type <span class="text-red-500">*</span></label>
                        <select name="is_recurring" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2" required>
                            <option value="">--Select--</option>
                            <option value="1">Monthly</option>
                            <option value="2">One Time</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700"> Date Start <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2" placeholder="0.00" required>
                        <input type="hidden" name="created_by" value="<?= $_SESSION['user_id']; ?>">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" id="createBtn" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Create Fee
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageScripts = '
<script type="module" src="' . BASE_URL . 'ui/modules/fee-type/post.fee-type.js"></script>
';
require_once BASE_PATH . '/pages/layout.php';
?>