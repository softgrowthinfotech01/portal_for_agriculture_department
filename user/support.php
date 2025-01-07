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
  <title>Support</title>

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
            FAQ
            <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
     <b> How to Add Blog?</b>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
          <ul>
              <li>
                  Click On <b>Add Blog</b> from menu. 
              </li>
              <li>
                  <b>Select Category</b> e.g SMART , ATMA.
              </li>
              <li>
                  Select <b>Blog Image</b> which will display on front view of website. 
              </li>
              <li>
                 <b> Select Blog Title</b> > <b>In Blog Title</b> >Select last two option <b>for marathi Title</b> >Select 1st option for <b>English Title.</b>
                   
              </li>
              <li>
                  In Blog Field >Select last <b>two option for marathi blog</b> >Select 1st option of font for <b>English Title</b>. > User and use other <b>option to write a blog</b> like font color,list ,table , images > last click on <b>submit</b>
              </li>
          </ul>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
<b>How to Update/Edit Blog?</b>
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
          
           <ul>
              <li>
                  Click On <b>Blog List</b> from menu. >Here you can see all blog added by you.
              </li>
             
              <li>
                  Select Blog which you want to <b>Edit</b> >Click on <b>Update option</b> >here you can <b>edit text </b> can change images , Title  
              </li>
              <li>
                  At last click on <b>Submit button</b> 
              </li>
             
          </ul>
          </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
    <b>   How to change password?</b>
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
           <ul>
              <li>
                  Click On <b>Change Password</b> from menu. 
              </li>
              <li>
                Please Enter A <b>New Password </b> > Confirm <b> New Password </b> (Enter Same password as enter on 1st field)
              </li>
              <li>
                  Click on <b>Send OTP  to E-mail Id</b> to verify the user >Now enter OTP >Click on <b>Submit Button</b> for change password
              </li>
             
          </ul>
      </div>
    </div>
  </div>
</div>
            </div>
        </div>
             
    <!-- /.content -->
</section>
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
