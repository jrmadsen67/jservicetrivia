<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MakeGameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_new_game(){
        $response = $this->post(route('games.game.store'), []);

        $response->assertStatus(302);
    }
}
