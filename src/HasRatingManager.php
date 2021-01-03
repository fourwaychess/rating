<?php

namespace FourWayChess\Rating;

trait HasRatingManager
{
    /**
     * Calculate the new rating based on the current game.
     *
     * @return array Returns the calculated ratings.
     */
    public function calculateRatings()
    {
        $result = $this->result;
        $rr = (new RatingCalculator)->calculate(($this->blue + $this->green) / 2, $this->red, $this->r_constant, $result);
        $yr = (new RatingCalculator)->calculate(($this->blue + $this->green) / 2, $this->yellow, $this->y_constant, $result);
        if ($result === -1)
            $result = 1;
        $br = (new RatingCalculator)->calculate(($this->red + $this->yellow) / 2, $this->blue, $this->b_constant, $result);
        $gr = (new RatingCalculator)->calculate(($this->red + $this->yellow) / 2, $this->green, $this->g_constant, $result);
        return [$rr, $br, $yr, $gr];
    }
}
