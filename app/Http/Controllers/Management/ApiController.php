<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Masterdata\PetitionSession;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function getAdvocateStatus()
    {

        $subquery = DB::table('certificates')
            ->select('profile_id', DB::raw('MAX(date_of_issued) as latest_date_of_issued'))
            ->whereIn('type', ['PRACTISING', 'NON PRACTISING'])
            ->groupBy('profile_id');

        $statusAdvocate = DB::table('advocates')
            ->join('profiles', 'profiles.id', '=', 'advocates.profile_id')
            ->joinSub($subquery, 'latest_certificates', function ($join) {
                $join->on('profiles.id', '=', 'latest_certificates.profile_id');
            })
            ->join('certificates', function ($join) {
                $join->on('profiles.id', '=', 'certificates.profile_id')
                    ->on('certificates.date_of_issued', '=', 'latest_certificates.latest_date_of_issued');
            })
            ->select('advocates.roll_no', 'profiles.fullname', 'certificates.type', 'certificates.expire_date', 'certificates.date_of_issued')
            ->whereIn('certificates.type', ['PRACTISING', 'NON PRACTISING'])
            ->orderBy('advocates.roll_no', 'desc')
            ->get();

        return response()->json($statusAdvocate);

    }

    public function getAdvocate()
    {
        $session_id = PetitionSession::where('active', true)->first()->id;
        $newAdvocate = DB::table('advocates')
            ->join('profiles', 'profiles.id', '=', 'advocates.profile_id')
            ->select('advocates.roll_no', 'profiles.fullname', 'advocates.admission',
                'advocates.status', 'advocates.paid_year', 'advocates.status_date', 'advocates.petition_session_id')
            ->orderBy('advocates.created_at', 'desc')
            ->where('advocates.petition_session_id', $session_id)
            ->get();
        return response()->json($newAdvocate);
    }

    public function postToExternalApi()
    {

        // retrieve data from the database
        $subquery = DB::table('certificates')
            ->select('profile_id', DB::raw('MAX(date_of_issued) as latest_date_of_issued'))
            ->whereIn('type', ['PRACTISING', 'NON PRACTISING'])
            ->groupBy('profile_id');

        $data = DB::table('advocates')
            ->join('profiles', 'profiles.id', '=', 'advocates.profile_id')
            ->joinSub($subquery, 'latest_certificates', function ($join) {
                $join->on('profiles.id', '=', 'latest_certificates.profile_id');
            })
            ->join('certificates', function ($join) {
                $join->on('profiles.id', '=', 'certificates.profile_id')
                    ->on('certificates.date_of_issued', '=', 'latest_certificates.latest_date_of_issued');
            })
            ->select('advocates.roll_no', 'profiles.fullname', 'certificates.type', 'certificates.expire_date', 'certificates.date_of_issued')
            ->whereIn('certificates.type', ['PRACTISING', 'NON PRACTISING'])
            ->whereYear('certificates.expire_date', '=', date('Y'))
            ->whereYear('certificates.date_of_issued', '=', date('Y'))
            ->orderBy('advocates.roll_no', 'desc')
            ->get();

        // transform data to match the format expected by the external API
        $transformedData = [];

        foreach ($data as $row) {
            $transformedData[] = [
                'certexpiry_date' => $row->expire_date,
                'certissue_date' => $row->date_of_issued,
                'roll_no' => $row->roll_no,

            ];
        } 
        
       // Make POST requests for each set of transformed data
foreach ($transformedData as $postData) {
    $response = Http::post('https://wakili.tls.or.tz/api/v1/receiveRenewed', [
        'certexpiry_date' => $postData['certexpiry_date'],
        'certissue_date' => $postData['certissue_date'],
        'key' => '$2AGAhgsghs9873bnxb773',
        'roll_no' => $postData['roll_no'],
    ]);

    // Get the response status code
    $status = $response->status();

    // Check the status code and process the response
    if ($status === 200) {
        // Request succeeded
        $responseData = $response->body(); // Get the response body

        // Process the response data
    } else {
        // Request failed
        $errorMessage = $response->body();
        // Handle the error
    }
}
    }

}
