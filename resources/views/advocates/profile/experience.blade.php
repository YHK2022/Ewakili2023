@extends('adv-static')

@section('title')
    @parent
    | Application for Petition
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
                            <h5>Work Experience</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Work Experience</li>
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
            @if($experience)
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Work Experience - <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('petition/update-experience', $experience->id)}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Organisation</label>
                                    <input type="text" name="name" class="form-control is-valid" value="{{ $experience->organisation }}" id="exampleInputUsername1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Job Title</label>
                                    <input type="text" name="title" class="form-control is-valid" value="{{ $experience->title }}" id="exampleInputUsername1" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Start Year</label>
                                    <input type="text" name="start_year" class="form-control is-valid" value="{{ $experience->start_year }}" id="exampleInputUsername1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">End Year</label>
                                    <input type="text" name="end_year" class="form-control is-valid" value="{{ $experience->end_year }}" id="exampleInputUsername1">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Update Changes</button>
                            <button class="btn btn-default">Cancel</button>
                            <a href="{{ url('petition/firm') }}" class="btn btn-primary">Next</a>
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
                    <h3>Work Experience</h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('petition/post-experience')}}">
                        {{ csrf_field() }}
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Organisation</label>
                                    <input type="text" name="name" class="form-control is-valid" value="{{ old('organisation') }}" id="exampleInputUsername1" placeholder="Organization">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Job Title</label>
                                    <input type="text" name="title" class="form-control is-valid" value="{{ old('organisation') }}" id="exampleInputUsername1" placeholder="Job title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Start Year</label>
                                    <input type="text" name="start_year" class="form-control is-valid" value="{{ old('start_year') }}" id="exampleInputUsername1" placeholder="Start year">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">End Year</label>
                                    <input type="text" name="end_year" class="form-control is-valid" value="{{ old('end_year') }}" id="exampleInputUsername1" placeholder="End year">
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


