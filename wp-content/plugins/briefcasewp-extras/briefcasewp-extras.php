<?php
/**
 * Plugin Name:			Briefcasewp Extras
 * Plugin URI:			http://briefcasewp.com/bew-extras
 * Description:			Extra features for Briefcase Elementor Widgets.
 * Version:				1.3.1
 * Author:				briefcaseWP
 * Author URI:			http://briefcasewp.com
 * Requires at least:	4.9.0
 * Tested up to:		5.4.2
 *
 * Text Domain: bew-extras
 * Domain Path: /languages/
 *
 * @package bew-extras
 * @category Core
 * @author Briefcasewp
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require 'includes/plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://briefcasewp.com/?udm_action=updateinfo&slug=briefcasewp-extras&muid=1',
	__FILE__,
	'briefcasewp-extras'
);

define( 'BEW_EXTRAS_VERSION', '1.3.1' );
define( 'BEW_EXTRAS_PREVIOUS_STABLE_VERSION', '1.3.0' );

define( 'BEW_EXTRAS__FILE__', __FILE__ );
define( 'BEW_EXTRAS_PLUGIN_BASE', plugin_basename( BEW_EXTRAS__FILE__ ) );
define( 'BEW_EXTRAS_PATH', plugin_dir_path( BEW_EXTRAS__FILE__ ) );
define( 'BEW_EXTRAS_MODULES_PATH', BEW_EXTRAS_PATH . 'modules/' );
define( 'BEW_EXTRAS_URL', plugins_url( '/', BEW_EXTRAS__FILE__ ) );
define( 'BEW_EXTRAS_ASSETS_URL', BEW_EXTRAS_URL . 'assets/' );
define( 'BEW_EXTRAS_MODULES_URL', BEW_EXTRAS_URL . 'modules/' );
define( 'BEW_EXTRAS_NAME', 'Briefcase Extras' );
define( 'BEW_EXTRAS_IMPORTER_ASSETS_URL', BEW_EXTRAS_URL . 'extensions/bew-extensions/assets/' );
/**
 * Load gettext translate for our text domain.
 *
 * @since 1.0.0
 *
 * @return void
 */
function bew_extras_load_plugin() {
	load_plugin_textdomain( 'bew-extras' );

	require( BEW_EXTRAS_PATH . 'plugin.php' );
}
add_action( 'plugins_loaded', 'bew_extras_load_plugin' );

if ( ! function_exists( 'bew_is_plugin_active' ) ) {
	
function bew_is_plugin_active() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
}
}
	
if ( ! function_exists( 'bew_is_elementor_installed' ) ) {

function bew_is_elementor_installed() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
}
}

/**
* A shorthand function to get an image uri from /assets/img/ directory.
*/
function bew_get_img_uri( $path ) {
	return BEW_EXTRAS_URL . 'extensions/bew-builder/assets/img/'. $path ;
}

/**
 * Get blog posts page URL.
 *
 * @return string The blog posts page URL.
 */
function bew_get_blog_posts_page_url() {

	// If front page is set to display a static page, get the URL of the posts page.
	if ( 'page' === get_option( 'show_on_front' ) ) {
		return get_permalink( get_option( 'page_for_posts' ) );
	}

	// The front page IS the posts page. Get its URL.
	return get_home_url();
}
