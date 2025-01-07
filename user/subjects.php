<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
//check if agent id is set
/*if(isset($_POST['submit_add']))
{
  extract($_POST);
  
    if($_FILES['category_image']['name']!="")
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
    			{
                  //code to add image to database image table
                       $stmt = $conn->prepare("INSERT INTO exam_category(category_name,category_image,category_status)VALUES(:category_name,:category_image,:category_status)");
                       $executed=$stmt->execute(array(':category_name' => $category_name,':category_image' => $date1,':category_status' => $category_status));
                       if($executed){
                           $success_msg="Category Added Successfully.."; 
                       }
    			}
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
	}
            
}*/

//get all categories
$stmt_subject_list = $conn->prepare("SELECT * FROM subject WHERE subject_id IN(".$row_agent_details[0]['assigned_subjects'].") ORDER BY subject_id DESC");
$stmt_subject_list->execute();
$row_subject_list = $stmt_subject_list->fetchAll(PDO::FETCH_ASSOC);


//get all categories 
$stmt_category_list = $conn->prepare("SELECT * FROM exam_category ORDER BY exam_category_id DESC");
$stmt_category_list->execute();
$row_category_list = $stmt_category_list->fetchAll(PDO::FETCH_ASSOC);

//get all exam type
$stmt_sub_category_list = $conn->prepare("SELECT * FROM exam_sub_category ORDER BY exam_sub_category_id DESC");
$stmt_sub_category_list->execute();
$row_sub_category_list = $stmt_sub_category_list->fetchAll(PDO::FETCH_ASSOC);

//get all subject
$stmt_exam_type_list = $conn->prepare("SELECT * FROM exam_type ORDER BY exam_type_id DESC");
$stmt_exam_type_list->execute();
$row_exam_type_list = $stmt_exam_type_list->fetchAll(PDO::FETCH_ASSOC);

//get all sub categories where category id is 0
$stmt_direct_sub_category_list = $conn->prepare("SELECT * FROM exam_sub_category WHERE exam_category_id=0 ORDER BY exam_sub_category_id DESC");
$stmt_direct_sub_category_list->execute();
$row_direct_sub_category_list = $stmt_direct_sub_category_list->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Agent</title>

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
          <div class="col-sm-6">
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subjects Assigned to me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form method="post" action="">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Exam Type</th>
                    <th>Subject</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($row_subject_list)
                    {
                        for($c=0;$c<count($row_subject_list);$c++)
                        {
                            
                      ?>
                      <tr>
                        <td><?php echo $c+1;?></td>
                        <td><?php 
                            $key_category_name = array_column($row_category_list, 'category_name', 'exam_category_id');
                          //  print_r($key_category_name);exit;
                            
                            $key_sub_category_name = array_column($row_sub_category_list, 'sub_category_name', 'exam_sub_category_id');
                            //print_r($key);exit;
                            if($row_subject_list[$c]['exam_category_id']==0)
                            {
                                 echo $key_sub_category_name[$row_subject_list[$c]['exam_sub_category_id']];
                            }
                            else
                            {
                                 echo $key_category_name[$row_subject_list[$c]['exam_category_id']];
                            }
                               ?></td>
                        <td><?php 
                            if($row_subject_list[$c]['exam_category_id']==0)
                            {
                                 echo '-';
                            }
                            else
                            {
                                 echo $key_sub_category_name[$row_subject_list[$c]['exam_sub_category_id']];
                            }?></td>
                        <td><?php 
                            $key_exam_type_name = array_column($row_exam_type_list, 'exam_type_name', 'exam_type_id');
                            //print_r($key);exit;
                            echo $key_exam_type_name[$row_subject_list[$c]['exam_type_id']];?></td>
                        <td><?php echo $row_subject_list[$c]['subject_name'];?></td>
                        <td><button type="button" class="btn btn-primary btn-sm" onclick="startsession('sess_subject_id',<?php echo $row_subject_list[$c]['subject_id'];?>)">
                              Questions
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
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Exam Type</th>
                    <th>Subject</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              
              </form>
                <script>
                    function startsession(name,value)
                    {
                        $.ajax({
                          url: "createsession.php",
                          method:'POST',
                          data: {name: name, value: value},
                          success: function(data){
                             window.location.href = "questions";
                          }
                       });
                    }
                </script>
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
    <div class="modal fade" id="modal-default">
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
$(document).ready(function(){
    $(".modalButton").click(function(){
        var agent_id =$(this).data('id');
        
        $.ajax({
            url:"get_update_agent_modal.php",
            method:"post",
            data:{agent_id:agent_id},
            success:function(response){
                $(".modal-content").html(response);
                $("#modal-default").modal('show');
            }
        })
    })
})
</script>

<script>
/*  function check_update_category(frm)
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
  }*/
</script>
</body>
</html>
