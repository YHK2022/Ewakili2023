@extends('adv-static')

@section('title')
    @parent
    | My Firm/Work Place
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-briefcase bg-red"></i>
                            <div class="d-inline">
                                <h5>My Firm / Work Place</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">My Firm / Work Place</li>
                                </li>
                                <li class="breadcrumb-item">
                                    <button title="Go Bck" style="border: none" onclick="goBack()"><i class="ik ik-chevrons-left"></i></button>
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

            <div>
                <a title="Leave Firm" class="btn btn-info btn-xm pull-right">
                    <i class="ik ik-log-out"></i>
                    Leave Current Firm
                </a>
            </div><br/>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <p class="lead"><i class="ik ik-briefcase"></i> My Firm / Work Place </p><hr/>


                                @if($firms != "No data")
                                    <div class="col-12">
                                        <p class="lead"><i class="ik ik-home"></i> Firm/Work Place</p>
                                        <div class="table-responsive">
                                            @foreach($firms as  $firm)
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
                                                        <td>{{ $firm->tin_number}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Category:</th>
                                                        <td>{{ $firm->firm_type}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Model:</th>
                                                        <td>{{ $firm->firm_model}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Status:</th>
                                                        <td>{{ $firm->approval_status}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Members:</th>
                                                        <td>{{ $firm->members}}</td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($firm_addresses != "No data")
                                    <div class="col-12">
                                        <p class="lead"><i class="ik ik-home"></i> Firm/Work Place Branch/Address</p>
                                        <div class="table-responsive">
                                            @foreach($firm_addresses as  $firm)
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
                                                        <td>{{ $firm->phone_number}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Email:</th>
                                                        <td>{{ $firm->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Box:</th>
                                                        <td>{{ $firm->box}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Postcode:</th>
                                                        <td>{{ $firm->postcode}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Region:</th>
                                                        <td>{{ $firm->region_id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">City:</th>
                                                        <td>{{ $firm->city}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">District:</th>
                                                        <td>{{ $firm->district_id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Ward:</th>
                                                        <td>{{ $firm->ward}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Street:</th>
                                                        <td>{{ $firm->street}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:20%;text-align:right;">Status:</th>
                                                        <td>{{ $firm->approval_status}}</td>
                                                    </tr>
                                                </table>
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
    </div>

@endsection

