<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getHistory(Request $request)
    {
        $user = auth()->user();
        $history = $user->histories()->orderBy('searched_at', 'desc')->paginate(15, ['*'], 'page', $request->input('page'));

        return response()->json(compact('history'));
    }
}
