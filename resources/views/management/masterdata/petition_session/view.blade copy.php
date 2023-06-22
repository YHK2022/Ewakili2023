@extends('mgt-static')

@section('title')
@parent
| Sessions Management
@stop

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-lock bg-red"></i>
                        <div class="d-inline">
                            <h5>Sessions Management</h5>
                            <span>Session Details View</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Petition Sessions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Start Alert-->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
        <div>

            <div class="row"
                style="background-color:rgb(243, 240, 240); text-align:center; padding-top:20px; padding-bottom:10px;">
                <div class="col-sm">
                    <h6>Open Date</h6>

                    <h5><i class="fa fa-calendar" aria-hidden="true" style="color: red;"></i>
                        <strong>{{$sessions->open_date}}</strong></h5>
                </div>
                <div class="col-sm">
                    <h6>Close Date</h6>
                    <h5><i class="fa fa-calendar" aria-hidden="true" style="color: red;"></i>
                        <strong>{{$sessions->close_date}}</strong></h5>
                </div>
                <div class="col-sm">
                    <h6>Admission Date</h6>
                    <h5><i class="fa fa-calendar" aria-hidden="true" style="color: red;"></i>
                        <strong>{{$sessions->admission_date}}</strong></h5>

                </div>
                <div class="col-sm">
                    <h6>Admission Count</h6>
                    <h5><i class="fa fa-users" aria-hidden="true" style="color: red;"></i> <strong>{{$apps}}</strong>
                    </h5>

                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#practising" role="tab"
                                aria-controls="pills-timeline" aria-selected="true">ALL PETITIONER <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#non_practising"
                                role="tab" aria-controls="pills-profile" aria-selected="false">CLE SESSIONS <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#suspended" role="tab"
                                aria-controls="pills-setting" aria-selected="false">BAR EXAMS <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#deferred" role="tab"
                                aria-controls="pills-setting" aria-selected="false">CJ INTERVIEW <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#non_profit" role="tab"
                                aria-controls="pills-setting" aria-selected="false">VIEWS OBJECTION <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#retired" role="tab"
                                aria-controls="pills-setting" aria-selected="false">PENDING ADMISSION <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#deceased" role="tab"
                                aria-controls="pills-setting" aria-selected="false">DECEASED <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">


                        <div class="tab-pane fade show active" id="practising" role="tabpanel"
                            aria-labelledby="pills-timeline-tab">
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#no_venue"
                                        role="tab" aria-controls="pills-timeline" aria-selected="true">No Venue <span
                                            class="badge bg-warning" style="color: white"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#no_appearance"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">No Appearance
                                        <span class="badge bg-warning" style="color: white"></span></a>
                                </li>

                            </ul>

                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th id="table_id" data-priority="1">#</th>
                                            <th id="table_id">Petitioner Name</th>
                                            <th id="table_id">Petitioner No</th>
                                            <th id="table_id">Current Stage</th>
                                            <th id="table_id">Chosen Venue</th>
                                            <th id="table_id">Arranged Venue</th>
                                            <th id="table_id">CJ Appearance Date</th>
                                            <th id="table_id">Applied On</th>
                                            <th id="table_id" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result as $key => $advocate)
                                        <?php
                                                  $venues = DB::table('appearance_venues')
                                                  ->find($advocate->venue_id);
                                                ?>
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $advocate->fullname }}</td>
                                            <td id="table_id">{{ $advocate->petition_no }}</td>
                                            <td id="table_id">@if($advocate->current_stage == 1) <span> FRONT
                                                    DESK</span>
                                                @elseif ($advocate->current_stage == 2)<span> RHC</span>
                                                @elseif ($advocate->current_stage == 3)<span> CLE</span>
                                                @elseif ($advocate->current_stage == 4)<span> CJ</span>
                                                @endif</td>
                                            @if($venues == null)
                                            <td id="table_id">NO VENUE</td>
                                            <td id="table_id">NO VENUE</td>
                                            @else
                                            <td id="table_id"> {{$venues->name}}</td>
                                            <td id="table_id"> {{$venues->name}}</td>
                                            @endif
                                            <td id="table_id"></td>
                                            <td id="table_id">{{ $advocate->submission_at }} </td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="non_practising" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th id="table_id" data-priority="1">#</th>
                                            <th id="table_id">Full Name</th>
                                            <th id="table_id">Roll Number</th>
                                            <th id="table_id">Admission Date</th>
                                            <th id="table_id">Status</th>
                                            <th id="table_id" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($non_practising_all as $key => $advocate)
                                                <tr>
                                                    <td id="table_id">{{ ++$key }}</td>
                                        <td id="table_id">{{ $advocate->profile->fullname }}</td>
                                        <td id="table_id">{{ $advocate->roll_no }}</td>
                                        <td id="table_id">{{ $advocate->admission }}</td>
                                        <td id="table_id">
                                            @if ($advocate->paid_year != $cur_year)
                                            <span class="badge bg-danger" style="color: white">Not
                                                Active</span>
                                            @else
                                            <span class="badge bg-success" style="color: white">Active</span>
                                            @endif
                                        </td>
                                        <td id="table_id">
                                            <div class="table-actions">
                                                <a href="{{ url('advocate/view', $advocate->uid) }}"
                                                    title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                            </div>
                                        </td>
                                        </tr>

                                        <!-- View Advocate Model-->
                                        <div class="modal fade" id="view{{ $advocate->uid }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <center>Advocate Profile</center>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-5">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <div class="profile-pic mb-20">

                                                                    @if (!empty($profile->picture))
                                                                    <img src="{{ asset('storage/files/' . $profile->picture) }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @else
                                                                    <img src="{{ URL::to('images/user.png') }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @endif

                                                                    @if ($advocate->paid_year != $cur_year)
                                                                    <span class="badge bg-danger"
                                                                        style="color: white">Not Active Since
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @else
                                                                    <span class="badge bg-success"
                                                                        style="color: white">Active -
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @endif

                                                                    <h5 class="mt-20 mb-0">
                                                                        {{ $advocate->profile->fullname }}</h5>
                                                                    <a
                                                                        style="font-size:17px;color:blue;"><strong>{{ $advocate->status }}</strong></a>
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">
                                                                    Admission<br />{{ $advocate->admission }}</div>
                                                                <div class="badge badge-pill badge-dark">Roll
                                                                    No.<br />{{ $advocate->roll_no }}</div>
                                                            </div>

                                                            <hr class="mb-0">

                                                            <div class="card-body">
                                                                <h6 class="mt-30">Firm/Work Place:</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="suspended" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table1_id">
                                    <thead>
                                        <tr>
                                            <th id="table1_id" data-priority="1">#</th>
                                            <th id="table1_id">Full Name</th>
                                            <th id="table1_id">Roll Number</th>
                                            <th id="table1_id">Admission Date</th>
                                            <th id="table1_id">Status</th>
                                            <th id="table1_id" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($suspended_all as $key => $advocate)
                                                <tr>
                                                    <td id="table1_id">{{ ++$key }}</td>
                                        <td id="table1_id">{{ $advocate->profile->fullname }}</td>
                                        <td id="table1_id">{{ $advocate->roll_no }}</td>
                                        <td id="table1_id">{{ $advocate->admission }}</td>
                                        <td id="table1_id">
                                            @if ($advocate->paid_year != $cur_year)
                                            <span class="badge bg-danger" style="color: white">Not
                                                Active</span>
                                            @else
                                            <span class="badge bg-success" style="color: white">Active</span>
                                            @endif
                                        </td>
                                        <td id="table1_id">
                                            <div class="table-actions">
                                                <a href="{{ url('advocate/view', $advocate->uid) }}"
                                                    title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                            </div>
                                        </td>
                                        </tr>

                                        <!-- View Advocate Model-->
                                        <div class="modal fade" id="view{{ $advocate->uid }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <center>Advocate Profile</center>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-5">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <div class="profile-pic mb-20">

                                                                    @if (!empty($profile->picture))
                                                                    <img src="{{ asset('storage/files/' . $profile->picture) }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @else
                                                                    <img src="{{ URL::to('images/user.png') }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @endif

                                                                    @if ($advocate->paid_year != $cur_year)
                                                                    <span class="badge bg-danger"
                                                                        style="color: white">Not Active Since
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @else
                                                                    <span class="badge bg-success"
                                                                        style="color: white">Active -
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @endif

                                                                    <h5 class="mt-20 mb-0">
                                                                        {{ $advocate->profile->fullname }}</h5>
                                                                    <a
                                                                        style="font-size:17px;color:blue;"><strong>{{ $advocate->status }}</strong></a>
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">
                                                                    Admission<br />{{ $advocate->admission }}</div>
                                                                <div class="badge badge-pill badge-dark">Roll
                                                                    No.<br />{{ $advocate->roll_no }}</div>
                                                            </div>

                                                            <hr class="mb-0">

                                                            <div class="card-body">
                                                                <h6 class="mt-30">Firm/Work Place:</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="deferred" role="tabpanel" aria-labelledby="pills-setting-tab">


                            <br>
                            <div>
                                <a data-toggle="modal" data-target="#addSession" style="margin-left: 40px;"
                                    title="Add Session" class="btn btn-info btn-xm pull-right">
                                    <i class="fa fa-plus"></i>
                                    Add Appearance Date
                                </a>
                                <div class="modal fade" id="addSession" tabindex="-1" role="dialog"
                                    aria-labelledby="demoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('settings/appearance/add')}}">
                                                <?php
                                                           $appearance_venues = DB::table('appearance_venues')
                                                          ->get();
                                                           ?>
                                                {{ csrf_field() }}
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="demoModalLabel">Add Appearance Date</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Appearance
                                                                    Date</label>
                                                                <input type="date" name="appear_date"
                                                                    class="form-control  is-valid"
                                                                    placeholder="Open Date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputConfirmPassword1">Appearance
                                                                    Time</label>
                                                                <input type="time" name="reporting_time"
                                                                    class="form-control  is-valid"
                                                                    placeholder="Close Date" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Total Number Of
                                                                    Candidate</label>
                                                                <input type="number" name="number"
                                                                    class="form-control  is-valid"
                                                                    placeholder="candidate number" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleSelectGender">Appearance
                                                                    Venue</label>

                                                                <select name="venue_id" class="form-control is-valid"
                                                                    id="exampleSelectGender" required>
                                                                    @foreach ($appearance_venues as $appearance_venue)
                                                                    <option value="{{ $appearance_venue->id }}">
                                                                        {{ $appearance_venue->name  }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="container">
                                @foreach($appearances as $appearance)
                                <?php
                 $venues = DB::table('appearance_venues')
                ->find($appearance->venue_id);
                ?>
                                <div class="row" style="margin-left:10px;">
                                    <div style="display: inline-block;margin-right: 10px; border-radius:30px; color:white; font-size:15px;padding-right:10px;padding-left:10px;
                   margin-bottom:10px; background-color:rgb(58, 114, 58); ">{{$appearance->appear_date}} |
                                        {{$venues->name}}({{$appearance->appearnumber}})</div>
                                </div>
                                @endforeach
                            </div>



                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th id="table_id" data-priority="1">#</th>
                                            <th id="table_id">Full Name</th>
                                            <th id="table_id">Roll Number</th>
                                            <th id="table_id">Admission Date</th>
                                            <th id="table_id">Status</th>
                                            <th id="table_id" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($deferred_all as $key => $advocate)
                                                <tr>
                                                    <td id="table_id">{{ ++$key }}</td>
                                        <td id="table_id">{{ $advocate->profile->fullname }}</td>
                                        <td id="table_id">{{ $advocate->roll_no }}</td>
                                        <td id="table_id">{{ $advocate->admission }}</td>
                                        <td id="table_id">
                                            @if ($advocate->paid_year != $cur_year)
                                            <span class="badge bg-danger" style="color: white">Not
                                                Active</span>
                                            @else
                                            <span class="badge bg-success" style="color: white">Active</span>
                                            @endif
                                        </td>
                                        <td id="table_id">
                                            <div class="table-actions">
                                                <a href="{{ url('advocate/view', $advocate->uid) }}"
                                                    title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                            </div>
                                        </td>
                                        </tr>

                                        <!-- View Advocate Model-->
                                        <div class="modal fade" id="view{{ $advocate->uid }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <center>Advocate Profile</center>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-5">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <div class="profile-pic mb-20">

                                                                    @if (!empty($profile->picture))
                                                                    <img src="{{ asset('storage/files/' . $profile->picture) }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @else
                                                                    <img src="{{ URL::to('images/user.png') }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @endif

                                                                    @if ($advocate->paid_year != $cur_year)
                                                                    <span class="badge bg-danger"
                                                                        style="color: white">Not Active Since
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @else
                                                                    <span class="badge bg-success"
                                                                        style="color: white">Active -
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @endif

                                                                    <h5 class="mt-20 mb-0">
                                                                        {{ $advocate->profile->fullname }}</h5>
                                                                    <a
                                                                        style="font-size:17px;color:blue;"><strong>{{ $advocate->status }}</strong></a>
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">
                                                                    Admission<br />{{ $advocate->admission }}</div>
                                                                <div class="badge badge-pill badge-dark">Roll
                                                                    No.<br />{{ $advocate->roll_no }}</div>
                                                            </div>

                                                            <hr class="mb-0">

                                                            <div class="card-body">
                                                                <h6 class="mt-30">Firm/Work Place:</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="non_profit" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th id="table_id" data-priority="1">#</th>
                                            <th id="table_id">Full Name</th>
                                            <th id="table_id">Roll Number</th>
                                            <th id="table_id">Admission Date</th>
                                            <th id="table_id">Status</th>
                                            <th id="table_id" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($non_profit_all as $key => $advocate)
                                                <tr>
                                                    <td id="table_id">{{ ++$key }}</td>
                                        <td id="table_id">{{ $advocate->profile->fullname }}</td>
                                        <td id="table_id">{{ $advocate->roll_no }}</td>
                                        <td id="table_id">{{ $advocate->admission }}</td>
                                        <td id="table_id">
                                            @if ($advocate->paid_year != $cur_year)
                                            <span class="badge bg-danger" style="color: white">Not
                                                Active</span>
                                            @else
                                            <span class="badge bg-success" style="color: white">Active</span>
                                            @endif
                                        </td>
                                        <td id="table_id">
                                            <div class="table-actions">
                                                <a href="{{ url('advocate/view', $advocate->uid) }}"
                                                    title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                            </div>
                                        </td>
                                        </tr>

                                        <!-- View Advocate Model-->
                                        <div class="modal fade" id="view{{ $advocate->uid }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <center>Advocate Profile</center>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-5">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <div class="profile-pic mb-20">

                                                                    @if (!empty($profile->picture))
                                                                    <img src="{{ asset('storage/files/' . $profile->picture) }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @else
                                                                    <img src="{{ URL::to('images/user.png') }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @endif

                                                                    @if ($advocate->paid_year != $cur_year)
                                                                    <span class="badge bg-danger"
                                                                        style="color: white">Not Active Since
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @else
                                                                    <span class="badge bg-success"
                                                                        style="color: white">Active -
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @endif

                                                                    <h5 class="mt-20 mb-0">
                                                                        {{ $advocate->profile->fullname }}</h5>
                                                                    <a
                                                                        style="font-size:17px;color:blue;"><strong>{{ $advocate->status }}</strong></a>
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">
                                                                    Admission<br />{{ $advocate->admission }}</div>
                                                                <div class="badge badge-pill badge-dark">Roll
                                                                    No.<br />{{ $advocate->roll_no }}</div>
                                                            </div>

                                                            <hr class="mb-0">

                                                            <div class="card-body">
                                                                <h6 class="mt-30">Firm/Work Place:</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="retired" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th id="table_id" data-priority="1">#</th>
                                            <th id="table_id">Full Name</th>
                                            <th id="table_id">Roll Number</th>
                                            <th id="table_id">Admission Date</th>
                                            <th id="table_id">Status</th>
                                            <th id="table_id" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($retired_all as $key => $advocate)
                                                <tr>
                                                    <td id="table_id">{{ ++$key }}</td>
                                        <td id="table_id">{{ $advocate->profile->fullname }}</td>
                                        <td id="table_id">{{ $advocate->roll_no }}</td>
                                        <td id="table_id">{{ $advocate->admission }}</td>
                                        <td id="table_id">
                                            @if ($advocate->paid_year != $cur_year)
                                            <span class="badge bg-danger" style="color: white">Not
                                                Active</span>
                                            @else
                                            <span class="badge bg-success" style="color: white">Active</span>
                                            @endif
                                        </td>
                                        <td id="table_id">
                                            <div class="table-actions">
                                                <a href="{{ url('advocate/view', $advocate->uid) }}"
                                                    title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                            </div>
                                        </td>
                                        </tr>

                                        <!-- View Advocate Model-->
                                        <div class="modal fade" id="view{{ $advocate->uid }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <center>Advocate Profile</center>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-5">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <div class="profile-pic mb-20">

                                                                    @if (!empty($profile->picture))
                                                                    <img src="{{ asset('storage/files/' . $profile->picture) }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @else
                                                                    <img src="{{ URL::to('images/user.png') }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @endif

                                                                    @if ($advocate->paid_year != $cur_year)
                                                                    <span class="badge bg-danger"
                                                                        style="color: white">Not Active Since
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @else
                                                                    <span class="badge bg-success"
                                                                        style="color: white">Active -
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @endif

                                                                    <h5 class="mt-20 mb-0">
                                                                        {{ $advocate->profile->fullname }}</h5>
                                                                    <a
                                                                        style="font-size:17px;color:blue;"><strong>{{ $advocate->status }}</strong></a>
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">
                                                                    Admission<br />{{ $advocate->admission }}
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">Roll
                                                                    No.<br />{{ $advocate->roll_no }}</div>
                                                            </div>

                                                            <hr class="mb-0">

                                                            <div class="card-body">
                                                                <h6 class="mt-30">Firm/Work Place:</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="deceased" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th id="table_id" data-priority="1">#</th>
                                            <th id="table_id">Full Name</th>
                                            <th id="table_id">Roll Number</th>
                                            <th id="table_id">Admission Date</th>
                                            <th id="table_id">Status</th>
                                            <th id="table_id" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($deceased_all as $key => $advocate)
                                                <tr>
                                                    <td id="table_id">{{ ++$key }}</td>
                                        <td id="table_id">{{ $advocate->profile->fullname }}</td>
                                        <td id="table_id">{{ $advocate->roll_no }}</td>
                                        <td id="table_id">{{ $advocate->admission }}</td>
                                        <td id="table_id">
                                            @if ($advocate->paid_year != $cur_year)
                                            <span class="badge bg-danger" style="color: white">Not
                                                Active</span>
                                            @else
                                            <span class="badge bg-success" style="color: white">Active</span>
                                            @endif
                                        </td>
                                        <td id="table_id">
                                            <div class="table-actions">
                                                <a href="{{ url('advocate/view', $advocate->uid) }}"
                                                    title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                            </div>
                                        </td>
                                        </tr>

                                        <!-- View Advocate Model-->
                                        <div class="modal fade" id="view{{ $advocate->uid }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <center>Advocate Profile</center>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-5">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <div class="profile-pic mb-20">

                                                                    @if (!empty($profile->picture))
                                                                    <img src="{{ asset('storage/files/' . $profile->picture) }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @else
                                                                    <img src="{{ URL::to('images/user.png') }}"
                                                                        width="150" class="rounded-circle" alt="user">
                                                                    @endif

                                                                    @if ($advocate->paid_year != $cur_year)
                                                                    <span class="badge bg-danger"
                                                                        style="color: white">Not Active Since
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @else
                                                                    <span class="badge bg-success"
                                                                        style="color: white">Active -
                                                                        {{ $advocate->paid_year }}</span>
                                                                    @endif

                                                                    <h5 class="mt-20 mb-0">
                                                                        {{ $advocate->profile->fullname }}</h5>
                                                                    <a
                                                                        style="font-size:17px;color:blue;"><strong>{{ $advocate->status }}</strong></a>
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">
                                                                    Admission<br />{{ $advocate->admission }}
                                                                </div>
                                                                <div class="badge badge-pill badge-dark">Roll
                                                                    No.<br />{{ $advocate->roll_no }}</div>
                                                            </div>

                                                            <hr class="mb-0">

                                                            <div class="card-body">
                                                                <h6 class="mt-30">Firm/Work Place:</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection







<div  role="tabpanel" aria-labelledby="pills-setting-tab">
<div class="card-body">
                                <table class="table table-hover" id="table_id8">
                                    <thead>
                                        <tr>
                                            <th id="table_id8" data-priority="1">#</th>
                                            <th id="table_id8">Petition Name</th>
                                            <th id="table_id8">Petition No</th>
                                            <th id="table_id8">Applied On</th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appearanceMembers as $key => $appearanceMember)
                                         @php
                                             $profile = \App\Profile::find($appearanceMember->profile_id);
                                         @endphp
                                        <tr>
                                        <td id="table_id8">{{ ++$key }}</td>
                                        <td id="table_id8">{{ $profile->fullname }}</td>
                                        <td id="table_id8">{{ $appearanceMember->petition_no }}</td>
                                        <td id="table_id8"> {{ date('F d, Y', strtotime($appearanceMember->created_at)) }} </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
</div>





