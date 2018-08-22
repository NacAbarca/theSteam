<?php
/**
 * Functions File Doc Comment
 *
 * This file contains TheSteam theme functions
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 * Text Domain: thesteam
 **/

require_once get_template_directory() . '/classes/suggested-items.php';
require_once get_template_directory() . '/classes/textarea-control.php';
require_once get_template_directory() . '/classes/bootstrap-nav-menu.php';
require_once get_template_directory() . '/classes/frontpage-mobile-nav-menu.php';
require_once get_template_directory() . '/classes/blog-menu.php';
require_once( get_template_directory() . '/inc/alpha-color-picker/alpha-color-picker.php' );
require_once get_template_directory() . '/customizer.php';

add_action( 'after_setup_theme', 'the_steam_add_theme_supported_features' );

if ( ! function_exists( 'the_steam_add_theme_supported_features' ) ) {
	/**
	 * Calls add_theme_support for each of the
	 * theme supported features
	 */
	function the_steam_add_theme_supported_features() {
		$the_steam_custom_header_defaults = array(
			'default-image'          => the_steam_get_theme_mod( 'default_header_image', '#' ),
			'width'                  => 2554,
			'height'                 => 1904,
			'flex-height'            => true,
			'flex-width'             => true,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => false,
			'default-text-color'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-header', $the_steam_custom_header_defaults );

		$the_steam_custom_background_defaults = array(
			'default-color'          => 'white',
			'default-image'          => '',
			'default-repeat'         => '',
			'default-position-x'     => '',
			'default-attachment'     => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-background', $the_steam_custom_background_defaults );

		add_theme_support( 'custom-logo' );

		add_theme_support(
			'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'static-front-page' );

		load_theme_textdomain( 'thesteam', get_template_directory() . '/languages' );
	}
}

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 */
require_once get_template_directory() . '/tgmp/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'the_steam_register_required_plugins' );

if ( ! function_exists( 'the_steam_register_required_plugins' ) ) {
	/**
	 * Registers bundled plugin for the theam
	 */
	function the_steam_register_required_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'               => esc_html__( 'TheSteam Plugin', 'thesteam' ),
				'slug'               => 'the-steam',
				'source'             => get_template_directory() . '/tgmp/plugins/the-steam.zip',
				'required'           => false,
				'version'            => '',
				'force_activation'   => false,
				'force_deactivation' => false,
				'is_callable'        => 'the_steam_install_plugin',
			),
			array(
				'name'               => esc_html__( 'Easy Google Fonts', 'easy-google-fonts' ),
				'slug'               => 'easy-google-fonts',
				'source'             => 'https://downloads.wordpress.org/plugin/easy-google-fonts.zip',
				'required'           => false,
				'version'            => '',
				'force_activation'   => false,
				'force_deactivation' => false,
				'is_callable'        => 'easy_google_fonts_text_domain',
			),
		);

		/*
         * Array of configuration settings. Amend each line as needed.
         *
         * TGMPA will start providing localized text strings soon. If you already have translations of our standard
         * strings available, please help us make TGMPA even better by giving us access to these translations or by
         * sending in a pull-request with .po file(s) with the translations.
         *
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
		$config = array(
			'id'           => 'thesteam',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'has_notices'  => true,
			// Show admin notices or not.
			'dismissable'  => true,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissible' is false, this message will be output at top of nag.
			'is_automatic' => true,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

add_action( 'after_switch_theme', 'the_steam_theme_activated' );

if ( ! function_exists( 'the_steam_theme_activated' ) ) {
	/**
	 * Theme activation handler
	 */
	function the_steam_theme_activated() {
		// If pages don't exist already, they will be created.
		the_steam_create_categories_page();
		the_steam_create_front_page();
		the_steam_create_demo_frontpage_menu_items();
		the_steam_create_demo_blog_menu_items();
	}
}

if ( ! function_exists( 'the_steam_create_categories_page' ) ) {
	/**
	 * Function run at plugin intialization and creates the page needed for displaying categories
	 */
	function the_steam_create_categories_page() {

		$categories_page = get_page_by_title( esc_html__( 'Category List', 'thesteam' ) );

		if ( null !== $categories_page ) {
			// Demo pages are recreated.
			wp_delete_post( $categories_page->ID, true );
		}

		// Value provided by WP.
		$page['post_type']    = 'page';
		$page['post_content'] = '';
		$page['post_parent']  = 0;
		$page['post_author']  = get_the_ID();
		$page['post_status']  = 'publish';
		$page['post_title']   = esc_html__( 'Category List', 'thesteam' );
		$page['post_name']    = esc_html__( 'Preview Category List', 'thesteam' );

		$page_id = wp_insert_post( $page );

		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', 'page-preview-category-list.php' );
		}
	}
}

if ( ! function_exists( 'the_steam_create_front_page' ) ) {
	/**
	 * Function runs at plugin intialization and creates the front page
	 */
	function the_steam_create_front_page() {

		$front_page = get_page_by_title( esc_html__( 'TheSteam Front Page', 'thesteam' ) );

		if ( null !== $front_page ) {
			// Demo pages are recreated.
			wp_delete_post( $front_page->ID, true );
		}

		// Value provided by WP.
		$page['post_type'] = 'page';
		$page['post_content'] = '';
		$page['post_parent'] = 0;
		$page['post_author'] = get_the_ID();
		$page['post_status'] = 'publish';
		$page['post_title'] = esc_html__( 'TheSteam Front Page', 'thesteam' );

		$page_id = wp_insert_post( $page );

		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', 'page-thesteam-front-page.php' );
		}
	}
}

add_action( 'init', 'the_steam_index_init' );
if ( ! function_exists( 'the_steam_index_init' ) ) {
	/**
	 * Initialize global index variable
	 */
	function the_steam_index_init() {

		global $the_steam_global_index;
		$the_steam_global_index = false;
	}
}

if ( ! function_exists( 'the_steam_set_is_index' ) ) {
	/**
	 * Setup global index variable
	 */
	function the_steam_set_is_index() {

		global $the_steam_global_index;
		$the_steam_global_index = true;
	}
}

if ( ! function_exists( 'the_steam_get_is_index' ) ) {
	/**
	 *  Retrieve global index variable value
	 *
	 * @return mixed
	 */
	function the_steam_get_is_index() {
		global $the_steam_global_index;

		return $the_steam_global_index;
	}
}
/* Refactored from codex */
if ( ! function_exists( 'the_steam_show_previous_next_page' ) ) {
	/**
	 * Print out previous or next page links on a single page template.
	 *
	 * @param bool|true $previous Whether to print previous link, if not the next printed.
	 */
	function the_steam_show_previous_next_page( $previous = true ) {

		if ( 'page' !== get_post_type() ) {
			/* this only works for pages */
			return;
		}

		// As suggested by the codex - get_pages - at: https://codex.wordpress.org/Next_and_Previous_Links !
		$page_list = get_pages( array( 'post_type' => 'page', 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );

		if ( ! isset( $page_list ) || false === $page_list ) {
			return;
		}

		$all_pages = array();

		foreach ( $page_list as $page ) {
				$all_pages[] += $page->ID;
		}

		$current = array_search( get_the_ID(), $all_pages );

		if ( false === $current ) {
			return;
		}

		$previous_page_id = array_key_exists( $current - 1, $all_pages ) ? $all_pages[ $current - 1 ] : false;
		$next_page_id     = array_key_exists( $current + 1, $all_pages ) ? $all_pages[ $current + 1 ] : false;

		// As suggested by the codex - get_pages - at: https://codex.wordpress.org/Next_and_Previous_Links !
		if ( ! empty( $previous_page_id ) && true === $previous ) {
			echo '';
			echo '<a href="';
			echo esc_url( get_permalink( $previous_page_id ) );
			echo '"';
			echo 'class="';
			echo 'page-selector';
			echo '"';
			echo 'title="';
			echo esc_attr( get_the_title( $previous_page_id ) );
			echo '">' . esc_html__( 'Previous Page', 'thesteam' ) . '</a>';
		}

		// As suggested by the codex - get_pages - at: https://codex.wordpress.org/Next_and_Previous_Links !
		if ( ! empty( $next_page_id ) && true !== $previous ) {
			echo '';
			echo '<a href="';
			echo esc_url( get_permalink( $next_page_id ) );
			echo '"';
			echo 'class="';
			echo 'page-selector';
			echo '"';
			echo 'title="';
			echo esc_attr( get_the_title( $next_page_id ) );
			echo '">' . esc_html__( 'Next Page', 'thesteam' ) . '</a>';
		}
	}
}

/* Max image and video width */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

add_filter( 'excerpt_more', 'the_steam_custom_more_text' );
add_filter( 'the_content_more_link', 'the_steam_custom_more_text' );
if ( ! function_exists( 'the_steam_custom_more_text' ) ) {
	/**
	 * Retrieves the 'read more' text for excerpts
	 *
	 * @param string $more Not used, imposed by hook signature.
	 *
	 * @return string The "read more" link for excerpts
	 */
	function the_steam_custom_more_text( $more ) {
		return '<a class="read-more-txt" href="' . esc_url( get_permalink( get_the_ID() ) ) . '"> ... ' . esc_html__( 'read more', 'thesteam' ) . '</a>';
	}
}

add_filter( 'excerpt_length', 'the_steam_custom_excerpt_length', 999 );
if ( ! function_exists( 'the_steam_custom_excerpt_length' ) ) {
	/**
	 * Retrieves custom theme excerpt length
	 *
	 * @param int $length Not used, imposed by hook signature.
	 *
	 * @return int Length of the excerpt
	 */
	function the_steam_custom_excerpt_length( $length ) {
		return 55;
	}
}

if ( ! function_exists( 'the_steam_get_theme_image_url' ) ) {
	/**
	 * Retrieves theme image url for a given picture name
	 *
	 * @param string $image_name    File name for the image.
	 *
	 * @return string    Full path for the image name provided
	 */
	function the_steam_get_theme_image_url( $image_name ) {

		return get_template_directory_uri() . '/inc/' . $image_name ;
	}
}

if ( ! function_exists( 'the_steam_is_active_categ' ) ) {
	/**
	 * Compares two given categoryes and prints out active category
	 * in order to mark current category with an underline in css
	 *
	 * @param string $cat1 First category for comparison.
	 * @param string $cat2 Second category for comparison.
	 *
	 * @return string css active category
	 */
	function the_steam_is_active_categ( $cat1, $cat2 ) {

		if ( 0 === strcmp( $cat1, $cat2 ) ) {
			return ' active-categ';
		}

		return '';
	}
}

add_action( 'customize_controls_enqueue_scripts', 'the_steam_customizer_curtain_toggle' );
if ( ! function_exists( 'the_steam_customizer_curtain_toggle' ) ) {
	/**
	 * Enqueues script needed to toggle customizer elements - Instagram source / Handpicked images
	 */
	function the_steam_customizer_curtain_toggle() {
		$contact_form_active = 'yes' === the_steam_get_option( 'option_contact_form' ) ? 1 : 0;
		$initial_settings = array(
		'curtain_setting' => the_steam_curtain_setting_get(),
		                           'plugin_active' => the_steam_check_plugin_active(),
								   'contact_form_active' => $contact_form_active,
							);
		wp_register_script( 'thesteam-toggle-customizer-controls', get_template_directory_uri() . '/js/toggle-controls.js', array( 'jquery' ), null, true );
		wp_localize_script( 'thesteam-toggle-customizer-controls', 'initialSettings', $initial_settings );

		wp_enqueue_script( 'thesteam-toggle-customizer-controls' );
	}
}

if ( ! function_exists( 'the_steam_get_valid_theme_kses' ) ) {
	/**
	 * Retrieves the valid theme kses for wp_kses calls inside the template
	 *
	 * @return array
	 */
	function the_steam_get_valid_theme_kses() {
			return array(
				'table' => array( 'class' => true, 'id' => true ),
				'input' => array( 'type' => true, 'class' => true, 'name' => true, 'value' => true, 'id' => true, 'checked' => true ),
				'tr' => array( 'id' => true, 'class' => true ),
				'th' => array( 'id' => true, 'class' => true ),
				'td' => array( 'id' => true, 'class' => true ),
				'h3' => array( 'class' => true ),
				'hr' => true,
				'br' => true,
				'p' => array( 'id' => true, 'style' => true, 'align' => true ),
				'i' => array( 'class' => true ),
				'b' => true,
				'div' => array( 'id' => true, 'class' => true ),
				'a' => array( 'href' => true, 'title' => true, 'class' => true, 'id' => true ),
				'ul' => array( 'id' => true, 'class' => true ),
				'li' => array( 'id' => true, 'class' => true ),
				'u' => true,
				'slice' => true,
				'strong' => true,
				'strike' => true,
				'del' => true,
			);
	}
}

if ( ! function_exists( 'the_steam_get_curtain_image' ) ) {
	/**
	 * Retrieves a single curtain image for the front page
	 *
	 * @param int $curtain_num Number of the curtain for which to retrieve the image URL.
	 *
	 * @return string|void Image url or void if no image is available for the provided index
	 */
	function the_steam_get_curtain_image( $curtain_num ) {

		if ( ! isset( $curtain_num ) ) {
			return '';
		}

		if ( 'inverse' === the_steam_curtain_setting_get() ) {
			global $instagram_feed;

			if ( ! function_exists( 'curl_init' ) ) {
				return '';
			}

			/* Instagram feature relies on The Steam plugin. */
			if ( ! function_exists( 'the_steam_install_plugin' ) ) {
				return '';
			}

			if ( ! isset( $instagram_feed ) || ! is_array( $instagram_feed ) ) {
				$instagram_feed = the_steam_get_instagram_feed_items( the_steam_get_theme_mod( 'the_steam_instagram_api_key', '' ) );
			}

			if ( ! isset( $instagram_feed ) || ! is_array( $instagram_feed ) ) {
				return '';
			}

			if ( array_key_exists( $curtain_num, $instagram_feed ) ) {
				return $instagram_feed[ $curtain_num ];
			}

			return '';

		} else if ( 'normal' === the_steam_curtain_setting_get() ) {
			return the_steam_get_theme_mod( 'the_steam_curtain_image' . $curtain_num, '#' );
		}

		return '';
	}
}

if ( ! function_exists( 'the_steam_get_category_image_url' ) ) {
	/**
	 * Retrieves featured image url for a given category slug
	 * If the request is done for an archive or date based search,
	 * then the image for the "Category List" page will be used.
	 *
	 * If a translation for All Pages is available, then this
	 * will be used.
	 *
	 * @param string $slug Slug of the category.
	 *
	 * @return string URL of the featured image
	 */
	function the_steam_get_category_image_url( $slug ) {

		/* can't use vip as suggested by phpcs */
		$cat = get_term_by( 'slug', $slug, 'category' );

		if ( false !== $cat ) {
			$t_id          = $cat->term_id;
			$category_meta = get_option( 'category_term_' . $t_id, false );

			if ( false !== $category_meta ) {
				return esc_url( $category_meta['category_id'] );
			} else {
				return '#';
			}
		}

		if ( is_page_template( 'page-preview-category-list.php' ) ) {
			return the_steam_get_theme_mod( 'the_steam_all_categories_page_header', '#' );
		}

		if ( true === the_steam_get_is_index() ) {
			return the_steam_get_theme_mod( 'the_steam_all_posts_page_header', '#' );
		}

		return '#';
	}
}

add_action( 'init', 'the_steam_register_menu' );
if ( ! function_exists( 'the_steam_register_menu' ) ) {
	/**
	 * Function used to register front page menu
	 */
	function the_steam_register_menu() {

		register_nav_menu( 'frontpage-menu', esc_html__( 'Front Page Menu - Only for TheSteam Front Page (max 6 items)', 'thesteam' ) );
		register_nav_menu( 'blog-menu', esc_html__( 'Blog Menu - Only for Blog Entries (max 7 items)', 'thesteam' ) );
	}
}

add_action( 'widgets_init', 'the_steam_widgets_init' );
if ( ! function_exists( 'the_steam_widgets_init' ) ) {
	/**
	 * Function used to initialize widgets provided by the theme
	 */
	function the_steam_widgets_init() {

		register_sidebar(
			array(
			'name'          => esc_html__( 'The Steam Blog Entries Sidebar', 'thesteam' ),
			'id'            => 'blog',
			'class'         => 'blog-sidebar-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
			'description'   => esc_html__( 'The main blog sidebar appears on the right on the list of blog entries', 'thesteam' ),
			)
		);

		if ( the_steam_check_plugin_active() ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'The Steam Dishes Sidebar', 'thesteam' ),
					'id'            => 'dishes',
					'class'         => 'dishes-sidebar-widget',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '',
					'after_title'   => '',
					'description'   => esc_html__( 'The dish sidebar appears on the right on the list of dishes', 'thesteam' ),
				)
			);
		}
	}
}

add_action( 'wp_head', 'the_steam_old_browser_compat' );
if ( ! function_exists( 'the_steam_old_browser_compat' ) ) {
	/**
	 * Function used to enqueue scripts needed to provide compatibility with older browsers
	 * Although not marked as supported browsers, it's good if we the UX is at least acceptable.
	 */
	function the_steam_old_browser_compat() {
		global $wp_version;

		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		if ( version_compare( $wp_version, '4.2', '>=' ) ) {
			wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv/html5shiv.js' );
			wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
			wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond/respond.min.js' );
			wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

		} elseif ( version_compare( $wp_version, '4.1', '>=' ) ) {
			$conditional_scripts = array(
			 'html5shiv' => get_template_directory_uri() . '/js/html5shiv/html5shiv.js',
			 'respond'   => get_template_directory_uri() . '/js/respond/respond.min.js',
			);
			foreach ( $conditional_scripts as $handle => $src ) {
				wp_enqueue_script( $handle, $src, array(), '', false );
			}

			if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
				add_filter(
					'script_loader_tag', function ( $tag, $handle ) use ( $conditional_scripts ) {
					if ( array_key_exists( $handle, $conditional_scripts ) ) {
						$tag = "<!--[if lt IE 9]>$tag<![endif]-->";
					}

					return $tag;
				}, 10, 2);
			} else {
				add_action( 'admin_notices', 'the_steam_notice_old_php', 999 );
			}
		}
	}
}

if ( ! function_exists( 'the_steam_is_blog_list' ) ) {
	/**
	 * Function used to check if the page displays a list of posts, regardless of their type
	 *
	 * @return bool True if current page displays a list of posts
	 */
	function the_steam_is_blog_entries_list() {

		return the_steam_get_is_index() || is_category();
	}
}

add_action( 'wp_footer', 'the_steam_frontpage_carousel_load_scripts' );
if ( ! function_exists( 'the_steam_frontpage_carousel_load_scripts' ) ) {
	/**
	 * Loads scripts needed for owl careousel, which displays posts
	 * and dishes on the front page
	 */
	function the_steam_frontpage_carousel_load_scripts() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		if ( ! the_steam_is_frontpage() ) {
			return;
		}

		wp_register_script( 'thesteam-owl-elements', get_template_directory_uri().'/js/owl-elements.js', array( 'jquery' ), null );
		wp_localize_script( 'thesteam-owl-elements', 'settings', the_steam_get_owl_carousel_settings() );
		wp_enqueue_script( 'thesteam-owl-elements' );
	}
}

add_action( 'admin_init', 'the_steam_register_editor_styles' );
if ( ! function_exists( 'the_steam_register_editor_styles' ) ) {
	/**
	 * Enqueues editor styles as required by WordPress
	 */
	function the_steam_register_editor_styles() {
		add_editor_style( 'editor-style.css' );
	}
}

add_action( 'wp_footer', 'the_steam_load_footer_scripts' );
if ( ! function_exists( 'the_steam_load_footer_scripts' ) ) {
	/**
	 * Function used to enqueue scripts inside the footer
	 */
	function the_steam_load_footer_scripts() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		wp_enqueue_script( 'thesteam-tscommon', get_template_directory_uri() . '/js/ts-common.js', array( 'jquery' ), null, true );

		if ( the_steam_is_frontpage() ) {
			wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/inc/owl-carousel/owl-carousel/owl.carousel.min.js', array( 'jquery' ), null, true );

			/* scripts not exclusive do not have handle prefix */
			wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation/foundation.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap/4.0.0/bootstrap.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr/2.8.3/modernizr.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/js/waypoints/jquery.waypoints.min.js', array( 'jquery' ), null, true );

			if ( 'yes' === the_steam_get_option( 'option_reservations_enabled' )  && the_steam_check_plugin_active() ) {
				wp_enqueue_script( 'timepicker', get_template_directory_uri() . '/inc/timepicker/jquery.timepicker.min.js', array( 'jquery' ), null, true );
				wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui/1.11.4/jquery-ui.min.js', array( 'jquery' ), null, true );
				$locale = get_locale();
				$lang = 0;
				$lang_arr = explode('_', $locale);
				if ($lang_arr && is_array($lang_arr) && array_key_exists(0, $lang_arr)) {
					$lang = $lang_arr[0];
				}

				if ($lang) {
					wp_enqueue_script( 'jquery-ui-' . $lang, get_template_directory_uri() . '/js/jquery-ui/1.11.4/i18n/datepicker-' . $lang .'.js', array( 'jquery-ui' ), null, true );
				}

				wp_enqueue_script( 'jquery-vibrate', get_template_directory_uri() . '/js/jquery-vibrate/jquery.vibrate.min.js', array( 'jquery' ), null, true );

				$resargs = array(
					'the_steam_submit_reservation_security' => wp_create_nonce( 'the_steam_submit_reservation' ),
					'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
					'submit_reservation_button' => esc_html__( 'BOOK NOW', 'thesteam' ),
					'sending_msg' => esc_html__( 'Sending...', 'thesteam' ),
					'email_hint' => esc_html__( 'E-Mail', 'thesteam' ),
					'vibrate_enabled' => esc_js( the_steam_get_option( 'option_vibrate_enabled' ), 'no' ),
					'use_opentable' => esc_js( the_steam_get_option( 'option_use_opentable', 'no' ) ),
					'opentable_restaurant_id' => esc_js( the_steam_get_option( 'option_opentable_restaurant_id', '000000' ) ),
					'usa_format' => esc_js( the_steam_get_option('option_date_format_usa')),
					'enforce_email' => esc_js( the_steam_get_option('option_enforce_email')),
					'secondary_field_email' =>  'name' === the_steam_get_option( 'option_secondary_field' )  ? 'false' : 'true'
				);

				wp_register_script( 'thesteam-reservations', get_template_directory_uri() . '/js/reservations.js', array( 'jquery', 'thesteam-functions', 'jquery-vibrate' ), null, true );
				wp_localize_script( 'thesteam-reservations', 'resargs', $resargs );
				wp_enqueue_script( 'thesteam-reservations' );
			}

			$protocol = is_ssl() ? 'https' : 'http';
			$google_maps_api_key = the_steam_get_option( 'option_maps_api_key', '  ', 300 );
			$google_maps_url = $protocol . '://maps.googleapis.com/maps/api/js';

			if ( isset( $google_maps_api_key ) && '  ' !== $google_maps_api_key && '' !== $google_maps_api_key ) {
				$google_maps_url .= '?key=' . esc_js( $google_maps_api_key );
			}

			/* Google Maps API cannot be stored locally */
			wp_enqueue_script( 'google-maps', esc_url( $google_maps_url ), array( 'jquery' ), null, true );

			$map_data = array( 'index' => esc_js( the_steam_get_theme_mod( 'the_steam_frontpage_map_selection', '0' ) ) );

			wp_register_script( 'thesteam-frontpagemap', get_template_directory_uri() . '/js/frontpage-map.js', array( 'jquery', 'thesteam-functions' ), null, true );
			wp_localize_script( 'thesteam-frontpagemap', 'map_data', $map_data );
			wp_enqueue_script( 'thesteam-frontpagemap' );

			wp_register_script( 'thesteam-gallery', get_template_directory_uri() . '/js/gallery/js/blueimp-gallery.min.js', array( 'jquery' ), null, true );


			$functions_args = array(
								'header_animation' => esc_js( the_steam_get_theme_mod( 'the_steam_header_animation', 'none' ) ),
								'dishtypes_animation' => esc_js( the_steam_get_theme_mod( 'the_steam_dishtypes_animation', 'none' ) ),
							    'menubook_hover_animation' => esc_js( the_steam_get_option( 'option_enable_menubook_preview', 'no' ) ),
								'marker_bounce' => esc_js( the_steam_get_option( 'option_maker_bounce', 'no' ) ),
								'about_animation' => esc_js( the_steam_get_theme_mod( 'the_steam_section1_animation', 'none' ) ),
								'reservations_animation' => esc_js( the_steam_get_theme_mod( 'the_steam_reservations_animation', 'none' ) ),
								'dishtypes_fixed' => esc_js( the_steam_get_option( 'option_4_main_categories', 'no' ) ),
								);

			wp_register_script( 'thesteam-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery', 'TweenMax', 'thesteam-tscommon', 'jquery-waypoints', 'thesteam-gallery' ), null, true );
			wp_localize_script( 'thesteam-functions', 'functions_args', $functions_args );
			wp_enqueue_script( 'thesteam-functions' );
		}

		wp_enqueue_script( 'jquery-ui-touchpunch', get_template_directory_uri() . '/js/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', array( 'jquery-ui' ), null, true );

		if ( the_steam_is_blog_entries_list() || is_single() || the_steam_is_taxonomy() || is_404() || is_page() ) {
			wp_enqueue_script( 'thesteam-blog-entries-script', get_template_directory_uri() . '/js/blog-script.js', array( 'jquery' ), null, true );
		}

		if ( the_steam_is_blog_entries_list() || the_steam_is_taxonomy() ) {
			wp_enqueue_script( 'thesteam-blog-list-script', get_template_directory_uri() . '/js/blog-list.js', array( 'jquery' ), null, true );
		}

		if ( is_page_template( 'page-preview-category-list.php' ) ) {
			wp_enqueue_script( 'freewall', get_template_directory_uri() . '/js/freewall/freewall.js', array( 'jquery' ), null, true );
		}

		wp_enqueue_script( 'ScrollToPlugin', get_template_directory_uri() . '/js/ScrollToPlugin/ScrollToPlugin.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'TweenMax', get_template_directory_uri() . '/js/TweenMax/TweenMax.min.js', array( 'jquery', 'ScrollToPlugin' ), null, true );

		$fnargs = array(
			'the_steam_submit_message_security' => wp_create_nonce( 'the_steam_submit_message' ),
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'submit_message_button' => esc_html__( 'SEND MESSAGE', 'thesteam' ),
			'parallax_enabled' => esc_js( the_steam_get_option( 'option_parallax_enabled', 'no' ) ),
			'vibrate_enabled' => esc_js( the_steam_get_option( 'option_vibrate_enabled' ), 'no' ),
			'headerAnimationClass' => esc_js( the_steam_get_theme_mod( 'the_steam_header_animation', 'none' ) ),
			'positionMenuDown' => esc_js( the_steam_get_option( 'option_navbar_down', 'no' ) ),
		);

		wp_enqueue_script( 'jquery-appear', get_template_directory_uri() . '/inc/jquery-appear/jquery.appear.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-vibrate', get_template_directory_uri() . '/js/jquery-vibrate/jquery.vibrate.min.js', array( 'jquery' ), null, true );

		wp_register_script( 'thesteam-footer-script', get_template_directory_uri() . '/js/footer.js', array( 'jquery', 'TweenMax', 'thesteam-tscommon', 'jquery-vibrate' ), null, true );
		wp_localize_script( 'thesteam-footer-script', 'fnargs', $fnargs );
		wp_enqueue_script( 'thesteam-footer-script' );
	}
}

if ( ! function_exists( 'the_steam_is_taxonomy' ) ) {
	/**
	 * Wrapper function used to check if current page displays posts from a specific taxonomy
	 *
	 * @return bool True if page is for displaying posts from a taxonomy
	 */
	function the_steam_is_taxonomy() {
		return is_tax();
	}
}

add_action( 'customize_preview_init', 'the_steam_customize_preview_js' );
if ( ! function_exists( 'the_steam_customize_preview_js' ) ) {
	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function the_steam_customize_preview_js() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		$initial_settings = array( 'firstLogoImage' => the_steam_get_theme_mod( 'the_steam_logo1', '' ),
									'galleryEnabled' =>  'yes' === the_steam_get_option( 'option_gallery_enabled' ) ? 'true' : 'false' );

		$deps = array( 'jquery' );

		if ( the_steam_is_frontpage() ) {
			array_push( $deps, 'thesteam-frontpagemap' );
		}

		wp_register_script( 'thesteam-customizer', get_template_directory_uri() . '/js/customizer.js', $deps, null, true );
		wp_localize_script( 'thesteam-customizer', 'initialSettings', $initial_settings );

		wp_enqueue_script( 'thesteam-customizer' );
	}
}

if ( ! function_exists( 'the_steam_get_theme_mod' ) ) {
	/**
	 * Function used to retrieve a theme mod
	 *
	 * @param string $theme_mod Theme mod name.
	 * @param string $default_msg Default message to be returned in case theme mod is not set.
	 *
	 * @return string|void Theme mod that has been set trough the customizer or null otherwise
	 */
	function the_steam_get_theme_mod( $theme_mod, $default_msg = ' ' ) {

		if ( ! isset( $theme_mod ) || empty( $theme_mod ) ) {
			return $default_msg;
		}

		$retval = ( get_theme_mod( $theme_mod ) );

		if ( ! $retval || empty( $retval ) ) {
			return $default_msg;
		} else {
			return $retval;
		}
	}
}

add_action( 'wp_head', 'the_steam_add_ajax_library' );
if ( ! function_exists( 'the_steam_add_ajax_library' ) ) {
	/**
	 * Function used to enqueue ajax needed for theme reservations
	 */
	function the_steam_add_ajax_library() {
		if ( ('yes' === the_steam_get_option( 'option_reservations_enabled' ) || 'yes' === the_steam_get_option( 'option_contact_form' ) )  && the_steam_check_plugin_active() ) {
			wp_enqueue_script( 'ajax', admin_url( 'admin-ajax.php' ), array(), null, true );
		}
	}
}

/* Render title in Head */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	/**
	 * Function used to render html title
	 * in wp_head hook
	 */
	function the_steam_render_title() {

		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}

	add_action( 'wp_head', 'the_steam_render_title' );
}

if ( ! function_exists( 'the_steam_is_frontpage' ) ) {
	/**
	 * Function used to check whether current page is the theme's front page
	 *
	 * @return bool True if page is theme's front page, false otherwise
	 */
	function the_steam_is_frontpage() {

		return is_page_template( 'page-thesteam-front-page.php' );
	}
}

if ( ! function_exists( 'the_steam_is_page_all_categories' ) ) {
	/**
	 * Checks whether it is the all categories page
	 *
	 * @return bool True if page displays all the categories
	 */
	function the_steam_is_page_all_categories() {

		return is_page_template( 'page-preview-category-list.php' );
	}
}

if ( ! function_exists( 'the_steam_enqueue_google_fonts' ) ) {
	/**
	 * Enqueues Google fonts.
	 *
	 * Adapted from example at:
	 * https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
	 */
	function the_steam_enqueue_google_fonts() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		$protocol = is_ssl() ? 'https' : 'http';
		$font_url = $protocol . '://fonts.googleapis.com/css?family=';

		/*
		 Translators: If there are characters in your language that are not
        * supported by any of these fonts, translate the corresponding value to 'off'.
		* Do not translate into your own language.
        */
		$playfair = _x( 'on', 'PlayFair font: on or off', 'thesteam' );

		$open_sans = _x( 'on', 'Open Sans font: on or off', 'thesteam' );

		$playfair_sc = _x( 'on', 'PlayFairSC font: on or off', 'thesteam' );

		$josefin_sans = _x( 'on', 'Josefin Sans font: on or off', 'thesteam' );

		$lato_sans = _x( 'on', 'Lato font: on or off', 'thesteam' );

		/* Each font is requested by itself because Google no longer returns all fonts in one request */
		if ( 'off' !== $playfair || 'off' !== $open_sans || 'off' !== $playfair_sc || 'off' !== $josefin_sans || 'off' !== $lato_sans ) {

			if ( 'off' !== $playfair ) {
				wp_enqueue_style( 'PlayFair', esc_url( $font_url . 'Playfair+Display:400,700,900' ), array(), null );
			}

			if ( 'off' !== $open_sans ) {
				wp_enqueue_style( 'OpenSansGoogle', esc_url( $font_url . 'Open+Sans:400,300,600,700italic,800,400italic,600italic,700,300italic,800italic' ), array(), null );
			}

			if ( 'off' !== $playfair_sc ) {
				wp_enqueue_style( 'PlayFairSC', esc_url( $font_url . 'Playfair+Display+SC:400,700,900' ), array(), null );
			}

			if ( 'off' !== $josefin_sans ) {
				wp_enqueue_style( 'JosefinSans', esc_url( $font_url . 'Josefin+Sans:400,600,700' ), array(), null );
			}

			if ( 'off' !== $lato_sans ) {
				wp_enqueue_style( 'Lato', esc_url( $font_url . 'Lato:300,400' ), array(), null );
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'the_steam_load_styles' );
if ( ! function_exists( 'the_steam_load_styles' ) ) {
	/**
	 * Function used to load css styles. Apart from google fonts, the rest of the styles are hosted locally
	 */
	function the_steam_load_styles() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		the_steam_enqueue_google_fonts();

		if ( the_steam_is_frontpage() ) {
			wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/inc/font-awesome-4.4.0/css/font-awesome.min.css', array() );
			wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/inc/foundation/css/foundation.min.css', array() );
			wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/layouts/bootstrap.min.css', array(), '3.3.5' );
			wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/layouts/normalize.min.css', array() );
			wp_enqueue_style( 'foundation-icons', get_stylesheet_directory_uri() . '/layouts/foundation-icons.css', array() );
			wp_enqueue_style( 'owl-carousel', get_stylesheet_directory_uri() . '/inc/owl-carousel/owl-carousel/owl.carousel.css', array() );
			wp_enqueue_style( 'jquery-ui', get_stylesheet_directory_uri() . '/layouts/jqueryui/1.11.4/jquery-ui.min.css', array() );
			wp_enqueue_style( 'jquery-timepicker', get_stylesheet_directory_uri() . '/inc/timepicker/jquery.timepicker.css', array() );
			wp_enqueue_style( 'thesteam-frontpage-style', get_stylesheet_directory_uri() . '/layouts/first-page-style.css', array( 'bootstrap' ) );
			wp_enqueue_style( 'animate-css-style', get_stylesheet_directory_uri() . '/layouts/animate/animate.css', array() );
			wp_enqueue_style( 'gallery-css-style', get_stylesheet_directory_uri() . '/js/gallery/css/blueimp-gallery.min.css', array() );
		}

		if ( ! the_steam_is_frontpage() && ( is_category() || is_single() || the_steam_is_taxonomy() || the_steam_get_is_index() || is_404() || is_page() ) ) {
			wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/layouts/normalize.min.css', array() );
			wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/inc/foundation/css/foundation.min.css', array() );
			wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/inc/font-awesome-4.4.0/css/font-awesome.min.css', array() );
			wp_enqueue_style( 'foundation-icons', get_stylesheet_directory_uri() . '/layouts/foundation-icons.css', array() );

			if ( ! is_single() && ( the_steam_get_is_index() || is_category() || the_steam_is_taxonomy() || is_404() ) ) {
				wp_enqueue_style( 'thesteam-blog-entry', get_stylesheet_directory_uri() . '/layouts/blog-list.css', array() );
			}

			if ( is_single() || is_404() || is_page() ) {
				wp_enqueue_style( 'thesteam-single-entry', get_stylesheet_directory_uri() . '/layouts/single.css', array() );
			}
		}

		if ( ! the_steam_is_frontpage() && ( the_steam_get_is_index() || is_category() || is_single() || the_steam_is_taxonomy() || is_404() || is_page() ) ) {
			wp_enqueue_style( 'thesteam-footer-special', get_stylesheet_directory_uri() . '/layouts/overrides/footer-special.css', array() );
		}

		wp_enqueue_style( 'thesteam-mobile-menu', get_stylesheet_directory_uri() . '/layouts/mobile-menu.css', array() );
		wp_enqueue_style( 'thesteam-wordpress-style', get_stylesheet_directory_uri() . '/style.css', array() );
	}
}

if ( ! function_exists( 'the_steam_get_gallery_display_class' )) {
	function the_steam_get_gallery_display_class($id) {
		if ($id > 4 && $id <=8) {
			return 'show-for-medium-up';
		}

		if ($id > 8 && $id <=12) {
			return 'show-for-large-up';
		}

		return '';
	}
}

if ( ! function_exists( 'the_steam_get_elipsis' ) ) {
	/**
	 * Function used to retrieved a trimmed down version of the string passed as argument
	 *
	 * @param string $str Text which needs to be trimmed.
	 * @param int    $len Number of characters to trim from the original string.
	 * @param string $alt Alternative text if not provided.
	 *
	 * @return string A trimmed down version of the provided string or ' ' if provided string is empty
	 */
	function the_steam_get_elipsis( $str, $len = 33, $alt = ' ' ) {

		$ret = $alt;

		if ( isset( $str ) && ! empty( $str ) ) {
			$ret = $str;
		}

		if ( $len < strlen( $str ) ) {
			$ret = substr( $str, 0, strrpos( substr( $str, 0, $len ), ' ' ) );

			$ret .= '...';
		}

		return $ret;
	}
}

add_action( 'wp_enqueue_scripts', 'the_steam_setup_all_categories_style' );
if ( ! function_exists( 'the_steam_setup_all_categories_style' ) ) {
	/**
	 * Sets up css with background images for all categories page
	 * and returns the array of categories to be later used.
	 *
	 * This function must be called before wp_header(), where styles
	 * are printed of course.
	 */
	function the_steam_setup_all_categories_style() {

		$categories = get_categories( array( 'orderby' => 'name', 'parent' => 0 ) );
		$all_categories_style = '';
		foreach ( $categories as $category ) {
			// Cannot use ids for css because javascript plugin changes ids, therefore we need to use the class.
			$all_categories_style .= '.brick-category-'.esc_html( $category->slug ) . " { background-image: url('" . esc_url( the_steam_get_category_image_url( $category->slug ) )  . "'); } ";
		}

		// If All Categories jumbotron is not set in the theme_mod at all, use no image at all.
		$bg_url = the_steam_get_theme_mod( 'the_steam_all_categories_page_header', '#' );

		$all_categories_style .= ' .large-image {
                background-image: url("' . esc_url( $bg_url ) . '");}';

		wp_add_inline_style( 'thesteam-footer-layout', $all_categories_style );
	}
}

add_action( 'wp_enqueue_scripts', 'the_steam_enqueue_post_jumbotron_style' );
if ( ! function_exists( 'the_steam_enqueue_post_jumbotron_style' ) ) {
	/**
	 * Function used to enqueue css style for theme's post page jumbotrons
	 */
	function the_steam_enqueue_post_jumbotron_style() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		if ( ! (is_single() || (is_page() && ! is_page_template( 'page-preview-category-list.php' ))) ) {
			return;
		}

		$style = '
			.large-image {
                background-image: url("' . esc_url( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ) . '");}';

		wp_add_inline_style( 'thesteam-footer-layout',$style );
	}
}

add_action( 'wp_enqueue_scripts', 'the_steam_enqueue_dish_list_jumbotron_style' );
if ( ! function_exists( 'the_steam_enqueue_dish_list_jumbotron_style' ) ) {
	/**
	 * Function used to print out css style for a dish list, including jumbotron background image
	 */
	function the_steam_enqueue_dish_list_jumbotron_style() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		if ( ! the_steam_is_taxonomy() ) {
			return;
		}
		$style = '#dishlist-header-image {
                background-image: url("' . esc_url( the_steam_get_theme_mod( 'the_steam_dishlist_page_header', the_steam_get_default_value( 'the_steam_dishlist_page_header' ) ) ) . '");
            }';

		wp_add_inline_style( 'thesteam-footer-layout', $style );
	}
}

add_action( 'wp_enqueue_scripts', 'the_steam_logo_img_enqueue_style', 9999 );
if ( ! function_exists( 'the_steam_logo_img_enqueue_style' ) ) {
	/**
	 * Function used to enqueue logo css style
	 */
	function the_steam_logo_img_enqueue_style() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		if ( ! the_steam_is_frontpage() ) {
			return;
		}

		$style  = ' .logo-first-line, .logo-second-line, .first-logo-hr, .logo-third-line { display: ';
		$style .= the_steam_frontpage_setting_is( 'normal' ) ? 'block' : 'none';
		$style .= ';} .logo-image, .first-logo { ';
		$style .= the_steam_frontpage_setting_is( 'inverse' ) ? 'block' : 'none';
		$style .= ';}';

		if ( 'yes' === the_steam_get_option( 'option_hide_diamonds' ) ) {
			$style  = ' .under-title-symbol, .under-title-symbol-ws1, .under-title-symbol-footer { display: none; } ';
		}

		if ( 'yes' === the_steam_get_option( 'option_disable_map_text' ) ) {
			$style .= ' .map-overlay { opacity: 0; }';
		}

		wp_add_inline_style( 'thesteam-frontpage-style', $style );
	}
}

if ( ! function_exists( 'the_steam_curtain_setting_get' ) ) {
	/**
	 * Function used to get the setting for curtains
	 *
	 * @return string|void Values are either 'normal' or 'inverse'
	 */
	function the_steam_curtain_setting_get() {

		return the_steam_get_theme_mod( 'the_steam_section2_curtain_setting', 'normal' );
	}
}


if ( ! function_exists( 'the_steam_frontpage_setting_is' ) ) {
	/**
	 * Checks provided if provided argument equals to the theme setting
	 * for frontpage - should it display a logo or some text
	 *
	 * @param string $val Value to compare to the current setting.
	 *
	 * @return bool True if provided value is the same as the current setting
	 */
	function the_steam_frontpage_setting_is( $val ) {

		if ( ! isset( $val ) ) {
			return false;
		}

		return the_steam_get_theme_mod( 'the_steam_text_or_logo', 'inverse' ) === $val;
	}
}

add_action( 'init', 'the_steam_options_init' );
if ( ! function_exists( 'the_steam_options_init' ) ) {
	/**
	 * This function initializes global theme options
	 */
	function the_steam_options_init() {

		global $the_steam_options_extracted;
		$the_steam_options_extracted = 0;
	}
}

add_action( 'admin_init', 'the_steam_register_theme_settings' );
if ( ! function_exists( 'the_steam_register_theme_settings' ) ) {
	/**
	 * This function is used to register the theme settings
	 */
	function the_steam_register_theme_settings() {

		// Register the steam settings.
		register_setting('the-steam-settings-group',
		'the_steam_options', 'the_steam_sanitize_options');
	}
}

if ( ! function_exists( 'the_steam_setup_options' ) ) {
	/**
	 * This is used to setup global options if not already initialized
	 */
	function the_steam_setup_options() {

		global $the_steam_theme_options, $the_steam_options_extracted;

		$the_steam_theme_options = get_option( 'the_steam_options' );

		if ( false !== $the_steam_theme_options && '' !== $the_steam_theme_options ) {
			$the_steam_options_extracted = 1;
		}
	}
}

if ( ! function_exists( 'the_steam_get_option' ) ) {
	/**
	 * Retrieve the specified theme option
	 *
	 * @param string $option The option that for which the value is retrieved.
	 * @param string $alt Alternate text if option was not defined.
	 * @param int    $len Max length of the string, if exceeds '...' is appended.
	 *
	 * @return string|void The option defined value or alternate text if not set
	 */
	function the_steam_get_option( $option, $alt = 'Unset', $len = 33 ) {
		global $the_steam_theme_options, $the_steam_options_extracted;

		if ( isset( $the_steam_options_extracted ) && 1 !== $the_steam_options_extracted ) {
			the_steam_setup_options();
		}

		if ( isset( $option ) && '' !== $option && ' ' !== $option ) {
			$ret = false !== $the_steam_theme_options && is_array( $the_steam_theme_options ) && array_key_exists( $option, $the_steam_theme_options ) && ! empty( $the_steam_theme_options[ $option ] ) ?  $the_steam_theme_options[ $option ] : $alt;
			return the_steam_get_elipsis( $ret,$len, '' );
		}

		return the_steam_get_elipsis( $alt,$len, '' );
	}
}

if ( ! function_exists( 'the_steam_sanitize_options' ) ) {
	/**
	 * This function is used to sanitize different theme options
	 *
	 * @param string $input Value to sanitize.
	 *
	 * @return mixed Sanitized value
	 */
	function the_steam_sanitize_options( $input ) {
		$input['option_fb_url'] =
			sanitize_text_field( isset( $input['option_fb_url'] ) ? esc_url( $input['option_fb_url'] ) : '  ' );
		$input['option_twitter_url'] =
			sanitize_text_field( isset( $input['option_twitter_url'] ) ? esc_url( $input['option_twitter_url'] ) : '  ' );
		$input['option_instagram_url'] =
			sanitize_text_field( isset( $input['option_instagram_url'] ) ? esc_url( $input['option_instagram_url'] ) : ' ' );
		$input['option_foursquare_url'] =
			sanitize_text_field( isset( $input['option_foursquare_url'] ) ? esc_url( $input['option_foursquare_url'] ) : '  ' );
		$input['option_pinterest_url'] =
			sanitize_text_field( isset( $input['option_pinterest_url'] ) ? esc_url( $input['option_pinterest_url'] ) : '  ' );
		$input['option_tripadvisor_url'] =
			sanitize_text_field( isset( $input['option_tripadvisor_url'] ) ? esc_url( $input['option_tripadvisor_url'] ) : '  ' );

		return $input;
	}
}

if ( ! function_exists( 'the_steam_get_current_category' ) ) {
	/**
	 * Function used to retrieve the current category name from the query variable for the category
	 *
	 * @return int|mixed The value for the query var, 1 if the query var is not set
	 */
	function the_steam_get_current_category() {
		return get_query_var( 'category_name', '1' );
	}
}

if ( ! function_exists( 'the_steam_get_owl_carousel_settings' ) ) {
	/**
	 * Function used to set up javascript variables for the scripts which create the carousel for the blog posts
	 * on the front page
	 *
	 * @return array An array of settings for the owl carousel
	 */
	function the_steam_get_owl_carousel_settings() {

		$the_steam_auto_play_blog             = 'false';
		$the_steam_max_blog_elements          = the_steam_get_option( 'option_carousel_items', '5' );
		$the_steam_setting_carousel_enabled   = the_steam_get_option( 'option_carousel_enabled', 'false' );

		if ( 'true' === $the_steam_setting_carousel_enabled ) {
			$the_steam_auto_play_blog = the_steam_get_option( 'option_carousel_delay' );
			if ( '' !== $the_steam_auto_play_blog && ' ' !== $the_steam_auto_play_blog && 'false' !== $the_steam_auto_play_blog && ' ' !== $the_steam_auto_play_blog ) {
				$the_steam_auto_play_blog .= '000'; // Milliseconds.
			}
		}

		$the_steam_owl_carousel_settings = array(
		 'maxBlogItems'           => $the_steam_max_blog_elements,
		 'autoPlayBlog'           => $the_steam_auto_play_blog,
		);

		return $the_steam_owl_carousel_settings;
	}
}

if ( ! function_exists( 'the_steam_post_link_pages' ) ) {
	/**
	 * Function to display the page navigation for a post
	 */
	function the_steam_post_link_pages() {

		$the_steam_link_pages_arg = array(
		 'before'           => '<p class="link-pages">' . esc_html__( 'Pages:', 'thesteam' ),
		 'after'            => '</p>',
		 'link_before'      => '',
		 'link_after'       => '',
		 'next_or_number'   => 'number',
		 'separator'        => ' ',
		 'nextpagelink'     => esc_html__( 'Next page', 'thesteam' ),
		 'previouspagelink' => esc_html__( 'Previous page', 'thesteam' ),
		 'pagelink'         => '%',
		 'echo'             => 1,
		);

		wp_link_pages( $the_steam_link_pages_arg );
	}
}


if ( ! function_exists( 'the_steam_frontpage_menu' ) ) {
	/**
	 * Function which sets up and registers the front page menu for wide screens
	 */
	function the_steam_frontpage_menu() {

		if ( has_nav_menu( 'frontpage-menu' ) ) {
			$menu = wp_nav_menu(
				array(
				'theme_location'  => 'frontpage-menu',
				'echo'         => false,
				'items_wrap'      => '%3$s',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'depth'           => - 1,
				'fallback_cb'     => function () {
					return;
				},
				'walker'          => new TheSteam_Bootstrap_Nav_Menu(),
				)
			);

			/* Bootstrap menu align left displays inverse items */
			$elements = explode( '<ul', $menu );
			$idx = 0;
			foreach ( $elements as &$element ) {
				if ( 0 !== $idx++ ) {
					$element = '<ul' . $element;
				}
			}

			$elements = array_reverse( $elements );

			foreach ( $elements as &$element ) {
				echo wp_kses( $element, the_steam_get_valid_theme_kses() );
			}
		}
	}
}

if ( ! function_exists( 'the_steam_blog_menu' ) ) {
	/**
	 * Function which sets up and registers the blog (index, single entry,
	 * anything that has to do with standard posts or categories) for wide screens
	 */
	function the_steam_blog_list_menu() {

		if ( has_nav_menu( 'blog-menu' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'blog-menu',
					'echo'         => true,
					'items_wrap'      => '%3$s',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => '',
					'menu_id'         => '',
					'depth'           => - 1,
					'fallback_cb'     => function () {
						return;
					},
					'walker'          => new TheSteam_Blog_Menu(),
				)
			);
		}
	}
}

if ( ! function_exists( 'the_steam_frontpage_mobile_menu' ) ) {
	/**
	 * Function which sets up and registers the mobile menu for all pages
	 */
	function the_steam_frontpage_mobile_menu() {

		/* this is available only for frontpage */
		if ( ! the_steam_is_frontpage() ) {
			return;
		}

		if ( has_nav_menu( 'frontpage-menu' ) ) {
			wp_nav_menu(
				array(
				'theme_location'  => 'frontpage-menu',
				'items_wrap'      => '%3$s',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'depth'           => - 1,
				'fallback_cb'     => function () {
					return;
				},
				'walker'          => new TheSteam_Frontpage_Mobile_Nav_Menu(),
				)
			);
		}
	}
}

if ( ! function_exists( 'the_steam_get_post_subtitle' ) ) {
	/**
	 * Function used to return a subtitle for the current post
	 */
	function the_steam_get_post_subtitle() {

		$post_subtitle = get_post_meta( get_the_ID(), get_post_type() . '_subtitle', 'true' );
		if ( isset( $post_subtitle ) && false !== $post_subtitle ) {
			return $post_subtitle;
		}

		return '';
	}
}

if ( ! function_exists( 'the_steam_current_category_set_name' ) ) {
	/**
	 * Function used to set up global category name for internal use
	 *
	 * @param string $cat_name New category name.
	 *
	 * @return string Same value provided as argument
	 */
	function the_steam_current_category_set_name( $cat_name ) {

		if ( ! isset( $cat_name ) ) {
			return '';
		}

		global $the_steam_category_name;

		return $the_steam_category_name = $cat_name;

	}
}

if ( ! function_exists( 'the_steam_current_category_get_current_name' ) ) {
	/**
	 * Function used to retrieve the global value for the current category
	 *
	 * @return string Current category name
	 */
	function the_steam_current_category_get_current_name() {

		global $the_steam_category_name;

		return $the_steam_category_name;
	}
}

if ( ! function_exists( 'the_steam_current_post_category_get_name' ) ) {
	/**
	 * Returns  category name for the currently selected post
	 *
	 * @param string $chars Maximum number of chars to be returned.
	 * @return string Category name
	 */
	function the_steam_current_post_category_get_name( $chars = '15' ) {

		$the_steam_post_category = 'dish' === get_post_type() ? get_the_terms( get_the_ID(), 'dishtype' ) : get_the_category( get_the_ID() );

		if ( isset( $the_steam_post_category ) && isset( $the_steam_post_category[0]->name ) ) {
			return the_steam_get_elipsis( the_steam_current_category_set_name( $the_steam_post_category[0]->name ), $chars );
		} else {
			the_steam_current_category_set_name( 1 );
			return esc_html__( 'Uncategorized', 'thesteam' );
		}
	}
}

if ( ! function_exists( 'the_steam_get_blog_list_categories' ) ) {
	/**
	 * Retrieves an array of 5 categories sorted by name asc
	 *
	 * @return array List of categories.
	 */
	function the_steam_get_blog_list_categories() {

		$list_cat_args = array(
		 'hide_empty' => 0,
		 'type'       => 'post',
		 'orderby'    => 'name',
		 'number'     => '5',
		 'order'      => 'ASC',
		);

		return get_categories( $list_cat_args );
	}
}

if ( ! function_exists( 'the_steam_get_current_post_date' ) ) {
	/**
	 * Retrieve date for the current post in the loop
	 *
	 * @param string $req_item Part of the date to be retrieved, like day, month, year, etc.
	 *
	 * @return false|string Value of the selected item or full date if invalid value provided
	 */
	function the_steam_get_current_post_date( $req_item ) {

		$post_date = get_the_date( 'j;F;Y;g;i;A' );
		$date_arr  = explode( ';', $post_date );

		switch ( $req_item ) {
			case 'day':
			return $date_arr[0];
			case 'month':
			return $date_arr[1];
			case 'year':
			return $date_arr[2];
			case 'hour':
			return $date_arr[3];
			case 'min':
			return $date_arr[4];
			case 'am_pm':
			return $date_arr[5];
			default:
			return $post_date;
		}
	}
}

if ( ! function_exists( 'the_steam_generic_count' ) ) {
	/**
	 * Generic counter used for various function as a global index
	 *
	 * @param string $counter_name Index name.
	 *
	 * @return int mixed Value at given time
	 */
	function the_steam_generic_count( $counter_name ) {

		global $generic_counter;

		if ( ! isset( $generic_counter[ $counter_name ] ) ) {
			$generic_counter[ $counter_name ] = 0;
			return $generic_counter[ $counter_name ];
		}

		$generic_counter[ $counter_name ] += 1;

		return $generic_counter[ $counter_name ];
	}
}

if ( ! function_exists( 'the_steam_generic_count_is_greater' ) ) {
	/**
	 * Comparison helper function for global index
	 *
	 * @param string $counter_name Counter name to compare with given value.
	 * @param int    $val Value to compare global index value to.
	 *
	 * @return bool True if index is greater
	 */
	function the_steam_generic_count_is_greater( $counter_name, $val ) {

		global $generic_counter;

		if ( $generic_counter[ $counter_name ] > $val ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'the_steam_get_terms' ) ) {
	/**
	 * Retrieves an array of terms for the dishtype taxonomy
	 *
	 * @return array|int|WP_Error A list of terms for the dish
	 */
	function the_steam_get_terms() {

		$tax_args = array(
		 'order'          => 'ASC',
		 'orderby'        => 'id',
		 'hide_empty'     => 0,
		 'number' => 'yes' === the_steam_get_option( 'option_4_main_categories', 'no' ) ? 4 : 100,
		);

		return get_terms( 'dishtype', $tax_args );
	}
}

if ( ! function_exists( 'the_steam_show_suggested_items' ) ) {
	/**
	 * Enqueues a different part of the theme for pages, dishes and posts, which in turn displays suggested items
	 */
	function the_steam_show_suggested_items() {
		if ( ! is_404() && 'yes' === the_steam_get_option( 'option_hide_next_prev', 'no' ) ) {
			return;
		}

		'page' === get_post_type() ? get_template_part( 'parts/blog', 'random-items' ) : get_template_part( 'parts/blog', 'related-items' );
	}
}

if ( ! function_exists( 'the_steam_get_blog_carousel_elements' ) ) {
	/**
	 * Function used to retrieve a list of 12 posts to be displayed in the front page carousel
	 *
	 * @return WP_Query
	 */
	function the_steam_get_blog_carousel_elementes() {

		$total_items = intval( the_steam_get_option( 'option_carousel_total_items', 8 ) );

		$the_steam_blog_carousel_query_args = array(
		 'post_type'      => 'post',
		 'posts_per_page' => absint( $total_items ),
		 'post_status'    => 'publish',
		);

		return new WP_Query( $the_steam_blog_carousel_query_args );
	}
}

add_filter( 'comment_form_default_fields', 'the_steam_comment_form_filter' );
if ( ! function_exists( 'the_steam_comment_form_filter' ) ) {
	/**
	 * Function used to retrieve the comment form default fields for the comment_form_default_fields hook
	 *
	 * @param array $args Current fields for the comment form as set up by Wordpress.
	 *
	 * @return array Modified fields for the comment form
	 */
	function the_steam_comment_form_filter( $args ) {
		/* enclose in a div the existing comment box, for styling */
		$args = wp_parse_args( $args );

		$args['author'] = '<div class="ts-commenter-details">' . $args['author'];
		$args['url']    = $args['url'] . '</div></div>';

		return $args;
	}
}

if ( ! function_exists( 'the_steam_is_logged_add_class' ) ) {
	/**
	 * Function used return a specific class if user is logged in
	 *
	 * @param string $class The class to be returned.
	 *
	 * @return string Provided argument if condition yields true, void if else
	 */
	function the_steam_is_logged_add_class( $class ) {

		if ( ! isset( $class ) ) {
			return '';
		}

		if ( is_user_logged_in() ) {
			return $class;
		}

		return '';
	}
}

add_filter( 'comment_form_defaults', 'the_steam_comment_field_filter' );
if ( ! function_exists( 'the_steam_comment_field_filter' ) ) {
	/**
	 * Function used to modify comment fields that are set up by wordpress
	 *
	 * @param array $args Default fields set up by wordpress.
	 *
	 * @return array Modified fields necessary for the theme to display nice
	 */
	function the_steam_comment_field_filter( $args ) {

		$args = wp_parse_args( $args );

		$args['comment_field'] = '<div class="ts-comments-container ' . esc_attr( the_steam_is_logged_add_class( 'ts-comments-large' ) ) . '"><div class="ts-comment-form-textarea ' . esc_attr( the_steam_is_logged_add_class( 'ts-comments-large' ) ) . '">' . $args['comment_field'];
		$args['comment_field'] = $args['comment_field'] . '</div>';

		if ( is_user_logged_in() ) {
			$args['comment_field'] .= '</div>';
		}

		return $args;
	}
}

add_action( 'admin_notices', 'the_steam_notice_plugin_inactive', 999 );
if ( ! function_exists( 'the_steam_notice_plugin_inactive' ) ) {
	/**
	 * Notices the user if the theme's plugin was not installed
	 */
	function the_steam_notice_plugin_inactive() {
		if ( ! function_exists( 'the_steam_install_plugin' ) ) {
			if ( is_admin() ) {
				?>
				<div class="notice notice-info is-dismissible">
					<p><?php esc_html_e( 'To enjoy functionalities like reservations management, menus and dishes please install The Steam plugin', 'thesteam' ); ?></p>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'the_steam_notice_old_php' ) ) {
	/**
	 * Notices the user that he is using a PHP version older than 5.3
	 */
	function the_steam_notice_old_php() {
			if ( is_admin() ) {
				?>
				<div class="notice notice-info is-dismissible">
					<p><?php esc_html_e( 'You are using a PHP version older than 5.3, launched in 2009. Please update to a newer version, otherwhise the theme may not work properly.', 'thesteam' ); ?></p>
				</div>
				<?php
			}
	}
}

if ( ! function_exists( 'the_steam_check_plugin_active' ) ) {
	/**
	 * Checks if the theme's plugin is active
	 *
	 * @return bool True if plugin is installed
	 */
	function the_steam_check_plugin_active() {
		if ( true === function_exists( 'the_steam_install_plugin' ) ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'the_steam_enqueue_admin_dependencies' ) ) {
	/**
	 * This function is used to enqueue admin scripts
	 */
	function the_steam_enqueue_admin_dependencies() {
		if ( is_page_template( 'PageBuilder' ) ) {
			return;
		}

		wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/layouts/jqueryui/1.11.4/jquery-ui.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-loader', get_template_directory_uri() . '/js/admin/loader/jquery-loader.js', array( 'jquery' ), null, true );

		$admin_data = array(
			'the_steam_submit_reservations_change' => wp_create_nonce( 'the_steam_submit_reservations_change' ),
			'the_steam_submit_reservations_date_change' => wp_create_nonce( 'the_steam_submit_reservations_date_change' ),
			'the_steam_importing_msg' => esc_html__( 'Importing...', 'thesteam' ),
			'the_steam_please_wait_msg' => esc_html__( 'Please wait...', 'thesteam' ),
			'the_steam_done_msg' => esc_html__( 'Done!', 'thesteam' ),
			'the_steam_ok_btn' => esc_html__( 'OK', 'thesteam' ),
			'the_steam_cancel_btn' => esc_html__( 'Cancel', 'thesteam' ),
			'the_steam_exporting_msg' => esc_html__( 'Exporting', 'thesteam' ),
			'the_steam_reset_btn' => esc_html__( 'Reset', 'thesteam' ),
			'the_steam_server_error_1' => esc_html__( 'Server error occurred. Please try again', 'thesteam' ),
			'the_steam_server_error_btn_1' => esc_html__( 'Try again', 'thesteam' ),
			'the_steam_server_error_2' => esc_html__( '- This is caused by the small PHP execution time of your hosting provider. Please increase PHP execution time or try again.', 'thesteam' ),
			'the_steam_import_finished_msg' => esc_html__( 'Importing of demo data is finished!','thesteam' ),
			'the_steam_ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'the_steam_retry_msg' => esc_html__( 'Try again', 'thesteam' ),
		);

		wp_register_script( 'thesteam-admin-js-functions', get_template_directory_uri() . '/js/admin/admin-scripts.js', array( 'jquery' ), null, true );
		wp_localize_script( 'thesteam-admin-js-functions', 'adminData', $admin_data );
		wp_enqueue_script( 'thesteam-admin-js-functions' );

		wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/inc/font-awesome-4.4.0/css/font-awesome.min.css', array(), null );
		wp_enqueue_style( 'jquery-ui', get_stylesheet_directory_uri() . '/layouts/jqueryui/1.11.4/jquery-ui.min.css', array(), null );
		the_steam_enqueue_metaboxes_style();

		$admin_img_style = 'td.media-icon img, img.attachment-post-thumbnail {
            width: 100% !important;
			height: auto !important;}';

		wp_add_inline_style( 'thesteam-admin-styles', $admin_img_style );
	}
}

add_action( 'admin_menu', 'the_steam_create_menu' );
if ( ! function_exists( 'the_steam_create_menu' ) ) {
	/**
	 * This function is used to add menu pages to the admin menu
	 */
	function the_steam_create_menu() {

		// This is for the steam settings.
		$title = esc_html__( 'Settings', 'thesteam' ) . ' - The Steam';
		$name  = esc_html__( 'Theme Settings', 'thesteam' );
		$settings_page = add_theme_page($title, $name, 'manage_options', 'the_steam_view_settings',
		'the_steam_view_settings');

		add_action( 'category_edit_form_fields', 'the_steam_enqueue_admin_dependencies' );
		add_action( 'category_add_form_fields', 'the_steam_enqueue_admin_dependencies' );

		add_action( 'load-' . $settings_page, 'the_steam_load_admin_scripts' );
	}
}

if ( ! function_exists( 'the_steam_load_admin_scripts' ) ) {
	/**
	 * This function is used to add an action for admin scripts
	 */
	function the_steam_load_admin_scripts() {

		add_action( 'admin_enqueue_scripts', 'the_steam_enqueue_admin_dependencies' );
		add_action( 'admin_enqueue_scripts', 'the_steam_enqueue_theme_admin_styles' );
	}
}

if ( ! function_exists( 'the_steam_enqueue_theme_admin_styles' ) ) {
	/**
	 * Enqueues admins panel styles specific for theme pages
	 */
	function the_steam_enqueue_theme_admin_styles() {
		wp_enqueue_style( 'thesteam-theme-settings-admin-styles', get_stylesheet_directory_uri() . '/layouts/admin/settings-special.css', array(), null );
	}
}

if ( ! function_exists( 'the_steam_view_settings' ) ) {
	/**
	 * This function prints out the theme settings in the admin menu
	 */
	function the_steam_view_settings() {

		if ( current_user_can( 'customize' ) ) {
			?>
			<div>
				<h3><?php esc_html_e( 'Theme customization', 'thesteam' ); ?></h3>
				<?php if ( ! function_exists( 'curl_init' ) ) : ?>
					<p>
						<?php esc_html_e( 'Notice: Your PHP Installation is missing the curl plugin. Please install it to be able to use Instagram integration!', 'thesteam' ); ?>
					</p>
				<?php endif; ?>
				<?php if ( ! function_exists( 'simplexml_load_file' ) ) : ?>
					<p>
						<?php esc_html_e( 'Notice: Your PHP Installation is missing the SimpleXML plugin. Please install it if you want to be able to import demo data.', 'thesteam' ); ?>
					</p>
				<?php endif; ?>
				<hr/>
			</div>
			<?php
		}
		?>
		<form method="post" action="options.php">
			<?php settings_fields( 'the-steam-settings-group' ); ?>
			<?php $google_maps_api_key = the_steam_get_option( 'option_maps_api_key', '  ', 300 );
			$protocol = is_ssl() ? 'https' : 'http';
			$google_maps_url = $protocol . '://maps.googleapis.com/maps/api/js';
			if ( isset( $google_maps_api_key ) && '  ' !== $google_maps_api_key && '' !== $google_maps_api_key ) {
				$google_maps_url .= '?key=' . esc_js( $google_maps_api_key );
			}?>
			<?php wp_enqueue_script( 'GMaps', esc_url( $google_maps_url ), array( 'jquery' ), null, true ); ?>
			<p class="submit">
				<input type="submit" class="button-primary the-steam-save-changes-button" id="the-steam-save-changes-upper2"
				       value="<?php esc_attr_e( 'Save Changes', 'thesteam' ); ?>"/>
			</p>
			<hr/>
			<div id="theme-settings-tabs">
				<ul>
					<li><a href="#settings-tabs-1"><?php esc_html_e( 'General', 'thesteam' ); ?></a></li>
                    <li><a href="#settings-tabs-2"><?php esc_html_e( 'Main Sections', 'thesteam' ); ?></a></li>
                    <li><a href="#settings-tabs-3"><?php esc_html_e( 'Menu Book', 'thesteam' ); ?></a></li>
					<li><a href="#settings-tabs-4"><?php esc_html_e( 'Social & Contact', 'thesteam' ); ?></a></li>
					<li><a href="#settings-tabs-5"><?php esc_html_e( 'Reservations', 'thesteam' ); ?></a></li>
					<li><a href="#settings-tabs-6"><?php esc_html_e( 'Blog Slider', 'thesteam' ); ?></a></li>
                    <li><a href="#settings-tabs-7"><?php esc_html_e( 'Footer options', 'thesteam' ); ?></a></li>
                    <li><a href="#settings-tabs-8"><?php esc_html_e( 'Google Analytics', 'thesteam' ); ?></a></li>
				</ul>
				<div id="settings-tabs-1">
					<div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'General Theme Settings', 'thesteam' ); ?> </p>
                            </div>
                        </div>
						<table class="form-table">
							<tr>
								<td>
									<p class="setting setting-title">
                                        <span class="fa fa-arrows-v"></span> <?php esc_html_e( 'Frontpage Desktop Navbar Position:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Choose whether the frontpage navbar should be positioned on top of the page or below the header.', 'thesteam' ); ?></p>
								</td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_navbar_down]"
									        id="blog-carousel-visible">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_navbar_down' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Bottom', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_navbar_down' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Top', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>
							<tr>
								<td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-file-photo-o"></span> <?php esc_html_e( 'Frontpage Header:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Choose between an Image, HTML5 Video or Youtube Video for the FrontPage Header.
									         If HTML5 video selected, please copy and rename the MP4 file in thesteam/inc/header/header.mp4. OGV and webM extensions work as well.
									         If Youtube video is selected, please copy the embed link obtained from Yotube below, eg. https://www.youtube.com/embed/abcdef', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_frontpage_jumbotron_video]"
									        id="jumbotron-video-selector">
										<option
											value="html5" <?php if ( 'html5' === the_steam_get_option( 'option_frontpage_jumbotron_video' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'HTML5 Video', 'thesteam' ); ?>
										</option>
										<option
											value="youtube" <?php if ( 'youtube' === the_steam_get_option( 'option_frontpage_jumbotron_video' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Youtube Video', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'youtube' !== the_steam_get_option( 'option_frontpage_jumbotron_video' ) && 'html5' !== the_steam_get_option( 'option_frontpage_jumbotron_video' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Image', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>
							<tr id="youtube-video-fields">
								<td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-youtube"></span> <?php esc_html_e( 'Youtube Video Embedd URL', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Embedded video url, eg. https://www.youtube.com/embed/XXXXXXX', 'thesteam' ); ?></p>
                                </td>
								<td>
									<input class="select-top-align" type="text" size="10" name="the_steam_options[option_youtube_video_url]"
									       value="<?php echo esc_url( the_steam_get_option( 'option_youtube_video_url', esc_attr__( 'example', 'thesteam' ), 600 ) ); ?>"
									       id="youtube-video-url">
								</td>
							</tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-money"></span> <?php esc_html_e( 'Currency:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( "Currency to display along with the prices for your restaurant`s dishes. Relies on the plugin being activated.", 'thesteam' ); ?></p>
                                </td>
                                <td><input type="text" name="the_steam_options[option_currency]"
                                           value="<?php echo esc_attr( the_steam_get_option( 'option_currency', '' ) ); ?>"
                                           id="currency" class="select-top-align">
                                </td>
                            </tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-arrows-h"></span> <?php esc_html_e( 'Currency after digits:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Displays currency after price digits, for example: 15 Euro', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_currency_after]"
									        id="blog-carousel-visible">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_currency_after' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_currency_after' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-calendar"></span> <?php esc_html_e( 'Reservations date format USA:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'If yes, then date format on the FrontPage will be mm/dd/yy. If not, date format will be dd/mm/yy.', 'thesteam' ); ?></p>
                                </td>
                                <td>
									<select class="select-top-align" name="the_steam_options[option_date_format_usa]"
									        id="reservations-enabled">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_date_format_usa' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_date_format_usa' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-film"></span> <?php esc_html_e( 'Enable parallax effect:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Enables parallax effect on front page for desktop devices.', 'thesteam' ); ?></p>
                                </td>
                                <td>
									<select class="select-top-align" name="the_steam_options[option_parallax_enabled]"
											id="blog-carousel-visible">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_parallax_enabled' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_parallax_enabled' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>

							<tr>
								<td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-clock-o"></span> <?php esc_html_e( 'Disable limiting of reservations & contact - prevents spam:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'If yes, then usage of contact form and reservations will no longer be limited to one per 30 minutes.', 'thesteam' ); ?></p>
                                </td>
                                <td>
									<select class="select-top-align" name="the_steam_options[option_disable_spam_limit]">
									        id="reservations-enabled"
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_disable_spam_limit' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_disable_spam_limit' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope"></span> <?php esc_html_e( 'Use e-mail headers:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'If your hosting provider doesn`t support e-mail headers, turn them off and you will receive e-mails.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_use_email_headers]">
									        id="reservations-enabled"
									        <option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_use_email_headers' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_use_email_headers' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-mobile fa-2x"></span> <?php esc_html_e( 'Enable haptic feedback:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Enables mobile vibrations on certain buttons and links throughout the website.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_vibrate_enabled]" id="vibrate">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_vibrate_enabled' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_vibrate_enabled' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-map-marker"></span> <?php esc_html_e( 'Hide FrontPage Map Location Text:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'This option hides the box on top of the FrontPage map.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_disable_map_text]">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_disable_map_text' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_disable_map_text' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-map-marker"></span> <?php esc_html_e( 'Enable map marker bounce:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'This option makes the map marker bounce - animation.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_maker_bounce]">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_maker_bounce' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_maker_bounce' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-link"></span> <?php esc_html_e( 'Hide Next/Prev Posts in Blog:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'This option hides Previous/Suggested/Next navigation when preview-ing a Post/Page.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select class="select-top-align" name="the_steam_options[option_hide_next_prev]">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_hide_next_prev' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_hide_next_prev' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-comment-o"></span> <?php esc_html_e( 'Hide "Comments are closed":', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Hides the "Comments are closed" message in the blog when set.', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select class="select-top-align" name="the_steam_options[option_hide_comments_closed]"
                                            id="option_hide_comments_e1">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_hide_comments_closed' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_hide_comments_closed' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-diamond"></span> <?php esc_html_e( 'Hide Diamond Symbols:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Hides Diamonds Symbols on Front Page', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select class="select-top-align" name="the_steam_options[option_hide_diamonds]"
                                            id="option_hide_diamonds">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_hide_diamonds' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_hide_diamonds' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-refresh"></span> <?php esc_html_e( 'Reset theme settings:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Resets theme settings to default.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<div class="reset-changes">
										<input type="button" class="reset-default select-top-align" value="<?php esc_html_e( 'Reset', 'thesteam' ); ?>"/>
									</div>
								</td>
							</tr>
                            <!--import demo data-->
							<tr>
								<?php if ( function_exists( 'simplexml_load_file' ) ) : ?>
									<td>
										<p class="setting setting-title">
											<span class="fa fa-download"></span> <?php esc_html_e( 'Import Demo Posts:', 'thesteam' ); ?>
										</p>
										<p class="setting setting-description"><?php esc_attr_e( 'Imports demo data: posts/ dishes/ images.', 'thesteam' ); ?></p>
									</td>
									<td>
										<div>
											<?php if ( the_steam_check_plugin_active() ) : ?>
												<input type="button" class="import-demo-data select-top-align" value="<?php esc_html_e( 'Import', 'thesteam' ); ?>" title="<?php esc_attr_e( 'When The Steam plugin is active, demo posts, categories and dishes can be imported with one click', 'thesteam' ); ?>"/>
											<?php else : ?>
												<p><?php esc_html_e( 'Please activate The Steam plugin to import demo data', 'thesteam' ); ?></p>
											<?php endif; ?>
											<img class="loading-gif" src="<?php echo esc_url( get_template_directory_uri() . '/inc/loading32x32.gif' );?>"/>
										</div>
									</td>
								<?php else : ?>
									<td>
										<p><?php esc_html_e( 'SimpleXML PHP Module is needed if you want to import demo data', 'thesteam' ); ?></p>
									</td>
								<?php endif; ?>
							</tr>
							<tr>
								<td>
									<p class="setting setting-title">
										<span class="fa fa-download"></span> <?php esc_html_e( 'Create EGF Controls:', 'thesteam' ); ?>
									</p>
									<p class="setting setting-description"><?php esc_attr_e( 'Create controls for Easy Google Fonts plugin. This enables you to change typography / fonts / sizes etc in the Wordpress Customizer. Existing controls will not be modified.', 'thesteam' ); ?></p>
								</td>
								<td>
									<div>
										<?php if ( the_steam_check_plugin_active() && class_exists( 'EGF_Posttype' ) ) : ?>
											<input type="button" class="create-demo-controls select-top-align" value="<?php esc_html_e( 'Create', 'thesteam' ); ?>" title="<?php esc_attr_e( 'When The Steam plugin & Easy Google Fonts plugin are active, demo controls for typography changes can be created with one click', 'thesteam' ); ?>"/>
										<?php else : ?>
											<?php if (!the_steam_check_plugin_active()) { ?>
												<p><?php esc_html_e( 'Please activate The Steam Plugin', 'thesteam' ); ?></p>
											<?php }; ?>
											<?php if (!class_exists( 'EGF_Posttype' )) { ?>
												<p><?php esc_html_e( 'Please activate Easy Google Fonts Plugin', 'thesteam' ); ?></p>
											<?php }; ?>
										<?php endif; ?>
										<img class="loading-gif" src="<?php echo esc_url( get_template_directory_uri() . '/inc/loading32x32.gif' );?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div id="import-response">
									</div>
								</td>
							</tr>
						</table>
						<div id="dialog-confirm" title="<?php esc_html_e( 'Delete all theme settings?', 'thesteam' ); ?>">
							<p><span class="ui-icon ui-icon-alert ts-admin-alert"></span><?php esc_html_e( 'This action cannot be undone!', 'thesteam' ); ?></p>
						</div>
						<div id="dialog-confirm-import" title="<?php esc_html_e( 'Import demo data?', 'thesteam' ); ?>">
							<p><span class="ui-icon ui-icon-alert ts-admin-alert"></span><?php esc_html_e( 'Available in english only, usually takes up to five minutes depending on your server\'s connection. If first attempt failed, please increase php max_execution_time or try again!', 'thesteam' ); ?></p>
						</div>
					</div>
				</div>
				<div id="settings-tabs-4">
					<div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'Social & Contact Details', 'thesteam' ); ?> </p>
                            </div>
                        </div>
						<table class="form-table">
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-mobile-phone fa-2x"></span> <?php esc_html_e( 'Phone Number:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Phone number used to contact your restaurant and for reservations. It may be a good idea to also provide country code', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_phone_number]"
								           value="<?php echo esc_attr( the_steam_get_option( 'option_phone_number', '' ) ); ?>"
								           id="phone-number" class="select-top-align-social"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-mobile-phone fa-2x"></span> <?php esc_html_e( 'Phone Num. in mobile menu:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Shows the phone number in the mobile menu and is callable from mobile devices', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_phone_in_menu]"
									        id="phone-num-visible" class="select-top-align-social">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_phone_in_menu' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_phone_in_menu' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-building-o"></span> <?php esc_html_e( 'Address (Street):', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Address of your restaurant', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_street]" class="select-top-align-social"
								           value="<?php echo esc_attr( the_steam_get_option( 'option_street', '', 300 ) ); ?>" id="street"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope"></span> <?php esc_html_e( 'E-Mail for Contact Us (Footer):', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'E-Mail Address used to receive messages sent via Contact Us Box (Footer)', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_email_contact_us]" class="select-top-align-social"
								           value="<?php echo esc_attr( the_steam_get_option( 'option_email_contact_us', get_option('admin_email'), 300 ) ); ?>" id="street"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope"></span> <?php esc_html_e( 'E-Mail for Reservations:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'E-Mail Address used to receive reservations emails. Works when E-Mail is setup correctly in WordPress and of course when not using OpenTable.', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_email_reservations]" class="select-top-align-social"
								           value="<?php echo esc_attr( the_steam_get_option( 'option_email_reservations', get_option('admin_email'), 300 ) ); ?>" id="street"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-globe "></span> <?php esc_html_e( 'City:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'City followed by country (optional)', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_city]"
								           value="<?php echo esc_attr( the_steam_get_option( 'option_city', '', 300 ) ); ?>"
								           id="city" class="select-top-align-social"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-facebook-official"></span> <?php esc_html_e( 'Facebook URL:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Link to your Facebook page', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_fb_url]"
								           value="<?php echo  esc_url( the_steam_get_option( 'option_fb_url', '', 300 ) ); ?>"
								           id="facebook-url" class="select-top-align-social"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-twitter-square"></span> <?php esc_html_e( 'Twitter URL:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Link to your Twitter account', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <input type="text" name="the_steam_options[option_tw_url]"
								           value="<?php echo esc_attr( esc_url( the_steam_get_option( 'option_tw_url', '', 300 ) ) ); ?>"
								           id="twitter-url" class="select-top-align-social"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-foursquare"></span> <?php esc_html_e( 'Foursquare URL:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Link to your your Foursquare account', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_foursquare_url]"
								           value="<?php echo esc_attr( esc_url( the_steam_get_option( 'option_foursquare_url', '', 300 ) ) ); ?>"
								           id="foursquare-url" class="select-top-align-social"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-instagram"></span> <?php esc_html_e( 'Instagram URL:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Link to your your Instagram account', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_instagram_url]"
								           value="<?php echo esc_attr( esc_url( the_steam_get_option( 'option_instagram_url', '', 300 ) ) ); ?>"
								           id="instagram-url" class="select-top-align-social"/>
								</td>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-pinterest"></span> <?php esc_html_e( 'Pinterest URL:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Link to your your Pinterest account', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_pinterest_url]"
								           value="<?php echo esc_attr( esc_url( the_steam_get_option( 'option_pinterest_url', '', 300 ) ) ); ?>"
								           id="pinterest-url" class="select-top-align-social"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-tripadvisor"></span> <?php esc_html_e( 'Trip Advisor URL:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Link to your your Trip Advisor account', 'thesteam' ); ?></p>
                                </td>
								<td><input type="text" name="the_steam_options[option_tripadvisor_url]"
								           value="<?php echo esc_attr( esc_url( the_steam_get_option( 'option_tripadvisor_url', '', 300 ) ) ); ?>"
								           id="tripadvisor-url" class="select-top-align-social"/>
								</td>
							</tr>
							<tr>
								<td>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div id="settings-tabs-5">
					<div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'Reservations options', 'thesteam' ); ?> </p>
                            </div>
                        </div>
						<table class="form-table">
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-bookmark-o"></span> <?php esc_html_e( 'Reservation system:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Selected between TheSteam integrated reservations system and Open Table', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_use_opentable]"
									        id="reservation-system-selector" class="select-top-align">
										<option
											value="no" <?php if ( the_steam_get_option( 'option_use_opentable' ) !== 'yes' ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'The Steam', 'thesteam' ); ?>
										</option>
										<option
											value="yes" <?php if ( the_steam_get_option( 'option_use_opentable' ) === 'yes' ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Open Table', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-user-o"></span> <?php esc_html_e( 'Secondary field:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Apart from phone number, choose if guests can provide name or email', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_secondary_field]"
									        id="reservation-system-selector" class="select-top-align">
										<option
											value="email" <?php if ( the_steam_get_option( 'option_secondary_field' ) !== 'name' ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'E-Mail', 'thesteam' ); ?>
										</option>
										<option
											value="name" <?php if ( the_steam_get_option( 'option_secondary_field' ) === 'name' ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Name', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr id="opentable-restaurant-id-fields">
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-id-badge"></span> <?php esc_html_e( 'OpenTable Restaurant ID:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Restaurant ID you received when you registered with Open Table.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<input type="text" size="10" name="the_steam_options[option_opentable_restaurant_id]"
									       value="<?php echo esc_attr( the_steam_get_option( 'option_opentable_restaurant_id', esc_attr__( '000000', 'thesteam' ), 20 ) ); ?>"
									       id="opentable-restaurant-id-number" class="select-top-align">
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope"></span> <?php esc_html_e( 'E-Mail Address required for reservation:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'If enabled, e-mail address will be required to submit a reservation request. If name is selected for secondary field, this will have no effect.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_enforce_email]"
									        id="blog-carousel-visible" class="select-top-align">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_enforce_email' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_enforce_email' ) ) {
											echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>

									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope"></span> <?php esc_html_e( 'Reservation confirmation notification:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Send back email to confirm reservation was received', 'thesteam' ); ?></p>
                                </td>
                                <td>
									<select name="the_steam_options[option_received_reservation_sendmail]"
									        id="received-reservation-sendmail" class="select-top-align">
										<option
											value="yes" <?php if ( the_steam_get_option( 'option_received_reservation_sendmail' ) === 'yes' ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( the_steam_get_option( 'option_received_reservation_sendmail' ) !== 'yes' ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope"></span> <?php esc_html_e( 'Notify admin for reservation via email:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Admin receives email for every new reservation', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_received_reservation_send_admin_mail]"
									        id="notify-reservation-email" class="select-top-align">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_received_reservation_send_admin_mail' )  ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_received_reservation_send_admin_mail' )  ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope"></span> <?php esc_html_e( 'E-Mail Title:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Title of the e-mail to be sent to client when receiving a reservation', 'thesteam' ); ?></p>
                                </td>
								<td>
									<input type="text" size="78" name="the_steam_options[option_received_reservation_title]"
									       value="<?php echo esc_attr( the_steam_get_option( 'option_received_reservation_title', esc_attr__( 'Thank you for your reservation!', 'thesteam' ), 100 ) ); ?>"
									       id="received-reservation-title" class="select-top-align reservation-field">
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-sticky-note-o"></span> <?php esc_html_e( 'E-Mail Body:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Body of the e-mail to send when receiving a reservation', 'thesteam' ); ?></p>
                                </td>
								<td><textarea cols="80" rows="12"
								              name="the_steam_options[option_received_reservation_body]"
								              id="received-reservation-body" class="reservation-text-field">
                                        <?php echo wp_kses( the_steam_get_option( 'option_received_reservation_body', '',900 ), the_steam_get_valid_theme_kses() ); ?>
									</textarea></td>
							</tr>
							<tr>
								<td colspan="2">
                                    <hr class="admin-hr-element"/>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-check-square-o"></span> <?php esc_html_e( 'Reservation confirmed email:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Send back email to confirm reservation was accepted', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_accepted_reservation_sendmail]"
									        id="accepted-reservation-sendmail" class="select-top-align">
										<option
											value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_accepted_reservation_sendmail' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Yes', 'thesteam' ); ?>
										</option>
										<option
											value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_accepted_reservation_sendmail' ) ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'No', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-check-square-o"></span> <?php esc_html_e( 'Confirmation E-Mail Title:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Title of the e-mail to send when confirming an accepted reservation.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<input type="text" size="78" name="the_steam_options[option_accepted_reservation_title]"
									       value="<?php echo esc_attr( the_steam_get_option( 'option_accepted_reservation_title', esc_attr__( 'Reservation confirmed!', 'thesteam' ), 50 ) ); ?>"
									       id="accepted-reservation-title" class="select-top-align reservation-field" >
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-sticky-note-o"></span> <?php esc_html_e( 'Confirmation E-Mail Body:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Body of the e-mail to send when confirming an accepted reservation.', 'thesteam' ); ?></p>
                                </td>
								<td><textarea cols="80" rows="12"
								              name="the_steam_options[option_accepted_reservation_body]"
								              id="accepted-reservation-body" class="select-top-align reservation-text-field">
									<?php echo wp_kses( the_steam_get_option( 'option_accepted_reservation_body', '  ', 900 ), the_steam_get_valid_theme_kses() ); ?></textarea>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div id="settings-tabs-6">
					<div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'Front Page Blog Slider', 'thesteam' ); ?> </p>
                            </div>
                        </div>
						<table class="form-table">
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa fa-sitemap"></span> <?php esc_html_e( 'Max Number of Items:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Maximum number of blog featured images to display in the blog carousel on one page. Actual number depends on client screen size.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_carousel_items]" id="carousel_items" class="select-top-align">
										<option
											value="4" <?php if (  '4' === the_steam_get_option( 'option_carousel_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											4
										</option>
										<option
											value="5" <?php if (  '5' === the_steam_get_option( 'option_carousel_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											5
										</option>
										<option
											value="6" <?php if (  '6' === the_steam_get_option( 'option_carousel_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											6
										</option>
										<option
											value="7" <?php if ( '7' === the_steam_get_option( 'option_carousel_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											7
										</option>
										<option
											value="8" <?php if ( '8' === the_steam_get_option( 'option_carousel_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											8
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-list-ol"></span> <?php esc_html_e( 'Total Number of Items:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Total number of blog featured images to display in the blog carousel on one page. A number too large may impact page loading times.', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_carousel_total_items]" id="carousel_items" class="select-top-align">
										<option
											value="8" <?php if (  '8' === the_steam_get_option( 'option_carousel_total_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											8
										</option>
										<option
											value="10" <?php if (  '10' === the_steam_get_option( 'option_carousel_total_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											10
										</option>
										<option
											value="12" <?php if (  '12' === the_steam_get_option( 'option_carousel_total_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											12
										</option>
										<option
											value="14" <?php if ( '14' === the_steam_get_option( 'option_carousel_total_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											14
										</option>
										<option
											value="16" <?php if ( '16' === the_steam_get_option( 'option_carousel_total_items' )  ) {
												echo esc_attr( 'selected' );} ?>>
											16
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-play"></span> <?php esc_html_e( 'Auto Play:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Allow for the blog slider to play trough images automatically', 'thesteam' ); ?></p>
                                </td>
								<td>
									<select name="the_steam_options[option_carousel_enabled]" id="carousel-enabled" class="select-top-align">
										<option
											value="true" <?php if (  'true' === the_steam_get_option( 'option_carousel_enabled' )  ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'On', 'thesteam' ); ?>
										</option>
										<option
											value="false" <?php if ( 'true' !== the_steam_get_option( 'option_carousel_enabled' )   ) {
												echo esc_attr( 'selected' );} ?>>
											<?php esc_html_e( 'Off', 'thesteam' ); ?>
										</option>
									</select>
								</td>
							</tr>
							<tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-clock-o"></span> <?php esc_html_e( 'Slide Show Delay (seconds):', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Number of seconds to wait before switching to the next image in the slider', 'thesteam' ); ?></p>
                                </td>
								<td>
									<input maxlength="2" size="4" type="text"
									       name="the_steam_options[option_carousel_delay]"
									       value="<?php echo esc_attr( the_steam_get_option( 'option_carousel_delay', '5' ) ); ?>"
									       id="carousel-delay" class="select-top-align special-top-align">
								</td>
							</tr>
							<tr>
								<td>
								</td>
							</tr>
						</table>
					</div>
				</div>
                <div id="settings-tabs-2">
                    <div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'Main Front Page Sections', 'thesteam' ); ?> </p>
                            </div>
                        </div>
                        <table class="form-table">
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-info"></span> <?php esc_html_e( 'Enable about section:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Display the About us section on the front page, right below the header', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_enable_about_section]"
                                            id="blog-about-visible" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_enable_about_section' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_enable_about_section' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>

                                    </select>
                                </td>
                            </tr>
	                        <tr>
		                        <td>
			                        <p class="setting setting-title">
				                        <span class="fa fa-info"></span> <?php esc_html_e( 'Enable menu book description section:', 'thesteam' ); ?>
			                        </p>
			                        <p class="setting setting-description"><?php esc_attr_e( 'Display the menu book section section on the front page - the second parallax image', 'thesteam' ); ?></p>
		                        </td>
		                        <td>
			                        <select name="the_steam_options[option_enable_parallax_image_2]"
			                                id="blog-about-visible" class="select-top-align">
				                        <option
					                        value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_enable_parallax_image_2' ) ) {
					                        echo esc_attr( 'selected' );} ?>>
					                        <?php esc_html_e( 'Yes', 'thesteam' ); ?>
				                        </option>
				                        <option
					                        value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_enable_parallax_image_2' ) ) {
					                        echo esc_attr( 'selected' );} ?>>
					                        <?php esc_html_e( 'No', 'thesteam' ); ?>
				                        </option>

			                        </select>
		                        </td>
	                        </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-pie-chart"></span> <?php esc_html_e( 'Enable dish types:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Display dish type icons and description on front page, above menu book', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_enable_dish_types]"
                                            id="blog-carousel-visible" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_enable_dish_types' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_enable_dish_types' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-map-o"></span> <?php esc_html_e( 'Enable menu book:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Display menu book on front page', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_enable_menubook]"
                                            id="blog-carousel-visible" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_enable_menubook' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_enable_menubook' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-picture-o"></span> <?php esc_html_e( 'Enable blog slider:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Show the blog slider on the front page', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_carousel_visible]"
                                            id="blog-carousel-visible" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_carousel_visible' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_carousel_visible' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-calendar"></span> <?php esc_html_e( 'Enable reservations:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Accept reservations for your restaurant on this website. Depends on plugin being active!', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_reservations_enabled]"
                                            id="reservations-enabled" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_reservations_enabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_reservations_enabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-picture-o"></span> <?php esc_html_e( 'Enable Front Page Gallery:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Show a gallery of images on frontpage. You can select the images to be shown in the customizer', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_gallery_enabled]"
                                            id="gallery-enabled" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_gallery_enabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_gallery_enabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-map-marker"></span> <?php esc_html_e( 'Disable FrontPage Map:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'This hides the map from the Front Page', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_disable_map]" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_disable_map' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_disable_map' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="settings-tabs-7">
                    <div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'Footer options are also available in the Live Customizer', 'thesteam' ); ?> </p>
                            </div>
                        </div>
                        <table class="form-table">
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-cutlery"></span> <?php esc_html_e( 'Restaurant Cuisine:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Restaurant cuisine, i.e: Fusion Cuisine. Will be displayed in the footer, if set.', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <input type="text" name="the_steam_options[option_cuisine]"
                                           value="<?php echo esc_attr( the_steam_get_option( 'option_cuisine', '' ) ); ?>"
                                           id="cuisine" class="select-top-align-social special-top-align cuisine">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-clock-o"></span> <?php esc_html_e( 'Opening hours:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Restaurant opening hours i.e: Mo-Sun 9am - 12pm', 'thesteam' ); ?></p>
                                </td>
                                <td><input type="text" name="the_steam_options[opening_hours]"
                                           value="<?php echo esc_attr( the_steam_get_option( 'opening_hours', '', 300 ) ); ?>"
                                           id="hours" class="select-top-align-social special-top-align cuisine">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-envelope-o"></span> <?php esc_html_e( 'Enable contact form (plugin dependent):', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'If enabled it shows the contact form in footer, otherwise it will show a paragraph of customizable text. Contact form relies on the plugin being activated.', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_contact_form]"
                                            id="contact_form_enabled" class="select-top-align-social cuisine">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_contact_form' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_contact_form' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="settings-tabs-8">
                    <div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'Designated Google Analytics Field', 'thesteam' ); ?> </p>
                            </div>
                        </div>
                        <table class="form-table">
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-google"></span> <?php esc_html_e( 'Google Analytics Tracking Code:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Paste here the code from Google Analytics to see where your visitors come from', 'thesteam' ); ?></p>
                                </td>
                                <td><textarea cols="80" rows="12"
                                              name="the_steam_options[option_analytics_code]"
                                              id="analytics-tracking-code" class="select-top-align reservation-text-field">
                                        <?php echo the_steam_get_option( 'option_analytics_code', '  ', 9900 ); ?></textarea>
                                </td>
                            </tr>
	                        <tr>
		                        <td>
			                        <p class="setting setting-title">
				                        <span class="fa fa-rocket"></span> <?php esc_html_e( 'Boost caching:', 'thesteam' ); ?>
			                        </p>
			                        <p class="setting setting-description"><?php esc_attr_e( 'This enables sending "Last modified" headers. This will help boost caching of your website, however it should be disabled during development so you can see your changes instantly.', 'thesteam' ); ?></p>
		                        </td>
		                        <td>
			                        <select class="select-top-align" name="the_steam_options[option_enable_last_modified_headers]">
				                        <option
					                        value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_enable_last_modified_headers' ) ) {
					                        echo esc_attr( 'selected' );} ?>>
					                        <?php esc_html_e( 'Yes', 'thesteam' ); ?>
				                        </option>
				                        <option
					                        value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_enable_last_modified_headers' ) ) {
					                        echo esc_attr( 'selected' );} ?>>
					                        <?php esc_html_e( 'No', 'thesteam' ); ?>
				                        </option>

			                        </select>
		                        </td>
	                        </tr>
                        </table>
                    </div>
                </div>
                <div id="settings-tabs-3">
                    <div>
                        <div class="category-align-top">
                            <div class="admin-subtitle-container">
                                <p class="admin-subtitle"> <?php esc_html_e( 'Front Page Menu Book Options', 'thesteam' ); ?> </p>
                            </div>
                        </div>
                        <table class="form-table">
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-file-o"></span> <?php esc_html_e( 'Enable dish pages:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'This option enables dedicated pages for dishes along with a detailed menu of dishes. Relies on the plugin being activated.', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_dish_enabled]" class="select-top-align" id="dish_enabled">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_dish_enabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_dish_enabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-map-o"></span> <?php esc_html_e( 'Number of dish types on Front Page:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Always show four main general categories on frontpage, or show as many as look fine according to screen width. If unlimited, then it will be possible to swipe them.', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_4_main_categories]"
                                            id="number-of-dishtypes" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_4_main_categories' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Four', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_4_main_categories' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Unlimited', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-sort"></span> <?php esc_html_e( 'Menu book dish order:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Display menu book items  Descending or Ascending.', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_menubook_order]"
                                            id="blog-carousel-visible" class="select-top-align">
                                        <option value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_menubook_order' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Ascending', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_menubook_order' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Descending', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
	                        <tr>
		                        <td>
			                        <p class="setting setting-title">
				                        <span class="fa fa-sort"></span> <?php esc_html_e( 'Front Page Menu book dishes ordered by:', 'thesteam' ); ?>
			                        </p>
			                        <p class="setting setting-description"><?php esc_attr_e( 'Display menu book items by creation date or by custom number set when editing the dish.', 'thesteam' ); ?></p>
		                        </td>
		                        <td>
			                        <select name="the_steam_options[option_frontpage_menu_order]"
			                                id="blog-carousel-visible" class="select-top-align">
				                        <option value="number" <?php if ( 'number' === the_steam_get_option( 'option_frontpage_menu_order' ) ) {
					                        echo esc_attr( 'selected' );} ?>>
					                        <?php esc_html_e( 'Custom number', 'thesteam' ); ?>
				                        </option>
				                        <option
					                        value="date" <?php if ( 'number' !== the_steam_get_option( 'option_frontpage_menu_order' ) ) {
					                        echo esc_attr( 'selected' );} ?>>
					                        <?php esc_html_e( 'Date', 'thesteam' ); ?>
				                        </option>
			                        </select>
		                        </td>
	                        </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-gift"></span> <?php esc_html_e( 'Enable menu book hover preview:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Animate menu book item on hover by displaying the dish image in the background', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_enable_menubook_preview]"
                                            id="menu-book-hover-preview" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_enable_menubook_preview' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_enable_menubook_preview' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="setting setting-title">
                                        <span class="fa fa-moon-o"></span> <?php esc_html_e( 'Disable menu book dark filter:', 'thesteam' ); ?>
                                    </p>
                                    <p class="setting setting-description"><?php esc_attr_e( 'Hide the default dark filter behind the menu book text on front page', 'thesteam' ); ?></p>
                                </td>
                                <td>
                                    <select name="the_steam_options[option_filter_menu_book_disabled]"
                                            id="menu-book-dark-filter" class="select-top-align">
                                        <option
                                            value="yes" <?php if ( 'yes' === the_steam_get_option( 'option_filter_menu_book_disabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'Yes', 'thesteam' ); ?>
                                        </option>
                                        <option
                                            value="no" <?php if ( 'yes' !== the_steam_get_option( 'option_filter_menu_book_disabled' ) ) {
                                            echo esc_attr( 'selected' );} ?>>
                                            <?php esc_html_e( 'No', 'thesteam' ); ?>
                                        </option>

                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
			</div>
			<p></p>
			<hr/>
			<?php
			// This has to be enqueued at this point!.
			wp_enqueue_script( 'AdminJSMapHelpers',get_template_directory_uri() . '/js/admin/admin-map-helpers.js', array( 'GMaps', 'jquery' ), null, true );
			?>
			<p class="submit">
				<input type="submit" class="button-primary the-steam-save-changes-button" id="the-steam-save-changes-upper1"
				       value="<?php esc_attr_e( 'Save Changes', 'thesteam' ); ?>"/>
			</p>
			<hr/>
			<div id="map-table-container">
				<table class="form-table map-section-table">
					<tr class="hidden">
						<td><?php esc_html_e( 'Latitude:', 'thesteam' ); ?></td>
						<td>
							<input type="text" name="the_steam_options[option_map_latitude]"
							       value="<?php echo esc_attr( the_steam_get_option( 'option_map_latitude', '40.707139681781946', 1000 ) ); ?>"
							       id="map-latitude"
							       title="<?php esc_attr_e( 'Latitude of your restaurant location. Gets updated automatically when you click on the map below', 'thesteam' ); ?>"/>
						</td>
					</tr>
					<tr class="hidden">
						<td><?php esc_html_e( 'Longitude:', 'thesteam' ); ?></td>
						<td>
							<input type="text" name="the_steam_options[option_map_longitude]"
							       value="<?php echo esc_attr( the_steam_get_option( 'option_map_longitude', '-74.00296211242676', 1000 ) ); ?>"
							       id="map-longitude"
							       title="<?php esc_attr_e( 'Longitude of your restaurant location. Gets updated automatically when you click on the map below', 'thesteam' ); ?>"/>

							<input type="hidden" name="the_steam_options[option_map_zoom]"
							       id="map-zoom"
							       value="<?php echo esc_attr( the_steam_get_option( 'option_map_zoom', '5' ) );
									?>"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p class="setting-title"><?php esc_html_e( 'It easy and takes less than a minute to get your FREE Google Maps API Key.', 'thesteam' ); ?> <a href="<?php echo esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#key' ); ?>"><?php esc_html_e( 'Obtain API Key!', 'thesteam' ); ?></a></p>
						</td>
					</tr>
                    <tr>
                        <td colspan="2">
                            <hr class="admin-hr-element"/>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p class="setting setting-title">
                                <span class="fa fa-google"></span> <?php esc_html_e( 'Google Maps API Key:', 'thesteam' ); ?>
                            </p>
                            <p class="setting setting-description"><?php esc_attr_e( 'Google Maps API Key needed for maps authentication. Map will not work without a key!', 'thesteam' ); ?></p>
                        </td>
                        <td>
							<input type="text" size="65" name="the_steam_options[option_maps_api_key]"
							       value="<?php echo esc_attr( the_steam_get_option( 'option_maps_api_key', '', 150 ) ); ?>"
                                   id="map-longitude" class="select-top-align-social map-text-field">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p><b><?php esc_html_e( 'To zoom in/out of the map use the scroll wheel on the mouse and click save.', 'thesteam' ); ?></b></p>
	                        <p><b><?php esc_html_e( 'Click map to add/remove markers!', 'thesteam' ); ?></b></p>
	                        <p><b><?php esc_html_e( 'First added marker will center the map on Front Page!', 'thesteam' ); ?></b></p>
						</td>
					</tr>
                    <tr>
                        <td colspan="2">
                            <hr class="admin-hr-element"/>
                        </td>
                    </tr>
					<tr>
						<td colspan="2">
							<div id="google-map-selection"></div>
						</td>
					</tr>
                    <tr>
                        <td colspan="2">
                            <hr class="admin-hr-element"/>
                        </td>
                    </tr>
				</table>
			</div>
			<div id="map-invalid-dialog" title="<?php esc_attr_e( 'Error', 'thesteam' ); ?>">
				<p><span class="ui-icon ui-icon-alert ts-admin-alert"></span><?php esc_html_e( 'Invalid map coordinates! Please check values and then try again!', 'thesteam' ); ?></p>
			</div>
			<hr/>
			<p class="submit">
				<input type="submit" class="button-primary the-steam-save-changes-button" id="the-steam-save-changes"
				       value="<?php esc_attr_e( 'Save Changes', 'thesteam' ); ?>"/>
			</p>
		</form>
		<?php
	}
}

add_action( 'wp_ajax_the_steam_create_demo_data_1', 'the_steam_create_demo_data_1' );
add_action( 'wp_ajax_nopriv_the_steam_create_demo_data_1', 'the_steam_create_demo_data_1' );

if ( ! function_exists( 'the_steam_create_demo_data_1' ) ) {
	/**
	 * This function is used to create a fully functional demo site
	 * It is the first part since demo data is imported in two steps
	 * to try to avoid reaching script max execution time on shared hosts
	 */
	function the_steam_create_demo_data_1() {

		if ( ! current_user_can( 'manage_categories' ) ) {
			die( esc_html__( 'Insufficient permissions!', 'thesteam' ) );
		}

		/* Demo posts and categories are created by the plugin */
		if ( the_steam_check_plugin_active() ) {
			if ( function_exists( 'the_steam_create_demo_categories' ) ) {
				the_steam_create_demo_categories();
			}
			if ( function_exists( 'the_steam_create_demo_posts' ) ) {
				the_steam_create_demo_posts();
			}
		}

		$menu_name = esc_html__( 'The Steam Blog Demo', 'thesteam' );
		$menu_exists = wp_get_nav_menu_object( $menu_name );

		/* If blog menu exists, overwrite it to add newly crerated categories. */
		if ( $menu_exists ) {
			wp_delete_nav_menu( $menu_name );
			the_steam_create_demo_blog_menu_items();
		}

		if ( the_steam_check_plugin_active() ) {
			if ( function_exists( 'the_steam_create_demo_data_2' ) ) {
				// Creation and importing of custom posts is provided by the plugin.
				the_steam_create_demo_data_2();
			}
		}
		die( esc_html__( 'Done!', 'thesteam' ) );
	}
}

add_action( 'add_meta_boxes', 'the_steam_meta_boxes_init' );
add_action( 'add_meta_boxes', 'the_steam_enqueue_metaboxes_style' );
if ( ! function_exists( 'the_steam_enqueue_metaboxes_style' ) ) {
	/**
	 * Enqueues style for admin panel custom theme metaboxes
	 */
	function the_steam_enqueue_metaboxes_style() {

		wp_enqueue_style( 'thesteam-admin-styles', get_template_directory_uri() . '/layouts/admin/admin-styles.css', array(), null );
	}
}
if ( ! function_exists( 'the_steam_meta_boxes_init' ) ) {
	/**
	 * Intializes metaboxes added by the theme
	 */
	function the_steam_meta_boxes_init() {

		$currency = the_steam_get_option( 'option_currency', '$' );
		$order = the_steam_get_option( 'option_order', '0' );

		add_meta_box( 'post_subtitle', esc_html__( 'Subtitle (Optional)', 'thesteam' ), 'the_steam_post_subtitle_box', 'post', 'advanced', 'default' );
		add_meta_box( 'page_subtitle', esc_html__( 'Subtitle (Optional)', 'thesteam' ), 'the_steam_page_subtitle_box', 'page', 'advanced', 'default' );

		add_meta_box( 'seo_description', esc_html__( 'Meta Description (SEO)', 'thesteam' ), 'the_steam_post_description_box', 'post', 'advanced', 'default' );
		add_meta_box( 'seo_description', esc_html__( 'Meta Description (SEO)', 'thesteam' ), 'the_steam_page_description_box', 'page', 'advanced', 'default' );

		if ( the_steam_check_plugin_active() ) {
			/* Will now add dish metaboxes if plugin is active */
			add_meta_box( 'dishtype_chooser', esc_html__( 'Dish type', 'thesteam' ), 'the_steam_dish_tax_term_box', 'dish', 'side', 'default' );
			add_meta_box( 'dish_price', esc_html__( 'Dish Price', 'thesteam' ) . ' (' . $currency . ')', 'the_steam_dish_price_box', 'dish', 'side', 'default' );
			add_meta_box( 'dish_order', esc_html__( 'Dish Order', 'thesteam' ), 'the_steam_dish_order_box', 'dish', 'side', 'default' );
			add_meta_box( 'dish_contents', esc_html__( 'Dish Contents', 'thesteam' ), 'the_steam_dish_contents_box', 'dish', 'advanced', 'default' );
			add_meta_box( 'dish_subtitle', esc_html__( 'Subtitle (Optional)', 'thesteam' ), 'the_steam_dish_subtitle_box', 'dish', 'advanced', 'default' );
			add_meta_box( 'dish_description', esc_html__( 'Dish Description (SEO)', 'thesteam' ), 'the_steam_dish_description_box', 'dish', 'advanced', 'default' );

		}
	}
}

if ( ! function_exists( 'the_steam_post_description_box' ) ) {
	/**
	 * Prints out description metabox
	 *
	 * @param WP_Post $object Post.
	 */
	function the_steam_post_description_box( $object ) {
		wp_nonce_field( 'the_steam_submit_description', 'ts-meta-box-post-description' );

		$post_description = get_post_meta( $object->ID, 'post_description', 'true' );
		?>
		<input id="the-steam-post-description" type="text" maxlength="200" name="the_steam_post_description"
		       value="<?php echo esc_attr( $post_description ); ?>"/>

		<?php
	}
}

add_action( 'save_post', 'the_steam_save_post_description_metabox', 10, 3 );
if ( ! function_exists( 'the_steam_save_post_description_metabox' ) ) {
	/**
	 * Runs when the post is saved to update metabox values
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post The post being edited.
	 * @param bool    $update Existing post being updated or not.
	 *
	 * @return int Post ID
	 */
	function the_steam_save_post_description_metabox( $post_id, $post, $update ) {
		if ( ! isset( $_POST ) || ! isset( $_POST['ts-meta-box-post-description'] ) || ! wp_verify_nonce( $_POST['ts-meta-box-post-description'], 'the_steam_submit_description' ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$slug = 'post';

		if ( $slug !== $post->post_type ) {
			return $post_id;
		}

		if ( isset( $_POST['the_steam_post_description'] ) ) {
			$meta_box_post_description = sanitize_text_field( $_POST['the_steam_post_description'] );
			update_post_meta( $post_id, 'post_description', $meta_box_post_description );
		}
		return $post_id;
	}
}

if ( ! function_exists( 'the_steam_page_description_box' ) ) {
	/**
	 * Prints out description metabox
	 *
	 * @param WP_Post $object Post.
	 */
	function the_steam_page_description_box( $object ) {
		wp_nonce_field( 'the_steam_submit_description', 'ts-meta-box-page-description' );

		$page_description = get_post_meta( $object->ID, 'page_description', 'true' );
		?>
		<input id="the-steam-page-description" type="text" maxlength="200" name="the_steam_page_description"
		       value="<?php echo esc_attr( $page_description ); ?>"/>

		<?php
	}
}

add_action( 'save_post', 'the_steam_save_page_description_metabox', 10, 3 );
if ( ! function_exists( 'the_steam_save_page_description_metabox' ) ) {
	/**
	 * Runs when the page is saved to update metabox values
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post The post being edited.
	 * @param bool    $update Existing post being updated or not.
	 *
	 * @return int Post ID
	 */
	function the_steam_save_page_description_metabox( $post_id, $post, $update ) {
		if ( ! isset( $_POST ) || ! isset( $_POST['ts-meta-box-page-description'] ) || ! wp_verify_nonce( $_POST['ts-meta-box-page-description'], 'the_steam_submit_description' ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$slug = 'page';

		if ( $slug !== $post->post_type ) {
			return $post_id;
		}

		if ( isset( $_POST['the_steam_page_description'] ) ) {
			$meta_box_page_description = sanitize_text_field( $_POST['the_steam_page_description'] );
			update_post_meta( $post_id, 'page_description', $meta_box_page_description );
		}
		return $post_id;
	}
}

if ( ! function_exists( 'the_steam_post_subtitle_box' ) ) {
	/**
	 * Prints out subtitle metabox
	 *
	 * @param WP_Post $object Post.
	 */
	function the_steam_post_subtitle_box( $object ) {
		wp_nonce_field( 'the_steam_submit_subtitle', 'ts-meta-box-post-subtitle' );

		$post_subtitle = get_post_meta( $object->ID, 'post_subtitle', 'true' );
		?>
		<input id="the-steam-post-subtitle" type="text" maxlength="200" name="the_steam_post_subtitle"
		       value="<?php echo esc_attr( $post_subtitle ); ?>"/>

		<?php
	}
}

add_action( 'save_post', 'the_steam_save_post_subtitle_metabox', 10, 3 );
if ( ! function_exists( 'the_steam_save_post_subtitle_metabox' ) ) {
	/**
	 * Runs when the post is saved to update metabox values
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post The post being edited.
	 * @param bool    $update Existing post being updated or not.
	 *
	 * @return int Post ID
	 */
	function the_steam_save_post_subtitle_metabox( $post_id, $post, $update ) {
		if ( ! isset( $_POST ) || ! isset( $_POST['ts-meta-box-post-subtitle'] ) || ! wp_verify_nonce( $_POST['ts-meta-box-post-subtitle'], 'the_steam_submit_subtitle' ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$slug = 'post';

		if ( $slug !== $post->post_type ) {
			return $post_id;
		}

		if ( isset( $_POST['the_steam_post_subtitle'] ) ) {
			$meta_box_post_subtitle = sanitize_text_field( $_POST['the_steam_post_subtitle'] );
			update_post_meta( $post_id, 'post_subtitle', $meta_box_post_subtitle );
		}
		return $post_id;
	}
}

if ( ! function_exists( 'the_steam_page_subtitle_box' ) ) {
	/**
	 * Prints out subtitle metabox
	 *
	 * @param WP_Post $object The post.
	 */
	function the_steam_page_subtitle_box( $object ) {
		wp_nonce_field( 'the_steam_submit_subtitle', 'ts-meta-box-page-subtitle' );

		$page_subtitle = get_post_meta( $object->ID, 'page_subtitle', 'true' );
		?>
		<input type="text" id="the-steam-page-subtitle" maxlength="200" size="100" name="the_steam_page_subtitle"
		       value="<?php echo esc_attr( $page_subtitle ); ?>"/>

		<?php
	}
}

add_action( 'save_post', 'the_steam_save_page_subtitle_metabox', 10, 3 );
if ( ! function_exists( 'the_steam_save_page_subtitle_metabox' ) ) {
	/**
	 * Saves subtitle metabox contents
	 *
	 * @param int     $page_id Page Id.
	 * @param WP_Post $post The post.
	 * @param bool    $update Updating existing post or not.
	 *
	 * @return int Post id
	 */
	function the_steam_save_page_subtitle_metabox( $page_id, $post, $update ) {
		if ( ! isset( $_POST ) || ! isset( $_POST['ts-meta-box-page-subtitle'] ) || ! wp_verify_nonce( $_POST['ts-meta-box-page-subtitle'], 'the_steam_submit_subtitle' ) ) {
			return $page_id;
		}

		if ( ! current_user_can( 'edit_post', $page_id ) ) {
			return $page_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $page_id;
		}

		$slug = 'page';

		if ( $slug !== $post->post_type ) {
			return $page_id;
		}

		if ( isset( $_POST['the_steam_page_subtitle'] ) ) {
			$meta_box_page_subtitle = sanitize_text_field( $_POST['the_steam_page_subtitle'] );
			update_post_meta( $page_id, 'page_subtitle', $meta_box_page_subtitle );
		}

		return $page_id;
	}
}

add_action( 'admin_menu', 'the_steam_remove_meta_boxes' );
if ( ! function_exists( 'the_steam_remove_meta_boxes' ) ) {
	/**
	 * Removes metaboxes not displayed by the theme
	 */
	function the_steam_remove_meta_boxes() {
		remove_meta_box( 'commentsdiv', 'dish', 'advanced' );
		remove_meta_box( 'commentstatusdiv', 'dish', 'advanced' );
		if ( the_steam_check_plugin_active() ) {
			remove_meta_box( 'tagsdiv-dishtype', 'dish', 'advanced' );
		}
	}
}

if ( ! function_exists( 'the_steam_get_blogpost_views' ) ) {
	/**
	 * Retrieves post view count for a specific post
	 *
	 * @param int $id Post id.
	 *
	 * @return int|mixed Post views count
	 */
	function the_steam_get_blogpost_views( $id ) {
		$key = 'the_steam_blogpost_views_count';
		$cnt = get_post_meta( $id, $key, true );
		if ( '' === $cnt ) {
			delete_post_meta( $id, $key );
			add_post_meta( $id, $key, '0' );
			return 0;
		}
		return $cnt;
	}
}

if ( ! function_exists( 'the_steam_set_blogpost_views' ) ) {
	/**
	 * Sets up or increases post views for the specified post
	 *
	 * @param int $id Post id.
	 */
	function the_steam_set_blogpost_views( $id ) {
		$key = 'the_steam_blogpost_views_count';
		$cnt = get_post_meta( $id, $key, true );
		if ( isset( $cnt ) && '' === $cnt && 0 !== $cnt ) {
			delete_post_meta( $id, $key );
			add_post_meta( $id, $key, '0' );
		} else {
			$cnt++;
			update_post_meta( $id, $key, $cnt );
		}
	}
}

// Remove pre-fetching.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

add_action( 'save_post', 'the_steam_post_added' );
if ( ! function_exists( 'the_steam_post_added' ) ) {
	/**
	 * Sets up post views to 0 for a post when created if not already done
	 *
	 * @param int $id Post ID.
	 */
	function the_steam_post_added( $id ) {
		the_steam_set_blogpost_views( $id );
	}
}


add_filter( 'manage_edit-category_columns', 'the_steam_category_term_columns' );
if ( ! function_exists( 'the_steam_category_term_columns' ) ) {
	/**
	 * Sets up table for categories to show a header for category featured image
	 *
	 * @param array $theme_columns Default columns for the category.
	 *
	 * @return array New theme columns
	 */
	function the_steam_category_term_columns( $theme_columns ) {
		$new_columns = array(
			'cb' => '<input type="checkbox" />',
			'name' => esc_html__( 'Name', 'thesteam' ),
			'category_image' => esc_html__( 'Featured Image', 'thesteam' ),
			'description' => esc_html__( 'Description', 'thesteam' ),
			'slug' => esc_html__( 'Slug', 'thesteam' ),
			'count' => esc_html__( 'Count', 'thesteam' ),
		);
		return $new_columns;
	}
}

add_filter( 'manage_category_custom_column', 'the_steam_manage_category_columns', 10, 3 );
if ( ! function_exists( 'the_steam_manage_category_columns' ) ) {
	/**
	 * Sets up table to display category featured image
	 *
	 * @param string $out Table cell content with image.
	 * @param string $column_name Columnt name for featured image.
	 * @param int    $term_id Term id.
	 *
	 * @return string Table cell content
	 */
	function the_steam_manage_category_columns( $out, $column_name, $term_id ) {
		switch ( $column_name ) {
			case 'category_image':
				$category_meta = get_option( 'category_term_' . $term_id );
				$out .= "<img alt=\"Category image\" src='" . ($category_meta['category_id'] ? $category_meta['category_id'] : '#') . "' height='50' width='65'/>";
				break;

			default:
				break;
		}
		return $out;
	}
}

add_action( 'admin_enqueue_scripts', 'the_steam_load_wp_media_files' );
if ( ! function_exists( 'the_steam_load_wp_media_files' ) ) {
	/**
	 * Enqueue jquery
	 */
	function the_steam_load_wp_media_files() {
		wp_enqueue_media();
	}
}

// This helps print out in the edit taxonomy menu.
add_action( 'category_edit_form_fields', 'the_steam_category_edit_custom_fields', 10, 2 );
if ( ! function_exists( 'the_steam_category_edit_custom_fields' ) ) {
	/**
	 * Renders the taxonomy edit menu
	 *
	 * @param WP_Term $tag The category.
	 */
	function the_steam_category_edit_custom_fields( $tag ) {
		wp_nonce_field( 'category_add_form_fields', 'add_form_fields' );
		$t_id = $tag->term_id;
		$category_meta = get_option( 'category_term_' . $t_id );
		?>
		<tr class="form-field">
			<th scope="row" class="category-align-top">
				<label for="category"><?php esc_html_e( 'Image', 'thesteam' ); ?></label>
			</th>
			<td>
				<input type="text"
				       name="category_meta[category_id]" id="category_meta[category_id]"
				       class="taxonomy-image-url"
				       value="<?php echo esc_attr( $category_meta['category_id'] ? $category_meta['category_id'] : '' ); ?>"/>
			</td>
			<td class="td-align"><a href="#" class="button-primary ts-button-primary taxonomy-image-upload"><?php esc_html_e( 'Select', 'thesteam' ); ?></a></td>
		</tr>
		<tr class="category-align-top">
			<td><img class="taxonomy-image" alt="<?php esc_html_e( 'Please select or upload an image', 'thesteam' ); ?>"
			         src="<?php echo esc_url( $category_meta['category_id'] ? $category_meta['category_id'] : '' ); ?>"
			         height="200"
			         width="300"/>
			</td>
			<td></td>
		</tr>
		<?php
		$tax_img_upload_data = array( 'dialogTitle' => esc_html__( 'Custom Image', 'thesteam' ), 'dialogText' => esc_html__( 'Select Image', 'thesteam' ) );
		wp_register_script( 'thesteam-taxonomy-image-upload', esc_url( get_template_directory_uri() . '/js/taxonomy-image-upload.js' ), array( 'jquery' ), null );
		wp_localize_script( 'thesteam-taxonomy-image-upload', 'taxImgUploadData', $tax_img_upload_data );
		wp_enqueue_script( 'thesteam-taxonomy-image-upload' );
	}
}

add_action( 'category_add_form_fields', 'the_steam_category_add_custom_fields', 10, 2 );
if ( ! function_exists( 'the_steam_category_add_custom_fields' ) ) {
	/**
	 * Renders the category image upload section
	 */
	function the_steam_category_add_custom_fields() {
		wp_nonce_field( 'category_add_form_fields', 'add_form_fields' );
		?>
		<tr class="form-field">
			<th scope="row" class="category-align-top">
				<label for="category"><?php esc_html_e( 'Image', 'thesteam' ); ?></label>
			</th>
		</tr>
		<tr>
			<td>
				<input type="text"
				       name="category_meta[category_id]" id="category_meta[category_id]"
				       class="taxonomy-image-url"
				       value=""/>
			</td>
		</tr>
		<tr>
			<td>
				<a href="#" class="button-primary ts-button-primary taxonomy-image-upload"><?php esc_html_e( 'Browse gallery', 'thesteam' ); ?></a>
			</td>
		</tr>
		<tr>
			<td>
				<img class="taxonomy-image" alt="<?php esc_html_e( 'Please select or upload an image', 'thesteam' ); ?>" src="" height="200" width="300"/>
			</td>
		</tr>
		<?php

		$tax_img_upload_data = array( 'dialogTitle' => esc_html__( 'Custom Image', 'thesteam' ), 'dialogText' => esc_html__( 'Select Image', 'thesteam' ) );
		wp_register_script( 'thesteam-taxonomy-image-upload', esc_url( get_template_directory_uri() . '/js/taxonomy-image-upload.js' ), array( 'jquery' ), null );
		wp_localize_script( 'thesteam-taxonomy-image-upload', 'taxImgUploadData', $tax_img_upload_data );
		wp_enqueue_script( 'thesteam-taxonomy-image-upload' );
	}
}

add_action( 'edited_category', 'the_steam_save_category_custom_fields', 10, 2 );
add_action( 'create_category', 'the_steam_save_category_custom_fields', 10, 2 );
if ( ! function_exists( 'the_steam_save_category_custom_fields' ) ) {
	/**
	 * Saves category featured image
	 *
	 * @param int $term_id Category id.
	 */
	function the_steam_save_category_custom_fields( $term_id ) {

		if ( ! current_user_can( 'manage_categories' ) ) {
			return;
		}

		if ( ! isset( $_POST ) || ! isset( $_POST['add_form_fields'] ) || ! wp_verify_nonce( $_POST['add_form_fields'], 'category_add_form_fields' ) ) {
			return;
		}

		if ( isset( $_POST['category_meta'] ) ) {
			$t_id = $term_id;
			$category_meta = get_option( 'category_term_' . $t_id );
			$cat_keys = array_keys( $_POST['category_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset( $_POST['category_meta'][ $key ] ) ) {
					$category_meta[ $key ] = sanitize_text_field( $_POST['category_meta'][ $key ] );
				}
			}
			// Save the option array.
			update_option( 'category_term_' . $t_id, $category_meta );
		}
	}
}

if ( ! function_exists( 'the_steam_create_demo_frontpage_menu_items' ) ) {
	/**
	 * This is used to create demo menu items
	 */
	function the_steam_create_demo_frontpage_menu_items() {

		$menu_name = esc_html__( 'The Steam FrontPage', 'thesteam' );
		$menu_exists = wp_get_nav_menu_object( $menu_name );

		$menu_items = array(
			array(
				'name' => esc_html__( 'HOME', 'thesteam' ),
				'url'  => esc_url( home_url( '/' ) ),
			),

			array(
				'name' => esc_html__( 'ABOUT', 'thesteam' ),
				'url'  => esc_url( home_url( '/' ) . '#about-section' ),
			),

			array(
				'name' => esc_html__( 'MENU', 'thesteam' ),
				'url'  => esc_url( home_url( '/' ) . '#menu-book-title' ),
			),

			array(
				'name' => esc_html__( 'BLOG', 'thesteam' ),
				'url'  => esc_url( home_url( '/' ) . '#blog-section' ),
			),

			array(
				'name' => esc_html__( 'RESERVATIONS', 'thesteam' ),
				'url'  => esc_url( home_url( '/' ) . '#reservations-section' ),
			),

			array(
				'name' => esc_html__( 'CONTACT', 'thesteam' ),
				'url'  => esc_url( home_url( '/' ) . '#map-section' ),
			),
		);

		if ( $menu_exists ) {
			wp_delete_nav_menu( $menu_name );
		}

		$menu_id = wp_create_nav_menu( $menu_name );

		foreach ( $menu_items as $menu_item ) {

			wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title' => $menu_item['name'],
					'menu-item-classes' => $menu_item['name'],
					'menu-item-url' => $menu_item['url'],
					'menu-item-status' => 'publish',
				)
			);
		}

		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['frontpage-menu'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );

	}
}

if ( ! function_exists( 'the_steam_create_demo_blog_menu_items' ) ) {
	/**
	 * This is used to create demo menu items
	 */
	function the_steam_create_demo_blog_menu_items() {

		$menu_name = esc_html__( 'The Steam Blog Demo', 'thesteam' );
		$menu_exists = wp_get_nav_menu_object( $menu_name );

		if ( $menu_exists ) {
			// Demo menu is recreated.
			wp_delete_nav_menu( $menu_name );
		}

		$menu_items = array();

		$categories = the_steam_get_blog_list_categories();

		$menu_id = wp_create_nav_menu( $menu_name );

		foreach ( $categories as $category ) {
			array_push($menu_items, array(
				'name' => $category->name,
				'url' => esc_url( get_category_link( $category->term_id ) ),
			));
		}

		$all_categories_page = get_page_by_title( esc_html__( 'Category List', 'thesteam' ) );

		if ( null !== $all_categories_page ) {
			array_push($menu_items, array(
				'name' => esc_html__( 'Category List', 'thesteam' ),
				'url' => esc_url( get_permalink( $all_categories_page->ID ) ),
			));
		}

		foreach ( $menu_items as $menu_item ) {

			wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title' => $menu_item['name'],
					'menu-item-classes' => $menu_item['name'],
					'menu-item-url' => $menu_item['url'],
					'menu-item-status' => 'publish',
				)
			);
		}

		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['blog-menu'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

if ( ! function_exists( 'the_steam_get_sender_ip' ) ) {
	/**
	 * Retrieves the IP address of the computer used to do the reservation
	 *
	 * @return mixed IP address
	 */
	function the_steam_get_sender_ip() {

		$client = filter_var( @$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP );
		$forward = filter_var( @$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP );
		$remote = filter_var( @$_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP );

		if ( $client ) {
			$ip = $client;
		} elseif ( $forward ) {
			$ip = $forward;
		} else {
			$ip = $remote;
		}

		return $ip;
	}
}

if ( ! function_exists( 'the_steam_have_social_links' ) ) {
	/**
	 * Checks whether at least one social network
	 * profile has been provided
	 *
	 * @return bool True if at least one option is set
	 */
	function the_steam_have_social_links() {
		return ('#' !== the_steam_get_option( 'option_fb_url', '#' ) ||
		        '#' !== the_steam_get_option( 'option_tw_url', '#' ) ||
		        '#' !== the_steam_get_option( 'option_foursquare_url', '#' ) ||
		        '#' !== the_steam_get_option( 'option_instagram_url', '#' ) ||
		        '#' !== the_steam_get_option( 'option_pinterest_url', '#' ) ||
		        '#' !== the_steam_get_option( 'option_tripadvisor_url', '#' )
		);
	}
}

if ( ! function_exists( 'the_steam_have_contact_details' ) ) {
	/**
	 * Checks whether at least one contact detail
	 * has been provided
	 *
	 * @return bool True if at least one option is set
	 */
	function the_steam_have_contact_details() {
		return ('#' !== the_steam_get_option( 'option_city', '#' ) ||
		        '#' !== the_steam_get_option( 'option_phone_number', '#' ) ||
		        '#' !== the_steam_get_option( 'opening_hours', '#' )
		);
	}
}

if ( ! function_exists( 'the_steam_sanitize_ajax_field' ) ) {
	/**
	 * Function used to sanitize values passed trough the Wordpress admin-ajax
	 *
	 * @param string $field Text value to be validated.
	 * @param string $type Type of element passed, like hour, minute, phone, date, etc.
	 *
	 * @return mixed|string Returnes escaped string or the text 'invalid' if $type is not valid
	 */
	function the_steam_sanitize_ajax_field( $field, $type ) {
		if ( ! isset( $type ) ) {
			die( esc_html__( 'We are sorry, we encountered error in ajax field - please contact administrator...', 'thesteam' ) . esc_html( $field ) );
		}

		if ( ! isset( $field ) ) {
			die( esc_html__( 'We are sorry, we encountered error in ajax field: please contact administrator...', 'thesteam' ) . esc_html( $type ) );
		}

		/*
		 * Hour, minute, day and so on are not printed anywhere, they are
		 * used internally by the theme and translating them will make
		 * this function stop working.
		 */
		switch ( $type ) {
			case 'hour':
				if ( '00' === $field ) {
					$field = 0;
				}

				$ret = filter_var( $field, FILTER_VALIDATE_INT );
				if ( $ret < 0 || $ret > 24 ) {
					$ret = 12;
				}

				return $ret;

			case 'minute':
				if ( '00' === $field ) {
					$field = 0;
				}

				$ret = filter_var( $field, FILTER_VALIDATE_INT );

				if ( $ret < 0 || $ret > 60 ) {
					$ret = 30;
				}

				return $ret;

			case 'day':
				$field = ltrim( $field, '0' );
				$ret = filter_var( $field, FILTER_VALIDATE_INT );
				if ( $ret < 1 || $ret > 31 ) {
					$ret = 1;
				}

				return $ret;

			case 'month':
				$field = ltrim( $field, '0' );
				$ret = filter_var( $field, FILTER_VALIDATE_INT );
				if ( $ret < 1 || $ret > 12 ) {
					$ret = 1;
				}

				return $ret;

			case 'num_pers':
				$field = ltrim( $field, '0' );
				$ret = filter_var( $field, FILTER_VALIDATE_INT );
				if ( $ret < 1 || $ret > 300 ) {
					$ret = 1;
				}

				return $ret;

			case 'email':
				return sanitize_email( $field );

			case 'phone':
				return filter_var( $field, FILTER_SANITIZE_NUMBER_INT );

			case 'ip':
				return filter_var( $field, FILTER_VALIDATE_IP );

			case 'id':
				return filter_var( $field, FILTER_VALIDATE_INT );

			case 'user_msg':
				return sanitize_text_field( $field );

			case 'date':
				if ( strtotime( $field ) ) {
					return $field;
				}
				return 'invalid';

			default:
				return 'invalid';
		}
	}
}

if ( ! function_exists( 'the_steam_sanitize_field' ) ) {
	/**
	 * Function used to sanitize a generic field
	 *
	 * @param string $field Value to be sanitized.
	 * @param string $type Type of value to be sanitized.
	 *
	 * @return mixed|string Sanitized value
	 */
	function the_steam_sanitize_field( $field, $type ) {
		return the_steam_sanitize_ajax_field( $field, $type );
	}
}

if ( ! function_exists( 'the_steam_get_blogname' ) ) {
	/**
	 * Function used to set the e-mail name for sending notifications
	 *
	 * @return string Blog's name
	 */
	function the_steam_get_blogname() {
		return get_option( 'blogname' );
	}
}

add_action( 'wp_ajax_the_steam_submit_reservation', 'the_steam_submit_reservation' );
add_action( 'wp_ajax_nopriv_the_steam_submit_reservation', 'the_steam_submit_reservation' );
if ( ! function_exists( 'the_steam_submit_reservation' ) ) {
	/**
	 * Function used to submit a reservation
	 */
	function the_steam_submit_reservation() {

		if ( function_exists( 'the_steam_plugin_submit_reservation' ) ) {

			// Handle reservation in the plugin.
			the_steam_plugin_submit_reservation();

			// This should never happen, but if it does, we need to know.
			error_log( 'the_steam_plugin_submit_reservation() did not die in plugin' );
			die( esc_html__( 'Error in reservation processing. Please contact administrator', 'thesteam' ) );
		}
	}

	// Do nothing if plugin isn't active.
}

add_action( 'wp_ajax_the_steam_reset_settings', 'the_steam_reset_settings' );
add_action( 'wp_ajax_nopriv_the_steam_reset_settings', 'the_steam_reset_settings' );
if ( ! function_exists( 'the_steam_reset_settings' ) ) {
	/**
	 * Resets custom settings from the Admin Panel
	 */
	function the_steam_reset_settings() {

		if ( ! current_user_can( 'customize' ) ) {
			die( esc_html__( 'you are not allowed to do changes in this area', 'thesteam' ) );
		}

		$res = delete_option( 'the_steam_options' );

		if ( true === $res ) {
			die( esc_html__( 'settings cleared', 'thesteam' ) );
		}

		die( esc_html__( 'failed to delete theme settings - settings already cleared' . 'thesteam' ) );
	}
}?>