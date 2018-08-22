<?php
/**
 * Front Page File Doc Comment
 *
 * This file contains TheSteam front page
 *
 * Template Name: The Steam FrontPage
 *
 * @category Template File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 * Text Domain: thesteam
 **/

?>

<?php get_header();?>
<main>
<!-- mobile menu -->
<?php get_template_part( 'parts/mobile', 'menu' );?>
<!-- jumbotron - full page image -->
<?php get_template_part( 'parts/frontpage', 'jumbotron' ); ?>
<!-- frontpage menu -->
<?php get_template_part( 'parts/frontpage', 'menu' ); ?>
<!-- first section - about restaurant -->
<?php get_template_part( 'parts/frontpage', 'section1' ); ?>
<!-- second section - parallax image -->
<?php get_template_part( 'parts/frontpage', 'parallax-img2' );
if ( the_steam_check_plugin_active() ) : ?>
	<!-- second section - menu book description -->
	<?php $dishtypes_part = 'yes' === the_steam_get_option( 'option_4_main_categories' ) ? 'section2' : 'section2-carousel'; ?>
	<?php get_template_part( 'parts/frontpage', $dishtypes_part ); ?>
	<!-- section 4 - menu book carousel -->
	<?php get_template_part( 'parts/frontpage', 'section4' );
endif;
if ( 'yes' === the_steam_get_option( 'option_carousel_visible' ) ) : ?>
	<!-- blog heading section -->
	<?php get_template_part( 'parts/frontpage', 'section5' ); ?>
	<!-- blog section - latest posts are featured in a carousel -->
	<?php get_template_part( 'parts/frontpage', 'blog-carousel' );
endif;
?>
<!-- reservations section -->
<?php get_template_part( 'parts/frontpage', 'reservations' ); ?>
<!-- gallery section -->
<?php if ( 'yes' === the_steam_get_option( 'option_gallery_enabled' ) ) : ?>
	<?php get_template_part( 'parts/frontpage', 'gallery' ); ?>
<?php endif; ?>
<!-- map -->
<?php get_template_part( 'parts/frontpage', 'map' ); ?>
</main>
<?php get_footer(); ?>
