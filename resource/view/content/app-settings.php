<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['saveLogoConfig']))
{
	#Upload Image File Name Generate
	$appFaviconName = 'APP_FAVICON' . date('Ymd') . '_CONFIG_' . rand(100, 999) . @$_FILES['appFavicon']['name'];
	$appLogoName = 'APP_LOGO' . date('Ymd') . '_CONFIG_' . rand(100, 999) . @$_FILES['appLogo']['name'];
	$invoiceLogoName = 'INVOICE_LOGO' . date('Ymd') . '_CONFIG_' . rand(100, 999) . @$_FILES['invoiceLogo']['name'];
	$orgLogoName = 'ORG_LOGO' . date('Ymd') . '_CONFIG_' . rand(100, 999) . @$_FILES['orgLogo']['name'];
	
	#Upload Image File Validation
	$appFavicon = $control->checkImage(@$_FILES['appFavicon']['type'], @$_FILES['appFavicon']['size'], @$_FILES['appFavicon']['error'] == 1);
	$appLogo = $control->checkImage(@$_FILES['appLogo']['type'], @$_FILES['appLogo']['size'], @$_FILES['appLogo']['error'] == 1);
	$invoiceLogo = $control->checkImage(@$_FILES['invoiceLogo']['type'], @$_FILES['invoiceLogo']['size'], @$_FILES['invoiceLogo']['error'] == 1);
	$orgLogo = $control->checkImage(@$_FILES['orgLogo']['type'], @$_FILES['orgLogo']['size'], @$_FILES['orgLogo']['error'] == 1);
	
	#Fetch Data to Check Availability
	$columnName = $tableName = null;
	$columnName = "*";
	$tableName = "ems_icons";
	$fetchLogoData = $eloquent->selectData($columnName, $tableName);
	
	if(!empty($fetchLogoData))
	{	
		#Hold The Fetch Data by Assigning a SESSION Variable
		$_SESSION['GET_LAST_INSERT_ID'] = $fetchLogoData[0]['id'];
		$_SESSION['APP_FAVICON_OLD_IMAGE'] = $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$fetchLogoData[0]['app_favicon'];
		$_SESSION['APP_LOGO_OLD_IMAGE'] = $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$fetchLogoData[0]['app_logo'];
		$_SESSION['INVOICE_LOGO_OLD_IMAGE'] = $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$fetchLogoData[0]['invoice_logo'];
		$_SESSION['ORG_LOGO_OLD_IMAGE'] = $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$fetchLogoData[0]['org_logo'];
		
		#Update Icon/Logo's Data
		if($appFavicon && $appLogo && $invoiceLogo && $orgLogo)
		{
			$tableName = $columnValue = null;
			$tableName = "ems_icons";
			$columnValue["app_favicon"] = $appFaviconName;
			$columnValue["app_logo"] = $appLogoName;
			$columnValue["invoice_logo"] = $invoiceLogoName;
			$columnValue["org_logo"] = $orgLogoName;
			$columnValue["updated_at"] = date('Y-m-d H:i:s');
			$whereValue["id"] = $_SESSION['GET_LAST_INSERT_ID'];
			$updateLogoData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if(!empty($updateLogoData))
			{
				#Store The Uploaded Files Into The Defined Directory
				move_uploaded_file(@$_FILES['appFavicon']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$appFaviconName);
				move_uploaded_file(@$_FILES['appLogo']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$appLogoName);
				move_uploaded_file(@$_FILES['invoiceLogo']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$invoiceLogoName);
				move_uploaded_file(@$_FILES['orgLogo']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$orgLogoName);
				
				#Remove The Previous Image from The Defined Directory
				unlink($_SESSION['APP_FAVICON_OLD_IMAGE']);
				unlink($_SESSION['APP_LOGO_OLD_IMAGE']);
				unlink($_SESSION['INVOICE_LOGO_OLD_IMAGE']);
				unlink($_SESSION['ORG_LOGO_OLD_IMAGE']);
			}
		}
	}
	else
	{
		#Insert Icon/Logo's Data
		if($appFavicon && $appLogo && $invoiceLogo && $orgLogo)
		{
			$tableName = $columnValue = null;
			$tableName = "ems_icons";
			$columnValue["app_favicon"] = $appFaviconName;
			$columnValue["app_logo"] = $appLogoName;
			$columnValue["invoice_logo"] = $invoiceLogoName;
			$columnValue["org_logo"] = $orgLogoName;
			$columnValue["created_at"] = date('Y-m-d H:i:s');
			$insertLogoData = $eloquent->insertData($tableName, $columnValue);
			
			if($insertLogoData['LAST_INSERT_ID'] > 0)
			{
				#Store The Uploaded Files Into The Defined Directory
				move_uploaded_file(@$_FILES['appFavicon']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$appFaviconName);
				move_uploaded_file(@$_FILES['appLogo']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$appLogoName);
				move_uploaded_file(@$_FILES['invoiceLogo']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$invoiceLogoName);
				move_uploaded_file(@$_FILES['orgLogo']['tmp_name'], $GLOBALS['APP_LOGO_IMAGES_DIRECTORY'].$orgLogoName);
			}
		}
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch TimeZone Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "name";
$columnName["3"] = "details";
$tableName = "ems_timezone";
$fetchTimeZone = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= Style Defined =*=-->
<style>
	.input-group, .input-group-prepend, .form-control {
		height: 38px !important;
	}
	.nav-pills .nav-link.active {
		color: #01c0c8; 
		background-color: #f6f6f6;
		border-left: 5px solid #01c0c8;
	}
	.card-box ul li a {
		color: #6c757d;
		font-weight: 500;
	}
</style>
<!--=*= Style Defined =*=-->

<!--=*= Side Navigation Bar =*=-->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div class="sidebar-menu">
			<ul>
				<li><a href="dashboard.php"> <i class="fa fa-home back-icon"></i> Back to Home </a> </li>
				<li class="menu-title"> Settings Overview </li>
				<li> <a href="settings-dashboard.php"> Dashboard </a> </li>
				<li class="active"> <a href="app-settings.php"> App Settings </a> </li>
				<li> <a href="roles-permissions.php"> Roles & Permissions </a> </li>
				<li> <a href="#"> Accounts Settings </a> </li>
			</ul>
		</div>
	</div>
</div>
<!--=*= Side Navigation Bar =*=-->


<!--=*= |#| APP SETTING CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> App <span style="font-weight: 300;"> Settings </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="settings-dashboard.php"> Settings </a> </li>
						<li class="list-inline-item"> App Settings </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<div class="card-box">
							<ul class="nav flex-column nav-pills nav-justified" aria-orientation="vertical">
								<li class="nav-item text-left">
									<a class="nav-link active" href="#tab1" data-toggle="tab"> Logo Configuration </a>
								</li>								
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab2" data-toggle="tab"> Organization Information </a>
								</li>								
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab3" data-toggle="tab"> Authorized Person </a>
								</li>
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab4" data-toggle="tab"> PHP Mail Configuration </a>
								</li>
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab5" data-toggle="tab"> SMTP Configuration </a>
								</li>								
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab6" data-toggle="tab"> Leave Configuration </a>
								</li>								
							</ul>
						</div>
					</div>
					<div class="col-md-8 ml-5">
						<div class="card-box">
							<div class="tab-content">
								
								<!--=*= Logo Configuration Content =*=-->
								<div class="tab-pane show active" id="tab1">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Logo 
												<span style="font-weight: 300;" class="text-dark text-lowercase"> Configuration </span> 
												<hr>
											</h3>
											
											<?php
											#Insert and/or Update Confirmation Message
											if(isset($_POST['saveLogoConfig']))
											{
												if(@$insertLogoData > 0 || @$updateLogoData > 0)
												{
													echo '
													<div class="alert alert-success alert-dismissible fade show" role="alert">
														<strong> Congratulation! Uploaded data is set successfully! </strong>
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													';
												}
											}
											?>
											
											<form action="" method="post" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label for="fileupload1" class="btn btn-outline-secondary btn-sm form-control-file"> 
																<i class="fas fa-cloud-upload-alt"></i> &nbsp; App Favicon 
															</label>
															<input type="file" name="appFavicon" id="fileupload1" class="form-control-file fileupload" onchange="readURL(this);" set-to="div1" style="visibility: hidden;" required>
														</div>
														<div id="appFavicon" class="text-center" style="margin-top: -30px;"> </div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="fileupload2" class="btn btn-outline-danger btn-sm form-control-file"> 
																<i class="fas fa-cloud-upload-alt"></i> &nbsp; App Logo 
															</label>
															<input type="file" name="appLogo" id="fileupload2" class="form-control-file" onchange="readURL(this);" set-to="div2" style="visibility: hidden;" required>
														</div>
														<div id="appLogo" class="text-center" style="margin-top: -30px;"> </div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="fileupload3" class="btn btn-outline-warning btn-sm form-control-file"> 
																<i class="fas fa-cloud-upload-alt"></i> &nbsp; Invoice Logo
															</label>
															<input type="file" name="invoiceLogo"  id="fileupload3" class="form-control-file fileupload" onchange="readURL(this);" set-to="div3" style="visibility: hidden;" required>
														</div>
														<div id="invoiceLogo" class="text-center" style="margin-top: -30px;"> </div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="fileupload4" class="btn btn-outline-info btn-sm form-control-file"> 
																<i class="fas fa-cloud-upload-alt"></i> &nbsp; Org Logo
															</label>
															<input type="file" name="orgLogo" id="fileupload4" class="form-control-file fileupload" onchange="readURL(this);" set-to="div4" style="visibility: hidden;" required>
														</div>
														<div id="orgLogo" class="text-center" style="margin-top: -30px;"> </div>
													</div>
												</div>
												<div class="row mt-4">
													<div class="col-sm-12 text-center">
														<button type="submit" name="saveLogoConfig" class="btn btn-outline-success btn-sm mb-3" style="width: 160px;">
															<i class="fa fa-plus-circle mr-1"></i> Save Changes
														</button>
														<button type="reset" class="btn btn-outline-dark btn-sm mb-3" id="reset" style="width: 160px;">
															<i class="fas fa-power-off"></i> Reset Data
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--=*= Logo Configuration Content =*=-->

								
								<!--=*= Organization Information Content =*=-->
								<div class="tab-pane" id="tab2">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Organization
												<span style="font-weight: 300;" class="text-dark text-lowercase"> Information </span> 
												<hr>
											</h3>
											<form id="schoolInformation">
												<div class="row">
													<div class="col-md-10 offset-md-1">
														<div id="schoolErrorMessage"></div>
														<div id="schoolSuccessMessage"></div>
														<div class="row">
															<div class="col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="fas fa-laptop-house text-info mr-2"></i> Organization
																		</span>
																	</div>
																	<input type="text" class="form-control" id="organization">
																</div>
															</div>
															<div class="col-md-8">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text" style="padding-right: 16px;">
																			<i class="fas fa-globe text-info mr-2"></i> Website URL
																		</span>
																	</div>
																	<input type="text" class="form-control" id="webUrl">
																</div>
															</div>
															<div class="col-md-4">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<label class="input-group-text">
																			<i class="fas fa-euro-sign text-info mr-2"></i> Currency
																		</label>
																	</div>
																	<select class="custom-select" id="currency">
																		<option> Choose </option>
																		<option value="BDT">BDT</option>
																		<option value="USD">USD</option>
																		<option value="EURO">EURO</option>
																	</select>
																</div>
															</div>
															<div class="col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<label class="input-group-text" style="padding-right: 34px;">
																			<i class="fas fa-hourglass-half text-info mr-2"></i> Time Zone
																		</label>
																	</div>
																	<select class="custom-select" id="timezone" required>
																		<option> Choose... </option>
																		
																		<?php
																		foreach($fetchTimeZone AS $eachZone)
																		{
																			echo '<option value="'.$eachZone['id'].'">'. $eachZone['details'] .'</option>';
																		}
																		?>
																		
																	</select>
																</div>
															</div>
															<div class="col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text" style="padding-right: 44px;">
																			<i class="fas fa-map-marked-alt text-info mr-2"></i> Address
																		</span>
																	</div>
																	<input type="text" class="form-control" id="address">
																</div>
															</div>
															<div class="col-sm-12 text-center mt-4">
																<button type="submit" id="saveSchoolInfo" class="btn btn-outline-success btn-sm mb-3" style="width: 160px;">
																	<i class="fa fa-plus-circle mr-1"></i> Save Changes
																</button>
																<button type="reset" class="btn btn-outline-dark btn-sm mb-3" style="width: 160px;">
																	<i class="fas fa-power-off"></i> Reset Data
																</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--=*= Organization Information Content =*=-->
								
								
								<!--=*= Contact Configuration Content =*=-->
								<div class="tab-pane" id="tab3">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Contact
												<span style="font-weight: 300;" class="text-dark text-lowercase"> Configuration (a person) </span> 
												<hr>
											</h3>
											<form id="contactConfig">
												<div class="row">
													<div class="col-md-10 offset-md-1">
														<div id="contactErrorMessage"></div>
														<div id="contactSuccessMessage"></div>
													</div>
													<div class="col-md-10 offset-md-1">
														<div class="profile-img-wrap">
															<img class="inline-block" src="public/assets/img/user.jpg" alt="user" id="div5">
															<div class="fileupload btn">
																<span class="btn-text">person</span>
																<input class="upload" type="file" name="contactImage" onchange="readURL(this);" set-to="div5" required>
															</div>
														</div>
														<div class="profile-basic">
															<div class="row mt-3">
																<div class="col-md-12">
																	<div class="input-group mb-3">
																		<div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="far fa-user-circle text-warning mr-1"></i> Authentic to
																			</span>
																		</div>
																		<input type="text" class="form-control" name="fullName" required>
																	</div>
																</div>																
																<div class="col-md-12">
																	<div class="input-group mb-3">
																		<div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="fas fa-hashtag text-warning mr-1"></i> Designation
																			</span>
																		</div>
																		<input type="text" class="form-control" name="designation" required>
																	</div>
																</div>
															</div>
														</div>
														<div class="row mt-3">
															<div class="col-md-6">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="far fa-envelope text-warning mr-1"></i> Email
																		</span>
																	</div>
																	<input type="email" class="form-control" name="contactEmail" required>
																</div>
															</div>	
															<div class="col-md-6">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="fas fa-fax text-warning mr-1"></i> FAX
																		</span>
																	</div>
																	<input type="text" class="form-control" name="contactFax" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="fas fa-mobile-alt text-warning mr-1"></i> Phone
																		</span>
																	</div>
																	<input type="tel" class="form-control" name="contactPhone" required>
																</div>
															</div>																
															<div class="col-md-6">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text" style="padding-right: 20px;">
																			<i class="fas fa-tty text-warning mr-1"></i> Tel
																		</span>
																	</div>
																	<input type="tel" class="form-control" name="contactTelephone" required>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row mt-4">
													<div class="col-sm-12 text-center">
														<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="saveContactInfo" style="width: 160px;">
															<i class="fa fa-plus-circle mr-1"></i> Save Changes
														</button>
														<button type="reset" class="btn btn-outline-dark btn-sm mb-3" style="width: 160px;">
															<i class="fas fa-power-off"></i> Reset Data
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--=*= Contact Configuration Content =*=-->
								
								
								<!--=*= PHP Mail Content =*=-->
								<div class="tab-pane" id="tab4">
									<div class="row">
										<div class="col-sm-10 offset-sm-1">
											<h3 class="text-capitalize text-info text-center"> PHP 
												<span style="font-weight: 300;" class="text-dark text-lowercase"> Mail Configuration </span> 
												<hr>
											</h3>
											<div id="php-error-message"></div>
											<div id="php-success-message"></div>
											<form id="php-mail-setting">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-envelope text-success mr-1"></i> Email From Address
																</span>
															</div>
															<input type="email" class="form-control text-right" id="mail_from" placeholder="info@oldschool.com">
														</div>
													</div>											
													<div class="col-md-12">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-user-check text-success mr-2"></i> Emails From Name
																</span>
															</div>
															<input type="text" class="form-control text-right" id="mail_name" placeholder="Abdullah Al Mamun Roni">
														</div>
													</div>
												</div>	
												<div class="row">
													<div class="col-sm-12 text-center m-t-20">
														<button type="sumbit" id="php-mail" class="btn btn-outline-success btn-sm mb-3" style="width: 160px;">
															<i class="fa fa-plus-circle mr-1"></i> Save Changes
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--=*= PHP Mail Content =*=-->

								
								<!--=*= SMTP Content =*=-->
								<div class="tab-pane overflow-auto" id="tab5">
									<div class="row">
										<div class="col-sm-10 offset-sm-1">
											<h3 class="text-capitalize text-info text-center"> SMTP 
												<span style="font-weight: 300;" class="text-dark text-lowercase"> Configuration </span> 
												<hr>
											</h3>
											<div id="smtp-error-message"></div>
											<div id="smtp-success-message"></div>
											<form id="smtp-mail-setting">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-server text-danger mr-2"></i> 
																	<span style="margin-right: 55px;">SMTP HOST</span>
																</span>
															</div>
															<input type="text" class="form-control" id="host" placeholder="mail.servername.com">
														</div>
													</div>											
													<div class="col-md-12">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-user-shield text-danger mr-2"></i> 
																	<span style="margin-right: 55px;">SMTP USER</span>
																</span>
															</div>
															<input type="text" class="form-control" id="user" placeholder="noreply@servername.com">
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fab fa-megaport text-danger mr-2"></i> 
																	<span style="margin-right: 57px;">SMTP PORT</span>
																</span>
															</div>
															<input type="text" class="form-control" id="port" value="465">
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<label class="input-group-text">
																	<i class="fas fa-random text-danger mr-2"></i> SMTP Authantication
																</label>
															</div>
															<select class="custom-select" id="domain">
																<option value="None">None</option>
																<option value="SSL">SSL</option>
																<option value="TLS">TLS</option>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-unlock-alt text-danger mr-2"></i> 
																	<span style="margin-right: 15px;">SMTP PASSWORD</span>
																</span>
															</div>
															<input type="password" class="form-control" id="password" placeholder="abc123***">
														</div>
													</div>
												</div>	
												<div class="row">
													<div class="col-sm-12 text-center m-t-20">
														<button type="submit" id="save-smtp" class="btn btn-outline-success btn-sm mb-3" style="width: 160px;">
															<i class="fa fa-plus-circle mr-1"></i> Save Changes
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--=*= SMTP Content =*=-->
								
								<!--=*= Leave Content =*=-->
								<div class="tab-pane" id="tab6">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Leave 
												<span style="font-weight: 300;" class="text-dark text-lowercase"> Configuration </span> 
												<hr>
											</h3>
											<div id="insertErrorMessage"> </div>
											<div id="insertSuccessMessage"> </div>
											<div id="insertValidationMessage"> </div>
											<form id="leaveForm">
												<div class="row">
													<div class="col-md-4">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<label class="input-group-text" style="height: 34px;"> Type </label>
															</div>
															<select class="custom-select" id="leave_type" style="height: 34px;">
																<option> Choose... </option>
																
																<?php
																$leaveType = ['Annual Leave', 'Casual Leave', 'Earned Leave', 'Festival Holidays', 'Medical Leave', 'Maternity Leave', 'Paternity Leave', 'Study Leave'];
																foreach($leaveType AS $eachOption)
																{
																	echo '<option value="'. $eachOption .'">'. $eachOption .'</option>';
																}
																?>
																
															</select>
														</div>
													</div>
													<div class="col-md-3">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" style="height:34px;"> Days </span>
															</div>
															<input type="number" min="1" max="99" class="form-control" id="leave_day" style="height:34px !important;">
														</div>
													</div>
													<div class="col-md-4">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<label class="input-group-text" style="height: 34px;"> Status </label>
															</div>
															<select class="custom-select" id="leave_status" style="height: 34px;">
																<option>Choose..</option>
																
																<?php
																$statusType = ['Active', 'Inactive'];
																foreach($statusType AS $eachOption)
																{
																	echo '<option value="'. $eachOption .'">'. $eachOption .'</option>';
																}
																?>
																
															</select>
														</div>
													</div>
													<div class="col-md-1">
														<button type="submit" class="btn btn-outline-success btn-sm" id="addLeaveConfig" style="margin-left: -5px;">
															<i class="fa fa-plus-circle fa-lg pt-1 pb-1"></i>
														</button>							
													</div>
												</div>	
											</form>
										</div>
										<div class="col-md-12">
										<div id="errorMessage"></div>
										<div id="successMessage"></div>
										<div class="table-responsive card-box">
											<table class="table table-sm table-hover custom-table">
												<thead>
													<tr>
														<th style="width: 5%"> # </th>
														<th style="width: 30%"> Leave Type </th>
														<th style="width: 20%"> Leave Days </th>
														<th style="width: 30%"> Status </th>
														<th style="width: 15%"> Action </th>
													</tr>
												</thead>
												<tbody id="leaveData">	
													<!--=*= All The Leave Data =*=-->
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!--=*= Leave Content =*=-->
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| APP SETTING CONTENT |#| =*=-->



<!--=*= Edit Leave Data =*=-->
<div id="editLeaveConfig" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Leave Type</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div id="update"></div>
		</div>
	</div>
</div>
<!--=*= Edit Leave Data =*=-->

<!--=*= Delete Leave Confirmation =*=-->
<div id="deleteLeaveConfig" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Do you want to <span class="text-danger"> Delete </span> this Leave Config info?</h4>
				<button type="button" class="close" id="close-modal" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body m-b-10">
				<div class="m-t-10"> 
					<button class="btn btn-dark btn-sm" id="close-modal" data-dismiss="modal" style="width: 86px;"> Close </button>
					<button class="btn btn-warning btn-sm deleteData" style="width: 86px;"> Delete </button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Leave Confirmation =*=-->



<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">

/*
------------------------------------------------
| =*=*=*=*= Logo Configuration Content =*=*=*=*=
------------------------------------------------
*/

	$(document).ready(function() {
		$(':input[name="appFavicon"]').on('change', function(e) {
			
			var appFaviconName = e.target.files[0].name;		
			
			$('#appFavicon').html('<div class="card fileupload fileupload-new" data-provides="fileupload1"><div class="fileupload-new thumbnail"><img src="" class="card-img-top" alt="" id="div1" height="96px" width="96px"></div><div class="card-body"><p class="card-text">'+ appFaviconName +'</p></div></div>');
		});
		
		$(':input[name="appLogo"]').on('change', function(e) {
			
			var appLogoName = e.target.files[0].name;			
			
			$('#appLogo').html('<div class="card fileupload fileupload-new" data-provides="fileupload2"><div class="fileupload-new thumbnail"><img src="" class="card-img-top" alt="" id="div2" height="96px" width="96px"></div><div class="card-body"><p class="card-text">'+ appLogoName +'</p></div></div>');
		});
		
		$(':input[name="invoiceLogo"]').on('change', function(e) {
			
			var invoiceLogo = e.target.files[0].name;
			
			$('#invoiceLogo').html('<div class="card fileupload fileupload-new" data-provides="fileupload3"><div class="fileupload-new thumbnail"><img src="" class="card-img-top" alt="" id="div3" height="96px" width="96px"></div><div class="card-body"><p class="card-text">'+ invoiceLogo +'</p></div></div>');			
		});
		
		$(':input[name="orgLogo"]').on('change', function(e) {
			
			var orgLogoName = e.target.files[0].name;
			
			$('#orgLogo').html('<div class="card fileupload fileupload-new" data-provides="fileupload4"><div class="fileupload-new thumbnail"><img src="" class="card-img-top" alt="" id="div4" height="96px" width="96px"></div><div class="card-body"><p class="card-text">'+ orgLogoName +'</p></div></div>');
		});
		
		
		$('#reset').on('click', function() {
			$('#appFavicon').html('');
			$('#appLogo').html('');
			$('#invoiceLogo').html('');
			$('#orgLogo').html('');
		});
	});




/*
--------------------------------------------------------
| =*=*=*=*= Organization Configuration Content =*=*=*=*=
--------------------------------------------------------
*/

	$(document).ready(function() {
		$('#saveSchoolInfo').on('click', function(e) {
			e.preventDefault();
			var org = $('#organization').val();
			var url = $('#webUrl').val();
			var cur = $('#currency').val();
			var tzn = $('#timezone').val();
			var add = $('#address').val();
			
			if(org == '' || url == '' || cur == '' || tzn == '' || add == '')
			{
				$('#schoolErrorMessage').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>All fields are required !</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
				
				$('#schoolSuccessMessage').slideUp();
			}
			else
			{
				$.ajax({
					url: 'ajax/orgConfig.php',
					type: 'POST',
					data: {action: "INSERT", org:org, url:url, cur:cur, tzn:tzn, add:add},
					success: function(data) {
						if(data == 1) 
						{
							$('#schoolInformation').trigger('reset');
							
							$('#schoolSuccessMessage').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! School Information is set successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$('#schoolErrorMessage').slideUp();
						}
						else
						{
							$('#schoolErrorMessage').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong> Please input a correct data <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$('#schoolSuccessMessage').slideUp();
						}
					}
				});
			}
		});
	});
	

	
/*
---------------------------------------------------
| =*=*=*=*= Contact Configuration Content =*=*=*=*=
---------------------------------------------------
*/

	$(document).ready(function(){
		$('#contactConfig').on('submit', function(e){
			e.preventDefault();
			
			var formData = new FormData(this);
			
			$.ajax({
				url: 'ajax/contactConfig.php',
				type: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data) {
					if(data == 1)
					{
						$('#contactConfig').trigger('reset');
						
						$("#contactSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! Contact configuration data is set successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						
						$("#contactErrorMessage").slideUp();	
					}
					else
					{
						$("#contactErrorMessage").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>All fields are required !</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						
						$("#contactSuccessMessage").slideUp();		
					}
				}
			});
		});
	});
	
	

/*
----------------------------------------------------
| =*=*=*=*= PHP Mail Configuration Content =*=*=*=*=
----------------------------------------------------
*/

	$(document).ready(function() {
		
		$('#php-mail').click(function(e){
			e.preventDefault();
			
			var mailFrom = $('#mail_from').val();
			var mailName = $('#mail_name').val();
			
			if(mailFrom == '' || mailName == '')
			{
				$("#php-error-message").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>All fields are required !</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
				
				$("#php-success-message").slideUp();
			} 
			else 
			{
				$.ajax({
					url: 'ajax/phpMail.php',
					type: 'POST',
					data: {php_mail: "YES", from:mailFrom, name:mailName},
					success: function(data) {
						if(data == 1)
						{
							$('#php-mail-setting').trigger('reset');
							$("#php-success-message").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! PHP Mail settings data is set successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#php-error-message").slideUp();
						} 
						else 
						{
							$("#php-error-message").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>All fields are required !</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#php-success-message").slideUp();
						}
					}
				});
			}
		});	
	});

	
	

/*
------------------------------------------------
| =*=*=*=*= SMTP Configuration Content =*=*=*=*=
------------------------------------------------
*/

	$(document).ready(function(){
		$('#save-smtp').click(function(e){
			e.preventDefault();
			
			var hostName = $('#host').val();
			var userName = $('#user').val();
			var portName = $('#port').val();
			var domainName = $('#domain').val();
			var smtpPass = $('#password').val();
			
			if(hostName == '' || userName == ''  || portName == ''  || domainName == '' || smtpPass == '')
			{
				$("#smtp-error-message").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>All fields are required !</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
				$("#smtp-success-message").slideUp();
			} 
			else 
			{
				$.ajax({
					url: 'ajax/smtpMail.php',
					type: 'POST',
					data: {smtp_mail: "YES", host:hostName, user:userName, port:portName, domain:domainName, pass:smtpPass},
					success: function(data) {
						if(data == 1)
						{
							$('#smtp-mail-setting').trigger('reset');
							
							$("#smtp-success-message").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! SMTP Mail settings data is set successfully! </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#smtp-error-message").slideUp();
						} 
						else 
						{
							$("#smtp-error-message").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>All fields are required!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#smtp-success-message").slideUp();
						}
					}
				});
			}
		});	
	});



/*
-------------------------------------------------
| =*=*=*=*= Leave Configuration Content =*=*=*=*=
-------------------------------------------------
*/

	$(document).ready(function(){
		
		//Fetch Leave Config Data
		function loadTable(){
			$.ajax({
				url: 'ajax/leaveConfig.php',
				type: 'POST',
				data: {action: "loadLeaveData"},
				success: function(data){
					$('#leaveData').html(data);
				}
			});
		};
		loadTable();

		//Insert Leave Configuration Data
		$('#addLeaveConfig').click(function(e) {
			e.preventDefault();  
			
			var type = $("#leave_type").val();
			var day = $("#leave_day").val();
			var status = $("#leave_status").val();
			
			if(type == '' || day == '' || status == '') 
			{
				$("#insertErrorMessage").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>All fields are required!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
				$("#insertSuccessMessage").slideUp();
				$("#insertValidationMessage").slideUp();
			} 
			else
			{
				$.ajax({
					url: 'ajax/leaveConfig.php',
					type: 'POST',
					data: {addLeave: "YES", type:type, day:day, status:status},
					success: function(data) {
						console.log(data);
						if(data == 1) 
						{
							loadTable(); // CALL THE FUNCTION TO LOAD DATA
							
							$('#leaveForm').trigger('reset'); // RESET THE INPUT FIELD
							
							$("#insertSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data is inserted successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#insertErrorMessage").slideUp();
							$("#insertValidationMessage").slideUp();
							
						} else if(data == 2) {
							$("#insertValidationMessage").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong> Already have an existing data! </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#insertSuccessMessage").slideUp();
							$("#insertErrorMessage").slideUp();
							
						} else {
							$("#insertErrorMessage").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>All fields are required!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#insertSuccessMessage").slideUp();
							$("#insertValidationMessage").slideUp();
						}
					}
				});
			}
		});
		
		
		//Edit Leave Configuration Data
		$(document).on("click","#editData", function(){
			$('#editLeaveConfig').show();
			
			var action = 'data';
			var editData = $(this).data('eid');
			var element = this;
			
			$.ajax({
				url: 'ajax/leaveConfig.php',
				type: 'POST',
				data: {action_data:action, id:editData},
				success: function(data){
					$("#update").html(data);
				}
			});
		});
		
		//Close Modal
		$(document).on("click",".close", function(){
			$('#editLeaveConfig').hide();
		});


		//Update Leave Configuration Data
		$(document).on("click","#updateData", function(e) {
			e.preventDefault(); 
			
			var updateId = $("#edit_id").val();
			var updateDay = $("#edit_day").val();
			var updateStatus = $("#edit_status").val();
			
			$.ajax({
				url: 'ajax/leaveConfig.php',
				type: 'POST',
				data: {action: "leaveUpdate", id:updateId, day:updateDay, status:updateStatus},
				success: function(data) {
					if(data == 1) 
					{
						$('#editLeaveConfig').hide();

						loadTable();
						
						$("#successMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data is updated successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						
						$("#errorMessage").slideUp();
					} 
					else 
					{
						$("#errorMessage").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Unable to update data! </strong>Please retry..<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						
						$("#successMessage").slideUp();
					}
				}
			});
		});
		

		//Delete Leave Configuration Data
		$(document).on("click", ".delete", function() {
			$('#deleteLeaveConfig').show();
			
			var action = 'data';
			var delData = $(this).data('did');
			var element = this;
			
			$(".deleteData").click(function() {
				
				$.ajax({
					url: 'ajax/leaveConfig.php',
					type: 'POST',
					data: {action_delete:action, id:delData},
					success: function(data){
						if(data == 1) 
						{
							$(element).closest('tr').fadeOut();
							
							$("#successMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data is deleted successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#errorMessage").slideUp();
							
							$('#deleteLeaveConfig').hide();
						} 
						else 
						{
							$("#errorMessage").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Unable to delete data! </strong>Please retry..<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
							
							$("#successMessage").slideUp();
						}
					}
				});
			});
		});
		
		//Close Modal
		$(document).on("click","#close-modal", function(){
			$('#deleteLeaveConfig').hide();
		});

	});
	
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->																					