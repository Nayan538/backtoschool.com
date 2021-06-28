<?php
## ===*=== [O]bject DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]bject DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Teacher's Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "ems_teachers";
$fetchTeacherData = $eloquent->selectData($columnName, $tableName);
$totalTeacher = count($fetchTeacherData);	

#Fetch Student's Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "ems_students";
$fetchStudentData = $eloquent->selectData($columnName, $tableName);
$totalStudent = count($fetchStudentData);	

#Fetch Parent's Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "ems_parents";
$fetchParentsData = $eloquent->selectData($columnName, $tableName);
$totalParents = count($fetchParentsData);	

#Fetch Employee's Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "ems_employees";
$fetchEmployeesData = $eloquent->selectData($columnName, $tableName);
$totalEmployees = count($fetchEmployeesData);

#Fetch Total Payment's Data
$columnName = $tableName = null;
$columnName["1"] = "payment_grandtotal";
$tableName = "ems_create_payments";
$fetchPaymentsData = $eloquent->selectData($columnName, $tableName);
$totalPayments = sprintf('%.1f', $fetchPaymentsData[0]['payment_grandtotal']);

#Fetch Total Admission Fees Data
$columnName = $tableName = null;
$columnName["1"] = "total_fees_amount";
$tableName = "ems_admission_fees";
$fetchAdmissionFeesData = $eloquent->selectData($columnName, $tableName);

$totalAdmissionFees = 0;
for($i = 0; $i < count($fetchAdmissionFeesData); $i++)
{
	$totalAdmissionFees = $totalAdmissionFees + $fetchAdmissionFeesData[$i]['total_fees_amount'];
}

#Fetch Total Monthly Fees Data
$columnName = $tableName = null;
$columnName["1"] = "total_amount";
$tableName = "ems_monthly_fees";
$fetchMonthlyFeesData = $eloquent->selectData($columnName, $tableName);

$totalMonthlyFees = 0;
for($i = 0; $i < count($fetchMonthlyFeesData); $i++)
{
	$totalMonthlyFees = $totalMonthlyFees + $fetchMonthlyFeesData[$i]['total_amount'];
}

#Fetch Organization Configuration Data
$columnName = $tableName = null;
$columnName["1"] = "currency";
$columnName["2"] = "organization_name";
$tableName = "ems_org_config";
$fetchOrgConfigData = $eloquent->selectData($columnName, $tableName);

if(!empty($fetchOrgConfigData))
{
	if($fetchOrgConfigData[0]['currency'] == 'BDT')	{
		$currency = '&#2547';
	} else if ($fetchOrgConfigData[0]['currency'] == 'USD') {
		$currency = '&#36';
	} else if ($fetchOrgConfigData[0]['currency'] == 'EUR') {
		$currency = '&euro';
	}
}

#Fetch Attendance's Data
$columnName = $tableName = null;
$columnName["1"] = "status";
$tableName = "ems_student_attendance_status";
$fetchAttendanceData = $eloquent->selectData($columnName, $tableName);

$columnName = $tableName = $whereValue = null;
$columnName["1"] = "status";
$tableName = "ems_student_attendance_status";
$whereValue["status"] = "present";
$fetchPresentAttendanceData = $eloquent->selectData($columnName, $tableName, @$whereValue);

$getPresentData = ceil((count($fetchPresentAttendanceData) / count($fetchAttendanceData)) * 100);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| DASHBOARD CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-user-tie fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3 class="counter"> <?php echo $totalTeacher ?> </h3>
						<span> TEACHERS </span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-user-graduate fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3 class="counter"> <?php echo $totalStudent ?> </h3>
						<span> STUDENTS </span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-user-friends fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3 class="counter"> <?php echo $totalParents ?> </h3>
						<span> PARENTS </span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-users fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3 class="counter"> <?php echo $totalEmployees ?> </h3>
						<span> EMPLOYEES </span>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-file-invoice-dollar fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3> <span class="counter"> <?php echo $totalPayments ?> </span> <?php echo $currency ?> </h3>
						<span> TOTAL PAYMENTS </span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-wallet fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3> <span class="counter"> <?php echo $totalAdmissionFees ?> </span> <?php echo $currency ?> </h3>
						<span> TOTAL ADMISSION FEES </span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-vote-yea fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3> <span class="counter"> <?php echo $totalMonthlyFees ?> </span> <?php echo $currency ?> </h3>
						<span> TOTAL MONTHLY FEES </span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="dash-widget-icon"><i class="fas fa-clipboard-list fa-2x text-success"></i></span>
					<div class="dash-widget-info">
						<h3> <span class="counter"> <?php echo $getPresentData ?> </span> % </h3>
						<span> STUDENT ATTENDANCE </span>
					</div>
				</div>
			</div>
		</div>	

		<!--=*= Content Summary =*=-->
		<div class="row mt-4">
			<div class="col-sm-12">
				<h2 class="mb-3 text-center text-secondary font-weight-bold" style="font-size: 46px;"> 
					<?php echo strtoupper($fetchOrgConfigData[0]['organization_name']) ?>
				</h2>	
				<h3 class="text-center text-success"> A Complete Software Package of Education Management System </h3>
				<div class="row">
					<div class="col-sm-12 text-center text-danger" style="font-size: 30px;"> 
						<?php echo $control->ipCheck() ?> 
					</div>
					<div class="col-sm-12 text-center text-info" style="font-size: 30px;"> 
						<?php echo $control->hostCheck() ?> 
					</div>
				</div>
			</div>
		</div>
		<!--=*= Content Summary =*=-->

	</div>
</div>
<!--=*= |#| DASHBOARD CONTENT |#| =*=-->