<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Add New Homeowner';
ob_start();
?>

<div class="">
    <div class="rounded-lg shadow-sm">
        <div class="mb-5 border-b-2 border-gray-300 pb-4">
            <h3 class="text-2xl font-medium text-gray-900 leading-none">Create Account</h3>
            <p class="text-gray-600">Create a new member account for your subdivision</p>
        </div>

        <form id="createHomeownerForm" class="space-y-4">
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="grid grid-cols-2 items-center">
                      <input type="hidden" name="role" value="6">
                      <label class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                      <input type="text" name="first_name" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                      <input type="text" name="middle_name" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                      <input type="text" name="last_name" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Suffix</label>
                      <input type="text" name="suffix" placeholder="Jr, Sr, III" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email_address" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700"> Phone Number <span class="text-red-500">*</span></label>
                      <input type="tel" name="phone" required pattern="09[0-9]{9}" placeholder="09123456789" class="mt-1 block w-full rounded-lg border border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
                      <input type="date" name="birthdate" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                </div>
            </div>

            <!-- HOME DETAILS -->
            <div class="border-2 border-gray-200 px-8 py-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Home Address</h2>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">HOA Number <span class="text-red-500">*</span></label>
                        <input type="text" name="hoa_number" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                        <label class="block text-sm font-medium text-gray-700">Home Address <span class="text-red-500">*</span></label>
                        <input type="text" name="home_address" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Lot <span class="text-red-500">*</span></label>
                      <input type="text" name="lot" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Block <span class="text-red-500">*</span></label>
                      <input type="text" name="block" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Phase <span class="text-red-500">*</span></label>
                      <input type="text" name="phase" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                    <div class="grid grid-cols-2 items-center">
                      <label class="block text-sm font-medium text-gray-700">Village / Subdivision <span class="text-red-500">*</span></label>
                      <input type="text" name="village" value="Mabuhay Homes 2000" readonly class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-4 pt-4">
                <a href="list.php" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" id="createBtn" class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageScripts = '
<script type="module" src="' . BASE_URL . 'ui/modules/users/post.users.js"></script>
';
require_once BASE_PATH . '/pages/layout.php';
?>