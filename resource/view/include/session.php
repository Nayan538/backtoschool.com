<?php
## ===*=== SESSION FOR USER LOGOUT ===*=== ##
if(@$_REQUEST['exit'] == "yes")
{
	session_start() ;
	session_destroy() ;
	header("Location: index.php");
}
## ===*=== SESSION FOR USER LOGOUT ===*=== ##


## ===*=== SESSION FOR USER LOCKSCREEN ===*=== ##
if(@$_REQUEST['exit'] == "lock")
{
	header("Location: lock-screen.php");
}
## ===*=== SESSION FOR USER LOCKSCREEN ===*=== ##
?>