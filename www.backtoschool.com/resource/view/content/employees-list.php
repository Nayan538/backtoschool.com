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
	$tableName = "ems_employees";
	$whereValue["id"] = $_REQUEST['did'];
	$fetchDeleteData = $eloquent->selectData($columnName, $tableName, $whereValue);

	#Delete Data
	$tableName = $whereValue = null;
	$tableName = "ems_employees";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteEmployeeData = $eloquent->deleteData($tableName, $whereValue, $whereValue);
	
	if($deleteEmployeeData > 0)
	{
		#Remove The Previous Image from The Defined Directory
		unlink($GLOBALS['EMPLOYEES_IMAGE_DIRECTORY'] . $fetchDeleteData[0]['employee_image']);
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_employees";
$fetchEmployeesData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| EMPLOYEES LIST CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">All <span style="font-weight: 300;"> Employees List </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="#"> Home </a></li>
						<li class="list-inline-item"><a href="#"> Management </a></li>
						<li class="list-inline-item"> All Employees </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9 col-3"></div>
			<div class="col-sm-3 col-12 text-right m-b-20">
				<a href="add-employee.php" class="btn btn-outline-dark btn-rounded float-right"><i class="fa fa-plus"></i> Add Employee</a>
				<div class="view-icons">
					<a href="employees-grid.php" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
					<a href="employees-list.php" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
				</div>
			</div>
		</div>
		
		<?php
		#Delete Confirmation Message
		if(isset($_REQUEST['did']))
		{
			if($deleteEmployeeData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> Congratulation! A Employee Data is Deleted Successfully! </strong> 
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
						<table class="table table-sm custom-table cstmDatatable" style="margin-top: 15px !important;">
							<thead>
								<tr>
									<th> Name </th>
									<th> Employee ID </th>
									<th> Gender </th>
									<th> Email </th>
									<th> Mobile </th>
									<th> Join Date </th>
									<th> Academic Qualification </th>
									<th class="text-center"> Action </th>
								</tr>
							</thead>
							<tbody>

							<?php
							#Table Data Content
							if(!empty($fetchEmployeesData))
							{
								foreach($fetchEmployeesData AS $eachRow)
								{
							?>
								<tr>
									<td>
										<span class="avatar bg-warning">
											<?php echo $ajaxcontrol->nameIndex($eachRow['employee_first_name'], $eachRow['employee_last_name']) ?> 	
										</span>
										<h2> 
											<?php echo $eachRow['employee_first_name'] .' '. $eachRow['employee_last_name'] ?> <span> 
												
											<?php
											$columnName = $tableName = $whereValue = null;
											$columnName = "*";
											$tableName = "ems_designations";
											$whereValue["id"] = $eachRow['employee_desg_id'];
											$fetchDesignationData = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											echo $fetchDesignationData[0]['designation_name'];
											?> 
												
											</span> 
										</h2>
									</td>
									<td> <?php echo $eachRow['employee_id'] ?> </td>
									<td> <?php echo $eachRow['employee_gender'] ?> </td>
									<td> <?php echo $eachRow['employee_email'] ?>  </td>
									<td> <?php echo $eachRow['employee_phone_no'] ?> </td>
									<td class="font-weight-bold"> 
										<?php echo $ajaxcontrol->dateOnly($eachRow['employee_join_date']) ?> 
									</td>
									<td> <?php echo $eachRow['academic_certification'] ?> </td>
									<td class="text-right" >
										<a href="<?php echo 'edit-employee.php?id='. $eachRow['id']?>" class="btn btn-outline-secondary btn-sm">
											<i class="fas fa-user-edit"></i>
										</a>										
										<button type="submit" data-toggle="modal" data-id="<?php echo $eachRow['id']?>" data-target="#delete_employee" class="btn btn-outline-danger btn-sm deleteButton">
											<i class="fas fa-user-times"></i>
										</button>
									</td>
								</tr>
								
							<?php
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
<!--=*= |#| EMPLOYEES LIST CONTENT |#| =*=-->

<!--=*= Delete Employee Confirmation =*=-->
<div id="delete_employee" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Employee info? </h4>
			</div>
			<div class="modal-body m-b-10">
				<div class="m-t-10">
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal">Close</a>
					<a href="#" class="btn btn-warning btn-sm" id="delete_modal">Delete</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Employee Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function() {
		var id = $(this).data('id');
		$('#delete_modal').attr('href','employees-list.php?did='+id);
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->