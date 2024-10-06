<?php
/**
*Plugin Name:       Scroll To Top WP
*Plugin URI:        https://wordpress.org/plugins/scroll-to-top-wp/
*Description:       Scroll to top plugin will help you to enable Back to Top button to your WordPress website.
*Version:           1.0.0
*Requires at least: 5.8
*Requires PHP:      7.4
*Author:            Luminous Labs BD
*Author URI:        https://luminouslabsbd.com
*Update URI:        https://github.com/Nasim25/scroll-to-top-wp-plugin
*License:           GPLv2 or later
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

function llsttwp_scroll_script(){?>
    <script>
        jQuery(document).ready(function(){
            jQuery.scrollUp();
        });
    </script>
    <?php
}
add_action("wp_footer","llsttwp_scroll_script")
?>