<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user or admin password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();
        $res = $user->update(['password' => Hash::make($password)]);

        if($res)
            $this->info('Password updated successfully');
        else
            $this->error('Something went wrong');
    }
}
