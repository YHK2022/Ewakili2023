@extends('mgt-static')

@section('title')
    @parent
    | Fees
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
                                <h5>Master Data</h5>
                                <span>Fees</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Fees</li>
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
            <div>
                <a data-toggle="modal" data-target="#addSession" title="Add Session" class="btn btn-info btn-xm pull-right">
                    <i class="fa fa-plus"></i>
                    Add Fees
                </a>
                <!-- Add Session Model-->
                <div class="modal fade" id="addSession" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="forms-sample" method="POST" action="{{ url('settings/fees/add') }}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demoModalLabel">Add Fee Type</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Description </label>
                                                <input type="text" name="description" class="form-control  is-valid"
                                                    placeholder="description" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Services </label>
                                                <input type="text" name="service" class="form-control  is-valid"
                                                    placeholder="service" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Service </label>
                                                <select class="form-control selectpicker" name="fee_type_id" required
                                                    data-live-search="true" data-live-search-style="begins"
                                                    title="Select Employee...">
                                                    @foreach ($feetypes as $feetype)
                                                        <option value="{{ $feetype->id }}">
                                                            {{ $feetype->service }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">amaount </label>
                                                <input type="text" name="amount" class="form-control  is-valid"
                                                    placeholder="amount" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Currency</label>
                                                <select class="select2 form-control w-100" value="currency" id="currency"
                                                    name="currency">
                                                    <option value=""> Select...</option>
                                                    <option value=" TZS"> TZS</option>
                                                    <option value="USD">USD</option>


                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="table_id">
                                <thead>
                                    <tr>
                                        <th id="table_id" data-priority="1">#</th>
                                        <th id="table_id">Service</th>
                                        <th id="table_id">Description</th>
                                        <th id="table_id">Amount</th>
                                        <th id="table_id">Currency</th>
                                        <th id="table_id">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fees as $key => $fee)
                                        @php
                                            $feetype = \App\Models\Masterdata\FeeType::find($fee->fee_type_id);
                                        @endphp
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $feetype->service }}</td>
                                            <td id="table_id">{{ $fee->description }}</td>
                                            <td id="table_id">{{ $fee->amount }}</td>
                                            <td id="table_id">{{ $fee->currency }}</td>
                                            <td id="table_id">
                                                <div class="table-actions">

                                                    <a href="#edit{{ $fee->id }}" title="Edit"
                                                        data-toggle="modal" data-id="{{ $fee->id }}"
                                                        data-target="#edit{{ $fee->id }}"><i
                                                            class="ik ik-edit-2"></i></a>
                                                    <a href="#delete{{ $fee->id }}" title="Delete"
                                                        data-toggle="modal" data-id="{{ $fee->id }}"
                                                        data-target="#delete{{ $fee->id }}"><i
                                                            class="ik ik-trash-2"></i></a>

                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Session Model-->
                                        <div class="modal fade" id="edit{{ $fee->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('settings/fees/edit', $fee->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Fees</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">



                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Service </label>
                                                                        <input type="hidden" name="fee_type_id"
                                                                            value="{{ $fee->fee_type_id }}">
                                                                        <select class="form-control selectpicker"
                                                                            name="fee_type_id" required
                                                                            data-live-search="true"
                                                                            data-live-search-style="begins"
                                                                            title="Select Employee...">
                                                                            @foreach ($feetypes as $feetype)
                                                                                <option value="{{ $feetype->id }}">
                                                                                    {{ $feetype->service }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Description
                                                                        </label>
                                                                        <input type="text" name="description"
                                                                            value="{{ $fee->description }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="description" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Service
                                                                        </label>
                                                                        <input type="text" name="service"
                                                                            value="{{ $fee->service }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="description" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">
                                                                            Amount</label>
                                                                        <input type="text" name="amount"
                                                                            value="{{ $fee->amount }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="amount" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">
                                                                            Currency</label>
                                                                        <select class="select2 form-control w-100"
                                                                            value="currency" id="currency"
                                                                            value="{{ $fee->currency }}" name="currency">
                                                                            {{-- <option value="{{ $fee->currency }}" selected>
                                                                                {{ $fee->currency }}</option> --}}

                                                                            <option value=" TZS"> TZS</option>
                                                                            <option value="USD">USD</option>


                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Delete session Model-->
                                        <div class="modal fade" id="delete{{ $fee->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('settings/fees/delete', $fee->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Delete
                                                                Fees</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete Petition Session opened:
                                                            <strong> {{ $fee->service }} </strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes
                                                                Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
