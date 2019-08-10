<?php

namespace App\Http\Controllers;

use App\Events\SearchEvent;
use App\Models\Favorite;
use App\Models\User;
use App\Services\Giphy\Facades\Giphy;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $offset = $request->input('offset');
        $response = Giphy::search($query, 20, $offset);
        $data = [];

        foreach ($response->data as $item) {
            $isFavorite = false;

            if ($request->has('api_token')) {
                $user = User::where('api_token', $request->input('api_token'))->first();
                $isFavorite = Favorite::where('giphy_id', $item->id)->where('user_id', $user->id)->exists();
            }

            $data[] = [
                'id'          => $item->id,
                'still_url'   => $item->images->original_still->url,
                'url'         => $item->images->original->url,
                'is_favorite' => $isFavorite,
            ];
        }

        $apiToken = '';

        if ($request->has('api_token')) {
            $apiToken = $request->input('api_token');
        }

        event(new SearchEvent($query, $apiToken));

        return response()->json(compact('data'));
    }

    public function doSearch(Request $request)
    {
        return view('search');
    }
}
