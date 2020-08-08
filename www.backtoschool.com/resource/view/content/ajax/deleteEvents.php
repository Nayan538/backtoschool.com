<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA START ===*=== ##
if(isset($_POST['id']))
{
	$tableName = "ems_events";
	$whereValue["id"] = $_POST['id'];
	$deleteEventData = $eloquent->deleteData($tableName, $whereValue);
}
## ===*=== [D]ELETE DATA END ===*=== ##
?>