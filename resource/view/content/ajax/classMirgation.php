<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Class Data
if($_POST['action'] == "SelectClass")
{
	$selectFromClass = $_POST['fClass'];

	$columnName = $tableName = null;
	$columnName = "*";
	$tableName = "ems_classes";
	$fetchClassData = $eloquent->selectData($columnName, $tableName);

	$getFromClass = '';
	foreach($fetchClassData AS $key => $eachRow)
	{
		if($key == $selectFromClass)
		{
			$getFromClass = next($eachRow);
		}
	}

	if(!empty($getFromClass))
	{
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "ems_classes";
		$whereValue["class_name"] = $getFromClass;
		$getClassData = $eloquent->selectData($columnName, $tableName, $whereValue);

		echo '<option value="'. $getClassData[0]['id'] .'">'. $getClassData[0]['class_name'] .'</option>';
	}
	else
	{
		echo '<option> No records found </option>';
	}
}


#Fetch Table Data Content
if(@$_POST['action'] == "LOAD")
{
	$classID = $_POST['class_id'];
	$shiftID = $_POST['shift_id'];
	$columnName["1"] = "id";
	$columnName["2"] = "class_id";
	$columnName["3"] = "shift_id";
	$columnName["4"] = "student_id";
	$columnName["5"] = "first_name";
	$columnName["6"] = "last_name";
	$columnName["7"] = "roll_number";
	$tableName = "ems_students";
	$whereValue["class_id"] = $classID;
	$whereValue["shift_id"] = $shiftID;
	$fetchStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);

	if(!empty($fetchStudentData))
	{
		foreach($fetchStudentData AS $eachRow)
		{
			# FETCH CLASS DATA
			$columnName = $tableName = $whereValue = null;
			$columnName = "*";
			$tableName = "ems_classes";
			$whereValue["id"] = $eachRow['class_id'];
			$fetchClassData = $eloquent->selectData($columnName, $tableName, @$whereValue);
			$getClassName = $fetchClassData[0]['class_name'];

			# FETCH SHIFT DATA
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
				<td style=" padding:7px 8px;">'. $eachRow['roll_number'] .'</td>
				<td style=" padding:7px 8px;">'. $eachRow['student_id'] .'</td>
				<td style=" padding:7px 8px;">'. $getClassName .'</td>
				<td style=" padding:7px 8px;">'. $getShiftName .'</td>
			</tr>
			';
		}
	}
	else
	{
		echo '<tr> <td colspan="6" class="text-center text-secondary"> <strong> Oops! </strong> No matching records found. Please retry... </td> </tr>';
	}
}
## ===*=== [F]ETCH  DATA ===*=== ##
?>			