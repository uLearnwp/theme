<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( 'ulearn_post_image' ); ?>
		</a>
	</div>
	<?php
		endif;
