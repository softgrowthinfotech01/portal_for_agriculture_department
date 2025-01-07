<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";

if(!isset($_SESSION['sess_subject_id']))
{
    echo '<script>alert("Subject Id not found. Please try again.");window.location.href = "subjects";</script>';
}

if(isset($_POST['submit_question']))
{
 /*  echo "<pre>";
    print_r($_POST);exit;
   echo "</pre>";*/
    extract($_POST);
    //check type of question
    if($radio_question==1)
    {
        $question=$question_text;
    }
    elseif($radio_question==2)
    {
        $question=$question_summernote;
    }
    elseif($radio_question==3)
    {
        if($_FILES['question_image']['name']!="")
    	{
    	    //print_r($_FILES);exit;
    		$file_name1=$_FILES['question_image']['name'];
    		$file_tmp1=$_FILES['question_image']['tmp_name'];
    		$errors1=array();
    		$arr1=explode('.',$file_name1);
    		$extension1=strtolower(end($arr1));
    		
    		$allowed1=array('jpg','jpeg','png');
    		
    		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
    		if(in_array($extension1,$allowed1))
    		{
        		if(empty($errors1))
        		{
        			if(move_uploaded_file($file_tmp1,"../uploaded_images/question/".$date1))	
        			{
        			    $question=$date1;
        			}
        		}
    		}
    	}
    }
    //check type of option1
    if($radio_option1==1)
    {
        $option1=$option1_text;
    }
    elseif($radio_option1==2)
    {
        $option1=$option1_summernote;
    }
    elseif($radio_option1==3)
    {
        
        if($_FILES['option1_image']['name']!="")
    	{
    	    //print_r($_FILES);exit;
    		$file_name1=$_FILES['option1_image']['name'];
    		$file_tmp1=$_FILES['option1_image']['tmp_name'];
    		$errors1=array();
    		$arr1=explode('.',$file_name1);
    		$extension1=strtolower(end($arr1));
    		
    		$allowed1=array('jpg','jpeg','png');
    		
    		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
    		if(in_array($extension1,$allowed1))
    		{
        		if(empty($errors1))
        		{
        			if(move_uploaded_file($file_tmp1,"../uploaded_images/question/".$date1))	
        			{
        			    $option1=$date1;
        			}
        		}
    		}
    	}
    }
    //check type of option2
    if($radio_option2==1)
    {
        $option2=$option2_text;
    }
    elseif($radio_option2==2)
    {
        $option2=$option2_summernote;
    }
    elseif($radio_option2==3)
    {
        if($_FILES['option2_image']['name']!="")
    	{
    	    //print_r($_FILES);exit;
    		$file_name1=$_FILES['option2_image']['name'];
    		$file_tmp1=$_FILES['option2_image']['tmp_name'];
    		$errors1=array();
    		$arr1=explode('.',$file_name1);
    		$extension1=strtolower(end($arr1));
    		
    		$allowed1=array('jpg','jpeg','png');
    		
    		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
    		if(in_array($extension1,$allowed1))
    		{
        		if(empty($errors1))
        		{
        			if(move_uploaded_file($file_tmp1,"../uploaded_images/question/".$date1))	
        			{
        			    $option2=$date1;
        			}
        		}
    		}
    	}
    }
    //check type of option3
    if($radio_option3==1)
    {
        $option3=$option3_text;
    }
    elseif($radio_option3==2)
    {
        $option3=$option3_summernote;
    }
    elseif($radio_option3==3)
    {
        if($_FILES['option3_image']['name']!="")
    	{
    	    //print_r($_FILES);exit;
    		$file_name1=$_FILES['option3_image']['name'];
    		$file_tmp1=$_FILES['option3_image']['tmp_name'];
    		$errors1=array();
    		$arr1=explode('.',$file_name1);
    		$extension1=strtolower(end($arr1));
    		
    		$allowed1=array('jpg','jpeg','png');
    		
    		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
    		if(in_array($extension1,$allowed1))
    		{
        		if(empty($errors1))
        		{
        			if(move_uploaded_file($file_tmp1,"../uploaded_images/question/".$date1))	
        			{
        			    $option3=$date1;
        			}
        		}
    		}
    	}
    }
    //check type of option4
    if($radio_option4==1)
    {
        $option4=$option4_text;
    }
    elseif($radio_option4==2)
    {
        $option4=$option4_summernote;
    }
    elseif($radio_option4==3)
    {
        if($_FILES['option4_image']['name']!="")
    	{
    	    //print_r($_FILES);exit;
    		$file_name1=$_FILES['option4_image']['name'];
    		$file_tmp1=$_FILES['option4_image']['tmp_name'];
    		$errors1=array();
    		$arr1=explode('.',$file_name1);
    		$extension1=strtolower(end($arr1));
    		
    		$allowed1=array('jpg','jpeg','png');
    		
    		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
    		if(in_array($extension1,$allowed1))
    		{
        		if(empty($errors1))
        		{
        			if(move_uploaded_file($file_tmp1,"../uploaded_images/question/".$date1))	
        			{
        			    $option4=$date1;
        			}
        		}
    		}
    	}
    }
    //check type of option5
    if($radio_option5==1)
    {
        $option5=$option5_text;
    }
    elseif($radio_option5==2)
    {
        $option5=$option5_summernote;
    }
    elseif($radio_option5==3)
    {
        if($_FILES['option5_image']['name']!="")
    	{
    	    //print_r($_FILES);exit;
    		$file_name1=$_FILES['option5_image']['name'];
    		$file_tmp1=$_FILES['option5_image']['tmp_name'];
    		$errors1=array();
    		$arr1=explode('.',$file_name1);
    		$extension1=strtolower(end($arr1));
    		
    		$allowed1=array('jpg','jpeg','png');
    		
    		$date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
    		if(in_array($extension1,$allowed1))
    		{
        		if(empty($errors1))
        		{
        			if(move_uploaded_file($file_tmp1,"../uploaded_images/question/".$date1))	
        			{
        			    $option5=$date1;
        			}
        		}
    		}
    	}
    }
    $stmt = $conn->prepare("INSERT INTO question_details(question_type, question, option1_type, option1, option2_type, option2, option3_type, option3, option4_type, option4, option5_type, option5, correct_option, subject_id, agent_id,added_on)VALUES(:question_type, :question, :option1_type, :option1, :option2_type, :option2, :option3_type, :option3, :option4_type, :option4, :option5_type, :option5, :correct_option, :subject_id, :agent_id,:added_on)");
   $executed=$stmt->execute(array(':question_type' => $radio_question,':question' => $question,':option1_type' => $radio_option1,':option1' => $option1,':option2_type' => $radio_option2,':option2' => $option2,':option3_type' => $radio_option3,':option3' => $option3,':option4_type' => $radio_option4,':option4' => $option4,':option5_type' => $radio_option5,':option5' => $option5,':correct_option' => $correct_option,':subject_id' => $_SESSION['sess_subject_id'],':agent_id' => $_SESSION['agent_id'],':added_on' => date('Y-m-d H:i:s')));
   if($executed){
       echo '<script>alert("Question added");window.location.href = "add_question";</script>';
   }
}

//echo '<script>alert("System is under maintainance for sometime. Please try again after later.");window.location.href = "logout";</script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Agent</title>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    <script src=""></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3.0.1/es5/tex-mml-chtml.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- include summernote css/js -->

  <!-- Google Font: Source Sans Pro -->
  
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .someData{
			display:none;
		    padding: 1%;
		}
		
		.activeTab{
			display:block;
		}
  </style>
</head>
<body class="hold-transition sidebar-mini">
      <?php require_once 'header.php';?>
      
       <div class="content-wrapper mt-5">
           <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                           <h3 class="card-title">Add Questions</h3>
                      </div>
                          <div class="card-body">
                              <form method="post" action="" enctype="multipart/form-data" onsubmit="return func_add_question(this)">
                                 
                                <div class="card-body col-md-7 mx-auto border mb-3">
                                  <div class="form-group">
                                    <label for="" style=";">Question
                                        <span class="ml-5">
                                          
                                            		<label for="radio_question_text">
                                            			<input type="radio" value="1" name="radio_question" class="radioCls" id="radio_question_text" checked> Text
                                            		</label>
                                            		<label for="radio_question_summernote">
                                            			<input type="radio" value="2" name="radio_question" class="radioCls" id="radio_question_summernote"> Summernote
                                            		</label>
                                            		<label class="ml-2" for="radio_question_image">
                                            			<input type="radio" value="3" name="radio_question" class="radioCls" id="radio_question_image"> Image
                                            		</label>
                                            <!--divs started-->
                                            <div class="someData activeTab" id="div_question_text" >
                                            	 <textarea  class="form-control" name="question_text" id="question_text"></textarea>
                                            	 
                                            </div>
                                            <div class="someData" id="div_question_summernote">
                                            	 <textarea name="question_summernote" id="question_summernote" class="editor"></textarea>
                                            </div>
                                            <div class="someData " id="div_question_image">
                                            	<input type="file" class="form-control" name="question_image" id="question_image" onchange="return checkImageDetails(this,'question_image')"/>
                                            </div>
                                        </span>
                                    </label>
                                    
                                    <input type="hidden" name="subject_id" value="<?php //echo $row_subject_by_id[0]['subject_id'];?>">
                                   
                                  </div>
                                  <div class="row">
                                  <div class="form-group col-md-6">
                                    <label>Option 1</label>
                                    <!--<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Option 1" name="option1">-->
                                    
                                            		<label for="radio_option1_text">
                                            			<input type="radio" value="1" name="radio_option1" class="radioCls" id="radio_option1_text" checked> Text
                                            		</label>
                                            		<label for="radio_option1_summernote">
                                            			<input type="radio" value="2" name="radio_option1" class="radioCls" id="radio_option1_summernote"> Summernote
                                            		</label>
                                            		<label class="ml-2" for="radio_option1_image">
                                            			<input type="radio" value="3" name="radio_option1" class="radioCls" id="radio_option1_image"> Image
                                            		</label>
                                            <!--divs started-->
                                            <div class="someData activeTab" id="div_option1_text">
                                            	 <input type="text" class="form-control" name="option1_text" id="option1_text"/>
                                            </div>
                                            <div class="someData" id="div_option1_summernote">
                                            	 <textarea name="option1_summernote" id="option1_summernote" class="editor"></textarea>
                                            </div>
                                            <div class="someData " id="div_option1_image">
                                            	<input type="file" class="form-control" name="option1_image" id="option1_image" onchange="return checkImageDetails(this,'option1_image')"/>
                                            </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label>Option 2</label>
                                    <label for="radio_option2_text">
                                            			<input type="radio" value="1" name="radio_option2" class="radioCls" id="radio_option2_text" checked> Text
                                            		</label>
                                            		<label for="radio_option2_summernote">
                                            			<input type="radio" value="2" name="radio_option2" class="radioCls" id="radio_option2_summernote"> Summernote
                                            		</label>
                                            		<label class="ml-2" for="radio_option2_image">
                                            			<input type="radio" value="3" name="radio_option2" class="radioCls" id="radio_option2_image" onchange="return checkImageDetails(this,'option2_image')"> Image
                                            		</label>
                                            <!--divs started-->
                                            <div class="someData activeTab" id="div_option2_text">
                                            	 <input type="text" class="form-control" name="option2_text" id="option2_text" />
                                            </div>
                                            <div class="someData" id="div_option2_summernote">
                                            	 <textarea id="option2_summernote" name="option2_summernote" class="editor"></textarea>
                                            </div>
                                            <div class="someData " id="div_option2_image">
                                            	<input type="file" class="form-control" name="option2_image" id="option2_image" onchange="return checkImageDetails(this,'option2_image')"/>
                                            </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label>Option 3</label>
                                    <label for="radio_option3_text">
                                            			<input type="radio" value="1" name="radio_option3" class="radioCls" id="radio_option3_text" checked> Text
                                            		</label>
                                            		<label for="radio_option3_summernote">
                                            			<input type="radio" value="2" name="radio_option3" class="radioCls" id="radio_option3_summernote"> Summernote
                                            		</label>
                                            		<label class="ml-2" for="radio_option3_image">
                                            			<input type="radio" value="3" name="radio_option3" class="radioCls" id="radio_option3_image"> Image
                                            		</label>
                                            <!--divs started-->
                                            <div class="someData activeTab" id="div_option3_text">
                                            	 <input type="text" class="form-control" name="option3_text" id="option3_text" />
                                            </div>
                                            <div class="someData" id="div_option3_summernote">
                                            	 <textarea id="option3_summernote" name="option3_summernote" class="editor"></textarea>
                                            </div>
                                            <div class="someData " id="div_option3_image">
                                            	<input type="file" class="form-control" name="option3_image" id="option3_image" onchange="return checkImageDetails(this,'option3_image')"/>
                                            </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label >Option 4</label>
                                    <label for="radio_option4_text">
                                            			<input type="radio" value="1" name="radio_option4" class="radioCls" id="radio_option4_text" checked> Text
                                            		</label>
                                            		<label for="radio_option4_summernote">
                                            			<input type="radio" value="2" name="radio_option4" class="radioCls" id="radio_option4_summernote"> Summernote
                                            		</label>
                                            		<label class="ml-2" for="radio_option4_image">
                                            			<input type="radio" value="3" name="radio_option4" class="radioCls" id="radio_option4_image"> Image
                                            		</label>
                                            <!--divs started-->
                                            <div class="someData activeTab" id="div_option4_text">
                                            	 <input type="text" class="form-control" name="option4_text" id="option4_text" />
                                            </div>
                                            <div class="someData" id="div_option4_summernote">
                                            	 <textarea id="option4_summernote" name="option4_summernote" class="editor"></textarea>
                                            </div>
                                            <div class="someData " id="div_option4_image">
                                            	<input type="file" class="form-control" name="option4_image" id="option4_image" onchange="return checkImageDetails(this,'option4_image')"/>
                                            </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label>Option 5</label>
                                    <label for="radio_option5_text">
                                            			<input type="radio" value="1" name="radio_option5" class="radioCls" id="radio_option5_text" checked> Text
                                            		</label>
                                            		<label for="radio_option5_summernote">
                                            			<input type="radio" value="2" name="radio_option5" class="radioCls" id="radio_option5_summernote"> Summernote
                                            		</label>
                                            		<label class="ml-2" for="radio_option5_image">
                                            			<input type="radio" value="3" name="radio_option5" class="radioCls" id="radio_option5_image"> Image
                                            		</label>
                                            <!--divs started-->
                                            <div class="someData activeTab" id="div_option5_text">
                                            	 <input type="text" class="form-control" name="option5_text" id="option5_text" />
                                            </div>
                                            <div class="someData" id="div_option5_summernote">
                                            	 <textarea id="option5_summernote" name="option5_summernote" class="editor"></textarea>
                                            </div>
                                            <div class="someData " id="div_option5_image">
                                            	<input type="file" class="form-control" name="option5_image" id="option5_image" onchange="return checkImageDetails(this,'option5_image')"/>
                                            </div>
                                  </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Correct Option</label>
                                    <select name="correct_option" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                
                                <div class="card-footer">
                                  <button type="submit" class="btn btn-primary" name="submit_question">Submit</button>
                                </div>
                              </form>
              <script>
                  function func_add_question(frm)
                  {
                      
                      //check if all fields are filled
                      /*if(frm.radio_question.value=="" || frm.radio_option1.value=="" || frm.radio_option2.value=="" || frm.radio_option3.value=="" || frm.radio_option4.value=="" ||  frm.correct_option.value=="")
                      {
                          alert('Please fill all fields.');
                          return false;
                      }
                      else
                      {*/
                         /* $.ajax({
                              url: "ajax_add_question.php",
                              method:'POST',
                              data: {question: frm.question.value,option1:frm.option1.value,option2:frm.option2.value,option3:frm.option3.value,option4:frm.option4.value,correct_option:frm.correct_option.value},
                              success: function(data){
                                 //window.location.href = "questions";
                                 if(data==1)
                                 {
                                    alert('Question added.'); 
                                 }
                              }
                           });*/
                          // return true;
                      //}
                  }
              </script>
                          </div>
                    </div>
                  </div>
                </div>
              </div>
       </div>

  
    
<!-- jQuery -->

<!-- AdminLTE App -->
<!--<script src="dist/js/adminlte.min.js"></script>-->
<!--<script src="plugins/jquery/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<!--<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!-- DataTables  & Plugins -->
<!--<script src="plugins/datatables/jquery.dataTables.min.js"></script>-->
<!--<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>-->
<!--<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>-->
<!--<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>-->
<!--<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>-->
<!--<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>-->
<!--<script src="plugins/jszip/jszip.min.js"></script>-->
<!--<script src="plugins/pdfmake/pdfmake.min.js"></script>-->
<!--<script src="plugins/pdfmake/vfs_fonts.js"></script>-->
<!--<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>-->
<!--<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>-->
<!--<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>-->
<!-- Page specific script -->
<script>
/*  $(function () {
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
  });*/
</script>

    <script>
      $(document).ready(function() {
          $('#question_text').bind("cut copy paste",function(e) {
             e.preventDefault();
          });
          $('#option1_text').bind("cut copy paste",function(e) {
             e.preventDefault();
          });
          $('#option2_text').bind("cut copy paste",function(e) {
             e.preventDefault();
          });
          $('#option3_text').bind("cut copy paste",function(e) {
             e.preventDefault();
          });
          $('#option4_text').bind("cut copy paste",function(e) {
             e.preventDefault();
          });
          $('#option5_text').bind("cut copy paste",function(e) {
             e.preventDefault();
          });
     });
    </script>
    <script>
    
    $(document).ready(function () {
        
    $('#question_summernote').summernote({
        //maximumImageFileSize: 1048576,
        callbacks: {
        onImageUpload: function(files) {
          sendFile(files[0],"question_summernote");
          },
              onPaste: function (e) {
                e.preventDefault();
            }
        } 
    });
        
    $('#option1_summernote').summernote({
        callbacks: {
        onImageUpload: function(files) {
          sendFile(files[0],"option1_summernote");
          },
              onPaste: function (e) {
                e.preventDefault();
            }
        }
    });
        
    $('#option2_summernote').summernote({
        callbacks: {
        onImageUpload: function(files) {
          sendFile(files[0],"option2_summernote");
          },
              onPaste: function (e) {
                e.preventDefault();
            }
        }
    });
        
    $('#option3_summernote').summernote({
        callbacks: {
        onImageUpload: function(files) {
          sendFile(files[0],"option3_summernote");
          },
              onPaste: function (e) {
                e.preventDefault();
            }
        }
    });
        
    $('#option4_summernote').summernote({
        callbacks: {
        onImageUpload: function(files) {
          sendFile(files[0],"option4_summernote");
          },
              onPaste: function (e) {
                e.preventDefault();
            }
        }
    });
        
    $('#option5_summernote').summernote({
        callbacks: {
        onImageUpload: function(files) {
          sendFile(files[0],"option5_summernote");
          },
              onPaste: function (e) {
                e.preventDefault();
            }
        }
    });

    function sendFile(file, sid) {
        data = new FormData();
          data.append("file", file);
        $.ajax({
           url: "uploader.php",
           data: data,
           cache: false,
           contentType: false,
           processData: false,
           type: 'POST',
           success: function(data){
            $('#'+sid).summernote("insertImage", data, 'filename');
            
            $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");
        },
           error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus+" "+errorThrown);
          }
        });
    }
});


/*$('#question_summernote').summernote();
$('#option1_summernote').summernote();
$('#option2_summernote').summernote();
$('#option3_summernote').summernote();
$('#option4_summernote').summernote();
$('#option5_summernote').summernote();*/
    
     /* $('.editor').summernote({
           
            tabsize: 2,
            height: 100,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'italic','clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ] ,
            callbacks: {
                onImageUpload: function(files, editor, $editable) {
                    alert(files);
                  question_sendFile(files[0],editor,$editable);
                  } ,
                  onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
        function question_sendFile(file,editor,welEditable) {
          data = new FormData();
          data.append("file", file);
          $.ajax({
           url: "uploader.php",
           data: data,
           cache: false,
           contentType: false,
           processData: false,
           type: 'POST',
           success: function(data){
           //alert(data);
            $('.editor').summernote("insertImage", data, 'filename');
            
            $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");
        },
           error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus+" "+errorThrown);
          }
        });
       }
        $('.editor').summernote('fontSize', 16);
        $('.editor').summernote('fontSizeUnit', 'px');
        //$('#summernote').summernote('code', '');
        //
//removeFormat
        $('.editor').summernote('fontName', 'Arial'); 
       */
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


                                  <script>


    
    
    $(document).ready(function(){
			//after load will check the checkbox is checked or not
		/*	var check = $("#radio_question_text").prop("checked");
			if(check){
				$("#div_question_text").addClass("activeTab");
			}*/
			//for question
			//click on text
			$("#radio_question_text").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_question_summernote").removeClass("activeTab");
				$("#div_question_image").removeClass("activeTab");
				$("#div_question_text").addClass("activeTab");
			})
			//click on summernote
			$("#radio_question_summernote").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_question_image").removeClass("activeTab");
				$("#div_question_text").removeClass("activeTab");
				$("#div_question_summernote").addClass("activeTab");
			})
			//click on image
			$("#radio_question_image").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_question_text").removeClass("activeTab");
				$("#div_question_summernote").removeClass("activeTab");
				$("#div_question_image").addClass("activeTab");
			})
			
			//for option1
			//click on text
			$("#radio_option1_text").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option1_summernote").removeClass("activeTab");
				$("#div_option1_image").removeClass("activeTab");
				$("#div_option1_text").addClass("activeTab");
			})
			//click on summernote
			$("#radio_option1_summernote").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option1_image").removeClass("activeTab");
				$("#div_option1_text").removeClass("activeTab");
				$("#div_option1_summernote").addClass("activeTab");
			})
			//click on image
			$("#radio_option1_image").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option1_text").removeClass("activeTab");
				$("#div_option1_summernote").removeClass("activeTab");
				$("#div_option1_image").addClass("activeTab");
			})
			//for option2
			//click on text
			$("#radio_option2_text").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option2_summernote").removeClass("activeTab");
				$("#div_option2_image").removeClass("activeTab");
				$("#div_option2_text").addClass("activeTab");
			})
			//click on summernote
			$("#radio_option2_summernote").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option2_image").removeClass("activeTab");
				$("#div_option2_text").removeClass("activeTab");
				$("#div_option2_summernote").addClass("activeTab");
			})
			//click on image
			$("#radio_option2_image").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option2_text").removeClass("activeTab");
				$("#div_option2_summernote").removeClass("activeTab");
				$("#div_option2_image").addClass("activeTab");
			})
			//for option3
			//click on text
			$("#radio_option3_text").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option3_summernote").removeClass("activeTab");
				$("#div_option3_image").removeClass("activeTab");
				$("#div_option3_text").addClass("activeTab");
			})
			//click on summernote
			$("#radio_option3_summernote").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option3_image").removeClass("activeTab");
				$("#div_option3_text").removeClass("activeTab");
				$("#div_option3_summernote").addClass("activeTab");
			})
			//click on image
			$("#radio_option3_image").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option3_text").removeClass("activeTab");
				$("#div_option3_summernote").removeClass("activeTab");
				$("#div_option3_image").addClass("activeTab");
			})
			//for option4
			//click on text
			$("#radio_option4_text").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option4_summernote").removeClass("activeTab");
				$("#div_option4_image").removeClass("activeTab");
				$("#div_option4_text").addClass("activeTab");
			})
			//click on summernote
			$("#radio_option4_summernote").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option4_image").removeClass("activeTab");
				$("#div_option4_text").removeClass("activeTab");
				$("#div_option4_summernote").addClass("activeTab");
			})
			//click on image
			$("#radio_option4_image").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option4_text").removeClass("activeTab");
				$("#div_option4_summernote").removeClass("activeTab");
				$("#div_option4_image").addClass("activeTab");
			})
			//for option5
			//click on text
			$("#radio_option5_text").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option5_summernote").removeClass("activeTab");
				$("#div_option5_image").removeClass("activeTab");
				$("#div_option5_text").addClass("activeTab");
			})
			//click on summernote
			$("#radio_option5_summernote").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option5_image").removeClass("activeTab");
				$("#div_option5_text").removeClass("activeTab");
				$("#div_option5_summernote").addClass("activeTab");
			})
			//click on image
			$("#radio_option5_image").on("click", function(){
			//	check = $(this).prop("checked");
				$("#div_option5_text").removeClass("activeTab");
				$("#div_option5_summernote").removeClass("activeTab");
				$("#div_option5_image").addClass("activeTab");
			})
		});
		
</script>  
    
    
  
                                  
                  <script>
                      function checkImageDetails(img,file_id)
                      {
                          var fileName =img.files[0]['name'];
                          var filePath = fileName.value;
                            // Allowing file type
                            var allowedExtensions =/(\.jpg|\.jpeg|\.png)$/i;
                                    
                            //get image size
                            var fileSize =img.files[0]['size'];
                             
                            if (!allowedExtensions.exec(fileName)) {
                                alert('File not supported. Please enter only .jpg or .png image.');
                                $("#"+file_id).val('');
                                return false;
                            }
                           
                            // Allowing file type
                            var allowedExtensions =/(\.jpg|\.jpeg|\.png)$/i;
                                    
                            //get image size
                            var fileSize =img.files[0]['size'];
                             
                            if (!allowedExtensions.exec(fileName)) {
                                alert('File not supported. Please enter only .jpg or .png image.');
                                
                                $("#"+file_id).val('');
                                return false;
                            }
                            else
                            {
                                //check image size is below 2MB
                                if(fileSize<=<?php echo $row_restrictions[0]['max_file_size_in_kb'];?>)
                                {
                                    
                                }
                                else
                                {
                                    alert('Image size should be less than 2MB.');
                                    
                                    $("#"+file_id).val('');
                                    return false;
                                }
                            }
                      }
                  </script> 

</body>
</html>
