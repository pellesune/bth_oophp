<?php

namespace Roju19\Blog;

/**
 * Create a filtersText of a string.
 *
 * @param string $text the string to format as text.
 *
 * @param string $filterType the string to format as $filterType.
 *
 * @return str the formatted slug.
 */
function filtersText($text, $filterType)
{
    $filter = new \Roju19\TextFilter\MyTextFilter();
    $myTextFilter = explode(",", $filterType);
    $text = $filter->parse($text, $myTextFilter);
    return $text;
}

/**
 * Create a count of a int, to be used as a test of exists.
 *
 * @param string $slug the string to format as slug.
 *
 * @param string $id the int to format as id.
 *
 * @return int the formatted slug.
 */
function slugCheck($db, $slug, $id)
{
    if (!$id == null || !$id == "") {
        $sql = "SELECT COUNT(1) AS count FROM content WHERE slug = ? AND id != ?;";
        $res = $db->executeFetchAll($sql, [$slug, $id]);
    } else {
        $sql = "SELECT COUNT(1) AS count FROM content WHERE slug = ?;";
        $res = $db->executeFetchAll($sql, [$slug]);
    }
    return $res[0]->count;
}


/**
 * Create a count of a int, to be used as a test of exists.
 *
 * @param string $slug the string to format as slug.
 *
 * @param string $id the int to format as id.
 *
 * @return int the formatted slug.
 */
function pathCheck($db, $path, $id)
{
    if (!$id == null || !$id == "") {
        $sql = "SELECT COUNT(1) AS count FROM content WHERE path = ? AND id != ?;";
        $res = $db->executeFetchAll($sql, [$path, $id]);
    } else {
        $sql = "SELECT COUNT(1) AS count FROM content WHERE path = ?;";
        $res = $db->executeFetchAll($sql, [$path]);
    }
    return $res[0]->count;
}


/**
 * Create a slug of a string, to be used as url.
 *
 * @param string $str the string to format as slug.
 *
 * @return str the formatted slug.
 */
function slugify($str)
{
    $str = mb_strtolower(trim($str));
    $str = str_replace(['å','ä'], 'a', $str);
    $str = str_replace('ö', 'o', $str);
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = trim(preg_replace('/-+/', '-', $str), '-');
    return $str;
}
