<?php

namespace Roju19\Blog;

require "functions.php";

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

class BlogController implements AppInjectableInterface
{
    use AppInjectableTrait;

         // "SELECT id, path, slug, title, data, type, filter, published, created, updated, deleted FROM content;";
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
        $db = $this->app->db;

        $data["title"] = "Blog controller | oophp";

        $db->connect();

        $sql = "SELECT id, title, published, created, updated, deleted, path, slug FROM content;";
        $data["res"] = $db->executeFetchAll($sql);

        $page->add("blog/index", $data);

        return $page->render($data);
    }


    public function adminActionGet() : object
    {
        // $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $data["title"] = "Blog admin | oophp";

        $db->connect();

        $sql = "SELECT id, title, type ,published, created, updated, deleted FROM content;";
        $data["res"] = $db->executeFetchAll($sql);

        $page->add("blog/admin", $data);

        return $page->render($data);
    }


    public function adminActionPost() : object
    {
        // $request = $this->app->request;
        $response = $this->app->response;
        // $session = $this->app->session;
        // $page = $this->app->page;
        // $db = $this->app->db;

        return $response->redirect("blog/admin");
    }

    public function pagesActionGet() : object
    {
        // $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $data["title"] = "Blog pages | oophp";

        $db->connect();

        $sql = <<<EOD
        SELECT
            *,
            CASE
                WHEN (deleted <= NOW()) THEN "isDeleted"
                WHEN (published <= NOW()) THEN "isPublished"
                ELSE "notPublished"
            END AS status
        FROM content
        WHERE type= 'page'
        ;
EOD;
        $data["res"] = $db->executeFetchAll($sql);

        $page->add("blog/pages", $data);

        return $page->render($data);
    }

    public function pageAction($path)
    {
        // $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $title = "Show Page";

        $db->connect();
        $sql = "SELECT * FROM content WHERE path = ? OR id = ?";
        $res = $db->executeFetchAll($sql, [$path, $path]);

        $res[0]->data = filtersText($res[0]->data, $res[0]->filter);

        $page->add("blog/page", [
            "res" => $res[0],
        ]);
        return $page->render([
            "title" => $title,
        ]);
    }

    public function blogpostActionGet() : object
    {
        // $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $data["title"] = "Blogpost | oophp";

        $db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type='post'
ORDER BY published DESC
;
EOD;
        $data["res"] = $db->executeFetchAll($sql);

        $page->add("blog/blogpost", $data);

        return $page->render($data);
    }

    public function postAction($slug)
    {
        // $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $title = "Show Post";

        $db->connect();
        $sql = "SELECT * FROM content WHERE slug = ?";
        $res = $db->executeFetchAll($sql, [$slug]);

        $res[0]->data = filtersText($res[0]->data, $res[0]->filter);

        $page->add("blog/post", [
            "res" => $res[0],
        ]);
        return $page->render([
            "title" => $title,
        ]);
    }


    public function addActionGet() : object
    {
        // $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        // $db = $this->app->db;

        $data["title"] = "Add a Blog";
        $page->add("blog/add", $data);

        return $page->render($data);
    }

    public function addActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $cancel = $request->getPost("cancel");

        if (isset($cancel)) {
            return $response->redirect("blog/admin");
        } else {
            $db->connect();
            $sql = "INSERT INTO content (path, slug, type, title, data, filter) VALUES (?, ?, ?, ?, ?, ?)";

            $path = $request->getPost("path");
            $slug =  slugify($request->getPost("slug"));
            $type = $request->getPost("type");
            $title = $request->getPost("title");
            $data = $request->getPost("data");
            $filter = $request->getPost("filter");

            if ($path == "") {
                $path = null;
            }

            if ($slug == null || $slug == "") {
                $slug = slugify($title);
            }

            $pathCheck = pathCheck($db, $path, null);
            $slugCheck = slugCheck($db, $slug, null);

            if ($slugCheck == 0 && $pathCheck == 0) {
                 $db->execute($sql, [$path, $slug, $type, $title, $data, $filter]);
                 return $response->redirect("blog/admin");
            } else {
                  $page->add("blog/add", [
                      "error" => "already exists",
                      "path" => $path,
                      "slug" => $slug,
                      "type" => $type,
                      "title" => $title,
                      "data" => $data,
                      "filter" => $filter,
                      "pathCheck" => $pathCheck,
                      "slugCheck" => $slugCheck,
                  ]);
                  return $page->render([
                      "title" => "Add a Blog",
                  ]);
            }
        }
    }

    public function editActionGet() : object
    {
        $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $db->connect();
        $sql = "SELECT * FROM content WHERE id = ?";

        $id = $request->getGet("id");

        $data["res"] = $db->executeFetchAll($sql, [$id]);
        $data["title"] = "Edit blog";

        $page->add("blog/edit", $data);

        return $page->render($data);
    }

    public function editActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $cancel = $request->getPost("cancel");

        if (isset($cancel)) {
            return $response->redirect("blog/admin");
        } else {
            $db->connect();
            $sql = "UPDATE content
                        SET path = ?,
                            slug = ?,
                            type = ?,
                            title = ?,
                            data = ?,
                            filter = ?
                    WHERE id = ?";

            $path = $request->getPost("path");
            $slug =  slugify($request->getPost("slug"));
            $type = $request->getPost("type");
            $title = $request->getPost("title");
            $data = $request->getPost("data");
            $filter = $request->getPost("filter");
            $published = $request->getPost("published");
            $id = $request->getPost("id");

            if ($path == "") {
                $path = null;
            }

            if ($slug == null || $slug == "") {
                $slug = slugify($title);
            }

            $pathCheck = pathCheck($db, $path, $id);
            $slugCheck = slugCheck($db, $slug, $id);

            if ($slugCheck == 0 && $pathCheck == 0) {
                 $db->execute($sql, [$path, $slug, $type, $title, $data, $filter, $id]);
                 return $response->redirect("blog/admin");
            } else {
                $arr[] = (object) array(
                    "error" => "already exists",
                    "path" => $path,
                    "slug" => $slug,
                    "type" => $type,
                    "title" => $title,
                    "data" => $data,
                    "filter" => $filter,
                    "published" => $published,
                    "id" => $id,
                    "pathCheck" => $pathCheck,
                    "slugCheck" => $slugCheck,
                );
                $data2['res'] = $arr;

                $page->add("blog/edit", $data2);

                return $page->render($data2);
            }
        }
    }

    public function deleteActionGet() : object
    {
        $request = $this->app->request;
        // $response = $this->app->response;
        // $session = $this->app->session;
        $page = $this->app->page;
        $db = $this->app->db;

        $db->connect();
        $sql = "SELECT * FROM content WHERE id = ?";
        $id = $request->getGet("id");

        $data["res"] = $db->executeFetchAll($sql, [$id]);
        $data["title"] = "Delete blog";

        $page->add("blog/delete", $data);

        return $page->render($data);
    }

    public function deleteActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        // $session = $this->app->session;
        // $page = $this->app->page;
        $db = $this->app->db;

        $cancel = $request->getPost("cancel");

        if (isset($cancel)) {
            return $response->redirect("blog/admin");
        } else {
            $db->connect();
            $sql = "UPDATE content
                        SET deleted=NOW()
                    WHERE id=?;";
            $id = $request->getPost("id");

            $db->execute($sql, [$id]);

            return $response->redirect("blog/admin");
        }
    }
}
