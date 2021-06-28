<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [U]PDATE DATA ===*=== ##
if(isset($_POST['updateEmployee']))
{
	#Modify Date as SQL Syntax
	$joinDate = date('Y-m-d', strtotime($_POST['joinDate']));
	$birthDate = date('Y-m-d', strtotime($_POST['birthDate']));
	
	if(empty($_FILES['employeeImage']['name']))
	{
		$tableName = $columnValue = $whereValue = null;
		$tableName = "ems_employees";
		$columnValue["employee_first_name"] = $_POST['firstName'];
		$columnValue["employee_last_name"] = $_POST['lastName'];
		$columnValue["employee_email"] = $_POST['emailAdd'];
		$columnValue["employee_phone_no"] = $_POST['phoneNo'];
		$columnValue["employee_dept_id"] = $_POST['department'];
		$columnValue["employee_desg_id"] = @$_POST['designation'];
		$columnValue["employee_join_date"] = $joinDate;
		$columnValue["employee_religion"] = $_POST['religion'];
		$columnValue["academic_institute"] = $_POST['institution'];
		$columnValue["academic_subject_in"] = $_POST['subject'];
		$columnValue["academic_certification"] = $_POST['certification'];
		$columnValue["academic_pass_year"] = $_POST['year'];
		$columnValue["academic_result"] = $_POST['cgpa'];
		$columnValue["employee_address"] = $_POST['address'];
		$columnValue["employee_birth_date"] = $birthDate;
		$columnValue["employee_gender"] = $_POST['gender'];
		$columnValue["employee_nid"] = $_POST['nid'];
		$columnValue["employee_emg_contact"] = $_POST['emgContact'];
		$columnValue["updated_at"] = date('Y-m-d H:i:s');
		$whereValue["id"] = $_SESSION['EDIT_EMPLOYEE_ID'];
		$updateEmployeeData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	else
	{		
		#Upload Image File Name Generate	
		$fileName = 'EMPLOYEE' . date('Ymd') . '_IMAGE_' . rand(100, 999) . $_FILES['employeeImage']['name'];

		#Upload Image File Validation
		$imageValid = $control->checkImage(@$_FILES['employeeImage']['type'], @$_FILES['employeeImage']['size'], @$_FILES['employeeImage']['error']);
		
		if($imageValid == 1)
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_employees";
			$columnValue["employee_image"] = $fileName;
			$columnValue["employee_first_name"] = $_POST['firstName'];
			$columnValue["employee_last_name"] = $_POST['lastName'];
			$columnValue["employee_email"] = $_POST['emailAdd'];
			$columnValue["employee_phone_no"] = $_POST['phoneNo'];
			$columnValue["employee_dept_id"] = $_POST['department'];
			$columnValue["employee_desg_id"] = @$_POST['designation'];
			$columnValue["employee_join_date"] = $joinDate;
			$columnValue["employee_religion"] = $_POST['religion'];
			$columnValue["academic_institute"] = $_POST['institution'];
			$columnValue["academic_subject_in"] = $_POST['subject'];
			$columnValue["academic_certification"] = $_POST['certification'];
			$columnValue["academic_pass_year"] = $_POST['year'];
			$columnValue["academic_result"] = $_POST['cgpa'];
			$columnValue["employee_address"] = $_POST['address'];
			$columnValue["employee_birth_date"] = $birthDate;
			$columnValue["employee_gender"] = $_POST['gender'];
			$columnValue["employee_nid"] = $_POST['nid'];
			$columnValue["employee_emg_contact"] = $_POST['emgContact'];
			$columnValue["updated_at"] = date('Y-m-d H:i:s');
			$whereValue["id"] = $_SESSION['EDIT_EMPLOYEE_ID'];
			$updateEmployeeData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if(@$updateEmployeeData > 0)
			{
				#Store The Uploaded Files Into The Defined Directory
				move_uploaded_file($_FILES['employeeImage']['tmp_name'], $GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $fileName);

				#Remove The Previous Image from The Defined Directory
				unlink($_SESSION['EDIT_EMPLOYEE_IMAGE']);
			}
		}
	}
}
## ===*=== [U]PDATE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
if(isset($_REQUEST['id']))
{
	$_SESSION['EDIT_EMPLOYEE_ID'] = $_REQUEST['id'];
}

#Fetch Employee Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_employees";
$whereValue["id"] = $_SESSION['EDIT_EMPLOYEE_ID'];
$fetchEmployeeData = $eloquent->selectData($columnName, $tableName, @$whereValue);

#Create a SESSION for Image (if user willing to change)
$_SESSION['EDIT_EMPLOYEE_IMAGE'] = $GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $fetchEmployeeData[0]['employee_image'];

#Fetch Department Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_departments";
$fetchDepartmentData = $eloquent->selectData($columnName, $tableName);	
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= ADD EMPLOYEE CONTENT START =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> Edit <span style="font-weight: 300;"> New Employee </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php"> Home </a></li>
						<li class="list-inline-item"><a href="#"> Management </a></li>
						<li class="list-inline-item"><a href="#"> Employees </a></li>
						<li class="list-inline-item"> Edit Employee </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					
					<?php
					#Update Confirmation Message
					if(isset($_POST['updateEmployee']))
					{
						if($updateEmployeeData > 0)
						{
							echo '
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong> Congratulation! The Employee Data is Updated Successfully! </strong> 
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							';
						}
					}
					?>
					
					<div class="card-box">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="row mt-4">
								<div class="col-md-10 offset-md-1">
									<div class="profile-img-wrap">
										<img class="inline-block" src="<?php echo $GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $fetchEmployeeData[0]['employee_image'] ?>" alt="user" id="div1">
										<div class="fileupload btn">
											<span class="btn-text"> update </span>
											<input class="upload" type="file" name="employeeImage" onchange="readURL(this);" set-to="div1">
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> First Name </label>
													<input type="text" name="firstName" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['employee_first_name'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Last Name </label>
													<input type="text" name="lastName" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['employee_last_name'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Email </label>
													<input type="email" name="emailAdd" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['employee_email'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Phone Number </label>
													<input type="tel" name="phoneNo" class="form-control floating" value="01316770422" pattern="[0-9]{5}[0-9]{6}" value="<?php echo $fetchEmployeeData[0]['employee_phone_no'] ?>">
												</div>
											</div>	
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Department </label>
													<select class="select form-control floating" name="department" id="department">
														<option> Choose... </option>
														
														<?php
														foreach($fetchDepartmentData AS $eachDept)
														{
															echo '<option value="'.$eachDept['id'].'" ';
															
															if($eachDept['id'] == $fetchEmployeeData[0]['employee_dept_id'])
															echo 'selected';
															
															echo ' >'.$eachDept['department_name'].'</option>';
														}
														?>
														
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Designation </label>
													<select class="select form-control floating" name="designation" id="designation">
														<option> Choose... </option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Join Date </label>
													<div class="cal-icon">
														<input class="form-control floating datepicker-here" type="text" name="joinDate" data-language='en' placeholder="<?php echo date('m/d/Y', strtotime($fetchEmployeeData[0]['employee_join_date'])) ?>">
													</div>
												</div>
											</div>									
											<div class="col-md-6">
												<div class="form-group form-focus select-focus cstm-height">
													<label class="focus-label"> Religion </label>
													<select class="select form-control floating" name="religion">
														<option value="<?php echo $fetchEmployeeData[0]['employee_religion'] ?>"> 
															<?php echo $fetchEmployeeData[0]['employee_religion'] ?> 
														</option>
														
														<?php
														$selectedReligion = $fetchEmployeeData[0]['employee_religion'];
														$religion = ['Islam', 'Hindu', 'Christian', 'Others'];
														foreach($religion AS $eachOption)
														{
															if($eachOption != $selectedReligion)
															{
																echo '<option value="'. $eachOption .'">'. $eachOption .'</option>';
																continue;
															}
														}
														?>
														
													</select>
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Institution </label>
													<input type="text" name="institution" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['academic_institute'] ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Subject or Major in </label>
													<input type="text" name="subject" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['academic_subject_in'] ?>">
												</div>
											</div>																			
											<div class="col-md-8">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Certification </label>
													<input type="text" name="certification" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['academic_certification'] ?>">
												</div>
											</div>	
											<div class="col-md-2">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label">Year</label>
													<select class="select form-control floating" name="year">
														<option value="<?php echo $fetchEmployeeData[0]['academic_pass_year'] ?>"> 
															<?php echo $fetchEmployeeData[0]['academic_pass_year'] ?>
														</option>
														
														<?php
														for($i = 1998; $i <= date('Y'); $i++)
														{
															echo '<option value="'. $i .'">'. $i .'</option>';
														}
														?>
														
													</select>
												</div>
											</div>	
											<div class="col-md-2">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> CGPA </label>
													<input type="text" name="cgpa" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['academic_result'] ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Address </label>
													<input type="text" name="address" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['employee_address'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Birth Date </label>
													<div class="cal-icon">
														<input class="form-control floating datepicker-here" type="text" name="birthDate" data-language='en' data-position='top left' placeholder="<?php echo date('m/d/Y', strtotime($fetchEmployeeData[0]['employee_birth_date'])) ?>">
													</div>
												</div>
											</div>									
											<div class="col-md-6">
												<div class="form-group form-focus select-focus cstm-height">
													<label class="focus-label"> Gender </label>
													<select class="select form-control floating" name="gender">
														<option value="<?php echo $fetchEmployeeData[0]['employee_gender'] ?>">
															<?php echo $fetchEmployeeData[0]['employee_gender'] ?>
														</option>
														
														<?php
														$selectedGenger = $fetchEmployeeData[0]['employee_gender'];
														$gender = ['Male', 'Female', 'Others'];
														
														foreach($gender AS $eachOption)
														{
															if($eachOption != $selectedGenger)
															echo '<option value="'. $eachOption .'">'. $eachOption .'</option>';
															continue;
														}
														?>
														
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> NID </label>
													<input type="text" name="nid" class="form-control floating" value="<?php echo $fetchEmployeeData[0]['employee_nid']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Emergency Contact </label>
													<input type="tel" name="emgContact" class="form-control floating" pattern="[0-9]{5}[0-9]{6}" value="<?php echo $fetchEmployeeData[0]['employee_emg_contact']?>">
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 text-center mt-3">
								<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="updateEmployee"> 
									<i class="fa fa-plus-circle"></i> Updated Employee
								</button>						
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| EDIT EMPLOYEE CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	$(document).ready(function() {
		
		//For Edit Data
		var dept = <?php echo $fetchEmployeeData[0]['employee_dept_id']; ?>;
		
		if (dept != "") 
		{
			$.ajax({
				url: "ajax/DropDown.php",
				type: 'POST',
				data: {
					editDesignation: "YES",
					dept_id: dept,
					desg_id: <?php echo $fetchEmployeeData[0]['employee_desg_id']; ?>
				},
				success: function(data) {
					var response = $.trim(data);
					$("#designation").html(response);
					
					if (response == "")
					$("#designation").html("<option value=''> No Designation Found </option>");
				}
			});
		} 
		else 
		{
			$("#designation").html("<option value=''> Choose... </option>");
		}

		
		//For Update or Insert Data
		$("#department").change(function() {
			var dept = $(this).val();
			
			if(dept != "")
			{
				$.ajax({
					url:"ajax/DropDown.php",
					type:'POST',
					data:{
						insertDesignation: "YES",
						dept_id: dept
					},
					success:function(data) 
					{
						var response = $.trim(data);
						$("#designation").html(response);
						
						if(response == "")
						$("#designation").html("<option value=''> Choose... </option>");
					}
				});
			}
			else
			{
				$("#designation").html("<option value=''> Choose... </option>");
			}
		});
		
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->