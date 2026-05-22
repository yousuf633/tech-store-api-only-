<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = Favorite::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $favorites
        ]);
    }

    public function store(StoreFavoriteRequest $request)
    {
        $favorite = Favorite::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id
        ]);

        return response()->json([
            'message' => 'added',
            'data' => $favorite
        ]);
    }

    public function destroy(Favorite $favorite, Request $request)
    {
        if ($favorite->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'unauthorized'
            ], 403);
        }

        $favorite->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }
}