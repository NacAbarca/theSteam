/**
 * Footer
 * License: GPLv2 or later
 * Link: www.webdotinc.com
 */
jQuery( document ).ready(function( $ ) {
    'use strict';
    var wall = null;
    var isMobileClient;
    var newScrollY;
    var isFrontPage = $( '#parallax-jumbotron' ).length;
    var selectors = ['span.fa-stack-footer a.no-load', 'a.blog-menu-social-icon', 'div.social a.no-load'];
    var wpadminbarObject = $( '#wpadminbar' );
    var parallaxEnabled = fnargs.parallax_enabled;
    var headerAnimationFunction = window.runHeaderAnimation;
    var headerAnimationClass = fnargs.headerAnimationClass;
    window.latestKnownScrollY = $( window ).scrollTop();
    newScrollY = window.latestKnownScrollY;

    /* Loading animate code */
    $( window ).load(function() {
        if ( $( '.loading-animation' ).length ) {
            window.setTimeout(function() {

                    if ( $( '.' + headerAnimationClass ).length ) {
                        if ( 'none' !== headerAnimationClass && '' !== headerAnimationClass ) {
                            $( '.' + headerAnimationClass ).css({ 'opacity': '0' });
                        }
                    }

                $( '.loading-animation' ).fadeOut( 400 );
                window.setTimeout(function() {
                    /* Can't make footer dependent on functions, but what if they get switched when loading? */
                    if ( 'function' === typeof headerAnimationFunction )  {
                        window.runHeaderAnimation();
                    }
                }, 200 );
            });
        };
    });

    if ( undefined !== wpadminbarObject && null !== wpadminbarObject && wpadminbarObject.length ) {
        $( '.wrap' ).css({ 'margin-top':'40px' });
    }

    /* Failsafe */
    window.setTimeout(function() {
        $( '.loading-animation' ).fadeOut( 400 );
    }, 15000 );

    $( 'a' ).on( 'click', function( e ) {
        /* Do not show loading animation for menu items. */
        if ( $( this ).hasClass( 'menu-scroll' ) || $( this ).hasClass( 'no-load' ) || $( this ).hasClass( 'close' ) || $( this ).is( '#cn-accept-cookie' ) || $( this ).hasClass( 'comment-reply-link' ) || $( this ).hasClass( 'ab-item' ) ) {
            return;
        }

        /* Don't show the animation or at least not for long, in case the user opens with specific button / another tab */
        if ( ! e.ctrlKey ) {
            $( '.loading-animation' ).fadeIn( 400 );
        }

        window.setTimeout(function() {
                 $( '.loading-animation' ).fadeOut( 400 );
            }, 8000 );
    });

    window.getChromeVersion = function() {
        var raw = navigator.userAgent.match( /Chrom(e|ium)\/([0-9]+)\./ );

        return raw ? parseInt( raw[2], 10 ) : false;
    };

    isMobileClient = window.isMobileBrowser();
    window.isInternetExplorer = window.isBrowser( 'ie' );

    $(function() {
        $( '.menu-scroll' ).on( 'click', function( event ) {
            var target = $( this.hash );
            var $window = $( window );
            var scrollTime = 1.2;
            var menuOffset = 0;
            var locationPathName = location.pathname.replace( /^\//, '' );
            var thisPathName = this.pathname.replace( /^\//, '' );
            var locationHostName = location.hostname.replace( /^\//, '' );;
            var thisHostName = this.hostname.replace( /^\//, '' );;

            locationHostName = locationHostName.replace(/www./gi, '');
            thisHostName = thisHostName.replace(/www./gi, '');
            locationPathName = locationPathName.replace(/www./gi, '');
            thisPathName = thisPathName.replace(/www./gi, '');

            if ( locationPathName == thisPathName && locationHostName == thisHostName ) {
                target = target.length ? target : $( '.hero' );
                if ( target.length ) {
                    event.preventDefault();

                    if ( $( '.fixme' ).length ) {
                        menuOffset -= $( '.fixme' ).height() - 20;
                    }

                    TweenMax.to( $window, scrollTime, {
                        scrollTo: { y: ( target.offset().top + menuOffset - 70 ), autoKill:true },
                        ease: Power1.easeOut,
                        overwrite: 5
                    });

                    return false;
                }
            }
        });
    });

    if ( $( '.owl-wrapper-outer' ).length ) {
        $( '.owl-wrapper-outer' ).each( function() {
            $( this ).addClass( 'ts-fixed-image' );
        });
    }

    $( '.btn-open' ).on( 'click', function() {
        $( '.overlay' ).fadeToggle( 200 );
        $( this ).toggleClass( 'btn-open' ).toggleClass( 'btn-close' );
        onToggleMenu( $( this ) );
    });

    $( '.overlay' ).on( 'click', function() {
        $( '.btn-close' ).trigger( 'click' );
    });

    /* This is a toggle menu function */
    function onToggleMenu( object ) {
        if ( object.hasClass( 'btn-close' ) ) {
            $( 'body' ).css({ 'overflow-y': 'hidden' });
            $( '.title-line' ).css({ 'z-index':'100', 'display':'none' });
            $( 'nav.over-menu-visible' ).css({ 'background-color':'transparent', '-webkit-box-shadow': 'none', '-moz-box-shadow': 'none', 'box-shadow': 'none' });
        } else {
            $( 'body' ).css({ 'overflow-y': 'initial' });
            $( '.title-line' ).css({ 'z-index':'407', 'display':'flex' });
            $( 'nav.over-menu-visible' ).css({ 'background-color':'#ffffff', '-webkit-box-shadow': '0 1px 4px 0 #999999', '-moz-box-shadow': '0 1px 4px 0 #999999', 'box-shadow': '0 1px 4px 0 #999999' });
        }
    }

    if ( $( '#all-categories-content' ).length ) {
        wall = new Freewall( '#all-categories-content' );

        $( '.brick' ).each(function( index ) {
            var w = 200 + 200 * Math.random() << 0;
            $( this ).css({ 'width': w + 'px' });
        });

        wall.reset({
            selector: '.brick',
            animate: true,
            cellW: 20,
            cellH: 200,
            onResize: function() {
                wall.fitWidth();
            }
        });

        wall.fitWidth();
    }

    function setIEBgSize() {
        if ( $( '#first-image-container' ).length ) {
            $( '#first-image-container, #second-image-container' ).css({ 'width':window.innerWidth });
        }
    }

    function parallaxLogoElements( currentWindowScroll ) {
        if ( 'yes' !== parallaxEnabled ) {
            return;
        }

        if ( $( '.the' ).length && $( '.steam' ) && $( '.first-word' ) ) {
            $( '.the, .first-logo-hr, .first-word, .steam, .first-logo' ).removeClass( 'fadeIn fadeInUp lightSpeedIn fadeInUpBig rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight rollIn zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp slideInDown slideInLeft' ).addClass( 'opacity-override' );
            $( '.opacity-override' ).css({
                'opacity': 1 - ( currentWindowScroll / 600 )
            });

        }
   }

    /* http://paulirish.com/2011/requestanimationframe-for-smart-animating/
     * http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
     * requestAnimationFrame polyfill by Erik Möller
     * fixes from Paul Irish and Tino Zijdel
     */

    (function() {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        var x;
        for ( x = 0; x < vendors.length && ! window.requestAnimationFrame; ++x ) {
            window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] ||
                window[vendors[x] + 'CancelRequestAnimationFrame'];
        }

        if ( ! window.requestAnimationFrame ) {
            window.requestAnimationFrame = function( callback, element ) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max( 0, 16 - ( currTime - lastTime ) );
                var id = window.setTimeout(function() {
                        callback( currTime + timeToCall );
                    },
                    timeToCall );
                lastTime = currTime + timeToCall;
                return id;
            };
        }

        if ( ! window.cancelAnimationFrame ) {
            window.cancelAnimationFrame = function( id ) {
                clearTimeout( id );
            };
        }
    }() );

    function scrollHandler() {
        if ( false === isMobileClient && $( '#first-image-container' ).length && 'yes' === parallaxEnabled ) {
            if ( 'edge' === window.isInternetExplorer ) {
                if ( 'none' !== $( '.reservations-label-text' ).css( 'display' ) ) {
                    TweenMax.to( $( '.parallax-jumbotron' ), 0.4, {
                        'background-position-y': ( 50 - Number( ( newScrollY / 5 ) / window.viewportHeight * 100 ) ),
                        force3D: true,
                        ease: Power1.easeOut,
                        overwrite: 5
                    });

                    TweenMax.to( $( '.parallax-image2' ), 0.4, {
                        'background-position-y': ( 50 - Number( ( newScrollY / 2 - window.viewportHeight ) / 5 / window.viewportHeight * 100 )  ),
                        ease: Power1.easeOut,
                        force3D: true,
                        overwrite: 5
                    });
                } else {
                    TweenMax.to( $( '.parallax-jumbotron' ), 0.4, {
                        'background-position-y': 0,
                        force3D: true,
                        ease: Power1.easeOut,
                        overwrite: 5
                    });

                    // Revert to non parallax original position
                    TweenMax.to( $( '.parallax-image2' ), 0.4, {
                        'background-position-y': 0,
                        ease: Power1.easeOut,
                        force3D: true,
                        overwrite: 5
                    });
                }
            } else {
                if ( 'none' !== $( '.reservations-label-text' ).css( 'display' ) ) {

                    TweenMax.to( $( '.parallax-jumbotron' ), 0.4, {
                        y: ( Number( newScrollY / 5 ) ),
                        force3D: true,
                        ease: Power1.easeOut,
                        overwrite: 5
                    });

                    TweenMax.to( $( '.parallax-image2' ), 0.4, {
                        y: ( Number( ( newScrollY / 2 - window.viewportHeight ) / 5 ) ),
                        ease: Power1.easeOut,
                        force3D: true,
                        overwrite: 5
                    });
                } else {
                    TweenMax.to( $( '.parallax-jumbotron' ), 0.4, {
                        y: 0,
                        force3D: true,
                        ease: Power1.easeOut,
                        overwrite: 5
                    });

                    // Revert to non parallax original position
                    TweenMax.to( $( '.parallax-image2' ), 0.4, {
                        y: 0,
                        ease: Power1.easeOut,
                        force3D: true,
                        overwrite: 5
                    });
                }
            }
          }

        if ( 'function' == typeof( window.positionMenu ) ) {
            window.positionMenu();
            parallaxLogoElements( newScrollY );
        }
   }

    $( window ).scroll(function() {
        newScrollY = $( window ).scrollTop();
    });

    function renderLoop() {
        if ( ! isFrontPage ) {
            return;
        }
        if ( window.latestKnownScrollY !== newScrollY ) {
            window.latestKnownScrollY = newScrollY;
            requestAnimationFrame( scrollHandler );
        }
        window.setTimeout( renderLoop, 10 );
    }

    window.setTimeout( renderLoop, 16 );

    if ( false !== window.isBrowser( 'safari' ) && ! isMobileClient ) {

        if ( window.getBrowserMajorVersion() < 9 ) {
            $( '.under-title-symbol-footer' ).css({ 'margin-top': '15px' });
        }

        $( '.image-gallery-container' ).css({ 'height': 'initial' });
        $( '.ts-fixed-image' ).css({ 'background-attachment': 'scroll' });
        $( '.button' ).css({ 'display': '-webkit-flex' });
        $( '#subaligner' ).css({ 'display': '-webkit-inline-flex', '-webkit-transform': 'translateX(0)' });

    };

    if ( $( '.image-gallery-container' ).length && 0 === $( '.image-gallery-container' ).height() ) {
        $( '.image-gallery-container' ).css({ 'height': 'inherit' });
    }

    // Fix parallax and bg cover issues on specific browsers like IE, there's now way to rely on modernizr for this quirk
    // since the issue is not feature detection but browser / render engine wrong behavior
    if ( false !== window.isInternetExplorer || ( 49 > Number( window.getChromeVersion() ) && false === window.isBrowser( 'safari' ) && false === window.isBrowser( 'firefox' ) && false === window.isBrowser( 'opera' ) ) ) {
        if ( $( '.ts-fixed-image' ).length ) {
            $( '.ts-fixed-image' ).each( function() {
                $( this ).css( { 'background-attachment': 'scroll' } );
            } );
        }

        if ( 'trident' == window.isInternetExplorer ) {
            $( window ).resize(function() {
                window.setTimeout(function() {
                    setIEBgSize();
                }, 50 );
            });
            setIEBgSize();
        }

        $( '.menu-hr' ).css({ 'display': 'none' });

        // Fix object fit issue with IE and some other browsers, can't rely on modernizr for this quirk, browser stack is the only way
        // to find out which browser behaves ok and which doesn't. To this point these seem to be render engine issues
        $( '.blog-post' ).each(function() {
            var $wrapper = $( this ),
                imgUrl = $( this ).attr( 'src' );

            if ( undefined === imgUrl || null === imgUrl ) {
                return;
            }

            $wrapper.css({
                'background-image': 'url(' + imgUrl + ')',
                'background-size': 'cover',
                'background-position': '50% 50%',
                'transition': 'opacity 0, transform 0, -webkit-transform 0',
                'transform': 'scale3d(1.08, 1.08, 1)'
            });
            $wrapper.removeAttr( 'src' );
            $wrapper.removeAttr( 'alt' );
            $wrapper.removeAttr( 'srcset' );
        });

        $( '.parallax-jumbotron, .parallax-image2, .attachment-large, .sugested-posts, .most-read-blog-post, .menu-image  ' ).each(function() {
            var $wrapper = $( this );
            var imgUrl = $( this ).attr( 'src' );

            if ( undefined === imgUrl || null === imgUrl ) {
                return;
            }

            /* EDGE usecase is not needed for post images */
            if ( false === $wrapper.hasClass( 'wp-post-image' ) ) {

                $wrapper.css({
                    'background': 'url(' + imgUrl + ')',
                    'background-size': 'cover',
                    'background-position': '50% 50%'
                });
                $wrapper.removeAttr( 'src' );
                $wrapper.removeAttr( 'alt' );
            }
        });

        // Browser specific and targeted fixes.
        if ( $( '.post-types-selector' ).length && 'edge' !== window.isInternetExplorer ) {
            $( '.post-types-selector' ).css({ 'width': '100%', 'height': '0' });
        }

        if ( $( '.subfooter-first-line' ).length ) {
            $( '.subfooter-first-line' ).css({ 'display': 'inline-flex', 'font-size': '13px', 'line-height': '22px' });
            $( '.subfooter-container' ).css({ 'text-align': 'center' });
        }

        if ( $( '.side-thumbs-info' ).length ) {
            $( '.side-thumbs-info' ).css({ 'height': '21em' });
        }

        if ( $( '.zoe-bg' ).length ) {
            $( '.zoe-bg' ).css({ 'height': '0' });
        }

        $( '.align-items' ).removeClass( 'show-for-large-up' ).css({ 'display':'none' });
        $( '.side-thumbs-info' ).removeClass( 'hide-for-large-up' );
        $( '.figure-zoe' ).removeClass( '.zoe-bg' );

        if ( $( '.aligner' ).length ) {
            $( '.aligner' ).css({ 'width': 'auto' });
        }

        if ( $( '.contact-fields' ).length ) {
            $( '.contact-fields' ).css({ 'margin-top': '1em' });
        }

        if ( $( '.submit' ).length ) {
            $( '.submit' ).css({ 'margin-top': window.innerWidth < 1025 ? '1.7em' : '2.7em' });
        }

        if ( $( '.blog-navbar' ).length ) {
            $( '.blog-navbar' ).css({ 'overflow': 'hidden' });
        }
    }

    if ( false !== window.isBrowser( 'firefox' ) ) {
        if ( $( '.contact-fields' ).length ) {
            $( '.contact-fields' ).css({ 'padding-top': '1em' });
        }

        if ( $( '.menu-book-title' ).length ) {
            $( '.menu-book-title' ).css({ 'margin-bottom': '1em' });
        }
    }

    if ( false !== window.isBrowser( 'safari' ) ) {
        if ( $( '.ts-fixed-image' ).length ) {
            $( '.ts-fixed-image' ).css({ 'background-attachment': 'scroll' });
        }
    }

    if ( 'trident' == window.isInternetExplorer ) {
        if ( $( '.triangle-icon-right>i' ).length ) {
            $( '.triangle-icon-right>i' ).css({ 'left': '0px' });
        }

        if ( $( '.triangle-icon-left>i' ).length ) {
            $( '.triangle-icon-left>i' ).css({ 'left': '-4px' });
        }
    }

    if ( 'edge' == window.isInternetExplorer ) {
        if ( $( '.parallax-image2' ).length ) {
            $( '.parallax-image2' ).css({ 'height': '100%' });
        }
    }

    /* Some IEs show the alt value although the image is present, can't rely on modernizr for this browser quirk*/
    if ( false !== window.isInternetExplorer && $( 'img.parallax-image2' ).length &&  $( 'img.parallax-jumbotron' ).length ) {
        $( 'img.parallax-image2, img.parallax-jumbotron' ).removeAttr( 'alt' );
    }

    function clearSocialIcons( selector, clearParent ) {
        $( selector ).each(function() {
            if ( '#' === $( this ).attr( 'href' ) || '' === $( this ).attr( 'href' ) || ' ' === $( this ).attr( 'href' ) ) {
                if ( -1 !== selector.indexOf( 'span' ) ) {
                    $( this ).parent().css({ 'display':'none' });
                } else {
                    $( this ).css({ 'display':'none' });
                }
            }
        });
    }

    function emailValid( email ) {
        if ( 'E-Mail' == email || '' == email ) {
            return false;
        }

        return validateEmail( email );
    }

    // Helper function
    function validateEmail( email ) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test( email );
    }

    /* User message code */
    $( '.message-button' ).click(function() {
        var shouldExit = false;
        var data = {
            'action': 'the_steam_submit_message',
            'security': fnargs.the_steam_submit_message_security,
            'email': $( '#mesage-email' ).val(),
            'subject': $( '#subject-text' ).val(),
            'message': $( '#message-body' ).val()
        };

        if ( ! emailValid( $( '#mesage-email' ).val() ) ) {
            $( '#mesage-email' ).css({ 'color': 'red' }).effect( 'shake' );;
            shouldExit = true;
        }

        if ( $( '#message-body' ).val().length < 10 ) {
            $( '#message-body' ).css({ 'color': 'red' }).effect( 'shake' );
            shouldExit = true;
        }

        if ( shouldExit ) {
            return;
        }

        jQuery.post( fnargs.ajaxurl, data, function( response ) {

            // -1 is replied by wp internals, we can only deal from Javascript with this
            if ( '-1' === response ) {
                response = 'Oops! An error has occurred! Please try again later!';
            }

            $( '.contact-fields-footer' ).html( response ).css({ 'color':'#ffffff', 'font-size':'14px', 'margin-top':'1em', 'text-align':'center' });
            $( '#user-message-response' ).css({ 'color':'#ffffff', 'font-size':'14px', 'margin-top':'1em', 'min-height':'180px', 'text-align':'center' });
        });
    });

    selectors.forEach(function( selector ) {
        clearSocialIcons( selector );
    });

    if ( 'yes' === fnargs.vibrate_enabled ) {
        $( '#mobile-menu-open' ).vibrate( 'short' );
        $( '#navbar-logo' ).vibrate( 'short' );
        $( '#arrow-down' ).vibrate( 'short' );
        $( '.fript-container' ).vibrate( 'short' );
        $( '.photo-align-selector' ).vibrate( 'short' );
        $( '.items-align' ).vibrate( 'short' );
        $( '.title-line' ).vibrate( 'short' );
        $( '.read-more-btn' ).vibrate( 'short' );
        $( '.message-button' ).vibrate( 'short' );
    }
});
