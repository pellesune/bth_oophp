<?php

namespace Roju19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceCreateObjectTest extends TestCase
{


    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Roju19\Dice\Dice", $dice);
    }


    /**
     * Construct object and verify that the object and Method roll()
     */
    public function testCreateObjectRoll()
    {
        $dice = new Dice();

        $res = $dice->roll();
        $low = 1;
        $high = 6;

        $this->assertTrue($res<=$high);
        $this->assertTrue($res>=$low);
    }


    /**
     * Construct object and verify that the object and Method getLastRoll()
     */
    public function testCreateObjectGetLastRoll()
    {
        $dice = new Dice();
        $dice->roll();

        $res = $dice->getLastRoll();
        $low = 1;
        $high = 6;

        $this->assertTrue($res<=$high);
        $this->assertTrue($res>=$low);
    }
}
