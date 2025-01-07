<?php
session_start();
    require_once('../conn.php');
    require_once('check_login.php');
    // Prepare a select statement
    $stmt_district_by_id = $conn->prepare("SELECT * FROM district WHERE district_id=".$_POST['district_id']);
	$stmt_district_by_id->execute();
	$row_district_by_id = $stmt_district_by_id->fetchAll(PDO::FETCH_ASSOC);
	  
?>
       <div class="modal-header">
              <h4 class="modal-title">Update district</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_update_district(this)">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">District Name</label>
                    <input type="hidden" name="district_id" value="<?php echo $row_district_by_id[0]['district_id'];?>">
                    <input type="text" class="form-control" placeholder="district Name" name="district_name" value="<?php echo $row_district_by_id[0]['district_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">District Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="district_status2" value="1" id="update_district_active" <?php echo $row_district_by_id[0]['district_status']==1?'checked':'';?>>
                      <label for="update_district_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="district_status2" value="2" id="update_district_inactive" <?php echo $row_district_by_id[0]['district_status']==2?'checked':'';?>>
                      <label for="update_district_inactive" class="form-check-label">Inactive</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_update">Submit</button>
                </div>
              </form>
            </div>