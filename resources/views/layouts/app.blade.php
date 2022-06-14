@include('layouts.header')

@include('layouts.sidebar')


<!-- App-Content -->
<div class="app-content main-content">
	<div class="side-app">

		<!--app header-->
		<div class="app-header header main-header1">
			<div class="container-fluid">
				<div class="d-flex">
				<div class="app-sidebar__toggle d-flex" data-bs-toggle="sidebar">
						<a class="open-toggle" href="javascript:void(0);">
							<svg xmlns="http://www.w3.org/2000/svg" class="feather feather-align-left header-icon" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
						</a>
					</div>
					<a class="header-brand" href="index.html">
						<img src="{{url('public')}}/logo/logo.png" class="header-brand-img desktop-lgo" alt="Azea logo">
						<img src="{{url('public')}}/logo/logo.png" class="header-brand-img dark-logo" alt="Azea logo">
						<img src="{{url('public')}}/logo/logo.png" class="header-brand-img mobile-logo" alt="Azea logo">
						<img src="{{url('public')}}/logo/logo.png" class="header-brand-img darkmobile-logo" alt="Azea logo">
					</a>
					<div class="d-flex order-lg-2 ms-auto main-header-end">
						<button class="navbar-toggler navresponsive-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="true" aria-label="Toggle navigation">
							<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
						</button>

						<div class="navbar navbar-expand-lg navbar-collapse responsive-navbar p-0">
							<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
								<div class="d-flex order-lg-2">

									<div class="dropdown header-notify d-flex">
										<a class="nav-link icon" data-bs-toggle="dropdown">
											<svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"/></svg><span class="pulse "></span>
										</a>
										<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow  animated">
											<div class="dropdown-header">
												<h6 class="mb-0">Notifications</h6>
												<span class="badge fs-10 bg-secondary br-7 ms-auto">New</span>
											</div>
											<div class="notify-menu">
												<a href="email-inbox.html" class="dropdown-item border-bottom d-flex ps-4">
													<div class="notifyimg  text-primary bg-primary-transparent border-primary"> <i class="fa fa-envelope"></i> </div>
													<div>
														<span class="fs-13">Message Sent.</span>
														<div class="small text-muted">3 hours ago</div>
													</div>
												</a>
												<a href="email-inbox.html" class="dropdown-item border-bottom d-flex ps-4">
													<div class="notifyimg  text-secondary bg-secondary-transparent border-secondary"> <i class="fa fa-shopping-cart"></i></div>
													<div>
														<span class="fs-13">Order Placed</span>
														<div class="small text-muted">5  hour ago</div>
													</div>
												</a>
												<a href="email-inbox.html" class="dropdown-item border-bottom d-flex ps-4">
													<div class="notifyimg  text-danger bg-danger-transparent border-danger"> <i class="fa fa-gift"></i> </div>
													<div>
														<span class="fs-13">Event Started</span>
														<div class="small text-muted">45 mintues ago</div>
													</div>
												</a>
												<a href="email-inbox.html" class="dropdown-item border-bottom d-flex ps-4 mb-2">
													<div class="notifyimg  text-success  bg-success-transparent border-success"> <i class="fa fa-windows"></i> </div>
													<div>
														<span class="fs-13">Your Admin lanuched</span>
														<div class="small text-muted">1 daya ago</div>
													</div>
												</a>
											</div>
											<div class=" text-center p-2">
												<a href="email-inbox.html" class="btn btn-primary btn-md fs-13 btn-block">View All</a>
											</div>
										</div>
									</div>

									<div class="dropdown profile-dropdown d-flex">
										<a href="javascript:void(0);" class="nav-link pe-0 leading-none" data-bs-toggle="dropdown">
											<span class="header-avatar1">
												<img src="{{url('storage/app')}}/{{Auth::user()->profile_image_id}}" alt="img" class="avatar avatar-md brround">
											</span>
										</a>
										<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated profile_drop_down_div">
											<div class="text-center">
												<div class="text-center user pb-0 font-weight-bold">{{strtoupper(Auth::user()->last_name)}}</div>
												<span class="text-center user-semi-title">{{strtoupper(Auth::user()->roles[0]->name)}}</span>
												<div class="dropdown-divider"></div>
											</div>
											<a class="dropdown-item d-flex" href="./user/profile/">
												<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/></svg>
												<div class="fs-13">Profile</div>
											</a>
											<a class="dropdown-item d-flex" href="search.html">
												<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
												<div class="fs-13">Settings</div>
											</a>
											<a class="dropdown-item d-flex" href="chat.html">
												<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z"/></svg>
												<div class="fs-13">Messages</div>
											</a>
											<a class="dropdown-item d-flex" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
													<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
														@csrf
													</form>
												<svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><path d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z"/></g></svg>
												<div class="fs-13">Sign Out</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/app header-->

	@yield('content')


	</div>
</div>

<!-- End app-content-->
@include('layouts.footer')

</div>
</div>
</div>
<!-- End Page -->


<!-- Back to top -->
<a href="#top" id="back-to-top"><i class="fe fe-chevron-up"></i></a>

<script src="{{asset('public')}}/js/app.js" ></script>

<script src="{{asset('public')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="{{asset('public')}}/assets/plugins/bootstrap/popper.min.js"></script>

<!--Othercharts js-->
<script src="{{asset('public')}}/assets/plugins/othercharts/jquery.sparkline.min.js"></script>

<!-- Circle-progress js-->
<script src="{{asset('public')}}/assets/js/circle-progress.min.js"></script>

<!-- Jquery-rating js-->
<script src="{{asset('public')}}/assets/plugins/rating/jquery.rating-stars.js"></script>

<!--Sidemenu js-->
<script src="{{asset('public')}}/assets/plugins/sidemenu/sidemenu.js"></script>


<script src="{{asset('public')}}/assets/plugins/date-picker/date-picker.js"></script>
<script src="{{asset('public')}}/assets/plugins/date-picker/jquery-ui.js"></script>
<script src="{{asset('public')}}/assets/plugins/input-mask/jquery.maskedinput.js"></script>
<!-- P-scroll js-->
<!-- <script src="{{asset('public')}}/assets/plugins/p-scrollbar/p-scrollbar.js"></script>
<script src="{{asset('public')}}/assets/plugins/p-scrollbar/p-scroll1.js"></script>
<script src="{{asset('public')}}/assets/plugins/p-scrollbar/p-scroll.js"></script>
-->
<!--INTERNAL Flot Charts js-->
<!-- 		<script src="{{asset('public')}}/assets/plugins/flot/jquery.flot.js"></script>
<script src="{{asset('public')}}/assets/plugins/flot/jquery.flot.fillbetween.js"></script>
<script src="{{asset('public')}}/assets/plugins/flot/jquery.flot.pie.js"></script>
<script src="{{asset('public')}}/assets/js/dashboard.sampledata.js"></script>
<script src="{{asset('public')}}/assets/js/chart.flot.sampledata.js"></script>

-->		<!-- INTERNAL Chart js -->
<!-- 		<script src="{{asset('public')}}/assets/plugins/chart/chart.bundle.js"></script>
<script src="{{asset('public')}}/assets/plugins/chart/utils.js"></script>
-->
<!-- INTERNAL Apexchart js -->
<!-- <script src="{{asset('public')}}/assets/js/apexcharts.js"></script> -->

<!--INTERNAL Moment js-->
<script src="{{asset('public')}}/assets/plugins/moment/moment.js"></script>

<!--INTERNAL Index js-->
<!-- <script src="{{asset('public')}}/assets/js/index1.js"></script> -->

<!-- INTERNAL Data tables -->
<script src="{{asset('public')}}/assets/plugins/datatables/DataTables/js/jquery.dataTables.js"></script>

<script src="{{asset('public')}}/assets/plugins/datatables/DataTables/js/dataTables.bootstrap5.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Responsive/js/dataTables.responsive.min.js"></script>
<!-- <script src="{{asset('public')}}/assets/plugins/datatables/Responsive/js/responsive.bootstrap5.min.js"></script> -->
<!-- <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script> -->

<!-- 
<script src="{{asset('public')}}/assets/plugins/datatables/DataTables/js/jquery.dataTables.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/DataTables/js/dataTables.bootstrap5.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/JSZip/jszip.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Buttons/js/buttons.print.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/datatables/Responsive/js/responsive.bootstrap5.min.js"></script>
<script src="{{asset('public')}}/assets/js/datatables.js" defer ></script> -->




<!-- https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js -->

<!-- <link rel="stylesheet" type="text/css" href="{{asset('public')}}/assets/plugins/DataTables12/datatables.css"> -->
<!-- INTERNAL Select2 js -->
<script src="{{asset('public')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{asset('public')}}/assets/js/select2.js"></script>

<!-- Simplebar JS -->
<script src="{{asset('public')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<!-- Rounded bar chart js-->
<!-- <script src="{{asset('public')}}/assets/js/rounded-barchart.js"></script> -->
<!-- Custom js-->
<!-- INTERNAL File-Uploads Js-->
<script src="{{asset('public')}}/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="{{asset('public')}}/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="{{asset('public')}}/assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="{{asset('public')}}/assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="{{asset('public')}}/assets/plugins/fancyuploder/fancy-uploader.js"></script>

<!-- INTERNAL File uploads js -->
<script src="{{asset('public')}}/assets/plugins/fileupload/js/dropify.js"></script>
<script src="{{asset('public')}}/assets/js/filupload.js"></script>



<script src="{{url('public/')}}/assets/js/jquery.validate.min.js" ></script>
<script src="{{asset('public')}}/assets/js/form-vallidations.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script> -->
<script src="{{asset('public')}}/assets/plugins/sweet-alert/jquery.sweet-modal.min.js"></script>
<script src="{{asset('public')}}/assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="{{asset('public')}}/assets/js/sweet-alert.js"></script>
<script type="text/javascript" src="{{asset('public')}}/assets/plugins/dist_file_upload/imageuploadify.min.js"></script>

<script src="{{asset('public')}}/assets/js/custom.js"></script>
<script src="{{asset('public')}}/assets/js/script.js"></script>

@section('after_script')

@show

<script type="text/javascript">


$(document).on('click','.profile-dropdown',function(){

$('.profile_drop_down_div').toggle('d-block');

});

$(document).on('click',function(){

if($('.profile-dropdown .profile_drop_down_div').hasClass('d-block')){

		$('.profile_drop_down_div').removeClass('d-block')

}


});

</script>
<script type="text/javascript">
            $(document).ready(function() {
				
                $('#task_documents_uploadd').imageuploadify();
                $('#multi_file_upload_1').imageuploadify();
				$('#multi_file_upload_2').imageuploadify();
				$('#multi_file_upload_lead').imageuploadify();

				$('.upload_docs .imageuploadify-message').html("Upload Documents");
				$('.upload_invoice .imageuploadify-message').html("Upload Order Invoice");
				$('.upload_led_doc .imageuploadify-message').html("Upload Attachments");
            })
        </script>

</body>
</html>

