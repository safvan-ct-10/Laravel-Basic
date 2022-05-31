<?php

namespace App\Listeners;

use App\Events\UserCreateEvent;
use App\Mail\UserCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserCreateListener
{
    public function __construct()
    {

    }

    public function handle(UserCreateEvent $event)
    {
        // Mail::to('isafvanct@gmail.com')
        //     ->cc('safvanctsfn@gmail.com', 'test@gmail.com') // Carbon Copy
        //     ->bcc('abc@gmail.com') // Blind Carbon Copy
        //     ->send(new UserCreatedMail($event->data));
    }
}
