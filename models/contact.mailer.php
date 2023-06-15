<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

function envoi_mail(){
   $mail = new PHPMailer();
   $mail->isSMTP();
   $mail->SMTPDebug = 0;
   $mail->SMTPSecure = 'ssl';
   $mail->Host =



}