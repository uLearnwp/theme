<?php
// Product Registration
define( 'STM_THEME_NAME', 'ulearn' );
define( 'STM_THEME_PATH', dirname( __FILE__ ) );
define( 'STM_INCLUDES_PATH', STM_THEME_PATH . '/inc' );
define( 'ULEARN_THEME_DIR', get_parent_theme_file_path() );
define( 'ULEARN_THEME_URI', get_parent_theme_file_uri() );
define( 'ULEARN_THEME_VERSION', ( WP_DEBUG ) ? time() : wp_get_theme()->get( 'Version' ) );

require_once STM_INCLUDES_PATH . '/custom-functions.php';
require_once STM_INCLUDES_PATH . '/enqueue.php';
require_once STM_INCLUDES_PATH . '/comments.php';
require_once STM_INCLUDES_PATH . '/theme-config.php';
require_once STM_INCLUDES_PATH . '/helpers.php';
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include dashboard.php
 */
require_once ULEARN_THEME_DIR . '/inc/class-init.php';
require_once ULEARN_THEME_DIR . '/inc/customizer/class-customizer.php';
require_once ULEARN_THEME_DIR . '/inc/customizer/general/class-colors.php';
require_once ULEARN_THEME_DIR . '/inc/customizer/general/class-preloader.php';
require_once ULEARN_THEME_DIR . '/inc/customizer/general/class-layout.php';

// Register services.
if ( class_exists( '\ulearn\Init' ) ) :
	ulearn\Init::register_services();
endif;

if ( get_theme_mod( 'ms_lms_ulearn_preloader_' ) ) {
	function ulearn_footer_preloader() {
		get_template_part( 'templates/modals/preloader' );
	}

	add_action( 'wp_head', 'ulearn_footer_preloader' );

}
function ulearn_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'ulearn_woocommerce_support' );

function ulearn_remove_shop_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

add_action( 'template_redirect', 'ulearn_remove_shop_breadcrumbs' );

add_action(
	'admin_init',
	function () {
		delete_transient( 'elementor_activation_redirect' );
	}
);
function ulearn_woocommerce_image_size_gallery_thumbnail( $size ) {
	return array(
		'width'  => 470,
		'height' => 470,
		'crop'   => 1,
	);
}

function ulearn_custom_logo_setup() {
	$defaults = array(
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true,
	);
	add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'ulearn_custom_logo_setup' );
add_filter( 'woocommerce_get_image_size_single', 'ulearn_woocommerce_image_size_gallery_thumbnail' );

/* Including plugins TGM */
require_once ULEARN_THEME_DIR . '/inc/tgmpa/theme-required-plugins.php';

/* Merlin Demo Import*/
require_once ULEARN_THEME_DIR . '/merlin/class-merlin.php';

require_once ULEARN_THEME_DIR . '/merlin/vendor/autoload.php';

require_once ULEARN_THEME_DIR . '/inc/merlin-config.php';
