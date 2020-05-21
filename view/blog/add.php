<?php
namespace Anax\View;

// if (!$res) {
//     return;
// }
// echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($res);
?><br>
<form method="post">
    <fieldset>
    <legend>Add</legend>

    <p>
        <label>Title:<br>
            <?php if (isset($error)) { ?>
                <input type="text" name="title" required="required" pattern="[A-Za-z0-9]{1,120}" value="<?= $title ?>"/>
            <?php } else { ?>
                <input type="text" name="title" required="required" pattern="[A-Za-z0-9]{1,120}"/>
            <?php } ?>
        </label>
    </p>
    <p>
        <label>Path:<br>
            <?php if (isset($error)) { ?>
                <input type="text" name="path" value="<?= $path ?>"/>
                <?php if ($pathCheck > 0) { ?><b><?= " *  Path " . $error ?></b>
                <?php } ?>
            <?php } else { ?>
                <input type="text" name="path"/>
            <?php } ?>
        </label>
    </p>
    <p>
        <label>Slug:<br>
            <?php if (isset($error)) { ?>
                <input type="text" name="slug" value="<?= $slug ?>"/>
                <?php if ($slugCheck > 0) { ?><b><?= " *  Slug " . $error ?></b>
                <?php } ?>
            <?php } else { ?>
                <input type="text" name="slug"/>
            <?php } ?>
        </label>
    </p>
    <p>
        <label>Text:<br>
            <?php if (isset($error)) { ?>
                <textarea name="data"><?= $data ?></textarea>
            <?php } else { ?>
                <textarea name="data"></textarea>
            <?php } ?>
        </label>
    </p>
    <p>
        <label>Type:<br>
            <?php if (isset($error)) { ?>
                <input type="text" name="type" value="<?= $type ?>"/>
            <?php } else { ?>
                <input type="text" name="type"/>
            <?php } ?>
        </label>
    </p>
    <p>
        <label>Filter:<br>
            <?php if (isset($error)) { ?>
                <input type="text" name="filter" value="<?= $filter ?>"/>
            <?php } else { ?>
                <input type="text" name="filter"/>
            <?php } ?>
        </label>
    </p>
    <p>
        <button type="submit" name="add"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
        <button type="submit" name="cancel" formnovalidate><i class="fas fa-times" aria-hidden="true"></i> Cancel</button>
    </p>
    </fieldset>
</form>
