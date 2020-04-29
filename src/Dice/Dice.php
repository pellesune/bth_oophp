<?php

namespace Roju19\Dice;

/**
 * This is a summary
 * Showing of a standard Dice class
 */

 // Show incoming variables and view helper functions
 //echo showEnvironment(get_defined_vars(), get_defined_functions());

class Dice
{
    /**
     * @var int $sides        Number of sides that the dice has
     * @var int $lastRoll     The latest dice roll
     */
    private $sides;
    private $lastRoll;

    /**
     * Constructor to create a dice.
     *
     * @param 6|int $sides  Sides of the dice and set lastRoll to null
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
        $this->lastRoll = null;
    }

    /**
     * function to roll the dice.
     *
     * @return int  number between 1 and $this->sides
     */
    public function roll()
    {
        $newRoll = rand(1, $this->sides);
        $this->lastRoll = $newRoll;
        return $newRoll;
    }

    /**
     * Get/Return variable lastRoll
     *
     * @return int      the latest roll
     */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }
}
