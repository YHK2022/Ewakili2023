<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use App\Models\Advocate\RenewalHistory;
use App\Models\Masterdata\RenewalBatch;
use App\Models\Advocate\NameChange;
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

class RequestController extends Controller
{

    /**
     * get renewal index page
     * @return \Illuminate\Http\Response
     */
    public function get_index()
    {
        if (Auth::check()) {
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
            return view('advocates.request.index', [
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
     * Submit out of time request
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function out_of_time_request(Request $request)
    {
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT RENEWAL";
            $status = "Under Review";


            $application = new Application();
            $application->submission_at = $submitdate;
            $application->active = "true";
            $application->uid = $uuid;
            $application->type = $appl_type;
            // $application->qualification = $qualification;
            $application->status = $status;
            $application->resubmission = "true";
            $application->un_reviewed = "0";
            $application->current_stage = "1";
            $application->profile_id = $profile_id;
            $application->workflow_process_id = "1";
            $application->actionstatus = "0";
            $application->stage = "0";
          
            $application->save();
               $file_names = ['Notice of Intention to Renew', 'Affidavit']; // Array of file names corresponding to the files
            if ($request->hasfile('files')) {
                $files = $request->file('files');

                foreach ($files as $key => $file) {
                  $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                  $name = $file_names[$key]; // Get the corresponding name from the array
                  $imageName = $name . '_' . time() . '.' . $ext;
                  $file->move('public/images/files', $imageName);

                     if($application){
                         $document = new Document;
                         $document->user_id = $user_id;
                         $document->name = $name;
                         $document->file = $imageName;
                         $document->auther = $profile_id;
                         $document->profile_id = $profile_id;
                         $document->application_id = $application->id;
                         $document->upload_date = $submitdate;
                         $document->status = $status;
                        // dd($document);
                       $document->save();
                     }
                }
            }
            return back()->with('success', 'Request submitted successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * Submit out of time with accumulation but no current penalty request
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function outoftime_without_penalty_request(Request $request, $id)
    {
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            // Check for renew year
            $renew_year = RenewalBatch::where('active', 'true')->first()->year;
            $profile_id = Profile::where('uid', $id)->first()->id;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT_RENEWAL";
            $status = "Under Review";

            //Chech if Application exists
            if (RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->exists()) {
                $renew_history = RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->select('application_id')->get();
            } else {
                $renew_history = "No data";
            }
            //echo $renew_history;exit;

            if ($renew_history != "No data") {


                if (Application::whereIn('id', $renew_history)->where('type', $appl_type)->exists()) {
                    return back()->with('warning', 'You have already applied for the same request, wait for your application to be approved');
                } else {

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

                    if ($application->save()) {

                        //Save application history
                        $hist_uuid = Str::uuid();
                        $year = RenewalBatch::where('active', 'true')->first()->year;
                        $batch_id = RenewalBatch::where('active', 'true')->first()->id;
                        $created_by = Auth::user()->id;

                        $renew_history = new RenewalHistory();
                        $renew_history->active = "true";
                        $renew_history->uid = $hist_uuid;
                        $renew_history->year = $year;
                        $renew_history->created_by = $created_by;
                        $renew_history->application_id = $application->id;
                        $renew_history->profile_id = $profile_id;
                        $renew_history->renewal_batch_id = $batch_id;
                        //dd($renew_history);exit;
                        $renew_history->save();

                        //Save application documents
                        if ($request->hasfile('files')) {
                            $files = $request->file('files');

                            foreach ($files as $file) {

                                $filename = pathinfo($file, PATHINFO_FILENAME);
                                $extension = $file->getClientOriginalExtension();
                                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                                $file->storeAs('public/files', $fileNameToStore);

                                $document = new Document;
                                $document->user_id = $user_id;
                                $document->name = $file['names'];
                                $document->file = $fileNameToStore;
                                $document->author = $profile_id;
                                $document->upload_date = $submitdate;
                                $document->status = $status;
                                //dd($document);exit;
                                $document->save();
                            }
                        }
                        return back()->with('success', 'Request submitted successfully');
                    }

                }

            } else {
                $application_status = "No data";

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

                if ($application->save()) {

                    //Save application history
                    $hist_uuid = Str::uuid();
                    $year = RenewalBatch::where('active', 'true')->first()->year;
                    $batch_id = RenewalBatch::where('active', 'true')->first()->id;
                    $created_by = Auth::user()->id;
                    $statuses = 0;

                    $renew_history = new RenewalHistory();
                    $renew_history->active = "true";
                    $renew_history->uid = $hist_uuid;
                    $renew_history->year = $year;
                    $renew_history->created_by = $created_by;
                    $renew_history->application_id = $application->id;
                    $renew_history->profile_id = $profile_id;
                    $renew_history->renewal_batch_id = $batch_id;
                    //dd($renew_history);exit;
                    $renew_history->save();

                    //Save application documents
                    if ($request->hasfile('files')) {
                        $files = $request->file('files');
                        $names = $request->names;

                        foreach ($files as $key => $file) {

                            $filename = pathinfo($file, PATHINFO_FILENAME);
                            $extension = $file->getClientOriginalExtension();
                            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                            $file->storeAs('public/files', $fileNameToStore);

//                            $files[] = Document::create([
//                                'user_id' => $user_id,
//                                'file' => $fileNameToStore,
//                                'name' => $names[$key],
//                                'author' => $profile_id,
//                                'upload_date' => $submitdate,
//                                'status' => $statuses
//                            ]);

                            $document = new Document;
                            $document->user_id = $user_id;
                            $document->name = $names[$key];
                            $document->file = $fileNameToStore;
                            $document->author = $profile_id;
                            $document->upload_date = $submitdate;
                            $document->status = $statuses;
                            dd($document);exit;
                            $document->save();
                        }
                    }
                    return back()->with('success', 'Request submitted successfully');
                }
            }
            return Redirect::to("auth/login")->withErrors('You do not have access!');
        }

    }


    public function change_name_request(Request $request)
    {
      
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $fullname = Profile::where('user_id', $user_id)->first()->fullname;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT NAME CHANGE";
            $status = "Under Review";


            $application = new Application();
            $application->submission_at = $submitdate;
            $application->active = "true";
            $application->uid = $uuid;
            $application->type = $appl_type;
            // $application->qualification = $qualification;
            $application->status = $status;
            $application->resubmission = "true";
            $application->un_reviewed = "0";
            $application->current_stage = "1";
            $application->profile_id = $profile_id;
            $application->workflow_process_id = "1";
            $application->actionstatus = "0";
            $application->stage = "0";
            // dd($application);
            $application->save();

            if($application){
            $namechange = new NameChange();
            $namechange->date_changed = $submitdate;
            $namechange->active = "true";
            $namechange->uid = $uuid;
            $namechange->new_name = $request->input('new_name');
            $namechange->previous_name = $fullname;
            $namechange->application_id = $application->id;
            $namechange->profile_id = $profile_id;  
            $namechange->save();         
            }


            if($application){
                if ($request->hasfile('files')) {
    $files = $request->file('files');
    foreach ($files as $file) {    
        $ext = pathinfo( $file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $file->getClientOriginalName();
        $imageName = date("Ymdhis");
        $imageName = $name . '_' . time() . '.' . $ext;
         $file->move('public/images/files', $imageName);
        //  $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        //  $file->move('public/images/files', $filename);


         

            if($application){
        $document = new Document;
        $document->user_id = $user_id;
        $document->name = $name;
        $document->file = $imageName;
        $document->auther = $profile_id;
        $document->profile_id = $profile_id;
        $document->application_id = $application->id;
        $document->upload_date = $submitdate;
        $document->status = $status;
        // dd($document);
        $document->save();
    }
}
}

            }
            return back()->with('success', 'Request submitted successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function non_practising_request(Request $request)
    {
      
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $fullname = Profile::where('user_id', $user_id)->first()->fullname;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT NON PRACTISING";
            $status = "Under Review";


            $application = new Application();
            $application->submission_at = $submitdate;
            $application->active = "true";
            $application->uid = $uuid;
            $application->type = $appl_type;
            // $application->qualification = $qualification;
            $application->status = $status;
            $application->resubmission = "true";
            $application->un_reviewed = "0";
            $application->current_stage = "1";
            $application->profile_id = $profile_id;
            $application->workflow_process_id = "1";
            $application->actionstatus = "0";
            $application->stage = "0";
            // dd($application);
            $application->save();

            

            if($application){
                if ($request->hasfile('files')) {
                 $files = $request->file('files');
   
                  foreach ($files as $file) {

        

             $ext = pathinfo( $file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $file->getClientOriginalName();
        $imageName = date("Ymdhis");
        $imageName = $name . '_' . time() . '.' . $ext;
         $file->move('public/images/files', $imageName);

         if($application){
        $document = new Document;
        $document->user_id = $user_id;
        $document->name = $name;
        $document->file = $imageName;
        $document->auther = $profile_id;
        $document->profile_id = $profile_id;
        $document->application_id = $application->id;
        $document->upload_date = $submitdate;
        $document->status = $status;
        // dd($document);
        $document->save();
      }
     }
    }
            }
            return back()->with('success', 'Request submitted successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     public function suspend_request(Request $request)
    {
      
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $fullname = Profile::where('user_id', $user_id)->first()->fullname;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT SUSPENDED";
            $status = "Under Review";


            $application = new Application();
            $application->submission_at = $submitdate;
            $application->active = "true";
            $application->uid = $uuid;
            $application->type = $appl_type;
            // $application->qualification = $qualification;
            $application->status = $status;
            $application->resubmission = "true";
            $application->un_reviewed = "0";
            $application->current_stage = "1";
            $application->profile_id = $profile_id;
            $application->workflow_process_id = "1";
            $application->actionstatus = "0";
            $application->stage = "0";
            // dd($application);
            $application->save();

            

            if($application){
                if ($request->hasfile('files')) {
                 $files = $request->file('files');
   
                  foreach ($files as $file) {

        

            $ext = pathinfo( $file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $file->getClientOriginalName();
        $imageName = date("Ymdhis");
        $imageName = $name . '_' . time() . '.' . $ext;
         $file->move('public/images/files', $imageName);

       

           if($application){
        $document = new Document;
        $document->user_id = $user_id;
        $document->name = $name;
        $document->file = $imageName;
        $document->auther = $profile_id;
        $document->profile_id = $profile_id;
        $document->application_id = $application->id;
        $document->upload_date = $submitdate;
        $document->status = $status;
        // dd($document);
        $document->save();
      }
     }
    }
            }
            return back()->with('success', 'Request submitted successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
      public function non_profit_request(Request $request)
    {
        //  $user_id = Auth::user()->id;
        // $qualification = Qualification::where('user_id', $user_id)->first();
        // dd($qualification);
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first()->qualification;
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $fullname = Profile::where('user_id', $user_id)->first()->fullname;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT NON PROFIT";
            $status = "Under Review";


            $application = new Application();
            $application->submission_at = $submitdate;
            $application->active = "true";
            $application->uid = $uuid;
            $application->type = $appl_type;
            // $application->qualification = $qualification;
            $application->status = $status;
            $application->resubmission = "true";
            $application->un_reviewed = "0";
            $application->current_stage = "1";
            $application->profile_id = $profile_id;
            $application->workflow_process_id = "1";
            $application->actionstatus = "0";
            $application->stage = "0";
            // dd($application);
            $application->save();

            

            if($application){
                if ($request->hasfile('files')) {
                 $files = $request->file('files');
   
                  foreach ($files as $file) {
        $ext = pathinfo( $file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $file->getClientOriginalName();
        $imageName = date("Ymdhis");
        $imageName = $name . '_' . time() . '.' . $ext;
         $file->move('public/images/files', $imageName);

        


            if($application){
        $document = new Document;
        $document->user_id = $user_id;
        $document->name = $name;
        $document->file = $imageName;
        $document->auther = $profile_id;
        $document->profile_id = $profile_id;
        $document->application_id = $application->id;
        $document->upload_date = $submitdate;
        $document->status = $status;
        // dd($document);
        $document->save();
      }
     }
    }
            }
            return back()->with('success', 'Request submitted successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

       public function resume_practising_request(Request $request)
    {
        //  $user_id = Auth::user()->id;
        // dd($user_id);
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $fullname = Profile::where('user_id', $user_id)->first()->fullname;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT RESUME PRACTISING";
            $status = "Under Review";


            $application = new Application();
            $application->submission_at = $submitdate;
            $application->active = "true";
            $application->uid = $uuid;
            $application->type = $appl_type;
            // $application->qualification = $qualification;
            $application->status = $status;
            $application->resubmission = "true";
            $application->un_reviewed = "0";
            $application->current_stage = "1";
            $application->profile_id = $profile_id;
            $application->workflow_process_id = "1";
            $application->actionstatus = "0";
            $application->stage = "0";
            // dd($application);
            $application->save();

            

            if($application){
                if ($request->hasfile('files')) {
                 $files = $request->file('files');
   
                  foreach ($files as $file) {

        

            $ext = pathinfo( $file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $file->getClientOriginalName();
        $imageName = date("Ymdhis");
        $imageName = $name . '_' . time() . '.' . $ext;
         $file->move('public/images/files', $imageName);

     


             if($application){
        $document = new Document;
        $document->user_id = $user_id;
        $document->name = $name;
        $document->file = $imageName;
        $document->auther = $profile_id;
        $document->profile_id = $profile_id;
        $document->application_id = $application->id;
        $document->upload_date = $submitdate;
        $document->status = $status;
        // dd($document);
        $document->save();
      }
     }
                }
            }
            return back()->with('success', 'Request submitted successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

       public function retire_practising_request(Request $request)
    {
        //  $user_id = Auth::user()->id;
        // dd($user_id);
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();


            //Save application information values
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $fullname = Profile::where('user_id', $user_id)->first()->fullname;
            $submitdate = date('Y-m-d H:i:s');
            $uuid = Str::uuid();
            $appl_type = "PERMIT RETIRE PRACTISING";
            $status = "Under Review";


            $application = new Application();
            $application->submission_at = $submitdate;
            $application->active = "true";
            $application->uid = $uuid;
            $application->type = $appl_type;
            // $application->qualification = $qualification;
            $application->status = $status;
            $application->resubmission = "true";
            $application->un_reviewed = "0";
            $application->current_stage = "1";
            $application->profile_id = $profile_id;
            $application->workflow_process_id = "1";
            $application->actionstatus = "0";
            $application->stage = "0";
            // dd($application);
            $application->save();

            

            if($application){
                if ($request->hasfile('files')) {
                 $files = $request->file('files');
   
                  foreach ($files as $file) {

       

        $ext = pathinfo( $file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $file->getClientOriginalName();
        $imageName = date("Ymdhis");
        $imageName = $name . '_' . time() . '.' . $ext;
         $file->move('public/images/files', $imageName);

      
        

            if($application){
        $document = new Document;
        $document->user_id = $user_id;
        $document->name = $name;
        $document->file = $imageName;
        $document->auther = $profile_id;
        $document->profile_id = $profile_id;
        $document->application_id = $application->id;
        $document->upload_date = $submitdate;
        $document->status = $status;
        // dd($document);
        $document->save();
      }
     }
    }
            }
            return back()->with('success', 'Request submitted successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
}