<?php

namespace App\Http\Controllers\Reports;
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
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function petition(Request $request)
    {
        $query = $request->input('query');
        $applications = DB::table('petitions AS A')
    ->select('A.petition_no', 'A.lst_regno', 'B.fullname', 'A.admit_as', 'C.type', 'C.status')
    ->join('profiles AS B', 'A.profile_id', '=', 'B.id')
    ->join('applications AS C', 'A.application_id', '=', 'C.id')
    ->where('A.petition_no', 'like', '%' . $query . '%')->take(10)->get();
        return view('management.report.petition',compact('applications')); 
    }
    

    public function advocate(Request $request)
    {
        $query = $request->input('query');
      $advocates = DB::table('advocates')
    ->join('profiles', 'profiles.id', '=', 'advocates.profile_id')
    ->join('users', 'users.id', '=', 'profiles.user_id')
    ->select('users.*', 'profiles.*', 'advocates.*')
    ->where('advocates.roll_no', 'like', '%' . $query . '%')->take(50)->get();
        return view('management.report.advocate', compact('advocates'));
    }



    public function permit(Request $request)
    {

        $query = $request->input('query');
      $permits = DB::table('applications AS B')
    ->select('p.fullname', 'B.type', 'W.display_name', 'B.status', 'B.submission_at', 'B.current_stage')
    ->rightJoin('profiles AS p', 'B.profile_id', '=', 'p.id')
    ->rightJoin('workflow_process AS W', 'B.workflow_process_id', '=', 'W.id')
    ->whereNotNull('type')
    ->orderBy('B.submission_at', 'DESC')
    ->where('p.fullname', 'like', '%' . $query . '%')->take(15)->get();
    // dd($permits);


        return view('management.report.permit', compact('permits'));
    }

    

    public function revenue(Request $request)
    {
       
        $revenues = DB::table('payments')
    ->select('payctrnum', 'billamt', 'paidamt', 'pyrname', 'pspreceiptnumber', 'pspname', 'pyrcellnum', 'usdpaychnl', 'trxdttm')
    ->orderBy('trxdttm', 'DESC')
    ->paginate(100);
    $query = $request->input('query');
    $search_all = DB::table('payments')
    ->select('payctrnum', 'billamt', 'paidamt', 'pyrname', 'pspreceiptnumber', 'pspname', 'pyrcellnum', 'usdpaychnl', 'trxdttm')
    ->where('payctrnum', 'like', '%' . $query . '%')->take(15)->get();
        return view('management.report.revenue', compact('revenues','search_all')); 
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}