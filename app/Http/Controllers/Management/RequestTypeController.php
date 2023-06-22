<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Masterdata\RequestType;

class RequestTypeController extends Controller
{
    /**
     * get a listing of requesttypes.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $requesttypes= RequestType::orderBy('id')->get();
            return view('management.masterdata.request-types.index', [
                'profile' => $profile,
                'requesttypes' => $requesttypes,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new qualificationsfee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_request(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);


            $requesttypes= new RequestType();
            $requesttypes->name = $request->input('name');
            $requesttypes->description = $request->input('description');
           
            $requesttypes->save();

            return back()->with('success', 'Request Type added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit requesttypesfee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_request(Request $request, $id)
    {

        if(Auth::check()){

            try {

                $requesttype = RequestType::findOrFail($id);

                $this->validate($request, [
                    'name' => 'required',
                    'description' => 'required',
                ]);

                $requesttype->name = $request->input('name');
                $requesttype->description = $request->input('description');
                $requesttype->save();

                return back()->with('success', 'Request Type edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Request Type not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_request(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $requesttype = RequestType::findOrFail($id);
                $requesttype->delete();

                return back()->with('success', 'User Request Type deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User Request Type not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}