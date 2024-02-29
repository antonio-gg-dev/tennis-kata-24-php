<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private const SCORING_SYSTEM = ['Love', 'Fifteen', 'Thirty', 'Forty'];
    private const DEUCE = 'Deuce';
    private const ALL = 'All';
    private const SCORE_FORMAT = '%s-%s';

    private int $playerOneScore = 0;
    private int $playerTwoScore = 0;

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

            if (($this->isDeuce())) {
                return $this->scoreFormat($scorePlayerOne, self::ALL);
            }

            return $this->scoreFormat($scorePlayerOne, $scorePlayerTwo);
        }

        if ($this->isDeuce()) {
            return self::DEUCE;
        }

        if ($this->hasAdvantageOfOne()) {
            return sprintf("Advantage %s", $this->winningPlayerName());
        }

        return sprintf("Win for %s", $this->winningPlayerName());
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === $this->playerOneName) {
            $this->playerOneScore++;
        }

        if ($playerName === $this->playerTwoName) {
            $this->playerTwoScore++;
        }
    }

    private function isDeuce(): bool
    {
        return $this->playerOneScore === $this->playerTwoScore;
    }

    private function normalGame(): bool
    {
        return $this->playerOneScore < $this->firstScores() && $this->playerTwoScore < $this->firstScores();
    }

    private function notAdvantage(): bool
    {
        return ($this->playerOneScore + $this->playerTwoScore) !== 6;
    }

    private function winningPlayerName(): string
    {
        if ($this->playerOneScore > $this->playerTwoScore) {
            return $this->playerOneName;
        }

        return $this->playerTwoName;
    }

    private function hasAdvantageOfOne(): bool
    {
        return abs($this->playerOneScore - $this->playerTwoScore) === 1;
    }

    private function firstScores(): int
    {
        return count(self::SCORING_SYSTEM);
    }

    private function scoreFormat(string $scoreOne, string $scoreTwo): string
    {
        return sprintf(self::SCORE_FORMAT, $scoreOne, $scoreTwo);
    }
}
