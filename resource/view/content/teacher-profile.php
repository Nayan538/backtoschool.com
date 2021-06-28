<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
if(isset($_REQUEST['id']))
{
	$_SESSION['GET_TEACHER_PROFILE_ID'] = $_REQUEST['id'];
}	

#Fetch Teacher's Data
$columnName = $tableName =	$whereValue = null;
$columnName = "*";
$tableName = "ems_teachers";
$whereValue["id"] = $_SESSION['GET_TEACHER_PROFILE_ID'];
$fetchTeacherProfile = $eloquent->selectData($columnName, $tableName, $whereValue);

#Fetch Department Data
$columnName = $tableName =	$whereValue = null;
$columnName = "*";
$tableName = "ems_departments";
$whereValue["id"] = $fetchTeacherProfile[0]['department_id'];
$fetchDepartmentData = $eloquent->selectData($columnName, $tableName, @$whereValue);

#Fetch Designation Data
$columnName = $tableName =	$whereValue = null;
$columnName = "*";
$tableName = "ems_designations";
$whereValue["id"] = $fetchTeacherProfile[0]['designation_id'];
$fetchDesignationData = $eloquent->selectData($columnName, $tableName, @$whereValue);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| TEACHER PROFILE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"><span style="font-weight: 300;">
						<?php echo $fetchTeacherProfile[0]['first_name'] .' '. $fetchTeacherProfile[0]['last_name']; ?>'s </span> Profile
					</h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="teachers-infogrid.php"> Teachers </a> </li>
						<li class="list-inline-item"> Teacher Profile </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card-box">
			<div class="row">
				<div class="col-md-12">
					<div class="profile-view">
						<div class="profile-img-wrap">
							<div class="profile-img">
								<a href="<?php echo $GLOBALS['TEACHER_IMAGE_DIRECTORY'].$fetchTeacherProfile[0]['teacher_image'] ?>">
									<img class="avatar" src="<?php echo $GLOBALS['TEACHER_IMAGE_DIRECTORY'].$fetchTeacherProfile[0]['teacher_image']?>" alt="">
								</a>
							</div>
						</div>
						<div class="profile-basic">
							<div class="row">
								<div class="col-md-5">
									<div class="profile-info-left">
										<h3 class="user-name m-t-0">
											<?php echo $fetchTeacherProfile[0]['first_name'] .' '. $fetchTeacherProfile[0]['last_name'] ?>
										</h3>
										<h5 class="company-role m-t-0 m-b-0"> BackToSchool </h5>
										<small class="text-muted"> <?php echo $fetchDepartmentData[0]['department_name'] ?> </small>
										<div class="staff-id"> Employee ID : <?php echo $fetchTeacherProfile[0]['teacher_id'] ?> </div>
										<div class="d-inline">
											<ul class="social-media-list">
												
											<?php
											if(!empty($fetchTeacherProfile[0]['facebook_url']))
											{
											?>
											
											<li>
												<a target="_blank" href="<?php echo $fetchTeacherProfile[0]['facebook_url']; ?>">
													<i class="fab fa-facebook fa-lg text-success"></i>
												</a>
											</li>

											<?php
											}
											if(!empty($fetchTeacherProfile[0]['linkedin_url']))
											{
											?>

											<li>
												<a target="_blank" href="<?php echo $fetchTeacherProfile[0]['linkedin_url']; ?>">
													<i class="fab fa-linkedin-in fa-lg text-success"></i>
												</a>
											</li>

											<?php
											}
											if(!empty($fetchTeacherProfile[0]['youtube_url']))
											{
											?>

											<li>
												<a target="_blank" href="<?php echo $fetchTeacherProfile[0]['youtube_url']; ?>">
													<i class="fab fa-youtube fa-lg text-success"></i>
												</a>
											</li>

											<?php		
											}
											if(!empty($fetchTeacherProfile[0]['twitter_url']))
											{
											?>

											<li>
												<a target="_blank" href="<?php echo $fetchTeacherProfile[0]['twitter_url']; ?>">
													<i class="fab fa-twitter fa-lg text-success"></i>
												</a>
											</li>

											<?php
											}
											?>
												
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<ul class="personal-info">
										<li>
											<span class="title"> Phone: </span>
											<span class="text">
												<a href="tel:<?php echo $fetchTeacherProfile[0]['phone_no'] ?>">
													<?php echo $fetchTeacherProfile[0]['phone_no'] ?> 
												</a>
											</span>
										</li>
										<li>
											<span class="title"> Email: </span>
											<span class="text">
												<a href="mailto:<?php echo $fetchTeacherProfile[0]['email_address'] ?>"> 
													<?php echo $fetchTeacherProfile[0]['email_address'] ?> 
												</a>
											</span>
										</li>
										<li>
											<span class="title"> Birthday: </span>
											<span class="text"> <?php echo $ajaxcontrol->dateOnly($fetchTeacherProfile[0]['birth_date']) ?> </span>
										</li>
										<li>
											<span class="title"> Religion: </span>
											<span class="text"> <?php echo $fetchTeacherProfile[0]['religion'] ?> </span>
										</li>										
										<li>
											<span class="title"> Address: </span>
											<span class="text"> <?php echo $fetchTeacherProfile[0]['present_address'] ?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<div class="card-box">
					<h3 class="card-title text-primary"> About Me </h3>
					<div class="card-body">
						<p> <?php echo $fetchTeacherProfile[0]['about_teacher'] ?> </p>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"> <b> NID </b>
								<span class="float-right text-info"> <?php echo $fetchTeacherProfile[0]['nid_card_no'] ?> </a>
							</li>
							<li class="list-group-item"> <b> Gender </b>
								<span class="float-right text-info"> <?php echo $fetchTeacherProfile[0]['gender'] ?> </span>
							</li>
							<li class="list-group-item"> <b> Degree </b>
								<span class="float-right text-info">
									
									<?php
									#Highest Academic Degree
									$result = '';
									if(!empty($fetchTeacherProfile[0]['graduate_certification_in'])) {
										$result .= $fetchTeacherProfile[0]['graduate_certification_in'];
									} else if (!empty($fetchTeacherProfile[0]['undergraduate_certification_in'])) {
										$result .= $fetchTeacherProfile[0]['undergraduate_certification_in'];
									} else if (!empty($fetchTeacherProfile[0]['hsc_certification_in'])) {
										$result .= $fetchTeacherProfile[0]['hsc_certification_in'];
									}
									echo $result;
									?>
									
								</span>
							</li>
							<li class="list-group-item"> <b> Desgination </b>
								<span class="float-right text-info"> <?php echo $fetchDesignationData[0]['designation_name'] ?> </span>
							</li>
							<li class="list-group-item"> <b> Joining Date </b>
								<span class="float-right text-info"> <?php echo $ajaxcontrol->dateOnly($fetchTeacherProfile[0]['join_date']) ?> </span>
							</li>
						</ul>
						<div class="aboutme-start">
							<div class="row">
								<div class="col-lg-4">
									<div class="aboutme-starttitle text-uppercase"> 37 </div>
									<div class="aboutme-startname text-uppercase"> Papers </div>
								</div>
								<div class="col-lg-4">
									<div class="aboutme-starttitle text-uppercase"> 52 </div>
									<div class="aboutme-startname text-uppercase"> Seminors </div>
								</div>
								<div class="col-lg-4">
									<div class="aboutme-starttitle text-uppercase"> 50 </div>
									<div class="aboutme-startname text-uppercase"> Articles </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title text-primary"> Emergency Contact </h3>
					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item"> <b> Name </b>
								<span class="float-right text-info"> <?php echo $fetchTeacherProfile[0]['contact_name'] ?> </span>
							</li>
							<li class="list-group-item"> <b> Relation </b>
								<span class="float-right text-info"> <?php echo $fetchTeacherProfile[0]['contact_relation'] ?> </span>
							</li>
							<li class="list-group-item"> <b> Phone </b>
								<a href="tel:<?php echo $fetchTeacherProfile[0]['contact_number'] ?>" class="float-right text-info">
									<?php echo $fetchTeacherProfile[0]['contact_number'] ?>
								</a>
							</li>													
							<li class="list-group-item"> <b> Address </b>
								<span class="float-right text-info"> <?php echo $fetchTeacherProfile[0]['contact_address'] ?> </span>
							</li>
						</ul>
					</div>
				</div>				
			</div>
			<div class="col-md-7">
				<div class="card-box">
					<h3 class="card-title text-primary"> Education Informations </h3>
					<div class="experience-box">
						<ul class="experience-list">
							
						<?php
						if($fetchTeacherProfile > 0)
						{
							#Graduation Information
							if(!empty($fetchTeacherProfile[0]['graduate_institution_name']))
							{
								echo '
									<li>
										<div class="experience-user">
											<div class="before-circle"></div>
										</div>
										<div class="experience-content">
											<div class="timeline-content">
												<a target="_blank" href="#" class="name">'. $fetchTeacherProfile[0]['graduate_certification_in'] .'</a>
												<div>'. $fetchTeacherProfile[0]['graduate_institution_name'] .'</div>
												<div>'. $fetchTeacherProfile[0]['graduate_subject_in'] .'</div>
												<div>'. $fetchTeacherProfile[0]['graduate_result'] .'</div>
												<span class="time">'. $fetchTeacherProfile[0]['graduate_year_in'] .'</span>
											</div>
										</div>
									</li>
								';
							}					
							
							#UnderGraduation Information
							if(!empty($fetchTeacherProfile[0]['undergraduate_institution_name']))
							{
								echo '
									<li>
										<div class="experience-user">
											<div class="before-circle"></div>
										</div>
										<div class="experience-content">
											<div class="timeline-content">
												<a target="_blank" href="#" class="name">'. $fetchTeacherProfile[0]['undergraduate_certification_in'] .'</a>
												<div>'. $fetchTeacherProfile[0]['undergraduate_institution_name'] .'</div>
												<div>'. $fetchTeacherProfile[0]['undergraduate_subject_in'] .'</div>
												<div>'. $fetchTeacherProfile[0]['undergraduate_result'] .'</div>
												<span class="time">'. $fetchTeacherProfile[0]['undergraduate_year_in'] .'</span>
											</div>
										</div>
									</li>
								';
							}					
							
							#Higher Secondary Information
							if(!empty($fetchTeacherProfile[0]['hsc_institution_name']))
							{
								echo '
									<li>
										<div class="experience-user">
											<div class="before-circle"></div>
										</div>
										<div class="experience-content">
											<div class="timeline-content">
												<a target="_blank" href="#" class="name">'. $fetchTeacherProfile[0]['hsc_certification_in'] .'</a>
												<div>'. $fetchTeacherProfile[0]['hsc_institution_name'] .'</div>
												<div>'. $fetchTeacherProfile[0]['hsc_group_in'] .'</div>
												<div>'. $fetchTeacherProfile[0]['hsc_result'] .'</div>
												<span class="time">'. $fetchTeacherProfile[0]['hsc_year_in'] .'</span>
											</div>
										</div>
									</li>
								';
							}
						}
						?>
							
						</ul>
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title text-primary"> Experience </h3>
					<div class="experience-box">
						<ul class="experience-list">
							
						<?php
						#Experience Information
						if(!empty($fetchTeacherProfile[0]['exp_org_name']))
						{
							foreach($fetchTeacherProfile AS $eachRow)
							{
								echo '
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#" class="name">'. $eachRow['exp_org_name'] .'</a>
											<div>'. $eachRow['exp_org_location'] .'</div>
											<div>'. $eachRow['exp_job_position'] .'</div>
											<div>'. $eachRow['exp_in_year'] .'</div>
										</div>
									</div>
								</li>
								';
							}
						}
						?>
							
						</ul>
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title text-primary"> Conferences, Cources &amp; Workshop Attended </h3>
					<div class="experience-box">
						<ul class="experience-list">
							
						<?php
						#Extra Carricullam Activities -1
						if(!empty($fetchTeacherProfile[0]['organization_f']))
						{
							foreach($fetchTeacherProfile AS $eachRow)
							{
								echo '
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#" class="name">'. $eachRow['organization_f'] .'</a>
											<div>'. $eachRow['workshop_on_f'] .'</div>
											<div>'. $eachRow['certification_on_f'] .'</div>
											<span class="time">'. $eachRow['in_year_f'] .'</span>
										</div>
									</div>
								</li>	
								';
							}
						}								
						
						#Extra Carricullam Activities -2
						if(!empty($fetchTeacherProfile[0]['organization_s']))
						{
							foreach($fetchTeacherProfile AS $eachRow)
							{
								echo '
								<li>
									<div class="experience-user">
										<div class="before-circle"></div>
									</div>
									<div class="experience-content">
										<div class="timeline-content">
											<a href="#" class="name">'. $eachRow['organization_s'] .'</a>
											<div>'. $eachRow['workshop_on_s'] .'</div>
											<div>'. $eachRow['certification_on_s'] .'</div>
											<span class="time">'. $eachRow['in_year_s'] .'</span>
										</div>
									</div>
								</li>	
								';
							}
						}
						?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| TEACHER PROFILE CONTENT |#| =*=-->																																		