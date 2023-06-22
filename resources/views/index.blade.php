@extends('public')

@section('title')
    @parent
    Home
@stop

@section('content')
    <div class="page-content bg-white">
        <!-- Main Slider -->
        <div class="section-area section-sp1 ovpr-dark bg-fix online-cours" style="background-image:url(images/banner2.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center text-white">
                        <span>
                            <h1 style="color: white;">Petition for Admission & Advocates System</h1>
                        </span>
                        <h2 style="color: white;">Know the advocate</h2>
                        <form class="cours-search">
                            <div class="input-group">
                                <input type="text" autocomplete="off" name="search" id="searchadvocate"
                                    class="searchtxt form-control" spellcheck="false"
                                    placeholder="Search by name or roll number">

                            </div>
                            <!-- Display search results -->
                            <div id="Advprofile"></div>
                        </form>

                    </div>

                </div>
                <div class="mw800 m-auto justify-content-center">
                    <div class="row justify-content-center">
                        @if ($session->close_date >= $current_date)
                            <div class="col-md-4 justify-content-center">
                                <div class="cours-search-bx m-b30">
                                    <span class="cours-search-text">New Petition for Admission!</span>
                                    <span class="cours-search-text">Clossing on {{ $session->close_date }}</span>
                                    <div class="justify-content-center">
                                        {{-- <a href="{{ url('advocate-registration') }}" class="btn">Apply Now</a> --}}
                                         <a href="{{ url('register') }}" class="btn">Apply Now</a>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
