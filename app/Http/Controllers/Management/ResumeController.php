<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

class ResumeController extends Controller
{
    public function get_index()
    {
        return view('management.petition_resume.rhc.index');

    }

    public function get_cle()
    {

        return view('management.petition_resume.cle.index');

    }

    public function get_cj()
    {
        return view('management.petition_resume.cj.index');

    }
}
