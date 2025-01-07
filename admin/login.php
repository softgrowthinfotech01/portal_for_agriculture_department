<?php
session_start();
require "../conn.php";
if(isset($_SESSION['admin_username']))
{
     echo "<script>window.location.href = 'dashboard';</script>";
}
if(isset($_POST['login']))
{
    extract($_POST);
    $stmt_login = $conn->prepare("SELECT * FROM admin_details WHERE admin_login=:admin_login and admin_password=:admin_password");
    $stmt_login->execute(array(':admin_login'=>$admin_login,':admin_password'=>$admin_password));
    $row_login = $stmt_login->fetchAll(PDO::FETCH_ASSOC);
     if($row_login)
     {
           $_SESSION["admin_username"]=$_POST['admin_login'];
		   echo "<script>window.location.href='dashboard';</script>";
     }
	 else
	 {
		 echo "<script>alert('Please enter correct Username and Password!!!')</script>" ;
	 }
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
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

 body
{
    background:#307D7E;
}

.login-box{
position: relative;
top: 50%;
left: 50%;
transform: translate(-50%, 50%);


}
</style> 

</head>
<body class="hold-transition">
<!-- <body class="hold-transition login-page"> -->
<div class="login-box">
  <div class="login-logo">
    <b class="text-white">Admin Pannel</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="admin_login" class="form-control" placeholder="Admin Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="admin_password" class="form-control" placeholder="Admin Password">
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

      
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
     
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
