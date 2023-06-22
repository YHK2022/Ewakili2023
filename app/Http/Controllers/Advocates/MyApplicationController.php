<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use App\Models\Petitions\PetitionForm;
use App\Models\Petitions\Document;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationMove;
use App\Models\Petitions\AttachmentMove;
use App\Models\Petitions\Qualification;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\LlbCollege;
use App\Models\Petitions\LstCollege;
use App\Models\Petitions\Firm;
use App\Models\Petitions\FirmRequestConfirmation;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use App\Models\Petitions\ApplicationApproval;
use App\Models\Masterdata\PetitionSession;
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

class MyApplicationController extends Controller
{

    /**
     * get applications list index page
     * @return \Illuminate\Http\Response
     */
    public function get_index()
    {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            //echo $user_id;exit();
            $profile = Profile::where('user_id', $user_id)->first();

            $profile_id = Profile::where('user_id', $user_id)->first()->id;
           $approval_id = Application::where('profile_id', $profile_id)->first()->id;

            // Find Application
            $applications = Application::where('profile_id', $profile_id)->orderBy('submission_at', 'desc')->get();
            $approvals = ApplicationApproval::where('application_id', $approval_id)->get();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            // dd($profile);
            return view('advocates.my_application.index', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'approvals' => $approvals,
                'profile_id' => $profile_id,
                'applications' => $applications,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

}