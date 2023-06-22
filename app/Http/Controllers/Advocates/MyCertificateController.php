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
use Carbon\Carbon;

use App\Mail\VerifyFirm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class MyCertificateController extends Controller
{

    /**
     * get certificate list index page
     * @return \Illuminate\Http\Response
     */
    public function get_index()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            //echo $user_id;exit();
            $profile = Profile::where('user_id', $user_id)->first();

            $profile_id = Profile::where('user_id', $user_id)->first()->id;

            // Find Certificate
            $certificates = Certificate::where('profile_id', $profile_id)->orderBy('date_of_issued', 'desc')->get();
            $cur_year = date('Y');

            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            $type = Certificate::where('profile_id', $profile_id)->get();
            // dd($type->type);
            //dd($profile);exit;
            return view('advocates.my_certificate.index', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'profile_id' => $profile_id,
                'certificates' => $certificates,
                'cur_year' => $cur_year,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'type' => $type,
                'experience' => $experience,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * view certificate
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function view_certificate(Request $request, $id)
    {
           
        if(Auth::check()){

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $advocate = Advocate::where('profile_id', $profile_id)->first();
            $cur_year = date('Y');
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
             $certificate = Certificate::where('profile_id', $profile_id)->first()->date_of_issued;

            //check certificate
            $certificates = Certificate::where('uid', $id)->get();
            //   $dateString = '2022-02-06';
                 $date = Carbon::createFromFormat('Y-m-d', $certificate);
                 $formattedDate = $date->format('jS \d\a\y \o\f F, Y');


            return view('advocates.my_certificate.view', [
                'profile' => $profile,
                'formattedDate' => $formattedDate,
                'advocate' => $advocate,
                'certificates' => $certificates,
                'certificate' => $certificate,
                'cur_year' => $cur_year,
                'progress' => $progress,
                'petition_form' => $petition_form,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }



    public function view_notary_certificate(Request $request, $id)
    {
           
        if(Auth::check()){
            $type = "NOTARY";
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $advocate = Advocate::where('profile_id', $profile_id)->first();
            $cur_year = date('Y');
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
             $certificate = Certificate::where('profile_id', $profile_id)->first()->date_of_issued;
             $type = Certificate::where('profile_id', $profile_id)->where('type', 'NOTARY')->first();
            // dd($type);
            //check certificate
            $certificates = Certificate::where('uid', $id)->where('type', 'NOTARY')->get();
       
            //   $dateString = '2022-02-06';
                 $date = Carbon::createFromFormat('Y-m-d', $certificate);
                 $formattedDate = $date->format('jS \d\a\y \o\f F, Y');


            return view('advocates.my_certificate.notary', [
                'profile' => $profile,
                'formattedDate' => $formattedDate,
                'advocate' => $advocate,
                'certificates' => $certificates,
                'certificate' => $certificate,
                'cur_year' => $cur_year,
                'progress' => $progress,
                'petition_form' => $petition_form,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'type' => $type,
                'experience' => $experience,
            ]);
        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }

}