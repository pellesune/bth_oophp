<?php

// namespace Anax\View;
namespace Roju19\Movie;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<p>
<form action="" method="get" style="margin-left:150px;">
    <input type="text" name="search" placeholder="Sök efter Id, Titel eller År">
    <button>Sök</button>
</form>
</p>
<table>
    <tr class="index-table">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th></th>
        <th></th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td>
            <form action="" method="post">
                <input type="hidden" name="id" value=<?= $row->id ?>>
                <input type="submit" name="edit" value="Editera">
            </form>
        </td>
        <td>
            <form action="" method="post">
                <input type="hidden" name="id" value=<?= $row->id ?>>
                <input type="submit" name="delete" value="Radera">
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<p>
<form action="" method="post">
    <input type="submit" name="add" value="Lägg till film">
    <input type="submit" name="reset" value="Återskapa film databas" style="margin-left:255px;">
</form>
</p>
