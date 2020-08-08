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

#Fetch Teacher's Data
$searchTeacher = $ajaxcontrol->searchGridContent('ems_teachers', 'first_name', 'last_name', @$search_data);

#if Serach Result is Not Empty/
if($searchTeacher > 0)
{
	foreach($searchTeacher AS $eachRow)
	{	
		#Fetch Department Data
		$columnName = $tableName =	$whereValue = null;
		$columnName = "*";
		$tableName = "ems_departments";
		$whereValue["id"] = $eachRow['department_id'];
		$fetchDepartmentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
		
		echo '
		<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
			<div class="profile-widget">
				<div class="profile-img">
					<a target="_blank" href="'. $GLOBALS['TEACHER_IMAGE_DIRECTORY'] . $eachRow['teacher_image'] .'">
						<img class="avatar" src="'. $GLOBALS['TEACHER_IMAGE_DIRECTORY'] . $eachRow['teacher_image'] .'" alt="">
					</a>
				</div>
				<div class="dropdown profile-action">
					<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="edit-teacher.php?id='. $eachRow['id'] .'">
							<i class="fa fa-pencil m-r-5"></i> Edit
						</a>
						<a data-id="'. $eachRow['id'] .'" class="dropdown-item deleteButton" data-toggle="modal" href="#delete_data">
							<i class="fa fa-trash-o m-r-5"></i> Delete
						</a>
					</div>
				</div>
				<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
					<a href="teacher-profile.php?id='. $eachRow['id'] .'">'. $eachRow['first_name'] .' '. $eachRow['last_name'] .'</a>
				</h4>
				<div class="small text-muted">'. $fetchDepartmentData[0]['department_name'] .'</div>
			</div>
		</div>
		';
	}
}
else
{
	echo '<strong class="ml-3"> Oops! </strong> &nbsp; No matching records found, Please retry ...';
}
## ===*=== [S]EARCH DATA ===*=== ##
?>				