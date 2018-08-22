<?php
/**
 * Frontpage Map Doc Comment
 *
 * This template part displays a map centered to the restaurant's location
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<section class="fifthImage <?php if ( 'yes' === the_steam_get_option( 'option_disable_map' ) ) { echo esc_attr( 'hide-for-small-up' ); } ?>">
	<a class="no-load" id="map-section"></a>
	<hr class="map-hr-blue"/>
	<div class="map-section" id="map-container">
		<div id="map-button">
			<i class="fa fa-map-marker refresh-button" aria-hidden="true" ></i>
		</div>
		<!-- restaurant location is pinpointed on the map -->
		<div id="map" class="map"
			 data-longitude="<?php echo esc_js( the_steam_get_option( 'option_map_longitude', '-74.00296211242676', 500 ) ); ?>"
			 data-latitude="<?php echo esc_js( the_steam_get_option( 'option_map_latitude', '40.707139681781946', 500 ) ); ?>"
			 data-zoom="<?php echo esc_js( the_steam_get_option( 'option_map_zoom', '5' ) ); ?>">
		</div>
		<div class="map-overlay">
			<div class="map-logo-position">
				<div class="map-logo-bg" id="map-bg">
					<!-- few words above the map -->
					<p class="over-map-logo first-map-line" id="map-restaurant-details"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_map_section_msg_line1', the_steam_get_default_value( 'the_steam_map_section_msg_line1' ) ), 40 ) );?></p>
					<p class="over-map-logo second-map-line" id="map-restaurant-location"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_map_section_msg_line2', the_steam_get_default_value( 'the_steam_map_section_msg_line2' ) ), 30 ) );?></p>
				</div>
			</div>
		</div>
	</div>
</section>
