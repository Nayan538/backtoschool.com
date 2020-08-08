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
#Fetch Student Name
if(@$_POST['action'] == "YES")
{
	$classID = $_POST['class_id'];
	$shiftID = $_POST['shift_id'];
	
	$columnName = $tableName = $whereValue = null;
	$columnName[1] = "id";
	$columnName[2] = "first_name";
	$columnName[3] = "last_name";
	$tableName = "ems_students";
	$whereValue["class_id"] = $classID;
	$whereValue["shift_id"] = $shiftID;
	$fetchStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	echo '<option> Choose... </option>';
	
	if(!empty($fetchStudentData))
	{
		foreach($fetchStudentData AS $eachOption)
		{
			echo '<option value="'. $eachOption['id'] .'">'. $eachOption['first_name'] .' '. $eachOption['last_name'] .'</option>';
		}
	}
	else
	{
		echo '<option> No Records Found </option>';
	}
}	


#Fetch Student ID
if(@$_POST['action'] == "STUDENTID")
{		
	$getID = $_POST['student'];
	
	$columnName = $tableName = $whereValue = null;
	$columnName[1] = "student_id";
	$tableName = "ems_students";
	$whereValue["id"] = $getID;
	$fetchStudentID = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	echo $fetchStudentID[0]['student_id'];
}	


#Fetch Student Roll No
if(@$_POST['action'] == "ROLLNO")
{		
	$getID = $_POST['student'];
	
	$columnName = $tableName = $whereValue = null;
	$columnName[1] = "roll_number";
	$tableName = "ems_students";
	$whereValue["id"] = $getID;
	$fetchRollNo= $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	echo $fetchRollNo[0]['roll_number'];
}
## ===*=== [F]ETCH DATA ===*=== ##
?>