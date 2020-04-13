<?php

/**
 * Guess my number, a GET version.
 */
require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";


// Deal with incoming variables
$number = $_GET["number"] ?? null;
$tries = $_GET["tries"] ?? null;
$guess = $_GET["guess"] ?? null;
$doInit = $_GET["doInit"] ?? null;
$doGuess = $_GET["doGuess"] ?? null;
$doCheat = $_GET["doCheat"] ?? null;


// Init the game
if ($doInit || $number === null) {
    $number = rand(1, 100);
    $tries = 5;
    header("Location: index_get.php?tries=$tries&number=$number");
} elseif ($doGuess) {
    // Do a guess
    $tries -= 1;
    if ($guess === $number) {
        $res = "CORRECT";
    } elseif ($guess > $number) {
        $res = "TOO HIGH";
    } else {
        $res = "TOO LOW";
    }
}


// Render the page
?><h1>Guess my number (GET)</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> left.</p>

<form>
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?=$number ?>">
    <input type="hidden" name="tries" value="<?=$tries ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>


<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b>.</p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number ?>.</p>
<?php endif; ?>

<!--
<pre>
<?= var_dump($_GET) ?>
 -->
