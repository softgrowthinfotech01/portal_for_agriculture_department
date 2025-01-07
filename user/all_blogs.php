<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";

//get all categories
$stmt_question_list = $conn->prepare("SELECT * FROM blog WHERE user_id=".$row_user_details[0]['user_id']." ORDER BY blog_id DESC");
$stmt_question_list->execute();
$row_question_list = $stmt_question_list->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User</title>

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
  
  <style>
           /*  @font-face {
    font-family: KrutiDev;
    src: url(k010.woff);
}
           .my_text
            {
                font-family:KrutiDev;
            }*/
        </style>
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
                <h3 class="card-title">Blogs List <?php //echo $_SESSION['agent_id'];?></h3> 
               <span class="float-right"><a href="add_blog"><button type="button" class="btn btn-primary btn-sm">Add Blog</button></a>
                    </span>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Category Name</th>
                    <th>Blog Title</th>
                   <th>Blog Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($row_question_list)
                    {
                        for($c=0;$c<count($row_question_list);$c++)
                        {
                            
                      ?>
                      <tr class="my_text">
                        <td><?php echo $c+1;?></td>
                        <td>
                        <?php 
                            $stmt_cate = $conn->prepare("SELECT * FROM category WHERE category_id=".$row_question_list[$c]['category_id']);
                            $stmt_cate->execute();
                            $row_cate = $stmt_cate->fetchAll(PDO::FETCH_ASSOC);
                            echo $row_cate[0]['category_name'];
                           
                        ?>
                        </td>
                        <td>
                            <?php
                        /*    if($row_question_list[$c]['blog_title_image']=="")
                            {
                                ?><img src="../assets/images/picture-not-available.jpg" style="height:100px;width:100px;">
                                <?php
                            }
                            else
                            {
                                ?><img src="../uploaded_images/blog_title_images/<?php echo $row_question_list[$c]['blog_title_image'];?>">
                                <?php
                            }*/
                            
                        echo $row_question_list[$c]['blog_title'];
                        ?>
                        </td>
                        <td>
                        <?php 
                        if($row_question_list[$c]['blog_status']==1)
                        {
                            echo "Active";
                        }
                        elseif($row_question_list[$c]['blog_status']==2)
                        {
                            echo "Inactive";
                        }
                        ?>
                        </td>
                        <td>
                        <button type="button" class="btn btn-primary btn-sm" onclick="startsession('sess_blog_id',<?php echo $row_question_list[$c]['blog_id'];?>)">Update</button>
                        </td>
                      </tr>
                      <?php
                        }
                    }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sr. No.</th>
                    <th>District Name</th>
                    <th>Blog</th>
                    
                    <th>Blog Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                <script>
                function startsession(name,value)
                    {
                        $.ajax({
                          url: "createsession.php",
                          method:'POST',
                          data: {name: name, value: value},
                          success: function(data){
                             window.location.href = "update_blog";
                          }
                        });
                    }
               /* function confirm_delete(blog_id)
                {
                    if (confirm("Are you sure you want to delete this question?") == true) 
                    {
                        //call ajax to delete question
                        $.ajax({
                          url: "ajax_delete_question.php",
                          method:'POST',
                          data: {blog_id: blog_id},
                          success: function(data){
                             window.location.href = "questions";
                          }
                        });
                    } 
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
