<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> left.</p>

<form method="post">
    <input type="text" name="guess" <?= ($tries == 0) ? "readonly" : "" ?>>
    <input type="hidden" name="number" value="<?=$number ?>">
    <input type="hidden" name="tries" value="<?=$tries ?>">
    <input type="submit" name="doGuess" value="Make a guess" <?= ($tries == 0) ? "disabled" : "" ?>>
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>


<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b>.</p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number ?>.</p>
<?php endif; ?>


<!-- <pre>
<?= var_dump($_GET) ?> -->
