<?php
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<main id="main" class="generic-page container"><?php if (have_posts()): while (have_posts()): the_post(); ?><article><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php the_excerpt(); ?></article><?php endwhile; the_posts_pagination(); else: ?><h1>Halaman belum tersedia</h1><a class="pill" href="<?php echo esc_url(home_url('/')); ?>">Kembali ke beranda</a><?php endif; ?></main>
<?php get_footer();
