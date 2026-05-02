<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';

?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <?php include $root . 'app/includes/page-icon.php'; ?>
  <?php include $root . 'app/includes/styles.php'; ?>
</head>
<body class="min-h-screen md:bg-gray-50 flex flex-col">
  <div class="flex justify-center">
    <div 
      id="toast-container" 
      class="flex flex-col justify-center fixed mt-5 space-y-2 z-50">
    </div>
  </div>
  <div class="flex-1 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="flex justify-center">
        <span class="text-7xl text-teal-600">
          <i class="ri-community-line"></i>
        </span>
      </div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        <?= $pageTitle ?? '' ?>
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        <?= $pageSubTitle ?? '' ?>
      </p>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <div id="error-message" class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative hidden" role="alert">
          <span class="block sm:inline" id="error-text"></span>
        </div>

      <?= $content ?? '' ?>

      <div class="mt-6">
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white text-gray-500">Need help?</span>
          </div>
        </div>
        <div class="mt-6 text-center text-sm font-bold text-gray-500">
            <p>Visit the HOA office for assistance.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-8 text-center">
      <a href="<?= BASE_URL . '/index.php'?>" class="inline-flex items-center text-sm font-medium text-teal-600 hover:text-teal-500">
          <i class="ri-arrow-left-long-line me-2"></i>
          Back to home
      </a>
  </div>
  </div>
  <footer class="bg-white py-4 border-t border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <p class="text-center text-sm text-gray-500">
              &copy; <script>document.write(new Date().getFullYear())</script> HOAConnect. All rights reserved. 
          </p>
      </div>
  </footer>

  <?php include $root . 'app/includes/scripts.php'; ?>
  <?= '<script type="module" src="'. BASE_URL .'ui/core/state.js"></script>'; ?>
  <?= $pageScripts ?? '' ?>
</body>
</html>