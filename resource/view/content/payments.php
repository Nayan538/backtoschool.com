<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	#Delete Payment Details Data	
	$tableName = $whereValue = null;
	$tableName = "ems_payments_details";
	$whereValue["payments_id"] = $_REQUEST['did'];
	$deletePaymentDetails = $eloquent->deleteData($tableName, @$whereValue);
	
	if(!empty($deletePaymentDetails))
	{
		#Delete Payment Data
		$tableName = $whereValue = null;
		$tableName = "ems_create_payments";
		$whereValue["id"] = $_REQUEST['did'];
		$deletePayment = $eloquent->deleteData($tableName, @$whereValue);		
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Payment Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_create_payments";
$fetchPaymentsData = $eloquent->selectData($columnName, $tableName);

#Fetch Organization Configuration Data
$columnName = $tableName = null;
$columnName["1"] = "currency";
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
## ===*=== [F]ETCH DATA END ===*=== ##
?>

<!--=*= |#| PAYMENTS CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">EMS <span style="font-weight: 300;">Payment Reports</span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="dashboard.php"> Accounts </a> </li>
						<li class="list-inline-item"> Payments </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-sm-9 col-12">
			</div>
			<div class="col-sm-3 col-12 text-right m-b-20">
				<a href="create-payment.php" class="btn btn-outline-dark btn-rounded float-right">
					<i class="fa fa-plus"></i> Create Payment
				</a>
			</div>
		</div>
		
		<?php
		#Insert Confirmation Message
		if(isset($_REQUEST['id']))
		{
			if(@$deletePayment > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong> The Payment ID is Deleted Successfully! </strong>
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
						<table class="cstmDatatable table table-hover table-sm custom-table" style="margin-top: 15px !important;">
							<thead>
								<tr>
									<th> # </th>
									<th> Payment ID </th>
									<th> Payee Name </th>
									<th> Payee Org </th>
									<th> Payee Email </th>
									<th> Payee Phone </th>
									<th> Total Amount </th>
									<th> Payment Date </th>
									<th> Payment Invoice </th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								
							<?php 
							#Table Data Content
							if(!empty($fetchPaymentsData))
							{
								$n = 1;
								foreach($fetchPaymentsData AS $eachPayment)
								{
									echo'
									<tr>
										<td class="font-weight-bold">'. $n .'</td>
										<td>'. $eachPayment['payment_id'] .'</td>
										<td>'. $eachPayment['payee_name'] .'</td>
										<td>'. $eachPayment['payee_org'] .'</td>
										<td>'. $eachPayment['payee_email'] .'</td>
										<td>'. $eachPayment['payee_phone'] .'</td>
										<td>'. $eachPayment['payee_address'] .'</td>
										<td>'. $currency .' '. $eachPayment['payment_grandtotal'] .'</td>
										<td>
											<a href="invoice.php?id='. $eachPayment['id'] .'" class="btn btn-sm btn-outline-success"> Generate Invoice </a>
										</td>
										<td class="text-center">
											<a data-id="'. $eachPayment['id'] .'" class="btn btn-sm btn-warning text-white deleteButton" data-toggle="modal" data-target="#delete_payments"> 
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
<!--=*= |#| PAYMENTS CONTENT |#| =*=-->

<!--=*= Delete Subject Confirmation =*=-->
<div id="delete_payments" class="modal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Do you want to delete this Payments info?</h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> 
						<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal"> Delete </a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Subject Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function() {
		var id = $(this).data('id');
		$('#delete_modal').attr('href','payments.php?did='+id);
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->