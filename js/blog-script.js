/**
 * Blog-script
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */
jQuery( document ).ready(function( $ ) {
    'use strict';
    var viewportHeight = window.innerHeight;
    var viewportWidth = window.innerWidth;
    var wpadminbarObject = $( '#wpadminbar' );
    var adminbarHeight = wpadminbarObject.length ? wpadminbarObject.height() : 0;

    // Setup jumbotron and related items sizes considering admin bar.
    function setLargeImageSize() {
        var largeimage = $( '.large-image' );
        var aligner = $( '.aligner' );

        viewportHeight = window.innerHeight;
        viewportWidth = window.innerWidth;

        if ( 0 < adminbarHeight ) {
            if ( 'absolute' === wpadminbarObject.css( 'position' ) ) {
                $( '#ts-mobile-menu' ).css({ 'position':'absolute' });
            } else {
                $( '#ts-mobile-menu' ).css({ 'position':'fixed' });
            }
        }

        if ( window.innerHeight < window.innerWidth ) {
            largeimage.css({ 'height': viewportHeight * 55 / 100 });
            aligner.css({ 'top': viewportHeight * 26 / 100 });
        }

        if (  window.innerWidth < 1024 ) {
            largeimage.css({ 'height': viewportHeight * 55 / 100 });
            aligner.css({ 'top': viewportHeight * 32.5 / 100 });
        } else {
            aligner.css({ 'top': viewportHeight * 28.5 / 100 });
        }

        if ( wpadminbarObject.length ) {
            largeimage.css({ 'height': viewportHeight * 55 / 100 });
            if (  window.innerWidth < 1024 ) {
                aligner.css({ 'top': viewportHeight * 35 / 100 });
            } else {
                aligner.css({ 'top': viewportHeight * 30 / 100 });
            }
        }

        if ( window.innerHeight < window.innerWidth  &&  window.innerWidth < 1024 ) {
            largeimage.css({ 'height': viewportHeight * 65 / 100 });
            aligner.css({ 'top': viewportHeight * 36.5 / 100 });
        }

        if ( wpadminbarObject.length && window.innerHeight < window.innerWidth  &&  window.innerWidth < 1024 ) {
            largeimage.css({ 'height': viewportHeight * 65 / 100 });
            aligner.css({ 'top': viewportHeight * 40 / 100 });
        }

        if ( window.innerHeight < 500 &&  window.innerWidth < 1024 )  {
            largeimage.css({ 'height': viewportHeight * 65 / 100 });
            aligner.css({ 'top': viewportHeight * 42.5 / 100 });
        }

        if ( wpadminbarObject.length && window.innerHeight < 500  &&  window.innerWidth < 1024 )  {
            largeimage.css({ 'height': viewportHeight * 75 / 100 });
            aligner.css({ 'top': viewportHeight * 55 / 100 });
        }
    }

    // Scroll handler with parallax
    $( window ).scroll(function() {
        var currentScroll = $( window ).scrollTop();
        $( '.first-logo-line' ).css({
            'opacity': 1 - ( currentScroll / 300 )
        });

        $( '.second-logo-line' ).css({
            'opacity': 1 - ( currentScroll / 400 )
        });
    });

    // Initial setup
    setLargeImageSize();

    // Month / year widget toggle handler
    $( '#month-tab-selector' ).on( 'click', function() {
        $( '.year' ).css({ 'display':'none' });
        $( '.month' ).css({ 'display':'block' });
    });

    $( '#year-tab-selector' ).on( 'click', function() {
        $( '.year' ).css({ 'display':'block' });
        $( '.month' ).css({ 'display':'none' });
    });

    // Window resize handler
    $( window ).resize(function() {
        window.setTimeout(function() {
            if ( window.innerWidth != viewportWidth ) {
                setLargeImageSize();
            }
        }, 500 );
    });

    if ( $( '.logged-in' ).length ) {
        $( '.title-admin' ).css({ 'margin-top':'57px' });
    }

    if ( ! $( '.first-image-selector' ).length && ! $( '.second-image-selector' ).length && ! $( '.third-image-selector' ).length ) {

        // No image is present in related items.
        $( '.photo-align-selector' ).css({ 'padding-bottom':'13px' });
    }
});
