<?php

/** 
 * Plugin Name:       All-maintenance-mode
 * Plugin URI:        https://github.com/Oluwaseyieniola
 * Description:       A simple plugin to enable maintenance mode with an IP whitelist.
 * Version:           1.1
 * Requires PHP:      7.2
 * Author:            Oluwaseyi
 * Author URI:        https://github.com/Oluwaseyieniola
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       all-maintenance-mode
 * Domain Path:       /languages
 * Requires Plugins:  False
 */




// Prevent direct access to the file
if (!defined('WPINC')) {
    die;
}



// Prevent direct access to the file
if (!defined('WPINC')) {
    die;
}

// Function to display maintenance mode message
function wabi_maintenance_mode_display() {
    wp_die(
        '<h1>Under Maintenance</h1><p>Our website is currently undergoing scheduled maintenance. Please check back soon.</p>',
        'Maintenance Mode',
        array('response' => 503)
    );
}

// Function to get the user's IP address
function all_maintenance_mode_get_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Function to check if the user's IP is whitelisted
function is_ip_whitelisted($whitelist) {
    $user_ip = all_maintenance_mode_get_ip();
    $whitelisted_ips = array_map('trim', explode(',', $whitelist));
    return in_array($user_ip, $whitelisted_ips);
}

// Hook to check and apply maintenance mode
function apply_wabi_maintenance_mode() {
    $is_enabled = get_option('all_maintenance_mode_enabled', false);
    $ip_whitelist = get_option('all_maintenance_mode_ip_whitelist', '');

    if ($is_enabled && !current_user_can('administrator') && !is_user_logged_in() && !is_ip_whitelisted($ip_whitelist)) {
        wabi_maintenance_mode_display();
    }
}
add_action('template_redirect', 'apply_all_maintenance_mode');

// Function to add the settings link on the plugins page
function wabi_maintenance_mode_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=all-maintenance-mode">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'all_maintenance_mode_settings_link');

// Function to add a menu item for the plugin settings
function wabi_maintenance_mode_menu() {
    add_options_page(
        'all Maintenance Mode Settings',
        'all Maintenance Mode',
        'manage_options',
        'all-maintenance-mode',
        'all_maintenance_mode_settings_page'
    );
}
add_action('admin_menu', 'all_maintenance_mode_menu');

// Function to render the settings page
function all_maintenance_mode_settings_page() {
    ?>
    <div class="wrap">
        <h1>all Maintenance Mode Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('all_maintenance_mode_settings_group');
            do_settings_sections('all-maintenance-mode');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Function to initialize the plugin settings
function wabi_maintenance_mode_settings_init() {
    register_setting('all_maintenance_mode_settings_group', 'all_maintenance_mode_enabled');
    register_setting('all_maintenance_mode_settings_group', 'all_maintenance_mode_ip_whitelist');

    add_settings_section(
        'all_maintenance_mode_settings_section',
        'Maintenance Mode Settings',
        'all_maintenance_mode_settings_section_callback',
        'all-maintenance-mode'
    );

    add_settings_field(
        'all_maintenance_mode_enabled_field',
        'Enable Maintenance Mode',
        'all_maintenance_mode_enabled_field_callback',
        'all-maintenance-mode',
        'all_maintenance_mode_settings_section'
    );

    add_settings_field(
        'all_maintenance_mode_ip_whitelist_field',
        'IP Whitelist',
        'all_maintenance_mode_ip_whitelist_field_callback',
        'all-maintenance-mode',
        'all_maintenance_mode_settings_section'
    );
}
add_action('admin_init', 'all_maintenance_mode_settings_init');

// Callback to display the settings section content
function all_maintenance_mode_settings_section_callback() {
    echo '<p>Use this section to enable or disable maintenance mode and set IP whitelist.</p>';
}

// Callback to display the enable/disable maintenance mode field
function all_maintenance_mode_enabled_field_callback() {
    $enabled = get_option('all_maintenance_mode_enabled', false);
    $checked = $enabled ? 'checked' : '';
    echo '<input type="checkbox" id="all_maintenance_mode_enabled" name="all_maintenance_mode_enabled" value="1" ' . $checked . '>';
}

// Callback to display the IP whitelist field
function all_maintenance_mode_ip_whitelist_field_callback() {
    $ip_whitelist = get_option('all_maintenance_mode_ip_whitelist', '');
    echo '<textarea id="all_maintenance_mode_ip_whitelist" name="all_maintenance_mode_ip_whitelist" rows="5" cols="50">' . esc_textarea($ip_whitelist) . '</textarea>';
    echo '<p class="description">Enter IP addresses separated by commas. These IPs will bypass maintenance mode.</p>';
}



  