<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package croccante
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf(
						/* translators: 1: title. */
						esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'croccante' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'croccante' ) ),
						number_format_i18n( $comments_number ),
						'<span>' . get_the_title() . '</span>'
					);
				}
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => '60',
					'reply_text'        =>  '<span>' .esc_html__( 'Reply'  , 'croccante' ) . '<i class="fa fa-reply spaceLeft" aria-hidden="true"></i></span>',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'croccante' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'croccante' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'croccante' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'croccante' ); ?></p>
	<?php
	endif;

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => '<p class="comment-form-author"><label for="author"><span class="screen-reader-text">' . esc_html__( 'Name *'  , 'croccante' ) . '</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Name *'  , 'croccante' ) . '"/></p>',
		'email'  => '<p class="comment-form-email"><label for="email"><span class="screen-reader-text">' . esc_html__( 'Email *'  , 'croccante' ) . '</span></label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Email *'  , 'croccante' ) . '"/></p>',
		'url'    => '<p class="comment-form-url"><label for="url"><span class="screen-reader-text">' . esc_html__( 'Website *'  , 'croccante' ) . '</span></label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website'  , 'croccante' ) . '"/></p>',
	);
	$required_text = __(' Required fields are marked ', 'croccante').' <span class="required">*</span>';
	?>
	<?php comment_form( array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		/* translators: %s: wordpress login url */
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'croccante' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		/* translators: 1: profile user link, 2: username, 3: logout link */
		'logged_in_as' => '<p class="logged-in-as smallPart">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  , 'croccante' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes smallPart">' . __( 'Your email address will not be published.'  , 'croccante' ) . ( $req ? $required_text : '' ),
		'title_reply' => __( 'Leave a Reply'  , 'croccante' ),
		/* translators: %s: name of person to reply */
		'title_reply_to' => __( 'Leave a Reply to %s'  , 'croccante' ),
		'cancel_reply_link' => __( 'Cancel reply'  , 'croccante' ) . '<i class="fa fa-times spaceLeft"></i>',
		'label_submit' => __( 'Post Comment'  , 'croccante' ),
		'comment_field' => '<p class="comment-form-comment"><label for="comment"><span class="screen-reader-text">' . esc_html__( 'Comment *'  , 'croccante' ) . '</span></label><textarea id="comment" name="comment" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Comment *'  , 'croccante' ) . '"></textarea></p>',
	));
	?>

</div><!-- #comments -->
