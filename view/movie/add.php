<?php

// namespace Anax\View;
namespace Roju19\Movie;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($data["res"]);
// if (!$res) {
//     return;
// }
?>
<h1>Lägg till film</h1>
<form action="" method="post">
    <label for="title">Titel:</label>
    <input type="text" name="title">
    <label for="year">År:</label>
    <input type="number" name="year">
    <input type="submit" name="add" value="Lägg till">
</form>
