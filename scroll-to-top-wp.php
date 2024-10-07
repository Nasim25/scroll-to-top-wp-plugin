<?php
/**
*Plugin Name:       LL Scroll To Top WP
*Plugin URI:        https://wordpress.org/plugins/scroll-to-top-wp/
*Description:       Scroll to top plugin will help you to enable Back to Top button to your WordPress website.
*Version:           1.0.0
*Requires at least: 5.8
*Requires PHP:      7.4
*Author:            Luminous Labs BD
*Author URI:        https://luminouslabsbd.com
*License:           GPLv2 or later
*License URI:       https://www.gnu.org/licenses/gpl-2.0.html
*Text Domain:       llsttwp
*/

// include css
function llsttwp_enqueue_style(){
    wp_enqueue_style('llsttwp-style', plugins_url('css/llsttwp-style.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'llsttwp_enqueue_style');

// include javaScript
function llsttwp_enqueue_script(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('llsttwp-script', plugins_url('js/llsttwp-plugin.js', __FILE__),array(),'1.0.0',true);
}
add_action( 'wp_enqueue_scripts', 'llsttwp_enqueue_script');

function llsttwp_scroll_script(){
    ?>
        <script>
            jQuery(document).ready(function(){
                jQuery.scrollUp();
            });
        </script>
    <?php
}
add_action("wp_footer","llsttwp_scroll_script");

// Enqueue Color Picker script and styles
function llsttwp_enqueue_customizer_assets() {
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');
}
add_action('customize_controls_enqueue_scripts', 'llsttwp_enqueue_customizer_assets');

// Plugin Customization Sattings
add_action( "customize_register", "llsttwp_scroll_to_top" );
function llsttwp_scroll_to_top($wp_customize){
  $wp_customize-> add_section('llsttwp_scroll_top_section', array(
    'title' => __('Scroll To Top', 'llsttwp'),
    'description' => 'Simple Scroll to top plugin will help you to enable Back to Top button to your WordPress website.',
  ));

  // color change
  $wp_customize ->add_setting('llsttwp_default_color', array(
    'default' => '#000000',
  ));
  $wp_customize->add_control('llsttwp_default_color', array(
      'label'   => 'Background Color',
      'section' => 'llsttwp_scroll_top_section',
      'type'    => 'color',
  ));

  // Adding Rounded Corner
  $wp_customize ->add_setting('llsttwp_rounded_corner', array(
    'default' => '5px',
    'description' => 'If you need fully rounded or circular then use 25px here.',
  ));
  $wp_customize->add_control('llsttwp_rounded_corner', array(
      'label'   => 'Rounded Corner',
      'section' => 'llsttwp_scroll_top_section',
      'type'    => 'text',
  ));
}

function llsttwp_theme_color_cus(){
    ?>
        <style>
            #llsttwpscrollUp {
                background-color: <?php print get_theme_mod("llsttwp_default_color") ?>;
                border-radius: <?php print get_theme_mod('llsttwp_rounded_corner') ?>;
            }
        </style>
    <?php
}
add_action('wp_head','llsttwp_theme_color_cus');

?>