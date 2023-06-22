@extends('adv-static')

@section('title')
    @parent
    | My Certificates
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-award bg-red"></i>
                            <div class="d-inline">
                                <h5>My Certificates</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">My Certificates</li>
                                </li>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <p class="lead"><i class="ik ik-award"></i> My Certificates </p><hr/>

                                <table class="table table-hover" id="table_id">
                                    <thead>
                                    <tr>
                                        <th id="table_id" data-priority="1">#</th>
                                        <th id="table_id">Certificate</th>
                                        <th id="table_id">Practising Year</th>
                                        <th id="table_id">Issue Date</th>
                                        <th id="table_id">Expire Date</th>
                                        <th id="table_id">Status</th>
                                        <th id="table_id" data-priority="2">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($certificates as $certificate)
                                        <tr>
                                            <td id="table_id"><i class="ik ik-award"></i></td>
                                            <td id="table_id">{{$certificate->type}}</td>
                                            <td id="table_id">{{$certificate->issued_year}}</td>
                                            <td id="table_id">{{$certificate->date_of_issued}}</td>
                                            <td id="table_id">{{$certificate->expire_date}}</td>
                                            <td id="table_id">
                                                @if ($certificate->issued_year != $cur_year)
                                                    <span class="badge bg-danger" style="color: white">Expired</span>
                                                @else
                                                    <span class="badge bg-success" style="color: white">Active</span>
                                                @endif
                                            </td>
                                            <td id="table_id">
                                                 @if($certificate->type == 'NOTARY')
                                                  <div class="table-actions">
                                                    <a href="{{ url('my-certificate/notary', $certificate->uid) }}" title="View Certificate" ><i class="ik ik-eye pull-left"></i></a>
                                                </div>
                                                @else
                                                 <div class="table-actions">
                                                    <a href="{{ url('my-certificate/view', $certificate->uid) }}" title="View Certificate" ><i class="ik ik-eye pull-left"></i></a>
                                                </div>
                                                @endif

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

@endsection

