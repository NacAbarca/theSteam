<?php
/**
 * Single File Doc Comment
 *
 * This file displays a single post
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
<?php get_header(); ?>
<!-- single post container -->
<main id="main" class="main">
	<?php get_template_part( 'parts/mobile','menu' ); ?>
		<div class="row row-first-section ts-clearfix">
			<!-- featured image -->
			<div class="large-12 columns large-image ts-fixed-image ts-clearfix">
				<div id="header-bg"></div>
				<?php get_template_part( 'parts/blog', 'social-links' ); ?>
			</div>
		</div>
		<a class="title-line title-admin bloglist-menu-color title-top show-for-large-up" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="blog-header-logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a>
		<div class="aligner subaligner">
			<!-- post title -->
			<?php $title = get_the_title(); ?>
			<?php if ( ! empty( $title ) ) : ?>
			<h1 class="logo first-logo-line ellipsis" id="first-logo-line"><?php echo esc_html( the_steam_get_elipsis( $title , 100 ) ); ?></h1>
			<hr class="line first-logo-line">
			<?php endif; ?>
			<!-- post subtitle -->
			<h2 class="logo second-logo-line ellipsis-second" id="second-logo-line">
				<?php echo esc_html( the_steam_get_post_subtitle() ); ?>
			</h2>
		</div>
		<?php get_template_part( 'parts/single','menu' ); ?>
		<?php get_template_part( 'parts/blog','post' ); ?>
</main>
<?php get_footer(); ?>
