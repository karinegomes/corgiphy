<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddSearchToHistory
{
    public function handle($event)
    {
        $user = auth()->user();

        if ($user) {
            $user->histories()->create([
                'query'       => $event->query,
                'searched_at' => now(),
            ]);
        }
    }
}
