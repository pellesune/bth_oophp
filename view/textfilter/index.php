<?php
namespace Anax\View;

?>

<h1>Showing off BBCode</h1>

<h2>Source in bbcode controller</h2>
<pre><?= wordwrap(htmlentities($bbText)) ?></pre>

<h2>Filter BBCode applied, source</h2>
<pre><?= wordwrap(htmlentities($bbHTML)) ?></pre>

<h2>Filter BBCode applied, HTML</h2>
<?= nl2br($bbHTML) ?>


<h1>Showing off Clickable</h1>

<h2>Source in clickable controller</h2>
<pre><?= wordwrap(htmlentities($linkText)) ?></pre>

<h2>Source formatted as HTML</h2>
<?= $linkText ?>

<h2>Filter Clickable applied, source</h2>
<pre><?= wordwrap(htmlentities($linkHTML)) ?></pre>

<h2>Filter Clickable applied, HTML</h2>
<?= $linkHTML ?>


<h1>Showing off Markdown</h1>

<h2>Markdown source in controller</h2>
<pre><?= $markdownText ?></pre>

<h2>Text formatted as HTML source</h2>
<pre><?= htmlentities($markdownHTML) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $markdownHTML ?>


<h1>Showing off nl2br</h1>

<h2>nl2br source in controller</h2>
<p><?=$nl2brText?></p>

<h2>Text formatted as HTML source</h2>
<pre><?= wordwrap(htmlentities($nl2brHTML)) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $nl2brHTML ?>
