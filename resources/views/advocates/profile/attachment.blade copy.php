                @if (!empty($attach_move->profile_picture))
                <!-- Petition for Admission and Enrollment-->
                @if (!empty($attach_move->petition))
                <div class="row">
                    <div class="col-sm-9">
                        <form class="petition" method="POST" action="{{ url('petition/delete-petition') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group div2">
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <a href="#petition{{ $attach_move->id }}"
                                                title="{{ $attach_move->petition }}" data-toggle="modal"
                                                data-id="{{ $attach_move->id }}"
                                                data-name="{{ $attach_move->petition }}"
                                                data-file="{{ $attach_move->petition }}"
                                                data-target="#petition{{ $attach_move->id }}">
                                                <span>

                                                    <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i>
                                                        - Petition for Admission and
                                                        Enrollment @if ($petition_form->attachment == 1)
                                                        - <span style="color:DeepSkyBlue;">&#10003;</span>
                                                        @endif
                                                    </p>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-sm-3">
                                            @if ($petition_form->attachment == 0)
                                            <button type="submit" class="btn btn-danger button2"><i
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
                            <div class="modal fade" id="petition{{ $attach_move->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="demoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="demoModalLabel">Petition for
                                                Admission and Enrollment</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <embed
                                                src="{{ asset('public/images/files/' . $attach_move->petition) }}#toolbar=0"
                                                type="application/pdf" width="100%" height="500px" />
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
                        <form class="petition" method="POST" action="{{ url('petition/post-petition') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-30">

                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                            <h4 class="sub-title">Petition for
                                                Admission and Enrollment</h4>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="file" name="petition" accept=".pdf" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <button type="submit" class="btn btn-info"><i
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