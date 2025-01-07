<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
//check if agent id is set
if(isset($_POST['add_questions']))
{
   // print_r($_POST);exit;
  extract($_POST);
  //first delete all previous selection
    //$sql_delete = "INSERT INTO questions_in_exam(exam_id,question_details_id,subject_id) VALUES" . $values_."";
    //echo "INSERT INTO questions_in_exam(exam_id,question_details_id,subject_id) VALUES" . $values_."";exit;
    
    $conn->beginTransaction();//to enable commit
    $sql_delete = $conn->prepare("DELETE FROM questions_in_exam WHERE exam_id=". $_SESSION['sess_exam_id']);
    $sql_delete->execute();
    
   $values = array();
   if(isset($question_details_id))
   {
        foreach($question_details_id as $value){
          $_value = "(".$_SESSION['sess_exam_id'].",".$value.")";
          array_push($values,$_value);
        }
        $values_ = implode(",",$values);
    
        $sql = "INSERT INTO questions_in_exam(exam_id,question_details_id,subject_id) VALUES" . $values_."";
        //echo "INSERT INTO questions_in_exam(exam_id,question_details_id,subject_id) VALUES" . $values_."";exit;
        $stmt = $conn->prepare($sql);
        $row=$stmt->execute();
        if($row)
        {
            $conn->commit();
        }
   }
   else
   {
       $conn->commit();
   }
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
	}*/
            
}

$stmt_exam = $conn->prepare("SELECT * FROM exam WHERE exam_id=".$_SESSION['sess_exam_id']);
$stmt_exam->execute();
$row_exam = $stmt_exam->fetchAll(PDO::FETCH_ASSOC);
//print_r($row_question_list);exit;

$stmt_selected_questions = $conn->prepare("SELECT question_details_id FROM questions_in_exam WHERE exam_id=".$_SESSION['sess_exam_id']);
$stmt_selected_questions->execute();
$row_selected_questions = $stmt_selected_questions->fetchAll(PDO::FETCH_ASSOC);
$question_ids_array=array_column($row_selected_questions,'question_details_id');

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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  
  <!--================Bootstrap 5 link for new modal popup===================-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!--================Bootstrap 5 link for new modal popup===================-->
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3.0.1/es5/tex-mml-chtml.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php require_once 'header.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
        <form method="post" action="">
    <section class="content">
      <div class="container-fluid">
       <?php
       
        //get subjects related to this exam
        $subject_array=explode(',',$row_exam[0]['exam_subjects_id']);
        for($i=0;$i<count($subject_array);$i++)
        {
            //get subject name
            $stmt_subject = $conn->prepare("SELECT subject_name FROM subject WHERE subject_id=".$subject_array[$i]);
            $stmt_subject->execute();
            $row_subject = $stmt_subject->fetchAll(PDO::FETCH_ASSOC);
            ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Select Questions for Subject: <?php echo $row_subject[0]['subject_name'];?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class=" example1 table table-bordered table-striped">
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
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        //get all categories
                        $stmt_question_list = $conn->prepare("SELECT * FROM question_details WHERE subject_id IN (".$subject_array[$i].") ORDER BY question_details_id DESC");
                        $stmt_question_list->execute();
                        $row_question_list = $stmt_question_list->fetchAll(PDO::FETCH_ASSOC);
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
                            else
                            {
                                echo $row_question_list[$c]['option5'];
                            }
                        ?></td>
                        <td><?php echo $row_question_list[$c]['correct_option'];?></td>
                            <td><input type="checkbox" name="question_details_id[]" value="<?php echo $row_question_list[$c]['question_details_id'].",".$row_question_list[$c]['subject_id'];?>" <?php echo in_array($row_question_list[$c]['question_details_id'],$question_ids_array)?'checked':''; ?>>
                            <input type="hidden" name="subject_ids[]" value="<?php echo $row_question_list[$c]['subject_id'];?>"></td>
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
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                <script>
                  /*  function startsession(name,value)
                    {
                        $.ajax({
                          url: "createsession.php",
                          method:'POST',
                          data: {name: name, value: value},
                          success: function(data){
                             window.location.href = "questions";
                          }
                       });
                    }*/
                </script>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      
        <?php
            }
        ?>
                <input type="submit" class="btn btn-primary" name="add_questions" value="Submit">
              </form>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    </section>
  
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
    $(".example1").DataTable(/*{
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)'*/);
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
