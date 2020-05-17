<?php

namespace Roju19\TextFilter;

// namespace Roju19\Movie;
// namespace Anax\TextFilter;

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

class MyTextFilterController implements AppInjectableInterface
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
    public function indexActionGet() : object
    {
        // $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        // $db = $this->app->db;

        $title = 'Textfiler';
        $myTextFilter = new MyTextFilter();

        $bbText = "[b]Fetstil[/b] på den vänstra av två fetstil.";
        $bbHTML = $myTextFilter->parse($bbText, ["bbcode"]);

        $linkText = "http://www.student.bth.se/~roju19/dbwebb-kurser/oophp/me/redovisa/htdocs/";
        $linkHTML = $myTextFilter->parse($linkText, ["link"]);

        $markdownText = "
1. Ordered list
2. Ordered list again
        ";
        $markdownHTML = $myTextFilter->parse($markdownText, ["markdown"]);

        $nl2brText = "Första raden\nAndra raden\nTredje raden\nFjärde raden";
        $nl2brHTML = $myTextFilter->parse($nl2brText, ["nl2br"]);

        $page->add("textfilter/index", [
            "bbText" => $bbText,
            "bbHTML" => $bbHTML,
            "linkText" => $linkText,
            "linkHTML" => $linkHTML,
            "markdownText" => $markdownText,
            "markdownHTML" => $markdownHTML,
            "nl2brText" => $nl2brText,
            "nl2brHTML" => $nl2brHTML,
        ]);
        return $page->render([
            "title" => $title,
        ]);
    }
}
