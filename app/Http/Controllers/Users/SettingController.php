<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'tagline' => ['required', 'string'],
            'about' => ['required', 'string', 'min:20'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'github' => ['nullable', 'url'],
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'tagline' => $request->tagline,
            'about' => $request->about,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube
        ]);

        return new UserResource($user);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', new MatchOldPassword()],
            'password' => ['required', 'min:8', 'confirmed', 'different:current_password']
        ]);

        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Change password successfully'
        ]);
    }
}
