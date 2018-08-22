<?php
/**
 * Frontpage Blog Carousel File Doc Comment
 *
 * This template part renders a carousel of blog entries on the theme's front page
 *
 * @category Carousel
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @License URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<section id="white-section3wp" class="white-section3 <?php if ( 'yes' !== the_steam_get_option( 'option_carousel_visible' ) ) { echo esc_attr( 'hide-for-small-up' ); } ?>">
	<div class="blogPostsCarousel">
		<!-- last posts on front page, showcased in a nice carousel -->
		<div id="owl-demo" class="owl-carousel ts-clearfix ts-fixed-image owl-bg">
			<?php
			$blog_results = the_steam_get_blog_carousel_elementes();
			if ( $blog_results->have_posts() ) :
				while ( $blog_results->have_posts() ) : $blog_results->the_post();
					if ( has_post_thumbnail() ) : ?>
						<a class="click-carousel" href="<?php echo esc_url( get_the_permalink() ); ?>">
							<div class="item blogWrapper clickable">
								<!-- post featured image -->
								<figure class="effect-zoe"><img alt="Thumbnail"
										src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $blog_results->post->ID ) ) ); ?>"
										<?php if ( function_exists( 'wp_get_attachment_image_srcset' ) ) :?>
										srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_post_thumbnail_id( $blog_results->post->ID, 'thesteam-carousel-image-size' ) ) ); ?>"
										sizes="(max-width: 500px) 100vw, 500px"
										<?php endif; ?>
										class="blog-post">
									<div class="figure-zoe zoe-bg show-for-large-up"></div>
									<figcaption class="effect-zoe blog-owly-hover-effect">
										<!-- post details for large screens -->
										<div class="align-items description zoe-align show-for-large-up">
											<table class="tg">
												<tr>
													<th class="tg-t7cm"> <!-- here we will have the date -->
														<div class="first-line">
															<!-- post publish date -->
															<div class="day-number"><?php echo esc_html( the_steam_get_current_post_date( 'day' ) ); ?></div>
															<div class="month-year-container">
																<div class="month-owly">
																	*<?php echo esc_html( the_steam_get_current_post_date( 'month' ) ); ?></div>
																<div class="year-owly"><?php echo esc_html( the_steam_get_current_post_date( 'year' ) ); ?></div>
															</div>
														</div>
													</th>
												</tr>
												<tr>
													<!-- post title -->
													<td class="tg-t7cm">
														<div class="second-line">
															<h4 class="blog-owly-post-title"><?php echo esc_html( the_steam_get_elipsis( get_the_title(), 30 /* chars */ ) ); ?></h4>
														</div>
													</td>
												</tr>
												<tr>
													<td class="tg-t7cm">
														<hr class="third-line">
													</td>
												</tr>
												<tr>
													<td class="tg-t7cm">
														<!-- post category and comments number -->
														<div class="forth-line-owly">
															<p class="post-category-owly"><?php echo esc_html( the_steam_current_post_category_get_name() ); ?></p>

															<p class="vertical-line-between"> | </p>

															<p class="owly-post-comments"><?php echo esc_html( get_comments_number() ); ?>
																<?php esc_html_e( 'Comments', 'thesteam' ); ?></p>
														</div>
													</td>
												</tr>
											</table>
										</div>
									<!-- post details rearanged for smaller screens -->
									<div class="side-thumbs-info hide-for-large-up">
										<div class="align-items-side">
											<table class="tg-side">
												<tr>
													<td colspan="2">
														<div class="first-line-side-owly">
															<div class="day-number-side"><?php echo esc_html( the_steam_get_current_post_date( 'day' ) ); ?></div>
															<div class="month-year-container-side">
																<div class="month-owly-side">
																	*<?php echo esc_html( the_steam_get_current_post_date( 'month' ) ); ?></div>
																<div class="year-owly-side"><?php echo esc_html( the_steam_get_current_post_date( 'year' ) ); ?></div>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td class="tg-t7cm" colspan="2">
														<div class="second-line">
															<h4 class="blog-owly-post-title-side"><?php echo esc_html( the_steam_get_elipsis( get_the_title(), 20 /* chars */ ) ); ?></h4>
															<!-- same posts, but on mobile -->
														</div>
													</td>
												</tr>
												<tr>
													<td class="tg-t7cm-side" colspan="2">
														<hr class="third-line-side">
													</td>
												</tr>
												<tr>
													<td class="tg-t7cm-side">
													<td class="tg-t7cm">
														<div class="forth-line-owly-side">
															<p class="post-category-owly-side"><?php echo esc_html( the_steam_current_post_category_get_name() ); ?></p>
															<p class="vertical-line-between-side"> | </p>
															<p class="owly-post-comments-side"><?php echo esc_html( get_comments_number() ); ?>
																<?php esc_html_e( 'Comments', 'thesteam' ); ?></p>
														</div>
													</td>
												</tr>
											</table>
										</div>
									</div>
									</figcaption>
								</figure>
							</div>
						</a>
						<?php
					endif; // Endif has_thumbnail.
				endwhile; // Endwhile loop have_posts().
			endif; // End have_posts(). ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>
