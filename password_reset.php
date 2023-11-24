<?php
session_start();
ob_start();
include_once('con.php');
$id = $_GET['id'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
$query = "select first_name,last_name,email from users where id='".$id."'";
$execute = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($execute)){
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $name = $first_name." ".$last_name;
    $email = $row['email'];
}
$password = randomPassword();

$query = "update users set password = '".$password."' where id='".$id."'";
$execute = mysqli_query($con, $query);

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->CharSet = "UTF-8";
$mail->Host = 'smtp.gmail.com';
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->Username = 'yancyloria3@gmail.com';
$mail->Password = 'fyobgsgjopncsage';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->Subject = 'Reset password for Sharkfin Ventures';
$mail->setFrom('yancyloria3@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);
$email_content = '
<body style="font-family: Arial, sans-serif;line-height: 1.6;background-color: #f9f9f9;margin: 0;padding: 0;">
  <div class="container" style="max-width: 600px;margin: 0 auto;padding: 20px;background-color: #ffffff;">
    <div class="logo" style="text-align: center;margin-bottom: 20px;">
      <img src="https://sharkfin.ventures/back-office/logo.jpg" alt="Company Logo" style="max-width: 200px;height:70px;">
    </div>
    <div class="message" style="margin-bottom: 20px;padding: 20px;background-color: #f2f2f2;">
      <p>Dear '.$name.',</p>
      <p>We received a request to reset your password. Here is your new password: '.$password.'</p>
    </div>
    <div class="footer" style="text-align: center;">
      <p>© 2023 Sharkfin Ventures. All rights reserved.</p>
    </div>
  </div>
</body>';
$mail->Body = $email_content;

if($execute and $mail->send()){
    $_SESSION['success_message'] = 'Success! Password reset successfully.Mail Sent!!';
    header('Location:user_management.php');
}
?>