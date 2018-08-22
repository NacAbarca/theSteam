<?php
/**
 * Front Page File Doc Comment
 *
 * This file contains the template for SiteOrigin PageBuilder
 * Please note that TheSteam theme was not created with page builder,
 * thus we do not support mixing TheSteam elements with PageBuilder elements.
 * However, if you wish you may create one or more pages that use this
 * template and use PageBuilder within this page.
 *
 * Also, please note that this feature exists solely to help you
 * implement your custom tailored solutions and we do not offer
 * support for PageBuilder related issues.
 *
 * Template Name: PageBuilder
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
<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-## -->
	<?php comments_template( '', true ); ?>
<?php endwhile;
}; // end of the loop. ?>
