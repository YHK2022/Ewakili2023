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
        <div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Renewal Fee Summary</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Payment Control Number is : <span id="control-number"></span><br>
        Total Fees: <span id="total-fees"></span><br>
        Expire on : <span id="due-date"></span><br>
      </div>
       <div class="modal-body">
         Payment can be made through Bank Or Mobile (AirtelMoney / Halopesa / MPESA / TigoPesa)
         by selecting payment option.
         Government above paymernt Control Number as your payment reference . For More Information refer user guide       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@if(session()->has('success'))
  <script>
    $(function() {
      var controlNumber = "{{ session('data.control_number') }}";
      var totalFees = "{{ session('data.total_all_fees') }}";
      var duedate = "{{ session('data.due_date') }}";
      $('#control-number').text(controlNumber);
      $('#total-fees').text(totalFees);
       $('#due-date').text(duedate);
      $('#exampleModal').modal('show');
    });
  </script>
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
                                    <strong style="color: #1ea1f3;">Apply for PC With Penalty<hr></strong>
                                    <!-- Notice of Intention to renew and Affidavit-->
                                    <div class="row">
                                        <div class="row">
                                        @if($tax_result == 2)

                                         
                                            <div class="col-sm-12">
                                                <form class="forms-sample" method="POST" action="{{ url('renewal/request-control-number', $profile_id)}}">
                                                    {{ csrf_field() }}
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                        <tr>
                                                            <th style="width:90%;text-align:right;">Practising Certificate Fee:</th>
                                                            <td>{{ $pc_fee_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:90%;text-align:right;">Notary Public Certificate Fee:</th>
                                                            <td>{{ $nc_fee_amount }}/=</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:90%;text-align:right;">Total Amount:</th>
                                                            <td>{{ $total }}/=</td>
                                                        </tr>
                                                        </table>
                                                    </div>
                                                        <div class="form-group">
                                                          <label for="users">Roll Number</label>
                                                          <select id="users" name="users[]" class="form-control" multiple></select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="amount">Amount</label>
                                                               <input type="number" id="amount" name="amount" class="form-control">
                                                        </div>
                                                      
                                               <div class="row">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <span style="color: white; background-color: red;"> <p style="margin:7px;"><i class="ik ik-search"></i></p></span>
                                <input type="text" autocomplete="off" name="search" id="searchadv" class=" searchadv form-control input-lg is-valid" placeholder="Enter Roll Number">
                            </div>
                        </div>
                    </div>

                    <div id="Hintadv"></div> 
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success pull-left">Request Control Number</button>
                                                    </div>
                                                </form>
                                                <div class="autocomplete">
    <input type="text" name="query" id="query" class="form-control" autocomplete="off" placeholder="Search...">
    <div id="search-results"></div>
    <ul id="selected-items"></ul>
    <ul id="selected-views"></ul>

</div>
                                            </div>
                                        @elseif($tls_result == 1)
                                                <div class="col-sm-12">
                                                    <form class="forms-sample" method="POST" action="{{ url('renewal/tax-check', $profile_id)}}">
                                                        {{ csrf_field() }}
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless">
                                                            <tr>
                                                                <th style="width:90%;text-align:right;">Practising Certificate Fee:</th>
                                                                <td>{{ $pc_fee_amount }}/=</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:90%;text-align:right;">Notary Public Certificate Fee:</th>
                                                                <td>{{ $nc_fee_amount }}/=</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:90%;text-align:right;">Total Amount:</th>
                                                                <td>{{ $total }}/=</td>
                                                            </tr>
                                                            </table>
                                                        </div>

                                                   <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Enter Tax Clearance Certificate No:</label>
                                                             <input type="text" name="data" class="form-control  is-valid"  id="data" required
                                                             placeholder="Cerificate No." required>
                                                        </div>
                                                    </div>

                                                      
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success pull-left">Submit for TAX Clearance Check</button>
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
                                                                <th style="width:90%;text-align:right;">Practising Certificate Fee:</th>
                                                                <td>{{ $pc_fee_amount }}/=</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:90%;text-align:right;">Notary Public Certificate Fee:</th>
                                                                <td>{{ $nc_fee_amount }}/=</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:90%;text-align:right;">Total Amount:</th>
                                                                <td>{{ $total }}/=</td>
                                                            </tr>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success pull-left">Submit for TLS Compliance Check</button>
                                                        </div>
                                                    </form>
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

@endsection

