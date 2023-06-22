@extends('mgt-static')

@section('title')
    @parent
    | Group Permission
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
                                <h5>Group Permission</h5>
                                <span>User Management</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">User Roles</li>
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
            <form class="forms-sample" method="POST" action="{{ url('user-management/role/setPermission') }}">
                {{ csrf_field() }}
                <div class="card-body">
                    <input type="hidden" name="role_id" value="{{ $lims_role_data->id }}" />
                    <div class="table-responsive">
                        <table class="table table-bordered permission-table">
                            <thead>
                                <tr>
                                    <th colspan="5" class="text-center">{{ $lims_role_data->name }}-
                                        Group Permissions</th>
                                </tr>
                                {{-- <tr>
                                    <th colspan="8" class="text-center">
                                        <div class="checkbox">
                                            <input type="checkbox" id="select_all">
                                            <label for="select_all">Permissions</label>
                                        </div>
                                    </th>
                                </tr> --}}

                                <tr>
                                    <td>ADVOCATE PROFILE</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_PROFILE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_PROFILE"
                                                            name="ROLE_MANAGE_PROFILE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_PROFILE"
                                                            name="ROLE_MANAGE_PROFILE">
                                                    @endif
                                                    <label for="ROLE_MANAGE_PROFILE" class="padding05">Can View Profile
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_PROFILE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_PROFILE"
                                                            name="ROLE_CREATE_PROFILE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_PROFILE"
                                                            name="ROLE_CREATE_PROFILE">
                                                    @endif
                                                    <label for="ROLE_CREATE_PROFILE" class="padding05">Can Add Profile
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_PROFILE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_PROFILE"
                                                            name="ROLE_UPDATE_PROFILE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_PROFILE"
                                                            name="ROLE_UPDATE_PROFILE">
                                                    @endif
                                                    <label for="ROLE_UPDATE_PROFILE" class="padding05">Can Edit Profile
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_PROFILE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_PROFILE"
                                                            name="ROLE_DELETE_PROFILE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_PROFILE"
                                                            name="ROLE_DELETE_PROFILE">
                                                    @endif
                                                    <label for="ROLE_DELETE_PROFILE" class="padding05">Can Delete Profile
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_PROFILE_DETAILS', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_PROFILE"
                                                            name="ROLE_DELETE_PROFILE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_PROFILE"
                                                            name="ROLE_DELETE_PROFILE">
                                                    @endif
                                                    <label for="ROLE_DELETE_PROFILE" class="padding05">Can View Profile
                                                        Details
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_PROFILE_DETAILS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_PROFILE_DETAILS"
                                                            name="ROLE_VIEW_PROFILE_DETAILS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_PROFILE_DETAILS"
                                                            name="ROLE_VIEW_PROFILE_DETAILS">
                                                    @endif
                                                    <label for="ROLE_VIEW_PROFILE_DETAILS" class="padding05">Can View
                                                        Profile Details
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_ADVOCATE_STATUS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_ADVOCATE_STATUS"
                                                            name="ROLE_UPDATE_ADVOCATE_STATUS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_ADVOCATE_STATUS"
                                                            name="ROLE_UPDATE_ADVOCATE_STATUS">
                                                    @endif
                                                    <label for="ROLE_UPDATE_ADVOCATE_STATUS" class="padding05">Can Update
                                                        Advocate Status
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_ADVOCATE_STATUS_CHANGE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_ADVOCATE_STATUS_CHANGE"
                                                            name="ROLE_VIEW_ADVOCATE_STATUS_CHANGE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_ADVOCATE_STATUS_CHANGE"
                                                            name="ROLE_VIEW_ADVOCATE_STATUS_CHANGE">
                                                    @endif
                                                    <label for="ROLE_VIEW_ADVOCATE_STATUS_CHANGE" class="padding05">Can
                                                        View Advocate Status Change
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>

                                <tr>
                                    <td>APPLICATION</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_SEND_RECONCILIATION_REQUEST', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PETITION_APPLICATION"
                                                            name="ROLE_CREATE_PETITION_APPLICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PETITION_APPLICATION"
                                                            name="ROLE_CREATE_PETITION_APPLICATION">
                                                    @endif
                                                    <label for="ROLE_CREATE_PETITION_APPLICATION" class="padding05">Can
                                                        Apply For Petition
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_APPROVE_APPLICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_APPROVE_APPLICATION" name="ROLE_APPROVE_APPLICATION"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_APPROVE_APPLICATION" name="ROLE_APPROVE_APPLICATION">
                                                    @endif
                                                    <label for="ROLE_APPROVE_APPLICATION" class="padding05">Can Approve
                                                        Petition Application
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_APPLICATION_BY_ACTION_USER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_APPLICATION_BY_ACTION_USER"
                                                            name="ROLE_VIEW_APPLICATION_BY_ACTION_USER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_APPLICATION_BY_ACTION_USER"
                                                            name="ROLE_VIEW_APPLICATION_BY_ACTION_USER">
                                                    @endif
                                                    <label for="ROLE_VIEW_APPLICATION_BY_ACTION_USER"
                                                        class="padding05">Can View And Approve Applications
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_USER_APPLICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_USER_APPLICATION"
                                                            name="ROLE_VIEW_USER_APPLICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_USER_APPLICATION"
                                                            name="ROLE_VIEW_USER_APPLICATION">
                                                    @endif
                                                    <label for="ROLE_VIEW_USER_APPLICATION" class="padding05">Applicant
                                                        Can View Applications
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_RECONCILIATION_BATCH', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_RECONCILIATION_BATCH"
                                                            name="ROLE_DELETE_RECONCILIATION_BATCH" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_RECONCILIATION_BATCH"
                                                            name="ROLE_DELETE_RECONCILIATION_BATCH">
                                                    @endif
                                                    <label for="ROLE_DELETE_RECONCILIATION_BATCH" class="padding05">Can
                                                        Delete Reconcillation Batch
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_REQUEST_CONTROL_NUMBER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_REQUEST_CONTROL_NUMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_REQUEST_CONTROL_NUMBER">
                                                    @endif
                                                    <label for="ROLE_REQUEST_CONTROL_NUMBER" class="padding05">Can Request
                                                        Control Number
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_RE_REQUEST_CONTROL_NUMBER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_RE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_RE_REQUEST_CONTROL_NUMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_RE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_RE_REQUEST_CONTROL_NUMBER">
                                                    @endif
                                                    <label for="ROLE_RE_REQUEST_CONTROL_NUMBER" class="padding05">Can Re
                                                        Request Control Number
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_ALL_BILL', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ALL_BILL"
                                                            name="ROLE_VIEW_ALL_BILL" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ALL_BILL"
                                                            name="ROLE_VIEW_ALL_BILL">
                                                    @endif
                                                    <label for="ROLE_VIEW_ALL_BILL" class="padding05">Can View All Bills
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_APPLICANT_BILL', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_APPLICANT_BILL" name="ROLE_VIEW_APPLICANT_BILL"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_APPLICANT_BILL" name="ROLE_VIEW_APPLICANT_BILL">
                                                    @endif
                                                    <label for="ROLE_VIEW_APPLICANT_BILL" class="padding05">Can View
                                                        Applicant Bills
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CHANGE_PETITION_ADMIT_AS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CHANGE_PETITION_ADMIT_AS"
                                                            name="ROLE_CHANGE_PETITION_ADMIT_AS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CHANGE_PETITION_ADMIT_AS"
                                                            name="ROLE_CHANGE_PETITION_ADMIT_AS">
                                                    @endif
                                                    <label for="ROLE_CHANGE_PETITION_ADMIT_AS" class="padding05">Can
                                                        Petitioner Admit As
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_ADVOCATE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ADVOCATE"
                                                            name="ROLE_VIEW_ADVOCATE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ADVOCATE"
                                                            name="ROLE_VIEW_ADVOCATE">
                                                    @endif
                                                    <label for="ROLE_VIEW_ADVOCATE" class="padding05">Can View Advocate
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CHOOSE_VENUE_APPEARANCE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CHOOSE_VENUE_APPEARANCE"
                                                            name="ROLE_CHOOSE_VENUE_APPEARANCE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CHOOSE_VENUE_APPEARANCE"
                                                            name="ROLE_CHOOSE_VENUE_APPEARANCE">
                                                    @endif
                                                    <label for="ROLE_CHOOSE_VENUE_APPEARANCE" class="padding05">Can Choose
                                                        Appearance Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_BAR_EXAM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_BAR_EXAM"
                                                            name="ROLE_CREATE_BAR_EXAM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_BAR_EXAM"
                                                            name="ROLE_CREATE_BAR_EXAM">
                                                    @endif
                                                    <label for="ROLE_CREATE_BAR_EXAM" class="padding05">Can Create Bar
                                                        Exam
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_BAR_EXAM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_BAR_EXAM"
                                                            name="ROLE_UPDATE_BAR_EXAM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_BAR_EXAM"
                                                            name="ROLE_UPDATE_BAR_EXAM">
                                                    @endif
                                                    <label for="ROLE_UPDATE_BAR_EXAM" class="padding05">Can Update Bar
                                                        Exam
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_CJ_INTERVIEW_PETITIONER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_CJ_INTERVIEW_PETITIONER"
                                                            name="ROLE_VIEW_CJ_INTERVIEW_PETITIONER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_CJ_INTERVIEW_PETITIONER"
                                                            name="ROLE_VIEW_CJ_INTERVIEW_PETITIONER">
                                                    @endif
                                                    <label for="ROLE_VIEW_CJ_INTERVIEW_PETITIONER" class="padding05">Can
                                                        View CJ Interview Petitioners
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_PENDING_ADMISSION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_PENDING_ADMISSION"
                                                            name="ROLE_VIEW_PENDING_ADMISSION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_PENDING_ADMISSION"
                                                            name="ROLE_VIEW_PENDING_ADMISSION">
                                                    @endif
                                                    <label for="ROLE_VIEW_PENDING_ADMISSION" class="padding05">Can View
                                                        Pending Admission
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_RESUBMIT_APPLICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_RESUBMIT_APPLICATION"
                                                            name="ROLE_RESUBMIT_APPLICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_RESUBMIT_APPLICATION"
                                                            name="ROLE_RESUBMIT_APPLICATION">
                                                    @endif
                                                    <label for="ROLE_RESUBMIT_APPLICATION" class="padding05">Can Resubmit
                                                        Permit Application
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>

                                <tr>
                                    <td>ATTACHMENT TYPE</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_ATTACHMENT_TYPE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_ATTACHMENT_TYPE"
                                                            name="ROLE_MANAGE_ATTACHMENT_TYPE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_ATTACHMENT_TYPE"
                                                            name="ROLE_MANAGE_ATTACHMENT_TYPE">
                                                    @endif
                                                    <label for="ROLE_MANAGE_ATTACHMENT_TYPE" class="padding05">Can Add
                                                        Attachment Type
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_ATTACHMENT_TYPE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_ATTACHMENT_TYPE"
                                                            name="ROLE_CREATE_ATTACHMENT_TYPE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_ATTACHMENT_TYPE"
                                                            name="ROLE_CREATE_ATTACHMENT_TYPE">
                                                    @endif
                                                    <label for="ROLE_CREATE_ATTACHMENT_TYPE" class="padding05">Can View
                                                        Attachment Type
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_ATTACHMENT_TYPE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_ATTACHMENT_TYPE"
                                                            name="ROLE_UPDATE_ATTACHMENT_TYPE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_ATTACHMENT_TYPE"
                                                            name="ROLE_UPDATE_ATTACHMENT_TYPE">
                                                    @endif
                                                    <label for="ROLE_UPDATE_ATTACHMENT_TYPE" class="padding05">Can Edit
                                                        Attachment Type
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_ATTACHMENT_TYPE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_ATTACHMENT_TYPE"
                                                            name="ROLE_DELETE_ATTACHMENT_TYPE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_ATTACHMENT_TYPE"
                                                            name="ROLE_DELETE_ATTACHMENT_TYPE">
                                                    @endif
                                                    <label for="ROLE_DELETE_ATTACHMENT_TYPE" class="padding05">Can Delete
                                                        Attachment Type
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>BILL</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_SEND_RECONCILIATION_REQUEST', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_SEND_RECONCILIATION_REQUEST"
                                                            name="ROLE_SEND_RECONCILIATION_REQUEST" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_SEND_RECONCILIATION_REQUEST"
                                                            name="ROLE_SEND_RECONCILIATION_REQUEST">
                                                    @endif
                                                    <label for="ROLE_SEND_RECONCILIATION_REQUEST" class="padding05">Can
                                                        Send Reconcillation Request
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CANCEL_BILL', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CANCEL_BILL"
                                                            name="ROLE_CANCEL_BILL" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CANCEL_BILL"
                                                            name="ROLE_CANCEL_BILL">
                                                    @endif
                                                    <label for="ROLE_CANCEL_BILL" class="padding05">Can Cancel Bill
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_REUSE_CONTROL_NUMBER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REUSE_CONTROL_NUMBER"
                                                            name="ROLE_REUSE_CONTROL_NUMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REUSE_CONTROL_NUMBER"
                                                            name="ROLE_REUSE_CONTROL_NUMBER">
                                                    @endif
                                                    <label for="ROLE_REUSE_CONTROL_NUMBER" class="padding05">Can Reuse
                                                        Control Number
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_BILL', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_BILL"
                                                            name="ROLE_MANAGE_BILL" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_BILL"
                                                            name="ROLE_MANAGE_BILL">
                                                    @endif
                                                    <label for="ROLE_MANAGE_BILL" class="padding05">Can View Bill
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_RECONCILIATION_BATCH', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_RECONCILIATION_BATCH"
                                                            name="ROLE_DELETE_RECONCILIATION_BATCH" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_RECONCILIATION_BATCH"
                                                            name="ROLE_DELETE_RECONCILIATION_BATCH">
                                                    @endif
                                                    <label for="ROLE_DELETE_RECONCILIATION_BATCH" class="padding05">Can
                                                        Delete Reconcillation Batch
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_REQUEST_CONTROL_NUMBER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_REQUEST_CONTROL_NUMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_REQUEST_CONTROL_NUMBER">
                                                    @endif
                                                    <label for="ROLE_REQUEST_CONTROL_NUMBER" class="padding05">Can Request
                                                        Control Number
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_RE_REQUEST_CONTROL_NUMBER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_RE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_RE_REQUEST_CONTROL_NUMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_RE_REQUEST_CONTROL_NUMBER"
                                                            name="ROLE_RE_REQUEST_CONTROL_NUMBER">
                                                    @endif
                                                    <label for="ROLE_RE_REQUEST_CONTROL_NUMBER" class="padding05">Can Re
                                                        Request Control Number
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_ALL_BILL', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ALL_BILL"
                                                            name="ROLE_VIEW_ALL_BILL" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ALL_BILL"
                                                            name="ROLE_VIEW_ALL_BILL">
                                                    @endif
                                                    <label for="ROLE_VIEW_ALL_BILL" class="padding05">Can View All Bills
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_APPLICANT_BILL', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_APPLICANT_BILL" name="ROLE_VIEW_APPLICANT_BILL"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_APPLICANT_BILL" name="ROLE_VIEW_APPLICANT_BILL">
                                                    @endif
                                                    <label for="ROLE_VIEW_APPLICANT_BILL" class="padding05">Can View
                                                        Applicant Bills
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_ALL_PAYMENT', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ALL_PAYMENT"
                                                            name="ROLE_VIEW_ALL_PAYMENT" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_ALL_PAYMENT"
                                                            name="ROLE_VIEW_ALL_PAYMENT">
                                                    @endif
                                                    <label for="ROLE_VIEW_ALL_PAYMENT" class="padding05">Can View All
                                                        Payment
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CHANGE_BILL', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CHANGE_BILL"
                                                            name="ROLE_CHANGE_BILL" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CHANGE_BILL"
                                                            name="ROLE_CHANGE_BILL">
                                                    @endif
                                                    <label for="ROLE_CHANGE_BILL" class="padding05">Can Extend Bill
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_RECONCILIATION_BATCH', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_RECONCILIATION_BATCH"
                                                            name="ROLE_VIEW_RECONCILIATION_BATCH" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_RECONCILIATION_BATCH"
                                                            name="ROLE_VIEW_RECONCILIATION_BATCH">
                                                    @endif
                                                    <label for="ROLE_VIEW_RECONCILIATION_BATCH" class="padding05">Can View
                                                        Reconcilation Batch
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>CLE MEMBER</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_CLE_MEMBER', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_CLE_MEMBER"
                                                            name="ROLE_VIEW_CLE_MEMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_CLE_MEMBER"
                                                            name="ROLE_VIEW_CLE_MEMBER">
                                                    @endif
                                                    <label for="ROLE_VIEW_CLE_MEMBER" class="padding05">Can View CLE
                                                        Member
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_CLE_MEMBER', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_CLE_MEMBER"
                                                            name="ROLE_UPDATE_CLE_MEMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_CLE_MEMBER"
                                                            name="ROLE_UPDATE_CLE_MEMBER">
                                                    @endif
                                                    <label for="ROLE_UPDATE_CLE_MEMBER" class="padding05">Can Update CLE
                                                        Member
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_CLE_CORAM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_CLE_CORAM"
                                                            name="ROLE_VIEW_CLE_CORAM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_CLE_CORAM"
                                                            name="ROLE_VIEW_CLE_CORAM">
                                                    @endif
                                                    <label for="ROLE_VIEW_CLE_CORAM" class="padding05">Can Update CLE
                                                        Coram
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>COUNTRY</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_COUNTRY', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_COUNTRY"
                                                            name="ROLE_MANAGE_COUNTRY" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_COUNTRY"
                                                            name="ROLE_MANAGE_COUNTRY">
                                                    @endif
                                                    <label for="ROLE_MANAGE_COUNTRY" class="padding05">Can View Country

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>DISTRICT</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_DISTRICT', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_DISTRICT"
                                                            name="ROLE_MANAGE_DISTRICT" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_DISTRICT"
                                                            name="ROLE_MANAGE_DISTRICT">
                                                    @endif
                                                    <label for="ROLE_MANAGE_DISTRICT" class="padding05">Can View District
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_DISTRICT', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_DISTRICT"
                                                            name="ROLE_CREATE_DISTRICT" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_DISTRICT"
                                                            name="ROLE_CREATE_DISTRICT">
                                                    @endif
                                                    <label for="ROLE_CREATE_DISTRICT" class="padding05">Can Add District
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_DISTRICT', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_DISTRICT"
                                                            name="ROLE_UPDATE_DISTRICT" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_DISTRICT"
                                                            name="ROLE_UPDATE_DISTRICT">
                                                    @endif
                                                    <label for="ROLE_UPDATE_DISTRICT" class="padding05">Can Edit District
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_DISTRICT', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_DISTRICT"
                                                            name="ROLE_DELETE_DISTRICT" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_DISTRICT"
                                                            name="ROLE_DELETE_DISTRICT">
                                                    @endif
                                                    <label for="ROLE_DELETE_DISTRICT" class="padding05">Can Delete
                                                        District
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>EXCHANGE RATE</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_EXCHANGE_RATE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_EXCHANGE_RATE"
                                                            name="ROLE_MANAGE_EXCHANGE_RATE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_EXCHANGE_RATE"
                                                            name="ROLE_MANAGE_EXCHANGE_RATE">
                                                    @endif
                                                    <label for="ROLE_MANAGE_EXCHANGE_RATE" class="padding05">Can View
                                                        Exchange Rate
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_EXCHANGE_RATE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_EXCHANGE_RATE"
                                                            name="ROLE_CREATE_EXCHANGE_RATE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_EXCHANGE_RATE"
                                                            name="ROLE_CREATE_EXCHANGE_RATE">
                                                    @endif
                                                    <label for="ROLE_CREATE_EXCHANGE_RATE" class="padding05">Can Add
                                                        Exchange Rate
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_EXCHANGE_RATE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_EXCHANGE_RATE"
                                                            name="ROLE_UPDATE_EXCHANGE_RATE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_EXCHANGE_RATE"
                                                            name="ROLE_UPDATE_EXCHANGE_RATE">
                                                    @endif
                                                    <label for="ROLE_UPDATE_EXCHANGE_RATE" class="padding05">Can Edit
                                                        Exchange Rate
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_EXCHANGE_RATE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_EXCHANGE_RATE"
                                                            name="ROLE_DELETE_EXCHANGE_RATE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_EXCHANGE_RATE"
                                                            name="ROLE_DELETE_EXCHANGE_RATE">
                                                    @endif
                                                    <label for="ROLE_DELETE_EXCHANGE_RATE" class="padding05">Can Delete
                                                        Exchange Rate
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>FEE</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_FEE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_FEE"
                                                            name="ROLE_MANAGE_FEE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_FEE"
                                                            name="ROLE_MANAGE_FEE">
                                                    @endif
                                                    <label for="ROLE_MANAGE_FEE" class="padding05">Can View Fee
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_FEE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_FEE"
                                                            name="ROLE_CREATE_FEE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_FEE"
                                                            name="ROLE_CREATE_FEE">
                                                    @endif
                                                    <label for="ROLE_CREATE_FEE" class="padding05">Can Add Fee

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_FEE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_FEE"
                                                            name="ROLE_UPDATE_FEE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_FEE"
                                                            name="ROLE_UPDATE_FEE">
                                                    @endif
                                                    <label for="ROLE_UPDATE_FEE" class="padding05">Can Edit Fee

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_FEE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_FEE"
                                                            name="ROLE_DELETE_FEE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_FEE"
                                                            name="ROLE_DELETE_FEE">
                                                    @endif
                                                    <label for="ROLE_DELETE_FEE" class="padding05">Can Delete Fee
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>FIRM</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_FIRM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_FIRM"
                                                            name="ROLE_MANAGE_FIRM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_FIRM"
                                                            name="ROLE_MANAGE_FIRM">
                                                    @endif
                                                    <label for="ROLE_MANAGE_FIRM" class="padding05">Can View Firm
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_FIRM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_FIRM"
                                                            name="ROLE_CREATE_FIRM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_FIRM"
                                                            name="ROLE_CREATE_FIRM">
                                                    @endif
                                                    <label for="ROLE_CREATE_FIRM" class="padding05">Can Add Firm

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_APPROVE_FIRM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_APPROVE_FIRM"
                                                            name="ROLE_APPROVE_FIRM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_APPROVE_FIRM"
                                                            name="ROLE_APPROVE_FIRM">
                                                    @endif
                                                    <label for="ROLE_APPROVE_FIRM" class="padding05">Can Approve Firm

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_APPLY_FIRM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_APPLY_FIRM"
                                                            name="ROLE_APPLY_FIRM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_APPLY_FIRM"
                                                            name="ROLE_APPLY_FIRM">
                                                    @endif
                                                    <label for="ROLE_APPLY_FIRM" class="padding05">Can Apply Firm
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CONFIRM_FIRM', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CONFIRM_FIRM"
                                                            name="ROLE_CONFIRM_FIRM" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CONFIRM_FIRM"
                                                            name="ROLE_CONFIRM_FIRM">
                                                    @endif
                                                    <label for="ROLE_CONFIRM_FIRM" class="padding05">Can Confirm Firm
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>LEGAL PROFESSIONAL</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_LEGAL_VIEW', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_LEGAL_VIEW"
                                                            name="ROLE_CREATE_LEGAL_VIEW" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_LEGAL_VIEW"
                                                            name="ROLE_CREATE_LEGAL_VIEW">
                                                    @endif
                                                    <label for="ROLE_CREATE_LEGAL_VIEW" class="padding05">Can Create Legal
                                                        Professional View
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_LEGAL_VIEW', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_LEGAL_VIEW"
                                                            name="ROLE_VIEW_LEGAL_VIEW" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_VIEW_LEGAL_VIEW"
                                                            name="ROLE_VIEW_LEGAL_VIEW">
                                                    @endif
                                                    <label for="ROLE_VIEW_LEGAL_VIEW" class="padding05">Can View Legal
                                                        Professional View

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER"
                                                            name="ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER"
                                                            name="ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER">
                                                    @endif
                                                    <label for="ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER" class="padding05">Can
                                                        View Legal Professional View By Action User

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_LEGAL_VIEW_PETITIONER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_LEGAL_VIEW_PETITIONER"
                                                            name="ROLE_LEGAL_VIEW_PETITIONER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_LEGAL_VIEW_PETITIONER"
                                                            name="ROLE_LEGAL_VIEW_PETITIONER">
                                                    @endif
                                                    <label for="ROLE_LEGAL_VIEW_PETITIONER" class="padding05">Can View
                                                        Pending Admission List
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_APPROVE_LEGAL_VIEW', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_APPROVE_LEGAL_VIEW" name="ROLE_APPROVE_LEGAL_VIEW"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_APPROVE_LEGAL_VIEW" name="ROLE_APPROVE_LEGAL_VIEW">
                                                    @endif
                                                    <label for="ROLE_APPROVE_LEGAL_VIEW" class="padding05">Can Approve
                                                        Legal Professional View
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>PETITION EDUCATION</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_PETITION_EDUCATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_PETITION_EDUCATION"
                                                            name="ROLE_MANAGE_PETITION_EDUCATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_PETITION_EDUCATION"
                                                            name="ROLE_MANAGE_PETITION_EDUCATION">
                                                    @endif
                                                    <label for="ROLE_MANAGE_PETITION_EDUCATION" class="padding05">Can Add
                                                        Petition Education
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_PETITION_EDUCATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PETITION_EDUCATION"
                                                            name="ROLE_CREATE_PETITION_EDUCATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PETITION_EDUCATION"
                                                            name="ROLE_CREATE_PETITION_EDUCATION">
                                                    @endif
                                                    <label for="ROLE_CREATE_PETITION_EDUCATION" class="padding05">Can View
                                                        Petition Education

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_PETITION_EDUCATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_PETITION_EDUCATION"
                                                            name="ROLE_UPDATE_PETITION_EDUCATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_PETITION_EDUCATION"
                                                            name="ROLE_UPDATE_PETITION_EDUCATION">
                                                    @endif
                                                    <label for="ROLE_UPDATE_PETITION_EDUCATION" class="padding05">Can
                                                        Can Edit Petition Education
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PROFILE ADDRESS</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_PROFILE_ADDRESS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_PROFILE_ADDRESS"
                                                            name="ROLE_MANAGE_PROFILE_ADDRESS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_PROFILE_ADDRESS"
                                                            name="ROLE_MANAGE_PROFILE_ADDRESS">
                                                    @endif
                                                    <label for="ROLE_MANAGE_PROFILE_ADDRESS" class="padding05">Can View
                                                        Profile Address
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_PROFILE_ADDRESS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PROFILE_ADDRESS"
                                                            name="ROLE_CREATE_PROFILE_ADDRESS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PROFILE_ADDRESS"
                                                            name="ROLE_CREATE_PROFILE_ADDRESS">
                                                    @endif
                                                    <label for="ROLE_CREATE_PROFILE_ADDRESS" class="padding05">Can Add
                                                        Profile Address

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_PROFILE_ADDRESS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_PROFILE_ADDRESS"
                                                            name="ROLE_UPDATE_PROFILE_ADDRESS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_PROFILE_ADDRESS"
                                                            name="ROLE_UPDATE_PROFILE_ADDRESS">
                                                    @endif
                                                    <label for="ROLE_UPDATE_PROFILE_ADDRESS" class="padding05">Can Edit
                                                        Profile Address

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_PROFILE_ADDRESS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_PROFILE_ADDRESS"
                                                            name="ROLE_DELETE_PROFILE_ADDRESS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_PROFILE_ADDRESS"
                                                            name="ROLE_DELETE_PROFILE_ADDRESS">
                                                    @endif
                                                    <label for="ROLE_DELETE_PROFILE_ADDRESS" class="padding05">Can
                                                        Delete Profile Address

                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PROFILE CONTACT</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_PROFILE_CONTACT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_PROFILE_CONTACT"
                                                            name="ROLE_MANAGE_PROFILE_CONTACT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_PROFILE_CONTACT"
                                                            name="ROLE_MANAGE_PROFILE_CONTACT">
                                                    @endif
                                                    <label for="ROLE_MANAGE_PROFILE_CONTACT" class="padding05">Can View
                                                        Profile Contact
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_PROFILE_CONTACT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PROFILE_CONTACT"
                                                            name="ROLE_CREATE_PROFILE_CONTACT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_PROFILE_CONTACT"
                                                            name="ROLE_CREATE_PROFILE_CONTACT">
                                                    @endif
                                                    <label for="ROLE_CREATE_PROFILE_CONTACT" class="padding05">Can Add
                                                        Profile Contact
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_PROFILE_CONTACT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_PROFILE_CONTACT"
                                                            name="ROLE_UPDATE_PROFILE_CONTACT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_PROFILE_CONTACT"
                                                            name="ROLE_UPDATE_PROFILE_CONTACT">
                                                    @endif
                                                    <label for="ROLE_UPDATE_PROFILE_CONTACT" class="padding05">Can Edit
                                                        Profile Contact
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_PROFILE_CONTACT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_PROFILE_CONTACT"
                                                            name="ROLE_DELETE_PROFILE_CONTACT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_PROFILE_CONTACT"
                                                            name="ROLE_DELETE_PROFILE_CONTACT">
                                                    @endif
                                                    <label for="ROLE_DELETE_PROFILE_CONTACT" class="padding05">Can
                                                        Delete Profile Contact
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>QUALIFICATIN</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_QUALIFICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_QUALIFICATION"
                                                            name="ROLE_MANAGE_QUALIFICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_QUALIFICATION"
                                                            name="ROLE_MANAGE_QUALIFICATION">
                                                    @endif
                                                    <label for="ROLE_MANAGE_QUALIFICATION" class="padding05">Can Add
                                                        Qualification
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_QUALIFICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_QUALIFICATION"
                                                            name="ROLE_CREATE_QUALIFICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_QUALIFICATION"
                                                            name="ROLE_CREATE_QUALIFICATION">
                                                    @endif
                                                    <label for="ROLE_CREATE_QUALIFICATION" class="padding05">Can View
                                                        Qualification
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_QUALIFICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_QUALIFICATION"
                                                            name="ROLE_UPDATE_QUALIFICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_QUALIFICATION"
                                                            name="ROLE_UPDATE_QUALIFICATION">
                                                    @endif
                                                    <label for="ROLE_UPDATE_QUALIFICATION" class="padding05">Can Edit
                                                        Qualification
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_QUALIFICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_QUALIFICATION"
                                                            name="ROLE_DELETE_QUALIFICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_DELETE_QUALIFICATION"
                                                            name="ROLE_DELETE_QUALIFICATION">
                                                    @endif
                                                    <label for="ROLE_DELETE_QUALIFICATION" class="padding05">Can Delete
                                                        Qualification
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ASSIGN_QUALIFICATION_ATTACHMENT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ASSIGN_QUALIFICATION_ATTACHMENT"
                                                            name="ROLE_ASSIGN_QUALIFICATION_ATTACHMENT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ASSIGN_QUALIFICATION_ATTACHMENT"
                                                            name="ROLE_ASSIGN_QUALIFICATION_ATTACHMENT">
                                                    @endif
                                                    <label for="ROLE_ASSIGN_QUALIFICATION_ATTACHMENT"
                                                        class="padding05">Can Assign Attachment to Qualification
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_USER_QUALIFICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_USER_QUALIFICATION"
                                                            name="ROLE_CREATE_USER_QUALIFICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_USER_QUALIFICATION"
                                                            name="ROLE_CREATE_USER_QUALIFICATION">
                                                    @endif
                                                    <label for="ROLE_CREATE_USER_QUALIFICATION" class="padding05">Can
                                                        Add User Qualification
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_USER_QUALIFICATION', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_USER_QUALIFICATION"
                                                            name="ROLE_VIEW_USER_QUALIFICATION" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_USER_QUALIFICATION"
                                                            name="ROLE_VIEW_USER_QUALIFICATION">
                                                    @endif
                                                    <label for="ROLE_VIEW_USER_QUALIFICATION" class="padding05">Can View
                                                        User Qualification
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>REGION</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_REGION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_REGION"
                                                            name="ROLE_MANAGE_REGION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_REGION"
                                                            name="ROLE_MANAGE_REGION">
                                                    @endif
                                                    <label for="ROLE_MANAGE_REGION" class="padding05">Can View Region
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_REGION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_REGION"
                                                            name="ROLE_CREATE_REGION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_REGION"
                                                            name="ROLE_CREATE_REGION">
                                                    @endif
                                                    <label for="ROLE_CREATE_REGION" class="padding05">Can Add Region
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_REGION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_REGION"
                                                            name="ROLE_UPDATE_REGION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_REGION"
                                                            name="ROLE_UPDATE_REGION">
                                                    @endif
                                                    <label for="ROLE_UPDATE_REGION" class="padding05">Can Edit Region
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_REGION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_REGION"
                                                            name="ROLE_DELETE_REGION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_REGION"
                                                            name="ROLE_DELETE_REGION">
                                                    @endif
                                                    <label for="ROLE_DELETE_REGION" class="padding05">Can Delete Region
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>RENEWAL BATCH</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_RENEWAL_BATCH', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_RENEWAL_BATCH" name="ROLE_VIEW_RENEWAL_BATCH"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_RENEWAL_BATCH" name="ROLE_VIEW_RENEWAL_BATCH">
                                                    @endif
                                                    <label for="ROLE_VIEW_RENEWAL_BATCH" class="padding05">Can View
                                                        Renewal Batch
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_RENEWAL_BATCH', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_RENEWAL_BATCH"
                                                            name="ROLE_CREATE_RENEWAL_BATCH" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_RENEWAL_BATCH"
                                                            name="ROLE_CREATE_RENEWAL_BATCH">
                                                    @endif
                                                    <label for="ROLE_CREATE_RENEWAL_BATCH" class="padding05">Can Create
                                                        Renewal Batch
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_RENEWAL_BATCH', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_RENEWAL_BATCH"
                                                            name="ROLE_UPDATE_RENEWAL_BATCH" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_RENEWAL_BATCH"
                                                            name="ROLE_UPDATE_RENEWAL_BATCH">
                                                    @endif
                                                    <label for="ROLE_UPDATE_RENEWAL_BATCH" class="padding05">Can Update
                                                        Renewal Batch
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>SESSION</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_SESSION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_SESSION"
                                                            name="ROLE_MANAGE_SESSION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_SESSION"
                                                            name="ROLE_MANAGE_SESSION">
                                                    @endif
                                                    <label for="ROLE_MANAGE_SESSION" class="padding05">Can View Session
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_SESSION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_SESSION"
                                                            name="ROLE_CREATE_SESSION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_SESSION"
                                                            name="ROLE_CREATE_SESSION">
                                                    @endif
                                                    <label for="ROLE_CREATE_SESSION" class="padding05">Can Add Session
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_SESSION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_SESSION"
                                                            name="ROLE_DELETE_SESSION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_SESSION"
                                                            name="ROLE_DELETE_SESSION">
                                                    @endif
                                                    <label for="ROLE_DELETE_SESSION" class="padding05">Can Delete
                                                        Session
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_SESSION', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_SESSION"
                                                            name="ROLE_UPDATE_SESSION" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_SESSION"
                                                            name="ROLE_UPDATE_SESSION">
                                                    @endif
                                                    <label for="ROLE_UPDATE_SESSION" class="padding05">Can Edit Session
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>SESSION MANAGEMENT</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_PRE_ASSIGN_ROLL_NUMBER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_PRE_ASSIGN_ROLL_NUMBER"
                                                            name="ROLE_PRE_ASSIGN_ROLL_NUMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_PRE_ASSIGN_ROLL_NUMBER"
                                                            name="ROLE_PRE_ASSIGN_ROLL_NUMBER">
                                                    @endif
                                                    <label for="ROLE_PRE_ASSIGN_ROLL_NUMBER" class="padding05">Can Pre
                                                        Assign Roll Number
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_REARRANGE_ROLL_NUMBER', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REARRANGE_ROLL_NUMBER"
                                                            name="ROLE_REARRANGE_ROLL_NUMBER" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_REARRANGE_ROLL_NUMBER"
                                                            name="ROLE_REARRANGE_ROLL_NUMBER">
                                                    @endif
                                                    <label for="ROLE_REARRANGE_ROLL_NUMBER" class="padding05">Can Re
                                                        arrange Roll Number
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>USER MANAGEMENT</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_USER_VIEW', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_USER_VIEW"
                                                            name="ROLE_USER_VIEW" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_USER_VIEW"
                                                            name="ROLE_USER_VIEW">
                                                    @endif
                                                    <label for="ROLE_USER_VIEW" class="padding05">Can View All Users
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_USER_STAFF_ADD', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_USER_STAFF_ADD"
                                                            name="ROLE_USER_STAFF_ADD" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_USER_STAFF_ADD"
                                                            name="ROLE_USER_STAFF_ADD">
                                                    @endif
                                                    <label for="ROLE_USER_STAFF_ADD" class="padding05">Can Add Staff
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_USER_STAFF_EDIT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_USER_STAFF_EDIT" name="ROLE_USER_STAFF_EDIT"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_USER_STAFF_EDIT" name="ROLE_USER_STAFF_EDIT">
                                                    @endif
                                                    <label for="ROLE_USER_STAFF_EDIT" class="padding05">Can Edit Staff
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_USER_STAFF_DELETE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_USER_STAFF_DELETE" name="ROLE_USER_STAFF_DELETE"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_USER_STAFF_DELETE" name="ROLE_USER_STAFF_DELETE">
                                                    @endif
                                                    <label for="ROLE_USER_STAFF_DELETE" class="padding05">Can Delete
                                                        Staff
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ACTION_USER_TYPES_VIEW', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ACTION_USER_TYPES_VIEW"
                                                            name="ROLE_ACTION_USER_TYPES_VIEW" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ACTION_USER_TYPES_VIEW"
                                                            name="ROLE_ACTION_USER_TYPES_VIEW">
                                                    @endif
                                                    <label for="ROLE_ACTION_USER_TYPES_VIEW" class="padding05">Can View
                                                        Action User Types
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ROLE_ADD', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_ADD"
                                                            name="ROLE_ROLE_ADD" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_ADD"
                                                            name="ROLE_ROLE_ADD">
                                                    @endif
                                                    <label for="ROLE_ROLE_ADD" class="padding05">Can Add Role
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ROLE_VIEW', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_VIEW"
                                                            name="ROLE_ROLE_VIEW" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_VIEW"
                                                            name="ROLE_ROLE_VIEW">
                                                    @endif
                                                    <label for="ROLE_ROLE_VIEW" class="padding05">Can View Roles
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ROLE_EDIT', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_EDIT"
                                                            name="ROLE_ROLE_EDIT" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_EDIT"
                                                            name="ROLE_ROLE_EDIT">
                                                    @endif
                                                    <label for="ROLE_ROLE_EDIT" class="padding05">Can Edit Role
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ROLE_DELETE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_DELETE"
                                                            name="ROLE_ROLE_DELETE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_ROLE_DELETE"
                                                            name="ROLE_ROLE_DELETE">
                                                    @endif
                                                    <label for="ROLE_ROLE_DELETE" class="padding05">Can Delete Role
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ROLE_ASSIGN_PERMISSIONS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ROLE_ASSIGN_PERMISSIONS"
                                                            name="ROLE_ROLE_ASSIGN_PERMISSIONS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ROLE_ASSIGN_PERMISSIONS"
                                                            name="ROLE_ROLE_ASSIGN_PERMISSIONS">
                                                    @endif
                                                    <label for="ROLE_ROLE_ASSIGN_PERMISSIONS" class="padding05">Can
                                                        Assign Permissions To Role
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>VENUE</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_VENUE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_VENUE"
                                                            name="ROLE_MANAGE_VENUE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_MANAGE_VENUE"
                                                            name="ROLE_MANAGE_VENUE">
                                                    @endif
                                                    <label for="ROLE_MANAGE_VENUE" class="padding05">Can View Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_VENUE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_VENUE"
                                                            name="ROLE_CREATE_VENUE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_CREATE_VENUE"
                                                            name="ROLE_CREATE_VENUE">
                                                    @endif
                                                    <label for="ROLE_CREATE_VENUE" class="padding05">Can Add Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_VENUE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_VENUE"
                                                            name="ROLE_UPDATE_VENUE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_UPDATE_VENUE"
                                                            name="ROLE_UPDATE_VENUE">
                                                    @endif
                                                    <label for="ROLE_UPDATE_VENUE" class="padding05">Can Edit Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>

                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_DELETE_VENUE', $all_permission))
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_VENUE"
                                                            name="ROLE_DELETE_VENUE" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="ROLE_DELETE_VENUE"
                                                            name="ROLE_DELETE_VENUE">
                                                    @endif
                                                    <label for="ROLE_DELETE_VENUE" class="padding05">Can Delete Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_APPEARANCE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_APPEARANCE" name="ROLE_CREATE_APPEARANCE"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_APPEARANCE" name="ROLE_CREATE_APPEARANCE">
                                                    @endif
                                                    <label for="ROLE_CREATE_APPEARANCE" class="padding05">Can Create
                                                        Appearance Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_APPEARANCE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_APPEARANCE" name="ROLE_MANAGE_APPEARANCE"
                                                            checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_APPEARANCE" name="ROLE_MANAGE_APPEARANCE">
                                                    @endif
                                                    <label for="ROLE_MANAGE_APPEARANCE" class="padding05">Can View
                                                        Appearance Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CAN_APPLY_FOR_VENUE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CAN_APPLY_FOR_VENUE"
                                                            name="ROLE_CAN_APPLY_FOR_VENUE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CAN_APPLY_FOR_VENUE"
                                                            name="ROLE_CAN_APPLY_FOR_VENUE">
                                                    @endif
                                                    <label for="ROLE_CAN_APPLY_FOR_VENUE" class="padding05">Can Apply
                                                        For Appearance Venue
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>WORK EXPERIENCE</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_WORKFLOW_PROCESS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_WORKFLOW_PROCESS"
                                                            name="ROLE_MANAGE_WORKFLOW_PROCESS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_WORKFLOW_PROCESS"
                                                            name="ROLE_MANAGE_WORKFLOW_PROCESS">
                                                    @endif
                                                    <label for="ROLE_MANAGE_WORKFLOW_PROCESS" class="padding05">Can Add
                                                        Work Experience
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_WORK_EXPERIENCE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_WORK_EXPERIENCE"
                                                            name="ROLE_CREATE_WORK_EXPERIENCE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_WORK_EXPERIENCE"
                                                            name="ROLE_CREATE_WORK_EXPERIENCE">
                                                    @endif
                                                    <label for="ROLE_CREATE_WORK_EXPERIENCE" class="padding05">Can View
                                                        Work Experience
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_UPDATE_WORK_EXPERIENCE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_WORK_EXPERIENCE"
                                                            name="ROLE_UPDATE_WORK_EXPERIENCE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_UPDATE_WORK_EXPERIENCE"
                                                            name="ROLE_UPDATE_WORK_EXPERIENCE">
                                                    @endif
                                                    <label for="ROLE_UPDATE_WORK_EXPERIENCE" class="padding05">Can Edit
                                                        Work Experience
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ASSIGN_WORKFLOW_ATTACHMENT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ASSIGN_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_ASSIGN_WORKFLOW_ATTACHMENT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ASSIGN_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_ASSIGN_WORKFLOW_ATTACHMENT">
                                                    @endif
                                                    <label for="ROLE_ASSIGN_WORKFLOW_ATTACHMENT" class="padding05">Can
                                                        Assign Workflow Attachment
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_WORKFLOW_ATTACHMENT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_VIEW_WORKFLOW_ATTACHMENT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_VIEW_WORKFLOW_ATTACHMENT">
                                                    @endif
                                                    <label for="ROLE_VIEW_WORKFLOW_ATTACHMENT" class="padding05">Can
                                                        View Workflow Attachment
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>WORKFLOW PROCESS</td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_WORKFLOW_PROCESS', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_WORKFLOW_PROCESS"
                                                            name="ROLE_MANAGE_WORKFLOW_PROCESS" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_WORKFLOW_PROCESS"
                                                            name="ROLE_MANAGE_WORKFLOW_PROCESS">
                                                    @endif
                                                    <label for="ROLE_MANAGE_WORKFLOW_PROCESS" class="padding05">Can View
                                                        Workflow Process
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_MANAGE_WORKFLOW_STAGE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_WORKFLOW_STAGE"
                                                            name="ROLE_MANAGE_WORKFLOW_STAGE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_MANAGE_WORKFLOW_STAGE"
                                                            name="ROLE_MANAGE_WORKFLOW_STAGE">
                                                    @endif
                                                    <label for="ROLE_MANAGE_WORKFLOW_STAGE" class="padding05">Can View
                                                        Workflow Stage
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_CREATE_WORKFLOW_STAGE', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_WORKFLOW_STAGE"
                                                            name="ROLE_CREATE_WORKFLOW_STAGE" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_CREATE_WORKFLOW_STAGE"
                                                            name="ROLE_CREATE_WORKFLOW_STAGE">
                                                    @endif
                                                    <label for="ROLE_CREATE_WORKFLOW_STAGE" class="padding05">Can Add
                                                        Workflow Stage
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_ASSIGN_WORKFLOW_ATTACHMENT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ASSIGN_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_ASSIGN_WORKFLOW_ATTACHMENT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_ASSIGN_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_ASSIGN_WORKFLOW_ATTACHMENT">
                                                    @endif
                                                    <label for="ROLE_ASSIGN_WORKFLOW_ATTACHMENT" class="padding05">Can
                                                        Assign Workflow Attachment
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if (in_array('ROLE_VIEW_WORKFLOW_ATTACHMENT', $all_permission))
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_VIEW_WORKFLOW_ATTACHMENT" checked>
                                                    @else
                                                        <input type="checkbox" value="1"
                                                            id="ROLE_VIEW_WORKFLOW_ATTACHMENT"
                                                            name="ROLE_VIEW_WORKFLOW_ATTACHMENT">
                                                    @endif
                                                    <label for="ROLE_VIEW_WORKFLOW_ATTACHMENT" class="padding05">Can
                                                        View Workflow Attachment
                                                        &nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
<script type="text/javascript">
    $("ul#setting").siblings('a').attr('aria-expanded', 'true');
    $("ul#setting").addClass("show");
    $("ul#setting #role-menu").addClass("active");

    $("#select_all").on("change", function() {
        if ($(this).is(':checked')) {
            $("tbody input[type='checkbox']").prop('checked', true);
        } else {
            $("tbody input[type='checkbox']").prop('checked', false);
        }
    });
</script>
