<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Http/Controllers/AjaxController.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [S]EARCH DATA START ===*=== ##
//HOLD THE KEYWORD BY ASSIGNING A VARIABLE
@$search_data = $_POST['search'];

//SQL QUERY
$searchNotice = $ajaxcontrol->searchNotice('ems_notices', 'author_name', 'type', 'title', 'note', $search_data);

if($searchNotice > 0)
{
	foreach($searchNotice AS $eachRow)
	{
		//SPLIT THE FIRST LETTER OR NAME FOR AVATAR
		$nameIndex = $ajaxcontrol->nameIndex($eachRow['author_name']);
		
		//DATE CONVERT AS USER FRIENDLY
		$dateResult =$ajaxcontrol->time_elapsed_string($eachRow['created_at']);
?>
	
		<div class="col-md-12">
			<div class="alert alert-light" role="alert">
				<span class="avatar"> <?php echo  $nameIndex ?> </span> <?php echo  $eachRow['author_name'] ?>
				
				<?php
				//HIGHLIGHT THE TEXT COLOR BASED ON NOTICE TYPE
				if($eachRow['type'] == 'General Notice') {
					echo '<strong class="text-uppercase text-success ml-2">'. $eachRow['title'] .'</strong>';
				} else if($eachRow['type'] == 'Important Notice') {
					echo '<strong class="text-uppercase text-danger ml-2">'. $eachRow['title'] .'</strong>';
				} else if($eachRow['type'] == 'Class Notice') {
					echo '<strong class="text-uppercase text-primary ml-2">'. $eachRow['title'] .'</strong>';
				} else if($eachRow['type'] == 'Examination Notice') {
					echo '<strong class="text-uppercase text-warning ml-2">'. $eachRow['title'] .'</strong>';
				} else if($eachRow['type'] == 'Employee Notice') {
					echo '<strong class="text-uppercase text-secondary ml-2">'. $eachRow['title'] .'</strong>';
				}
				?>
				
				<div class="float-right">
					<span> <?php echo  $dateResult ?> </span>
					<span class="pl-4">
						<button data-id="<?php echo  $eachRow['id'] ?>" class="btn btn-outline-danger btn-sm delete" data-toggle="modal" data-target="#del_notice">
							<i class="fas fa-trash"></i>
						</button>
					</span>
				</div>
				<p class="mt-2"> <?php echo  $eachRow['description'] ?> </p>
				
				<?php
				//IF N:B IS EMPTY
				if(!empty($eachRow['note'])) {
					echo '<hr> <p class="mb-0">'. $eachRow['note'] .'</p>';
				}
				?>
				
			</div>
		</div>

<?php
	}
}
## ===*=== [S]EARCH DATA END ===*=== ##
?>