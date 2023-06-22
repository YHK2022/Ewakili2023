@extends('mgt-static')

@section('title')
    @parent
    | Petition Sessions
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
                                <h5>Master Data</h5>
                                <span>Petition Sessions</span>
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
                <a data-toggle="modal" data-target="#addSession" title="Add Session" class="btn btn-info btn-xm pull-right">
                    <i class="fa fa-plus"></i>
                    Add Session
                </a>
                <!-- Add Session Model-->
                <div class="modal fade" id="addSession" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="forms-sample" method="POST" action="{{ url('settings/petition-session/add')}}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demoModalLabel">Add Petition Session</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Open Date</label>
                                                <input type="date"  name="open_date" class="form-control  is-valid" placeholder="Open Date" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">Close Date</label>
                                                <input type="date"  name="close_date" class="form-control  is-valid" placeholder="Close Date" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Admission Date</label>
                                                <input type="date"  name="admission_date" class="form-control  is-valid" placeholder="Admission Date" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="table_id">
                                <thead>
                                <tr>
                                    <th id="table_id" data-priority="1">#</th>
                                    <th id="table_id">Open Date</th>
                                    <th id="table_id">Close Date</th>
                                    <th id="table_id">Admission Date</th>
                                    <th id="table_id">Admission Count</th>
                                    <th id="table_id">Status</th>
                                    <th id="table_id" data-priority="2">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sessions as $key => $session)
                                    <tr>
                                        <td id="table_id">{{++$key}}</td>
                                        <td id="table_id"> {{ date('F d, Y', strtotime($session->open_date)) }}</td>
                                        <td id="table_id"> {{ date('F d, Y', strtotime($session->close_date)) }}</td>
                                        <td id="table_id"> {{ date('F d, Y', strtotime($session->admission_date)) }}</td>
                                        <td id="table_id">
                                            @if($session->admitted_count > 0)
                                            {{$session->admitted_count}}
                                            @else
                                            Waiting for Admission
                                            @endif
                                        </td>
                                        <td id="table_id">
                                            @if ($session->active != "tue")
                                                <span class="badge bg-danger" style="color: white">Session Closed</span>
                                            @else
                                                <span class="badge bg-success" style="color: white">Active Session</span>
                                            @endif
                                        </td>
                                        <td id="table_id">
                                            <div class="table-actions">
                                                @if ($session->active != "tue")

                                                @else
                                                     <a href="{{ url('settings/petition-session/view', $session->uid) }}"
                                                            title="View Profile"><i class="ik ik-eye pull-left"></i></a>
                                                    <a href="#edit{{$session->id}}" title="Edit" data-toggle="modal" data-id="{{ $session->id }}" data-target="#edit{{$session->id}}"><i class="ik ik-edit-2"></i></a>
                                                    <a href="#delete{{$session->id}}" title="Delete" data-toggle="modal" data-id="{{ $session->id }}" data-target="#delete{{$session->id}}"><i class="ik ik-trash-2"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Session Model-->
                                    <div class="modal fade" id="edit{{$session->id}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <form class="forms-sample" method="POST" action="{{ url('settings/petition-session/edit', $session->id)}}">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="demoModalLabel">Edit Petition Session</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Open Date</label>
                                                                    <input type="date"  name="open_date" value="{{$session->open_date}}" class="form-control  is-valid" placeholder="Open Date" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputConfirmPassword1">Close Date</label>
                                                                    <input type="date"  name="close_date" value="{{$session->close_date}}" class="form-control  is-valid" placeholder="Close Date" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Admission Date</label>
                                                                    <input type="date"  name="admission_date" value="{{$session->admission_date}}" class="form-control  is-valid" placeholder="Group Name" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Delete session Model-->
                                    <div class="modal fade" id="delete{{$session->id}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <form class="forms-sample" method="POST" action="{{ url('settings/petition-session/delete', $session->id)}}">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="demoModalLabel">Delete Petition Session</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete Petition Session opened: <strong> {{$session->open_date}} </strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Yes Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


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


