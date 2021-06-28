<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{	
	#Fetch Deleted Data
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_employees";
	$whereValue["id"] = $_REQUEST['did'];
	$fetchDeleteData = $eloquent->selectData($columnName, $tableName, $whereValue);
	
	#Deleted Data
	$tableName = $whereValue = null;
	$tableName = "ems_employees";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteEmployeeData = $eloquent->deleteData($tableName, $whereValue, $whereValue);
	
	if($deleteEmployeeData > 0)
	{
		#Remove The Previous Image from The Defined Directory
		unlink($GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $fetchDeleteData[0]['employee_image']);
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_employees";
$fetchEmployeesData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| EMPLOYEES CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">All <span style="font-weight: 300;"> Employees </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="#">Home</a></li>
						<li class="list-inline-item"><a href="#">Employees</a></li>
						<li class="list-inline-item"> All Employees</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-sm-9 col-12">
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text bg-dark text-white" id="basic-addon1">
									SEARCH HERE <i class="fab fa-searchengin fa-lg ml-3 text-warning"></i>
								</span>
							</div>
							<input class="form-control mr-sm-2" type="search" id="search" aria-describedby="basic-addon1" placeholder="Search here by Name or Designation or Department">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-12 text-right m-b-20">
				<a href="add-employee.php" class="btn btn-outline-dark btn-rounded float-right"><i class="fa fa-plus"></i> Add Employee</a>
				<div class="view-icons">
					<a href="employees-grid.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
					<a href="employees-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
				</div>
			</div>
		</div>
		
		<?php
		#Delete Confirmation Message
		if(isset($_REQUEST['did']))
		{
			if($deleteEmployeeData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Congratulation! A Employee Data is Deleted Successfully! </strong> 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}

		#Grid Data Content
		if(!empty($fetchEmployeesData))
		{				
			foreach($fetchEmployeesData AS $eachRow)
			{
		?>
			
		<div class="card-box mb-3">
			<div class="row">
				<div class="col-md-12">
					<div class="profile-view">
						<div class="profile-img-wrap">
							<div class="profile-img">
								<a href="<?php echo $GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $eachRow['employee_image']?>" target="_blank">
									<img class="avatar" src="<?php echo $GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $eachRow['employee_image']?>" alt="" style="border: 2px outset green;">
								</a>
							</div>
						</div>
						<div class="profile-basic">
							<div class="row">
								<div class="col-md-5">
									<div class="profile-info-left">
										<h3 class="user-name m-t-0"> 
											<?php echo $eachRow['employee_first_name'] .' '. $eachRow['employee_last_name']?>
										</h3>
										<h4 class="text-info"> 
											
											<?php
												$columnName = $tableName = $whereValue = null;
												$columnName = "*";
												$tableName = "ems_designations";
												$whereValue["id"] = $eachRow['employee_desg_id'];
												$fetchDesignationData = $eloquent->selectData($columnName, $tableName, @$whereValue);
												
												echo $fetchDesignationData[0]['designation_name'];
											?> 
											
										</h4>
										<ul class="personal-info mt-3">
											<li class="mb-1">
												<span class="title"> Employee ID: </span>
												<span class="text"> <?php echo $eachRow['employee_id']?> </span>
											</li>
											<li class="mb-1">
												<span class="title">Join Date:</span>
												<span class="text"> <?php echo $ajaxcontrol->dateOnly($eachRow['employee_join_date'])?> </span>
											</li>												
											<li class="mb-1">
												<span class="title">Certification:</span>
												<span class="text"> <?php echo $eachRow['academic_certification']?> </span>
											</li>											
											<li class="mb-1">
												<span class="title">NID:</span>
												<span class="text"> <?php echo $eachRow['employee_nid']?> </span>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<ul class="personal-info">
										<li>
											<span class="title">Phone:</span>
											<span class="text">
												<a href="tel: <?php echo $eachRow['employee_phone_no']?>">
													<?php echo $eachRow['employee_phone_no']?> 
												</a>
											</span>
										</li>
										<li>
											<span class="title">Email:</span>
											<span class="text">
												<a href="mailto: <?php echo $eachRow['employee_email']?>">
													<?php echo $eachRow['employee_email']?> 
												</a>
											</span>
										</li>
										<li>
											<span class="title"> Birthday: </span>
											<span class="text"> <?php echo $ajaxcontrol->dateOnly($eachRow['employee_birth_date']) ?> </span>
										</li>
										<li>
											<span class="title"> Address: </span>
											<span class="text"> <?php echo $eachRow['employee_address']?> </span>
										</li>
										<li>
											<span class="title"> Gender: </span>
											<span class="text"> <?php echo $eachRow['employee_gender']?> </span>
										</li>										
										<li>
											<span class="title"> Emergency Contact: </span>
											<span class="text"> <?php echo $eachRow['employee_emg_contact']?> </span>
										</li>
									</ul>
								</div>
								<div class="col-md-1">
									<a href="<?php echo 'edit-employee.php?id='. $eachRow['id']?>" data-id="<?php echo $eachRow['id']?>" class="btn btn-outline-secondary btn-sm  mb-2">
										<i class="fas fa-user-edit"></i>
									</a>									
									<button type="submit" data-toggle="modal" data-id="<?php echo $eachRow['id']?>" data-target="#delete_employee" class="btn btn-outline-danger btn-sm deleteButton">
										<i class="fas fa-user-times"></i>
									</button>
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
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong> Oops! </strong> no data is available at this momment, please add employee..
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>';
		}
		?>
		
	</div>
</div>
<!--=*= |#| EMPLOYEES CONTENT |#| =*=-->

<!--=*= Delete Employee Confirmation =*=-->
<div id="delete_employee" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Employee info? </h4>
			</div>
			<div class="modal-body m-b-10">
				<div class="m-t-10">
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal">Close</a>
					<a href="#" class="btn btn-warning btn-sm" id="delete_modal">Delete</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Employee Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		$('#delete_modal').attr('href','employees-grid.php?did='+id);
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->