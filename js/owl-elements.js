/**
 * Owl-elements
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */
jQuery( document ).ready(function( $ ) {
    'use strict';
    var owlMenu = $( '#owl-menu' );
    var owlDishtypes = $( '#owl-dishtypes' );
    var rightArrow = $( '#menu-navigate-right' );
    var owlBlog = $( '#owl-demo' );
    var leftArrow = $( '#menu-navigate-left' );
    var dishtypeArrowLeft = $( '#dishtype-navigate-left' );
    var dishtypeArrowRight = $( '#dishtype-navigate-right' );

    if ( owlBlog.length ) {
        // Owl carousel used for blog - Initialization
        owlBlog.owlCarousel({
            items: ( undefined === settings.maxBlogItems || null === settings.maxBlogItems ) ? 6 : settings.maxBlogItems,
            lazyLoad: true,
            autoPlay: ( undefined === settings.autoPlayBlog || null === settings.autoPlayBlog || settings.autoPlayBlog < 2000 || 'false' === settings.autoPlayBlog ) ? false : Number( settings.autoPlayBlog ),
            pagination: true,
            paginationNumbers: false,
            stopOnHover: true
        });
    }

    if ( owlDishtypes.length ) {
        // Owl carousel used for blog - Initialization
        owlDishtypes.owlCarousel({
            items: 4, //( undefined === settings.maxBlogItems || null === settings.maxBlogItems ) ? 6 : settings.maxBlogItems,
            lazyLoad: true,
            autoPlay: false,
            pagination: false,
            paginationNumbers: false,
            stopOnHover: true,
            itemsCustom: [
                [0, 2],
                [800, 3],
                [1024, 4]
            ]
        });
    }

    if ( null != dishtypeArrowRight ) {
        dishtypeArrowRight.click(function() {
            owlDishtypes.trigger( 'owl.next' );
        });
    }

    if ( null != dishtypeArrowLeft ) {
        dishtypeArrowLeft.click(function() {
            owlDishtypes.trigger( 'owl.prev' );
        });
    }

    // Enable mouse scrolling of carousel
    if ( 'true' === settings.enableMouseWheelScroll ) {
        if ( owlBlog.length ) {
            owlBlog.on( 'mousewheel', function( e ) {
                if ( e.deltaY > 0 ) {
                    owlBlog.trigger( 'owl.next' );
                } else {
                    owlBlog.trigger( 'owl.prev' );
                }
                e.preventDefault();
            });
        }
    }

    if ( owlMenu.length ) {
        // Menu book owl carousel, showcases dishes and other edible products
        owlMenu.owlCarousel({
            navigation: false,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            pagination: false,
            lazyLoad: true
        });
    }

    if ( null != rightArrow ) {
        rightArrow.click(function() {
            owlMenu.trigger( 'owl.next' );
        });
    }

    if ( null != leftArrow ) {
        leftArrow.click(function() {
            owlMenu.trigger( 'owl.prev' );
        });
    }

    owlMenu.on('owl.next', function() {
        updateMenubookPage();
    });
    owlMenu.on('owl.prev', function() {
        updateMenubookPage();
    });

    function updateMenubookPage()
    {
        if ($( '.first-menu-column').length && $( '.first-menu-column').css('display') == 'none') {
            $( '.first-menu-column' ).css({ 'display':'block' });
            $( '.third-menu-column' ).css({ 'display':'none' });
            $( '.clicked-bar' ).css({ 'background-color':'rgba(153, 204, 204, 0.73)' });
            $( '.unclicked-bar' ).css({ 'background-color':'rgba(139, 137, 140, 0.5)' });
        }
    }

});
