<?php
/**
 * Textfilter controller.
 */
return [
    "routes" => [
        [
            "info" => "blog",
            "mount" => "blog",
            "handler" => "\Roju19\Blog\BlogController",
            // "handler" => "\Anax\Textfilter\MyTextFilterController",
        ],
    ]
];
