<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SomeEvent extends Event
{
    use SerializesModels;
    
    /**
     *
     * @var string 
     */
    public $some_event;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->some_event = 'This is some event';
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
