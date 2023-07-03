<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Advocate\Advocate;
use App\Models\Advocate\NameChange;
use App\Models\Masterdata\AdvocateStatusChange;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationApproval;
use App\Models\Petitions\Firm;
use App\Models\Petitions\FirmAddress;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\Petition;
use App\Models\Petitions\PetitionEducation;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\WorkExperience;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PermitController extends Controller
{
    // application forn non practising
    public function get_practising_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT NON PRACTISING";
            $status = "Under Review";
            $resubmit = "RETURN";
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count();   
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();   

            return view('management.permit_application.non_practising.under_review.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_practising_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 2;
            $application_type = "PERMIT NON PRACTISING";
            $status = "Under Review";
            $resubmit = 'RETURN';

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 

             $approved_applications = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();    

            return view('management.permit_application.non_practising.rhc.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_practising_cj()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 4;
            $application_type = "PERMIT NON PRACTISING";
            $status = "Under Review";
            $resubmit = 'RETURN';
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
             $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();      
            return view('management.permit_application.non_practising.cj.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_practising_front(Request $request, $id)
    {

        if (Auth::check()) {

            $stage = Application::findOrFail($id);
            // dd($stage->id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();
            if ($stage->status == "RETURN") {
                $cj = DB::table('applications')
                    ->where('id', $id)
                    ->update([
                        'current_stage' => 1]);

                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->active = true;
                $comment->decision = "RETURN";
                $comment->action_user_type_id = 2;
                $comment->uid = $uuid;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 2]);
            }

            return Redirect::to("permit/non-practising/under-review")
                ->with('success', ' Application edited successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_practising_cj(Request $request, $id)
    {

        if (Auth::check()) {

            try {

                $stage = Application::findOrFail($id);
                $profile_id = Application::find($id)->profile_id;
                $previous_status = Advocate::where('profile_id', $profile_id)->first()->status;

                $uuid = Str::uuid();

                $this->validate($request, [
                    'status' => 'required',
                ]);

                $stage->status = $request->input('status');
                $stage->save();

                if ($stage->status == "ACCEPT") {
                    $currDate = Carbon::now()->format('Y-m-d');
                    $profile_id = Application::find($id)->profile_id;
                    $advocate = DB::table('advocates')
                        ->where('profile_id', $profile_id)
                        ->update(['status' => 'NON PRACTISING']);

                    $non_practising = new AdvocateStatusChange();
                    $non_practising->active = true;
                    $non_practising->description = "Application for Non Practising";
                    $non_practising->uid = $uuid;
                    $non_practising->start_date = $currDate;
                    $non_practising->end_date = $currDate;
                    $non_practising->previous_status = $previous_status;
                    $non_practising->reason = "Application";
                    $non_practising->status = "NON PRACTISING";
                    $non_practising->profile_id = $profile_id;
                    $non_practising->save();

                }

                if ($stage->status == "RETURN") {
                    $application = DB::table('applications')
                        ->where('id', $id)
                        ->update(['status' => "Under Review",
                            'current_stage' => 2]);

                    $comment = new ApplicationApproval();
                    $comment->comment = $request->input('comment');
                    $comment->active = true;
                    $comment->decision = "RETURN";
                    $comment->action_user_type_id = 6;
                    $comment->uid = $uuid;
                    $comment->application_id = $stage->id;
                    $comment->user_id = Auth()->user()->id;
                    $comment->save();
                }

                return Redirect::to("permit/non-practising/cj")
                    ->with('success', ' Application edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_practising_rhc(Request $request, $id)
    {

        if (Auth::check()) {
            $stage = Application::findOrFail($id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();

            if ($stage->status == "RETURN") {
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->decision = "RETURN";
                $comment->active = true;
                $comment->uid = $uuid;
                $comment->action_user_type_id = 3;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();

                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 1]);
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 4]);
            }

            return Redirect::to("permit/non-practising/rhc")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_practising_profile(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT NON PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.non_practising.under_review.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_practising_rhc(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT NON PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.non_practising.rhc.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function view_practising_cj(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();

            $advocate = Application::where('uid', $id)->first();
            //  dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                $application_type = "PERMIT NON PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;
            } else {
                $applications = "No data";
            }
            //  dd($applications);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);

            return view('management.permit_application.non_practising.cj.view', [
                'docus' => $docus,
                'profile' => $profile,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    // end for non practising application

    // application for susUnder Review

    public function get_suspend_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT SUSPENDED";
            $status = "Under Review";
            $resubmit = 'RETURN';

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();     
            return view('management.permit_application.suspend.under_review.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_suspend_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 2;
            $application_type = "PERMIT SUSPENDED";
            $status = "Under Review";
            $resubmit = 'RETURN';

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();     
            return view('management.permit_application.suspend.rhc.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_suspend_cj()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 4;
            $application_type = "PERMIT SUSPENDED";
            $status = "Under Review";
            $resubmit = 'RETURN';

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();     
            return view('management.permit_application.suspend.cj.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_suspend_profile(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT SUSPENDED";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.suspend.under_review.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_suspend_rhc(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT SUSPENDED";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.suspend.rhc.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function view_suspend_cj(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT SUSPENDED";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.suspend.cj.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_suspend_front(Request $request, $id)
    {

        if (Auth::check()) {

            $stage = Application::findOrFail($id);
            // dd($stage->id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();
            if ($stage->status == "RETURN") {
                $cj = DB::table('applications')
                    ->where('id', $id)
                    ->update([
                        'current_stage' => 1]);

                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->active = true;
                $comment->decision = "RETURN";
                $comment->action_user_type_id = 2;
                $comment->uid = $uuid;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 2]);
            }

            return Redirect::to("permit/suspend/under-review")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_suspend_cj(Request $request, $id)
    {

        // if (Auth::check()) {

        //     try {

        $stage = Application::findOrFail($id);
        $profile_id = Application::find($id)->profile_id;
        $previous_status = Advocate::where('profile_id', $profile_id)->first()->status;
        $currDate = Carbon::now()->format('Y-m-d');

        $uuid = Str::uuid();

        $this->validate($request, [
            'status' => 'required',
        ]);

        $stage->status = $request->input('status');
        $stage->save();

        if ($stage->status == "ACCEPT") {

            $profile_id = Application::find($id)->profile_id;
            $cj = DB::table('advocates')
                ->where('profile_id', $profile_id)
                ->update(['status' => 'SUSPENDED']);
            $status = Advocate::where('profile_id', $profile_id)->first()->status;

            $non_practising = new AdvocateStatusChange();
            $non_practising->active = true;
            $non_practising->description = "Application for SusUnder Review";
            $non_practising->uid = $uuid;
            $non_practising->start_date = $currDate;
            $non_practising->end_date = $currDate;
            $non_practising->previous_status = $previous_status;
            $non_practising->reason = "Application";
            $non_practising->status = $status;
            $non_practising->profile_id = $profile_id;
            $non_practising->save();

        }

        if ($stage->status == "RETURN") {
            $cj = DB::table('applications')
                ->where('id', $id)
                ->update(['status' => "Under Review",
                    'current_stage' => 2]);

            $comment = new ApplicationApproval();
            $comment->comment = $request->input('comment');
            $comment->active = true;
            $comment->decision = "RETURN";
            $comment->action_user_type_id = 6;
            $comment->uid = $uuid;
            $comment->application_id = $stage->id;
            $comment->user_id = Auth()->user()->id;
            $comment->save();
        }
        return Redirect::to("permit/suspend/cj")
            ->with('success', ' Application edited successfully');

        // }
        // catch (\Throwable $th) {

        //     return back()->with('warning', 'Stage not edited');
        // }

        // }
        // return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_suspend_rhc(Request $request, $id)
    {

        if (Auth::check()) {
            $stage = Application::findOrFail($id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();

            if ($stage->status == "RETURN") {
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->decision = "RETURN";
                $comment->active = true;
                $comment->uid = $uuid;
                $comment->action_user_type_id = 3;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();

                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review", 'resubmission' => false,
                        'current_stage' => 1]);
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 4]);
            }

            return Redirect::to("permit/suspend/rhc")
                ->with('success', ' Application edited successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    // end suspension application

    // permit resume practising
    public function get_resume_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT RESUME PRACTISING";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();   
            return view('management.permit_application.resume_practising.under_review.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_resume_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 2;
            $application_type = "PERMIT RESUME PRACTISING";
            $status = "Under Review";

           $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();  
            return view('management.permit_application.resume_practising.rhc.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_resume_cj()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 4;
            $application_type = "PERMIT RESUME PRACTISING";
            $status = "Under Review";

            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 

             $approved_applications = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();     
            
            return view('management.permit_application.resume_practising.cj.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_resume_profile(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT RESUME PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.resume_practising.under_review.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_resume_rhc(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT RESUME PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.resume_practising.rhc.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function view_resume_cj(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT RESUME PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.resume_practising.cj.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_resume_front(Request $request, $id)
    {

        if (Auth::check()) {

            $stage = Application::findOrFail($id);
            // dd($stage->id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();
            if ($stage->status == "RETURN") {
                $cj = DB::table('applications')
                    ->where('id', $id)
                    ->update([
                        'current_stage' => 1]);

                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->active = true;
                $comment->decision = "RETURN";
                $comment->action_user_type_id = 2;
                $comment->uid = $uuid;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 2]);
            }

            return Redirect::to("permit/resume-practising/under-review")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_resume_cj(Request $request, $id)
    {

        if (Auth::check()) {

            try {

                $stage = Application::findOrFail($id);
                $profile_id = Application::find($id)->profile_id;
                $previous_status = Advocate::where('profile_id', $profile_id)->first()->status;

                $uuid = Str::uuid();

                $this->validate($request, [
                    'status' => 'required',
                ]);

                $stage->status = $request->input('status');
                $stage->save();

                if ($stage->status == "ACCEPT") {

                    $profile_id = Application::find($id)->profile_id;
                    $advocate = DB::table('advocates')
                        ->where('profile_id', $profile_id)
                        ->update(['status' => 'PRACTISING']);

                    $status = Advocate::where('profile_id', $profile_id)->first()->status;
                    $non_practising = new AdvocateStatusChange();
                    $non_practising->active = true;
                    $non_practising->description = "Application for Practising";
                    $non_practising->uid = $uuid;
                    $non_practising->start_date = Carbon::now();
                    $non_practising->end_date = Carbon::now();
                    $non_practising->previous_status = $previous_status;
                    $non_practising->reason = "Application";
                    $non_practising->status = $status;
                    $non_practising->profile_id = $profile_id;
                    $non_practising->save();

                }

                if ($stage->status == "RETURN") {
                    $application = DB::table('applications')
                        ->where('id', $id)
                        ->update(['status' => "Under Review",
                            'current_stage' => 2]);

                    $comment = new ApplicationApproval();
                    $comment->comment = $request->input('comment');
                    $comment->active = true;
                    $comment->decision = "RETURN";
                    $comment->action_user_type_id = 6;
                    $comment->uid = $uuid;
                    $comment->application_id = $stage->id;
                    $comment->user_id = Auth()->user()->id;
                    $comment->save();
                }
                return Redirect::to("permit/resume-practising/cj")
                    ->with('success', ' Application edited successfully');
            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_resume_rhc(Request $request, $id)
    {

        if (Auth::check()) {
            $stage = Application::findOrFail($id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();

            if ($stage->status == "RETURN") {
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->decision = "RETURN";
                $comment->active = true;
                $comment->uid = $uuid;
                $comment->action_user_type_id = 3;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();

                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review", 'resubmission' => false,
                        'current_stage' => 1]);
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 4]);
            }

            return Redirect::to("permit/resume-practising/rhc")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    // end resume practising
    public function get_renewal_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT RENEWAL";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
             $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();    
    
            return view('management.permit_application.late_renewal.under_review.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function get_renewal_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT RENEWAL";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();     
            return view('management.permit_application.late_renewal.rhc.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_renewal_cj()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT RENEWAL";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();     
            return view('management.permit_application.late_renewal.cj.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    //retire practising application
    public function get_retire_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT RETIRE PRACTISING";
            $status = "Under Review";
            $resubmit = 'RETURN';

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
             $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();   
    
            return view('management.permit_application.retire_practising.under_review.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_retire_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 2;
            $application_type = "PERMIT RETIRE PRACTISING";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
             $approved_applications = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();  
                
    
            return view('management.permit_application.retire_practising.rhc.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function get_retire_cj()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 4;
            $application_type = "PERMIT RETIRE PRACTISING";
            $status = "Under Review";
            $resubmit = 'RETURN';
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
             $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();   
    
            return view('management.permit_application.retire_practising.cj.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_retire_profile(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT RETIRE PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.retire_practising.under_review.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_retire_rhc(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT RETIRE PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.retire_practising.rhc.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function view_retire_cj(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT RETIRE PRACTISING";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.retire_practising.cj.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_retire_front(Request $request, $id)
    {

        if (Auth::check()) {

            $stage = Application::findOrFail($id);
            // dd($stage->id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();

            if ($stage->status == "RETURN") {
                $cj = DB::table('applications')
                    ->where('id', $id)
                    ->update([
                        'current_stage' => 1]);
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->active = true;
                $comment->decision = "RETURN";
                $comment->action_user_type_id = 2;
                $comment->uid = $uuid;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 2]);
            }

            return Redirect::to("permit/retire-practising/under-review")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_retire_cj(Request $request, $id)
    {

        if (Auth::check()) {

            try {

                $stage = Application::findOrFail($id);
                $profile_id = Application::find($id)->profile_id;
                $previous_status = Advocate::where('profile_id', $profile_id)->first()->status;

                $uuid = Str::uuid();
                $this->validate($request, [
                    'status' => 'required',
                ]);
                $stage->status = $request->input('status');
                $stage->save();

                if ($stage->status == "ACCEPT") {

                    $profile_id = Application::find($id)->profile_id;
                    $cj = DB::table('advocates')
                        ->where('profile_id', $profile_id)
                        ->update(['status' => 'RETIRED']);

                    $status = Advocate::where('profile_id', $profile_id)->first()->status;
                    $non_practising = new AdvocateStatusChange();
                    $non_practising->active = true;
                    $non_practising->description = "Application for Retiring";
                    $non_practising->uid = $uuid;
                    $non_practising->start_date = Carbon::now();
                    $non_practising->end_date = Carbon::now();
                    $non_practising->previous_status = $previous_status;
                    $non_practising->reason = "Application";
                    $non_practising->status = $status;
                    $non_practising->profile_id = $profile_id;
                    $non_practising->save();

                }

                if ($stage->status == "RETURN") {
                    $cj = DB::table('applications')
                        ->where('id', $id)
                        ->update(['status' => "Under Review",
                            'current_stage' => 2]);
                    $comment = new ApplicationApproval();
                    $comment->comment = $request->input('comment');
                    $comment->active = true;
                    $comment->decision = "RETURN";
                    $comment->action_user_type_id = 6;
                    $comment->uid = $uuid;
                    $comment->application_id = $stage->id;
                    $comment->user_id = Auth()->user()->id;
                    $comment->save();
                }
                return Redirect::to("permit/retire-practising/cj")
                    ->with('success', ' Application edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_retire_rhc(Request $request, $id)
    {

        if (Auth::check()) {
            $stage = Application::findOrFail($id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 4]);
            }

            if ($stage->status == "RETURN") {
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->decision = "RETURN";
                $comment->active = true;
                $comment->uid = $uuid;
                $comment->action_user_type_id = 3;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();

                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review", 'resubmission' => false,
                        'current_stage' => 1]);

            }
            return Redirect::to("permit/retire-practising/rhc")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    //end retire practising application

    // non profit application
    public function get_profit_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT NON PROFIT";
            $status = "Under Review";
            $resubmit = 'RETURN';

             $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();      
            return view('management.permit_application.non_profit.under_review.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_profit_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 2;
            $application_type = "PERMIT NON PROFIT";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();      

            return view('management.permit_application.non_profit.rhc.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_profit_cj()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 4;
            $application_type = "PERMIT NON PROFIT";
            $status = "Under Review";
            $resubmit = 'RETURN';
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();      

            return view('management.permit_application.non_profit.cj.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_profit_profile(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT NON PROFIT";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.non_profit.under_review.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_profit_rhc(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT NON PROFIT";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.non_profit.rhc.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function view_profit_cj(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT NON PROFIT";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->get();
                $application_id = Application::where('profile_id', $profile_id)
                    ->where('type', $application_type)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.non_profit.cj.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_profit_front(Request $request, $id)
    {

        if (Auth::check()) {

            $stage = Application::findOrFail($id);
            // dd($stage->id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();

            if ($stage->status == "RETURN") {

                $cj = DB::table('applications')
                    ->where('id', $id)
                    ->update([
                        'current_stage' => 1]);
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->active = true;
                $comment->decision = "RETURN";
                $comment->action_user_type_id = 2;
                $comment->uid = $uuid;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 2]);
            }
            // return view('management.permit_application.non_profit.under_review.index');
            return Redirect::to("permit/non-profit/under-review")
                ->with('success', ' Application edited successfully');

            // return back()->with('success', ' Application edited successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_profit_cj(Request $request, $id)
    {

        if (Auth::check()) {

            try {

                $stage = Application::findOrFail($id);
                $profile_id = Application::find($id)->profile_id;
                $previous_status = Advocate::where('profile_id', $profile_id)->first()->status;
                $uuid = Str::uuid();

                $this->validate($request, [
                    'status' => 'required',
                ]);

                $stage->status = $request->input('status');
                $stage->save();

                if ($stage->status == "ACCEPT") {

                    $profile_id = Application::find($id)->profile_id;
                    $cj = DB::table('advocates')
                        ->where('profile_id', $profile_id)
                        ->update(['status' => 'NON PROFIT']);

                    $status = Advocate::where('profile_id', $profile_id)->first()->status;
                    $non_practising = new AdvocateStatusChange();
                    $non_practising->active = true;
                    $non_practising->description = "Application for Non Profit";
                    $non_practising->uid = $uuid;
                    $non_practising->start_date = Carbon::now();
                    $non_practising->end_date = Carbon::now();
                    $non_practising->previous_status = $previous_status;
                    $non_practising->reason = "Application";
                    $non_practising->status = $status;
                    $non_practising->profile_id = $profile_id;
                    $non_practising->save();

                }

                if ($stage->status == "RETURN") {
                    $cj = DB::table('applications')
                        ->where('id', $id)
                        ->update(['status' => "Under Review",
                            'current_stage' => 2]);

                    $comment = new ApplicationApproval();
                    $comment->comment = $request->input('comment');
                    $comment->active = true;
                    $comment->decision = "RETURN";
                    $comment->action_user_type_id = 6;
                    $comment->uid = $uuid;
                    $comment->application_id = $stage->id;
                    $comment->user_id = Auth()->user()->id;
                    $comment->save();
                }
                return Redirect::to("permit/non-profit/cj")
                    ->with('success', ' Application edited successfully');
            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_profit_rhc(Request $request, $id)
    {

        if (Auth::check()) {
            $stage = Application::findOrFail($id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();
            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 4]);
            }
            if ($stage->status == "RETURN") {
                $rhc = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 1]);
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->decision = "RETURN";
                $comment->active = true;
                $comment->uid = $uuid;
                $comment->action_user_type_id = 3;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();

            }
            return Redirect::to("permit/non-profit/rhc")
                ->with('success', ' Application edited successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    // end non profit application

    // change name Application

    public function get_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT NAME CHANGE";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();    

            return view('management.permit_application.name_change.under_review.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $stage = 2;
            $application_type = "PERMIT NAME CHANGE";
            $status = "Under Review";
            $resubmit = 'RETURN';
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 5)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 5)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();    

            return view('management.permit_application.name_change.rhc.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function get_jk()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $stage = 5;
            $application_type = "PERMIT NAME CHANGE";
            $status = "Under Review";
            $accept = "ACCEPT";
            $resubmit = 'RETURN';
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 2)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->count();    

            return view('management.permit_application.name_change.jk.index', [
                'profile' => $profile,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'submit_applications' => $submit_applications,
                'submit_applications_count' => $submit_applications_count,
                'approved_applications' => $approved_applications,
                'approved_applications_count' => $approved_applications_count,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_front(Request $request, $id)
    {

        if (Auth::check()) {

            $stage = Application::findOrFail($id);
            // dd($stage->id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();
            if ($stage->status == "RETURN") {
                $cj = DB::table('applications')
                    ->where('id', $id)
                    ->update([
                        'current_stage' => 1]);

                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->active = true;
                $comment->decision = "RETURN";
                $comment->action_user_type_id = 2;
                $comment->uid = $uuid;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 2]);
            }
            return Redirect::to("permit/name-change/under-review")
                ->with('success', ' Application edited successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_jk(Request $request, $id)
    {

        if (Auth::check()) {

            try {

                $stage = Application::findOrFail($id);
                dd($stage);
                $uuid = Str::uuid();

                $this->validate($request, [
                    'status' => 'required',
                ]);

                $stage->status = $request->input('status');
                $stage->save();

                if ($stage->status == "ACCEPT") {
                    $profile_id = Application::find($id)->profile_id;
                    $newname = NameChange::where('profile_id', $profile_id)->orderby('created_at', 'DESC')
                    ->first()->new_name;
                    $nameChange = DB::table('profiles')
                        ->where('id', $profile_id)
                        ->update(['fullname' => $newname]);
                    $appps = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "ACCEPT",
                        'current_stage' => 5]);    
                }

                if ($stage->status == "RETURN") {
                    $cj = DB::table('applications')
                        ->where('id', $id)
                        ->update(['status' => "Under Review",
                            'current_stage' => 2]);
                    $comment = new ApplicationApproval();
                    $comment->comment = $request->input('comment');
                    $comment->active = true;
                    $comment->decision = "RETURN";
                    $comment->action_user_type_id = 6;
                    $comment->uid = $uuid;
                    $comment->application_id = $stage->id;
                    $comment->user_id = Auth()->user()->id;
                    $comment->save();
                }
                return Redirect::to("permit/name-change/jk")
                    ->with('success', ' Application edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_rhc(Request $request, $id)
    {

        if (Auth::check()) {
            $stage = Application::findOrFail($id);
            $uuid = Str::uuid();
            $this->validate($request, [
                'status' => 'required',
            ]);
            $stage->status = $request->input('status');
            $stage->save();

            if ($stage->status == "RETURN") {
                $comment = new ApplicationApproval();
                $comment->comment = $request->input('comment');
                $comment->decision = "RETURN";
                $comment->active = true;
                $comment->uid = $uuid;
                $comment->action_user_type_id = 3;
                $comment->application_id = $stage->id;
                $comment->user_id = Auth()->user()->id;
                $comment->save();

                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review", 'resubmission' => false,
                        'current_stage' => 1]);
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",
                        'current_stage' => 5]);
            }

            return Redirect::to("permit/name-change/rhc")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_profile(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT NAME CHANGE";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.name_change.under_review.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function view_jk(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $profile = Profile::where('uid', $id)->first();

            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();
            //   dd($approvals);
            $advocate = Application::where('uid', $id)->first();
            // dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;
            //   dd($advocate);

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                // $applications = Application::where('profile_id', $profile_id)->get();
                $application_type = "PERMIT NAME CHANGE";
                $status = "Under Review";
                $accept = "ACCEPT";

                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orWhere('status', $accept)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orWhere('status', $accept)->first()->id;

            } else {
                $applications = "No data";
            }
            // dd($application_id);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);
            return view('management.permit_application.name_change.jk.view', [
                'profile' => $profile,
                'docus' => $docus,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_rhc(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();

            $advocate = Application::where('uid', $id)->first();
            //  dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                $application_type = "PERMIT NAME CHANGE";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->first()->id;
            } else {
                $applications = "No data";
            }
            //  dd($applications);
            $docus = DB::table('applications')
                ->leftJoin('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')
                ->where('applications.id', $application_id)
                ->get();
            // dd($docus);

            return view('management.permit_application.name_change.rhc.view', [
                'docus' => $docus,
                'profile' => $profile,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    //end name change Application

    public function view_cle(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();

            $advocate = Application::where('uid', $id)->first();
            //  dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                $applications = Application::where('profile_id', $profile_id)->get();
            } else {
                $applications = "No data";
            }
            //  dd($applications);

            return view('management.petition_application.cle.view', [
                'profile' => $profile,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function new_applicant()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PETITION";
            $status = "Under Review";

            $applications = Application::where('type', $application_type)->where('status', $status)->orderBy('created_at', 'desc')->paginate(20);

            return view('management.petition_application.new-applicant.index', [
                'profile' => $profile,
                'applications' => $applications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function view_applicant(Request $request, $id)
    {

        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $cur_year = date('Y');
            $approval_ids = Application::where('uid', $id)->first()->id;
            $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();

            $advocate = Application::where('uid', $id)->first();
            //  dd($advocate);

            $profile_id = Application::where('uid', $id)->first()->profile_id;

            //check membership
            if (FirmMembership::where('profile_id', $profile_id)->exists()) {
                $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
            } else {
                $since = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if (Firm::where('id', $firm_id)->exists()) {
                $firms = Firm::where('id', $firm_id)->get();
            } else {
                $firms = "No data";
            }

            //check personal info
            $personal_infos = Profile::where('id', $profile_id)->get();

            //check contact
            if (ProfileContact::where('profile_id', $profile_id)->exists()) {
                $contacts = ProfileContact::where('profile_id', $profile_id)->get();
            } else {
                $contacts = "No data";
            }

            //check firm address / branch
            if (FirmAddress::where('id', $firm_branch_id)->exists()) {
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            } else {
                $firm_addresses = "No data";
            }

            //check education
            if (PetitionEducation::where('profile_id', $profile_id)->exists()) {
                $educations = PetitionEducation::where('profile_id', $profile_id)->get();
            } else {
                $educations = "No data";
            }

            //check experience
            if (WorkExperience::where('profile_id', $profile_id)->exists()) {
                $experiences = WorkExperience::where('profile_id', $profile_id)->get();
            } else {
                $experiences = "No data";
            }

            //check applications
            if (Application::where('profile_id', $profile_id)->exists()) {
                $applications = Application::where('profile_id', $profile_id)->get();
            } else {
                $applications = "No data";
            }
            //  dd($applications);

            return view('management.petition_application.new-applicant.view', [
                'profile' => $profile,
                'advocate' => $advocate,
                'cur_year' => $cur_year,
                'firms' => $firms,
                'firm_id' => $firm_id,
                'since' => $since,
                'approvals' => $approvals,
                'personal_infos' => $personal_infos,
                'contacts' => $contacts,
                'firm_addresses' => $firm_addresses,
                'educations' => $educations,
                'experiences' => $experiences,
                'firm_branch_id' => $firm_branch_id,
                'applications' => $applications,
            ]);

        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function admit(Request $request, $id)
    {

        if (Auth::check()) {

            try {
                $session_id = PetitionSession::where('active', true)->first()->id;
                $profile_id = Application::findOrFail($id)->profile_id;
                $stage = Petition::where('profile_id', $profile_id)->first();
                $this->validate($request, [
                    'admit_as' => 'required',
                ]);

                $stage->admit_as = $request->input('admit_as');
                $stage->save();

                return back()->with('success', ' Admission edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function enroll(Request $request)
    {

        $currentDate = Carbon::now()->format('Y-m-d');

        $this->validate($request, [
            // 'admit_as' => 'required',
        ]);
        $uuid = Str::uuid();
        $session_id = PetitionSession::where('active', true)->first()->id;
        // $advocates = Petition::where('petition_session_id', $session_id)->get();
        $advocates = DB::table('applications')
            ->leftJoin('petitions', 'petitions.application_id', '=', 'applications.id')
            ->select('applications.*', 'petitions.*')
            ->where('petitions.petition_session_id', $session_id)
            ->where('applications.status', 'ADMIT')
            ->get();
        foreach ($advocates as $data) {
            $advocate = new Advocate;
            $advocate->active = true;
            $advocate->uid = $uuid;
            $advocate->admission = $currentDate;
            $advocate->status = $data->admit_as;
            $advocate->roll_no = $data->roll_no;
            $advocate->status_date = $currentDate;
            $advocate->petition_session_id = $data->petition_session_id;
            $advocate->profile_id = $data->profile_id;
            $advocate->save();
        }
        if ($advocate->save()) {
            //Update profile picture values
            $profile_picture = DB::table('applications')
                ->where('status', 'ADMIT')
                ->update(['active' => false]);
        }

        return back()->with('success', ' Enrollment  successfully');

    }

}
