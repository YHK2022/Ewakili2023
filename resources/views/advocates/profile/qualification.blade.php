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
                    <h3>Education Qualifications - <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" id="qualificationForm" method="POST" action="{{ url('petition/update-qualification', $qualification->id)}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Attended Ordinary Level Secondary Education in</label>
                                        <select name="olevel" class="form-control is-valid required" id="exampleSelectLevel" required>
                                            <option value="{{$qualification->o_level}}">{{$qualification->o_level}}</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Abroad">Abroad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Attended Advanced Level Secondary Education in</label>
                                        <select name="alevel" class="form-control is-valid" id="exampleSelectLevel" required>
                                            <option value="{{$qualification->a_level}}">{{$qualification->a_level}}</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Abroad">Abroad</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Attended LLB in</label>
                                        <select name="llb" class="form-control is-valid" id="exampleSelectLlb" required>
                                            <option value="{{$qualification->llb}}">{{$qualification->llb}}</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Abroad">Abroad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Attended Legal Practice From Law School of Tanzania ?</label>
                                        <select name="lst" class="form-control is-valid" id="exampleSelectLst" required>
                                            <option value="{{$qualification->lst}}">{{$qualification->lst}}</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Names Validation</label>
                                        <select name="validation" class="form-control is-valid" id="exampleSelectValidation" required>
                                            <option value="{{$qualification->names_validation}}">{{$qualification->names_validation}}</option>
                                            <option value="As Appeared in Academic Certificates">As Appeared in Academic Certificates</option>
                                            <option value="Changed">Changed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger mr-2">Update Changes</button>
                            <button class="btn btn-default">Cancel</button>
                            <a href="{{ url('petition/attachments') }}" class="btn btn-primary">Next</a>
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
                        <form class="forms-sample" id="qualificationForm" method="POST" action="{{ url('petition/post-qualification')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Attended Ordinary Level Secondary Education in</label>
                                        <select name="olevel" class="form-control is-valid required" id="exampleSelectLevel" required>
                                            <option value="">--Choose one--</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Abroad">Abroad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Attended Advanced Level Secondary Education in</label>
                                        <select name="alevel" class="form-control is-valid" id="exampleSelectLevel" required>
                                            <option value="">--Choose one--</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Abroad">Abroad</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Attended LLB in</label>
                                        <select name="llb" class="form-control is-valid" id="exampleSelectLlb" required>
                                            <option value="">--Choose one--</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Abroad">Abroad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Attended Legal Practice From Law School of Tanzania ?</label>
                                        <select name="lst" class="form-control is-valid" id="exampleSelectLst" required>
                                            <option value="">--Choose one--</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">Names Validation</label>
                                        <select name="validation" class="form-control is-valid" id="exampleSelectValidation" required>
                                            <option value="">--Choose one--</option>
                                            <option value="As Appeared in Academic Certificates">As Appeared in Academic Certificates</option>
                                            <option value="Changed">Changed</option>
                                        </select>
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


