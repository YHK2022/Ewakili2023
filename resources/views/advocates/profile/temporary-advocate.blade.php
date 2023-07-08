@extends('temp-adv-static')

@section('title')
    @parent
    | Profile
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-user bg-red"></i>
                            <div class="d-inline">
                                <h5>Profile</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="profile-pic mb-20">
                                @if (!empty($profile->picture))
                                    <img src="{{ asset('public/images/files/' . $profile->picture) }}" width="150"
                                        class="rounded-circle" alt="user">
                                @else
                                    <img src="{{ URL::to('images/user.png') }}" width="150" class="rounded-circle"
                                        alt="user">
                                @endif
                                <h5 class="mt-20 mb-0">{{ Auth::user()->full_name }}</h5>
                                {{-- <a style="font-size:17px;color:blue;" href="#"><strong>Petitioner</strong></a> --}}
                            </div>
                              @php           
                  
                                      if(\App\Profile::where('user_id', Auth()->user()->id)->exists()){
                                     $user_id = Auth::user()->id;
                                     $profile_id = \App\Profile::where('user_id', $user_id)->first()->id;

                         }
                             @endphp
                            {{-- <div class="badge badge-pill badge-dark">Admission No.</div> --}}
                            {{-- <div class="badge badge-pill badge-dark">Petition No.{{$petition_number}}</div> --}}
                        </div>

                        <hr class="mb-0">
                        @if ($progress)
                            <div class="card-body">
                                <h6 class="mt-30">Application Progress <span
                                        class="pull-right">{{ $progress->appl_progress }}%</span></h6>
                                <div class="progress  progress-sm">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"
                                        style="width:{{ $progress->appl_progress }}%;"> <span
                                            class="sr-only">{{ $progress->appl_progress }}% Complete</span> </div>
                                </div>

                            </div>
                        @else
                            <div class="card-body">
                                <h6 class="mt-30">Application Progress <span class="pull-right">0%</span></h6>
                                <div class="progress  progress-sm">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" style="width:0%;"> <span class="sr-only">50%
                                            Complete</span> </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="card">
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link active" id="pills-timeline-tab"
                                    data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline"
                                    aria-selected="true">Personal Info</a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                    href="#last-month" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-setting-tab" data-toggle="pill"
                                    href="#previous-month" role="tab" aria-controls="pills-setting"
                                    aria-selected="false">Short CV</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="current-month" role="tabpanel"
                                aria-labelledby="pills-timeline-tab">
                                <div class="card-body">
                                    @if ($profile)
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-user"></i> Personal Profile Information</p>
                                            <div class="table-responsive">
                                                <table class="table table-borderless" style="font: size 20px;">
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Gender:</th>
                                                        <td>{{ $profile->gender }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Date of Birth:</th>
                                                        <td> {{ date('F d, Y', strtotime( $profile->dob)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Nationality:</th>
                                                        <td>{{ $profile->nationality }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">ID Type:</th>
                                                        <td>{{ $profile->id_type }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">ID Number:</th>
                                                        <td>{{ $profile->id_number }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-alert-triangle" style="color:red;"></i> No
                                                Profile Information to show! <a style="color:blue;"
                                                    href="{{ url('petition/personal-details') }}"> Click here to update
                                                    your personal profile</a></p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="last-month" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-body">

                                    <div class="col-12">
                                        <p class="lead"><i class="ik ik-phone"></i> Contact Information</p>
                                        <div class="table-responsive">
                                            <table class="table table-borderless" style="font: size 20px;">
                                                <tr>
                                                    <th style="width:20%;text-align:right;">Email:</th>
                                                    <td>{{ Auth::user()->email }} <i>[ Used as login email ]</i></td>
                                                </tr>
                                                 <tr>
                                                    <th style="width:20%;text-align:right;">Address:</th>
                                                    <td>{{ Auth::user()->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:20%;text-align:right;">Phone:</th>
                                                    <td>{{ Auth::user()->phone_number }}</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="previous-month" role="tabpanel"
                                aria-labelledby="pills-setting-tab">
                                <div class="card-body">
                                    @if ($llb)
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-award"></i> Bachelor of Law (LLB) </p>
                                            <hr />
                                            <div class="table-responsive">
                                                <table class="table table-borderless" style="font: size 20px;">
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">University / College:</th>
                                                        <td>{{ $llb->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Completed Year:</th>
                                                        <td>{{ $llb->completed_year }}</td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-award"></i> Bachelor of Law (LLB) </p>
                                            <hr />
                                            <p><i class="ik ik-alert-triangle" style="color:red;"></i> No information to
                                                display !, to complete your application submit University / College went for
                                                LLB</p>
                                        </div>
                                    @endif

                                    @if ($lst)
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-bookmark"></i> Post Graduate in Legal
                                                Practice </p>
                                            <hr />
                                            <div class="table-responsive">
                                                <table class="table table-borderless" style="font: size 20px;">
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">University / College:</th>
                                                        <td>{{ $lst->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Registration Number:</th>
                                                        <td>{{ $lst->reg_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Completed Year:</th>
                                                        <td>{{ $lst->completed_year }}</td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($experience)
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-briefcase"></i> Work Experience </p>
                                            <hr />
                                            <div class="table-responsive">
                                                <table class="table table-borderless" style="font: size 20px;">
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Organisation:</th>
                                                        <td>{{ $experience->organisation }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Job Title:</th>
                                                        <td>{{ $experience->title }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Start Year:</th>
                                                        <td>{{ $experience->start_year }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">End Year:</th>
                                                        <td>{{ $experience->end_year }}</td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-briefcase"></i> Work Experience </p>
                                            <hr />
                                            <p><i class="ik ik-alert-triangle" style="color:red;"></i> No information to
                                                display !, to complete your application submit your work experience
                                                information</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
