<?php
/**
 * Guess game specific routes.
 */
//var_dump($data);

/**
 * Init the game and redirect to play the game.
 */
$app->router->get("dice100/init", function () use ($app) {
    // Init the session for the gamestart.
    $_SESSION = [];
    $_POST = [];
    session_destroy();
    return $app->response->redirect("dice100/play");
});

/**
 * Showing Guess my number with $_POST, rendered within the standard page layout.
 */
$app->router->any(["GET", "POST"], "dice100/play", function () use ($app) {
    $title = "Tärningsspelet 100";
    $currRoll = "";

    $_SESSION["game"] = (isset($_SESSION["game"]) ? $_SESSION["game"] : new \Roju19\Dice\DiceGame());
    $_SESSION["game"] = (isset($_POST["game"]) ? $_POST["game"] : $_SESSION["game"]);

    $game = $_SESSION["game"];
    $player = ($game->currentPlayer() == 0) ? "Player's " : "Computer's ";

    $data = [
        "game" => $game,
        "player" => $player,
        "currRoll" => $currRoll,
        "title" => $title,
    ];
    $app->page->add("dice/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
