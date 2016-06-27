<?php

namespace App\Events;

use Auth;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddTask extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $user;
    public $task_name;

        /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($taskName)
    {
        // Get auth user
        $this->user = Auth::user();
        
        $this->task_name = $taskName;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['user.'.$this->user->id];
    }
}
