<?php

namespace Roju19\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        // return __METHOD__ . ", \$db is {$this->db}";
        return "INDEX!!";
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    // public function indexAction() : string
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        // return __METHOD__ . ", \$db is {$this->db}";
        return "Debug my game!!";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    // public function indexAction() : string
    // public function initAction() : string
    public function initAction() : object
    {
        $response = $this->app->response;
        $session = $this->app->session;

        // Init the session for the gamestart.
        $session->destroy();
        // $currRoll = "";
        return $response ->redirect("dice2/play");
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    // public function indexAction() : string
    public function playAction() : object
    {
        $page = $this->app->page;
        $request = $this->app->request;
        $session = $this->app->session;

        $title = "Tärningsspelet 100 controller";

        $session->set("game", ($session->has("game") ? $session->get("game") : new DiceGame()));
        $session->set("game", ($request->getPost("game") ? $request->getPost("game") : $session->get("game")));

        $game = $session->get("game");
        $player = ($game->currentPlayer() == 0) ? "Player's " : "Computer's ";

        $session->set("diceHistogram", ($session->has("diceHistogram") ? $session->get("diceHistogram") : new DiceHistogram2()));
        $diceHistogram = $session->get("diceHistogram");

        $session->set("histogram", ($session->has("histogram") ? $session->get("histogram") : new Histogram()));
        $histogram = $session->get("histogram");

        $currRoll = "";

        if ($game->diceScorecard() != null) {
            if (in_array("1", $game->diceScorecard())) {
                $currRoll = $session->get("currRoll", "At least one of the dice shows one in last roll: "
                    . implode(", ", $game->getPlayers()[$game->currentPlayer()]->values()));
                $game->changeCurrentPlayer();
            } else {
                $currRoll = $session->get("currRoll", "Dices: "
                    . implode(", ", $game->getPlayers()[$game->currentPlayer()]->values())
                    . "<br>" . "Score this round: "
                    . array_sum($game->diceScorecard())
                    . "<br>" . "Average this round: "
                    . round(array_sum($game->diceScorecard()) / sizeof($game->diceScorecard()), 2)
                    . "<br>");
                if ($game->currentPlayer() == 1) {
                        $game->playComputerTurn();
                }
            }

            // if (($game->currentPlayer() == 1) && (in_array("1", $game->diceScorecard()))) {
            //     $game->playComputerTurn();
            // }



            // if ($game->currentPlayer() == 1) {
            //     if (in_array("1", $game->diceScorecard())) {
            //         $game->changeCurrentPlayer();
            //     } else {
            //         $game->playComputerTurn();
            //     }
            // } else {
            //     if (!in_array(1, $game->diceScorecard())) {
            //         ;
            //     } else {
            //         $game->changeCurrentPlayer();
            //     }
            // }
        }

        $data = [
            "game" => $game,
            "player" => $player,
            "currRoll" => $currRoll,
            "title" => $title,
            "diceHistogram" => $diceHistogram,
            "histogram" => $histogram,
        ];
        $page->add("dice2/play", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $doInit  = $request->getPost("doInit");
        $doSave  = $request->getPost("doSave");
        $doRoll  = $request->getPost("doRoll");
        $game = $session->get("game");

        if ($doInit) {
            return $response->redirect("dice2/init");
        }

        /**
         * Play the dice game and roll the dices
         */
        if ($doRoll) {
            $game->getPlayers()[$game->currentPlayer()]->roll();
            $game->addToScorecard($game->getPlayers()[$game->currentPlayer()]->values());

            $values = $game->getPlayers()[$game->currentPlayer()]->values();

            $histogram = $session->get("histogram");
            $diceHistogram = $session->get("diceHistogram");
            $diceHistogram->setSerie($values);

            $histogram->injectData($diceHistogram);
        }

        if ($doSave) {
            $game->getPlayers()[$game->currentPlayer()]->setPoints($game->diceScorecard());
            $game->changeCurrentPlayer();
            $game->isDone();
        }

        return $response->redirect("dice2/play");
    }
}
