<?php

namespace App\Listeners;

use App\Events\UserCreateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserUpdateListener
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
     * @param  \App\Events\UserCreateEvent  $event
     * @return void
     */
    public function handle(UserCreateEvent $event)
    {
        //
    }
}
