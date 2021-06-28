<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addMonthlyFee']))
{
	$tableName = "ems_monthly_fees";
	$columnValue["student_id"] = $_POST['student'];
	$columnValue["month_name"] = $_POST['month'];
	$columnValue["date"] = date('Y-m-d', strtotime($_POST['month']));
	$columnValue["tution_fees"] = $_POST['tutionFee'];
	$columnValue["exam_fees"] = $_POST['examFee'];
	$columnValue["fines_deduction"] = $_POST['finesDeduct'];
	$columnValue["total_amount"] = $_POST['totalAmount'];
	$columnValue["created_at"] = date('Y-m-d H:i:s');
	$insertMonthlyFeesData = $eloquent->insertData($tableName, $columnValue);
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Student Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "first_name";
$columnName["3"] = "last_name";
$columnName["4"] = "student_id";
$tableName = "ems_students";
$fetchStudentData = $eloquent->selectData($columnName, $tableName);

#Fetch Organization Configuration Data
$columnName = $tableName = null;
$columnName["1"] = "currency";
$tableName = "ems_org_config";
$fetchOrgConfigData = $eloquent->selectData($columnName, $tableName);

if(!empty($fetchOrgConfigData))
{
	if($fetchOrgConfigData[0]['currency'] == 'BDT') {
		$currency = '&#2547';
	} else if ($fetchOrgConfigData[0]['currency'] == 'USD') {
		$currency = '&#36';
	} else if ($fetchOrgConfigData[0]['currency'] == 'EUR') {
		$currency = '&euro';
	}
}
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| ADMISSION FEES CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">EMS <span style="font-weight: 300;"> Student Monthly Fees</span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php">Home</a></li>
						<li class="list-inline-item"><a href="#">Accounts</a></li>
						<li class="list-inline-item"><a href="#">Student Fees</a></li>
						<li class="list-inline-item"> Monthly Fees </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="table-responsive card-box">
					<table class="table table-hover table-sm">
						<thead>
							<tr class="text-secondary">
								<th style="width: 25%;"> Student Name </th>
								<th style="width: 12%;"> Student ID </th>
								<th style="width: 6%;"> Roll No </th>
								<th style="width: 12%;"> Select Month </th>
								<th style="width: 10%; font-weight: 500;" class="text-info"> Tution Fee </th>
								<th style="width: 10%; font-weight: 500;" class="text-info"> Exam. Fee </th>
								<th style="width: 10%; font-weight: 500;" class="text-info"> Fines Deduction </th>
								<th style="width: 10%;" class="text-secondary"> Total Amount </th>
								<th style="width: 5%;" class="text-secondary"> Action </th>
							</tr>
						</thead>
						<tbody>
							<form action="" method="post">
								<tr id="form">
									<td> 
										<select class="custom-select" name="student" id="student" required>
											<option> Choose... </option>

											<?php
											foreach ($fetchStudentData AS $eachStudent) 
											{
												$fullName = $eachStudent['first_name'] .' '. $eachStudent['last_name'];
												echo '<option value="'. $eachStudent['id'] .'">'. $fullName .'</option>';
											}
											?>

										</select>
									</td>
									<td> 
										<input type="text" class="form-control bg-light" id="getID" value="" style="height: 38px;" readonly> 
									</td>
									<td> 
										<input type="text" class="form-control bg-light" id="getRoll" value="" style="height: 38px;" readonly>
									</td>
									<td> 
										<select class="custom-select" name="month" id="month" required>
											<option> Choose... </option>

											<?php
											$month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
											foreach ($month AS $eachMonth)
											{
												echo '<option value="'. $eachMonth .'">'. $eachMonth .'</option>';
											}
											?>

										</select>
									</td>
									<td> 
										<input type="text" class="form-control amount" name="tutionFee" style="height: 38px;">
									</td>
									<td> 
										<input type="text" class="form-control amount" name="examFee" style="height: 38px;">
									</td>
									<td>
										<input type="text" class="form-control amount" name="finesDeduct" style="height: 38px;">
									</td>
									<td> 
										<input type="text" class="form-control bg-light text-center font-weight-bold" name="totalAmount" id="totalAmount" value="" style="height: 38px;" readonly> 
									</td>
									<td class="text-right">
										<button type="submit" class="btn btn-outline-success" name="addMonthlyFee">
											<i class="fas fa-plus-circle fa-lg mt-1"></i> Add
										</button>
									</td>
								</tr>
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="content-page">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-hover table-sm cstmDatatable table-striped table-bordered text-center" style="margin-top: 15px !important;">
							<thead>
								<tr>
									<th style="width: 4%"> # </th>
									<th style="width: 16%"> Student Name </th>
									<th style="width: 10%"> Student ID </th>
									<th style="width: 5%"> Jan </th>
									<th style="width: 5%"> Feb </th>
									<th style="width: 5%"> Mar </th>
									<th style="width: 5%"> Apr </th>
									<th style="width: 5%"> May </th>
									<th style="width: 5%"> Jun </th>
									<th style="width: 5%"> Jul </th>
									<th style="width: 5%"> Aug </th>
									<th style="width: 5%"> Sep </th>
									<th style="width: 5%"> Oct </th>
									<th style="width: 5%"> Nov </th>
									<th style="width: 5%"> Dec </th>
									<th style="width: 10%" class="text-center font-weight-bold"> Total </th>
								</tr>
							</thead>
							<tbody>

							<?php
							#Table Data Content
							if(!empty($fetchStudentData))
							{
								$n = 1;
								foreach ($fetchStudentData AS $eachRow) 
								{
									#Fetch Monthly Fees Data
									$columnName = $tableName = $whereValue = null;
									$columnName = "*";
									$tableName = "ems_monthly_fees";
									$whereValue["student_id"] = $eachRow['id'];
									$fetchMonthlyFeesData = $eloquent->selectData($columnName, $tableName, @$whereValue);
							?>

								<tr>
									<td> <?php echo $n ?> </td>
									<td class="text-left"> <?php echo $eachRow['first_name'].' '.$eachRow['last_name'] ?> </td>
									<td> <?php echo $eachRow['student_id'] ?> </td>
									<td>
										<?php
										#Fetch January Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "January";
										$fetchJanuaryData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchJanuaryData[0]['tution_fees']))
										{
											if(!empty($fetchJanuaryData[0]['exam_fees']) || !empty($fetchJanuaryData[0]['fines_deduction']))
											{
												echo ($fetchJanuaryData[0]['tution_fees'] + $fetchJanuaryData[0]['exam_fees'] + $fetchJanuaryData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchJanuaryData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td> 
										<?php
										#Fetch February Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "February";
										$fetchFebruaryData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchFebruaryData[0]['tution_fees']))
										{
											if(!empty($fetchFebruaryData[0]['exam_fees']) || !empty($fetchFebruaryData[0]['fines_deduction']))
											{
												echo ($fetchFebruaryData[0]['tution_fees'] + $fetchFebruaryData[0]['exam_fees'] + $fetchFebruaryData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchFebruaryData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td> 
										<?php
										#Fetch March Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "March";
										$fetchMarchData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchMarchData[0]['tution_fees']))
										{
											if(!empty($fetchMarchData[0]['exam_fees']) || !empty($fetchMarchData[0]['fines_deduction']))
											{
												echo ($fetchMarchData[0]['tution_fees'] + $fetchMarchData[0]['exam_fees'] + $fetchMarchData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchMarchData[0]['tution_fees'];
											}
										}
										?>
									</td> 
									<td>
										<?php
										#Fetch April Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "April";
										$fetchAprilData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchAprilData[0]['tution_fees']))
										{
											if(!empty($fetchAprilData[0]['exam_fees']) || !empty($fetchAprilData[0]['fines_deduction']))
											{
												echo ($fetchAprilData[0]['tution_fees'] + $fetchAprilData[0]['exam_fees'] + $fetchAprilData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchAprilData[0]['tution_fees'];
											}
										}
										?>
									</td> 
									<td>
										<?php
										#Fetch May Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "May";
										$fetchMayData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchMayData[0]['tution_fees']))
										{
											if(!empty($fetchMayData[0]['exam_fees']) || !empty($fetchMayData[0]['fines_deduction']))
											{
												echo ($fetchMayData[0]['tution_fees'] + $fetchMayData[0]['exam_fees'] + $fetchJanuaryData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchMayData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td> 
										<?php
										#Fetch June Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "June";
										$fetchJuneData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchJuneData[0]['tution_fees']))
										{
											if(!empty($fetchJuneData[0]['exam_fees']) || !empty($fetchJuneData[0]['fines_deduction']))
											{
												echo ($fetchJuneData[0]['tution_fees'] + $fetchJuneData[0]['exam_fees'] + $fetchJuneData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchJuneData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td>
										<?php
										#Fetch July Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "July";
										$fetchJulyData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchJulyData[0]['tution_fees']))
										{
											if(!empty($fetchJulyData[0]['exam_fees']) || !empty($fetchJulyData[0]['fines_deduction']))
											{
												echo ($fetchJulyData[0]['tution_fees'] + $fetchJulyData[0]['exam_fees'] + $fetchJulyData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchJulyData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td>
										<?php
										#Fetch August Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "August";
										$fetchAugustData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchAugustData[0]['tution_fees']))
										{
											if(!empty($fetchAugustData[0]['exam_fees']) || !empty($fetchAugustData[0]['fines_deduction']))
											{
												echo ($fetchAugustData[0]['tution_fees'] + $fetchAugustData[0]['exam_fees'] + $fetchAugustData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchAugustData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td>
										<?php
										#Fetch September Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "September";
										$fetchSeptemberData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchSeptemberData[0]['tution_fees']))
										{
											if(!empty($fetchSeptemberData[0]['exam_fees']) || !empty($fetchSeptemberData[0]['fines_deduction']))
											{
												echo ($fetchSeptemberData[0]['tution_fees'] + $fetchSeptemberData[0]['exam_fees'] + $fetchSeptemberData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchSeptemberData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td>
										<?php
										#Fetch October Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "October";
										$fetchOctoberData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchOctoberData[0]['tution_fees']))
										{
											if(!empty($fetchOctoberData[0]['exam_fees']) || !empty($fetchOctoberData[0]['fines_deduction']))
											{
												echo ($fetchOctoberData[0]['tution_fees'] + $fetchOctoberData[0]['exam_fees'] + $fetchOctoberData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchOctoberData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td>
										<?php
										#Fetch November Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "November";
										$fetchNovemberData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchNovemberData[0]['tution_fees']))
										{
											if(!empty($fetchNovemberData[0]['exam_fees']) || !empty($fetchNovemberData[0]['fines_deduction']))
											{
												echo ($fetchNovemberData[0]['tution_fees'] + $fetchNovemberData[0]['exam_fees'] + $fetchNovemberData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchNovemberData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td>
										<?php
										#Fetch December Month's Fees Data
										$columnName = $tableName = $whereValue = null;
										$columnName = "*";
										$tableName = "ems_monthly_fees";
										$whereValue["student_id"] = $eachRow['id'];
										$whereValue["month_name"] = "December";
										$fetchDecemberData = $eloquent->selectData($columnName, $tableName, @$whereValue);

										if(!empty($fetchDecemberData[0]['tution_fees']))
										{
											if(!empty($fetchDecemberData[0]['exam_fees']) || !empty($fetchDecemberData[0]['fines_deduction']))
											{
												echo ($fetchDecemberData[0]['tution_fees'] + $fetchDecemberData[0]['exam_fees'] + $fetchDecemberData[0]['fines_deduction']);
											}
											else
											{
												echo $fetchDecemberData[0]['tution_fees'];
											}
										}
										?>
									</td>
									<td class="text-center font-weight-bold text-secondary"> 

										<?php 
										$grandTotal = $ajaxcontrol->sumArray('total_amount', 'ems_monthly_fees', 'student_id', $eachRow['id']);

										if($grandTotal[0]['total'] > 0)
										{
											echo $grandTotal[0]['total'] .' '. $currency;
										}

										?>

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
<!--=*= |#| ADMISSION FEES CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	$(document).ready(function() {

		/* =*= get the calculation value on keyup =*= */
		$('#month').on('change', function(){
			$('#form').on('keyup', function(){
				totalAmount();
			});
		});

		/* =*= calculation function for each =*= */
		var totalAmount = function(){
			var sum = 0;
			$('.amount').each(function(){
				var num = $(this).val();
				if(num != '') {
					sum += parseFloat(num);
				}
			});
			$('#totalAmount').val(sum);
		}

		/* =*= get each student id and roll no =*= */
		$('#student').on('change', function(){
			var studentID = $(this).val();

			$.ajax({
				url: 'ajax/examMarkSheet.php',
				type: 'POST',
				data: {action: "STUDENTID", student:studentID},
				success: function(data) {
					document.getElementById('getID').value = data;
				}   
			}); 

			$.ajax({
				url: 'ajax/examMarkSheet.php',
				type: 'POST',
				data: {action: "ROLLNO", student:studentID},
				success: function(data) {
					document.getElementById('getRoll').value = data;
				}   
			});
		});
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->