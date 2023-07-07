@extends('mgt-static')

@section('title')
    @parent
    | Application For Non Profit
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
                                <h5>Application For Resume Profit</h5>
                                <span>Current applications</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">CJ Review</li>
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
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ik ik-x"></i>
                        </button>
                    </div>
                @endforeach
            @endif

            <!-- End Alert-->

            <div class="row">
              <div class="col-md-12">
                    <div class="card">
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#all"
                                    role="tab" aria-controls="pills-timeline" aria-selected="true">Pending Applications <span
                                        class=" badge " style="color:white; background-color:#de2a3c;">
                                        {{ $applications_count }}
                                    </span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#practising"
                                    role="tab" aria-controls="pills-timeline" aria-selected="true">Returned Applications <span
                                        class="badge bg-warning" style="color: white">
                                        {{ $submit_applications_count }}
                                    </span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#non_practising"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Approved Applications <span
                                        class="badge bg-warning" style="color: white">
                                        {{ $approved_applications_count }}
                                    </span></a>
                            </li>
                            
                            
                
                        </ul>
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="all" role="tabpanel"
                                aria-labelledby="pills-timeline-tab">
                                <div class="card-body">
                                    <table class="table table-hover" id="table_id">
                                <thead>
                                    <tr>
                                        <th id="table_id" data-priority="1">#</th>
                                        <th id="table_id">Applicant Name</th>
                                        <th id="table_id">Application Type</th>
                                        <th id="table_id">Current Stage</th>
                                        <th id="table_id">Status</th>
                                        <th id="table_id">Submitted Date</th>
                                        <th id="table_id">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $key => $application)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $application->profile_detail->fullname }}</td>
                                            <td id="table_id">{{ $application->type }}</td>
                                            <td id="table_id"> CJ REVIEW </td>
                                            <td id="table_id">{{ $application->status }}</td>
                                            <td id="table_id"> {{ date('F d, Y', strtotime($application->submission_at)) }}</td>
                                            <td id="table_id">
                                                <div class="table-actions">
                                                    <div class="table-actions">
                                                        <a href="{{ url('permit/non-profit/cj/view', $application->uid) }}"
                                                            title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="practising" role="tabpanel"
                                aria-labelledby="pills-timeline-tab">
                                <div class="card-body">
                                    <table class="table table-hover" id="table_id1">
                                        <thead>
                                            <tr>
                                                 <th id="table_id1" data-priority="1">#</th>
                                        <th id="table_id1">Applicant Name</th>
                                        <th id="table_id1">Application Type</th>
                                        <th id="table_id1">Current Stage</th>
                                        <th id="table_id1">Status</th>
                                        <th id="table_id1">Submitted Date</th>
                                        <th id="table_id1">Action</th>

                                            </tr>
                                        </thead>
                                       <tbody>
                                            @foreach ($submit_applications as $key => $application)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $application->profile_detail->fullname }}</td>
                                            <td id="table_id">{{ $application->type }}</td>
                                            <td id="table_id"> RHC REVIEW </td>
                                            <td id="table_id">{{ $application->status }}</td>
                                            <td id="table_id"> {{ date('F d, Y', strtotime($application->submission_at)) }}</td>
                                            <td id="table_id">
                                                <div class="table-actions">
                                                    <div class="table-actions">
                                                        <a href="{{ url('permit/non-practising/view', $application->uid) }}"
                                                            title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="non_practising" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    <table class="table table-hover" id="table_id2">
                                        <thead>
                                            <tr>
                                                 <th id="table_id2" data-priority="1">#</th>
                                        <th id="table_id2">Applicant Name</th>
                                        <th id="table_id2">Application Type</th>
                                        <th id="table_id2">Current Stage</th>
                                        <th id="table_id2">Status</th>
                                        <th id="table_id2">Submitted Date</th>
                                        {{-- <th id="table_id2">Action</th> --}}

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($approved_applications as $key => $application)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $application->profile_detail->fullname }}</td>
                                            <td id="table_id">{{ $application->type }}</td>
                                            <td id="table_id"> CJ REVIEW </td>
                                            <td id="table_id">{{ $application->status }}</td>
                                            <td id="table_id">{{ $application->submission_at }}</td>
                                            
                                        </tr>
                                    @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="suspended" role="tabpanel"
                                aria-labelledby="pills-setting-tab">
                              
                                <div class="card-body">
                                    
                                    <table class="table table-hover" id="table_id3">
                                        <thead>
                                            <tr>
                                        <th id="table_id3" data-priority="1">#</th>
                                        <th id="table_id3">Applicant Name</th>
                                        <th id="table_id3">Application Type</th>
                                        <th id="table_id3">Current Stage</th>
                                        <th id="table_id3">Status</th>
                                        <th id="table_id3">Submitted Date</th>
                                        <th id="table_id3">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($applications as $key => $application)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $application->profile_detail->fullname }}</td>
                                            <td id="table_id">{{ $application->type }}</td>
                                            <td id="table_id"> FRONT DESK </td>
                                            <td id="table_id">{{ $application->status }}</td>
                                            <td id="table_id">{{ $application->submission_at }}</td>
                                            <td id="table_id">
                                                <div class="table-actions">
                                                        <div class="table-actions" style="justify-content: center;align-items: center;  display: flex;">
                                                        <a href="{{ url('petition/view', $application->uid) }}"
                                                            title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                                    </div>
                                                </div>
                                            </td>
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
