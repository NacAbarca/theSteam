<?php
/**
 * Single Menu Doc Comment
 *
 * This template part displays the menu for single entries. This menu is filled with post categories
 * and also contains a link to a page filled with categories
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>

<nav class="blog-navbar navbar-transparent show-for-large-up">
	<!-- single blog entry menu container -->
	<div class="container">
		<div id="navbar">
			<div class="menu-background"></div>
			<ul class="menu-items-align">
				<?php if ( 'posts' === get_option( 'show_on_front' ) ) : ?>
					<li class="menu-bloglist bloglist-menu-color"><a class="menu-topitem bloglist-menu-color" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'thesteam' ); ?></a></li>
					<li class="menu-bloglist bloglist-menu-color"><p class="menu-topitem bloglist-menu-color">|</p></li>
				<?php endif; ?>
				<!-- list all menu items -->
				<?php the_steam_blog_list_menu(); ?>
			</ul>
		</div>
	</div>
</nav>
