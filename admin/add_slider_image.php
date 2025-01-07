<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
if(isset($_POST['upload']))
{
  // echo "<pre>";
  // print_r($_FILES);exit();
  extract($_POST);
// Start multiple gallery image

$targetDir = "images/slider/"; 
 $allowTypes = array('jpg','png','jpeg'); 

 
         $fileName = basename($_FILES['image']['name']); 
          $arr1=explode('.',$fileName);
    $extension1=strtolower(end($arr1));
   $date1=rand(1000,9999)."_".date('dmYhis').".$extension1";

         $targetFilePath = $targetDir . $fileName; 
          
         // Check whether file type is valid 
         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
         if(in_array($fileType, $allowTypes)){ 
             // Upload file to server 
             if(move_uploaded_file($_FILES["image"]["tmp_name"], "images/slider/".$date1)){ 
                 // Image db insert sql 
                 //code to add image to database image table

       $stmt = $conn->prepare("INSERT INTO slider_image (slider_path,slider_heading)VALUES(:slider_path,:slider_heading)");
       $executed=$stmt->execute(array(':slider_path' => $date1,':slider_heading' => "-"));
            }else{ 
                 $errorUpload="There is some error. Please try again."; 
             } 
         }else{ 
             $errorUploadType="Please select only .jpg or .png file."; 
         } 
      
     //if(!empty($insertValuesSQL)){ 
         $insertValuesSQL = trim($insertValuesSQL, ','); 
         // Insert image file name into database 
        

         /*    $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
             $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
             $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
             $statusMsg = "Files are uploaded successfully.".$errorMsg; 
         }else{ 
             $statusMsg = "Sorry, there was an error uploading your file."; 
         } */
     //}

echo "<script>alert('Added Successfully....');window.location.href='add_slider_image';</script>";
}
// End gallery image

//Delete gallery Image
if(isset($_GET['del_id'])) 
{
  $slider_image_del=$_GET['del_id'];
  //echo $gallery_img_del;exit();
$delete_gallery_image = $conn->prepare("DELETE FROM slider_image  WHERE slider_image_id=$slider_image_del");
$delete_gallery_image->execute();
echo "<script>alert('Deleted Successfully....');window.location.href='add_slider_image';</script>";
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
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Header And Sidebar -->
  <?php require "header.php"; ?>
  <!-- End Header And Sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Slider images</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Slider Image <!--<span class="text-danger pl-3">(Maximum Add Only 4 Images For Best Result)</span>--></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="" enctype="multipart/form-data"> 
                <div class="card-body">
                  <!--<div class="form-group">
                    <label for="exampleInputFile">Heading</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="text" name="slider_heading" class="form-control">
                            
                      </div>
                    </div>
                  </div>-->
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile"  name="image" accept="image/jpg, image/jpeg, image/png" onchange="return checkImageDetails(this)">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      
                      <div id="imagePreview">
                        
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="upload">Submit</button>
                </div>
              </form>
              
              
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
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Slider Images List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr No.</th>
                  <th>Slider Image</th>
                 <!-- <th>Heading</th>-->
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                   $stmt_gallery_image = $conn->prepare("SELECT * FROM slider_image ORDER BY slider_image_id DESC");
                    $stmt_gallery_image->execute();
                    $row_gallery_show = $stmt_gallery_image->fetchAll(PDO::FETCH_ASSOC);
                    for($sl=0;$sl<count($row_gallery_show);$sl++) {
                  ?>
                <tr>
                  <td><?php echo $sl+1; ?></td>
                  <td><img src="images/slider/<?php echo $row_gallery_show[$sl]['slider_path'];?>" style="height:100px; width:100px;">
                  </td>
                  <!--<td><?php 
                    //echo $row_gallery_show[$sl]['slider_heading'];
                  ?>
                  </td>-->
                  <td><a href="add_slider_image?del_id=<?php echo $row_gallery_show[$sl]['slider_image_id']; ?>">
                    <button class="btn btn-primary" onclick="alert('You Want Delete This Image...');"><i class="fa fa-trash" aria-hidden="true"></i>
Delete</button></a></td>
                </tr>
                <?php } ?>
              </tbody>  
              </table>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
