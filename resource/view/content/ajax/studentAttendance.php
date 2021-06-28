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


## ===*=== [F]ETCH DATA ===*=== ##
@$cName = $_POST['cName'];
@$sName = $_POST['sName'];
@$tName = $_POST['tName'];


if($_POST['action'] == "YES")
{	
	$columnName = $tableName = $whereValue = null;
	$columnName["1"] = "id";
	$columnName["2"] = "student_id";
	$columnName["3"] = "first_name";
	$columnName["4"] = "last_name";
	$columnName["5"] = "roll_number";
	$tableName = "ems_students";
	$whereValue["class_id"] = $cName;
	$whereValue["shift_id"] = $sName;
	$fetchStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	if(!empty($fetchStudentData))
	{
		$n = 1;
		$a = 0;
		foreach($fetchStudentData AS $eachRow)
		{
			$fullName = $eachRow['first_name'] . ' ' . $eachRow['last_name'];
			
			echo '
			<tr>
				<td class="font-weight-bold">'. $n .'</td>
				<td>'. $fullName .'</td>
				<td>'. $eachRow['student_id'] .'</td>
				<td>'. $eachRow['roll_number'] .'</td>
				<td class="text-right" >
					<div class="form-inline">
						<input type="radio" class="form-check-input" name="attend['. $a .']" value="present" style="width:18px; height:18px; margin-top: -0.5px;">
						<label class="form-check-label mr-3"> Present </label>
						<input type="radio" class="form-check-input" name="attend['. $a .']" value="absent" style="width:18px; height:18px; margin-top: -0.5px;">
						<label class="form-check-label"> Absent </label>
					</div>
					<input type="hidden" name="attenanceID[]" value="'. $eachRow['id'] .'">
					<input type="hidden" name="classID" value="'. $cName .'">
					<input type="hidden" name="shiftID" value="'. $sName .'">
					<input type="hidden" name="teacherID" value="'. $tName .'">
				</td>
			</tr>
			';
			$n++;
			$a++;
		}
	}
}
## ===*=== [F]ETCH DATA ===*=== ##
?>