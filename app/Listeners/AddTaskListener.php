<?php

namespace App\Listeners;

use Auth;
use Log;
use App\Events\AddTask;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddTaskListener implements ShouldQueue {

    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddTask  $event
     * @return void
     */
    public function handle(AddTask $event) {

        $event->user->tasks()->create([
            'name' => $event->task_name
        ]);

        Log::info('End event - AddTask');
    }

}
