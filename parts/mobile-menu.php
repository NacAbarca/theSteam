<?php
/**
 * Mobile Menu Doc Comment
 *
 * This template part displays the mobile menu
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- mobile menu open/close icon -->
<nav class="over-menu-visible hide-for-large-up" id="ts-mobile-menu">
	<div class="over-ul ts-clearfix">
		<div class="mobile-menu-title hide-for-large-up"><a class="title-line bloglist-menu-color" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="navbar-logo-small" class="title-line bloglist-menu-color"  src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>"/></a></div>
		<div class="over-menu-button"><a href="#" name="mobile-menu-open" id="mobile-menu-open" class="btn-open no-load"><span class="anchor-content"><?php esc_html_e( 'Menu', 'thesteam' ); ?></span></a></div>
	</div>
</nav>
<!-- mobile menu overlay, is shown by clicking on the button -->
<div class="overlay">
	<div class="wrap">
		<ul class="wrap-nav">
			<?php if ( ! is_front_page() /* provided static front page already has home menu item */ || is_home() && ! is_page() ) : ?>
				<li class="over-menu-li  mobile-about-button">
					<!-- home icon with link -->
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-menu-icon-title"><i class="fa fa-home fa-lg-mobile-menu" aria-hidden="true"></i>
						<?php esc_html_e( 'HOME', 'thesteam' ); ?>
					</a>
				</li>
			<?php endif; ?>
			<!-- mobile menu elements are provided by wordpress wp_nav_menu() -->
			<?php the_steam_frontpage_mobile_menu(); ?>
			<?php if ( ! the_steam_is_taxonomy() && 'dish' !== get_post_type() ) : ?>
				<li class="over-menu-li mobile-column">
					<ul>
					<?php
						$index      = 0;
						$menu_items = array();
					if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['blog-menu'] ) ) {
						$menu = wp_get_nav_menu_object( $locations['blog-menu'] );
						$menu_items = wp_get_nav_menu_items( false !== $menu ? $menu->term_id : '' );

						if ( false === $menu_items ) {
							$menu_items = array();
						}
					}
					foreach ( (array) $menu_items as $key => $menu_item ) : ?>
							<li class="over-menu-li mobile-column">
								<a class="no-load" href="<?php echo esc_url( $menu_item->url ); ?>">
									<?php echo esc_html( ucfirst( $menu_item->title ) ); ?>
								</a>
							</li>
							<?php
							if ( $index ++ > 6 ) {
								break;
							}
						endforeach;
					?>
					</ul>
				</li>
			<?php else :
				$tax_terms = the_steam_get_terms();
	foreach ( $tax_terms as $term ) : ?>
					<li class="over-menu-li mobile-column">
						<a class="no-load" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
					</li>
				<?php endforeach;
			endif; ?>
			<?php $phone_num = the_steam_get_option( 'option_phone_number', '#' ); ?>
			<?php if ( '#' !== $phone_num && 'yes' === the_steam_get_option( 'option_phone_in_menu' ) ) : ?>
			<li class="social">
				<p class="contact-number-align"><a class="no-load" href="tel:<?php echo esc_html( $phone_num ); ?>"><?php esc_html_e( 'Call us:', 'thesteam' );?><br><span class="fa fa-phone phone-reservation-number"> <?php echo esc_html( $phone_num ); ?></span></a></p>
			</li>
			<?php endif; ?>
		</ul>
		<!-- restaurant's social pages links -->
		<div class="social">
			<?php $fb_url = the_steam_get_option( 'option_fb_url', '#', 300 ); ?>
			<?php if ( '#' !== $fb_url ) : ?>
			<a class="no-load" href="<?php echo esc_url( $fb_url ); ?>">
				<div class="social-icon-mobile"><i class="fa fa-facebook"></i><span class="anchor-content"><?php esc_html_e( 'facebook', 'thesteam' ); ?></span></div>
			</a>
			<?php endif; ?>

			<?php $tw_url = the_steam_get_option( 'option_tw_url', '#', 300 ); ?>
			<?php if ( '#' !== $tw_url ) : ?>
			<a class="no-load" href="<?php echo esc_url( $tw_url ); ?>">
				<div class="social-icon-mobile"><i class="fa fa-twitter"></i><span class="anchor-content"><?php esc_html_e( 'twitter', 'thesteam' ); ?></span></div>
			</a>
			<?php endif; ?>

			<?php $foursquare_url = the_steam_get_option( 'option_foursquare_url', '#', 300 ); ?>
			<?php if ( '#' !== $foursquare_url ) : ?>
			<a class="no-load" href="<?php echo esc_url( $foursquare_url ); ?>">
				<div class="social-icon-mobile"><i class="fa fa-foursquare"></i><span class="anchor-content"><?php esc_html_e( 'foursquare', 'thesteam' ); ?></span></div>
			</a>
			<?php endif; ?>

			<?php $instagram_url = the_steam_get_option( 'option_instagram_url', '#', 300 ); ?>
			<?php if ( '#' !== $instagram_url ) : ?>
			<a class="no-load" href="<?php echo esc_url( $instagram_url ); ?>">
				<div class="social-icon-mobile"><i class="fa fa-instagram"></i><span class="anchor-content"><?php esc_html_e( 'instagram', 'thesteam' ); ?></span></div>
			</a>
			<?php endif; ?>

			<?php $pinterest_url = the_steam_get_option( 'option_pinterest_url', '#', 300 ); ?>
			<?php if ( '#' !== $pinterest_url ) : ?>
			<a class="no-load" href="<?php echo esc_url( $pinterest_url ); ?>">
				<div class="social-icon-mobile"><i class="fa fa-pinterest"></i><span class="anchor-content"><?php esc_html_e( 'pinterest', 'thesteam' ); ?></span></div>
			</a>
			<?php endif; ?>

			<?php $tripadvisor_url = the_steam_get_option( 'option_pinterest_url', '#', 300 ); ?>
			<?php if ( '#' !== $tripadvisor_url ) : ?>
			<a class="no-load" href="<?php echo esc_url( $tripadvisor_url ); ?>">
				<div class="social-icon-mobile"><i class="fa fa-tripadvisor"></i><span class="anchor-content"><?php esc_html_e( 'tripadvisor', 'thesteam' ); ?></span></div>
			</a>
			<?php endif; ?>
		</div>
	</div>
</div>
