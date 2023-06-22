@extends('adv-static')

@section('title')
    @parent
    | My Certificates
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-award bg-red"></i>
                            <div class="d-inline">
                                <h5>My Certificates</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">My Certificates</li>
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
                <a title="Print Certificate" class="btn btn-info btn-xm pull-right">
                    <i class="ik ik-printer"></i>
                    Print
                </a>
                <a title="Download Certificate" class="btn btn-info btn-xm pull-right">
                    <i class="ik ik-download"></i>
                    Download
                </a>
            </div><br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="certificate-container">
                                    <div class="certificate-notary">
                                        <div class="water-mark-overlay"></div>

                                        <div class="certificate-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td style="text-align:left;top: 0;">
                                                        <strong>S/N P22051739947</strong>
                                                    </td>
                                                
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left;top: 0;">
                                                    </td>
                                                    <td>
                                                            {{-- <img src="{{ asset('public/images/files/'.$profile->picture) }}" width="100"  alt="user"> --}}
                                                            <img src="{{ URL::to('images/tz.png') }}" width="110" alt="user">

                                                        </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:center;">
                                                        <h1><strong>THE HIGH COURT OF TANZANIA</strong></h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align:center;">
                                                        <hr style="color: #0a0a0a; size: 10px;"/>
                                                         <br> <br>
                                                        <h2><strong>Certificate to practise as a Notary Public and commissioner for Oaths in Tanzania</strong></h2><br>
                                                        <hr style="color: #0a0a0a; size: 10px;"/>
                                                    </td>
                                                 
                                                </tr>
                                                <br> <br> <br>
                                                <tr>
                                                    <td colspan="3">
                                                        {{-- <h3><strong>{{$type->type}} CERTIFICATE</strong></h3><br> --}}
                                                        <h2><strong>I HEREBY CERTIFY that {{$profile->fullname}},
                                                        ROLL NO {{$advocate->roll_no}}, has this day been admitted to practice as a Notary Public and Commissioner for oaths in Tanzania. 
                                                                <br><br> <br> <br>
                                                                <strong>
                                                                    Fee Paid T. Shillings 40,000/=<br>
                                                                    This Certificate expires on the 31st December, {{$cur_year}},<br> unless renewed 
                                                                </strong>
                                                                <br><br> <br> <br>
                                                            Dated this {{$formattedDate}} at Dar es Salaam
                                                            </strong></h2>
                                                    </td>
                                                </tr>
                                                 <br> <br> <br>
                                                <tr colspan="3">
                                                    <td style="width:30%;text-align:right;"></td>
                                                    <td></td>
                                                    <td style="width:30%;text-align:center;padding-right:50px;">
                                                        Signature<br>
                                                        <strong><h2>Registrar<br>
                                                             The High Court Of Tanzania<br>
                                                              Dar Es Salaam</h2> </strong>
                                                    </td>
                                                </tr>
                                            </table>
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

