<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA START ===*=== ##
//FOR EDIT ONLY
if(@$_POST['editDesignation'] == "YES")
{
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_designations";
	$whereValue["department_id"] = $_POST['dept_id'];
	$fetchDesignationData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	echo '<option> Choose </option>';
	
	foreach($fetchDesignationData AS $eachOption)
	{
		echo '<option value="'. $eachOption['id'] .'" ';
		
		if($eachOption['id'] == $_POST['desg_id'])
		
		echo 'selected';		
		
		echo '>'. $eachOption['designation_name'] .'</option>';
	}
}

//FOR INSERT ONLY
if(@$_POST['insertDesignation'] == "YES")
{
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_designations";
	$whereValue["department_id"] = $_POST['dept_id'];
	$fetchDesignationData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	echo '<option> Choose </option>';
	
	foreach($fetchDesignationData AS $eachOption)
	{
		echo '<option value="'. $eachOption['id'] .'" ';
		
		if($eachOption['id'] == $_POST['dept_id'])
		
		echo 'selected';		
		
		echo '>'. $eachOption['designation_name'] .'</option>';
	}
}
## ===*=== [F]ETCH DATA END ===*=== ##
?>