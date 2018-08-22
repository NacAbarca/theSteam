<?php
/**
 * Frontpage Section 5 Menu Doc Comment
 *
 * This section is a template part that contains a short entry message for the list of blog entries presented in the form of a carousel.
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- blog title and subtitle container -->
<section id="t25image" class="t25image mobile-bottom-align ts-fixed-image <?php if ( 'yes' !== the_steam_get_option( 'option_carousel_visible' ) ) { echo esc_attr( ' hide-for-small-up' ); } ?>">
	<a id="blog-section"></a>
	<div class="blog-image-aligner menu-book-title blog-title-top-height">
		<!-- blog title -->
		<h2 class="logo-blog"><a class="logo-blog" id="blog-section-title" href="<?php echo esc_url( get_permalink( get_page_by_title( esc_html__( 'Category List', 'thesteam' ) ) ) ); ?>"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_fifth_section_msg_line1', the_steam_get_default_value( 'the_steam_fifth_section_msg_line1' ) ), 20 ) );?></a></h2>
		<!-- blog subtitle -->
		<p class="under-blog" id="blog-section-under-title"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_fifth_section_msg_line2', the_steam_get_default_value( 'the_steam_fifth_section_msg_line2' ) ), 40 ) );?></p>
		<!-- design element -->
		<div class="under-title-symbol">
			<div class="above">
				<div class="diamond-above"></div>
				<div class="diamond-above"></div>
			</div>
			<p class="under diamond"></p>
		</div>
	</div>
</section>
