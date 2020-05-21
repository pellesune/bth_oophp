<?php
namespace Anax\View;

if (!$res) {
    return;
}
// echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($res);
?><h1>Blog post</h1><br>
<article><?php
foreach ($res as $value) :
    ?>
        <section>
            <header>
                <h1><a href="post/<?= htmlentities($value->slug) ?>"><?= htmlentities($value->title)?></a></h1>
            </header>
            <i>Published: <?=$value->created?></i>
            <p><?=$value->data?></p>
        </section>
    <?php
endforeach; ?>
</article>
