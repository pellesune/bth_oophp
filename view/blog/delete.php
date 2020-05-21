<?php
namespace Anax\View;

if (!$res) {
    return;
}
// echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($res);
?>
<?php foreach ($res as $value) : ?>
<form method="post">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="id" value="<?= htmlentities($value->id) ?>"/>

    <p>
        <label>Title:<br>
            <input type="text" name="title" value="<?= htmlentities($value->title) ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="delete"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
        <button type="submit" name="cancel" formnovalidate><i class="fas fa-times" aria-hidden="true"></i> Cancel</button>
    </p>
    </fieldset>
</form>
<?php endforeach; ?>
