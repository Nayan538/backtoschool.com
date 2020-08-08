<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<!--=*= Attendance Table Data =*=-->
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-sm table-hover table-bordered cstmDatatable" style="margin-top: 15px !important;">
					<thead>
						<tr>
							<th style="width: 16%"> Student Name </th>
							<th style="width: 5%"> Jan </th>
							<th style="width: 5%"> Feb </th>
							<th style="width: 5%"> Mar </th>
							<th style="width: 5%"> Apr </th>
							<th style="width: 5%"> May </th>
							<th style="width: 5%"> Jun </th>
							<th style="width: 5%"> Jul </th>
							<th style="width: 5%"> Aug </th>
							<th style="width: 5%"> Sep </th>
							<th style="width: 5%"> Oct </th>
							<th style="width: 5%"> Nov </th>
							<th style="width: 5%"> Dec </th>
							<th style="width: 6%"> Present </th>
							<th style="width: 6%"> Absent </th>
							<th style="width: 6%"> Holidays </th>
							<th style="width: 6%"> Total </th>
						</tr>								
					</thead>
					<tbody>
						<tr class="text-center">
							<td class="text-left"> Ruth C. Gault </td>
							<td> 
								<span class="text-info"> 24 </span> &nbsp; <span class="text-danger"> 7 </span>
							</td>
							<td> 
								<span class="text-info"> 22 </span> &nbsp; <span class="text-danger"> 4 </span>
							</td>
							<td> 
								<span class="text-info"> 19 </span> &nbsp; <span class="text-danger"> 3 </span>
							</td>
							<td> 
								<span class="text-info"> 29 </span> &nbsp; <span class="text-danger"> 0 </span>
							</td>
							<td> 
								<span class="text-info"> 30 </span> &nbsp; <span class="text-danger"> 0 </span>
							</td>
							<td> 
								<span class="text-info"> 27 </span> &nbsp; <span class="text-danger"> 3 </span>
							</td>
							<td> 
								<span class="text-info"> 31 </span> &nbsp; <span class="text-danger"> 0 </span>
							</td>
							<td> 
								<span class="text-info"> 30 </span> &nbsp; <span class="text-danger"> 0 </span>
							</td>
							<td> 
								<span class="text-info"> 30 </span> &nbsp; <span class="text-danger"> 1 </span>
							</td>
							<td> 
								<span class="text-info"> 30 </span> &nbsp; <span class="text-danger"> 0 </span>
							</td>
							<td> 
								<span class="text-info"> 30 </span> &nbsp; <span class="text-danger"> 0 </span>
							</td>
							<td> 
								<span class="text-info"> 28 </span> &nbsp; <span class="text-danger"> 1 </span>
							</td>
							<td class="font-weight-bold text-info"> 36 </td>
							<td class="font-weight-bold text-danger"> 38 </td>
							<td class="font-weight-bold text-warning"> 40 </td>
							<td class="font-weight-bold"> 42 </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!--=*= Attendance Table Data =*=-->
	
	<!--=*= covid-19 updates start =*=-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card mb-4">
					<div class="row no-gutters">
						<div class="col-md-4">
							<img src="public/assets/img/bd.png" class="card-img" alt="bangladesh">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<ul class="list-group list-group-flush" id="bangladesh">
									
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 mt-4">
				<h2 class="text-uppercase text-secondary text-center">
					GLOBAL <span style="font-weight: 300;"> CORONA VIRUS </span> UPDATES
				</h2>
				<div class="row" id="corona"></div>
			</div>
		</div>
	</div>
	<!--=*= covid-19 updates end =*=-->

	<!--=*= 3RD PARTY API INTEGRATTION START =*=-->
	<script type="text/javascript">
		//GET CURRENT YEAR
		var cyear = new Date().getUTCFullYear();
		//ASSIGN AJAX MACHANISM
		$.ajax({
			//url: "https://api.covid19api.com/summary",
			type: "GET",
			dataType: "JSON",
			success: function(data){
				
				//EACH LOOP FUNCTION
				$.each(data.Countries[13], function(key, value){
					
					//DATA WILL BE APPEND INTO THE DESIRE TABLE
					$("#bangladesh").append(
					"<li class='list-group-item'>"+ key + ' : ' + value +"</li>");
				});	
				
				//EACH LOOP FUNCTION
				$.each(data.Global, function(key, value){
					
					//DATA WILL BE APPEND INTO THE DESIRE TABLE
					$("#corona").append("<div class='col-md-6 col-sm-6 col-lg-6 col-xl-4'><div class='dash-widget dash-widget5'><span class='dash-widget-icon bg-primary'><i class='fas fa-virus fa-lg'></i></span><div class='dash-widget-info'><h4><span class='text-secondary'>" + value + "</span></h4><span class='text-secondary'>" + key + "</span></div></div></div>");
				});
			}
		});
	</script>
	<!--=*= 3RD PARTY API INTEGRATTION END =*=-->





	<!--=*= JS Script =*=-->
	<script type="text/javascript">
		/* =*= COUNT EACH INPUT VALUES =*= */
		$(document).ready(function(){
			$("input[type='radio']").click(function(){
				var totalAttendance = [];

				$(':radio:checked').each(function(key){
					totalAttendance[key] = $(this).val();
				});

				var numOfP = 0;
				var numOfA = 0;

				for(var i = 0; i < totalAttendance.length; i++ ) {
					if(totalAttendance[i] === "present") {
						numOfP++;
					}				
					else if(totalAttendance[i] === "absent") {
						numOfA++;
					}
				}

				$('#totalPresent').val(numOfP);
				$('#totalAbsent').val(numOfA);
			});
		});
			
	/*
		1. ON THE DEFINED AREA ADD AND|OR REMOVE THE DRAGGING CLASS
		2. AFTER DROP THE "FormData()" OBJECT WILL BE POPULATE WITH THE CURRENT KEYS OR VALUES USING NAME PROPERTY
		3. "e.originalEvent" DEFINED THAT, IT'S THE EVENT OBJECT CONTAINS A PROPERTY WHICH IS THE EVENT OBJECT THAT THE BROWSER ITSELF CREATED AND "dataTransfer.files" DEFINED THAT, A LIST OF THE FILES IN A DRAG OPERATION
		4. CREATE A LOOP SO THAT DRAGGED DATA WILL BE COUNT AND APPEARED
		5. CREATE A CLICK EVENT TO SAVE THE DATA INTO THE DATABASE
		
		
		
		
		// Add Images
    var limit = "5";
    var inserted = 0;
    
    $('.img').click(function() {

    if (inserted == limit) 
    {
        toastr.error("Already added maximum images, remove one for add another one.");
    }else
    {
        $(this).next().trigger('click');
        var input = $(this).next();
        input.change(function()
        {
            var len = this.files.length;
            $(".preview-images-zone").sortable();

            if (window.File && window.FileList && window.FileReader) 
            {
                var output = $(".preview-images-zone");
                var files = event.target.files; 
                for (let i = 0; i < files.length; i++) 
                {
                    if (len > limit-inserted) 
                    {
                        toastr.error("Maximum image limit "+limit+"."); break;
                    }else
                    {
                        var file = files[i];
                        if (!file.type.match('image')) continue;
                        var picReader = new FileReader();
                        picReader.onload = function (event) 
                        {

                            var html = '<div class="preview-image">'+
                                    '<i class="fas fa-times image-cancel"></i>'+
                                    '<img class="image" src="'+event.target.result+'">'+
                                    '<input name="image[]" type="hidden" value="'+event.target.result+'">'+
                                  '</div>';
                            output.append(html);
                            inserted = inserted + 1;
                        }
                        picReader.readAsDataURL(file);
                    }
                }
                input.val('');
            }
        });
    }});
	</script>
	<!--=*= JS Script =*=-->

</body>
</html>	






