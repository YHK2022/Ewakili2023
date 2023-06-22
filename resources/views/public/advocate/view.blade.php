@extends('public')

@section('title')
    @parent
    Home
@stop

@section('content')
    <div class="page-content bg-white">
        <!-- Main Slider -->
        <div class="section-area section-sp1 ovpr-dark bg-fix online-cours" style="background-image:url(images/banner2.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center text-white">

                        <div class="content-block">
                            <!-- About Us -->
                            <div class="section-area section-sp1">
                                <div class="container">
                                    <div class="row">
                                        @if($advocate->paid_year == $cur_year && $advocate->status == $practising)
                                        <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                            <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, lightskyblue 50%);"><br>
                                                <a class="btn green radius-xl outline">Active</a>
                                                <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                    @if(!empty($profile->picture))
                                                        <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                    @else
                                                        <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                    @endif
                                                </div>
                                                <div class="profile-info">
                                                    <h4>{{ $profile->fullname }}</h4>
                                                    <h4>{{ $advocate->roll_no }}</h4>
                                                    <div class="badge badge-pill badge-success">Has Valid Certificate</div>
                                                </div>

                                            </div>
                                        </div>
                                        @elseif($advocate->paid_year !== $cur_year && $advocate->status == $practising)
                                            <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, red 50%);"><br>
                                                    <a class="btn red radius-xl outline">Not Active</a>
                                                    <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                        @endif
                                                    </div>
                                                    <div class="profile-info">
                                                        <h4>{{ $profile->fullname }}</h4>
                                                        <h4>{{ $advocate->roll_no }}</h4>
                                                        <div class="badge badge-pill badge-danger">Has no Valid Certificate</div>
                                                    </div>

                                                </div>
                                            </div>
                                        @elseif($advocate->paid_year == $cur_year && $advocate->status == $non_practising)
                                            <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, grey 50%);"><br>
                                                    <a class="btn green radius-xl outline">Active for Notary</a>
                                                    <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                        @endif
                                                    </div>
                                                    <div class="profile-info">
                                                        <h4>{{ $profile->fullname }}</h4>
                                                        <h4>{{ $advocate->roll_no }}</h4>
                                                        <div class="badge badge-pill badge-success">Has Valid Notary Certificate</div>
                                                    </div>

                                                </div>
                                            </div>
                                        @elseif($advocate->paid_year !== $cur_year && $advocate->status == $non_practising)
                                            <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, red 50%);"><br>
                                                    <a class="btn red radius-xl outline">Active for Notary</a>
                                                    <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                        @endif
                                                    </div>
                                                    <div class="profile-info">
                                                        <h4>{{ $profile->fullname }}</h4>
                                                        <h4>{{ $advocate->roll_no }}</h4>
                                                        <div class="badge badge-pill badge-danger">Has Valid Notary Certificate</div>
                                                    </div>

                                                </div>
                                            </div>
                                        @elseif($profile->fullname == $cj && $advocate->status == $deferred)
                                            <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, darkgrey 50%);"><br>
                                                    <a class="btn red radius-xl outline">Deferred</a>
                                                    <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                        @endif
                                                    </div>
                                                    <div class="profile-info">
                                                        <h4>{{ $profile->fullname }}</h4>
                                                        <h4>{{ $advocate->roll_no }}</h4>
                                                        <div class="badge badge-pill badge-danger">Chief Justice of Tanzania</div>
                                                    </div>

                                                </div>
                                            </div>
                                        @elseif($profile->fullname !== $cj && $advocate->status == $deferred)
                                            <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, darkgrey 50%);"><br>
                                                    <a class="btn red radius-xl outline">Deferred</a>
                                                    <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                        @endif
                                                    </div>
                                                    <div class="profile-info">
                                                        <h4>{{ $profile->fullname }}</h4>
                                                        <h4>{{ $advocate->roll_no }}</h4>
                                                        <div class="badge badge-pill badge-danger">Not Permitted to Practice</div>
                                                    </div>

                                                </div>
                                            </div>
                                        @elseif($advocate->status == $deceased)
                                            <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, black 50%);"><br>
                                                    <a class="btn red radius-xl outline">Not Practising</a>
                                                    <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                        @endif
                                                    </div>
                                                    <div class="profile-info">
                                                        <h4>{{ $profile->fullname }}</h4>
                                                        <h4>{{ $advocate->roll_no }}</h4>
                                                        <div class="badge badge-pill badge-danger">Deceased</div>
                                                    </div>

                                                </div>
                                            </div>
                                        @elseif($advocate->status == $retired)
                                            <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, red 50%);"><br>
                                                    <a class="btn red radius-xl outline">Not Practising</a>
                                                    <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                        @endif
                                                    </div>
                                                    <div class="profile-info">
                                                        <h4>{{ $profile->fullname }}</h4>
                                                        <h4>{{ $advocate->roll_no }}</h4>
                                                        <div class="badge badge-pill badge-danger">Retired</div>
                                                    </div>

                                                </div>
                                            </div>
                                            @elseif($advocate->paid_year == $cur_year && $advocate->status == $non_profit)
                                                <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                    <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, lightskyblue 50%);"><br>
                                                        <a class="btn green radius-xl outline">Active</a>
                                                        <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                            @if(!empty($profile->picture))
                                                                <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                            @else
                                                                <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                            @endif
                                                        </div>
                                                        <div class="profile-info">
                                                            <h4>{{ $profile->fullname }}</h4>
                                                            <h4>{{ $advocate->roll_no }}</h4>
                                                            <div class="badge badge-pill badge-success">Has Valid Certificate</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @elseif($advocate->paid_year !== $cur_year && $advocate->status == $non_profit)
                                                <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                    <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, red 50%);"><br>
                                                        <a class="btn red radius-xl outline">Not Active</a>
                                                        <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                            @if(!empty($profile->picture))
                                                                <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                            @else
                                                                <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                            @endif
                                                        </div>
                                                        <div class="profile-info">
                                                            <h4>{{ $profile->fullname }}</h4>
                                                            <h4>{{ $advocate->roll_no }}</h4>
                                                            <div class="badge badge-pill badge-danger">Has no Valid Certificate</div>
                                                        </div>

                                                    </div>
                                                </div>
                                                @elseif($advocate->status == $suspended && $suspend == 1)
                                                <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                    <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, red 50%);"><br>
                                                        <a class="btn red radius-xl outline">Suspended</a>
                                                        <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                            @if(!empty($profile->picture))
                                                                <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                            @else
                                                                <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                            @endif
                                                        </div>
                                                        <div class="profile-info">
                                                            <h4>{{ $profile->fullname }}</h4>
                                                            <h4>{{ $advocate->roll_no }}</h4>
                                                            <div class="badge badge-pill badge-danger">Requested to suspend practising</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @elseif($advocate->status == $suspended && $suspend == 0)
                                                <div class="col-lg-4 col-md-5 col-sm-12 m-b10">
                                                    <div class="profile-bx text-center" style="background: linear-gradient(to bottom, white 50%, red 50%);"><br>
                                                        <a class="btn red radius-xl outline">Suspended</a>
                                                        <div class="user-profile-thumb" style="width: 200px; height: 200px;">
                                                            @if(!empty($profile->picture))
                                                                <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                            @else
                                                                <img src="{{ URL::to('images/user.png') }}" width="200" class="rounded-circle" alt="user">
                                                            @endif
                                                        </div>
                                                        <div class="profile-info">
                                                            <h4>{{ $profile->fullname }}</h4>
                                                            <h4>{{ $advocate->roll_no }}</h4>
                                                            <div class="badge badge-pill badge-danger">Suspended by Judge</div>
                                                        </div>

                                                    </div>
                                                </div>
                                        @endif

                                        <div class="col-lg-8 col-md-7 col-sm-12 m-b30">
                                            <div class="profile-content-bx">
                                                <div class="tab-content">
                                                    <div class="tab-pane active">
                                                        <div class="profile-head">
                                                            <h3 style="color: steelblue">Renewal History</h3>
                                                            <div class="feature-filters style1 ml-auto">
                                                                <ul class="filters" data-toggle="buttons">
                                                                    <li data-filter="" class="btn active">
                                                                        <input type="radio">
                                                                        <a title="Go Bck" style="border: none" onclick="goBack()">Go back to search results</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="courses-filter">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    @if($bills !== 0)
                                                                    <table class="table table-hover" id="table_id">
                                                                        <thead>
                                                                        <tr>
                                                                            <th id="table_id" data-priority="1">#</th>
                                                                            <th id="table_id">Year</th>
                                                                            <th id="table_id">Date From</th>
                                                                            <th id="table_id">Date To</th>
                                                                            <th id="table_id">Status</th>

                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($bills as $key => $bill)
                                                                            <tr>
                                                                                <td id="table_id"><i class="ti-time"></i></td>
                                                                                <td id="table_id">{{$bill->paid_year}}</td>
                                                                                <td id="table_id"></td>
                                                                                <td id="table_id">31 December {{$bill->paid_year}}</td>
                                                                                <td id="table_id">
                                                                                    @if ($bill->payment_status != 'PAID')
                                                                                        <span class="badge bg-danger" style="color: white">Not Active</span>
                                                                                    @else
                                                                                        <span class="badge bg-success" style="color: white">Active</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    @else
                                                                        <div>
                                                                            <a style="color: #ee1e2d">No Renewal History Information Found Related to This Advocate!</a><br>
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
                                </div>
                            </div>
                        </div>
                        <!-- contact area END -->

                    </div>

                </div>
                <div class="mw800 m-auto justify-content-center">
                    <div class="row justify-content-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

