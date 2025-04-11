<?php

/**
 * Admin Cleanup for a cleaner client dashboard
 */

// Remove dashboard widgets
add_action('wp_dashboard_setup', function () {
  remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress News
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
});

// Remove admin bar items
add_action('admin_bar_menu', function ($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');         // WordPress logo
  $wp_admin_bar->remove_node('about');           // About WordPress
  $wp_admin_bar->remove_node('comments');        // Comments bubble
  $wp_admin_bar->remove_node('customize');       // Customize
  $wp_admin_bar->remove_node('updates');         // Update icon
  // Optional: remove 'Howdy, user'
  // $wp_admin_bar->remove_node('my-account');
}, 999);

// Remove unused menus for non-admins (like Editors, Authors)
add_action('admin_menu', function () {
  if (!current_user_can('manage_options')) {
    remove_menu_page('tools.php');
    remove_menu_page('edit-comments.php');
    remove_menu_page('themes.php');
    remove_menu_page('plugins.php');
    remove_menu_page('users.php');
    remove_menu_page('options-general.php');
    remove_menu_page('edit.php?post_type=acf-field-group'); // ACF
  }
}, 999);

// Rename "Posts" to "Blog"
add_action('admin_menu', function () {
  global $menu;
  global $submenu;

  $menu[5][0] = 'Blog';
  $submenu['edit.php'][5][0] = 'All Blog Posts';
  $submenu['edit.php'][10][0] = 'Add Blog Post';
});

// Remove welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

// Hide help and screen options
add_filter('screen_options_show_screen', '__return_false');
add_filter('contextual_help', '__return_false');

// Hide admin notices for non-admins
add_action('admin_head', function () {
  if (!current_user_can('manage_options')) {
    echo '<style>.update-nag, .notice, .error, .updated { display: none !important; }</style>';
  }
});



add_filter('acf/settings/show_admin', function () {
  return current_user_can('manage_options');
});
