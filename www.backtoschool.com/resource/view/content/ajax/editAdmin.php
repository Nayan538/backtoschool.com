<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Http/Controllers/AjaxController.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [E]DIT DATA START ===*=== ##
if(isset($_POST['action']))
{
	$edit_id = $_REQUEST['id'];
	
	#Fetch Data Query
	$editData = $ajaxcontrol->getData('ems_admins', $edit_id);
	
	if($editData > 0)
	{
		#Hold The Requested ID and Image within a SESSION
		$_SESSION['EMS_ADMIN_ID'] = $_REQUEST['id'];
		$_SESSION['EMS_ADMIN_IMAGE_OLD'] = $GLOBALS['ADMIN_IMAGE_DIRECTORY'] . $editData[0]['admin_image'];
?>
	
<div class="modal-body">
	<form action="" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text">
							<i class="fas fa-user-secret mr-1 text-danger"></i> Full Name
						</label>
					</div>
					<input type="hidden" id="edit_id" value="<?php echo  $editData[0]['id'] ;?>">
					<input type="text" class="form-control" name="edit-adminName" id="edit-adminName" value="<?php echo $editData[0]['admin_name'] ?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text pr-4">
							<i class="fas fa-envelope mr-1 text-danger"></i> Email ID
						</label>
					</div>
					<input type="email" class="form-control" name="edit-adminEmail" id="edit-adminEmail" value="<?php echo $editData[0]['admin_email'] ?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="profile-img-wrap mt-3">
					<img class="inline-block" src="<?php echo  $GLOBALS['ADMIN_IMAGE_DIRECTORY'] . $editData[0]['admin_image'] ?>" alt="user" id="div2">
					<div class="fileupload btn">
						<span class="btn-text">admin's image</span>
						<input class="upload" type="file" name="edit-adminImage" id="edit-adminImage" onchange="readURL(this);" set-to="div2">
					</div>
				</div>
				<div class="profile-basic">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text">
								<i class="fas fa-mobile mr-1 text-danger"></i> Phone
							</label>
						</div>
						<input type="tel" class="form-control" name="edit-adminPhone" id="edit-adminPhone" value="<?php echo $editData[0]['admin_phone_no'] ?>" pattern="[0-9]{5}[0-9]{6}">
					</div>								
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text">
								<i class="fas fa-bars mr-1 text-danger"></i> Type
							</label>
						</div>
						<select class="custom-select" name="edit-adminType"  id="edit-adminType" required>
							<option>Choose..</option>
							<option <?php if($editData[0]['admin_type'] == 'Root Administrator') echo 'selected';?>> Root Administrator </option>
							<option <?php if($editData[0]['admin_type'] == 'Academic Administrator') echo 'selected';?>> Academic Administrator </option>
							<option <?php if($editData[0]['admin_type'] == 'Accounts Administrator') echo 'selected'; ?>> Accounts Administrator </option>
							<option <?php if($editData[0]['admin_type'] == 'Users & System Administrator') echo 'selected';?>> Users & System Administrator </option>
							<option <?php if($editData[0]['admin_type'] == 'Sales & Marketing Administrator') echo 'selected';?>> Sales & Marketing Administrator </option>
						</select>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text">
								<i class="fas fa-info-circle mr-1 text-danger"></i> Status
							</label>
						</div>
						<select class="custom-select" name="edit-adminStatus" id="edit-adminStatus" required>
							<option>Choose..</option>
							<option <?php if($editData[0]['admin_status'] == 'Active') echo 'selected';?>> Active </option>
							<option <?php if($editData[0]['admin_status'] == 'Inactive') echo 'selected';?>> Inactive </option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div id="error-message"></div>
		<div class="col-sm-12 text-center mt-4">
			<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="updateData" id="updateData">
				<i class="fa fa-plus-circle"></i> Update Admin
			</button>					
		</div>
	</form>
</div>
	
<?php
	}
}
## ===*=== [E]DIT DATA END ===*=== ##
?>																		