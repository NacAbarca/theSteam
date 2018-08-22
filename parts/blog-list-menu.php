<?php
/**
 * Blog List Menu Doc Comment
 *
 * This template part displays a list of four major types of dishes along with descriptive images
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- menu used in the list of blog entries page -->
<nav class="blog-navbar navbar-transparent show-for-large-up">
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
<!-- end navigation menu -->
