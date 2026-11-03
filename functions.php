<?php
if (!defined('ABSPATH')) { exit; }
require_once __DIR__ . '/inc/content.php';

add_action('after_setup_theme', static function (): void {
    register_nav_menus(['rizal_primary' => 'Navigasi utama Rizal']);
});

add_action('wp_enqueue_scripts', static function (): void {
    $version = wp_get_theme()->get('Version') . '-r2';
    $base = get_stylesheet_directory_uri();
    wp_enqueue_style('rizal-fonts', $base . '/assets/fonts.css', ['falcon-theme'], $version);
    wp_enqueue_style('rizal-tokens', $base . '/assets/tokens.css', ['rizal-fonts'], $version);
    wp_enqueue_style('rizal-base', $base . '/assets/base.css', ['rizal-tokens'], $version);
    if (is_page_template('page-maintenance.php')) {
        wp_enqueue_style('rizal-maintenance', $base . '/assets/maintenance.css', ['rizal-base'], $version);
        wp_enqueue_script('rizal-maintenance', $base . '/assets/maintenance.js', [], $version, true);
        return;
    }
    wp_enqueue_style('rizal-site', $base . '/assets/site.css', ['rizal-base'], $version);
    wp_enqueue_script('rizal-site', $base . '/assets/site.js', [], $version, true);
});

add_filter('wp_robots', static function (array $robots): array {
    if (is_page_template('page-maintenance.php')) {
        $robots['noindex'] = true;
        unset($robots['index']);
    }
    return $robots;
});
