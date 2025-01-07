<?php
session_start();
require "../conn.php";
//check if key matches
if(isset($_GET['key']) && isset($_GET['email']))
{
    $stmt_login = $conn->prepare("SELECT user_id FROM user WHERE user_email ='".$_GET['email']."' AND forget_password_key='".$_GET['key']."'");
    $stmt_login->execute();
    $row_login = $stmt_login->fetchAll(PDO::FETCH_ASSOC);
    if(!$row_login)
    {
        echo "<script>alert('There is some error. Please try again.');window.location.href='login';</script>" ;
    }
}
if(isset($_POST['reset_password_btn']))
{
   // print_r($_POST);exit;
    extract($_POST);
    $query =$conn->prepare("UPDATE user SET user_password=:user_password WHERE user_email='".$_GET['email']."'");
    $executed_ven=$query->execute(array(':user_password' => $password1));
    if($executed_ven)
    {
        echo "<script>alert('Password is successfully reset.');window.location.href='login';</script>" ;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ATMA | Reset Agent Password</title>

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
      <p class="login-box-msg">You are only one step a way from your new password, reset your password now.</p>

      <form action="" method="post" onsubmit="return func_reset_password();">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password1" id="password1" maxlength="6" pattern="PD[a-z]{4}" onblur="check_password_pattern(this.value)" autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
            <input type="checkbox" onclick="myFunction1()">&nbsp;&nbsp;<span>Show Password </span>
            <span id="div_id_message_password" style="color:red;"></span>
                <script>
                    function check_password_pattern(str)
                    {
                        var re = /^PD[a-z]{4}$/;
                        var response=re.test(str);
                        //alert(response);
                              if(response)
                              {
                                  $('#div_id_message_password').html('');
                              }
                              else
                              {
                                  $('#password1').val("");
                                  $('#div_id_message_password').html("Please use a 6 letter password starting with 'PD' Example: PDabcd");
                              }
                    }
                </script>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="password2" id="password2" maxlength="6" autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
            <input type="checkbox" onclick="myFunction2()">&nbsp;&nbsp;<span >Show Password </span>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="reset_password_btn" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

                            
                            <script>
                                function func_reset_password()
                                {
                                    //check if both passwords match
                                     var x = document.getElementById("password1").value;
                                     var y = document.getElementById("password2").value;
                                     if(x!='' && y!='')
                                     {
                                         if(x!=y)
                                         {
                                            alert("Passwords not matched."); 
                                            return false;
                                         }
                                     }
                                     else
                                     {
                                        alert("Passwords cannot be blank."); 
                                        return false; 
                                     }
                                }
                            </script>
                                    <script>
                                        function myFunction1() {
                                          var x = document.getElementById("password1");
                                          if (x.type === "password") {
                                            x.type = "text";
                                          } else {
                                            x.type = "password";
                                          }
                                        }
                                    </script>
                                    <script>
                                        function myFunction2() {
                                          var y = document.getElementById("password2");
                                          if (y.type === "password") {
                                            y.type = "text";
                                          } else {
                                            y.type = "password";
                                          }
                                        }
                                    </script>
      <p class="mt-3 mb-1">
        <a href="login">Login</a>
      </p>
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
