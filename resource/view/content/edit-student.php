<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [U]PDATE DATA ===*=== ##
if(isset($_POST['updateStudent']))
{		
	#Modify Date as SQL Syntax
	if(empty($_POST['birthDate'])) {
		$dateOfBirth = $_SESSION['EDIT_STUDENT_BIRTH_DATE'];
	} else {
		$dateOfBirth = date("Y-m-d", strtotime($_POST['birthDate']));
	}
	
	if(empty($_POST['admission'])) {
		$dateOfAdmission = $_SESSION['EDIT_STUDENT_ADMISSION_DATE'];
	} else {
		$dateOfAdmission = date("Y-m-d", strtotime($_POST['admission']));
	}

	
	if(empty($_FILES['studentImage']['name']))
	{
		#Update Data Excluding Image
		$tableName = $columnValue = $whereValue = null;
		$tableName = "ems_students";
		$columnValue["first_name"] = $_POST['firstName'];
		$columnValue["last_name"] = $_POST['lastName'];
		$columnValue["birth_date"] = $dateOfBirth;
		$columnValue["gender"] = $_POST['gender'];
		$columnValue["class_id"] = $_POST['class'];
		$columnValue["shift_id"] = $_POST['shift'];
		$columnValue["admission_date"] = $dateOfAdmission;
		$columnValue["birth_certificate_no"] = $_POST['birthCertificate'];
		$columnValue["blood_group"] = $_POST['bg'];
		$columnValue["phone_no"] = $_POST['phone'];
		$columnValue["religion"] = $_POST['religion'];
		$columnValue["address"] = $_POST['address'];
		$columnValue["updated_at"] = date("Y-m-d H:i:s");
		$whereValue["id"] = $_SESSION['EDIT_STUDENT_ID'];
		$updateStudentData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	
	if(empty($_FILES['parentsImage']['name']))
	{
		#Update Data Excluding Image
		$tableName = $columnValue = $whereValue = null;
		$tableName = "ems_parents";
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
		$columnValue["updated_at"] = date("Y-m-d H:i:s");
		$whereValue["student_id"] = $_SESSION['EDIT_STUDENT_ID'];
		$updateParentsData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	else
	{
		#Update Data Including Image
		
		#Upload Image File Name Generate
		$studentFilename = 'IMAGE_' . date("YmdHis") . rand(1000, 9999) . $_FILES['studentImage']['name'];		
		$parentsFilename = 'IMAGE_' . date("YmdHis") . rand(1000, 9999) . $_FILES['parentsImage']['name'];
		
		#Upload Image File Validation
		$studentImageCheck = $control->checkImage(@$_FILES['studentImage']['type'], @$_FILES['studentImage']['size'], @$_FILES['studentImage']['error']);
		$parentImageCheck = $control->checkImage(@$_FILES['parentsImage']['type'], @$_FILES['parentsImage']['size'], @$_FILES['parentsImage']['error']);
		
		#Update Student Data
		if($studentImageCheck == 1)
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_students";
			$columnValue["student_image"] = $studentFilename;
			$columnValue["first_name"] = $_POST['firstName'];
			$columnValue["last_name"] = $_POST['lastName'];
			$columnValue["birth_date"] = $dateOfBirth;
			$columnValue["gender"] = $_POST['gender'];
			$columnValue["class_id"] = $_POST['class'];
			$columnValue["shift_id"] = $_POST['shift'];
			$columnValue["admission_date"] = $dateOfAdmission;
			$columnValue["birth_certificate_no"] = $_POST['birthCertificate'];
			$columnValue["blood_group"] = $_POST['bg'];
			$columnValue["phone_no"] = $_POST['phone'];
			$columnValue["religion"] = $_POST['religion'];
			$columnValue["address"] = $_POST['address'];
			$columnValue["updated_at"] = date("Y-m-d H:i:s");
			$whereValue["id"] = $_SESSION['EDIT_STUDENT_ID'];
			$updateStudentData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if(!empty($updateStudentData))
			{
				#Store The Uploaded Files Into The Defined Directory
				move_uploaded_file($_FILES['studentImage']['tmp_name'], $GLOBALS['STUDENT_IMAGE_DIRECTORY'] . $studentFilename);
				
				#Remove The Previous Image from The Defined Directory
				unlink($_SESSION['EDIT_STUDENT_OLD_IMAGE']);
			}
		}
		
		#Update Parents Data
		if($parentImageCheck == 1)
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_parents";
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
			$columnValue["updated_at"] = date("Y-m-d H:i:s");
			$whereValue["id"] = $_SESSION['EDIT_PARENTS_ID'];
			$updateParentsData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if(!empty($updateParentsData))
			{
				#Store The Uploaded Files Into The Defined Directory
				move_uploaded_file($_FILES['parentsImage']['tmp_name'], $GLOBALS['PARENT_IMAGE_DIRECTORY'] . $parentsFilename);
				
				#Remove The Previous Image from The Defined Directory
				unlink($_SESSION['EDIT_PARENT_OLD_IMAGE']);
			}
		}
	}
}
## ===*=== [U]PDATE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Students Data | After Updated to Get Profile Link
if(!empty($updateStudentData))
{
	$tableName = $columnName = $whereValue = null;
	$columnName["1"] = "id";
	$columnName["2"] = "first_name";
	$columnName["3"] = "last_name";
	$tableName = "ems_students";
	$whereValue["id"] = $_SESSION['EDIT_STUDENT_ID'];
	$fetchUpdatedData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	$getFullName = @$fetchUpdatedData[0]['first_name'] . ' ' . @$fetchUpdatedData[0]['last_name'];
	$getID = @$fetchUpdatedData[0]['id'];
}

#Create a SESSION Based on Requested ID
if(isset($_REQUEST['id']))
{
	$_SESSION['EDIT_STUDENT_ID'] = $_REQUEST['id'];
}

#Fetch Student Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_students";
$whereValue["id"] = $_SESSION['EDIT_STUDENT_ID'];
$fetchStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);

#To Avoid Bugs | Hold The Requried Values For Later Uses
$birthDate = date('m/d/Y', strtotime($fetchStudentData[0]['birth_date']));
$admissionDate = date('m/d/Y', strtotime($fetchStudentData[0]['admission_date']));
$_SESSION['EDIT_STUDENT_OLD_IMAGE'] = $GLOBALS['STUDENT_IMAGE_DIRECTORY'] . $fetchStudentData[0]['student_image'];
$_SESSION['EDIT_STUDENT_BIRTH_DATE'] = $fetchStudentData[0]['birth_date'];
$_SESSION['EDIT_STUDENT_ADMISSION_DATE'] = $fetchStudentData[0]['admission_date'];

#Fetch Parent Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_parents";
$whereValue["student_id"] = $_SESSION['EDIT_STUDENT_ID'];
$fetchParentsData = $eloquent->selectData($columnName, $tableName, @$whereValue);	

#Create a SESSION for Requested Data Images and ID
$_SESSION['EDIT_PARENTS_ID'] = $fetchParentsData[0]['id'];
$_SESSION['EDIT_PARENT_OLD_IMAGE'] = $GLOBALS['PARENT_IMAGE_DIRECTORY'] . $fetchParentsData[0]['parents_image'];	

#Fetch Class Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_classes";
$fetchClassData = $eloquent->selectData($columnName, $tableName, @$whereValue);	

#Fetch Shift Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_shifts";
$fetchShiftData = $eloquent->selectData($columnName, $tableName, @$whereValue);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| EDIT STUDENT CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> Edit <span style="font-weight: 300;"> Student </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="students-infogrid.php"> Student </a> </li>
						<li class="list-inline-item"> Edit Student </li>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
		#Update Confirmation Message
		if(isset($_POST['updateStudent']))
		{
			if(@$updateStudentData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					Congratulation! A New Student Data is Added Successfully. Checkout 
					<strong> '.$getFullName.'<a href="student-profile.php?id='.$getID.'"> Profile </a> </strong> 
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
							<img class="inline-block" src="<?php echo $GLOBALS['STUDENT_IMAGE_DIRECTORY'] . $fetchStudentData[0]['student_image'] ?>" alt="user" id="div1">
							<div class="fileupload btn">
								<span class="btn-text"> edit </span>
								<input class="upload" name="studentImage" type="file" onchange="readURL(this);" set-to="div1">
							</div>
						</div>
						<div class="profile-basic">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<input type="hidden" name="student">
										<label class="focus-label"> First Name </label>
										<input type="text" name="firstName" class="form-control floating" value="<?php echo $fetchStudentData[0]['first_name'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Last Name </label>
										<input type="text" name="lastName" class="form-control floating" value="<?php echo $fetchStudentData[0]['last_name'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Birth Date </label>
										<div class="cal-icon">
											<input class="form-control floating datepicker-here" name="birthDate" type="text" data-language='en' placeholder="<?php echo $birthDate ?>">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Gendar </label>
										<select class="select form-control floating" name="gender">
											<option value="<?php echo $fetchStudentData[0]['gender'] ?>"><?php echo $fetchStudentData[0]['gender'] ?></option>
											
											<?php
											$gender = ['Male', 'Female'];
											foreach($gender AS $each)
											{
												if($each != $fetchStudentData[0]['gender'])
												{
													echo '<option value="'. $each .'">'. $each .'</option>';
													continue;
												}
											}
											?>
											
										</select>
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Class </label>
										<select class="select form-control floating" name="class">
											
											<?php
											foreach($fetchClassData AS $eachClass)
											{
												echo '<option value="'. $eachClass['id'] .'" ';
												
												if($eachClass['id'] == $fetchStudentData[0]['class_id'])
												echo 'selected';
												
												echo '>'. $eachClass['class_name'] .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Shift </label>
										<select class="select form-control floating" name="shift">
											
											<?php
											foreach($fetchShiftData AS $eachShift)
											{
												echo '<option value="'. $eachShift['id'] .'" ';
												
												if($eachShift['id'] == $fetchStudentData[0]['shift_id'])
												echo 'selected';
												
												echo '>'. $eachShift['shift_name'] .'</option>';
											}
											?>
											
										</select>
									</div>
								</div>	
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Roll No </label>
										<input class="form-control floating" value="<?php echo $fetchStudentData[0]['roll_number'] ?>" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Admission Date </label>
										<div class="cal-icon">
											<input class="form-control floating datepicker-here" name="admission" type="text" data-language='en' placeholder="<?php echo $admissionDate ?>">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Birth Certificate No. </label>
										<input type="text" class="form-control floating" name="birthCertificate" value="<?php echo $fetchStudentData[0]['birth_certificate_no'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Blood Group </label>
										<select class="select form-control floating" name="bg">
											<option value="<?php echo$fetchStudentData[0]['blood_group']?>"><?php echo$fetchStudentData[0]['blood_group']?></option>
											
											<?php
											$bloodGroup = ['A positive (A+)', 'A negative (A-)', 'B positive (B+)', 'B negative (B-)', 'O positive (O+)', 'O negative (O-)', 'AB positive (AB+)', 'AB negative (AB-)'];
											
											foreach($bloodGroup AS $eachGroup)
											{
												if($eachGroup != $fetchStudentData[0]['blood_group'])
												{
													echo '<option value="'. $eachGroup .'">'. $eachGroup .'</option>';
													continue;
												}
											}
											?>
											
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Phone Number </label>
										<input type="text" class="form-control floating" name="phone" pattern="[0-9]{5}[0-9]{6}" value="<?php echo $fetchStudentData[0]['phone_no'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Religion </label>
										<select class="select form-control floating" name="religion">
											<option value="<?php echo$fetchStudentData[0]['religion']?>"><?php echo$fetchStudentData[0]['religion']?></option>
											
											<?php
												$religion = ['Islam', 'Hindu', 'Christian', 'Others'];
												foreach($religion AS $eachReligion)
												{
													if($eachReligion != $fetchStudentData[0]['religion'])
													{
														echo '<option value="'. $eachReligion .'">'. $eachReligion .'</option>';
														continue;
													}
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
										<input type="text" class="form-control floating" name="address" value="<?php echo $fetchStudentData[0]['address'] ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-box">
				<h3 class="card-title">Parents Informations</h3>
				<div class="row">
					<div class="col-md-12">
						<div class="profile-img-wrap">
							<img class="inline-block" src="<?php echo $GLOBALS['PARENT_IMAGE_DIRECTORY'] . $fetchParentsData[0]['parents_image'] ?>" alt="user" id="div2">
							<div class="fileupload btn">
								<span class="btn-text">edit</span>
								<input class="upload" name="parentsImage" type="file" onchange="readURL(this);" set-to="div2">
							</div>
						</div>
						<div class="profile-basic">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's Name </label>
										<input type="text" name="fatherName" class="form-control floating" value="<?php echo $fetchParentsData[0]['father_name'] ?>">
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's NID </label>
										<input type="text" name="father_nid" class="form-control floating" value="<?php echo $fetchParentsData[0]['father_nid_card_no'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's Phone No </label>
										<input type="text" name="father_phoneNo" class="form-control floating" value="<?php echo $fetchParentsData[0]['father_phone_no'] ?>">
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Father's Email (optional)</label>
										<input type="text" name="father_email" class="form-control floating" value="<?php echo $fetchParentsData[0]['father_email'] ?>">
									</div>
								</div>								
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Mother's Name </label>
										<input type="text" name="motherName" class="form-control floating" value="<?php echo $fetchParentsData[0]['mother_name'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Mother's NID </label>
										<input type="text" name="mother_nid" class="form-control floating" value="<?php echo $fetchParentsData[0]['mother_nid_card_no'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Mother's Phone No </label>
										<input type="text" name="mother_phoneNo" class="form-control floating" value="<?php echo $fetchParentsData[0]['mother_phone_no'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus select-focus cstm-height">
										<label class="focus-label"> Mother's Occupation </label>
										<select class="select form-control floating" name="mother_occupation">
											<option value="<?php echo$fetchParentsData[0]['mother_occupation']?>"><?php echo$fetchParentsData[0]['mother_occupation']?></option>
											
											<?php
												$occupation = ['Housewife', 'Service', 'Business', 'Others'];
												foreach($occupation AS $eachOccupation)
												{
													if($eachOccupation != $fetchParentsData[0]['mother_occupation'])
													{
														echo '<option value="'. $eachOccupation .'">'. $eachOccupation .'</option>';
														continue;
													}
												}
											?>
											
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Parent's Occupation </label>
										<input type="text" name="parentOccupation" class="form-control floating" value="<?php echo $fetchParentsData[0]['parents_occupation'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Office or Org Name </label>
										<input type="text" name="parentOrgname" class="form-control floating" value="<?php echo $fetchParentsData[0]['parents_org_name'] ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Orgnaization Address </label>
										<input type="text" name="parentOrgAdd" class="form-control floating" value="<?php echo $fetchParentsData[0]['parents_org_address'] ?>">
									</div>
								</div>						
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Orgnaization Contact Number </label>
										<input type="text" name="parentOrgNumber" class="form-control floating" value="<?php echo $fetchParentsData[0]['parents_org_contact_number'] ?>">
									</div>
								</div>
								<div class="col-md-12">
									<h5 class="text-muted"> Parents Address Informations </h5>
								</div>
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Address </label>
										<input type="text" name="parmanentAddress" class="form-control floating" value="<?php echo $fetchParentsData[0]['permanent_address'] ?>">
									</div>
								</div>					
								<div class="col-md-3">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Post Office & Post Code </label>
										<input type="text" name="parmanentPO" class="form-control floating" value="<?php echo $fetchParentsData[0]['permanent_post_office'] ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Police Station </label>
										<input type="text" name="parmanentPS" class="form-control floating" value="<?php echo $fetchParentsData[0]['permanent_police_station'] ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> District </label>
										<input type="text" name="parmanentDist" class="form-control floating" value="<?php echo $fetchParentsData[0]['permanent_district'] ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-focus cstm-height">
										<label class="focus-label"> Country </label>
										<input type="text" name="parmanentCountry" class="form-control floating" value="<?php echo $fetchParentsData[0]['permanent_country'] ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center m-t-20">
					<button class="btn btn-outline-success btn-sm" name="updateStudent" type="submit" style="width: 160px;">
						<i class="fa fa-plus-circle"></i> Update Student 
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!--=*= |#| EDIT STUDENT CONTENT |#| =*=-->