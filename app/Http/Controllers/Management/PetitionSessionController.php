<?php

namespace App\Http\Controllers\Management;

use App\Models\Masterdata\PetitionSession;
use App\Models\Masterdata\Coram;
use App\Models\Masterdata\CoramCleMember;
use App\Models\Masterdata\CleMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\Petition;
use App\Models\Petitions\Firm;
use App\Models\Petitions\Application;
use Illuminate\Support\Facades\DB;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\FirmAddress;
use App\Models\Petitions\PetitionEducation;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\ApplicationApproval;
use App\Models\Masterdata\Appearance;
use App\Profile;
use Illuminate\Support\Carbon;
class PetitionSessionController extends Controller
{
    /**
     * get a listing of petition sessions.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $sessions = PetitionSession::orderByDesc('open_date')->get();
            $session = PetitionSession::latest()->first()->id;
            return view('management.masterdata.petition_session.index', [
                'profile' => $profile,
                'sessions' => $sessions,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new petition session
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_session(Request $request)
    {

        if(Auth::check()){
          $session_id = PetitionSession::latest()->first()->id;
          DB::table('petition_sessions')
         ->where('id', $session_id)
         ->update(['active' => 'false']);

            $this->validate($request, [
                'open_date' => 'required',
                'close_date' => 'required',
                'admission_date' => 'required',
            ]);

            $uuid = Str::uuid();

            $session = new PetitionSession();
            $session->open_date = $request->input('open_date');
            $session->close_date = $request->input('close_date');
            $session->admission_date = $request->input('admission_date');
            $session->uid = $uuid;
            $session->active = "true";
            //dd($session);exit;
            $session->save();

            return back()->with('success', 'Petition Session added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit petition session
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_session(Request $request, $id)
    {

        if(Auth::check()){

            try {

                $session = PetitionSession::findOrFail($id);

                $this->validate($request, [
                    'open_date' => 'required',
                    'close_date' => 'required',
                    'admission_date' => 'required',
                ]);

                $session->open_date = $request->input('open_date');
                $session->close_date = $request->input('close_date');
                $session->admission_date = $request->input('admission_date');
                //dd($session);exit;
                $session->save();

                return back()->with('success', 'Petition Session edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Petition Session not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_session(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $permission = PetitionSession::findOrFail($id);
                $permission->delete();

                return back()->with('success', 'User permission deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User permission not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


public function view_session(Request $request, $id)
    {

        if(Auth::check()){
                $session_id = PetitionSession::where('uid', $id)->first()->id;
                $sessions = PetitionSession::where('uid', $id)->first();
                $corams = Coram::where('petition_session_id', $session_id)->count();
                $advocates = Petition::where('petition_session_id', $session_id)->get();
                $coram_lists = Coram::where('petition_session_id', $session_id)->get();
                $appearance_lists = Appearance::where('petition_session_id', $session_id)->get();
                // dd($appearance_lists);
                $coramCleMembers = CoramCleMember::whereIn('coram_id', $coram_lists->pluck('id'))->get();
                 $apps = DB::table('applications')
                    ->leftJoin('petitions', 'petitions.application_id', '=', 'applications.id')
                    ->select('applications.*','petitions.*')
                     ->where('petitions.petition_session_id',$session_id )
                     ->where('applications.status', 'ADMIT')
                     ->count();

                     $advocates = DB::table('advocates')
                    ->select('advocates.*')
                     ->where('advocates.petition_session_id',$session_id )
                     ->get();

                    $advocatesCount = DB::table('advocates')
                    ->select('advocates.*')
                     ->where('advocates.petition_session_id',$session_id )
                     ->count();
                    //  dd($advocatesCount);

                        $appearances = DB::table('appearances')
                    ->leftJoin('petitions', 'petitions.appearance_id', '=', 'appearances.id')
                    ->leftJoin('appearance_venues', 'appearance_venues.id', '=', 'appearances.venue_id')
                    ->select('appearances.appear_date','appearances.id','appearances.venue_id','appearance_venues.name', DB::raw('COUNT(petitions.appearance_id) As appearnumber'))
                     ->where('appearances.petition_session_id',$session_id )
                     ->groupBy('appearances.appear_date','appearances.venue_id', 'appearances.id','appearance_venues.name')
                     ->get();
                    //  dd($appearances);

                  $result = DB::table('profiles')
                           ->join('applications', 'profiles.id', '=', 'applications.profile_id')
                           ->join('petitions', 'applications.id', '=', 'petitions.application_id')
                           ->select('profiles.*', 'applications.*', 'petitions.*')
                          ->where('petition_session_id',$session_id )
                         ->get();
                //   dd($result);

                  $no_venues = DB::table('profiles')
                          ->join('applications', 'profiles.id', '=', 'applications.profile_id')
                          ->join('petitions', 'applications.id', '=', 'petitions.application_id')
                          ->select('profiles.*', 'applications.*', 'petitions.*')
                          ->where('petition_session_id', $session_id)
                          ->where('venue_id', null)
                         ->get();

                      $no_appearances = DB::table('profiles')
                          ->join('applications', 'profiles.id', '=', 'applications.profile_id')
                          ->join('petitions', 'applications.id', '=', 'petitions.application_id')
                         ->select('profiles.*', 'applications.*', 'petitions.*')
                        ->where('petition_session_id', $session_id)
                       ->where('appearance_id', null)
                      ->get();

                         $legalViews = DB::table('petitions')
               ->join('legal_professional_views', 'petitions.id', '=', 'legal_professional_views.petition_id')
                ->select('petitions.profile_id','petitions.application_id', 'petitions.created_at','petitions.petition_no','petitions.admit_as','legal_professional_views.comment')
                ->where('petitions.petition_session_id', $session_id)
                ->get(); 

                $legal =  $legalViews->count();
                

               
                return view('management.masterdata.petition_session.view', [
                    'result' => $result,
                    'apps' => $apps,
                    'legal' => $legal,
                    'legalViews' => $legalViews,
                    'advocates' => $advocates,
                    'advocatesCount' => $advocatesCount,
                    'coramCleMembers' => $coramCleMembers,
                    'corams' => $corams,
                    'coram_lists' => $coram_lists,
                    'appearance_lists' => $appearance_lists,
                    'no_venues' => $no_venues,
                    'no_appearances' => $no_appearances,
                    'sessions' => $sessions,
                    'appearances' => $appearances,
                    'advocates' => $advocates
                ]);
        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }




public function profile_view_session(Request $request, $id)
    {


        if(Auth::check()){

                $user_id = Auth::user()->id;
                $profile = Profile::where('uid', $id)->first();
                $profile_ids = Profile::where('uid', $id)->first()->id;
                $cur_year = date('Y');
                $advocate = Application::where('profile_id', $profile_ids)->first();

                $profile_id = Application::where('profile_id', $profile_ids)->first()->profile_id;
               

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

               //check applications

                if(Petition::where('profile_id', $profile_id)->exists()){
                    $petitions = Petition::where('profile_id', $profile_id)->get();
                    
                }else{
                    $petitions = "No data";
                }
                 
                //check applications
                $application_type = "PETITION";

                if(Application::where('profile_id', $profile_id)->exists()){
                    $applications = Application::where('profile_id', $profile_id)
                    ->where('type', $application_type)->get();
                     $application_id = Application::where('profile_id', $profile_id)
                     ->where('type', $application_type)->first()->id;
                }else{
                    $applications = "No data";
                }

                $docus = DB::table('applications')
                ->Join('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')->where('applications.id', $application_id)
                 ->get();
                $petition = Petition::where('profile_id', $profile_id)->first();


                return view('management.masterdata.petition_session.profile-view', [
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


    
     public function coramCleMembers($id)
{
    $coramCleMembers = CoramCLEMember::where('coram_id', $id)->get();
    $totalReviewed = CoramCleMember::where('coram_id', $id)->sum('member_id');
    // $totalReviewed = CoramCleMember::where('coram_id', $id)->sum('member_id');

    return view('management.masterdata.petition_session.related-data', [
        'coramCleMembers' => $coramCleMembers,'totalReviewed' => $totalReviewed,
    ]);
}

public function appearanceMembers($id)
{
    $appearanceMembers = Petition::where('appearance_id', $id)->get();
   
    return view('management.masterdata.petition_session.appearance-data', [
        'appearanceMembers' => $appearanceMembers,
    ]);
}

    public function add_appearance(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'appear_date' => 'required',
                'reporting_time' => 'required',
                'venue_id' => 'required',

            ]);
            $session_id = PetitionSession::where('active', true)->first()->id;
            $uuid = Str::uuid();

            $appearance = new Appearance();
            $appearance->appear_date = $request->input('appear_date');
            $appearance->reporting_time = $request->input('reporting_time');
            $appearance->venue_id = $request->input('venue_id');
            $appearance->petition_session_id = $session_id;
            $appearance->uid = $uuid;
            $appearance->active = "true";
            $appearance->save();

                        if ($appearance) {
                //Update profile picture values
                $appearance = DB::table('petitions')
                 ->where('venue_id', $appearance->venue_id)
                 ->where('petition_session_id', $session_id)
                    ->update(['appearance_id' => $appearance->id]);
            }
            return back()->with('success', 'Petition Session added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    public function add_bar_exam(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'appear_date' => 'required',
                'reporting_time' => 'required',
                'venue_id' => 'required',

            ]);
            $session_id = PetitionSession::where('active', true)->first()->id;
            $uuid = Str::uuid();

            $appearance = new BarExam();
            $appearance->appear_date = $request->input('exam_date');
            $appearance->reporting_time = $request->input('reporting_time');
            $appearance->venue_id = $request->input('venue_id');
            $appearance->petition_session_id = $session_id;
            $appearance->uid = $uuid;
            $appearance->active = "true";
            $appearance->save();

                        if ($appearance) {
                //Update profile picture values
                $appearance = DB::table('petitions')
                 ->where('venue_id', $appearance->venue_id)
                 ->where('petition_session_id', $session_id)
                    ->update(['bar_exam_id' => $appearance->id]);
            }
            return back()->with('success', 'Petition Session added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

      public function change_venue(Request $request, $id)
    {
        if(Auth::check()){
        $profile_id= Profile::where('uid', $id)->first()->id;
    
        $status = PetitionSession::where('active', 'true')->first()->id;

        $llb = Petition::where('profile_id', $profile_id)->first();
        $this->validate($request, [
            'venue_id' => 'required',
        ]);

        $llb->venue_id = $request->input('venue_id');
        $llb->save();

        if($llb)
        {
        $appearance_id = DB::table('appearances')
                      ->where('petition_session_id',$status )
                      ->where('venue_id', $llb->venue_id)
                       ->value('id');
            $update_venue = DB::table('petitions')
                       ->where('profile_id', $profile_id)
                         ->update(['venue_id' => $llb->venue_id,
                                    'appearance_id' => $appearance_id]);

        }


        
        return back()->with('success', 'Appearance Venue info Updated successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    

}