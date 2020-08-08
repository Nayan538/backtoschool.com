<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA START ===*=== ##
if(isset($_POST['addTeacher']))
{
	#Upload Image File Name Generate
	$imageFileName= 'IMAGE_' . date("YmdHis") . rand(1000, 9999) . $_FILES['image']['name'];

	#Upload Image File Validation
	$validImage = $control->checkImage(@$_FILES['image']['type'], @$_FILES['image']['size'], @$_FILES['image']['error']);
	
	#Teacher ID Generate
	$teacherID = 'T-ID# ' . rand(1000,9999);
	
	#Modify Date as SQL Syntax
	$dataOfJoin = date("Y-m-d", strtotime($_POST['joinDate']));
	$dataOfBirth = date("Y-m-d", strtotime($_POST['birthDate']));
		
	if($validImage == 1)
	{
		$tableName = $columnValue = null;
		$tableName = "ems_teachers";
		$columnValue["department_id"] = $_POST['department'];
		$columnValue["designation_id"] = $_POST['designation'];
		$columnValue["teacher_id"] = $teacherID;
		$columnValue["teacher_image"] = $imageFileName;
		$columnValue["first_name"] = $_POST['firstName'];
		$columnValue["last_name"] = $_POST['lastName'];
		$columnValue["email_address"] = $_POST['emailAdd'];
		$columnValue["phone_no"] = $_POST['phoneNo'];
		$columnValue["join_date"] = $dataOfJoin;
		$columnValue["religion"] = $_POST['religion'];
		$columnValue["nid_card_no"] = $_POST['nid'];
		$columnValue["country"] = $_POST['country'];
		$columnValue["teacher_password"] = sha1($_POST['confirmPass'] . $GLOBALS['CYPHER_KEY']);
		$columnValue["birth_date"] = $dataOfBirth;
		$columnValue["gender"] = $_POST['gender'];
		$columnValue["present_address"] = $_POST['address'];
		$columnValue["facebook_url"] = $_POST['facebook'];
		$columnValue["linkedin_url"] = $_POST['linkedin'];
		$columnValue["youtube_url"] = $_POST['youtube'];
		$columnValue["twitter_url"] = $_POST['twitter'];
		$columnValue["contact_name"] = $_POST['contactName'];
		$columnValue["contact_relation"] = $_POST['relation'];
		$columnValue["contact_address"] = $_POST['contactAdd'];
		$columnValue["contact_number"] = $_POST['contactPhoneNo'];
		$columnValue["graduate_institution_name"] = $_POST['graduateInstitute'];
		$columnValue["graduate_subject_in"] = $_POST['graduateSubject'];
		$columnValue["graduate_year_in"] = $_POST['graduateYear'];
		$columnValue["graduate_certification_in"] = $_POST['graduateDegree'];
		$columnValue["graduate_result"] = $_POST['graduateCgpa'];
		$columnValue["undergraduate_institution_name"] = $_POST['underGraduateInstitute'];
		$columnValue["undergraduate_subject_in"] = $_POST['underGraduateSubject'];
		$columnValue["undergraduate_year_in"] = $_POST['underGraduateYear'];
		$columnValue["undergraduate_certification_in"] = $_POST['underGraduateDegree'];
		$columnValue["undergraduate_result"] = $_POST['underGraduateCgpa'];
		$columnValue["hsc_institution_name"] = $_POST['hscInstitute'];
		$columnValue["hsc_group_in"] = $_POST['hscGroup'];
		$columnValue["hsc_year_in"] = $_POST['hscYear'];
		$columnValue["hsc_certification_in"] = $_POST['hscCerfication'];
		$columnValue["hsc_result"] = $_POST['hscCgpa'];
		$columnValue["organization_f"] = $_POST['org1'];
		$columnValue["workshop_on_f"] = $_POST['workshop1'];
		$columnValue["certification_on_f"] = $_POST['certificate1'];
		$columnValue["in_year_f"] = $_POST['year1'];
		$columnValue["organization_s"] = $_POST['org2'];
		$columnValue["workshop_on_s"] = $_POST['workshop2'];
		$columnValue["certification_on_s"] = $_POST['certificate2'];
		$columnValue["in_year_s"] = $_POST['year2'];
		$columnValue["exp_org_name"] = $_POST['expCompany'];
		$columnValue["exp_org_location"] = $_POST['expLocation'];
		$columnValue["exp_job_position"] = $_POST['expPosition'];
		$columnValue["exp_in_year"] = $_POST['expYear'];
		$columnValue["about_teacher"] = $_POST['about'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$insertTeacherData = $eloquent->insertData($tableName, $columnValue);
		
		$_SESSION['LAST_INSERTED_TEACHER_ID'] = @$insertTeacherData['LAST_INSERT_ID'];
		
		if(@$insertTeacherData['LAST_INSERT_ID'] > 0)
		{
			#Store The Uploaded Files Into The Defined Directory
			move_uploaded_file($_FILES['image']['tmp_name'], $GLOBALS['TEACHER_IMAGE_DIRECTORY'] . $imageFileName);
			
			#Fetch The Last Inserted Data to Get Profile Link
			$tableName = $columnName = $whereValue = null;
			$columnName["1"] = "id";
			$columnName["2"] = "first_name";
			$columnName["3"] = "last_name";
			$tableName = "ems_teachers";
			$whereValue["id"] = $_SESSION['LAST_INSERTED_TEACHER_ID'];
			$fetchLastInsertData = $eloquent->selectData($columnName, $tableName, @$whereValue);

			$getName = $fetchLastInsertData[0]['first_name'] . ' ' . $fetchLastInsertData[0]['last_name'];
			$getID = $fetchLastInsertData[0]['id'];
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

<!--=*= |#| ADD TEACHER CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> Add <span style="font-weight: 300;"> A New Teacher </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="teachers-infogrid.php"> Teachers </a> </li>
						<li class="list-inline-item"> Add Teacher </li>
					</ul>
				</div>
			</div>
			
			<?php
			#Insert Confirmation Message
			if(isset($_POST['addTeacher']))
			{
				if(@$insertTeacherData > 0)
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Congratulation! A New Data is Added Successfully, Checkout
						<strong>
							'. $getName .' <a href="teacher-profile.php?id='. $getID .'"> Profile </a>
						</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"> &times; </span>
						</button>
					</div>
					';
				}
			}
			?>
			
			<form action="" method="post" enctype="multipart/form-data">
				<div class="card-box">
					<h3 class="card-title"> Basic Informations </h3>
					<div class="row">
						<div class="col-md-12">
							<div class="profile-img-wrap">
								<img class="inline-block" src="public/assets/img/user.jpg" alt="user" id="div1">
								<div class="fileupload btn">
									<span class="btn-text"> add </span>
									<input class="upload" type="file" name="image" onchange="readURL(this);" set-to="div1" required>
								</div>
							</div>
							<div class="profile-basic">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group form-focus cstm-height">
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
											<label class="focus-label"> Email Address </label>
											<input type="email" name="emailAdd" class="form-control floating">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group form-focus cstm-height">
											<label class="focus-label"> Phone Number </label>
											<input type="tel" name="phoneNo" class="form-control floating" pattern="[0-9]{5}[0-9]{6}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group form-focus cstm-height">
											<label class="focus-label"> Select Department </label>
											<select class="select form-control floating" name="department" id="department">
												<option > Choose... </option>
												
												<?php
												foreach($fetchDepartmentData AS $eachDept)
												{
													echo '<option value="'. $eachDept['id'] .'">'. $eachDept['department_name'] .'</option>';
												}
												?>
												
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group form-focus cstm-height">
											<label class="focus-label"> Select Designation </label>
											<select class="select form-control floating" name="designation" id="designation">
												<option > Choose... </option>
											</select>
										</div>
									</div>								
									<div class="col-md-3">
										<div class="form-group form-focus cstm-height">
											<label class="focus-label"> Join Date </label>
											<div class="cal-icon">
												<input class="form-control floating datepicker-here" type="text" name="joinDate" data-language='en'>
											</div>
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group form-focus select-focus cstm-height">
											<label class="focus-label"> Select Religion </label>
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
							</div>
						</div>
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title"> Contact Informations </h3>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> National Identification Card No </label>
								<input type="text" name="nid" class="form-control floating" placeholder="870 155 0140">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Country </label>
								<input type="text" name="country" class="form-control floating" value="Bangladesh">
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
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Date of Birth </label>
								<div class="cal-icon">
									<input class="form-control floating datepicker-here" type="text" name="birthDate" data-language='en'>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-focus select-focus cstm-height">
								<label class="focus-label"> Select Gendar </label>
								<select class="select form-control floating" name="gender">
									<option> Choose... </option>
									
									<?php
									$gender = ['Male', 'Female'];
									foreach($gender AS $eachGender)
									{
										echo '<option value="'. $eachGender .'">'. $eachGender .'</option>';
									}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Address </label>
								<input type="text" name="address" class="form-control floating">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Facebook Profile Link </label>
								<input type="text" name="facebook" class="form-control floating" placeholder="(optional)">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label">LinkedIN Profile Link </label>
								<input type="text" name="linkedin" class="form-control floating" placeholder="(optional)">
							</div>
						</div>						
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Youtube Channel Link </label>
								<input type="text" name="youtube" class="form-control floating" placeholder="(optional)">
							</div>
						</div>					
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Twitter Profile Link </label>
								<input type="text" name="twitter" class="form-control floating" placeholder="(optional)">
							</div>
						</div>					
					</div>
					<h3 class="card-title"> Emergency Contact Informations </h3>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Contact Person </label>
								<input type="text" name="contactName" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Relation in </label>
								<select class="select form-control floating" name="relation">
									<option> Choose... </option>
									
									<?php
									$relation = ['Parents', 'Spouse', 'Family Member', 'Relative'];
									foreach($relation AS $eachRelation)
									{
										echo '<option value="'. $eachRelation .'">'. $eachRelation .'</option>';
									}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Contact Address </label>
								<input type="text" name="contactAdd" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Contact Number </label>
								<input type="tel" name="contactPhoneNo" class="form-control floating" pattern="[0-9]{5}[0-9]{6}">
							</div>
						</div>
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title"> Academic Informations </h3>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Graduation Institution </label>
								<input type="text" name="graduateInstitute" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Major in </label>
								<input type="text" name="graduateSubject" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Graduation Year </label>
								<input type="text" name="graduateYear" class="form-control floating">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Graduation Degree </label>
								<input type="text" name="graduateDegree" class="form-control floating">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> CGPA </label>
								<input type="number" name="graduateCgpa" class="form-control floating" step="any">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> UnderGraduation Institution </label>
								<input type="text" name="underGraduateInstitute" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Major in </label>
								<input type="text" name="underGraduateSubject" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> UnderGraduation Year </label>
								<input type="text" name="underGraduateYear" class="form-control floating">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> UnderGraduation Degree </label>
								<input type="text" name="underGraduateDegree" class="form-control floating">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> CGPA </label>
								<input type="number" name="underGraduateCgpa" class="form-control floating" step="any">
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> HSC Institution </label>
								<input type="text" name="hscInstitute" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> HSC Group </label>
								<select class="select form-control floating" name="hscGroup">
									<option> Choose... </option>
									
									<?php
									$group = ['Science', 'Humanities', 'Business Studies'];
									foreach($group AS $eachGroup)
									{
										echo '<option value="'. $eachGroup .'">'. $eachGroup .'</option>';
									}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> HSC Year </label>
								<input type="text" name="hscYear" class="form-control floating">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Certification </label>
								<input type="text" name="hscCerfication" class="form-control floating">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> CGPA </label>
								<input type="number" name="hscCgpa" class="form-control floating" step="any">
							</div>
						</div>
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title"> Conferences or Courses or Extra Carriculam Activities </h3>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Organized By </label>
								<input type="text" name="org1" class="form-control floating">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Course or Workshop on </label>
								<input type="text" name="workshop1" class="form-control floating">
							</div>
						</div>					
						<div class="col-md-4">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Certification </label>
								<input type="text" name="certificate1" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> In Year </label>
								<input type="text" name="year1" class="form-control floating">
							</div>
						</div>					
					</div>				
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Organized By </label>
								<input type="text" name="org2" class="form-control floating">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Course or Workshop on </label>
								<input type="text" name="workshop2" class="form-control floating">
							</div>
						</div>					
						<div class="col-md-4">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Certification </label>
								<input type="text" name="certificate2" class="form-control floating">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> In Year </label>
								<input type="text" name="year2" class="form-control floating">
							</div>
						</div>					
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title"> Experience Informations <span class="text-muted"> (optional) </span> </h3>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Company Name </label>
								<input type="text" name="expCompany" class="form-control floating">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Location </label>
								<input type="text" name="expLocation" class="form-control floating">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> Job Position </label>
								<input type="text" name="expPosition" class="form-control floating">
							</div>
						</div>					
						<div class="col-md-2">
							<div class="form-group form-focus cstm-height">
								<label class="focus-label"> In Year </label>
								<input type="text" name="expYear" class="form-control floating">
							</div>
						</div>
					</div>
				</div>	
				<div class="card-box">
					<div class="row">
						<div class="col-md-12">
							<textarea id="message" name="about" class="form__field mt-2" rows="1" required> let us know a simple bio about teacher </textarea>
						</div>
					</div>
					<div class="text-center m-t-20">
						<button class="btn btn-outline-success btn-sm" name="addTeacher" type="submit" style="width: 160px;">
							<i class="fa fa-plus-circle"></i> Add New Teacher 
						</button>
						<button class="btn btn-outline-dark btn-sm" type="reset" style="width: 160px;">
							<i class="fa fa-power-off"></i> Reset Data
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= |#| ADD TEACHER CONTENT |#| =*=-->


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
	
	
	$(document).ready(function() {
		
		//Fetch Designation Based on Department
		$("#department").change(function() {
			var dept = $(this).val();

			if(dept != "") 
			{
				$.ajax({
					url: "ajax/DropDown.php",
					type: 'POST',
					data: {insertDesignation: "YES", dept_id:dept},
					success: function(data) {
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
		$('input[name="confirmPass"]').on('keyup', function() {
			var createPass = $('input[name="createPass"]').val();
			var confirmPass = $(this).val();
			
			if(createPass === confirmPass) {
				$('#info').html('<i class="far fa-check-circle text-success fa-lg"></i>');
			} else {
				$('#info').html('<i class="far fa-times-circle text-danger fa-lg"></i>');
			}
		});		
		
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->									