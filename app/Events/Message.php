<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message,$chat_id,$user_id;
    /**
     * Create a new event instance.
     */
    public function __construct($message,$chat_id,$user_id)
    {
        $this->message =$message;
        $this->chat_id =$chat_id;
        $this->user_id =$user_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('Sendmessages.'.$this->chat_id),
        ];
    }
    public function broadcastWith()
    {
        return [
            'message'=>$this->message,
            'created_at'=>now(),
            'sent_by'=>$this->user_id
        ];
    }
}
