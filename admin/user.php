<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
if(isset($_POST['submit_add']))
{
  extract($_POST);
  
   /* if($_FILES['user_image']['name']!="")
	{
	    //print_r($_FILES);exit;
		$file_name1=$_FILES['user_image']['name'];
		$file_tmp1=$_FILES['user_image']['tmp_name'];
		$errors1=array();
		$arr1=explode('.',$file_name1);
		$extension1=strtolower(end($arr1));
		
		$allowed1=array('jpg','jpeg','png');
		
		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
		if(in_array($extension1,$allowed1))
		{
    		if(empty($errors1))
    		{
    			if(move_uploaded_file($file_tmp1,"../user/user_profile_image/".$date1))	
    			{*/
                  //code to add image to database image table
                       $stmt = $conn->prepare("INSERT INTO user( user_name, user_email, user_password, user_phone_no, user_photo,district_id, user_status, added_on)VALUES(:user_name, :user_email, :user_password, :user_phone_no, :user_photo,:district_id, :user_status, :added_on)");
                       $executed=$stmt->execute(array(':user_name' => $user_name,':user_email' => $user_email,':user_password' => $user_password,':user_phone_no' => $user_phone_no,':user_photo' => "-",':district_id' => $district_id,':user_status' => $user_status,':added_on' => date('Y-m-d H:i:s')));
                       if($executed){
                           
                           $to = $user_email;
        					$subject="Welcome To Atmamaharashtra!";
        						 $link="https://atmamaharashtra.com/user/login";
        					$txt = "<p>Your registration at Atmamaharashtra is successful.</p>
        					<p>Your Username is $user_email and Password is $user_password</p>
        					<p>For Login link $link</p>";
        					
        				
        					
                            require_once '../PHPMailer/src/Exception.php'; 
                            require_once '../PHPMailer/src/PHPMailer.php'; 
                            require_once '../PHPMailer/src/SMTP.php'; 
        					$mail = new PHPMailer;
        					$mail->setFrom('info@atmamaharashtra.com', 'Atma Maharashtra');
        					$mail->addAddress("info@atmamaharashtra.com");
        					$mail->addCC($user_email);
        					$mail->isHTML(true);
        					$mail->Subject  = $subject;
        					$mail->Body     = $txt;
        					if(!$mail->send()) 
        					{
								//echo 'Message was not sent.';
								//echo 'Mailer error: ' . $mail->ErrorInfo;
							} else {
								
                                $success_msg="User Added Successfully. Username and password is send on user email"; 
							}
                       }
    		/*	}
    			else
    			{
    				//echo "File not uploaded";
    			}
    
    		}
		}
		else
		{
		    $error_message2="Please upload only jpg, jpeg or png images";
		}
	}*/
            
}
if(isset($_POST['submit_update']))
{
  extract($_POST);
  
   /* if(isset($_FILES['user_image2']['name']) && $_FILES['user_image2']['name']!="")
	{
	    //print_r($_FILES);exit;
		$file_name1=$_FILES['user_image2']['name'];
		$file_tmp1=$_FILES['user_image2']['tmp_name'];
		$errors1=array();
		$arr1=explode('.',$file_name1);
		$extension1=strtolower(end($arr1));
		
		$allowed1=array('jpg','jpeg','png');
		
		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
		if(in_array($extension1,$allowed1))
		{
    		if(empty($errors1))
    		{
    			if(move_uploaded_file($file_tmp1,"../user/user_profile_image/".$date1))	
    			{
                   $stmt = $conn->prepare("UPDATE user SET user_name=:user_name, user_email=:user_email, user_password=:user_password, user_phone_no=:user_phone_no, user_photo=:user_photo,district_id=:district_id, user_status=:user_status WHERE user_id=$user_id");
                   $executed=$stmt->execute(array(':user_name' => $user_name2,':user_email' => $user_email2,':user_password' => $user_password2,':user_phone_no' => $user_phone_no2,':user_photo' => $date1,':district_id' => $district_id2,':user_status' => $user_status2));
                   if($executed){
                       $success_msg="user Updated Successfully.."; 
                   }
    			}
    		}
		}
		else
		{
		    $error_message2="Please upload only jpg, jpeg or png images";
		}
	}
	else
	{*/
      $stmt = $conn->prepare("UPDATE user SET user_name=:user_name, user_email=:user_email, user_password=:user_password, user_phone_no=:user_phone_no,district_id=:district_id,  user_status=:user_status WHERE user_id=$user_id");
       $executed=$stmt->execute(array(':user_name' => $user_name2,':user_email' => $user_email2,':user_password' => $user_password2,':user_phone_no' => $user_phone_no2,':district_id' => $district_id2,':user_status' => $user_status2));
	/*}*/
	    
}

//get all categories
$stmt_user_list = $conn->prepare("SELECT * FROM user ORDER BY user_id DESC");
$stmt_user_list->execute();
$row_user_list = $stmt_user_list->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Add User</title>

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
                <h3 class="card-title">Add user</h3>
              </div>
              <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_add_user(this)">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">District</label>
                        <select name="district_id" class="form-control">
                            <option value="">Select District</option>
                            <?php
                            $stmt_district_list = $conn->prepare("SELECT * FROM district ORDER BY district_id DESC");
                            $stmt_district_list->execute();
                            $row_district_list = $stmt_district_list->fetchAll(PDO::FETCH_ASSOC);
                            for($c=0;$c<count($row_district_list);$c++)
                            {
                                ?>
                                <option value="<?php echo $row_district_list[$c]['district_id'];?>"><?php echo $row_district_list[$c]['district_name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="user_name" autocomplete="new-password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Email</label>
                    <input type="text" class="form-control" placeholder="User Email" name="user_email" id="user_email" onblur="check_email_exist(this.value)" autocomplete="new-password">
                  </div>
                        <span id="div_id_message_email" style="color:red;"></span>
                        <script>
                            function check_email_exist(user_email)
                            {
                                $.ajax({
                                   url:'check_user_email_exist.php',
                                   method:'POST',
                                    data:{user_email:user_email},
                                   success:function(response){
                                       console.log(response);
                                 
                                      if(response==1)
                                      {
                                          $('#user_email').val("");
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
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Password (Example: PDabcd )</label>
                    <input type="password" class="form-control" id="user_password" placeholder="User Password" name="user_password" maxlength="6" pattern="PD[a-z]{4}" onblur="check_password_pattern(this.value)" autocomplete="new-password">
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
                    <label for="exampleInputEmail1">User Phone No.</label>
                    <input type="text" class="form-control" id="user_phone_no" placeholder="User Phone No." name="user_phone_no" maxlength="10" onblur="check_contact_exist(this.value)">
                  </div>
        <span id="div_id_message_contact" style="color:red;"></span>
        <script>
            function check_contact_exist(user_phone_no)
            {
                $.ajax({
                   url:'check_user_contact_exist.php',
                   method:'POST',
                    data:{user_phone_no:user_phone_no},
                   success:function(response){
                       console.log(response);
                 
                      if(response==1)
                      {
                          $('#user_phone_no').val("");
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
                 <!-- <div class="form-group">
                    <label for="exampleInputFile">User Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="user_image" name="user_image" onchange="return checkImageDetails(this)">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      
                      <div id="imagePreview">
                        
                      </div>
                    </div>
                  </div>-->
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="user_status" checked value="1" id="add_user_active">
                      <label for="add_user_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="user_status" value="2" id="add_user_inactive">
                      <label for="add_user_inactive" class="form-check-label">Inactive</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_add">Submit</button>
                </div>
              </form>
              <script>
                  function check_add_user(frm)
                  {
                    //alert(frm.user_image.value);
                    //check if all field are complete
                    if(frm.user_name.value=="" || frm.user_image.value=="" || frm.user_status.value=="")
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
              
                  <script>
                      function checkImageDetails(img)
                      {
                          var fileName =img.files[0]['name'];
                          var filePath = fileName.value;
                         
                            // Allowing file type
                            var allowedExtensions =/(\.jpg|\.jpeg|\.png)$/i;
                                    
                            //get image size
                            var fileSize =img.files[0]['size'];
                             
                            if (!allowedExtensions.exec(fileName)) {
                                alert('File not supported. Please enter only .jpg or .png image.');
                                fileInput.value = '';
                                return false;
                            }
                            else
                            {
                                //check image size is below 2MB
                                if(fileSize<=<?php echo $row_restrictions[0]['max_file_size_in_kb'];?>)
                                {
                                    // Image preview
                                    if (img.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            document.getElementById(
                                                'imagePreview').innerHTML =
                                                '<img src="' + e.target.result
                                                + '" style="width:150px;height:150px"/>';
                                        };
                                         
                                        reader.readAsDataURL(img.files[0]);
                                    } 
                                }
                                else
                                {
                                    alert('Image size should be less than 2MB.');
                                    fileInput.value = '';
                                    return false;
                                }
                            }
                      }
                  </script>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">user List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <!--<th>Image</th>-->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($row_user_list)
                    {
                        for($c=0;$c<count($row_user_list);$c++)
                        {
                            
                      ?>
                      <tr>
                        <td><?php echo $c+1;?></td>
                        <td><?php echo $row_user_list[$c]['user_name'];?></td>
                       <!-- <td><img src="../user/user_profile_image/<?php //echo $row_user_list[$c]['user_photo'];?>" style="width:150px;height:150px;"></td>-->
                        <td><?php echo $row_user_list[$c]['user_status']==1?'Active':'Inactive';?></td>
                        <td><button type="button" class="btn btn-primary btn-sm " onclick="func1(<?php echo $row_user_list[$c]['user_id'];?>)">
                              Update
                            </button></td>
                      </tr>
                      <?php
                        }
                    }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                   <!-- <th>Image</th>-->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal" id="modal-default" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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

function func1(user_id)
{
    $.ajax({
        url:"get_update_user_modal.php",
        method:"post",
        data:{user_id:user_id},
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
        var user_id =$(this).data('id');
        
        $.ajax({
            url:"get_update_user_modal.php",
            method:"post",
            data:{user_id:user_id},
            success:function(response){
                $(".modal-content").html(response);
                $("#modal-default").modal('show');
            }
        })
    })
})*/
</script>

<script>
  function check_update_user(frm)
  {
    //alert(frm.user_image.value);
    //check if all field are complete
    if(frm.user_name.value=="" || frm.user_status.value=="")
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
