<?php
/**
 * Frontpage Section 4 Doc Comment
 *
 * This template part displays a list of four major types of dishes along with descriptive images
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- menu book container -->
<section class="fourth-section <?php if ( 'yes' !== the_steam_get_option( 'option_enable_menubook' ) ) { echo esc_attr( 'hide-for-small-up' ); } ?>" id="menu-book-owl">
	<div class="behind-menu-filter">
		<div class="menu-title-aligner ">
			<!-- short message or title for the menu book -->
			<h3 class="logo-menu-book-title" id="menu-book-title"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_fourth_section_msg_line1', the_steam_get_default_value( 'the_steam_fourth_section_msg_line1' ) ), 20 ) ); ?></h3>
			<!-- a few words for the menu book -->
			<p class="under-menu" id="menu-section-under-title"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_fourth_section_msg_line2', the_steam_get_default_value( 'the_steam_fourth_section_msg_line2' ) ), 40 ) );?></p>
			<!-- design element -->
			<div class="under-title-symbol">
				<div class="above">
					<div class="diamond-above"></div>
					<div class="diamond-above"></div>
				</div>
				<p class="under diamond"></p>
			</div>
		</div>
		<div id="owl-menu">
			<?php
			$tax_args = array(
				'order' => 'ASC',
				'orderby' => 'id',
				'hide_empty' => 0,
				'posts_per_page' => 4,
			);
			$tax_terms = get_terms( 'dishtype', $tax_args );
			$num_chars_owl_menu = 70;
			$page_num = 0;
			foreach ( $tax_terms as $dish_term ) :
				$dish_menu_list_query_args = array( 'post_type' => 'dish', 'post_status' => 'publish', 'tax_query' => array( array( 'taxonomy' => 'dishtype', 'field' => 'slug', 'terms' => array( $dish_term->slug ) ) ),'posts_per_page' => '50', 'order' => ( 'yes' === the_steam_get_option( 'option_menubook_order' ) ? 'ASC' : 'DESC') );
				$frontpage_menu_order = the_steam_get_option( 'option_frontpage_menu_order', 'date' );

				if ('date' === $frontpage_menu_order) {
					$dish_menu_list_query_args['orderby'] = 'date';
				} else {
					$dish_menu_list_query_args['orderby'] = 'meta_value';
					$dish_menu_list_query_args['meta_key'] = 'dish_order';
				}

				$dish_list_results = new WP_Query( $dish_menu_list_query_args );
				$the_steam_curr_dish_index = 0;
				$dishes_count = $dish_list_results->post_count;
				if ( $dish_list_results->have_posts() ) :
					while ( $dish_list_results->have_posts() ) : $dish_list_results->the_post();
						?>
						<?php if ( 0 === $the_steam_curr_dish_index || 0 === $the_steam_curr_dish_index % 10 ) : ?>

							<div class="item" id="item-<?php echo esc_attr( $dish_term->slug );
							echo esc_attr( $the_steam_curr_dish_index );?>" data-page="<?php echo esc_js( $page_num );?>">
							<?php $page_num++; ?>
								<section class="menu-book">
								<div class="dishtype-menu">
									<div class="menu-book-center"><h3 class="food-type"><?php echo esc_html( $dish_term->name ); ?></h3><hr class="under-food-type"/></div>
										<div class="dish-list">
											<div class="first-menu-column">
												<ul class="leaders"> <!-- start ul -->
													<?php endif; ?>
													<?php $the_steam_curr_dish_index++;  ?>
													<!-- dish name -->
													<li class="product-name">

														<?php $featured_img = null;
														if ( wp_get_attachment_image_src( get_post_thumbnail_id( $dish_term->ID, 'large' ) ) ) {
															$img_obj = wp_get_attachment_image_src( get_post_thumbnail_id( $dish_term->ID ), 'large' );
															if ( is_array( $img_obj ) && array_key_exists( 0, $img_obj ) ) {
																$featured_img = $img_obj[0];
															} else {
																$featured_img = '#';
															}
														} ?>
														<a class="product-line <?php if ( 'yes' !== the_steam_get_option( 'option_dish_enabled' ) ) { echo 'no-load'; } ?>" <?php  if ( 'yes' === the_steam_get_option( 'option_dish_enabled' ) ) : ?> href="<?php echo esc_url( get_the_permalink() ); ?>" <?php endif; ?> data-img="<?php echo esc_js( $featured_img ); ?>">
															<span class="ellipsis">
																<?php echo esc_html( the_steam_get_elipsis( get_the_title(), $num_chars_owl_menu ) ); ?>
															</span>
															<!-- dish prince and currency -->
															<?php $price_tag = get_post_meta( get_the_ID(), 'dish_price', 'true' );
															$show_price = ('0' !== $price_tag) ? true : false;
															if ( 'yes' === the_steam_get_option( 'option_currency_after' ) ) {
																$price_tag .= ' ' . the_steam_get_option( 'option_currency', '$' );
															} else {
																$price_tag = the_steam_get_option( 'option_currency', '$' ) . ' ' . $price_tag;
															} ?>

															<?php if ( true === $show_price ) : ?>
															<span class="product-price"><?php echo esc_html( $price_tag ); ?></span>
															<?php endif; ?>
														</a>
													</li>
													<?php global $post; ?>
													<li class="product-description"><?php echo esc_html( get_post_meta( $post->ID, 'dish_contents', 'true' ) ); ?> </li>
													<?php if ( 5 === ($the_steam_curr_dish_index % 10) ) : ?>
												</ul>
											</div>
											<div class="second-menu-column"></div>
											<div class="third-menu-column ts-clearfix">
												<ul class="leaders"><?php endif; ?>
												<?php if ( 0 === ($the_steam_curr_dish_index % 10) || $the_steam_curr_dish_index === $dishes_count ) : ?>
												</ul><!-- end ul -->
											</div><!-- end third menu column -->
										</div><!-- end dish-list -->
									</div><!-- end dishtype-menu -->
									<!-- this appears although there are only 3 elements left on the second page, special usecase -->
									<div class="bar-selector">
										<div class="bar left-bar clicked-bar"><?php esc_html_e( '1','thesteam' ); ?></div>
										<div class="bar right-bar unclicked-bar"><?php esc_html_e( '2', 'thesteam' ); ?></div>
									</div>
								</section><!-- end section -->
							</div><!-- end item -->
						<?php endif; ?>
						<?php
					endwhile;
				endif;
				wp_reset_postdata();
			endforeach;	?>
		</div>
		<!-- navigation arrows trigger left or right movement of the page. swipe also works -->
		<div class="arrows">
			<div class="angle prev no-load" id="menu-navigate-left">
				<span class="icon-wrap"></span>
			</div>
			<div class="angle next no-load" id="menu-navigate-right">
				<span class="icon-wrap"></span>
			</div>
		</div>
	</div>
</section>
