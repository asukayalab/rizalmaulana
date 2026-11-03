<?php if (!defined('ABSPATH')) { exit; } ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class('rizal-site'); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Langsung ke isi</a>
<header class="rizal-header" data-menu>
  <div class="header-bar"><span class="wordmark">RIZAL MAULANA</span><button class="menu-toggle" aria-expanded="false" aria-controls="site-navigation" aria-label="Buka menu" type="button"><span></span><span></span></button></div>
  <nav id="site-navigation" class="menu-panel" aria-label="Menu utama"><?php \Rizal\navigation(); ?></nav>
</header>
