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
if(@$_FILES['contactImage']['name'] != '')
{
	//CREATE A NEW IMAGE FILE NAME
	$imageName = 'CONTACT_' . date('Ymd'). '_PERSON_' . rand(100, 999) . @$_FILES['contactImage']['name'];
	$imageValid = $control->checkImage(@$_FILES['contactImage']['type'], @$_FILES['contactImage']['size'], @$_FILES['contactImage']['error']);
	
	//FETCH CONTACT DATA
	$columnName = $tableName = null;
	$columnName = "*";
	$tableName = "ems_contact_config";
	$fetchContactInfo = $eloquent->selectData($columnName, $tableName);	
	
	if(!empty($fetchContactInfo))
	{
		$_SESSION['FETCH_CONTACT_ID'] = $fetchContactInfo[0]['id'];
		$_SESSION['FETCH_CONTACT_IMAGE'] = './../'.$GLOBALS['ADMIN_IMAGE_DIRECTORY'].$fetchContactInfo[0]['image'];
		
		if($_FILES['contactImage']['name'] == '')
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "ems_contact_config";
			$columnValue["full_name"] = $_POST['fullName'];
			$columnValue["designation"] = $_POST['designation'];
			$columnValue["email"] = $_POST['contactEmail'];
			$columnValue["fax"] = $_POST['contactFax'];
			$columnValue["phone"] = $_POST['contactPhone'];
			$columnValue["telephone"] = $_POST['contactTelephone'];
			$columnValue["updated_at"] = date('Y-m-d H:i:s');
			$whereValue["id"] = $_SESSION['FETCH_CONTACT_ID'];
			$updateContactInfo = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if(!empty($updateContactInfo)) 
			{
				echo 1;
			}
		}
		else
		{
			if($imageValid == 1)
			{
				$tableName = $columnValue = $whereValue = null;
				$tableName = "ems_contact_config";
				$columnValue["image"] = $imageName;
				$columnValue["full_name"] = $_POST['fullName'];
				$columnValue["designation"] = $_POST['designation'];
				$columnValue["email"] = $_POST['contactEmail'];
				$columnValue["fax"] = $_POST['contactFax'];
				$columnValue["phone"] = $_POST['contactPhone'];
				$columnValue["telephone"] = $_POST['contactTelephone'];
				$columnValue["updated_at"] = date('Y-m-d H:i:s');
				$whereValue["id"] = $_SESSION['FETCH_CONTACT_ID'];
				$updateContactInfo = $eloquent->updateData($tableName, $columnValue, @$whereValue);
				
				if(!empty($updateContactInfo))
				{
					move_uploaded_file($_FILES['contactImage']['tmp_name'], './../'.$GLOBALS['ADMIN_IMAGE_DIRECTORY'].$imageName);
					unlink($_SESSION['FETCH_CONTACT_IMAGE']);
					echo 1;
				}
			}
		}
	}
	else
	{
		if($imageValid == 1)
		{
			$tableName = $columnValue = null;
			$tableName = "ems_contact_config";
			$columnValue["image"] = $imageName;
			$columnValue["full_name"] = $_POST['fullName'];
			$columnValue["designation"] = $_POST['designation'];
			$columnValue["email"] = $_POST['contactEmail'];
			$columnValue["fax"] = $_POST['contactFax'];
			$columnValue["phone"] = $_POST['contactPhone'];
			$columnValue["telephone"] = $_POST['contactTelephone'];
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$insertContactInfo = $eloquent->insertData($tableName, $columnValue);
			
			if($insertContactInfo['LAST_INSERT_ID'] > 0)
			{
				move_uploaded_file($_FILES['contactImage']['tmp_name'], './../'.$GLOBALS['ADMIN_IMAGE_DIRECTORY'].$imageName);
				echo 1;
			}
			else 
			{
				echo 0;
			}
		}
	}
}
## ===*=== [I]NSERT DATA END ===*=== ##
?>