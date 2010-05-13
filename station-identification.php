<?php
/*
Plugin Name: Station Identification
Author: Phil Nelson
Author URI: http://extrafuture.com/
Version: 2.0
Description: Adds a notice to the bottom of feed items, indicating the author's copyright and pointing to the original URL of the post. 
Plugin URI: http://extrafuture.com/projects/station-identification

*/

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

add_option("station_identification_version", "1.0");
add_option("station_identification_message", "\"%%post_title%%\" was originally posted by %%author%% on %%blog_name%%. All rights are reserved by the author.");
add_option("station_identification_registered", "no");
add_option("station_identification_registered_on", "0");
add_option("extra_future_site_id",md5(get_bloginfo('url')));

function station_identification_print_message( $content ) 
{
	$message = get_option('station_identification_message');
	
	$message = str_ireplace('%%post_title%%',"<a href=\"".get_permalink()."\" title=\"".the_title('','',false)."\">".the_title('','',false)."</a>",$message);
	
	$message = str_ireplace('%%author%%',get_the_author(),$message);
	
	$message = str_ireplace('%%blog_name%%',"<a href=\"".get_bloginfo('url')."\" title=\"".get_bloginfo('name')."\">".get_bloginfo('name')."</a>",$message);
	
	if( is_feed() ) 
	{
		return $content . "<hr style=\"border:0; border-bottom: 1px dotted #333;\" /><p>".$message."</p>";
	}
	else
	{
		return $content;
	}
}

// Thanks to http://wpengineer.com/how-to-improve-wordpress-plugins/ for instructions on adding the Settings link

function station_identification_plugin_actions($links, $file)
{
	static $this_plugin;
 
	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);
 
	if( $file == $this_plugin )
	{
		$settings_link = '<a href="index.php?page=station-identification/station-identification-options.php">' . __('Settings') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}

function station_identification_admin_panel()
{
	add_options_page('Station Identification Options', 'Station Identification', 8, 'station-identification/station-identification-options.php', 'station_identification_settings');
	if ( current_user_can('edit_posts') && function_exists('add_submenu_page') ) {
		add_filter( 'plugin_action_links', 'station_identification_plugin_actions', 10, 2 );
	}
}

function station_identification_settings()
{
	require_once('station-identification-options.php');
}

function station_identification_register()
{
	update_option('station_identification_registered', "yes");
	update_option('station_identification_registered_on', time());
}

add_filter('the_content', 'station_identification_print_message');

if(is_admin()) 
{
	add_action('admin_menu', 'station_identification_admin_panel');
}

?>