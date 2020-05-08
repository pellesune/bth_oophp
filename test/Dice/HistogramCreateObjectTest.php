<?php

namespace Roju19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Histogram.
 */
class HistogramCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the Histogram object has the expected
     * properties. Use no arguments.
     */
    public function testCreateHistogram()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Roju19\Dice\Histogram", $histogram);
    }


    /**
     * Test GetSerie
     *
     */
    public function testCreateGetSerie()
    {
        $diceHistogram2 = new DiceHistogram2();
        $this->assertInstanceOf("\Roju19\Dice\Dice", $diceHistogram2);


        $histogram = new Histogram();
        $this->assertInstanceOf("\Roju19\Dice\Histogram", $histogram);

        $exp = array(1, 4, 6);
        $diceHistogram2->setSerie($exp);

        $histogram->injectData($diceHistogram2);

        $res = $histogram->getSerie();
        $this->assertEquals($exp, $res);
    }
}
