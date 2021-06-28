<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	$tableName = $whereValue = null;
	$tableName = "ems_class_routine";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteRoutineData = $eloquent->deleteData($tableName, $whereValue);	
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [I]INSERT DATA ===*=== ##
if(isset($_POST['addRoutine']))
{
	$tableName = $columnValue = null;
	$tableName = "ems_class_routine";
	$columnValue["day_name"] = $_POST['class_days'];
	$columnValue["class_id"] = $_POST['classFor'];
	$columnValue["subject_id"] = $_POST['subjectFor'];
	$columnValue["shift_id"] = $_POST['shiftFor'];
	$columnValue["teacher_id"] = $_POST['teacherName'];
	$columnValue["start_time"] = $_POST['startTime'];
	$columnValue["end_time"] = $_POST['endTime'];
	$columnValue["created_at"] = date('Y-m-d H:i:s');
	$insertRoutineData = $eloquent->insertData($tableName, $columnValue);
}
## ===*=== [I]INSERT DATA ===*=== ##	


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Class Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_classes";
$fetchClassData = $eloquent->selectData($columnName, $tableName);

#Fetch Subject Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_subjects";
$fetchSubjectData = $eloquent->selectData($columnName, $tableName);

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
$fetchTeacherData = $eloquent->selectData($columnName, $tableName);	

#Fetch Class Routine Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_class_routine";
$fetchRoutineData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| CLASS ROUTINE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Class Routine </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"> <a href="#"> Students </a> </li>
						<li class="list-inline-item"> Class Routine </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 card-box">
				
				<?php
				#Insert Confirmation Message
				if(isset($_POST['addRoutine']))
				{
					if(@$insertRoutineData > 0)
					{
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong> Congratulation! A New Data is Added Successfully </strong> 
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
									<label class="input-group-text" style="padding-right: 36px;"> Days </label>
								</div>
								<select class="custom-select" name="class_days" id="class_days">
									<option> Choose.. </option>
									
									<?php
									#Static DAY's Data
									$days = ['Friday', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];
									foreach($days AS $eachRow)
									{
										echo '<option value="'. $eachRow .'">'. $eachRow .'</option>';
									}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text" style="padding-right: 32px;"> Class </label>
								</div>
								<select class="custom-select"  name="classFor" id="classFor">
									<option> Choose.. </option>
									
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
									<label class="input-group-text" style="padding-right: 18px;"> Subject </label>
								</div>
								<select class="custom-select" name="subjectFor" id="subjectFor">
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
									<label class="input-group-text" style="padding-right: 36px;"> Shift </label>
								</div>
								<select class="custom-select" name="shiftFor" id="shiftFor">
									<option> Choose.. </option>
									
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
									<label class="input-group-text"> Teacher </label>
								</div>
								<select class="custom-select" name="teacherName" id="teacherName">
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
								<div class="input-group-prepend">
									<label class="input-group-text">
										<i class="far fa-clock mr-1"></i> Time
									</label>
									<input class="form-control only-time" type="text" data-language='en' name="startTime" id="startTime" placeholder="start time">
									<span></span>
									<input class="form-control only-time" type="text" data-language='en' name="endTime" id="endTime" placeholder="end time">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 text-center mt-3">
						<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="addRoutine" id="addRoutine" style="width:120px;">
							<i class="fa fa-plus-circle"></i> Save Data
						</button>						
						<button type="reset" class="btn btn-outline-dark btn-sm mb-3" style="width:120px;">
							<i class="fas fa-power-off"></i> Reset Data
						</button>
					</div>
				</form>
			</div>
			<div class="col-md-9">
				<div class="content-page">
					<div class="row">
						<div class="col-lg-12">
							
							<?php
							#Delete Confirmation Message
							if(isset($_REQUEST['did']))
							{
								if($deleteRoutineData > 0)
								{
									echo '
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong> Data Deleted Successfully! </strong>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									';
								}
							}
							?>

							<div class="table-responsive">
								<table class="table table-sm table-hover cstmDatatable custom-table" style="margin-top: 15px !important;">
									<thead>
										<tr>
											<th> # </th>
											<th> Days </th>
											<th> Class </th>
											<th> Subject </th>
											<th> Shift </th>
											<th> Teacher </th>
											<th> Time </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="searchData">
										
									<?php
									#Table Data Content
									if(!empty($fetchRoutineData))
									{
										$n = 1;
										foreach($fetchRoutineData AS $eachRow)
										{
											#Fetch Class Data
											$columnName = $tableName = $whereValue = null;
											$columnName = "*";
											$tableName = "ems_classes";
											$whereValue["id"] = $eachRow['class_id'];
											$getClassData = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Fetch Subject Data
											$columnName = $tableName = $whereValue = null;
											$columnName = "*";
											$tableName = "ems_subjects";
											$whereValue["id"] = $eachRow['subject_id'];
											$getSubjectData = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Fetch Shift Data
											$columnName = $tableName = $whereValue = null;
											$columnName = "*";
											$tableName = "ems_shifts";
											$whereValue["id"] = $eachRow['shift_id'];
											$getShiftData = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Modify Time as User Friendly
											$start = date('H:i A', strtotime($eachRow['start_time']));
											$end = date('H:i A', strtotime($eachRow['end_time']));
											
											#Fetch Teacher Data
											$columnName = $tableName = $whereValue = null;
											$columnName["1"] = "first_name";
											$columnName["2"] = "last_name";
											$tableName = "ems_teachers";
											$whereValue["id"] = $eachRow['teacher_id'];
											$fetchResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
											$getTeacherName = $fetchResult[0]['first_name'] . ' ' . $fetchResult[0]['last_name'];
											
											echo '
											<tr>
												<td class="font-weight-bold" style="padding: 3px 8px;">'. $n .'</td>
												<td style="padding: 3px 8px;">'. $eachRow['day_name'] .'</td>
												<td style="padding: 3px 8px;">'. $getClassData[0]['class_name'] .'</td>
												<td style="padding: 3px 8px;">'. $getSubjectData[0]['subject_name'] .'</td>
												<td style="padding: 3px 8px;">'. $getShiftData[0]['shift_name'] .'</td>
												<td style="padding: 3px 8px;">'. $getTeacherName .'</td>
												<td style="padding: 3px 8px;">'. $start . '<span class="text-danger font-weight-bold"> TO </span>' . $end .'</td>
												<td class="text-center" style="padding: 3px 8px;">
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
<!--=*= CLASS ROUTINE CONTENT END =*=-->

<!--=*= Delete Class Routine Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Do you want to <span class="text-danger"> Delete </span> this Class Routine info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> 
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal" style="width: 86px;"> Close </a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal" style="width: 86px;"> Delete </a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Class Routine Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->	
<script type="text/javascript">
	
	//Get The Requested Delete Class Routine ID
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		
		$('#delete_modal').attr('href','class-routine.php?did='+id);
	});
	

	//Prevent Submission if Data is Empty
	$(document).ready(function(){
		$('#addRoutine').on('click', function(e){
			var days = $('#class_days').val();
			var classes = $('#classFor').val();
			var subject = $('#subjectFor').val();
			var shift = $('#shiftFor').val();
			var teacher = $('#teacherName').val();
			var sTime = $('#startTime').val();
			var eTime = $('#endTime').val();
			
			if(days == '' || classes == '' || subject == '' || shift == '' || teacher == '' || sTime == '' || eTime == '') {
				e.preventDefault();
			} else {
				return true;
			}			
		});
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->	