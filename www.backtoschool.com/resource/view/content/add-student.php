<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addStudent']))
{		
	#Upload Image File Name Generate
	$studentFilename = 'IMAGE_' . date("YmdHis") . rand(1000, 9999) . $_FILES['studentImage']['name'];		
	$parentsFilename = 'IMAGE_' . date("YmdHis") . rand(1000, 9999) . $_FILES['parentsImage']['name'];
	
	#Upload Image File Validation
	$studentImageCheck = $control->checkImage(@$_FILES['studentImage']['type'], @$_FILES['studentImage']['size'], @$_FILES['studentImage']['error']);
	$parentImageCheck = $control->checkImage(@$_FILES['parentsImage']['type'], @$_FILES['parentsImage']['size'], @$_FILES['parentsImage']['error']);
	
	#Student ID Generate
	$studentID = 'ST-ID#' . rand(10000, 99999);		
	
	#Modify Date as SQL Syntax
	$dateOfBirth = date("Y-m-d", strtotime($_POST['birthDate']));
	$dateOfAdmission = date("Y-m-d", strtotime($_POST['admission']));
	
	if($studentImageCheck == 1)
	{
		$tableName = $columnValue = null;
		$tableName = "ems_students";
		$columnValue["student_id"] = $studentID;
		$columnValue["student_image"] = $studentFilename;
		$columnValue["first_name"] = $_POST['firstName'];
		$columnValue["last_name"] = $_POST['lastName'];
		$columnValue["birth_date"] = $dateOfBirth;
		$columnValue["gender"] = $_POST['gender'];
		$columnValue["class_id"] = $_POST['class'];
		$columnValue["shift_id"] = $_POST['shift']; 
		$columnValue["roll_number"] = $_POST['rollNo'];
		$columnValue["admission_date"] = $dateOfAdmission;
		$columnValue["birth_certificate_no"] = $_POST['birthCertificate'];
		$columnValue["blood_group"] = $_POST['bg'];
		$columnValue["phone_no"] = $_POST['phone'];
		$columnValue["religion"] = $_POST['religion'];
		$columnValue["address"] = $_POST['address'];
		$columnValue["student_password"] = sha1($_POST['confirmPass'] . $GLOBALS['CYPHER_KEY']);
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$insertStudentData = $eloquent->insertData($tableName, $columnValue);
		
		$_SESSION['LAST_INSERT_STUDENT_ID'] = @$insertStudentData['LAST_INSERT_ID'];
		
		if(@$insertStudentData['LAST_INSERT_ID'] > 0)
		{
			#Store The Uploaded Files Into The Defined Directory
			move_uploaded_file($_FILES['studentImage']['tmp_name'], $GLOBALS['STUDENT_IMAGE_DIRECTORY'] . $studentFilename);

			if($parentImageCheck == 1)
			{
				$tableName = $columnValue = null;
				$tableName = "ems_parents";
				$columnValue["student_id"] = $_SESSION['LAST_INSERT_STUDENT_ID'];
				$columnValue["parents_image"] = $parentsFilename;
				$columnValue["father_name"] = $_POST['fatherName'];
				$columnValue["father_nid_card_no"] = $_POST['father_nid'];
				$columnValue["father_phone_no"] = $_POST['father_phoneNo'];
				$columnValue["father_email"] = $_POST['father_email'];
				$columnValue["mother_name"] = $_POST['motherName'];
				$columnValue["mother_nid_card_no"] = $_POST['mother_nid'];
				$columnValue["mother_phone_no"] = $_POST['mother_phoneNo'];
				$columnValue["mother_occupation"] = $_POST['mother_occupation'];
				$columnValue["parents_occupation"] = $_POST['parentOccupation'];
				$columnValue["parents_org_name"] = $_POST['parentOrgname'];
				$columnValue["parents_org_address"] = $_POST['parentOrgAdd'];
				$columnValue["parents_org_contact_number"] = $_POST['parentOrgNumber'];
				$columnValue["permanent_address"] = $_POST['parmanentAddress'];
				$columnValue["permanent_post_office"] = $_POST['parmanentPO'];
				$columnValue["permanent_police_station"] = $_POST['parmanentPS'];
				$columnValue["permanent_district"] = $_POST['parmanentDist'];
				$columnValue["permanent_country"] = $_POST['parmanentCountry'];
				$columnValue["created_at"] = date("Y-m-d H:i:s");
				$insertParentsData = $eloquent->insertData($tableName, $columnValue);
				
				if($insertParentsData['LAST_INSERT_ID'] > 0)
				{
					#Store The Uploaded Files Into The Defined Directory
					move_uploaded_file($_FILES['parentsImage']['tmp_name'], $GLOBALS['PARENT_IMAGE_DIRECTORY'] . $parentsFilename);
				}
			}
			
			#Fetch The Last Inserted Data to Get Profile Link
			$tableName = $columnName = $whereValue = null;
			$columnName["1"] = "id";
			$columnName["2"] = "first_name";
			$columnName["3"] = "last_name";
			$tableName = "ems_students";
			$whereValue["id"] = $_SESSION['LAST_INSERT_STUDENT_ID'];
			$fetchLastInsertedData = $eloquent->selectData($columnName, $tableName, @$whereValue);
			
			$getFullName = @$fetchLastInsertedData[0]['first_name'] . ' ' . @$fetchLastInsertedData[0]['last_name'];
			$getID = @$fetchLastInsertedData[0]['id'];
		}
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Classes Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_classes";
$fetchClassData = $eloquent->selectData($columnName, $tableName);	

#Fetch Shift Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_shifts";
$fetchShiftData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| ADD STUDENT CONTENT |#| =*=-->	
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">Add <span style="font-weight: 300;"> New Student </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="students-infogrid.php"> Students </a> </li>
						<li class="list-inline-item"> Add Student </li>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
		#Insert Confirmation Message
		if(isset($_POST['addStudent']))
		{
			if(@$insertStudentData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					Congratulation! A New Student Data is Added Successfully. Checkout 
					<strong>
						'.$getFullName.'<a href="student-profile.php?id='.$getID.'"> Profile </a>
					</strong> 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}
		?>
		
		<form action="" method="post" enctype="multipart/form-data">
			<div class="card-box">
				<h3 class="card-title"> Student Informations </h3>
				<div class="row">
					<div class="col-md-12">
						<div class="profile-img-wrap">
							<img class="inline-block" src="public/assets/img/user.jpg" alt="user" id="div1">
							<div class="fileupload btn">
								<span class="btn-text"> add </span>
								<input class="upload" name="studentImage" type="file" onchange="readURL(this);" set-to="div1" required>
							</div>
						</div>
						<div class="profile-basic">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<input type="hidden" name="student">
										<label class="focus-label"> First Name </label>
										<input type="text" name="firstName" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Last Name </label>
										<input type="text" name="lastName" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Birth Date </label>
										<div class="cal-icon">
											<input class="form-control floating datepicker-here" name="birthDate" type="text" data-language='en'>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Gendar </label>
										<select class="select form-control floating" name="gender">
											<option> Choose... </option>
											
											<?php
											$gender = ['Male', 'Female'];
											foreach($gender AS $each)
											{
												echo '<option value="'. $each .'">'. $each .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Class </label>
										<select class="select form-control floating" name="class">
											<option> Choose... </option>
											
											<?php
											foreach($fetchClassData AS $eachClass)
											{
												echo '<option value="'. $eachClass['id'] .'">'. $eachClass['class_name'] .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Shift </label>
										<select class="select form-control floating" name="shift">
											<option> Choose... </option>
											
											<?php
											foreach($fetchShiftData AS $eachShift)
											{
												echo '<option value="'. $eachShift['id'] .'">'. $eachShift['shift_name'] .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>	
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Roll No </label>
										<input type="number" min="1" max="50" class="form-control floating" name="rollNo">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Admission Date </label>
										<div class="cal-icon">
											<input class="form-control floating datepicker-here" name="admission" type="text" data-language='en'>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Birth Certificate No. </label>
										<input type="text" class="form-control floating" name="birthCertificate">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Blood Group </label>
										<select class="select form-control floating" name="bg">
											<option > Choose... </option>
											
											<?php
											$bloodGroup = ['A positive (A+)', 'A negative (A-)', 'B positive (B+)', 'B negative (B-)', 'O positive (O+)', 'O negative (O-)', 'AB positive (AB+)', 'AB negative (AB-)'];
											foreach($bloodGroup AS $eachGroup)
											{
												echo '<option value="'. $eachGroup .'">'. $eachGroup .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Phone Number </label>
										<input type="text" class="form-control floating" name="phone" pattern="[0-9]{5}[0-9]{6}">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Religion </label>
										<select class="select form-control floating" name="religion">
											<option > Choose... </option>
											
											<?php
											$religion = ['Islam', 'Hindu', 'Christian', 'Others'];
											foreach($religion AS $eachReligion)
											{
												echo '<option value="'. $eachReligion .'">'. $eachReligion .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Address </label>
										<input type="text" class="form-control floating" name="address">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Create Password </label>
										<input type="password" name="createPass" class="form-control floating" id="checkPass">
										<span style="position: absolute; margin-top: -26px; right: 5px; cursor: pointer;" id="view">
											
										</span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Confirm Password </label>
										<input type="password" name="confirmPass" class="form-control floating">
										<span style="position: absolute; margin-top: -25px; right: 10px;" id="info"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-box">
				<h3 class="card-title"> Parents Informations </h3>
				<div class="row">
					<div class="col-md-12">
						<div class="profile-img-wrap">
							<img class="inline-block" src="public/assets/img/user.jpg" alt="user" id="div2">
							<div class="fileupload btn">
								<span class="btn-text">add</span>
								<input class="upload" name="parentsImage" type="file" onchange="readURL(this);" set-to="div2" required>
							</div>
						</div>
						<div class="profile-basic">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's Name </label>
										<input type="text" name="fatherName" class="form-control floating">
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's NID </label>
										<input type="text" name="father_nid" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's Phone No </label>
										<input type="text" name="father_phoneNo" class="form-control floating">
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's Email (optional)</label>
										<input type="text" name="father_email" class="form-control floating">
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Mother's Name </label>
										<input type="text" name="motherName" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Mother's NID </label>
										<input type="text" name="mother_nid" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Mother's Phone No </label>
										<input type="text" name="mother_phoneNo" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Mother's Occupation </label>
										<select class="select form-control floating" name="mother_occupation">
											<option > Choose... </option>
											
											<?php
											$occupation = ['Housewife', 'Service', 'Business', 'Others'];
											foreach($occupation AS $eachOccupation)
											{
												echo '<option value="'. $eachOccupation .'">'. $eachOccupation .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Parent's Occupation </label>
										<input type="text" name="parentOccupation" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Office or Org Name </label>
										<input type="text" name="parentOrgname" class="form-control floating">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Orgnaization Address </label>
										<input type="text" name="parentOrgAdd" class="form-control floating">
									</div>
								</div>						
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Orgnaization Contact Number </label>
										<input type="text" name="parentOrgNumber" class="form-control floating">
									</div>
								</div>
								<div class="col-md-12">
									<h5 class="text-muted"> Parents Address Informations </h5>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Address </label>
										<input type="text" name="parmanentAddress" class="form-control floating">
									</div>
								</div>					
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Post Office & Post Code </label>
										<input type="text" name="parmanentPO" class="form-control floating">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Police Station </label>
										<input type="text" name="parmanentPS" class="form-control floating">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> District </label>
										<input type="text" name="parmanentDist" class="form-control floating">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Country </label>
										<input type="text" name="parmanentCountry" class="form-control floating" value="Bangladesh">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center m-t-20">
					<button class="btn btn-outline-success btn-sm" name="addStudent" type="submit" style="width: 160px;">
						<i class="fa fa-plus-circle"></i> Add New Student 
					</button>
					<button class="btn btn-outline-dark btn-sm" type="reset" style="width: 160px;">
						<i class="fa fa-power-off"></i> Reset Data
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!--=*= |#| ADD STUDENT CONTENT |#| =*=-->	


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	
	//Password Visibility
	function myFunction() {
		var x = document.getElementById("checkPass");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
	
	$('input[name="createPass"]').on('change', function(){
		$('#view').html('<i class="far fa-eye text-muted" onclick="myFunction()"></i>');
	});
	
	
	//Check Validation in Both Password
	$('input[name="confirmPass"]').on('keyup', function() {
		var createPass = $('input[name="createPass"]').val();
		var confirmPass = $(this).val();
		
		if(createPass === confirmPass) {
			$('#info').html('<i class="far fa-check-circle text-success fa-lg"></i>');
		} else {
			$('#info').html('<i class="far fa-times-circle text-danger fa-lg"></i>');
		}
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->	