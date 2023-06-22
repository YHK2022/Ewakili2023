<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * get a listing of users.
     * @return \Illuminate\Http\Response
     */

    /**
     * add a new user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */

    /**
     * edit user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */

    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */

    public function profile()
    {

        if (Auth::check()) {
            $lims_user_data = User::where('id', Auth()->user()->id)->first();
            return view('advocates.user.profile', compact('lims_user_data'));
        } else {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }

    }

    public function profileUpdate(Request $request, $id)
    {
        // if(!env('USER_VERIFIED'))
        //     return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);
        return back()->with('success', 'Profile  edited successfully');
    }

    public function changePassword(Request $request, $id)
    {

        $input = $request->all();
        $lims_user_data = User::find($id);
        // dd($lims_user_data);
        if ($input['new_pass'] != $input['confirm_pass']) {
            return redirect("user/" . "profile/" . $id)->with('success', "Please Confirm your new password");
        }

        if (Hash::check($input['current_pass'], $lims_user_data->password)) {
            $lims_user_data->password = bcrypt($input['new_pass']);
            $lims_user_data->save();
        } else {
            return redirect("user/" . "profile/" . $id)->with('success', "Current Password doesn't match");
        }
        auth()->logout();
        return redirect('/');
    }

}
