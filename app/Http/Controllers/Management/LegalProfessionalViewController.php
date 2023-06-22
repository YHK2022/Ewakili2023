<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petitions\Petition;
use App\Models\Masterdata\PetitionSession;
use App\Models\Masterdata\LegalProfessionalView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Masterdata\Appearance;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationApproval;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\Firm;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\FirmAddress;
use App\Models\Petitions\PetitionEducation;
use App\Models\Petitions\WorkExperience;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class LegalProfessionalViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function legal_objections() 
    {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $petition_session_id = PetitionSession::where('active', true)->first()->id;  
           $applications = Appearance::where('petition_session_id', $petition_session_id)
           ->whereDate('appear_date', '<', Carbon::today())->latest('appear_date')->value('appear_date');
             $legalViews = DB::table('petitions')
               ->join('legal_professional_views', 'petitions.id', '=', 'legal_professional_views.petition_id')
                ->select('petitions.profile_id','petitions.application_id', 'petitions.created_at','petitions.petition_no','petitions.admit_as','legal_professional_views.comment')
                ->where('petitions.petition_session_id', $petition_session_id)
                ->get();  

            $petitions = Petition::where('petition_session_id', $petition_session_id)
                    ->whereIn('admit_as', ['PRACTISING', 'NON_PRACTISING', 'NON_PROFIT'])->whereNotIn('id', function ($query) {
                  $query->select('petition_id')->from('legal_professional_views'); })->orderBy('created_at', 'desc')->get();

                //   testing


 $petitionSessions = Appearance::select('petition_session_id')
    ->where('petition_session_id', $petition_session_id)
    ->distinct()
    ->pluck('petition_session_id');

foreach ($petitionSessions as $petition_session_id) {

 $lastAppearDate = Appearance::where('petition_session_id', $petition_session_id)
    ->max('appear_date');
    if ($lastAppearDate < Carbon::now()->subDay()) {
        $users = User::select('users.id', 'users.full_name', 'users.email', 'users.phone_number', 'users.username', 'users.address', 'ru.role_id')
            ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
            ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
            ->groupBy('users.id', 'ru.role_id')
            ->with('roles')
            ->where('ro.id', 13)
            ->orderBy('users.id', 'DESC')
            ->get();
        foreach ($users as $user) {
            // Check if the user has already received an email for this petition session
            $hasEmailSent = \App\LoginLinkMail::where('user_id', $user->id)
                ->where('petition_session_id', $petition_session_id)
                ->exists();

            if (!$hasEmailSent) {
                // Generate and store the login token for the user
                $loginToken = Str::random(60); // Generate a random login token
                $user->login_token = $loginToken;
                $user->save();

                // Send the email with the login link
                $loginLink = route('login.auto', ['token' => $loginToken]);
                $links = 'http://154.118.230.22/login';
                $data = [
                    'loginLink' => $loginLink,
                    'user' => $user,
                    'link' => $links,
                ];
                // Mail::to($user->email)->send(new \App\Mail\LoginLinkMail($data));
                // Store the sent email information to prevent duplicate emails
                \App\LoginLinkMail::create([
                    'user_id' => $user->id,
                    'petition_session_id' => $petition_session_id,
                ]);
            }
        }
    }

}




        return view('management.legal-objections.index',compact('petitions','legalViews'));
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }




    public function view_lp(Request $request, $id)
    {

        if(Auth::check()){

                $user_id = Auth::user()->id;
                $profile = Profile::where('uid', $id)->first();
                $cur_year = date('Y');
                $applications_id = Petition::where('uid', $id)->first()->application_id;
                $approval_ids = Application::where('id', $applications_id)->first()->id;
                $approvals = ApplicationApproval::where('application_id', $applications_id)->get();
                $advocate = Application::where('id', $applications_id)->first();
                $profile_id = Application::where('id', $applications_id)->first()->profile_id;


                //check membership
                if(FirmMembership::where('profile_id', $profile_id)->exists()){
                    $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                    $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                    $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
                }else{
                    $since = "No data";
                    $firm_id = 0;
                    $firm_branch_id = 0;
                }



                //check firm
                if(Firm::where('id', $firm_id)->exists()){
                    $firms = Firm::where('id', $firm_id)->get();
                }else{
                    $firms = "No data";
                }


    

                //check personal info
                $personal_infos = Profile::where('id', $profile_id)->get();



                //check contact
                if(ProfileContact::where('profile_id', $profile_id)->exists()){
                    $contacts = ProfileContact::where('profile_id', $profile_id)->get();
                }else{
                    $contacts = "No data";
                }


                //check firm address / branch
                if(FirmAddress::where('id', $firm_branch_id)->exists()){
                    $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
                }else{
                    $firm_addresses = "No data";
                }


                //check education
                if(PetitionEducation::where('profile_id', $profile_id)->exists()){
                    $educations = PetitionEducation::where('profile_id', $profile_id)->get();
                }else{
                    $educations = "No data";
                }


                //check experience
                if(WorkExperience::where('profile_id', $profile_id)->exists()){
                    $experiences = WorkExperience::where('profile_id', $profile_id)->get();
                }else{
                    $experiences = "No data";
                }
    //   dd($experiences);

                if(Petition::where('profile_id', $profile_id)->exists()){
                    $petitions = Petition::where('profile_id', $profile_id)->get();
                    
                }else{
                    $petitions = "No data";
                }

                //check applications
                $application_type = "PETITION";

                if(Application::where('profile_id', $profile_id)->exists()){
                    $applications = Application::where('profile_id', $profile_id)->get();
                     $application_id = Application::where('profile_id', $profile_id)
                     ->where('type', $application_type)->first()->id;
                }else{
                    $applications = "No data";
                }

               $petition = Petition::where('profile_id', $profile_id)->first();
                $docus = DB::table('applications')
                ->Join('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')->where('applications.id', $application_id)
                 ->get();

    //  dd($docus);

                return view('management.legal-objections.view', [
                    'petitions' => $petitions,
                    'petition' => $petition,
                    'docus' => $docus,
                    'profile' => $profile,
                    'advocate' => $advocate,
                    'cur_year' => $cur_year,
                    'firms' => $firms,
                    'firm_id' => $firm_id,
                    'since' => $since,
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





         public function edit_lp(Request $request, $id)
    {
        if(Auth::check())
        {
                $applications = Petition::where('id', $id)->first();
                $petition_session_id = PetitionSession::where('active', true)->first()->id;
                $stage = Application::findOrFail($id);
                $uuid = Str::uuid();
                $this->validate($request, [
                'comment' => 'required',
                ]);
                          $comment = new LegalProfessionalView();
                          $comment->comment = $request->input('comment');
                          $comment->active = true;
                          $comment->status = "viewed";
                          $comment->current_stage = 4;
                          $comment->submission_at = date('Y-m-d H:i:s');;
                          $comment->uid = $uuid;
                          $comment->petition_id = $applications->id;
                          $comment->petition_session_id = $petition_session_id;
                          $comment->workflow_process_id = 12;
                          $comment->user_id = Auth()->user()->id;
                          $comment->save();
                return Redirect::to("petition/legal-objections")->with('success', ' Application edited successfully');
     }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $activeSession = PetitionSession::where('active', true)->first();

if ($activeSession) {
    $users = User::select('users.id', 'users.full_name', 'users.email', 'users.phone_number', 'users.username', 'users.address', 'ru.role_id')
        ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
        ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
        ->groupBy('users.id', 'ru.role_id')
        ->with('roles')
        ->where('ro.id', 13)
        ->orderBy('users.id', 'DESC')
        ->get();

    foreach ($users as $user) {
        // Check if the user has already received the email for the active session
        $emailExists = Email::where('user_id', $user->id)
            ->where('petition_session_id', $activeSession->id)
            ->exists();

        if ($emailExists) {
            // User has already received the email for the active session, so skip sending
            continue;
        }

        // Generate and store the login token for the user
        $loginToken = Str::random(60); // Generate a random login token
        $user->login_token = $loginToken;
        $user->save();

        // Send the email with the login link
        $loginLink = route('login.auto', ['token' => $loginToken]);
        $data = [
            'loginLink' => $loginLink,
            'user' => $user,
        ];
        Mail::to($user->email)->send(new \App\Mail\LoginLinkMail($data));

        // Store the sent email for the user and active session
        $email = new Email();
        $email->user_id = $user->id;
        $email->petition_session_id = $activeSession->id;
        $email->sent_at = Carbon::now();
        $email->save();
    }
}

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
