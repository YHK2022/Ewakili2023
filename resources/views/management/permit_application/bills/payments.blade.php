

@extends('mgt-static')

@section('title')
    @parent
    | Bills
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-lock bg-red"></i>
                            <div class="d-inline">
                                <h5>Payments</h5>
                                <span>Payments</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Payments</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="table_id">
                                <thead>
                                    <tr>
                                        <th id="table_id" data-priority="1">#</th>
                                                    <th id="table_id">Receipt Number</th>
                                                    <th id="table_id">Payment Date</th>
                                                    <th id="table_id">Bill For</th>
                                                    <th id="table_id">Amount</th>
                                                    <th id="table_id">Paid Amount</th>
                                                    <th id="table_id">Control Number</th>
                                                    <th id="table_id">Payment Channel</th>
                                                    <th id="table_id">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($bills as $key => $bill)
                                     @php
                                            $user = \App\User::find($pending->payer_id);
                                        @endphp
                                        <tr>
                                            <td id="table_id">{{++$key}}</td>
                                                        <td id="table_id">{{$bill->pspreceiptnumber}}</td>
                                                        <td id="table_id">{{$bill->created_at}}</td>
                                                        <td id="table_id"></td>
                                                        <td id="table_id">{{$bill->billamt}}</td>
                                                        <td id="table_id">{{$bill->paidamt}}</td>
                                                        <td id="table_id">{{$bill->payctrnum}}</td>
                                                        <td id="table_id">{{$bill->usdpaychnl}}</td>
                                                        <td id="table_id">
                                                            <div class="table-actions">
                                                                <a href="{{ url('bill/view', $bill->uid) }}" title="View Certificate" ><i class="ik ik-eye pull-left"></i></a>
                                                            </div>
                                                        </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
