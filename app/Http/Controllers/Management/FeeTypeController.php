<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\Models\Masterdata\FeeType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;



class FeeTypeController extends Controller
{
    /**
     * get a listing of feetypes feetypes.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $feetypes = FeeType::orderBy('id')->get();
            return view('management.masterdata.fee-types.index', [
                'profile' => $profile,
                'feetypes' => $feetypes,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new feetypes fee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_feetypes(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'service' => 'required',
                'gfscode' => 'required',
                'sub_sp_code' => 'required',
            ]);

            $uuid = Str::uuid();

            $feetypes = new FeeType();
            $feetypes->service = $request->input('service');
            $feetypes->gfscode = $request->input('gfscode');
            $feetypes->sub_sp_code = $request->input('sub_sp_code');
            $feetypes->uid = $uuid;
            $feetypes->created_by = Auth()->user()->id;
            $feetypes->active = "true";
            //dd($fee-types);exit;
            $feetypes->save();

            return back()->with('success', 'Fees Type added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit feetypes fee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_feetypes(Request $request, $id)
    {

        if(Auth::check()){

            try {

                $feetypes = FeeType::findOrFail($id);

                $this->validate($request, [
                'service' => 'required',
                'gfscode' => 'required',
                'sub_sp_code' => 'required',
                 ]);

                 $feetypes->service = $request->input('service');
                 $feetypes->gfscode = $request->input('gfscode');
                 $feetypes->sub_sp_code = $request->input('sub_sp_code');
                 $feetypes->updated_by = Auth()->user()->id;

                //dd($fee-types);exit;
                $feetypes->save();

                return back()->with('success', 'Fee Type edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Fee Type not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_feetypes(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $feetypes = FeeType::findOrFail($id);
                $feetypes->delete();

                return back()->with('success', 'Fee Type deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Fee Type not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}