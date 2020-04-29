<?php

namespace Roju19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceGame.
 */
class DiceGameCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $diceGame = new DiceGame();
        $this->assertInstanceOf("\Roju19\Dice\DiceGame", $diceGame);

        $res = $diceGame->getNames();
        $exp = "Player";

        $this->assertEquals($exp, $res[0]);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectGetPlayers()
    {
        $diceGame = new DiceGame(1, 2);
        $this->assertInstanceOf("\Roju19\Dice\DiceGame", $diceGame);

        $res = count($diceGame->getPlayers());

        $exp = 2;

        $this->assertTrue($res==$exp);
    }

    /**
     * Construct object and verify that the object and Method dices()
     */
    public function testCreateObjectDices()
    {
        $diceGame = new DiceGame(1, 2);
        $this->assertInstanceOf("\Roju19\Dice\DiceGame", $diceGame);

        $res = $diceGame->dices();

        $exp = 1;

        $this->assertTrue($res==$exp);
    }

    /**
     * Construct object and verify that the object and Method currentPlayer()
     */
    public function testCreateObjectCurrentPlayer()
    {
        $diceGame = new DiceGame(1, 2);
        $this->assertInstanceOf("\Roju19\Dice\DiceGame", $diceGame);

        $res = $diceGame->currentPlayer();

        $exp = 0;

        $this->assertTrue($res==$exp);
    }

    /**
     * Construct object and verify that the object and Method ChangeCurrentPlayer()
     */
    public function testCreateObjectChangeCurrentPlayer()
    {
        $diceGame = new DiceGame(1, 2);
        $this->assertInstanceOf("\Roju19\Dice\DiceGame", $diceGame);

        $diceGame->ChangeCurrentPlayer();
        $res = $diceGame->currentPlayer();

        $exp = 1;
        $this->assertTrue($res==$exp);
    }


        /**
         * Construct object and verify that the object and Methods addToScorecard()
         * and diceScorecard().
         */
    public function testCreateObjectAddToScorecardAndDiceScorecard()
    {
        $diceGame = new DiceGame(1, 2);
        $this->assertInstanceOf("\Roju19\Dice\DiceGame", $diceGame);

        $diceGame->getPlayers()[$diceGame->currentPlayer()]->roll();
        $values = $diceGame->getPlayers()[$diceGame->currentPlayer()]->values();
        $diceGame->addToScorecard($values);
        $res = $diceGame->diceScorecard();

        $exp = 1;
        $this->assertTrue($res>=$exp);
    }
}
