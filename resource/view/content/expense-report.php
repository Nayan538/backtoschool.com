<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Stock Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_payments_details";
$fetchStockData = $eloquent->selectData($columnName, $tableName);	

#Fetch Organization Configuration Data
$columnName = $tableName = null;
$columnName["1"] = "currency";
$tableName = "ems_org_config";
$fetchOrgConfigData = $eloquent->selectData($columnName, $tableName);

#Get Defined Currency
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

<!--=*= |#| EXPENSES CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Stock in Purchase </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php">Home</a></li>
						<li class="list-inline-item"><a href="#">Accounts</a></li>
						<li class="list-inline-item">Expenses</li>
					</ul>
				</div>
			</div>
		</div>	
		<div class="content-page">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="cstmDatatable table table-hover table-sm custom-table" style="margin-top: 15px !important;">
							<thead>
								<tr>
									<th style="width: 5%"> # </th>
									<th style="width: 18%"> Item </th>
									<th style="width: 30%"> Item Description </th>
									<th style="width: 15%"> Purchase Date </th>
									<th style="width: 10%"> Price </th>
									<th style="width: 10%"> Qty. </th>
									<th style="width: 12%"> Total </th>
								</tr>
							</thead>
							<tbody>

							<?php
							#Table Data Content
							if(!empty($fetchStockData))
							{
								$n = 1;
								foreach($fetchStockData AS $eachRow)
								{
									echo '
									<tr>
										<td>
											<span class="badge badge-pill badge-secondary" style="width: 30px; padding: 10px 0px; margin: 0px 2px;">'. $n .'</span>
										</td>
										<td>'. $eachRow['item_name'] .'</td>
										<td>'. $eachRow['item_description'] .'</td>
										<td>'. $eachRow['created_at'] .'</td>
										<td>'. $currency .' '. $eachRow['item_cost'] .'</td>
										<td class="font-weight-bold">'. $eachRow['item_qty'] .'</td>
										<td>'. $currency .' '. $eachRow['item_amount'] .'</td>
									</tr>';
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
<!--=*= |#| EXPENSES CONTENT |#| =*=-->