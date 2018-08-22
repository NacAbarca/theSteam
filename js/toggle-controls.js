/**
 * Admin-map-helpers
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */

jQuery( document ).ready(function( $ ) {
    'use strict';

    if ( ! initialSettings.plugin_active ) {

        // If plugin is not active, Instagram integration cannot work
        $( '[name=_customize-radio-the_steam_section2_curtain_setting_selector]' ).parent().css({ 'display':'none' });
    }

    if ( '1' === initialSettings.contact_form_active ) {
        $( '#customize-control-the_steam_footer_paragraph_msg' ).css({ 'opacity':'0' });
    }

    if ( 'normal' === initialSettings.curtain_setting ) {
        toggleCurtainImageControls( 'visible' );
    } else {
        toggleCurtainImageControls( 'hidden' );
    }

    if ( ! $( '#customize-control-the_steam_curtain_image1_selector' ).length ) {

        /* Elements don't exist */
        return;
    }

    // Customizer toggle Instagram / Manual image selection
    function toggleCurtainImageControls( val ) {
        if ( 'visible' === val ) {
            $( '[id^=customize-control-the_steam_curtain_image]' ).css({ 'display': 'block' });
            $( '#customize-control-the_steam_instagram_api_key_input' ).css({ 'display': 'none' });
        } else {
            $( '[id^=customize-control-the_steam_curtain_image]' ).css({ 'display': 'none' });
            $( '#customize-control-the_steam_instagram_api_key_input' ).css({ 'display': 'block' });
        }
    }

    $( 'input[name=\'_customize-radio-the_steam_section2_curtain_setting_selector\']' ).on( 'click', function() {
        if ( 'normal' === $( this ).val() ) {
            toggleCurtainImageControls( 'visible' );
        } else {
            toggleCurtainImageControls( 'hidden' );
        }
    });
});
