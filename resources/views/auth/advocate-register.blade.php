<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
			@section('title')
			e-Wakili | Registration
			@show
		</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

        <!--favicon-->
  		<link rel="icon" href="{{ URL::to('images/Judiciary-Logo.png') }}" type="image/x-icon">

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

		<link href="{{ asset('app-css-js/plugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('app-css-js//plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
		<link href="{{ asset('app-css-js/plugins/ionicons/dist/css/ionicons.min.css') }}" rel="stylesheet">
		<link href="{{ asset('app-css-js/plugins/icon-kit/dist/css/iconkit.min.css') }}" rel="stylesheet">
		<link href="{{ asset('app-css-js/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
		<link href="{{ asset('app-css-js/dist/css/theme.min.css') }}" rel="stylesheet">
		<link href="{{ asset('app-css-js/src/js/vendor/modernizr-2.8.3.min.js') }}" rel="stylesheet">

		<!--custom css-->
		<link href="{{ asset('app-css-js/dist/css/custom.css') }}" rel="stylesheet">
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

		<!-- start loader -->
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   		<!-- end loader -->

        <div class="auth-wrapper">
            <div class="container-fluid">
					<div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-5 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto" >
                            <h3><center>Create account to apply</center></h3>

                            <!-- Start Alert-->
							@if (session('success'))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								{{ session('success') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<i class="ik ik-x"></i>
								</button>
							</div>
							@endif
							@if (session('warning'))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								{{ session('warning') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<i class="ik ik-x"></i>
								</button>
							</div>
							@endif
							@if($errors->any())
								@foreach($errors->all() as $error)
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
									{{ $error }}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<i class="ik ik-x"></i>
									</button>
									</div>
								@endforeach
							@endif

							<!-- End Alert-->

                            <form method="POST" action="{{ url('advocate-post-registration')}}" >
							{{ csrf_field() }}

							<div class="form-group">
								<input type="text" name="national_id" value="{{ $nationalId }}" class="form-control" readonly>
								<i class="ik ik-credit-card"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" value="{{ old('userNmae') }}" class="form-control is-valid" placeholder="Full Name" id="exampleInputUsername">
                                    <i class="ik ik-user"></i>
                                </div>
								<div class="form-group">
                                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control is-valid" placeholder="Mobile Number eg. 07XXXXXXXX" id="exampleInputUsername">
                                    <i class="ik ik-phone"></i>
                                </div>
								<div class="form-group">
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control is-valid" placeholder="Valid Email eg. email@email.com" id="exampleInputUsername">
                                    <i class="ik ik-mail"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control is-valid" placeholder="Password" id="exampleInputPassword">
                                    <i class="ik ik-lock"></i>
                                </div>
								<div class="form-group">
                                    <input type="password" name="confirm_password" class="form-control is-valid" placeholder="Confirm Password" id="exampleInputPassword">
                                    <i class="ik ik-lock"></i>
                                </div>

                                <div class="sign-btn text-center">
                                    <button class="btn btn-theme" data-loading-text="Submiting request.....">Apply</button>
                                </div>
                            </form>
                            <div class="register">
                                <p>Already Registered? <a style="color:blue;" href="{{ URL('login') }}"> Sign In Here</a> | <i class="ik ik-home"></i> <a href="{{ url('/') }}">Home</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="{{ asset('app-css-js/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
		<script src="{{ asset('app-css-js/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('app-css-js/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
		<script src="{{ asset('app-css-js/plugins/screenfull/dist/screenfull.js') }}"></script>
		<script src="{{ asset('app-css-js/dist/js/theme.js') }}"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');

			$(".btn").on('click', function () {
			var dataLoadingText = $(this).attr("data-loading-text");
			if (typeof dataLoadingText !== typeof undefined && dataLoadingText !== false) {
				console.log(dataLoadingText);
				$(this).text(dataLoadingText).addClass("disabled");
			}
			});

			$(window).on("load",function(){
     	 	$("#pageloader-overlay").fadeOut("slow");
			});
        </script>
    </body>
</html>


