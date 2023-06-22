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
                            <h5>Application for Petition for Admission</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Petition for admission</li>
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
                    <h3>1: Personal & Contact Info <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse @if($petition_form_one = 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('petition/post-profile')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Full Name</label>
                                    <input type="text" name="name" class="form-control is-valid" value="{{ Auth::user()->username }}" id="exampleInputUsername1" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select name="gender" class="form-control is-valid" id="exampleSelectGender">
                                            <option>--Choose one--</option>    
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control datetimepicker-input is-valid" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Nationality</label>
                                    <select name="nationality" class="selectpicker countrypicker form-control is-valid" data-default="TZ" data-live-search="true" data-flag="true"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">ID Type</label>
                                    <select name="id_type" class="form-control is-valid" id="exampleSelectGender">
                                        <option>--Choose one--</option>    
                                        <option>National Identity Card</option>
                                        <option>Voters Identity Card</option>
                                        <option>Passport</option>
                                        <option>Driving Licence</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">ID Number</label>
                                    <input type="text" name="id_number" class="form-control is-valid" id="exampleInputUsername1" placeholder="ID Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control is-valid" value="{{ Auth::user()->email }}" id="exampleInputEmail1" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Mobile</label>
                                    <input type="text" name="mobile" class="form-control is-valid" value="{{ Auth::user()->mobile }}" id="exampleInputUsername1" placeholder="Mobile Number">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Submit</button>
                            <button class="btn btn-default">Cancel</button>
                        </form>
                    </div>
                    
                  </div>
                </div>
                </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <h3>2: Education Qualifications & Attachments <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">

                        <div class="row">
                                <div class="col-sm-6">
                                <form class="picture" method="POST" action="{{ url('petition/post-picture')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <h4 class="sub-title">Passport Size <small><i style="color:red;">Recent & Colored</i></small></h4>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <input type="file" name="profile_picture" class="form-control is-valid" placeholder="col-sm-11" onChange="readURL(this);">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <img src="{{ URL::to('images/user.png') }}" id="img" width="170px" alt="You are uploading something else, Only image is required here!" />
                                    </div>
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Petition for Admission and Enrollment</h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <h4 class="sub-title">Attended Ordinary Level Secondary Education in</h4>
                                        <div class="form-radio">
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="olevel" value="o-level-tz">
                                                        <i class="helper"></i>Tanzania
                                                    </label>
                                                </div>
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="olevel" value="o-level-abroad">
                                                        <i class="helper"></i>Abroad
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="row" id="o-level-tz" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Certificate of Secondary Education (CSEE) <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                       </div>

                                        <div class="row" id="o-level-ab" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Certificate of Ordinary Secondary Education <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                    <h4 class="sub-title">NECTA Certificate of Recognition <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="file" class="form-control is-valid"/>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select class="form-control is-valid" id="exampleSelectGender">
                                            <option>--Choose one--</option>    
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <h4 class="sub-title">Attended Advanced Level Secondary Education in</h4>
                                        <div class="form-radio">
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="alevel" value="a-level-tz">
                                                        <i class="helper"></i>Tanzania
                                                    </label>
                                                </div>
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="alevel" value="a-level-abroad">
                                                        <i class="helper"></i>Abroad
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="row" id="a-level-tz" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Advanced Certificate of Secondary Education (ACSEE) <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                </div>

                                <div class="row" id="a-level-ab" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Advanced Certificate of Secondary Education <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                    <h4 class="sub-title">NECTA/NACTE Certificate of Recognition <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="file" class="form-control is-valid"/>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                        </div>

                                      
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleSelectGender">Gender</label>
                                            <select class="form-control is-valid" id="exampleSelectGender">
                                                <option>--Choose one--</option>    
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <h4 class="sub-title">Attended LLB in</h4>
                                        <div class="form-radio">
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="llb" value="llb-tz">
                                                        <i class="helper"></i>Tanzania
                                                    </label>
                                                </div>
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="llb" value="llb-abroad">
                                                        <i class="helper"></i>Abroad
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="row" id="llb-tz" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">LLB Certificate <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">LLB Transcript <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                       </div>

                                        <div class="row" id="llb-ab" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">LLB Certificate <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                    <h4 class="sub-title">LLB Transcript <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="file" class="form-control is-valid"/>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                    <h4 class="sub-title">TCU Certificate of Recognition <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="file" class="form-control is-valid"/>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select class="form-control is-valid" id="exampleSelectGender">
                                            <option>--Choose one--</option>    
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <h4 class="sub-title">Attended Legal Practice From Law School of Tanzania ?</h4>
                                        <div class="form-radio">
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="lst" value="lst-yes">
                                                        <i class="helper"></i>Yes
                                                    </label>
                                                </div>
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="lst" value="lst-no">
                                                        <i class="helper"></i>No
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="row" id="lst-yes" style="display: none;">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Collage/University</label>
                                                <input type="text" class="form-control is-valid" id="exampleInputUsername1" value="Law School of Tanzania" readonly/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">LST registration number <small><i> (as appears on your transcript)</i></small></label>
                                                <input type="text" class="form-control is-valid" id="exampleInputUsername1" placeholder="eg LST/2017/25/035">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Year of Completion</label>
                                                <input type="text" class="form-control is-valid" id="exampleInputUsername1" placeholder="eg 2020 ">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Post Graduate Diploma in Legal Practice from LST <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Final result Post Graduate Diploma in Legal Practice from LST <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                       </div>

                                        <div class="row" id="lst-no" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Letter for pupilage <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                    <h4 class="sub-title">Internship / Externship <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="file" class="form-control is-valid"/>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                    <h4 class="sub-title">Employer Letter <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="file" class="form-control is-valid"/>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select class="form-control is-valid" id="exampleSelectGender">
                                            <option>--Choose one--</option>    
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <h4 class="sub-title">Names Validation</h4>
                                        <div class="form-radio">
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="deedpoll" value="not-changed">
                                                        <i class="helper"></i>As Appeared in Academic Certificates
                                                    </label>
                                                </div>
                                                <div class="radio radio-inverse radio-inline">
                                                    <label>
                                                        <input type="radio" name="deedpoll" value="changed">
                                                        <i class="helper"></i>Changed
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="row" id="deedpool-yes" style="display: none;">
                                            <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Deed Poll <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control is-valid"/>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger"><i class="ik ik-share"></i>Upload</button>
                                            </div>
                                       </div>
                                        
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select class="form-control is-valid" id="exampleSelectGender">
                                            <option>--Choose one--</option>    
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <h3>3: Bachelor of Laws (LLB) <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                   <div class="col-md-12">
                     <div class="card">
                      <div class="card-body">
                        <form class="forms-sample">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">University / College</label>
                                    <input type="text" class="form-control is-valid"  id="exampleInputUsername1" placeholder="University / College">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Year of Completion</label>
                                        <input type="text" class="form-control is-valid"  id="exampleInputUsername1" placeholder="Year of Completion">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Submit</button>
                            <button class="btn btn-default">Cancel</button>
                        </form>
                      </div>
                     </div> 
                   </div>
                </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingFourt">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                    <h3>4: Work Experience <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                     <div class="card">
                      <div class="card-body">
                        <form class="forms-sample">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Organisation</label>
                                    <input type="text" class="form-control is-valid"  id="exampleInputUsername1" placeholder="Organisation">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Job Title</label>
                                        <input type="text" class="form-control is-valid"  id="exampleInputUsername1" placeholder="Job Title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Start Year</label>
                                    <input type="text" class="form-control is-valid"  id="exampleInputUsername1" placeholder="Start Year">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">End Year</label>
                                        <input type="text" class="form-control is-valid"  id="exampleInputUsername1" placeholder="End Year">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Submit</button>
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

    </div>
</div>

@endsection


