<?php
session_start();
require_once "conn.php";

if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$stmt = $conn->prepare("SELECT * FROM slider_details WHERE slider_id=".$id);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_POST['submit']))
{
	extract($_POST);
	//print_r($_FILES);exit;
	if($_FILES['slider_image']['name']!="")
	{
	$file_size1=$_FILES['slider_image']['size'];
	$file_name1=$_FILES['slider_image']['name'];
	$file_tmp1=$_FILES['slider_image']['tmp_name'];
	$errors1=array();
	$arr1=explode('.',$file_name1);
	$extension1=strtolower(end($arr1));
	//to check extension
	$allowed1=array('jpg','jpeg','png');
	
	//to check size
	
	
	//move_uploaded_file("location od temperory stored file","location where i want to store my file");
	
	$date1=$arr1[0]."_".date('dmYhis').".$extension1";
		if(empty($errors1))
		{
				//echo "in empty error.";exit;
			if(move_uploaded_file($file_tmp1,"images/slider/".$date1))	
			{
			}
			else
			{
				//echo "File not uploaded";
			}

		}
	}
	else
	{
		$date1=$row[0]['slider_image'];
	}
	
	
	$stmt_update = $conn->prepare('UPDATE slider_details SET slider_image=:slider_image,slider_status=:slider_status WHERE slider_id='.$id);		
	$executed=$stmt_update->execute(array('slider_image' => $date1,':slider_status' => $slider_status));
	if($executed)
	{
		echo "<script>alert('Update Successfully!!!')</script>" ;
		echo "<script>window.location.href='slider_list';</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "head.php"; ?>
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php require_once "header.php"; ?>
			<div class="right_col" role="main">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Update Slider</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content"><br />
						   <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="" enctype="multipart/form-data">
				               <div class="form-group">
								<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Previous Image<span class="required">*</span></label>
								<div id="inputHolder">
								  <img src="images/slider/<?php echo $row[0]['slider_image']; ?>" style="width:100px;height:100px;">				
								</div>
							   </div> 
								<div class="form-group">
									<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Add Slider Image <span class="required">*</span></label>
									<div id="inputHolder">
								   <input id="" class=" col-md-7 col-xs-12" type="file" name="slider_image">
								   <input id="" class=" col-md-7 col-xs-12" type="hidden" name="image1" value="<?php echo $row[0]['slider_image']; ?>" >											 
									</div>
								</div> 
								<script type="text/javascript">
								/*$('#file1').bind('change', function() {
									if((this.files[0].size/1024)>150)
									{
										alert("Image size should be less than 150kb");
										$('#file1').val('');
									}
									
									//alert('This file size is: ' + this.files[0].size/1024/1024 + "MB");
								});*/
								var _URL = window.URL || window.webkitURL;

								$("#file1").change(function(e) {
									var file, img;
									if ((file = this.files[0])) {
										img = new Image();
										//alert(file.size/1024);
										img.onload = function() {
											//alert(this.width + " " + this.height);
											if(file.size/1024>1023 || this.width!=1500 || this.height!=1500)
											{
												alert("Image size should be less than 1 MB, height=1500px and width=1500px.");
												$('#file1').val('');
											}
										};
										img.onerror = function() {
											alert( "not a valid file: " + file.type);
										};
										img.src = _URL.createObjectURL(file);
									}

								});
							</script>		
				            <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									Active:
									<input type="radio" class="flat" name="slider_status" id="genderM" value="active" <?php if($row[0]['slider_status']=='active'){echo "checked";} ?>> 
									Inactive:
									<input type="radio" class="flat" name="slider_status" id="genderF" value="inactive" <?php if($row[0]['slider_status']=='inactive'){echo "checked";} ?>>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" name="submit" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-primary">Cancel</button>
								</div>
							</div>
                           </form>
							</div>
						</div>
					</div>
				</div>
				<?php require "footer.php" ; ?>		
			</div>
		</div>
	</div>
	<?php require "footlink.php" ; ?>
  </body>
</html>
