@extends('mgt-static')

@section('title')
    @parent
    | Petitioner For Legal Objections
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-users bg-red"></i>
                            <div class="d-inline">
                                <h5>Petitioner For Legal Objections</h5>
                                <span>To be objected by Legal Professional</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Petitioner For Legal Objections</li>
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
                                    role="tab" aria-controls="pills-timeline" aria-selected="true">Pending Petitioners <span
                                        class="badge bg-warning" style="color: white">{{ $petitions->count()}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#practising"
                                    role="tab" aria-controls="pills-timeline" aria-selected="true">Done Petitioners <span
                                        class="badge bg-warning" style="color: white">{{ $legalViews->count()}}</span></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">


                            <div class="tab-pane fade show active" id="all" role="tabpanel"aria-labelledby="pills-timeline-tab">
                         <div style="display: flex; justify-content: flex-end;padding-top:10px;padding-right:15px">
                          <form action="{{ url('advocate/roll') }}" method="GET" style="margin-bottom: 10px;">
                                  <input type="text" name="query" placeholder="Search Roll no..." style="padding: 5px;">
                                  <button type="submit" class="badge bg-warning" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Search</button>
                         </form>
                          </div>
                            {{-- @if ($search_all->count() > 0) --}}
                                <div class="card-body">
                                    <table class="table table-hover" id="table_id">
                                        <thead>
                                            <tr>
                                                <th  data-priority="1">#</th>
                                                <th >Petitioner Name</th>
                                                <th >Petitioner Number</th>
                                                <th >Admit As</th>
                                                <th >Applied Date</th>
                                                <th  data-priority="2">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($petitions as $key => $petition)
                                             @php
                                             $profile = \App\Profile::find($petition->profile_id);
                                         @endphp
                                                <tr>
                                                     <td >{{ ++$key }}</td>
                                                    <td >{{ $profile->fullname }}</td>
                                                    <td >{{ $petition->petition_no }}</td>
                                                    <td >{{ $petition->admit_as }}</td>
                                                    <td > {{ date('F d, Y', strtotime($petition->created_at)) }}</td>
                                                  
                                                    <td >
                                                        <div class="table-actions" style="justify-content: center;align-items: center;  display: flex;">
                                                            <a href="{{ url('petition/legal-objections/view', $petition->uid) }}"
                                                            title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                                            </div>
                                                    </td>
                                                </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                             {{-- @else
                              <p>No results found.</p>
                            @endif --}}
                            </div>

                            <div class="tab-pane fade" id="practising" role="tabpanel"
                                aria-labelledby="pills-timeline-tab">
                                <div class="card-body">
                                    <table class="table table-hover" id="table_id1">
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

                         

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
