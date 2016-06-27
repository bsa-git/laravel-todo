<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use DB;
use Carbon\Carbon;
use Crypt;
use Event;
use Log;
use App\User;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Send mail
     *
     * @return Response
     */
    public function mail() {
        Mail::raw('Text of the letter', function($message) {
            $message->from('m5-asutp@azot.ck.ua', 'm5-asutp')->subject('Test Laravel!');

            $message->to('bsa2657@yandex.ru')->cc('bs261257@gmail.com');
        });

        return view('test.email', [
            'mail' => 'Test send message',
        ]);
    }

    /**
     * DataBase operations
     *
     * @return Response
     */
    public function db() {

        //---------------------
        // --- SQL ---
        $users = DB::select('select * from users where name = ?', ['admin']);
        $vUsers = $users;
        $tasks = DB::select('select * from tasks');
        $vTasks = $tasks;

        // --- Query Builder ---
        $users = DB::table('users')->where('name', 'admin')->first();
        $vUsers = $users;
        $tasks = DB::table('tasks')->get();
        $vTasks = $tasks;

        // --- Eloquent ORM ---
        $vUsers = array();
        $vTasks = array();

        // Get auth user
        $user = Auth::user();

        $vUsers['id'] = $user->id;
        $vUsers['name'] = $user->name;
        $vUsers['email'] = $user->email;
        $vUsers['created_at'] = $user->created_at->toDateTimeString();
        $vUsers['updated_at'] = $user->updated_at->toDateTimeString();
        $vUsers['diff'] = Carbon::now()->subMinutes(2)->diffForHumans();

        try {
            $vUsers['secret'] = Crypt::decrypt($user->secret);
        } catch (DecryptException $e) {
            abort(405, 'Crypt error');
        }

        $tasks = $user->tasks;
        foreach ($tasks as $task) {
            $vTasks[] = [
                'id' => $task->id,
                'user_id' => $task->user_id,
                'name' => $task->name,
                'created_at' => $task->created_at->toDateTimeString(),
                'updated_at' => $task->updated_at->toDateTimeString(),
            ];
        }

        return view('test.db', [
            'users' => $vUsers,
            'tasks' => $vTasks
        ]);
    }

    /**
     * Encrypt operations
     * secret information has been added for all users
     *
     * @return Response
     */
    public function encrypt() {
        $users = User::all();
        foreach ($users as $user) {
            $name = $user->name;
            $secret = Crypt::encrypt("Secret information for user - {$name}");
            $user->fill([
                'secret' => $secret
            ])->save();
        }
        
        return view('test.encrypt');
    }
    
    /**
     * Add task for an authorized user
     *
     * @return Response
     */
    public function addtask(Request $request, $task) {
        
        Log::info('Begin event - AddTask');
        
        Event::fire(new \App\Events\AddTask($task));
        
        return view('test.addtask');
    }

    /**
     * Send mail from template
     *
     * @return Response
     */
    public function mail_from_template() {
        Mail::send('test.emails.html', array('mail' => 'Test send message from template'), function($message) {
            $message->from('m5-asutp@azot.ck.ua', 'm5-asutp')->subject('Test Laravel!');

            $message->to('bsa2657@yandex.ru')->cc('bs261257@gmail.com');
        });

        return view('test.email', [
            'mail' => 'Test send message from template',
        ]);
    }

    /**
     * Send mail using API Mailgun
     *
     * @return Response
     */
    public function mailgun() {

        /*
          curl -s --user 'api:key-77f268518902706eb094311e5a55e3d2' \
          https://api.mailgun.net/v3/sandboxc8b8b9a79ceb463997df4aa57b08e005.mailgun.org/messages \
          -F from='Mailgun Sandbox <postmaster@sandboxc8b8b9a79ceb463997df4aa57b08e005.mailgun.org>' \
          -F to='Sergei <bs261257@gmail.com>' \
          -F subject='Hello Sergei' \
          -F text='Congratulations Sergei, you just sent an email with Mailgun!  You are truly awesome!'

          You can see a record of this email in your logs: https://mailgun.com/cp/log

          You can send up to 300 emails/day from this sandbox server. Next, you should add your own domain so you can send 10,000 emails/month for free.'
         */

        /*

          curl -s --user 'api:key-77f268518902706eb094311e5a55e3d2' https://api.mailgun.net/v3/sandboxc8b8b9a79ceb463997df4aa57b08e005.mailgun.org/messages -F from='Mailgun Sandbox <postmaster@sandboxc8b8b9a79ceb463997df4aa57b08e005.mailgun.org>' -F to='Sergei <bs261257@gmail.com>' -F subject='Hello Sergei' -F text='Congratulations Sergei, you just sent an email with Mailgun!  You are truly awesome!'

         */


        /**
          # Include the Autoloader (see "Libraries" for install instructions)
          require 'vendor/autoload.php';
          use Mailgun\Mailgun;

          # Instantiate the client.
          $mgClient = new Mailgun('key-77f268518902706eb094311e5a55e3d2');
          $domain = "sandboxc8b8b9a79ceb463997df4aa57b08e005.mailgun.org";

          # Make the call to the client.
          $result = $mgClient->sendMessage("$domain",
          array('from'    => 'Mailgun Sandbox <postmaster@sandboxc8b8b9a79ceb463997df4aa57b08e005.mailgun.org>',
          'to'      => 'Sergei <bs261257@gmail.com>',
          'subject' => 'Hello Sergei',
          'text'    => 'Congratulations Sergei, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));

         */
        return view('test.email', [
            'mail' => 'Test send message from mailgun',
        ]);
    }

}
