<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>
    @section('title')
      e-Wakili
    @show
  </title>
  <!--favicon-->
  <link rel="icon" href="{{ URL::to('/internal/images/Judiciary-Logo.png') }}" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="{{ asset('internal/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('internal/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('internal/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('internal/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('internal/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('internal/css/app-style.css') }}" rel="stylesheet"/>
  <!-- skins CSS-->
  <link href="{{ asset('internal/css/skins.css') }}" rel="stylesheet"/>

</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
  @include('layouts.advocates.sidebar')
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
@include('layouts.advocates.header')
<!--End topbar header-->

<div class="clearfix"></div>

<!--Start content-->
@if(View::hasSection('content'))
   @yield('content')
@endif
<!--End content-->

<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
    </div>
    <!-- End container-fluid-->
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	<!--Start footer-->
  @include('layouts.advocates.footer')
	<!--End footer-->

  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('internal/js/jquery.min.js') }}"></script>
  <script src="{{ asset('internal/js/popper.min.js') }}"></script>
  <script src="{{ asset('internal/js/bootstrap.min.js') }}"></script>

  <!-- simplebar js -->
  <script src="{{ asset('internal/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('internal/js/sidebar-menu.js') }}"></script>

  <!-- Custom scripts -->
  <script src="{{ asset('internal/js/app-script.js') }}"></script>

</body>
</html>
