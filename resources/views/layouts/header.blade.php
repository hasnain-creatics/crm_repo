<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
	
		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="CRM - Createics Information Technology" name="description">
		<meta content="Spruko Private Limited" name="author">
		<meta name="keywords" content="admin, admin template, dashboard, admin dashboard, responsive, bootstrap, bootstrap 5, admin theme, admin themes, bootstrap admin template, scss, ui, crm, modern, flat">
   <!-- CSRF Token -->
   		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Title -->
		<title>Creatics CRM</title>

		<script type="text/javascript">
			const public_url = "{{asset('public')}}";
			const main_url = "{{url('admin')}}";

		</script>

		  <!-- CK Editor -->
		<script src="{{asset('public')}}/assets/ckeditor/ckeditor.js" type="text/javascript">
	
		</script>



		<!--Favicon -->
		<link rel="icon" href="{{asset('public')}}/logo/logo.png" type="image/x-icon"/>
		<link href="{{asset('public')}}/assets/plugins/dist_file_upload/imageuploadify.min.css" rel="stylesheet">
		<!--Bootstrap css -->
		<link id="style" href="{{asset('public')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Style css -->
		<link href="{{asset('public')}}/assets/css/style.css" rel="stylesheet" />
		<link href="{{asset('public')}}/assets/css/dark.css" rel="stylesheet" />
		<link href="{{asset('public')}}/assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{asset('public')}}/assets/css/animated.css" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="{{asset('public')}}/assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{asset('public')}}/assets/css/icons.css" rel="stylesheet" />

		<!-- Simplebar css -->
		<link rel="stylesheet" href="{{asset('public')}}/assets/plugins/simplebar/css/simplebar.css">

		<!-- INTERNAL Morris Charts css -->
		<link href="{{asset('public')}}/assets/plugins/morris/morris.css" rel="stylesheet" />

		<!-- INTERNAL Select2 css -->
		<link href="{{asset('public')}}/assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- Data table css -->
		<!-- <link href="{{asset('public')}}/assets/plugins/datatables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="{{asset('public')}}/assets/plugins/datatables/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" /> -->

		<link href="{{asset('public')}}/assets/plugins/datatables/DataTables/css/dataTables.bootstrap5.css" rel="stylesheet" />
		<link href="{{asset('public')}}/assets/plugins/datatables/Buttons/css/buttons.bootstrap5.min.css"  rel="stylesheet">
		<link href="{{asset('public')}}/assets/plugins/datatables/Responsive/css/responsive.bootstrap5.min.css" rel="stylesheet" />


<!-- INTERNAL File Uploads css -->
<link href="{{asset('public')}}/assets/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" />
<!-- <link rel="stylesheet" type="text/css" href="{{asset('public')}}/assets/plugins/DataTables12/datatables.css"> -->
<!-- INTERNAL File Uploads css-->
<link href="{{asset('public')}}/assets/plugins/fileupload/css/fileupload.css" rel="stylesheet" type="text/css" />



	    <!-- Color Skin css -->
		<link id="theme" href="{{asset('public')}}/assets/colors/color1.css" rel="stylesheet" type="text/css"/>
	
		<!-- <link href="{{asset('public')}}/assets/plugins/date-picker/date-picker.css" rel="stylesheet"> -->
		
		<link href="{{asset('public')}}/assets/plugins/sweet-alert/jquery.sweet-modal.min.css" rel="stylesheet">
		<link href="{{asset('public')}}/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
		<!-- <link href="{{asset('public')}}/assets/toggle/css/bootstrap2-toggle.css" rel="stylesheet">
		<link href="{{asset('public')}}/assets/toggle/css/bootstrap2-toggle.min.css" rel="stylesheet">
		<link href="{{asset('public')}}/assets/toggle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="{{asset('public')}}/assets/toggle/css/bootstrap-toggle.min.css" rel="stylesheet"> -->
		<!-- Jquery js-->
		<!-- <link rel="stylesheet" href="{{asset('public')}}/assets/css/jquery.dataTables.min.css"> -->

		<script src="{{asset('public')}}/assets/js/jquery.min.js"></script>
	<style type="text/css">
		.swal-button--confirm {
			    background: #eeeeee;
			}

			.cancel {
			   background: #eeeeee;
			}

			.swal-button--danger {
			    background: #a00;
			}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.lead_assigned_name{background:lightblue;padding:5px;border-radius:5px;text-transform:capitalize;}
.lead_id{color:blue;}
.lead_id:hover{text-decoration:underline;cursor:pointer}
.paid{
	padding:5px;
	background:lightblue;border-radius:5px;
}
.un-paid{
	padding:5px;
	background:lightgray;border-radius:5px;
}
.followup{
	padding:5px;
	background:lightpink;border-radius:5px;
}
</style>
	</head>

	<body class="app sidebar-mini">
<div id="app">
		<!---Global-loader-->
		<div id="global-loader" >
			<img src="{{asset('public')}}/assets/images/svgs/loader.svg" alt="loader">
		</div>
		<!--- End Global-loader-->

		<!-- Page -->
		<div class="page">
			<div class="page-main">
