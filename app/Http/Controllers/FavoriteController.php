<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();

        $user->favorites()->create($request->all());

        return response()->json('ok');
    }
}
