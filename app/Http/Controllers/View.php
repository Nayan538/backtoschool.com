<?php
## ===*=== GLOBAL SESSION ===*=== ##
session_start();
## ===*=== GLOBAL SESSION ===*=== ##


## ===*=== CONFIGURATION FILES ===*=== ##
include("config/site.php");
include("config/server.php");
include("config/database.php");
## ===*=== CONFIGURATION FILES ===*=== ##


## ===*=== VIEW CLASS ===*=== ##
class View
{
	public function loadContent($directory, $page_name)
	{
		include("resource/view/".$directory."/".$page_name.".php");
	}
}
## ===*=== VIEW CLASS ===*=== ##
?>