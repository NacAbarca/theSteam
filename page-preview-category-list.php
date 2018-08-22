<?php
/**
 * Front Page File Doc Comment
 *
 * This file displays all post categories as a list
 *
 * Template Name: TheSteam All Categories
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
<?php get_header(); ?>
<!-- all categories page template -->
<main id="main" class="main">
	<?php get_template_part( 'parts/mobile','menu' ); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="row row-first-section ts-clearfix">
		<div class="large-12 columns large-image ts-fixed-image ts-clearfix" id="all-categories-header">
			<div id="header-bg"></div>
			<?php get_template_part( 'parts/blog', 'social-links' ); ?>
		</div>
	</div>
	<a class="title-line title-admin title-top show-for-large-up" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="blog-header-logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_menu_logo', the_steam_get_default_value( 'the_steam_menu_logo' ) ) ); ?>" /></a>
	<div class="aligner subaligner"><h2 class="logo first-logo-line" id="first-logo-line"><?php echo esc_html( get_the_title() ); ?></h2>
		<hr class="line first-logo-line">
	</div>
	<?php get_template_part( 'parts/single','menu' ); ?>
	<div class="row medium-8 large-7 columns all-categories-container">
		<article class="blog-post-content">
			<header class="all-categories-header">
				<p class="post-title"><?php esc_html_e( 'Categories preview', 'thesteam' ); ?></p>
				<hr class="categories-title-hr">
				<p class="post-subtitle"><?php esc_html_e( 'Browse through all categories', 'thesteam' ); ?></p>
			</header>
			<!-- categories list container - arranged dynamically with freewall script-->
			<div id="all-categories-content" class="free-wall">
				<?php $categories = get_categories( array( 'orderby' => 'id', 'order' => 'ASC', 'parent' => 0 ) ); ?>
				<?php foreach ( $categories as $category ) : ?>
					<!-- category element -->
					<a href="<?php echo esc_attr( get_category_link( $category->term_id ) ); ?>">
						<div class="brick brick-category-<?php echo esc_attr( $category->slug ); ?>">
							<div class="all-category-details">
								<span class="category-title">
									<span class="title-border"><?php echo esc_html( the_steam_get_elipsis( $category->name, 34 ) ); ?></span>
								</span>
								<span class="category-description">
									<?php echo esc_html( the_steam_get_elipsis( $category->description, 340 ) ); ?>
								</span>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</article>
	</div>
	<?php endwhile; ?>
<?php endif; ?>
</main>
<?php get_footer(); ?>
