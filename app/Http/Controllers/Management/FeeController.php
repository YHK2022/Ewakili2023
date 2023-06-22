<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use Illuminate\Support\Facades\Redirect;
use App\Models\Masterdata\Fee;
use App\Models\Masterdata\FeeType;

class FeeController extends Controller
{
    /**
     * get a listing of fees fees.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $fees = Fee::orderBy('id')->get();
            $feetypes = FeeType::get();
    //   dd($feetypes);
            return view('management.masterdata.fees.index', compact('profile','fees','feetypes'));
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new fees fee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_fees(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'amount' => 'required',
                'currency' => 'required',
                'description' => 'required',
                'service' => 'required',
                'fee_type_id' => 'required'
            ]);

            $uuid = Str::uuid();

            $fees = new Fee();
            $fees->amount = $request->input('amount');
            $fees->currency = $request->input('currency');
            $fees->description = $request->input('description');
            $fees->service = $request->input('service');
            $fees->fee_type_id = $request->input('fee_type_id');
            $fees->created_by = Auth()->user()->id;
            $fees->uid = $uuid;
            $fees->active = "true";
            //dd($fee-types);exit;
            $fees->save();

            return back()->with('success', 'Fees added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit fees fee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_fees(Request $request, $id)
    {
       $fees = Fee::findOrFail($id);
$this->validate($request, [
    'amount' => 'required',
    'currency' => 'required',
    'description' => 'required',
    'service' => 'required',
]);

$fees->amount = $request->input('amount');
$fees->currency = $request->input('currency');
$fees->description = $request->input('description');
$fees->service = $request->input('service');
$fees->updated_by = Auth()->user()->id;
$fees->fee_type_id = $request->input('fee_type_id');

$fees->save();

return back()->with('success', 'Fees dited successfully');

        
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_fees(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $fees = Fee::findOrFail($id);
                $fees->delete();

                return back()->with('success', 'Fee deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Fee not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}