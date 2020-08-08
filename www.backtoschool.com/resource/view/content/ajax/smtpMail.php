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
if(isset($_POST['smtp_mail']) == "YES")
{
	$smtpHost = $_POST['host'];
	$smtpUser = $_POST['user'];
	$smtpPort = $_POST['port'];
	$smtpDomain = $_POST['domain'];
	$smtpPass = $_POST['pass'];
	
	$tableName = $columnValue = $whereValue = null;
	$tableName = "smtp_setting";
	$columnValue["ems_smtp_host"] = $smtpHost;
	$columnValue["ems_smtp_user"] = $smtpUser;
	$columnValue["ems_smtp_pass"] = $smtpPass;
	$columnValue["ems_smtp_port"] = $smtpPort;
	$columnValue["ems_smtp_auth_domain"] = $smtpDomain;
	$columnValue["updated_at"] = date('Y-m-d H:i:s');
	$whereValue["id"] = 1;
	$updateSMTPdata = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	
	if(@$updateSMTPdata > 0) {
		echo 1;
	} else {
		echo 0;
	}
}
## ===*=== [U]PDATE DATA END ===*=== ##
?>