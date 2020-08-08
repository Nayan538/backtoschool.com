<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/InvoiceValue.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
$getAmount = new InvoiceValue;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Get The Requested ID
if(isset($_REQUEST['id']))
{
	$_SESSION['PAYMENT_INVOICE_ID'] = $_REQUEST['id'];
}

#Fetch Payments Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_create_payments";
$whereValue["id"] = $_SESSION['PAYMENT_INVOICE_ID'];
$fetchPayments = $eloquent->selectData($columnName, $tableName, @$whereValue);

#Fetch Payment Details Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_payments_details";
$whereValue["payments_id"] = $fetchPayments[0]['id'];
$paymentDetails = $eloquent->selectData($columnName, $tableName, @$whereValue);

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
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| INVOICE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header printClose">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">Invoice</h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php"> Home </a></li>
						<li class="list-inline-item"><a href="payments.php"> Payments </a></li>
						<li class="list-inline-item"> Invoice </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7 col-8 text-left m-b-30">
				<div class="btn-group btn-group-sm">
					<button class="btn btn-white"> CSV </button>
					<button class="btn btn-white"> PDF </button>
					<button type="button" class="btn btn-white" onclick="print_current_page()" target="_blank">
						<i class="fa fa-print fa-lg"></i> Print
					</button>
				</div>
			</div>
			<div class="col-sm-5 col-4 text-right">
				<a href="payments.php" class="btn btn-primary btn-rounded"><i class="fa fa-undo"></i> Back to List</a>
			</div>
		</div>
		<div class="row" id="#section-to-print">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 m-b-20">
								<ul class="list-unstyled">
									<li><h4 class="text-uppercase"> Back to School</h4></li>
									<li>3864 Quiet Valley Lane,</li>
									<li>Sherman Oaks, CA, 91403</li>
								</ul>
							</div>
							<div class="col-sm-6 m-b-20">
								<div class="invoice-details">
									<h3 class="text-uppercase">Invoice# <?php echo $fetchPayments[0]['payment_id'] ?> </h3>
									<ul class="list-unstyled">
										<li>Payment Date: <span> <?php echo $fetchPayments[0]['created_at'] ?> </span></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-lg-7 m-b-20">
								<h5>Invoice to:</h5>
								<ul class="list-unstyled">
									<li>
										<h5>
											<strong>  <?php echo $fetchPayments[0]['payee_name'] ?> </strong>
										</h5>
									</li>
									<li>
									<span> <?php echo $fetchPayments[0]['payee_org'] ?> </span></li>
									<li> 
										<?php echo $fetchPayments[0]['payee_address'] ?> 
									</li>
									<li>
										<a href="tel:<?php echo $fetchPayments[0]['payee_email'] ?>"> 
											<?php echo $fetchPayments[0]['payee_phone'] ?>
										</a> 
									</li>
									<li>
										<a href="mailto:<?php echo $fetchPayments[0]['payee_email'] ?>"> 
											<?php echo $fetchPayments[0]['payee_email'] ?> 
										</a>
									</li>
								</ul>
							</div>
							<div class="col-sm-6 col-lg-5 m-b-20">
								
								<ul class="list-group list-group-flush">
									<li class="list-group-item">
										<b> Total Payment: </b>
										<span class="float-right mr-2">
											<?php echo $currency .' '. $fetchPayments[0]['payment_grandtotal'] ?>
										</span>
									</li>											
									<li class="list-group-item">
										<b> Bank name: </b>
										<span class="float-right mr-2"> <?php echo $fetchPayments[0]['bank_name'] ?> </span>
									</li>												
									<li class="list-group-item">
										<b> Account No:  </b>
										<span class="float-right mr-2"> <?php echo $fetchPayments[0]['bank_account_no'] ?> </span>
									</li>												
									<li class="list-group-item">
										<b> SWIft code: </b>
										<span class="float-right mr-2"> <?php echo $fetchPayments[0]['bank_swift_code'] ?> </span>
									</li>												
									<li class="list-group-item">
										<b> Branch: </b>
										<span class="float-right mr-2"> <?php echo $fetchPayments[0]['branch_name'] ?> </span>
									</li>											
									<li class="list-group-item">
										<b> Address:  </b>
										<span class="float-right mr-2"> <?php echo $fetchPayments[0]['bank_address'] ?> </span>
									</li>		
								</ul>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-sm table-hover">
								<thead>
									<tr>
										<th style="width: 5%" class="text-center">#</th>
										<th style="width: 25%">ITEM</th>
										<th style="width: 40%">DESCRIPTION</th>
										<th style="width: 10%" class="text-center">UNIT COST</th>
										<th style="width: 10%" class="text-center">QUANTITY</th>
										<th style="width: 10%" class="text-center">TOTAL</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
								#Table Data Content
								$n = 1;
								foreach($paymentDetails AS $eachDetails)
								{
									echo '
									<tr>
										<td class="text-center font-weight-bold">'. $n .'</td>
										<td>'. $eachDetails['item_name'] .'</td>
										<td>'. $eachDetails['item_description'] .'</td>
										<td class="text-center">'. $eachDetails['item_cost'] .'</td>
										<td class="text-center">'. $eachDetails['item_qty'] .'</td>
										<td class="text-center">'. $currency .' '. $eachDetails['item_amount'] .'</td>
									</tr>';
									$n++;
								}
								?>

								</tbody>
							</table>
						</div>
						<div>
							<div class="row invoice-payment">
								<div class="col-sm-7">
									<div class="mt-4">
										<h5> IN AMOUNT: 
											<span class="text-primary">
												<?php echo $getAmount->inAwords($fetchPayments[0]['payment_grandtotal']) .' TAKA ONLY'?>
											</span>
										</h5>
									</div>
									<div class="invoice-info mt-2">
										<h5 style="margin-bottom: -10px;">Other information</h5>
										<p> <?php echo $fetchPayments[0]['others_info'] ?> </p>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="m-b-20">
										
										<div class="table-responsive no-border">
											<table class="table m-b-0">
												<tbody>
													<tr>
														<th> Sub Total : </th>
														<td class="text-right">
															<?php echo $currency .' '. $fetchPayments[0]['payment_subtotal'] ?>
														</td>
													</tr>
													<tr>
														<th> Tax (%): </th>
														<td class="text-right">
															<?php echo $fetchPayments[0]['tax_total'] ?>
														</td>
													</tr>
													<tr>
														<th> Grand Total (incl. tax): </th>
														<td class="text-right text-primary">
															<h5>
																<?php echo $currency .' '. $fetchPayments[0]['payment_grandtotal'] ?>
															</h5>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<p class="text-muted text-center" style="margin-bottom: -10px;">
								copyright &copy; 2020 all rights reserved | Developed by: 
								<a href="//aamroni.info"> Abdullah Al Mamun Roni </a>
							</p>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| INVOICE CONTENT |#| =*=-->


<!--=*= |#| JS AND CSS SCRIPT |#| =*=-->
<script type="text/javascript">
	function print_current_page() {
		window.print();
	}
</script>

<style type="text/css">
	@media print 
	{
		#section-to-print, #section-to-print * {visibility: visible;}
		#section-to-print {position: absolute; left: 0; top: 0;}
	}
</style>
<!--=*= |#| JS AND CSS SCRIPT |#| =*=-->			