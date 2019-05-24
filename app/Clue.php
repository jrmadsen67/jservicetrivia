<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clue extends Model
{
    protected $fillable = [
        'game_id',
        'jservice_id',
        'difficulty',
        'category',
        'question',
        'answer',
        'used',
    ];
}
