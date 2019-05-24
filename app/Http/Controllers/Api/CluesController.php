<?php

namespace App\Http\Controllers\Api;

use App\Clue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CluesController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Game
     */
    public function getNext(Request $request)
    {
        $game_id = $request->get('game_id', null);

        if (empty($game_id)){
            return response()->json([
                'success' => true,
                'message' => 'No game id provided'
            ]);
        }

        $clue = Clue::getNextClue($game_id);
        if (empty($clue)){
            return response()->json([
                'success' => true,
                'message' => 'No more clues!'
            ]);
        }

        $clue->used = true;
        $clue->save();

        return response()->json([
            'data' => $clue,
            'success' => true,
            'message' => 'Game updated'
        ]);
    }

}
