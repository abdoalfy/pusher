<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels ;

    /**
     * Create a new event instance.
     */


     public $reciver;
     public $message;
     public $sender;
     

    public function __construct( $reciver, $sender,$message)
    {
        $this->reciver=$reciver;
        $this->sender = $sender;
        $this->message=$message;
    }



    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat'.$this->reciver->id),
        ];
    }


    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'sender_name' => $this->sender,
            'sender_avatar' => "https://static.vecteezy.com/system/resources/previews/019/896/008/original/male-user-avatar-icon-in-flat-design-style-person-signs-illustration-png.png", // Assuming you have an avatar field
        ];
    }
    
}
