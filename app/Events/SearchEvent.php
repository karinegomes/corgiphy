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
    public $apiToken;

    public function __construct($query, $apiToken)
    {
        $this->query = $query;
        $this->apiToken = $apiToken;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
