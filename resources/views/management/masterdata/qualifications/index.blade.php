@extends('mgt-static')

@section('title')
    @parent
    | Qualifications
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
                                <span>Qualifications</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Qualifications</li>
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
            <div>
                <a data-toggle="modal" data-target="#addBatch" title="Add Qualifications"
                    class="btn btn-info btn-xm pull-right">
                    <i class="fa fa-plus"></i>
                    Add Qualifications
                </a>
                <!-- Add Session Model-->
                <div class="modal fade" id="addBatch" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="forms-sample" method="POST" action="{{ url('settings/qualifications/add') }}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demoModalLabel">Add Qualifications</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Start Date</label>
                                                <input type="date" name="start_date" class="form-control  is-valid"
                                                    placeholder="Start Date" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">First Deadline</label>
                                                <input type="date" name="first_deadline" class="form-control  is-valid"
                                                    placeholder="First Deadline" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">First Penalty</label>
                                                <input type="text" name="first_penalt" class="form-control  is-valid"
                                                    placeholder="First Penalty" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Second Deadline</label>
                                                <input type="date" name="second_deadline" class="form-control  is-valid"
                                                    placeholder="Second Deadline" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">Second Penalty</label>
                                                <input type="text" name="second_penalt" class="form-control  is-valid"
                                                    placeholder="Second Penalty" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">End Date</label>
                                                <input type="date" name="end_date" class="form-control  is-valid"
                                                    placeholder="End Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Renewal Year</label>
                                                <input type="text" name="year" class="form-control  is-valid"
                                                    placeholder="Renewal Year" required>
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
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="table_id">
                                <thead>
                                    <tr>
                                        <th id="table_id" data-priority="1">#</th>
                                        <th id="table_id">Name</th>
                                        <th id="table_id">Qualification Name</th>
                                        <th id="table_id">Qualification Group</th>
                                        <th id="table_id" data-priority="2">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($qualifications as $key => $qualification)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $qualification->name }}</td>
                                            <td id="table_id">{{ $qualification->qualification_name }}</td>
                                            <td id="table_id">{{ $qualification->qualification_group }}</td>
                                            <td id="table_id">
                                                <div class="table-actions">
                                                    <a href="#edit{{ $qualification->id }}" title="Edit"
                                                        data-toggle="modal" data-id="{{ $qualification->id }}"
                                                        data-target="#edit{{ $qualification->id }}"><i
                                                            class="ik ik-edit-2"></i></a>
                                                    <a href="#delete{{ $qualification->id }}" title="Delete"
                                                        data-toggle="modal" data-id="{{ $qualification->id }}"
                                                        data-target="#delete{{ $qualification->id }}"><i
                                                            class="ik ik-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Session Model-->
                                        <div class="modal fade" id="edit{{ $qualification->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('settings/qualifications/edit', $qualification->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Edit Renewal
                                                                qualification</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Start
                                                                            Date</label>
                                                                        <input type="date" name="start_date"
                                                                            value="{{ $qualification->start_date }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Start Date" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputConfirmPassword1">First
                                                                            Deadline</label>
                                                                        <input type="date" name="first_deadline"
                                                                            value="{{ $qualification->first_deadline }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="First Deadline" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputConfirmPassword1">First
                                                                            Penalty</label>
                                                                        <input type="text" name="first_penalt"
                                                                            value="{{ $qualification->first_penalt }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="First Penalty" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Second
                                                                            Deadline</label>
                                                                        <input type="date" name="second_deadline"
                                                                            value="{{ $qualification->second_deadline }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Second Deadline" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputConfirmPassword1">Second
                                                                            Penalty</label>
                                                                        <input type="text" name="second_penalt"
                                                                            value="{{ $qualification->second_penalt }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Second Penalty" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputConfirmPassword1">End
                                                                            Date</label>
                                                                        <input type="date" name="end_date"
                                                                            value="{{ $qualification->end_date }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="End Date" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Renewal
                                                                            Year</label>
                                                                        <input type="text" name="year"
                                                                            value="{{ $qualification->year }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Renewal Year" required>
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

                                        <!-- Delete session Model-->
                                        <div class="modal fade" id="delete{{ $qualification->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('settings/qualifications/delete', $qualification->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Delete Stage</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete Stage: <strong>
                                                                {{ $qualification->name }} </strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes
                                                                Delete</button>
                                                        </div>
                                                    </form>
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

@endsection
