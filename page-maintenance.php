<?php
/** Template Name: Rizal Maintenance */
if (!defined('ABSPATH')) { exit; }
get_header('maintenance');
if (have_posts()) : the_post();
if (post_password_required()) :
    echo get_the_password_form();
else :
    $field = static function (string $key): string {
        $value = function_exists('FalconTheme\\field') ? \FalconTheme\field(get_the_ID(), $key, '') : '';
        return is_string($value) ? trim($value) : '';
    };
    $wa = $field('rm_whatsapp'); $ig = $field('rm_instagram'); $email = $field('rm_email');
    $hero_title = $field('rm_hero_title');
    if ($hero_title === '') { $hero_title = get_the_title(); }
?>
<main id="main" class="rm-page">
  <section class="rm-hero" aria-labelledby="rm-title">
    <div class="rm-decoration" aria-hidden="true"><i></i><i></i><i></i></div>
    <div class="rm-dots rm-dots-hero" aria-hidden="true"><i></i><i></i><i></i></div>
    <div class="rm-content">
      <div class="rm-rule"></div>
      <h1 id="rm-title"><span class="rm-brand-left"><?php echo esc_html($hero_title); ?></span><?php if ($field('rm_brand_suffix') !== ''): ?> <span class="rm-brand-right"><?php echo esc_html($field('rm_brand_suffix')); ?></span><?php endif; ?></h1>
      <?php if ($field('rm_tagline') !== ''): ?><p class="rm-tagline"><?php echo esc_html($field('rm_tagline')); ?></p><?php endif; ?>
      <ul class="rm-professions"><?php foreach (['rm_profession_1','rm_profession_2','rm_profession_3'] as $key): if ($field($key) !== ''): ?><li><?php echo esc_html($field($key)); ?></li><?php endif; endforeach; ?></ul>
      <div class="rm-actions"><div class="rm-wa"><?php if ($wa !== ''): ?><a class="rm-button" href="<?php echo esc_url($wa, ['https']); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a><?php endif; ?></div><?php if (is_email($email)): ?><div class="rm-email"><a class="rm-button" href="<?php echo esc_url('mailto:' . $email, ['mailto']); ?>">Email</a></div><?php endif; ?></div>
    </div>
    <a class="rm-scroll" href="#coming-soon" aria-label="Scroll to next section">↓</a>
  </section>
  <section id="coming-soon" class="rm-second">
    <div class="rm-dots rm-dots-second" aria-hidden="true"><i></i><i></i></div>
    <div class="rm-second-content">
      <?php if ($field('rm_line_1') !== ''): ?><p class="rm-line rm-line-1"><?php echo esc_html($field('rm_line_1')); ?></p><?php endif; ?>
      <?php if ($field('rm_line_2') !== ''): ?><p class="rm-line rm-line-2"><?php echo esc_html($field('rm_line_2')); ?></p><?php endif; ?>
      <?php if ($field('rm_launch') !== ''): ?><p class="rm-launch"><?php echo esc_html($field('rm_launch')); ?></p><?php endif; ?>
      <?php if ($ig !== ''): ?><div class="rm-instagram"><a class="rm-button" href="<?php echo esc_url($ig, ['https']); ?>" target="_blank" rel="noopener noreferrer">Visit my Instagram Profile</a></div><?php endif; ?>
    </div>
  </section>
  <footer class="rm-footer"><p><?php echo esc_html($field('rm_footer')); ?></p><p><?php echo esc_html($field('rm_domain')); ?></p></footer>
</main>
<?php endif; endif; get_footer('maintenance');
