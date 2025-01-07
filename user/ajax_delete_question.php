<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";

$sql = "DELETE FROM question_details WHERE agent_id=".$_SESSION['agent_id']." AND question_details_id=".$_POST['question_details_id'];
$stmt= $conn->prepare($sql);
$stmt->execute();
?>