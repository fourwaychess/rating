<?php

namespace FourWayChess\Rating;

class RatingCalculator
{
    /**
     * Calculate the new ratings.
     *
     * @param int $team     Opposing team's rating.
     * @param int $user     User's rating.
     * @param int $constant A constant var.
     * @param int $result   Did the user win.
     *
     * @return array Returns the updated ratings.
     */
    public static function calculate(int $team, int $user, int $constant, int $result): array
    {
        $userProbability = (1.0 * 1.0 / (1 + 1.0 * pow(10, 1.0 * ($user - $team) / 400)))
        if ($result === 1)
            $user = $user + $constant * (1 - $userProbability);
        else
            $user = $user + $constant * (0 - $userProbability);
        return $user;
    }
}
