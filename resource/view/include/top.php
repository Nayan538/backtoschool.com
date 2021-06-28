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


## ===*=== [F]ETCH DATA START ==*=== ##

//FETCH ORG DATA
$columnName = $tableName = null;
$columnName["1"] = "organization_name";
$tableName = "ems_org_config";
$fetchOrgData = $eloquent->selectData($columnName, $tableName);

$orgName = $fetchOrgData[0]['organization_name'];


//FETCH LOGO DATA
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_icons";
$fetchLogoData = $eloquent->selectData($columnName, $tableName);

$favicon = $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoData[0]['app_favicon'];
$logo = $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoData[0]['app_logo'];


//FETCH NOTICE DATA
$fetchNotice = $ajaxcontrol->fetchLimit('ems_notices', 'id', '8');
$noticeCount = count($fetchNotice);	


//FETCH EVENTS DATA
$fetchEvent = $ajaxcontrol->fetchLimit('ems_events', 'id', '5');
$eventCount = count($fetchEvent);

## ===*=== [F]ETCH DATA END ===*=== ##


## ===*=== [L]OG IN ACCESS | CREDENTIAL FILES ===*=== ##

if(isset($_POST['getAccess']))
{
	$key = $_POST['keyWord'];
	$pass = sha1($_POST['passWord']);

	$settingsAccess = $ajaxcontrol->tryLogin('ems_crendential', 'credential_keyword', '	credential_password', $key, $pass);

	if(!empty($settingsAccess)) 
	{
		header('Location: settings-dashboard.php');
	} 
	else 
	{
		session_start();
		session_destroy();
		header('Location: error-500.php');
	}
}

## ===*=== [L]OG IN ACCESS | CREDENTIAL FILES ===*=== ##


## ===*=== [H]EADER TITLE ===*=== ##

$getTitle = basename($_SERVER['PHP_SELF']);
$explodeTitle = explode('.', $getTitle);
$fetchTitle = $explodeTitle[0];

if(strpos($fetchTitle, '-')) 
{
	$pageTitle = explode('-', $fetchTitle);
	$pageTitle = 'EMS | ' . ucfirst($pageTitle[0]) . ' ' . ucfirst($pageTitle[1]);
} 
else 
{
	$pageTitle = 'EMS | ' . ucfirst($fetchTitle);
}

## ===*=== [H]EADER TITLE ===*=== ##
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon ?>">
	
	<title> <?php echo $pageTitle; ?> </title>
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="public/assets/css/all.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/tagsinput.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/datepicker.css">
	
	<!--=*= css files | plugins =*=-->
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/light-gallery/css/lightgallery.min.css">
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/icheck/skins/all.css">
	<link rel="stylesheet" type="text/css" href="public/assets/plugins/summernote/dist/summernote-bs4.css">
	<!--=*= css files | plugins =*=-->
	
	<link rel="stylesheet" type="text/css" href="public/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/custom.css">
	
	<!--=*= jQuery initiate to re-call again and again =*=-->
	<script type="text/javascript" src="public/assets/js/jquery-3.3.1.js"></script>
	<!--=*= jQuery initiate to re-call again and again =*=-->
	
	<!--[if lt IE 9]>
		<script src="public/assets/js/html5shiv.min.js"></script>
		<script src="public/assets/js/respond.min.js"></script>
	<![endif]-->
	</head>
	<body>
		<div class="main-wrapper">

			<!--=*= top navigation bar start =*=-->
			<div class="header">
				<div class="header-left">
					<a href="index.php" class="logo">
						<img src="<?php echo $logo ?>" alt="" style="width: auto; height: 66px;">
					</a>
				</div>
				<div class="page-title-box float-left">
					<h3 class="text-uppercase"> <?php echo $orgName ?> </h3>
				</div>
				<a id="mobile_btn" class="mobile_btn float-left" href="#sidebar">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</a>
				<ul class="nav user-menu float-right">	
					
					<!--=*= events notification content start =*=-->
					<li class="nav-item dropdown d-none d-sm-block">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell text-dark"></i>
							<span class="badge badge-pill btn-success float-right"> <?php echo $eventCount ?> </span>
						</a>	
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span> Events </span>
							</div>
							<div class="drop-scroll">
								<ul class="notification-list">
									
									<?php
									if(!empty($fetchEvent))
									{
										foreach($fetchEvent AS $eachEvent)
										{
											$start = date('M d, Y', strtotime($eachEvent['start_event']));
											$end = date('M d, Y', strtotime($eachEvent['end_event']));
											$getTime = $start .' <b class="text-secondary"> TO </b> '. $end;
											
											echo '
											<li class="notification-message">
												<a href="events.php">
												<div class="media">
													<span class="pr-2 text-secondary"> <i class="fab fa-battle-net fa-2x"></i> </span>
													<div class="media-body">
														<p class="noti-details"> <span class="noti-title">'. $eachEvent['title'] .'</span> </p>
														<p class="noti-time"> <span>'. $getTime .'</span> </p>
													</div>
												</div>
												</a>
											</li>
											';
										}
									}
									?>

								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="events.php"> View all Events </a>
							</div>
						</div>
					</li>
					<!--=*= events notification content end =*=-->
					
					<!--=*= notice notification content start =*=-->
					<li class="nav-item dropdown d-none d-sm-block">
						<a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link">
							<i class="fa fa-envelope text-dark"></i>
							<span class="badge badge-pill btn-success float-right"> <?php echo $noticeCount ?> </span>
						</a>
						<div class="notification-box">
							<div class="msg-sidebar notifications msg-noti">
								<div class="topnav-dropdown-header">
									<span> NOTICE </span>
								</div>
								<div class="drop-scroll msg-list-scroll">
									<ul class="list-box">
										<?php										
										if(!empty($fetchNotice))
										{
											foreach($fetchNotice AS $eachRow)
											{
												$nameIndex = $ajaxcontrol->nameIndex($eachRow['author_name']);
												$getTime = date('d M', strtotime($eachRow['created_at']));
												$shortDes = substr($eachRow['description'], 0, 30);
												
												echo '
												<li>
													<a href="notice.php">
														<div class="list-item new-message bg-light">
															<div class="list-left">
																<span class="avatar bg-secondary">'. $nameIndex .'</span>
															</div>
															<div class="list-body">
																<span class="message-author">'. $eachRow['author_name'] .'</span>
																<span class="message-time">'. $getTime .'</span>
																<div class="clearfix"></div>
																<span class="message-content">'. $shortDes .'</span>
															</div>
														</div>
													</a>
												</li>
												';
											}
										}
										?>
										
									</ul>
								</div>
								<div class="topnav-dropdown-footer">
									<a href="notice.php"> See all Notices </a>
								</div>
							</div>
						</div>
					</li>					
					<!--=*= notice notification content end =*=-->

					<!--=*= logged in user content start =*=-->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
							<span class="user-img">
								
								<?php
								if($_SESSION['EMSB_login_id'] > 0)
								{
									$userImage = $GLOBALS['ADMIN_IMAGE_DIRECTORY'] . $_SESSION['EMSB_login_admin_image'];

									echo '<img class="rounded-circle" src="'. $userImage .'" width="40" alt="Admin">
											<span class="status online"></span>
										';
								}
								?>
								
							</span>
							<span class="cstm-text">
								
								<?php 
								if($_SESSION['EMSB_login_id'] > 0)
								{
									echo $_SESSION['EMSB_login_admin_name'];
								}
								?>
								
							</span>
						</a>
						<div class="dropdown-menu" style="margin-left: 100px !important;">
							<a class="dropdown-item" href="change-password.php">
								<i class="fab fa-creative-commons-sa mr-1 text-success"></i> Change Password 
							</a>
							<a class="dropdown-item" href="?exit=lock">
								<i class="fas fa-user-lock mr-1 text-success"></i> Lock Screen 
							</a>
							<a class="dropdown-item" href="?exit=yes"> 
								<i class="fas fa-sign-out-alt mr-1 text-success"></i> Logout 
							</a>
						</div> 
					</li>
					<!--=*= logged in user content start =*=-->
					
				</ul>
				<div class="dropdown mobile-user-menu float-right">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="change-password.php">
							<i class="fab fa-creative-commons-sa mr-1 text-success"></i> Change Password 
						</a>
						<a class="dropdown-item" href="?exit=lock">
							<i class="fas fa-user-lock mr-1 text-success"></i> Lock Screen 
						</a>
						<a class="dropdown-item" href="?exit=yes"> 
							<i class="fas fa-sign-out-alt mr-1 text-success"></i> Logout 
						</a>
					</div>
				</div>
			</div>	
			<!--=*= top navigation bar end =*=-->
			
			<!--=*= side navigation menu start =*=-->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> EMS Overview </li>
							<li class="">
								<a href="dashboard.php">
									<i class="fas fa-chart-line" aria-hidden="true"></i> Dashboard
								</a>
							</li>
							<li>
								<a href="teachers-infogrid.php">
									<i class="fas fa-user-tie"></i> Teachers 
								</a>
							</li>
							<li>
								<a href="students-infogrid.php">
									<i class="fas fa-user-graduate"></i> Students 
								</a>
							</li>
							<li>
								<a href="contacts.php">
									<i class="fas fa-address-book"></i> Contacts
								</a>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="noti-dot">
									<i class="fab fa-app-store-ios"></i> Apps <span class="menu-arrow"></span>
								</a>
								<ul style="display: none;">
									<li> 
										<a href="blank-page.php"> 
											<i class="far fa-file"></i> Blank Page 
										</a> 
									</li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#" class="noti-dot">
									<i class="fas fa-bars"></i> Features <span class="menu-arrow"></span>
								</a>
								<ul class="list-unstyled" style="display: none;">
									<li> <a href="events.php"> Events </a> </li>
									<li> <a href="gallery.php"> Gallery </a> </li>
									<li> <a href="holidays.php"> Holidays </a> </li>
									<li> <a href="blog.php"> Blog </a> </li>
									<li> <a href="notice.php"> Notice </a> </li>
								</ul>
							</li>
							
							<li class="menu-title"> Admin &amp; Accounts </li>
							<li class="submenu">
								<a href="#" class="noti-dot">
									<i class="fas fa-file-invoice-dollar"></i> Accounts <span class="menu-arrow"></span>
								</a>
								<ul class="list-unstyled" style="display: none;">
									<li> <a href="payments.php"> Payments </a> </li>
									<li> <a href="expense-report.php"> Expenses </a> </li>
									<li class="submenu">
										<a href="#"> Student Fees <span class="menu-arrow"></span> </a>
										<ul class="list-unstyled" style="display: none;">
											<li> <a href="admission-fees.php"> Admission Fees </a> </li>
											<li> <a href="monthly-fees.php"> Monthly Fees </a> </li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#" class="noti-dot">
									<i class="fas fa-th"></i> Management <span class="menu-arrow"></span>
								</a>
								<ul style="display: none;">
									<li class="submenu">
										<a href="#"> Employees <span class="menu-arrow"></span> </a>
										<ul class="list-unstyled" style="display: none;">
											<li> <a href="employees-grid.php"> All Employees </a> </li>
											<li> <a href="leaves.php"> Leave Requests </a> </li>
											<li> <a href="departments.php"> Departments </a> </li>
											<li> <a href="designations.php"> Designations </a> </li>
										</ul>
									</li>
									<li> <a href="admins.php"> Admins </a> </li>
									<li> <a href="settings-dashboard.php" id="credential"> Settings </a> </li>
								</ul>
							</li>

							<li class="menu-title"> School Management </li>
							<li class="submenu">
								<a href="#" class="noti-dot">
									<i class="far fa-calendar-alt"></i> Students <span class="menu-arrow"></span>
								</a>
								<ul class="list-unstyled" style="display: none;">
									<li> <a href="student-attendance.php"> Attendance </a> </li>
									<li> <a href="class-migration.php"> Class Migration </a> </li>
									<li> <a href="library.php"> Library </a> </li>
									<li> <a href="class-routine.php"> Class Routine </a> </li>
								</ul>
							</li>								
							<li class="submenu">
								<a href="#" class="noti-dot">
									<i class="far fa-calendar-alt"></i> Examination <span class="menu-arrow"></span>
								</a>
								<ul class="list-unstyled" style="display: none;">
									<li> <a href="exam-schedule.php"> Exam Schedule </a> </li>
									<li> <a href="exam-grade.php"> Exam Grade </a> </li>
									<li> <a href="exam-marksheet.php"> Exam Mark Sheet </a> </li>
								</ul>
							</li>
							<li>
								<a href="basic-config.php"> <i class="fas fa-cogs"></i> Basic Config </a> 
							</li>
						</ul>
					</div>
				</div>
			</div>																																																																																																																																																																																																																																																																																																																																																	
			<!--=*= side navigation menu end =*=-->
			
			<!--=*= credential files access start =*=-->
			<div id="settingsLogin" class="modal" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" style="border-color: transparent;">
						<div class="modal-header">
							<h4 class="modal-title"> Authorized Person Only </h4>
							<button type="button" class="btn btn-sm btn-outline-warning text-right" data-dismiss="modal"> 
								I Understand 
							</button>
						</div>
						<div class="modal-body mb-2">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="row">						
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="input-group-prepend" style="height:36px;">
												<label class="input-group-text pr-4">
													<i class="fas fa-user-secret text-danger mr-2"></i> KEYWORD
												</label>
											</div>
											<input type="text" class="form-control" name="keyWord" style="height:36px;">
										</div>
									</div>
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="input-group-prepend" style="height:36px;">
												<label class="input-group-text">
													<i class="fas fa-key text-danger mr-2"></i> PASSWORD
												</label>
											</div>
											<input type="password" class="form-control" name="passWord" style="height:36px;">
										</div>
									</div>	
								</div>
								<div class="col-sm-12 text-center mt-3">
									<button type="submit" class="btn btn-outline-success btn-sm mb-31" name="getAccess" style="width: 180px;">
										<i class="fa fa-plus-circle"></i> Get Access
									</button>					
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>		
			<!--=*= credential files access end =*=-->				