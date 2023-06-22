<?php

namespace App\Http\Controllers\Advocates;

use App\Models\Advocate\Advocate;
use App\Models\Advocate\Certificate;
use App\Http\Controllers\Controller;
use App\Models\Petitions\PetitionEducation;
use App\Models\Petitions\PetitionForm;
use App\Models\Petitions\Document;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationMove;
use App\Models\Petitions\AttachmentMove;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\Qualification;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\LlbCollege;
use App\Models\Petitions\LstCollege;
use App\Models\Petitions\Firm;
use App\Models\Petitions\FirmRequestConfirmation;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use App\Profile;
use App\User;
use App\Mail\VerifyFirm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class FirmController extends Controller
{

    /**
     * get firm index page
     * @return \Illuminate\Http\Response
     */
    public function get_index()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            //echo $user_id;exit();
            $profile = Profile::where('user_id', $user_id)->first();

            //Required declarations
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();

            $profile_id = Profile::where('user_id', $user_id)->first()->id;

            $cur_year = date('Y');
                // $since = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;

                // dd($since);
            //check membership
            if(FirmMembership::where('user_id', $user_id)->exists()){
                $since = FirmMembership::where('user_id', $user_id)->first()->since;
                $firm_id = FirmMembership::where('user_id', $user_id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('user_id', $user_id)->first()->firm_branch_id;
                $memberships = FirmMembership::where('user_id', $user_id)->orderBy('till', 'desc')->get();
                // dd($memberships);
            }else{
                $since = "No data";
                $memberships = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if(Firm::where('id', $firm_id)->exists()){
                $firms = Firm::where('id', $firm_id)->get();
            }else{
                $firms = "No data";
            }

            //check firm address / branch
            if(FirmAddress::where('id', $firm_branch_id)->exists()){
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            }else{
                $firm_addresses = "No data";
            }


            //dd($profile);exit;
            return view('advocates.firm.index', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'profile_id' => $profile_id,
                'since' => $since,
                'cur_year' => $cur_year,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
                'firms' => $firms,
                'firm_addresses' => $firm_addresses,
                'memberships' => $memberships,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * view firm
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function view_firm(Request $request, $id)
    {

        if(Auth::check()){

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $cur_year = date('Y');
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();

            $profile_id = Profile::where('user_id', $user_id)->first()->id;

            //check membership
            if(FirmMembership::where('uid', $id)->exists()){
                $since = FirmMembership::where('uid', $id)->first()->since;
                $firm_id = FirmMembership::where('uid', $id)->first()->firm_id;
                $firm_branch_id = FirmMembership::where('uid', $id)->first()->firm_branch_id;
                $memberships = FirmMembership::where('uid', $id)->get();
            }else{
                $since = "No data";
                $memberships = "No data";
                $firm_id = 0;
                $firm_branch_id = 0;
            }

            //check firm
            if(Firm::where('id', $firm_id)->exists()){
                $firms = Firm::where('id', $firm_id)->get();
            }else{
                $firms = "No data";
            }

            //check firm address / branch
            if(FirmAddress::where('id', $firm_branch_id)->exists()){
                $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
            }else{
                $firm_addresses = "No data";
            }



            return view('advocates.firm.view', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'profile_id' => $profile_id,
                'since' => $since,
                'cur_year' => $cur_year,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
                'firms' => $firms,
                'firm_addresses' => $firm_addresses,
                'memberships' => $memberships,


            ]);
        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

}