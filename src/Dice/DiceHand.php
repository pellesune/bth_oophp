<?php

namespace Roju19\Dice;

/**
 * A dicehand, consisting of dices.
 */

class DiceHand
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of rounds of the dices.
     * @var int  $points  consisting of last round of the dices.
     */
    private $dices;
    private $values;
    private $points;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     * Also increments the instance counter
     *
     * @param int $dices Number of dices to create (Qty of dices comes from DiceHand)
     */
    public function __construct(int $dices = 1)
    {
        $this->dices  = [];
        $this->values = [];
        $this->points = 0;

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
            $this->values[] = null;
        }
    }

    /**
     * Roll all dices save their value to array.
     *
     * @return void.
     */
    public function roll()
    {
        for ($i=0; $i < sizeof($this->values); $i++) {
        // for ($i=0; $i < count($this->values); $i++) {
            $this->values[$i] = $this->dices[$i]->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get the player points
     *
     * @return int the total dice points
     */
    public function points()
    {
        return $this->points;
    }

    /**
     *
     * Adds the total sum of all dices if none has the score of 1
     *
     * @param $values Array with the values of the last roll
     *
     * @return bool true if no 1 in values is in the array || Else false
     */
    public function setPoints($values)
    {
        if (in_array(1, $values)) {
            return false;
        } else {
            $this->points += array_sum($values);
        }
        return true;
    }
}
