<?php

/*
Plugin Name: NasaGallery
Description: Галерея с сайта NASA.
Plugin URI:  https://github.com/pahaa97/NASA_Gallery
Version: 1.0
Author: Pavel Fedotov
*/

require_once('settings/settings.php');
require_once('settings/shortcodes.php');
require_once('models/NASA.php');
require_once('models/Post.php');



register_activation_hook( __FILE__, 'nasagallery_install' );
register_deactivation_hook( __FILE__, 'nasagallery_deactivation');

add_action( 'init' , 'nasagallery_setup_post_types' );
add_action( 'my_everyday_event', 'get_everyday_post' );
add_action('wp_head', 'my_wp_head_css' );

add_shortcode( 'nasa_gallery' , 'nasa_gallery_func' );








