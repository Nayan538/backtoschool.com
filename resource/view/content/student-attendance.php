<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addAttendance']))
{
	#Insert Attendance Data
	$tableName = $columnValue = null;
	$tableName = "ems_student_attendance";
	$columnValue["date"] = date('Y-m-d H:i:s');
	$columnValue["teacher_id"] = $_POST['teacherID'];
	$columnValue["class_id"] = $_POST['classID'];
	$columnValue["shift_id"] = $_POST['shiftID'];
	$columnValue["created_at"] = date('Y-m-d H:i:s');
	$insertStudentAttendanceData = $eloquent->insertData($tableName, $columnValue);

	#Insert Attendance Status Data
	if($insertStudentAttendanceData['LAST_INSERT_ID'] > 0)
	{
		for($i = 0; $i < count($_POST['attend']); $i++)
		{		
			$tableName = $columnValue = null;
			$tableName = "ems_student_attendance_status";
			$columnValue["attendance_id"] = $insertStudentAttendanceData['LAST_INSERT_ID'];
			$columnValue["student_id"] = $_POST['attenanceID'][$i];
			$columnValue["status"] = $_POST['attend'][$i];
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$insertStudentAttendanceStatusData = $eloquent->insertData($tableName, $columnValue);
		}
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Class Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_classes";
$fetchClassData = $eloquent->selectData($columnName, $tableName);

#Fetch Shift Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_shifts";
$fetchShiftData = $eloquent->selectData($columnName, $tableName);	

#Fetch Teacher's Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "first_name";
$columnName["3"] = "last_name";
$tableName = "ems_teachers";
$fetchtTeacherData = $eloquent->selectData($columnName, $tableName);

#Fetch Student Attendance Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_student_attendance";
$fetchtStudentAttendanceData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== #
?>

<!--=*= |#| STUDENT ATTENDANCE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">Student <span style="font-weight: 300;">Attendance Sheet</span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"> <a href="#"> Students </a> </li>
						<li class="list-inline-item"> Attendance </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-4">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text">
									<i class="fas fa-school fa-sm mr-1"></i> Class
								</label>
							</div>
							<select class="custom-select" id="classData" required>
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
					<div class="col-md-4">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text">
									<i class="fas fa-toggle-on mr-1"></i> Shift 
								</label>
							</div>
							<select class="custom-select" id="shiftData" required>
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
					<div class="col-md-4">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text">
									<i class="far fa-calendar-check mr-1"></i> Teacher 
								</label>
							</div>
							<select class="custom-select" id="teacherData" required>
								<option> Choose... </option>
								
								<?php
								foreach($fetchtTeacherData AS $eachTeacher)
								{
									$fullName = $eachTeacher['first_name'] .' '. $eachTeacher['last_name'];
									echo '<option value="'. $eachTeacher['id'] .'">'. $fullName .'</option>';
								}
								?>
								
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-outline-dark btn-rounded float-right" data-toggle="modal" data-target="#studentAttendance">
					<i class="fa fa-plus"></i> Today's Attendance
				</button>
			</div>
		</div>
		
		<?php
		#Insert Confirmation Message
		if(isset($_POST['addAttendance']))
		{
			if(@$insertStudentAttendanceData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Congratulation! </strong>A New Data is Added Successfully
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"> &times; </span>
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
						<table class="table table-sm table-hover table-bordered cstmDatatable" style="margin-top: 15px !important;">
							<thead>
								<tr>
									<th style="width: 5%"> # </th>
									<th style="width: 15%"> Date </th>
									<th style="width: 10%"> Class </th>
									<th style="width: 10%"> Shift </th>
									<th style="width: 20%"> Teacher Name </th>
									<th style="width: 18%"> Status </th>
									<th style="width: 8%"> Action </th>
									<th style="width: 14%"> Generate </th>
								</tr>								
							</thead>
							<tbody>

							<?php
							#Table Data Content
							if(!empty($fetchtStudentAttendanceData))
							{
								$n = 1;
								foreach ($fetchtStudentAttendanceData AS $eachRow) 
								{
									#Fetch Class Data
									$columnName = $tableName = $whereValue = null;
									$columnName = "*";
									$tableName = "ems_classes";
									$whereValue["id"] = $eachRow['class_id'];
									$fetchClassTableData = $eloquent->selectData($columnName, $tableName, @$whereValue);

									#Fetch Shift Data
									$columnName = $tableName = $whereValue = null;
									$columnName = "*";
									$tableName = "ems_shifts";
									$whereValue["id"] = $eachRow['shift_id'];
									$fetchShiftTableData = $eloquent->selectData($columnName, $tableName, @$whereValue);	

									#Fetch Teacher's Data
									$columnName = $tableName = $whereValue = null;
									$columnName["1"] = "id";
									$columnName["2"] = "first_name";
									$columnName["3"] = "last_name";
									$tableName = "ems_teachers";
									$whereValue["id"] = $eachRow['teacher_id'];
									$fetchtTeacherTableData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									$teacherName = $fetchtTeacherTableData[0]['first_name'] .' '. $fetchtTeacherTableData[0]['last_name'];

									#Fetch Present Attendance Status Data
									$columnName = $tableName = $whereValue = null;
									$columnName["1"] = "status";
									$tableName = "ems_student_attendance_status";
									$whereValue["status"] = 'present';
									$whereValue["attendance_id"] = $eachRow['id'];
									$fetchtPresentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									$presentCount = count($fetchtPresentData);

									#Fetch Absent Attendance Status Data
									$columnName = $tableName = $whereValue = null;
									$columnName["1"] = "status";
									$tableName = "ems_student_attendance_status";
									$whereValue["status"] = 'absent';
									$whereValue["attendance_id"] = $eachRow['id'];
									$fetchtAbsentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									$absentCount = count($fetchtAbsentData);

							?>
									
								<tr>
									<td class="font-weight-bold text-center"><?php echo $n ?></td>
									<td> <?php echo $ajaxcontrol->dateTime($eachRow['date']) ?> </td>
									<td> <?php echo $fetchClassTableData[0]['class_name'] ?> </td>
									<td> <?php echo $fetchShiftTableData[0]['shift_name'] ?> </td>
									<td> <?php echo $teacherName ?> </td>
									<td class="text-center">
										<div class="d-inline">
											<button type="button" class="btn btn-sm btn-outline-success" style="width: 86px; padding: 0px;">
												
												<?php 
												if(!empty($fetchtPresentData)) {
													echo $fetchtPresentData[0]['status'];
												} else {
													echo 'present';
												}
												?>

												<span class="badge badge-light"> <?php echo @$presentCount ?></span>
											</button>
											<button type="button" class="btn btn-sm btn-outline-danger" style="width: 86px; padding: 0px;">
												
												<?php 
												if(!empty($fetchtAbsentData)) {
													echo $fetchtAbsentData[0]['status'];
												} else {
													echo 'absent';
												}
												?> 

												<span class="badge badge-light"> <?php echo @$absentCount ?> </span>
											</button>
										</div>
									</td>
									<td class="text-center">
										<button type="button" class="btn btn-sm btn-outline-info" style="width: 56px; padding: 0px;">
											<i class="fas fa-file-pdf"></i> PDF
										</button>	
									</td>
									<td class="text-center">
										<form action="generate-attendance.php" method="post">
											<input type="hidden" name="id" value="<?php echo $eachRow['id']?>">	
											<button class="btn btn-sm btn-outline-secondary" style="width: 126px; padding: 0px;" name="generate">
												<i class="fas fa-file-import"></i> Generate Sheet
											</button>
										</form>
									</td>
								</tr>
									
							<?php
									$n++;
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
<!--=*= |#| STUDENT ATTENDANCE CONTENT |#| =*=-->

<!--=*= Add Attendance Data =*=-->
<div id="studentAttendance" class="modal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-body m-b-10">
					<div class="table-responsive">
						<table class="table table-sm table-hover custom-table">
							<thead>	
								<tr>
									<th colspan="5" style="border: none;">
										<div class="modal-title text-center text-light bg-secondary">
											<h3> 
												Student Attendance System &nbsp; | &nbsp; 
												<span style="font-weight: 300;"> Date: <?php echo date('Y-m-d') ?> </span>
											</h3>
										</div>
									</th>
								</tr>					
								<tr>
									<th style="width: 5%"> # </th>
									<th style="width: 40%"> Student Name </th>
									<th style="width: 15%"> Student ID </th>
									<th style="width: 15%"> Roll </th>
									<th style="width: 25%" class="text-center"> Attendance </th>
								</tr>								
							</thead>
							<tbody id="loadAttendanceData">		
								<!--=*= Load The Student Data =*=-->
							</tbody>
						</table>
					</div>
					<div class="text-center mt-5">
						<button class="btn btn-outline-success btn-sm" name="addAttendance" type="submit" style="width: 160px;">
							<i class="fa fa-plus-circle"></i> Add Attendance
						</button>
						<a href="#" class="btn btn-outline-dark btn-sm" data-dismiss="modal" style="width: 160px;"> 
							<i class="fa fa-power-off"></i> Close
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Add Attendance Data =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	$(document).ready(function() {
		
		//Fetch Student Data
		$('#teacherData').on('change', function(e) {
			e.preventDefault();
			var cName = $('#classData').val();
			var sName = $('#shiftData').val();
			var tName = $(this).val();
			
			$.ajax({
				url: 'ajax/studentAttendance.php',
				type: 'POST',
				data: {action: "YES", cName:cName, sName:sName, tName:tName},
				success: function(data) {
					$('#loadAttendanceData').html(data);
				}
			});
		});
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->