<?php
require "check_login.php";
if(isset($_GET['id']))
	{		$id=$_GET['id'];	
			$stmt=$conn->prepare("DELETE FROM slider_details WHERE slider_id=$id");		
			$executed=$stmt->execute();	
			if($executed)
			{
			    echo "<script>alert('Deleted Successfully.');window.location.href='slider_list';</script>";
			}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once "head.php"; ?>
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
		<?php require_once "header.php"; ?>
			<div class="right_col" role="main">
				<div class="">
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<a href="add_slider_image" class="btn btn-primary submit" >Add Slider Image</a>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content table-responsive">
									<?php
									$stmt=$conn->prepare("SELECT * FROM slider_details");
									$stmt->execute();
									$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
									?>
									<table id="datatable" class="table table-striped table-bordered">
										<thead>
										  <tr>
											<th>Sr. No.</th>
											<th>Image</th>
											<th>Status</th>
											<th>Action</th>
										  </tr>
										</thead>
										<tbody>
										<?php
										for($i=0;$i<count($row);$i++)
										{
										?>
										  <tr>
											<td><?php echo $i+1;?></td>
											<td> <img src="images/slider/<?php echo $row[$i]['slider_image']; ?>" style="width:100px;height:100px;"></td>
											<td><?php echo $row[$i]['slider_status']; ?></td>
											<td>
											<a href="update_slider?id=<?php echo $row[$i]['slider_id']; ?>"><button class="btn btn-primary submit">Update</button></a>
											<a href="slider_list?id=<?php echo $row[$i]['slider_id']; ?>" onclick="return confirm('Are you sure you want to delete this?');"><button class="btn btn-danger">Delete</button></a>
											</td>
										  </tr>
										<?php
										}
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- foot-->
				<?php require "footer.php" ; ?>
				
				<!-- /foot-->
            </div>
            <!-- /page content -->
		</div>
	</div>
	<!-- footlink-->
	<?php require "footlink.php" ; ?>
	<!-- /footlink --> 
 </body>
</html>
