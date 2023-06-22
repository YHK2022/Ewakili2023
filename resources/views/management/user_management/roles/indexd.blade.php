@extends('mgt-static')

@section('title')
    @parent
    | User Roles
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
                                <h5>User Roles</h5>
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
                                <li class="breadcrumb-item active" aria-current="page">User Roles</li>
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
                <a title="Add Role" href="{{ url('user-management/role/add') }}" class="btn btn-info btn-xm pull-right">
                    <i class="fa fa-plus"></i>
                    Add Role
                </a>
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
                                                <td>{{ ucwords(str_replace('-', ' ', $role->display_name)) }}</td>
                                                <td>{{ ucwords(str_replace('-', ' ', $role->description)) }}</td>
                                                <td>
                                                    {{-- @foreach ($role->permissions as $permission)
                                                        <span class="btn btn-info btn-xs"
                                                            style="margin-bottom: 2px">{{ ucwords($permission->display_name) }}</span>
                                                    @endforeach --}}
                                                    <a href="{{ url('user-management/role/permission', $role->id) }}"
                                                        class="btn btn-link"><i class="dripicons-lock-open"></i>
                                                        Change Permission</a>
                                                </td>
                                                <td>
                                                    <div class="table-actions">
                                                        <a href="{{ url('user-management/role/permission', $role->id) }}"
                                                            class="btn btn-link"><i class="dripicons-lock-open"></i>
                                                            Change Permission</a>

                                                        <a title="Edit"
                                                            href="{{ url('user-management/role/edit', $role->id) }}"><i
                                                                class="ik ik-edit-2"></i>
                                                        </a>
                                                        <a title="Delete"
                                                            href="{{ url('user-management/role/delete', $role->id) }}"><i
                                                                class="ik ik-trash-2"></i>
                                                        </a>
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
