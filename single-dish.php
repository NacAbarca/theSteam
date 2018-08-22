<?php
/**
 * Single Dish File Doc Comment
 *
 * This file displays a single post that belong to the dish type taxonomy
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
<!-- single dish - dish is a custom post type -->
<main id="main">
	<?php get_template_part( 'parts/mobile','menu' ); ?>
	<div class="row row-first-section ts-clearfix">
		<!-- featured image -->
		<div class="large-12 columns large-image ts-fixed-image ts-clearfix">
			<div id="header-bg"></div>
			<?php get_template_part( 'parts/blog', 'social-links' ); ?>
		</div>
	</div>
	<!-- custom post title -->
	<a class="title-line title-admin title-top show-for-large-up" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img id="blog-header-logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a>
	<div class="aligner subaligner">
		<h1 class="logo first-logo-line ellipsis"><?php echo esc_html( the_steam_get_elipsis( get_the_title(), 100 ) ); ?></h1>
		<hr class="line first-logo-line">
		<!-- custom post category -->
		<h2 class="logo second-logo-line ellipsis-second">
			<?php echo esc_html( the_steam_current_post_category_get_name() ); ?>
		</h2>
	</div>
	<!-- menu -->
	<nav class="blog-navbar navbar-transparent show-for-large-up">
		<div class="container">
			<div id="navbar">
				<div class="menu-background"></div>
				<ul class="menu-items-align">
				<?php get_template_part( 'parts/dish', 'categories-menu' ); ?>
				</ul>
			</div>
		</div>
	</nav>
	<?php get_template_part( 'parts/blog','post' ); ?>
<!-- Start dynamic -->
</main>
<?php get_footer(); ?>
