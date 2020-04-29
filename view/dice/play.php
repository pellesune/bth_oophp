<?php

namespace Roju19\Dice;

/**
 * debug
 */
// var_dump($game);
// var_dump($currRoll);

/**
 * Init and re:start the dice game
 */
if (isset($_POST["doInit"])) {
    $_SESSION = [];
    $_POST = [];

    session_destroy();
    $game = new \Roju19\Dice\DiceGame();
}

/**
 * Play the dice game and roll the dices
 */
if (isset($_POST["doRoll"])) {
    $game->getPlayers()[$game->currentPlayer()]->roll();
    $game->addToScorecard($game->getPlayers()[$game->currentPlayer()]->values());

    if (in_array("1", $game->diceScorecard())) {
        $currRoll = "It was at least one dice in last roll: " .
            implode(", ", $game->getPlayers()[$game->currentPlayer()]->values());
    } else {
        $currRoll = "Dices: " .
            implode(", ", $game->getPlayers()[$game->currentPlayer()]->values()) .
            "<br>" . "Score this round: " . array_sum($game->diceScorecard()) . "<br>";
    }


    if ($game->currentPlayer() == 1) {
        $game->playComputerTurn();
    } else {
        if (!in_array(1, $game->diceScorecard())) {
            ;
        } else {
            $game->changeCurrentPlayer();
        }
    }
}


/**
 * Save the results to diceScorecard and change player
 */
if (isset($_POST["doSave"])) {
    $game->getPlayers()[$game->currentPlayer()]->setPoints($game->diceScorecard());
    $game->changeCurrentPlayer();
    $game->isDone();
}

?>
    <ul>
    <?php for ($i=0; $i < count($game->getNames()); $i++) { ?>
              <li><b><?= $game->getNames()[$i] ?></b> <?= $game->getPlayers()[$i]->points() ?></li>
    <?php } ?>
    </ul>
    <ul>
    <?php if (null !== $game->diceScorecard() && $currRoll !== "") { ?>
              <b><?= $player ?> last turn</b> <br>
              <?= $currRoll ?>
    <?php } ?>
    </ul>

    <?php if ($game->isDone()) { ?>
        <p><?= $game->isDone() ?></p>
        <form method="post">
                <input type="submit" name="doInit" value="Start from beginning" style="float: center;"/>
        </form>
    <?php } else { ?>
        <form method="post">
                <?php if ($game->currentPlayer() == 0) { ?>
                    <input type="submit" name="doRoll" value="<?= $game->getNames()[0] ?> roll" style="float: left;">
                        <?php if (null !== $game->diceScorecard()) {
                            if (sizeof($game->diceScorecard()) > 0) { ?>
                                    <input type="submit" name="doSave" value="Save round">
                            <?php } ?>
                        <?php } ?>
                <?php } else { ?>
                    <input type="submit" name="doRoll" value="<?= $game->getNames()[1] ?> roll" style="float: left;">
                <?php } ?>
                <input type="submit" name="doInit" value="Start from beginning" style="float: center;" />
        </form>
    <?php } ?>
