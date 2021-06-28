<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addEmployee']))
{
	#Upload Image File Name Generate
	$fileName = 'EMPLOYEE' . date('Ymd') . '_IMAGE_' . rand(100, 999) . $_FILES['employeeImage']['name'];

	#Upload Image File Validation
	$imageValid = $control->checkImage(@$_FILES['employeeImage']['type'], @$_FILES['employeeImage']['size'], @$_FILES['employeeImage']['error']);
	
	if($imageValid == 1)
	{
		#Modify Date as SQL Syntax
		$employeeID = 'EM-#' . rand(10, 99) . @$_POST['department'] . @$_POST['designation'];
		$joinDate = date('Y-m-d', strtotime($_POST['joinDate']));
		$birthDate = date('Y-m-d', strtotime($_POST['birthDate']));
		
		if($_POST['createPass'] === $_POST['confirmPass'])
		{
			$tableName = $columnValue = null;
			$tableName = "ems_employees";
			$columnValue["employee_id"] = $employeeID;
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
			$columnValue["employee_password"] = sha1($_POST['confirmPass']);
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$insertEmployeeData = $eloquent->insertData($tableName, $columnValue);
			
			if(@$insertEmployeeData['LAST_INSERT_ID'] > 0)
			{
				#Store The Uploaded Files Into The Defined Directory
				move_uploaded_file($_FILES['employeeImage']['tmp_name'], $GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $fileName);
			}
		}
	}
}
## ===*=== [I]NSERT DATA ===*=== ##	


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Department Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_departments";
$fetchDepartmentData = $eloquent->selectData($columnName, $tableName);	
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| ADD EMPLOYEE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">Add <span style="font-weight: 300;"> New Employee </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php"> Home </a></li>
						<li class="list-inline-item"><a href="#"> Management </a></li>
						<li class="list-inline-item"><a href="#"> Employees </a></li>
						<li class="list-inline-item"><a href="#"> All Employees </a></li>
						<li class="list-inline-item"> Add Employee </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					
					<?php
					#Insert Confirmation Message
					if(isset($_POST['addEmployee']))
					{
						if(@$insertEmployeeData > 0)
						{
							echo '
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong> Congratulation! A New Employee Data is Added Successfully! </strong> 
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
										<img class="inline-block" src="public/assets/img/user.jpg" alt="user" id="div1">
										<div class="fileupload btn">
											<span class="btn-text">add</span>
											<input class="upload" type="file" name="employeeImage" onchange="readURL(this);" set-to="div1" required>
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> First Name </label>
													<input type="text" name="firstName" class="form-control floating">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Last Name </label>
													<input type="text" name="lastName" class="form-control floating">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Email </label>
													<input type="email" name="emailAdd" class="form-control floating">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Phone Number </label>
													<input type="tel" name="phoneNo" class="form-control floating" pattern="[0-9]{5}[0-9]{6}">
												</div>
											</div>	
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Department </label>
													<select class="select form-control floating" name="department" id="department">
														<option> Choose... </option>
														
														<?php
														foreach($fetchDepartmentData AS $eachOption)
														{															
															echo '<option value="'. $eachOption['id'] .'">'. $eachOption['department_name'] .'</option>';
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
														<input class="form-control floating datepicker-here" type="text" name="joinDate" data-language='en' placeholder="<?php echo date('m/d/Y') ?>">
													</div>
												</div>
											</div>									
											<div class="col-md-6">
												<div class="form-group form-focus select-focus cstm-height">
													<label class="focus-label"> Religion </label>
													<select class="select form-control floating" name="religion">
														<option> Choose... </option>
														
														<?php
														$religion = ['Islam', 'Hindu', 'Christian', 'Others'];
														foreach($religion AS $eachOption)
														{
															echo '<option value="'. $eachOption .'">'. $eachOption .'</option>';
														}
														?>
														
													</select>
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Institution </label>
													<input type="text" name="institution" class="form-control floating">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Subject or Major in </label>
													<input type="text" name="subject" class="form-control floating">
												</div>
											</div>																			
											<div class="col-md-8">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Certification </label>
													<input type="text" name="certification" class="form-control floating">
												</div>
											</div>	
											<div class="col-md-2">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Year </label>
													<select class="select form-control floating" name="year">
														<option > Choose... </option>
														
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
													<input type="text" name="cgpa" class="form-control floating">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Address </label>
													<input type="text" name="address" class="form-control floating">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Birth Date </label>
													<div class="cal-icon">
														<input class="form-control floating datepicker-here" type="text" name="birthDate" data-language='en' data-position='top left' placeholder="<?php echo date('m/d/Y')?>">
													</div>
												</div>
											</div>									
											<div class="col-md-6">
												<div class="form-group form-focus select-focus cstm-height">
													<label class="focus-label"> Gender </label>
													<select class="select form-control floating" name="gender">
														<option> Choose... </option>
														
														<?php
														$gender = ['Male', 'Female', 'Others'];
														foreach($gender AS $eachOption)
														{
															echo '<option value="'. $eachOption .'">'. $eachOption .'</option>';
														}
														?>
														
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> NID </label>
													<input type="text" name="nid" class="form-control floating">
													</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Emergency Contact </label>
													<input type="tel" name="emgContact" class="form-control floating" pattern="[0-9]{5}[0-9]{6}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Create Password </label>
													<input type="password" name="createPass" class="form-control floating" placeholder="e.g. abc12#654@12">
												</div>
											</div>												
											<div class="col-md-6">
												<div class="form-group form-focus cstm-height">
													<label class="focus-label"> Confirm Password </label>
													<input type="password" name="confirmPass" class="form-control floating" placeholder="e.g. abc12#654@12">
													<span style="position: absolute; margin-top: -25px; right: 10px;" id="info"></span>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 text-center mt-3">
								<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="addEmployee"> 
									<i class="fa fa-plus-circle"></i> Add Employee
								</button>						
								<button type="reset" class="btn btn-outline-dark btn-sm mb-3">
									<i class="fa fa-plus-circle"></i> Reset Data
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| ADD EMPLOYEE CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	$(document).ready(function(){
		
		//Fetch Designation Based on Department
		$("#department").change(function() {
			var dept = $(this).val();
			
			if(dept != "") 
			{
				$.ajax({
					url:"ajax/DropDown.php",
					type:'POST',
					data:{insertDesignation: "YES", dept_id:dept},
					success:function(data) {
						var data = $.trim(data);
						$("#designation").html(data);
						
						if(data == "") {
							$("#designation").html("<option> No Designation Found </option>");
						}
					}
				});
			} 
			else 
			{
				$("#designation").html("<option> Choose... </option>");
			}
		});
		
		
		//Check Validation in Both Password
		$('input[name="confirmPass"]').on('change', function() {
			var createPass = $('input[name="createPass"]').val();
			var confirmPass = $(this).val();
			
			if(confirmPass == createPass) {
				$('#info').html('<i class="far fa-check-circle text-success fa-lg"></i>');
			} else {
				$('#info').html('<i class="far fa-times-circle text-danger fa-lg"></i>');
			}
		});
		
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->