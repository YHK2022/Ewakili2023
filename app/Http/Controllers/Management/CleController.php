<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CleController extends Controller
{
    public function get_index() {

        if(Auth::check()){
            
            $profile = Profile::where('user_id', $user_id)->first();

            
    //   dd($feetypes);
            return view('management.masterdata.fees.index', compact('profile','fees','feetypes'));
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
}

        