<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request, User $user)
    {
        if(! URL::hasValidSignature($request)) {
            return response()->json([ 'errors' => [
                'message' => 'Invalid Verification URL.'
            ]], 422);
        }

        if($user->hasVerifiedEmail()) {
            return response()->json(['errors' => [
                'message' => 'Email address already verified.'
            ]], 422);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return response()->json([
            'message' => 'Email successfully verified.'
        ], 200);
    }

    public function resend(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $request->email)->first();

        if($user->hasVerifiedEmail()) {
            return response()->json([ 'errors' => [
                'message' => 'Email address already verified.'
            ]], 422);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['errors' => [
            'message' => 'Verification successful resend.'
        ]], 200);
    }
}
