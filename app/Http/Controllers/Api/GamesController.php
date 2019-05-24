<?php

namespace App\Http\Controllers\Api;

use App\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GamesController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Game
     */
    public function update(Request $request, Game $game)
    {
        $game->update(['players' => json_encode($request->get('players'))]);
        return response()->json([
            'data' => $game->fresh(),
            'success' => true,
            'message' => 'Game updated'
        ]);
    }

}
