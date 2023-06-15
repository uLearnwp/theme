<?php
$post_category = get_the_category();
$author_link   = get_the_author_posts_link();
$author_name   = get_the_author_meta( 'display_name' );
$posted        = get_the_time( 'U' );
$settings      = get_option( 'stm_theme_settings', array() );
?>

<div class="post-info">

	<?php if ( $post_category && ulearn_post_info_section_by_theme_options( 'post-category-on-posts-page' ) ) : ?>
		<div class="post-info__item post-categories">
			<h6 class="screen-reader-text"><?php esc_html_e( 'Categories:', 'ulearn' ); ?></h6>
			<?php echo wp_kses_post( get_the_category_list( esc_html__( ', ', 'ulearn' ) ) ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $author_link && ulearn_post_info_section_by_theme_options( 'post-posted-by-on-posts-page' ) ) : ?>
		<div class="post-info__item post-author">
			<span class="screen-reader-text"><?php esc_html_e( 'Posted by: ', 'ulearn' ); ?></span>
			<?php echo wp_kses_post( $author_link ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $posted && ulearn_post_info_section_by_theme_options( 'post-date-on-posts-page' ) ) : ?>
		<div class="post-info__item post-date">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $settings['comment-on-posts-page'] ) ) : ?>
	<div class="post-info__item post-comment">
		<?php comments_number( 'No comments', '1 Comment', '% Comments' ); ?>
	</div>
	<?php endif; ?>

</div>
