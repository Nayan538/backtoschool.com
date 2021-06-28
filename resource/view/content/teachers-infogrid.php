<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##	


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{	
	#Fetch Deleted Data
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_teachers";
	$whereValue["id"] = $_REQUEST['did'];
	$fetchDeleteData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#Delete Data
	$tableName = $whereValue = null;
	$tableName = "ems_teachers";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteTeacherData = $eloquent->deleteData($tableName, @$whereValue);
	
	if($deleteTeacherData > 0)
	{
		#Remove The Previous Image from The Defined Directory
		unlink($GLOBALS['TEACHER_IMAGE_DIRECTORY'].$fetchDeleteData[0]['teacher_image']);
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$columnName = $tableName =	null;
$columnName["1"] = "id";
$columnName["2"] = "department_id";
$columnName["3"] = "teacher_image";
$columnName["4"] = "first_name";
$columnName["5"] = "last_name";
$tableName = "ems_teachers";
$fetchTeachersData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| TEACHER'S GRID CONTENT |#| =*=-->
<div class="page-wrapper">		
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> All <span style="font-weight: 300;"> Teachers </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Teachers </a> </li>
						<li class="list-inline-item"> All Teachers </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-sm-8 col-12">
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text bg-dark text-white" id="basic-addon1">
									SEARCH HERE <i class="fab fa-searchengin fa-lg ml-3 text-warning"></i>
								</span>
							</div>
							<input class="form-control mr-sm-2" type="search" id="search" aria-describedby="basic-addon1" placeholder="Search here by name only...">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-12 text-right m-b-20">
				<a href="add-teacher.php" class="btn btn-outline-dark btn-rounded float-right">
					<i class="fa fa-plus"></i> Add Teacher
				</a>
				<div class="view-icons">
					<a href="teachers-infogrid.php" class="grid-view btn btn-link active">
						<i class="fa fa-th"></i>
					</a>
					<a href="teachers-infolist.php" class="list-view btn btn-link"> 
						<i class="fa fa-bars"></i> 
					</a>
				</div>
			</div>
		</div>
		
		<?php
		#Delete Confirmation Message
		if(isset($_REQUEST['did']))
		{
			if($deleteTeacherData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					Congratulation! A Data is Deleted Successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}
		?>
		
		<?php
		#Grid Data Content
		if(!empty($fetchTeachersData))
		{
		?>
		
		<div class="content-page">
			<div class="row staff-grid-row" id="searchData">
				
			<?php
			foreach($fetchTeachersData AS $eachRow)
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
							<a target="_blank" href="'.$GLOBALS['TEACHER_IMAGE_DIRECTORY'] . $eachRow['teacher_image'].'">
								<img class="avatar bg-white" src="'.$GLOBALS['TEACHER_IMAGE_DIRECTORY'].$eachRow['teacher_image'].'" alt="">
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
							<a href="teacher-profile.php?id='. $eachRow['id'] .'">
								'. $eachRow['first_name'] .' '. $eachRow['last_name'] .'
							</a>
						</h4>
						<div class="small text-muted">'. $fetchDepartmentData[0]['department_name'] .'</div>
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
<!--=*= |#| TEACHER'S GRID CONTENT |#| =*=-->

<!--=*= Delete Subject Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to <span class="text-danger"> delete </span> this Teacher's info? </h4>
			</div>
			<div class="modal-body m-b-10">
				<div class="m-t-10">
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </a>
					<a href="#" class="btn btn-warning btn-sm" id="delete_modal"> Delete </a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Subject Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function() {
		var id = $(this).data('id');
		$('#delete_modal').attr('href','teachers-infogrid.php?did='+id);
	});
	
	
	//Fetch Teacher's Search Data
	$(document).ready(function() {
		$('#search').on('keyup', function() {
			var serachTeacher = $(this).val();
			
			$.ajax({
				url: 'ajax/searchTeacher.php',
				type: 'POST',
				data: {search:serachTeacher},
				success: function(data) {
					$('#searchData').html(data);
				}
			});
		});
	});
	
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->