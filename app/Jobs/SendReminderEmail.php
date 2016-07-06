<?php

namespace App\Jobs;

use App\User;
use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReminderEmail extends Job implements ShouldQueue {

    use InteractsWithQueue,
        SerializesModels;

    protected $user;
    
    protected  $repeats = 2;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @param  string $userName
     * @return void
     */
    public function __construct(User $user) {

        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function handle(Mailer $mailer) {
        
        $user = $this->user;
        
        $mailer->send('test.emails.reminder', ['user' => $user], function ($m) use ($user) {
            // Get mail to
            $email = $user->email;

            // Get config info
            $mail_from_address = config('mail.from.address');
            $mail_from_name = config('mail.from.name');

            $m->from($mail_from_address, $mail_from_name)->subject('Test Laravel!');

            $m->to($email);
        });
        
//        if($this->repeats){
//            $this->repeats = $this->repeats - 1;
//            $this->release(5);
//        }
    }

}
