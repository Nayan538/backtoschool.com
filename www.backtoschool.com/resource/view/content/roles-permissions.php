<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Admin Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_admins";
$fetchAdminData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= Side Navigation Bar =*=-->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div class="sidebar-menu">
			<ul>
				<li> <a href="dashboard.php"> <i class="fa fa-home back-icon"></i> Back to Home </a> </li>
				<li class="menu-title">Settings</li>
				<li> <a href="settings-dashboard.php"> Dashboard </a> </li>
				<li> <a href="app-settings.php"> App Settings </a> </li>
				<li class="active"><a href="roles-permissions.php"> Roles & Permissions </a> </li>
				<li> <a href="#"> Accounts Settings </a> </li>
			</ul>
		</div>
	</div>
</div>
<!--=*= Side Navigation Bar =*=-->

<!--=*= Style Defined =*=-->
<style>
	.input-group, .input-group-prepend, .form-control {height: 38px !important;}
	.nav-pills .nav-link.active {color: #01c0c8; background-color: #f6f6f6; border-left: 5px solid #01c0c8;}
	a {color: ##01c0c8; font-weight: 500;}
</style>
<!--=*= Style Defined =*=-->

<!--=*= |#| ROLES AND PERMISSION SETTINGS CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">Roles <span style="font-weight: 300;">&amp; Permissions</span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="settings-dashboard.php"> Settings </a> </li>
						<li class="list-inline-item"> Roles & Permissions </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">

		<?php
		if(!empty($fetchAdminData))
		{
			$n = 1;
			foreach($fetchAdminData AS $eachAdmin)
			{
		?>

		<div class="col-md-8 offset-md-2">
			<div class="row card-box">
				<div class="col-md-6">
					<div class="edit-profile-img">
						<img src="<?php echo $GLOBALS['ADMIN_IMAGE_DIRECTORY'] . $eachAdmin['admin_image'] ?>" alt="">
					</div>
					<div class="text-center"> 
						<h3 class="user-name m-t-30"> <?php echo $eachAdmin['admin_name'] ?> </h3>
					</div>
					<div class="chat-profile-info m-t-10">
						<ul class="user-det-list">
							<li>
								<span> Designation: </span>
								<span class="float-right text-muted"> <?php echo $eachAdmin['admin_type'] ?> </span>
							</li>
							<li>
								<span> Email: </span>
								<span class="float-right text-muted"> <?php echo $eachAdmin['admin_email'] ?> </span>
							</li>
							<li>
								<span> Phone: </span>
								<span class="float-right text-muted"> <?php echo '+88' . $eachAdmin['admin_phone_no'] ?> </span>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 mt-5">
					<h3 class="text-primary text-center"> Access Permission </h3>
					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<b> Admission Date </b>
								<span class="float-right font-weight-bold mr-2"> 
									<input type="checkbox" class="input"><label>ACCESS PERMIT</label>
								</span>
							</li>							
							<li class="list-group-item">
								<b> Present Score </b>
								<span class="float-right font-weight-bold mr-2"> 
									<input type="checkbox" class="input"><label>ACCESS PERMIT</label> 
								</span>
							</li>							
							<li class="list-group-item">
								<b> Absent Score </b>
								<span class="float-right font-weight-bold mr-2"> 
									<input type="checkbox" class="input"><label>ACCESS PERMIT</label> 
								</span>
							</li>							
							<li class="list-group-item">
								<b> Behaviour Score </b>
								<span class="float-right font-weight-bold mr-2"> 
									<input type="checkbox" class="input"><label>ACCESS PERMIT</label> 
								</span>
							</li>
							<li class="list-group-item">
								<b> Teachers Observation </b>
								<span class="float-right font-weight-bold mr-2"> 
									<input type="checkbox" class="input"><label>ACCESS PERMIT</label> 
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<?php
				$n++;
			}
		}
		?>

		</div>
	</div>
</div>
<!--=*= |#| ROLES AND PERMISSION SETTINGS CONTENT |#| =*=-->