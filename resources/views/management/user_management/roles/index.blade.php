@extends('mgt-static')

@section('title')
    @parent
    | Roles
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
                                <span>Roles</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Roles</li>
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
                <a data-toggle="modal" data-target="#addSession" title="Add Session" class="btn btn-info btn-xm pull-right">
                    <i class="fa fa-plus"></i>
                    Add Roles
                </a>
                <!-- Add Session Model-->
                <div class="modal fade" id="addSession" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="forms-sample" method="POST" action="{{ url('user-management/role/add') }}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demoModalLabel">Add Roles</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">User Role Name</label>
                                                <input type="text" name="name" class="form-control  is-valid"
                                                    placeholder="Use Role" required>
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
            @if (isset($roles) && count($roles) > 0)

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="col-lg-2">Role Name</th>
                                            <th>Description</th>
                                            <th>Permissions Assigned</th>
                                            <th class="col-lg-2"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ ucwords(str_replace('-', ' ', $role->name)) }}</td>
                                                <td>{{ ucwords(str_replace('-', ' ', $role->description)) }}</td>
                                                <td>
                                                    {{-- @foreach ($role->permissions as $permission)
                                                        <span class="btn btn-info btn-xs"
                                                            style="margin-bottom: 2px">{{ ucwords($permission->display_name) }}</span>
                                                    @endforeach --}}
                                                    <a title="permissions"
                                                        href="{{ url('user-management/role/permission', $role->id) }}"
                                                        class="btn btn-link"><i class="dripicons-lock-open"></i>
                                                        <i class="ik ik-link-2"></i></a>
                                                </td>
                                                <td>
                                                    <div class="table-actions">

                                                        <a href="#edit{{ $role->id }}" title="Edit"
                                                            data-toggle="modal" data-id="{{ $role->id }}"
                                                            data-target="#edit{{ $role->id }}"><i
                                                                class="ik ik-edit-2"></i></a>
                                                        <a href="#delete{{ $role->id }}" title="Delete"
                                                            data-toggle="modal" data-id="{{ $role->id }}"
                                                            data-target="#delete{{ $role->id }}"><i
                                                                class="ik ik-trash-2"></i></a>

                                                    </div>
                                                </td>
                                            </tr>


                                            <div class="modal fade" id="edit{{ $role->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" method="POST"
                                                            action="{{ url('user-management/role/edit', $role->id) }}">
                                                            {{ csrf_field() }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="demoModalLabel">role</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputPassword1">User Role
                                                                            </label>
                                                                            <input type="text" name="name"
                                                                                value="{{ $role->name }}"
                                                                                class="form-control  is-valid"
                                                                                placeholder="User Role" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Edit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Delete session Model-->
                                            <div class="modal fade" id="delete{{ $role->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <form class="forms-sample" method="POST"
                                                            action="{{ url('user-management/role/delete', $role->id) }}">
                                                            {{ csrf_field() }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="demoModalLabel">Delete
                                                                    role</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete User Role opened:
                                                                <strong> {{ $role->name }} </strong>?
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
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-hover" id="table_id">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="col-lg-2">Role Name</th>
                                        <th>Permissions Assigned</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ ucwords(str_replace('-', ' ', $role->name)) }}</td>
                                            <td>
                                                @foreach ($role->permissions as $permission)
                                                    <span class="btn btn-info btn-xs"
                                                        style="margin-bottom: 2px">{{ ucwords($permission->name) }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="table-actions">
                                                    @hasanyrole('super-admin')
                                                        <a title="Edit"
                                                            href="{{ url('user-management/role/edit', $role->id) }}"><i
                                                                class="ik ik-edit-2"></i>
                                                        </a>
                                                    @endhasanyrole
                                                    @hasanyrole('super-admin')
                                                        <a title="Delete"
                                                            href="{{ url('user-management/role/delete', $role->id) }}"><i
                                                                class="ik ik-trash-2"></i>
                                                        </a>
                                                    @endhasanyrole
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
