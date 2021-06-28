<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	$tableName = $whereValue = null;
	$tableName = "ems_notices";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteNoticeData = $eloquent->deleteData($tableName, @$whereValue);
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['save_notice']))
{
	if(!empty($_POST['notice_author']) && !empty($_POST['notice_type']) && !empty($_POST['notice_title']) && !empty($_POST['notice_description']))
	{
		$tableName = $columnValue = null;
		$tableName = "ems_notices";
		$columnValue["author_name"] = $_POST['notice_author'];
		$columnValue["type"] = $_POST['notice_type'];
		$columnValue["title"] = $_POST['notice_title'];
		$columnValue["description"] = $_POST['notice_description'];
		$columnValue["note"] = $_POST['notice_note'];
		$columnValue["created_at"] = date('Y-m-d H:i:s a');
		$insertNoticeData = $eloquent->insertData($tableName, $columnValue);
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##	
$fetchNoticeData = $ajaxcontrol->fetchDesc('ems_notices', 'id');
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| NOTICE CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">EMS <span style="font-weight: 300;"> All Notices</span></h5>
				</div>
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Management </a> </li>
						<li class="list-inline-item"> Notice </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-sm-9 col-12">
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text bg-dark text-white" id="basic-addon1">
									SEARCH HERE <i class="fab fa-searchengin fa-lg ml-3 text-warning"></i>
								</span>
							</div>
							<input class="form-control mr-sm-2" type="search" id="search" aria-describedby="basic-addon1" placeholder="Search here by Name or Title or Type or Note...">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-12 text-right m-b-20">
				<button class="btn btn-outline-dark btn-rounded float-right" data-toggle="modal" data-target="#add_notice"><i class="fa fa-plus"></i> Add Notice</button>
			</div>
		</div>
		
		<?php
		#Insert Confirmation Message
		if(isset($_POST['save_notice']))
		{
			if(@$insertNoticeData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> A New Notice is Added Successfully! </strong> 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}	

		#Delete Confirmation Message
		if(isset($_REQUEST['did'])) 
		{
			if(@$deleteNoticeData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong> A New Notice is Deleted Successfully! </strong> 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}
		?>
		
		<div class="row" id="searchResult">
			
			<?php
			#Table Data Content
			if(!empty($fetchNoticeData))
			{
				foreach($fetchNoticeData AS $eachRow)
				{
			?>
				
				<div class="col-md-12">
					<div class="alert alert-light" role="alert">
						<span class="avatar"> <?php echo $ajaxcontrol->nameIndex($eachRow['author_name']) ?> </span> <?php echo $eachRow['author_name'] ?>
						
						<?php
						#HighLight Notice Type
						if($eachRow['type'] == 'General Notice') 
						{
							echo '<strong class="text-uppercase text-success ml-2">'. $eachRow['title'] .'</strong>';
						}
						
						if($eachRow['type'] == 'Important Notice') 
						{
							echo '<strong class="text-uppercase text-danger ml-2">'. $eachRow['title'] .'</strong>';
						}						
						
						if($eachRow['type'] == 'Class Notice') 
						{
							echo '<strong class="text-uppercase text-primary ml-2">'. $eachRow['title'] .'</strong>';
						}								
						
						if($eachRow['type'] == 'Examination Notice') 
						{
							echo '<strong class="text-uppercase text-warning ml-2">'. $eachRow['title'] .'</strong>';
						}							
						
						if($eachRow['type'] == 'Employee Notice') 
						{
							echo '<strong class="text-uppercase text-secondary ml-2">'. $eachRow['title'] .'</strong>';
						}
						?>
						
						<div class="float-right">
							<span> <?php echo $ajaxcontrol->dateTime($eachRow['created_at']) ?> </span>
							<span class="pl-4">
								<button data-id="<?php echo $eachRow['id'] ?>" class="btn btn-outline-danger btn-sm delete" data-toggle="modal" data-target="#del_notice">
									<i class="fas fa-trash"></i>
								</button>
							</span>
						</div>
						<p class="mt-2"> <?php echo $eachRow['description'] ?> </p>
						
						<?php
						#if N:B is Empty
						if(!empty($eachRow['note'])) 
						{
							echo '<hr> <p class="mb-0">'. $eachRow['note'] .'</p>';
						}
						?>
						
					</div>
				</div>
				
		<?php
				}
			}
		?>
			
		</div>
	</div>
</div>
<!--=*= |#| NOTICE CONTENT |#| =*=-->

<!--=*= Create A New Notice Data =*=-->>
<div id="add_notice" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Create a New Notice</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-md-7">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text">
										<i class="fas fa-user-tie text-info mr-1"></i> Author
									</label>
								</div>
								<input type="text" class="form-control" name="notice_author" placeholder="Your Name" aria-describedby="basic-addon1" required>
							</div>
						</div>
						<div class="col-md-5">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text">
										<i class="fas fa-exclamation text-warning mr-1"></i> Type
									</label>
								</div>
								<select class="custom-select" name="notice_type" required>
									<option>Choose..</option>
									
									<?php
									#Static Data
									$type = ['General Notice', 'Important Notice', 'Class Notice', 'Examination Notice', 'Employee Notice'];
									
									foreach($type AS $eachRow)
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
										<i class="fas fa-heading text-success mr-1"></i> Title
									</label>
								</div>
								<input type="text" class="form-control" name="notice_title" placeholder="Notice Title" aria-describedby="basic-addon1" required>
							</div>
						</div>
						<div class="col-md-12">
							<textarea name="notice_description" class="summernote" id="summerOne" required></textarea>
						</div>
						<div class="col-md-12 mt-3">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text">
										<i class="fas fa-exclamation-triangle text-danger mr-1"></i> N:B:
									</label>
								</div>
								<input type="text" class="form-control" name="notice_note" placeholder="Please feel free to contact with..." aria-describedby="basic-addon1">
							</div>
						</div>
					</div>	
					<div class="col-sm-12 text-center mt-4">
						<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="save_notice">
							<i class="fa fa-plus-circle"></i> Add Notice
						</button>						
						<button type="reset" class="btn btn-outline-dark btn-sm mb-3">
							<i class="fa fa-plus-circle"></i> Reset Notice
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--=*= Create A New Notice Data =*=-->>

<!--=*= Delete Subject Confirmation =*=-->
<div id="del_notice" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Do you want to really delete this Notice info?</h4>
			</div>
			<div class="modal-body m-b-10">
				<div class="m-t-10"> <a href="#" class="btn btn-dark btn-sm" data-dismiss="modal">Close</a>
					<a href="#" class="btn btn-warning btn-sm" id="delete_modal">Delete</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Subject Confirmation =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	$(document).ready(function() {
		
		//Get The Requested Delete Shift ID
		$('.delete').click(function(){
			var id = $(this).data('id');
			$('#delete_modal').attr('href','notice.php?did='+id);
		});

	
		//Fetch The Search Notice Data
		$('#search').on('keyup', function() {
			var serachData = $(this).val();
			
			$.ajax({
				url: 'ajax/searchNotice.php',
				type: 'POST',
				data: {search: serachData},
				success: function(data) {
					$('#searchResult').html(data);
				}				
			});			
		});
	});	
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->