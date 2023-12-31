@extends('mgt-static')

@section('title')
@parent
| User List
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
                            <h5>User Management</h5>
                            <span>User List</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
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
                Add User
            </a>
            <!-- Add Session Model-->
            <div class="modal fade" id="addSession" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form class="forms-sample" method="POST" action="{{ url('user-management/user/add') }}">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="demoModalLabel">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Full
                                                Name</label>
                                            <input type="text" name="full_name" class="form-control  is-valid"
                                                placeholder="full name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email
                                            </label>
                                            <input type="email" name="email" class="form-control  is-valid"
                                                placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">
                                                User Name</label>
                                            <input type="text" name="username" class="form-control  is-valid"
                                                placeholder="username" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Phone Number
                                            </label>
                                            <input type="text" name="phone_number" class="form-control  is-valid"
                                                placeholder="phone number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Roles
                                            </label>
                                            <select class="form-control selectpicker" name="role_id" required
                                                data-live-search="true" data-live-search-style="begins"
                                                title="Select Role...">
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password
                                            </label>
                                            <input type="password" name="password" class="form-control  is-valid"
                                                placeholder="password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Action User Type
                                            </label>
                                            <select class="form-control selectpicker" name="action_user_type_id"
                                                required data-live-search="true" data-live-search-style="begins"
                                                title="Select Action Type...">
                                                @foreach ($usertypes as $usertype)
                                                <option value="{{ $usertype->id }}">{{ $usertype->display_name }}
                                                </option>
                                                @endforeach
                                            </select>
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
                                    <th id="table_id">Full Name</th>
                                    <th id="table_id">UserName</th>
                                    <th id="table_id">Email</th>
                                    <th id="table_id">Phone Number</th>
                                    <th id="table_id">Role</th>
                                    <th id="table_id" data-priority="2">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $key => $row)
                                <tr>
                                    <td id="table_id">{{ ++$key }}</td>
                                    <td id="table_id">{{ $row->full_name }}</td>
                                    <td id="table_id">{{ $row->email }}</td>
                                    <td id="table_id">{{ $row->phone_number }}</td>

                                    <td id="table_id">
                                        <ul>
                                            @foreach ($row->roles as $role)
                                            <span class="badge bg-primary"
                                                style="color: white">{{ $role->display_name }}</span>
                                            @endforeach

                                        </ul>

                                    </td>
                                    <td id="table_id">

                                        <a href="#edit{{ $row->id }}" title="Edit" data-toggle="modal"
                                            data-id="{{ $row->id }}" data-target="#edit{{ $row->id }}"><i
                                                class="ik ik-edit-2"></i></a>
                                        <a href="#delete{{ $row->id }}" title="Delete" data-toggle="modal"
                                            data-id="{{ $row->id }}" data-target="#delete{{ $row->id }}"><i
                                                class="ik ik-trash-2"></i></a>
                                    </td>
                                </tr>

                                <!-- Edit Session Model-->
                                <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="demoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('settings/user/edit', $row->id) }}">
                                                {{ csrf_field() }}
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="demoModalLabel">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Full
                                                                    Name</label>
                                                                <input type="text" name="name"
                                                                    value="{{ $row->full_name }}"
                                                                    class="form-control  is-valid" placeholder="name"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Email
                                                                </label>
                                                                <input type="text" name="email"
                                                                    value="{{ $row->email }}"
                                                                    class="form-control  is-valid" placeholder="name"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">
                                                                    User Name</label>
                                                                <input type="text" name="name"
                                                                    value="{{ $row->username }}"
                                                                    class="form-control  is-valid"
                                                                    placeholder="username" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Phone Number
                                                                </label>
                                                                <input type="text" name="email"
                                                                    value="{{ $row->phone_number }}"
                                                                    class="form-control  is-valid" placeholder="name"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Password
                                                                </label>
                                                                <input type="password" name="password"
                                                                    class="form-control">
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
                                <div class="modal fade" id="delete{{ $row->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="demoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('settings/user/delete', $row->id) }}">
                                                {{ csrf_field() }}
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="demoModalLabel">Delete
                                                        User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete User:
                                                    <strong> {{ $row->full_name }} </strong>?
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
                                {{ $staffs->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection