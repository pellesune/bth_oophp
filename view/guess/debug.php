<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><hr>
<pre>
SESSION
<?= VAR_DUMP($_SESSION) ?>
POST
<?= VAR_DUMP($_POST) ?>
GET
<?= VAR_DUMP($_GET) ?>
</pre>
</hr>
