<?php
/**
 * Customizer File Doc Comment
 *
 * This file is used to handle the live customization part for the theme
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

global $the_steam_defaults;
$theme_uri = get_template_directory_uri();

$the_steam_defaults = array(
	'the_steam_text_or_logo' => 'inverse',
	'the_steam_logo1' => $theme_uri . '/inc/demos/ts-logo.png',
	'the_steam_menu_logo' => $theme_uri . '/inc/demos/ts-logo-menu.png',
	'the_steam_first_section_msg_line1' => esc_html__( 'The', 'thesteam' ),
	'default_header_image' => '',
	'the_steam_first_section_msg_line1_color' => '#ffffff',
	'the_steam_dishlist_widget_color_hover_filter' => 'rgba(218,186,111,0.9)',
	'the_steam_first_section_msg_line2' => esc_html__( 'STEAM', 'thesteam' ),
	'the_steam_first_section_msg_line2_color' => '#ffffff',
	'the_steam_first_section_msg_line3' => esc_html__( 'RESTAURANT', 'thesteam' ),
	'the_steam_first_section_msg_line3_color' => '#ffffff',
	'the_steam_section2_curtain_setting' => 'normal',
	'the_steam_curtain_image1' => 'http://webdotinc.net/demos/thesteam/wp-content/uploads/2016/11/curtain-photo-1414235077428-338989a2e8c0.jpg',
	'the_steam_curtain_image2' => 'http://webdotinc.net/demos/thesteam/wp-content/uploads/2017/01/curtain-cheesecake-1578695.jpg',
	'the_steam_curtain_image3' => 'http://webdotinc.net/demos/thesteam/wp-content/uploads/2016/11/curtainpexels-photo-214859.jpg',
	'the_steam_curtain_image4' => 'http://webdotinc.net/demos/thesteam/wp-content/uploads/2017/01/curtain-pexels-photo-47412-1.jpg',
	'the_steam_second_section_message1' => esc_html__( 'A History Of Delightful Memories', 'thesteam' ),
	'the_steam_second_section_message2' => esc_html__( 'For many years we served delicious food to our customers and we hope to see you here and taste our great dishes. Our restaurant changed the way people see food for the last twenty six years and we hope you will discover our traditions and culinary choices already tested by the best reviewers in the world. Our mission is to provide the best dining experience for all our customers depending on their varied tastes. Eat smart and stay healthy with our food.', 'thesteam' ),
	'the_steam_second_section_color' => '#333',
	'the_steam_third_section_msg_line1' => esc_html__( 'Our Specialities', 'thesteam' ),
	'the_steam_third_section_msg_line1_color' => '#ffffff',
	'the_steam_third_section_msg_line2' => esc_html__( 'From fresh seafood to delicate desserts, everything looks and tastes really exquisitely.', 'thesteam' ),
	'the_steam_third_section_msg_line2_color' => '#ffffff',
	'the_steam_second_image' => '',
	'the_steam_fourth_section_msg_line1' => esc_html__( 'MENU', 'thesteam' ),
	'the_steam_fourth_section_msg_line2' => esc_html__( 'Take a journey into our specialties', 'thesteam' ),
	'the_steam_footer_subtitle_right' => esc_html__( 'SEND US A MESSAGE', 'thesteam' ),
	'the_steam_footer_subtitle_left_social' => esc_html__( 'WE ARE SOCIAL', 'thesteam' ),
	'the_steam_footer_subtitle_left' => esc_html__( 'SEND US A MESSAGE', 'thesteam' ),
	'the_steam_footer_title' => esc_html__( 'LET`S KEEP IN TOUCH', 'thesteam' ),
	'the_steam_fourth_section_msg_line1_color' => '#ffffff',
	'the_steam_fourth_section_menu_book_color' => '#ffffff',
	'the_steam_fourth_image' => '',
	'the_steam_color_scheme_setting'  => '#99CCCC',
	'the_steam_dishlist_color_scheme_setting'  => '#daba6f',
	'the_steam_dishlist_widget_color_scheme_setting'  => '#daba6f',
	'the_steam_fifth_section_msg_line1' => esc_html__( 'BLOG', 'thesteam' ),
	'the_steam_fifth_section_msg_line2' => esc_html__( 'Enjoy our finest posts!', 'thesteam' ),
	'the_steam_fifth_section_msg_line1_color' => '#333',
	'the_steam_reservations_section_msg_line1' => esc_html__( 'ONLINE RESERVATION', 'thesteam' ),
	'the_steam_reservations_section_msg_line2' => esc_html__( 'We have made your favorite dish for dinner', 'thesteam' ),
	'the_steam_reservations_section_color' => '#333',
	'the_steam_reservations_section_subtitle' => esc_html__( 'Reserve by phone', 'thesteam' ),
	'the_steam_reservations_section_details1' => esc_html__( 'We take reservations for lunch and dinner. To make a reservation, please select the date and time and fill in your contact information in the designated section or call us at (027) 8338 145 between 10 am - 6 pm.', 'thesteam' ),
	'the_steam_reservations_section_details2' => esc_html__( 'We do not book the bar area, we leave this for walk-in guests.', 'thesteam' ),
	'the_steam_reservations_section_details_color' => '#333',
	'the_steam_map_section_msg_line1' => esc_html__( 'THE FINEST RESTAURANT IN', 'thesteam' ),
	'the_steam_map_section_msg_line2' => esc_html__( 'New York City', 'thesteam' ),
	'the_steam_map_section_color' => '#99CCCC',
	'the_steam_bloglist_page_header_upper_menu_text_color' => '#ffffff',
	'the_steam_dishlist_page_header' => '',
	'the_steam_all_categories_page_header' => '',
	'the_steam_facebook_share_url' => 'https://www.facebook.com/sharer/sharer.php?u=',
	'the_steam_twitter_share_url' => 'https://twitter.com/home?status=',
	'the_steam_pinterest_share_url' => 'http://pinterest.com/pin/create/link/?url=',
	'the_steam_googleplus_share_url' => 'https://plus.google.com/share?url=',
	'import_first_image_url' => 'http://webdotinc.net/demos/thesteam/wp-content/uploads/2016/11/header-image-newest2.jpg',
	'import_second_image_url' => 'http://webdotinc.net/demos/thesteam/wp-content/uploads/2016/11/menu-book-description-dimmed.jpg',
	'import_third_image_url' => 'http://webdotinc.net/demos/thesteam/wp-content/uploads/2017/01/poza-fundal-varianta-latita-spre-stanga2.jpg',
);

if ( ! function_exists( 'the_steam_get_default_value' ) ) {
	/**
	 * Returns a default value for a specified theme setting. This is
	 * usually used when there is no value set in the customizer
	 * for that customizer setting.
	 *
	 * @param string $field Theme setting a default value should be returned for.
	 *
	 * @return string Default value for specified setting.
	 */
	function the_steam_get_default_value( $field ) {
		global $the_steam_defaults;

		if ( ! isset( $field ) ) {
			return esc_html__( 'Undefined field', 'thesteam' );
		}

		if ( ! array_key_exists( $field, $the_steam_defaults ) ) {
			return esc_html__( 'Undefined key', 'thesteam' );
		}

		return $the_steam_defaults[ $field ];
	}
}

add_action( 'customize_register', 'the_steam_add_customize_header_image' );
if ( ! function_exists( 'the_steam_add_customize_header_image' ) ) {
	/**
	 * Adds settings to the header_image section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_header_image( $wp_customize ) {

		// Cleanup customizer.
		$wp_customize->remove_section( 'static_front_page' );

		$wp_customize->add_setting(
			'the_steam_text_or_logo',
			array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'default'           => the_steam_get_default_value( 'the_steam_text_or_logo' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'the_steam_text_or_logo',
			array(
				'section' => 'header_image',
				'label'   => esc_html__( 'Text or logo', 'thesteam' ),
				'type'    => 'radio',
				'default' => 'inverse',
				'choices' => array(
					'normal'  => esc_html__( 'Text', 'thesteam' ),
					'inverse' => esc_html__( 'Logo', 'thesteam' ),
				),
			)
		);

		$wp_customize->add_setting(
			'the_steam_logo1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				/* esc_url_raw for database storing */
				'sanitize_callback' => 'esc_url_raw',
				'default'           => the_steam_get_default_value( 'the_steam_logo1' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_logo1selector',
				array(
					'label'    => esc_html__( 'Please select the main logo image (max. recommended size 250 x 360 px)', 'thesteam' ),
					'section'  => 'header_image',
					'settings' => 'the_steam_logo1',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_first_section_msg_line1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_first_section_msg_line1' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec1_msg_line1',
				array(
					'label'    => esc_html__( 'First line of text', 'thesteam' ),
					'section'  => 'header_image',
					'settings' => 'the_steam_first_section_msg_line1',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_first_section_msg_line1_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_first_section_msg_line1_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec1_msg_line1_color',
				array(
					'label'    => esc_html__( 'First line of text color', 'thesteam' ),
					'section'  => 'header_image',
					'settings' => 'the_steam_first_section_msg_line1_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_first_section_msg_line2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_first_section_msg_line2' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec1_msg_line2',
				array(
					'label'    => esc_html__( 'Second line of text', 'thesteam' ),
					'section'  => 'header_image',
					'settings' => 'the_steam_first_section_msg_line2',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_first_section_msg_line2_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_first_section_msg_line2_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec1_msg_line2_color',
				array(
					'label'    => esc_html__( 'Second line of text color', 'thesteam' ),
					'section'  => 'header_image',
					'settings' => 'the_steam_first_section_msg_line2_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_first_section_msg_line3', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_first_section_msg_line3' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec1_msg_line3',
				array(
					'label'    => esc_html__( 'Third line of text', 'thesteam' ),
					'section'  => 'header_image',
					'settings' => 'the_steam_first_section_msg_line3',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_first_section_msg_line3_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_first_section_msg_line3_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec1_msg_line3_color',
				array(
					'label'    => esc_html__( 'Third line of text color', 'thesteam' ),
					'section'  => 'header_image',
					'settings' => 'the_steam_first_section_msg_line3_color',
				)
			)
		);
	}
}


add_action( 'customize_register', 'the_steam_add_customize_animations_section' );
if ( ! function_exists( 'the_steam_add_customize_animations_section' ) ) {
	/**
	 * Adds settings to the 'Animations' section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_animations_section( $wp_customize ) {

		$logo_animations_list = array(
								esc_attr( 'none' )  => esc_attr( 'none' ),
								esc_attr( 'fadeIn' ) => esc_attr( 'Fade In' ),
								esc_attr( 'fadeInUpShort' ) => esc_attr( 'Fade In Short' ),
								esc_attr( 'fadeInUp' ) => esc_attr( 'Fade In Up' ),
		                        esc_attr( 'fadeInUpBig' ) => esc_attr( 'Fade In Up Big' ),
		                        esc_attr( 'lightSpeedIn' ) => esc_attr( 'Light Speed In' ),
		                        esc_attr( 'rotateIn' ) => esc_attr( 'Rotate In' ),
								esc_attr( 'rotateInDownLeft' ) => esc_attr( 'Rotate In Down Left' ),
		                        esc_attr( 'rotateInDownRight' ) => esc_attr( 'Rotate In Down Right' ),
		                        esc_attr( 'rotateInUpLeft' ) => esc_attr( 'Rotate In Up Left' ),
		                        esc_attr( 'rotateInUpRight' ) => esc_attr( 'Rotate In Up Right' ),
		                        esc_attr( 'rollIn' ) => esc_attr( 'Roll In' ),
		                        esc_attr( 'zoomIn' ) => esc_attr( 'Zoom In' ),
		                        esc_attr( 'zoomInDown' ) => esc_attr( 'Zoom In Down' ),
		                        esc_attr( 'zoomInLeft' ) => esc_attr( 'Zoom In Left' ),
		                        esc_attr( 'zoomInRight' ) => esc_attr( 'Zoom In Right' ),
		                        esc_attr( 'zoomInUp' ) => esc_attr( 'Zoom In Up' ),
		                        esc_attr( 'slideInDown' ) => esc_attr( 'Slide In Down' ),
		                        esc_attr( 'slideInLeft' ) => esc_attr( 'Slide In Left' ),
								);

		$dishtypes_animations_list = array(
								esc_attr( 'none' )  => esc_attr( 'none' ),
								esc_attr( 'fadeIn' ) => esc_attr( 'Fade In' ),
								esc_attr( 'zoomIn' ) => esc_attr( 'Zoom In' ),
								esc_attr( 'fadeInUpShort' ) => esc_attr( 'Fade In Short' ),
							);

		$about_animations_list = $logo_animations_list;
		$reservations_animations_list = $about_animations_list;

		$wp_customize->add_section(
			'the_steam_animations', array(
				'title'           => esc_html__( 'Animations', 'thesteam' ),
				'description'     => esc_html__( 'Theme animations settings', 'thesteam' ),
				'priority'        => 3,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting('the_steam_frontpage_header_animation', array(
			'default'        => 'No',
			'transport'      => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control( 'the_steam_frontpage_header_animation_selector', array(
			'settings' => 'the_steam_frontpage_header_animation',
			'label'    => 'Enable Frontpage Header Image Animation:',
			'section'  => 'the_steam_animations',
			'type'     => 'select',
			'choices'  => array(
				esc_attr( 'img-brought-in' ) => esc_html__( 'Yes', 'thesteam' ),
				esc_attr( ' ' ) => esc_html__( 'No', 'thesteam' ),
			),
		));

		$wp_customize->add_setting('the_steam_header_animation', array(
			'default'    => 'none',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control( 'the_steam_header_animation_selector', array(
			'settings'    => 'the_steam_header_animation',
			'label'       => esc_html__( 'Select Header Logo Animation:', 'thesteam' ),
			'description' => esc_html__( 'Available only for Logo Image', 'thesteam' ),
			'section'     => 'the_steam_animations',
			'type'        => 'select',
			'choices'     => $logo_animations_list,
		));

		$wp_customize->add_setting('the_steam_section1_animation', array(
			'default'    => 'none',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control( 'the_steam_section1_animation_selector', array(
			'settings'    => 'the_steam_section1_animation',
			'label'       => esc_html__( 'Select About Section Animation:', 'thesteam' ),
			'description' => esc_html__( 'Available only for About Section', 'thesteam' ),
			'section'     => 'the_steam_animations',
			'type'        => 'select',
			'choices'     => $about_animations_list,
		));

		$wp_customize->add_setting('the_steam_dishtypes_animation', array(
			'default'        => 'none',
			'transport'      => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control( 'the_steam_dishtypes_animation_selector', array(
			'settings' => 'the_steam_dishtypes_animation',
			'label'    => 'Select Dish Types Animation:',
			'section'  => 'the_steam_animations',
			'type'     => 'select',
			'choices'  => $dishtypes_animations_list,
		));

		$wp_customize->add_setting('the_steam_reservations_animation', array(
			'default'    => 'none',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control( 'the_steam_reservations_animation_selector', array(
			'settings'    => 'the_steam_reservations_animation',
			'label'       => esc_html__( 'Select Reservations Section Animation:', 'thesteam' ),
			'description' => esc_html__( 'Available only for Reservations Section', 'thesteam' ),
			'section'     => 'the_steam_animations',
			'type'        => 'select',
			'choices'     => $reservations_animations_list,
		));
	}
}

add_action( 'customize_register', 'the_steam_add_customize_navbar' );
if ( ! function_exists( 'the_steam_add_customize_navbar' ) ) {
	/**
	 * Adds settings to the 'Navbar' section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_navbar( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_section_navbar', array(
				'title'           => esc_html__( 'Desktop navbar', 'thesteam' ),
				'description'     => esc_html__( 'Frontpage Desktop Navbar settings', 'thesteam' ),
				'priority'        => 3,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_navbar_filter',
			array(
				'default'     => 'rgba(255,255,255,1)',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_navbar_filter_control',
				array(
					'label'        => __( 'Menu filter color', 'thesteam' ),
					'section'      => 'the_steam_section_navbar',
					'settings'     => 'the_steam_navbar_filter',
					'show_opacity' => true, // Optional.
					'palette'      => array(
						'rgba(255,255,255,1)',
					),
				)
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_navbar_filter_stacked',
			array(
				'default'     => 'rgba(255,255,255,1)',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_navbar_filter_control_stacked',
				array(
					'label'        => __( 'Menu filter color when sticky', 'thesteam' ),
					'section'      => 'the_steam_section_navbar',
					'settings'     => 'the_steam_navbar_filter_stacked',
					'show_opacity' => true, // Optional.
					'palette'      => array(
						'rgba(255,255,255,1)',
					),
				)
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_navbar_text_stacked',
			array(
				'default'     => 'rgba(255,255,255,1)',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_navbar_items_stacked_control',
				array(
					'label'        => __( 'Navbar items colors - when sticky', 'thesteam' ),
					'section'      => 'the_steam_section_navbar',
					'settings'     => 'the_steam_navbar_text_stacked',
					'show_opacity' => true, // Optional.
					'palette'      => array(
						'rgba(255,255,255,1)',
					),
				)
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_navbar_text_unstacked',
			array(
				'default'     => 'rgba(51, 51, 51, 1)',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_navbar_items_unstacked_control',
				array(
					'label'        => __( 'Navbar items colors - when not sticky', 'thesteam' ),
					'section'      => 'the_steam_section_navbar',
					'settings'     => 'the_steam_navbar_text_unstacked',
					'show_opacity' => true, // Optional.
					'palette'      => array(
						'rgba(51, 51, 51, 1)',
					),
				)
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_navbar_items_hover_color',
			array(
				'default'     => 'rgba(124, 124, 124, 1)',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_navbar_items_hover_control',
				array(
					'label'        => __( 'Navbar items colors when hovered', 'thesteam' ),
					'section'      => 'the_steam_section_navbar',
					'settings'     => 'the_steam_navbar_items_hover_color',
					'show_opacity' => true, // Optional.
					'palette'      => array(
						'rgba(124, 124, 124, 1)',
					),
				)
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_navbar_items_hover_underline_color',
			array(
				'default'     => '#4e4e4e',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_navbar_items_underline_hover_control',
				array(
					'label'        => __( 'Navbar items underline colors when hovered (save & refresh to see changes)', 'thesteam' ),
					'section'      => 'the_steam_section_navbar',
					'settings'     => 'the_steam_navbar_items_hover_underline_color',
					'show_opacity' => true, // Optional.
					'palette'      => array(
						'#4e4e4e',
					),
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_menu_logo', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				/* esc_url_raw for database storing */
				'sanitize_callback' => 'esc_url_raw',
				'default'           => the_steam_get_default_value( 'the_steam_menu_logo' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_menu_logo_selector',
				array(
					'label'    => esc_html__( 'Please select the nav-bar logo image (max size: 250 x 48 px)', 'thesteam' ),
					'section'  => 'the_steam_section_navbar',
					'settings' => 'the_steam_menu_logo',
				)
			)
		);
	}
}

add_action( 'customize_register', 'the_steam_add_customize_about_section' );
if ( ! function_exists( 'the_steam_add_customize_about_section' ) ) {
	/**
	 * Adds settings to the 'About' section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_about_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_section2', array(
				'title'           => esc_html__( 'Restaurant description', 'thesteam' ),
				'description'     => esc_html__( 'Restaurant description section theme settings', 'thesteam' ),
				'priority'        => 3,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_section2_curtain_setting',
			array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'default'           => the_steam_get_default_value( 'the_steam_section2_curtain_setting' ),
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'the_steam_section2_curtain_setting_selector',
			array(
				'section'  => 'the_steam_section2',
				'label'    => esc_html__( 'Curtain Images', 'thesteam' ),
				'type'     => 'radio',
				'default'  => 'normal',
				'choices'  => array(
					'normal'  => esc_html__( 'Manual selection', 'thesteam' ),
					'inverse' => esc_html__( 'Instagram', 'thesteam' ),
				),
				'settings' => 'the_steam_section2_curtain_setting',
			)
		);

		$wp_customize->add_setting(
			'the_steam_instagram_api_key', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$instagram_notice = function_exists( 'curl_init' ) ? '' : esc_html__( 'Inactive! Please install PHP Curl plugin!', 'thesteam' );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_instagram_api_key_input',
				array(
					'label'    => sprintf( esc_html__( 'Instagram API KEY %s', 'thesteam' ), esc_html( $instagram_notice ) ),
					'section'  => 'the_steam_section2',
					'settings' => 'the_steam_instagram_api_key',
					'type'     => 'text',
				)
			)
		);

		/* Curtain image 1. */
		$wp_customize->add_setting(
			'the_steam_curtain_image1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_curtain_image1_selector',
				array(
					'label'    => esc_html__( 'Please select curtain image 1', 'thesteam' ),
					'section'  => 'the_steam_section2',
					'settings' => 'the_steam_curtain_image1',
				)
			)
		);

		/* End curtain image 1. */

		/* Curtain image 2. */
		$wp_customize->add_setting(
			'the_steam_curtain_image2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_curtain_image2_selector',
				array(
					'label'    => esc_html__( 'Please select curtain image 2', 'thesteam' ),
					'section'  => 'the_steam_section2',
					'settings' => 'the_steam_curtain_image2',
				)
			)
		);

		/* End curtain image 2. */

		/* Curtain image 3. */
		$wp_customize->add_setting(
			'the_steam_curtain_image3', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_curtain_image3_selector',
				array(
					'label'    => esc_html__( 'Please select curtain image 3', 'thesteam' ),
					'section'  => 'the_steam_section2',
					'settings' => 'the_steam_curtain_image3',
				)
			)
		);

		/* End curtain image 3. */

		/* curtain image 4 */
		$wp_customize->add_setting(
			'the_steam_curtain_image4', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_curtain_image4_selector',
				array(
					'label'    => esc_html__( 'Please select curtain image 4', 'thesteam' ),
					'section'  => 'the_steam_section2',
					'settings' => 'the_steam_curtain_image4',
				)
			)
		);

		/* End curtain image 4. */

		$wp_customize->add_setting(
			'the_steam_second_section_message1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_second_section_message1' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec2_msg_line2',
				array(
					'label'    => esc_html__( 'Restaurant description - title - max. 50 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_section2',
					'settings' => 'the_steam_second_section_message1',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_second_section_message2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_second_section_message2' ),

			)
		);

		$wp_customize->add_control(
			new TheSteam_Customize_About_Textarea_Control(
				$wp_customize,
				'the_steam_sec2_msg_line3',
				array(
					'label'       => esc_html__( 'Restaurant description paragraph - max. 720 characters including spaces', 'thesteam' ),
					'section'     => 'the_steam_section2',
					'settings'    => 'the_steam_second_section_message2',
					'type'        => 'textarea',
					'description' => '(Max 720 chars)',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_second_section_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_second_section_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_second_section_text_color',
				array(
					'label'    => esc_html__( 'Text color', 'thesteam' ),
					'section'  => 'the_steam_section2',
					'settings' => 'the_steam_second_section_color',
				)
			)
		);
	}
}

add_action( 'customize_register', 'the_steam_add_customize_gallery_section' );
if ( ! function_exists( 'the_steam_add_customize_gallery_section' ) ) {
	/**
	 * Adds settings to the 'Gallery' section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_gallery_section( $wp_customize ) {

		if ( 'yes' !== the_steam_get_option( 'option_gallery_enabled' ) ) {
			return;
		}

		$wp_customize->add_section(
			'the_steam_gallery', array(
				'title'           => esc_html__( 'Gallery Images', 'thesteam' ),
				'description'     => esc_html__( 'Gallery Section Images Upload', 'thesteam' ),
				'priority'        => 8,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		for ( $index = 0; $index <= 11; $index++ ) {
			/* Gallery image */
			$wp_customize->add_setting(
				'the_steam_gallery_image' . $index, array(
					'capability'        => 'edit_theme_options',
					'type'              => 'theme_mod',
					'transport'         => 'postMessage',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'the_steam_curtain_gallery_image_selector' . $index,
					array(
						'label'    => esc_html__( 'Please select an image', 'thesteam' ),
						'section'  => 'the_steam_gallery',
						'settings' => 'the_steam_gallery_image' . $index,
					)
				)
			);

			/* End Gallery image  */
		}

	}
}

add_action( 'customize_register', 'the_steam_add_customize_third_section' );
if ( ! function_exists( 'the_steam_add_customize_third_section' ) ) {
	/**
	 * Adds settings to the Menu book section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_third_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_section3', array(
				'title'           => esc_html__( 'Menu book description', 'thesteam' ),
				'description'     => esc_html__( 'Menu book description section theme settings', 'thesteam' ),
				'priority'        => 4,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_third_section_msg_line1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_third_section_msg_line1' ),

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec3_msg_line1_control',
				array(
					'label'    => esc_html__( 'Title - max. 40 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_section3',
					'settings' => 'the_steam_third_section_msg_line1',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_third_section_msg_line1_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_third_section_msg_line1_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec3_msg_line1_color',
				array(
					'label'    => esc_html__( 'Title color', 'thesteam' ),
					'section'  => 'the_steam_section3',
					'settings' => 'the_steam_third_section_msg_line1_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_third_section_msg_line2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_third_section_msg_line2' ),

			)
		);

		$wp_customize->add_control(
			new TheSteam_Customize_About_Textarea_Control(
				$wp_customize,
				'the_steam_sec3_msg_line2_control',
				array(
					'label'    => esc_html__( 'Message - max. 90 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_section3',
					'settings' => 'the_steam_third_section_msg_line2',
					'type'     => 'textarea',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_third_section_msg_line2_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_third_section_msg_line2_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec3_msg_line2_color',
				array(
					'label'    => esc_html__( 'Message color', 'thesteam' ),
					'section'  => 'the_steam_section3',
					'settings' => 'the_steam_third_section_msg_line2_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_second_image', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
				'default'           => the_steam_get_default_value( 'the_steam_second_image' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_ctrl_second_image',
				array(
					'label'    => esc_html__( 'Please select a background image', 'thesteam' ),
					'section'  => 'the_steam_section3',
					'settings' => 'the_steam_second_image',
				)
			)
		);

	}
}

add_action( 'customize_register', 'the_steam_add_customize_fourth_section' );
if ( ! function_exists( 'the_steam_add_customize_fourth_section' ) ) {
	/**
	 * Adds settings to the detailed Menu book section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_fourth_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_section4', array(
				'title'           => esc_html__( 'Menu book', 'thesteam' ),
				'description'     => esc_html__( 'Menu book section theme settings', 'thesteam' ),
				'priority'        => 5,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_fourth_section_msg_line1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_fourth_section_msg_line1' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec4_msg_line1_control',
				array(
					'label'    => esc_html__( 'Menu book title - max. 20 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_section4',
					'settings' => 'the_steam_fourth_section_msg_line1',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_fourth_section_msg_line2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_fourth_section_msg_line2' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec4_msg_line2_control',
				array(
					'label'    => esc_html__( 'Menu book subtitle - max. 40 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_section4',
					'settings' => 'the_steam_fourth_section_msg_line2',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_fourth_section_msg_line1_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_fourth_section_msg_line1_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec4_msg_line1_color',
				array(
					'label'    => esc_html__( 'Title color', 'thesteam' ),
					'section'  => 'the_steam_section4',
					'settings' => 'the_steam_fourth_section_msg_line1_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_fourth_section_menu_book_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_fourth_section_menu_book_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec4_menu_book_text_color',
				array(
					'label'    => esc_html__( 'Menu book text color', 'thesteam' ),
					'section'  => 'the_steam_section4',
					'settings' => 'the_steam_fourth_section_menu_book_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_fourth_image', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
				'default'           => the_steam_get_default_value( 'the_steam_fourth_image' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_ctrl_fourth_image_control',
				array(
					'label'    => esc_html__( 'Please select a background image', 'thesteam' ),
					'section'  => 'the_steam_section4',
					'settings' => 'the_steam_fourth_image',
				)
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_frontpage_menubook_filter',
			array(
				'default'     => 'rgba(0,0,0,0.48)',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Alpha Color Picker control.
		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_menu_book_filter_control',
				array(
					'label'         => __( 'Menu book filter color', 'thesteam' ),
					'section'       => 'the_steam_section4',
					'settings'      => 'the_steam_frontpage_menubook_filter',
					'show_opacity'  => true, // Optional.
					'palette'   => array(
						'rgba(0,0,0,0.48)',
					),
				)
			)
		);
	}
}

add_action( 'customize_register', 'the_steam_add_customize_fifth_section' );
if ( ! function_exists( 'the_steam_add_customize_fifth_section' ) ) {
	/**
	 * Adds settings to the Blog section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_fifth_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_section5', array(
				'title'           => esc_html__( 'Blog section', 'thesteam' ),
				'description'     => esc_html__( 'Blog section theme settings', 'thesteam' ),
				'priority'        => 6,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_fifth_section_msg_line1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_fifth_section_msg_line1' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec5_msg_line1',
				array(
					'label'    => esc_html__( 'Title text - max. 20 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_section5',
					'settings' => 'the_steam_fifth_section_msg_line1',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_fifth_section_msg_line2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_fifth_section_msg_line2' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_sec5_msg_line2_control',
				array(
					'label'    => esc_html__( 'Under title text - max. 40 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_section5',
					'settings' => 'the_steam_fifth_section_msg_line2',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_fifth_section_msg_line1_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_fifth_section_msg_line1_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_sec5_msg_line1_color',
				array(
					'label'    => esc_html__( 'Text color', 'thesteam' ),
					'section'  => 'the_steam_section5',
					'settings' => 'the_steam_fifth_section_msg_line1_color',
				)
			)
		);
	}
}

add_action( 'customize_register', 'the_steam_add_customize_reservations_section' );
if ( ! function_exists( 'the_steam_add_customize_reservations_section' ) ) {
	/**
	 * Adds settings to the reservations section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_reservations_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_reservations', array(
				'title'           => esc_html__( 'Reservations section', 'thesteam' ),
				'description'     => esc_html__( 'Reservations section theme settings', 'thesteam' ),
				'priority'        => 7,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_reservations_section_msg_line1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_reservations_section_msg_line1' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_reservations_msg_line1',
				array(
					'label'    => esc_html__( 'Reservations title - max. 30 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_reservations',
					'settings' => 'the_steam_reservations_section_msg_line1',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_reservations_section_msg_line2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_reservations_section_msg_line2' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_reservations_msg_line2_control',
				array(
					'label'    => esc_html__( 'Reservations under title text - max. 50 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_reservations',
					'settings' => 'the_steam_reservations_section_msg_line2',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_reservations_section_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_reservations_section_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_reservations_msg_color',
				array(
					'label'    => esc_html__( 'Title, under title - color', 'thesteam' ),
					'section'  => 'the_steam_reservations',
					'settings' => 'the_steam_reservations_section_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_reservations_section_subtitle', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_reservations_section_subtitle' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_reservations_msg_subtitle_control',
				array(
					'label'    => esc_html__( 'Subtitle text - max. 30 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_reservations',
					'settings' => 'the_steam_reservations_section_subtitle',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_reservations_section_details1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_reservations_section_details1' ),
			)
		);

		$wp_customize->add_control(
			new TheSteam_Customize_About_Textarea_Control(
				$wp_customize,
				'the_steam_reservations_msg_details1',
				array(
					'label'       => esc_html__( 'Reservations details first paragraph - max. 150 characters including spaces', 'thesteam' ),
					'section'     => 'the_steam_reservations',
					'settings'    => 'the_steam_reservations_section_details1',
					'type'        => 'textarea',
					'description' => '(Max 720 chars)',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_reservations_section_details2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_reservations_section_details2' ),
			)
		);

		$wp_customize->add_control(
			new TheSteam_Customize_About_Textarea_Control(
				$wp_customize,
				'the_steam_reservations_msg_details2',
				array(
					'label'       => esc_html__( 'Reservations details second paragraph - max. 65 characters including spaces', 'thesteam' ),
					'section'     => 'the_steam_reservations',
					'settings'    => 'the_steam_reservations_section_details2',
					'type'        => 'textarea',
					'description' => '(Max 720 chars)',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_reservations_section_details_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_reservations_section_details_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				 'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_reservations_msg_details_color',
				array(
					'label'    => esc_html__( 'Subtitle and details color', 'thesteam' ),
					'section'  => 'the_steam_reservations',
					'settings' => 'the_steam_reservations_section_details_color',
				)
			)
		);
	}
}


add_action( 'customize_register', 'the_steam_add_customize_map_section' );
if ( ! function_exists( 'the_steam_add_customize_map_section' ) ) {
	/**
	 * Adds settings to the Map section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_map_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_map', array(
				'title'           => esc_html__( 'Map section', 'thesteam' ),
				'description'     => esc_html__( 'Map section theme settings', 'thesteam' ),
				'priority'        => 8,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_map_section_msg_line1', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_map_section_msg_line1' ),

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_map_msg_line1',
				array(
					'label'    => esc_html__( 'Restaurant description - max. 40 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_map',
					'settings' => 'the_steam_map_section_msg_line1',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_map_section_msg_line2', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => the_steam_get_default_value( 'the_steam_map_section_msg_line2' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_map_msg_line2_control',
				array(
					'label'    => esc_html__( 'Restaurant location - max. 30 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_map',
					'settings' => 'the_steam_map_section_msg_line2',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_map_section_color',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_map_section_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_map_msg_color',
				array(
					'label'    => esc_html__( 'Map title and description color', 'thesteam' ),
					'section'  => 'the_steam_map',
					'settings' => 'the_steam_map_section_color',
				)
			)
		);

		$map_selection = array();

		for ( $i = 0; $i <= 63; $i++ ) {
			$map_selection[ $i ] = sprintf( esc_html__( 'Style %d', 'thesteam' ), $i );
		}

		$wp_customize->add_setting('the_steam_frontpage_map_selection', array(
			'default'        => '0',
			'transport'      => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control( 'the_steam_frontpage_map_selection_selector', array(
			'settings' => 'the_steam_frontpage_map_selection',
			'label'    => 'Frontpage Map Style',
			'section'  => 'the_steam_map',
			'type'     => 'select',
			'choices'  => $map_selection,
		));
	}
}

add_action( 'customize_register', 'the_steam_add_customize_footer_section' );
if ( ! function_exists( 'the_steam_add_customize_footer_section' ) ) {
	/**
	 * Adds settings to the Footer section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_footer_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_footer', array(
				'title'           => esc_html__( 'Footer', 'thesteam' ),
				'description'     => esc_html__( 'Footer settings', 'thesteam' ),
				'priority'        => 9,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_footer_title', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => ' ',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_footer_title_msg',
				array(
					'label'    => esc_html__( 'Footer title - max. 50 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_footer',
					'settings' => 'the_steam_footer_title',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_footer_subtitle_left', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => ' ',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_footer_subtitle_msg',
				array(
					'label'    => esc_html__( 'Footer contact title - left', 'thesteam' ),
					'section'  => 'the_steam_footer',
					'settings' => 'the_steam_footer_subtitle_left',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_footer_subtitle_left_social', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => ' ',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_footer_subtitle_social_msg',
				array(
					'label'    => esc_html__( 'Footer social icons title', 'thesteam' ),
					'section'  => 'the_steam_footer',
					'settings' => 'the_steam_footer_subtitle_left_social',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_footer_subtitle_right', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => ' ',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_footer_subtitle_right_msg',
				array(
					'label'    => esc_html__( 'Footer contact form title', 'thesteam' ),
					'section'  => 'the_steam_footer',
					'settings' => 'the_steam_footer_subtitle_right',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_footer_paragraph', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => ' ',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_footer_paragraph_msg',
				array(
					'label'    => esc_html__( 'Footer right paragraph', 'thesteam' ),
					'section'  => 'the_steam_footer',
					'settings' => 'the_steam_footer_paragraph',
					'type'     => 'text',
				)
			)
		);
	}
}

add_action( 'customize_register', 'the_steam_add_customize_color_scheme_section' );
if ( ! function_exists( 'the_steam_add_customize_color_scheme_section' ) ) {
	/**
	 * Adds settings for the color scheme
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_color_scheme_section( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_color_scheme', array(
				'title'           => esc_html__( 'Front Page Color Scheme', 'thesteam' ),
				'description'     => esc_html__( 'Modify general colors', 'thesteam' ),
				'priority'        => 9,
				'active_callback' => 'the_steam_is_frontpage',
			)
		);

		$wp_customize->add_setting(
			'the_steam_color_scheme_setting',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_color_scheme_setting' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_color_scheme_control',
				array(
					'label'    => esc_html__( 'General color selection', 'thesteam' ),
					'section'  => 'the_steam_color_scheme',
					'settings' => 'the_steam_color_scheme_setting',
				)
			)
		);
	}
}

add_action( 'customize_register', 'the_steam_add_customize_dishlist_page' );
if ( ! function_exists( 'the_steam_add_customize_dishlist_page' ) ) {
	/**
	 * Adds settings to the dish list section
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_dishlist_page( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_dishlist_page_header_settings', array(
				'title'           => esc_html__( 'Dish List Header', 'thesteam' ),
				'description'     => esc_html__( 'Dish List Header Settings', 'thesteam' ),
				'priority'        => 5,
				'active_callback' => 'the_steam_is_taxonomy',

			)
		);

		$wp_customize->add_setting(
			'the_steam_dishlist_page_header', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
				'default'           => the_steam_get_default_value( 'the_steam_dishlist_page_header' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_dishlistpage_header_img',
				array(
					'label'    => esc_html__( 'Please select header image', 'thesteam' ),
					'section'  => 'the_steam_dishlist_page_header_settings',
					'settings' => 'the_steam_dishlist_page_header',
				)
			)
		);

		$wp_customize->add_section(
			'the_steam_dishlist_color_scheme', array(
				'title'           => esc_html__( 'Color Scheme', 'thesteam' ),
				'description'     => esc_html__( 'Modify general colors', 'thesteam' ),
				'priority'        => 9,
				'active_callback' => function() { return the_steam_is_blog_entries_list() || the_steam_is_taxonomy(); },
			)
		);

		$wp_customize->add_setting(
			'the_steam_dishlist_color_scheme_setting',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_dishlist_color_scheme_setting' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_dishlist_color_scheme_control',
				array(
					'label'    => esc_html__( 'General color selection', 'thesteam' ),
					'section'  => 'the_steam_dishlist_color_scheme',
					'settings' => 'the_steam_dishlist_color_scheme_setting',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_dishlist_widget_color_scheme_setting',
			array(
				'default'           => the_steam_get_default_value( 'the_steam_dishlist_widget_color_scheme_setting' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_dishlist_widget_color_scheme_control',
				array(
					'label'    => esc_html__( 'Widgets color selection', 'thesteam' ),
					'section'  => 'the_steam_dishlist_color_scheme',
					'settings' => 'the_steam_dishlist_widget_color_scheme_setting',
				)
			)
		);

		// Alpha Color Picker setting.
		$wp_customize->add_setting(
			'the_steam_dishlist_widget_color_hover_filter',
			array(
				'default'     => 'rgba(218,186,111,0.9)',
				'type'        => 'theme_mod',
				'capability'  => 'edit_theme_options',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Alpha Color Picker control.
		$wp_customize->add_control(
			new Customize_Alpha_Color_Control(
				$wp_customize,
				'the_steam_dishlist_widget_color_hover_filter_control',
				array(
					'label'         => __( 'Hover filter color', 'thesteam' ),
					'section'       => 'the_steam_dishlist_color_scheme',
					'settings'      => 'the_steam_dishlist_widget_color_hover_filter',
					'show_opacity'  => true, // Optional.
					'palette'   => array(
						'rgba(218,186,111,0.9)',
					),
				)
			)
		);

	}
}

add_action( 'customize_register', 'the_steam_add_customize_all_categories_page', 500 );
if ( ! function_exists( 'the_steam_add_customize_all_categories_page' ) ) {
	/**
	 * Adds settings to the all categories page
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_add_customize_all_categories_page( $wp_customize ) {

		$wp_customize->add_section(
			'the_steam_all_categories_page_header_settings', array(
				'title'           => esc_html__( 'All Categories Header', 'thesteam' ),
				'description'     => esc_html__( 'All Categories Header Settings', 'thesteam' ),
				'priority'        => 1,
				'active_callback' => 'the_steam_is_page_all_categories',

			)
		);

		$wp_customize->add_setting(
			'the_steam_all_categories_page_header', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_all_categories_header_img',
				array(
					'label'    => esc_html__( 'Please select header image', 'thesteam' ),
					'section'  => 'the_steam_all_categories_page_header_settings',
					'settings' => 'the_steam_all_categories_page_header',
				)
			)
		);

		$wp_customize->add_section(
			'the_steam_all_posts_section', array(
				'title'           => esc_html__( 'All posts header', 'thesteam' ),
				'description'     => esc_html__( 'All posts header settings', 'thesteam' ),
				'priority'        => 4,
				'active_callback' => function() { return is_home() && ! is_page();},
			)
		);

		$wp_customize->add_setting(
			'the_steam_blog_list_title', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'the_steam_blog_list_title_msg',
				array(
					'label'    => esc_html__( 'Blog Header Title - 50 characters including spaces', 'thesteam' ),
					'section'  => 'the_steam_all_posts_section',
					'settings' => 'the_steam_blog_list_title',
					'type'     => 'text',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_all_header_msg_line_color', array(
				'default'           => the_steam_get_default_value( 'the_steam_bloglist_header_msg_line_color' ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'the_steam_all_header_color',
				array(
					'label'    => esc_html__( 'Header text color', 'thesteam' ),
					'section'  => 'the_steam_all_posts_section',
					'settings' => 'the_steam_all_header_msg_line_color',
				)
			)
		);

		$wp_customize->add_setting(
			'the_steam_all_posts_page_header', array(
				'capability'        => 'edit_theme_options',
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'the_steam_all_posts_page_header_selector',
				array(
					'label'    => esc_html__( 'Please select header image', 'thesteam' ),
					'section'  => 'the_steam_all_posts_section',
					'settings' => 'the_steam_all_posts_page_header',
				)
			)
		);
	}
}

add_action( 'customize_register', 'the_steam_customizer_change_section_priorities', 50 );
if ( ! function_exists( 'the_steam_customizer_change_section_priorities' ) ) {
	/**
	 * Changes default priorities for default Wordpress customizer sections and panels
	 *
	 * @param Wp_Customize_Manager $wp_customize Wordpress Customization manager.
	 */
	function the_steam_customizer_change_section_priorities( $wp_customize ) {

		$wp_customize->get_section( 'title_tagline' )->priority = 1;
		$wp_customize->get_section( 'header_image' )->priority = 2;
		$wp_customize->get_section( 'header_image' )->active_callback = 'the_steam_is_frontpage';

		// Colors are individually customizable in their respective sections.
		$wp_customize->get_section( 'colors' )->active_callback = function() { return false;
		};

		// Custom logo or logo text are centralized in the Header Image tab.
		$wp_customize->get_control( 'custom_logo' )->active_callback = function() { return false;
		};

		$nav_menus_panel = (object) $wp_customize->get_panel( 'nav_menus' );
		$nav_menus_panel->active_callback = 'the_steam_is_frontpage';
	}
}

add_action( 'wp_enqueue_scripts', 'the_steam_customize_css' );
if ( ! function_exists( 'the_steam_customize_css' ) ) {
	/**
	 * Enqueues the dynamic layout settings chosen by the user as inline css
	 */
	function the_steam_customize_css() {

		wp_enqueue_style(
			'thesteam-footer-layout',
			get_stylesheet_directory_uri() . '/layouts/footer-layout.css', array( 'foundation' )
		);

		$customizer_css = ' .about_textarea {
            maxlength="582";
        }';

		$customizer_css .= ' #curtain-image1 {
            background-image: url("' . esc_url( the_steam_get_curtain_image( 1 ) ) . '");
        }';

		$customizer_css .= ' #curtain-image2 {
            background-image: url("' . esc_url( the_steam_get_curtain_image( 2 ) ) . '");
        }';

		$customizer_css .= ' #curtain-image3 {
            background-image: url("' . esc_url( the_steam_get_curtain_image( 3 ) ) . '");
        }';

		$customizer_css .= ' #curtain-image4 {
            background-image: url("' . esc_url( the_steam_get_curtain_image( 4 ) ) . '");
        }';

		$customizer_css .= ' #menu-book-title, #menu-section-under-title {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_fourth_section_msg_line1_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' #menu-book-title, #menu-section-under-title {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_fourth_section_msg_line1_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' .product-line, .product-description, .owl-carousel .owl-wrapper-outer {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_fourth_section_menu_book_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' .under-food-type {
            border-top-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_fourth_section_menu_book_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' .behind-menu-filter {
		    background-color: '. esc_html( the_steam_get_theme_mod( 'the_steam_frontpage_menubook_filter', 'rgba(0, 0, 0, 0.48)' ) )  .' }';

		$customizer_css .= ' .post-selector-item:hover .side-thumbs-info-widget {
		    background-color: '. esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_widget_color_hover_filter', 'rgba(218,186,111,0.9)' ) )  .' }';

		$customizer_css .= ' .first-logo {
            display: ' . ( the_steam_frontpage_setting_is( 'inverse' ) ? 'block' : 'none' ) . '
        }';

		$customizer_css .= ' .logo-text-general {
            display: ' . ( !the_steam_frontpage_setting_is( 'inverse' ) ? 'block' : 'none' ) . '
        }';

		$customizer_css .= ' .fourth-section {
            background-image: url(' . esc_url( the_steam_get_theme_mod( 'the_steam_fourth_image', the_steam_get_default_value( 'the_steam_fourth_image' ) ) ) . ');
        }';
		$customizer_css .= ' .the_steam_sec1_msg_line1 {
            maxlength="5";
        }';

		$customizer_css .= ' #subheader-text {
            color:' . esc_html( the_steam_get_theme_mod( 'the_steam_first_section_msg_line3_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' #before-header-text {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_first_section_msg_line1_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' #header-text {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_first_section_msg_line2_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' .subheader {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_second_section_message_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' #third-section-msg {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_third_section_msg_line1_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' #third-section-msg2 {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_third_section_msg_line2_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' .above, .under, .forth-line-owly, .forth-line-owly-side, .btn-open:after {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_color_scheme_setting', '#99CCCC' ) ) . ';
        }';

		$customizer_css .= ' .diamond, .below-menu-hr, .diamond-above {
            background-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_color_scheme_setting', '#99CCCC' ) ) . ';
        }';

		$customizer_css .= ' a.read-more-txt, .photo-align-selector:hover .under-selector, .comment-form p > a, .comment-author b > a, .reply > a, .comment-metadata > a, .comment-metadata span > a, a.date-line:hover, .sticky .post-title-line a, .post-title-line a, .sticky .post-title-line a:hover, .sticky .post-title-line:first-child a:hover:before, .sticky .post-title-line:first-child a:before, .sticky .post-title-line a {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .post-bottom, .read-more-btn:hover, .similar-recipes, .first-column:hover .next-post, .first-column:hover .previous-post, .first-column:hover .square  {
            background-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .read-more-btn, .trio-selector, .sticky .main-post-container {
            border-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' #triangle-down, .next-post, .previous-post, .triangle-right:after, .triangle-right-2:after, .triangle-left:after, .triangle-left-2:after, .square {
            border-top-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .next-post, .triangle-icon-right > i, .first-column:hover #triangle-right, #triangle-right-front {
            border-left-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .previous-post, .triangle-icon-left > i, .first-column:hover #triangle-left, #triangle-left-front  {
            border-right-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .next-post, .previous-post, .square {
            border-bottom-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .search-container input, .search-container input:focus, .widget_pages, .widget_recent_entries, .widget_recent_comments, .widget_archive, .widget_categories, .widget_categories select, .widget_meta, .widget_text, .widget_tag_cloud, .widget_calendar, .top-line, .widget_nav_menu, .widget_rss {
            border-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_widget_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .widget_pages ul:first-child:before, .widget_recent_entries ul:before, .widget_archive ul:before, .widget_recent_comments ul:before, .widget_categories ul:first-child:before, .widget_meta ul:before, .textwidget:before, .tagcloud:before, .widget_nav_menu:before, .widget_rss ul:before {
            border-top-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_widget_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .post-container {
            border-left-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_widget_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .post-container {
            border-right-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_widget_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' .post-container {
            border-bottom-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_widget_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' p.post-topitem, a.post-topitem:active, a.post-topitem:visited, a.post-topitem:hover, p.logged-in-as {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_dishlist_widget_color_scheme_setting', '#daba6f' ) ) . ';
        }';

		$customizer_css .= ' #message-about, input {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_second_section_message_color', '#000000' ) ) . ';
        }';

		$customizer_css .= ' #first-logo-line {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_all_header_msg_line_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' .line {
            border-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_all_header_msg_line_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' #second-logo-line {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_all_header_msg_line_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' .bloglist-menu-color {
            color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_bloglist_page_header_upper_menu_text_color', '#ffffff' ) ) . ';
        }';

		$customizer_css .= ' #bloglist-header-image { background-image: url(' . esc_url( the_steam_get_category_image_url( the_steam_get_current_category() ) ) . '); }';

		$customizer_css .= ' #dishlist-header-image { background-image: url(' . esc_url( the_steam_get_theme_mod( 'the_steam_dishlist_page_header', '#' ) ) . '); }';

		$customizer_css .= ' #body { background-color: url(' . esc_url( get_background_image() ) . '); }';

		$customizer_css .= ' #blog-section-title, #blog-section-under-title { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_fifth_section_msg_line1_color', '#000000' ) ) .';}';

		$customizer_css .= ' #white-section-title, #about-text { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_second_section_color', '#000000' ) ) .';}';

		$customizer_css .= ' .reservations-subtitle, .reservations-details-line2, .reservations-details-line1 { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_reservations_section_details_color', '#000000' ) ) .';}';

		$customizer_css .= ' #reservations-title, #reservations-under-title { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_reservations_section_color', '#000000' ) ) .';}';

		$customizer_css .= ' #map-restaurant-details, #map-restaurant-location { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_map_section_color', '#99CCCC' ) ) .';}';

		$customizer_css .= ' .navbar-default { background-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_navbar_filter', '#fff ' ) ) .' !important;}';

		$customizer_css .= ' .stacked { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_navbar_text_stacked', '#333' ) ) .' !important;}';

		$customizer_css .= ' .unstacked { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_navbar_text_unstacked', '#fff ' ) ) .' !important;}';

		$customizer_css .= ' .stacked:hover, .unstacked:hover  { color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_navbar_items_hover_color', '#7c7c7c ' ) ) .' !important;}';

		$customizer_css .= ' a.menu-hover:after  { background: ' . esc_html( the_steam_get_theme_mod( 'the_steam_navbar_items_hover_underline_color', '#4e4e4e ' ) ) .' !important;}';

		if ( 'none' !== the_steam_get_theme_mod( 'the_steam_header_animation', 'none' ) ) {
			$customizer_css .= ' .logo-animation-supported { opacity: 0; } ';
		}

		if ( 'none' !== the_steam_get_theme_mod( 'the_steam_section1_animation', 'none' ) ) {
			$customizer_css .= ' #first-section-text > .white-section-title { opacity: 0; } ';
		}

		if ( 'none' !== the_steam_get_theme_mod( 'the_steam_section1_animation', 'none' ) ) {
			$customizer_css .= ' #first-section-text > #about-diamonds-container { opacity: 0; } ';
		}

		if ( 'none' !== the_steam_get_theme_mod( 'the_steam_section1_animation', 'none' ) ) {
			$customizer_css .= ' #first-section-text > #about-text { opacity: 0; } ';
		}

		$customizer_css .= ' .navbar-default-stacked  { background-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_navbar_filter_stacked', '#fff ' ) ) .' !important;}';

		$customizer_css .= ' .navbar-default-unstacked  { background-color: ' . esc_html( the_steam_get_theme_mod( 'the_steam_navbar_filter', 'rgba(0, 0, 0, 0) ' ) ) .' !important;}';

		if ( the_steam_is_frontpage() && 'yes' === the_steam_get_option( 'option_disable_map' ) ) {
			$customizer_css .= ' .footer-bg  { margin-top: -2em; }';
		}

		wp_add_inline_style( 'thesteam-footer-layout', $customizer_css );
	}
}?>
