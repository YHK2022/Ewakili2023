@extends('adv-static')

@section('title')
    @parent
    | My Bills
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
                                <h5>My Bills</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">My Bills</li>
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
                                <p class="lead"><i class="ik ik-briefcase"></i> My Bills </p><hr/>

                                @if($bills != "No data")
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="table_id">
                                                <thead>
                                                <tr>
                                                    <th id="table_id" data-priority="1">#</th>
                                                    <th id="table_id">Bill ID</th>
                                                    <th id="table_id">Generated Date</th>
                                                    <th id="table_id">Bill Year</th>
                                                    <th id="table_id">Due Date</th>
                                                    <th id="table_id">Control Number</th>
                                                    <th id="table_id">Amount</th>
                                                    <th id="table_id">Status</th>
                                                    <th id="table_id">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bills as $key => $bill)
                                                    <tr>
                                                        <td id="table_id">{{++$key}}</td>
                                                        <td id="table_id">{{$bill->bill_id}}</td>
                                                        <td id="table_id">{{$bill->bill_date}}</td>
                                                        <td id="table_id">{{$bill->paid_year}}</td>
                                                        <td id="table_id">{{$bill->due_date}}</td>
                                                        <td id="table_id">{{$bill->control_number}}</td>
                                                        <td id="table_id">{{$bill->total_amount}}</td>
                                                        <td id="table_id">{{$bill->payment_status}}</td>
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
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

