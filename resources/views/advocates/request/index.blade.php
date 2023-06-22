@extends('adv-static')

@section('title')
    @parent
    | Request Permit
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
                                <h5>Request Permit</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">Request Permit</li>
                                </li>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <p class="lead"><i class="ik ik-edit"></i> Request Permit </p><hr/>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Choose Request type</label>
                                        <select name="request" class="form-control is-valid required" id="myselection">
                                            <option>--Choose one--</option>
                                            <option value="OutOfTime">Application for Renew Out of Time</option>
                                            <option value="Resume">Application for Resume Practicing</option>
                                            <option value="NonPractising">Application for Non Practicing</option>
                                            <option value="Suspend">Application for Suspend Practising</option>
                                            <option value="NonProfit">Application for Non Profit</option>
                                            <option value="Retire">Application for Retire Practicing</option>
                                            <option value="NameChange">Application for Change of Name</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 myDiv" id="showOutOfTime">
                                    <strong>You have selected option to Apply for Renew Out of Time. Submit the folloing required attachments<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="petition" method="POST" action="{{ url('request/out-of-time')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="names[]"  multiple value="Notice of Intention to Renew" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;" type="text" name="names[]" multiple value="Affidavit" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload and Submit Request</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                </div>

                                <div class="col-sm-12 myDiv" id="showResume">
                                     <strong>You have selected option to Apply for Resuming<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="petition" method="POST" action="{{ url('request/resume-practising-request')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="names[]"  multiple value="Letter of resuming" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload and Submit Request</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-sm-12 myDiv" id="showNonPractising">
                                    <strong>You have selected option to Apply for Non Practising<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="petition" method="POST" action="{{ url('request/non-practising-request')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="names[]"  multiple value="Letter of Non practising" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;" type="text" name="names[]" multiple value="Employer letter" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload and Submit Request</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-sm-12 myDiv" id="showSuspend">
                                    <strong>You have selected option to Apply for Suspend<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="petition" method="POST" action="{{ url('request/suspend-request')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="names[]"  multiple value="Letter of suspending" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;" type="text" name="names[]" multiple value="Supporting document" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload and Submit Request</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                </div>

                                <div class="col-sm-12 myDiv" id="showNonProfit">
                                    <strong>You have selected option to Apply for Non Profit<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="petition" method="POST" action="{{ url('request/non-profit-request')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="names[]"  multiple value="Letter of Non Profit" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                           

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload and Submit Request</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-sm-12 myDiv" id="showRetire">
                                    <strong>You have selected option to Apply for Retire<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="petition" method="POST" action="{{ url('request/retire-practising-request')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="names[]"  multiple value="Letter of Retire" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;" type="text" name="names[]" multiple value="Supporting document" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload and Submit Request</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-sm-6 myDiv" id="showNameChange">
                                    <strong>You have selected option to Apply for Name Change<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="petition" method="POST" action="{{ url('request/change-name-request')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="new_name"  multiple value="New Name" readonly></h4>
                                                                    <div class="form-group row">
                                                                      
                                                                        <div class="col-sm-12">
                                                                    <input type="text" name="new_name"
                                                                        class="form-control is-valid"
                                                                        id="exampleInputUsername1"
                                                                        placeholder="New Name">
                                                                </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;size: auto;" type="text" name="names[]"  multiple value="Letter Requesting Change Name" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;" type="text" name="names[]" multiple value="Deed poll" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <h4><input style="border: 0px;" type="text" name="names[]" multiple value="National ID" readonly></h4>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="file" name="files[]" multiple accept=".pdf"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload and Submit Request</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
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

@endsection

