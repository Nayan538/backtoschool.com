<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/View.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$view = new View;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [L]OAD CONTENT DATA ===*=== ##
$view->loadContent("include", "session");
$view->loadContent("include", "top");
$view->loadContent("content", "teachers-infolist");
$view->loadContent("include", "tail");
## ===*=== [L]OAD CONTENT DATA ===*=== ##
?>