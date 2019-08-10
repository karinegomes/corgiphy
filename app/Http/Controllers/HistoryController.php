<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getHistory()
    {
        $user = auth()->user();
        $history = $user->histories()->limit(25)->get();

        return response()->json(compact('history'));
    }
}
