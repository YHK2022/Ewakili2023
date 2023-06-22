@extends('adv-static')

@section('title')
    @parent
    | Select Venue
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
                                <h5>Appearance Venue</h5>
                                <span>{{ Auth::user()->username }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Appearance Venue</li>
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
                    <div class="accordion" id="accordionExample">
                        {{-- @if ($llb) --}}
                         @if (!empty($llb->venue_id))
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <h3>Appearance Venue </h3>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('petition/update-venue', $llb->id) }}">
                                                        <?php
                                                       
                                                           $session_id = DB::table('petition_sessions')->where('active',true)->first()->id;
                                                            $appearance_venues = DB::table('appearances')
                                                             ->join('appearance_venues', 'appearances.venue_id', '=', 'appearance_venues.id')
                                                                 ->where('appearances.petition_session_id', $session_id)
                                                              ->get();
                                                           ?>
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                        <div class="col-sm-6">
                                         <div class="form-group">
                                        <label for="exampleSelectGender">Appearance Venue</label>
                                          <?php
                                                $venue = DB::table('appearances')->find($llb->venue_id);
                                         ?>
                                        <select name="venue_id" class="form-control is-valid" id="exampleSelectGender" value="{{ $llb->venue_id }}" required>
                                             <option value="{{$llb->venue_id}}"></option>  
                                            @foreach ($appearance_venues as $appearance_venue)
                                               <option value="{{ $appearance_venue->id }}">
                                                  {{ $appearance_venue->name  }}</option>
                                                 @endforeach
                                          
                                        </select>
                                    </div>
                                </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-danger mr-2">Update
                                                            Changes</button>
                                                        <button class="btn btn-default">Cancel</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <h3>Appearance Venue</h3>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('petition/post-venue') }}">
                                                        <?php
                                                        
                                                        $session_id = DB::table('petition_sessions')->where('active',true)->first()->id;
                                                          $appearance_venues = DB::table('appearances')
                                                             ->join('appearance_venues', 'appearances.venue_id', '=', 'appearance_venues.id')
                                                                 ->where('appearances.petition_session_id', $session_id)
                                                              ->get();
                                                        
                                                           ?>
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                                   <div class="col-sm-6">
                                         <div class="form-group">
                                        <label for="exampleSelectGender"> Selected Appearance Venue</label>
                                        <select name="venue_id" class="form-control is-valid" id="exampleSelectGender" value="{{ $llb->venue_id }}" required>
                                              @foreach ($appearance_venues as $appearance_venue)
                                               <option value="{{ $appearance_venue->id }}">
                                                {{  date('F d, Y', strtotime($appearance_venue->appear_date) ) }} |  {{ $appearance_venue->name  }}</option>
                                                 @endforeach
                                          
                                        </select>
                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-danger mr-2">Submit</button>
                                                        <button class="btn btn-default">Cancel</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
