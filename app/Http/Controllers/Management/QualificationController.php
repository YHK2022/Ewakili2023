<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
use App\Models\Masterdata\Qualification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class QualificationController extends Controller
{
    /**
     * get a listing of qualifications.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $qualifications= Qualification::orderBy('id')->get();
            return view('management.masterdata.qualifications.index', [
                'profile' => $profile,
                'qualifications' => $qualifications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new qualificationsfee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_qualifications(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'open_date' => 'required',
                'close_date' => 'required',
                'admission_date' => 'required',
            ]);

            $uuid = Str::uuid();

            $qualifications= new Qualification();
            $qualifications->open_date = $request->input('open_date');
            $qualifications->close_date = $request->input('close_date');
            $qualifications->admission_date = $request->input('admission_date');
            $qualifications->uid = $uuid;
            $qualifications->active = "true";
            //dd($fee-types);exit;
            $qualifications->save();

            return back()->with('success', 'qualificationsfee-types added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit qualificationsfee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_qualifications(Request $request, $id)
    {

        if(Auth::check()){

            try {

                $feeypes = Qualification::findOrFail($id);

                $this->validate($request, [
                    'open_date' => 'required',
                    'close_date' => 'required',
                    'admission_date' => 'required',
                ]);

                $qualifications->open_date = $request->input('open_date');
                $qualifications->close_date = $request->input('close_date');
                $qualifications->admission_date = $request->input('admission_date');
                //dd($fee-types);exit;
                $qualifications->save();

                return back()->with('success', 'qualificationsfee-types edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Petition fee-types not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_qualifications(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $permission = Permission::findOrFail($id);
                $permission->delete();

                return back()->with('success', 'User permission deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User permission not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}