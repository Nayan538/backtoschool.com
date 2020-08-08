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
if(isset($_FILES['file']['name'][0]))
{
	//COUNT FILES BECAUSE OF AN ARRAY
	$count = count($_FILES['file']['name']);
	
	for($i = 0; $i < $count; $i++)
	{
		//IMAGE FILE VALIDATION
		$error = $control->checkImage($_FILES['file']['type'][$i], $_FILES['file']['size'][$i], $_FILES['file']['error'][$i]);
		
		//IMAGE FILE NAME
		$fileName = 'GALLARY_' . date('Ymd') . '_IMAGE_' .rand(100, 999) . '_' . $_FILES['file']['name'][$i];
		
		//TEMPORARY LOCATION OF FILES
		$tempLocation = $_FILES['file']['tmp_name'][$i];
		
		if($error == 1)
		{
			$tableName = "ems_galleries";
			$columnValue["galleries_image"] = $fileName;
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$insertGallaryData = $eloquent->insertData($tableName, $columnValue);
			
			if($insertGallaryData['NO_OF_ROW_INSERTED'] > 0)
			{
				//STORE THE IMAGES INTO THE DEFINED DIRECTORY
				move_uploaded_file($_FILES['file']['tmp_name'][$i], './../'.$GLOBALS['APP_GALLARY_IMAGES_DIRECTORY'] . $fileName);
			}
		}
	}
}
## ===*=== [I]NSERT DATA END ===*=== ##
?>	