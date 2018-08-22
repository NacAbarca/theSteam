<?php
/**
 * Index File Doc Comment
 *
 * This file is used to display a list of posts
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

the_steam_set_is_index();
get_header(); ?>
<main>
	<!-- mobile menu -->
	<?php get_template_part( 'parts/mobile','menu' );?>
	<div class="row row-first-section ts-clearfix">
		<!-- header image or jumbotron -->
		<div class="large-12 columns large-image ts-fixed-image ts-clearfix" id="bloglist-header-image">
			<div id="header-bg"></div>
			<!-- social pages links -->
			<?php get_template_part( 'parts/blog', 'social-links' ); ?>
		</div>
	</div>
	<!-- homepage link -->
	<a class="title title-line bloglist-menu-color title-admin title-top show-for-large-up" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="blog-header-logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a>
	<div class="aligner subaligner">
		<!-- current selected category -->
		<h1 class="logo first-logo-line" id="first-logo-line">
			<?php
			$delimit = true;
			if (  is_search() ) {
				echo esc_html( get_search_query() );
			} else if ( is_author() ) {
				echo esc_html( get_the_author() );
			} else if ( is_archive() ) {
				echo esc_html( get_the_archive_title() );
			} else {
				if ( '1' !== the_steam_get_current_category() && '' !== the_steam_get_current_category() ) {
					echo esc_html( the_steam_get_current_category() );
				} else {
					if ( '#' !== the_steam_get_theme_mod( 'the_steam_blog_list_title', '#' ) ) {
						echo esc_html( the_steam_get_theme_mod( 'the_steam_blog_list_title' ) );
					} else {
						$delimit = false;
					}
				}
			} ?>
		</h1>
		<?php if ( $delimit ) : ?>
		<hr class="line first-logo-line"/>
		<!-- category description -->
		<h2 class="logo second-logo-line"  id="second-logo-line">
		<?php echo esc_html( the_steam_get_elipsis( wp_strip_all_tags( category_description() ), 40, '' ) ); ?>
		</h2>
		<?php endif; ?>
	</div>
	<!-- menu -->
	<?php get_template_part( 'parts/blog-list','menu' ); ?>
	<div class="row row-post-list large-screen-width ts-clearfix">
		<div class="large-8 row-top-align columns" id="main-blog-list-column">
			<!-- search results - if the case -->
			<?php if ( is_search() ) : ?>
				<div class="search-results">
					<p class="search-results-line"><?php esc_html_e( 'Search results: ', 'thesteam' ); ?></p>
				</div>
			<?php endif; ?>
			<?php if ( have_posts() ) : ?>
				<!-- Start of the main loop. -->
					<section class="section-container">
						<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'parts/content','post' );
						 endwhile; ?>
					</section>
					<?php get_template_part( 'parts/blog', 'pagination' ); ?>
				<!-- End of the main loop. -->
			<?php else : ?>
					<p class="no-post-found"><?php esc_html_e( 'Sorry, no posts matched your criteria. Please try other categories from above.', 'thesteam' ); ?></p>
			<?php endif; ?>
		</div>
	<?php get_sidebar(); ?>
	</div>
</main>
<?php get_footer();?>
