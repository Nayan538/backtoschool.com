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
if(isset($_POST['php_mail']) == "YES")
{
	@$mFrom = $_POST['from'];
	@$mName = $_POST['name'];
	
	$tableName = $columnValue = $whereValue = null;
	$tableName = "php_mail_setting";
	$columnValue["ems_php_mail_from"] = $mFrom;
	$columnValue["ems_php_mail_name"] = $mName;
	$columnValue["updated_at"] = date('Y-m-d H:i:s');
	$whereValue["id"] = 1;
	$updatePHPMailData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	
	if(@$updatePHPMailData > 0) {
		echo 1;
	} else {
		echo 0;
	}
}
## ===*=== [U]PDATE DATA END ===*=== ##
?>

