@extends('adv-static')

@section('title')
    @parent
    | Renewal
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
                                <h5>Practising & Notary Public Certificate Renewal</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">Renewal</li>
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
                                <p class="lead"><i class="ik ik-edit"></i> Application for Practising Certificate {{$renew_year}} </p><hr/>
                                <div class="col-sm-12">

                                    @if($application_status != "APPROVE")
                                    <strong style="color: #ee1e2d;"> You delayed renewing within time, Apply for Renew Out of Time. Submit the following required attachments<hr></strong>
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
                                    @else
                                    <strong style="color: #ee1e2d;">Your request for Renew out of time is approved, Apply for Practicing Certificate<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                    <div class="row">
                                    @if($tls_result == 1)    
                                        <div class="col-sm-12">
                                            <form class="forms-sample" method="POST" action="{{ url('renewal/tax-check', $profile_id)}}">
                                                {{ csrf_field() }}
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Practising Certificate Fee:</th>
                                                            <td>{{ $pc_fee_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Notary Public Certificate Fee:</th>
                                                            <td>{{ $nc_fee_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Penalty:</th>
                                                            <td>{{ $penalty_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Total Amount:</th>
                                                            <td>{{ $total }}/=</td>
                                                        </tr>
                                                    </table>


                                                      <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Enter Tax Clearance Certificate No:</label>
                                                             <input type="text" name="data" class="form-control  is-valid" id="data" required
                                                             placeholder="Cerificate No." required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger pull-left">Submit for TAX Clearance Check</button>
                                                </div>
                                            </form>
                                        </div>
                                    @else   
                                    <div class="col-sm-12">
                                            <form class="forms-sample" method="POST" action="{{ url('renewal/tls-check', $profile_id)}}">
                                                {{ csrf_field() }}
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Practising Certificate Fee:</th>
                                                            <td>{{ $pc_fee_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Notary Public Certificate Fee:</th>
                                                            <td>{{ $nc_fee_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Penalty:</th>
                                                            <td>{{ $penalty_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:40%;text-align:right;">Total Amount:</th>
                                                            <td>{{ $total }}/=</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger pull-left">Submit for TLS Compliance Check</button>
                                                </div>
                                            </form>
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
    </div>

@endsection

