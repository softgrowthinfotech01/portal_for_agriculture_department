<?php
if(!isset($_SESSION['user_id']))
{
    echo "<script>alert('Please login to view this page.');window.location.href = 'login';</script>";
 }else
    {
        $user_id=$_SESSION['user_id'];
        $stmt_user_details = $conn->prepare("SELECT * FROM user WHERE user_id=".$user_id);
        $stmt_user_details->execute();
        $row_user_details = $stmt_user_details->fetchAll(PDO::FETCH_ASSOC);
    }
?>