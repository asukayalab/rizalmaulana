<?php
/** Template Name: Rizal Beranda */
if (!defined('ABSPATH')) { exit; }
get_header();
if (have_posts()) : the_post();
if (post_password_required()) : ?>
<main id="main" class="generic-page container"><?php echo get_the_password_form(); ?></main>
<?php else : get_template_part('template-parts/home'); endif; endif;
get_footer();
