<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

class MiscellaneousController extends Controller
{
    //
    public function get_index()
    {
        return view('management.miscellaneous.abandoned.index');

    }

    public function get_postponed()
    {
        return view('management.miscellaneous.postponed.index');

    }

    public function get_objected()
    {
        return view('management.miscellaneous.objected.index');

    }
    public function get_deferred()
    {
        return view('management.miscellaneous.deferred.index');

    }

}
