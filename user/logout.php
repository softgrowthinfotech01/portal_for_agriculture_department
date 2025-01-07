<?php 
session_start();
require "../conn.php";
if(isset($_SESSION['agent_id']))
{
    $stmt_update_login_time2 = $conn->prepare("UPDATE agent SET login_session=:login_session,generated_session_id=:generated_session_id WHERE agent_id=".$_SESSION['agent_id']);
    $executed_update_login_time2=$stmt_update_login_time2->execute(array(':login_session'=>0,':generated_session_id'=>null));
    if($executed_update_login_time2)
    {
       unset($_SESSION['agent_id']);
       unset($_SESSION['login_token']);
        session_destroy();
        echo "<script>window.location.href='login';</script>";
    }
}
elseif(isset($_SESSION['logout_agent_id']))
{
    //for logout all
    $stmt_update_login_time2 = $conn->prepare("UPDATE agent SET login_session=:login_session,generated_session_id=:generated_session_id WHERE agent_id=".$_SESSION['logout_agent_id']);
    $executed_update_login_time2=$stmt_update_login_time2->execute(array(':login_session'=>0,':generated_session_id'=>null));
    if($executed_update_login_time2)
    {
       unset($_SESSION['logout_agent_id']);
       unset($_SESSION['login_token']);
    session_destroy();
    echo "<script>window.location.href='login';</script>";
    }
}
else
{
    
    session_destroy();
    echo "<script>window.location.href='login';</script>";
}
?>