<?php

/**
 *Plugin Name:       Page Scroll To Top WP
 *Plugin URI:        https://wordpress.org/plugins/scroll-to-top-wp/
 *Description:       Scroll to top plugin will help you to enable Back to Top button to your WordPress website.
 *Version:           1.0.0
 *Requires at least: 5.8
 *Requires PHP:      7.4
 *Author:            Md Nasim Uddin
 *Author URI:        https://exdesigners.shop
 *License:           GPLv2 or later
 *License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *Text Domain:       page-scroll-to-top-wp
 */

// Include CSS
function llsttwp_enqueue_style()
{
    if (!is_admin()) {
        wp_register_style('llsttwp-style', plugins_url('css/llsttwp-style.css', __FILE__), [], '1.0.0');
        wp_enqueue_style('llsttwp-style');
    }
}
add_action('wp_enqueue_scripts', 'llsttwp_enqueue_style');

// Include JavaScript
function llsttwp_enqueue_script()
{
    if (!is_admin()) {
        wp_register_script('llsttwp-script', plugins_url('js/llsttwp-plugin.js', __FILE__), ['jquery'], '1.0.0', true);
        wp_enqueue_script('llsttwp-script');
    }
}
add_action('wp_enqueue_scripts', 'llsttwp_enqueue_script');

function llsttwp_scroll_script()
{
?>
    <script>
        jQuery(document).ready(function() {
            jQuery.scrollUp();
        });
    </script>
<?php
}
add_action("wp_footer", "llsttwp_scroll_script");

// Enqueue Color Picker script and styles
function llsttwp_enqueue_customizer_assets()
{
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');
}
add_action('customize_controls_enqueue_scripts', 'llsttwp_enqueue_customizer_assets');

// Plugin Customization Settings
add_action("customize_register", "llsttwp_scroll_to_top");
function llsttwp_scroll_to_top($wp_customize)
{
    $wp_customize->add_section('llsttwp_scroll_top_section', [
        'title' => __('Scroll To Top', 'page-scroll-to-top-wp'),
        'description' => __('Simple Scroll to top plugin will help you to enable Back to Top button to your WordPress website.', 'page-scroll-to-top-wp'),
    ]);

    // Color change
    $wp_customize->add_setting('llsttwp_default_color', [
        'default' => '#000000',
    ]);
    $wp_customize->add_control('llsttwp_default_color', [
        'label'   => __('Background Color', 'page-scroll-to-top-wp'),
        'section' => 'llsttwp_scroll_top_section',
        'type'    => 'color',
    ]);

    // Adding Rounded Corner
    $wp_customize->add_setting('llsttwp_rounded_corner', [
        'default' => '5px',
        'description' => __('If you need fully rounded or circular then use 25px here.', 'page-scroll-to-top-wp'),
    ]);
    $wp_customize->add_control('llsttwp_rounded_corner', [
        'label'   => __('Rounded Corner', 'page-scroll-to-top-wp'),
        'section' => __('llsttwp_scroll_top_section', 'page-scroll-to-top-wp'),
        'type'    => 'text',
    ]);
}

function llsttwp_theme_color_cus()
{
?>
    <style>
        #llsttwpscrollUp {
            background-color: <?php echo esc_html(get_theme_mod("llsttwp_default_color")); ?>;
            border-radius: <?php echo esc_html(get_theme_mod('llsttwp_rounded_corner')); ?>;
        }
    </style>
<?php
}
add_action('wp_head', 'llsttwp_theme_color_cus');

?>