<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use App\Models\Advocate\Advocate;
use App\Models\Advocate\Certificate;
use App\Models\Advocate\RenewalHistory;
use App\Models\Masterdata\RenewalBatch;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationMove;
use App\Models\Petitions\Bill;
use App\Models\Petitions\Document;
use App\Models\Petitions\LlbCollege;
use App\Models\Petitions\LstCollege;
use App\Models\Petitions\PetitionForm;
use App\Models\Petitions\Qualification;
use App\Models\Petitions\TlsPaymentCheck;
use App\Models\Advocate\TaxClearanceCheck;
use App\Models\Petitions\WorkExperience;
use App\Profile;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Redirect;
use Symfony\Component\HttpFoundation\Response;
use \SimpleXMLElement;

class RenewalController extends Controller
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

            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $uuid = Profile::where('user_id', $user_id)->first()->uid;

            // Check for renew year
            $renew_year = RenewalBatch::where('active', 'true')->first()->year;
            $current_year = date('Y');
            $paid_year = Advocate::where('profile_id', $profile_id)->first()->paid_year;
            // Check seniority of the advocate
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

            // Check first, second and end deadlines from active renewal batch
            $first_deadline = RenewalBatch::where('active', 'true')->first()->first_deadline;
            $second_deadline = RenewalBatch::where('active', 'true')->first()->second_deadline;
            $end_date = RenewalBatch::where('active', 'true')->first()->end_date;

            // Check for TLS Payment check
            if (TlsPaymentCheck::where('year', $renew_year)->where('profile_id', $profile_id)->exists()) {
                $tls_result = TlsPaymentCheck::where('profile_id', $profile_id)->where('year', $renew_year)->first()->check_result;
            } else {
                $tls_result = 0;
            }
            // Check for Tax Clearance check
            if (TaxClearanceCheck::where('year', $renew_year)->where('profile_id', $profile_id)->exists()) {
                $tax_result = TaxClearanceCheck::where('profile_id', $profile_id)->where('year', $renew_year)->first()->check_result;
            } else {
                $tax_result = 0;
            }
//    dd($tls_result);
            if ($paid_year < $renew_year) {
                // Calculate year difference between advocate paid year and renewal year
                $year_diff = $renew_year - $paid_year;

                if ($year_diff > 1) {
                    //echo "una malimbikizo";exit;

                    if ($date <= $first_deadline) {
                        //echo "Renew out of Time with penalties and accumulation plus current renewal without penalty ";exit;

                        //Check if already applied out of tme
                        $app_type = "PERMIT_RENEWAL";

                        if (RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->exists()) {
                            $renew_history = RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->select('application_id')->get();
                        } else {
                            $renew_history = "No data";
                        }
                        //echo $renew_history;exit;

                        if ($renew_history != "No data") {

                            if (Application::whereIn('id', $renew_history)->where('type', $app_type)->exists()) {
                                $application_status = Application::whereIn('id', $renew_history)->where('type', $app_type)->first()->status;
                            } else {
                                $application_status = "No data";
                            }

                        } else {
                            $application_status = "No data";
                        }
                        //echo $application_status;exit;

                        // Create bill Items

                        // Accumulation fee
                        $pc_accumulation = $practising_fee * $year_diff;
                        $nc_accumulation = $notary_fee * $year_diff;
                        $penalty_accumulation = $penalty * $year_diff;

                        // Current year fee
                        $pc_fee_amount = $practising_fee;
                        $nc_fee_amount = $notary_fee;
                        $total = $pc_fee_amount + $nc_fee_amount + $pc_accumulation + $nc_accumulation + $penalty_accumulation;

                        return view('advocates.renewal.outoftime_without_penalty', [
                            'petition_form' => $petition_form,
                            'profile' => $profile,
                            'profile_id' => $profile_id,
                            'uuid' => $uuid,
                            'progress' => $progress,
                            'qualification' => $qualification,
                            'attachment' => $attachment,
                            'llb' => $llb,
                            'lst' => $lst,
                            'experience' => $experience,
                            'renew_year' => $renew_year,
                            'application_status' => $application_status,
                            'pc_fee_amount' => $pc_fee_amount,
                            'nc_fee_amount' => $nc_fee_amount,
                            'penalty_accumulation' => $penalty_accumulation,
                            'nc_accumulation' => $nc_accumulation,
                            'pc_accumulation' => $pc_accumulation,
                            'tls_result' => $tls_result,
                            'total' => $total,
                        ]);
                    } elseif ($date <= $end_date) {
                        //echo "Renew out of Time with penalties and accumulation plus current renewal with penalty";exit;

                        return view('advocates.renewal.outoftime_with_penalty', [
                            'petition_form' => $petition_form,
                            'profile' => $profile,
                            'progress' => $progress,
                            'qualification' => $qualification,
                            'attachment' => $attachment,
                            'llb' => $llb,
                            'lst' => $lst,
                            'experience' => $experience,
                            'renew_year' => $renew_year,
                        ]);
                    }
                } else {
                    //echo "hauna malimbikizo";exit;

                    if ($date <= $first_deadline) {
                        //echo "Apply for pc";exit;

                        // Create bill Items
                        $pc_fee_amount = $practising_fee;
                        $nc_fee_amount = $notary_fee;
                        $total = $pc_fee_amount + $nc_fee_amount;

                        return view('advocates.renewal.apply_for_pc', [
                            'petition_form' => $petition_form,
                            'profile' => $profile,
                            'profile_id' => $profile_id,
                            'progress' => $progress,
                            'qualification' => $qualification,
                            'attachment' => $attachment,
                            'llb' => $llb,
                            'lst' => $lst,
                            'experience' => $experience,
                            'renew_year' => $renew_year,
                            'pc_fee_amount' => $pc_fee_amount,
                            'nc_fee_amount' => $nc_fee_amount,
                            'total' => $total,
                            'tls_result' => $tls_result,
                            'tax_result' => $tax_result,

                        ]);

                    } elseif ($date <= $second_deadline) {
                        // echo "Apply for pc with penalty";exit;
                        $pc_fee_amount = $practising_fee;
                        $nc_fee_amount = $notary_fee;
                        $penalty = 0.5 * $practising_fee;
                        $total = $pc_fee_amount + $nc_fee_amount +  $penalty;
                        // dd( $total);

                        return view('advocates.renewal.apply_with_penalty', [
                            'petition_form' => $petition_form,
                            'profile' => $profile,
                            'profile_id' => $profile_id,
                            'progress' => $progress,
                            'qualification' => $qualification,
                            'attachment' => $attachment,
                            'llb' => $llb,
                            'lst' => $lst,
                            'experience' => $experience,
                            'renew_year' => $renew_year,
                            'pc_fee_amount' => $pc_fee_amount,
                            'nc_fee_amount' => $nc_fee_amount,
                            'total' => $total,
                            'tls_result' => $tls_result,
                            'tax_result' => $tax_result,

                        ]);

                    } elseif ($date > $end_date) {
                        echo "Renew out of Time with penalty";exit;

                        //Check if already applied out of tme
                        $app_type = "PERMIT_RENEWAL";

                        if (RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->exists()) {
                            $renew_history = RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->select('application_id')->get();
                        } else {
                            $renew_history = "No data";
                        }

                        if ($renew_history != "No data") {

                            if (Application::whereIn('id', $renew_history)->where('type', $app_type)->exists()) {
                                $application_status = Application::whereIn('id', $renew_history)->where('type', $app_type)->first()->status;
                            } else {
                                $application_status = "No data";
                            }

                        } else {
                            $application_status = "No data";
                        }
                        //echo $application_status;exit;

                        // Create bill Items
                        $pc_fee_amount = $practising_fee;
                        $nc_fee_amount = $notary_fee;
                        $penalty_amount = $penalty;
                        $total = $pc_fee_amount + $nc_fee_amount + $penalty_amount;

                        return view('advocates.renewal.renew_outoftime', [
                            'petition_form' => $petition_form,
                            'profile' => $profile,
                            'profile_id' => $profile_id,
                            'progress' => $progress,
                            'qualification' => $qualification,
                            'attachment' => $attachment,
                            'llb' => $llb,
                            'lst' => $lst,
                            'experience' => $experience,
                            'renew_year' => $renew_year,
                            'application_status' => $application_status,
                            'pc_fee_amount' => $pc_fee_amount,
                            'nc_fee_amount' => $nc_fee_amount,
                            'penalty_amount' => $penalty_amount,
                            'total' => $total,
                        ]);
                    }
                }
            } else {

                return view('advocates.renewal.index', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'experience' => $experience,
                    'renew_year' => $renew_year,
                ]);

            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');
        $users = Advocate::where('roll_no', 'like', '%' . $query . '%')->get();
        return response()->json($users);
    }

    public function control_number_request(Request $request, $id)
    {

           

        $users = $request->input('users');
        $amount = $request->input('amount');
        $renew_year = RenewalBatch::where('active', 'true')->first()->year;
       
// dd($renew_year);
        // Make HTTP request to external API to get user data
        //   $roll = 7007;
        $years = [];
        $results = [];
        if (!empty($users)) {
            foreach ($users as $user) {
                $res = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://wakili.tls.or.tz/ewakili/checkComplianceApi/' . $user .
                    '?key=$2AGAhgsghs9873bnxb773');
                $result = $res->json();
                $results[] = $result;

            }
        }

// dd($results);
        $sameYearResults = [];
        $differentYearResults = [];
        $RollResults = [];

        foreach ($results as $result) {
            $tlsPaidYear = $result[0]['member']['year'];
            $roll_no = $result[0]['member']['roll_no'];
            if ($tlsPaidYear == $renew_year) {
                $sameYearResults[] = $result;
                $successResults[] = ['roll_no' => $roll_no, 'year' => $tlsPaidYear];
                $RollResults[] = ['roll_no' => $roll_no];

                $profile_id = DB::table('advocates')->whereIn('roll_no', $RollResults)
                    ->pluck('profile_id');
                $admission = DB::table('advocates')->whereIn('roll_no', $RollResults)
                    ->pluck('admission');

            } else {
                $differentYearResults[] = $result;
                $errorResults[] = ['roll_no' => $roll_no, 'year' => $tlsPaidYear];
                $errorRollResults[] = ['roll_no' => $roll_no];

            }
        }

          if (TlsPaymentCheck::whereIn('profile_id', $profile_id)
                  ->where('year', $renew_year)->exists()) {
             // Do nothing
                  } else {
                    $profiles = DB::table('advocates')->whereIn('roll_no', $RollResults)
                    ->get();
                    // dd($profiles);

                    foreach ($profiles as $result) {
                              DB::table('tls_payment_checks')->insert([
                              'profile_id' => $result->profile_id,
                               'year' => $renew_year,
                               'check_result' => 0,
                               'created_at' => now()->format('Y-m-d H:i:s'),
                                'updated_at' => now()->format('Y-m-d H:i:s'),
                                // add more columns as needed
                             ]);
                        }

                    }

        if($tlsPaidYear == $renew_year){
            $tls = DB::table('tls_payment_checks')
               ->whereIn('profile_id', $profile_id)->where('year', $renew_year)
             ->update(['check_result' => 1]);
        }
        // Add authorized login user to the selected users
        $user_id = Auth::user()->id;
        $profiles = Profile::where('user_id', $user_id)->first()->id;
        $roll_no = Advocate::where('profile_id', $profiles)->first()->roll_no;
        $selectedUsers = collect($RollResults);
        $selectedUsers->push($roll_no);
        //    dd($selectedUsers);

        //    $admissions = DB::table('advocates')->whereIn('roll_no', $selectedUsers)
        //    ->pluck('admission');
        $admissions = DB::table('advocates')->whereIn('roll_no', $selectedUsers)->select('admission', 'profile_id', 'status', 'roll_no')->get();
        $diffs = [];
        $seniorities = [];
        foreach ($admissions as $admission) {
            $date = date('Y-m-d');
            $diffs[$admission->profile_id] = abs(strtotime($date) - strtotime($admission->admission));
        }
        // dd($diffs);
        foreach ($diffs as $profile_id => $diff) {
            $seniorities = floor($diff / (365 * 60 * 60 * 24));

        }
        $results = [];

        foreach ($diffs as $profile_id => $diff) {
            $first_deadline = RenewalBatch::where('active', true)->first()->first_deadline;
              $second_deadline = RenewalBatch::where('active', true)->first()->second_deadline;
           $end_date = RenewalBatch::where('active', 'true')->first()->end_date;
               $seniority = floor($diff / (365 * 60 * 60 * 24));
            $notary_fee = 40000;

            if ($seniority <= 5) {
                if ($date <= $first_deadline){
                     $practising_fee = 50000;
                     $pc_fee_id = 3;
                     $app_type = 'RENEWAL_JR';

                }else{
                    $practising_fees = 50000;
                    $penalty = 0.5 * $practising_fees;
                    $practising_fee =  $practising_fees +   $penalty ;
                    $pc_fee_id = 3;
                    $app_type = 'RENEWAL_JR';

                }        
        
            } else {

                if ($date <= $first_deadline){
                  $practising_fee = 100000;
                   $pc_fee_id = 4;
                    $app_type = 'RENEWAL_SR';

                }else{
                    $practising_fees = 100000;
                    $penalty = 0.5 * $practising_fees;
                    $practising_fee =  $practising_fees +   $penalty ;
                    $pc_fee_id = 4;
                    $app_type = 'RENEWAL_SR';

                }       
                  
            }

            // Calculate total fee for admission
            $total_fee = $notary_fee + $practising_fee;

// Store result for admission
            $results[$profile_id] = [
                'profile_id' => $profile_id,
                'status' => $admissions->where('profile_id', $profile_id)->first()->status,
                'practising_fee' => $practising_fee,
                'notary_fee' => $notary_fee,
                'total_fee' => $total_fee,
                'app_type' => $app_type,
                'pc_fee_id' => $pc_fee_id,
            ];

        }

// Get total of all total_fee
        $total_all_fees = 0;

        foreach ($results as $result) {
            if (isset($result['total_fee'])) {
                $total_all_fees += $result['total_fee'];
            }
        }

// Get profile_id, amount to be paid per profile_id in array, and total amount for all profile_ids
        $profile_fees = [];

        foreach ($results as $profile_id => $result) {
            $profile_fees[] = [
                'profile_id' => $profile_id,
                'status' => $result['status'],
                'amount_to_be_paid' => $result['total_fee'],
                'app_type' => $result['app_type'],
                'pc_fee_id' => $result['pc_fee_id'],

            ];
        }
    // dd($profile_fees);
// Send email to authenticated user
        $user = Auth::user();
        $billdate = date('Y-m-d H:i:s');
        $expireDate = date('Y-m-d\TH:i:s', strtotime('+10 days'));
        $total_all_fees_formatted = number_format($total_all_fees, 2); // format total amount as currency
        $date_time = new DateTime($billdate);
        $due_Date = $date_time->format('Y-m-d\TH:i:s');

        $bill_id = 'GP16' . mt_rand(1000000000000, 9999999999999);
        $control_number = '19' . mt_rand(1000000, 99999999);

        while (Bill::where('bill_id', $bill_id)->exists()) {
            $bill_id = 'GP16' . mt_rand(10000000000, 99999999999);
        }
        while (Bill::where('control_number', $control_number)->exists()) {
            $control_number = '19' . mt_rand(1000000, 99999999);

        }

        $datas = [
            'total_all_fees' => $total_all_fees_formatted,
            'profile_fees' => $profile_fees,
            'bill_id' => $bill_id,
            'due_date' => $due_Date,
            'expire_date' => $expireDate,

        ];

// dd($datas);

        $xml = new SimpleXMLElement('<gepgBillSubReq/>');

        $billHdr = $xml->addChild('BillHdr');
        $billHdr->addChild('SpCode', 'SP023');
        $billHdr->addChild('RtrRespFlg', 'true');

        $billTrxInf = $xml->addChild('BillTrxInf');
        $billTrxInf->addChild('BillId', $datas['bill_id']);
        $billTrxInf->addChild('SubSpCode', '2001');
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
        // dd($result);
        $ch = curl_init();

// set the URL and other cURL options for submitting the bill
        $url = 'http://<gepgIP>:<port>/api/bill/sigqrequest';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $result); // $result is the XML data
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

// execute the cURL request to submit the bill and get the response
        $response = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

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
            $url = 'http://<gepgIP>:<port>/api/bill/sigqrequest';
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

            // handle the response based on the status code
            if ($statusCode == 200) {
                $gepgBillSubResp = simplexml_load_string($response);
                $billId = $gepgBillSubResp->BillTrxInf->BillId;
                $trxSts = $gepgBillSubResp->BillTrxInf->TrxSts;
                $payCntrNum = $gepgBillSubResp->BillTrxInf->PayCntrNum;
                $trxStsCode = $gepgBillSubResp->BillTrxInf->TrxStsCode;

                // pass the values to the Laravel view
                return view('your-view-name', [
                    'billId' => $billId,
                    'trxSts' => $trxSts,
                    'payCntrNum' => $payCntrNum,
                    'trxStsCode' => $trxStsCode,
                ]);
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

        dd($result);

        $billDate = now()->format('Y-m-d H:i:s');
        $dueDate = date('d.m.Y 23:59:59', strtotime('+10 days'));
        $uuid = Str::uuid();
        $cur_year = date('Y');
        $issueDate = Carbon::now()->format('Y-m-d');
        $currentDate = Carbon::now();
        $issueDate = Carbon::now()->format('Y-m-d');
        if ($currentDate->month === 12) {
            $currentDate->addYear();
        }
        $expireDate = $currentDate->endOfYear()->format('Y-m-d');

        $currentyear = date('Y');
        $notary = "NOTARY";
        $notary_no = Certificate::orderBy('id', 'desc')->max('notary_no');
        $nextNotartyNumber = $notary_no + 1;
        $practising_no = Certificate::orderBy('id', 'desc')->max('practising_no');
        $nextPractisingNumber = $practising_no + 1;
        $notary_cert = Certificate::where('type', $notary)->orderBy('id', 'desc')->max('notary_no');
        $nextNotartyCert = $notary_cert + 1;
        $submitdate = date('Y-m-d H:i:s');

        $application_ids = [];
        $saved_bills = [];
foreach ($profile_fees as $data){
        $application = new Application();
        $application->submission_at = $submitdate;
        $application->active = "true";
        $application->uid = $uuid;
        $application->type = $data['app_type'];
        $application->status = 'Under Review';
        $application->resubmission = "true";
        $application->un_reviewed = "0";
        $application->current_stage = "1";
        $application->profile_id = $data['profile_id'];
        $application->workflow_process_id = "1";
        $application->actionstatus = "0";
        $application->stage = "0";
        $application->save();
        $application_ids[$data['profile_id']][$data['amount_to_be_paid']][] = $application->id;

$bill = new Bill;
        $bill->bill_date = $billDate;
        $bill->bill_id = $bill_id;
        $bill->category = "RENEWAL";
        $bill->control_number = $control_number; //control number required
        $bill->control_number_requested = true;
        $bill->currency = 'TZS';
        $bill->due_date = $dueDate;
        $bill->email_control_number_sent = true;
        $bill->email_payment_info_sent = true;
        $bill->paid_year = $cur_year;
        $bill->payment_status = "UNPAID";
        $bill->sms_payment_info_sent = true;
        $bill->sms_control_number_sent = true;
        $bill->total_amount = $data['amount_to_be_paid'];
        $bill->uid = $uuid;
        $bill->payer_id = Auth()->user()->id;;
        $bill->fee_type_id = $application->id;
        $bill->bill_category = 'Group Payment';
        $bill->application_id = $application->id;
        $bill->profile_id = $data['profile_id'];
        $bill->save();
        $saved_bills[] = $bill;

$certificate = new Certificate;
        $certificate->active = true;
        $certificate->uid = $uuid;
        $certificate->accessible = false;
        $certificate->date_of_issued = $issueDate;
        $certificate->expire_date = $expireDate;
        $certificate->issued_year = $currentyear;
        $certificate->practising_no = $nextPractisingNumber;
        $certificate->signature_id = 1;
        $certificate->type = $data['status'];
        $certificate->application_id = $application->id;
        $certificate->profile_id = $data['profile_id'];
        $certificate->save();

$notary_cert = new Certificate;
        $notary_cert->active = true;
        $notary_cert->uid = $uuid;
        $notary_cert->accessible = false;
        $notary_cert->date_of_issued = $issueDate; //control number required
        $notary_cert->expire_date = $expireDate;
        $notary_cert->issued_year = $currentyear;
        $notary_cert->notary_no = $nextNotartyCert;
        $notary_cert->signature_id = 3;
        $notary_cert->type = $notary;
        $notary_cert->application_id = $application->id;
        $notary_cert->profile_id = $data['profile_id'];
        $notary_cert->save();

}

// Send email to authenticated user
        $user = Auth::user();
        $total_all_fees_formatted = number_format($total_all_fees, 2); // format total amount as currency
        $date_time = new DateTime($dueDate);
        $due_Date = $date_time->format('M d, Y H:i:s');

        $data = [
            'total_all_fees' => $total_all_fees_formatted,
            'profile_fees' => $profile_fees,
            'control_number' => $control_number,
            'due_date' => $due_Date,
        ];

        Mail::to($user->email)->send(new \App\Mail\RenewalFeeSummary($data));

        return back()->with('success', 'Control Number Sent to Your Email')->with('data', $data);

// $date = date('Y-m-d');
        // $diff = abs(strtotime($date) - strtotime($admission_date));
        // $seniority = floor($diff / (365 * 60 * 60 * 24));

//  dd($admission);

    }
}