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
Version: 1.0
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
define( 'REVYRIDERSMAP_VERSION', '1.0');

// Plugin directory
define( 'REVYRIDERSMAP_DIRECTORY', dirname( plugin_basename( __FILE__ ) ) );

// Plugin URL directory
define( 'REVYRIDERSMAP_URL', WP_PLUGIN_URL . '/' . REVYRIDERSMAP_DIRECTORY );


/**
 * Class Revy_Riders_Map
 */
class Revy_Riders_Map {

	/**
	 * @var
	 */
	static $add_revyriders_map;

	/**
	 * Main Plugin Function
	 */
	static function init() {
		add_shortcode( 'revyriders-map', array(__CLASS__, 'revyriders_map_display' ) );

		add_action( 'init', array( __CLASS__, 'register_script') );
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	static function revyriders_map_display( $atts ) {
		self::$add_revyriders_map = true;

		$html = '<div id="map-canvas"></div>';
		$html .= '<style type="text/css">';
		$html .= '#map-canvas {height:800px;}';
		$html .= '#map-canvas img {max-width:none;}';
		$html .= '</style>';

		return $html;
	}

	/**
	 * Register javascript
	 */
	static function register_script() {
		// load google maps api
		wp_register_script( 'googlemaps', 'https://maps.googleapis.com/maps/api/js?sensor=true');
		wp_enqueue_script( 'googlemaps');

		// load js
		wp_register_script( 'revyriders-map', REVYRIDERSMAP_URL . '/revyriders-map.js', array('jquery'), REVYRIDERSMAP_VERSION, true );
		wp_enqueue_script( 'revyriders-map');
	}
}

Revy_Riders_Map::init();