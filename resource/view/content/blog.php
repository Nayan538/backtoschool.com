<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['save_blog']))
{
	#Upload Image File Name Generate
	$fileName = 'BLOG_' . date('Ymd') . '_IMAGES_' . rand(1000, 9999) . $_FILES['blogPhoto']['name'];
	
	#Upload Image File Validation
	$error = $control->checkImage(@$_FILES['blogPhoto']['type'], @$_FILES['blogPhoto']['size'], @$_FILES['blogPhoto']['error']);
	
	if($error == 1)
	{
		$tableName = $columnValue = null;
		$tableName = "ems_blogs";
		$columnValue["blog_title"] = $_POST['blogTitle'];
		$columnValue["blog_details"] = $_POST['blogDescription'];
		$columnValue["blog_tags"] = $_POST['blogTags'];
		$columnValue["blog_image"] = $fileName;
		$columnValue["created_at"] = date('Y-m-d H:i:s');
		$insertBlogData = $eloquent->insertData($tableName, $columnValue);
		
		if($insertBlogData['LAST_INSERT_ID'] > 0)
		{
			#Store The Uploaded Files Into The Defined Directory
			move_uploaded_file($_FILES['blogPhoto']['tmp_name'], $GLOBALS['APP_BLOG_IMAGES_DIRECTORY'] . $fileName);
		}
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Blog Data
$columnName = $tableName = $formatBy = null;
$columnName = "*";
$tableName = "ems_blogs";
$fetchBlogData = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| BLOG CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<button class="btn btn-outline-dark btn-rounded" data-toggle="modal" data-target="#add_blog">
						<i class="fa fa-plus"></i> Create Blog
					</button>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Features </a> </li>
						<li class="list-inline-item"> Blog </li>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
		#Insert Confirmation Message
		if(isset($_POST['save_blog']))
		{
			if(@$insertBlogData > 0)
			{
				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					Congratulation! <strong> A New Blog Data is Inserted Successfully </strong> 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
			}
		}
		?>
		
		<div class="row">	
			
			<?php
			#Grid Data Content
			if(!empty($fetchBlogData))
			{
				foreach($fetchBlogData AS $eachRow)
				{
					#Blog Title Length Shorten
					$fetchTitle = str_word_count($eachRow['blog_title'], 0);
					$limit = 6;
					
					$getBlogTitle = '';
					
					if($fetchTitle > $limit) {
						$explode = explode(' ', $eachRow['blog_title']);
						
						for($i = 0; $i < $limit; $i++) {
							$getBlogTitle .= $explode[$i] . ' ';
						}
						
						$getBlogTitle = rtrim($getBlogTitle, ' ,');
					} else {
						$getBlogTitle = $eachRow['blog_title'];
					}
					
					#Blog Description Length Shorten
					$getDescription = '';
					if($eachRow['blog_details'] > 220)
					{
						$fetchDescription = substr($eachRow['blog_details'], 0, 220);
						$getDescription = str_pad($fetchDescription, 223, '...', STR_PAD_RIGHT);
					}
					else
					{
						$getDescription = $eachRow['blog_details'];
					}
					
					echo '
					<div class="col-sm-6 col-md-6 col-lg-4">
						<div class="blog grid-blog">
							<div class="blog-image">
								<a href="'.$GLOBALS['APP_BLOG_IMAGES_DIRECTORY'] . $eachRow['blog_image'].'" target="_blank">
									<img class="img-fluid" src="'.$GLOBALS['APP_BLOG_IMAGES_DIRECTORY'] . $eachRow['blog_image'].'" alt="" style="height: 180px;">
								</a>
							</div>
							<div class="blog-content">
								<h3 class="blog-title">
									<a href="//localhost/www.oldschool.com/blog-details.php" target="_blank">'. $getBlogTitle .'</a>
								</h3>
								<div>'.$getDescription.' </div>
								<div class="blog-info clearfix d-inline">
									<div class="post-left">
										<a href="//localhost/www.oldschool.com/blog-details.php" target="_blank" class="read-more">
											<i class="fas fa-arrow-circle-right"></i> Read More
										</a>
									</div>
									<div class="post-right">
										<i class="far fa-calendar-alt"></i> '. $ajaxcontrol->dateTime($eachRow['created_at']) .'
									</div>
								</div>									
							</div>
						</div>
					</div>
					';
				}
			}
			?>
			
		</div>
	</div>
</div>
<!--=*= |#| BLOG CONTENT |#| =*=-->


<!--=*= Create a New Blog =*=-->
<div id="add_blog" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Create a New Blog Post </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text"> <i class="fas fa-blog mr-1"></i> Blog Title </label>
								</div>
								<input type="text" class="form-control" name="blogTitle" aria-describedby="basic-addon1" required/>
							</div>
						</div>
						<div class="col-md-12">
							<label class="input-group-text"> 
								<i class="fas fa-copy mr-1"></i>Please write here below your blog content only...
							</label>
							<textarea name="blogDescription" id="summerOne" class="summernote" required></textarea>
						</div>
						<div class="col-md-12 mt-3">
							<div class="form-group" style="margin-top: -20px;">
								<label class="input-group-text"> <i class="fas fa-tags mr-1"></i> Blog Tags (separated with a comma) </label>
								<input type="text" placeholder="Blog tags" name="blogTags" data-role="tagsinput" class="form-control" required>
							</div>
						</div>
						<div class="col-md-8 offset-md-2">
							<div class="form-group">
								<label for="fileupload" class="btn btn-outline-secondary btn-sm form-control-file"> 
									<i class="fas fa-upload"></i> &nbsp; Choose a image files for blog
								</label>
								<input type="file" id="fileupload" name="blogPhoto" class="form-control-file" onchange="readURL(this);" set-to="div1" style="visibility: hidden;">
							</div>
							<div id="preview"> </div>
						</div>						
					</div>	
					<div class="col-sm-12 text-center">
						<button type="submit" class="btn btn-outline-success btn-sm mb-3" name="save_blog"> 
							<i class="fa fa-plus-circle"></i> Save Blog Data 
						</button>						
						<button type="reset" class="btn btn-outline-dark btn-sm mb-3" id="reset">
							<i class="fa fa-plus-circle"></i> Reset Blog Data
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--=*= Create a New Blog =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	$(document).ready(function() {
		
		$(':input[type="file"]').on('change', function() {
			$('#preview').html('<div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-new thumbnail"><img src="" alt="" id="div1" style="width: 100%; height: 192px; margin-top: -35px; padding-bottom: 18px;"/></div></div>');
		});
		
		$('#reset').on('click', function() {
			$('#preview').html('');
		});
		
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->