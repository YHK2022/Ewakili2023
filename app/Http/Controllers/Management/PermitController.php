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
use App\Models\Petitions\Bill;
use Illuminate\Support\Facades\Mail;
use App\User;
use DateTime;
use App\Models\Advocate\Certificate;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
                        'current_stage' => 1, 'resubmission' => false]);

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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
                        ->update(['status' => "Under Review", 'resubmission' => false,
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
                    ->update(['status' => "Under Review", 'resubmission' => false,
                        'current_stage' => 1]);
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",'resubmission' => true,
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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;
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
            $resubmit = false;

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;
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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                        'current_stage' => 1,'resubmission' => false]);

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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
                ->update(['status' => "Under Review",'resubmission' => false,
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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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

            $resubmit = true;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                        'current_stage' => 1, 'resubmission' => false]);

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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
                        ->update(['status' => "Under Review",'resubmission' => false,
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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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

     public function edit_renewal_front(Request $request, $id)
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
                        'current_stage' => 1, 'resubmission' => false]);

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
                    ->update(['status' => "Under Review",'resubmission' => true,
                        'current_stage' => 2]);
            }

            return Redirect::to("permit/late-renewal/under-review")
                ->with('success', ' Application edited successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
     public function edit_renewal_cj(Request $request, $id)
    {

        // if (Auth::check()) {

        //     try {

                $stage = Application::findOrFail($id);
                $profile_id = Application::find($id)->profile_id;
                $previous_status = Advocate::where('profile_id', $profile_id)->first()->status;

                $uuid = Str::uuid();

                $this->validate($request, [
                    'status' => 'required',
                ]);

                $stage->status = $request->input('status');
                $stage->save();

                if ($stage->status == "ACCEPT WITHOUT PENALTY") {

                    //BILL, CONTROL NUMBER and PAYMENT STRUCTURE//  

                    $date = date('Y-m-d');
                    $admission_date = Advocate::where('profile_id', $profile_id)->first()->admission;
                    $diff = abs(strtotime($date) - strtotime($admission_date));
                    $seniority = floor($diff / (365 * 60 * 60 * 24));
                  // Identify Fee structure
                   $notary_fee = 40000;
                   if ($seniority <= 5) {
                   $practising_fee = 50000;
                   $pc_fee_id = 3;
                  } else {
                     $practising_fee = 100000;
                     $pc_fee_id = 4;
                 }
                   
                    $total = $notary_fee + $practising_fee ;
                   
                    $billdate = date('Y-m-d H:i:s');
                    $expireDate = date('Y-m-d\TH:i:s', strtotime('+10 days'));
                     $date_time = new DateTime($billdate);
                     $due_Date = $date_time->format('Y-m-d\TH:i:s');
                     $bill_id = 'JUD16' . mt_rand(1000000000000, 9999999999999);
                     while (Bill::where('bill_id', $bill_id)->exists()) {
                               $bill_id = 'JUD16' . mt_rand(10000000000, 99999999999);
                            }
                   $datas = [
                          'total_all_fees' => $total,
                           'bill_id' => $bill_id,
                           'due_date' => $due_Date,
                            'expire_date' => $expireDate,

                    ];
                dd($datas);

                    // CERTIFICATES  

                     $currentyear = date('Y');
                     $application = DB::table('applications')->where('id', $id)->update(['status' => "Under Review",'resubmission' => true,
                    'current_stage' => 4]);
                     $advocate = DB::table('advocates')->where('profile_id', $profile_id)->update(['paid_year' => $currentyear]);
                     $application_id = Application::findOrFail($id)->id;
                     $notary = "NOTARY";
                      $currentDate = Carbon::now();
                      $issueDate = Carbon::now()->format('Y-m-d');
                         if ($currentDate->month === 12) {
                             $currentDate->addYear();
                          }
                     $status = Advocate::where('profile_id', $profile_id)->first()->status; 
                     $expireDate = $currentDate->endOfYear()->format('Y-m-d');  
                     $notary_no = Certificate::orderBy('id', 'desc')->max('notary_no');
                     $nextNotartyNumber = $notary_no + 1;
                     $practising_no = Certificate::orderBy('id', 'desc')->max('practising_no');
                     $nextPractisingNumber = $practising_no + 1;
                     $notary_cert = Certificate::where('type',$notary )->orderBy('id', 'desc')->max('notary_no');
                     $nextNotartyCert = $notary_cert + 1;

                                        $practising = new Certificate;
                                        $practising->active = true;
                                        $practising->uid = $uuid;
                                        $practising->accessible = false;
                                        $practising->date_of_issued = $issueDate;   
                                        $practising->expire_date = $expireDate;
                                        $practising->issued_year = $currentyear;
                                        $practising->practising_no = $nextPractisingNumber;
                                        $practising->signature_id = 1;
                                        $practising->type =$status;
                                        $practising->application_id = $application_id;
                                        $practising->profile_id = $profile_id;
                                        $practising->save();

                                        $notary = new Certificate;
                                        $notary->active = true;
                                        $notary->uid = $uuid;
                                        $notary->accessible = false;
                                        $notary->date_of_issued = $issueDate;   //control number required
                                        $notary->expire_date = $expireDate;
                                        $notary->issued_year = $currentyear;
                                        $notary->notary_no = $nextNotartyCert;
                                        $notary->signature_id = 3;
                                        $notary->type = 'NOTARY';
                                        $notary->application_id =$application_id;
                                        $notary->profile_id = $profile_id;
                                        $notary->save();


                }
                 if ($stage->status == "ACCEPT WITH PENALTYT") {
                    $application = DB::table('applications')->where('id', $id)->update(['status' => "Under Review",
                    'resubmission' => true,'current_stage' => 4]);
                    $currDate = Carbon::now()->format('Y-m-d');
                    $profile_id = Application::find($id)->profile_id;
                    $billdate = date('Y-m-d H:i:s');
                    $expireDate = date('Y-m-d\TH:i:s', strtotime('+10 days'));
                    $date_time = new DateTime($billdate);
                    $due_Date = $date_time->format('Y-m-d\TH:i:s');
                    $bill_id = 'JUD16'.mt_rand(1000000000000 , 9999999999999);
                        while (Bill::where('bill_id', $bill_id)->exists()) {
                                      $bill_id = 'JUD16' . mt_rand(10000000000, 99999999999);
                                        }

                        $date = date('Y-m-d');
                        $admission_date = Advocate::where('profile_id', $profile_id)->first()->admission;
                        $diff = abs(strtotime($date) - strtotime($admission_date));
                         $seniority = floor($diff / (365 * 60 * 60 * 24));

                         // Identify Fee structure
                         $notary_fee = 40000;
                            if ($seniority <= 5) {
                               $practising_fee = 50000;
                               $pc_fee_id = 3;
                            } else {
                               $practising_fee = 100000;
                               $pc_fee_id = 4;
                            }
                          $penalty = 0.5 * $practising_fee;
                          $penalty_fee_id = 6;
                          $notary_fee_id = 2;   
                          $pc_accumulation = $practising_fee * $year_diff;
                          $nc_accumulation = $notary_fee * $year_diff;
                          $penalty_accumulation = $penalty * $year_diff;  
                        $total = $practising_fee + $notary_fee + $pc_accumulation + $nc_accumulation 
                              + $penalty_accumulation;
           
                    

                }
                if ($stage->status == "RETURN") {
                    $application = DB::table('applications')
                        ->where('id', $id)
                        ->update(['status' => "Under Review",'resubmission' => false,
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

                return Redirect::to("permit/late-renewal/cj")
                    ->with('success', ' Application edited successfully');

            // } catch (\Throwable $th) {

            //     return back()->with('warning', 'Stage not edited');
            // }

        // }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_renewal_rhc(Request $request, $id)
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
                    ->update(['status' => "Under Review",'resubmission' => false,
                        'current_stage' => 1]);
            }

            if ($stage->status == "ACCEPT") {
                //Update profile picture values
                $profile_picture = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",'resubmission' => true,
                        'current_stage' => 4]);
            }

            return Redirect::to("permit/late-renewal/rhc")
                ->with('success', ' Application edited successfully');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function get_renewal_rhc()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 2;
            $application_type = "PERMIT RENEWAL";
            $status = "Under Review";
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->count(); 
            $approved_applications = Application::where('current_stage', 4)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            $approved_applications_count = Application::where('current_stage', 4)
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

            $stage = 4;
            $application_type = "PERMIT RENEWAL";
            $status = "Under Review";
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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


      public function view_renewal_profile(Request $request, $id)
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
                $application_type = "PERMIT RENEWAL";
                $status = "Under Review";
              
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
            return view('management.permit_application.late_renewal.under_review.view', [
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

    public function view_renewal_rhc(Request $request, $id)
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
                $application_type = "PERMIT RENEWAL";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
            return view('management.permit_application.late_renewal.rhc.view', [
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
    public function view_renewal_cj(Request $request, $id)
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
                $application_type = "PERMIT RENEWAL";
                $status = "Under Review";
                $applications = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;
             

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
            return view('management.permit_application.late_renewal.cj.view', [
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

    //retire practising application
    public function get_retire_index()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT RETIRE PRACTISING";
            $status = "Under Review";
            $resubmit = false;

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                        'current_stage' => 1, 'resubmission' => false]);
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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
                        ->update(['status' => "Under Review",'resubmission' => false,
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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
            $resubmit = false;

             $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                        'current_stage' => 1,'resubmission' => false]);
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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
                        ->update(['status' => "Under Review",'resubmission' => false,
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
                    ->update(['status' => "Under Review",'resubmission' => true,
                        'current_stage' => 4]);
            }
            if ($stage->status == "RETURN") {
                $rhc = DB::table('applications')
                    ->where('id', $id)
                    ->update(['status' => "Under Review",'resubmission' => false,
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
            $resubmit = false;
           $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', true)
                ->orderBy('created_at', 'desc')->count();

             $submit_applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
                ->orderBy('created_at', 'desc')->paginate(20);
            
             $submit_applications_count = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('resubmission', $resubmit)
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
                        'current_stage' => 1,'resubmission' => false]);

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
                    ->update(['status' => "Under Review",'resubmission' => true,
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
                        ->update(['status' => "Under Review",'resubmission' => false,
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
                    ->update(['status' => "Under Review", 'resubmission' => true,
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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;

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
                    ->where('status', $status)->orderBy('id', 'desc')->get();
                $application_id = Application::where('profile_id', $profile_id)->where('type', $application_type)
                    ->where('status', $status)->orderBy('id', 'desc')->first()->id;
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
