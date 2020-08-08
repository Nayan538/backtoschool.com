<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	#Delete Subject Based Marks Data
	$tableName = $whereValue = null;
	$tableName = "ems_exam_marks_subjects";
	$whereValue["marks_sheet_id"] = $_REQUEST['did'];
	$deleteExamMarksSubjectData = $eloquent->deleteData($tableName, $whereValue);		
	
	#Deleted MarkSheet Data
	if(!empty($deleteExamMarksSubjectData))
	{
		$tableName = $whereValue = null;
		$tableName = "ems_exam_marksheet";
		$whereValue["id"] = $_REQUEST['did'];
		$deleteExamMarkSheetData = $eloquent->deleteData($tableName, $whereValue);
	}
}
## ===*=== [D]ELETE DATA ===*=== ##
		

## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addMarkSheet']))
{
	#Insert MarkSheet Data
	$tableName = $columnValue = null;
	$tableName = "ems_exam_marksheet";
	$columnValue["student_id"] = $_POST['student'];
	$columnValue["class_id"] = $_POST['class'];
	$columnValue["shift_id"] = $_POST['shift'];
	$columnValue["semester_id"] = $_POST['semester'];
	$columnValue["exam_year"] = $_POST['examYear'];
	$columnValue["total_marks"] = $_POST['markTotal'];
	$columnValue["created_at"] = date('Y-m-d H:i:s');
	$insertExamMarkSheetData = $eloquent->insertData($tableName, $columnValue);
	
	#Insert Subject Based Marks Data
	if(@$insertExamMarkSheetData['LAST_INSERT_ID'] > 0)
	{
		for($i = 0; $i < count($_POST['subjectValue']); $i++)
		{
			$tableName = $columnValue = null;
			$tableName = "ems_exam_marks_subjects";
			$columnValue["marks_sheet_id"] = $insertExamMarkSheetData['LAST_INSERT_ID'];
			$columnValue["subject_id"] = $_POST['subjectID'][$i];
			$columnValue["subject_marks"] = $_POST['subjectValue'][$i];
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$insertExamMarksData = $eloquent->insertData($tableName, $columnValue);
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

#Fetch Student Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "first_name";
$columnName["3"] = "last_name";
$tableName = "ems_students";
$fetchStudentsData = $eloquent->selectData($columnName, $tableName);	

#Fetch Exam MarkSheet Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_exam_marksheet";
$fetchExamMarkSheetData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| EXAM MARK SHEET CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Examination MarkSheet </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"> <a href="#"> Examination </a> </li>
						<li class="list-inline-item"> Exam Mark Sheet </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="content-page">
			<div class="row">
				<div class="col-md-12">
					
					<?php
						#INSERT CONFIRMATION MESSAGE
						if(isset($_POST['addMarkSheet']))
						{
							if(@$insertExamMarkSheetData > 0)
							{
								echo '
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong> Congratulation! A New Data is Added Successfully </strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true"> &times; </span>
									</button>
								</div>
								';
							}
						}
					?>
					
					<form action="" method="post">
						<div class="row">
							<div class="col-md-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style="padding-right:76px;"> Class </label>
									</div>
									<select class="custom-select className" name="class" required>
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
							<div class="col-md-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text"> Semester </label>
									</div>
									<select class="custom-select" name="semester" required>
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
							<div class="col-md-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style="padding-right:32px;"> Shift </label>
									</div>
									<select class="custom-select shift" name="shift" required>
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
							<div class="col-md-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height:38px;">
										<label class="input-group-text"> Exam Year </label>
									</div>
									<input type="text" class="form-control bg-white" name="examYear" value="<?php echo date('Y')?>" readonly style="height:38px;">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text"> Student Name </label>
									</div>
									<select class="custom-select" name="student" id="student" required> 
										<option> Choose... </option>
									</select>
								</div>
							</div>							
							<div class="col-md-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height:38px;">
										<label class="input-group-text"> Roll No </label>
									</div>
									<input type="text" class="form-control bg-white" name="rollNo" id="getRoll" value="" readonly style="height:38px;">
								</div>
							</div>							
							<div class="col-md-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height:38px;">
										<label class="input-group-text"> Student ID </label>
									</div>
									<input type="text" class="form-control bg-white" name="studentID" id="getID" value="" readonly style="height:38px;">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="table-responsive">
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan='13' class="text-center text-success"> Subject Based Marks Input </th>
									</tr>
									<tr>
										
										<?php
										$inputCount = count($fetchSubjectData);
										$inputWidth = (80 / $inputCount);
										
										foreach($fetchSubjectData AS $eachSubject)
										{
											echo '<th style="width:'. $inputWidth.'%' .'">'. $eachSubject['subject_name'] .'</th>';
										}
										?>
										
										<th style="width:8%"> Total Marks </th>
										<th style="width:2%"> Action </th>
									</tr>
								</thead>
								<tbody id="addRow">
									<tr>
										
										<?php
										foreach($fetchSubjectData AS $eachData)
										{
											echo '
												<td> 
													<input class="form-control marks" name="subjectValue[]" type="text"> 
													<input class="form-control" name="subjectID[]" value="'.$eachData['id'].'" type="hidden">
												</td>
											';
										}
										?>
										
										<td> <input class="form-control" id="totalMark" name="markTotal" type="text" readonly> </td>
										<td class="text-center">
											<button class="btn btn-outline-success btn-sm text-right" name="addMarkSheet" type="submit">
												<i class="far fa-plus-square fa-2x"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="content-page mt-3">
			<div class="row">
				<div class="col-lg-12">
					
					<?php
					#DELETE CONFIRMATION MESSAGE
					if(isset($_REQUEST['did']))
					{
						if(@$deleteExamMarkSheetData > 0)
						{
							echo '
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong> Congratulation! A Exam Mark Sheet Data is Deleted Successfully </strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true"> &times; </span>
								</button>
							</div>
							';
						}
					}
					?>
					
					<div class="table-responsive">
						<table class="table table-sm table-hover table-bordered cstmDatatable custom-table" style="margin-top: 15px !important;">
							<thead>
								<tr>
									<th style="width:4%"> # </th>
									<th style="width:10%"> SID </th>
									<th style="width:18%"> Name </th>
									
									<?php
									$columnCount = count($fetchSubjectData);
									$columnWidth = (50 / $columnCount);
									
									foreach($fetchSubjectData AS $eachRow)
									{
										echo '<th style="'. $columnWidth.'%' .'"> C-'. $eachRow['subject_code'] .' </th>';
									}
									?>
									
									<th style="width:10%"> Total Marks </th>
									<th style="width:5%"> CGPA </th>
									<th style="width:3%"> Action </th>
								</tr>								
							</thead>
							<tbody>
								
							<?php
							if(!empty($fetchExamMarkSheetData))
							{
								$n = 1;
								foreach($fetchExamMarkSheetData AS $eachRow)
								{
									#Fetch Student Data
									$columnName = $tableName = $whereValue = null;
									$columnName["1"] = "id";
									$columnName["2"] = "student_id";
									$columnName["3"] = "first_name";
									$columnName["4"] = "last_name";
									$tableName = "ems_students";
									$whereValue["id"] = $eachRow['student_id'];
									$getStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);		
									
									#Fetch Exam MarkSheet Subject Data
									$columnName = $tableName = $whereValue = null;
									$columnName = "*";
									$tableName = "ems_exam_marks_subjects";
									$whereValue["marks_sheet_id"] = $eachRow['id'];
									$getSubjectMarksData = $eloquent->selectData($columnName, $tableName, @$whereValue);	
									
									#Fetch Exam Grade Data
									$columnName = $tableName = null;
									$columnName = "*";
									$tableName = "ems_exam_grades";
									$getExamGradeData = $eloquent->selectData($columnName, $tableName);
									
									#Get CGPA Based on Exam Grade Data
									$data = $eachRow['total_marks'] / count($getSubjectMarksData);
									$data = sprintf('%.0f', $data);
									
									$cGpa = '';
									foreach($getExamGradeData AS $eachGrade)
									{
										if($data >= $eachGrade['marks_from'] && $data <= $eachGrade['marks_upto'])
										{
											$cGpa = $eachGrade['grade_name'];
										}
									}
									
									
									echo '
									<tr class="text-center">
										<td class="font-weight-bold" style="padding: 3px; 8px;">'. $n .'</td>
										<td class="text-success font-weight-bold" style="padding: 3px; 8px;">'. $getStudentData[0]['student_id'] .'</td>
										<td class="text-left text-secondary font-weight-bold" style="padding: 3px; 8px;">
											'. $getStudentData[0]['first_name'] .' '. $getStudentData[0]['last_name'] .'
										</td>
									';
										
										foreach($getSubjectMarksData AS $eachSubject)
										{
											echo '<td class="text-secondary font-weight-bold" style="padding: 3px; 8px;">'. $eachSubject['subject_marks'] .'</td>';
										}
										
									echo '
										<td class="font-weight-bold" style="padding: 3px; 8px;">'. $eachRow['total_marks'] .'</td>
										<td class="font-weight-bold text-info" style="font-size:16px; padding: 3px; 8px;">'. $cGpa .'</td> 
										<td style="padding: 3px; 8px;">
											<a data-id="'. $eachRow['id'] .'" class="btn btn-sm btn-outline-danger deleteButton" data-toggle="modal" href="#delete_data">
												<i class="fas fa-trash"></i>
											</a>	
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
<!--=*= |#| EXAM MARK SHEET CONTENT |#| =*=-->

<!--=*= Delete MarkSheet Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to <span class="text-danger"> Delete </span> this Exam Marksheet info? </h4>
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
<!--=*= Delete MarkSheet Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	
	$(document).ready(function(){
		
		//Get The Requested Delete Shift ID
		$('.deleteButton').click(function() {
			var id = $(this).data('id');
			$('#delete_modal').attr('href','exam-marksheet.php?did='+id);
		});
		
		
		//Auto Calculation Function
		var totalMarks = function() {
			var sum = 0;
			$('.marks').each(function() {
				var num = $(this).val();
				if(num != 0) {
					sum += parseFloat(num);
				}
			});
			$('#totalMark').val(sum);
		}
		
		
		//Get The Calculation Value on Keyup
		$('#addRow').on('keyup', function() {		
			totalMarks();
		});
		

		//Fetch Student Data
		$('.shift').change(function() {
			var shiftID = $(this).val();
			var classID = $('.className').val();
			
			if(classID != '' || shiftID != '') {
				$.ajax({
					url: 'ajax/examMarkSheet.php',
					type: 'POST',
					data: {action: "YES", class_id: classID, shift_id: shiftID},
					success: function(data) {
						$('#student').html(data);
					}
				});
			}
		});	
		
		
		//Fetch Student ID and Roll No Data
		$('#student').change(function() {
			var studentID = $(this).val();

			$.ajax({
				url: 'ajax/examMarkSheet.php',
				type: 'POST',
				data: {action: "STUDENTID", student:studentID},
				success: function(studentid) {
					console.log(studentid);
					document.getElementById('getID').value = studentid;
				}   
			});	
			
			$.ajax({
				url: 'ajax/examMarkSheet.php',
				type: 'POST',
				data: {action: "ROLLNO", student:studentID},
				success: function(data) {
					console.log(data);
					document.getElementById('getRoll').value = data;
					
				}   
			});
		});	
		
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->																														