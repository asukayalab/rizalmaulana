<?php
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<main id="main" class="generic-page container"><?php if (have_posts()): while (have_posts()): the_post(); ?><article><h1><?php the_title(); ?></h1><div class="entry-content"><?php the_content(); ?></div></article><?php endwhile; endif; ?></main>
<?php get_footer();
