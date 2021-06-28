<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/ajaxView.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$view = new ajaxView;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [L]OAD CONTENT DATA ===*=== ##
$view->loadContent("include", "session");
$view->loadContent("content/ajax", "editAdmin");
## ===*=== [L]OAD CONTENT DATA ===*=== ##
?>