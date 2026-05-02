<?php
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/db.php');
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/session.php');
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/helpers/sidebar.config.php');

  header('Content-Type: application/json');

  if (!isset($_SESSION['user_id'])) {
      echo json_encode(['error' => 'Not logged in']);
      exit;
  }

  $userId = $_SESSION['user_id'];

  $sql = "SELECT r.name 
          FROM users u
          JOIN roles r ON u.role_id = r.id
          WHERE u.user_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'i', $userId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $role);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  if (!$role) $role = 'Home Owners';

  $menu = $sidebarItems[$role] ?? [];

  echo json_encode($menu);
