<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @section('title')
            e-Wakili
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
    <link href="{{ asset('app-css-js/plugins/datedropper/datedropper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app-css-js/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app-css-js/plugins/summernote/dist/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('app-css-js/dist/css/bootstrap-select-country.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app-css-js/plugins/bootstrap/dist/js/bootstrap-select.min.js') }}" rel="stylesheet">

    <link href="{{ asset('app-css-js/dist/css/custom.css') }}" rel="stylesheet">



    <!-- Datatable Dependency start -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
    <style>
        .button1,
        .button2,
        .button3,
        .button4,
        .button5,
        .button6,
        .button7,
        .button8,
        .button9,
        .button10,
        .button11,
        .button12,
        .button13,
        .button14,
        .button15,
        .button16,
        .button17,
        .button18,
        .button19,
        .button20,
        .button21 {
            display: none;
        }

        .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
            background-color: #ffffff;
            border-bottom: 0px;
        }

        .card-body {
            padding: 0rem 1.25rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .card {
            border-radius: 0px;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .flex-wrap {
            margin-bottom: -35px;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            margin-top: -25px;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #5D78FF;
            border-color: #5D78FF;
        }

        #table_id {
            text-size: 20px;
        }
    </style>

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <!-- end loader -->

    <div class="wrapper">
        <!--header starts-->
        @include('layouts.management.header')
        <!--header ends-->
        <div class="page-wrap">
            <!--sidebar starts-->
            @include('layouts.management.sidebar')
            <!--sidebar ends-->


            <!--main content starts-->
            @if (View::hasSection('content'))
                @yield('content')
            @endif
            <!--main content ends-->

            <!--chat list starts-->
            <aside class="right-sidebar">
                <div class="sidebar-chat" data-plugin="chat-sidebar">
                    <div class="sidebar-chat-info">
                        <h6>Chat List</h6>
                        <form class="mr-t-10">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search for friends ...">
                                <i class="ik ik-search"></i>
                            </div>
                        </form>
                    </div>
                    <div class="chat-list">
                        <div class="list-group row">
                            <a href="javascript:void(0)" class="list-group-item" data-chat-user="Gene Newman">
                                <figure class="user--online">
                                    <img src="../img/users/1.jpg" class="rounded-circle" alt="">
                                </figure><span><span class="name">Gene Newman</span> <span
                                        class="username">@gene_newman</span> </span>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item" data-chat-user="Billy Black">
                                <figure class="user--online">
                                    <img src="../img/users/2.jpg" class="rounded-circle" alt="">
                                </figure><span><span class="name">Billy Black</span> <span
                                        class="username">@billyblack</span> </span>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item" data-chat-user="Herbert Diaz">
                                <figure class="user--online">
                                    <img src="../img/users/3.jpg" class="rounded-circle" alt="">
                                </figure><span><span class="name">Herbert Diaz</span> <span
                                        class="username">@herbert</span> </span>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item" data-chat-user="Sylvia Harvey">
                                <figure class="user--busy">
                                    <img src="../img/users/4.jpg" class="rounded-circle" alt="">
                                </figure><span><span class="name">Sylvia Harvey</span> <span
                                        class="username">@sylvia</span> </span>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item active"
                                data-chat-user="Marsha Hoffman">
                                <figure class="user--busy">
                                    <img src="../img/users/5.jpg" class="rounded-circle" alt="">
                                </figure><span><span class="name">Marsha Hoffman</span> <span
                                        class="username">@m_hoffman</span> </span>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item" data-chat-user="Mason Grant">
                                <figure class="user--offline">
                                    <img src="../img/users/1.jpg" class="rounded-circle" alt="">
                                </figure><span><span class="name">Mason Grant</span> <span
                                        class="username">@masongrant</span> </span>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item" data-chat-user="Shelly Sullivan">
                                <figure class="user--offline">
                                    <img src="../img/users/2.jpg" class="rounded-circle" alt="">
                                </figure><span><span class="name">Shelly Sullivan</span> <span
                                        class="username">@shelly</span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
            <!--chat list ends-->

            <div class="chat-panel" hidden>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <a href="javascript:void(0);"><i class="ik ik-message-square text-success"></i></a>
                        <span class="user-name">John Doe</span>
                        <button type="button" class="close" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="card-body">
                        <div class="widget-chat-activity flex-1">
                            <div class="messages">
                                <div class="message media reply">
                                    <figure class="user--online">
                                        <a href="#">
                                            <img src="../img/users/3.jpg" class="rounded-circle" alt="">
                                        </a>
                                    </figure>
                                    <div class="message-body media-body">
                                        <p>Epic Cheeseburgers come in all kind of styles.</p>
                                    </div>
                                </div>
                                <div class="message media">
                                    <figure class="user--online">
                                        <a href="#">
                                            <img src="../img/users/1.jpg" class="rounded-circle" alt="">
                                        </a>
                                    </figure>
                                    <div class="message-body media-body">
                                        <p>Cheeseburgers make your knees weak.</p>
                                    </div>
                                </div>
                                <div class="message media reply">
                                    <figure class="user--offline">
                                        <a href="#">
                                            <img src="../img/users/5.jpg" class="rounded-circle" alt="">
                                        </a>
                                    </figure>
                                    <div class="message-body media-body">
                                        <p>Cheeseburgers will never let you down.</p>
                                        <p>They'll also never run around or desert you.</p>
                                    </div>
                                </div>
                                <div class="message media">
                                    <figure class="user--online">
                                        <a href="#">
                                            <img src="../img/users/1.jpg" class="rounded-circle" alt="">
                                        </a>
                                    </figure>
                                    <div class="message-body media-body">
                                        <p>A great cheeseburger is a gastronomical event.</p>
                                    </div>
                                </div>
                                <div class="message media reply">
                                    <figure class="user--busy">
                                        <a href="#">
                                            <img src="../img/users/5.jpg" class="rounded-circle" alt="">
                                        </a>
                                    </figure>
                                    <div class="message-body media-body">
                                        <p>There's a cheesy incarnation waiting for you no matter what you palete
                                            preferences are.</p>
                                    </div>
                                </div>
                                <div class="message media">
                                    <figure class="user--online">
                                        <a href="#">
                                            <img src="../img/users/1.jpg" class="rounded-circle" alt="">
                                        </a>
                                    </figure>
                                    <div class="message-body media-body">
                                        <p>If you are a vegan, we are sorry for you loss.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="javascript:void(0)" class="card-footer" method="post">
                        <div class="d-flex justify-content-end">
                            <textarea class="border-0 flex-1" rows="1" placeholder="Type your message here"></textarea>
                            <button class="btn btn-icon" type="submit"><i
                                    class="ik ik-arrow-right text-success"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <!--footer starts-->
            @include('layouts.management.footer')
            <!--footer ends-->

        </div>
    </div>




    <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog"
        aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                class="ik ik-x-circle"></i></button>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="quick-search">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ml-auto mr-auto">
                                <div class="input-wrap">
                                    <input type="text" id="quick-search" class="form-control"
                                        placeholder="Search..." />
                                    <i class="ik ik-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="container">
                        <div class="apps-wrap">
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-users"></i><span>Accounts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-shopping-cart"></i><span>Sales</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-briefcase"></i><span>Purchase</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-server"></i><span>Menus</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-clipboard"></i><span>Pages</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-message-square"></i><span>Chats</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-map-pin"></i><span>Contacts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-box"></i><span>Blocks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-calendar"></i><span>Events</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bell"></i><span>Notifications</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-pie-chart"></i><span>Reports</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-layers"></i><span>Tasks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-edit"></i><span>Blogs</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-settings"></i><span>Settings</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-more-horizontal"></i><span>More</span></a>
                            </div>
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
    <script src="{{ asset('app-css-js/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('app-css-js/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('app-css-js/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('app-css-js/dist/js/theme.js') }}"></script>
    <script src="{{ asset('app-css-js/js/form-advanced.js') }}"></script>
    <script src="{{ asset('app-css-js/plugins/datedropper/datedropper.min.js') }}"></script>
    <script src="{{ asset('app-css-js/js/form-picker.js') }}"></script>
    <script src="{{ asset('app-css-js/js/bootstrap-select-country.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        //go back funtion
        function goBack() {
            window.history.back();
        }


        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function() {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');

        // Loading...
        $(".btn").on('click', function() {
            var dataLoadingText = $(this).attr("data-loading-text");
            if (typeof dataLoadingText !== typeof undefined && dataLoadingText !== false) {
                console.log(dataLoadingText);
                $(this).text(dataLoadingText).addClass("disabled");
            }
        });

        $(window).on("load", function() {
            $("#pageloader-overlay").fadeOut("slow");
        });

        // Hide/Show div based on radio selection in Application for petition page
        $("input[name='olevel']:radio")
            .change(function() {
                $("#o-level-tz").toggle($(this).val() == "o-level-tz");
                $("#o-level-ab").toggle($(this).val() == "o-level-abroad");
            });

        $("input[name='alevel']:radio")
            .change(function() {
                $("#a-level-tz").toggle($(this).val() == "a-level-tz");
                $("#a-level-ab").toggle($(this).val() == "a-level-abroad");
            });

        $("input[name='llb']:radio")
            .change(function() {
                $("#llb-tz").toggle($(this).val() == "llb-tz");
                $("#llb-ab").toggle($(this).val() == "llb-abroad");
            });

        $("input[name='lst']:radio")
            .change(function() {
                $("#lst-yes").toggle($(this).val() == "lst-yes");
                $("#lst-no").toggle($(this).val() == "lst-no");
            });

        $("input[name='deedpoll']:radio")
            .change(function() {
                $("#deedpool-yes").toggle($(this).val() == "changed");
                $("#deedpool-no").toggle($(this).val() == "not-changed");
            });


        // View apploaded profile picture in Application for petition page
        function readURL(input) {
            var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                $('#img').attr('src', '/internal/images/Judiciary-Logo.png');
            }
        }

        // Date picker
        $(function() {
            $("#datepicker").datepicker();

            $(".countrypicker").select2();
        });

        // hide and show buttons in attachments view
        $(document).ready(function() {
            $(".div1").hover(function() {
                $(".button1").toggle();
            });
            $(".div2").hover(function() {
                $(".button2").toggle();
            });
            $(".div3").hover(function() {
                $(".button3").toggle();
            });
            $(".div4").hover(function() {
                $(".button4").toggle();
            });
            $(".div5").hover(function() {
                $(".button5").toggle();
            });
            $(".div6").hover(function() {
                $(".button6").toggle();
            });
            $(".div7").hover(function() {
                $(".button7").toggle();
            });
            $(".div8").hover(function() {
                $(".button8").toggle();
            });
            $(".div9").hover(function() {
                $(".button9").toggle();
            });
            $(".div10").hover(function() {
                $(".button10").toggle();
            });
            $(".div11").hover(function() {
                $(".button11").toggle();
            });
            $(".div12").hover(function() {
                $(".button12").toggle();
            });
            $(".div13").hover(function() {
                $(".button13").toggle();
            });
            $(".div14").hover(function() {
                $(".button14").toggle();
            });
            $(".div15").hover(function() {
                $(".button15").toggle();
            });
            $(".div16").hover(function() {
                $(".button16").toggle();
            });
            $(".div17").hover(function() {
                $(".button17").toggle();
            });
            $(".div18").hover(function() {
                $(".button18").toggle();
            });
            $(".div19").hover(function() {
                $(".button19").toggle();
            });
            $(".div20").hover(function() {
                $(".button20").toggle();
            });
            $(".div21").hover(function() {
                $(".button21").toggle();
            });
        });


        // Live search law firms and workplace
        $(document).ready(function() {
            $("#searchtxt").keyup(function() {
                var str = $("#searchtxt").val();
                if (str == "") {
                    $("#Hintdate").html("<b>Firms information will be listed here...</b>");
                } else {
                    $.get("{{ url('petition/search-firm?id=') }}" + str, function(data) {
                        $("#Hintdate").html(data);
                    });
                }
            });
        });

        // Show div based on drop down select
        function showDiv(select) {
            if (select.value == "Law Firm" || select.value == "Business Company") {
                document.getElementById('hidden_div').style.display = "block";
            } else {
                document.getElementById('hidden_div').style.display = "none";
            }
        }

        // Show div based on text click
        $("#show").click(function() {
            if ($(this).text() == "Show Address") {
                $("#example").css('display', 'block');
                $(this).text('Hide');
            } else {
                $("#example").css('display', 'none');
                $(this).text('Show Address');
            }
        });

        // Datatable
        $(document).ready(function() {
            //document.title='User Permissions';
            $('#table_id').DataTable({

                dom: '<"dt-buttons"Bf><"clear">lirtp',
                responsive: true,
                paging: true,
                pageLength: 25,
                lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]

            });
        });
    </script>
</body>

</html>
