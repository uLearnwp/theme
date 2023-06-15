<?php if ( has_post_thumbnail() ) : ?>
	<div class="single-post-thumbnail">
		<?php the_post_thumbnail( 'ulearn_single_post_image', array( 'loading' => false ) ); ?>
	</div>
	<?php
endif;
