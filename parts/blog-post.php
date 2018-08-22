<?php
/**
 * Blog Post Doc Comment
 *
 * This file is a template part which displays a single blog post entry in the single.php page
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @License URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<?php if ( have_posts() ) : the_post();
endif; ?>
<div class="row medium-8 large-7 columns">
	<!-- article from the articles list -->
	<article class="blog-post-content">
		<header class="ts-clearfix">
			<hr class="blog-title">
			<!-- post date -->
			<?php if ( 'post' === get_post_type() || 'dish' === get_post_type() ) : ?>
			<div class="publish-date">
				<div class="post-date-container">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<p class="post-date-time"><?php echo esc_html( the_steam_get_current_post_date( 'month' ) . ' ' . the_steam_get_current_post_date( 'day' ) . ' ' . the_steam_get_current_post_date( 'year' ) . ' | ' . the_steam_get_current_post_date( 'hour' ) . ':' . the_steam_get_current_post_date( 'min' ) . ' ' . the_steam_get_current_post_date( 'am_pm' ) );?></p>
				</div>
			</div>
			<?php endif; ?>
			<!-- blog post categories -->
			<div class="post-category-info">
				<p class="post-category-line">
					<?php if ( 'dish' === get_post_type() ) : ?>
						<?php esc_html_e( 'Posted in','thesteam' );?> <?php echo esc_html( the_steam_current_post_category_get_name() ); ?> <?php esc_html_e( 'category', 'thesteam' ); ?>
					<?php elseif ( 'post' === get_post_type() ) : ?>
						<?php esc_html_e( 'Posted in','thesteam' );?> <?php the_category( ', ' ); ?>
					<?php endif; ?>	<?php if ( '' !== get_the_author() ) : esc_html_e( 'by', 'thesteam' ); ?> <?php the_author_posts_link();
endif; ?>
				</p>
			</div>
		</header>
		<hr class="blog-title-hr">
		<p class="dish-contents">
		<?php if ( 'dish' === get_post_type() ) : ?>
			<span class="pre-dish-contents">
				<?php esc_html_e( 'Ingredients: ', 'thesteam' ); ?>
			</span>
			<?php echo esc_html( get_post_meta( get_the_ID(), 'dish_contents', 'true' ) );
		endif; ?>
		</p>
		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</section>
		<!-- mfunc <?php  the_steam_set_blogpost_views( get_the_ID() ); ?> --><!-- /mfunc -->
		<?php the_steam_enqueue_post_jumbotron_style( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>
	<hr class="blog-title-bottom">
	<!-- share icons -->
	<div class="blog-post-social-media">
		<div class="blog-post-social-media-symbols">
			<span class="fa-stack fa-lg">
				<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_facebook_share_url' ) .
				get_the_permalink()); ?>"><span class="anchor-content"><?php esc_html_e( 'facebook', 'thesteam' ); ?></span>
					<i class="fa fa-facebook fa-stack-1x-blog-post"></i>
				</a>
			</span>
			<span class="fa-stack fa-lg">
				<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_twitter_share_url' ) .
				get_the_permalink()); ?>"><span class="anchor-content"><?php esc_html_e( 'twitter', 'thesteam' ); ?></span>
					<i class="fa fa-twitter fa-stack-1x-blog-post"></i>
				</a>
			</span>
			<span class="fa-stack fa-lg">
				<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_pinterest_share_url' ) .
				get_the_permalink()); ?>"><span class="anchor-content"><?php esc_html_e( 'pinterest', 'thesteam' ); ?></span>
					<i class="fa fa-pinterest fa-stack-1x-blog-post"></i>
				</a>
			</span>
		   <span class="fa-stack fa-lg">
				<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_googleplus_share_url' ) .
				get_the_permalink()); ?>"><span class="anchor-content"><?php esc_html_e( 'google-plus', 'thesteam' ); ?></span>
					<i class="fa fa-google-plus fa-stack-1x-blog-post"></i>
				</a>
			</span>
		</div>
	</div>
	<!-- blog post tags -->
	<div class="post-category-info">
		<p class="post-tags-line"><?php the_tags(); ?></p>
	</div>
	<hr class="blog-title-hr">
	</article>
	<!-- suggested posts -->
	<nav><?php the_steam_post_link_pages(); ?></nav>
	<nav class="trio-bottom-space"><?php the_steam_show_suggested_items(); ?></nav>
	<!-- comments template loaded here -->
	<aside class="comment-area">
		<?php comments_template( '', true ); ?>
	</aside>
</div>
