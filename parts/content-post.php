<?php
/**
 * Content Post File Doc Comment
 *
 * This template part displays the post content
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- post entry -->
<article <?php post_class( 'row row-thumb-section ts-clearfix' ); ?>>
	<div class="large-12 columns">
		<div class="main-post-container">
			 <header class="before-post-info ts-clearfix">
				 <!-- post title -->
				<p class="post-title-line"><a class="no-load" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( the_steam_get_elipsis( get_the_title(), 100 ) ); ?></a></p>
				<div class="under-title-container">
					<!-- date -->
					<p class="under-post date-line"><a class="date-line" href="<?php echo esc_url( get_the_permalink() );?>"><?php echo esc_html( the_steam_get_current_post_date( 'month' ) ); ?> <?php echo esc_html( the_steam_get_current_post_date( 'day' ) ); ?> <?php echo esc_html( the_steam_get_current_post_date( 'year' ) ); ?></a></p>
					<p class="under-post vertical-line">|</p>
					<p class="under-post comment-line"><?php echo esc_html( sprintf( _n( '%d COMMENT', '%d COMMENTS', get_comments_number( get_the_ID() ), 'thesteam' ),  get_comments_number( get_the_ID() ) ) ); ?></p>
				</div>
			</header>
			<?php if ( has_post_thumbnail() ) : ?>
			<!-- featured image -->
			   <figure>
				   <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_post_thumbnail( 'large' );?></a>
				   <figcaption class="post-caption"><?php echo esc_html( the_steam_get_post_subtitle() ); ?></figcaption>
			   </figure>
			<?php endif; ?>
			<div class="list-category">
				<p class="post-category-line">
					<?php if ( 'dish' === get_post_type() ) : ?>
						<?php esc_html_e( 'Posted in','thesteam' );?> <?php echo esc_html( the_steam_current_post_category_get_name() ); ?> <?php esc_html_e( 'category', 'thesteam' ); ?>
					<?php elseif ( 'post' === get_post_type() ) : ?>
						<?php esc_html_e( 'Posted in','thesteam' );?> <?php the_category( ', ' ); ?>
					<?php endif; ?>	<?php if ( '' !== get_the_author() ) : esc_html_e( 'by', 'thesteam' ); ?> <?php the_author_posts_link();
endif; ?>
				</p>
			</div>
			<section class="under-post-text">
				<!-- for dishes, meal contents -->
				<p class="dish-contents">
				<?php if ( 'dish' === get_post_type() ) : ?>
					<span class="pre-dish-contents">
						<?php esc_html_e( 'Ingredients: ', 'thesteam' ); ?>
					</span>
					<?php echo esc_html( get_post_meta( get_the_ID(), 'dish_contents', 'true' ) );
				endif; ?>
				</p>
				<?php
				global $post;
				if ( strpos( $post->post_content, '<!--more-->' ) ) {
					the_content( );
				} else {
					the_excerpt();
				} ?>
			</section>
			<div class="read-more">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>"><div class="read-more-btn"><?php 'dish' === get_post_type() ? esc_html_e( 'READ MORE', 'thesteam' ) : esc_html_e( 'READ FULL ARTICLE', 'thesteam' ); ?></div></a>
			</div>
			<div class="post-bottom">
				<div class="post-views">
					<span class="fa-stack-list fa-lg">
						<a href="<?php echo esc_url( get_the_permalink() );?>">
							<i class="fa fa-eye fa-stack-1x-blog-post eye">
								<!-- number of post views -->
								<span class="icon-text"><?php echo esc_html( sprintf( _n( '%d VIEW', '%d VIEWS', the_steam_get_blogpost_views( get_the_ID() ), 'thesteam' ),  the_steam_get_blogpost_views( get_the_ID() ) ) ); ?></span>
							</i>
						</a>
					</span>
				</div>
				<!-- social sharing buttons -->
				<div class="post-social-media">
					<div class="blog-post-social-media-symbols">
						<span class="fa-stack-list fa-lg">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_facebook_share_url' ) .
							get_the_permalink()); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'facebook', 'thesteam' ); ?></span>
								<i class="fa fa-facebook fa-stack-1x-blog-post"></i>
							</a>
						</span>
						<span class="fa-stack-list fa-lg">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_twitter_share_url' ) .
							get_the_permalink());?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'twitter', 'thesteam' ); ?></span>
								<i class="fa fa-twitter fa-stack-1x-blog-post"></i>
							</a>
						</span>
						<span class="fa-stack-list fa-lg">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_pinterest_share_url' ) .
							get_the_permalink()); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'pinterest', 'thesteam' ); ?></span>
								<i class="fa fa-pinterest fa-stack-1x-blog-post"></i>
							</a>
						</span>
					    <span class="fa-stack-list fa-lg">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_default_value( 'the_steam_googleplus_share_url' ) .
							get_the_permalink()); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'google-plus', 'thesteam' ); ?></span>
								<i class="fa fa-google-plus fa-stack-1x-blog-post"></i>
							</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
