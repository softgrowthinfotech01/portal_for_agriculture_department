<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";

if(!isset($_SESSION['sess_subject_id']))
{
    echo '<script>alert("Subject Id not found. Please try again.");window.location.href = "subjects";</script>';
}
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
$stmt_question_list = $conn->prepare("SELECT * FROM question_details WHERE subject_id=".$_SESSION['sess_subject_id']." AND agent_id=".$_SESSION['agent_id']." ORDER BY question_details_id DESC");
$stmt_question_list->execute();
$row_question_list = $stmt_question_list->fetchAll(PDO::FETCH_ASSOC);

/*
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
$row_direct_sub_category_list = $stmt_direct_sub_category_list->fetchAll(PDO::FETCH_ASSOC);*/
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
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3.0.1/es5/tex-mml-chtml.js"></script>
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
                <h3 class="card-title">Assign Subjects to Agent <?php echo $_SESSION['agent_id'];?></h3> 
                <span class="float-right"><button type="button" class="btn btn-primary btn-sm" onclick="startsession('sess_subject_id',<?php echo $_SESSION['sess_subject_id'];?>)">Add Question</button>
                    </span>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Option 5</th>
                    <th>Correct Option</th>
                    <th>Action(You can Edit or Delete only the Questions that have not been added to any exam.)</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($row_question_list)
                    {
                        for($c=0;$c<count($row_question_list);$c++)
                        {
                            
                      ?>
                      <tr>
                        <td><?php echo $c+1;?></td>
                        <td>
                        <?php 
                            if($row_question_list[$c]['question_type']==3)
                            {
                                ?>
                                <img src="../uploaded_images/question/<?php echo $row_question_list[$c]['question'];?>" style="width:150px;height:150px;">
                                <?php
                            }
                            else
                            {
                                echo $row_question_list[$c]['question'];
                            }
                        ?>
                        </td>
                        <td>
                        <?php 
                            if($row_question_list[$c]['option1_type']==3)
                            {
                                ?>
                                <img src="../uploaded_images/question/<?php echo $row_question_list[$c]['option1'];?>" style="width:150px;height:150px;">
                                <?php
                            }
                            else
                            {
                                echo $row_question_list[$c]['option1'];
                            }
                        ?>
                        </td>
                        <td>
                        <?php 
                            if($row_question_list[$c]['option2_type']==3)
                            {
                                ?>
                                <img src="../uploaded_images/question/<?php echo $row_question_list[$c]['option2'];?>" style="width:150px;height:150px;">
                                <?php
                            }
                            else
                            {
                                echo $row_question_list[$c]['option2'];
                            }
                        ?>
                        </td>
                        <td>
                        <?php 
                            if($row_question_list[$c]['option3_type']==3)
                            {
                                ?>
                                <img src="../uploaded_images/question/<?php echo $row_question_list[$c]['option3'];?>" style="width:150px;height:150px;">
                                <?php
                            }
                            else
                            {
                                echo $row_question_list[$c]['option3'];
                            }
                        ?></td>
                        <td>
                        <?php 
                            if($row_question_list[$c]['option4_type']==3)
                            {
                                ?>
                                <img src="../uploaded_images/question/<?php echo $row_question_list[$c]['option4'];?>" style="width:150px;height:150px;">
                                <?php
                            }
                            else
                            {
                                echo $row_question_list[$c]['option4'];
                            }
                        ?></td>
                        <td>
                        <?php 
                            if($row_question_list[$c]['option5_type']==3)
                            {
                                ?>
                                <img src="../uploaded_images/question/<?php echo $row_question_list[$c]['option5'];?>" style="width:150px;height:150px;">
                                <?php
                            }
                            elseif($row_question_list[$c]['option5_type']==1 || $row_question_list[$c]['option5_type']==2)
                            {
                                echo $row_question_list[$c]['option5'];
                            }
                        ?></td>
                        <td><?php echo $row_question_list[$c]['correct_option'];?></td>
                        <td><?php
                        //check if this question is already selected by admin
                        $stmt_check_que = $conn->prepare("SELECT * FROM questions_in_exam WHERE question_details_id=".$row_question_list[$c]['question_details_id']);
                        $stmt_check_que->execute();
                        $row_check_que = $stmt_check_que->fetchAll(PDO::FETCH_ASSOC);
                        if(!$row_check_que)
                        {
                            ?>
                            <button type="button" class="btn btn-success btn-sm" onclick="func_edit_question(<?php echo $row_question_list[$c]['question_details_id'];?>)">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirm_delete(<?php echo $row_question_list[$c]['question_details_id'];?>)">Delete</button>
                            <?php
                        }
                        ?></td>
                      </tr>
                      <?php
                        }
                    }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Option 5</th>
                    <th>Correct Option</th>
                    <th>Action(You can Edit or Delete only the Questions that have not been added to any exam.)</th>
                  </tr>
                  </tfoot>
                </table>
                <script>
                function func_edit_question(question_details_id)
                {
                    $.ajax({
                      url: "ajax_get_edit_question.php",
                      method:'POST',
                      data: {question_details_id: question_details_id},
                      success: function(data){
                         window.location.href = "edit_question";
                      }
                    });
                }
                function confirm_delete(question_details_id)
                {
                    if (confirm("Are you sure you want to delete this question?") == true) 
                    {
                        //call ajax to delete question
                        $.ajax({
                          url: "ajax_delete_question.php",
                          method:'POST',
                          data: {question_details_id: question_details_id},
                          success: function(data){
                             window.location.href = "questions";
                          }
                        });
                    } 
                }
                    function startsession(name,value)
                    {
                        $.ajax({
                          url: "createsession.php",
                          method:'POST',
                          data: {name: name, value: value},
                          success: function(data){
                             window.location.href = "add_question";
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
/*$(document).ready(function(){
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
})*/
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
