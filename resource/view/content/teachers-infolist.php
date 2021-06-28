<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
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
$columnName = "*";
$tableName = "ems_teachers";
$fetchTeachersData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| TEACHER'S LIST CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">All <span style="font-weight: 300;"> Teachers </span></h5>
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
			<div class="col-sm-9 col-12">
			</div>
			<div class="col-sm-3 col-12 text-right m-b-20">
				<a href="add-teacher.php" class="btn btn-outline-dark btn-rounded float-right">
					<i class="fa fa-plus"></i> Add Teacher
				</a>
				<div class="view-icons">
					<a href="teachers-infogrid.php" class="grid-view btn btn-link">
						<i class="fa fa-th"></i> 
					</a>
					<a href="teachers-infolist.php" class="list-view btn btn-link active"> 
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
		
		<div class="content-page">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table custom-table table-sm table-hover cstmDatatable" style="margin-top: 15px !important;">
							<thead>
								<tr>
									<th> Name (Subject) </th>
									<th> Designation </th>
									<th> Teacher ID </th>
									<th> Join Date </th>
									<th> Gender </th>
									<th> Email </th>
									<th> Mobile </th>
									<th> Action </th>
								</tr>
							</thead>
							<tbody>
								
							<?php
							#Table Data Content
							if(!empty($fetchTeachersData))
							{
								foreach($fetchTeachersData AS $eachRow)
								{
									#Fetch Department Data
									$columnName = $tableName =	$whereValue = null;
									$columnName = "*";
									$tableName = "ems_departments";
									$whereValue["id"] = $eachRow['department_id'];
									$fetchDepartmentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									
									#Fetch Designation Data
									$columnName = $tableName =	$whereValue = null;
									$columnName = "*";
									$tableName = "ems_designations";
									$whereValue["id"] = $eachRow['designation_id'];
									$fetchDesignationData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									
									echo '
									<tr>
										<td style="padding: 4px; 8px;">
											<a href="teacher-profile.php?id='. $eachRow['id'] .'" class="avatar bg-warning">
												'. $ajaxcontrol->nameIndex($eachRow['first_name'], $eachRow['last_name']) .'
											</a>
											<h2>
												<a href="teacher-profile.php?id='. $eachRow['id'] .'">
												'. $eachRow['first_name'] .' '. $eachRow['last_name'] .'
												<span>('. $fetchDepartmentData[0]['department_name'] .')</span>
												</a>
											</h2>
										</td>
										<td style="padding: 4px; 8px;">'. $fetchDesignationData[0]['designation_name'] .'</td>
										<td style="padding: 4px; 8px;">'. $eachRow['teacher_id'] .'</td>
										<td style="padding: 4px; 8px;">'. $ajaxcontrol->dateOnly($eachRow['join_date']) .'</td>
										<td style="padding: 4px; 8px;">'. $eachRow['gender'] .'</td>
										<td style="padding: 4px; 8px;">'. $eachRow['email_address'] .'</td>
										<td style="padding: 4px; 8px;">+88 '. $eachRow['phone_no'] .'</td>
										<td class="text-center" style="padding: 4px; 8px;">
											<a href="edit-teacher.php?id='. $eachRow['id'] .'" class="btn btn-outline-secondary btn-sm">
												<i class="fas fa-edit"></i>
											</a>
											<button data-id="'. $eachRow['id'] .'" class="btn btn-outline-danger btn-sm deleteButton" data-toggle="modal" data-target="#delete_data">
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
<!--=*= |#| TEACHER'S LIST CONTENT |#| =*=-->

<!--=*= Delete Subject Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">  Do you want to <span class="text-danger"> delete </span> this Teacher's info? </h4>
			</div>
			<div class="modal-body m-b-10">
				<div class="m-t-10">
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal" style="width: 86px;"> Close </a>
					<a href="#" class="btn btn-warning btn-sm" id="delete_modal" style="width: 86px;"> Delete </a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Subject Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		$('#delete_modal').attr('href','teachers-infolist.php?did='+id);
	});

</script>
<!--=*= |#| JS SCRIPT |#| =*=-->															