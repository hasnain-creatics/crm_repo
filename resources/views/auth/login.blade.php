<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="CRM - Creatics Information Technology" name="description">
		<meta content="Spruko Private Limited" name="author">
		<meta name="keywords" content="admin, admin template, dashboard, admin dashboard, responsive, bootstrap, bootstrap 5, admin theme, admin themes, bootstrap admin template, scss, ui, crm, modern, flat">

		<!-- Title -->
		<title>CRM - Creatics Information Technology</title>

		<!--Favicon -->
		<link rel="icon" href="{{asset('public')}}/assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!--Bootstrap css -->
		<link id="style" href="{{asset('public')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Style css -->
		<link href="{{asset('public')}}/assets/css/style.css" rel="stylesheet" />
		<link href="{{asset('public')}}/assets/css/dark.css" rel="stylesheet" />
		<link href="{{asset('public')}}/assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{asset('public')}}/assets/css/animated.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{asset('public')}}/assets/css/icons.css" rel="stylesheet" />

	    <!-- Color Skin css -->
		<link id="theme" href="{{asset('public')}}/assets/colors/color1.css" rel="stylesheet" type="text/css"/>

	</head>

	<body class="register-2">
		<div class="page">
			<div class="page-content">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-4">
									<div class="text-center mb-5">
                                        <img src="{{asset('public')}}/logo/logo.png" alt="">
									</div>
									<div class="card">
										<div class="card-body">
											<div class="text-center mb-3">
												<h1 class="mb-2">Log In</h1>
												<a href="javascript:void(0);" class="">Welcome Back !</a>
											</div>
						
                                            <form method="POST" class="mt-5" id="login_from" action="{{ route('login') }}">
                                                     @csrf
                                                     @error('email')
                                                                <div class="alert alert-danger" role="alert">
                                                                {{ $message }}
                                                                </div>   
                                                    @enderror
                                                    
                                                    @error('password')
                                                    <div class="alert alert-danger" role="alert">
                                                                {{ $message }}
                                                                </div>      
                                                    @enderror
                                                        <div>
												<div class="input-group mb-4">
														<div class="input-group-text">
															<i class="fe fe-user"></i>
														</div>
                                                    <input id="email" tabindex="2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="required" autocomplete="off" placeholder="Email" autofocus>
												</div>
												<div class="input-group mb-4">
													<div class="input-group" id="Password-toggle1">
														<a href="" class="input-group-text">
														  <i class="fe fe-eye" aria-hidden="true"></i>
														</a>
                                                        <input id="password" tabindex="2" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required="required"  autocomplete="off"  placeholder="Password" >
													</div>
												</div>
												<div class="form-group text-center mb-3">
													<button  type="submit"  class="btn btn-primary btn-loaders btn-icon btn-lg w-100 br-7 login-btn">  {{ __('Login') }}</button>
													<!-- <button type="button" class="btn btn-primary btn-loaders btn-icon">Button</button> -->
												</div>
										
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Jquery js-->
		<script src="{{asset('public')}}/assets/js/jquery.min.js"></script>

		<!-- Bootstrap5 js-->
		<script src="{{asset('public')}}/assets/plugins/bootstrap/popper.min.js"></script>
		<script src="{{asset('public')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="{{asset('public')}}/assets/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!-- Circle-progress js-->
		<script src="{{asset('public')}}/assets/js/circle-progress.min.js"></script>

		<!-- Jquery-rating js-->
		<script src="{{asset('public')}}/assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- Show Password -->
		<script src="{{asset('public')}}/assets/js/bootstrap-show-password.min.js"></script>

		<!-- Custom js-->
		<script src="{{asset('public')}}/assets/js/custom.js"></script>

		<script>

					$(document).ready(function(){
						// alert();

						$(document).on('submit','#login_from',function(){

								$('.login-btn').prop('disabled',true);

						});

					});

		</script>

	</body>
</html>
