<?php

namespace App\Http\Controllers\Management;

use App\Models\Masterdata\ActionUserType;
use App\Models\Masterdata\PetitionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Profile;

class StageController extends Controller
{
    /**
     * get a listing of stages.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stages = ActionUserType::orderBy('id', 'desc')->get();

            //dd($stages);exit;

            return view('management.masterdata.stage.index', [
                'profile' => $profile,
                'stages' => $stages,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new petition session
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_stage(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'name' => 'required',
                'display_name' => 'required',
            ]);

            $uuid = Str::uuid();

            $session = new ActionUserType();
            $session->name = $request->input('name');
            $session->display_name = $request->input('display_name');
            $session->created_by = Auth()->user()->id;
            $session->uid = $uuid;
            $session->active = "true";
            //dd($session);exit;
            $session->save();

            return back()->with('success', 'Stage added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit petition session
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_stage(Request $request, $id)
    {

        if(Auth::check()){

            try {

                $stage = ActionUserType::findOrFail($id);

                $this->validate($request, [
                'name' => 'required',
                'display_name' => 'required',
                ]);

                 $stage->name = $request->input('name');
                 $stage->display_name = $request->input('display_name');
                 $stage->updated_by = Auth()->user()->id;

                //dd($stage);exit;
                $stage->save();

                return back()->with('success', ' stage edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_stage(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $stage = ActionUserType::findOrFail($id);
                $stage->delete();

                return back()->with('success', 'Stage deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Stage not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}