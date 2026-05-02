<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';

require_once $root . 'config.php';

$pageTitle = 'Log in to HOAConnect';
$pageSubTitle = 'Access your Mabuhay Homes 2000 account';

ob_start();

?>
<form id="login-form" class="login-form space-y-6">
  <div>
      <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
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
      <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
      <div class="mt-1 relative">
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm pr-10 pw "
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
  <div class="flex items-center justify-between">
    <div class="flex items-center">
      <input
        id="remember-me"
        name="remember-me"
        type="checkbox"
        class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
      />
      <label for="remember-me" class="ml-2 block text-sm text-gray-900">
        Remember me
      </label>
    </div>

    <div class="text-sm">
      <a href="<?= BASE_URL . 'public/auth/forgot-password.php' ?>" class="font-medium text-teal-600 hover:text-teal-500">
          Forgot your password?
      </a>
    </div>
  </div>

  <div>
    <button
        type="submit"
        id="loginBtn"
        class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
    >
    Log in
    </button>
  </div>
</form>
<?php
$content = ob_get_clean();

$pageScripts = '
  <script type="module" src="'. BASE_URL .'ui/modules/auth/authenticate.js"></script>"></script>
';

require_once BASE_PATH . '/public/auth/layout.php';
?>