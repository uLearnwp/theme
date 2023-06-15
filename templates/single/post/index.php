<?php
$settings          = get_option( 'stm_theme_settings', array() );
$current_post_type = get_post_type( get_the_ID() );
$sidebar           = ulearn_post_sidebar_by_theme_options( $settings );

if ( is_active_sidebar( $sidebar ) && 'none' !== $sidebar || empty( $settings ) ) :
	?>
<div class="row <?php echo esc_attr( ulearn_post_sidebar_position_theme_options( get_post_type( get_the_ID() ), $settings ) ); ?>">
<div class="stm-col-xl-9">
	<?php
	endif;
if ( have_posts() ) {
	echo '<main id="content">';
	while ( have_posts() ) :
		the_post();
		get_template_part( 'templates/single/post/parts/title' );
		get_template_part( 'templates/single/post/parts/info' );
		get_template_part( 'templates/single/post/parts/share' );
		get_template_part( 'templates/single/post/parts/thumbnail' );
		get_template_part( 'templates/single/post/parts/content' );
		get_template_part( 'templates/single/post/parts/next-page' );
		ulearn_post_author_by_theme_options( get_post_type( get_the_ID() ), $settings );
		ulearn_post_comments_by_theme_options( get_post_type( get_the_ID() ), $settings );
	endwhile;
	echo '</main>';
} else {
	get_template_part( 'templates/content', 'none' );
}
if ( is_active_sidebar( $sidebar ) || empty( $settings ) ) :
	?>
	</div>
	<div class="stm-col-xl-3">
		<?php get_sidebar( $sidebar ); ?>
	</div>
	<?php endif; ?>
</div>
