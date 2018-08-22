<?php
/**
 * Header File Doc Comment
 *
 * This file contains the theme's header
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 * Text Domain: thesteam
 **/

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
<meta property="og:url" content="<?php echo get_permalink(); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo get_bloginfo('name'); echo ' - ' . get_the_title(); ?>" />
	<?php $post_object = get_post( get_the_ID() ); ?>
	<?php if (the_steam_is_frontpage()) : ?>
		<meta property="og:description" content="<?php echo esc_html( the_steam_get_elipsis( the_steam_get_theme_mod( 'the_steam_second_section_message2', the_steam_get_post_subtitle() ), 250 ) ); ?>" />
	<?php else : ?>
	<meta property="og:description" content="<?php echo wp_strip_all_tags($post_object->post_content); ?>" />
	<?php endif; ?>
	
	<?php if (the_steam_is_frontpage()) : ?>
		<meta property="og:image" content="<?php echo get_header_image(); ?>" />
	<?php else : ?>
		<meta property="og:image" content="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" />
	<?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $post_type = get_post_type( get_the_ID() ); ?>
	<?php $meta_description = $post_type . '_description'; ?>
	<meta name="description" content="<?php echo esc_attr( get_post_meta( get_the_ID(), $meta_description, 'true' ) ); ?>"/>
	<?php wp_head(); ?>
	<?php echo the_steam_get_option( 'option_analytics_code', '  ', 9900 ); ?>
</head>
<body <?php body_class(); ?>>
<aside class="loading-animation"></aside>
