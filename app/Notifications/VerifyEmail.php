<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail as Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
    protected function verificationUrl($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'verify',
            Carbon::now()->addMinutes(60),
            [
                'user' => $notifiable->id
            ]
        );

        return str_replace(url('/api'), config('app.url'), $url);
    }
}
