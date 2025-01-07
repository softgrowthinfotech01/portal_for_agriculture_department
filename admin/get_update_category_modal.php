<?php
session_start();
    require_once('../conn.php');
    require_once('check_login.php');
    // Prepare a select statement
    $stmt_category_by_id = $conn->prepare("SELECT * FROM category WHERE category_id=".$_POST['category_id']);
	$stmt_category_by_id->execute();
	$row_category_by_id = $stmt_category_by_id->fetchAll(PDO::FETCH_ASSOC);
	  
?>
       <div class="modal-header">
              <h4 class="modal-title">Update Category</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_update_category(this)">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="hidden" name="category_id" value="<?php echo $row_category_by_id[0]['category_id'];?>">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Name" name="category_name2" value="<?php echo $row_category_by_id[0]['category_name'];?>">
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleInputFile">Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="category_image" name="category_image2" onchange="return checkImageDetails2(this)">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      
                      <div id="imagePreview2">
                        <img src="../uploaded_images/category/<?php //echo $row_category_by_id[0]['category_image'];?>" style="width:150px;height:150px;">
                      </div>
                    </div>
                  </div>-->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="category_status2" value="1" id="update_category_active" <?php echo $row_category_by_id[0]['category_status']==1?'checked':'';?>>
                      <label for="update_category_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="category_status2" value="2" id="update_category_inactive" <?php echo $row_category_by_id[0]['category_status']==2?'checked':'';?>>
                      <label for="update_category_inactive" class="form-check-label">Inactive</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_update">Submit</button>
                </div>
              </form>
            </div>
            <script>
                      function checkImageDetails2(img)
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
                                                'imagePreview2').innerHTML =
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