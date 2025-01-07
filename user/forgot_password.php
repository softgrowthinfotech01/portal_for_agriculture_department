<?php
session_start();
require "../conn.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ATMA | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="dashboard">ATMA</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="recover_password" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="user_email" id="user_email"> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="button" class="btn btn-primary btn-block" onclick="func_user_forget_password()">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
                            <script>
                                function func_user_forget_password()
                                {
                                    var email_id=document.getElementById("user_email").value;
                                    if(email_id=="")
                                    {
                                        alert('Please enter the email id.');
                                    }
                                    else
                                    {
                                        $.ajax({
                                           url:'ajax_send_user_forget_password.php',
                                           method:'POST',
                                            data:{email_id:email_id},
                                           success:function(response){
                                              // alert(response);
                                              if(response==1)
                                              {
                                                  alert("The email you entered does not exist.");
                                              }
                                              else if(response==2)
                                              {
                                                  alert("Password recovery email not sent. Please try again.");
                                              }
                                              else if(response==3)
                                              {
                                                  alert("Password recovery email sent successfully.");
                                              }
                                            }
                                           });
                                    }
                                }
                            </script>

      <p class="mt-3 mb-1">
        <a href="login">Login</a>
      </p>
     <!-- <p class="mb-0">
        <a href="registration" class="text-center">Register a new membership</a>
      </p>-->
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
