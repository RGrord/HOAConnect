<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';

require_once $root . 'config.php';
require_once $root . 'app/includes/session.php';

$pageTitle = 'Reset Password';
$pageSubTitle = 'Reset your Mabuhay Homes 2000 account';
ob_start();

?>
        <form id="reset-password-form" method="POST" class="space-y-6">
          <input type="hidden" name="reset_token" value="<?= $_GET['token'] ?>">

          <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <div class="mt-1 relative">
                  <input
                      id="password"
                      name="password"
                      type="password"
                      autocomplete="current-password"
                      required
                      class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm pr-10 pw"
                  />
                  <button
                      type="button"
                      id="toggle-password"
                      data-target="#password"
                      class="absolute inset-y-0 right-0 pr-3 flex items-center pw-toggle"
                  >
                      <i class="ri-eye-line"></i>
                  </button>
              </div>
          </div>

          <div>
              <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
              <div class="mt-1 relative">
                  <input
                      id="confirmPassword"
                      name="confirm_password"
                      type="password"
                      autocomplete="current-password"
                      required
                      class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm pr-10 pw"
                  />
                  <button
                      type="button"
                      id="toggle-confirm-password"
                      data-target="#confirmPassword"
                      class="absolute inset-y-0 right-0 pr-3 flex items-center pw-toggle"
                  >
                      <i class="ri-eye-line"></i>
                  </button>
              </div>
          </div>

          <div>
              <button
                  type="submit"
                  id="submitBtn"
                  class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
              >
                  Submit
              </button>
              <input type="hidden" name="setup" value="1">
          </div>
      </form>

<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="'. BASE_URL .'ui/modules/auth/reset-password.js"></script>"></script>
';

require_once BASE_PATH . '/public/auth/layout.php';
?>