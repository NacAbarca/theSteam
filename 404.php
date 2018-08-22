<?php
/**
 * 404 File Doc Comment
 *
 * This file is used to display the 404 error page along with some suggestions
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

get_header(); ?>
<main id="main" class="main">
	<?php get_template_part( 'parts/mobile','menu' ); ?>
		<!-- End dynamic -->
		<div class="row row-first-section">
			<!-- social pages links -->
			<div class="large-12 columns large-image ts-fixed-image">
				<div id="header-bg"></div>
				<?php get_template_part( 'parts/blog', 'social-links' ); ?>
			</div>
		</div>
		<!-- website title with link to homepage -->
		<a class="title-line title-admin title-top show-for-large-up" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="blog-header-logo"  src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a>
		<div class="aligner subaligner"><h2 class="logo first-logo-line" id="first-logo-line"><?php esc_html_e( 'Ooops!', 'thesteam' ); ?></h2>
			<hr class="line first-logo-line">
			<h4 class="logo second-logo-line" id="second-logo-line"><?php esc_html_e( 'No results found...', 'thesteam' ); ?></h4>
		</div>
		<!-- Start dynamic -->
		<div class="error-content">
			<p class="error-message"><?php esc_html_e( 'Try something from below:', 'thesteam' ); ?></p>
			<!-- a few suggested posts -->
			<nav><?php get_template_part( 'parts/blog','random-items' ); ?></nav>
		</div>
		<hr class="bottom-shadow">
</main>
<?php get_footer(); ?>
