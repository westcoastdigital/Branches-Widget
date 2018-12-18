<?php
/**
 * Plugin Name: Branches Contact Widget
 * Plugin URI: https://github.com.au/WestCoastDigital/Branches-Widget
 * Description: Add contact details as an accordion in widget areas
 * Version: 1.0
 * Author: Jon Mather
 * Author URI: https://github.com.au/WestCoastDigital/
 */

require_once 'includes/widget.php';
function wcd_branch_widgets_scripts() {
     
    wp_enqueue_script( 'branch_widget', plugins_url( 'includes/widget.js', __FILE__ ) );
    wp_enqueue_style( 'branch_widget',    plugins_url( 'includes/widget.css',    __FILE__ ) );
 
}
add_action('wp_enqueue_scripts', 'wcd_branch_widgets_scripts');