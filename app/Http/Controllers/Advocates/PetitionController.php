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
use App\Models\Petitions\Petition;
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

class PetitionController extends Controller
{
    /**
     * get profile registration form
     * @return \Illuminate\Http\Response
     */
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
            return view('advocates.profile.personal_details', [
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
            $qualification = Qualification::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //dd($profile);exit;
            return view('advocates.profile.qualification', [
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
            $attach_move = AttachmentMove::where('user_id', $user_id)->first();
            //dd($profile);exit;
            return view('advocates.profile.attachment', [
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
        //dd($profile);exit;
        $profile->save();

        //Insert petition forms values
        if($profile){
        $petition_form_one = 1;
        $form = new PetitionForm();
        $form->personal_detail = $petition_form_one;
        $form->user_id = Auth::user()->id;
        $form->profile_id = $profile->id;
        $form->save();

        $petition = new Petition();
        $petition->profile_id = $profile->id;
        $petition->uid = $uuid;
        $petition->active = "true";
        $petition->petition_session_id = $session_id;
        $petition->save();

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
            'olevel' => 'required',
            'alevel' => 'required',
            'llb' => 'required',
            'lst' => 'required',
            'validation' => 'required',
        ]);

        $qualification = new Qualification();
        $qualification->o_level = $request->input('olevel');
        $qualification->a_level = $request->input('alevel');
        $qualification->llb = $request->input('llb');
        $qualification->lst = $request->input('lst');
        $qualification->names_validation = $request->input('validation');
        $qualification->user_id = Auth::user()->id;
        $qualification->profile_id = $profile_id;
        //dd($qualification);exit;
        $qualification->save();


        if($qualification){
         //Update petition forms values
        $qualification_form_value = 1;
        $qualification_form = DB::table('petition_forms')
                        ->where('user_id', $user_id)
                        ->update(['qualification' => $qualification_form_value]);
        $qualifications = DB::table('petitions')
                        ->where('profile_id', $profile_id)
                        ->update(['qualifications' => $qualification->id]);
        //Update progress values
        $progress = DB::table('application_moves')
                        ->where('user_id', $user_id)
                        ->update(['appl_progress' => $new_progress]);

        //Save application information values
        $submitdate = date('Y-m-d H:i:s');
        $uuid = Str::uuid();
        $appl_type = "PETITION";
        $lst = $request->input('lst');
        if($lst == "Yes"){
            $qualification = "LAW SCHOOL";
        }

        if($lst == "No"){
            $qualification = "BAR";
        }
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
        $application->current_stage = "1";
        $application->profile_id = $profile_id;
        $application->workflow_process_id = "1";
        $application->actionstatus = "0";
        $application->stage = "0";
        //dd($application);exit;
        $application->save();

        if($application){
             $apps = DB::table('petitions')
                        ->where('profile_id', $profile_id)
                        ->update(['application_id' => $application->id]);
        }


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

$qualification = Qualification::findOrFail($id);
// dd($qualification);
$this->validate($request, [
    'olevel' => 'required',
    'alevel' => 'required',
    'llb' => 'required',
    'lst' => 'required',
    'validation' => 'required',
]);

$qualification->o_level = $request->input('olevel');
$qualification->a_level = $request->input('alevel');
$qualification->llb = $request->input('llb');
$qualification->lst = $request->input('lst');
$qualification->names_validation = $request->input('validation');

//dd($qualification);exit;
$qualification->save();

if ($qualification) {
    
    //Save application information values
    $submitdate = date('Y-m-d H:i:s');
    $lst = $request->input('lst');
    if ($lst == "Yes") {
        $qualification = "LAW SCHOOL";
    }

    if ($lst == "No") {
        $qualification = "BAR";
    }
    $application = Application::findOrFail($profile_id);
    $application->submission_at = $submitdate;
    $application->qualification = $qualification;
    // dd($application);
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

            // $lims_category_data['image'] = $imageName;
        

        //  if($request->hasFile('profile_picture')) {
        //     $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('profile_picture')->getClientOriginalExtension();
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     $request->file('profile_picture')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
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
                $attachment = new AttachmentMove;
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
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Petition for Admission and Enrollment";
        $status = 0;
        $attachment_type_id = 1;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'petition' => 'required|mimes:pdf|max:2048',
         ]);


         $petition = $request->petition;
        if ($petition) {
            $ext = pathinfo($petition->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $petition->move('public/images/files', $imageName);

        

            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['petition' => $imageName]);
            }

         }

        return back()->with('success', 'Petition Document successfully added');

        }
    }




    public function delete_petition(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 1;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['petition' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
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
    public function add_csee_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Certificate of Secondary Education (CSEE)";
        $status = 0;
        $attachment_type_id = 4;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'csee' => 'required|mimes:pdf|max:2048',
         ]);
          $csee = $request->csee;
        if ($csee) {
            $ext = pathinfo($csee->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $csee->move('public/images/files', $imageName);

        //  if($request->hasFile('csee')) {
        //     $filenameWithExt = $request->file('csee')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('csee')->getClientOriginalExtension();
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     $request->file('csee')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['csee' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }




     public function delete_csee(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 4;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['csee' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'CSEE Document Deleted  successfully ');
    }
    /**
     * upload certificate of recognition necta
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_necta_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "NECTA Certificate of Recognition";
        $status = 0;
        $attachment_type_id = 6;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'necta' => 'required|mimes:pdf|max:2048',
         ]);

         $necta = $request->necta;
        if ($necta) {
            $ext = pathinfo($necta->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $necta->move('public/images/files', $imageName);
       
            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['necta' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


     public function delete_necta(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 6;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['necta' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'CSEE Document Deleted  successfully ');
    }

    /**
     * upload certificate of a level
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_acsee_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Advanced Certificate of Secondary Education";
        $status = 0;
        $attachment_type_id = 7;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'acsee' => 'required|mimes:pdf|max:2048',
         ]);
          $acsee = $request->acsee;
        if ($acsee) {
            $ext = pathinfo($acsee->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $acsee->move('public/images/files', $imageName);

      
            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['acsee' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }






     public function delete_acsee(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 7;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['acsee' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }
    /**
     * upload certificate of recognition nacte
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_nacte_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "NACTE/NECTA Certificate of Recognition";
        $status = 0;
        $attachment_type_id = 12;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'nacte' => 'required|mimes:pdf|max:2048',
         ]);

         $nacte = $request->nacte;
        if ($nacte) {
            $ext = pathinfo($nacte->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $nacte->move('public/images/files', $imageName);
       
            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['nacte' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


     public function delete_nacte(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 12;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['nacte' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
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
    public function add_llbcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "LLB Certificate";
        $status = 0;
        $attachment_type_id = 13;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'llbcert' => 'required|mimes:pdf|max:2048',
         ]);


         $llbcert = $request->llbcert;
        if ($llbcert) {
            $ext = pathinfo($llbcert->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $llbcert->move('public/images/files', $imageName);

            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['llb_cert' => $imageName]);
            }

         }


        return back()->with('success', 'Certificate successfully added');

        }
    }

     public function delete_llbcert(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 13;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['llb_cert' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate for llb tanscript
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_llbtrans_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "LLB Transcript";
        $status = 0;
        $attachment_type_id = 14;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'llbtrans' => 'required|mimes:pdf|max:2048',
         ]);

         $llbtrans = $request->llbtrans;
        if ($llbtrans) {
            $ext = pathinfo($llbtrans->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $llbtrans->move('public/images/files', $imageName);
        
            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['llb_trans' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }



     public function delete_llbtrans(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 14;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['llb_trans' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate of TCU recognition
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_tcu_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "TCU Certificate of Recognition";
        $status = 0;
        $attachment_type_id = 15;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'tcu' => 'required|mimes:pdf|max:2048',
         ]);

         $tcu = $request->tcu;
        if ($tcu) {
            $ext = pathinfo($tcu->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $tcu->move('public/images/files', $imageName);
        
            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['tcu' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }

     public function delete_tcu(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 15;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['tcu' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate for lst
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_lstcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Post Graduate Diploma in Legal Practice from LST";
        $status = 0;
        $attachment_type_id = 17;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'lstcert' => 'required|mimes:pdf|max:2048',
         ]);

           $lstcert = $request->lstcert;
        if ($lstcert) {
            $ext = pathinfo($lstcert->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $lstcert->move('public/images/files', $imageName);
     
            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['lst_cert' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }

     public function delete_lstcert(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 17;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['lst_cert' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate for lst final results
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_lsttrans_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Final Result Post Graduate Diploma in Legal Practice from LST";
        $status = 0;
        $attachment_type_id = 16;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'lsttrans' => 'required|mimes:pdf|max:2048',
         ]);

         
           $lsttrans = $request->lsttrans;
        if ($lsttrans) {
            $ext = pathinfo($lsttrans->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $lsttrans->move('public/images/files', $imageName);

            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['lst_results' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }

  public function delete_lsttrans(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 16;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['lst_results' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate of pupilage
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_pupilage_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Letter for Pupilage";
        $status = 0;
        $attachment_type_id = 20;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'pupilage' => 'required|mimes:pdf|max:2048',
         ]);

         $pupilage = $request->pupilage;
        if ($pupilage) {
            $ext = pathinfo($pupilage->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $pupilage->move('public/images/files', $imageName);
  
            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['pupilage' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }
 public function delete_pupilage(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 20;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['pupilage' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate of intenship/extenship
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_intenship_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Internship / Externship";
        $status = 0;
        $attachment_type_id = 21;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'intenship' => 'required|mimes:pdf|max:2048',
         ]);
           $intenship = $request->intenship;
        if ($intenship) {
            $ext = pathinfo($intenship->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $intenship->move('public/images/files', $imageName);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->attachment_type_id = $attachment_type_id;
            $document->auther = $profile_id;
            $document->application_id = $application_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['intenship' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }

 public function delete_intenship(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 21;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['intenship' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }
    /**
     * upload employer later
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_empletter_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Employer Letter";
        $status = 0;
        $attachment_type_id = 19;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'empletter' => 'required|mimes:pdf|max:2048',
         ]);

         $empletter = $request->empletter;
        if ($empletter) {
            $ext = pathinfo($empletter->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $empletter->move('public/images/files', $imageName);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->application_id  = $application_id;
            $document->attachment_type_id = $attachment_type_id;
            $document->auther = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['emp_later' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }
 public function delete_empletter(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 19;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['emp_later' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload deed poll
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_deedpoll_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Deed Poll";
        $status = 0;
        $attachment_type_id = 3;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'deedpoll' => 'required|mimes:pdf|max:2048',
         ]);

            $deedpoll = $request->deedpoll;
        if ($deedpoll) {
            $ext = pathinfo($deedpoll->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $deedpoll->move('public/images/files', $imageName);

            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['deedpoll' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }
 public function delete_deedpall(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 3;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['deedpoll' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**deed
     * upload birth certificate
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_birthcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Birth Certificate";
        $status = 0;
        $attachment_type_id = 2;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'birthcert' => 'required|mimes:pdf|max:2048',
         ]);
           $birthcert = $request->birthcert;
        if ($birthcert) {
            $ext = pathinfo($birthcert->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $birthcert->move('public/images/files', $imageName);

            $document = new Document;
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
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['birth_cert' => $imageName]);
            }

         }

        return back()->with('success', 'Birth Certificate successfully added');

        }
    }
 public function delete_birthcert(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 2;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['birth_cert' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

    /**
     * upload certificate of good character
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_charcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Certificate of Good Character";
        $status = 0;
        $attachment_type_id = 18;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'charcert' => 'required|mimes:pdf|max:2048',
         ]);


         $charcert = $request->charcert;
        if ($charcert) {
            $ext = pathinfo($charcert->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '_' . time() . '.' . $ext;
            $charcert->move('public/images/files', $imageName);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $imageName;
            $document->attachment_type_id = $attachment_type_id;
            $document->auther = $profile_id;
            $document->application_id = $application_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['char_cert' => $imageName]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }

    public function delete_charcert(Request $request , $id)
    {
        $user_id = Auth()->user()->id;
        $attachment_type_id = 18;
        // $document = AttachmentMove::findOrFail($id);
         
    $document = DB::table('attachment_moves')
        ->where('id', $id)
        ->update(['char_cert' => null]);
         
        if ($document) {
    //Update profile picture values
    $profile_picture = DB::table('documents')
        ->where('user_id', $user_id)
        ->where('attachment_type_id', $attachment_type_id )
        ->delete();
}

        return back()->with('success', 'Petition Document Deleted  successfully ');
    }

     /**
     * upload submit attachments
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
    public function get_venue_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $profile_id= Profile::where('user_id', $user_id)->first()->id;
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = Petition::where('profile_id', $profile_id)->first();
        //   dd($llb);
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //dd($profile);exit;
            return view('advocates.profile.venue', [
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


     public function get_llb_index(Request $request)
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
            //dd($profile);exit;
            return view('advocates.profile.llb', [
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
     * get lst index
     * @return \Illuminate\Http\Response
     */
    public function get_lst_index(Request $request)
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
            //dd($profile);exit;
            return view('advocates.profile.lst', [
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
     * get work experience index
     * @return \Illuminate\Http\Response
     */
    public function get_experience_index(Request $request)
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
            //dd($profile);exit;
            return view('advocates.profile.experience', [
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
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //echo $attachment;exit;
            if($progress){
                $progress_value = ApplicationMove::where('user_id', $user_id)->first('appl_progress')->appl_progress;
                    return view('advocates.profile.finish', [
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
                return view('advocates.profile.finish', [
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
    public function get_firm_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $firm = FirmMembership::where('user_id', $user_id)->first();
            $request_confirmation = FirmRequestConfirmation::where('requester_id', $user_id)->first();
            //  dd($firm);
            if($firm){
                $firm_id = FirmMembership::where('user_id', $user_id)->first('firm_id')->firm_id;
                $firm_address = FirmAddress::where('firm_id',$firm_id)->get();
                $firm_creator_id = Firm::where('id', $firm_id)->first('created_by')->created_by;

                $firm_owner = User::where('id', $firm_creator_id)->first();

                $experience = WorkExperience::where('user_id', $user_id)->first();
                //echo $attachment;exit;
                return view('advocates.profile.firm', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'request_confirmation' => $request_confirmation,
                    'llb' => $llb,
                    'lst' => $lst,
                    'firm' => $firm,
                    'firm_address' => $firm_address,
                    'firm_owner' => $firm_owner,
                    'experience' => $experience,
                ]);
            }else if($request_confirmation){
                $experience = WorkExperience::where('user_id', $user_id)->first();
                //echo $attachment;exit;
                return view('advocates.profile.firm', [
                    'request_confirmation' => $request_confirmation,
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'firm' => $firm,
                    'experience' => $experience,
                ]);
            }else{
                $experience = WorkExperience::where('user_id', $user_id)->first();
                //echo $attachment;exit;
                return view('advocates.profile.firm', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'firm' => $firm,
                    'request_confirmation' => $request_confirmation,
                    'experience' => $experience,
                ]);
            }

          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


      /**
     * get firm & work places add form index
     * @return \Illuminate\Http\Response
     */
    public function get_add_firm_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $firm = FirmMembership::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //echo $attachment;exit;
            return view('advocates.profile.add_firm', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'firm' => $firm,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


       /**
     * get firm & work confirmation form index
     * @return \Illuminate\Http\Response
     */
    public function get_firm_confirmation(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $firm = FirmMembership::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //echo $attachment;exit;
            return view('advocates.profile.confirm_firm', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'firm' => $firm,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add llb university or college
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_llb(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required',
            'complete_year' => 'required|numeric',
        ]);

        $college = new LlbCollege();
        $college->name = $request->input('name');
        $college->completed_year = $request->input('complete_year');
        $college->user_id = Auth::user()->id;
        $college->save();

        //Update petition form values and progress
        if($college){
        //Update progress values
        $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
        $progress_form = 10;
        $value = 1;

        $new_progress = $progress + $progress_form;
        $progress = DB::table('application_moves')
                        ->where('user_id', $user_id)
                        ->update(['appl_progress' => $new_progress]);

         //Update petition form
         $profile_picture = DB::table('petition_forms')
                        ->where('user_id', $user_id)
                        ->update(['llb' => $value]);

        }
        return back()->with('success', 'University / College info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     public function add_venue(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $status = PetitionSession::where('active', 'true')->first()->id;
        $profile_id= Profile::where('user_id', $user_id)->first()->id;
        $llb = Petition::where('profile_id', $profile_id)->first();
        $this->validate($request, [
            'venue_id' => 'required',
        ]);

        $llb->venue_id = $request->input('venue_id');
        $llb->save();

        if($llb){
            $appearance_id = DB::table('appearances')
                      ->where('petition_session_id',$status )
                      ->where('venue_id', $llb->venue_id)
                       ->value('id');
            $progress = DB::table('petitions')
                        ->where('profile_id', $profile_id)
                         ->update(['venue_id' => $llb->venue_id,
                                    'appearance_id' => $appearance_id]);
        }

        return back()->with('success', 'Appearance Venue info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


     public function update_venue(Request $request, $id)
    {
        if(Auth::check()){
       $user_id = Auth::user()->id;
        $profile_id= Profile::where('user_id', $user_id)->first()->id;
        $status = PetitionSession::where('active', 'true')->first()->id;

        $llb = Petition::where('profile_id', $profile_id)->first();
        $this->validate($request, [
            'venue_id' => 'required',
        ]);

        $llb->venue_id = $request->input('venue_id');
        $llb->save();

        if($llb)
        {
            $update_venue = DB::table('petitions')
                       ->where('profile_id', $profile_id)
                        ->update(['petition_session_id' => $status]);

        }


        
        return back()->with('success', 'Appearance Venue info Updated successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

   public function add_bar_exam(Request $request)

      {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $status = PetitionSession::where('active', 'true')->first()->id;
        $profile_id= Profile::where('user_id', $user_id)->first()->id;
        $llb = Petition::where('profile_id', $profile_id)->first();
        $this->validate($request, [
            'venue_id' => 'required',
        ]);

        $llb->venue_id = $request->input('venue_id');
        $llb->save();

        if($llb){
            $progress = DB::table('petitions')
                        ->where('profile_id', $profile_id)
                         ->update(['venue_id' => $llb->venue_id]);

        }

        
        return back()->with('success', 'Appearance Venue info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


     public function update_bar_exam(Request $request, $id)
    {
        if(Auth::check()){
       $user_id = Auth::user()->id;
        $profile_id= Profile::where('user_id', $user_id)->first()->id;
        $status = PetitionSession::where('active', 'true')->first()->id;

        $llb = Petition::where('profile_id', $profile_id)->first();
        $this->validate($request, [
            'venue_id' => 'required',
        ]);

        $llb->venue_id = $request->input('venue_id');
        $llb->save();

        if($llb)
        {
            $update_venue = DB::table('petitions')
                       ->where('profile_id', $profile_id)
                        ->update(['petition_session_id' => $status]);

        }


        
        return back()->with('success', 'Appearance Venue info Updated successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
 public function update_llb(Request $request , $id)
    {
        if(Auth::check()){
        $college =  LlbCollege::findOrfail($id);
        // dd($college);
        $this->validate($request, [
            'name' => 'required',
            'complete_year' => 'required|numeric',
        ]);

        $college->name = $request->input('name');
        $college->completed_year = $request->input('complete_year');
        $college->save();

        
        return back()->with('success', 'University / College info Updated successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    /**
     * add  firm or workplace
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_firm(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $profile_id = Profile::where('user_id', $user_id)->first()->profile_id;
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'region' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'street' => 'required',
        ]);

        if($request->input('type') == "Law Firm" || $request->input('type') == "Business Company"){
            $member = 1;
            $date = date("Y-m-d");
            $position = "HQ";
            $approval_status = 'APPROVED';
            $uuid = Str::uuid();

            $firm = new Firm();
            $firm->name = $request->input('name');
            $firm->type = $request->input('type');
            $firm->tin = $request->input('tin');
            $firm->members = $member;
            $firm->active = true;
            $firm->uid = $uuid;
            $firm->taxpayer_name = $request->input('taxpayer');
            $firm->created_by = Auth::user()->id;
            $firm->save();

            $firm_membership = new FirmMembership();
            $firm_membership->date_joined = $date;
            $firm_membership->date_requested = $date;
            $firm_membership->firm_id = $firm->id;
            $firm_membership->active = true;
            $firm_membership->uid = $uuid;
            $firm_membership->approval_status = $approval_status;
            $firm_membership->profile_id = $profile_id;
            $firm_membership->user_id = Auth::user()->id;
            $firm_membership->save();

            $firm_address = new FirmAddress();
            $firm_address->address = $request->input('address');
            $firm_address->region = $request->input('region');
            $firm_address->district = $request->input('district');
            $firm_address->ward = $request->input('ward');
            $firm_address->street = $request->input('street');
            $firm_address->postcode = $request->input('postcode');
            $firm_address->firm_id = $firm->id;
            $firm_address->active = true;
            $firm_address->uid = $uuid;
            $firm_address->position = $position;
            $firm_address->save();

            //Update petition form values and progress
            if($firm){
            //Update progress values
            $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
            $progress_form = 5;
            $value = 1;
            $new_progress = $progress + $progress_form;

            $progress = DB::table('application_moves')
                            ->where('user_id', $user_id)
                            ->update(['appl_progress' => $new_progress]);

            //Update petition form
            $profile_picture = DB::table('petition_forms')
                            ->where('user_id', $user_id)
                            ->update(['firm' => $value]);


            }
            return redirect::to("petition/firm")->with('success', 'Workplace added successfully');

        }else{

            $member = 1;
            $date = date("Y-m-d");
            $position = "HQ";
            $uuid = Str::uuid();
            $firm = new Firm();
            $firm->name = $request->input('name');
            $firm->type = $request->input('type');
            $firm->members = $member;
            $firm->active = true;
            $firm->uid = $uuid;
            $firm->created_by = Auth::user()->id;
            $firm->save();

            $firm_membership = new FirmMembership();
            $firm_membership->date_joined = $date;
            $firm_membership->date_requested = $date;
            $firm_membership->firm_id = $firm->id;
            $firm_membership->active = true;
            $firm_membership->uid = $uuid;
            $firm_membership->user_id = Auth::user()->id;
            $firm_membership->save();

            $firm_address = new FirmMembership();
            $firm_address->address = $request->input('address');
            $firm_address->region = $request->input('region');
            $firm_address->district = $request->input('district');
            $firm_address->ward = $request->input('ward');
            $firm_address->street = $request->input('street');
            $firm_address->postcode = $request->input('postcode');
            $firm_address->firm_id = $firm->id;
            $firm_address->position = $position;
            $firm_address->save();

            //Update petition form values and progress
            if($firm){
            //Update progress values
            $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
            $progress_form = 5;
            $value = 1;
            $new_progress = $progress + $progress_form;

            $progress = DB::table('application_moves')
                            ->where('user_id', $user_id)
                            ->update(['appl_progress' => $new_progress]);

            //Update petition form
            $profile_picture = DB::table('petition_forms')
                            ->where('user_id', $user_id)
                            ->update(['firm' => $value]);


            }
            return redirect::to("petition/firm")->with('success', 'Workplace added successfully');
        }

        }

        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * add law school college
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_lst(Request $request)
    {
        if(Auth::check()){

        // Validate LST Reg Number with LAW SCHOOL system API



        $this->validate($request, [
            'name' => 'required',
            'reg_number' => 'required',
            'complete_year' => 'required|numeric',
        ]);
            $user_id = Auth::user()->id;
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
        $college = new LstCollege();
        $college->name = $request->input('name');
        $college->reg_number = $request->input('reg_number');
        $college->completed_year = $request->input('complete_year');
        $college->user_id = Auth::user()->id;
        $college->save();

        if($college){
            $petition = DB::table('petitions')
                            ->where('profile_id', $profile_id)
                            ->update(['lst_regno' => $college->reg_number]);
        }

        return back()->with('success', 'Post graduate in legal practice info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
 public function update_lst(Request $request, $id)
    {
        if(Auth::check()){

        // Validate LST Reg Number with LAW SCHOOL system API


        $college =  LstCollege::findOrfail($id);
// dd($college);
        $this->validate($request, [
            'name' => 'required',
            'reg_number' => 'required',
            'complete_year' => 'required|numeric',
        ]);

        $college->name = $request->input('name');
        $college->reg_number = $request->input('reg_number');
        $college->completed_year = $request->input('complete_year');
        $college->save();

        return back()->with('success', 'Post graduate in legal practice info Updated successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add work experience
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_experience(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'start_year' => 'required|numeric',
            'end_year' => 'required|numeric',
        ]);
        $uuid = Str::uuid();
        $user_id = Auth::user()->id;
        $profile_id = Profile::where('user_id', $user_id)->first()->id;
        $experience = new WorkExperience();
        $experience->organisation = $request->input('name');
        $experience->title = $request->input('title');
        $experience->start_year = $request->input('start_year');
        $experience->end_year = $request->input('end_year');
        $experience->user_id = Auth::user()->id;
        $experience->active = "true";
        $experience->profile_id = $profile_id;
        $experience->uid = $uuid;

        $experience->save();

        //Update petition form values and progress
        if($experience){
            //Update progress values
            $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
            $progress_form = 10;
            $value = 1;

            $new_progress = $progress + $progress_form;
            $progress = DB::table('application_moves')
                            ->where('user_id', $user_id)
                            ->update(['appl_progress' => $new_progress]);

             //Update petition form
             $profile_picture = DB::table('petition_forms')
                            ->where('user_id', $user_id)
                            ->update(['experience' => $value]);

        }
        return back()->with('success', 'Work experience info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

 public function update_experience(Request $request, $id)
    {
        if(Auth::check()){
        
        $experience =  WorkExperience::findOrfail($id);
        // dd($experience);
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'start_year' => 'required|numeric',
            'end_year' => 'required|numeric',
        ]);

        $experience->organisation = $request->input('name');
        $experience->title = $request->input('title');
        $experience->start_year = $request->input('start_year');
        $experience->end_year = $request->input('end_year');
        $experience->save();
        return back()->with('success', 'Work experience info Updated successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    /**
     * Law firms live search
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function search_firm(Request $request)
    {
        $search_val = $request->id;

        if (is_null($search_val))
        {
        return view('advocates.profile.firm');
        }
        else
        {

        $posts_data = Firm::where('name','LIKE',"%{$search_val}%")->get();

        $output = '';

        if (count($posts_data)>0) {

            $output = '<ul class="list-group" style="display: block; position: relative;">';

            foreach ($posts_data as $row){
                $register = url('petition/request-firm',$row->id);
                $output .= '<li class="list-group-item">'.'<table>'.'<tr>'.'<td style="width:90%;font-size:15px;">'.$row->name.'</td>'.'<td style="width:10%">'.'<a class="btn btn-danger btn-xs" style="" href="'.$register.'">'.'Register'.'</a>'.'</td>'.'</tr>'.'</table>'.'</li>';
            }

            $output .= '</ul>';
        }
        else {
            $add = url('petition/add-firm');
            $output .= '<li class="list-group-item">'.'<table>'.'<tr>'.'<td style="width:90%;font-size:15px;">'.'No firm results found !'.'</td>'.'<td style="width:10%">'.'<a class="btn btn-danger btn-xs" style="" href="'.$add.'">'.'Add new firm'.'</a>'.'</td>'.'</tr>'.'</table>'.'</li>';
        }

        return $output;

      }
    }


    /**
     * request firm registration
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_firm_request(Request $request, $id)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $firm_id = $id;

        $requester_name = Auth::user()->username;
        $requester_phone = Auth::user()->phone_number;

        $firm_owner_id = Firm::where('id', $firm_id)->first('created_by')->created_by;

        $firm_owner_email = User::where('id', $firm_owner_id)->first('email')->email;

        $firm_owner_name = User::where('id', $firm_owner_id)->first('username')->username;

        $firm_name = Firm::where('id', $id)->first('name')->name;

        // Generate and send verificaion code to firm owner

        $verf_code = mt_rand(1,100000000);

        $confirmation = new FirmRequestConfirmation();
        $confirmation->firm_id = $firm_id;
        $confirmation->created_by = $firm_owner_id;
        $confirmation->requester_id = $user_id;
        $confirmation->ver_code = $verf_code;
        $confirmation->save();

        $email = 'Dear'." ".$firm_owner_name." ".$requester_name." ".'with mobile number'." ".$requester_phone." ".'has requested to register under Firm'." ".$firm_name." ".', If you recognize this member please share with him/her following registration confirmation code '." ".$verf_code;

        $toEmail = $firm_owner_email;
        \Mail::to($toEmail)->send(new VerifyFirm($email));

        return redirect()->intended('petition/firm-confirmation')->with('success', 'Email confirmation code sent to '. $toEmail);

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


        /**
     * request firm registration
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function post_firm_confirmation(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;

        $ver_code = $request->input('code');

        //Find and compare the verificaion code
        $verf_code = FirmRequestConfirmation::where('requester_id', $user_id)->first('ver_code')->ver_code;
        $firm_id = FirmRequestConfirmation::where('requester_id', $user_id)->first('firm_id')->firm_id;

        if($ver_code != $verf_code ){

            return back()->withErrors('You entered wrong code!');

        }else{

            //Chech for application moves
            $application_moves = ApplicationMove::where('user_id', $user_id)->first();

            if($application_moves){

                //Update firm members values
                $current_value = Firm::where('id', $firm_id)->first('members')->members;

                $progress_member = 1;
                $new_members = $current_value + $progress_member;

                $members = DB::table('firms')
                                ->where('id', $firm_id)
                                ->update(['members' => $new_members]);

                //Update progress values
                $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
                $progress_form = 5;
                $value = 1;
                $new_progress = $progress + $progress_form;

                $progress = DB::table('application_moves')
                                ->where('user_id', $user_id)
                                ->update(['appl_progress' => $new_progress]);

                //Update petition form
                $petition_form = DB::table('petition_forms')
                                ->where('user_id', $user_id)
                                ->update(['firm' => $value]);

                //Add firm membership
                $date = date("Y-m-d");
                 $uuid = Str::uuid();
                 $user_id = Auth::user()->id;
                $profile_id = Profile::where('user_id', $user_id)->first()->id;
                $firm_membership = new FirmMembership();
                $firm_membership->date_joined = $date;
                $firm_membership->date_requested = $date;
                $firm_membership->firm_id = $firm_id;
                $firm_membership->active = true;
                $firm_membership->uid = $uuid;
                $firm_membership->profile_id = $profile_id;
                $firm_membership->user_id = Auth::user()->id;
                $firm_membership->save();

                return Redirect::to("petition/add-firm")->with('success', 'Firm registration successful!');


            }else{
                return back()->withErrors('You cant complete this step until you submit at least your personal information!');
            }


        }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


          /**
     * submit entire application
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function submit_application(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;

                //Update progress values
                $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
                $progress_form = 5;
                $value = 1;
             $profile_id = Profile::where('user_id', $user_id)->first()->id;
                $status = "PENDING";
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


                return Redirect::to("petition/finish")->with('success', 'Application submitted successful!');


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
                $status = "PENDING";
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