<?php

declare(strict_types=1);

namespace Tests;

use TennisGame\TennisGame3;

/**
 * TennisGame1 test case.
 */
class TennisGame3Test extends TestMaster
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->game = new TennisGame3('player1', 'player2');
    }

    public function test_rafa_nadal_can_wins(): void
    {
        $playerOneName = 'Rafa Nadal';
        $this->game = new TennisGame3($playerOneName, 'Antonio Federer');

        $this->game->wonPoint($playerOneName);

        $this->assertSame("Fifteen-Love", $this->game->getScore());
    }

    public function test_ball_boys_cannot_wins(): void
    {
        $playerOneName = 'Rafa Nadal';
        $ballBoy = 'Little Timmy';
        $this->game = new TennisGame3($playerOneName, 'Antonio Federer');

        $this->game->wonPoint($ballBoy);

        $this->assertSame("Love-All", $this->game->getScore());
    }

    /**
     * @dataProvider data
     */
    public function testScores(int $score1, int $score2, string $expectedResult): void
    {
        $this->seedScores($score1, $score2);
        $this->assertSame($expectedResult, $this->game->getScore());
    }
}
