<?php

/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    // return "Hello Movie";
    // $title = "Show all movies";
    // $view[] = "view/show-all.php";
    // $sql = "SELECT * FROM movie;";
    // $resultset = $db->executeFetchAll($sql);


    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/index", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
    // ]);
    // $data = [
    //     "title" => "Movie databas | oophp"
    // ];
    //
    // $app->db->connect();
    //
    // $sql = "SELECT * FROM movie;";
    // $res = $app->db->executeFetchAll($sql);
    //
    // $data["resultset"] = $res;
    //
    // $app->page->add("movie/index", $data);
    // $app->page->render($data);
// });
