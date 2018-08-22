<?php
/**
 * Comments File Doc Comment
 *
 * This file displays a list of comments when available
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 * Text Domain: thesteam
 **/

?>

<!-- comments template page -->
<?php
if ( true === post_password_required() ) : ?>
	<p class="nocomments"><?php esc_html_e( 'This post is protected with a password. Please enter the password to view comments.', 'thesteam' ); ?></p>
	<?php return;
endif; ?>
<?php if ( true === have_comments() ) : ?>
	<hr class="after-selector">
	<h3 id="comments">
		<?php comments_number( esc_html__( 'No Comment', 'thesteam' ), esc_html__( 'One Comment', 'thesteam' ), esc_html__( '% Comments', 'thesteam' ) ); ?><?php esc_html_e( ' so far:', 'thesteam' ); ?>
	</h3>
	<ol class="commentlist">
		<?php wp_list_comments( array( 'avatar_size' => 77 ) ); ?>
	</ol>
	<?php previous_comments_link();
	next_comments_link(); ?>
	<hr class="after-selector">
<?php else : // This is displayed if there are no comments so far. ?>
	<?php if ( false === comments_open() && 0 !== get_comments_number() && true === post_type_supports( get_post_type(), 'comments' ) && 'page' !== get_post_type() ) : ?>
		<p class="ts-closed-comments"> <?php if ( 'yes' !== the_steam_get_option( 'option_hide_comments_closed' ) ) { esc_html_e( 'Comments are closed.', 'thesteam' ); } ?> </p>
	<?php endif; ?>
<?php endif; ?>
<?php if ( true === comments_open() ) : ?>
	<hr class="after-selector">
	<?php comment_form(); ?>
	<hr class="after-selector">
<?php endif; ?>
