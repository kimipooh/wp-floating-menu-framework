<?php
/*
Plugin Name: WP Floating Menu Framework 
Plugin URI: 
Description: The plugin is the framework for setting up the floating menu in WordPress.
Version: 1.0.0
Author: Kimiya Kitani
Author URI: https://profiles.wordpress.org/kimipooh/
*/

require_once(plugin_dir_path(__FILE__) . '/kimipooh_url_check.php');

$js_url = plugins_url() .'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))  . 'floating-menu.js';

// Stop the floating menu in Admin menu.
if (!is_admin() ):
	if(kimipooh_url_exists($js_url)):
		wp_enqueue_script('jquery');
		wp_enqueue_script('floating-menu',$js_url,array('jquery'));
	endif;
endif;
?>
