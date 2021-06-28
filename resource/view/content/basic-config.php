<style>
	.nav-pills .nav-link.active {background-color: #38957b;}
	a {color: #38957b;}
</style>

<!--=*= |#| BASIC CONFIGURATION CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Basic Configuration </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"> Basic Config </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<div class="card-box font-weight-bold" style="font-size: 18px;">
							<ul class="nav flex-column nav-pills nav-justified" aria-orientation="vertical">
								<li class="nav-item text-left">
									<a class="nav-link active" href="#tab1" data-toggle="tab"> Subject Configuration </a>
								</li>								
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab2" data-toggle="tab"> Class Configuration </a>
								</li>								
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab3" data-toggle="tab"> Shift Configuration </a>
								</li>
								<li class="nav-item text-left">
									<a class="nav-link" href="#tab4" data-toggle="tab"> Semester Configuration </a>
								</li>							
							</ul>
						</div>
					</div>
					<div class="col-md-9">
						<div class="card-box">
							<div class="tab-content">
								
								<!--=*= Subject Configuration Content =*=-->
								<div class="tab-pane show active" id="tab1">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Subject 
												<span style="font-weight: 300;" class="text-dark"> Configuration </span> 
												<hr>
											</h3>
											<div class="mb-1">
												<form id="subjectForm">
													<div class="row">
														<div class="col-md-6">
															<div class="input-group mb-3">
																<div class="input-group-prepend" style="height:34px;">
																	<span class="input-group-text pr-2"> Subject Name </span>
																</div>
																<input type="text" class="form-control" name="subName" style="height:34px;">
															</div>
														</div>
														<div class="col-md-4">
															<div class="input-group mb-3">
																<div class="input-group-prepend" style="height:34px;">
																	<span class="input-group-text"> Subject Code </span>
																</div>
																<input type="text" class="form-control" name="subCode" style="height:34px;">
															</div>
														</div>
														<div class="col-sm-2">
															<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="addSubject" style="padding: 5px 8px;">
																<i class="fa fa-plus-circle"></i> Save Data
															</button>
														</div>
													</div>
												</form>
												<div id="subjectSuccessMessage"></div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="table-responsive">
														<table class="table table-sm table-striped table-hover custom-table" style="margin-top: 15px !important;">
															<thead>
																<tr style="background-color: #38957b; color: #fff;">
																	<th style="width: 8%" class="text-center"> # </th>
																	<th style="width: 42%"> Subject Name </th>
																	<th style="width: 42%"> Subject Code </th>
																	<th style="width: 8%"> Action </th>
																</tr>
															</thead>
															<tbody id="subjectData">

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--=*= Subject Configuration Content =*=-->
								
								<!--=*= Class Configuration Content =*=-->
								<div class="tab-pane" id="tab2">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Class
												<span style="font-weight: 300;" class="text-dark"> Configuration </span> 
												<hr>
											</h3>
											<div class="mb-1">
												<form id="classForm">
													<div class="row">
														<div class="col-md-6">
															<div class="input-group mb-3">
																<div class="input-group-prepend" style="height:34px;">
																	<span class="input-group-text"> Class Name </span>
																</div>
																<input type="text" class="form-control" name="className" style="height:34px;">
															</div>
														</div>
														<div class="col-sm-2">
															<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="addClass" style="padding: 5px 8px;">
																<i class="fa fa-plus-circle"></i> Save Data
															</button>
														</div>
													</div>
												</form>
												<div id="classSuccessMessage"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table class="table table-sm table-striped table-hover custom-table" style="margin-top: 15px !important;">
													<thead>
														<tr style="background-color: #38957b; color: #fff;">
															<th style="width: 8%;" class="text-center"> # </th>
															<th style="width: 84%;"> Class Name </th>
															<th style="width: 8%;"> Action </th>
														</tr>
													</thead>
													<tbody id="classData">

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!--=*= Class Configuration Content =*=-->
								
								<!--=*= Shift Configuration Content =*=-->
								<div class="tab-pane" id="tab3">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Shift
												<span style="font-weight: 300;" class="text-dark"> Configuration </span> 
												<hr>
											</h3>
											<div class="mb-1">
												<form id="shiftForm">
													<div class="row">
														<div class="col-md-6">
															<div class="input-group mb-3">
																<div class="input-group-prepend" style="height:34px;">
																	<span class="input-group-text"> Shift Name </span>
																</div>
																<input type="text" class="form-control" name="shiftName" style="height:34px;">
															</div>
														</div>
														<div class="col-sm-2">
															<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="addShift" style="padding: 5px 8px;">
																<i class="fa fa-plus-circle"></i> Save Data
															</button>				
														</div>
													</div>
												</form>
												<div id="shiftSuccessMessage"></div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="table-responsive">
														<table class="table table-sm table-striped table-hover custom-table" style="margin-top: 15px !important;">
															<thead>
																<tr style="background-color: #38957b; color: #fff;">
																	<th style="width: 8%;" class="text-center"> # </th>
																	<th style="width: 84%;"> Shift Name </th>
																	<th style="width: 8%;"> Action </th>
																</tr>
															</thead>
															<tbody id="shiftData">

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--=*= Shift Configuration Content =*=-->
								
								<!--=*= Semester Configuration Content =*=-->
								<div class="tab-pane" id="tab4">
									<div class="row">
										<div class="col-sm-12">
											<h3 class="text-capitalize text-info text-center"> Semester 
												<span style="font-weight: 300;" class="text-dark"> Configuration </span> 
												<hr>
											</h3>
											<div class="mb-1">
												<form id="semesterForm">
													<div class="row">
														<div class="col-md-6">
															<div class="input-group mb-3">
																<div class="input-group-prepend" style="height:34px;">
																	<span class="input-group-text"> Semesters </span>
																</div>
																<input type="text" class="form-control" name="semisterName" style="height:34px;">
															</div>
														</div>
														<div class="col-sm-6">
															<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="addSemesters" style="padding: 5px 8px;">
																<i class="fa fa-plus-circle"></i> Save Data
															</button>						
														</div>
													</div>
												</form>
												<div id="semesterSuccessMessage"></div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="table-responsive">
														<table class="table table-sm table-striped table-hover custom-table" style="margin-top: 15px !important;">
															<thead>
																<tr style="background-color: #38957b; color: #fff;">
																	<th style="width: 8%;" class="text-center"> # </th>
																	<th style="width: 84%;"> Semesters Name </th>
																	<th style="width: 8%;"> Action </th>
																</tr>
															</thead>
															<tbody id="semesterData">
																
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--=*= Semester Configuration Content =*=-->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| BASIC CONFIGURATION CONTENT |#| =*=-->


<!--=*= Delete Subject Confirmation =*=-->
<div id="deleteSubject" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Subject info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> 
						<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </button>
						<button type="button" class="btn btn-warning btn-sm" id="delete_subject"> Delete </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Subject Confirmation =*=-->

<!--=*= Delete Class Confirmation =*=-->
<div id="deleteClass" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Class info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10">
						<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </button>
						<button type="button" class="btn btn-warning btn-sm" id="delete_class"> Delete </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Class Confirmation =*=-->

<!--=*= Delete Shift Confirmation =*=-->
<div id="deleteShift" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Shift info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10">
						<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </button>
						<button type="button" class="btn btn-warning btn-sm" id="delete_shift"> Delete </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Shift Confirmation =*=-->

<!--=*= Delete Semester Confirmation =*=-->
<div id="deleteSemesters" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this Semester info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> 
						<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </button>
						<button type="button" class="btn btn-warning btn-sm" id="delete_semester"> Delete </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Semester Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">

// --------------------------------
// | =*=*=*=*= FETCH DATA =*=*=*=*=
// --------------------------------

	//Fetch Subject Data
	function loadSubject() {
		$.ajax({
			url: 'ajax/basic-config.php',
			type: 'POST',
			data: {action: "loadSubject"},
			success: function(data) {
				$('#subjectData').html(data);
			}
		});
	}
	loadSubject();


	//Fetch Class Data
	function loadClass() {
		$.ajax({
			url: 'ajax/basic-config.php',
			type: 'POST',
			data: {action: "loadClass"},
			success: function(data) {
				$('#classData').html(data);
			}
		});
	}
	loadClass();


	//Fetch Shift Data
	function loadShift() {
		$.ajax({
			url: 'ajax/basic-config.php',
			type: 'POST',
			data: {action: "loadShift"},
			success: function(data) {
				$('#shiftData').html(data);
			}
		});
	}
	loadShift();


	//Fetch Semester Data
	function loadSemester() {
		$.ajax({
			url: 'ajax/basic-config.php',
			type: 'POST',
			data: {action: "loadSemester"},
			success: function(data) {
				$('#semesterData').html(data);
			}
		});
	}
	loadSemester();


// ---------------------------------
// | =*=*=*=*= DELETE DATA =*=*=*=*=
// ---------------------------------

	//Delete Subject Data
	$(document).on('click', '.deleteSubject', function() {
		$('#deleteSubject').show();

		var subjectID = $(this).data('id');
		var element = this;

		$('#delete_subject').click(function(){
			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "deleteSubject", id:subjectID},
				success: function(data) {
					if(data == 1) {
						$('#deleteSubject').modal('hide');
						$(element).closest('tr').fadeOut();
						$("#subjectSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A Subject Data is Deleted Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
					}
				}
			});
		});
	});	
	

	//Delete Class Data
	$(document).on('click', '.deleteClass', function() {
		$('#deleteClass').show();

		var classID = $(this).data('id');
		var element = this;

		$('#delete_class').click(function() {
			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "deleteClass", id:classID},
				success: function(data) {
					if(data == 1) {
						$('#deleteClass').modal('hide');
						$(element).closest('tr').fadeOut();
						$("#classSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A Class Data is Deleted Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
					}
				}
			});
		});
	});	
	
	
	//Delete Shift Data
	$(document).on('click', '.deleteShift', function() {
		$('#deleteShift').show();

		var shiftID = $(this).data('id');
		console.log(shiftID);
		var element = this;

		$('#delete_shift').click(function() {
			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "deleteShift", id:shiftID},
				success: function(data) {
					if(data == 1) {
						$('#deleteShift').modal('hide');
						$(element).closest('tr').fadeOut();
						$("#shiftSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A Shift Data is Deleted Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
					}
				}
			});
		});
	});	


	//Delete Semester Data
	$(document).on('click', '.deleteSemesters', function() {
		$('#deleteSemesters').show();

		var semesterID = $(this).data('id');
		console.log(semesterID);
		var element = this;

		$('#delete_semester').click(function() {

			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "deleteSemester", id:semesterID},
				success: function(data) {
					if(data == 1) {
						$('#deleteSemesters').modal('hide');
						$(element).closest('tr').fadeOut();
						$("#semesterSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A Semester Data is Deleted Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
					}
				}
			});
		});
	});	



// ---------------------------------
// | =*=*=*=*= INSERT DATA =*=*=*=*=
// ---------------------------------

	$(document).ready(function() {

		//Insert Subject Data
		$('button[name="addSubject"]').on('click', function(e) {
			e.preventDefault();
			var subjectValue = $('input[name="subName"]').val();
			var codeValue = $('input[name="subCode"]').val();
			
			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "insertSUBJECT", nameOfSubject: subjectValue, nameOfCode: codeValue},
				success: function(data) {
					if(data == 1) {
						$('#subjectForm').trigger('reset');
						$("#subjectSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A New Subject Data is Added Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						loadSubject();
					}
				}
			});
		});


		//Insert Class Data
		$('button[name="addClass"]').on('click', function(e) {
			e.preventDefault();
			var classValue = $('input[name="className"]').val();
			
			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "insertCLASS", nameOfClass: classValue},
				success: function(data) {
					if(data == 1) {
						$('#classForm').trigger('reset');
						$("#classSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A New Class Data is Added Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						loadClass();
					}
				}
			});
		});


		//Insert Shift Data
		$('button[name="addShift"]').on('click', function(e) {
			e.preventDefault();
			var shiftValue = $('input[name="shiftName"]').val();
			
			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "insertShift", nameOfShift: shiftValue},
				success: function(data) {
					if(data == 1) {
						$('#shiftForm').trigger('reset');
						$("#shiftSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A New Shift Data is Added Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						loadShift();
					}
				}
			});		
		});


		//Insert Semester Data
		$('button[name="addSemesters"]').on('click', function(e) {
			e.preventDefault();
			var semesterValue = $('input[name="semisterName"]').val();
			
			$.ajax({
				url: 'ajax/basic-config.php',
				type: 'POST',
				data: {action: "insertSEMESTER", nameOfSemester: semesterValue},
				success: function(data) {
					if(data == 1) {
						$('#semesterForm').trigger('reset');
						$("#semesterSuccessMessage").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation! A New Semester Data is Added Successfully!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						loadSemester();
					}
				}
			});
		});

	});
	
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->