<?php
session_start();
    require_once('../conn.php');
    require_once('check_login.php');
    // Prepare a select statement
    $stmt_user_by_id = $conn->prepare("SELECT * FROM user WHERE user_id=".$_POST['user_id']);
	$stmt_user_by_id->execute();
	$row_user_by_id = $stmt_user_by_id->fetchAll(PDO::FETCH_ASSOC);
	  
?>
       <div class="modal-header">
              <h4 class="modal-title">Update User</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_update_user(this)">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">District</label>
                        <select name="district_id2" class="form-control">
                            <option value="">Select District</option>
                            <?php
                            $stmt_district_list = $conn->prepare("SELECT * FROM district ORDER BY district_id DESC");
                            $stmt_district_list->execute();
                            $row_district_list = $stmt_district_list->fetchAll(PDO::FETCH_ASSOC);
                            for($c=0;$c<count($row_district_list);$c++)
                            {
                                ?>
                                <option value="<?php echo $row_district_list[$c]['district_id'];?>" <?php if($row_district_list[$c]['district_id']==$row_user_by_id[0]['district_id'])echo "selected";?> ><?php echo $row_district_list[$c]['district_name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="hidden" name="user_id" value="<?php echo $row_user_by_id[0]['user_id'];?>">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="user Name" name="user_name2" value="<?php echo $row_user_by_id[0]['user_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Email</label>
                    <input type="text" class="form-control" id="user_email2" placeholder="User Email" name="user_email2" value="<?php echo $row_user_by_id[0]['user_email'];?>" onblur="check_update_email_exist2(this.value,<?php echo $row_user_by_id[0]['user_id'];?>)">
                  </div>
                        <span id="div_id_message_update_email" style="color:red;"></span>
                        <script>
                            function check_update_email_exist2(user_email,user_id)
                            {
                                $.ajax({
                                   url:'check_user_update_email_exist.php',
                                   method:'POST',
                                    data:{user_email:user_email,user_id:user_id},
                                   success:function(response){
                                       console.log(response);
                                 
                                      if(response==1)
                                      {
                                          $('#user_email2').val("");
                                          $('#div_id_message_update_email').html('Email Already Exist.');
                                      }
                                      
                                      if(response==2)
                                      {
                                          
                                         
                                          $('#div_id_message_update_email').html('');
                                      }
                                   }
                                   
                               });
                            }
                        </script>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Password (Example: PDabcd )</label>
                    <input type="password" class="form-control" id="user_password2" placeholder="User Password" name="user_password2" maxlength="6" value="<?php echo $row_user_by_id[0]['user_password'];?>" pattern="PD[a-z]{4}" onblur="check_password_pattern2(this.value)">
                  </div>
        <span id="div_id_message_password2" style="color:red;"></span>
        <script>
            function check_password_pattern2(str)
            {
                var re = /^PD[a-z]{4}$/;
                var response=re.test(str);
                //alert(response);
                      if(response)
                      {
                          $('#div_id_message_password2').html('');
                      }
                      else
                      {
                          $('#user_password2').val("");
                          $('#div_id_message_password2').html("Please use a 6 letter password starting with 'PD' Example: PDabcd");
                      }
            }
        </script>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Phone No.</label>
                    <input type="text" class="form-control" id="user_phone_no2" placeholder="User Phone No." name="user_phone_no2" maxlength="10" value="<?php echo $row_user_by_id[0]['user_phone_no'];?>" onblur="check_update_contact_exist(this.value,<?php echo $row_user_by_id[0]['user_id'];?>)">
                  </div>
        <span id="div_id_message_update_contact" style="color:red;"></span>
        <script>
            function check_update_contact_exist(user_phone_no,user_id)
            {
                $.ajax({
                   url:'check_user_update_contact_exist.php',
                   method:'POST',
                    data:{user_phone_no:user_phone_no,user_id:user_id},
                   success:function(response){
                       console.log(response);
                 
                      if(response==1)
                      {
                          $('#user_phone_no2').val("");
                          $('#div_id_message_update_contact').html('Contact No. Already Exist.');
                      }
                      
                      if(response==2)
                      {
                          $('#div_id_message_update_contact').html('');
                      }
                   }
                   
               });
            }
        </script>
                  <!--<div class="form-group">
                    <label for="exampleInputFile">Old Image</label>
                    <div class="input-group">
                        <img src="../user/user_profile_image/<?php //echo $row_user_by_id[0]['user_photo'];?>" style="height:200px;weight:200px;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">User Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="user_image2" name="user_image2" onchange="return checkImageDetails2(this)">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      
                      <div id="imagePreview2">
                        
                      </div>
                    </div>
                  </div>-->
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="user_status2" <?php if($row_user_by_id[0]['user_status']==1)echo "checked";?> value="1" id="add_user_active">
                      <label for="add_user_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="user_status2" value="2" id="add_user_inactive" <?php if($row_user_by_id[0]['user_status']==2)echo "checked";?>>
                      <label for="add_user_inactive" class="form-check-label">Inactive</label>
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