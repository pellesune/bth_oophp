<?php

namespace Roju19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Roju19\Dice\DiceHand", $diceHand);

        $res = $diceHand->points();
        $exp = 0;

        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object and Methods roll() and values()
     */
    public function testCreateObjectRollAndValues()
    {
        $diceHand = new DiceHand(1);
        $diceHand->roll();

        $res = $diceHand->values();

        $low = 1;
        $high = 6;

        $this->assertTrue($res[0]<=$high);
        $this->assertTrue($res[0]>=$low);
    }

    /**
     * Construct object and verify that the object and Methods setPoints()
     * and points(). Roll until <> 1 and setPoints = True and points 2->6
     */
    public function testCreateObjectSetPointsTrue()
    {
        $diceHand = new DiceHand(1);

        // Roll dice until <> 1
        do {
                    $diceHand->roll();
                    $values = $diceHand->values();
                    $res = in_array(1, $values);
        } while ($res === true);

        $res1 = $diceHand->setPoints($values);
        $res2 = $diceHand->points();

        $low = 2;
        $high = 6;

        $this->assertTrue($res1);

        $this->assertTrue($res2<=$high);
        $this->assertTrue($res2>=$low);
    }

    /**
    * Construct object and verify that the object and Methods setPoints()
    * and points(). Roll until = 1 and setPoints = False and points 0
    */
    public function testCreateObjectSetPointsFalse()
    {
        $diceHand = new DiceHand(1);

        // Roll dice until = 1
        do {
                    $diceHand->roll();
                    $values = $diceHand->values();
                    $res = in_array(1, $values);
        } while ($res === false);

        $res1 = $diceHand->setPoints($values);
        $res2 = $diceHand->points();

        $exp2 = 0;

        $this->assertFalse($res1);
        $this->assertTrue($res2==$exp2);
    }
}
