<?php
/**
 * Frontpage Section 1 File Doc Comment
 *
 * This template part displays a short description of the restaurant along with four images
 * which are either set manually or grabbed from the owner's Instagram account
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- section one - restaurant description -->
<section class="white-section1 <?php if ( 'yes' !== the_steam_get_option( 'option_enable_about_section' ) ) { echo esc_attr( 'hide-for-small-up' ); } ?>">
	<div id="white-section1wp"></div>
	<!-- curtain-effect images container - is filled either using Instagram or hand-picked images -->
	<div id="first-section-container">
		<div class="large-8 image-gallery-container">
			<div id="curtain-image1" class="fin-image the-steam-show-for-medium-up" ></div>
			<div id="curtain-image2" class="fin-image the-steam-show-for-large-up" ></div>
			<div id="curtain-image3" class="fin-image the-steam-show-for-large-up" ></div>
			<div id="curtain-image4" class="fin-image the-steam-show-for-large-up ts-show-for-large" ></div>
		</div>
		<!-- restaurant description container -->
		<?php $about_section_animation = the_steam_get_theme_mod( 'the_steam_section1_animation', 'none' ); ?>
		<div id="first-section-text" class="large-4" data-appear-top-offset="10" data-sequence="500">
			<a id="about-section"></a>
			<!-- title or a short message -->
			<div class="white-section-title <?php echo esc_attr( 'none' !== $about_section_animation ? 'about-animation-supported' : '' ); ?>" data-id="1"><h2 id="white-section-title">
			<?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_second_section_message1', the_steam_get_default_value( 'the_steam_second_section_message1' ) ), 50 ) ); ?></h2></div>
			<div id="about-diamonds-container" class="diamonds-container <?php echo esc_attr( 'none' !== $about_section_animation ? 'about-animation-supported' : '' ); ?>" data-id="2">
				<div class="under-title-symbol-ws1 ">
					<!-- design element -->
					<div class="above">
						<div class="diamond-above"></div>
						<div class="diamond-above"></div>
					</div>
					<p class="diamond under"></p>
				</div>
			</div>
			<!-- a few words about the restaurant -->
			<p class="about-text <?php echo esc_attr( 'none' !== $about_section_animation ? 'about-animation-supported' : '' ); ?>" id="about-text" data-id="3"><?php echo wp_kses( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_second_section_message2', the_steam_get_default_value( 'the_steam_second_section_message2' ) ), 720 ), the_steam_get_valid_theme_kses() ); ?></p>
		</div>
	</div>
	<!-- End Content-->
</section>
