<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
if(isset($_POST['submit_add']))
{
  extract($_POST);
  
//code to add image to database image table
   $stmt = $conn->prepare("INSERT INTO district(district_name,district_status)VALUES(:district_name,:district_status)");
   $executed=$stmt->execute(array(':district_name' => $district_name,':district_status' => $district_status));
   if($executed){
       $success_msg="District Added Successfully.."; 
   }
            
}
if(isset($_POST['submit_update']))
{
  extract($_POST);
       $stmt = $conn->prepare("UPDATE district SET district_name=:district_name,district_status=:district_status WHERE district_id=$district_id");
       $executed=$stmt->execute(array(':district_name' => $district_name,':district_status' => $district_status2));
       if($executed){
           $success_msg="District Updated Successfully.."; 
       }
}

//get all categories
$stmt_district_list = $conn->prepare("SELECT * FROM district ORDER BY district_id DESC");
$stmt_district_list->execute();
$row_district_list = $stmt_district_list->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Add District</title>

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
  <div class="container-fluid">
    <section class="content">
        <div class="row">
          <div class="col-6">
            <!-- /.card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add District</h3>
              </div>
              <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_add_district(this)">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">District Name</label>
                    <input type="text" class="form-control" placeholder="District Name" name="district_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">District Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="district_status" checked value="1" id="add_district_active">
                      <label for="add_district_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="district_status" value="2" id="add_district_inactive">
                      <label for="add_district_inactive" class="form-check-label">Inactive</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_add">Submit</button>
                </div>
              </form>
              <script>
                  function check_add_district(frm)
                  {
                    //alert(frm.district_image.value);
                    //check if all field are complete
                    if(frm.total_days.value=="" || frm.district_fees.value=="" || frm.district_status.value=="")
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
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">District List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($row_district_list)
                    {
                        for($c=0;$c<count($row_district_list);$c++)
                        {
                            
                      ?>
                      <tr>
                        <td><?php echo $c+1;?></td>
                        <td><?php echo $row_district_list[$c]['district_name'];?></td>
                        <td><?php echo $row_district_list[$c]['district_status']==1?'Active':'Inactive';?></td>
                        <td><button type="button" class="btn btn-primary btn-sm modalButton" data-toggle="modal" data-id="<?php echo $row_district_list[$c]['district_id'];?>">
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
$(document).ready(function(){
    $(".modalButton").click(function(){
        var district_id =$(this).data('id');
        
        $.ajax({
            url:"get_update_district_modal.php",
            method:"post",
            data:{district_id:district_id},
            success:function(response){
                $(".modal-content").html(response);
                $("#modal-default").modal('show');
            }
        })
    })
})
</script>

<script>
  function check_update_district(frm)
  {
    //alert(frm.district_image.value);
    //check if all field are complete
    if(frm.total_days.value=="" || frm.district_fees.value=="" || frm.district_status.value=="")
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
