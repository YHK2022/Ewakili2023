<?php

namespace App\Http\Controllers\Management;

use App\Models\Masterdata\PetitionSession;
use App\Models\Masterdata\Coram;
use App\Models\Masterdata\CoramCleMember;
use App\Models\Masterdata\CleMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillEmail;
use App\Models\Advocate\Certificate;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\Petition;
use App\Models\Petitions\Firm;
use Illuminate\Support\Carbon;
use App\Models\Advocate\Advocate;
use Illuminate\Support\Facades\DB;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\FirmAddress;
use App\Models\Petitions\PetitionEducation;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\ApplicationApproval;
use App\Models\Petitions\Bill;
use DateTime;
use \SimpleXMLElement;
use Illuminate\Support\Facades\Redirect;
use App\Profile;
use App\User;
use App\Models\Petitions\Application;

class PetitionApplicationUnderReviewController extends Controller
{
    /**
     * get a listing of petition applications.
     * @return \Illuminate\Http\Response
     */
    public function get_index() 
    {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $stage = 1;
            $application_type = "PETITION";
            $status = "PENDING";
            $resubmit = "RE SUBMIT";


            $applications = Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $status)->orderBy('created_at', 'desc')->paginate(20);
            $application_count = Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $status)->orderBy('created_at', 'desc')->count();
             $approved_count = Application::where('current_stage', 2)->where('type', $application_type)
            ->where('status', $status)->orderBy('created_at', 'desc')->count();
             $approved_applications = Application::where('current_stage', 2)->where('type', $application_type)
            ->where('status', $status)->orderBy('created_at', 'desc')->get();

            $resubmit_applications =  Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $resubmit)->orderBy('created_at', 'desc')->paginate(20);
             $resubmit_applications_count =  Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $resubmit)->orderBy('created_at', 'desc')->count();


            return view('management.petition_application.under_review.index', [
                'profile' => $profile,
                'resubmit_applications_count' => $resubmit_applications_count,
                'resubmit_applications' => $resubmit_applications,
                'applications' => $applications,
                'application_count' => $application_count,
                'approved_count' => $approved_count,
                'approved_applications' => $approved_applications,

            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     public function get_rhc() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $stage = 2;
            $status = 'PENDING';
            $application_type = "PETITION";
            $resubmit = 'RE SUBMIT';

         
            $applications = Application::where('current_stage', $stage)->where('status', $status)->where('type', $application_type)
            ->orderBy('created_at', 'desc')->paginate(20);
            $applications_count = Application::where('current_stage', $stage)->where('type', $application_type)
            ->orderBy('created_at', 'desc')->where('status', $status)->count();
             $approved_count = Application::where('current_stage', 3)->where('type', $application_type)
            ->orderBy('created_at', 'desc')->count();
             $approved_applications = Application::where('current_stage', 3)->where('type', $application_type)
            ->orderBy('created_at', 'desc')->get();

            $resubmit_applications =  Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $resubmit)->orderBy('created_at', 'desc')->paginate(20);

             $resubmit_applications_count =  Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $resubmit)->orderBy('created_at', 'desc')->count();

            return view('management.petition_application.rhc.index', [
                'profile' => $profile,
                'resubmit_applications' => $resubmit_applications,
                'resubmit_applications_count' => $resubmit_applications_count,
                'applications' => $applications,
                'applications_count' => $applications_count,
                'approved_count' => $approved_count,
                'approved_applications' => $approved_applications,

            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     public function edit_front(Request $request, $id)
    {

        if(Auth::check())
        {
            
                $stage = Application::findOrFail($id);
                // dd($stage->id);
                $uuid = Str::uuid();
                $this->validate($request, [
                'status' => 'required',
                ]);
                $stage->status = $request->input('status');
                $stage->save();
                
             

                if ($stage->status == "RE SUBMIT") 
                {
                    $cj = DB::table('applications')
                     ->where('id', $id)->update([ 'current_stage' => 1]);

                    $comment = new ApplicationApproval();
                    $comment->comment = $request->input('comment');
                    $comment->active = true;
                    $comment->decision = "RE SUBMIT";
                    $comment->action_user_type_id = 2;
                    $comment->uid = $uuid;
                    $comment->application_id = $stage->id;
                    $comment->user_id = Auth()->user()->id;
                    $comment->save();
                }

                $lastpetition_no = Petition::orderBy('id', 'desc')->max('petition_no');
                $nextpetionNumber = str_pad($lastpetition_no + 1, 0, STR_PAD_LEFT);

                if ($stage->status == "ACCEPT") 
                {
                   $profile_picture = DB::table('applications')
                   ->where('id', $id)->update(['status' => "PENDING", 'current_stage' => 2 ]);
                    $petition = DB::table('petitions')
                       ->where('application_id', $id)
                        ->where('petition_no' , null) ->update(['petition_no' => $nextpetionNumber]);
                }


                return Redirect::to("petition/under-review")->with('success', ' Application edited successfully');



     }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     public function edit_rhc(Request $request, $id)
    {

        if(Auth::check())
        {
            
                $stage = Application::findOrFail($id);
                // dd($stage->id);
                $uuid = Str::uuid();
                $this->validate($request, [
                'status' => 'required',
                ]);
                $stage->status = $request->input('status');
                $stage->save();
                
             

                if ($stage->status == "RE SUBMIT") 
                {
                    $cj = DB::table('applications')
                     ->where('id', $id)->update([ 'current_stage' => 1, 'status'=>'RE SUBMIT']);
        
                    $comment = new ApplicationApproval();
                    $comment->comment = $request->input('comment');
                    $comment->active = true;
                    $comment->decision = "RE SUBMIT";
                    $comment->action_user_type_id = 2;
                    $comment->uid = $uuid;
                    $comment->application_id = $stage->id;
                    $comment->user_id = Auth()->user()->id;
                    $comment->save();
                }

               

                if ($stage->status == "ACCEPT") 
                {
                   $profile_picture = DB::table('applications')
                   ->where('id', $id)->update(['status' => "PENDING", 'current_stage' => 3 ]);
                   
                }


                return Redirect::to("petition/rhc-review")->with('success', ' Application edited successfully');



     }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function edit_cj(Request $request, $id)
    {
                $stage = Application::findOrFail($id);
                $profile_id = Application::findOrFail($id)->profile_id;
                $user_id = Profile::where('id', $profile_id )->first()->user_id;
                $userEmail = User::where('id', $user_id )->first();
                // dd($userEmail);
            
                $uuid = Str::uuid();
                $cur_year = date('Y');


                $this->validate($request, [
                'status' => 'required',
                ]);

                $stage->status = $request->input('status');
                $stage->save();
                $lastroll_no = Petition::orderBy('id', 'desc')->max('roll_no');
                $nextrollNumber = $lastroll_no + 1;

                if ($stage->status == "ADMIT") 
                 
                {
                   $session_id = PetitionSession::where('active', true)->first()->id;
                   $petition = DB::table('petitions')
                                ->where('application_id', $id)
                                 ->where('roll_no', null)
                                 ->update([ 'roll_no' => $nextrollNumber]);
                    $admission = DB::table('applications')
                        ->leftJoin('petitions', 'petitions.application_id', '=', 'applications.id')
                        ->select('applications.*', 'petitions.*')
                        ->where('petitions.petition_session_id', $session_id)
                        ->where('applications.status', 'ADMIT')
                         ->count();
                          $cj = DB::table('petition_sessions')
                                ->where('active', true)
                                ->update(['admitted_count' => $admission]);


                        $bill_id = 'JUD16'.mt_rand(1000000000000 , 9999999999999);
                        // $control_number = '19' . mt_rand(1000000, 99999999);

                        while (Bill::where('bill_id', $bill_id)->exists()) {
                                      $bill_id = 'JUD16' . mt_rand(10000000000, 99999999999);
                                        }
                        // while (Bill::where('control_number', $control_number)->exists()) {
                        //               $control_number = '19' . mt_rand(1000000, 99999999);

                        //                 }
                         $billdate = date('Y-m-d H:i:s');
                         $expireDate = date('Y-m-d\TH:i:s', strtotime('+10 days'));
                        //  $total_all_fees_formatted = number_format($total_all_fees, 2); // format total amount as currency
                         $date_time = new DateTime($billdate);
                         $due_Date = $date_time->format('Y-m-d\TH:i:s');

                         $session_id = PetitionSession::where('active', true)->first()->id;
                         $bills = DB::table('applications')
                            ->leftJoin('petitions', 'petitions.application_id', '=', 'applications.id')
                            ->select('applications.*', 'petitions.*')
                            ->where('petitions.petition_session_id', $session_id)
                            ->where('applications.status', 'ADMIT')
                            ->get();


                            $datas = [
                                 'total_all_fees' => 110000,
                                   'bill_id' => $bill_id,
                                   'due_date' => $due_Date,
                                   'expire_date' => $expireDate,

                                  ];

             $xml = new SimpleXMLElement('<gepgBillSubReq/>');

        $billHdr = $xml->addChild('BillHdr');
        $billHdr->addChild('SpCode', 'JUD001');
        $billHdr->addChild('RtrRespFlg', 'true');

        $billTrxInf = $xml->addChild('BillTrxInf');
        $billTrxInf->addChild('BillId', $datas['bill_id']);
        $billTrxInf->addChild('SubSpCode', 'SP250');
        $billTrxInf->addChild('SpSysId', 'tjv47');
        $billTrxInf->addChild('BillAmt', $datas['total_all_fees']);
        $billTrxInf->addChild('MiscAmt', '0');
        $billTrxInf->addChild('BillExprDt', $datas['expire_date']);
        $billTrxInf->addChild('PyrId', $datas['bill_id']);
        $billTrxInf->addChild('PyrName', $datas['bill_id']);
        $billTrxInf->addChild('BillDesc', 'Bill Number ' . $datas['bill_id']);
        $billTrxInf->addChild('BillGenDt', $datas['due_date']);
        $billTrxInf->addChild('BillGenBy', '');
        $billTrxInf->addChild('BillApprBy', '');
        $billTrxInf->addChild('PyrCellNum', '');
        $billTrxInf->addChild('PyrEmail', '');
        $billTrxInf->addChild('Ccy', 'TZS');
        $billTrxInf->addChild('BillEqvAmt', $datas['total_all_fees']);
        $billTrxInf->addChild('RemFlag', 'true');
        $billTrxInf->addChild('BillPayOpt', '1');

        $billItems = $billTrxInf->addChild('BillItems');
        $billItem1 = $billItems->addChild('BillItem');
        $billItem1->addChild('BillItemRef', $datas['bill_id'] . '78851');
        $billItem1->addChild('UseItemRefOnPay', 'N');
        $billItem1->addChild('BillItemAmt', $datas['total_all_fees']);
        $billItem1->addChild('BillItemEqvAmt', $datas['total_all_fees']);
        $billItem1->addChild('BillItemMiscAmt', '0');
        $billItem1->addChild('GfsCode', '140206');

        $result = $xml->asXML();
        $ch = curl_init();

        // set the URL and other cURL options for submitting the bill
        $url = 'https://uat1.gepg.go.tz/api/bill/sigqrequest';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $result); // $result is the XML data
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

        // Set the path to your private key and certificate files
         $certificatePath = storage_path('gepgKeys/gepgpubliccertificate.pfx');
         $privateKeyPath = storage_path('gepgKeys/gepgclientprivatekey.pfx');

         // Set the password for the private key and certificate files
        $privateKeyPassword = 'passpass';
        $certificatePassword = 'passpass';

 
        // Set the cURL options for SSL certificate and private key
        curl_setopt($ch, CURLOPT_SSLCERT, $certificatePath);
        curl_setopt($ch, CURLOPT_SSLKEY, $privateKeyPath);
        curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $privateKeyPassword);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certificatePassword);


// execute the cURL request to submit the bill and get the response
        $response = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        dd($statusCode);

// close the cURL resource
        curl_close($ch);

// handle the response based on the status code
        if ($statusCode == 200) {

            $gepgBillSubReqAck = simplexml_load_string($response);
            $trxStsCode = $gepgBillSubReqAck->TrxStsCode;
            // dd($trxStsCode);

            // now that we have the GePG Bill Submission Request Acknowledgment,
            // we can use it to retrieve the GePG Bill Submission Response

            // set the URL and other cURL options for retrieving the response
            $url = 'https://uat1.gepg.go.tz/api/bill/sigqrequest';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $result); // $result is the XML data
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

            // execute the cURL request to retrieve the response
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // close the cURL resource
            curl_close($ch);
                $expireDate = date('Y-m-d H:i:s', strtotime('+10 days'));
            // handle the response based on the status code
            if ($statusCode == 200) {
                $gepgBillSubResp = simplexml_load_string($response);
                $billId = $gepgBillSubResp->BillTrxInf->BillId;
                $trxSts = $gepgBillSubResp->BillTrxInf->TrxSts;
                $payCntrNum = $gepgBillSubResp->BillTrxInf->PayCntrNum;
                $trxStsCode = $gepgBillSubResp->BillTrxInf->TrxStsCode;

                                        $bill = new Bill;
                                        $bill->bill_date = $billDate;
                                        $bill->bill_id =  $billId;
                                        $bill->category = "PETITIONER";
                                        $bill->control_number = $payCntrNum ;   //control number required
                                        $bill->control_number_requested = true;
                                        $bill->currency = 'TZS';
                                        $bill->due_date = $expireDate;
                                        $bill->email_control_number_sent = true;
                                        $bill->email_payment_info_sent = true;
                                        $bill->paid_year = $cur_year;
                                        $bill->payment_status = "UNPAID";
                                        $bill->sms_payment_info_sent = true;
                                        $bill->sms_control_number_sent = true;
                                        $bill->total_amount = 110000;
                                        $bill->uid = $uuid;
                                        $bill->payer_id = $user_id;
                                        $bill->fee_type_id = 1;
                                        $bill->bill_category = 'Individual';
                                        $bill->application_id = $id;
                                        $bill->profile_id = $profile_id;
                                        $bill->save();

                                        $data = [
                                             'bill' => $bill
            
                                            ];

                            Mail::to($userEmail->email)->send(new \App\Mail\BillEmail($data));

            } else {
                // the request for the GePG Bill Submission Response failed
                // handle the error, if needed
                echo "Error: Request for GePG Bill Submission Response failed. Status code: " . $statusCode;
            }
        } else {
            // the request for the GePG Bill Submission Request Acknowledgment failed
            // handle the error, if needed
                echo "Error: Request for GePG Bill Submission Request Acknowledgment failed. Status code: " .$statusCode;
        }
// Enter your National Identification Number (NIN)

        dd($result);

                } 
                        if ($stage->status == "RE SUBMIT") 
                        {
                          $cj = DB::table('applications')
                             ->where('id', $id)->update(['status' => "RE SUBMIT", 'current_stage' => 3]);
                          $comment = new ApplicationApproval();
                          $comment->comment = $request->input('comment');
                          $comment->active = true;
                          $comment->decision = "RE SUBMIT";
                          $comment->action_user_type_id = 6;
                          $comment->uid = $uuid;
                          $comment->application_id = $stage->id;
                          $comment->user_id = Auth()->user()->id;
                          $comment->save();
                        }
                return Redirect::to("petition/cj-appearance")->with('success', ' Application edited successfully');

        
    }

     public function edit_cle(Request $request, $id)
   {

      if (Auth::check()) {
        $stage = Application::findOrFail($id);
        $session_id = PetitionSession::where('active', true)->first()->id;
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
                    ->update(['status' => "PENDING",
                        'current_stage' => 3]);

                        $date = date('Y-m-d');
                                 $user_id = Auth::user()->id;
                                 $cleMemberId = CleMember::where('user_id', $user_id)->first()->id;
                                //   $cleMemberId = 1;
                            if (Coram::where('workday', $date)->exists()) {
                                    // Data exists in 'corams' table, insert into 'coram_cle_members' table
                                 $coram = Coram::where('workday', $date)->first();
                                 // Update CoramCleMember table
                                   $coramCleMember = CoramCleMember::where('coram_id', $coram->id)
                                   ->where('cle_member_id', $cleMemberId)
                                   ->first();
                                   if ($coramCleMember) {
                                        $coramCleMember->member_id += 1;
                                        $coramCleMember->save();
                                   } else {
                                     // Create new CoramCleMember record
                                     $coramCleMember = new CoramCleMember();
                                     $coramCleMember->coram_id = $coram->id;
                                     $coramCleMember->cle_member_id = $cleMemberId;
                                     $coramCleMember->member_id = 1; // or any initial value
                                    $coramCleMember->save();
                                 }
                                } else {
                                      // Data doesn't exist in 'corams' table, insert a new record
                                      $coram = new Coram();
                                      $coram->active = true;
                                      $coram->workday = $date;
                                      $coram->chairman_id = 8715;
                                      $coram->petition_session_id = $session_id;
                                      $coram->uid = $uuid;
                                      $coram->secretary_id = Auth()->user()->id;
                                      $coram->save();

                                      // Insert into CoramCleMember table
                                      $coramCleMember = new CoramCleMember();
                                      $coramCleMember->coram_id = $coram->id;
                                      $coramCleMember->cle_member_id = $cleMemberId;
                                      $coramCleMember->member_id = 1;
                                      $coramCleMember->save();
                                }
                               

            }

            if ($stage->status == "RE SUBMIT") {
                 $comment = new ApplicationApproval();
              $comment->comment = $request->input('comment');
              $comment->active = true;
              $comment->decision = "RE SUBMIT";
              $comment->action_user_type_id = 5;
              $comment->uid = $uuid;
              $comment->application_id = $stage->id;
              $comment->user_id = Auth()->user()->id;
              $comment->save();
             $profile_picture = DB::table('applications')->where('id', $id)->update(['status' => "RE SUBMIT",
            'current_stage' => 2]);
                  }

                return Redirect::to("petition/cle-inspection")->with('success', ' Application edited successfully');


         }
         return Redirect::to("auth/login")->withErrors('You do not have access!');
   }


   


     public function get_cj() {
      

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 4;
            $status = "PENDING";
            $application_type = "PETITION";

            $applications = Application::where('current_stage', $stage)->where('type', $application_type)->where('status', $status)->orderBy('created_at', 'desc')->paginate(20);
            $application = Application::where('current_stage', $stage)->where('type', $application_type)->where('status', $status)->orderBy('created_at', 'desc')->count();

            $admit = Application::where('current_stage', $stage)->where('type', $application_type)->where('status', 'ADMIT')->where('active', true)->orderBy('created_at', 'desc')->paginate(20);
            $admitCount = Application::where('current_stage', $stage)->where('type', $application_type)->where('status', 'ADMIT')->where('active', true)->orderBy('created_at', 'desc')->count();


// dd($admit);
            return view('management.petition_application.cj.index', [
                'profile' => $profile,
                'admit' => $admit,
                'admitCount' => $admitCount,
                 'application' => $application,
                'applications' => $applications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     public function get_cle() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $stage = 3;
            $application_type = "PETITION";
             $status = "PENDING";
             $resubmit = 'RE SUBMIT';

            $applications = Application::where('current_stage', $stage)->where('type', $application_type)->where('status', $status)
            ->orderBy('created_at', 'desc')->paginate(20);
            $application_count = Application::where('current_stage', $stage)->where('status', $status)->where('type', $application_type)
            ->orderBy('created_at', 'desc')->count();

             $approved_count = Application::where('current_stage', 4)->where('status', 'PENDING')
            ->orderBy('created_at', 'desc')->count();
             $approved_applications = Application::where('current_stage', 4)->where('status', 'PENDING')
            ->orderBy('created_at', 'desc')->get();

            $resubmit_applications =  Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $resubmit)->orderBy('created_at', 'desc')->paginate(20);

             $resubmit_applications_count =  Application::where('current_stage', $stage)->where('type', $application_type)
            ->where('status', $resubmit)->orderBy('created_at', 'desc')->count();

            return view('management.petition_application.cle.index', [
                'profile' => $profile,
                'resubmit_applications' => $resubmit_applications,
                'resubmit_applications_count' => $resubmit_applications_count,
                'applications' => $applications,
                 'approved_count' => $approved_count,
                'approved_applications' => $approved_applications,
                'application_count' => $application_count,



            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
   public function view_profile(Request $request, $id)
    {

        if(Auth::check()){

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

                //check applications
                $application_type = "PETITION";

                if(Application::where('profile_id', $profile_id)->exists()){
                    $applications = Application::where('profile_id', $profile_id)->get();
                     $application_id = Application::where('profile_id', $profile_id)
                     ->where('type', $application_type)->first()->id;
                }else{
                    $applications = "No data";
                }

                $docus = DB::table('applications')
                ->Join('documents', 'documents.application_id', '=', 'applications.id')
                ->select('applications.*', 'documents.*')->where('applications.id', $application_id)
                 ->get();

    //  dd($docus);

                return view('management.petition_application.under_review.view', [
                    'profile' => $profile,
                    'docus' => $docus,
                    'advocate' => $advocate,
                    'cur_year' => $cur_year,
                    'firms' => $firms,
                    'firm_id' => $firm_id,
                    'since' => $since,
                    'approvals'=>$approvals,
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
    
public function view_cj(Request $request, $id)
    {


        if(Auth::check()){

                $user_id = Auth::user()->id;
                $profile = Profile::where('user_id', $user_id)->first();
                $cur_year = date('Y');

                $advocate = Application::where('uid', $id)->first();

                $profile_id = Application::where('uid', $id)->first()->profile_id;
               

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


                return view('management.petition_application.cj.view', [
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

public function view_rhc(Request $request, $id)
    {

        if(Auth::check()){

                $user_id = Auth::user()->id;
                $profile = Profile::where('user_id', $user_id)->first();
                $cur_year = date('Y');
                $approval_ids = Application::where('uid', $id)->first()->id;
                $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();

                $advocate = Application::where('uid', $id)->first();
                //  dd($advocate);

                $profile_id = Application::where('uid', $id)->first()->profile_id;
               

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
                $application_type = "PETITION";

                if(Application::where('profile_id', $profile_id)->exists()){
                    $applications = Application::where('profile_id', $profile_id)->get();
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
                
    //  dd($applications);

                return view('management.petition_application.rhc.view', [
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

public function view_cle(Request $request, $id)
    {

        if(Auth::check()){

                $user_id = Auth::user()->id;
                $profile = Profile::where('user_id', $user_id)->first();
                $cur_year = date('Y');
                $approval_ids = Application::where('uid', $id)->first()->id;
                $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();


                $advocate = Application::where('uid', $id)->first();
                //  dd($advocate);

                $profile_id = Application::where('uid', $id)->first()->profile_id;
               

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
                $application_type = "PETITION";

                if(Application::where('profile_id', $profile_id)->exists()){
                    $applications = Application::where('profile_id', $profile_id)->get();
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

                return view('management.petition_application.cle.view', [
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

   public function new_applicant()
   {
    if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            

            $stage = 1;
            $application_type = "PETITION";
            $status = "PENDING";


            $applications = Application::where('type', $application_type)->where('status', $status)->orderBy('created_at', 'desc')->paginate(200);


            return view('management.petition_application.new-applicant.index', [
                'profile' => $profile,
                'applications' => $applications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
   }


   public function view_applicant(Request $request, $id)
    {

        if(Auth::check()){

                $user_id = Auth::user()->id;
                $profile = Profile::where('user_id', $user_id)->first();
                $cur_year = date('Y');
                $approval_ids = Application::where('uid', $id)->first()->id;
                $approvals = ApplicationApproval::where('application_id', $approval_ids)->get();


                $advocate = Application::where('uid', $id)->first();
                //  dd($advocate);

                $profile_id = Application::where('uid', $id)->first()->profile_id;
               

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
                if(Application::where('profile_id', $profile_id)->exists()){
                    $applications = Application::where('profile_id', $profile_id)->get();
                }else{
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


    public function admit(Request $request,  $id)
    {
       

        if(Auth::check()){

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
                      $currentDate = Carbon::now();
                      $issueDate = Carbon::now()->format('Y-m-d');
                         if ($currentDate->month === 12) {
                             $currentDate->addYear();
                          }
        $expireDate = $currentDate->endOfYear()->format('Y-m-d');
        $session_id = PetitionSession::where('active', true)->first()->id;
        $certificates = DB::table('applications')
                        ->leftJoin('petitions', 'petitions.application_id', '=', 'applications.id')
                        ->leftJoin('bills', 'bills.application_id', '=', 'applications.id')
                        ->select('applications.*', 'petitions.*', 'bills.*')
                        ->where('petitions.petition_session_id', $session_id)
                        ->where('bills.payment_status', 'PAID')
                        ->where('applications.certificate', null)
                        ->get();
                    //   dd($certificates);  
      
                            $uuid = Str::uuid();
                            $currentyear = date('Y');
                            $notary = "NOTARY";
                         $notary_no = Certificate::orderBy('id', 'desc')->max('notary_no');
                         $nextNotartyNumber = $notary_no + 1;
                         $practising_no = Certificate::orderBy('id', 'desc')->max('practising_no');
                         $nextPractisingNumber = $practising_no + 1;
                         $notary_cert = Certificate::where('type',$notary )->orderBy('id', 'desc')->max('notary_no');
                         $nextNotartyCert = $notary_cert + 1;

                         foreach($certificates as $data)
                               {
                                        $certificate = new Certificate;
                                        $certificate->active = true;
                                        $certificate->uid = $uuid;
                                        $certificate->accessible = true;
                                        $certificate->date_of_issued = $issueDate;   //control number required
                                        $certificate->expire_date = $expireDate;
                                        $certificate->issued_year = $currentyear;
                                        // $certificate->notary_no = $nextNotartyNumber;
                                        $certificate->practising_no = $nextPractisingNumber;
                                        $certificate->signature_id = 1;
                                        $certificate->type = $data->admit_as;
                                        $certificate->application_id =$data->application_id;
                                        $certificate->profile_id = $data->profile_id;
                                        $certificate->save();
                                    
                                }   
                                 foreach($certificates as $data)
                               {
                                        $certificate = new Certificate;
                                        $certificate->active = true;
                                        $certificate->uid = $uuid;
                                        $certificate->accessible = true;
                                        $certificate->date_of_issued = $issueDate;   //control number required
                                        $certificate->expire_date = $expireDate;
                                        $certificate->issued_year = $currentyear;
                                        $certificate->notary_no = $nextNotartyCert;
                                        // $certificate->practising_no = $nextPractisingNumber;
                                        $certificate->signature_id = 3;
                                        $certificate->type = $notary;
                                        $certificate->application_id =$data->application_id;
                                        $certificate->profile_id = $data->profile_id;
                                        $certificate->save();
                                    
                                }   
                                
                                if(!empty($certificate) ){
                                    $cert = DB::table('applications')
                                                    //    ->where('id', $id)
                                                       ->update(['certificate' => true]);
                                   }
                $currDate = Carbon::now()->format('Y-m-d');
                 $uuid = Str::uuid();
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
            $advocate->admission = $currDate;
            $advocate->paid_year = $currentyear;
            $advocate->status = $data->admit_as;
            $advocate->roll_no = $data->roll_no;
            $advocate->status_date = $currentDate;
            $advocate->petition_session_id = $data->petition_session_id;
            $advocate->profile_id = $data->profile_id;
            $advocate->save();
        }

         if ($advocate->save()) {
                $profile_picture = DB::table('applications')
                 ->where('status', 'ADMIT')
                 ->update(['active' => false]);
           }

        return back()->with('success', ' Enrollment  successfully');       
    }
   

} 