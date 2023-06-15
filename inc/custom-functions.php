<?php
/**
 * Content width
 */
if ( ! isset( $ulearn_content_width ) ) {
	$ulearn_content_width = 900;
}

/**
 * Setup settings
 */
if ( ! function_exists( 'ulearn_setup' ) ) {
	function ulearn_setup() {
		load_theme_textdomain( 'ulearn', get_template_directory() . '/languages' );
		add_theme_support( 'widgets' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		register_nav_menus(
			array(
				'ulearn-theme-main-menu' => esc_html__( 'Header menu', 'ulearn' ),
			)
		);
	}
}

add_action( 'after_setup_theme', 'ulearn_setup' );

/**
 * Add ping back url
 */
function ulearn_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'ulearn_pingback_header' );

/**
 * Custom excerpt size
 */
function ulearn_minimize_word( $word, $length = '40', $affix = '...' ) {
	if ( ! empty( intval( $length ) ) ) {
		$word_length = mb_strlen( $word );
		if ( $word_length > $length ) {
			$word = mb_strimwidth( $word, 0, $length, $affix );
		}
	}

	return sanitize_text_field( $word );
}

function ulearn_get_option( $option_name, $default = false ) {
	$options = ulearn_stored_theme_options();
	$option  = null;

	if ( ! empty( $options[ $option_name ] ) ) {
		$option = $options[ $option_name ];
	} elseif ( isset( $default ) ) {
		$option = $default;
	}

	return $option;
}

function ulearn_read_more_link() {
	if ( ! is_admin() ) {
		return '<a href="' . esc_url( get_permalink() ) . '" class="more-link"><span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span></a>';
	}
}

add_filter( 'excerpt_more', 'ulearn_read_more_link' );

function ulearn_admin_bar_css() {
	?>
	<style type="text/css" media="screen">
		body {
			margin-top: 32px !important;
		}

		@media screen and (max-width: 782px) {
			body {
				margin-top: 46px !important;
			}
		}
	</style>
	<?php
}

add_theme_support( 'admin-bar', array( 'callback' => 'ulearn_admin_bar_css' ) );

function ulearn_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary sidebar', 'ulearn' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'ulearn' ),
			'before_widget' => '<section id="%1$s" class="widget widget-container %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'ulearn_widgets_init' );

/**
 * Custom Pagination
 */
if ( ! function_exists( 'ulearn_posts_pages_pagination' ) ) :
	function ulearn_posts_pages_pagination( $paging_extra_class = '', $current_query = '' ) {
		global $wp_query, $wp_rewrite;

		if ( ! $current_query ) {
			$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pages = $wp_query->max_num_pages;
		} else {
			$paged = $current_query->query_vars['paged'];
			$pages = $current_query->max_num_pages;
		}

		if ( $pages < 2 ) {
			return;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = remove_query_arg( array_keys( $query_args ), $page_num_link );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		$links = paginate_links(
			array(
				'base'      => $page_num_link,
				'format'    => $format,
				'total'     => $pages,
				'current'   => $paged,
				'mid_size'  => 1,
				'add_args'  => array_map( 'urlencode', $query_args ),
				'prev_text' => __( 'Prev', 'ulearn' ),
				'next_text' => __( 'Next', 'ulearn' ),
				'type'      => 'list',
			)
		);

		if ( $links ) {
			echo wp_kses_post( $links );
		}
	}
endif;

add_filter( 'body_class', 'ulearn_body_classes' );
function ulearn_body_classes( $classes ) {
	$classes[] = 'ulearn-theme';

	return $classes;
}

/**
 * Custom Pagination
 */
if ( ! function_exists( 'ulearn_posts_pages_pagination' ) ) :
	function ulearn_posts_pages_pagination( $paging_extra_class = '', $current_query = '' ) {
		global $wp_query, $wp_rewrite;

		if ( ! $current_query ) {
			$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pages = $wp_query->max_num_pages;
		} else {
			$paged = $current_query->query_vars['paged'];
			$pages = $current_query->max_num_pages;
		}

		if ( $pages < 2 ) {
			return;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = remove_query_arg( array_keys( $query_args ), $page_num_link );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		$links = paginate_links(
			array(
				'base'      => $page_num_link,
				'format'    => $format,
				'total'     => $pages,
				'current'   => $paged,
				'mid_size'  => 1,
				'add_args'  => array_map( 'urlencode', $query_args ),
				'prev_text' => '<i aria-hidden="true" class="starter-icon-arrow-left-sharp"></i>',
				'next_text' => '<i aria-hidden="true" class="starter-icon-arrow-right-sharp"></i>',
				'type'      => 'list',
			)
		);

		if ( $links ) {
			echo wp_kses_post( $links );
		}
	}
endif;


/**
 * Custom function which will return sidebar layout depend on theme options
 */
if ( ! function_exists( 'ulearn_post_sidebar_by_theme_options' ) ) :
	function ulearn_post_sidebar_by_theme_options( $settings = '' ) {
		if ( ! empty( $settings['single-posts-sidebar'] ) ) {
			return $settings['single-posts-sidebar'];
		} elseif ( ulearn_is_defined_theme_options() ) {
			return 'primary-sidebar';
		}
	}
endif;

/**
 * Custom function which will return author tags section depend on theme options
 */
function ulearn_is_defined_theme_options() {
	return ( ! defined( 'ULEARN_CONFIGURATIONS_VERSION' ) );
}


/**
 * Custom function which will return sidebar position depend on theme options
 */
if ( ! function_exists( 'ulearn_post_sidebar_position_theme_options' ) ) :
	function ulearn_post_sidebar_position_theme_options( $current_post_type = '', $settings = '' ) {
		if ( ! empty( $settings['single-posts-sidebar-position'] ) ) {
			return 'sidebar-position-' . $settings['single-posts-sidebar-position'];
		} elseif ( ulearn_is_defined_theme_options() ) {
			return 'sidebar-position-right';
		}
	}
endif;


/**
 * Custom function which will return post info section depend on theme options
 */
if ( ! function_exists( 'ulearn_post_info_section_by_theme_options' ) ) :
	function ulearn_post_info_section_by_theme_options( $option = '' ) {
		$settings = get_option( 'stm_theme_settings', array() );
		if ( ! empty( $settings[ $option ] ) || ulearn_is_defined_theme_options() ) {
			return true;
		}
	}
endif;


/**
 * Custom function which will return author tags section depend on theme options
 */
if ( ! function_exists( 'ulearn_post_author_by_theme_options' ) ) :
	function ulearn_post_author_by_theme_options( $current_post_type = '', $settings = '' ) {
		if ( ! empty( $settings['author-on-posts-page'] ) || ulearn_is_defined_theme_options() ) {
			get_template_part( 'templates/single/post/parts/tags' );
			get_template_part( 'templates/single/post/parts/author' );
			get_template_part( 'templates/single/post/parts/share' );
		}
	}
endif;


/**
 * Custom function which will return comment section depend on theme options
 */
if ( ! function_exists( 'ulearn_post_comments_by_theme_options' ) ) :
	function ulearn_post_comments_by_theme_options( $current_post_type = '', $settings = '' ) {
		if ( ! empty( $settings['comment-on-posts-page'] ) || ulearn_is_defined_theme_options() ) {
			get_template_part( 'templates/single/post/parts/comments' );
		}
	}
endif;

function ulearn_stored_theme_options() {
	$options = get_option( 'stm_theme_settings', array() );

	return apply_filters( 'ulearn_stored_theme_options', $options );
}
