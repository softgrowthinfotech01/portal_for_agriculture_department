<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
if(isset($_POST['change']))
{
  extract($_POST);
  //check if otp is correct
  if($email_otp!="" && $email_otp==$_SESSION['password_otp'])
  {
       $stmt = $conn->prepare("UPDATE user SET user_password=:user_password WHERE user_id=".$row_user_details[0]['user_id']);
       $executed=$stmt->execute(array(':user_password' => $user_password));
       if($executed){
           $success_msg="Password Updated Successfully."; 
       }
       else
       {
           $failure_msg="Password Not Updated. Please Try Again Later."; 
       }
  }
  else
  {
      $failure_msg="OTP did not match. Please Try Again"; 
  }
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  
  <!--================Bootstrap 5 link for new modal popup===================-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!--================Bootstrap 5 link for new modal popup===================-->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php require_once 'header.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 ">
              <?php 
              if(isset($success_msg))
              {
                 ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo $success_msg;?>
                </div>
                 <?php
              }
              ?>
              <?php 
              if(isset($failure_msg))
              {
                 ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo $failure_msg;?>
                </div>
                 <?php
              }
              ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-6">
            <!-- /.card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <form method="post" action="" onsubmit="return func_change(this)">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter A New Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="User Password" name="user_password" pattern="PD[a-z]{4}" onblur="check_password_pattern(this.value)">
                  </div>
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
                                  $('#user_password').val("");
                                  $('#div_id_message_password').html("Please use a 6 letter password starting with 'PD' Example: PDabcd");
                              }
                    }
                </script>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" class="form-control" id="repeat_password" placeholder="Repeat Password" name="repeat_password">
                  </div>
                  <div class="form-group">
                    <button type="button" class="btn btn-primary btn-sm" name="send_otp" onclick="func_send_email_otp()">Send OTP to Email Id</button>
                  </div>
                  <div class="form-group" id="div_otp" style="display:none;">
                    <label for="exampleInputEmail1">Email OTP</label>
                    <input type="text" class="form-control" id="email_otp" placeholder="Email OTP" name="email_otp" maxlength="6">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="change">Submit</button>
                </div>
              </form>
              <script>
            function func_send_email_otp()
            {
                var user_password=document.getElementById('user_password').value;
                var repeat_password=document.getElementById('repeat_password').value;
                if(user_password=="" || repeat_password=="")
                {
                    alert("Please Enter Password first.");
                }
                else
                {
                    
                    $.ajax({
                       url:'ajax_send_email_otp.php',
                       method:'POST',
                       // data:{agent_phone_no:agent_phone_no},
                       success:function(response){
                           console.log(response);
                     
                          if(response==1)
                          {
                              $("#div_otp").css("display","block");
                          }
                          else if(response==2)
                          {
                             $("#div_otp").css("display","none"); 
                          }
                       }
                       
                   });
                }
            }
        </script>
              <script>
                  function func_change(frm)
                  {
                    if(frm.user_password.value!=frm.repeat_password.value)
                    {
                        alert("Passwords do not match.");
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                  }
              </script>
            </div>
          </div>
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php require_once 'footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!--===================Bootstrap5 script for modal popup=====================-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<!--===================Bootstrap5 script for modal popup=====================-->

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

     
<script>

function func1(exam_category_id)
{
    $.ajax({
        url:"get_update_category_modal.php",
        method:"post",
        data:{exam_category_id:exam_category_id},
        success:function(response){
            $(".modal-content").html(response);
            //$("#modal-default").modal('show');
            
            var myModal = new bootstrap.Modal(document.getElementById('modal-default'), {})
             myModal.show()
            }
    })
}
</script>
<script>
/*$(document).ready(function(){
    $(".modalButton").click(function(){
        var exam_category_id =$(this).data('id');
        
        $.ajax({
            url:"get_update_category_modal.php",
            method:"post",
            data:{exam_category_id:exam_category_id},
            success:function(response){
                $(".modal-content").html(response);
                $("#modal-default").modal('show');
            }
        })
    })
})*/
</script>

<script>
  function check_update_category(frm)
  {
    //alert(frm.category_image.value);
    //check if all field are complete
    if(frm.category_name.value=="" || frm.category_status.value=="")
    {
        alert("Please fill all fields.");
        return false;
    }
    else
    {
        return true;
    }
  }
</script>
</body>
</html>
