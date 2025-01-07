<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
if(isset($_POST['submit_add']))
{
  extract($_POST);
  
   /* if($_FILES['category_image']['name']!="")
	{
	    //print_r($_FILES);exit;
		$file_name1=$_FILES['category_image']['name'];
		$file_tmp1=$_FILES['category_image']['tmp_name'];
		$errors1=array();
		$arr1=explode('.',$file_name1);
		$extension1=strtolower(end($arr1));
		
		$allowed1=array('jpg','jpeg','png');
		
		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
		if(in_array($extension1,$allowed1))
		{
    		if(empty($errors1))
    		{
    			if(move_uploaded_file($file_tmp1,"../uploaded_images/category/".$date1))	
    			{*/
                  //code to add image to database image table
                       $stmt = $conn->prepare("INSERT INTO category(category_name,category_image,category_status)VALUES(:category_name,:category_image,:category_status)");
                       $executed=$stmt->execute(array(':category_name' => $category_name,':category_image' => "-",':category_status' => $category_status));
                       if($executed){
                           $success_msg="Category Added Successfully.."; 
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
  
    /*if(isset($_FILES['category_image2']['name']) && $_FILES['category_image2']['name']!="")
	{
	    //print_r($_FILES);exit;
		$file_name1=$_FILES['category_image2']['name'];
		$file_tmp1=$_FILES['category_image2']['tmp_name'];
		$errors1=array();
		$arr1=explode('.',$file_name1);
		$extension1=strtolower(end($arr1));
		
		$allowed1=array('jpg','jpeg','png');
		
		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
		if(in_array($extension1,$allowed1))
		{
    		if(empty($errors1))
    		{
    			if(move_uploaded_file($file_tmp1,"../uploaded_images/category/".$date1))	
    			{
                   $stmt = $conn->prepare("UPDATE category SET category_name=:category_name,category_status=:category_status,category_image=:category_image WHERE category_id=$category_id");
                   $executed=$stmt->execute(array(':category_name' => $category_name2,':category_status' => $category_status2,':category_image' => $date1));
                   if($executed){
                       $success_msg="Category Updated Successfully.."; 
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
       $stmt = $conn->prepare("UPDATE category SET category_name=:category_name,category_status=:category_status WHERE category_id=$category_id");
       $executed=$stmt->execute(array(':category_name' => $category_name2,':category_status' => $category_status2));
       if($executed){
           $success_msg="Category Updated Successfully.."; 
       }
/*	}*/
	    
}

//get all categories
$stmt_category_list = $conn->prepare("SELECT * FROM category ORDER BY category_id DESC");
$stmt_category_list->execute();
$row_category_list = $stmt_category_list->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Add Category</title>

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
                <h3 class="card-title">Add Category</h3>
              </div>
              <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_add_category(this)">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Name" name="category_name">
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleInputFile">Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="category_image" name="category_image" onchange="return checkImageDetails(this)">
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
                    <label for="exampleInputEmail1">Category Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="category_status" checked value="1" id="add_category_active">
                      <label for="add_category_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="category_status" value="2" id="add_category_inactive">
                      <label for="add_category_inactive" class="form-check-label">Inactive</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_add">Submit</button>
                </div>
              </form>
              <script>
                  function check_add_category(frm)
                  {
                    //alert(frm.category_image.value);
                    //check if all field are complete
                    if(frm.category_name.value=="" || frm.category_image.value=="" || frm.category_status.value=="")
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
                <h3 class="card-title">Category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                   <!-- <th>Image</th>-->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($row_category_list)
                    {
                        for($c=0;$c<count($row_category_list);$c++)
                        {
                            
                      ?>
                      <tr>
                        <td><?php echo $c+1;?></td>
                        <td><?php echo $row_category_list[$c]['category_name'];?></td>
                      <!--  <td><img src="../uploaded_images/category/<?php //echo $row_category_list[$c]['category_image'];?>" style="width:150px;height:150px;"></td>-->
                        <td><?php echo $row_category_list[$c]['category_status']==1?'Active':'Inactive';?></td>
                        <td><button type="button" class="btn btn-primary btn-sm " onclick="func1(<?php echo $row_category_list[$c]['category_id'];?>)">
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
                    <!--<th>Image</th>-->
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

function func1(category_id)
{
    $.ajax({
        url:"get_update_category_modal.php",
        method:"post",
        data:{category_id:category_id},
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
        var category_id =$(this).data('id');
        
        $.ajax({
            url:"get_update_category_modal.php",
            method:"post",
            data:{category_id:category_id},
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
