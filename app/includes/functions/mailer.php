<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/PHPMailer/src/PHPMailer.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/PHPMailer/src/SMTP.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($message, $title, $creds) {
  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';       
    $mail->SMTPAuth = true;
    $mail->Username = 'i05764152@gmail.com';
    $mail->Password = 'hemgbpmzfozvjsiz';
    $mail->SMTPSecure = 'tls';            
    $mail->Port = 587;                      

    $mail->setFrom('i05764152@gmail.com', 'HOA');
    $mail->addAddress($creds);    

    $mail->isHTML(true);                               
    $mail->Subject = $title;
    $mail->Body    = $message;

    $mail->send();
    echo ""; 

    return true;
  } catch (Exception $e) {
    return false;
  }
}