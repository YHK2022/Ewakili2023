<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advocate\Advocate;
use App\Models\Masterdata\PetitionSession;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    /**
     * get a home page.
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $active = "true";
        $current_date = date("Y-m-d");
        $session = PetitionSession::where('active', $active)->first();

        //dd($session);exit();
        //echo $current_date;exit;

        return view('index', [
            'session' => $session,
            'current_date' => $current_date,
        ]);
    }
}
