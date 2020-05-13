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
<h1>Editera film: <?= $row->title ?></h1>
    <form action="" method="post" class="edit-movie">
        <input type="hidden" name="id" value="<?= $row->id ?>">
        <label style="width:50px; display: inline-block;" for="title">Titel:</label>
        <input type="text" name="title" value="<?= $row->title ?>"><br>
        <label style="width:50px; display: inline-block;" for="Year">År:</label>
        <input type="number" name="year" value="<?= $row->year ?>"><br><br><br>
        <input type="submit" name="edit" value="Spara" style="margin-left:55px;">
    </form>
<?php endforeach; ?>
