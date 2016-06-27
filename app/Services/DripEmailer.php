<?php

// app/Services/DripEmailer.php

namespace App\Services;

use App\User;
use Mail;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class - DripEmailer
 * Send emails
 *
 * @category Service
 * @package  app\Services
 * @author   Sergei Beskorovainyi <bsa2657@yandex.ru>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 */
class DripEmailer {

    /**
     * Application
     *
     * @var Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * 
     * @param type $param
     */
    public function __construct(Application $app) {
        $this->app = $app;
    }

    /**
     * Send email
     *
     * @param string $to
     * @param string $msg
     */
    public function send($to, $msg = 'Hellow!') {

        Mail::raw($msg, function($message) {
            $message->from(config('mail.from.address'), config('mail.from.name'))->subject('Test Laravel!');

            $message->to('bsa2657@yandex.ru');
        });
    }

    /**
     * Send email for user
     * 
     * @param string $userName
     * @param string $msg
     */
    public function sendForUser($userName, $msg = 'Hellow ') {
        $user = User::where('name', $userName)->first();

        if ($user->count()) {
            Mail::raw($msg . $user->name . '!', function($message) use ($user) {
                // Get mail to
                $email = $user->email;
                
                // Get config info
                $mail_from_address = config('mail.from.address');
                $mail_from_name = config('mail.from.name');

                $message->from($mail_from_address, $mail_from_name)->subject('Test Laravel!');
                
                $message->to($email);
            });
        }
    }

}
