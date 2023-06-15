<?php
// phpcs:ignoreFile

if ( ! function_exists( 'ulearn_sanitize_checkbox' ) ) {
	function ulearn_sanitize_checkbox( $input ) {
		//returns true if checkbox is checked
		return ( isset( $input ) ? true : false );
	}
}
/**
 * Register Menu for Header
 */
function ulearn_menu_import() {

	$locations = get_theme_mod( 'nav_menu_locations' );
	$menus     = wp_get_nav_menus();

	if ( ! empty( $menus ) ) {
		foreach ( $menus as $menu ) {
			$menu_names = array(
				'uLearn Theme Main Menu',
			);

			if ( is_object( $menu ) && in_array( $menu->name, $menu_names ) ) {
				$locations['ulearn-theme-main-menu'] = $menu->term_id;
			}
		}
	}
	set_theme_mod( 'nav_menu_locations', $locations );

}

add_action( 'ulearn_merlin_after_all_import', 'ulearn_menu_import' );

/**
 * Generating Pages for Theme Options
 */
function ulearn_generate_lms_pages() {

	global $wp_filesystem;

	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}

	$args  = array(
		'post_type'   => 'page',
		'post_status' => 'publish'
	);
	$pages = get_pages( $args );

	$mods           = STM_INCLUDES_PATH . '/sample_data/options.json';
	$encode_options = $wp_filesystem->get_contents( $mods );
	$import_options = json_decode( $encode_options, true );
	update_option( 'stm_lms_settings', $import_options );

	$options = get_option( 'stm_lms_settings', array() );


	foreach ( $pages as $page ) {
		if ( $page->post_name == 'user-account' ) {
			$options['user_url'] = ( $page->ID );
		}

		if ( $page->post_name == 'user-public-account' ) {
			$options['user_url_profile'] = ( $page->ID );
		}

		if ( $page->post_name == 'courses' ) {
			$options['courses_page'] = ( $page->ID );
		}

		if ( $page->post_name == 'wishlist' ) {
			$options['wishlist_url'] = ( $page->ID );
		}

		if ( $page->post_name == 'checkout' ) {
			$options['checkout_url'] = ( $page->ID );
		}
	}

	update_option( 'stm_lms_settings', $options );

	$settings = get_option( 'stm_lms_settings', array() );
	$id       = 'stm_lms_settings';

	$response = array(
		'reload'  => false,
		'updated' => false,
	);

	$response['reload'] = apply_filters( 'wpcfto_reload_after_save', $id, $settings );

	do_action( 'wpcfto_settings_saved', $id, $settings );

	$response['updated'] = update_option( $id, $settings );

	do_action( 'wpcfto_after_settings_saved', $id, $settings );
}

if ( empty( get_option( 'stm_lms_settings' ) ) ) {
	add_action( 'ulearn_merlin_after_all_import', 'ulearn_generate_lms_pages' );
}

function elementor_set_default_settings_ulearn() {
	//Elementor Settings
	$active_kit = intval( get_option( 'elementor_active_kit', 0 ) );
	$meta       = get_post_meta( $active_kit, '_elementor_page_settings', true );

	if ( ! empty( $active_kit ) ) {
		$meta                    = ( ! empty( $meta ) ) ? $meta : array();
		$meta['container_width'] = array(
			'size'  => '1230',
			'unit'  => 'px',
			'sizes' => array(),
		);
		update_post_meta( $active_kit, '_elementor_page_settings', $meta );

		if ( class_exists( 'Elementor\Core\Responsive\Responsive' ) ) {
			Elementor\Core\Responsive\Responsive::compile_stylesheet_templates();
		}
	}

	$elementor_cpt_support = array(
		'post',
		'page',
		'stm_courses',
	);
	update_option( 'elementor_cpt_support', $elementor_cpt_support );

	// AddToAny Share Buttons
	$new_options       = array(
		'icon_size'                         => 20,
		'display_in_posts_on_front_page'    => '-1',
		'display_in_posts_on_archive_pages' => '-1',
		'display_in_excerpts'               => '-1',
		'display_in_posts'                  => '-1',
		'display_in_pages'                  => '-1',
		'display_in_attachments'            => '-1',
		'display_in_feed'                   => '-1',
	);
	$custom_post_types = array_values(
		get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			),
			'objects'
		)
	);
	foreach ( $custom_post_types as $custom_post_type_obj ) {
		$placement_name                                     = $custom_post_type_obj->name;
		$new_options[ 'display_in_cpt_' . $placement_name ] = '-1';
	}

	update_option( 'addtoany_options', $new_options );

	if ( class_exists( 'Elementor\Core\Responsive\Responsive' ) ) {
		Elementor\Core\Responsive\Responsive::compile_stylesheet_templates();
	}
}

add_action( 'ulearn_merlin_after_all_import', 'elementor_set_default_settings_ulearn' );

add_action( 'wp_enqueue_scripts', 'ulearn_icons_script_styles' );
function ulearn_icons_script_styles() {
	wp_enqueue_style( 'liner-icons', ULEARN_THEME_URI . '/assets/icons/linearicons/linear-icons.css', array(), ULEARN_THEME_VERSION );
	wp_enqueue_style( 'starter-icons', ULEARN_THEME_URI . '/assets/icons/starter-icons/style.css', array(), ULEARN_THEME_VERSION );

}

add_action( 'admin_enqueue_scripts', 'ulearn_admin_script_styles' );
function ulearn_admin_script_styles() {
	wp_enqueue_style( 'admin_ulearn_style', ULEARN_THEME_URI . '/assets/admin/admin_styles.css', '', ULEARN_THEME_VERSION );
}


add_action( 'admin_menu', 'ulearn_show_nav_item' );
function ulearn_show_nav_item() {

	add_menu_page(
		esc_html__( 'Welcome to uLearn Page', 'ulearn' ),
		esc_html__( 'uLearn', 'ulearn' ),
		'manage_options',
		'ulearn-options',
		'ulearn_admin_page_content',
		ULEARN_THEME_URI . '/assets/images/dash_global.svg',
		'2'
	);
}

function ulearn_admin_page_content() {
	?>
	<div class="ulearn-row">
		<div class="ulearn-column has-content">
			<img src="<?php echo esc_url( ULEARN_THEME_URI . '/assets/images/base/ulearn-left.png' ); ?>" alt="">
			<div class="content">
				<div class="logo">
					<img src="<?php echo esc_url( ULEARN_THEME_URI . '/assets/images/dark-logo.svg' ); ?>" alt="">
				</div>
				<div class="text">
					uLearn is a starter theme from MasterStudy LMS plugin provides a complete and ready-made site template for eLearning and online education websites. The theme is fully responsive with a cutting-edge design that can be customized according to the user's requirements.
				</div>
				<div class="actions">
					<a href="#" target="_blank" class="documentation ulearn-wpcfto-documentation ulearn-btn">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
							<!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
							<path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z"/>
						</svg>
						Documentation
					</a>
					<a href="<?php echo admin_url() . esc_url( 'admin.php?page=ulearn_demo_installer' ); ?>" target="_blank" class="changelog ulearn-transients ulearn-btn">
						Demo Import
						<svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 499.93"><path fill-rule="nonzero" d="M114.51 278.73c-4.37-4.2-4.55-11.2-.38-15.62a10.862 10.862 0 0 1 15.46-.39l115.34 111.34V11.07C244.93 4.95 249.88 0 256 0c6.11 0 11.06 4.95 11.06 11.07v362.42L378.1 262.85c4.3-4.27 11.23-4.21 15.46.13 4.23 4.35 4.17 11.35-.13 15.62L264.71 406.85a11.015 11.015 0 0 1-8.71 4.25c-3.45 0-6.52-1.57-8.56-4.04L114.51 278.73zm375.35 110.71c0-6.11 4.96-11.07 11.07-11.07S512 383.33 512 389.44v99.42c0 6.12-4.96 11.07-11.07 11.07H11.07C4.95 499.93 0 494.98 0 488.86v-99.42c0-6.11 4.95-11.07 11.07-11.07 6.11 0 11.07 4.96 11.07 11.07v88.36h467.72v-88.36z"/></svg>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php
}
