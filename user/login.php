<?php
session_start();
require "../conn.php";

    $error_msg=0;
if(isset($_SESSION['user_id']))
{
    echo "<script>window.location.href = 'dashboard';</script>";
}
//registration code
if(isset($_POST['login']))
{
    extract($_POST);
    $stmt_login = $conn->prepare("SELECT * FROM user WHERE user_email ='$user_email' and user_password='$user_password'");
    $stmt_login->execute();
    $row_login = $stmt_login->fetchAll(PDO::FETCH_ASSOC);
    if($row_login)
    {
        //check if already login
        if($row_login[0]['login_session']==1)
        {
            $error_msg=1;
            $_SESSION['logout_user_id']=$row_login[0]['user_id'];
        }
        else
        {
            
            //dont allow login if user is blocked
            if($row_login[0]['user_status']==2)//inactive
            {
                 echo "<script>alert('You have been blocked. Please contact admin.');window.location.href = 'login';</script>";
            }
           /* elseif($row_login[0]['user_status']==2)//approval pending
            {
                 echo "<script>alert('Your application is pending for admin approval.');window.location.href = 'login';</script>";
            }*/
            elseif($row_login[0]['user_status']==1)//active
            {
                $_SESSION['user_id']=$row_login[0]['user_id'];
                
                echo "<script>window.location.href = 'dashboard';</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('Please enter correct username and password.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
body{
 background-image: url('dist/img/log.jpg'); 
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}
.login-box{
position: relative;
top: 50%;
left: 50%;
transform: translate(-50%, 50%);


}
body
{
    background:#307D7E;
}
</style> 

</head>
<body class="hold-transition">
<!-- <body class="hold-transition login-page"> -->
<div class="login-box">
  <div class="login-logo">
    <b class="text-white">User Login</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="user_email" class="form-control" placeholder="User Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="user_password" class="form-control" placeholder="User Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
        <a href="forgot_password">I forgot my password</a>
      </p>
     <!-- <p class="mb-0">
        <a href="registration" class="text-center">Register</a>
      </p>-->
     
<?php
if($error_msg==1)
{
    ?>
    <p>Your session is active in another device. Please click below to Logout Of All Devices: 
    <a href="logout"><button class="btn btn-primary" type="button" >Logout Of All Devices</button></a>
    </p>
    <?php
}
?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
