

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
                                <h5>Bills</h5>
                                <span>Reconcile Bills</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Pending Bills</li>
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
                                        <th id="table_id">Bill Number</th>
                                        <th id="table_id">Bill Date</th>
                                        <th id="table_id">Year</th>
                                        <th id="table_id">Payer</th>
                                        <th id="table_id">Bill For</th>
                                        <th id="table_id">Amount</th>
                                        <th id="table_id">Due Date</th>
                                        <th id="table_id">Control Number</th>
                                        <th id="table_id">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($pendings as $key => $pending)
                                     @php
                                            $user = \App\User::find($pending->payer_id);
                                        @endphp
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $pending->id }}</td>
                                            <td id="table_id">{{ $pending->bill_date }}</td>
                                            <td id="table_id">{{ $pending->paid_year }}</td>
                                            <td id="table_id">{{ $user->full_name }}</td>
                                            <td id="table_id"> {{$pending->status}} </td>
                                            <td id="table_id">{{ $pending->total_amount }}</td>
                                            <td id="table_id">{{ $pending->due_date }}</td>
                                            <td id="table_id">{{ $pending->control_number }}</td>
                                            <td id="table_id">{{ $pending->payment_status }}</td>
                                            
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
