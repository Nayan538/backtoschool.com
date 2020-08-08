<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Contact Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_contact_config";
$fetchContactConfig = $eloquent->selectData($columnName, $tableName);	

#Fetch Organization Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_org_config";
$fetchOrgConfig = $eloquent->selectData($columnName, $tableName);	

#Fetch Time Zone Configuration Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_timezone";
$whereValue["id"] = $fetchOrgConfig[0]['timezone'];
$fetchTimeZone = $eloquent->selectData($columnName, $tableName, @$whereValue);

#Fetch Logo's Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_icons";
$fetchLogoConfig = $eloquent->selectData($columnName, $tableName);	

#Fetch PHP Mail Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "php_mail_setting";
$fetchPHPMailsettings = $eloquent->selectData($columnName, $tableName);

#Fetch SMTP Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "smtp_setting";
$fetchSMTPsettings = $eloquent->selectData($columnName, $tableName);	

#Fetch Leave Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_leave_config";
$fetchLeaveConfig = $eloquent->selectData($columnName, $tableName);

#Fetch Salary Configuration Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "salary_setting";
$salaryResult = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= Side Navigation Bar =*=-->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div class="sidebar-menu">
			<ul>
				<li> <a href="dashboard.php"> <i class="fa fa-home back-icon"></i> Back to Home </a> </li>
				<li class="menu-title">Settings</li>
				<li class="active"> <a href="settings-dashboard.php"> Dashboard </a> </li>
				<li> <a href="app-settings.php"> App Settings </a> </li>
				<li> <a href="roles-permissions.php"> Roles & Permissions </a> </li>
				<li> <a href="#"> Accounts Settings </a> </li>
			</ul>
		</div>
	</div>
</div>
<!--=*= Side Navigation Bar =*=-->


<!--=*= |#| SETTING OVERVIEW CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">Setting's <span style="font-weight: 300;">Overview</span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> Settings Dashboard </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="content-page">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="aboutprofile-sidebar">
						<div class="row">
							<div class="col-lg-4 col-md-12 col-sm-12 col-12">
								
								<!--=*= Contact Configuration Content =*=-->
								<div class="aboutprofile">
									<div class="card">
										<div class="page-title">
											<h4 class="text-success"> CONTACT 
												<span style="font-weight: 300;"> PERSON </span> 
											</h4>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="profile-img">
														<img class="avatar" src="
														<?php echo $GLOBALS['ADMIN_IMAGE_DIRECTORY'].$fetchContactConfig[0]['image'] ?>
														" alt="">
													</div>
													<div class="aboutprofile-name">
														<h5 class="text-center mt-2"> 
															<?php echo $fetchContactConfig[0]['full_name'] ?>
														</h5>
														<p class="text-center"> 
															<?php echo $fetchContactConfig[0]['designation'] ?> 
														</p>
													</div>
													<ul class="list-group list-group-flush font-weight-bold">
														<li class="list-group-item"> Email ID:
															<a href="mailto:" class="float-right"> 
																<?php echo $fetchContactConfig[0]['email'] ?>
															</a>
														</li>
														<li class="list-group-item"> Mobile:
															<a href="tel:" class="float-right"> 
																<?php echo $fetchContactConfig[0]['phone'] ?>
															</a>
														</li>
														<li class="list-group-item"> Telephone:
															<a href="tel:" class="float-right"> 
																<?php echo $fetchContactConfig[0]['telephone'] ?>
															</a>
														</li>														
														<li class="list-group-item"> FAX:
															<a href="fax:" class="float-right"> 
																<?php echo $fetchContactConfig[0]['fax'] ?>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--=*= Contact Configuration Content =*=-->
								
								<!--=*= Organization Configuration Content =*=-->
								<div class="aboutme-profile mt-4">
									<div class="card">
										<div class="page-title">
											<h4 class="text-success"> ORGANIZATION 
												<span style="font-weight: 300;"> CONFIGURATION </span> 
											</h4>
										</div>
										<div class="card-body">
											<ul class="list-group list-group-flush">
												<li class="list-group-item">
													<b> Org Name </b>
													<span class="float-right"> <?php echo $fetchOrgConfig[0]['organization_name'] ?> </span>
												</li>																					
												<li class="list-group-item">
													<b> Address </b>
													<span class="float-right"> <?php echo $fetchOrgConfig[0]['org_address'] ?> </span>
												</li>
												<li class="list-group-item">
													<b> Website URL </b>
													<span class="float-right"> 
														<a href="<?php echo $fetchOrgConfig[0]['website_url'] ?>" target="_blank">
															<?php echo $fetchOrgConfig[0]['website_url'] ?> 
														</a>
													</span>
												</li>												
												<li class="list-group-item">
													<b> Currency </b>
													<span class="float-right"> <?php echo $fetchOrgConfig[0]['currency'] ?> </span>
												</li>
												<li class="list-group-item">
													<b> Time Zone </b> 
													<span class="float-right"> <?php echo $fetchTimeZone[0]['details'] ?> </span>
												</li>	
											</ul>
										</div>
									</div>
								</div>
								<!--=*= Organization Configuration Content =*=-->
								
								<!--=*= APP Logo Configuration Content =*=-->
								<div class="aboutme-profile">
									<div class="container">
										<div class="row mt-4">
											<div class="col-md-6">
												<div class="card" style="height:146px;">
													<img src="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoConfig[0]['app_favicon'] ?>" class="card-img-top" alt="" style="height:96px;">
													<div class="card-body text-center">
														<h5 class="card-title text-secondary"> App Favicon </h5>
													</div>
												</div>
											</div>											
											<div class="col-md-6">
												<div class="card" style="height:146px;">
													<img src="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoConfig[0]['app_logo'] ?>"" class="card-img-top" alt="" style="height:96px;">
													<div class="card-body text-center">
														<h5 class="card-title text-secondary"> App Logo </h5>
													</div>
												</div>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-md-6">
												<div class="card" style="height:146px;">
													<img src="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoConfig[0]['invoice_logo'] ?>"" class="card-img-top" alt="" style="height:96px;">
													<div class="card-body text-center">
														<h5 class="card-title text-secondary"> Invoice Logo </h5>
													</div>
												</div>
											</div>											
											<div class="col-md-6">
												<div class="card" style="height:146px;">
													<img src="<?php echo $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'] . $fetchLogoConfig[0]['org_logo'] ?>"" class="card-img-top" alt="" style="height:96px;">
													<div class="card-body text-center">
														<h5 class="card-title text-secondary"> Org Logo </h5>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--=*= APP Logo Configuration Content =*=-->
								
							</div>
							<div class="col-lg-8 col-md-12 col-sm-12 col-12">
								
								<!--=*= PHP Mail Configuration Content =*=-->
								<div class="aboutme-profile mt-4">
									<div class="card">
										<div class="page-title">
											<h4 class="text-success"> PHP MAIL 
												<span style="font-weight: 300;"> CONFIGURATION </span> 
											</h4>
										</div>
										<div class="card-body">
											<ul class="list-group list-group-flush">
												<li class="list-group-item">
													<b>Email Address</b> <span class="float-right"><?php echo $fetchPHPMailsettings[0]['ems_php_mail_from']; ?></span>
												</li>
												<li class="list-group-item">
													<b>Email Name</b> <span class="float-right"><?php echo $fetchPHPMailsettings[0]['ems_php_mail_name']; ?></span>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<!--=*= PHP Mail Configuration Content =*=-->
								
								<!--=*= SMTP Configuration Content =*=-->
								<div class="aboutme-profile mt-4">
									<div class="card">
										<div class="page-title">
											<h4 class="text-success"> SMTP 
												<span style="font-weight: 300;"> CONFIGURATION </span> 
											</h4>
										</div>
										<div class="card-body">
											<ul class="list-group list-group-flush">
												<li class="list-group-item"><b>SMTP HOST</b>
													<span class="float-right"> <?php echo $fetchSMTPsettings[0]['ems_smtp_host'] ;?> </span>
												</li>
												<li class="list-group-item"><b>SMTP USER</b>
													<span class="float-right"> <?php echo $fetchSMTPsettings[0]['ems_smtp_user'] ;?> </span>
												</li>												
												<li class="list-group-item"><b>SMTP PORT</b>
													<span class="float-right"> <?php echo $fetchSMTPsettings[0]['ems_smtp_port'] ;?> </span>
												</li>												
												<li class="list-group-item"><b>SMTP PASSWORD</b>
													<span class="float-right"> <?php echo $fetchSMTPsettings[0]['ems_smtp_pass'] ;?> </span>
												</li>																						
												<li class="list-group-item"><b>SMTP Authentication Domain</b>
													<span class="float-right"> <?php echo $fetchSMTPsettings[0]['ems_smtp_auth_domain'] ;?>  </span>
												</li>												
											</ul>
										</div>
									</div>
								</div>
								<!--=*= SMTP Configuration Content =*=-->
								
								<!--=*= Leave Configuration Content =*=-->
								<div class="aboutme-profile mt-4">
									<div class="card">
										<div class="page-title">
											<h4 class="text-success"> LEAVE 
												<span style="font-weight: 300;"> CONFIGURATION </span> 
											</h4>
										</div>
										<div class="card-body">
											<ul class="list-group list-group-flush">
												
											<?php
											if($fetchLeaveConfig > 0)
											{
												foreach($fetchLeaveConfig AS $eachRow)
												{
											?>
													
											<li class="list-group-item">
												<b> <?php echo $eachRow['type'] ?> </b>
												
												<?php
												if($eachRow['status'] == 'Active')
												{
													echo '
													<span class="float-right badge badge-success" style="width:160px; padding: 5px 0px; font-size: 12px;"> 
													'. $eachRow['status'] .'<span class="mr-3"></span>'. $eachRow['days'] .' Days
													</span>';
												}
												else if($eachRow['status'] == 'Inactive')
												{
													echo '
													<span class="float-right badge badge-secondary" style="width:160px; padding: 5px 0px; font-size: 12px;"> 
													'. $eachRow['status'] .'<span class="mr-3"></span>'. $eachRow['days'] .' Days
													<span>';
												}
												?>
												
											</li>
													
											<?php
												}
											}
											?>
												
											</ul>
										</div>
									</div>
								</div>
								<!--=*= Leave Configuration Content =*=-->
								
								<!--=*= Salary Settings Content =*=-->
								<div class="aboutme-profile mt-4">
									<div class="card">
										<div class="page-title">
											<h4 class="text-success">SALARY CONFIGURATION</h4>
										</div>
										<div class="card-body">
											<ul class="list-group list-group-flush">
												<li class="list-group-item">
													<b>DA (%)</b>
													<span class="float-right"> <?php echo $salaryResult[0]['ems_da'] ;?> </span>
												</li>
												<li class="list-group-item">
													<b>HRA (%)</b>
													<span class="float-right"> <?php echo $salaryResult[0]['ems_hra'] ;?> </span>
												</li>												
												<li class="list-group-item">
													<b>Employee Share (%)</b>
													<span class="float-right"> <?php echo $salaryResult[0]['ems_pf_ees_share'] ;?> </span>
												</li>												
												<li class="list-group-item">
													<b>Organization Share (%)</b> 
													<span class="float-right"> <?php echo $salaryResult[0]['ems_pf_org_share'] ;?> </span>
												</li>											
												<li class="list-group-item">
													<b>Employee Share (%)</b>
													<span class="float-right"> <?php echo $salaryResult[0]['ems_esi_ees_share'] ;?> </span>
												</li>												
												<li class="list-group-item">
													<b>Organization Share (%)</b> 
													<span class="float-right"> <?php echo $salaryResult[0]['ems_esi_org_share'] ;?> </span>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<!--=*= Salary Settings Content =*=-->
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| SETTING OVERVIEW CONTENT |#| =*=-->