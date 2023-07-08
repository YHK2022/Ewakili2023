<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\Petitions\Petition;
use App\Models\Masterdata\PetitionSession;
use App\Models\Advocate\TemporaryAdmission;
use App\Models\Advocate\TemporaryAdmissionDocuments;
use App\Models\Advocate\TemporaryAtachmentMoves;
use App\Profile;
use App\User;
use App\Mail\VerifyFirm;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class TemporaryAdmissionsController extends Controller
{
     public function get_personal_detal_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            return view('advocates.profile.personal_detail', [
                'petition_form' => $petition_form,
                'profile' => $profile,
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


    /**
     * get qualification registration form
     * @return \Illuminate\Http\Response
     */
    public function get_qualification_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $qualification = TemporaryAdmission::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //dd($profile);exit;
            return view('advocates.profile.application-form', [
                'petition_form' => $petition_form,
                'qualification' => $qualification,
                'profile' => $profile,
                'progress' => $progress,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * get attachments registration form
     * @return \Illuminate\Http\Response
     */
    public function get_attachment_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $qualification = Qualification::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            $attach_move = TemporaryAtachmentMoves::where('user_id', $user_id)->first();
            //dd($profile);exit;
            return view('advocates.profile.temp-attachment', [
                'petition_form' => $petition_form,
                'qualification' => $qualification,
                'profile' => $profile,
                'progress' => $progress,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
                'attach_move' => $attach_move,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * add a new petitioner profile
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_profile(Request $request)
    {
        if(Auth::check()){
        $session_id = PetitionSession::where('active', true)->first()->id;
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'nationality' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
        ]);

        $uuid = Str::uuid();
        $profile = new Profile();
        $profile->title = $request->input('title');
        $profile->fullname = $request->input('name');
        $profile->gender = $request->input('gender');
        $profile->dob = $request->input('dob');
        $profile->nationality = $request->input('nationality');
        $profile->id_type = $request->input('id_type');
        $profile->id_number = $request->input('id_number');
        $profile->user_id = Auth::user()->id;
        $profile->uid = $uuid;
        $profile->active = "true";
        // dd($profile);
        $profile->save();

        //Insert petition forms values
        if($profile){
        $petition_form_one = 1;
        $form = new PetitionForm();
        $form->personal_detail = $petition_form_one;
        $form->user_id = Auth::user()->id;
        $form->profile_id = $profile->id;
        $form->save();

        // $petition = new Petition();
        // $petition->profile_id = $profile->id;
        // $petition->uid = $uuid;
        // $petition->active = "true";
        // $petition->petition_session_id = $session_id;
        // $petition->save();

        $progress_value = 15;
        $progress = new ApplicationMove();
        $progress->appl_progress = $progress_value;
        $progress->user_id = Auth::user()->id;
        $progress->profile_id = $profile->id;
        $progress->save();

        }
        return back()->with('success', 'Personal info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    public function update_profile(Request $request, $id)
    {
        if(Auth::check()){
            
           try{

        $profile = Profile::findOrFail($id);
// dd($profile);
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'nationality' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
        ]);
        $profile->title = $request->input('title');
        $profile->fullname = $request->input('name');
        $profile->gender = $request->input('gender');
        $profile->dob = $request->input('dob');
        $profile->nationality = $request->input('nationality');
        $profile->id_type = $request->input('id_type');
        $profile->id_number = $request->input('id_number');
        //dd($profile);exit;
        $profile->save();

        
        return back()->with('success', 'Personal info Updated successfully');
        }
            catch (\Throwable $th) {

                return back()->with('warning', 'Personal Info not edited');
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
}


    /**
     * add a new petitioner qualification
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_qualification(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $profile_id = Profile::where('user_id', $user_id)->first()->id;
        $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
        $progress_form = 20;
        $new_progress = $progress + $progress_form;


        $this->validate($request, [
            'case_nature' => 'required',
            'case_number' => 'required',
            'case_year' => 'required',
            'registration_court' => 'required',
            'case_parties' => 'required',
        ]);

        $qualification = new TemporaryAdmission();
        $qualification->case_nature = $request->input('case_nature');
        $qualification->case_number = $request->input('case_number');
        $qualification->case_year = $request->input('case_year');
        $qualification->case_parties = $request->input('case_parties');
        $qualification->registration_court = $request->input('registration_court');
        $qualification->user_id = Auth::user()->id;
        $qualification->profile_id = $profile_id;
        // dd($qualification);
        $qualification->save();


        if($qualification){
         //Update petition forms values
        $qualification_form_value = 1;
        $qualification_form = DB::table('petition_forms')
                        ->where('user_id', $user_id)
                        ->update(['qualification' => $qualification_form_value]);
        
        //Update progress values
        $progress = DB::table('application_moves')
                        ->where('user_id', $user_id)
                        ->update(['appl_progress' => $new_progress]);

        //Save application information values
        $submitdate = date('Y-m-d H:i:s');
        $uuid = Str::uuid();
        $appl_type = "TEMPORARY ADMISSION";
        
        $status = "NOT SUBMITTED";

        $application = new Application();
        $application->submission_at = $submitdate;
        $application->active = "true";
        $application->uid = $uuid;
        $application->type = $appl_type;
        $application->qualification = $qualification;
        $application->status = $status;
        $application->resubmission = "true";
        $application->un_reviewed = "0";
        $application->current_stage = "2";
        $application->profile_id = $profile_id;
        $application->workflow_process_id = "1";
        $application->actionstatus = "0";
        $application->stage = "0";
        //dd($application);exit;
        $application->save();

        }
        return back()->with('success', 'Education Qualifications added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

public function update_qualification(Request $request, $id)
    {
        if(Auth::check()){
        try{
$user_id = Auth::user()->id;
$profile_id = Profile::where('user_id', $user_id)->first()->id;

$qualification = TemporaryAdmission::findOrFail($id);
// dd($qualification);
$this->validate($request, [
            'case_nature' => 'required',
            'case_number' => 'required',
            'case_year' => 'required',
            'registration_court' => 'required',
            'case_parties' => 'required',
        ]);

        $qualification->case_nature = $request->input('case_nature');
        $qualification->case_number = $request->input('case_number');
        $qualification->case_year = $request->input('case_year');
        $qualification->case_parties = $request->input('case_parties');
        $qualification->registration_court = $request->input('registration_court');
        $qualification->save();

       if ($qualification) {
    
    //Save application information values
    $submitdate = date('Y-m-d H:i:s');
    $application = Application::findOrFail($profile_id);
    $application->submission_at = $submitdate;
    $application->qualification = $qualification;
    $application->save();

}

        } catch(\Throwable $th){
            return back()->with('warning', 'Education Qualifications not edited');

        }
        return back()->with('success', 'Education Qualifications updated successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    /**
     * upload profile picture
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_profile_picture(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        // dd($user_id);
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Profile Picuture";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');
        $uuid = Str::uuid();

        //echo $application_id;exit;

         $this->validate($request, [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

          $profile_picture = $request->profile_picture;
        if ($profile_picture) {
            $ext = pathinfo($profile_picture->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $profile_picture->move('public/images/files', $imageName);

            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->uid = $uuid;
            $document->application_id = $application_id;
            $document->profile_id = $profile_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                $attachment = new TemporaryAtachmentMoves;
                $attachment->user_id = $user_id;
                $attachment->profile_id = $profile_id;
                $attachment->application_id = $application_id;
                $attachment->profile_picture = $imageName;
                //dd($document);exit;
                $attachment->save();

                 //Update profile picture values
                $profile_picture = DB::table('profiles')
                        ->where('user_id', $user_id)
                        ->update(['picture' => $imageName]);
            }

         }

        return back()->with('success', 'Profile picture successfully added');

        }
    }







    /**
     * upload petition for admission and enrolment document
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_petition_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        // dd($user_id);
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Application for Temporary Admission";
        $status = 0;
        $attachment_type_id = 1;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'application_admission' => 'required|mimes:pdf|max:2048',
         ]);


         $application_admission = $request->application_admission;
        if ($application_admission) {
            $ext = pathinfo($application_admission->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $application_admission->move('public/images/files', $imageName);


            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->application_id = $application_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            $document->attachment_type_id = $attachment_type_id;

            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['application_admission' => $imageName]);
            }

         }

        return back()->with('success', 'Application For Teporary Admission Document successfully added');

        }
    }




    public function delete_petition(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 1;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_atachment_moves')
        ->where('id', $id)
        ->update(['application_admission' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', 1)
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }


    /**
     * upload certificate of o level
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_admission_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Admission Certificate";
        $status = 0;
        $attachment_type_id = 4;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'admission_certificate' => 'required|mimes:pdf|max:2048',
         ]);
          $admission_certificate = $request->admission_certificate;
        if ($admission_certificate) {
            $ext = pathinfo($admission_certificate->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $admission_certificate->move('public/images/files', $imageName);


            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->application_id = $application_id;
            $document->auther = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            $document->attachment_type_id = $attachment_type_id;

            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['admission_certificate' => $imageName]);
            }

         }

        return back()->with('success', 'Admission Certificate successfully added');

        }
    }

     public function delete_admission(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 4;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_attachment_moves')
        ->where('id', $id)
        ->update(['admission_certificate' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Admission Certificate Document Deleted  successfully ');
    }
    /**
     * upload certificate of recognition necta
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_practising_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Practising Certificate";
        $status = 0;
        $attachment_type_id = 6;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'practising_certificate' => 'required|mimes:pdf|max:2048',
         ]);

         $practising_certificate = $request->practising_certificate;
        if ($practising_certificate) {
            $ext = pathinfo($practising_certificate->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $practising_certificate->move('public/images/files', $imageName);
       
            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->application_id = $application_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            $document->attachment_type_id = $attachment_type_id;

            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['practising_certificate' => $imageName]);
            }

         }

        return back()->with('success', 'Practising Certificate successfully added');

        }
    }


     public function delete_practising(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 6;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_atachment_moves')
        ->where('id', $id)
        ->update(['practising_certificate' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Practising Certificate Deleted  successfully ');
    }

    /**
     * upload certificate of a level
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_notary_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Notary Certificate";
        $status = 0;
        $attachment_type_id = 7;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'notary_certificate' => 'required|mimes:pdf|max:2048',
         ]);
          $notary_certificate = $request->notary_certificate;
        if ($notary_certificate) {
            $ext = pathinfo($notary_certificate->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $notary_certificate->move('public/images/files', $imageName);

      
            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->attachment_type_id = $attachment_type_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['notary_certificate' => $imageName]);
            }

         }

        return back()->with('success', 'Notary Certificate successfully added');

        }
    }


     public function delete_notary(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 7;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_atachment_moves')
        ->where('id', $id)
        ->update(['notary_certificate' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_document')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Notary Certificate Deleted  successfully ');
    }
    /**
     * upload certificate of recognition nacte
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_letter_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Introduction Letter";
        $status = 0;
        $attachment_type_id = 12;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'introduction_letter' => 'required|mimes:pdf|max:2048',
         ]);

         $introduction_letter = $request->introduction_letter;
        if ($introduction_letter) {
            $ext = pathinfo($introduction_letter->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $introduction_letter->move('public/images/files', $imageName);
       
            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->attachment_type_id = $attachment_type_id;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->application_id = $application_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['introduction_letter' => $imageName]);
            }

         }

        return back()->with('success', 'Introduction Letter successfully added');

        }
    }


     public function delete_letter(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 12;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_atachment_moves')
        ->where('id', $id)
        ->update(['introduction_letter' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate for llb
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_ordinary_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Ordinary Secondary Education Certificate";
        $status = 0;
        $attachment_type_id = 13;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'ordinary_secondary_education' => 'required|mimes:pdf|max:2048',
         ]);


         $ordinary_secondary_education = $request->ordinary_secondary_education;
        if ($ordinary_secondary_education) {
            $ext = pathinfo($ordinary_secondary_education->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $ordinary_secondary_education->move('public/images/files', $imageName);

            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            $document->application_id = $application_id;
            $document->attachment_type_id = $attachment_type_id;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['ordinary_secondary_education' => $imageName]);
            }

         }


        return back()->with('success', 'Ordinary Secondary Certificate successfully added');

        }
    }

     public function delete_ordinary(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 13;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_attachment_moves')
        ->where('id', $id)
        ->update(['ordinary_secondary_education' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Ordinary Secondary Document Deleted  successfully ');
    }

    /**
     * upload certificate for llb tanscript
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_advanced_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Ordinary Secondary Education Certificate";
        $status = 0;
        $attachment_type_id = 14;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'advanced_certificate' => 'required|mimes:pdf|max:2048',
         ]);

         $advanced_certificate = $request->advanced_certificate;
        if ($advanced_certificate) {
            $ext = pathinfo($advanced_certificate->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $advanced_certificate->move('public/images/files', $imageName);
        
            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->application_id = $application_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            $document->attachment_type_id = $attachment_type_id;

            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['advanced_certificate' => $imageName]);
            }

         }

        return back()->with('success', 'Advanced Certificate successfully added');

        }
    }



     public function delete_advanced(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 14;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_atachment_moves')
        ->where('id', $id)
        ->update(['advanced_certificate' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Advanced Certificate Deleted  successfully ');
    }

    /**
     * upload certificate of TCU recognition
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_bachelor_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Bachelor Of Laws Degree Certificate";
        $status = 0;
        $attachment_type_id = 15;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'bachelor_degree' => 'required|mimes:pdf|max:2048',
         ]);

         $bachelor_degree = $request->bachelor_degree;
        if ($bachelor_degree) {
            $ext = pathinfo($bachelor_degree->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $bachelor_degree->move('public/images/files', $imageName);
        
            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->attachment_type_id = $attachment_type_id;
            $document->application_id = $application_id;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['bachelor_degree' => $imageName]);
            }

         }

        return back()->with('success', 'Bachelor Degree Certificate successfully added');

        }
    }

     public function delete_bachelor(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 15;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_atachment_moves')
        ->where('id', $id)
        ->update(['bachelor_degree' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Bachelor Degree Deleted  successfully ');
    }

    /**
     * upload certificate for lst
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_work_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Work Permit";
        $status = 0;
        $attachment_type_id = 17;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'work_permit' => 'required|mimes:pdf|max:2048',
         ]);

           $work_permit = $request->work_permit;
        if ($work_permit) {
            $ext = pathinfo($work_permit->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $work_permit->move('public/images/files', $imageName);
     
            $document = new TemporaryAdmissionDocuments;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->auther = $profile_id;
            $document->application_id = $application_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            $document->attachment_type_id = $attachment_type_id;

            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('temporary_atachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['work_permit' => $imageName]);
            }

         }

        return back()->with('success', 'Work Permit Document successfully added');

        }
    }

     public function delete_work(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 17;
        // $document = TemporaryAtachmentMoves::findOrFail($id);
         
    $document = DB::table('temporary_atachment_moves')
        ->where('id', $id)
        ->update(['work_permit' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('temporary_admission_documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Work Permit Deleted  successfully ');
    }

    /**
     * upload certificate for lst final results
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    
    public function submit_attachments(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $value = 1;
        $ldate = date('Y-m-d H:i:s');

        $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
        $progress_form = 35;
        $new_progress = $progress + $progress_form;

        //Update progress values
        $progress = DB::table('application_moves')
                        ->where('user_id', $user_id)
                        ->update(['appl_progress' => $new_progress]);

         //Update petition form
         $profile_picture = DB::table('petition_forms')
                        ->where('user_id', $user_id)
                        ->update(['attachment' => $value]);

        return back()->with('success', 'Attachments successfully submitted');

        }
    }

    /**
     * get llb index
     * @return \Illuminate\Http\Response
     */
  
    /**
     * get finish index
     * @return \Illuminate\Http\Response
     */
    public function get_finish_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $application = Application::where('profile_id', $profile_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = TemporaryAdmissionDocuments::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //echo $attachment;exit;
            if($progress){
                $progress_value = ApplicationMove::where('user_id', $user_id)->first('appl_progress')->appl_progress;
                    return view('advocates.profile.complete', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'application' => $application,
                    'progress' => $progress,
                    'progress_value' => $progress_value,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'experience' => $experience,
                ]);

            }else{
                return view('advocates.profile.complete', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'experience' => $experience,
                ]);
            }
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * get firm & work places index
     * @return \Illuminate\Http\Response
     */
    
    public function submit_applications(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
                //Update progress values
                $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
                $progress_form = 5;
                $value = 1;
             $profile_id = Profile::where('user_id', $user_id)->first()->id;
                $status = "Under Review";
                $new_progress = $progress + $progress_form;

                $progress = DB::table('application_moves')
                                ->where('user_id', $user_id)
                                ->update(['appl_progress' => $new_progress , 'finish' => 1]);

                //Update petition form
                $petition_form = DB::table('petition_forms')
                                ->where('user_id', $user_id)
                                ->update(['firm' => $value]);

                $psubmit_applicatioin = DB::table('applications')
                                ->where('profile_id', $profile_id)
                                ->update(['status' => $status]);


                return Redirect::to("temporary/complete")->with('success', 'Application submitted successful!');


        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     public function resubmit_application(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;

                //Update progress values
                $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
                $progress_form = 5;
                $value = 1;
                 $resubmission = true;
                $profile_id = Profile::where('user_id', $user_id)->first()->id;
                $status = "Under Review";
                $new_progress = $progress + $progress_form;

               
                //Update petition form
                $petition_form = DB::table('petition_forms')
                                ->where('user_id', $user_id)
                                ->update(['firm' => $value]);

                $psubmit_applicatioin = DB::table('applications')
                                ->where('profile_id', $profile_id)
                                ->update(['status' => $status, 'resubmission'=> $resubmission]);
                $progress = DB::table('application_moves')
                                ->where('user_id', $user_id)
                                ->update( ['finish' => 1]);


                return Redirect::to("petition/finish")->with('success', 'Application submitted successful!');


        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    } 

    /**
     * edit the specified officer group
     * @param \Illuminate\Http\Request $request
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function edit_officer_group(Request $request, $id)
    {
        try {
            $officer_group = OfficerGroup::findOrFail($id);

            $this->validate($request, [
                'name' => 'required'
            ]);

            $officer_group->name = $request->input('name');
            $officer_group->save();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Officer group updated successfully.',
                'officer_group' => $officer_group
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found'
            ], 404);
        }
    }


    /**
     * delete the specified officer group
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function delete_officer_group($id)
    {
        try {
            $officer_group = OfficerGroup::findOrFail($id);
            $officer_group->delete();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Officer group deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found'
            ], 404);
        }
    }
}
