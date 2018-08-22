<?php
/**
 * Frontpage Parallax Image 2 File Doc Comment
 *
 * This template part displays the second image with parallax effect
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- menu book heading - features parallax image and a few words on top -->
<section class="second-image" <?php if ( 'yes' !== the_steam_get_option( 'option_enable_parallax_image_2' ) ) { echo 'style="display: none;" ';}; ?>>
	<div id="second-image-container">
		<!-- parallax image -->
		<img alt="Second parallax image" class="parallax-image2" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_second_image', '#' ) ) ?>"/>
	</div>
	<a href="#" id="parallax-helper2"></a>
	<!-- short title -->
	<div class="image-aligner">
		<h1 class="logo-third-section" id="third-section-msg"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_third_section_msg_line1', the_steam_get_default_value( 'the_steam_third_section_msg_line1' ) ), 40 ) ); ?></h1>
		<p class="second-image-under-title" id="third-section-msg2"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_third_section_msg_line2',  the_steam_get_default_value( 'the_steam_third_section_msg_line2' ) ), 90 ) ); ?></p>
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
