<?php
namespace Anax\View;

if (!$res) {
    return;
}
// echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($res);
?><br>
<?php foreach ($res as $value) : ?>
<form method="post">
    <fieldset>
    <legend>Edit</legend>

    <input type="hidden" name="id" value="<?= htmlentities($value->id) ?>"/>

    <p>
        <label>Title:<br>
            <input type="text" name="title" value="<?= htmlentities($value->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
            <?php if (isset($value->error)) { ?>
                <input type="text" name="path" value="<?= htmlentities($value->path) ?>"/>
                <?php if ($value->pathCheck > 0) { ?><b><?= " * Path " . $value->error ?></b>
                <?php } ?>
            <?php } else { ?>
                <input type="text" name="path" value="<?= htmlentities($value->path) ?>"/>
            <?php } ?>
        </label>
    </p>

    <p>
        <label>Slug:<br>
            <?php if (isset($value->error)) { ?>
                <input type="text" name="slug" value="<?= htmlentities($value->slug) ?>"/>
                <?php if ($value->slugCheck > 0) { ?><b><?= " * Slug " . $value->error ?></b>
                <?php } ?>
            <?php } else { ?>
                <input type="text" name="slug" value="<?= htmlentities($value->slug) ?>"/>
            <?php } ?>
        </label>
    </p>

    <p>
        <label>Text:<br>
            <textarea name="data"><?= htmlentities($value->data) ?></textarea>
        </label>
    </p>

    <p>
        <label>Type:<br>
            <input type="text" name="type" value="<?= htmlentities($value->type) ?>"/>
        </label>
    </p>

    <p>
        <label>Filter:<br>
            <input type="text" name="filter" value="<?= htmlentities($value->filter) ?>"/>
        </label>
    </p>

    <p>
        <label>Publish:<br>
            <input type="datetime" name="published" value="<?= htmlentities($value->published) ?>"/>
        </label>
    </p>
    <p>
        <button type="submit" name="edit"><i class="fas fa-save" aria-hidden="true"></i> Save</button>
        <button type="submit" name="cancel" formnovalidate><i class="fas fa-times" aria-hidden="true"></i> Cancel</button>
    </p>
    </fieldset>
</form>
<?php endforeach; ?>
