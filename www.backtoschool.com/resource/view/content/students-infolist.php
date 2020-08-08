<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{	
	#Fetch Student's Deleted Data
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_students";
	$whereValue["id"] = $_REQUEST['did'];
	$fetchDeleteStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#Delete Student's Data
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
$columnName = "*";
$tableName = "ems_students";
$fetchStudentData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| STUDENT INFOLIST CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> All <span style="font-weight: 300;"> Students </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Students </a> </li>
						<li class="list-inline-item"> All Students </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-sm-9 col-12"> </div>
			<div class="col-sm-3 col-12 text-right m-b-20">
				<a href="add-student.php" class="btn btn-outline-dark btn-rounded float-right">
					<i class="fa fa-plus"></i> Add Student
				</a>
				<div class="view-icons">
					<a href="students-infogrid.php" class="grid-view btn btn-link">
						<i class="fa fa-th"></i>
					</a>
					<a href="students-infolist.php" class="list-view btn btn-link active">
						<i class="fa fa-bars"></i>
					</a>
				</div>
			</div>
		</div>
		
		<?php
		#Delete Confirmation Message
		if(isset($_REQUEST['did']))
		{
			if($deleteStudentData > 0)
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
		?>
		
		<div class="content-page">
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-sm table-hover cstmDatatable custom-table" style="margin-top: 0px !important;">
							<thead>
								<tr>
									<th> Name </th>
									<th> Student ID </th>
									<th> Gender </th>
									<th> Parents </th>
									<th> Section </th>
									<th> Date of Birth </th>
									<th> Blood Group </th>
									<th> Mobile </th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								
							<?php
							#Table Data Content
							if(!empty($fetchStudentData))
							{
								foreach($fetchStudentData AS $eachRow)
								{
									#Fetch Parent's Data
									$columnName = $tableName = $whereValue = null;
									$columnName = "*";
									$tableName = "ems_parents";
									$whereValue["student_id"] = $eachRow['id'];
									$fetchParentsData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									
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
									<tr>
										<td style="padding: 4px; 8px;">
											<a href="student-profile.php?id='.$eachRow['id'].'" class="avatar bg-warning">
												'. $ajaxcontrol->nameIndex($eachRow['first_name'], $eachRow['last_name']) .'
											</a>
											<h2>
												<a href="student-profile.php?id='.$eachRow['id'].'">
													'. $eachRow['first_name'] .' '. $eachRow['last_name'].'
													<span>'. $fetchClassesData[0]['class_name'] .'</span>
												</a>
											</h2>
										</td>
										<td style="padding: 4px; 8px;">'. $eachRow['student_id'] .'</td>
										<td style="padding: 4px; 8px;">'. $eachRow['gender'] .'</td>
										<td style="padding: 4px; 8px;">'. $fetchParentsData[0]['father_name'] .'</td>
										<td style="padding: 4px; 8px;">'. $fetchShiftData[0]['shift_name'] .'</td>
										<td style="padding: 4px; 8px;">'. $ajaxcontrol->dateOnly($eachRow['birth_date']) .'</td>
										<td style="padding: 4px; 8px;">'. $eachRow['blood_group'] .'</td>
										<td style="padding: 4px; 8px;">'. $eachRow['phone_no'] .'</td>
										<td class="text-right" style="padding: 4px; 8px;">
											<a href="edit-student.php?id='.$eachRow['id'].'" class="btn btn-outline-secondary btn-sm">
												<i class="fas fa-edit" aria-hidden="true"></i>
											</a>
											<button data-id="'.$eachRow['id'].'" class="btn btn-outline-danger btn-sm deleteButton" data-toggle="modal" data-target="#delete_data">
												<i class="fas fa-trash"></i>
											</button>
										</td>
									</tr>
									';
								}
							}
							?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| STUDENT INFOLIST CONTENT |#| =*=-->

<!--=*= Delete Subject Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Student info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> 
						<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal"> Delete </a>
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
		$('#delete_modal').attr('href','students-infolist.php?did='+id);
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->									