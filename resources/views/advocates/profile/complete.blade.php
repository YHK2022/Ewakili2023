@extends('temp-adv-static')

@section('title')
    @parent
    | Application for Temporary Admission
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
                                <h5>Application for Temporary Admission</h5>
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
                                <li class="breadcrumb-item active" aria-current="page">Finish</li>
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
                        <div class="card">

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">

                                                @if ($profile)
                                                    <div class="col-12">
                                                        <p class="lead"><i class="ik ik-user"></i> Personal Profile
                                                            Information <a style="color:red;" href="{{ url('petition/personal-details') }}"> [ Edit ]</a>
                                                        </p>
                                                        <hr />
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless" style="font: size 20px;">
                                                                <tr>
                                                                    <th style="width:20%;text-align:right;">Gender:</th>
                                                                    <td>{{ $profile->gender }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:20%;text-align:right;">Date of Birth:
                                                                    </th>
                                                                    <td>{{ $profile->dob }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:20%;text-align:right;">Nationality:
                                                                    </th>
                                                                    <td>{{ $profile->nationality }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:20%;text-align:right;">ID Type:</th>
                                                                    <td>{{ $profile->id_type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:20%;text-align:right;">ID Number:</th>
                                                                    <td>{{ $profile->id_number }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <p class="lead"><i class="ik ik-user"></i> Personal Profile
                                                            Information <a style="color:red;" href="{{ url('petition/personal-details') }}"> [ Edit ]</a>
                                                        </p>
                                                        <hr />
                                                        <p><i class="ik ik-alert-triangle" style="color:red;"></i> No
                                                            personal profile information to display !</p>
                                                    </div>
                                                @endif

                

                                                @if ($attachment)
                                                    <div class="col-12">
                                                        <p class="lead"><i class="ik ik-paperclip"></i> Attachments <a
                                                                style="color:red;" href="{{ url('temporary/temporary-attachment') }}"> [ Edit ]</a></p>
                                                        <hr />
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless"
                                                                style="font: size 20px;">
                                                                @foreach ($attachment as $key => $attachments)
                                                                    <tr>
                                                                        <th style="width:20%;text-align:right;">
                                                                            {{ $attachments->upload_date }}:</th>
                                                                        <td>
                                                                           
                                                                            
                                                                            <a style="color:blue;text-decoration:none;"  data-toggle="collapse" href="#collapseExample{{$attachments->id}}" 
                                                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                               {{ $attachments->name }}
                                                                             </a>
                                                                            <div class="collapse" id="collapseExample{{$attachments->id}}">
                                                                                 <div class="card card-body">
                                                                                      <embed
                                                                                        src="{{ url('public/images/files/' . $attachments->file) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                               </div>
                                                                           </div>
                                                                        </td>
                                                                    </tr>

                                                                    <!-- View pdf modal-->
                                                                    {{-- <div class="modal fade"
                                                                        id="document{{ $attachments->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">
                                                                                        {{ $attachments->name }}</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ url('public/images/files/' . $attachments->file) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <p class="lead"><i class="ik ik-paperclip"></i> Attachments <a
                                                                style="color:red;" href="{{ url('petition/attachments') }}"> [ Edit ]</a></p>
                                                        <hr />
                                                        <p><i class="ik ik-alert-triangle" style="color:red;"></i> No
                                                            attachment(s) to display !</p>
                                                    </div>
                                                @endif

                                                <!-- Submit application -->
                                                @if ($progress->appl_progress >= 95 && $progress->finish == 1)
                                                       
                                                        <div class="col-12">
                                                             <form class="submit" method="POST"
                                                                action="{{ url('temporary/resubmit-application') }}">
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger mr-2">Re-Submit
                                                                    application</button>
                                                            </form>
                                                        </div>
                                                      @else
                                                        <div class="col-12">
                                                            <form class="submit" method="POST"
                                                                action="{{ url('temporary/submit-applications') }}">
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger mr-2">Submit
                                                                    application</button>
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
    </div>

@endsection
