<?php
session_start();
require "../conn.php";
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

//registration code
if(isset($_POST['register']))
{
    try{
    extract($_POST);
    $stmt_insert_partner =$conn->prepare('INSERT INTO agent(agent_name, agent_email, agent_phone_no, agent_password,added_on) VALUES (:agent_name, :agent_email, :agent_phone_no, :agent_password,:added_on)');
    $executed_insert_partner=$stmt_insert_partner->execute(array(':agent_name' => $agent_name,':agent_email' => $agent_email,':agent_phone_no'=>$agent_phone_no,':agent_password'=>$agent_password,':added_on'=>date('Y-m-d H:i:s')));
    if($executed_insert_partner) 
    {
       // $_SESSION['partner_details_id']=$conn->lastInsertId();
       $to = $student_email;
		$subject="Welcome To Easycracker!";
		$txt = "<p>Your registration as and Agent at Easycracker is successful.</p>";
		
        require_once '../PHPMailer/src/Exception.php'; 
        require_once '../PHPMailer/src/PHPMailer.php'; 
        require_once '../PHPMailer/src/SMTP.php'; 
		$mail = new PHPMailer;
		$mail->setFrom('info@easycracker.in', 'Easy Cracker');
		$mail->addAddress($to);
	//	$mail->addBCC('bigbasketmart08@gmail.com');
		$mail->isHTML(true);
		$mail->Subject  = $subject;
		$mail->Body     = $txt;
		if(!$mail->send()) {
				//echo 'Message was not sent.';
				//echo 'Mailer error: ' . $mail->ErrorInfo;
		} 
		else 
		{
            echo "<script>alert('Registration Successful. You can login after admin approval.');</script>";
		}
    }
    } catch (PDOException $e) {
   if ($e->errorInfo[1] == 1062) {
      echo "<script>alert('Account for this email already exist. Please try again later.');</script>";
   } else {
      // an error other than duplicate entry occurred
   }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easycracker | Agent Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="dashboard">Easycracker</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <h3 class="login-box-msg"><b>Register</b></h3>

      <form action="" method="post" onsubmit="return submit_form(this)">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Name" name="agent_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Contact No. ex 112345678" maxlength="10" name="agent_phone_no" id="agent_phone_no" onblur="check_contact_exist(this.value)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <span id="div_id_message_contact" style="color:red;"></span>
        <script>
            function check_contact_exist(agent_phone_no)
            {
                $.ajax({
                   url:'check_agent_contact_exist.php',
                   method:'POST',
                    data:{agent_phone_no:agent_phone_no},
                   success:function(response){
                       console.log(response);
                 
                      if(response==1)
                      {
                          $('#agent_phone_no').val("");
                          $('#div_id_message_contact').html('Contact No. Already Exist.');
                      }
                      
                      if(response==2)
                      {
                          $('#div_id_message_contact').html('');
                      }
                   }
                   
               });
            }
        </script>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="agent_email" id="agent_email" onblur="check_email_exist(this.value)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
                            <span id="div_id_message_email" style="color:red;"></span>
        <script>
            function check_email_exist(agent_email)
            {
                $.ajax({
                   url:'check_agent_email_exist.php',
                   method:'POST',
                    data:{agent_email:agent_email},
                   success:function(response){
                       console.log(response);
                 
                      if(response==1)
                      {
                          $('#agent_email').val("");
                          $('#div_id_message_email').html('Email Already Exist.');
                      }
                      
                      if(response==2)
                      {
                          
                         
                          $('#div_id_message_email').html('');
                      }
                   }
                   
               });
            }
        </script>
        
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="agent_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="retype_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!--<div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>-->
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
      
                <script>
                    function submit_form(form)
                    {
                        //check if password and retype password match
                        password1 = form.agent_password.value;
                        password2 = form.retype_password.value;
                        
          
                        // If same return True.
                        
                            //check if all fields are filled
                            if(form.agent_name.value=="" || form.agent_phone_no.value=="" || form.agent_email.value=="" || form.agent_password.value=="" || form.retype_password.value=="" )
                            {
                                alert ("\nPlease fill all the fields.")
                                 return false;
                            }
                            else
                            {
                                if (password1 != password2) 
                                {
                                    alert ("\nPassword did not match: Please try again...")
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }
                            }
                        
                    }
                </script>

      <a href="login" class="text-center">I already have an account</a>
    </div>
    <!-- new form start -->
    
    <!--
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
