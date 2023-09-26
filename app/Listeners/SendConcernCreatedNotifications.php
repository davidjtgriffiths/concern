<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\User;
use App\Events\ConcernCreated;
use App\Notifications\NewConcern;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Grosv\LaravelPasswordlessLogin\LoginUrl;
use Grosv\LaravelPasswordlessLogin\PasswordlessLogin;

class SendConcernCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ConcernCreated $event): void
    {
        $recipientEmail = $event->concern->recipient_email;
        if ($recipientEmail == Auth::user()->email) {
            return;
        }
        $user = User::firstOrCreate(
            ['email' => $recipientEmail],
            [
                'email' => $recipientEmail,
                'email_verified_at' => Carbon::now(),
                'password_set_by_user' => false,
            ]
        );

        $event->concern->owner()->associate($user);
        $event->concern->save();

        $generator = new LoginUrl($user);
        $generator->setRedirectUrl('/concerns'); //TODO: Change this to Cases
        $loginLink = $generator->generate();
        $user->notify(new NewConcern($event->concern, $loginLink));
    }
}
