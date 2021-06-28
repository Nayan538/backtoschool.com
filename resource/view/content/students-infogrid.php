<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##
	

## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	#Fetch Student Deleted Data
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_students";
	$whereValue["id"] = $_REQUEST['did'];
	$fetchDeleteStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#Delete Student Data
	$tableName = $whereValue = null;
	$tableName = "ems_students";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteStudentData = $eloquent->deleteData($tableName, @$whereValue);
	
	if($deleteStudentData > 0)
	{
		#Remove The Previous Image from The Defined Directory
		unlink($GLOBALS['STUDENT_IMAGE_DIRECTORY'] . $fetchDeleteStudentData[0]['student_image']);
		
		#Fetch Parent's Deleted Data
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "ems_parents";
		$whereValue["student_id"] = $_REQUEST['did'];
		$fetchDeleteParentsData = $eloquent->selectData($columnName, $tableName, @$whereValue);
		
		#Delete Parent's Data
		$tableName = $whereValue = null;
		$tableName = "ems_parents";
		$whereValue["student_id"] = $_REQUEST['did'];
		$deleteParentsData = $eloquent->deleteData($tableName, @$whereValue);
		
		if($deleteParentsData > 0)
		{
			#Remove The Previous Image from The Defined Directory
			unlink($GLOBALS['PARENT_IMAGE_DIRECTORY'] . $fetchDeleteParentsData[0]['parents_image']);
		}
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "student_image";
$columnName["3"] = "first_name";
$columnName["4"] = "last_name";
$columnName["5"] = "class_id";
$columnName["6"] = "shift_id";
$tableName = "ems_students";
$fetchStudentData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| STUDENT INFOGRID CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> All <span style="font-weight: 300;"> Students </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dasboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Students </a> </li>
						<li class="list-inline-item"> All Students </li>
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
							<input class="form-control mr-sm-2" type="search" id="search" aria-describedby="basic-addon1" placeholder="Search here by Name only">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-12 text-right m-b-20">
				<a href="add-student.php" class="btn btn-outline-dark btn-rounded float-right"><i class="fa fa-plus"></i> Add Student</a>
				<div class="view-icons">
					<a href="students-infogrid.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
					<a href="students-infolist.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
				</div>
			</div>
		</div>
		
		<?php
		#Delete Confirmation Message
		if(isset($_REQUEST['did']))
		{
			if(@$deleteStudentData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Congratulation! </strong> A Student Data is Deleted Successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}
		
		#if Student Grid Content is Not Empty
		if(!empty($fetchStudentData))
		{
		?>
		
		<div class="content-page">
			<div class="row staff-grid-row" id="searchData">
				
			<?php
			#Table Data Content
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
			?>
				
			</div>
		</div>
		
		<?php
		}
		else
		{
			echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Oops! </strong> no data is available at this momment, please add a new teacher ...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}			
		?>
		
	</div>
</div>
<!--=*= |#| STUDENT INFOGRID CONTENT |#| =*=-->

<!--=*= Delete Subject Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Student info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> <a href="#" class="btn btn-dark btn-sm" data-dismiss="modal">Close</a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal">Delete</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Subject Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function() {
		var id = $(this).data('id');
		$('#delete_modal').attr('href','students-infogrid.php?did='+id);
	});
	
	
	//Fetch Student Serach Data
	$(document).ready(function() {
		$('#search').on('keyup', function() {
			var serachStudent = $(this).val();
			
			$.ajax({
				url: 'ajax/searchStudent.php',
				type: 'POST',
				data: {search:serachStudent},
				success: function(data) {
					$('#searchData').html(data);
				}
			});
		});
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->													