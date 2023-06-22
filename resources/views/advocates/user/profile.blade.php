@extends('mgt-static')

@section('title')
    @parent
    | User Profile
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
                                <span>User Profile</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
            <section class="forms">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h4>User Profile</h4>
                                </div>
                                <div class="card-body">

                                    <form class="forms-sample" method="POST"
                                        action="{{ url('user/update_profile', Auth::id()) }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Full Name *</strong> </label>
                                                    <input type="text" name="full_name"
                                                        value="{{ $lims_user_data->full_name }}" required
                                                        class="form-control" />
                                                    @if ($errors->has('name'))
                                                        <span>
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Email'*</strong> </label>
                                                    <input type="email" name="email"
                                                        value="{{ $lims_user_data->email }}" required class="form-control">
                                                    @if ($errors->has('email'))
                                                        <span>
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number *</strong> </label>
                                                    <input type="text" name="phone"
                                                        value="{{ $lims_user_data->phone_number }}" required
                                                        class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</strong> </label>
                                                    <input type="text" name="username"
                                                        value="{{ $lims_user_data->username }}" class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <?php $role = DB::table('roles')->find($lims_user_data->role_id); ?>
                                                    {{-- {{ $role->name }} --}}
                                                    @if ($lims_user_data->active != 'true')
                                                        <span class="badge bg-danger" style="color: white">Session
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success" style="color: white">Active
                                                        </span>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <input type="submit" value="Submit" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h4>Change Password</h4>
                                </div>
                                <div class="card-body">
                                    {{-- {!! Form::open(['method' => 'put']) !!} --}}
                                    <form class="forms-sample" method="POST"
                                        action="{{ url('user/changepass', Auth::id()) }}">
                                        {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Current Password *</strong> </label>
                                                <input type="password" name="current_pass" required class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label>New Password*</strong> </label>
                                                <input type="password" name="new_pass" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password*</strong> </label>
                                                <input type="password" name="confirm_pass" id="confirm_pass" required
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Update Password" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>

@endsection
