<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;


class GamesController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Game
     */
    public function store(Request $request)
    {
        $game = Game::create();
        return redirect()->route('games.game.show', [$game]);
    }


    public function show(Game $game)
    {
        return view('game.show')->with(['game' => $game]);
    }

}
