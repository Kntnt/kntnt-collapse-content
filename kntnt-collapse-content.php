<?php

/**
 * Plugin main file.
 * @wordpress-plugin
 * Plugin Name:       Kntnt Collapse Content
 * Plugin URI:        https://www.kntnt.com/
 * GitHub Plugin URI: https://github.com/Kntnt/kntnt-collapse-content
 * Description:       Adds shortcode that collapse content into an accordion.
 * Version:           1.0.1
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 */

namespace Kntnt\Collapse_Content;

defined( 'WPINC' ) && new Plugin;

class Plugin {

	private static $defaults = [
		'type' => 'single',
		'class' => null,
		'id' => null,
		'style' => null,
		'heading_style' => null,
		'content_style' => null,
	];


	private static $types = [
		'single',   // Accordion with single text visible
		'multiple', // Accordion with multiple texts visible
		'tabs',     // TODO: Horizontal tabs with single text visible
	];

	public function __construct() {
		add_shortcode( 'collapse', [ $this, 'collapse_content' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	public function collapse_content( $atts, $content, $tag ) {

		// Execute any shortcodes in the body of this shortcode.
		$content = do_shortcode( $content );

		// Workaround for the WordPress wpautop bug.
		$content = preg_replace( '`^\s*</p>|<p>\s*$|<p>[\s]*?</p>`', '', $content );

		// Import variables to be used in the template.
		extract( $this->shortcode_atts( self::$defaults, $atts ) );

		if ( in_array( $type, self::$types ) ) {

			// Split te content into pieces.
			list( $heading, $content ) = $this->partition_content( $content );

			// Count the number of pieces.
			$count = count( $content );

			// Add some classes.
			$class = "kntnt-collapse-content $type" . ( $class ? " $class" : '' );

			// Get the content.
			ob_start();
			include "includes/kntnt-collapse-content.php";
			$content = ob_get_clean();

		}

		return $content;

	}

	public function enqueue_assets() {
		wp_enqueue_style( 'kntnt-collapse-content.css', plugins_url( '/css/kntnt-collapse-content.css', __FILE__ ), [] );
		wp_enqueue_script( 'kntnt-collapse-content.js', plugins_url( '/js/kntnt-collapse-content.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	private function partition_content( $content ) {
		$content_array = [];
		preg_match_all( '/(<h3[^>]*>.*?<\/h3>)(.*?)(?:(?=<h3)|$)/s', $content, $content_array );
		return [ $content_array[1], $content_array[2] ];
	}

	// A more forgiving version of WP's shortcode_atts().
	private function shortcode_atts( $pairs, $atts, $shortcode = '' ) {

		$atts = (array) $atts;
		$out = [];
		$pos = 0;
		while ( $name = key( $pairs ) ) {
			$default = array_shift( $pairs );
			if ( array_key_exists( $name, $atts ) ) {
				$out[ $name ] = $atts[ $name ];
			}
			else if ( array_key_exists( $pos, $atts ) ) {
				$out[ $name ] = $atts[ $pos ];
				++ $pos;
			}
			else {
				$out[ $name ] = $default;
			}
		}

		if ( $shortcode ) {
			$out = apply_filters( "shortcode_atts_{$shortcode}", $out, $pairs, $atts, $shortcode );
		}

		return $out;

	}

}
