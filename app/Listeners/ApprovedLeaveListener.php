<?php

namespace App\Listeners;

use App\Notifications\ApprovedLeaveNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;
use Illuminate\Queue\InteractsWithQueue;

class ApprovedLeaveListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        Notification::send($user , new ApprovedLeaveNotification());
    }
}
