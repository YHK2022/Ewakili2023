<!DOCTYPE html>
<html lang="en">

<head>

    <!-- META ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />

    <!-- DESCRIPTION -->
    <meta name="description" content="EduChamp : Education HTML Template" />

    <!-- OG -->
    <meta property="og:title" content="EduChamp : Education HTML Template" />
    <meta property="og:description" content="EduChamp : Education HTML Template" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON ============================================= -->
    <link rel="icon" href="{{ URL::to('/public/images/Judiciary-Logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('/public/images/Judiciary-Logo.png') }}" />

    <!-- PAGE TITLE HERE ============================================= -->
    <title>
        @section('title')
            e-Wakili |
        @show
    </title>

    <!-- MOBILE SPECIFIC ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
 <script src="assets/js/html5shiv.min.js"></script>
 <script src="assets/js/respond.min.js"></script>
 <![endif]-->

    <!-- FONT FAMILY ============================================= -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- All PLUGINS CSS ============================================= -->
    <link href="{{ asset('public/css/assets.css') }}" rel="stylesheet" type="text/css">

    <!-- TYPOGRAPHY ============================================= -->
    <link href="{{ asset('public/css/typography.css') }}" rel="stylesheet" type="text/css">

    <!-- SHORTCODES ============================================= -->
    <link href="{{ asset('public/css/shortcodes/shortcodes.css') }}" rel="stylesheet" type="text/css">

    <!-- STYLESHEETS ============================================= -->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- REVOLUTION SLIDER CSS ============================================= -->
    <link href="{{ asset('public/vendors/revolution/css/layers.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendors/revolution/css/settings.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendors/revolution/css/navigation.css') }}" rel="stylesheet" type="text/css">
    <!-- REVOLUTION SLIDER END -->








    <style>

    </style>

</head>

<body id="bg">
    <div class="page-wraper">
        <!-- start loader -->
        <div id="pageloader-overlay" class="visible incoming">Loading....<div class="loader-wrapper-outer">
                <div class="loader-wrapper-inner">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
        <!-- end loader -->
        <!-- Header Top ==== -->
        @include('layouts.home.header')
        <!-- Header Top END ==== -->
        <!-- Content -->
        @if (View::hasSection('content'))
            @yield('content')
        @endif
        <!-- Content END-->
        <!-- Footer ==== -->
        @include('layouts.home.footer')
        <!-- Footer END ==== -->
        <button class="back-to-top fa fa-chevron-up"></button>
    </div>

    <!-- External JavaScripts -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('public/vendors/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ asset('public/vendors/counter/waypoints-min.js') }}"></script>
    <script src="{{ asset('public/vendors/counter/counterup.min.js') }}"></script>
    <script src="{{ asset('public/vendors/imagesloaded/imagesloaded.js') }}"></script>
    <script src="{{ asset('public/vendors/masonry/masonry.js') }}"></script>
    <script src="{{ asset('public/vendors/masonry/filter.js') }}"></script>
    <script src="{{ asset('public/vendors/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('public/js/functions.js') }}"></script>
    <script src="{{ asset('public/js/contact.js') }}"></script>

    <script>
        //go back funtion
        function goBack() {
            window.history.back();
        }

        $(window).on("load", function() {
            $("#pageloader-overlay").fadeOut("slow");
        });

        // Live search Advocates for Public
        $(document).ready(function() {
            $("#searchadvocate").keyup(function() {
                var str = $("#searchadvocate").val();
                if (str == "") {
                    $("#Advprofile").html("<b>Advocate information will be listed here...</b>");
                } else {
                    $.get("{{ url('public/search-advocate?id=') }}" + str, function(data) {
                        if (data == "") {
                            $("#Advprofile").html(
                                    '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <span class="font-periksa animated infinite flash">Loading</span>'
                                )
                                .fadeIn(200);
                        } else {
                            $("#Advprofile").html(data);
                        }

                    });
                }
            });
        });
    </script>

</body>

</html>
