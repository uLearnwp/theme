<?php
if ( post_password_required() ) {
	return;
}
$settings                      = get_option( 'stm_theme_settings', array() );
$comment_background_img        = ! empty( $settings['single-post-comment-image'] ) ? $settings['single-post-comment-image'] : '';
$comment_bg_overlay            = ! empty( $settings['single-post-comment-background-color'] ) ? $settings['single-post-comment-background-color'] : '#414562F2';
$actual_comment_background_img = get_template_directory_uri() . '/assets/images/comments-bg.jpg';

if ( ! empty( $comment_background_img ) ) {
	$comment_background_img = wp_get_attachment_image_url( $comment_background_img, '' );
	if ( ! empty( $comment_background_img ) ) {
		$actual_comment_background_img = $comment_background_img;
	}
}
?>

<div>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php comments_number(); ?>
		</h3>

		<ul class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 78,
					'max_depth'   => 10,
					'callback'    => 'ulearn_comment',
				)
			);
			?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ulearn' ); ?></h2>
				<div class="nav-links">
					<?php
					$prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'ulearn' ) );
					$next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'ulearn' ) );
					if ( $prev_link ) {
						printf( '<div class="nav-previous">%s</div>', esc_url( $prev_link ) );
					}
					if ( $next_link ) {
						printf( '<div class="nav-next">%s</div>', esc_url( $next_link ) );
					}
					?>
				</div>
			</nav>
			<?php
		endif;
	endif;
	?>

	<?php
	comment_form(
		array(
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'title_reply'          => 'Leave a Comment',
			'label_submit'         => esc_html__( 'Submit', 'ulearn' ),
		)
	);
	?>

	<?php
	if (
		! comments_open() &&
		get_comments_number() &&
		post_type_supports(
			get_post_type(),
			'comments'
		)
	) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ulearn' ); ?></p>
		<?php
	endif;
	?>

</div>
