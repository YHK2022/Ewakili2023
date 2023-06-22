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
                            <h5>Law Firm / Work Place</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Law Firm / Work Place</li>
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
            @if($firm)
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Law Firm / Work Place - <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" style="font: size 20px;">
                            <tr>
                                <th style="width:20%;text-align:right;">Name:</th>
                                <td>{{$firm->firm->name}}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;text-align:right;">Category:</th>
                                <td>{{$firm->firm->type}}</td>
                            </tr>
                            @if($firm->firm->type == "Law Firm" || $firm->firm->type == "Business Company")
                            <tr>
                                <th style="width:20%;text-align:right;">TIN:</th>
                                <td>{{$firm->firm->tin}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th style="width:20%;text-align:right;">Mobile:</th>
                                <td>{{$firm_owner->phone_number}}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;text-align:right;">Email:</th>
                                <td>{{$firm_owner->email}}</td>
                            </tr>
                            
                        </table>
                        <p id="show" style="cursor: pointer;">Show Address </p><hr/>
                        @foreach($firm_address as $address)
                        <div id="example" style="display: none;">
                            <table class="table table-borderless" style="font: size 20px;">
                                <tr>
                                    <th style="width:20%;text-align:right;">Position:</th>
                                    <td>{{$address->position}}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%;text-align:right;">Address:</th>
                                    <td>{{$address->address}}</td>
                                </tr>
                                
                                <tr>
                                    <th style="width:20%;text-align:right;">Region:</th>
                                    <td>{{$address->region}}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%;text-align:right;">District:</th>
                                    <td>{{$address->district}}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%;text-align:right;">Ward:</th>
                                    <td>{{$address->ward}}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%;text-align:right;">Street:</th>
                                    <td>{{$address->street}}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%;text-align:right;">Postcode:</th>
                                    <td>{{$address->postcode}}</td>
                                </tr>
                                
                            </table>
                        </div>
                        @endforeach
                        <a href="{{ url('petition/finish') }}" class="btn btn-primary">Next</a>

                    </div>
                        
                    </div>
                    
                  </div>
                </div>
                </div>
                </div>
            </div>
            @elseif($request_confirmation)
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Register Law Firm / Work Place</h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">

                        <form class="forms-sample" method="POST" action="{{ url('petition/post-firm-confirmation')}}">
                         {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Confirmation code</label>
                                    <input type="text" name="code" class="form-control is-valid" value="{{ old('code') }}" id="exampleInputUsername1" placeholder="Confirmation code">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Submit</button>
                            <button class="btn btn-default">Cancel</button>
                            <a href="{{ url('petition/finish') }}" class="btn btn-primary">Next</a>
                        </form>
                </div>
                </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Register Law Firm / Work Place</h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">

                     <div class="row">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <span style="color: white; background-color: red;"> <p style="margin:7px;"><i class="ik ik-search"></i> Search firm / workplace</p></span>
                                <input type="text" autocomplete="off" name="search" id="searchtxt" class=" searchtxt form-control input-lg is-valid" placeholder="Enter firm / workplace name">
                            </div>
                        </div>
                    </div>

                    <div id="Hintdate"></div> 
                        
                   
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


