@extends('mgt-static')

@section('title')
    @parent
    | Roll of Petition
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
                                <h5>Roll of Petition</h5>
                                <span>Petition Profile</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Roll of Petition</li>
                                <li class="breadcrumb-item">
                                    <button title="Go Bck" style="border: none" onclick="goBack()"><i
                                            class="ik ik-chevrons-left"></i></button>
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

            <div class="row">

                <div class="col-lg-4 col-md-5">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="profile-pic mb-20">

                                @if (!empty($advocate->profile_detail->picture))
                                    <img src="{{ asset('public/images/files/' . $advocate->profile_detail->picture) }}" width="150"
                                        class="rounded-circle" alt="user">
                                @else
                                    <img src="{{ URL::to('images/user.png') }}" width="150" class="rounded-circle"
                                        alt="user">
                                @endif

                                {{-- <h5 class="mt-20 mb-0">
                                    @if ($advocate->paid_year != $cur_year)
                                        <span class="badge bg-danger" style="color: white">Not Active Since
                                            {{ $advocate->paid_year }}</span>
                                    @else
                                        <span class="badge bg-success" style="color: white">Active -
                                            {{ $advocate->paid_year }}</span>
                                    @endif
                                </h5> --}}

                                <h5 class="mt-20 mb-0">{{ $advocate->profile_detail->fullname }}</h5>
                                <h5 class="mt-20 mb-0" style="font-size:17px;color:blue;">
                                    <strong>{{ $advocate->status }}</strong>
                                </h5>
                            </div>
                            {{-- <div class="badge badge-pill badge-dark">Admission<br />{{ $advocate->admission }}</div> --}}
                            <div class="badge badge-pill badge-dark">Petition Number.<br />{{ $advocate->id }}</div>
                        </div>

                        <hr class="mb-0">
                        @if ($firms)
                            {{-- <div class="card-body">
                                @foreach ($firms as $firm)
                                    <h6 class="mt-30">Firm/Work Place<br /> {{ $firm->name }}</h6>
                                @endforeach
                                <h6 class="mt-30">Member Since: {{ $since }}</h6>
                            </div> --}}
                        @endif
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    <div class="card">
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link active" id="pills-timeline-tab"
                                    data-toggle="pill" href="#info" role="tab" aria-controls="pills-timeline"
                                    aria-selected="true">Personal Info</a>
                            </li>

                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                    href="#contact" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">Contact</a>
                            </li>

                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-setting-tab" data-toggle="pill"
                                    href="#cv" role="tab" aria-controls="pills-setting" aria-selected="false">Short
                                    CV</a>
                            </li>

                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-setting-tab" data-toggle="pill"
                                    href="#firm" role="tab" aria-controls="pills-setting"
                                    aria-selected="false">Firm</a>
                            </li>

                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-setting-tab" data-toggle="pill"
                                    href="#applications" role="tab" aria-controls="pills-setting"
                                    aria-selected="false">Applications</a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-setting-tab" data-toggle="pill"
                                    href="#education" role="tab" aria-controls="pills-setting"
                                    aria-selected="false">Education</a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size:17px;" class="nav-link" id="pills-setting-tab" data-toggle="pill"
                                    href="#experience" role="tab" aria-controls="pills-setting"
                                    aria-selected="false">Experience</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel"
                                aria-labelledby="pills-timeline-tab">
                                <div class="card-body">
                                    @if ($personal_infos != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-user"></i> Personal Profile Information</p>
                                            <div class="table-responsive">
                                                @foreach ($personal_infos as $personal_info)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Gender:</th>
                                                            <td>{{ $personal_info->gender }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Date of Birth:</th>
                                                            <td>{{ $personal_info->dob }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Nationality:</th>
                                                            <td>{{ $personal_info->nationality }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">ID Type:</th>
                                                            <td>{{ $personal_info->id_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">ID Number:</th>
                                                            <td>{{ $personal_info->id_number }}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-alert-triangle" style="color:red;"></i> No
                                                Profile Information to show! </p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    @if ($contacts != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-phone"></i> Contact Information</p>
                                            <div class="table-responsive">
                                                @foreach ($contacts as $contact)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Contact Type:</th>
                                                            <td>{{ $contact->type }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Contact:</th>
                                                            <td>{{ $contact->contact_value }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Usage:</th>
                                                            <td>{{ $contact->usage }}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade" id="cv" role="tabpanel"
                                aria-labelledby="pills-setting-tab">
                                <div class="card-body">
                                    @if ($educations != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-award"></i> Petitioner Education </p>
                                            <hr />
                                            <div class="table-responsive">
                                                @foreach ($educations as $education)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">University / College:
                                                            </th>
                                                            <td>{{ $education->school }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Education Title:</th>
                                                            <td>{{ $education->level }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Started Year:</th>
                                                            <td>{{ $education->begin_year }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Completed Year:</th>
                                                            <td>{{ $education->complete_year }}</td>
                                                        </tr>

                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-award"></i> Education </p>
                                            <hr />
                                            <p><i class="ik ik-alert-triangle" style="color:red;"></i> No information to
                                                display !</p>
                                        </div>
                                    @endif

                                    @if ($experiences != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-briefcase"></i> Work Experience </p>
                                            <hr />
                                            <div class="table-responsive">
                                                @foreach ($experiences as $experience)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Organisation:</th>
                                                            <td>{{ $experience->place }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Job Title:</th>
                                                            <td>{{ $experience->title }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Start Year:</th>
                                                            <td>{{ $experience->begin_year }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">End Year:</th>
                                                            <td>{{ $experience->end_year }}</td>
                                                        </tr>

                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-briefcase"></i> Work Experience </p>
                                            <hr />
                                            <p><i class="ik ik-alert-triangle" style="color:red;"></i> No information to
                                                display !</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade" id="firm" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    @if ($firms != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-home"></i> Firm/Work Place</p>
                                            <div class="table-responsive">
                                                @foreach ($firms as $firm)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Name:</th>
                                                            <td>{{ $firm->name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Taxpayer:</th>
                                                            <td>{{ $firm->tax_payer_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">TIN:</th>
                                                            <td>{{ $firm->tin_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Category:</th>
                                                            <td>{{ $firm->firm_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Model:</th>
                                                            <td>{{ $firm->firm_model }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Status:</th>
                                                            <td>{{ $firm->approval_status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Members:</th>
                                                            <td>{{ $firm->members }}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($firm_addresses != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-home"></i> Firm/Work Place Branch/Address
                                            </p>
                                            <div class="table-responsive">
                                                @foreach ($firm_addresses as $firm)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Branch:</th>
                                                            <td>{{ $firm->name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Code:</th>
                                                            <td>{{ $firm->code }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Phone:</th>
                                                            <td>{{ $firm->phone_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Email:</th>
                                                            <td>{{ $firm->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Box:</th>
                                                            <td>{{ $firm->box }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Postcode:</th>
                                                            <td>{{ $firm->postcode }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Region:</th>
                                                            <td>{{ $firm->region_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">City:</th>
                                                            <td>{{ $firm->city }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">District:</th>
                                                            <td>{{ $firm->district_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Ward:</th>
                                                            <td>{{ $firm->ward }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Street:</th>
                                                            <td>{{ $firm->street }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Status:</th>
                                                            <td>{{ $firm->approval_status }}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="tab-pane fade" id="applications" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    @if ($applications != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-clipboard"></i> Applications</p>
                                            <div class="table-responsive">
                                                @foreach ($applications as $key => $application)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Application Type:</th>
                                                            <td>{{ $application->type }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Date Submitted:</th>
                                                            <td>{{ $application->submission_at }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Status:</th>
                                                            <td>{{ $application->status }}</td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="education" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    @if ($educations != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-clipboard"></i> Education</p>
                                            <div class="table-responsive">
                                                @foreach ($educations as $key => $education)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Education Level:</th>
                                                            <td>{{ $education->level }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">School:</th>
                                                            <td>{{ $education->school }}</td>
                                                        </tr>

                                                    </table>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="experience" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    @if ($educations != 'No data')
                                        <div class="col-12">
                                            <p class="lead"><i class="ik ik-clipboard"></i> Work Experience</p>
                                            <div class="table-responsive">
                                                @foreach ($experiences as $key => $experience)
                                                    <table class="table table-borderless" style="font: size 20px;">
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Title:</th>
                                                            <td>{{ $experience->title }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Place:</th>
                                                            <td>{{ $experience->place }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">Begin Year:</th>
                                                            <td>{{ $experience->begin_year }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:20%;text-align:right;">End Year:</th>
                                                            <td>{{ $experience->end_year }}</td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
              <div class="row">
                <div class="col-12">
                  @foreach ($approvals as $approval)
                                           <?php
                                               $user = DB::table('users')->find($approval->user_id);
                                                $current_stage = DB::table('action_user_types')->find($approval->action_user_type_id);

                                            ?>
                                      
                                            <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless" style="font: size 20px;">
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">DECISION:</th>
                                                        <td>{{ $approval->decision }}</td>
                                                    </tr>
                                                      {{-- <tr>
                                                        <th style="width:20%;text-align:right;">DECISION STAGE:</th>
                                                        <td>{{ $current_stage->display_name }}</td>
                                                    </tr> --}}
                                                      {{-- <tr>
                                                        <th style="width:20%;text-align:right;">ATTENDANT NAME:</th>
                                                        <td>{{ $user->full_name }}</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">comment:</th>
                                                        <td>{{ $approval->comment }}</td>
                                                    </tr>
                                                      <tr>
                                                        <th style="width:20%;text-align:right;">Created Date:</th>
                                                        <td>{{ $approval->created_at }}</td>
                                                    </tr>
                                                  
                                                </table>
                                            </div>
                                        </div>
                                      @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7" role="document">
                    <div class="modal-content">
                        <form class="forms-sample" method="POST"
                            action="{{ url('petition/under-review/edit', $application->id) }}">
                            {{ csrf_field() }}

                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Select Your Decision</label>
                                            <select class="form-control selectpicker" name="status"
                                                value="{{ $application->status }}" required data-live-search="true"
                                                data-live-search-style="begins" title="Select Employee...">
                                                <option value="ACCEPT">ACCEPT</option>
                                                <option value="REJECT">REJECT</option>
                                                <option value="RE SUBMIT">RE SUBMIT</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Add Comment To Your Decision</label>
                                            <textarea type="text" name="comment" value="" class="form-control  is-valid" placeholder="comment"
                                                required>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Save Decision</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
