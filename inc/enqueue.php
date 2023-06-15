<?php
// phpcs:ignoreFile

if ( ! function_exists( 'ulearn_styles_and_scripts' ) && ! is_admin() ) {
	function ulearn_styles_and_scripts() {

		/*Styles*/
		wp_enqueue_style( 'ulearn-style', get_stylesheet_uri(), array(), ULEARN_THEME_VERSION );
		wp_enqueue_style( 'ulearn-base', ULEARN_THEME_URI . '/assets/css/style.css', array(), ULEARN_THEME_VERSION );
		wp_enqueue_style( 'google-fonts', ulearn_theme_fonts(), array(), ULEARN_THEME_VERSION );

		wp_add_inline_style( 'ulearn-style', ulearn_color_styles() );

		wp_register_style( 'ulearn-404', ULEARN_THEME_URI . '/assets/css/components/pages/404.css', array(), ULEARN_THEME_VERSION );
		wp_register_style( 'ulearn-navigation', ULEARN_THEME_URI . '/assets/css/components/header/navigation.css', array(), ULEARN_THEME_VERSION );
		wp_enqueue_script( 'ulearn-header', ULEARN_THEME_URI . '/assets/js/components/header/header.js', array( 'jquery' ), ULEARN_THEME_VERSION );
		wp_enqueue_style( 'ulearn-navigation' );
		wp_register_style( 'ulearn-single-post', ULEARN_THEME_URI . '/assets/css/components/post/single/single-post.css', array(), ULEARN_THEME_VERSION );
		wp_register_style( 'ulearn-posts-list', ULEARN_THEME_URI . '/assets/css/components/post/archive/posts-list.css', array(), ULEARN_THEME_VERSION );
		wp_register_style( 'ulearn-search-list', ULEARN_THEME_URI . '/assets/css/components/pages/search.css', array(), ULEARN_THEME_VERSION );
		wp_register_style( 'ulearn-comments', ULEARN_THEME_URI . '/assets/css/components/comments/comments.css', array(), ULEARN_THEME_VERSION );

		wp_enqueue_style( 'liner-icons', ULEARN_THEME_URI . '/assets/icons/linearicons/linear-icons.css', array(), ULEARN_THEME_VERSION );
		wp_enqueue_style( 'starter-icons', ULEARN_THEME_URI . '/assets/icons/starter-icons/style.css', array(), ULEARN_THEME_VERSION );

		if ( is_single() ) {
			wp_enqueue_style( 'ulearn-single-post' );
		}

		if ( ( is_archive() || is_author() || is_category() || is_tag() || is_home() ) && 'post' === get_post_type() ) {
			wp_enqueue_style( 'ulearn-posts-list' );
		}

		if ( is_search() ) {
			wp_enqueue_style( 'ulearn-search-list' );
		}

		if ( is_404() ) {
			wp_enqueue_style( 'ulearn-404' );
		}

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
			wp_enqueue_style( 'ulearn-comments' );
		}

	}
}

add_action( 'wp_enqueue_scripts', 'ulearn_styles_and_scripts' );

if ( ! function_exists( 'ulearn_move_jquery_into_footer' ) ) {
	function ulearn_move_jquery_into_footer( $wp_scripts ) {

		if ( is_admin() ) {
			return;
		}

		$wp_scripts->add_data( 'jquery', 'group', 1 );
		$wp_scripts->add_data( 'jquery-core', 'group', 1 );
		$wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
	}
}

add_action( 'wp_default_scripts', 'ulearn_move_jquery_into_footer' );
function ulearn_generate_theme_option_css() {

	$inline_preloader_color  = get_theme_mod( 'ulearn_loader_customizer_color_primary_' );
	$outline_color_preloader = get_theme_mod( 'ulearn_loader_customizer_color_secondary_' );

	if ( ! empty( $inline_preloader_color ) ) :
		?>
		<style type="text/css" id="ms_lms_ulearn-theme-option-css">
			.ulearn_loader {
				border-color: <?php echo esc_attr__( $outline_color_preloader ); ?> <?php echo esc_attr__( $outline_color_preloader ); ?> transparent transparent;
			}
			.ulearn_loader::before, .ulearn_loader::after {
				border-color: transparent transparent<?php echo esc_attr__( $inline_preloader_color ); ?> <?php echo esc_attr__( $inline_preloader_color ); ?>;
			}
		</style>
		<?php

	endif;
}

add_action( 'wp_head', 'ulearn_generate_theme_option_css' );
