<?php

namespace App\Http\Controllers;

use App\Clue;
use App\Game;
use App\Services\JServiceTrivia;
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

        $clues = (new JServiceTrivia())->getRandomClue();

        collect(json_decode($clues['body'], true))->each(function($clue) use ($game){
            Clue::create([
                'game_id' => $game->id,
                'jservice_id' => $clue['id'],
                'difficulty' => $clue['value']??100,
                'category' => $clue['category_id'],
                'question' => $clue['question'],
                'answer' => $clue['answer'],
            ]);
        });

        return redirect()->route('games.game.show', [$game]);
    }


    public function show(Game $game)
    {
        return view('game.show')->with(['game' => $game]);
    }

}
