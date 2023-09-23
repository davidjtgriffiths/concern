<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ConcernCreated;
use App\Notifications\NewConcern;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
            ]
        );
        $user->notify(new NewConcern($event->concern));
    }
}
