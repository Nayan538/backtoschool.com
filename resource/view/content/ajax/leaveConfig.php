<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Http/Controllers/AjaxController.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_POST['action_delete']))
{
	$del_id = $_POST['id'];
	$deleteLeaveConfig = $ajaxcontrol->deleteData('ems_leave_config', $del_id);
	
	if($deleteLeaveConfig > 0) {
		echo 1;
	} else {
		echo 0;
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [U]PDATE DATA ===*=== ##
if(@$_POST['action'] == "leaveUpdate")
{
	@$updateId = $_POST['id'];
	@$updateDay = $_POST['day'];
	@$updateStatus = $_POST['status'];
	
	$tableName = "ems_leave_config";
	$columnValue["days"] = $updateDay;
	$columnValue["status"] = $updateStatus;
	$whereValue["id"] = $updateId;
	$updateLeaveData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	
	if($updateLeaveData > 0) {
		echo 1;
	} else {
		echo 0;
	}
}
## ===*=== [U]PDATE DATA ===*=== ##


## ===*=== [E]DIT DATA ===*=== ##
if(isset($_POST['action_data']))
{
	$edit_id = $_REQUEST['id'];
	$fetchLeaveData = $ajaxcontrol->getData('ems_leave_config', $edit_id);
	
	if($fetchLeaveData > 0)
	{
?>
	<div class="modal-body">
		<form>
			<div class="row">
				<div class="col-md-12 mb-3">
					<div class="form-row">
						<div class="col-md-5">
							<div class="form-group-prepend">
								<label class="input-group-text">
									<i class="fas fa-text-height text-info mr-3"></i> 
									<span> Leave Type </span>
								</label>
							</div>
						</div>
						<div class="col-md-7">
							<input class="form-control" id="edit_id" type="hidden" value="<?php echo $fetchLeaveData[0]['id'] ?>">
							<select class="form-control custom-select m-bot15" id="edit_type">
								<option> <?php echo $fetchLeaveData[0]['type'] ?> </option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12 mb-3">
					<div class="form-row">
						<div class="col-md-5">
							<div class="form-group-prepend">
								<span class="input-group-text" id="basic-addon1">
									<i class="fas fa-calendar-day text-info mr-3"></i> 
									<span style="padding-right: 22px;"> Days </span>
								</span>
							</div>
						</div>
						<div class="col-md-7">
							<input type="text" min="1" class="form-control" id="edit_day" value="<?php echo $fetchLeaveData[0]['days'] ?>" aria-describedby="basic-addon1">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-row">
						<div class="col-md-5">
							<div class="form-group-prepend">
								<label class="input-group-text">
									<i class="fas fa-toggle-on text-info mr-2 fa-lg"></i> 
									<span> Status </span>
								</label>
							</div>
						</div>
						<div class="col-md-7">
							<select class="form-control custom-select m-bot15" id="edit_status">
								<option <?php if($fetchLeaveData[0]['status'] == "Active") echo "selected"; ?>>Active</option>
								<option <?php if($fetchLeaveData[0]['status'] == "Inactive") echo "selected"; ?>>Inactive</option>
							</select>
						</div>
					</div>
				</div>
			</div>	
			<div class="col-sm-12 text-center mt-4">
				<button type="submit" class="btn btn-outline-success btn-sm mb-3" id="updateData">
					<i class="fas fa-edit"></i> Update &amp; Leave
				</button>
			</div>
		</form>
	</div>
	
<?php
	}
}
## ===*=== [E]DIT DATA ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addLeave']) == "YES")
{
	@$type = $_POST['type'];
	@$day = $_POST['day'];
	@$status = $_POST['status'];
	
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_leave_config";
	$whereValue["type"] = @$type;
	$fetchExistingData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	if(empty($fetchExistingData))
	{
		$tableName = $columnValue = null;
		$tableName = "ems_leave_config";
		$columnValue["type"] = $type ;
		$columnValue["days"] = $day ;
		$columnValue["status"] = $status ;
		$columnValue["created_at"] = date('Y-m-d H:i:s');
		$insertLeaveConfig = $eloquent->insertData($tableName, $columnValue);
		
		if($insertLeaveConfig['LAST_INSERT_ID'] > 0) {
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 2;
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
if(@$_POST['action'] == "loadLeaveData")
{
	$columnName = "*";
	$tableName = "ems_leave_config";
	$fetchLeaveData = $eloquent->selectData($columnName, $tableName);

	if($fetchLeaveData > 0)
	{
		$n = 1;
		foreach($fetchLeaveData AS $eachRow)
		{
?>
	<tr>
		<td class="font-weight-bold text-secondary" style="padding: 3px 8px;"> <?= $n ?> </td>
		<td class="font-weight-bold" style="padding: 3px 8px;"> <?= $eachRow['type'] ?> </td>
		<td style="padding: 3px 8px;"> <?= $eachRow['days'] ?> Days</td>
		<td style="padding: 3px 8px;">
			
			<?php
			if($eachRow["status"] == 'Active')
			{
				echo'<button class="btn btn-outline-success btn-rounded btn-sm" style="width: 96px; height: 26px; padding: 0px;">
						'. $eachRow["status"] .'
					</button>';
			}						
			if($eachRow["status"] == 'Inactive')
			{
				echo'<button class="btn btn-outline-danger btn-rounded btn-sm" style="width: 96px; height: 26px; padding: 0px;">
						'. $eachRow["status"] .'
					</button>';
			}
			?>

		</td>
		<td class="text-right d-flex" style="padding: 3px 8px;">
			<button data-eid="<?= $eachRow['id'] ?>" class="btn btn-outline-secondary btn-sm mr-1" id="editData">
				<i class="fas fa-edit"></i>
			</button>
			<button type="button" data-did="<?= $eachRow['id'] ?>" class="btn btn-outline-danger btn-sm delete">
				<i class="fas fa-trash"></i>
			</button>
		</td>
	</tr>
		
<?php
			$n++;
		}
	}
}
## ===*=== [F]ETCH DATA ===*=== ##
?>