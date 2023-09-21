<?php

namespace App\Listeners;

use App\Events\ConcernCreated;
use App\Models\User;
use App\Notifications\NewConcern;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        foreach (User::whereNot('id', $event->concern->user_id)->cursor() as $user) {
            $user->notify(new NewConcern($event->concern));
        }
    }
}
