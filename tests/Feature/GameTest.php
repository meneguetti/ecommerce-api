<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Tests\TestCase;

class GameTest extends TestCase
{

    public function test_user_starts_a_game()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/start', [
            'rows'    => 8,
            'columns' => 8,
            'mines'   => 10
        ]);

        $response->assertJsonStructure([
            'board' => [
                [
                    [
                        'status'
                    ]
                ]
            ],
            'game_id'
        ]);

        return ['user' => $user, 'game_id' => $response->json('game_id')];
    }

    /**
     * 
     * @depends test_user_starts_a_game
     */
    public function test_user_wins_the_game($data)
    {
        $user = $data['user'];

        // for the sake of this challenge
        // the game will be advanced to the last round before victory
        // so that we can make the final click (interaction) to win the game
        $game = Game::find($data['game_id']);
        $game->board = json_encode([
            [0, 1, 1, 1, 1, 1, -3, 1],
            [-1, 1, 1, 1, 1, -3, 1, 1],
            [1, -3, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, -3, -3, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1],
            [1, -3, -3, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, -3, -3, 1, 1]
        ]);
        $game->status = Game::GAME_STATUS_MINES_SET;
        $game->save();

        $response = $this->actingAs($user)->post('/api/interact', [
            'row'     => 0,
            'column'  => 0,
            'action'  => 1,
            'game_id' => $data['game_id']
        ]);

        $response->assertJson(['game_status' => 'WINNER']);
    }

}
