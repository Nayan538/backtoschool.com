<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['save_payments']))
{
	#Payment ID Generate
	$paymentID = 'EMSP-' . rand(1000, 9999);
	
	#Insert Payment Data
	$tableName = $columnValue = null;
	$tableName = "ems_create_payments";
	$columnValue["payment_id"] = $paymentID;
	$columnValue["payee_name"] = $_POST['payeeName'];
	$columnValue["payee_org"] = $_POST['orgName'];
	$columnValue["payee_email"] = $_POST['emailID'];
	$columnValue["payee_phone"] = $_POST['phone'];
	$columnValue["payee_address"] = $_POST['payeeAddress'];
	$columnValue["bank_name"] = $_POST['bankName'];
	$columnValue["bank_account_no"] = $_POST['accountNo'];
	$columnValue["bank_swift_code"] = $_POST['swiftNo'];
	$columnValue["branch_name"] = $_POST['branchNo'];
	$columnValue["bank_address"] = $_POST['branchAddress'];
	$columnValue["tax_total"] = $_POST['tax'];
	$columnValue["others_info"] = $_POST['payment_description'];
	$columnValue["created_at"] = date('Y-m-d H:i:s');
	$createPayment = $eloquent->insertData($tableName, $columnValue);
	
	if($createPayment['NO_OF_ROW_INSERTED'] > 0)
	{
		if($_POST['finalTotal'] > 1)
		{
			#Insert Payment Item Details Data
			for($i = 0; $i < $_POST['finalTotal']; $i++)
			{
				$item_name = $_POST['itemName'];
				$item_description = $_POST['itemDescription'];
				$item_cost = $_POST['unitCost'];
				$item_qty = $_POST['itemQty'];
				$item_total = $_POST['itemTotal'];
				
				$tableName = $columnValue = null;
				$tableName = "ems_payments_details";
				$columnValue["payments_id"] = $createPayment['LAST_INSERT_ID'];
				$columnValue["item_name"] = $item_name[$i];
				$columnValue["item_description"] = $item_description[$i];
				$columnValue["item_cost"] = $item_cost[$i];
				$columnValue["item_qty"] = $item_qty[$i];
				$columnValue["item_amount"] = $item_total[$i];
				$columnValue["created_at"] = date('Y-m-d H:i:s');
				$paymentDetails = $eloquent->insertData($tableName, $columnValue);
			}	
			
			#Calculation for Item SubTotal and GrandTotal
			$tax = $_POST['tax'];

			$subTotal = array_sum($item_total);
			if($tax) {
				$grandTotal = $subTotal + floatval(($subTotal * $tax)/100);
			} else {
				$grandTotal = $subTotal;
			}
			
			#Update The Last Insert Data
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_create_payments";
			$columnValue["payment_subtotal"] = $subTotal;
			$columnValue["payment_grandtotal"] = $grandTotal;
			$columnValue["updated_at"] = date('Y-m-d H:i:s');
			$whereValue["id"] = $createPayment['LAST_INSERT_ID'];
			$updatePayment = $eloquent->updateData($tableName, $columnValue, @$whereValue);
		}
		else
		{
			$itemName = $_POST['itemName'][0];
			$itemDescription = $_POST['itemDescription'][0];
			$itemCost = $_POST['unitCost'][0];
			$itemQty = $_POST['itemQty'][0];
			$itemTotal = $_POST['itemTotal'][0];
			
			$tableName = $columnValue = null;
			$tableName = "ems_payments_details";
			$columnValue["payments_id"] = $createPayment['LAST_INSERT_ID'];
			$columnValue["item_name"] = $itemName;
			$columnValue["item_description"] = $itemDescription;
			$columnValue["item_cost"] = $itemCost;
			$columnValue["item_qty"] = $itemQty;
			$columnValue["item_amount"] = $itemTotal;
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$paymentDetails = $eloquent->insertData($tableName, $columnValue);
			
			#Calculation for Item SubTotal and GrandTotal
			$tax = $_POST['tax'];

			$subTotal = $itemTotal;
			if($tax) {
				$grandTotal = $subTotal + floatval(($subTotal * $tax)/100);
			} else {
				$grandTotal = $subTotal;
			}
			
			#Update The Last Insert Data
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_create_payments";
			$columnValue["payment_subtotal"] = $subTotal;
			$columnValue["payment_grandtotal"] = $grandTotal;
			$columnValue["updated_at"] = date('Y-m-d H:i:s');
			$whereValue["id"] = $createPayment['LAST_INSERT_ID'];
			$updatePayment = $eloquent->updateData($tableName, $columnValue, @$whereValue);
		}
	}
}
?>

<!--=*= |#| CREATE PAYMENT CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Create Payment </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Accounts </a> </li>
						<li class="list-inline-item"> <a href="payments.php"> Payments </a> </li>
						<li class="list-inline-item"> Create Payment </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="content-page">
			<div class="row">
				<div class="col-sm-12">
					<form action="" method="post">
						<div class="row mb-2">
							<div class="col-md-12 mb-1">
								<h5>Invoice To</h5>
							</div>
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Payee Name </label>
									</div>
									<input type="text" class="form-control" name="payeeName">
								</div>
							</div>									
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Org Name </label>
									</div>
									<input type="text" class="form-control" name="orgName">
								</div>
							</div>					
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Email ID </label>
									</div>
									<input type="email" class="form-control" name="emailID">
								</div>
							</div>									
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text pr-4"> Phone No </label>
									</div>
									<input type="text" class="form-control" name="phone">
								</div>
							</div>	
							<div class="col-md-8 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text pr-4"> Address </label>
									</div>
									<input type="text" class="form-control" name="payeeAddress">
								</div>
							</div>									
						</div>
						<div class="row mb-2">
							<div class="col-md-12 mb-1">
								<h5>Bank Details</h5>
							</div>
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Bank Name </label>
									</div>
									<input type="text" class="form-control" name="bankName">
								</div>
							</div>									
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Account </label>
									</div>
									<input type="text" class="form-control" name="accountNo">
								</div>
							</div>									
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> SWIFT </label>
									</div>
									<input type="text" class="form-control" name="swiftNo">
								</div>
							</div>									
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Branch No. </label>
									</div>
									<input type="text" class="form-control" name="branchNo">
								</div>
							</div>									
							<div class="col-md-8 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Address </label>
									</div>
									<input type="text" class="form-control" name="branchAddress">
								</div>
							</div>																	
						</div>
						<div class="row mb-2">
							<div class="col-md-12 mb-1">
								<h5>TAX and Others Charge Details</h5>
							</div>							
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> TAX (%) </label>
									</div>
									<input type="number" class="form-control" min="1" name="tax" step="any" id="tax">
								</div>
							</div>
						</div>
						<div class="row mb-2">
							<div class="col-md-12 mb-1">
								<h5>Payment Details</h5>
							</div>
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Trasaction Method </label>
									</div>
									<select class="custom-select"  name="classFor">
										<option>Choose..</option>
										<option value="CASH"> CASH </option>
										<option value="BANK"> BANK </option>
									</select>
								</div>
							</div>							
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Payment By </label>
									</div>
									<select class="custom-select"  name="classFor">
										<option>Choose..</option>
										<option value="Al Mamun Roni"> Al Mamun Roni </option>
										<option value="Jhon Doe"> Jhon Doe </option>
									</select>
								</div>
							</div>							
							<div class="col-md-4 mb-1">
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text"> Designation </label>
									</div>
									<select class="custom-select"  name="classFor">
										<option>Choose..</option>
										<option value="Al Mamun Roni"> Al Mamun Roni </option>
										<option value="Jhon Doe"> Jhon Doe </option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="table-responsive">
									<table class="table table-hover table-sm">
										<thead>
											<tr>
												<th style="width:2%"> # </th>
												<th style="width:25%"> ITEM </th>
												<th style="width:45%"> DESCRIPTION </th>
												<th style="width:10%"> UNIT COST </th>
												<th style="width:10%"> QTY. </th>
												<th style="width:10%"> Amount </th>
												<th style="width:2%"> </th>
											</tr>
										</thead>
										<tbody id="addRow">
											<tr id="row_id">
												<td> <i class="fas fa-file-alt fa-lg mt-2 pt-1"></i> </td>
												<td>
													<input class="form-control" name="itemName[]" id="itemName1" type="text">
												</td>
												<td>
													<input class="form-control" name="itemDescription[]" id="itemDescription1" type="text">
												</td>
												<td>
													<input class="form-control" name="unitCost[]" id="unitCost1" type="text">
												</td>
												<td>
													<input class="form-control" name="itemQty[]" id="itemQty1" type="text">
												</td>												
												<td>
													<input class="form-control" name="itemTotal[]" id="itemTotal1" readonly>
												</td>
												<td>
													<a href="javascript:void(0)" class="text-success text-right" name="add" id="addMore">
														<i class="fas fa-plus-circle fa-2x mt-1"></i>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="row">
									<div class="col-sm-8">	
										<div class="form-group">
											<label>Other Information</label>
											<textarea name="payment_description" class="form-control" id="summerOne"></textarea>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card-body">
											<ul class="list-group list-group-flush">
												<li class="list-group-item">
													<b>Sub Total</b>
													<span class="float-right font-weight-bold mr-2" id="subTotal"></span>
												</li>
												<li class="list-group-item">
													<b>TAX (%)</b>
													<span class="float-right font-weight-bold mr-2" id="total_tax"></span>
												</li>																
												<li class="list-group-item">
													<b>Grand Total (incl. tax)</b>
													<span class="float-right font-weight-bold mr-2" id="grandTotal"></span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="text-center m-t-20 mb-3">
							<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="save_payments">
								<i class="fa fa-plus-circle"></i> Create Payment
							</button>						
							<button type="reset" class="btn btn-outline-dark btn-sm mb-3">
								<i class="fa fa-plus-circle"></i> Reset Payment
							</button>
							<input type="hidden" name="finalTotal" id="finalTotal" value="1">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| CREATE PAYMENT CONTENT |#| =*=-->					


<!--=*= |#| JS SCRIPT |#| =*=-->		
<script type="text/javascript">
	$(document).ready(function(){
		
		//Pull The Value as Text
		var getsubTotal = $('#subTotal').text();
		var getgrandTotal = $('#grandTotal').text();
		var n = 1;
		
		
		//Row Appending Option to Insert a New Data
		$(document).on('click', '#addMore', function() {
			n++;
			
			//This ID Will Hold The Number of Rows
			$('#finalTotal').val(n);
			
			var tableRow = '';
			tableRow += '<tr id="row_id'+ n +'">';
			tableRow +='<td><i class="fas fa-file-alt fa-lg mt-2 pt-1"></i></td>';
			tableRow +='<td><input class="form-control" name="itemName[]" id="itemName'+ n +'" type="text"></td>';
			tableRow +='<td><input class="form-control" name="itemDescription[]" id="itemDescription'+ n +'" type="text"></td>';
			tableRow +='<td><input class="form-control" name="unitCost[]" id="unitCost'+ n +'" type="text"></td>';
			tableRow +='<td><input class="form-control" name="itemQty[]" id="itemQty'+ n +'" type="text"></td>';
			tableRow +='<td><input class="form-control" name="itemTotal[]" id="itemTotal'+ n +'" readonly></td>';
			tableRow +='<td><a href="javascript:void(0)" class="text-danger remove" id="'+ n +'" name="remove"><i class="fas fa-minus-circle fa-2x mt-1"></i></a></td>';
			tableRow +='</tr>';
			
			//On Click Append a New Row Where It's Called
			$('#addRow').append(tableRow);
		});
		
		
		//Delete Each Row Where It's Called And Remove Also The Values
		$(document).on('click', '.remove', function() {
			var deleteRow = $(this).attr('id');
			var item_sub_total = $('#subTotal').text();
			var each_item_total = $('#itemTotal' + deleteRow).val();
			var result_amount = parseFloat(item_sub_total) - parseFloat(each_item_total);

			$('#subTotal').text(result_amount);
			$('#grandTotal').text(result_amount);
			$('#row_id' + deleteRow).remove();
			n--;
			$('#finalTotal').val(n);
		});
		
		
		//Calculation Function For Each Rows Total
		function getTotal(n) {
			var item_subTotal = 0;
			var item_grandTotal = 0;
			var inclTax = 0;

			for (i = 1; i <= n; i++) {
				var unitcost = 0;
				var item_qty = 0;
				var item_total = 0;
				var total_amount = 0;
				
				//Count Item Qty.
				item_qty = $('#itemQty' + i).val();

				if(item_qty > 0) {
					unitCost = $('#unitCost' + i).val();

					if(unitCost > 0) {
						item_total = parseFloat(item_qty) * parseFloat(unitCost);
						
						//Calculate Item Total
						total_amount = $('#itemTotal' + i).val(item_total);
						item_subTotal = parseFloat(item_subTotal) + parseFloat(item_total);
					}
				}
				
				//Calculate TAX
				var tax = $('#tax').val();
				if(tax > 0) {
					inclTax = parseFloat(item_subTotal) + (parseFloat(tax) * parseFloat(item_subTotal) / 100);
				} else {
					inclTax = parseFloat(item_subTotal).toFixed(2);
				}
			}
			
			//Pass All The Calculated Values Into The Defined ID
			$('#subTotal').text(item_subTotal);
			$('#total_tax').text(tax);
			$('#grandTotal').text(inclTax);
		}
		
		//Get The Grand Total Value On Keyup
		$(document).keyup(function() {
			getTotal(n);
		});

	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->		