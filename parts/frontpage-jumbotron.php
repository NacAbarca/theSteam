<?php
/**
 * Frontpage Jumbotron Doc Comment
 *
 * This file renders a large header image on the theme's frontpage
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 **/

?>
<section class="hero first-image" id="hero-image">
	<a id="home-jumbotron"></a>
	<!-- frontpage header image -->
	<div id="first-image-container">
		<?php if ( 'youtube' !== the_steam_get_option( 'option_frontpage_jumbotron_video' ) && 'html5' !== the_steam_get_option( 'option_frontpage_jumbotron_video' ) ) : ?>
		<?php $header_img = get_header_image(); ?>
		<img alt="Jumbotron parallax image" id="parallax-jumbotron" class="parallax-jumbotron <?php echo esc_attr( the_steam_get_theme_mod( 'the_steam_frontpage_header_animation', '' ) ); ?>" src="<?php echo esc_url( ! empty( $header_img ) ? $header_img : '#' ); ?>"/>
		<?php elseif ( 'youtube' === the_steam_get_option( 'option_frontpage_jumbotron_video' ) ) : ?>
			<div class="video-background">
				<div class="video-foreground">
					<iframe src="<?php echo esc_url( the_steam_get_option( 'option_youtube_video_url', '#', 600 ) ); ?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		<?php elseif ( 'html5' === the_steam_get_option( 'option_frontpage_jumbotron_video' ) ) :  ?>
			 <video width="300" height="150" id="parallax-jumbotron" class="parallax-jumbotron video" autobuffer autoplay="autoplay" loop="loop" muted="">
	             <source src="<?php echo esc_url( get_template_directory_uri() . '/inc/header/header.mp4' ); ?>" type="video/mp4" />
	             <source src="<?php echo esc_url( get_template_directory_uri() . '/inc/header/header.ogv' ); ?>" type="video/ogg" />
	             <source src="<?php echo esc_url( get_template_directory_uri() . '/inc/header/header.webm' ); ?>" type="video/webm" />
					<?php esc_html_e( 'Your browser does not support HTML5 video', 'thesteam' ); ?>
			 </video>
		<?php endif; ?>
	</div>
	<div class="aligner">
		<div id="subaligner" class="subaligner">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="logo-image">
						<!-- frontpage logo -->
						<img class="first-logo logo-animation-supported" alt="First logo" src="<?php echo esc_url( the_steam_get_theme_mod( 'the_steam_logo1', the_steam_get_default_value( 'the_steam_logo1' ) ) ); ?>">
					</div>
					<!-- frontpage may have 3 lines of text alternatively -->
					<p id="before-header-text" class="logo-first-line first-word logo-text-general"><?php echo esc_html( the_steam_get_theme_mod( 'the_steam_first_section_msg_line1', the_steam_get_default_value( 'the_steam_first_section_msg_line1' ) ) ); ?></p>
					<p id="header-text" class="logo-second-line the logo-text-general"><?php echo esc_html( the_steam_get_theme_mod( 'the_steam_first_section_msg_line2', the_steam_get_default_value( 'the_steam_first_section_msg_line2' ) ) ); ?></p>
					<hr class="first-logo-hr logo-text-general">
					<p id="subheader-text" class="logo-third-line steam logo-text-general"><?php echo esc_html( the_steam_get_theme_mod( 'the_steam_first_section_msg_line3', the_steam_get_default_value( 'the_steam_first_section_msg_line3' ) ) ); ?></p>
				</a>
		</div>
	</div>
</section>
<!-- arrow for navigating to next section -->
<div class="arrow-down" id="arrow-down">
	<div class="go-down-arrow bounce">
		<i class="fa-hero-down fa-angle-double-down " aria-hidden="true"></i>
	</div>
</div>
