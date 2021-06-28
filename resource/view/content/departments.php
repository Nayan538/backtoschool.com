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
	$tableName = "ems_departments";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteDepartmentData = $eloquent->deleteData($tableName, $whereValue);
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addDepartment']))
{
	if(!empty($_POST['deptName']))
	{
		$tableName = $columnValue = null;
		$tableName = "ems_departments";
		$columnValue["department_name"] = $_POST['deptName'];
		$columnValue["created_at"] = date('Y-m-d H:i:s');
		$insertDepartmentData = $eloquent->insertData($tableName, $columnValue);
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$fetchDepartmentData = $ajaxcontrol->fetchAsc('ems_departments', 'department_name');
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| DEPARTMENT CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">EMS <span style="font-weight: 300;"> Department </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a></li>
						<li class="list-inline-item"> <a href="#"> Management </a></li>
						<li class="list-inline-item"> <a href="#"> Employees </a></li>
						<li class="list-inline-item"> Department </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-md-12">
				
				<?php
				#Insert Confirmation Message
				if(isset($_POST['addDepartment']))
				{
					if(@$insertDepartmentData > 0)
					{
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong> A New Department is Added Successfully! </strong>
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
						<div class="col-md-10">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text"> Department </label>
								</div>
								<input type="text" class="form-control" name="deptName">
							</div>
						</div>						
						<div class="col-sm-2 text-center">
							<button type="submit" class="btn btn-outline-success btn-sm" name="addDepartment" style="padding: 9px 12px; margin-top: 0px;">
								<i class="fa fa-plus-circle"></i> Add Department
							</button>
						</div>
					</div>	
				</form>
			</div>	
			<div class="col-md-12">
				
				<?php
				#Delete Confirmation Message
				if(isset($_REQUEST['did']))
				{
					if(@$deleteDepartmentData > 0)
					{
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong> A Department is Deleted Successfully! </strong>
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
						<div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-sm table-hover table-striped cstmDatatable" style="margin-top: 15px !important;">
									<thead>
										<tr>
											<th style="width: 10%"> # </th>
											<th style="width: 80%"> Department Name </th>
											<th style="width: 10%" class="text-center"> Action </th>
										</tr>
									</thead>
									<tbody>
										
									<?php
									#Table Data Content
									if(!empty($fetchDepartmentData))
									{
										$n = 1;
										foreach($fetchDepartmentData AS $eachRow)
										{
											echo '
											<tr>
												<td class="font-weight-bold">'. $n .'</td>
												<td>'. $eachRow['department_name'] .'</td>
												<td class="text-center">
													<button data-id="'. $eachRow['id'] .'" class="btn btn-outline-danger btn-sm delete" data-toggle="modal" data-target="#delete_data">
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
<!--=*= |#| DEPARTMENT CONTENT |#| =*=-->

<!--=*= Delete Department Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Department info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> <a href="#" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal"> Delete </a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Department Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	//Get The Requested Delete Shift ID
	$('.delete').click(function(){
		var id = $(this).data('id');
		
		$('#delete_modal').attr('href','departments.php?did='+id);
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->