<?php

namespace Roju19\Dice;

/**
 * Class of the Dice 100 game
 */

class DiceGame
{
    /**
     * @var int       $dices          The number of dices that the game is played with.
     * @var DiceHand  $players        Array of the players
     * @var int       $currentPlayer  The current player number
     * @var array     $diceScorecard  Stores the all DiceHand values
     * @var string    $names          The current player name
     * @var string    $histogram      The
     * @var string    $diceHistogram  The
     */
    private $dices;
    private $players;
    private $currentPlayer;
    private $diceScorecard;
    private $names;
    // private $histogram;
    // private $diceHistogram;

    /**
     * Constructor to create a diceHand.
     *
     * @param 3|int $qtyOfDices        Default value of quantity of dices.
     * @param 2|int $qtyOfPlayers      Default value of quantity of players.
     */
    public function __construct(int $qtyOfDices = 3, int $qtyOfPlayers = 2)
    {
        $this->dices = $qtyOfDices;
        $this->currentPlayer = 0;
        $this->names = [
            0 => "Player",
            1 => "Computer",
        ];
        for ($i=0; $i < $qtyOfPlayers; $i++) {
            $this->players[]  = new DiceHand($this->dices);
        }
    }

    /**
     * Get the names array
     *
     * @return array with the names (DiceHand(s)).
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * Get the players array.
     *
     * @return array with the players (DiceHand(s)).
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Get the number of dices.
     *
     * @return int the number of dices that is getting played.
     */
    public function dices()
    {
        return $this->dices;
    }

    /**
     * Get the current player
     *
     * @return int The array index of the current player.
     */
    public function currentPlayer()
    {
        return $this->currentPlayer;
    }

    /**
     * Change the current player and reset dice Scorecard.
     *
     * @return void
     *
     */
    public function changeCurrentPlayer()
    {
        $this->currentPlayer = ($this->currentPlayer === 1) ? 0 : 1;
        $this->resetDiceScorecard();
    }

    /**
     * Adds score to the array to the round.
     *
     * @param array $values Keeps track of the values.
     *
     * @return void .
     */
    public function addToScorecard($values)
    {
        foreach ($values as $value) {
            $this->diceScorecard[] = $value;
        }
    }


    /**
     * Get the score of the rounds.
     *
     * @return array $this->diceScorecard all values from the dice hand.
     */
    public function diceScorecard()
    {
        return $this->diceScorecard;
    }

    /**
     * Resets the score of the round.
     *
     * @return void
     */
    public function resetDiceScorecard()
    {
        $this->diceScorecard = [];
    }

    /**
     * Play the Computers turn.
     * Save / change player, if sum of hand is equal or higher then 14 OR
     * average of hand is higher then 3.5
     *
     * @return void
     */
    public function playComputerTurn()
    {
        $sum = array_sum($this->diceScorecard);
        // var_dump($sum);
        $ave = $sum / sizeof($this->diceScorecard);
        // var_dump($ave);

        if ($sum >= 14 || $ave >= 3.5) {
            $this->getPlayers()[1]->setPoints($this->diceScorecard());
            $this->changeCurrentPlayer();
            $this->isDone();
        } else {
            $this->getPlayers()[1]->setPoints($this->diceScorecard());
            // $this->changeCurrentPlayer();
            $this->isDone();
        }
    }

    /**
     * Check if games is has a winner.
     *
     * @return bool false if no winner
     */
    public function isDone()
    {
        if ($this->getPlayers()[0]->points() >= 100) {
            return "Player won!";
        } elseif ($this->getPlayers()[1]->points() >= 100) {
            return "Computer won!";
        }
        return false;
    }
}
