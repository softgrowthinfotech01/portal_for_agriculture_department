<?php
require "../conn.php";

$data1=$_POST['user_phone_no'];
$user_id=$_POST['user_id'];
$stmt_email=$conn->prepare("SELECT * FROM user WHERE user_phone_no='$data1' AND user_id!=$user_id");
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