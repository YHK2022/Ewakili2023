@extends('mgt-static')

@section('title')
    @parent
    Revenue
@stop

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-red"></i>
                        <div class="d-inline">
                                <h5>Revenue Report</h5>
                            <span>Revenue Report</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Revenue Report</li>
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
            <div class="col-xl-12">
                        <div class="card">
  
                            <div class="tab-content" id="pills-tabContent">
                               

                                <div  id="all" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
<form action="{{ url('report/revenue') }}" method="GET" style="margin-bottom: 10px;">
  <input type="text" name="query" id="searchInput" placeholder="Search Roll no..." style="padding: 5px; width: 200px;" oninput="handleSearch(event)">
  <button type="submit" class="badge bg-warning" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Search</button>
</form>

<div id="search-results"></div>
                                          <div class="dt-buttons" style="margin-buttom:10px;"></div>
                                      @if ($search_all->count() > 0)
                                        <table class="table table-hover" id="table_id">                                                
                                            <thead>
                                            <tr>
                                                {{-- <th id="table_id" data-priority="1">#</th> --}}
                                                <th id="table_id">Control Number</th>
                                                <th id="table_id">Bill Amount</th>
                                                <th id="table_id">Paid Amount</th>
                                                <th id="table_id">Payer Name</th>
                                                <th id="table_id">Receipt No</th>
                                                <th id="table_id">Bank</th>
                                                <th id="table_id">Phone No</th>
                                                {{-- <th id="table_id">Pay Channel</th> --}}
                                                <th id="table_id">Paid Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($search_all as $key => $revenue)
                                                <tr>
                                                    {{-- <td id="table_id">{{++$key}}</td> --}}
                                                    <td id="table_id">{{$revenue->payctrnum}}</td>
                                                    <td id="table_id">{{$revenue->billamt}}</td>
                                                    <td id="table_id">{{$revenue->paidamt}}</td>
                                                    <td id="table_id">{{$revenue->pyrname}}</td>
                                                    <td id="table_id">{{$revenue->pspreceiptnumber}}</td>
                                                    <td id="table_id">{{$revenue->pspname}}</td>
                                                    <td id="table_id">{{$revenue->pyrcellnum}}</td>
                                                    {{-- <td id="table_id">{{$revenue->usdpaychnl}}</td> --}}
                                                    <td id="table_id">{{ date('F d, Y', strtotime($revenue->trxdttm)) }}</td>
                                                
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{-- {{ $search_all->links() }} --}}
                                            @else
                              <p>No results found.</p>
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


