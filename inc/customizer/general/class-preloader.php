<?php
/**
 * Handles layout customization
 *
 * @package ulearn
 */

namespace ulearn\customizer\General;

use WP_Customize_Control;
use WP_Customize_Color_Control;

defined( 'ABSPATH' ) || exit;

/**
 * Layout class
 */
class Preloader {

	/**
	 * Register
	 *
	 * @param WP_Customize_Manager $wp_customize theme customizer object.
	 */
	public function register( $wp_customize ) {

		$wp_customize->add_section(
			'ms_lms_ulearn_preloader_section',
			array(
				'panel'       => 'ms_lms_ulearn_customizer_panel',
				'title'       => esc_html__( 'Preloader', 'ulearn' ),
				'description' => esc_html__( 'Preloader Settings', 'ulearn' ),
				'priority'    => 3,
			)
		);
		$wp_customize->add_setting(
			'ms_lms_ulearn_preloader_',
			array(
				'title'             => esc_html__( 'Enable Preloader', 'ulearn' ),
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ms_lms_ulearn_preloader_',
				array(
					'label'             => esc_html__( 'Enable Preloader', 'ulearn' ),
					'type'              => 'checkbox',
					'section'           => 'ms_lms_ulearn_preloader_section',
					'sanitize_callback' => 'ulearn_sanitize_checkbox',
				)
			)
		);
		// Add Settings
		$wp_customize->add_setting(
			'ulearn_loader_customizer_color_primary_',
			array(
				'default'           => '#04bfbf',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_setting(
			'ulearn_loader_customizer_color_secondary_',
			array(
				'default'           => '#45ace0',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add Controls
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ulearn_loader_customizer_color_primary_',
				array(
					'label'    => esc_html__( 'Preloader Outline Color', 'ulearn' ),
					'section'  => 'ms_lms_ulearn_preloader_section',
					'settings' => 'ulearn_loader_customizer_color_primary_',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ulearn_loader_customizer_color_secondary_',
				array(
					'label'    => esc_html__( 'Preloader Inline Color', 'ulearn' ),
					'section'  => 'ms_lms_ulearn_preloader_section',
					'settings' => 'ulearn_loader_customizer_color_secondary_',
				)
			)
		);

	}
}
