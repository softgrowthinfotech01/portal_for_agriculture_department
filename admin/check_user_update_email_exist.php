<?php
require "../conn.php";

$user_email=$_POST['user_email'];
$user_id=$_POST['user_id'];
$stmt_email=$conn->prepare("SELECT * FROM user WHERE user_email='$user_email' AND user_id!=$user_id");//so that current user email is not checked
$stmt_email->execute(); 
$row_email=$stmt_email->fetchAll(PDO::FETCH_ASSOC);
if($row_email)
{
	echo 1;//mobile no. exist
}
else
{
	echo 2;// mobile no. does not exist
}

?>