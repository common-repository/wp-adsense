<?php
/**
 * @package wp-adsense
 * @author Jeromy Stroh
 * @version 0.117
 */
/*
Plugin Name: wp-adsense
Plugin URI: http://www.gemaga.com/
Description: Fun for everyone.
Author: Jeromy Stroh
Version: 0.117
Author URI: http://www.gemaga.com/
*/

require_once(dirname (__FILE__) . "/admin.php");

class wpadsense {

function wpadsense()
{
add_action('admin_menu', array($this, 'plugin_menu_callback'));
add_action( 'admin_init', array($this, 'register_mysettings_callback'));
add_filter('the_content', array($this, 'the_content_callback')); 
add_action('wp_footer', array($this, 'wp_footer_callback'));
}

function activate()
{
if(!isset($GLOBALS["wpa_instance"]))
{
$GLOBALS["wpa_instance"] = new wpadsense();
}
}

/*
Callbacks
*/
function the_content_callback($the_content)
{
if(is_single())
{

$under_percent = get_option('adsense_under_post_code_frequency');
if(is_numeric($under_percent))
{
if($under_percent > rand(0,100))
{
$the_content = $the_content.get_option('adsense_under_post_code');
}
}

$above_percent = get_option('adsense_above_post_code_frequency');
if(is_numeric($above_percent))
{
if($above_percent > rand(0,100))
{
$the_content = get_option('adsense_above_post_code').$the_content;
}
}

return $the_content;
}
else
return $the_content;
}

function wp_footer_callback()
{
echo get_option('adsense_below_page_code');
}

/*
Admin Callbacks
*/
function plugin_menu_callback() {
  add_options_page('wp-adsense Options', 'wp-adsense', 8, 'wpadsensealldaylong', array($this, 'plugin_options_callback'));
}

function register_mysettings_callback() {

register_setting( 'wpag', 'adsense_under_post_code' );
register_setting( 'wpag', 'adsense_under_post_code_frequency' );

register_setting( 'wpag', 'adsense_above_post_code' );
register_setting( 'wpag', 'adsense_above_post_code_frequency' );

register_setting( 'wpag', 'adsense_below_page_code' );
register_setting( 'wpag', 'adsense_below_page_code_frequency' );
}

function plugin_options_callback() {
?>

<div class="wrap">
<h2>wp-adsense settings</h2>
<script type="text/javascript">
function toggle(id) {
var e = document.getElementById(id);
if(e.style.display == 'none')
e.style.display = 'block';
else
e.style.display = 'none';
}
</script>

<?

print_editcode("Under Post","adsense_under_post");
print_editcode("Above Post","adsense_above_post");

print_editcode("Footer","adsense_below_page");
?>
</div>

<?
}

}

/*
Do it.
*/
wpadsense::activate();

?>