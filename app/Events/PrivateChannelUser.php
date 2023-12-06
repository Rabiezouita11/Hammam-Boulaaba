<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivateChannelUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public $user_id; // Add a user_id property
    public $created_at; // Add this line

    public function __construct($message, $user_id, $created_at)
    {
        $this->message=$message;
        $this->user_id=$user_id; // Set the user_id property
        $this->created_at = $created_at; // Add this line

    }

  

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
    
        return new PrivateChannel("myPrivateChannel.user.$this->user_id");
    }
}
