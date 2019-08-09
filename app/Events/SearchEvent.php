<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SearchEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
