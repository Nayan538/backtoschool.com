<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AjaxController.php");
include("app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_icons";
$fetchLogoData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##


## ===*=== [L]OGIN ACCESS FOR ALL USER START ===*=== ##
if(isset($_POST['userLogin']))
{
	$userEmail = $_POST['userEmail'];
	$userPass = sha1($_POST['userPass'] . $GLOBALS['CYPHER_KEY']);
	
	#Access Validation Query
	$adminData = $ajaxcontrol->tryLogin('ems_admins', 'admin_email', 'admin_password', $userEmail, $userPass);
	
	if(!empty($adminData))
	{
		#Create SESSION for Entire Application
		$_SESSION['EMSB_login_time'] = date("Y-m-d H:i:s");
		$_SESSION['EMSB_login_id'] = $adminData[0]['id'];
		$_SESSION['EMSB_login_admin_name'] = $adminData[0]['admin_name'];
		$_SESSION['EMSB_login_admin_email'] = $adminData[0]['admin_email'];
		$_SESSION['EMSB_login_admin_image'] = $adminData[0]['admin_image'];
		$_SESSION['EMSB_login_admin_status'] = $adminData[0]['admin_status'];
		$_SESSION['EMSB_login_admin_type'] = $adminData[0]['admin_type'];

		header("Location: dashboard.php");
	}
}
## ===*=== [L]OGIN ACCESS FOR ALL USER END ===*=== ##	


## ===*=== [P]AGE TITLE ===*=== ##	
$pageTitle = basename($_SERVER['PHP_SELF']);
if($pageTitle == 'index.php')
{
	$pageTitle = 'EMS | LOGIN';
}
## ===*=== [P]AGE TITLE ===*=== ##	
?>

<!--=*= |#| INDEX CONTENT |#| =*=-->
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
						<div class="account-wrapper text-light">
							<div class="account-logo">
								<a href="index.php">
									<img src="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoData[0]['org_logo'] ?>" alt="" style="width: auto; height: 96px;">
								</a>
							</div>
							<form action="" method="post">
								<div class="form-group custom-mt-form-group">
									<input type="text" class="text-light" name="userEmail"/>
									<label class="control-label text-light"> Email </label> 
									<i class="bar"></i>
								</div>
								<div class="form-group custom-mt-form-group">
									<input type="password" class="text-light" name="userPass"/>
									<label class="control-label text-light "> Password </label>
									<i class="bar"></i>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-success btn-block btn-rounded" name="userLogin" type="submit">
										<i class="fas fa-sign-in-alt"></i> LOGIN
									</button>
								</div>
								<div class="text-center mb-3">
									<a href="forgot-password.php" class="text-warning">Forgot your password?</a>
									<a href="#" class="text-white">or Signin Using</a>
								</div>
								<div class="form-group text-center">
									<a href="//facebook.com">
										<i class="fab fa-facebook text-success fa-2x"></i>
									</a>								
									<a href="//google.com" class="pl-4 pr-4">
										<i class="fab fa-google text-success fa-2x"></i>
									</a>									
									<a href="//linkedin.com">
										<i class="fab fa-linkedin text-success fa-2x"></i>
									</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<!--=*= |#| INDEX CONTENT |#| =*=-->																																													