<?php

/**
 * Performance and security optimizations
 */

// Disable WordPress emoji scripts
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Disable oEmbed
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

// Remove REST API links from head
remove_action('wp_head', 'rest_output_link_wp_head');


// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Disable dashicons for non-logged-in users
add_action('wp_enqueue_scripts', function () {
  if (!is_user_logged_in()) {
    wp_dequeue_style('dashicons');
  }
}, 100);

// Disable Gutenberg CSS on frontend
add_action('wp_enqueue_scripts', function () {
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style'); // If using WooCommerce
  wp_dequeue_style('global-styles');
}, 100);

// Disable jQuery Migrate
add_filter('wp_default_scripts', function ($scripts) {
  if (!is_admin() && isset($scripts->registered['jquery'])) {
    $scripts->registered['jquery']->deps = array_diff(
      $scripts->registered['jquery']->deps,
      ['jquery-migrate']
    );
  }
});

// Disable embeds script
add_action('init', function () {
  remove_action('wp_head', 'wp_embed_add_host_js');
  remove_action('wp_footer', 'wp_print_footer_scripts', 20);
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('template_redirect', 'rest_output_link_header', 11, 0);
  add_filter('embed_oembed_discover', '__return_false');
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
});

// Force SSL admin
if (!defined('FORCE_SSL_ADMIN')) {
  define('FORCE_SSL_ADMIN', true);
}

// Remove default image sizes to save space
add_filter('intermediate_image_sizes_advanced', function ($sizes) {
  unset($sizes['medium_large'], $sizes['1536x1536'], $sizes['2048x2048']);
  return $sizes;
});

// Remove DNS prefetch for external assets
remove_action('wp_head', 'wp_resource_hints', 2);

// Disable heartbeat API where not needed
add_action('init', function () {
  if (!is_admin()) {
    wp_deregister_script('heartbeat');
  }
}, 1);
