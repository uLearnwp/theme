<?php
/**
 * Handles layout customization
 *
 * @package Lms_ulearn
 */

namespace ulearn\customizer\General;

use WP_Customize_Control;

defined( 'ABSPATH' ) || exit;

/**
 * Layout class
 */
class Layout {

	/**
	 * Register
	 *
	 * @param WP_Customize_Manager $wp_customize theme customizer object.
	 */
	public function register( $wp_customize ) {

		$wp_customize->add_section(
			'ms_lms_ulearn_layout_section',
			array(
				'panel'       => 'ms_lms_ulearn_customizer_panel',
				'title'       => esc_html__( 'Layout', 'ulearn' ),
				'description' => esc_html__( 'Layout Settings', 'ulearn' ),
				'priority'    => 0,
			)
		);
		$wp_customize->add_setting(
			'ms_lms_ulearn_content_width_value',
			array(
				'title'             => esc_html__( 'Content Width (px)', 'ulearn' ),
				'transport'         => 'postMessage',
				'default'           => 1140,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ms_lms_ulearn_content_width_value',
				array(
					'label'   => esc_html__( 'Content Width (px)', 'ulearn' ),
					'type'    => 'number',
					'section' => 'ms_lms_ulearn_layout_section',
				)
			)
		);
	}
}
