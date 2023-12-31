<?php
$post_category = get_the_category();
$author_link   = get_the_author_posts_link();
$author_name   = get_the_author_meta( 'display_name' );
$posted        = get_the_time( 'U' );
?>

<div class="post-info">

	<?php if ( $post_category ) : ?>
		<div class="post-info__item post-categories">
			<h6 class="screen-reader-text"><?php esc_html_e( 'Categories:', 'ulearn' ); ?></h6>
			<?php echo wp_kses_post( get_the_category_list( esc_html__( ', ', 'ulearn' ) ) ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $author_link ) : ?>
		<div class="post-info__item post-author">
			<span class="screen-reader-text"><?php esc_html_e( 'Posted by: ', 'ulearn' ); ?></span>
			<?php echo wp_kses_post( $author_link ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $posted ) : ?>
		<div class="post-info__item post-date">
			<a href="<?php the_permalink(); ?>">
				<?php the_time( get_option( 'date_format' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="post-info__item post-comment">
		<a href="<?php comments_link(); ?>">
			<?php comments_number( 'No comments', '1 Comment', '% Comments' ); ?>
		</a>
	</div>

</div>
