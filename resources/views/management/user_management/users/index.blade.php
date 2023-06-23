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
                            <i class="ik ik-users bg-red"></i>
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
                                <li class="breadcrumb-item active" aria-current="page">Roll of Users</li>
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
                                                  <select data-placeholder="Select Roles" class="chosen-select" multiple="" name="role_id" data-live-search-style="begins"  tabindex="-1">
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
                                                <label>Action User Type</label>
                                                <select data-placeholder="Select Action User Type" class="chosen-select" multiple="" name="action_user_type_id"  tabindex="-1">
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
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#all"
                                    role="tab" aria-controls="pills-timeline" aria-selected="true">Non Staffs <span
                                        class="badge bg-warning" style="color: white"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#practising"
                                    role="tab" aria-controls="pills-timeline" aria-selected="true">Staffs <span
                                        class="badge bg-warning" style="color: white"></span></a>
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
                                         {{-- <th id="table_id" data-priority="1">#</th> --}}
                                        <th id="table_id">Full Name</th>
                                        <th id="table_id">Email</th>
                                        {{-- <th id="table_id">Address</th> --}}
                                        <th id="table_id">Phone Number</th>
                                        <th id="table_id">Role</th>
                                        <th id="table_id" data-priority="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    @foreach ($staffs as $key => $row)
                                        <tr>
                                            {{-- <td id="table_id">{{ ++$key }}</td> --}}
                                            <td id="table_id">{{ $row->full_name }}</td>
                                            <td id="table_id">{{ $row->email }}</td>
                                            {{-- <td id="table_id">{{ $row->address }}</td> --}}
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
                                                    data-id="{{ $row->id }}"
                                                    data-target="#edit{{ $row->id }}"><i
                                                        class="ik ik-edit-2"></i></a>
                                                <a href="#delete{{ $row->id }}" title="Delete" data-toggle="modal"
                                                    data-id="{{ $row->id }}"
                                                    data-target="#delete{{ $row->id }}"><i
                                                        class="ik ik-trash-2"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Edit Session Model-->
                                        <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
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
                                                                            class="form-control  is-valid"
                                                                            placeholder="name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Email
                                                                        </label>
                                                                        <input type="text" name="email"
                                                                            value="{{ $row->email }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="name" required>
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
                                                                            class="form-control  is-valid"
                                                                            placeholder="name" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Password
                                                                        </label>
                                                                        <input type="password" name="password"
                                                                            class="form-control">
                                                                    </div>
                                                                 </div>
                                                            </div> --}}
                                                            <div class="row">
                                                              <div class="col-sm-6">
                                                                 <div class="form-group">
                                                                      <label for="exampleInputPassword1">Roles</label>
                                                                        <select data-placeholder="Select Roles" class="chosen-select" multiple="" data-live-search-style="begins" value="{{ $row->role_id }}" tabindex="-1">
                                                                              @foreach ($row->roles as $role)
                                                                             <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                                             @endforeach
                                                                         </select>
                                                                    </div>
                                                              </div>
                                                              <div class="col-sm-6">
                                                              <div class="form-group">
                                                <label for="exampleInputPassword1">Action User Type
                                                </label>
                                            <select data-placeholder="Select Roles" class="chosen-select" multiple="" data-live-search-style="begins"  tabindex="-1">
                                                    @foreach ($usertypes as $usertype)
                                                        {{-- <option value="{{ $usertype->id }}">{{ $usertype->display_name }}
                                                        </option> --}}
                                                        <option value="{{ $usertype->id }}" {{ in_array($usertype->id, $selectedUserTypes) ? 'selected' : '' }}>
                                                            {{ $usertype->display_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                        <div class="modal fade" id="delete{{ $row->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
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
                                                 <tr>
                                         <th id="table_id" data-priority="1">#</th>
                                        <th id="table_id">Full Name</th>
                                        <th id="table_id">Email</th>
                                        {{-- <th id="table_id">Address</th> --}}
                                        <th id="table_id">Phone Number</th>
                                        <th id="table_id">Role</th>
                                        <th id="table_id" data-priority="2">Action</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($nonstaffs as $key => $row)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $row->full_name }}</td>
                                            <td id="table_id">{{ $row->email }}</td>
                                            {{-- <td id="table_id">{{ $row->address }}</td> --}}
                                            <td id="table_id">{{ $row->phone_number }}</td>

                                              <td id="table_id">
                                    <ul style="list-style: none; padding: 0; margin: 0;">
                                        @foreach ($row->roles as $role)
                                          <span class="badge bg-primary" style="background-color: blue; color: white;  margin-bottom: 5px;">
                                           {{ $role->display_name }}
                                          </span>
                                        @endforeach
                                          </ul>

                                           @foreach ($row->actionUser as $role)
                                          <span class="badge bg-danger" style="background-color: blue; color: white;  margin-bottom: 5px;">
                                           {{ $role->display_name }}
                                          </span>
                                        @endforeach
                                          </ul>
                                    </td>

                                            <td id="table_id">

                                                <a href="#edits{{ $row->id }}" title="Edits" data-toggle="modal"
                                                    data-id="{{ $row->id }}"
                                                    data-target="#edits{{ $row->id }}"><i
                                                        class="ik ik-edit-2"></i></a>
                                                <a href="#deletes{{ $row->id }}" title="Deletes" data-toggle="modal"
                                                    data-id="{{ $row->id }}"
                                                    data-target="#deletes{{ $row->id }}"><i
                                                        class="ik ik-trash-2"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Edit Session Model-->
                                        <div class="modal fade" id="edits{{ $row->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
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
                                                                            class="form-control  is-valid"
                                                                            placeholder="name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Email
                                                                        </label>
                                                                        <input type="text" name="email"
                                                                            value="{{ $row->email }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="name" required>
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
                                                                            class="form-control  is-valid"
                                                                            placeholder="name" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Password
                                                                        </label>
                                                                        <input type="password" name="password"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div> --}}

                                                             <div class="row">
                                                                <div class="col-sm-6">
                                                                  <div class="form-group">
                                                                     <label for="exampleInputPassword1">Roles</label>
                                                                <select data-placeholder="Select Roles" class="chosen-select" multiple="" data-live-search-style="begins"  tabindex="-1">
                                                                          @foreach ($roles as $role)
                                                                           <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                                           @endforeach
                                                                       </select>
                                                                    </div>
                                                                </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Action User Type
                                                </label>
                                            <select data-placeholder="Select Roles" class="chosen-select" multiple="" data-live-search-style="begins"  tabindex="-1">
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
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Delete session Model-->
                                        <div class="modal fade" id="deletes{{ $row->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
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
