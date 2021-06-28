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


## ===*=== [P]AGE TITLE ===*=== ##	
$pageTitle = basename($_SERVER['PHP_SELF']);
if($pageTitle == 'lock-screen.php')
{
	$pageTitle = 'EMS | Lock Screen';
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
		
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="public/assets/css/all.css">
		<link rel="stylesheet" type="text/css" href="public/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="public/assets/css/custom.css">
		
		<!--[if lt IE 9]>
			<script src="public/assets/js/html5shiv.min.js"></script>
			<script src="public/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<?php	
	#if User Logged In
	if($_SESSION['EMSB_login_id'] > 0)
	{
		#Fetch Admin Data
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "ems_admins";
		$whereValue["id"] = $_SESSION['EMSB_login_id'];
		$fetchUserData = $eloquent->selectData($columnName, $tableName, @$whereValue);
		
		$_SESSION['LOGGED_IN_USER_PASS'] = $fetchUserData[0]['admin_password'];
	}
		
	#When Try to Unlock
	if(isset($_POST['unlock']))
	{
		$userPass = sha1($_POST['userPass'] . $GLOBALS['CYPHER_KEY']);
		if(!empty($userPass))
		{
			if($userPass === $_SESSION['LOGGED_IN_USER_PASS'])
			{
				$adminAcecss = $ajaxcontrol->tryLockScreen('ems_admins', 'admin_password', $userPass);
				header("Location: dashboard.php");
			}
			else
			{
				if($userPass !== $_SESSION['LOGGED_IN_USER_PASS'])
				{
					session_destroy();
					header("Location: index.php");
				}
			}
		}
	}

	#Lock Screen is Only For Authentic User
	if($_SESSION['EMSB_login_id'] > 0)
	{
	?>
		
	<body class="lock-screen" onload="startTime()">
		<div class="main-wrapper error-wrapper">
			<div class="account-page">
				<div class="lock-wrapper">
					<div id="time"></div>
					<div class="lock-box text-center">
						<div class="lock-name"> <?php echo $_SESSION['EMSB_login_admin_name'] ?> </div>
						<img src="<?php echo $GLOBALS['ADMIN_IMAGE_DIRECTORY'] . $_SESSION['EMSB_login_admin_image'] ?>" alt="lock avatar"/>
						<div class="lock-pwd">
							<form role="form" class="form-inline" method="post" action="">
								<div class="form-group">
									<input type="password" name="userPass" placeholder="Password" id="password" class="form-control lock-input">
									<button class="btn btn-lock" name="unlock" id="unlock" type="submit">
										<i class="fas fa-arrow-right"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--=*= if Password is Empty =*=-->
		<div id="alert" class="modal" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" style="background-color: transparent; border-color: transparent; color: #fff;">
					<div class="modal-header">
						<h4 class="modal-title"> Dear User </h4>
					</div>
					<div class="modal-body mb-2">
						<p> Please make sure that you are a authorized user or <a href="forgot-password.php" class="text-success"> forgot your password? </a> </p>
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal"> 
								I Understand 
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--=*= if Password is Empty =*=-->

		
		<!--=*= |#| JS SCRIPT |#| =*=-->
		<script type="text/javascript" src="public/assets/js/jquery-3.3.1.js"></script>
		<script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript">

			//Digital Clock
			function startTime() {
				var today=new Date();
				var h=today.getHours();
				var m=today.getMinutes();
				var s=today.getSeconds();
				
				m=checkTime(m);
				s=checkTime(s);
				document.getElementById('time').innerHTML=h+":"+m+":"+s;
				t=setTimeout(function(){startTime()},500);
			}
			
			function checkTime(i)
			{
				if (i<10) {
					i="0" + i;
				}
				return i;
			}
			
				
			//if Password is Empty
			$('#unlock').on('click', function(e) {
				var pass = $('#password').val();
				
				if(pass == '') {
					e.preventDefault();
					$('#alert').modal('show')
				} else {
					return true;
				}
				
			});
		</script>
		<!--=*= |#| JS SCRIPT |#| =*=-->

	</body>
		
<?php
	}
	else
	{
		header("Location: index.php");
	}
?>

</html>						