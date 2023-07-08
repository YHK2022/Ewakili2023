@extends('temp-adv-static')

@section('title')
    @parent
    | Application for Temporary Admission
@stop

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-red"></i>
                        <div class="d-inline">
                            <h5>Education Qualifications</h5>
                            <span>{{ Auth::user()->username }} - {{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Education Qualifications</li>
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
            <div class="accordion" id="accordionExample">
            @if($qualification)
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Application Form  <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" id="qualificationForm" method="POST" action="{{ url('temporary/update-qualification', $qualification->id)}}">
                        {{ csrf_field() }}
                           <div class="row">
                                     <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Case Nature</label>
                                     <input type="text" name="case_nature" value="{{$qualification->case_nature}}" class="form-control is-valid" id="exampleInputUsername1" placeholder="CASE NATURE">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Case Number</label>
                                       <input type="text" name="case_number" value="{{$qualification->case_number}}" class="form-control is-valid" id="exampleInputUsername1" placeholder="Case Number">
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Case Year</label>
                                       <input type="text" name="case_year" value="{{$qualification->year}}" class="form-control is-valid" id="exampleInputUsername1" placeholder="Case Year">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Registration Court</label>
                                    <input type="text" name="registration_court" value="{{$qualification->registration_court}}" class="form-control is-valid" id="exampleInputUsername1" placeholder="Registration Court">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Case Parties</label>
                                        <input type="text" name="case_parties" value="{{$qualification->case_parties}}" class="form-control is-valid" id="exampleInputUsername1" placeholder="Case Parties">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger mr-2">Update Changes</button>
                            <button class="btn btn-default">Cancel</button>
                            <a href="{{ url('temporary/temporary-attachment') }}" class="btn btn-primary">Next</a>
                        </form>
                    </div>

                  </div>
                </div>
                </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Education Qualifications</h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" id="qualificationForm" method="POST" action="{{ url('temporary/post-qualification')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                     <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Case Nature</label>
                                     <input type="text" name="case_nature" class="form-control is-valid" id="exampleInputUsername1" placeholder="Case Nature">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Case Number</label>
                                       <input type="text" name="case_number" class="form-control is-valid" id="exampleInputUsername1" placeholder="Case Number">
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Case Year</label>
                                       <input type="text" name="case_year" class="form-control is-valid" id="exampleInputUsername1" placeholder="Case Year">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Registration Court</label>
                                    <input type="text" name="registration_court" class="form-control is-valid" id="exampleInputUsername1" placeholder="Registration Court">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Case Parties</label>
                                        <input type="text" name="case_parties" class="form-control is-valid" id="exampleInputUsername1" placeholder="Case Parties">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Save</button>
                            <button class="btn btn-default">Cancel</button>
                        </form>
                    </div>

                  </div>
                </div>
                </div>
                </div>
            </div>
            @endif

            </div>
          </div>
        </div>

    </div>
</div>

@endsection


