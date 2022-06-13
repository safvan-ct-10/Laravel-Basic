<?php

namespace App\Jobs;

use App\Mail\UserCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        Mail::to('isafvanct@gmail.com')
            ->cc('safvanctsfn@gmail.com', 'test@gmail.com') // Carbon Copy
            ->bcc('abc@gmail.com') // Blind Carbon Copy
            ->send(new UserCreatedMail($this->data));
    }
}
