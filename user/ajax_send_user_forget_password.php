<?php
session_start();
require_once('../conn.php');
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
$email_id=$_POST['email_id'];
//get mobile number using above email id
/*$sql = "SELECT agent_name FROM agent WHERE agent_email='".$email_id."'";
$stmt_cust_email = $conn->prepare($sql);
$stmt_cust_email->execute();
$row_cust_email = $stmt_cust_email->fetchAll(PDO::FETCH_ASSOC);*/
//check if email exist
if($email_id)
{
    
  //send otp to email
    $to = $email_id;
    $subject = "Recover Your ATMA Maharashtra Password";
    //generating_random_text
    $random_string=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
    $link="https://atmamaharashtra.com/user/reset_password?email=".$email_id."&key=".$random_string;
    $txt = "Please click on the following link to reset your password: $link";
    
    require_once '../PHPMailer/src/Exception.php'; 
    require_once '../PHPMailer/src/PHPMailer.php'; 
    require_once '../PHPMailer/src/SMTP.php';
    
	$mail = new PHPMailer;
	$mail->setFrom('info@atmamaharashtra.com', 'Atma Maharashtra');
	$mail->addAddress($to);
//	$mail->addBCC('');
	$mail->isHTML(true);
	$mail->Subject  = $subject;
	$mail->Body     = $txt;
	if($mail->send()) {
       //save the random string in database
        $query =$conn->prepare("UPDATE user SET forget_password_key=:forget_password_key WHERE user_email='".$email_id."'");
        $executed_ven=$query->execute(array(':forget_password_key' => $random_string));
        if($executed_ven)
        {
            echo json_encode(3);//email sent successfully
        }
    }
    else
    {
        echo json_encode(2);//mail not sent
    }
}
else
{
    echo json_encode(1);//email not found so no more process
}

?>