<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'status' => trans($response)
        ], 200);
    }

    public function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['errors' => [
            'email' => trans($response)
        ]], 422);
    }
}
