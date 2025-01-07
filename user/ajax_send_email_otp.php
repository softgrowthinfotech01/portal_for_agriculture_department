<?php
//page created by Rashi on 17072023
session_start();
require_once('../conn.php');
require_once "check_login.php";
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
$to=$row_user_details[0]['user_email'];
if($to)
{
    //generate password
    $otp=rand(100000,999999);
    require_once '../PHPMailer/src/Exception.php'; 
    require_once '../PHPMailer/src/PHPMailer.php'; 
    require_once '../PHPMailer/src/SMTP.php'; 
	$mail = new PHPMailer;
	$mail->setFrom('info@atmamaharashtra.com', 'Atma Maharashtra');
	$mail->addAddress($to);
//	$mail->addBCC('');
	$mail->isHTML(true);
	$mail->Subject  = "OTP for Password Change";
	$mail->Body     = "The OTP for changing password is ".$otp;
	if(!$mail->send()) {
			//echo 'Message was not sent.';
			//echo 'Mailer error: ' . $mail->ErrorInfo;
			echo json_encode(2);
	} 
	else 
	{
	    $_SESSION['password_otp']=$otp;
        echo json_encode(1);
	}
}
else
{
    echo json_encode(2);//email not found so no more process
}
?>