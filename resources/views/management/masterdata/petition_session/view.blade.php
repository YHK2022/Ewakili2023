@extends('mgts-static')

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
                        <strong>  {{ \Illuminate\Support\Carbon::parse($sessions->open_date)->format('F d, Y')}}</strong></h5>
                </div>
                <div class="col-sm">
                    <h6>Close Date</h6>
                    <h5><i class="fa fa-calendar" aria-hidden="true" style="color: red;"></i>
                    <strong>  {{ \Illuminate\Support\Carbon::parse($sessions->close_date)->format('F d, Y')}}</strong></h5>

                </div>
                <div class="col-sm">
                    <h6>Admission Date</h6>
                    <h5><i class="fa fa-calendar" aria-hidden="true" style="color: red;"></i>
                    <strong>  {{ \Illuminate\Support\Carbon::parse($sessions->admission_date)->format('F d, Y')}}</strong></h5>


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
                                aria-controls="pills-timeline" aria-selected="true">All Petitioner <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#non_practising"
                                role="tab" aria-controls="pills-profile" aria-selected="false">CLE Sessions <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#suspended" role="tab"
                                aria-controls="pills-setting" aria-selected="false">Bar Exams <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#deferred" role="tab"
                                aria-controls="pills-setting" aria-selected="false">CJ Interview <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#non_profit" role="tab"
                                aria-controls="pills-setting" aria-selected="false">Views Objections <span
                                    class="badge bg-warning" style="color: white">{{$legal}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#retired" role="tab"
                                aria-controls="pills-setting" aria-selected="false">Pending Admission <span
                                    class="badge bg-warning" style="color: white"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#deceased" role="tab"
                                aria-controls="pills-setting" aria-selected="false"> Enrolled Advocates <span
                                    class="badge bg-warning" style="color: white">{{ $advocatesCount }}</span></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">


                        <div class="tab-pane fade show active" id="practising" role="tabpanel"
                            aria-labelledby="pills-timeline-tab">
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#no_venue"
                                        role="tab" aria-controls="pills-timeline" aria-selected="true">No Venue <span
                                            class="badge bg-warning" style="color: white"></span></a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#no_appearance"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">No Appearance
                                        <span class="badge bg-warning" style="color: white"></span></a>
                                </li> --}}

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
                                                 $session_id = DB::table('petition_sessions')->where('active',true)->first()->id;
                                                  $venues = DB::table('appearance_venues')
                                                  ->find($advocate->venue_id);
                                                   $appearDate = DB::table('appearances')
                                                   ->where('petition_session_id', $session_id)
                                                     ->where('venue_id', $advocate->venue_id)
                                                       ->first();
                                                     
                                                ?>
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $advocate->fullname }}</td>
                                            <td id="table_id">{{ $advocate->petition_no }}</td>
                                            <td id="table_id">@if($advocate->current_stage == 1) <span> FRONT
                                                    DESK</span>
                                                @elseif ($advocate->current_stage == 2)<span> RHC REVIEW</span>
                                                @elseif ($advocate->current_stage == 3)<span> CLE REVIEW</span>
                                                @elseif ($advocate->current_stage == 4)<span> CJ REVIEW</span>
                                                @endif</td>
                                            @if($venues == null)
                                            <td id="table_id">NO VENUE</td>
                                            @else
                                            <td id="table_id"> {{$venues->name}}</td>
                                            @endif
                                            {{-- <td id="table_id">{{ $appearVenues->name }}</td> --}}
                                            @if($venues == null)
                                            <td id="table_id">NO VENUE</td>
                                            @else
                                            <td id="table_id"> {{$venues->name}}</td>
                                            @endif
                                            @if($venues == null)
                                            <td id="table_id">No Appearance Date</td>
                                            @else
                                            <td id="table_id"> {{ date('F d, Y', strtotime($appearDate->appear_date )) }} </td>
                                            @endif
                                            <td id="table_id">{{ date('F d, Y', strtotime($advocate->submission_at)) }} </td>
                                            <td id="table_id">
                                                <div class="table-actions" style="justify-content: center;align-items: center;  display: flex;">
                                                        <a href="{{ url('settings/petition-session/profile-view', $advocate->uid) }}"
                                                            title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                                    </div>
                                          
                                                <div class="table-actions">

                                                   <a href="#edit{{ $advocate->uid }}" title="Edit"
                                                        data-toggle="modal" data-id="{{ $advocate->uid}}"
                                                        data-target="#edit{{ $advocate->uid}}"><i
                                                            class="ik ik-edit-2"></i></a>
                                                   

                                                </div>
                                            </td>
                                          
                                             
                                        </tr>
                                           <!-- Edit Session Model-->
                                        <div class="modal fade" id="edit{{ $advocate->uid }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('settings/petition-session/view/edit', $advocate->uid) }}">
                                                         <?php
                                                        
                                                        $session_id = DB::table('petition_sessions')->where('active',true)->first()->id;
                                                          $appearance_venues = DB::table('appearances')
                                                             ->join('appearance_venues', 'appearances.venue_id', '=', 'appearance_venues.id')
                                                                 ->where('appearances.petition_session_id', $session_id)
                                                              ->get();
                                                        
                                                           ?>
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Change  Appearance Venue</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                              
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleSelectGender"> Selected Appearance Venue</label>
                                        <select name="venue_id" class="form-control is-valid" id="exampleSelectGender" value="{{ $advocate->venue_id }}" required>
                                              @foreach ($appearance_venues as $appearance_venue)
                                               <option value="{{ $appearance_venue->id }}">
                                                {{  date('F d, Y', strtotime($appearance_venue->appear_date) ) }} |  {{ $appearance_venue->name  }}</option>
                                                 @endforeach
                                          
                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                          

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                           {{-- <div class="tab-pane fade" id="no_venue" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id7">
                                    <thead>
                                        <tr>
                                            <th id="table_id7" data-priority="1">#</th>
                                            <th id="table_id7">Full Name</th>
                                            <th id="table_id7">Roll Number</th>
                                            <th id="table_id7">Admission Date</th>
                                            <th id="table_id7">Status</th>
                                            <th id="table_id7" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                    </tbody>
                                </table>
                            </div>
                           </div> --}}
                           {{-- <div class="tab-pane fade" id="no_appearance" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id8">
                                    <thead>
                                        <tr>
                                            <th id="table_id8" data-priority="1">#</th>
                                            <th id="table_id8">Full Name</th>
                                            <th id="table_id8">Roll Number</th>
                                            <th id="table_id8">Admission Date</th>
                                            <th id="table_id8">Status</th>
                                            <th id="table_id8" data-priority="2">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       

                                    </tbody>
                                </table>
                            </div>
                           </div> --}}
                        </div>


                        <div class="tab-pane fade" id="non_practising" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                             <br>
                        
                                <p style="font-size: 20px; color: #1a9138; font-weight: bold; margin-bottom: 10px; padding-left: 20px;">
                                   <span style="display: inline-block;font-size: 13px; border-radius: 50%; background-color: #287a3c; color: #fff; padding: 6px 10px; font-size: 14px;">
                                    {{$corams}}
                                      </span>
                                       Total coram available
                                   </p>


                           <div class="container" style="display: flex; align-items: flex-start; justify-content: space-between;">
                              <div class="row" style="display: flex; align-items: flex-start; margin-left: 10px;">
                                 @foreach($coram_lists as $coram_list)
                                     <a href="#" id="coram-link-{{ $coram_list->id }}">
                                              <div style="display: inline-block; margin-right: 10px; border-radius: 30px;
                                                       color: white; font-size: 15px; padding-right: 10px; padding-left: 10px;
                                                          margin-bottom: 10px; background-color: #ac1515;">
                                               {{ date('F d, Y', strtotime($coram_list->workday)) }}
                                            </div>
                                         </a>
                                 @endforeach
                                 </div>

                                      <div id="related-data-container"></div>
                            </div>

                            <div class="card-body">
                              
                            </div>
                        </div>
                        <div class="tab-pane fade" id="suspended" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id2">
                                    <thead>
                                        <tr>
                                            <th id="table_id2" data-priority="1">#</th>
                                            <th id="table_id2">Full Name</th>
                                            <th id="table_id2">Roll Number</th>
                                            <th id="table_id2">Admission Date</th>
                                            <th id="table_id2">Status</th>
                                            <th id="table_id2" data-priority="2">Action</th>

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
                                <a data-toggle="modal" data-target="#addSession" style="margin-left: 40px;border-radius: 30px;
                                padding-right: 10px; padding-left: 10px; text-align:center; background-color: #ac1515;
                                color: white; font-size: 15px; "
                                     class="btn btn-xm pull-right">
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
                            <div class="row" style="display: flex; align-items: flex-start; margin-left: 10px;">
                              @foreach($appearances as $appearance)
                               <?php
                                 $venues = DB::table('appearance_venues')->find($appearance->venue_id);
                               ?>
                                <a href="#" id="coram-link-{{ $appearance->id }}">
                                    <div style="display: inline-block; margin-right: 10px; border-radius: 30px; color: white; font-size: 15px; padding-right: 10px; padding-left: 10px; margin-bottom: 10px; background-color: #ac1515;">
                                    {{ date('F d, Y', strtotime($appearance->appear_date)) }} | {{$appearance->name}}({{$appearance->appearnumber}})
                                    </div>
                               </a>
                             @endforeach
                            </div>
                              <div id="appearance-data-container">
                                
                              </div>
                        </div>


                    </div>

                        <div class="tab-pane fade" id="non_profit" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                        <thead>
                                            <tr>
                                               <th  data-priority="1">#</th>
                                                <th >Petitioner Name</th>
                                                <th >Admit As</th>
                                                <th >Comment</th>
                                                <th >Applied Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($legalViews as $key => $legalView)
                                            @php
                                             $profile = \App\Profile::find($legalView->profile_id);
                                         @endphp
                                                <tr>
                                                    <td >{{ ++$key }}</td>
                                                    <td >{{ $profile->fullname }}</td>
                                                    <td >{{ $legalView->admit_as }}</td>
                                                    <td >{{ $legalView->comment }}</td>
                                                    <td > {{ date('F d, Y', strtotime($legalView->created_at)) }}</td>
                                                 
                                                  
                                                </tr>

                                                <!-- View Advocate Model-->
                                               
                                            @endforeach

                                        </tbody>
                                    </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="retired" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id5">
                                    <thead>
                                        <tr>
                                            <th id="table_id5" data-priority="1">#</th>
                                            <th id="table_id5">Full Name</th>
                                            <th id="table_id5">Roll Number</th>
                                            <th id="table_id5">Admission Date</th>
                                            <th id="table_id5">Status</th>
                                            <th id="table_id5" data-priority="2">Action</th>

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
                                <table class="table table-hover" id="table_id6">
                                    <thead>
                                        <tr>
                                            <th id="table_id6" data-priority="1">#</th>
                                            <th id="table_id6">Full Name</th>
                                            <th id="table_id6">Roll Number</th>
                                            <th id="table_id6">Admission Date</th>
                                            <th id="table_id6">Status</th>
                                            {{-- <th id="table_id6" data-priority="2">Action</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($advocates as $key => $advocate)
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
                                        {{-- <td id="table_id">
                                            <div class="table-actions">
                                                <a href="{{ url('advocate/view', $advocate->uid) }}"
                                                    title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                            </div>
                                        </td> --}}
                                        </tr>

                                   
                                        @endforeach

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