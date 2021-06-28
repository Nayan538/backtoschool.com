<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
if(isset($_REQUEST['id']))
{
	$_SESSION['STUDENT_PROFILE_ID'] = $_REQUEST['id'];
}

#Fetch Student's Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_students";
$whereValue["id"] = $_SESSION['STUDENT_PROFILE_ID'];
$fetchStudentData = $eloquent->selectData($columnName, $tableName, @$whereValue);	

#Fetch Parent's Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_parents";
$whereValue["student_id"] = $_SESSION['STUDENT_PROFILE_ID'];
$fetchParentsData = $eloquent->selectData($columnName, $tableName, @$whereValue);

#Fetch Class Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_classes";
$whereValue["id"] = $fetchStudentData[0]['class_id'];
$fetchClassesData = $eloquent->selectData($columnName, $tableName, @$whereValue);					

#Fetch Shift Data
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "ems_shifts";
$whereValue["id"] = $fetchStudentData[0]['shift_id'];
$fetchShiftData = $eloquent->selectData($columnName, $tableName, @$whereValue);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| STUDENT PROFILE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> 
						<span style="font-weight: 300;"> 
							<?php echo $fetchStudentData[0]['first_name'] .' '. $fetchStudentData[0]['last_name'] . " 's"; ?> </span> Profile 
					</h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="students-infogrid.php"> Student </a> </li>
						<li class="list-inline-item"> Student Profile </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<div class="card mb-4">
					<div class="row no-gutters">
						<div class="col-md-4">
							<img src="<?php echo $GLOBALS['STUDENT_IMAGE_DIRECTORY'].$fetchStudentData[0]['student_image']; ?>" class="card-img" alt="">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h3 class="user-name m-t-0"> <?php echo $fetchStudentData[0]['last_name']; ?> </h3>
								<h5 class="staff-id"> Student ID : <?php echo $fetchStudentData[0]['student_id']; ?> </h5>
								<h3 class="card-title text-primary"> Simple Bio: </h3>
								<div class="card-text"> This is a wider card longer. Lorem ipsum dollar sit amet </div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-box">
					<h3 class="card-title text-primary"> Management Overview </h3>
					<div class="card-body">
						<p>
							Hello I am Michael V. Buttars .Lorem Ipsum is simply dummy text of the printing and
							typesetting industry. Lorem Ipsum has been the...
						</p>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<b> Admission Date </b>
								<span class="float-right font-weight-bold mr-2"> 
									<?php echo $ajaxcontrol->dateOnly($fetchStudentData[0]['admission_date']) ?> 
								</span>
							</li>							
							<li class="list-group-item">
								<b> Present Score </b><span class="float-right font-weight-bold mr-2"> 93% </span>
							</li>							
							<li class="list-group-item">
								<b> Absent Score </b><span class="float-right font-weight-bold mr-2"> 7% </span>
							</li>							
							<li class="list-group-item">
								<b> Behaviour Score </b><span class="float-right font-weight-bold mr-2"> 85% </span>
							</li>							
							<li class="list-group-item">
								<b> Teachers Observation </b><span class="float-right font-weight-bold mr-2"> Good Learner </span>
							</li>
						</ul>
						<div class="aboutme-start">
							<h4 class="text-center text-success"> Examination Marks </h4>
							<div class="row">
								<div class="col-lg-4">
									<div class="aboutme-starttitle text-uppercase"> 79% </div>
									<div class="aboutme-startname text-uppercase"> 1st Semister </div>
								</div>
								<div class="col-lg-4">
									<div class="aboutme-starttitle text-uppercase"> 76% </div>
									<div class="aboutme-startname text-uppercase"> 2nd Semister </div>
								</div>
								<div class="col-lg-4">
									<div class="aboutme-starttitle text-uppercase"> 82% </div>
									<div class="aboutme-startname text-uppercase"> 3rd Semister </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="card-box">
					<h3 class="card-title text-primary"> Student Information </h3>
					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<b> Full Name </b>
								<span class="float-right font-weight-bold mr-2">
									<?php echo $fetchStudentData[0]['first_name'].' '.$fetchStudentData[0]['last_name'] ?>
								</span>
							</li>
							<li class="list-group-item">
								<b> Student ID and Roll No. </b>
								<span class="float-right font-weight-bold mr-2"> 
									<?php echo $fetchStudentData[0]['student_id']
										.' <span class="text-danger">[ &nbsp;'.$fetchStudentData[0]['roll_number'].' &nbsp;]'?> 
								</span>
							</li>							
							<li class="list-group-item">
								<b> Class </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $fetchClassesData[0]['class_name'] ?> </span>
							</li>
							<li class="list-group-item">
								<b> Shift </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $fetchShiftData[0]['shift_name'] ?> </span>
							</li>
							<li class="list-group-item">
								<b> Date of Birth </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $ajaxcontrol->dateOnly($fetchStudentData[0]['birth_date']) ?> </span>
							</li>
							<li class="list-group-item">
								<b> Brith Certificate No </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $fetchStudentData[0]['birth_certificate_no'] ?> </span>
							</li>
							<li class="list-group-item">
								<b> Gender </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $fetchStudentData[0]['gender'] ?> </span>
							</li>
							<li class="list-group-item">
								<b> Religion </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $fetchStudentData[0]['religion'] ?> </span>
							</li>							
							<li class="list-group-item">
								<b> Blood Group </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $fetchStudentData[0]['blood_group'] ?> </span>
							</li>							
							<li class="list-group-item">
								<b> Address </b>
								<span class="float-right font-weight-bold mr-2"> <?php echo $fetchStudentData[0]['address'] ?> </span>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-box">
					<div class="row">
						<div class="col-md-12">
							<div class="profile-view">
								<div class="profile-img-wrap">
									<div class="profile-img">
										<img src="<?php echo $GLOBALS['PARENT_IMAGE_DIRECTORY'] . $fetchParentsData[0]['parents_image'] ?>" alt="">
									</div>
								</div>
								<div class="profile-basic">
									<div class="row">
										<div class="col-md-12">
											<ul class="personal-info">
												<li>
													<span class="font-weight-bold text-muted"> Father's Name: </span>
													<span class="float-right"> <?php echo $fetchParentsData[0]['father_name'] ?> </span>
												</li>
												<li>
													<span class="font-weight-bold text-muted"> Father's NID: </span>
													<span class="float-right"> <?php echo $fetchParentsData[0]['father_nid_card_no'] ?> </span>
												</li>
												<li>
													<span class="font-weight-bold text-muted"> Father's Phone: </span>
													<span class="float-right">
														<a href="tel:"> <?php echo $fetchParentsData[0]['father_phone_no'] ?> </a>
													</span>
												</li>
												<li>
													<span class="font-weight-bold text-muted"> Father's Email: </span>
													<span class="float-right">
														<a href="mailto:"> <?php echo $fetchParentsData[0]['father_email'] ?> </a>
													</span>
												</li>
											</ul>
										</div>								
										<div class="col-md-12 mt-2">
											<ul class="personal-info">
												<li>
													<span class="font-weight-bold text-muted"> Mother's Name: </span>
													<span class="float-right"> <?php echo $fetchParentsData[0]['mother_name'] ?> </span>
												</li>
												<li>
													<span class="font-weight-bold text-muted"> Mother's NID: </span>
													<span class="float-right"> <?php echo $fetchParentsData[0]['mother_nid_card_no'] ?> </span>
												</li>
												<li>
													<span class="font-weight-bold text-muted"> Mother's Phone: </span>
													<span class="float-right">
														<a href="tel:"> <?php echo $fetchParentsData[0]['mother_phone_no'] ?> </a>
													</span>
												</li>
												<li>
													<span class="font-weight-bold text-muted"> Mother's Occupation: </span>
													<span class="float-right"> <?php echo $fetchParentsData[0]['mother_occupation'] ?> </span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-12">
							<h3 class="card-title text-primary pb-2"> Parent's Details Information </h3>
							<ul class="personal-info">
								<li>
									<span class="font-weight-bold text-muted"> Occupation: </span>
									<span class="float-right"> <?php echo $fetchParentsData[0]['parents_occupation'] ?> </span>
								</li>
								<li>
									<span class="font-weight-bold text-muted"> Organization Name: </span>
									<span class="float-right"> <?php echo $fetchParentsData[0]['parents_org_name'] ?> </span>
								</li>
								<li>
									<span class="font-weight-bold text-muted"> Organization Address: </span>
									<span class="float-right"> <?php echo $fetchParentsData[0]['parents_org_address'] ?> </span>
								</li>
								<li>
									<span class="font-weight-bold text-muted"> Organization Contact No: </span>
									<span class="float-right"> <?php echo $fetchParentsData[0]['parents_org_contact_number'] ?> </span>
								</li>								
								<li>
									<span class="font-weight-bold text-muted"> Parmanent Address: </span>									
									<span class="float-right">
										<?php 
											echo 
											$fetchParentsData[0]['permanent_address'] .', '. 
											$fetchParentsData[0]['permanent_post_office'] .', '. 
											$fetchParentsData[0]['permanent_police_station'] .', '. 
											$fetchParentsData[0]['permanent_district'] .', '. 
											$fetchParentsData[0]['permanent_country']
										?>
									</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| STUDENT PROFILE CONTENT |#| =*=-->