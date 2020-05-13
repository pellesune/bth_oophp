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
<?php foreach ($res as $row) :?>
<h1>Radera film: <?= $row->title ?></h1>
    <form method="post">
        <label style="width:50px; display: inline-block;" for="id">Id:</label>
        <input type="text" name="id" value="<?= $row->id ?>" readonly><br>
        <label style="width:50px; display: inline-block;" for="title">Titel:</label>
        <input type="text" name="title" value="<?= $row->title ?>" readonly><br>
        <label style="width:50px; display: inline-block;" for="Year">År:</label>
        <input type="text" name="year" value="<?= $row->year ?>" readonly><br><br><br>
        <input type="submit" name="delete" value="Radera" style="margin-left:55px;">
    </form>
<?php endforeach; ?>
