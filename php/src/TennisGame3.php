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
        if ($this->normalGame() && $this->notAdvantage()) {
            $scorePlayerOne = self::SCORING_SYSTEM[$this->playerOneScore];
            $scorePlayerTwo = self::SCORING_SYSTEM[$this->playerTwoScore];
            return ($this->isDeuce()) ? "{$scorePlayerOne}-All" : "{$scorePlayerOne}-{$scorePlayerTwo}";
        }
        if ($this->isDeuce()) {
            return 'Deuce';
        }
        $winnerPlayer = $this->winningPlayer();
        return (
            $this->hasAdvantageOfOne() ?
            "Advantage {$winnerPlayer}" : "Win for {$winnerPlayer}");
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === 'player1') {
            $this->playerOneScore++;
        } else {
            $this->playerTwoScore++;
        }
    }

    /**
     * @return bool
     */
    public function isDeuce(): bool
    {
        return $this->playerOneScore === $this->playerTwoScore;
    }

    /**
     * @return bool
     */
    public function normalGame(): bool
    {
        return $this->playerOneScore < 4 && $this->playerTwoScore < 4;
    }

    /**
     * @return bool
     */
    public function notAdvantage(): bool
    {
        return !($this->playerOneScore + $this->playerTwoScore === 6);
    }

    /**
     * @return string
     */
    public function winningPlayer(): string
    {
        return $this->playerOneScore > $this->playerTwoScore ? $this->playerOneName : $this->playerTwoName;
    }

    public function hasAdvantageOfOne(): bool
    {
        return abs($this->playerOneScore - $this->playerTwoScore) === 1;
    }
}
