<?php

/**
 * Guess my number, a SESSION version.
 */
require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

session_name("roju19");
session_start();

if (!isset($_SESSION["guessgame"])) {
    $_SESSION["guessgame"] = new Guess();
}


// Deal with variables
$guessgame = $_SESSION["guessgame"];
$number = $guessgame->number();
$tries = $guessgame->tries();


// Deal with POST variables
$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;


// Init the game
if ($doInit) {
    $_SESSION = [];
    header("Location: index.php");
} elseif ($doGuess) {
    if ($guess=="") {
    // om blank, 0
        $res = "either empty, or not set at all";
    } else {
    // Do a guess
        $res = $guessgame->makeGuess($guess);
        $tries   = $guessgame->tries();
    }
}

// Render the page
require __DIR__ . "/view/guess_my_number.php";
require __DIR__ . "/view/debug_session_post_get.php";
