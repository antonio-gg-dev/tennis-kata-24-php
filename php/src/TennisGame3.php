<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    const SCORING_SYSTEM = ['Love', 'Fifteen', 'Thirty', 'Forty'];
    private int $playerTwoScore = 0;

    private int $playerOneScore = 0;

    public function __construct(
        private string $playerOneName,
        private string $playerTwoName
    ) {
    }

    public function getScore(): string
    {
        if ($this->playerOneScore < 4 && $this->playerTwoScore < 4 && ! ($this->playerOneScore + $this->playerTwoScore === 6)) {
            $p = self::SCORING_SYSTEM;
            $s = $p[$this->playerOneScore];
            return ($this->playerOneScore === $this->playerTwoScore) ? "{$s}-All" : "{$s}-{$p[$this->playerTwoScore]}";
        }
        if ($this->playerOneScore === $this->playerTwoScore) {
            return 'Deuce';
        }
        $s = $this->playerOneScore > $this->playerTwoScore ? $this->playerOneName : $this->playerTwoName;
        return (($this->playerOneScore - $this->playerTwoScore) * ($this->playerOneScore - $this->playerTwoScore) === 1) ? "Advantage {$s}" : "Win for {$s}";
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === 'player1') {
            $this->playerOneScore++;
        } else {
            $this->playerTwoScore++;
        }
    }
}
