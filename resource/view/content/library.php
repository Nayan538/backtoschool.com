<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{		
	$tableName = $whereValue = null;
	$tableName = "ems_libraries";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteLibraryData = $eloquent->deleteData($tableName, $whereValue);	
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [I]INSERT DATA ===*=== ##
if(isset($_POST['addLibrary']))
{
	#Book ID Generate
	$bookName = explode(' ', $_POST['bookName']);
	$result = '';
	foreach($bookName AS $each)
	{
		@$result .= $each[0];
	}
	$number = rand(1000,9999);
	$bookId = $result . '-' . $number;	

	$tableName = $columnValue = null;
	$tableName = "ems_libraries";
	$columnValue["book_name"] = $_POST['bookName'];
	$columnValue["book_id"] = $bookId;
	$columnValue["author_name"] = $_POST['authorName'];
	$columnValue["class_id"] = $_POST['classFor'];
	$columnValue["subject_id"] = $_POST['subjectFor'];
	$columnValue["published"] = $_POST['published'];
	$columnValue["book_status"] = $_POST['status'];
	$columnValue["created_at"] = date('Y-m-d H:i:s');
	$insertLibraryData = $eloquent->insertData($tableName, $columnValue);
}
## ===*=== [I]INSERT DATA ===*=== ##	


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Class Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_classes";
$fetchClassData = $eloquent->selectData($columnName, $tableName);

#Fetch Subject Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_subjects";
$fetchSubjectData = $eloquent->selectData($columnName, $tableName);

#Fetch Library Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_libraries";
$fetchLibraryData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| LIBRARY CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Library </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> School Management </a> </li>
						<li class="list-inline-item"> <a href="#"> Students </a> </li>
						<li class="list-inline-item"> Library </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card-box">
					
					<?php
					#Insert Confirmation Message
					if(isset($_POST['addLibrary']))
					{
						if(@$insertLibraryData > 0)
						{
							echo '
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>A New Book is Added Succefully!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							';
						}
					}
					?>
					
					<form action="" method="post">
						<div class="row">
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-school fa-sm mr-1"></i>
											<span style="padding-right: 38px;"> Class </span>
										</label>
									</div>
									<select class="custom-select" name="classFor" id="classFor" required>
										<option>Choose..</option>
										
										<?php
										foreach($fetchClassData AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['class_name'] .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height: 38px;">
										<label class="input-group-text">
											<i class="fas fa-book mr-1"></i>
											<span> Book Name </span>
										</label>
									</div>
									<input type="text" class="form-control" name="bookName" id="bookName" style="height: 38px;" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend" style="height: 38px;">
										<label class="input-group-text">
											<i class="fas fa-copyright mr-1"></i>
											<span style="padding-right: 30px;"> Author </span>
										</label>
									</div>
									<input type="text" class="form-control" name="authorName" id="authorName" style="height: 38px;" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-info-circle mr-1"></i>
											<span style="padding-right: 27px;"> Subject </span>
										</label>
									</div>
									<select class="custom-select" name="subjectFor" id="subjectFor" required>
										<option>Choose..</option>
										
										<?php
										foreach($fetchSubjectData AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['subject_name'] .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text pr-3">
											<i class="far fa-calendar-check mr-1"></i>
											<span style="padding-right: 10px;"> Published </span>
										</label>
									</div>
									<select class="custom-select" name="published" id="published" required>
										<option>Choose..</option>
										
										<?php
										for($year = 2015; $year <= date('Y'); $year++)
										{
											echo '<option value="'. $year .'">'. $year .'</option>';
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											<i class="fas fa-toggle-on mr-1"></i> 
											<span style="padding-right: 30px;"> Status </span>
										</label>
									</div>
									<select class="custom-select" name="status" id="status" required>
										<option>Choose..</option>
										<option value="Available"> Available </option>
										<option value="Sold Out"> Sold Out </option>
									</select>
								</div>
							</div>
						</div>	
						<div class="col-sm-12 text-center mt-2">
							<button type="submit" class="btn btn-outline-success btn-sm mb-2" name="addLibrary" id="addLibrary" style="width:120px;">
								<i class="fa fa-plus-circle"></i> Save Data
							</button>						
							<button type="reset" class="btn btn-outline-dark btn-sm mb-2" style="width:120px;">
								<i class="fas fa-power-off"></i> Reset Data
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-12">
				
				<?php
				#Delete Confirmation Message
				if(isset($_REQUEST['did']))
				{
					if(@$deleteLibraryData > 0)
					{
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>A New Book is Deleted Succefully!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						';
					}
				}
				?>
				
				<div class="content-page">
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-sm table-hover cstmDatatable custom-table" style="margin-top: 15px !important;">
									<thead>
										<tr>
											<th> # </th>
											<th> Book ID </th>
											<th> Book Name </th>
											<th> Author or Publisher </th>
											<th> Class </th>
											<th> Subject </th>
											<th> Published </th>
											<th> Status </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="searchData">
										
									<?php
									#Table Data Content
									if(!empty($fetchLibraryData))
									{
										$n = 1;
										foreach($fetchLibraryData AS $eachRow)
										{
											#Fetch Class Data
											$columnName = $tableName = $whereValue = null;
											$columnName = "*";
											$tableName = "ems_classes";
											$whereValue["id"] = $eachRow['class_id'];
											$getClassData = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											#Fetch Subject Data
											$columnName = $tableName = $whereValue = null;
											$columnName = "*";
											$tableName = "ems_subjects";
											$whereValue["id"] = $eachRow['subject_id'];
											$getSubjectData = $eloquent->selectData($columnName, $tableName, @$whereValue);

											echo '
											<tr>
												<td style="padding: 3px; 8px;">'.$n.'</td>
												<td style="padding: 3px; 8px;">
													<h2 class="font-weight-bold text-info">'. $eachRow['book_id'] .'</h2>
												</td>
												<td style="padding: 3px; 8px;">'. $eachRow['book_name'] .'</td>
												<td style="padding: 3px; 8px;">'. $eachRow['author_name'] .'</td>
												<td style="padding: 3px; 8px;">'. $getClassData[0]['class_name'] .'</td>
												<td style="padding: 3px; 8px;">'. $getSubjectData[0]['subject_name'] .'</td>
												<td class="font-weight-bold" style="padding: 3px; 8px;">'. $eachRow['published'] .'</td>
												<td style="padding: 3px; 8px;">'. $eachRow['book_status'] .'</td>
												<td class="text-center" style="padding: 3px; 8px;">
													<a href="" data-id="'.$eachRow['id'].'" class="btn btn-outline-danger btn-sm deleteButton" data-toggle="modal" data-target="#delete_data">
														<i class="fas fa-trash"></i>
													</a>
												</td>
											</tr>
											';
											$n++;
										}
									}
									?>
										
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
<!--=*= |#| LIBRARY CONTENT |#| =*=-->

<!--=*= Delete Library Confirmation =*=-->
<div id="delete_data" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to <span class="text-danger"> Delete </span> this Book info? </h4>
			</div>
			<form>
				<div class="modal-body m-b-10">
					<div class="m-t-10"> 
						<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal" style="width: 86px;"> Close </a>
						<a href="#" class="btn btn-warning btn-sm" id="delete_modal" style="width: 86px;"> Delete </a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= Delete Library Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	
	//Get The Requested Delete Shift ID
	$('.deleteButton').click(function() {
		var id = $(this).data('id');
		$('#delete_modal').attr('href','library.php?did='+id);
	});
	

	//Prevent <form> Submission if Value is Empty 
	$(document).ready(function() {
		$('#addLibrary').on('click', function(e) {
			var book = $('#bookName').val();
			var sub = $('#subjectFor').val();
			var auth = $('#authorName').val();
			var cls = $('#classFor').val();
			var pub = $('#published').val();
			var sts = $('#status').val();
			
			if(book == '' || sub == '' || auth == '' || cls == '' || pub == '' || sts == '') {
				e.preventDefault();
			} else {
				return true;
			}			
		});
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->