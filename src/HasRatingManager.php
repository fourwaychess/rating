<?php

namespace FourWayChess\Rating;

use App\Models\User;

trait HasRatingManager
{
    /**
     * Calculate the new rating based on the current game.
     *
     * @param bool $update Should we automatically update the ratings as well.
     *
     * @return array Returns the calculated ratings.
     */
    public function calculateRatings(bool $update = true)
    {
        $result = $this->result;
        $rr = RatingCalculator::calculate(($this->blue + $this->green) / 2, $this->red, $this->r_constant, $result);
        $yr = RatingCalculator::calculate(($this->blue + $this->green) / 2, $this->yellow, $this->y_constant, $result);
        if ($result === -1)
            $result = 1;
        $br = RatingCalculator::calculate(($this->red + $this->yellow) / 2, $this->blue, $this->b_constant, $result);
        $gr = RatingCalculator::calculate(($this->red + $this->yellow) / 2, $this->green, $this->g_constant, $result);
        if ($update)
            $this->updateRatings([$rr, $br, $yr, $gr]);
        else
            return [$rr, $br, $yr, $gr];
    }

    /**
     * Update the ratings.
     *
     * @return void Returns nothing.
     */
    public function updateRatings(array $ratings)
    {
        DB::table('users')->where('username', $this->r_username)->update(['rating' => floatval($ratings[0])]);
        DB::table('users')->where('username', $this->b_username)->update(['rating' => floatval($ratings[1])]);
        DB::table('users')->where('username', $this->y_username)->update(['rating' => floatval($ratings[2])]);
        DB::table('users')->where('username', $this->g_username)->update(['rating' => floatval($ratings[3])]);
    }
}
