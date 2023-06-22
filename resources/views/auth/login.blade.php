
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
			@section('title')
			e-Wakili | Login
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
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto" >
                            <div class="logo-centered">
							<img src="{{ URL::to('/public/images/Judiciary-Logo.png') }}" style="height:60px; width: 60px;"  alt="logo icon">
                            </div>
                            <h3>Sign In to e-Wakili</h3>

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

                            <form method="POST" action="{{ url('post-login')}}" >
							{{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control is-valid" placeholder="Email" value="{{ old('email') }}" id="exampleInputUsername">
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control is-valid" placeholder="Password" id="exampleInputPassword">
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="row">
                                    <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                            <span class="custom-control-label">&nbsp;Remember Me</span>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <a href="forgot-password.html">Forgot Password ?</a>
                                    </div>
                                </div>
                                <div class="sign-btn text-center">
                                    <button class="btn btn-theme" data-loading-text="Processing.....">Sign In</button>
                                </div>
                            </form>
                            <div class="register">
                                <p>Khow the Advocate! <i class="ik ik-home"></i> <a href="{{ url('/') }}">Go back home</a></p>
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
