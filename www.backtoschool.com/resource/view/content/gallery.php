<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
if(isset($_REQUEST['did']))
{	
	#Fetch Deleted Data
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "ems_galleries";
	$whereValue["id"] = $_REQUEST['did'];
	$getDeleteData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#Delete Data
	$tableName = $whereValue = null;
	$tableName = "ems_galleries";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteImageData = $eloquent->deleteData($tableName, @$whereValue);
	
	if($deleteImageData > 0)
	{
		#Remove The Previous Image from The Defined Directory
		unlink($GLOBALS['APP_GALLARY_IMAGES_DIRECTORY'].$getDeleteData[0]['galleries_image']);
	}
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
$columnName = "*";
$tableName = "ems_galleries";
$fetchImagesData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| GALLARY CONTENT |#| =*=-->
<div class="main-wrapper">
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-7 col-md-12 col-sm-12 col-12">
						<button class="btn btn-outline-dark btn-rounded" data-toggle="modal" data-target="#add_gallary"><i class="fa fa-plus"></i> Add Image to Gallary</button>
					</div>
					<div class="col-lg-5 col-md-12 col-sm-12 col-12">
						<ul class="list-inline breadcrumb float-right">
							<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
							<li class="list-inline-item"> <a href="#"> Features </a> </li>
							<li class="list-inline-item"> Gallary </li>
						</ul>
					</div>
				</div>
			</div>
			
			<?php
			#Delete Confirmation Message
			if(isset($_REQUEST['did']))
			{
				if($deleteImageData > 0)
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong> The Image is Deleted Successfully! </strong> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
				}
			}
			?>
			
			<div id="lightgallery" class="row">
				
				<?php
				#Grid Data Content
				if(!empty($fetchImagesData))
				{
					foreach($fetchImagesData AS $eachRow)
					{
						echo '
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 m-b-20">
							<a href="'.$GLOBALS['APP_GALLARY_IMAGES_DIRECTORY'].$eachRow['galleries_image'].'">
								<img class="img-thumbnail delImg img-fluid" src="'.$GLOBALS['APP_GALLARY_IMAGES_DIRECTORY'] . $eachRow['galleries_image'] .'" alt="" style="min-width: 284px; min-height: 250px;">
							</a>
							<button data-target="#delete_image" data-id="'.$eachRow['id'].'" class="btn btn-outline-success btn-sm delbtn deleteButton" data-toggle="modal">
								<i class="fas fa-trash"></i>
							</button>
						</div>
						';
					}
				}
				?>
				
			</div>
		</div>
	</div>
</div>
<!--=*= |#| GALLARY CONTENT |#| =*=-->

<!--=*= Add Image To The Gallary =*=-->
<div id="add_gallary" class="modal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Images to Gallary</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12 mt-3">
							<div class="file_drag_area text-center pt-3 pb-3" style="border: 1px dashed #17a2b8;">
								<i class="fas fa-cloud-upload-alt fa-5x text-info"></i>
								<h3 class="text-muted mt-1"> 
									Drag & Drop Files
								</h3>
							</div>
						</div>
						<div class="col-md-12 mt-3" id="imageName">
							<!--=*= if Drag Over | The Image File Name Will Be Appear Here =*=-->
						</div>
					</div>	
					<div class="col-sm-12 text-center mt-4">
						<button type="submit" class="btn btn-outline-success btn-sm mb-3" id="save_gallary" name="save_gallary">
							<i class="fa fa-plus-circle"></i> Save Gallary
						</button>						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--=*= Add Image To The Gallary =*=-->

<!--=*= Delete Subject Confirmation =*=-->
<div id="delete_image" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Do you want to delete this image? </h4>
			</div>
			<div class="modal-body m-b-10">
				<div class="m-t-10"> 
					<a href="#" class="btn btn-dark btn-sm" data-dismiss="modal"> Close </a>
					<a href="#" class="btn btn-warning btn-sm" id="delete_modal"> Delete </a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= Delete Subject Confirmation =*=-->	


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">  
	$(document).ready(function(){  
		
		//Add Class
		$('.file_drag_area').on('dragover', function(){  
			$(this).addClass('file_drag_over');  
			return false;  
		});  
		

		//Remove Class
		$('.file_drag_area').on('dragleave', function(){  
			$(this).removeClass('file_drag_over');  
			return false;  
		}); 
		

		//Get and Read Files
		$('.file_drag_area').on('drop', function(e) {  

			e.preventDefault();
			$(this).removeClass('file_drag_over');

			var formData = new FormData();  
			var files_list = e.originalEvent.dataTransfer.files; 
			
			//Count Files And Display Uploaded Image Files Name
			for(var i = 0; i < files_list.length; i++)  
			{  
				if(files_list.length > 3)
				{
					$("#imageName").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"> Please upload upto maximum <strong> 3 </strong> image<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
				else
				{
					formData.append('file[]', files_list[i]);
					$("#imageName").append('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>'+ files_list[i].name +'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}  
			

			//Insert Data
			$('#save_gallary').click(function() {
				$.ajax({  
					url: "ajax/uploadGallary.php",  
					method: "POST",  
					data: formData,  
					contentType: false,  
					cache: false,  
					processData: false,  
					success: function(data) {
						$('#add_gallary').hide();
						$("#success_message").show();
					}
				});
			});
		});
		

		//Get The Requested Delete Shift ID
		$('.deleteButton').click(function() {
			var id = $(this).data('id');
			$('#delete_modal').attr('href','gallery.php?did='+id);
		});	
	}); 
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->