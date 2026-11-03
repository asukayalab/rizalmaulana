<?php
namespace Rizal;
if (!defined('ABSPATH')) { exit; }

function value(string $key, mixed $fallback = '', ?int $id = null): mixed {
    $id ??= get_the_ID();
    return function_exists('FalconTheme\\field') ? \FalconTheme\field($id, $key, $fallback) : $fallback;
}
function text(string $key, string $fallback = '', ?int $id = null): string {
    $result = value($key, $fallback, $id);
    return is_string($result) ? trim($result) : $fallback;
}
function role(string $key): string {
    return function_exists('FalconTheme\\projectPageUrl') ? \FalconTheme\projectPageUrl('@@PROJECT_ID@@', $key) : '';
}
function icon(string $name = 'arrow'): string {
    $paths = ['arrow' => '<path d="M5 12h14m-6-6 6 6-6 6"/>', 'left' => '<path d="m14 6-6 6 6 6"/>', 'right' => '<path d="m10 6 6 6-6 6"/>', 'up' => '<path d="M12 19V5m-6 6 6-6 6 6"/>'];
    return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($paths[$name] ?? $paths['arrow']) . '</svg>';
}
function link(string $url, string $label, string $class = ''): void {
    if ($url === '' || $label === '') { return; }
    echo '<a class="pill ' . esc_attr($class) . '" href="' . esc_url($url) . '"><span>' . esc_html($label) . '</span><span class="pill-icon">' . icon() . '</span></a>';
}
function image(string $key, string $placeholder, string $alt = '', bool $priority = false, ?int $id = null): void {
    $attachment = (int) value($key, 0, $id);
    $attrs = ['class' => 'media-image', 'loading' => $priority ? 'eager' : 'lazy', 'decoding' => 'async', 'sizes' => '(max-width: 760px) 100vw, 80vw'];
    if ($priority) { $attrs['fetchpriority'] = 'high'; }
    if ($attachment > 0) {
        $markup = wp_get_attachment_image($attachment, 'full', false, $attrs);
        if ($markup) { echo $markup; return; }
    }
    // User-supplied design references only. Replace with Media Library attachments before launch.
    $base = get_stylesheet_directory_uri() . '/assets/images/' . $placeholder;
    echo '<img class="media-image reference-image" src="' . esc_url($base . '-1600.webp') . '"' . ($priority ? '' : ' srcset="' . esc_url($base . '-800.webp') . ' 800w, ' . esc_url($base . '-1600.webp') . ' 1600w" sizes="100vw"') . ' width="1672" height="941" alt="' . esc_attr($alt) . '" loading="' . ($priority ? 'eager' : 'lazy') . '" decoding="async"' . ($priority ? ' fetchpriority="high"' : '') . '>';
}
function navigation(): void {
    if (has_nav_menu('rizal_primary')) {
        wp_nav_menu(['theme_location' => 'rizal_primary', 'container' => false, 'depth' => 1, 'menu_class' => 'nav-list', 'fallback_cb' => false]);
        return;
    }
    $labels = ['home' => 'Beranda', 'profile' => 'Profil', 'services' => 'Layanan', 'work' => 'Karya', 'education' => 'Edukasi', 'contact' => 'Kontak'];
    echo '<ul class="nav-list">';
    foreach ($labels as $key => $label) {
        $url = role($key);
        if ($url !== '') { echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>'; }
    }
    echo '</ul>';
}
function projects(): array {
    $items = [];
    for ($i = 1; $i <= 5; $i++) {
        $id = (int) value('rh_project_' . $i, 0);
        $post = $id > 0 ? get_post($id) : null;
        if (!$post || $post->post_type !== 'fwf_rm_project' || $post->post_status !== 'publish' || $post->post_password !== '') { continue; }
        if (isset($items[$id])) { continue; }
        $items[$id] = ['id' => $id, 'title' => get_the_title($id), 'location' => text('rp_location', '', $id), 'url' => get_permalink($id)];
    }
    return array_values($items);
}
