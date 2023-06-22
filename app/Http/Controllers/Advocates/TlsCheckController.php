<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use App\Models\Advocate\Advocate;
use App\Models\Advocate\TaxClearanceCheck;

use App\Models\Masterdata\RenewalBatch;
use App\Models\Advocate\RenewalHistory;
use App\Models\Petitions\PetitionForm;
use App\Models\Petitions\Document;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationMove;
use App\Models\Petitions\AttachmentMove;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\Qualification;
use App\Models\Petitions\TlsPaymentCheck;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\LlbCollege;
use App\Models\Petitions\LstCollege;
use App\Models\Petitions\Firm;
use App\Models\Petitions\FirmRequestConfirmation;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use App\Profile;
use App\User;
use GuzzleHttp\Client;

use App\Mail\VerifyFirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class TlsCheckController extends Controller
{

    /**
     * Check TLS Compliance
     * @return \Illuminate\Http\Response
     */
    public function compliance_check(Request $request, $id)
    {
$profile_id = Profile::where('id', $id)->first()->id;
$roll_no = Advocate::where('profile_id', $profile_id)->first()->roll_no;



        // Check for renew year
        $renew_year = RenewalBatch::where('active', 'true')->first()->year;

        //Submit request
        
        $res = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get('https://wakili.tls.or.tz/ewakili/checkComplianceApi/'.$roll_no.
        '?key=$2AGAhgsghs9873bnxb773');

        $result = $res->json();

        $tls_paid_year = $result[0]['member']['year'];
// dd($tls_paid_year);

// $tls_paid_year = 2023;

// if ($result !== null && isset($result[0]['member']) && isset($result[0]['member']['year'])) {
// $tls_paid_year = $result[0]['member']['year'];
// // do something with $tls_paid_year
// } else {
//     $tls_paid_year = 0;
//  // handle the case where $result is null or its first element does not have the 'member' key or its 'member' key does not have the 'year' key
// }

        
        //Save check details
        // Check if detail exist

        if(TlsPaymentCheck::where('profile_id', $profile_id)
                            ->where('year', $renew_year)->exists()){
            // Do nothing
        }else{
            $tls = new TlsPaymentCheck();
            $tls->profile_id = $profile_id;
            $tls->year = $renew_year;
            $tls->check_result = 0;
// dd($tls);

            $tls->save();
        }


        if($tls_paid_year == $renew_year){
            //echo "Umeshalipia TLS";exit;
            // Update check result
            $tls = DB::table('tls_payment_checks')
                ->where('profile_id', $profile_id)->where('year', $renew_year)
                ->update(['check_result' => 1]);
return back()->with('success', 'You already paid TLS annual fees, you can proceed with Tax Clearance');

        }else{
            //echo "Unadaiwa TLS";exit;
            return back()->with('warning', 'Please Comply with TLS regarding annual fees before proceeding with Tax Clearance');
        }


    }

      public function tax_clearance_check(Request $request, $id)
    {
        $profile_id = Profile::where('id', $id)->first()->id;
        $roll_no = Advocate::where('profile_id', $profile_id)->first()->roll_no;
        $renew_year = RenewalBatch::where('active', 'true')->first()->year;

        // $inputData = request()->only(['data']);
        $inputData = $request->input('data');

        // dd($inputData);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get('https://gorest.co.in/public/v2/users');



        // Get the input data from the request
        // $inputData = $request->input('data');

        $inputData = request()->only(['data']);
        $status = 'active'; //another data required to be checked


        // Set the API endpoint URL with the input data as query parameters
        // $url = 'https://gorest.co.in/public/v2/users?id=' . $inputData['data'];


        $response = Http::get('https://gorest.co.in/public/v2/users', [
                    'id' => $inputData['data'],
                     'status' => $status,]);

        // Send a GET request to the API endpoint using Laravel HTTP client
        // $response = Http::get($url);
        // $result = $response->json();

        // dd($result);
        // Check if the response was successful and contains the expected data
        if ($response->successful() && $response->json('available')) {
            // The data is available, return a success response
                  if(TaxClearanceCheck::where('profile_id', $profile_id)
                        ->where('year', $renew_year)->exists()){
                         }else{
                    $tax = new TaxClearanceCheck();
                    $tax->profile_id = $profile_id;
                    $tax->year = $renew_year;
                    $tax->check_result = 2;
                    // dd($tax);
                    $tax->save();
                         }
                    return back()->with('success', 'Please Request Control Number');
        } else {
            // The data is not available, return an error response
            return back()->with('warning', 'Please Comply with TAX CLEARANCE');

        }
      
  

    }

    /**
     * TLS Compliance Response
     * @return \Illuminate\Http\Response
     */
    public function compliance_response()
    {


    }

}