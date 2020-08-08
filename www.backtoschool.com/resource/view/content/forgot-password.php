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
#Fetch Logo's Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_icons";
$fetchLogoData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##


## ===*=== [P]AGE TITLE ===*=== ##	
$pageTitle = basename($_SERVER['PHP_SELF']);
if($pageTitle == 'forgot-password.php')
{
	$pageTitle = 'EMS | Forgot Password';
}
## ===*=== [P]AGE TITLE ===*=== ##
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoData[0]['app_favicon'] ?>">
		
		<title> <?php echo $pageTitle ?> </title>
		
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="public/assets/css/all.css">
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
					<div class="account-box" style="background-color: transparent; border-color: transparent;">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.php">
									<img src="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoData[0]['org_logo'] ?>" alt="" style="width: auto; height: 96px;">
								</a>
							</div>
							<form action="" method="post">
								<div class="form-group text-light custom-mt-form-group">
									<input type="email" class="text-light" id="emailId" required>
									<label class="control-label text-light"> Email ID </label> <i class="bar"></i>
								</div>
								<div class="form-group text-center custom-mt-form-group">
									<button class="btn btn-dark btn-rounded btn-block" id="submit" type="submit">
										<i class="fas fa-key"></i> Forgot Password
									</button>
								</div>
								<div class="text-center">
									<a href="index.php" class="btn btn-outline-secondary btn-rounded text-light">
										<i class="fas fa-sign-in-alt"></i> Back to Login
									</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--=*= Email Confirmation Notification =*=-->
		<div id="alert" class="modal" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" style="background-color: transparent; border-color: transparent; color: #fff;">
					<div class="modal-header">
						<h4 class="modal-title"> Dear User </h4>
					</div>
					<div class="modal-body mb-2">
						<p> 
							You will get a email verification link on 
							<span class="text-warning font-weight-bold" id="getEmail"></span>, 
							Please check your inbox and click to try to reset your password. 
						</p>
						<p> 
							If there any urgent issue, please call: <b class="text-success"> +880 1316 440504 </b>
						</p>
						<p class="text-right">
							Thank and Best Regards <br/> 
							<small> User &amp; System Adminitration </small> 
						</p>
						<a href="index.php" class="btn btn-sm btn-light"> 
							Okay! got it 
						</a>
					</div>
				</div>
			</div>
		</div>
		<!--=*= Email Confirmation Notification =*=-->
		
		
		<!--=*= |#| JS SCRIPT |#| =*=-->
		<script type="text/javascript" src="public/assets/js/jquery-3.3.1.js"></script>
		<script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
				
				//Get The Input Type Value
				$('#emailId').on('keyup', function(e) {
					var email = $(this).val();
					var reg = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
					
					if(reg.test(email) === true) {
						document.getElementById('getEmail').innerHTML = email;
						
						$('#submit').click(function(e) {
							e.preventDefault();
							
							$('#alert').modal('show');						
						});
					}
				});
			});
		</script>
		<!--=*= |#| JS SCRIPT |#| =*=-->
		
	</body>
</html>																													