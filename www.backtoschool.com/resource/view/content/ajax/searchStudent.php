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


## ===*=== [S]EARCH DATA ===*=== ##
@$search_data = $_POST['search'];

#Fetch Student Data Query
$fetchStudentData = $ajaxcontrol->searchGridContent('ems_students', 'first_name', 'last_name', @$search_data);

if($fetchStudentData > 0)
{
	foreach($fetchStudentData AS $eachRow)
	{
		#Fetch Class Data
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "ems_classes";
		$whereValue["id"] = $eachRow['class_id'];
		$fetchClassesData = $eloquent->selectData($columnName, $tableName, @$whereValue);					
		
		#Fetch Shift Data
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "ems_shifts";
		$whereValue["id"] = $eachRow['shift_id'];
		$fetchShiftData = $eloquent->selectData($columnName, $tableName, @$whereValue);
		
		echo '
		<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
			<div class="profile-widget">
				<div class="profile-img">
					<a arget="_blank" href="'.$GLOBALS['STUDENT_IMAGE_DIRECTORY'].$eachRow['student_image'].'">
						<img class="avatar" src="'.$GLOBALS['STUDENT_IMAGE_DIRECTORY'].$eachRow['student_image'].'" alt="">
					</a>
				</div>
				<div class="dropdown profile-action">
					<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="edit-student.php?id='.$eachRow['id'].'">
							<i class="fa fa-pencil m-r-5"></i> Edit
						</a>
						<a data-id="'.$eachRow['id'].'" class="dropdown-item deleteButton" data-toggle="modal" href="#delete_data">
							<i class="fa fa-trash-o m-r-5"></i> Delete
						</a>
					</div>
				</div>
				<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
					<a href="student-profile.php?id='.$eachRow['id'].'">'.$eachRow['first_name'].' '.$eachRow['last_name'].'</a>
				</h4>
				<div class="small text-muted">'. $fetchClassesData[0]['class_name'].' | '.$fetchShiftData[0]['shift_name'].'</div>
			</div>
		</div>
		';
	}
}
else
{
	echo '<strong class="ml-3"> Oops! </strong> &nbsp; No matching records found, Please retry ...';
}
## ===*=== [S]EARCH DATA  ===*=== ##
?>	