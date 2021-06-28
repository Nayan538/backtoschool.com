<?php
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
#Get The Tile of Page
$pageTitle = basename($_SERVER['PHP_SELF']);
if($pageTitle == 'change-password.php')
{
	$pageTitle = 'EMS | Change Password';
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
		
	<?php 			
	/*
	|------------------------------------------
	| =*=*=*=*=*= IF USER LOGGED IN =*=*=*=*=*=
	|------------------------------------------
	*/
	if(!empty(@$_SESSION['EMSB_login_id']))
	{
		## ===*=== [F]ETCH DATA ===*=== ##
		#Fetch Admin Data
		$columnName = $tableName = $whereValue = null;
		$columnName["1"] = "admin_password";
		$tableName = "ems_admins";
		$whereValue["id"] = $_SESSION['EMSB_login_id'];
		$fetchCurrentPassword = $eloquent->selectData($columnName, $tableName, @$whereValue);
		## ===*=== [F]ETCH DATA ===*=== ##
		
		
		## ===*=== [U]PDATE DATA ===*=== ##
		if(isset($_POST['changePass']))
		{
			@$currentPassword = sha1($_POST['currentPass'] . $GLOBALS['CYPHER_KEY']);
			@$newPassword = sha1($_POST['newPass'] . $GLOBALS['CYPHER_KEY']);
			@$reNewPassword = sha1($_POST['reNewPass'] . $GLOBALS['CYPHER_KEY']);
			
			#if Match Both Password And From Database
			if($currentPassword === $fetchCurrentPassword[0]['admin_password'])
			{
				#if New and reEnter Password is 'TRUE'
				if($newPassword === $reNewPassword)
				{
					$tableName = $columnValue = $whereValue = null;
					$tableName = "ems_admins";
					$columnValue["admin_password"] = $newPassword;
					$whereValue["id"] = $_SESSION['EMSB_login_id'];
					$updatePassword = $eloquent->updateData($tableName, $columnValue, @$whereValue);
					
					if($updatePassword > 0)
					{
						header("Location: index.php");
					}
				}
			}
		}
		## ===*=== [U]PDATE DATA ===*=== ##
	?>
			
	<div class="main-wrapper">
		<div class="account-page">
			<div class="container">
				<div class="account-box" style="background-color: transparent; border-color: transparent;">
					<div class="account-wrapper">
						<div class="account-logo">
							<a href="index.php">
								<img src="<?php echo  $GLOBALS['ADMIN_IMAGE_DIRECTORY'] . $_SESSION['EMSB_login_admin_image'] ?>" alt="" class="rounded-circle mb-3" style="border: 5px solid white; padding: 5px;">
							</a>
						</div>
						<form action="" method="post">
							<div class="form-group text-light custom-mt-form-group">
								<input type="password" name="currentPass" class="text-light"/>
								<label class="control-label text-light"> Current Password </label><i class="bar"></i>
							</div>
							<div class="form-group text-light custom-mt-form-group">
								<input type="password" name="newPass" id="newPass" class="text-light"/>
								<label class="control-label text-light"> New Password </label><i class="bar"></i>
							</div>
							<div class="form-group text-light custom-mt-form-group">
								<input type="password" name="reNewPass" id="reNewPass" class="text-light"/>
								<label class="control-label text-light"> New Repeat Password </label><i class="bar"></i>
							</div>
							<div id="error-message"></div>
							<div class="form-group m-b-0 text-center custom-mt-form-group">
								<button class="btn btn-warning btn-rounded btn-block" name="changePass" id="changePass" type="submit">
									<i class="fas fa-key"></i> Change Password
								</button>
							</div>
						</form>
					</div>
					<div class="text-center">
						<a href="dashboard.php" class="btn btn-outline-secondary btn-rounded text-light">
							<i class="fas fa-home"></i> Back to Dashboard
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
			
<?php
	}
	/*
	|------------------------------------------------
	| =*=*=*=*=*= IF USER "NOT" LOGGED IN =*=*=*=*=*=
	|------------------------------------------------
	*/
	else
	{
?>
			
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
						<form method="post">
							<div class="form-group text-light custom-mt-form-group">
								<input type="password" class="text-light"/>
								<label class="control-label text-light">New Password</label><i class="bar"></i>
							</div>
							<div class="form-group text-light custom-mt-form-group">
								<input type="password" class="text-light"/>
								<label class="control-label text-light">New Repeat Password</label><i class="bar"></i>
							</div>
							<div class="form-group m-b-0 text-center custom-mt-form-group">
								<button class="btn btn-warning btn-rounded btn-block" type="submit">
									<i class="fas fa-key"></i> Change Password
								</button>
							</div>
							<div class="text-center mt-3">
								<a href="index.php" class="btn btn-outline-secondary btn-rounded text-light">
									<i class="fas fa-home"></i> Back to Login
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
			
<?php	
	}
?>
	
	<!--=*= |#| JS SCRIPT |#| =*=-->
	<script type="text/javascript" src="public/assets/js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(e){
			$('#changePass').on('click', function(e){
				
				var np = $('#newPass').val();
				var rp = $('#reNewPass').val();
				
				if(np !== rp) {
					e.preventDefault();
					$('#error-message').html('<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-bottom: -15px;"><strong>Oops!</strong> both password is not match <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>').slideDown();
				} else {
					return true;
				}
				
			});				
		});
	</script>
	<!--=*= |#| JS SCRIPT |#| =*=-->
		
	</body>
</html>
