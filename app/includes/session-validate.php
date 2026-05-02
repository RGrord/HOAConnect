<?php 
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php');
  
  if(!empty($_SESSION)) {
    header('Location: '.BASE_URL.'app/pages/dashboard.php');
  } 
?>