<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddSearchToHistory
{
    public function handle($event)
    {
        if ($event->apiToken) {
            $user = User::where('api_token', $event->apiToken)->first();

            $user->histories()->create([
                'query'       => $event->query,
                'searched_at' => now(),
            ]);
        }
    }
}
