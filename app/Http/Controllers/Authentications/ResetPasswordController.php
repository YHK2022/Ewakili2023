<?php

namespace App\Http\Controllers\Authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    public function reset_response(ResetPasswordRequest $request)
    {
        return $this->get_password_table_row($request)->count() > 0
            ? $this->reset_password($request) : $this->token_not_found_response();
    }

    private function get_password_table_row($request)
    {
        return DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ]);
    }

    private function reset_password(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        $user->update(['password' => bcrypt($request->password)]);

        $this->get_password_table_row($request)->delete();

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'Password has been reset successfully.'
        ], 201);
    }

    private function token_not_found_response()
    {
        return response()->json([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'error' => 'Password can\'t be reset, the link has already been used.'
        ], 422);
    }
}
