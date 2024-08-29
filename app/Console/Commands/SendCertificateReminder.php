<?php

namespace App\Console\Commands;

use App\Mail\CertificationReminderMail;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendCertificateReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-certificate-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $employes = Empleado::alta()->get();
        foreach ($employes as $employ) {
            $user = User::where('email', trim(removeUnicodeCharacters($employ->email)))->first();
            $email = new CertificationReminderMail;
            Mail::to(removeUnicodeCharacters($user->email))->queue($email);
        }
    }
}
