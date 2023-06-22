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
                                    <div class="certificate">
                                        <div class="water-mark-overlay"></div>

                                        <div class="certificate-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td style="text-align:left;top: 0;">
                                                        <strong>S/N P22051739947 </strong>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:center;">
                                                        <h1><strong>THE HIGH COURT OF TANZANIA</strong></h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:30%;"></td>
                                                    <td style="width:40%;">
                                                        <hr style="color: #0a0a0a; size: 10px;"/>
                                                        <h2><strong>THE ADVOCATES ACT</strong></h2><br>
                                                        <strong>(Cap. 341 of the Revised Edition 2002)<br>
                                                            (Section 35)</strong>
                                                        <hr style="color: #0a0a0a; size: 10px;"/>
                                                    </td>
                                                    <td style="width:30%;">
                                                        @if(!empty($profile->picture))
                                                            <img src="{{ asset('public/images/files/'.$profile->picture) }}" width="100"  alt="user">
                                                        @else
                                                            <img src="{{ URL::to('images/user.png') }}" width="100" alt="user">
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <h3><strong>{{$advocate->status}} CERTIFICATE</strong></h3><br>
                                                        <h4><strong>I HEREBY CERTIFY that {{$profile->fullname}},
                                                        ROLL NO {{$advocate->roll_no}}, an Advocate of the High Court of
                                                        Tanzania having complied with the provision of sub
                                                        section (1) of section 35 of the Advocates Act is
                                                        entitled to practice before the said High Court and
                                                        before the courts subordinate thereto (but not Primary
                                                        Courts) up to the thirty first day of December, {{$cur_year}}
                                                        inclusive, upon the terms and subject to the conditions
                                                        set forth in the aforesaid Act as amended from time to
                                                        time and any legislations having validity there under.
                                                                <br><br>
                                                            Dated this {{$formattedDate}} at Dar es Salaam
                                                            </strong></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:30%;text-align:right;"></td>
                                                    <td></td>
                                                    <td style="width:30%;text-align:right;">
                                                        Signature<br>
                                                        <strong>Registrar of the High Court</strong>
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

