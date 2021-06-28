<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA START ===*=== ##	
if(isset($_POST['action']) == "INSERT")
{
	$orgName = $_POST['org'];
	$webUrl = $_POST['url'];
	$currency = $_POST['cur'];
	$timeZone = $_POST['tzn'];
	$address = $_POST['add'];
	
	//FETCH DATA TO CHECK AVAILABILITY
	$columnName = $tableName = null;
	$columnName = "*";
	$tableName = "ems_org_config";
	$fetchOrgInfo = $eloquent->selectData($columnName, $tableName);
	
	if(!empty($fetchOrgInfo))
	{
		$_SESSION['ORG_INFO_AVAILABLE_ID'] = $fetchOrgInfo[0]['id'];
		
		//UPDATE DATA IS AVAILABLE AFTER URL VALIDATION
		if(filter_var($_POST['url'], FILTER_VALIDATE_URL))
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_org_config";
			$columnValue["organization_name"] = $orgName;
			$columnValue["website_url"] = $webUrl;
			$columnValue["currency"] = $currency;
			$columnValue["timezone"] = $timeZone;
			$columnValue["org_address"] = $address;
			$columnValue["updated_at"] = date('Y-m-d H:i:s');
			$whereValue["id"] = $_SESSION['ORG_INFO_AVAILABLE_ID'];
			$updateOrgInfo = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if(!empty($updateOrgInfo))	{
				echo 1;
			} else {
				echo 0;
			}
		}
	}		
	else
	{
		//INSERT DATA AFTER URL VALIDATION
		if(filter_var($_POST['url'], FILTER_VALIDATE_URL))
		{
			$tableName = $columnValue = null;
			$tableName = "ems_org_config";
			$columnValue["organization_name"] = $orgName;
			$columnValue["website_url"] = $webUrl;
			$columnValue["currency"] = $currency;
			$columnValue["timezone"] = $timeZone;
			$columnValue["org_address"] = $address;
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$insertOrgInfo = $eloquent->insertData($tableName, $columnValue);
			
			if(@$insertOrgInfo['LAST_INSERT_ID'] > 0)	{
				echo 1;
			} else {
				echo 0;
			}
		}
	}
}
## ===*=== [I]NSERT DATA END ===*=== ##
?>