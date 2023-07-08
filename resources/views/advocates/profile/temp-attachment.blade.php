@extends('temp-adv-static')

@section('title')
    @parent
    | Application for Temporay Admission
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-paperclip bg-red"></i>
                            <div class="d-inline">
                                <h5>Temporary Admission Attachements</h5>
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
                                <li class="breadcrumb-item active" aria-current="page">Required Attachements</li>
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
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h3>Required Attachements
                                            
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- Profile Picture-->
                                                @if (!empty($attach_move->profile_picture))
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <form class="picture" method="POST"
                                                                action="{{ url('temporary/delete-picture') }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="form-group div1">
                                                                    <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-9">
                                                                                <img src="{{ asset('public/images/files/' . $attach_move->profile_picture) }}"
                                                                                    width="100px" height="90px" /> -
                                                                                <span>Profile Picture @if ($petition_form->attachment == 1)
                                                                                        - <span
                                                                                            style="color:DeepSkyBlue;">&#10003;</span>
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger button1"><i
                                                                                            class="ik ik-trash-2"></i>Remove</button>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="form-group">

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <form class="picture" method="POST"
                                                                action="{{ url('temporary/post-picture') }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                        <h4 class="sub-title">Passport Size <small><i
                                                                                    style="color:red;">Recent &
                                                                                    Colored</i></small></h4>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-9">
                                                                                <input type="file" name="profile_picture"
                                                                                    accept="image/*" placeholder="col-sm-11"
                                                                                    onChange="readURL(this);">
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <button type="submit"
                                                                                    class="btn btn-info"><i
                                                                                        class="ik ik-share"></i>Upload</button>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <img src="{{ URL::to('images/user.png') }}"
                                                                    id="img" width="100px"
                                                                    alt="You are uploading something else, Only image is required here!" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!empty($attach_move->profile_picture))
                                                    <!-- Application for Temporary Admission-->
                                                    @if (!empty($attach_move->application_admission))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="application_admission" method="POST"
                                                                    action="{{ url('temporary/delete-petition',$attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div2">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#application_admission{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->application_admission }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->application_admission }}"
                                                                                        data-file="{{ $attach_move->application_admission }}"
                                                                                        data-target="#application_admission{{ $attach_move->id }}">
                                                                                        <span>

                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Application for Temporary Admission 
                                                                                                 @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button2"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="application_admission{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Application for
                                                                                       Temporary Admission</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->application_admission) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="application_admission" method="POST"
                                                                    action="{{ url('temporary/post-petition') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">Application for
                                                                                      Temporary Admission</h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="application_admission"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Admission Certificate-->
                                                    @if (!empty($attach_move->admission_certificate))
                                                        <div class="row" >
                                                            <div class="col-sm-9">
                                                                <form class="admission_certificate" method="POST"
                                                                    action="{{ url('temporary/delete-admission-certificate', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div3">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#admission_certificate{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->admission_certificate }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->admission_certificate }}"
                                                                                        data-file="{{ $attach_move->petition }}"
                                                                                        data-target="#admission_certificate{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Admission Certificate
                                                                                                @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button3"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="admission_certificate{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Admission
                                                                                        Certificate</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ url('public/images/files/' . $attach_move->admission_certificate) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="admission_certificate" method="POST"
                                                                    action="{{ url('temporary/post-admission-certificate') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">Admission Certificate
                                                                                    </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="admission_certificate"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    <!-- Practising Certificate-->
                                                    @if (!empty($attach_move->practising_certificate))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="practising_certificate" method="POST"
                                                                    action="{{ url('temporary/delete-practising', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div4">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#practising_certificate{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->practising_certificate }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->practising_certificate }}"
                                                                                        data-file="{{ $attach_move->practising_certificate }}"
                                                                                        data-target="#practising_certificate{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Practising Certificate
                                                                                                 @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button4"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="practising_certificate{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Practising Certificate
                                                                                        </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->practising_certificate) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="practising_certificate" method="POST"
                                                                    action="{{ url('temporary/post-practising') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">Practising Certificate
                                                                                         </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="practising_certificate"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Notary Certificate-->
                                                    @if (!empty($attach_move->notary_certificate))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="notary_certificate" method="POST"
                                                                    action="{{ url('temporary/delete-notary', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div5">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#notary_certificate{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->notary_certificate }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->notary_certificate }}"
                                                                                        data-file="{{ $attach_move->notary_certificate }}"
                                                                                        data-target="#notary_certificate{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Notary Certificate
                                                                                                 @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button5"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="notary_certificate{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Notary Certificate
                                                                                        </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->notary_certificate) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="notary_certificate" method="POST"
                                                                    action="{{ url('temporary/post-notary') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">Notary Certificate
                                                                                         </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="notary_certificate"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Introduction letter-->
                                                    @if (!empty($attach_move->introduction_letter))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="introduction_letter" method="POST"
                                                                    action="{{ url('temporary/delete-letter', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div6">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#introduction_letter{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->introduction_letter }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->introduction_letter }}"
                                                                                        data-file="{{ $attach_move->introduction_letter }}"
                                                                                        data-target="#introduction_letter{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Introduction Letter
                                                                                                @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button6"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="introduction_letter{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Introduction Letter
                                                                                        </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->introduction_letter) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row" >
                                                            <div class="col-sm-9">
                                                                <form class="introduction_letter" method="POST"
                                                                    action="{{ url('temporary/post-letter') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">Introduction
                                                                                        Letter<small><i
                                                                                                style="color:red;">Certified
                                                                                                copy .pdf format</i></small>
                                                                                    </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="introduction_letter"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                         <!-- Ordinary Education letter-->
                                                    @if (!empty($attach_move->ordinary_secondary_education))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="ordinary_secondary_education" method="POST"
                                                                    action="{{ url('temporary/delete-ordinary', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div7">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#ordinary_secondary_education{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->ordinary_secondary_education }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->ordinary_secondary_education }}"
                                                                                        data-file="{{ $attach_move->ordinary_secondary_education }}"
                                                                                        data-target="#ordinary_secondary_education{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Ordinary Secondary Education
                                                                                                @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button7"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="ordinary_secondary_education{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Ordinary Secondary Education
                                                                                        </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->ordinary_secondary_education) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row" >
                                                            <div class="col-sm-9">
                                                                <form class="ordinary_secondary_education" method="POST"
                                                                    action="{{ url('temporary/post-ordinary') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">Ordinary
                                                                                        Secondary Education<small><i
                                                                                                style="color:red;">Certified
                                                                                                copy .pdf format</i></small>
                                                                                    </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="ordinary_secondary_education"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif


                                                   <!-- Advanced Education Certificate-->
                                                    @if (!empty($attach_move->advanced_certificate))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="advanced_certificate" method="POST"
                                                                    action="{{ url('temporary/delete-advanced', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div8">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#advanced_certificate{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->advanced_certificate }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->advanced_certificate }}"
                                                                                        data-file="{{ $attach_move->advanced_certificate }}"
                                                                                        data-target="#advanced_certificate{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Advanced Certificate Education
                                                                                                @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button8"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="advanced_certificate{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Advanced Certificate Education
                                                                                        </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->advanced_certificate) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row" >
                                                            <div class="col-sm-9">
                                                                <form class="advanced_certificate" method="POST"
                                                                    action="{{ url('temporary/post-advanced') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">
                                                                                        Advanced Certificate  Education<small><i
                                                                                                style="color:red;">Certified
                                                                                                copy .pdf format</i></small>
                                                                                    </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="advanced_certificate"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                  <!-- Bachelor Education Certificate-->
                                                    @if (!empty($attach_move->bachelor_degree))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="bachelor_degree" method="POST"
                                                                    action="{{ url('temporary/delete-bachelor', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div9">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#bachelor_degree{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->bachelor_degree }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->bachelor_degree }}"
                                                                                        data-file="{{ $attach_move->bachelor_degree }}"
                                                                                        data-target="#bachelor_degree{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Bachelor Laws Degree Certificate
                                                                                                @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button9"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="bachelor_degree{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Bachelor Laws Degree Certificate
                                                                                        </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->bachelor_degree) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row" >
                                                            <div class="col-sm-9">
                                                                <form class="bachelor_degree" method="POST"
                                                                    action="{{ url('temporary/post-bachelor') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">
                                                                                        Bachelor Laws Degree Certificate<small><i
                                                                                                style="color:red;">Certified
                                                                                                copy .pdf format</i></small>
                                                                                    </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="bachelor_degree"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif


                                          <!-- Work Permit-->
                                                    @if (!empty($attach_move->work_permit))
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <form class="work_permit" method="POST"
                                                                    action="{{ url('temporary/delete-work', $attach_move->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group div10">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9">
                                                                                    <a href="#work_permit{{ $attach_move->id }}"
                                                                                        title="{{ $attach_move->work_permit }}"
                                                                                        data-toggle="modal"
                                                                                        data-id="{{ $attach_move->id }}"
                                                                                        data-name="{{ $attach_move->work_permit }}"
                                                                                        data-file="{{ $attach_move->work_permit }}"
                                                                                        data-target="#work_permit{{ $attach_move->id }}">
                                                                                        <span>
                                                                                            <p><i style="color:red"
                                                                                                    class="fas fa-file-pdf fa-lg"></i>
                                                                                                - Work Permit
                                                                                                @if ($petition_form->attachment == 1)
                                                                                                    - <span
                                                                                                        style="color:DeepSkyBlue;">&#10003;</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    @if ($petition_form->attachment == 0 || $petition_form->attachment == 1)
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger button10"><i
                                                                                                class="ik ik-trash-2"></i>Remove</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <!-- View pdf modal-->
                                                                    <div class="modal fade"
                                                                        id="work_permit{{ $attach_move->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="demoModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="demoModalLabel">Work Permit
                                                                                        </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close"><span
                                                                                            aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed
                                                                                        src="{{ asset('public/images/files/' . $attach_move->work_permit) }}#toolbar=0"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="500px" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row" >
                                                            <div class="col-sm-9">
                                                                <form class="work_permit" method="POST"
                                                                    action="{{ url('temporary/post-work') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 col-md-12 col-xl-12"
                                                                                    style="margin-top:0px;">
                                                                                    <h4 class="sub-title">
                                                                                        Work Permit<small><i
                                                                                                style="color:red;">Certified
                                                                                                copy .pdf format</i></small>
                                                                                    </h4>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9">
                                                                                            <input type="file"
                                                                                                name="work_permit"
                                                                                                accept=".pdf" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-info"><i
                                                                                                    class="ik ik-share"></i>Upload</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Submit Attachements -->
                                                    @if ($petition_form->attachment == 0)
                                                        <form class="submit" method="POST"
                                                            action="{{ url('temporary/post-attachments') }}">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger mr-2">Submit
                                                                All</button>
                                                        </form>
                                                    @endif

                                                    @if($petition_form->attachment == 1)
                                                    <button class="btn btn-default">Cancel</button>
                                                 <a href="{{ url('temporary/complete') }}" class="btn btn-primary">Next</a>
                                                    @endif
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
