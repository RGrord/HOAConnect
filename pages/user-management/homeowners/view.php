
<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';

require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$userRole = $_SESSION['role'] ?? 0;
$isAdminOrPresident = in_array($userRole, [1, 3]);
$pageTitle = 'Users';
ob_start();

?>
<div class="mt-1">
  <div class="bg-white rounded-lg shadow-sm p-6 mb-6 w-full">
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <div class="relative">
          <img class="rounded-full border border-gray-100" src="<?= BASE_URL . 'assets/img/user-alt-64.png'?>" alt="User">
          <label for="profile-picture" class="absolute -bottom-3 -right-3 bg-teal-600 text-white rounded-full py-1 px-2 cursor-pointer hover:bg-teal-700 transition-colors shadow-lg text-center">
            <i class="ri-camera-lens-fill text-lg"></i>
            <input type="file" id="profile-picture" class="hidden" accept="image/png,image/jpeg" />
          </label>
        </div>
        <div class="w-100">
          <div id="heading" class="text-2xl font-bold text-gray-900"></div>
          <p id="subheading" class="text-gray-600"></p>
        </div>
      </div>
      <?php if($userRole == 1 || $userRole == 3): ?>
        <div class="">
          <button id="downloadPdfBtn" class="px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition whitespace-nowrap">Download PDF</button>
        </div>
        <?php endif; ?>
    </div>
  </div>
  <div class="mb-4 border-b border-default">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
      <li class="me-2" role="presentation">
        <button id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"
          class="inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-teal-600 hover:border-teal-600 aria-selected:border-teal-600 aria-selected:text-teal-600">
          Personal Information
        </button>
      </li>
      <li class="me-2" role="presentation">
        <button id="home-details-tab" data-tabs-target="#homeDetails" type="button" role="tab" aria-controls="homeDetails" aria-selected="false"
          class="inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-teal-600 hover:border-teal-600 aria-selected:border-teal-600 aria-selected:text-teal-600">
          Home Details
        </button>
      </li>
      <li role="presentation">
        <button id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false"
          class="inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-teal-600 hover:border-teal-600 aria-selected:border-teal-600 aria-selected:text-teal-600">
          Account Settings
        </button>
      </li>
    </ul>
  </div>

 <div id="default-tab-content">
  <!-- PERSONAL INFO TAB -->
  <div class="hidden rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <form id="personalInfo" class="profile-section rounded-lg shadow-sm mb-6 w-full">
      <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
        <div>
          <h3 class="text-lg font-semibold text-gray-900">Basic Information</h3>
          <p class="text-sm text-gray-500">Your name and role information</p>
        </div>
        <div class="flex items-center gap-3">
          <?php 
            if ($userRole == 3) {
              ?>
              <button type="button" class="edit-button text-gray-600 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition-colors">
                <i class="ri-edit-box-line mr-1"></i> Edit
              </button>
              <div class="hidden action-buttons">
                <button type="submit" class="save-btn text-white bg-teal-600 hover:bg-teal-700 px-4 py-2 rounded-md transition-colors">
                  <i class="ri-save-line mr-1"></i> Save
                </button>
                <input type="hidden" name="section" value="personal">
                <button type="button" class="cancel-btn text-gray-600 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition-colors">
                  <i class="ri-close-line mr-1"></i> Cancel
                </button>
              </div>
              <?php
            } 
          ?>
          
        </div>
      </div>
      <div id="basic-info-display" class="p-6 space-y-4">
        <input type="hidden" name="user_id">
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-500">First Name</label>
            <input type="text" name="first_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Middle Name</label>
            <input type="text" name="middle_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Last Name</label>
            <input type="text" name="last_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Suffix</label>
            <input type="text" name="suffix" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Contact Number</label>
            <input type="text" name="phone" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Date of Birth</label>
            <input type="date" name="birthdate" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Citizenship</label>
            <input type="text" name="citizenship" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Civil Status</label>
            <select name="civil_status" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 bg-gray-50 px-3 py-2.5" disabled>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Divorced">Divorced</option>
              <option value="Widowed">Widowed</option>
              <option value="Annulled">Annulled</option>
            </select>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- HOME DETAILS TAB -->
  <div class="hidden rounded-lg" id="homeDetails" role="tabpanel" aria-labelledby="home-details-tab">
    <form id="homeDetailsForm" class="profile-section rounded-lg shadow-sm mb-6 w-full">
      <input type="hidden" name="user_id">
      <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
        <div>
          <h3 class="text-lg font-semibold text-gray-900">Home Details</h3>
          <p class="text-sm text-gray-500">Your property and address information</p>
        </div>
        <div class="flex items-center gap-3">
          <?php
            if($userRole == 3) {
            ?>
            <button type="button" class="edit-button text-gray-600 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition-colors">
              <i class="ri-edit-box-line mr-1"></i> Edit
            </button>
            <div class="hidden action-buttons">
              <button type="submit" class="save-btn text-white bg-teal-600 hover:bg-teal-700 px-4 py-2 rounded-md transition-colors">
                <i class="ri-save-line mr-1"></i> Save
              </button>
              <input type="hidden" name="section" value="home">
              <button type="button" class="cancel-btn text-gray-600 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition-colors">
                <i class="ri-close-line mr-1"></i> Cancel
              </button>
            </div>
            <?php
            }
          ?>
         
        </div>
      </div>
      <div class="p-6 space-y-6">
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-500">HOA Number</label>
            <input type="text" name="hoa_number" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Home Address</label>
            <input type="text" name="home_address" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Lot</label>
            <input type="text" name="lot" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Block</label>
            <input type="text" name="block" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Phase</label>
            <input type="text" name="phase" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-500">Village</label>
            <input type="text" name="village" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" readonly>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- ACCOUNT SETTINGS TAB -->
  <div class="hidden rounded-lg" id="settings" role="tabpanel" aria-labelledby="settings-tab">
    <form id="accountSettingsForm" class="profile-section rounded-lg shadow-sm mb-6 w-full">
      <input type="hidden" name="user_id">
      <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
        <div>
          <h3 class="text-lg font-semibold text-gray-900">Account Settings</h3>
          <p class="text-sm text-gray-500">Email and password</p>
        </div>
        <div class="flex items-center gap-3">
          <?php 
            if($userRole == 3) {
            ?>
            <button type="button" class="edit-button text-gray-600 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition-colors">
              <i class="ri-edit-box-line mr-1"></i> Edit
            </button>
            <div class="hidden action-buttons">
              <button type="submit" class="save-btn text-white bg-teal-600 hover:bg-teal-700 px-4 py-2 rounded-md transition-colors">
                <i class="ri-save-line mr-1"></i> Save
              </button>
              <input type="hidden" name="section" value="account">
              <button type="button" class="cancel-btn text-gray-600 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition-colors">
                <i class="ri-close-line mr-1"></i> Cancel
              </button>
            </div>
            <?php
            }
          ?>
         
        </div>
      </div>
      <div class="p-6 space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-500">Email Address</label>
          <input type="email" name="email_address" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" readonly>
        </div>
        <!-- <div>
          <label class="block text-sm font-medium text-gray-500">New Password (leave blank to keep current)</label>
          <input type="password" name="password" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-3 py-2.5" placeholder="••••••••" readonly>
        </div> -->
      </div>
    </form>
  </div>
</div>

<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="' . BASE_URL . 'ui/modules/profile/fetch.profile.js"></script>
  <script type="module" src="' . BASE_URL . 'ui/modules/users/homeowner.downloadable.js"></script>

';

require_once BASE_PATH . '/pages/layout.php';
?>