<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	#Fetch Delete Data
	$columnName = $tableName = null;
	$columnName = "*";
	$tableName = "ems_admins";
	$whereValue["id"] = $_REQUEST['did'];
	$fetchDeleteData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#Delete Data
	$tableName = $whereValue = null;
	$tableName = "ems_admins";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteAdminData = $eloquent->deleteData($tableName, @$whereValue);
	
	if($deleteAdminData > 0)
	{
		#Remove The Previous Image from The Defined Directory
		unlink($GLOBALS['ADMIN_IMAGE_DIRECTORY'].$fetchDeleteData[0]['admin_image']);
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [U]PDATE DATA ===*=== ##
if(isset($_POST['updateData']))
{
	if(empty($_FILES['edit-adminImage']['name']))
	{
		#Update Data Excluding Image
		$tableName = $columnValue = $whereValue = null;
		$tableName = "ems_admins";
		$columnValue["admin_name"] = $_POST['edit-adminName'];
		$columnValue["admin_email"] = $_POST['edit-adminEmail'];
		$columnValue["admin_phone_no"] = $_POST['edit-adminPhone'];
		$columnValue["admin_type"] = $_POST['edit-adminType'];
		$columnValue["admin_status"] = $_POST['edit-adminStatus'];
		$columnValue["updated_at"] = date('Y-m-d H:i:s');
		$whereValue["id"] = $_SESSION['EMS_ADMIN_ID'];
		$updateAdminData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	else
	{
		#Update Data Including Image
		
		#Upload Image File Name Generate
		$adminImage = 'ADMIN' . date('YMD') . 'IMAGE' . rand(100, 999) . @$_FILES['edit-adminImage']['name'];
		
		#Upload Image File Validation
		$errorCheck = $control->checkImage(@$_FILES['edit-adminImage']['type'], @$_FILES['edit-adminImage']['size'], @$_FILES['edit-adminImage']['error']);
		
		if($errorCheck == 1)
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_admins";
			$columnValue["admin_name"] = $_POST['edit-adminName'];
			$columnValue["admin_email"] = $_POST['edit-adminEmail'];
			$columnValue["admin_phone_no"] = $_POST['edit-adminPhone'];
			$columnValue["admin_type"] = $_POST['edit-adminType'];
			$columnValue["admin_status"] = $_POST['edit-adminStatus'];
			$columnValue["admin_image"] = $adminImage;
			$columnValue["updated_at"] = date('Y-m-d H:i:s');
			$whereValue["id"] = $_SESSION['EMS_ADMIN_ID'];
			$updateAdminData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if($updateAdminData > 0)
			{
				#Store The Uploaded Files Into The Defined Directory
				move_uploaded_file($_FILES['edit-adminImage']['tmp_name'], $GLOBALS['ADMIN_IMAGE_DIRECTORY'].$adminImage);

				#Remove The Previous Image from The Defined Directory
				unlink($_SESSION['EMS_ADMIN_IMAGE_OLD']);
			}
		}
	}
}
## ===*=== [U]PDATE DATA ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addAdmin']))
{
	#Admin ID Generate
	$adminID = 'EMS#' . rand(100, 999) . '-AD';
	
	#Upload Image File Name Generate
	$adminImage = 'ADMIN' . date('YMD') . 'IMAGE' . rand(100, 999) . @$_FILES['adminImage']['name'];
	
	#Upload Image File Validation
	$errorCheck = $control->checkImage(@$_FILES['adminImage']['type'], @$_FILES['adminImage']['size'], @$_FILES['adminImage']['error']);
	
	if($errorCheck == 1)
	{
		$tableName = $columnValue = null;
		$tableName = "ems_admins";
		$columnValue["admin_id"] = $adminID;
		$columnValue["admin_name"] = $_POST['adminName'];
		$columnValue["admin_email"] = $_POST['adminEmail'];
		$columnValue["admin_password"] = sha1($_POST['adminPass'] . $GLOBALS['CYPHER_KEY']);
		$columnValue["admin_phone_no"] = $_POST['adminPhone'];
		$columnValue["admin_type"] = $_POST['adminType'];
		$columnValue["admin_status"] = $_POST['adminStatus'];
		$columnValue["admin_image"] = $adminImage;
		$columnValue["created_at"] = date('Y-m-d H:i:s');
		$insertAdminData = $eloquent->insertData($tableName, $columnValue);
		
		if($insertAdminData['LAST_INSERT_ID'] > 0)
		{
			#Store The Uploaded Files Into The Defined Directory
			move_uploaded_file($_FILES['adminImage']['tmp_name'], $GLOBALS['ADMIN_IMAGE_DIRECTORY'].$adminImage);
		}
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Admin Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_admins";
$fetchAdminData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| ADMIN CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<button class="btn btn-outline-dark btn-rounded" data-toggle="modal" data-target="#create_admin">
						<i class="fa fa-plus"></i> Create Admin 
					</button>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Management </a> </li>
						<li class="list-inline-item"> Admins </li>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
		#Insert Confirmation Message
		if(isset($_POST['addAdmin']))
		{
			if(@$insertAdminData['LAST_INSERT_ID'] > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Congratulation! A New Admin Data is Added Successfully... </strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}	
		
		#Delete Confirmation Message
		if(isset($_REQUEST['did']))
		{
			if(@$deleteAdminData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Congratulation! A Admin Data is Deleted Successfully... </strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}
		
		#Update Confirmation Message
		if(isset($_POST['updateData']))
		{
			if($updateAdminData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Congratulation! A Admin Data is Updated Successfully... </strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}
		?>
		
		<div class="row">
			
		<?php
		#Grid Data Content
		if(!empty($fetchAdminData))
		{
			foreach($fetchAdminData AS $eachRow)
			{
				$fetchDate = $eachRow['created_at']; 
				$time = strtotime($fetchDate); 
				$getDate = getDate($time);
				$date = $getDate['month'].' '.$getDate['mon'].', '.$getDate['year'];
		?>	
					
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
				<div class="profile-widget3">
					<div class="profile-bg" style="background: #fc6060c2;">
						<div class="text-left">
							<button data-target="#edit_admin" data-id="<?php echo $eachRow['id'] ?>" class="btn btn-outline-light btn-sm editButton" data-toggle="modal">
								<i class="fas fa-edit"></i>
								<input type="hidden" name="getData">
							</button>
							<button data-target="#delete_admin" data-id="<?php echo $eachRow['id'] ?>" class="btn btn-outline-light btn-sm deleteButton" data-toggle="modal">
								<i class="fas fa-user-times"></i>
							</button>
						</div>
						<div class="text-right mt-4">
							<h3 class="user-name text-ellipsis text-white text-uppercase"> <?php echo  $eachRow['admin_name'] ?> </h3>
							<h4 class="text-white text-lowercase"> <?php echo $eachRow['admin_email'] ?> </h4>
						</div>
					</div>
					<div>
						<a href="#" class="avatar-link">
							<img alt="" src="<?php echo $GLOBALS['ADMIN_IMAGE_DIRECTORY'] . $eachRow['admin_image'] ?>">
						</a>
						<div class="user-info">
							<div class="username"> <?php echo $eachRow['admin_type'] ?> </div>
							<span>
								<a href="#">+88 <?php echo $eachRow['admin_phone_no'] ?> </a>
							</span>
						</div>
						<div class="user-analytics">
							<div class="row">
								<div class="col-sm-4 col-4 border-right">
									<div class="analytics-desc">
										<h5 class="analytics-count"> Admin ID </h5>
										<span class="analytics-title"> <?php echo $eachRow['admin_id'] ?> </span>
									</div>
								</div>
								<div class="col-sm-4 col-4 border-right">
									<div class="analytics-desc">
										<h5 class="analytics-count"> Assigned Date </h5>
										<span class="analytics-title"> <?php echo $date ?> </span>
									</div>
								</div>
								<div class="col-sm-4 col-4">
									<div class="analytics-desc">
										<h5 class="analytics-count"> Status </h5>
										<span class="analytics-title"> <?php echo $eachRow['admin_status'] ?> </span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
					
				
		<?php
			}
		}
		else
		{
			echo '
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong> Oops! </strong> no data is available at this momment, please add a new admin ...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			';
		}
		?>	
			
		</div>
	</div>
</div>
<!--=*= |#| ADMIN CONTENT |#| =*=-->


<!--=*= Create Admin Data =*=-->
<div id="create_admin" class="modal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Create Admin </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
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
								<input type="text" class="form-control" name="adminName">
							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text pr-4">
										<i class="fas fa-envelope mr-1 text-danger"></i> Email ID
									</label>
								</div>
								<input type="email" class="form-control" name="adminEmail">
							</div>
						</div>						
						<div class="col-md-12">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text pr-3">
										<i class="fas fa-key mr-1 text-danger"></i>Password
									</label>
								</div>
								<input type="password" class="form-control" name="adminPass">
							</div>
						</div>
						<div class="col-md-12">
							<div class="profile-img-wrap mt-3">
								<img class="inline-block" src="public/assets/img/user.jpg" alt="user" id="div1">
								<div class="fileupload btn">
									<span class="btn-text">add</span>
									<input class="upload" type="file" name="adminImage" onchange="readURL(this);" set-to="div1">
								</div>
							</div>
							<div class="profile-basic">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-mobile mr-1 text-danger"></i> Phone
										</label>
									</div>
									<input type="tel" class="form-control" name="adminPhone" pattern="[0-9]{5}[0-9]{6}">
								</div>								
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-bars mr-1 text-danger"></i> Type
										</label>
									</div>
									<select class="custom-select" name="adminType" id="adminType">
										<option value= ''>Select Admin Type</option>
										<option value="Root Administrator"> Root Administrator </option>
										<option value="Academic Administrator"> Academic Administrator </option>
										<option value="Accounts Administrator"> Accounts Administrator </option>
										<option value="Users & System Administrator"> Users & System Administrator</option>
										<option value="Sales & Marketing Administrator"> Sales & Marketing Administrator </option>
									</select>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-info-circle mr-1 text-danger"></i> Status
										</label>
									</div>
									<select class="custom-select" name="adminStatus" id="adminStatus">
										<option value= ''>Select Admin Status</option>
										<option value="Active"> Active </option>
										<option value="Inactive"> Inactive </option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div id="errorMessage"></div>
					<div class="col-sm-12 text-center mt-4">
						<button type="submit" class="btn btn-outline-success btn-sm mb-3" id="saveAdmin" name="addAdmin">
							<i class="fa fa-plus-circle"></i> Save Admin
						</button>						
						<button type="reset" class="btn btn-outline-dark btn-sm mb-3">
							<i class="fa fa-power-off"></i> Reset Data
						</button>						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--=*= Create Admin Data =*=-->

<!--=*= Edit Admin Data =*=-->
<div id="edit_admin" class="modal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Edit Admin </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div id="update"></div>
		</div>
	</div>
</div>
<!--=*= Edit Admin Data =*=-->

<!--=*= Delete Admin Confirmation =*=-->
<div id="delete_admin" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Admin info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> 
						<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal"> Delete </a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Admin Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	$(document).ready(function(){
		
		//Prevent Submission If Data is Empty
		$('#saveAdmin').click(function(e) {
			var type = $('#adminType').val();
			var status = $('#adminStatus').val();
			
			if(type == '' || status == '') {
				e.preventDefault();
				$("#errorMessage").html('<div class="alert alert-warning alert-dismissible fade show" role="alert">All fields <b>*</b> are required!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
			} else {
				return true;
			}
		});
		
		
		//Get The Requested Delete Admin ID
		$('.deleteButton').click(function() {
			var id = $(this).data('id');
			
			$('#delete_modal').attr('href','admins.php?did='+id);
		});		
		
		
		//Fetch Admin Data Into The Edit Modal
		$(document).on("click",".editButton", function() {
			var eid = $(this).data('id');
			var action = 'data';
			
			$.ajax({
				url: 'ajax/editAdmin.php',
				type: 'POST',
				data: {action:action, id:eid},
				success: function(data) {
					$("#update").html(data);
				}				
			});
		});

	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->						