<?php
if (!defined('ABSPATH')) { exit; }
use function Rizal\text;
use function Rizal\value;
use function Rizal\role;
use function Rizal\link;
use function Rizal\image;
use function Rizal\icon;
$projects = \Rizal\projects();
$contact = role('contact');
?>
<main id="main">
  <div class="hero-track">
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-photo"><?php image('rh_hero_image', 'hero', '', true); ?></div>
      <div class="hero-mist" aria-hidden="true"></div>
      <div class="container hero-content">
        <p class="section-label"><?php echo esc_html(text('rh_hero_label', 'STRUCTURAL ENGINEER')); ?></p>
        <h1 id="hero-title"><span class="hero-primary"><?php echo nl2br(esc_html(text('rh_hero_title'))); ?></span><span class="hero-secondary"><?php echo nl2br(esc_html(text('rh_hero_secondary'))); ?></span></h1>
        <p class="hero-description"><?php echo esc_html(text('rh_hero_description')); ?></p>
        <?php link($contact, text('rh_hero_cta')); ?>
      </div>
    </section>
  </div>
  <section id="profil" class="profile-section paper-section" aria-labelledby="profile-title">
    <div class="container profile-grid">
      <figure class="profile-photo" data-reveal><?php image('rh_profile_image', 'profile', text('rh_profile_alt')); ?></figure>
      <div class="profile-copy">
        <div data-reveal><p class="section-label"><?php echo esc_html(text('rh_profile_label', 'RIZAL MAULANA ENGINEERING')); ?></p><h2 id="profile-title"><?php echo esc_html(text('rh_profile_title')); ?></h2><p class="section-description"><?php echo esc_html(text('rh_profile_description')); ?></p><?php link(role('profile'), text('rh_profile_cta')); ?></div>
        <dl class="statistics">
          <?php for ($i = 1; $i <= 4; $i++): $number = value('rh_stat_' . $i . '_value', 0); $label = text('rh_stat_' . $i . '_label'); if ((int)$number <= 0 || $label === '') { continue; } ?>
          <div class="statistic" data-reveal><dd><span data-count="<?php echo esc_attr((string)$number); ?>"><?php echo esc_html((string)$number); ?></span><span><?php echo esc_html(text('rh_stat_' . $i . '_suffix')); ?></span></dd><dt><?php echo esc_html($label); ?></dt></div>
          <?php endfor; ?>
        </dl>
      </div>
    </div>
  </section>
  <?php if ($projects): ?>
  <section id="karya" class="projects-section" aria-label="Karya pilihan" data-project-slider>
    <div class="project-slides">
      <?php foreach ($projects as $index => $project): ?>
      <article class="project-slide" aria-label="<?php echo esc_attr(($index + 1) . ' dari ' . count($projects)); ?>">
        <div class="project-photo"><?php image('rp_cover', 'project', '', false, $project['id']); ?></div>
        <div class="container project-caption"><h2><?php echo esc_html($project['title']); ?></h2><p><?php echo esc_html($project['location']); ?></p><?php link($project['url'], text('rh_project_cta')); ?></div>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="container project-toolbar"><span class="section-label"><?php echo esc_html(text('rh_project_label', 'KARYA PILIHAN')); ?></span><div class="slider-controls" hidden><button type="button" data-project-prev aria-label="Karya sebelumnya"><?php echo icon('left'); ?></button><output data-project-status aria-live="polite">01 / <?php echo esc_html(str_pad((string)count($projects), 2, '0', STR_PAD_LEFT)); ?></output><button type="button" data-project-next aria-label="Karya berikutnya"><?php echo icon('right'); ?></button></div></div>
  </section>
  <?php endif; ?>
  <section id="pendekatan" class="approach-section paper-section" aria-labelledby="approach-title" data-approach>
    <div class="approach-pin container">
      <div class="approach-heading"><div><p class="section-label"><?php echo esc_html(text('rh_approach_label', 'SPIRIT KERJA')); ?></p><h2 id="approach-title"><?php echo esc_html(text('rh_approach_title')); ?></h2></div><p class="section-description"><?php echo esc_html(text('rh_approach_description')); ?></p></div>
      <div class="approach-items">
        <?php for ($i = 1; $i <= 4; $i++): ?>
        <article class="approach-item" id="approach-<?php echo $i; ?>"><span class="approach-number" aria-hidden="true"><?php echo '0' . $i; ?></span><h3><?php echo esc_html(text('rh_approach_' . $i . '_title')); ?></h3><p><?php echo esc_html(text('rh_approach_' . $i . '_body')); ?></p></article>
        <?php endfor; ?>
      </div>
      <div class="approach-pagination" hidden aria-label="Pilih spirit kerja"><?php for ($i = 1; $i <= 4; $i++): ?><button type="button" data-step="<?php echo $i - 1; ?>" aria-label="<?php echo esc_attr('0' . $i . ' ' . text('rh_approach_' . $i . '_title')); ?>" aria-pressed="<?php echo $i === 1 ? 'true' : 'false'; ?>"><?php echo '0' . $i; ?></button><?php endfor; ?></div>
    </div>
  </section>
  <section id="layanan" class="services-section paper-section" aria-labelledby="services-title">
    <div class="container services-grid">
      <div class="services-intro" data-reveal><p class="section-label"><?php echo esc_html(text('rh_services_label', 'RAGAM LAYANAN')); ?></p><h2 id="services-title"><?php echo esc_html(text('rh_services_title')); ?></h2><p class="section-description"><?php echo esc_html(text('rh_services_description')); ?></p><?php link(role('services'), text('rh_services_cta')); ?></div>
      <div class="service-cards"><?php for ($i = 1; $i <= 4; $i++): ?><article class="service-card" data-reveal><span class="service-number" aria-hidden="true"><?php echo '0' . $i; ?></span><h3><?php echo esc_html(text('rh_service_' . $i . '_title')); ?></h3><p><?php echo esc_html(text('rh_service_' . $i . '_body')); ?></p></article><?php endfor; ?></div>
    </div>
  </section>
  <section id="pengetahuan" class="knowledge-section paper-section" aria-label="Jurnal, tulisan, dan edukasi"><div class="container"><p class="section-label knowledge-label" data-reveal><?php echo esc_html(text('rh_knowledge_label', 'KARYA LAINNYA')); ?></p></div><div class="container knowledge-list">
    <?php foreach (['journal' => 'work', 'writing' => 'work', 'education' => 'education'] as $key => $target): ?>
    <article class="knowledge-row" data-reveal><h2><?php echo esc_html(text('rh_' . $key . '_title')); ?></h2><figure><?php image('rh_' . $key . '_image', ['journal' => 'hero', 'writing' => 'knowledge', 'education' => 'project'][$key]); ?></figure><div class="knowledge-copy"><p><?php echo esc_html(text('rh_' . $key . '_body')); ?></p><?php $custom = value('rh_' . $key . '_target', 0); $targetPost = $custom ? get_post((int)$custom) : null; $url = $targetPost && $targetPost->post_status === 'publish' && $targetPost->post_password === '' ? get_permalink($targetPost) : role($target); link($url, text('rh_' . $key . '_cta')); ?></div></article>
    <?php endforeach; ?>
  </div></section>
  <div class="closing-track">
    <section id="kolaborasi" class="collaboration-section" aria-labelledby="contact-title"><div class="collaboration-photo"><?php image('rh_contact_image', 'contact'); ?></div><div class="container collaboration-copy" data-reveal><div><h2 id="contact-title"><?php echo esc_html(text('rh_contact_title')); ?></h2><p><?php echo esc_html(text('rh_contact_description')); ?></p></div><?php link($contact, text('rh_contact_cta')); ?></div></section>
    <footer class="rizal-footer paper-section"><div class="container footer-top"><div><p class="footer-brand"><?php echo esc_html(text('rh_footer_brand')); ?></p><nav aria-label="Navigasi footer"><?php \Rizal\navigation(); ?></nav></div><div class="footer-right"><p><?php echo esc_html(text('rh_footer_tagline')); ?></p><ul class="social-links"><?php foreach (['linkedin' => 'LinkedIn', 'instagram' => 'Instagram', 'facebook' => 'Facebook', 'threads' => 'Threads'] as $key => $label): $url = text('rh_social_' . $key); if ($url !== ''): ?><li><a href="<?php echo esc_url($url, ['https', 'http']); ?>" rel="noopener noreferrer" target="_blank"><?php echo esc_html($label); ?></a></li><?php endif; endforeach; ?></ul></div></div><p class="footer-masthead" data-reveal><?php echo esc_html(text('rh_footer_name')); ?></p><div class="container footer-bottom"><a class="back-top pill" href="#main"><span>Kembali ke atas</span><span class="pill-icon"><?php echo icon('up'); ?></span></a><p><?php echo esc_html(text('rh_footer_copyright')); ?></p></div></footer>
  </div>
</main>
