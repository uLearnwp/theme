<?php
if ( ! function_exists( 'ulearn_comment' ) ) {
	function ulearn_comment( $comment, $args, $depth ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li ';
			$add_below = 'div-comment';
		} ?>

		<?php
		echo '<' . esc_attr( $tag );
		comment_class( empty( $args['has_children'] ) ? 'starter-comment' : 'starter-comment parent' );
		?>
		id="comment-<?php comment_ID(); ?>">

		<?php if ( 'div' !== $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php } ?>

		<?php if ( 0 !== $args['avatar_size'] ) { ?>
			<div class="comment-author-avatar"><?php echo get_avatar( $comment, 78 ); ?></div>
		<?php } ?>

		<div class="comment-info">
			<div class="comment-info-top">
				<div class="comment-info-top-left">
					<div class="comment-author"><?php echo get_comment_author_link(); ?></div>
					<span class="comment-date">
						<?php
						// Translators: %s: Comment name, %s: Comment
						printf( esc_html__( '%1$s at %2$s', 'ulearn' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) );
						?>
					</span>
				</div>
				<div class="comment-info-top-right">
					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'reply_text' => '<i class="starter-icon-reply"></i>' . esc_html__( 'Reply', 'ulearn' ),
								'add_below'  => $add_below,
								'depth'      => $depth,
								'max_depth'  => $args['max_depth'],
							)
						)
					);

					edit_comment_link( '<i class="starter-icon-edit"></i>' . esc_html__( 'Edit', 'ulearn' ), '  ', '' );
					?>
				</div>
			</div>
			<div class="comment-text">
				<?php comment_text(); ?>
			</div>
			<?php if ( '0' === $comment->comment_approved ) { ?>
				<em class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'ulearn' ); ?></em>
			<?php } ?>
		</div>

		<?php if ( 'div' !== $args['style'] ) { ?>
			</div>
			<?php
		}
	}
}

add_filter( 'comment_form_default_fields', 'ulearn_comment_form_fields' );

function ulearn_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
	$fields    = array(
		'author' => '<div class="starter-row">
			<div class="stm-col stm-col-sm-4">
				<div class="input-group comment-form-author">
					<input placeholder="' . esc_attr__( 'Name', 'ulearn' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
				</div>
			</div>',
		'email'  => '<div class="stm-col stm-col-sm-4">
				<div class="input-group comment-form-email">
					<input placeholder="' . esc_attr__( 'E-mail', 'ulearn' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
				</div>
			</div>',
		'url'    => '<div class="stm-col stm-col-sm-4">
				<div class="input-group comment-form-url">
					<input placeholder="' . esc_attr__( 'Website', 'ulearn' ) . '" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
				</div>
			</div></div>',
	);

	return $fields;
}

add_filter( 'comment_form_defaults', 'ulearn_comment_form' );

function ulearn_comment_form( $args ) {
	$args['comment_field'] = '<div class="comment-form-comment">
		<div class="input-group">
			<textarea placeholder="' . esc_html__( 'Your Comment', 'ulearn' ) . ' *" class="form-control" name="comment" rows="9" aria-required="true"></textarea>
		</div>
	</div>';

	$args['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s starter-button" value="%4$s">%4$s</button>';

	return $args;
}

add_filter( 'comment_form_fields', 'ulearn_move_comment_field_to_bottom' );

function ulearn_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}
