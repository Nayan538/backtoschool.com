<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Http/Controllers/AjaxController.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [L]OAD AND [S]EARCH DATA START ===*=== ##
//HOLD THE KEYWORD BY ASSIGNING A VARIBALE
@$searchData = $_POST['search'];

//TEACHERS DATA QUERY
$fetchTeacherData = $ajaxcontrol->fetchSpecific('id', 'department_id', 'designation_id', 'teacher_id', 'teacher_image', 'first_name', 'last_name', 'email_address', 'phone_no', 'ems_teachers');
if(isset($searchData))
{
	$fetchTeacherData = $ajaxcontrol->searchSpecific('id', 'department_id', 'designation_id', 'teacher_id', 'teacher_image', 'first_name', 'last_name', 'email_address', 'phone_no', 'ems_teachers', $searchData);
}

//STUDENTS DATA QUERY
$fetchStudentData = $ajaxcontrol->fetchSpecific('id', 'class_id', 'shift_id', 'student_id', 'student_image', 'first_name', 'last_name', 'gender', 'phone_no', 'ems_students');
if(isset($searchData))
{
	$fetchStudentData = $ajaxcontrol->searchSpecific('id', 'class_id', 'shift_id', 'student_id', 'student_image', 'first_name', 'last_name', 'gender', 'phone_no', 'ems_students', $searchData);
}

//PARENTS DATA QUERY
$fetchParentsData = $ajaxcontrol->fetchSpecific('id', 'student_id', 'parents_image', 'father_name', 'father_phone_no', 'father_email', 'mother_name', 'mother_phone_no', 'parents_occupation', 'ems_parents');
if(isset($searchData))
{
	$fetchParentsData = $ajaxcontrol->searchSpecific('id', 'student_id', 'parents_image', 'father_name', 'father_phone_no', 'father_email', 'mother_name', 'mother_phone_no', 'parents_occupation', 'ems_parents', $searchData);
}

//IF SEARCH DATA IS EMPTY IN THE ALL DEFINED TABLE
if(isset($searchData))
{
	if(empty($fetchTeacherData) && empty($fetchStudentData) && empty($fetchParentsData))
	{
		echo '<li> <strong class="text-danger"> Oops! </strong> &nbsp; No matching records found, Please retry ... </li>';
	}
}


//FETCH TEACHER DATA START IF NOT EMPTY
if($fetchTeacherData > 0)
{
	foreach($fetchTeacherData AS $eachTeacher)
	{
		$columnName = $tableName = $whereValue= null;
		$columnName = "*";
		$tableName = "ems_departments";
		$whereValue["id"] = $eachTeacher['department_id'];
		$fetchDepartmentData = $eloquent->selectData($columnName, $tableName, @$whereValue);	
			
		$columnName = $tableName = $whereValue= null;
		$columnName = "*";
		$tableName = "ems_designations";
		$whereValue["id"] = $eachTeacher['designation_id'];
		$fetchDesignationData = $eloquent->selectData($columnName, $tableName, @$whereValue);	
		
		echo'
			<li>
				<div class="contact-cont">
					<div class="float-left user-img m-r-10">
						<a href="teacher-profile.php?id='.$eachTeacher['id'].'" title="'.$eachTeacher['teacher_id'].'">
							<img src="'. $GLOBALS['TEACHER_IMAGE_DIRECTORY'] . $eachTeacher['teacher_image'] .'" alt="" class="w-40 rounded-circle">
							<span class="status online"></span>
						</a>
					</div>
					<div class="contact-info">
						<div class="contact-name text-ellipsis">'. $eachTeacher['first_name'] .' ' . $eachTeacher['last_name'] .'</div>
						<div class="contact-date">'. $fetchDesignationData[0]['designation_name'] .' | '. $fetchDepartmentData[0]['department_name'] .'</div>
					</div>
					<ul class="contact-action">
						<li class="dropdown dropdown-action">
							<a href="#" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right custom-drop-style">
								<div class="dropdown-item-custom">
									<h5 class="float-left">Email:</h5>
									<h5 class="float-right font-weight-normal">
										<a href="mailto:">'. $eachTeacher['email_address'] .'</a>
									</h5>
								</div>
								<div class="dropdown-item-custom">
									<h5 class="float-left">Phone:</h5>
									<h5 class="float-right font-weight-normal">
										<a href="tel:">'. $eachTeacher['phone_no'] .'</a>
									</h5>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</li>
		';
	}
}


//FETCH STUDENT DATA START IF NOT EMPTY
if($fetchStudentData > 0)
{
	foreach($fetchStudentData AS $eachStudent)
	{
		$columnName = $tableName = $whereValue= null;
		$columnName = "*";
		$tableName = "ems_classes";
		$whereValue["id"] = $eachStudent['class_id'];
		$fetchClassData = $eloquent->selectData($columnName, $tableName, @$whereValue);	

		$columnName = $tableName = $whereValue= null;
		$columnName = "*";
		$tableName = "ems_shifts";
		$whereValue["id"] = $eachStudent['shift_id'];
		$fetchShiftData = $eloquent->selectData($columnName, $tableName, @$whereValue);	
		
		echo'
			<li>
				<div class="contact-cont">
					<div class="float-left user-img m-r-10">
						<a href="student-profile.php?id='. $eachStudent['id'].'" title="'.$eachStudent['student_id'] .'">
							<img src="'. $GLOBALS['STUDENT_IMAGE_DIRECTORY'] . $eachStudent['student_image'] .'" alt="" class="w-40 rounded-circle">
							<span class="status online"></span>
						</a>
					</div>
					<div class="contact-info">
						<div class="contact-name text-ellipsis">'. $eachStudent['first_name'] .' '. $eachStudent['last_name'] .'</div>
						<div class="contact-date">'. $fetchClassData[0]['class_name'] .' | '. $fetchShiftData[0]['shift_name'] .'</div>
					</div>
					<ul class="contact-action">
						<li class="dropdown dropdown-action">
							<a href="#" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right custom-drop-style">
								<div class="dropdown-item-custom">
									<h5 class="float-left">Phone:</h5>
									<h5 class="float-right font-weight-normal">
										<a href="tel:">'. $eachStudent['phone_no'] .'</a>
									</h5>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</li>
		';
	}
}


//FETCH PARENTS DATA IF NOT EMPTY
if($fetchParentsData > 0)
{	
	foreach($fetchParentsData AS $eachParent)
	{
		$columnName = $tableName = null;
		$columnName["1"] = "first_name";
		$columnName["2"] = "last_name";
		$tableName = "ems_students";
		$whereValue["id"] = $eachParent['student_id'];
		$fetchStudentID = $eloquent->selectData($columnName, $tableName);
		
		echo'
			<li>
				<div class="contact-cont">
					<div class="float-left user-img m-r-10">
						<a href="student-profile.php?id='. $eachParent['student_id'].'" title="'.$eachParent['parents_occupation'] .'">
							<img src="'. $GLOBALS['PARENT_IMAGE_DIRECTORY'] . $eachParent['parents_image'] .'" alt="" class="w-40 rounded-circle">
							<span class="status online"></span>
						</a>
					</div>
					<div class="contact-info">
						<div class="contact-name text-ellipsis">'. $eachParent['father_name'] .'</div>
						<div class="contact-date">Guardian of Student: '. $fetchStudentID[0]['first_name'] .' '. $fetchStudentID[0]['last_name'] .'</div>
					</div>
					<ul class="contact-action">
						<li class="dropdown dropdown-action">
							<a href="#" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right custom-drop-style">
								<div class="dropdown-item-custom">
									<h5 class="float-left">Email:</h5>
									<h5 class="float-right font-weight-normal">
										<a href="mailto:">'. $eachParent['father_email'] .'</a>
									</h5>
								</div>
								<div class="dropdown-item-custom">
									<h5 class="float-left">Phone:</h5>
									<h5 class="float-right font-weight-normal">
										<a href="tel:">'. $eachParent['father_phone_no'] .'</a>
									</h5>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</li>
		';
	}
}
## ===*=== [L]OAD AND [S]EARCH DATA END ===*=== ##
?>