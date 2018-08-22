<?php
/**
 * Frontpage Reservations File Doc Comment
 *
 * This template part displays reservations section
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<section id="white-section4wp" class="white-section4<?php if ( 'yes' !== the_steam_get_option( 'option_reservations_enabled' ) || ! the_steam_check_plugin_active() ) { echo esc_attr( ' hide-for-small-up' ); } ?>">
	<?php $reservations_section_animation = the_steam_get_theme_mod( 'the_steam_reservations_animation', 'none' ); ?>
<a id="reservations-section" class="no-load"></a>
<div class="res-aligner menu-book-title <?php echo esc_attr( 'none' !== $reservations_section_animation ? 'reservations-animation-supported' : '' ); ?>" id="frontpage-reservations-title">
	<!-- title and subtitle for this section -->
	<h2 class="logo-reservation" id="reservations-title"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_reservations_section_msg_line1', the_steam_get_default_value( 'the_steam_reservations_section_msg_line1' ) ), 30 ) );?></h2>
	<p class="under-blog" id="reservations-under-title"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_reservations_section_msg_line2', the_steam_get_default_value( 'the_steam_reservations_section_msg_line2' ) ), 50 ) );?></p>
	<!-- design element -->
	<div class="under-title-symbol">
		<div class="above">
			<div class="diamond-above"></div>
			<div class="diamond-above"></div>
		</div>
		<p class="under diamond" ></p>
	</div>
</div>
<!-- reservations interface container -->

<div class="reservations-wrapper-large <?php echo esc_attr( 'none' !== $reservations_section_animation ? 'reservations-animation-supported' : '' ); ?>" id="reservations-space">
	<div class="reservations-details-wrapper">
		<div class="reservations-inputs-wrapper">
			<!-- reservations date, hour and seats -->
			<div class="reservations-selectors">
				<div class="reservations-guest-num-selector reservations-even">
					<i class="fa fa-user reservations-icon fa-2x-reservations" aria-hidden="true"></i>
					<div class="res-line"></div>
					<p class="reservations-label-text"><?php esc_html_e( 'Guests', 'thesteam' ); ?></p>
					<div class="reservations-num-guest-selector-inner">
						<select class="reservations-desktop-input" id="reservations-num-guests-selector">
							<option>01</option>
							<option selected="selected">02</option>
							<option>03</option>
							<option>04</option>
							<option>05</option>
							<option>06</option>
							<option>07</option>
							<option>08</option>
							<option>09</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
						</select>
					</div>
				</div>
				<div class="reservations-spacer"></div>
				<div class="reservations-date-selector reservations-even">
					<i class="fa fa-calendar reservations-icon fa-2x-reservations" aria-hidden="true"></i>
					<div class="res-line"></div>
					<p class="reservations-label-text"><?php esc_html_e( 'Date of your visit', 'thesteam' ); ?></p>
					<input class="reservations-desktop-input" size="8" id="reservations-date-selector"/>
				</div>
				<div class="reservations-spacer"></div>
				<div class="reservations-hour-selector reservations-even">
					<i class="fa fa-clock-o reservations-icon fa-2x-reservations" aria-hidden="true"></i>
					<div class="res-line"></div>
					<p class="reservations-label-text"><?php esc_html_e( 'Time of your visit', 'thesteam' ); ?></p>
					<input class="reservations-desktop-input" size="5" id="reservations-hour-selector"/>
				</div>
			</div>
			<div class="contact-fields-block ts-cleafix">
				<div class="res-phone-input res-align-left">
					<input type="text" id="phone" />
					<label class="phone-number-placeholder"><?php esc_html_e( 'Phone Number', 'thesteam' ); ?></label>
				</div>
				<div class="res-email-input res-align-right">
					<input type="text" id="email"/>
					<label class="email-placeholder">
						<?php if ( the_steam_get_option( 'option_secondary_field' ) !== 'name' ) {
							esc_html_e( 'E-Mail', 'thesteam' );
} else if ( the_steam_get_option( 'option_secondary_field' ) === 'name' ) {
	esc_html_e( 'Name', 'thesteam' );
}
						?></label>
				</div>
			</div>
		</div>
		<div class="reservations-spacer-wrapper-left show-for-large-up"></div>
		<div class="reservations-spacer-wrapper-right show-for-large-up"></div>
		<div class="reservations-presentation-wrapper res-right-text show-for-large-up">
			<div class="reservations-text-container">
				<p class="res-right-title reservations-subtitle"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_reservations_section_subtitle', the_steam_get_default_value( 'the_steam_reservations_section_subtitle' ) ), 30 ) );?></p>
				<p class="second-res-row reservations-details-line1"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_reservations_section_details1', the_steam_get_default_value( 'the_steam_reservations_section_details1' ) ), 213 ) );?></p>
				<p class="second-res-row reservations-details-line2"><?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_reservations_section_details2', the_steam_get_default_value( 'the_steam_reservations_section_details2' ) ), 65 ) );?></p>
			</div>
		</div>
		<input id="opentable-res-name" name="opentable-res-name" type="hidden" value=""/>
	</div>
	<div class="contact-fields">
		<!-- reservation submission button - triggers ajax request -->
		<div class="submit">
			<a class="reservations-submit reservations-effect no-load"><?php esc_html_e( 'BOOK NOW', 'thesteam' ); ?></a>
		</div>
	</div>
</div>
<!-- end reservations interface container -->
</section>
