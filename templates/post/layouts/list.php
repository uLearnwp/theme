<?php
while ( have_posts() ) :
	the_post();
	?>
<div <?php post_class( 'news-list-item' ); ?>>
	<div class="news-list-content <?php echo has_post_thumbnail() ? 'image' : 'no-image'; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="news-list-item-image">
				<div class="news-list-post-categories">
					<ul>
						<?php
						$post_terms = get_the_category_list( '', '', get_the_ID() );
						echo wp_kses_post( $post_terms );
						?>
					</ul>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="ulearn-post-thumbnail">
						<?php the_post_thumbnail( 'post-thumbnail', array( 'loading' => false ) ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<div class="no-image-news-list-post-categories">
				<ul>
					<?php
					$post_terms = get_the_category_list( '', '', get_the_ID() );
					echo wp_kses_post( $post_terms );
					?>
				</ul>
			</div>
		<?php endif; ?>
		<div class="news-list-content-info">
			<div class="post-content-area">
				<div class="news-list-item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<div class="news-list-item-excerpt">
					<?php
					echo wp_kses_post( get_the_excerpt() );
					?>
				</div>
			</div>
			<a href="<?php the_permalink(); ?>" class="news-list-item-btn">
				<?php echo esc_html__( 'Learn more', 'ulearn' ); ?>
				<i aria-hidden="true" class="starter-icon-arrow-right"></i>
			</a>
		</div>
	</div>
</div>
	<?php
endwhile;
ulearn_posts_pages_pagination( 'posts_pages_pagination' );
wp_reset_postdata();
