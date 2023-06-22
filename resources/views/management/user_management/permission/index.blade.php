@extends('mgt-static')

@section('title')
    @parent
    | User Permissions
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
                                <h5>User Permissions</h5>
                                <span>User Management</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">User Permission</li>
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
                <a data-toggle="modal" data-target="#addPermission" title="Add Permission"
                    class="btn btn-info btn-xm pull-right">
                    <i class="fa fa-plus"></i>
                    Add Permission
                </a>
                <!-- Add Permission Model-->
                <div class="modal fade" id="addPermission" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="forms-sample" method="POST" action="{{ url('user-management/permission/add') }}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demoModalLabel">Add User Permission</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Permission Name</label>
                                                <input type="text" name="name" class="form-control  is-valid"
                                                    placeholder="Permission Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">Display Name</label>
                                                <input type="text" name="display_name" class="form-control  is-valid"
                                                    placeholder="Display Name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Group Name</label>
                                                <input type="text" name="group_name" class="form-control  is-valid"
                                                    placeholder="Group Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">Guard Name</label>
                                                <input type="text" name="guard_name" value="web"
                                                    class="form-control  is-valid" placeholder="Guard Name" required
                                                    readonly>
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
                                        <th id="table_id">Permission</th>
                                        <th id="table_id">Group Name</th>
                                        <th id="table_id" data-priority="2">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $permission->display_name }}</td>
                                            <td id="table_id">{{ $permission->group_name }}</td>
                                            <td id="table_id">
                                                <div class="table-actions">
                                                    <a href="#edit{{ $permission->id }}" title="Edit"
                                                        data-toggle="modal" data-id="{{ $permission->id }}"
                                                        data-target="#edit{{ $permission->id }}"><i
                                                            class="ik ik-edit-2"></i></a>
                                                    <a href="#delete{{ $permission->id }}" title="Delete"
                                                        data-toggle="modal" data-id="{{ $permission->id }}"
                                                        data-target="#delete{{ $permission->id }}"><i
                                                            class="ik ik-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Permission Model-->
                                        <div class="modal fade" id="edit{{ $permission->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('user-management/permission/edit', $permission->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Edit User
                                                                Permission</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Permission
                                                                            Name</label>
                                                                        <input type="text" name="name"
                                                                            value="{{ $permission->name }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Permission Name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputConfirmPassword1">Display
                                                                            Name</label>
                                                                        <input type="text" name="display_name"
                                                                            value="{{ $permission->display_name }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Display Name" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Group
                                                                            Name</label>
                                                                        <input type="text" name="group_name"
                                                                            value="{{ $permission->group_name }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Group Name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputConfirmPassword1">Guard
                                                                            Name</label>
                                                                        <input type="text" name="guard_name"
                                                                            value="{{ $permission->guard_name }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="Guard Name" required readonly>
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


                                        <!-- Delete Permission Model-->
                                        <div class="modal fade" id="delete{{ $permission->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('user-management/permission/delete', $permission->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Delete User
                                                                Permission</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete Permission: <strong>
                                                                {{ $permission->display_name }} </strong>?
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

        </div>
    </div>

@endsection
