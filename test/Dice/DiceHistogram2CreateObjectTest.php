<?php

namespace Roju19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Histogram.
 */
class DiceHistogram2CreateObjectTest extends TestCase
{
    /**
     * Test DiceHistogram2 and getHistogramMax
     *
     */
    public function testCreateGetHistogramMax()
    {
        $diceHistogram2 = new DiceHistogram2();
        $this->assertInstanceOf("\Roju19\Dice\Dice", $diceHistogram2);

        $res = $diceHistogram2->getHistogramMax();
        $exp = 6;
        $this->assertEquals($res, $exp);
    }

    /**
     * Test DiceHistogram2 and getHistogramMax
     *
     */
    public function testCreateGetHistogramMin()
    {
        $diceHistogram2 = new DiceHistogram2();
        $this->assertInstanceOf("\Roju19\Dice\Dice", $diceHistogram2);

        $res = $diceHistogram2->getHistogramMin();
        $exp = 1;
        $this->assertEquals($res, $exp);
    }

    /**
     * Test DiceHistogram2 and getHistogramMax
     *
     */
    public function testCreateGetHistogramSerie()
    {
        $diceHistogram2 = new DiceHistogram2();
        $this->assertInstanceOf("\Roju19\Dice\Dice", $diceHistogram2);

        $exp = array(1, 4, 6);
        $diceHistogram2->setSerie($exp);
        $res = $diceHistogram2->getHistogramSerie();
        $this->assertEquals($exp, $res);
    }
}
