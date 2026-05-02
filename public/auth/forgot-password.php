<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';

require_once $root . 'config.php';

$pageTitle = 'Reset your HOAConnect password';
$pageSubTitle = 'Enter your email to receive reset instructions';

ob_start();

?>
  <form id="forgot-password-form" class="space-y-6">
    <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Email Address</label>
        <div class="mt-1">
          <input
            id="username"
            name="username"
            type="text"
            autocomplete="username"
            required
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
          />
        </div>
    </div>

    <div>
      <button
          type="submit"
          id="loginBtn"
          class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
      >
      Submit
      </button>
    </div>
  </form>

<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="'. BASE_URL .'ui/modules/auth/validateUser.js"></script>"></script>
';

require_once BASE_PATH . '/public/auth/layout.php';
?>
