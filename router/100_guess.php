<?php
/**
 * Create routes using $app programming style.
 */


/**
 * Init the gane and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session for the gamestart.
    $_SESSION["guessgame"] = new Roju19\Guess\Guess();

    // Deal with variables
    $_SESSION["number"] = $_SESSION["guessgame"]->number();
    $_SESSION["tries"] = $_SESSION["guessgame"]->tries();

    return $app->response->redirect("guess/play");
});


/**
 * PLay the game - show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    // Get current settings from the SESSION
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doGuess = $_SESSION["doGuess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;

    // Reset SESSION
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["doGuess"] = null;
    $_SESSION["doCheat"] = null;


    $data = [
        "tries" => $_SESSION["tries"] ?? null,
        "doGuess" => $doGuess ?? null,
        "guess" => $guess ?? null,
        "res" => $res ?? null,
        "doCheat" => $doCheat ?? null,
        "number" => $_SESSION["number"] ?? null,
    ];

    $app->page->add("guess/play", $data);
  // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * PLay the game - make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";

    // Deal with POST variables
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

  // Get current settings from the SESSION
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    if ($doCheat) {
        $_SESSION["doCheat"] = $doCheat;
    }

    if ($doGuess) {
        if ($guess=="") {
        // om blank, 0
            $_SESSION["res"] = "either empty, or not set at all";
        } else {
      // Do a guess
            $_SESSION["res"] = $_SESSION["guessgame"]->makeGuess($guess);
            $_SESSION["tries"]   = $_SESSION["guessgame"]->tries();
            $_SESSION["guess"] = $guess;
            $_SESSION["doGuess"] = $doGuess;
        }
    }

    if ($doInit) {
        return $app->response->redirect("guess/init");
    }

    return $app->response->redirect("guess/play");
});
