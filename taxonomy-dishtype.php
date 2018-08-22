<?php
/**
 * Taxonomy Dish Type File Doc Comment
 *
 * This file displays a list of posts that belong to the dish type taxonomy
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
<main>
<?php get_template_part( 'parts/mobile', 'menu' ); ?>
	<!-- header image - is customizable -->
	<section class="row row-first-section ts-clearfix">
		<div class="large-12 columns large-image ts-fixed-image ts-clearfix" id="dishlist-header-image">
			<div id="header-bg"></div>
			<?php get_template_part( 'parts/blog', 'social-links' ); ?>
		</div>
	</section>
	<!-- jumbotron title -->
	<a class="title title-line bloglist-menu-color title-admin title-top show-for-large-up" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="blog-header-logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a>
	<section class="aligner subaligner">
		<h1 class="logo first-logo-line" id="dish-first-logo-line"><?php the_steam_print_current_selected_dishtype(); ?></h1>
		<hr class="line first-logo-line">
		<h2 class="logo second-logo-line" id="dish-second-logo-line"><?php echo esc_html( the_steam_get_elipsis( wp_strip_all_tags( category_description() ), 80 ) ); ?></h2>
	</section>
	<!-- menu - contains dish types for easy navigation -->
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
	<?php the_steam_setup_dish_query(); ?>
	<section class="row row-post-list large-screen-width">
		<div class="large-8 row-top-align columns" id="main-blog-list-column">
	<?php if ( have_posts() ) : ?>
			<!-- Start of the main loop. -->
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'parts/content','post' );
			endwhile; ?>
		<?php get_template_part( 'parts/blog', 'pagination' ); ?>
	<?php else : ?>
		<p class="no-post-found"><?php esc_html_e( 'Sorry, no posts matched your criteria. Please try other categories from above.', 'thesteam' ); ?></p>
	<?php endif; ?>
		</div>
		<!-- special sidebar for custom post type dish -->
		<?php get_sidebar( 'dishes' ); ?>
	</section>
</main>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
