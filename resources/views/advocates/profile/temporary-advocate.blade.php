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

            {{-- <div class="row">
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
                                <a style="font-size:17px;color:blue;" href="#"><strong>Petitioner</strong></a>
                            </div>
                              @php           
                  
                                      if(\App\Profile::where('user_id', Auth()->user()->id)->exists()){
                                     $user_id = Auth::user()->id;
                                     $profile_id = \App\Profile::where('user_id', $user_id)->first()->id;
                                    $petition_number = \App\Models\Petitions\Petition::where('profile_id', $profile_id)->first()->petition_no;

                         }
                             @endphp
                        </div>

                        <hr class="mb-0">
                       
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
                                
                                </div>
                            </div>
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

@endsection
