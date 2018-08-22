<?php
/**
 * Footer File Doc Comment
 *
 * This file renders the theme's footer and is included in all pages
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 * Text Domain: thesteam
 **/

?>
<!-- generic footer -->
<footer class="footer-bg">
	<div class="footer-title-aligner footer-title">
		<!-- footer title -->
		<?php $footer_title = the_steam_get_theme_mod( 'the_steam_footer_title', ' ' ); ?>
		<!-- header should exist even if empty for the customizer to work -->
		<h1 class="logo-footer white" id="footer-title"><?php echo esc_html( the_steam_get_elipsis( $footer_title ), 50 );?></h1>
		<?php if ( ' ' !== $footer_title || is_customize_preview() ) : ?>
		<hr id="footer-title-hr">
		<!-- design element -->
		<div class="under-title-symbol-footer white">
			<div class="above-footer">
				<div class="diamond-above-footer"></div>
				<div class="diamond-above-footer"></div>
			</div>
			<p class="under" id="diamond-sub-footer"></p>
		</div>
		<?php endif; ?>
	</div>
	<?php if ( (the_steam_check_plugin_active() && 'yes' === the_steam_get_option( 'option_contact_form' )) || the_steam_have_social_links() || the_steam_have_contact_details() || is_customize_preview() ) : ?>
	<div class="row-footer align-center ts-clearfix">
		<div class="column column-special small-4">
			<div class="footer-left-column white">
				<?php if ( the_steam_have_contact_details() || is_customize_preview() ) : ?>
				<!-- contact information heading -->
				<div class="footer-left-title">
					<?php $footer_subtitle_left = the_steam_get_theme_mod( 'the_steam_footer_subtitle_left', ' ' ); ?>
					<?php if ( ' ' !== $footer_subtitle_left || is_customize_preview() ) : ?>
	                    <h4 class="left-title" id="left-title"><?php echo esc_html( $footer_subtitle_left ); ?></h4>
					<?php endif; ?>
				</div>
				<div class="under-title-info">
					<!-- contact details container -->
					<div class="contact-details-container">
						<?php $opening = the_steam_get_option( 'opening_hours', '#', 300 );?>
						<?php if ( '#' !== $opening ) : ?>
						<!-- e-mail address -->
						<div class="email-line">
							<i class="fa fa-clock-o fa-lg-footer footer-left-padding ts-clearfix"></i>
							<div class="opening-hours">
								<p class="link-no-decoration no-load footer-contact"><?php echo esc_html( the_steam_get_elipsis( $opening, 300, ' ' ) ); ?></p>
							</div>
						</div>
						<?php endif; ?>
						<?php if ( '#' !== the_steam_get_option( 'option_phone_number', '#' ) ) : ?>
						<!-- phone number -->
						<div class="phone-line">
							<i class="fa fa-phone fa-lg-footer footer-left-padding"></i>
							<div class="phone-number">
								<p class="footer-contact">
									<a class="link-no-decoration no-load" href="tel:<?php echo esc_attr( str_replace( ' ', '.', the_steam_get_option( 'option_phone_number' ) ) ); ?>">
									<?php echo esc_html( the_steam_get_option( 'option_phone_number', '' ) ); ?>
								    </a>
								</p>
							</div>
						</div>
						<?php endif; ?>
						<?php if ( '#' !== the_steam_get_option( 'option_city', '#', 300 ) ) : ?>
						<!-- restaurant address - can be clicked and triggers google maps app where available -->
						<div class="web-line">
							<i class="fa fa-location-arrow fa-lg-footer footer-left-padding"></i>
							<?php
							$lats = explode( '+', the_steam_get_option( 'option_map_latitude', '', 600 ) );
							$longs = explode( '+', the_steam_get_option( 'option_map_longitude', '', 600 ) );
							?>
							<p class="footer-contact">
							    <a title="<?php echo esc_attr__( 'Navigate in Google Maps', 'thesteam' ); ?>" class="link-no-decoration web-adress no-load" href="<?php echo esc_url( 'https://www.google.com/maps/dir//' );
							    if ( isset( $lats ) && isset( $longs ) && is_array( $lats ) && is_array( $longs ) ) {
								    for ( $i = 0; $i < count( $lats ); $i++ ) {
									    echo (esc_attr( $lats[ $i ] ) . ',' . esc_attr( $longs[ $i ] ) . '/');
								    }
							    }

							    ?>"><?php echo esc_html( the_steam_get_option( 'option_city', '', 100 ) ); ?> <?php echo esc_html( the_steam_get_option( 'option_street', '', 100 ) ); ?></a>
						    </p>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( the_steam_have_social_links() || is_customize_preview() ) : ?>
				<!-- social icons container -->
				<div class="footer-left-social-media">
					<div class="social-media-title">
						<?php $footer_subtitle_left_social = the_steam_get_theme_mod( 'the_steam_footer_subtitle_left_social', ' ' ); ?>
						<?php if ( ' ' !== $footer_subtitle_left_social || is_customize_preview() ) : ?>
	                        <h4 class="left-title" id="left-title-social"><?php echo esc_html( $footer_subtitle_left_social ); ?></h4>
						<?php endif; ?>
					</div>
					<div class="social-media-symbols">
						<span class="fa-stack-footer fa-lg-footer social-media-margin">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_option( 'option_fb_url', '#', 300 ) ); ?>"><span class="anchor-content"><?php esc_html_e( 'facebook', 'thesteam' ); ?></span>
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-facebook fa-stack-1x"></i>
							</a>
						</span>
						<span class="fa-stack-footer fa-lg-footer social-media-margin">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_option( 'option_tw_url', '#', 300 ) ); ?>"><span class="anchor-content"><?php esc_html_e( 'twitter', 'thesteam' ); ?></span>
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-twitter fa-stack-1x"></i>
							</a>
						</span>
						<span class="fa-stack-footer fa-lg-footer social-media-margin">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_option( 'option_foursquare_url', '#', 300 ) ); ?>"><span class="anchor-content"><?php esc_html_e( 'foursquare', 'thesteam' ); ?></span>
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-foursquare fa-stack-1x"></i>
							</a>
						</span>
						<span class="fa-stack-footer fa-lg-footer social-media-margin">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_option( 'option_instagram_url', '#', 300 ) ); ?>"><span class="anchor-content"><?php esc_html_e( 'instagram', 'thesteam' ); ?></span>
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-instagram fa-stack-1x"></i>
							</a>
						</span>
						<span class="fa-stack-footer fa-lg-footer social-media-margin">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_option( 'option_pinterest_url', '#', 300 ) ); ?>"><span class="anchor-content"><?php esc_html_e( 'pinterest', 'thesteam' ); ?></span>
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-pinterest-p fa-stack-1x"></i>
							</a>
						</span>
						<span class="fa-stack-footer fa-lg-footer social-media-margin">
							<a class="no-load" href="<?php echo esc_url( the_steam_get_option( 'option_tripadvisor_url', '#', 300 ) ); ?>"><span class="anchor-content"><?php esc_html_e( 'tripadvisor', 'thesteam' ); ?></span>
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-tripadvisor fa-stack-1x"></i>
							</a>
						</span>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<!-- contact form container -->
		<div class="column column-special small-4 show-for-medium-up">
			<div class="footer-right-column">
				<div class="footer-right-title white">
					<?php $footer_subtitle_right = the_steam_get_theme_mod( 'the_steam_footer_subtitle_right', ' ' ); ?>
					<?php if ( ' ' !== $footer_subtitle_right || is_customize_preview() ) : ?>
	                    <h4 class="left-title <?php if ( 'yes' !== the_steam_get_option( 'option_contact_form' ) ) { echo 'ts-align-center';
}; ?>" id="contact-paragraph-title"><?php echo esc_html( $footer_subtitle_right ); ?></h4>
					<?php endif; ?>
				</div>
				<?php if ( 'yes' === the_steam_get_option( 'option_contact_form' ) && the_steam_check_plugin_active() ) : ?>
				<div class="contact-fields-footer">
					<div class="email">
						<div class="email">
							<input type="text"  id="mesage-email" placeholder="<?php echo esc_attr( __('Email Address', 'thesteam') ); ?>" class="footer-text field-background field-background-special" />
						</div>
					</div>
					<div class="subject">
						<div class="email">
							<input type="text"  id="subject-text" placeholder="<?php echo esc_attr( __('Subject', 'thesteam' ) ); ?>"  class="footer-text field-background field-background-special" />
						</div>
					</div>
					<div class="message-area">
						<textarea rows="5" id="message-body" placeholder="<?php echo esc_attr( __('Message', 'thesteam' ) ); ?>" class="field-background  field-background-special" ></textarea>
					</div>
					<div class="submit-footer">
						<input type="submit" class="message-button" value="<?php echo esc_attr( __('Send message', 'thesteam') ); ?>">
					</div>
					<?php else : ?>
					<?php $footer_paragraph = the_steam_get_theme_mod( 'the_steam_footer_paragraph', ' ' ); ?>
	                    <?php if ( ' ' !== $footer_paragraph || is_customize_preview() ) : ?>
		                    <p class="footer-text" id="footer-text"><?php echo esc_html( the_steam_get_elipsis( $footer_paragraph, 550 ) );?></p>
	                    <?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="subfooter">
		<hr class="last-hr">
		<!-- subfooter container features City, Restaurant cuisine and copyright information -->
		<div class="subfooter-container">
			<div class="subfooter-first-line white">
				<?php $cuisine = the_steam_get_option( 'option_cuisine', '#' );?>
				<?php if ( '#' !== $cuisine ) : ?>
					<div class="restaurant-type show-for-large-up" id="restaurant-cuisine"><?php echo esc_html( the_steam_get_elipsis( $cuisine ) ); ?></div>
					<div class="subfooter-dot show-for-large-up" >|</div>
				<?php endif; ?>
				<?php $city = the_steam_get_option( 'option_city', '#' );?>
				<?php if ( '#' !== $city ) : ?>
					<div class="subfooter-adress show-for-large-up">
						<?php echo esc_html( the_steam_get_elipsis( $city, 30 ) ); ?>
					</div>
					<div class="subfooter-dot show-for-large-up" >|</div>
				<?php endif; ?>
				<div class="subfooter-copyright"><i class="fa fa-copyright subfooter-symbol" aria-hidden="true"></i> <?php esc_html_e( 'All rights reserved - ', 'thesteam' );
				echo ' ';?>
				<?php echo esc_html( the_steam_get_elipsis( get_bloginfo( 'name' ), 35 ) ); ?>
				<?php echo esc_html( ' ' . date( 'Y' ) ); ?>
				</div>
			</div>
			<!-- tagline -->
			<div class="subfooter-second-line white">
				<div class="subfooter-creator"> <span class="blue-text"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span></div>
			</div>
		</div>
		<div class="subfooter-logo white show-for-large-up ts-clearfix">
			<a class="footer-bottom-logo menu-scroll no-load" href="<?php echo esc_url( home_url( '/' ) ); ?>#home-jumbotron">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</a>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
