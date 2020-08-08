<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [U]PDATE DATA START ===*=== ##
if(isset($_POST['id']))
{
	$tableName = "ems_events";
	$columnValue["title"] = $_POST['title'];
	$columnValue["start_event"] = $_POST['start'];
	$columnValue["end_event"] = $_POST['end'];
	$whereValue["id"] = $_POST['id'];
	$updateEventData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [U]PDATE DATA END ===*=== ##
?>