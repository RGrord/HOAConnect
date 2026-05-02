<?php 
  session_start();

  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php');
  
  if(!empty($_SESSION)) {
    header('Location:' . BASE_URL . 'pages/dashboard/index.php');
  }else{
    header('Location:' . BASE_URL . 'public/index.php');
  } 

?>