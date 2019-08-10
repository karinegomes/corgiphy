<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $favorite = $user->favorites()->where('giphy_id', $request->input('giphy_id'))->first();

        if ($favorite) {
            $favorite->delete();

            return response()->json(false);
        }

        $user->favorites()->create($request->all());

        return response()->json(true);
    }

    public function getFavorites(Request $request)
    {
        $favorites = auth()->user()->favorites()->paginate(8, ['*'], 'page', $request->input('page'));

        return response()->json(compact('favorites'));
    }
}
