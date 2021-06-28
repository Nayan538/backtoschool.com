<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Http/Controllers/AjaxController.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA START ===*=== ##
$data = array();
$loadEvents = $ajaxcontrol->fetchAsc('ems_events', 'id');

foreach($loadEvents AS $eachRow)
{
	$data[] = array(
		'id' 		=> $eachRow['id'],
		'title'	=> $eachRow['title'],
		'start'	=> $eachRow['start_event'],
		'end'		=> $eachRow['end_event']
	);
}
echo json_encode($data);
## ===*=== [F]ETCH DATA END ===*=== ##
?>