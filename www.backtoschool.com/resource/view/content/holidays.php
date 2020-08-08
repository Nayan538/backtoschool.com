<!--=*= |#| HOLIDAYS CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase">Govt. <span style="font-weight: 300;">Holidays in Bangladesh</span></h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"><a href="dashboard.php">Home</a></li>
						<li class="list-inline-item"> Holidays</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="content-page">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table custom-table table-striped m-b-0">
							<thead class="thead-dark">
								<tr>
									<th scope="row" style="width: 5%">#</th>
									<th style="width: 20%">Title </th>
									<th style="width: 40%">Description</th>
									<th style="width: 10%">Holiday</th>
									<th style="width: 5%">Day</th>
									<th style="width: 15%">Type</th>
								</tr>
							</thead>
							<tbody id="govtHolidays">
								<!--=*= All The Holiday's Table Data =*=-->
							</tbody>
						</table>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
<!--=*= |#| HOLIDAYS CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT | 3RD PARTY API INTEGRATTION |#| =*=-->
<script type="text/javascript">
	
	//Current Year
	var cyear = new Date().getUTCFullYear();
	
	$.ajax({
		url: "https://calendarific.com/api/v2/holidays?&api_key=9174acad73e14a20744a4b63912facb66f16e6bb&country=BD&year="+cyear,
		type: "GET",
		dataType: "JSON",
		success: function(data) {
			var n = 1;
			
			//Each Loop Function
			$.each(data.response.holidays, function(key, value){
				
				//Get The WeekDay Name Based On Data Fetching
				var dateName = value.date.iso;
				var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
				var dayCount = new Date(dateName);
				var dayName = days[dayCount.getDay()];
				
				//Fetch Table Data
				$("#govtHolidays").append(
				"<tr class='holiday-upcoming'>" +
				"<td>" + n + "</td>" +
				"<td>" + value.name + "</td>" +
				"<td>" + value.description + "</td>" +
				"<td>" + value.date.iso +"</td>" +
				"<td>" + dayName + "</td>" +
				"<td>" + value.type + "</td>" +
				"</tr>"
				);
				n++;
			});
		}
	});
</script>
<!--=*= |#| JS SCRIPT | 3RD PARTY API INTEGRATTION |#| =*=-->