			</div>
		<div class="sidebar-overlay" data-reff=""></div>
	
		<!--=*= When Try to Delete an Empty Value =*=-->
		<div id="rightClick" class="modal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<h4 class="modal-title text-info"> 
							Oops! <span style="font-weight: 300;" class="text-danger"> please don't try to click on this application </span> 
						</h4>
						<div class="text-right"> 
							<a href="#" class="btn btn-outline-dark btn-sm mt-3" data-dismiss="modal"> I Understand </a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--=*= When Try to Delete an Empty Value =*=-->


		<!--=*= js required files =*=-->
		<script type="text/javascript" src="public/assets/js/popper.min.js"></script>
		<script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="public/assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="public/assets/js/select2.min.js"></script>
		<script type="text/javascript" src="public/assets/js/app.js"></script>
		<script type="text/javascript" src="public/assets/js/tagsinput.js"></script>


		<!--=*= dataTable required files =*=-->
		<script type="text/javascript" src="public/assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="public/assets/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript">
			/* =*= re-initiate DataTable configuration | search & data length =*= */
			$(document).ready(function(){
				$('.cstmDatatable').DataTable({
					searching: true
				});
			});
		</script>
		<!--=*= dataTable required files =*=-->


		<!--=*= dashboard status counter =*=-->
		<script src="public/assets/js/jquery.counterup.js"></script>
		<script src="public/assets/js/jquery.waypoints.min.js"></script>
		<script type="text/javascript">
			$(".counter").counterUp({
				delay: 2, time: 1000
			});
		</script>
		<!--=*= dashboard status counter =*=-->


		<!--==*= air datetime picker ==*=-->
		<script type="text/javascript" src="public/assets/js/datepicker.js"></script>
		<script src="public/assets/js/datepicker.en.js"></script>
		<script>
			$('.datepicker-here').datepicker({
				language: 'en'
			});
			
			$('.only-time').datepicker({
				dateFormat: ' ',
				timepicker: true,
				classes: 'only-timepicker'
			});
		</script>
		<!--==*= air datetime picker ==*=-->


		<!--=*= HTML richtext editor | summernote =*=-->
		<script type="text/javascript" src="public/assets/plugins/light-gallery/js/lightgallery-all.min.js"></script>
		<script type="text/javascript" src="public/assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#summerOne').summernote();
				$('#summerTwo').summernote();
			});
		</script>
		<!--=*= HTML richtext editor | summernote =*=-->


		<!--=*= upload images preview =*=-->
		<script type="text/javascript">
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					var div_id  = $(input).attr('set-to');
					reader.onload = function (e) {
						$('#'+div_id).attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
			
			$(".default").change(function(){
				readURL(this);
			});
		</script>
		<!--=*= upload images preview =*=-->


		<!--=*= disable dragging images =*=-->
		<script type="text/javascript">
			$("img").mousedown(function(){
				return false;
			});
		</script>
		<!--=*= disable dragging images =*=-->


		<!--=*= credential files access =*=-->
		<script type="text/javascript">
			$(document).ready(function(){
				$("#credential").click(function(e){
					e.preventDefault();
					var count = 0;
					$('#settingsLogin').modal('show');
				});
			});
		</script>
		<!--=*= credential files access =*=-->


		<!--=*= iCheck plugins =*=-->
		<script type="text/javascript" src="public/assets/plugins/icheck/icheck.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.input').each(function(){
					var self = $(this),
					label = self.next(),
					label_text = label.text();
					
					label.remove();
					self.iCheck({
						checkboxClass: 'icheckbox_line-red',
						insert: '<div class="icheck_line-icon"></div>' + label_text
					});
				});
				$('.list').iCheck({
					checkboxClass: 'icheckbox_flat-green'
				});		
				$('.multiple').iCheck({
					checkboxClass: 'icheckbox_flat-red'
				});
			});
		</script>
		<!--=*= iCheck plugins =*=-->
		
		<!--=*= disable right click =*=-->
		<script type="text/javascript">
			// window.addEventListener('contextmenu', function (e) {
			// 	$('#rightClick').modal();
			// 	e.preventDefault();
			// }, false);
		</script>
		<!--=*= disable right click =*=-->

		<script type="text/javascript">
			// fullscreen() {
			// 	if (document.fullscreenElement === null) {
			// 		this._fullscreen.openFullscreen();
			// 	} else {
			// 		this._fullscreen.closeFullscreen();
			// 	}
			// }
		</script>

		<!--=*= js required files =*=-->

	</body>
</html>															