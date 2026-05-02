<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /hoa_system/public/auth/login.php');
    exit;
}

$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
$role = $_SESSION['role'];
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
<style>
#sidebar a.active {
    background-color: #4A90E2;
    color: white;
}

#sidebar ul.submenu-item.active {
    background-color: #4A90E2;
    color: white;
}

</style>
<body class="bg-gray-50 text-gray-900 font-sans">
  <div class="h-screen flex">
    <?php include $root . 'app/includes/sidebar.php'; ?>
    <div class="flex flex-col flex-1">
      <?php include $root . 'app/includes/header.php'; ?>
      <main class="flex-1 p-6 overflow-y-auto bg-white">
        <?= $content ?? '' ?>
      </main>
    </div>
  </div>
    <?php include $root . 'app/includes/scripts.php'; ?>
    <?= '<script type="module" src="'. BASE_URL .'ui/core/state.js"></script>'; ?>

    <?= '<script src="'. BASE_URL .'/ui/utils/sidebar.js"></script>'; ?>
    <?= '<script src="'. BASE_URL .'/ui/modules/profile/get.js"></script>'; ?>
    <?= '<script>localStorage.setItem("role", "' . $role . '");</script>'; ?>
    <?= $pageScripts ?? '' ?>
  </body>
</html>