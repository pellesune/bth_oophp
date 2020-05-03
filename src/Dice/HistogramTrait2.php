<?php

namespace Roju19\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait2
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];


    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }


    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return 1;
        // return min($this->serie);
    }


    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return 6;
        // return max($this->serie);
    }
}
