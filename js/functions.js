/**
 * Functions
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */

jQuery( document ).ready(function( $ ) {
    'use strict';
    var fixmeTop;
    var windowWidth;
    var menuToggle = false;
    var isMobileClient = window.isMobileBrowser();
    var currentWindowScroll = 0;
    var wpadminbarObject = $( '#wpadminbar' );
    var menuTopPosition = 0;
    var $mobMenu, $navBar, $img2, $img2src;
    var fripWaypoint;
    var aboutWaypoint;
    var reservationsWaypoint;
    var animationsDone = false;
    var aboutAnimationsDone = false;
    var reservationsAnimationsDone = false;
    var dishTypesAnimationClass = functions_args.dishtypes_animation;
    var headerAnimationClass = functions_args.header_animation;
    var aboutAnimationClass = functions_args.about_animation;
    var reservationsAnimationClass = functions_args.reservations_animation;
    var prePreloadImg = new Image();
    var video = $( 'video.parallax-jumbotron' );
    prePreloadImg.src = $( '#parallax-jumbotron' ).attr( 'src' );
    window.dishTypesAnimationClass = functions_args.dishtypes_animation;
    window.headerAnimationClass = headerAnimationClass;
    window.markerBounce = functions_args.marker_bounce;

    if ( $( '.frip-animation-supported' ).length ) {
        if ( '' !== dishTypesAnimationClass && 'none' !== dishTypesAnimationClass ) {
            $( '.frip-animation-supported' ).css({ 'opacity': '0' });
        } else {
            $( '.frip-animation-supported' ).css({ 'opacity': '1' });
        }
    }

    function runFripAnimations() {
        if ( true !== animationsDone && $( '#white-section2wp' ).length ) {
            if ( $( '.frip-animation-supported' ).length ) {
                if ( '' !== dishTypesAnimationClass && 'none' !== dishTypesAnimationClass ) {
                    $( '.frip-animation-supported' ).each(function( index, value ) {
                        window.setTimeout(function( obj ) {
                            obj.addClass( 'animated' ).addClass( dishTypesAnimationClass );
                        }, index * 150, $( this ) );
                    });
                }
            }

            animationsDone = true;
            fripWaypoint = null;
        }
    }

    if ( $( '#white-section2wp' ).length ) {
        fripWaypoint = new Waypoint({
            element: document.getElementById( 'white-section2wp' ),
            handler: function() {
                runFripAnimations();
            },
            offset: 590
        });
    }

    if ( $( '.about-animation-supported' ).length ) {
        if ( '' !== aboutAnimationClass && 'none' !== aboutAnimationClass ) {
            $( '#first-section-text > .white-section-title, #first-section-text > #about-diamonds-container, #first-section-text > #about-text' ).css({ 'opacity': '0' });
        } else {
            $( '#first-section-text > .white-section-title, #first-section-text > #about-diamonds-container, #first-section-text > #about-text' ).css({ 'opacity': '1' });
        }
    }

    function runReservationsAnimations() {
        if ( true !== reservationsAnimationsDone && $( '#white-section4wp' ).length ) {
            if ( $( '.reservations-animation-supported' ).length ) {
                if ( '' !== reservationsAnimationClass && 'none' !== reservationsAnimationClass ) {
                    $( '.reservations-animation-supported' ).each(function( index, value ) {
                        window.setTimeout(function( obj ) {
                            obj.addClass( 'animated' ).addClass( reservationsAnimationClass );
                        }, index * 350, $( this ) );
                    });
                }
            }

            reservationsAnimationsDone = true;
            reservationsWaypoint = null;
        }
    }

    if ( $( '#white-section4wp' ).length ) {
        reservationsWaypoint = new Waypoint({
            element: document.getElementById( 'white-section4wp' ),
            handler: function() {
                runReservationsAnimations();
            },
            offset: 550
        });
    }

    if ( $( '.reservations-animation-supported' ).length ) {
        if ( '' !== reservationsAnimationClass && 'none' !== reservationsAnimationClass ) {
            $( '#white-section4wp > #frontpage-reservations-title, #white-section4wp > #reservations-space' ).css({ 'opacity': '0' });
        } else {
            $( '#white-section4wp > #frontpage-reservations-title, #white-section4wp > #reservations-space' ).css({ 'opacity': '1' });
        }
    }

    function runAboutAnimations() {
        if ( true !== aboutAnimationsDone && $( '#first-section-text' ).length ) {
            if ( $( '.about-animation-supported' ).length ) {
                if ( '' !== aboutAnimationClass && 'none' !== aboutAnimationClass ) {
                    $( '.about-animation-supported' ).each(function( index, value ) {
                        window.setTimeout(function( obj ) {
                            obj.addClass( 'animated' ).addClass( aboutAnimationClass );
                        }, index * 350, $( this ) );
                    });
                }
            }

            aboutAnimationsDone = true;
            aboutWaypoint = null;
        }
    }

    if ( $( '#first-section-text' ).length ) {
        aboutWaypoint = new Waypoint({
            element: document.getElementById( 'first-section-text' ),
            handler: function() {
                runAboutAnimations();
            },
            offset: 490
        });
    }

    window.runHeaderAnimation = function runHeaderAnimation() {
        var headerPreloadImg = new Image();
        headerPreloadImg.src = $( '#parallax-jumbotron' ).attr( 'src' );

        if ( $( '.logo-animation-supported' ).length ) {
            if ( '' !== headerAnimationClass && 'none' !== headerAnimationClass ) {
                $( '.logo-animation-supported' ).addClass( 'animated' ).addClass( headerAnimationClass );
            } else if ( '' === headerAnimationClass && 'none' === headerAnimationClass ) {
                $( '.logo-animation-supported' ).css({ 'opacity': '1' });
            }
        }

        headerPreloadImg.onload = function() {
            if ( $( '.img-brought-in' ).length ) {
                window.setTimeout(function() {
                    $( '#parallax-jumbotron' ).addClass( 'img-brought-back' );
                    window.setTimeout(function() {
                        $( '#parallax-jumbotron' ).removeClass( 'img-brought-in' );
                        $( '#parallax-jumbotron' ).removeClass( 'img-brought-back' );
                    }, 1500 );
                }, 500 );
            }
        };
    };

    window.viewportHeight = $( window ).height();
    windowWidth = window.innerWidth;
    window.$img2src = $( '.parallax-image2' ).attr( 'src' );

    $( document ).foundation();

    // Mobile specific setup
    if ( true === isMobileClient ) {
        $img2 = $( '.parallax-image2' );
        if ( undefined !== $img2 ) {
            $img2.css({ 'height': '100%' });
        }

        $mobMenu = $( '.over-menu-visible' );
        if ( undefined !== $mobMenu ) {
            $mobMenu.removeClass( 'hide-for-large-up' );
        }

        $navBar = $( '.navbar' );
        if ( undefined !== $navBar ) {
            $navBar.removeClass( 'show-for-large-up' ).addClass( 'hide-for-medium-up' ).addClass( 'hide-for-small-only' );
        }
    }

    // Prevent hiding frontpage menu by the wp admin bar
    if ( undefined !== wpadminbarObject && null !== wpadminbarObject ) {
        menuTopPosition = wpadminbarObject.height();
    }

    // Handler for updating frontpage menu position
    window.positionMenu = function() {
        /* Do not add padding when on mobile because
         the menu icon does not occupy any space */
        if ( true === isMobileClient || 'none' == $( '.show-for-large-up' ).css( 'display' ) || ! $( '.fixme' ).length ) {
            return;
        }

        currentWindowScroll = $( window ).scrollTop();

        // Fix frontpage menu to viewport top when scrolling past it
        if ( currentWindowScroll >= fixmeTop ||  'yes' !== fnargs.positionMenuDown ) {
            $( '.fixme' ).css({
                position: 'fixed',
                '-webkit-transform': 'translate3d(0,0,0)',
                'transform': 'translate3d(0,0,0)',
                'top': Number( menuTopPosition ),
                'left': '0'
            });

            if ( 'yes' === fnargs.positionMenuDown ) {
                $( '.white-section1' ).css({ 'margin-top': '110px' });
            }

            if ( 'yes' !== fnargs.positionMenuDown ) {
                // Only for navbar set to top
                if ( currentWindowScroll >= 50 ) {
                    // Detaching menu at first scroll
                    $( '.navbar-default .navbar-nav > li > a' ).addClass( 'stacked' );
                    $( '.navbar-default .navbar-nav > li > a' ).removeClass( 'unstacked' );
                    $( '.navbar-default' ).addClass( 'navbar-default-stacked' );
                    $( '.navbar-default' ).removeClass( 'navbar-default-unstacked' );
                    $( '.container-navbar' ).css({ 'box-shadow':'0 5px 15px 0 rgba(0,0,0,0.25)' });

                } else {
                    // Attaching back menu at first scroll
                    $( '.navbar-default .navbar-nav > li > a' ).addClass( 'unstacked' );
                    $( '.navbar-default .navbar-nav > li > a' ).removeClass( 'stacked' );
                    $( '.navbar-default' ).removeClass( 'navbar-default-stacked' );
                    $( '.navbar-default' ).addClass( 'navbar-default-unstacked' );
                    $( '.container-navbar' ).css({ 'box-shadow':'0 0 0 0 rgba(0,0,0,0.0)' });

                }
            } else {
                // For menu set top bottom
                $( '.navbar-default .navbar-nav > li > a' ).addClass( 'stacked' );
                $( '.navbar-default .navbar-nav > li > a' ).removeClass( 'unstacked' );
                $( '.navbar-default' ).addClass( 'navbar-default-stacked' );
                $( '.navbar-default' ).removeClass( 'navbar-default-unstacked' );

            }
        } else if ( currentWindowScroll < fixmeTop ) {
            $( '.fixme' ).css({
                position: 'static',
                '-webkit-transform': '',
                'transform': ''
            });
            $( '.white-section1' ).css({ 'margin-top': '30px' });
            $( '.navbar-default .navbar-nav > li > a' ).addClass( 'unstacked' );
            $( '.navbar-default .navbar-nav > li > a' ).removeClass( 'stacked' );
            $( '.navbar-default' ).removeClass( 'navbar-default-stacked' );
            $( '.navbar-default' ).addClass( 'navbar-default-unstacked' );
        }

    };

    // Resize frontpage jumbotron handler
    function resizeHero() {
        var wpadminbarObject = $( '#wpadminbar' );
        var adminbarHeight = wpadminbarObject.length ? wpadminbarObject.height() : 0;
        var navbarHeight = $( '#navbar' ).hasClass( 'hide-for-small-only' ) ? 0 : $( '#navbar' ).height();

        if ( true !== animationsDone && $( '#white-section2wp' ).length ) {
            fripWaypoint = null;
            fripWaypoint = new Waypoint({
                element: document.getElementById( 'white-section2wp' ),
                handler: function() {
                    runFripAnimations();
                },
                offset: 625
            });
        }

        if ( 'yes' !== fnargs.positionMenuDown ) {
            navbarHeight = 0;
        }

        $( '.hero, #first-image-container, .parallax-jumbotron' ).css({ 'height': window.innerHeight - navbarHeight - adminbarHeight });
        if ( 'block' == $( '.show-for-large-up' ).css( 'display' ) || 'inline' == $( '.show-for-large-up' ).css( 'display' ) ) {
            fixmeTop = window.viewportHeight - navbarHeight;
        } else {
            fixmeTop = window.viewportHeight;
        }

        if ( 0 < adminbarHeight ) {
            if ( 'absolute' === wpadminbarObject.css( 'position' ) ) {
                $( '#ts-mobile-menu' ).css({ 'position':'absolute' });
            } else {
                $( '#ts-mobile-menu' ).css({ 'position':'fixed' });
            }
        }

        if ( 'none' === $( '.reservations-label-text' ).css( 'display' ) ) {

            // Is small screen.
            $( '#second-image-container' ).css({ 'background-image': 'url(' + window.$img2src + ')', 'background-position': 'center, center', 'background-size': 'cover', 'background-repeat': 'no-repeat' });
            $( '.parallax-image2' ).css({ 'height': '0px', 'width': '0px' }).removeAttr( 'src' );
            $( '.parallax-image2' ).removeAttr( 'alt' );
        } else {
            $( '.parallax-image2' ).css({ 'width':'100%', 'height': 'auto' }).attr( 'src', window.$img2src ).show();
            $( '#second-image-container' ).css({ 'background-image': 'none' });
        }

        $( '.aligner' ).css({ 'height': window.viewportHeight });
        window.positionMenu();
    }

    windowWidth = window.innerWidth;

    $( window ).resize(function() {
        window.positionMenu();
        window.setTimeout(function() {
            if ( window.innerWidth != windowWidth ) {
                window.viewportHeight = $( window ).height();
                resizeHero();
                windowWidth = window.innerWidth;
                if ( windowWidth >= 1025 ) {
                    $( '.first-menu-column, .third-menu-column' ).css({ 'display':'block' });
                } else {
                    $( '.left-bar' ).trigger( 'click' );
                }

            }
            window.positionMenu();
        }, 500 );
    });

    // Menu book page toggling for mobile devices
    $( '.clicked-bar, .unclicked-bar' ).on( 'click', function() {
        if ( true === menuToggle ) {
            $( '.first-menu-column' ).css({ 'display':'block' });
            $( '.third-menu-column' ).css({ 'display':'none' });
            $( '.clicked-bar' ).css({ 'background-color':'rgba(153, 204, 204, 0.73)' });
            $( '.unclicked-bar' ).css({ 'background-color':'rgba(139, 137, 140, 0.5)' });
            menuToggle = false;
        } else {
            $( '.first-menu-column, .second-menu-column' ).css({ 'display':'none' });
            $( '.third-menu-column' ).removeClass( 'show-for-large-up' ).css({ 'display':'block' });
            $( '.unclicked-bar' ).css({ 'background-color':'rgba(153, 204, 204, 0.73)' });
            $( '.clicked-bar' ).css({ 'background-color':'rgba(139, 137, 140, 0.5)' });
            menuToggle = true;
        }
    });

    resizeHero();

    // Modern Flexbox with `flex-wrap` supported.
    if ( Modernizr.flexbox && $('#subaligner').length) {
        document.getElementById( 'subaligner' ).className = 'aligner';
    }

    // Scroll to element action
    function scrollToElement( element, top, offset ) {
        var offsetAdd = 0;
        var position;
        var currWindowPos;

        if (! $( element).length) {
            return;
        }

        currWindowPos = document.documentElement.scrollTop || document.body.scrollTop;

        if ( 'true' === top ) {
            /* Prevent running useless queued up events */
            if ( currWindowPos <= 50 ) {
                return;
            }
            $( 'html, body' ).animate({
                scrollTop: 0 + offset
            }, 500 );
            return;
        }

        if ( undefined !== offset ) {
            offsetAdd = offset;
        }

        /* Also prevent running futile queued up events. */
        if ( position == currWindowPos ) {
            return;
        }

        position = $( element ).offset().top - $( element ).height() - $( element ).height() / 2 + offsetAdd;

        $( 'html, body' ).animate({
            scrollTop: position
        }, 500 );
    }

    /* Taxonomy dish types frontpage navigation menu code */
    $( '.menu-frip-div' ).on( 'click', function() {
        var pgElem = document.getElementById( 'item-' + $( this ).data( 'dish' ) + '0' );
        var pageNum = null !== pgElem && undefined !== pgElem ? pgElem.getAttribute( 'data-page' ) : 0;
        var owlMenu = $( '#owl-menu' );

        if ( 'none' === $( '.fourth-section' ).css( 'display' ) ) {

            // Menu is not visible, no reason to continue.
            return;
        }

        if ( null !== pgElem ) {
            if ( null !== owlMenu ) {
                owlMenu.trigger( 'owl.goTo', [pageNum]);
            }
        }
        scrollToElement( '#menu-book-title', 'false', -40 );
    });

    /* Animate scroll down code - arrow down */
    $( '.go-down-arrow' ).on( 'click', function() {
        window.setTimeout(function() {
            $( 'html, body' ).animate({ scrollTop: ( 0 + $( window ).height() - 80 ) }, 500 );
        }, 250 );

    });

    /* Clear up not needed space if reservations are disabled */
    if ( $( '#white-section4wp' ).length &&  true === $( '#white-section4wp ' ).hasClass( 'hide-for-small-up' ) ) {
        if ( $( '.fifthImage' ).length ) {
            $( '.fifthImage' ).css( { 'margin-top': '-23px' } );
        }
    }

    $( '.menu-pull-up p' ).addClass( 'show-for-medium-up dishtype-description' );

    /* Curtain images animation */
    function enter() {
        $( this ).addClass( 'curtain-wide' ).siblings().removeClass( 'curtain-wide' );
    }

    function leave() {
        $( this ).removeClass( 'curtain-wide' ).addClass( 'curtain-shrink' ).siblings().removeClass( 'curtain-wide' );
    }

    $( '.fin-image' ).hover( enter, leave );

    setTimeout(function() {
        enter.call( $( '.fin-image:first-child' ) );
    }, 500 );

    $( window ).on( 'orientationchange', function() {
        window.setTimeout(function() {
            window.viewportHeight = $( window ).height();
            resizeHero();
        }, 500 );
    });

    /* End user message code */

    $( '#parallax-jumbotron, .parallax-image2' ).each(function() {
        if ( $( this ).length ) {
            if ( '#' === $( this ).attr( 'src' ) ||  '' === $( this ).attr( 'src' ) ) {
                $( this ).hide();
                $( this ).attr( 'src', '#' );
            }
        }
    });

    var lastHoveredImage = null;
    var currentRenderedMenuImage = null;

    if ( 'yes' === functions_args.menubook_hover_animation ) {
        window.setInterval(function() {
            if ( currentRenderedMenuImage !== lastHoveredImage ) {
                if ( null !== lastHoveredImage && '#' !== lastHoveredImage ) {
                    $( '#menu-book-owl' ).animate({ opacity: 0.75 }, 150, function() {
                        //Swap out bg src
                        $( '#menu-book-owl' ).css({ 'background-image': 'url(' + lastHoveredImage + ')' });

                        //Animate fully back in
                        $( '#menu-book-owl' ).animate({ opacity: 1 }, 150, function() {
                        });
                        currentRenderedMenuImage = lastHoveredImage;
                    });
                }
            }
        }, 1500 );

        $( '.product-line' ).on( 'mouseenter', function() {
            var featuredImgUrl = $( this ).data( 'img' );
            if ( '#' !== featuredImgUrl ) {
                var preloadImg = new Image();
                preloadImg.src = featuredImgUrl;

                preloadImg.onload = function() {
                    lastHoveredImage = featuredImgUrl;
                };
            }
        });
    }

    if ($('#gallery-list').length) {
        document.getElementById('gallery-list').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        }
    }
});

