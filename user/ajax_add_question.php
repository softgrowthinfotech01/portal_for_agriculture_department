<?php
session_start();
//page created by Rashi on 24022023
require_once('../conn.php');
require_once "check_login.php";

extract($_POST);
 $stmt = $conn->prepare("INSERT INTO question_details(question,option1,option2,option3,option4,correct_option,subject_id,agent_id)VALUES(:question,:option1,:option2,:option3,:option4,:correct_option,:subject_id,:agent_id)");
   $executed=$stmt->execute(array(':question' => $question,':option1' => $option1,':option2' => $option2,':option3' => $option3,':option4' => $option4,':correct_option' => $correct_option,':subject_id' => $_SESSION['sess_subject_id'],':agent_id' => $_SESSION['agent_id']));
   if($executed){
       echo 1;
   }
   else
   {
       echo 2;
   }
?>