<?php
/*
Plugin Name: WP Floating Menu Framework 
Plugin URI: 
Description: The plugin is the framework for setting up the floating menu in WordPress.
Version: 1.0.0
Author: Kimiya Kitani
Author URI: https://profiles.wordpress.org/kimipooh/
*/

$wm = new wfmf();

class wfmf{
	var $js_url;
	var $js_filepath;
	var $js_file = 'floating-menu.js';
	var	$js_file_key = 'js_file';
	var $set_op = 'wp-floating-menu-framework_array';	// Save setting name in DB
	var $plugin_name = 'wp-floating-menu-framework';
	var $js_dir = 'js';	// JavaScript folder name
	var $lang_dir = 'lang';	// Language folder name
	var $settings;
	
	public function __construct(){
		$this->settings = get_option($this->set_op);
		// If JS file was selected on the setting menu, the file path needs to be overwritten.
		if(isset($settings[$js_file_key]) && is_file(plugins_url($settings[$this->js_file_key], __FILE__))):
			$this->js_file = $settings[$this->js_file_key];
		endif;

		$this->js_file_settings();
		$this->init_settings();
		register_activation_hook(__FILE__, array(&$this, 'installer'));
		// Add Setting to WordPress 'Settings' menu. 
		add_action('admin_menu', array(&$this, 'add_to_settings_menu'));
		add_action('plugins_loaded', array(&$this,'enable_language_translation'));

		$this->wfmf_done();
	}
	
	// Main Processing
	public function wfmf_done(){
		// Stop the floating menu in Admin menu.
		if (!is_admin() ):
			if(isset($this->settings[$this->js_file_key]) && !empty($this->settings[$this->js_file_key])):
				if(is_file($this->js_filepath)):
					wp_enqueue_script('jquery');
					wp_enqueue_script('floating-menu',$this->js_url,array('jquery'));
				endif;
			endif;
		endif;
	}

	public function js_file_settings(){
		if(isset($this->settings[$this->js_file_key]) && !empty($this->settings[$this->js_file_key]))
			$this->js_file = $this->settings[$this->js_file_key];
		$this->js_url = plugins_url('/' . $this->js_dir . '/' .  $this->js_file, __FILE__);
		$this->js_filepath = plugin_dir_path( __FILE__ ) . '/' . $this->js_dir . '/' .$this->js_file;
	}
	
	public function enable_language_translation(){
		load_plugin_textdomain($this->plugin_name, false, dirname( plugin_basename( __FILE__ ) ) . '/' . $this->lang_dir . '/');
	}
	public function init_settings(){
		$this->settings['version'] = 100;
		$this->settings['db_version'] = 100;
	}
	
	public function installer(){
		update_option($this->set_op , $this->settings);
	}

	function add_to_settings_menu(){
		add_options_page(__('WP Floating Menu Framework Settings', $this->plugin_name), __('Floating Menu Settings',$this->plugin_name), 'manage_options', __FILE__,array(&$this,'admin_settings_page'));
	}
	
	// Processing Setting menu for the plugin.
	function admin_settings_page(){
		$settings = get_option($this->set_op);
		$permission = false;
		// The user who can manage the WordPress option can only access the Setting menu of this plugin.
		if(current_user_can('manage_options')) $permission = true; 

		if(isset($_POST['selected_js_file'])):
			if(empty($_POST['selected_js_file'])):
				$settings[$this->js_file_key] = '';
			else:
				$js_file = esc_attr(strip_tags(html_entity_decode($_POST['selected_js_file']),ENT_QUOTES));
				$js_file_path = plugin_dir_path( __FILE__ ) . '/' . $this->js_dir . '/' .$js_file;
				if(is_file($js_file_path)):
					$settings[$this->js_file_key] = $js_file;
				endif;
			endif;
		endif;
		
		$scandir = scandir(plugin_dir_path( __FILE__ ) . '/' . $this->js_dir);
		$scandir = array_merge($scandir, scandir(plugin_dir_path( __FILE__ ) . '/' . $this->js_dir .  '/templates/'));
		$scan_dir_js_files = array();
		if($scandir):
			foreach($scandir as $fname):
				if(!strcmp('js', substr($fname, strrpos($fname, '.') + 1))):
					$scan_dir_js_files[] .= $fname;
				endif;
			endforeach;
		endif;
		
		update_option($this->set_op , $settings);
?>
<?php
  if(isset($_POST['selected_js_file'])):
?>
<div class="<?php print $this->plugin_name;?>_updated"><p><strong><?php _e('Updated', $this->plugin_name); ?></strong></p></div>
<?php
  endif;
?>
<div id="add_mime_media_admin_menu">
  <h2><?php _e('WP Floating Menu Framework Settings', $this->plugin_name); ?></h2>
  
  <form method="post" action="">
     <fieldset style="border:1px solid #777777; width: 750px; padding-left: 6px;">
		<legend><h3><?php _e('How to use it', $this->plugin_name); ?></h3></legend>
		<div style="overflow:scroll; height: 200px;">

		<p><?php _e('Please select JavaScript file from the setting menu "Floating Setting Menu" in the setting.,<br/><br/>If you want to customize the JS file, please copy the template file in js/templates folder to js folder and rename it.<br/>Then, please select JS file from the setting menu "Floating Setting Menu" in the setting.<br/>Then, fixed the JS file for your WordPress environment (name, page, adminbar values).<br/><br/>Please see readme.txt about the detail information.', $this->plugin_name); ?></p>
		</div>
	 </fieldset>
	 <br/><br/>
     <fieldset style="border:1px solid #777777; width: 750px; padding-left: 6px;">
		<legend><h3><?php _e('JavaScript File List', $this->plugin_name); ?></h3></legend>
		<div style="overflow:scroll; height: 500px;">

		<p><?php _e('Please select JavaScript file for enabling floating menu.', $this->plugin_name); ?></p>

		<table><tr><td>
<?php
		if(isset($scan_dir_js_files)):
			$empty_flag = "";
			if(empty($settings[$this->js_file_key])) $empty_flag = 'checked'; 

			print '<input type="radio" name="selected_js_file" value="" '.$empty_flag.'/>' . __('Disable', $this->plugin_name) . '</br/>' . "\n";
			foreach($scan_dir_js_files as $fname):
				print '<input type="radio" name="selected_js_file" value="' . $fname . '"';
				if(!strcmp($settings[$this->js_file_key], $fname)) print ' checked';
				print '/>' . __('Enable', $this->plugin_name) . ' "'. $fname . '"<br/>' . "\n";
			endforeach;
		endif;	
?>	
		<br/>
    	 <input type="submit" value="<?php _e('Save', $this->plugin_name);  ?>" />
  		</form>

		</div>
		 </td></tr>
		</table>
	    </div>
     </fieldset>

<?php 
	}


}
?>
