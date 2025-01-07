<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
$question_details_id=$_POST['question_details_id'];

$_SESSION['question_details_id']=$question_details_id;
?>