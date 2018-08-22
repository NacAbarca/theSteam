<?php
/**
 * Single Page File Doc Comment
 *
 * This file is used to display a single page
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

get_header(); ?>
<!-- single page container -->
<main id="main" class="main">
	<?php get_template_part( 'parts/mobile','menu' ); ?>
	<div class="row row-first-section ts-clearfix">
		<div class="large-12 columns large-image ts-clearfix">
			<div id="header-bg"></div>
			<?php get_template_part( 'parts/blog', 'social-links' ); ?>
		</div>
	</div>
	<a class="title-line title-admin title-top show-for-large-up" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="blog-header-logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a>
	<div class="aligner subaligner">
		<?php $title = get_the_title(); ?>
		<?php if ( ! empty( $title ) ) : ?>
		<h2 class="logo first-logo-line" id="first-logo-line"><?php echo esc_html( the_steam_get_elipsis( $title, 100 ) ); ?></h2>
		<hr class="line first-logo-line">
		<?php endif; ?>
	</div>
	<?php get_template_part( 'parts/single','menu' ); ?>
	<!-- page content, same as for posts -->
	<?php get_template_part( 'parts/blog','post' ); ?>
</main>
<?php get_footer(); ?>
