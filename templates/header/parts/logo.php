<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo_image     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
if ( ! empty( $custom_logo_id ) ) { ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ulearn-logo ">
		<img src="<?php echo esc_url( $logo_image[0] ); ?>" alt="<?php echo esc_html( get_the_title( $custom_logo_id ) ); ?>" class="custom-logo-link">
	</a>
<?php } else { ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ulearn-logo">
		<img
			width="151"
			height="33"
			src="
			<?php
				echo esc_url(
					get_template_directory_uri() . '/assets/images//dark-logo.svg'
				);
			?>
			"
			alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
		/>
	</a>
	<?php
}
