<?php
/**
 * Blog Social Links File Doc Comment
 *
 * This template part displays a list of social icons at the top of the page
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @License URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<nav class="nav-bar right">
	<!-- social links to restaurant's pages are displayed in the upper right corner on the blog -->
	<ul class="button-group show-for-large-up">
		<li><a class="no-load blog-menu-social-icon" href="<?php echo esc_url( the_steam_get_option( 'option_fb_url', '#', 300 ) ); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'facebook', 'thesteam' ); ?></span>
				<div class="bloglist-menu-color social-icon button icon-fontsize"><i class="bloglist-menu-color fa fa-facebook fa-lg"></i></div>
			</a>
		</li>
		<li><a class="no-load blog-menu-social-icon" href="<?php echo esc_url( the_steam_get_option( 'option_tw_url', '#', 300 ) ); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'twitter', 'thesteam' ); ?></span>
				<div class="bloglist-menu-color social-icon button icon-fontsize"><i class="bloglist-menu-color fa fa-twitter fa-lg"></i></div>
			</a>
		</li>
		<li><a class="no-load blog-menu-social-icon" href="<?php echo esc_url( the_steam_get_option( 'option_instagram_url', '#', 300 ) ); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'instagram', 'thesteam' ); ?></span>
				<div class="bloglist-menu-color social-icon button icon-fontsize"><i class="bloglist-menu-color fa fa-instagram fa-lg"></i></div>
			</a>
		</li>
		<li><a class="no-load blog-menu-social-icon" href="<?php echo esc_url( the_steam_get_option( 'option_foursquare_url', '#', 300 ) ); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'foursquare', 'thesteam' ); ?></span>
				<div class="bloglist-menu-color social-icon button icon-fontsize"><i class="bloglist-menu-color fa fa-foursquare fa-lg"></i></div>
			</a>
		</li>
		<li><a class="no-load blog-menu-social-icon" href="<?php echo esc_url( the_steam_get_option( 'option_pinterest_url', '#', 300 ) ); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'pinterest', 'thesteam' ); ?></span>
				<div class="bloglist-menu-color social-icon button icon-fontsize"><i class="bloglist-menu-color fa fa-pinterest fa-lg"></i></div>
			</a>
		</li>
		<li><a class="no-load blog-menu-social-icon" href="<?php echo esc_url( the_steam_get_option( 'option_tripadvisor_url', '#', 300 ) ); ?>" target="_blank"><span class="anchor-content"><?php esc_html_e( 'tripadvisor', 'thesteam' ); ?></span>
				<div class="bloglist-menu-color social-icon button icon-fontsize"><i class="bloglist-menu-color fa fa-tripadvisor fa-lg"></i></div>
			</a>
		</li>
	</ul>
</nav>
