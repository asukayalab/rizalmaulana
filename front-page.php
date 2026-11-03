<?php
/** Honor the selected static Page template instead of the parent's coming-soon front page. */
if (!defined('ABSPATH')) { exit; }
if (is_home() && !is_page()) { require __DIR__ . '/index.php'; return; }
$template = get_page_template();
if ($template && is_file($template) && realpath($template) !== __FILE__) {
    include $template;
} else {
    require __DIR__ . '/page.php';
}
