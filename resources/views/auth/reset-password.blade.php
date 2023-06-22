<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'JSDS') }}</title>
  <!--favicon-->
  <link rel="icon" href="homepage/images/Judiciary-Logo.png" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('homepage/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- animate CSS-->
  <link href="{{ asset('homepage/css/animate.css') }}" rel="stylesheet">
  <!-- Icons CSS-->
  <link href="{{ asset('homepage/css/icons.css') }}" rel="stylesheet">
  <!-- Horizontal menu CSS-->
  <link href="{{ asset('homepage/css/horizontal-menu.css') }}" rel="stylesheet">
  <!-- Custom Style-->
  <link href="{{ asset('homepage/css/app-style.css') }}" rel="stylesheet">
 
  
</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">


 <div class="card card-authentication1 mx-auto my-5">
    <div class="card-body">
        <div class="card-content p-2">
        <div class="card-title text-uppercase pb-2">Reset Password</div>
        <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
        <!-- Start Alert-->
			@if (session('success'))
			<div class="alert alert-outline-success alert-dismissible mb-0" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				<div class="alert-icon">
				<i class="fa fa-check"></i>
				</div>
				<div class="alert-message">
				<span> {{ session('success') }}  </span>
				</div>
			</div><br/>
			@endif

			@if($errors->any()) 
				@foreach($errors->all() as $error)
				<div class="alert alert-outline-warning alert-dismissible mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
						<div class="alert-icon">
						<i class="fa fa-exclamation-triangle"></i>
						</div>
						<div class="alert-message">
						<span> {{ $error }}  </span>
						</div>
					</div><br/>
				@endforeach
			@endif
			
			<!-- End Alert-->
         <form method="POST" action="{{ url('post-reset-password')}}" >
			{{ csrf_field() }}
            <div class="form-group">
			  <label for="exampleInputUsername">Email</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" name="email" value="{{ old('email') }}" id="exampleInputUsername" class="form-control input-shadow" placeholder="Enter Email">
				  <div class="form-control-position">
					  <i class="fa fa-envelope-o"></i>
				  </div>
			   </div>
			  </div>
            
            <button type="submit" class="btn btn-warning btn-block mt-3">Reset Password</button>
        </form>
        </div>
        </div>
        <div class="card-footer text-center py-3">
        <p class="text-dark mb-0">Return to the <a href="{{ url('login') }}"> Sign In</a></p>
        </div>
     </div>
    <!--End Back To Top Button-->
	
	
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('homepage/js/jquery.min.js') }}"></script>
  <script src="{{ asset('homepage/js/popper.min.js') }}"></script>
  <script src="{{ asset('homepage/js/bootstrap.min.js') }}"></script>
	
  <!-- simplebar js -->
  <script src="{{ asset('homepage/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- horizontal-menu js -->
  <script src="{{ asset('homepage/js/horizontal-menu.js') }}"></script>
  
  <!-- Custom scripts -->
  <script src="{{ asset('homepage/js/app-script.js') }}"></script>
  
</body>
</html>
