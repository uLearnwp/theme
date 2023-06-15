<?php
$settings         = get_option( 'stm_theme_settings', array() );
$sidebar          = ! empty( $settings['post-sidebar'] ) ? $settings['post-sidebar'] : 'primary-sidebar';
$sidebar_position = ! empty( $settings['post-sidebar-position'] ) ? 'sidebar-position-' . $settings['post-sidebar-position'] : 'sidebar-position-right';
$post_layout      = ! empty( $settings['post_layout'] ) ? ' post-layout-' . $settings['post_layout'] : ' post-layout-list';
$post_action      = ! empty( ( 'none' !== $sidebar && is_active_sidebar( $sidebar ) ) ) ? $sidebar_position . $post_layout . ' has-sidebar' : $sidebar_position . $post_layout;

if ( have_posts() ) : ?>
<div class="container">
	<div class="posts-template <?php echo esc_attr( $post_action ); ?>">
		<div class="post-content-column">
			<div class="post-content-column-inner">
				<?php get_template_part( 'templates/post/layouts/list' ); ?>
			</div>
		</div>
		<?php if ( is_active_sidebar( $sidebar ) ) : ?>
			<div class="post-sidebar-column">
				<div class="post-sidebar-column-inner">
					<?php get_sidebar( $sidebar ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
