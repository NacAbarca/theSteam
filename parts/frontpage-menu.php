<?php
/**
 * Frontpage Menu File Doc Comment
 *
 * This template part displays the frontpage menu for large displays
 *
 * @category Navigation
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- frontpage menu container -->
<nav class="navbar navbar-default navbar-transparent fixme show-for-large-up">
	<div class="below-menu-hr">
	</div>
	<div class="container-navbar ts-clearfix">
		<!-- bootstrap responsive menu for the frontpage -->
		<div class="navbar-header ts-clearfix"><a class="no-load menu-scroll" href="#"><img id="navbar-logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a></div>
		<!-- menu elements are created using wordpress functions -->
		<div id="navbar" class="navbar-collapse collapse ts-cleafix">
			<?php the_steam_frontpage_menu(); ?>
		</div>
	</div>
</nav>
