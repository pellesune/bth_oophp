<?php

namespace Roju19\Dice;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram2 extends Dice implements HistogramInterface
{
    use HistogramTrait2;


    /**
     * Get min value for the histogram.
     *
     * @return void with the min value.
     */
    public function setSerie($values)
    {
        $size = count($values);
        for ($i = 0; $i < $size; $i++) {
        // for ($i = 0; $i < count($values); $i++) {
            $this->serie[] = $values[$i];
        }
    }


    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    // public function getHistogramMax()
    // {
    //     return max($this->serie);
    // }

    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    // public function getHistogramMin()
    // {
    //     return min($this->serie);
    // }
}
