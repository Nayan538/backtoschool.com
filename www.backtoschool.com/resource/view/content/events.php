<!--=*= |#| EVENTS CONTENT |#| =*=-->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 col-12">
					<h5 class="text-uppercase"> EMS <span style="font-weight: 300;"> Calendar &amp; Events </span> </h5>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-12">
					<ul class="list-inline breadcrumb float-right">
						<li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
						<li class="list-inline-item"> <a href="#"> Features </a> </li>
						<li class="list-inline-item"> Calendar </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card-box m-b-0">
					<div class="row">
						<div class="col-md-12">
							<div id="calendar">
								<!--=*= Events Calender =*=-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= |#| EVENTS CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript" src="public/assets/plugins/fullcalendar/jquery-ui.min.js"></script>
<script type="text/javascript" src="public/assets/plugins/fullcalendar/moment.min.js"></script>
<script type="text/javascript" src="public/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		//Initiate Plugin Define Function
		var calendar = $('#calendar').fullCalendar({
			
			//Define: Resize Calender AS 'TRUE'
			editable:true,
			
			//Define The Header Property
			header:{
				left: 'prev, today, next',
				center: 'title',
				right: 'month, agendaWeek, agendaDay'
			},
			
			//Fetch All The Events From Database
			events: 'ajax/loadEvents.php',
			
			//Define The Events to Drag and Select AS 'TRUE'
			selectable: true,
			selectHelper: true,
			
			
			/*
			----------------------------------------------------------------
			| =*=*=*=*= Insert Events Data Into An Particular Date =*=*=*=*=
			----------------------------------------------------------------
			*/

			select: function(start, end, allDay)
			{
				var title = prompt('Enter your event title');
				
				if(title)	
				{
					var start = $.fullCalendar.formatDate(start,'Y-MM-DD HH:mm:ss');
					var end = $.fullCalendar.formatDate(end,'Y-MM-DD HH:mm:ss');
					
					$.ajax({
						url: 'ajax/insertEvents.php',
						type: 'POST',
						data: {title:title, start:start, end:end},
						success: function(data)
						{
							console.log(data);
							calendar.fullCalendar('refetchEvents');
							alert('Events is added successfully!');
						}
					});
				}				
			},
			
			
			/*
			------------------------------------------------------
			| =*=*=*=*= Resize An Events On All Day Long =*=*=*=*=
			------------------------------------------------------
			*/

			editable: true,
			eventResize: function(event)
			{
				var start = $.fullCalendar.formatDate(event.start,'Y-MM-DD HH:mm:ss');
				var end = $.fullCalendar.formatDate(event.end,'Y-MM-DD HH:mm:ss');
				var title = event.title;
				var id = event.id;
				
				$.ajax({
					url: 'ajax/updateEvents.php',
					type: 'POST',
					data: {title:title, start:start, end:end, id:id},
					success: function()
					{
						calendar.fullCalendar('refetchEvents');
						alert('Events is updated successfully!');
					}
				});
			},


			/*
			-------------------------------------------------------
			| =*=*=*=*= Drop An Events On Particular Date =*=*=*=*=
			-------------------------------------------------------
			*/

			eventDrop: function(event)
			{
				var start = $.fullCalendar.formatDate(event.start,'Y-MM-DD HH:mm:ss');
				var end = $.fullCalendar.formatDate(event.end,'Y-MM-DD HH:mm:ss');
				var title = event.title;
				var id = event.id;
				
				$.ajax({
					url: 'ajax/updateEvents.php',
					type: 'POST',
					data: {title:title, start:start, end:end, id:id},
					success: function()
					{
						calendar.fullCalendar('refetchEvents');
						alert('Events is updated successfully!');
					}
				});
			},
			
			
			/*
			-----------------------------------------------------------
			| =*=*=*=*= Delete An Events From Particular Date =*=*=*=*=
			-----------------------------------------------------------
			*/
			
			eventClick: function(event)
			{				
				if(confirm('Are you sure that you want to delete it?'))
				{
					var id = event.id;
					
					$.ajax({
						url: 'ajax/deleteEvents.php',
						type: 'POST',
						data: {id:id},
						success: function()
						{
							calendar.fullCalendar('refetchEvents');
							alert('Events is deleted successfully!');
						}
					});
				}
			}
			
		});
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->