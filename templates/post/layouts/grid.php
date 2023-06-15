<?php
$settings = get_option( 'stm_theme_settings', array() );
$per_row  = ( ! empty( $settings['ulearn-posts-per-row'] ) ) ? $settings['ulearn-posts-per-row'] : '';
?>

<div class="post-row">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
	<div class="news_item-item column-grid-<?php echo esc_attr( $per_row ); ?>">
		<div class="news_item-content">
			<?php
			if ( has_post_thumbnail() ) :
				?>
				<div class="news_item-image">
					<div class="post-categories">
						<?php
						$post_terms = get_the_category_list( '', '', get_the_ID() );
						echo wp_kses_post( $post_terms );
						?>
					</div>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<div class="no-image-post-categories">
					<?php
					$post_terms = get_the_category_list( '', '', get_the_ID() );
					echo wp_kses_post( $post_terms );
					?>
				</div>
			<?php endif; ?>
			<div class="news_item-content-info">
				<div class="news_item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<div class="news_item-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<a href="<?php the_permalink(); ?>" class="ulearn-widget-news_item__btn">
					<?php echo esc_html__( 'Learn more', 'ulearn' ); ?>
					<i aria-hidden="true" class="starter-icon-arrow-right"></i>
				</a>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</div>
<?php
ulearn_posts_pages_pagination( 'posts_pages_pagination' );
wp_reset_postdata();
