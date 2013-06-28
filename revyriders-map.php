<?php
/**
 * @package Revy Riders Map
 * @since   April 28, 2013
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/*
Plugin Name: Revy Riders Map
Plugin URI: https://derekmarcinyshyn.github.com/revy riders map
Description: A Google Map showcasing Revy Riders Dirt Bike Club trails and track in Revelstoke, BC.
Author: Derek Marcinyshyn
Author URI: http://derek.marcinyshyn.com
Version: 1.1
License: GPLv2

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Exit if called directly
defined( 'ABSPATH' ) or die( "Cannot access pages directly." );

// Plugin version
define( 'REVYRIDERSMAP_VERSION', '1.1');

// Plugin directory
define( 'REVYRIDERSMAP_DIRECTORY', dirname( plugin_basename( __FILE__ ) ) );

// Plugin URL directory
define( 'REVYRIDERSMAP_URL', WP_PLUGIN_URL . '/' . REVYRIDERSMAP_DIRECTORY );

// Updater
include_once( WP_PLUGIN_DIR . '/' . REVYRIDERSMAP_DIRECTORY . '/lib/updater/updater.php' );


/**
 * Class Revy_Riders_Map
 */
class Revy_Riders_Map {

	/**
	 * Main Plugin Function
	 */
	static function init() {
		add_shortcode( 'revyriders-map', array( __CLASS__, 'revyriders_map_display' ) );

		add_action( 'admin_init', array( __CLASS__, 'updater' ) );
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	static function revyriders_map_display( $atts ) {

		// load google maps api
		wp_register_script( 'googlemaps', 'https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather');
		wp_enqueue_script( 'googlemaps' );

		// load js
		wp_register_script( 'revyriders-map', REVYRIDERSMAP_URL . '/revyriders-map.js', array('jquery'), REVYRIDERSMAP_VERSION, true );
		wp_enqueue_script( 'revyriders-map' );

		$html = '<div id="map-canvas"></div>';
		$html .= '<style type="text/css">';
		$html .= '#map-canvas {height:800px;}';
		$html .= '#map-canvas img {max-width:none;}';
		$html .= '</style>';

		return $html;
	}

	/**
	 * Updater class checks GitHub repo
	 */
	static function updater() {
		if ( is_admin() ) {
			$config = array(
				'slug'									=> REVYRIDERSMAP_DIRECTORY . '/revyriders-map.php',
				'proper_folder_name'		=> 'revyriders-map',
				'api_url'								=> 'https://api.github.com/repos/DerekMarcinyshyn/revyriders-map',
				'raw_url'								=> 'https://raw.github.com/DerekMarcinyshyn/revyriders-map/master',
				'github_url'						=> 'https://github.com/DerekMarcinyshyn/revyriders-map',
				'zip_url'								=> 'https://github.com/DerekMarcinyshyn/revyriders-map/zipball/master',
				'sslverify'							=> false,
				'requires'							=> '3.0',
				'tested'								=> '3.6',
				'readme'								=> 'README.md',
				'access_token'					=> '',
			);

			new WP_RevyRiders_Map_Updater( $config );
		}
	}

}

Revy_Riders_Map::init();