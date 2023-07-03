<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Petitions\Application;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApplicationTrackingController extends Controller
{
    public function get_petition_application()
    {
        if (Auth::check()) {
            $stage = 1;

            $application_type = "PETITION";
            $applications = Application::where('type', $application_type)->orderBy('created_at', 'desc')
                ->paginate(1000);
            return view('management.permit_application.application_tracking.petition_application', [
                'applications' => $applications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    public function get_permit_request()
    {
        if (Auth::check()) {

            $applications = Application::where('type', 'PERMIT NAME CHANGE')
                ->orWhere('type', 'PERMIT NON PRACTISING')
                ->orWhere('type', 'PERMIT RETIRE PRACTISING')
                ->orWhere('type', 'PERMIT RESUME PRACTISING')
                ->orWhere('type', 'PERMIT NON PROFIT')
                ->orWhere('type', 'PERMIT SUSPENDED')
                ->orWhere('type', 'PERMIT RENEWAL')
                ->orderBy('created_at', 'desc')->paginate(1000);
            return view('management.permit_application.application_tracking.permit_request', [
                'applications' => $applications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    public function get_temporary_admission()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT NON PRACTISING";
            $status = "Under Review";

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            return view('management.permit_application.application_tracking.temporary_admission', [
                'applications' => $applications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    public function get_resume_petition()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $stage = 1;
            $application_type = "PERMIT NAME CHANGE";
            $status = "Under Review";

            $applications = Application::where('current_stage', $stage)
                ->where('type', $application_type)->where('status', $status)
                ->orderBy('created_at', 'desc')->paginate(20);
            return view('management.permit_application.application_tracking.resume_petition', [
                'applications' => $applications,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
}
