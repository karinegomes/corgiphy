<?php

namespace App\Http\Controllers;

use App\Events\SearchEvent;
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
            $data[] = [
                'id'        => $item->id,
                'still_url' => $item->images->original_still->url,
                'url'       => $item->images->original->url,
            ];
        }

        event(new SearchEvent($query));

        return response()->json(compact('data'));
    }
}
