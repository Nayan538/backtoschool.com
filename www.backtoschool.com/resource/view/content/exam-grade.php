<!--=*= |#| EXAM GRADE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Examination Grade </span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"> <a href="#"> Examination </a> </li>
						<li class="list-inline-item"> Exam Grade </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card-box">
					<div id="insertSuccessMessage"></div> 
					<div id="insertErrorMessage"></div>
					<form id="examGrade">
						<div class="row">
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-award  mr-1"></i>
											<span style="padding-right: 11px;"> Grade Name </span>
										</label>
									</div>
									<select class="custom-select" id="gradeName">
										<option>Choose..</option>
										
										<?php
										#Static Exam Grades
										$grade = ['A+','A','A-','B+','B','B-','C+','C','D','F'];
										foreach($grade AS $eachRow)
										{
											echo '<option value="'. $eachRow .'">'. $eachRow .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-award  mr-1"></i>
											<span style="padding-right: 15px;"> Grade Point </span>
										</label>
									</div>
									<select class="custom-select" id="gradePoint">
										<option>Choose..</option>
										
										<?php
										#Static Exam Grades Point
										$point = ['4.00','3.75','3.50','3.25','3.00','2.75','2.50','2.25','2.00','0.00'];
										foreach($point AS $eachRow)
										{
											echo '<option value="'. $eachRow .'">'. $eachRow .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height: 38px;">
										<label class="input-group-text">
											<i class="fas fa-award  mr-1"></i>
											<span style="padding-right: 14px;"> Marks From </span>
										</label>
									</div>
									<input type="number" min="33" max="100" placeholder="33" class="form-control" id="markFrom" style="height: 38px;">
								</div>
							</div>						
							<div class="col-md-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height: 38px;">
										<label class="input-group-text">
											<i class="fas fa-award  mr-1"></i>
											<span style="padding-right: 17px;"> Marks Upto </span>
										</label>
									</div>
									<input type="number" min="33" max="100" placeholder="99" class="form-control" id="markUpto" style="height: 38px;">
								</div>
							</div>
						</div>	
						<div class="col-sm-12 text-center mt-4">
							<button type="button" class="btn btn-outline-success btn-sm mb-2" id="addExamGrade" style="width:120px;">
								<i class="fa fa-plus-circle"></i> Save Data
							</button>						
							<button type="reset" class="btn btn-outline-dark btn-sm mb-2" style="width:120px;">
							<i class="fas fa-power-off"></i> Reset Data
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-8">
				<div class="content-page">
				<div id="deleteMessage"></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-sm table-hover table-striped custom-table text-center">
									<thead>
										<tr>
											<th class="text-center" style="width:10%;">
												<button class="btn btn-outline-success btn-sm del"> Confirm	</button>
											</th>
											<th style="width:2%;"> Sl </th>
											<th style="width:22%;"> Grade Name </th>
											<th style="width:22%;"> Grade Point </th>
											<th style="width:22%;"> Marks From </th>
											<th style="width:22%;"> Marks Upto </th>
										</tr>
									</thead>
									<tbody id="examGradeList">
										<!--=*= All The Examination Grade Data Appear Here =*=-->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| EXAM GRADE CONTENT |#| =*=-->

<!--=*= When Try to Delete an Empty Value =*=-->
<div id="alertModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> 
					Dear User, <span style="font-weight: 300;" class="text-secondary"> Please select at least one Data </span> 
				</h4>
			</div>
			<div class="modal-body">
				<div> 
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal"> I Understand </a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= When Try to Delete an Empty Value =*=-->

<!--=*= Delete Grade Confirmation =*=-->
<div id="delete_multiple" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to <span class="text-danger"> Delete </span> this Exam Grade info? </span> </h4>
			</div>
			<div class="modal-body">
				<div> 
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal" style="width: 86px;"> Close </a>
					<button class="btn btn-warning btn-sm" id="deleteAll" style="width: 86px;"> Delete </button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Grade Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">

	//Fetch Exam Grade Data
	function loadExamGrade() {
		$.ajax({
			url: 'ajax/examGrade.php',
			type: 'POST',
			data: {action: "loadExamGrade"},
			success: function(data) {
				$('#examGradeList').html(data);
			}
		});
	}
	loadExamGrade();
	
	
	//Insert Exam Grade Data
	$('#addExamGrade').on('click', function(e) {
		var grade = $('#gradeName').val();
		var point = $('#gradePoint').val();
		var from = $('#markFrom').val();
		var upto = $('#markUpto').val();
		
		if(grade == '' || point == '' || from == '' || upto == '') 
		{
			e.preventDefault();
			$('#insertErrorMessage').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong> Oops! </strong> all fields are required <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
			$('#insertSuccessMessage').slideUp();
		} 
		else 
		{
			$.ajax({
				url: 'ajax/examGrade.php',
				type: 'POST',
				data: {action: "insertExamGrade", grade: grade, point: point, from: from, upto: upto},
				success: function(data) {
					if(data == 1) 
					{
						$('#examGrade').trigger('reset');

						$('#insertSuccessMessage').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong> Contratulation! </strong> A New Data is Added <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						$('#insertErrorMessage').slideUp();
						loadExamGrade();
					}
					else 
					{
						$('#insertErrorMessage').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong> Oops! </strong> already the data is exist.. </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
						$('#insertSuccessMessage').slideUp();
					}
				}
			});
		}
	});
	
	
	//Multiple Data Delete
	$('.del').on('click', function() {
		var ID = [];
		console.log(ID);
		
		//ForEach Loop | Based on CheckBox
		$(':checkbox:checked').each(function(key) {
			ID[key] = $(this).val();
		});
		
		//Pass All The CheckBox Values If Not Empty
		if(ID.length == 0) 
		{
			$('#alertModal').modal('show');
		} 
		else
		{
			$('#delete_multiple').modal('show');

			$('#deleteAll').click(function() {
				$.ajax({
					url: 'ajax/examGrade.php',
					type: 'POST',
					data: {action: "deleteAll", id: ID},
					success: function(data) {
						console.log(data);
						if(data == 1)
						{
							$('#deleteMessage').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong> Congratulation! </strong> Data is Deleted Successfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown;

							$('#delete_multiple').modal('hide');

							loadExamGrade();
						}
					}				
				});
			});
		}
	});
	
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->