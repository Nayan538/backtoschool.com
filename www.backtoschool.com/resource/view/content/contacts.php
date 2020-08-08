<!--=*= |#| CONTACT LIST CONTENT |#| =*=-->
<div class="main-wrapper">
	<div class="page-wrapper">
		<div class="chat-main-row">
			<div class="chat-main-wrapper">
				<div class="col-lg-12 message-view">
					<div class="chat-window">
						<div class="fixed-header">
							<div class="row mr-5 ml-2">
								<div class="input-group mb-3" style="margin-top: 16px;">
									<div class="input-group-prepend">
										<span class="input-group-text bg-dark text-white" id="basic-addon1">
											SEARCH HERE <i class="fab fa-searchengin fa-lg ml-3 text-warning"></i>
										</span>
									</div>
									<input class="form-control mr-sm-2" type="search" id="search" aria-describedby="basic-addon1" placeholder="Search here by name or teacher id or student id or phone no or email address" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="chat-contents">
							<div class="chat-content-wrap">
								<div class="chat-wrap-inner" style="overflow: hidden !important;">
									<div class="contact-box">
										<div class="row">
											<div class="contact-cat col-sm-4 col-lg-3" style="margin-top: -20px;">
												<div class="roles-menu">
													<ul class="dataActive">
														<li class="active"> <a href="javascript:void(0);"> All </a> </li>
														<li> <a href="javascript:void(0);"> Teachers </a> </li>
														<li> <a href="javascript:void(0);"> students </a> </li>
														<li> <a href="javascript:void(0);"> Parents </a> </li>
														<li> <a href="javascript:void(0);"> HR & Admin </a> </li>
														<li> <a href="javascript:void(0);"> Accounts </a> </li>
														<li> <a href="javascript:void(0);"> Employees </a> </li>
													</ul>
												</div>
											</div>
											<div class="contacts-list col-sm-8 col-lg-9">
												<ul class="contact-list" id="searchResult" style="overflow-y: auto; max-height: 532px;">
													<!--=*= All The Contact List Data Will be Appear Here =*=-->
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<!--=*= |#| CONTACT LIST CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
	
	//Fetch All Contact List Data
	function loadContactList(){
		$.ajax({
			url: 'ajax/contacts.php',
			type: 'POST',
			success: function(data){
				$('#searchResult').html(data);
			}
		});
	};
	loadContactList();
	
	
	$(document).ready(function() {
		
		//Fetch The Search Contact Data
		$('#search').on('keyup', function(){
			var serachContact = $(this).val();
			
			$.ajax({
				url: 'ajax/contacts.php',
				type: 'POST',
				data: {search:serachContact},
				success: function(data) {
					$('#searchResult').html(data);
				}
			});
		});
		
		
		//Data List Active
		$('.dataActive li a').mouseover(function() {
			$('.dataActive li').removeClass('active').addClass('inactive');
			$(this).parent('li').addClass('active');
		});
		
	});
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->