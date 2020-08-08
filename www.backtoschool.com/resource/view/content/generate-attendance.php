<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Logo's Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_icons";
$fetchLogo = $eloquent->selectData($columnName, $tableName);
$getLogo = $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogo[0]['app_logo'];	

#Fetch Organization Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_org_config";
$fetchOrgInfo = $eloquent->selectData($columnName, $tableName);

#Fetch Student's Attendance Data
if(isset($_POST['generate']))	
{
	$_SESSION['STUDENT_ATTENDACNE_SHEET_ID'] = $_POST['id'];
}

$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_student_attendance";
$whereValue["id"] = $_SESSION['STUDENT_ATTENDACNE_SHEET_ID'];
$fetchtStudentAttendanceData = $eloquent->selectData($columnName, $tableName, $whereValue);
## ===*=== [F]ETCH DATA ===*=== #
?>

<!--=*= |#| GENERATE ATTENDANCE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> Attendance <span style="font-weight: 300;"> Sheet Generate </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"> <a href="#"> Students </a> </li>
						<li class="list-inline-item"> Generate Attendance </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="content-page">
			<div class="row" id="print">
				<div class="col-lg-10 offset-lg-1">
					
					<?php
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
							$fetchClassData = $eloquent->selectData($columnName, $tableName, @$whereValue);
							
							#Fetch Shift Data
							$columnName = $tableName = $whereValue = null;
							$columnName = "*";
							$tableName = "ems_shifts";
							$whereValue["id"] = $eachRow['shift_id'];
							$fetchShiftData = $eloquent->selectData($columnName, $tableName, @$whereValue);    
							
							#Fetch Teacher's Data
							$columnName = $tableName = $whereValue = null;
							$columnName["1"] = "id";
							$columnName["2"] = "first_name";
							$columnName["3"] = "last_name";
							$tableName = "ems_teachers";
							$whereValue["id"] = $eachRow['teacher_id'];
							$fetchTeacherData = $eloquent->selectData($columnName, $tableName, @$whereValue);
							$teacherName = $fetchTeacherData[0]['first_name'] .' '. $fetchTeacherData[0]['last_name'];
							
							#Fetch Attendance Status Data
							$columnName = $tableName = $whereValue = null;
							$columnName = "*";
							$tableName = "ems_student_attendance_status";
							$whereValue["attendance_id"] = $eachRow['id'];
							$fetchAttendanceStatusData = $eloquent->selectData($columnName, $tableName, @$whereValue);	
					?>
						
						<div class="row mt-1">
							<div class="col-md-12 mb-4">
								<div class="float-right">
									<a href="student-attendance.php" class="btn btn-sm btn-outline-dark" style="width: 96px;"> 
										<i class="fas fa-undo-alt"></i> Back 
									</a>
									<button type="button" id="docPrint" class="btn btn-sm btn-outline-warning" style="width: 96px;"> 
										<i class="fas fa-print"></i> Print 
									</button>
								</div>
							</div>
							<div class="col-md-8">
								<div>
									<h3 style="letter-spacing: 3px;" class="text-uppercase"> 
										<?php echo $fetchOrgInfo[0]['organization_name'] ?> 
									</h3>
									<div> 
										<a href="<?php echo $fetchOrgInfo[0]['website_url'] ?> " target="_blank">
											<?php echo $fetchOrgInfo[0]['website_url'] ?> 
										</a>
									</div>
									<div class="text-secondary"> <?php echo $fetchOrgInfo[0]['org_address'] ?> </div>
								</div>
								<img src="<?php echo $getLogo ?>" alt="" class="img-fluid" height="20%" width="20%">
							</div>
							<div class="col-md-4">
								<ul class="list-group mb-4">
									<li class="list-group-item active text-center text-uppercase"> Attendance Overview </li>
									<li class="list-group-item">
										<span class="float-left font-weight-bold text-secondary"> Date: </span> 
										<span class="float-right"> <?php echo $ajaxcontrol->dateTime($eachRow['date']) ?> </span>
									</li>
									<li class="list-group-item">
										<span class="float-left font-weight-bold text-secondary"> Class: </span> 
										<span class="float-right"> <?php echo $fetchClassData[0]['class_name'] ?>  </span> 
									</li>
									<li class="list-group-item"> 
										<span class="float-left font-weight-bold text-secondary"> Shift: </span> 
										<span class="float-right"> <?php echo $fetchShiftData[0]['shift_name'] ?> </span> 
									</li>
									<li class="list-group-item"> 
										<span class="float-left font-weight-bold text-secondary"> Teacher: </span> 
										<span class="float-right"> <?php echo $teacherName ?> </span> 
									</li>
								</ul>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-sm table-hover table-bordered custom-table" style="">
								<thead>                           
									<tr class="text-center text-secondary">
										<th> # </th>
										<th> Student ID </th>
										<th> Student Name </th>
										<th> Roll No </th>
										<th> Status </th>
									</tr>                               
								</thead>
								<tbody>
									
								<?php
								#Table Data Content
								$n = 1;
								foreach($fetchAttendanceStatusData AS $eachStudent)
								{
									$columnName = $tableName = $whereValue = null;
									$columnName["1"] = "id";
									$columnName["2"] = "student_id";
									$columnName["3"] = "first_name";
									$columnName["4"] = "last_name";
									$columnName["5"] = "roll_number";
									$tableName = "ems_students";
									$whereValue["id"] = $eachStudent['student_id'];
									$fetchtStudentTableData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									$studentName = $fetchtStudentTableData[0]['first_name'] .' '. $fetchtStudentTableData[0]['last_name'];
								?>
								
								
								<tr class="text-center" style="height: 38px;">
									<td class="font-weight-bold" style=" padding:0px 8px;"> <?php echo $n ?> </td>
									<td style=" padding:0px 8px;"> <?php echo $fetchtStudentTableData[0]['student_id'] ?> </td>
									<td class="text-left" style=" padding: 0px 8px;"> <?php echo $studentName ?> </td>
									<td style="padding:0px 8px;"> 
										<span class="avatar bg-dark" style="float: none; height: 28px; width: 28px; line-height: 28px;"> 
											<?php echo $fetchtStudentTableData[0]['roll_number'] ?>	
										</span> 
									</td>
									<td style="padding:0px 8px;"> 

										<?php
										if($eachStudent['status'] == 'present') 
										{
											echo '<button class="btn btn-sm btn-success" style="width: 86px; padding: 0px;">'. $eachStudent['status'] .'</button>';
										}														
										if($eachStudent['status'] == 'absent')
										{
											echo '<button class="btn btn-sm btn-danger" style="width: 86px; padding: 0px;">'. $eachStudent['status'] .'</button>';
										}
										?>
										
									</td>
								</tr>
								
								<?php
									$n++;
								}
								?>
									
								</tbody>
							</table>
						</div>
						
					<?php
						}
					}
					?>
					
					<div class="mt-5">
						<p class="text-muted text-center">
							copyright &copy; 2020 all rights reserved 
							<img class="rounded-circle mr-3 ml-3" src="public/assets/img/aamroni.png" width="30px" height="30px">
							developed by: <a href="//aamroni.info"> Abdullah Al Mamun Roni </a>
						</p>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| GENERATE ATTENDANCE CONTENT |#| =*=-->											