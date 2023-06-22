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

                <form class="forms-sample" method="POST" action="{{ url('petition/post-firm')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Name</label>
                                    <input type="text" name="name" class="form-control is-valid" value="{{ old('name') }}" id="exampleInputUsername1" placeholder="Firm / workplace name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Type</label>
                                        <select name="type" class="form-control is-valid" id="exampleSelectGender" onchange="showDiv(this)" required>
                                            <option value="">--Choose one--</option>    
                                            <option value="Law Firm">Law Firm</option>
                                            <option value="Business Company">Business Company</option>
                                            <option value="Government Institution">Government Institution</option>
                                            <option value="Non Government Organization">Non Government Organization</option>
                                            <option value="Public Limited Company">Public Limited Company</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="hidden_div" style="display:none;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Tax payer name</label>
                                    <input type="text" name="taxpayer" class="form-control is-valid" value="{{old('taxpayer')}}" placeholder="Tax payer name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">TIN</label>
                                    <input type="text" name="tin" class="form-control is-valid" id="exampleInputUsername1" placeholder="TIN">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Address</label>
                                    <input type="text" name="address" class="form-control is-valid" id="exampleInputUsername1" placeholder="Physical address">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Postcode</label>
                                    <input type="text" name="postcode" class="form-control is-valid" id="exampleInputUsername1" placeholder="Postcode">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Region</label>
                                    <input type="text" name="region" class="form-control is-valid" value="{{ old('region') }}" id="exampleInputEmail1" placeholder="Region">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">District</label>
                                    <input type="text" name="district" class="form-control is-valid" value="{{ old('district') }}" id="exampleInputUsername1" placeholder="District">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Ward</label>
                                    <input type="text" name="ward" class="form-control is-valid" value="{{ old('ward') }}" id="exampleInputEmail1" placeholder="Ward">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Street</label>
                                    <input type="text" name="street" class="form-control is-valid" value="{{ old('village') }}" id="exampleInputUsername1" placeholder="Village">
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
        </div>

    </div>
</div>

@endsection


