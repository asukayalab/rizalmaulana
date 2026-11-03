<?php
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<main id="main" class="generic-page container"><?php if (have_posts()): while (have_posts()): the_post(); ?><article><h1><?php the_title(); ?></h1><?php if (!post_password_required() && get_post_type() === 'fwf_rm_project'): ?><p><?php echo esc_html(\Rizal\text('rp_location')); ?></p><figure class="detail-photo"><?php \Rizal\image('rp_cover', 'project'); ?></figure><?php endif; ?><div class="entry-content"><?php the_content(); ?></div></article><?php endwhile; endif; ?></main>
<?php get_footer();
