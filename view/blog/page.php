<?php
namespace Anax\View;

if (!$res) {
    return;
}
// echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($res);
?><br>
<h1><?=$res->title?></h1>
<i>Published: <?=$res->created?></i>

<p><?=$res->data?></p>
