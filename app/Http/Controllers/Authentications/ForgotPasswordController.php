<?php

namespace App\Http\Controllers\Authentications;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function verify_email(Request $request)
    {
        if (!$this->validate_email($request->email)) {
            return $this->failed_response();
        } else if ($this->check_reset_email($request->email)) {
            return $this->email_found();
        }

        $this->send_email($request->email);
        return $this->success_response($request->email);
    }

    public function validate_email($email)
    {
        return User::where('email', $email)->first();
    }

    public function check_reset_email($email)
    {
        return DB::table('password_resets')->where('email', $email)->first();
    }

    public function failed_response()
    {
        return response()->json([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => 'Email doesn\'t exist.'
        ], 400);
    }

    public function email_found()
    {
        return response()->json([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'error' => 'Password reset link has already been sent. Please check your email.'
        ], 422);
    }

    public function success_response($email)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'An email has been sent to your email ' . $email . '. Please check your email to get a password reset link.'
        ], 200);
    }

    public function send_email($email)
    {
        $token = $this->create_token($email);
        Mail::to($email)->send(new ForgotPasswordMail($token));
    }

    public function create_token($email)
    {
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if ($oldToken) {
            return $oldToken;
        }

        $token = Str::random(60);
        $this->save_token($token, $email);

        return $token;
    }

    public function save_token($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }
}
