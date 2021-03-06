<?php

namespace Softwarescares\Safaricomdaraja\app\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TransactionNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $success;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($success)
    {
        Log::info("TransactionNotificationEvent");
        Log::info(json_encode($success));

        $this->success = $success;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
