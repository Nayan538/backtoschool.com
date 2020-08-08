<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	$tableName = $whereValue = null;
	$tableName = "ems_exam_schedule";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteExaminationData = $eloquent->deleteData($tableName, $whereValue);	
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [I]INSERT DATA ===*=== ##
if(isset($_POST['addExamSchedule']))
{
	if(!empty($_POST['classFor']) && !empty($_POST['semesterFor']) && !empty($_POST['subjectFor']) && !empty($_POST['shiftFor']) && !empty($_POST['teacherName']) && !empty($_POST['startDateTime']) && !empty($_POST['endDateTime']))
	{
		$tableName = $columnValue = null;
		$tableName = "ems_exam_schedule";
		$columnValue["class_id"] = $_POST['classFor'];
		$columnValue["semester_id"] = $_POST['semesterFor'];
		$columnValue["subject_id"] = $_POST['subjectFor'];
		$columnValue["shift_id"] = $_POST['shiftFor'];
		$columnValue["teacher_id"] = $_POST['teacherName'];
		$columnValue["start_date_time"] = date('Y-m-d H:i:s a', strtotime($_POST['startDateTime']));
		$columnValue["end_date_time"] = date('Y-m-d H:i:s a', strtotime($_POST['endDateTime']));
		$columnValue["created_at"] = date('Y-m-d H:i:s');
		$insertExaminationData = $eloquent->insertData($tableName, $columnValue);
	}
}
## ===*=== [I]INSERT DATA ===*=== ##	


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

#Fetch Semester Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_semesters";
$fetchSemesterData = $eloquent->selectData($columnName, $tableName);

#Fetch Subject Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_subjects";
$fetchSubjectData = $eloquent->selectData($columnName, $tableName);

#Fetch Teacher's Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "first_name";
$columnName["3"] = "last_name";
$tableName = "ems_teachers";
$fetchTeacherData = $eloquent->selectData($columnName, $tableName);	

#Fetch Exam Schedule Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_exam_schedule";
$fetchExaminationData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#|  EXAMINATION SCHEDULE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Examination Schedule </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php"> Home </a></li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"><a href="#"> Examination </a></li>
						<li class="list-inline-item"> Exam Schedule </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card-box">

					<?php
					#Insert Confirmation Message
					if(isset($_POST['addExamSchedule']))
					{
						if(@$insertExaminationData > 0)
						{
							echo '
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong> Congratulation! </strong> A New Data is Added
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							';
						}
					}
					?>
					
					<form action="" method="post">
						<div class="row">
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style="padding-right: 48px;"> Class </label>
									</div>
									<select class="custom-select"  name="classFor">
										<option> Choose... </option>
										
										<?php
										foreach($fetchClassData AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['class_name'] .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style="padding-right: 19px;"> Semester </label>
									</div>
									<select class="custom-select" name="semesterFor">
										<option> Choose... </option>
										
										<?php
										foreach($fetchSemesterData AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['semester_name'] .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style="padding-right: 34px;"> Subject </label>
									</div>
									<select class="custom-select" name="subjectFor">
										<option> Choose.. </option>
										
										<?php
										foreach($fetchSubjectData AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['subject_name'] .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>						
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style="padding-right: 54px;"> Shift </label>
									</div>
									<select class="custom-select" name="shiftFor">
										<option> Choose... </option>
										
										<?php
										foreach($fetchShiftData AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['shift_name'] .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style="padding-right: 30px;"> Teacher </label>
									</div>
									<select class="custom-select" name="teacherName">
										<option> Choose... </option>
										
										<?php
										foreach($fetchTeacherData AS $eachRow)
										{
											@$teacherName = $eachRow[first_name] . ' ' . $eachRow[last_name];
											echo '<option value="'. $eachRow['id'] .'">'. $teacherName .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height:38px;">
										<label class="input-group-text"> Start Time </label>
									</div>
									<input class="form-control datepicker-here" type="text" data-timepicker="true" data-position='right bottom' data-language='en' name="startDateTime" style="height:38px;">
								</div>
							</div>						
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height: 38px;">
										<label class="input-group-text" style="padding-right: 20px;"> End Time </label>
									</div>
									<input class="form-control datepicker-here" type="text" data-timepicker="true" data-position='right bottom' data-language='en' name="endDateTime" style="height:38px;">
								</div>
							</div>
						</div>	
						<div class="col-sm-12 text-center mt-2">
							<button type="submit" class="btn btn-outline-success btn-sm mb-2" name="addExamSchedule" style="width:120px;">
								<i class="fa fa-plus-circle"></i> Save Data
							</button>						
							<button type="reset" class="btn btn-outline-dark btn-sm mb-2" style="width:120px;">
								<i class="fas fa-power-off"></i> Reset Data
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-8">
				<div class="content-page">
					
					<?php
					#Delete Confirmation Message
					if(isset($_REQUEST['did']))
					{
						if(@$deleteExaminationData > 0)
						{
							echo '
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong> Congratulation! </strong> A Data Deleted Successfully
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							';
						}
					}
					?>
					
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-sm table-hover cstmDatatable" style="margin-top: 15px !important;">
									<thead>
										<tr>
											<th style="width: 5%"> # </th>
											<th style="width: 18%"> Class </th>
											<th style="width: 32%"> Subject </th>
											<th style="width: 33%"> Teacher Name </th>
											<th style="width: 6%"> Details </th>
											<th style="width: 6%"> Action </th>
										</tr>
									</thead>
									<tbody>
										
									<?php
									#Table Data Content
									if(!empty($fetchExaminationData))
									{
										$n = 1;
										foreach($fetchExaminationData AS $eachRow)
										{
											#Get Name of The WeekDay
											$getDate = getDate(strtotime($eachRow['start_date_time']));
											$getDayName = $getDate['weekday'];
											
											#Fetch Class Data
											$columnName = $tableName = $whereValue = null;
											$columnName["1"] = "id";
											$columnName["2"] = "class_name";
											$tableName = "ems_classes";
											$whereValue["id"] = $eachRow['class_id'];
											$getClassName = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Fetch Semester Data
											$columnName = $tableName = $whereValue = null;
											$columnName["1"] = "id";
											$columnName["2"] = "semester_name";
											$tableName = "ems_semesters";
											$whereValue["id"] = $eachRow['semester_id'];
											$getSemesterName = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Fetch Subject Data
											$columnName = $tableName = $whereValue = null;
											$columnName["1"] = "id";
											$columnName["2"] = "subject_name";
											$columnName["3"] = "subject_code";
											$tableName = "ems_subjects";
											$whereValue["id"] = $eachRow['subject_id'];
											$getSubjectName = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Fetch Shift Data
											$columnName = $tableName = $whereValue = null;
											$columnName["1"] = "id";
											$columnName["2"] = "shift_name";
											$tableName = "ems_shifts";
											$whereValue["id"] = $eachRow['shift_id'];
											$getShiftName = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Fetch Teacher's Data
											$columnName = $tableName = $whereValue = null;
											$columnName["1"] = "first_name";
											$columnName["2"] = "last_name";
											$tableName = "ems_teachers";
											$whereValue["id"] = $eachRow['teacher_id'];
											$getTeacherData = $eloquent->selectData($columnName, $tableName, @$whereValue);
											$getTeacherName = $getTeacherData[0]['first_name'] . ' ' . $getTeacherData[0]['last_name'];
											
											echo '
											<tr>
												<td class="font-weight-bold">'. $n .'</td>
												<td>'. $getClassName[0]['class_name'] .'</td>
												<td>'. $getSubjectName[0]['subject_name'] .' 
													<span class="text-danger">['. $getSubjectName[0]['subject_code'] .']</span>
												</td>
												<td>'. @$getTeacherName .'</td>
												<td>
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
															<i class="fas fa-grip-vertical text-secondary"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-right">
															<div class="dropdown-item-custom">
																<h5 class="float-left"> <i class="far fa-dot-circle text-success pr-1"></i> Semester: </h5>
																<h5 class="float-right"> '. $getSemesterName[0]['semester_name'] .'</h5>
															</div> 																		
															<div class="dropdown-item-custom">
																<h5 class="float-left"> <i class="far fa-dot-circle text-success pr-1"></i> Shift: </h5>
																<h5 class="float-right"> '. $getShiftName[0]['shift_name'] .'</h5>
															</div> 																	
															<div class="dropdown-item-custom">
																<h5 class="float-left"> <i class="far fa-dot-circle text-success pr-1"></i> Day: </h5>
																<h5 class="float-right"> '. $getDayName .'</h5>
															</div>  
															<div class="dropdown-item-custom">
																<h5 class="float-left"> <i class="far fa-dot-circle text-success pr-1"></i> Start Date: </h5>
																<h5 class="float-right"> '. $ajaxcontrol->dateTime($eachRow['start_date_time']) .'</h5>
															</div>                                                 
															<div class="dropdown-item-custom">
																<h5 class="float-left"> <i class="far fa-dot-circle text-success  pr-1"></i> End Date: </h5>
																<h5 class="float-right"> '. $ajaxcontrol->dateTime($eachRow['end_date_time']) .'</h5>
															</div>
														</div>
													</div>
												</td>
												<td class="text-center">
													<button data-id="'. $eachRow['id'] .'" class="btn btn-outline-danger btn-sm deleteButton" data-toggle="modal" data-target="#delete_data">
														<i class="fas fa-trash"></i>
													</button>
												</td>
											</tr>
											';
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
	</div>
</div>
<!--=*= |#|  EXAMINATION SCHEDULE CONTENT |#| =*=-->

<!--=*= Delete Schedule Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to <span class="text-danger"> Delete </span> this Exam Schedule info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> <a href="#" class="btn btn-dark btn-sm" data-dismiss="modal" style="width: 86px;">Close</a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal" style="width: 86px;">Delete</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Schedule Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function(){
		var id = $(this).data('id');		
		$('#delete_modal').attr('href','exam-schedule.php?did='+id);
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->																	