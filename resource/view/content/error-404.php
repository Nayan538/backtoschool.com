<?php
session_destroy();

## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_icons";
$fetchLogoData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##


## ===*=== [P]AGE TITLE ===*=== ##	
$pageTitle = basename($_SERVER['PHP_SELF']);
if($pageTitle == 'error-404.php')
{
	$pageTitle = 'EMS | ERROR-404';
}
## ===*=== [P]AGE TITLE ===*=== ##
?>

<!--=*= |#| ERROR 404 CONTENT |#| =*=-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoData[0]['app_favicon'] ?>">
		
		<title> <?php echo $pageTitle ?> </title>
		
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="public/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="public/assets/css/custom.css">
		
		<!--[if lt IE 9]>
			<script src="public/assets/js/html5shiv.min.js"></script>
			<script src="public/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<div class="text-center text-light">
						<h2 style="font-size: 96px;"> 404 </h2>
						<h3 class="text-uppercase"> Oops! <span style="font-weight: 300;"> Page not found! </span> </h3>
						<p> The page you requested was not found. </p>
						<a href="index.php" class="btn btn-outline-light btn-rounded"> Go back to Home </a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>	
<!--=*= |#| ERROR 404 CONTENT |#| =*=-->