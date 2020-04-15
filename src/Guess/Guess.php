<?php

namespace Roju19\Guess;

/**
 * This is a summary
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /** @var int $number   The current secret number. */
    private $number;
    /** @var int $tries    Number of tries a guess has been made.  */
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        // Number
        if ($number === -1) {
              $this->random();
        } else {
              $this->number = $number;
        }
        // tries
        $this->tries = $tries;
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function random()  : void
    {
        // randon number
        $this->number = rand(1, 100);
    }


    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries() : int
    {
        // tries left
        return $this->tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number() : int
    {
      // secret number
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @param int $guess the guesses number
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($guess) : string
    {
        if ($guess<1) {
            throw new GuessException("Number is only allowed to be a higher than 0.");
        } elseif ($guess>100) {
            throw new GuessException("Number is only allowed to be a lower than 101.");
        } else {
            if ($this->tries > 1) {
                $this->tries -= 1;
                if ($guess == $this->number) {
                    $res = "CORRECT";
                    $this->tries = 0;
                } elseif ($guess > $this->number) {
                    $res = "TOO HIGH";
                } else {
                    $res = "TOO LOW";
                }
            } elseif ($this->tries == 1) {
                $this->tries -= 1;
                if ($guess == $this->number) {
                    $res = "CORRECT";
                } else {
                    $res = "<b> NOT CORRECT and you have no guesses remains!</b> Press 'Start from beginning' to play again.";
                }
            }
            return $res;
        }
    }
}
