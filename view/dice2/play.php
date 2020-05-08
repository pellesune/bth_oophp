<?php

namespace Roju19\Dice;

/**
 * debug
 */
// var_dump($currRoll);
// var_dump($game);
// var_dump($player);


/**
 * Show off a histogram.
 */
// include(__DIR__ . "/config.php");
// include(__DIR__ . "/autoload_namespace.php");


// $rolls = $_GET["rolls"] ?? 6;
//
// $robert = new DiceHistogram2();
// $robert->getHistogramSerie();
// $histogram = new Histogram();
// $histogram->injectData($robert);

// var_dump($session);
// var_dump($historygram);
//
// for ($i = 0; $i < $rolls; $i++) {
//     $dice->diceRandom();
// }

// $histogram = $game->getHistogram();
// $histogram->injectData($dice);

// $rolls = $_GET["rolls"] ?? 6;

// $dice = new DiceHistogram2();

// for ($i = 0; $i < $rolls; $i++) {
    // $dice->roll();
// }
// $histogram = $game->getHistogram();

// $dice = new DiceHistogram();
// $dice->roll();
// var_dump($game);
// var_dump($diceHistogram);
// var_dump($histogram);
// var_dump($this->serie);

?><h1>Dice 100 controller</h1>
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
<pre><?= $histogram->getAsText() ?></pre>
