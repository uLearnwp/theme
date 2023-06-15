<?php
/**
 * Handles stuff on Customizer
 *
 * @package ulearn Customizer
 */

namespace ulearn\customizer;

use ulearn\customizer\general\preloader;
use ulearn\customizer\general\colors;
use ulearn\customizer\general\layout;

defined( 'ABSPATH' ) || exit;

/**
 * Customizer class
 */
class Customizer {

	/**
	 * Register default hooks and actions for WordPress
	 */
	public function register() {
		add_action( 'customize_register', array( $this, 'initialize' ) );
	}

	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public function get_classes() {
		return array(
			Colors::class,
			Layout::class,
			Preloader::class,
		);
	}

	/**
	 * Initialize services
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function initialize( $wp_customize ) {
		foreach ( $this->get_classes() as $class ) {
			$service = new $class();
			if ( method_exists( $class, 'register' ) ) {
				$service->register( $wp_customize );
			}
		}

		$this->add_customizer_panel( $wp_customize );
	}

	/**
	 * Add customizer panel for Lms_ulearn
	 *
	 * @param WP_Customize_Manager $wp_customize theme customizer object.
	 */
	public function add_customizer_panel( $wp_customize ) {
		$wp_customize->remove_section( 'colors' );
		$wp_customize->add_panel(
			'ms_lms_ulearn_customizer_panel',
			array(
				'title'      => __( 'uLearn Options Panel', 'ulearn' ),
				'capability' => 'edit_theme_options',
				'priority'   => 5,
			)
		);
	}
}
