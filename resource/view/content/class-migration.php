<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [R]EFRESH PAGE ===*=== ##
if(isset($_POST['refresh']))
{
	echo '<meta http-equiv="refresh" content="0;url='. $_SERVER['REQUEST_URI'] .'">';
}
## ===*=== [R]EFRESH PAGE ===*=== ##


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

#Fetch Student Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "class_id";
$columnName["3"] = "shift_id";
$columnName["4"] = "student_id";
$columnName["5"] = "first_name";
$columnName["6"] = "last_name";
$columnName["7"] = "roll_number";
$tableName = "ems_students";
$fetchStudentData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| CLASS MIGRATION CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">EMS <span style="font-weight: 300;"> Student Class Migration </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php"> Home </a></li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"><a href="#"> Students </a></li>
						<li class="list-inline-item"> Class Migration </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card-box">
					<form action="" method="post">
						<div class="row">
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text pr-4"> Select Shift </label>
									</div>
									<select class="custom-select" id="shift" required>
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
										<label class="input-group-text pr-4"> From Class </label>
									</div>
									<select class="custom-select" id="fromClass" required>
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
										<label class="input-group-text pr-2"> Migrate Class </label>
									</div>
									<select class="custom-select" id="migrateClass" required>
										<option> Choose... </option>										
									</select>
								</div>
							</div>
							<div class="col-sm-12 text-center mt-3">
								<button type="submit" class="btn btn-outline-success btn-sm mb-3" id="classMirgation">
									<i class="fa fa-plus-circle"></i> Migrate Class
								</button>						
								<button type="submit" class="btn btn-outline-dark btn-sm mb-3" name="refresh">
									<i class="fas fa-sync-alt"></i> Refresh Data
								</button>						
							</div>
						</div>	
					</form>				
				</div>
			</div>
			<div class="col-lg-8">
				<div class="content-page">			
					<div class="table-responsive">
						<table class="table table-sm table-hover table-striped custom-table">
							<thead>
								<tr>
									<th class="text-center" style="width: 10%; padding:7px 8px;"> 
										<button type="button" class="btn btn-sm btn-outline-success" id="clickID"> Confirm </button>
									</th>
									<th style="width: 35%; padding:7px 8px;"> Student Name </th>
									<th style="width: 10%; padding:7px 8px;"> Roll No </th>
									<th style="width: 15%; padding:7px 8px;"> Student ID </th>
									<th style="width: 15%; padding:7px 8px;"> Class </th>
									<th style="width: 15%; padding:7px 8px;"> Shift </th>
								</tr>								
							</thead>
							<tbody id="loadStudentData">
								
							<?php
							#Table Data Content
							if(!empty($fetchStudentData))
							{
								foreach($fetchStudentData AS $eachRow)
								{
									#Fetch Class Data
									$columnName = $tableName = $whereValue = null;
									$columnName = "*";
									$tableName = "ems_classes";
									$whereValue["id"] = $eachRow['class_id'];
									$fetchClassData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									$getClassName = $fetchClassData[0]['class_name'];
									
									#Fetch Shift Data
									$columnName = $tableName = $whereValue = null;
									$columnName = "*";
									$tableName = "ems_shifts";
									$whereValue["id"] = $eachRow['shift_id'];
									$fetchShiftData = $eloquent->selectData($columnName, $tableName, @$whereValue);
									$getShiftName = $fetchShiftData[0]['shift_name'];
									
									echo '
									<tr>
										<td class="text-center" style=" padding:7px 8px;"> 
											<input type="checkbox" class="form-check-input" value="'. $eachRow['id'] .'" style="width:18px; height:18px; margin-top: -8px;"> 
										</td>
										<td style=" padding:7px 8px;">'. $eachRow['first_name'] .' '.  $eachRow['last_name'] .'</td>
										<td style=" padding:7px 8px;" class="text-center font-weight-bold text-secondary">
											'. $eachRow['roll_number'] .'
										</td>
										<td style=" padding:7px 8px;">'. $eachRow['student_id'] .'</td>
										<td style=" padding:7px 8px;">'. $getClassName .'</td>
										<td style=" padding:7px 8px;">'. $getShiftName .'</td>
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
<!--=*= |#| CLASS MIGRATION CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->	
<script type="text/javascript">
	$(document).ready(function() {

		//Fetch Student Data
		$('#fromClass').on('change', function() {
			var fromClass = $(this).val();
			var classShift = $('#shift').val();
			var mClass = $('#migrateClass').val();
			
			if(classShift != ' ' || fromClass != ' ')
			{
				$.ajax({
					url: 'ajax/classMirgation.php',
					type: 'POST',
					data: {action: "LOAD", shift_id: classShift, class_id: fromClass},
					success: function(data) {
						$('#loadStudentData').html(data);
					}
				});
			}
		});


		//Get Default Migrate Class Data
		$('#fromClass').change(function(){
			var fClass = $(this).val();
			$.ajax({
				url: 'ajax/classMirgation.php',
				type: 'POST',
				data: {action: "SelectClass", fClass: fClass},
				success: function(data) {
					$('#migrateClass').html(data);
				}
			});
		});


		//Pull All The Student ID Value AS an Array
		$('#clickID').on('click', function(e) {
			var ID = [];
			
			$(':checkbox:checked').each(function(key){
				ID[key] = $(this).val();
				console.log(ID);
			});
		});		

	});	
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->