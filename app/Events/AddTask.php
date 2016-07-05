<?php

namespace App\Events;

use Auth;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddTask extends Event implements ShouldBroadcast {

    use SerializesModels;

    public $user;
    public $task_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($taskName) {
        // Get auth user
        $this->user = Auth::user();

        $this->task_name = $taskName;
    }

    /**
     * Get the name of the broadcast event.
     *
     * @return string
     */
    public function broadcastAs() {
        return 'app.add-task';
    }

    /**
     * Get the data to transmit.
     *
     * @return array
     */
    public function broadcastWith() {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'task_name' => $this->task_name
        ];
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn() {
        return ["user.{$this->user->id}"];
    }

}
