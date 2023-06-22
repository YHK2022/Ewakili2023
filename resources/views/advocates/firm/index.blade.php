@extends('adv-static')

@section('title')
    @parent
    | My Firm/Work Place
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-briefcase bg-red"></i>
                            <div class="d-inline">
                                <h5>My Firm / Work Place</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">My Firm / Work Place</li>
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

            <div>
                <a title="Leave Firm" class="btn btn-info btn-xm pull-right">
                    <i class="ik ik-log-out"></i>
                    Leave Current Firm
                </a>
            </div><br/>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <p class="lead"><i class="ik ik-briefcase"></i> My Firm / Work Place </p><hr/>

                                @if($memberships != "No data")
                                    <div class="col-12">
                                        <p class="lead"><i class="ik ik-home"></i> Membership Information</p>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="table_id">
                                                <thead>
                                                <tr>
                                                    <th id="table_id" data-priority="1">#</th>
                                                    <th id="table_id">Firm</th>
                                                    <th id="table_id">Date Joined</th>
                                                    <th id="table_id">Date Left</th>
                                                    <th id="table_id">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($memberships as $key => $membership)
                                                    <tr>
                                                        <td id="table_id">{{++$key}}</td>
                                                        <td id="table_id">{{$membership->firm->name}}</td>
                                                        {{-- <td id="table_id">{{$membership->since}}</td> --}}
                                                        <td id="table_id">{{$membership->date_joined}}</td>
                                                        <td id="table_id">
                                                            @if($membership->till != Null)
                                                                {{ $membership->till }}
                                                            @else
                                                                Still a member
                                                            @endif
                                                        </td>
                                                        <td id="table_id">
                                                            <div class="table-actions" style="justify-content: center;align-items: center;  display: flex;">
                                                                <a href="{{ url('firm/view', $membership->uid) }}" title="View Certificate" ><i class="ik ik-eye pull-left"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

