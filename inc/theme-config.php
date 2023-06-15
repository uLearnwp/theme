<?php

function ulearn_get_demo_name() {
	$demo_name = get_option( 'stm_demo_name', 'main_demo' );

	return $demo_name;
}

function ulearn_color_styles() {
	$theme_settings = get_option( 'stm_theme_settings', array() );
	ob_start();
	?>
	:root {
	--text_color: <?php echo esc_html( ( ! empty( $theme_settings['text_color'] ) ) ? $theme_settings['text_color'] : '#303441' ); ?>;
	--primary_variant_color: <?php echo esc_html( ( ! empty( $theme_settings['heading_color'] ) ) ? $theme_settings['heading_color'] : '#43C370' ); ?>;
	--primary_color: <?php echo esc_html( ( ! empty( get_theme_mod( 'ms_lms_starter_primary_color' ) ) ) ? get_theme_mod( 'ms_lms_starter_primary_color' ) : '#f54a24' ); ?>;
	--secondary_color: <?php echo esc_html( ( ! empty( get_theme_mod( 'ms_lms_starter_secondary_color' ) ) ) ? get_theme_mod( 'ms_lms_starter_secondary_color' ) : '#f54a24' ); ?>;
	--link_color_hover: <?php echo esc_html( ( ! empty( get_theme_mod( 'ms_lms_starter_link_color' ) ) ) ? get_theme_mod( 'ms_lms_starter_link_color' ) : '#fff' ); ?>;
	--layout_width: <?php echo esc_html( ( ! empty( get_theme_mod( 'ms_lms_starter_content_width_value' ) ) ) ? get_theme_mod( 'ms_lms_starter_content_width_value' ) . 'px' : '1140px' ); ?>;
	}
	<?php
	$css = ob_get_contents();
	ob_end_clean();

	return $css;
}

function ulearn_theme_fonts() {
	$settings = get_option( 'stm_theme_settings', array() );

	$fonts         = array();
	$heading_fonts = array(
		'h1_font',
		'h2_font',
		'h3_font',
		'h4_font',
		'h5_font',
		'h6_font',
	);

	foreach ( $heading_fonts as $heading_font ) {
		if ( ! empty( $settings[ $heading_font ]['font-family'] ) ) {
			$fonts[] = "{$settings[$heading_font]['font-family']}:{$settings[$heading_font]['font-weight']}";
			$fonts[] = "{$settings[$heading_font]['font-family']}:{$settings[$heading_font]['font-weight']}i";
		} else {
			$fonts[] = 'Poppins:700,400';
		}
	}

	if ( ! empty( $settings['body_font']['font-family'] ) ) {
		$fonts[] = "{$settings['body_font']['font-family']}:{$settings['body_font']['font-weight']}";
		$fonts[] = "{$settings['body_font']['font-family']}:{$settings['body_font']['font-weight']}i";
		$fonts[] = "{$settings['body_font']['font-family']}:700";
		$fonts[] = "{$settings['body_font']['font-family']}:700i";
	} else {
		$fonts[] = 'Open Sans:700,400';
	}

	$subsets = apply_filters( 'ulearn_google_fonts_subset', 'latin,latin-ext' );

	$query_args = array(
		'family' => rawurlencode( implode( '|', array_unique( $fonts ) ) ),
		'subset' => rawurlencode( $subsets ),
	);

	$fonts_url = ( ! empty( $fonts ) ) ? add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) : '';

	return esc_url( $fonts_url );
}

add_action( 'init', 'ulearn_theme_fonts' );
