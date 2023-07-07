

@extends('mgt-static')

@section('title')
    @parent
    | Application For Petition
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
                                <h5>Application For Petition</h5>
                                <span>Petition Review</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Petition Review</li>
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
                                        <th id="table_id"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $key => $application)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $application->profile_detail->fullname }}</td>
                                            <td id="table_id">{{ $application->type }}</td>
                                            <td id="table_id"> 
                                               @if($application->current_stage == 1)
                                                     <span>Front Desk</span>
                                               @elseif($application->current_stage == 2)
                                                     <span>RHC Review</span>
                                               @elseif($application->current_stage == 3)
                                                     <span>CLE Review</span>
                                               @elseif($application->current_stage == 4)
                                                       <span>CJ Review</span>
                                               @elseif($application->current_stage == 5)
                                                       <span>JK Review</span>
                                               @endif
                                            </td>
                                            <td id="table_id">{{ $application->status }}</td>
                                            <td id="table_id"> {{ date('F d, Y', strtotime($application->submission_at)) }}</td>
                                            <td id="table_id">
                                                {{-- <div class="table-actions">
                                                    <div class="table-actions">
                                                        <a href="{{ url('permit/suspend/cj/view', $application->uid) }}"
                                                            title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                                    </div>
                                                </div> --}}
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

@endsection
