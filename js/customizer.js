/**
 * Customizer
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */

/*
 * Snippet and workaround for !important by Aram Kocharyan
 * See: http://stackoverflow.com/questions/2655925/how-to-apply-important-using-css
 */
(function( $ ) {
    if ( $.fn.style ) {
        return;
    }

    // Escape regex chars with \
    var escape = function( text ) {
        return text.replace( /[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&' );
    };

    // For those who need them (< IE 9), add support for CSS functions
    var isStyleFuncSupported = !! CSSStyleDeclaration.prototype.getPropertyValue;
    if ( ! isStyleFuncSupported ) {
        CSSStyleDeclaration.prototype.getPropertyValue = function( a ) {
            return this.getAttribute( a );
        };
        CSSStyleDeclaration.prototype.setProperty = function( styleName, value, priority ) {
            this.setAttribute( styleName, value );
            var priority = typeof priority != 'undefined' ? priority : '';
            if ( priority != '' ) {
                // Add priority manually
                var rule = new RegExp( escape( styleName ) + '\\s*:\\s*' + escape( value ) +
                    '(\\s*;)?', 'gmi' );
                this.cssText =
                    this.cssText.replace( rule, styleName + ': ' + value + ' !' + priority + ';' );
            }
        };
        CSSStyleDeclaration.prototype.removeProperty = function( a ) {
            return this.removeAttribute( a );
        };
        CSSStyleDeclaration.prototype.getPropertyPriority = function( styleName ) {
            var rule = new RegExp( escape( styleName ) + '\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?',
                'gmi' );
            return rule.test( this.cssText ) ? 'important' : '';
        };
    }

    // The style function
    $.fn.style = function( styleName, value, priority ) {
        // DOM node
        var node = this.get( 0 );
        // Ensure we have a DOM node
        if ( typeof node == 'undefined' ) {
            return this;
        }
        // CSSStyleDeclaration
        var style = this.get( 0 ).style;
        // Getter/Setter
        if ( typeof styleName != 'undefined' ) {
            if ( typeof value != 'undefined' ) {
                // Set style property
                priority = typeof priority != 'undefined' ? priority : '';
                style.setProperty( styleName, value, priority );
                return this;
            } else {
                // Get style property
                return style.getPropertyValue( styleName );
            }
        } else {
            // Get CSSStyleDeclaration
            return style;
        }
    };
})( jQuery );

jQuery( document ).ready(function( $ ) {
    'use strict';
    var firstLogo = initialSettings.firstLogoImage;
    var initMenuColor = $( 'a.menu-hover' ).css( 'color' );

    // Fix IE / Opera background size issue.
    function updateBrowserSpecifics() {
        $( '.parallax-image2' ).each(function() {

            var $wrapper = $( this ),
                imgUrl = $( this ).attr( 'src' );

            $wrapper.css({
                'background': 'url(' + imgUrl + ')',
                'background-size': 'cover',
                'background-position': '50% 50%'
            });

            $wrapper.removeAttr( 'src' );
            $wrapper.removeAttr( 'alt' );

        });
    }

    // Smooth scroll to changed element.
    function scrollToElement( element, top, offset ) {
        var offsetAdd = 0;
        var desiredPos = 0;
        var currPos = 0;

        if (! $( element).length) {
            return;
        }

        if ( undefined === $( element ) || undefined === $( element ).offset() ) {
            return;
        }

        if ( undefined !== offset ) {
            offsetAdd = offset;
        }

        desiredPos = $( element ).offset().top - $( element ).height() - $( element ).height() / 2 + offsetAdd;
        currPos = document.documentElement.scrollTop || document.body.scrollTop;

        if ( undefined === element ) {
            return;
        }

        if ( 'true' == top ) {

            // Prevent running futile queued up events.
            if ( ( document.documentElement.scrollTop || document.body.scrollTop ) <= 50 ) {
                return;
            }

            $( 'html, body' ).animate({
                scrollTop: 0 + offset
            }, 500 );

            return;
        }

        if ( undefined === $( element ).offset() ) {
            return;
        }

        if ( desiredPos == currPos ) {
            return;
        }

        $( 'html, body' ).animate({
            scrollTop: desiredPos
        }, 500 );
    }

    // WP Customizer handlers
    wp.customize( 'the_steam_menu_logo', function( value ) {
        value.bind(function( to ) {
            var date = new Date();
            scrollToElement( 'notUsed', 'true' );
            $( '#navbar-logo' ).attr( 'src', to );
            $( '#navbar-logo-small' ).attr( 'src', to );
            window.scrollTo( 0, 0 );
        });
    });

    wp.customize( 'the_steam_header_animation', function( value ) {
        value.bind(function( to ) {
            if ( 'none' === to || '' === to ) {

                // Nothing to animate.
                return;
            }
            scrollToElement( 'notUsed', 'true' );
            $( '.logo-animation-supported' ).attr( 'class', 'first-logo logo-animation-supported' );
            $( '.logo-animation-supported' ).addClass( 'animated ' + to );
        });
    });

    wp.customize( 'the_steam_frontpage_header_animation', function( value ) {
        value.bind(function( to ) {
            if ( ' ' === to || '' === to ) {

                // Nothing to animate.
                return;
            }
            scrollToElement( 'notUsed', 'true' );

            if ( $( '#parallax-jumbotron' ).length ) {
                $( '#parallax-jumbotron' ).addClass( 'img-brought-in' );
                window.setTimeout(function() {
                    $( '#parallax-jumbotron' ).addClass( 'img-brought-back' );

                    window.setTimeout(function() {
                        $( '#parallax-jumbotron' ).removeClass( 'img-brought-in' );
                        $( '#parallax-jumbotron' ).removeClass( 'img-brought-back' );
                    }, 1500 );
 }, 1000 );
            }
        });
    });

    wp.customize( 'the_steam_section1_animation', function( value ) {
        value.bind(function( to ) {
            if ( ' ' === to || '' === to ) {

                // Nothing to animate.
                return;
            }
            scrollToElement( '#first-section-text', false, 500  );
            $( '.about-animation-supported' ).each(function() {
                while ( true === $( this ).hasClass( 'animated' ) ) {
                    var lastAnimationClass = $( this ).attr( 'class' ).split( ' ' ).pop();
                    $( this ).removeClass( lastAnimationClass );
                }
            });

            $( '.about-animation-supported' ).each(function( index, value ) {
                window.setTimeout(function( obj ) {
                    obj.addClass( 'animated' ).addClass( to );
                }, index * 350, $( this ) );
            });

        });
    });

    wp.customize( 'the_steam_dishtypes_animation', function( value ) {
        value.bind(function( to ) {
            if ( 'none' === to || '' === to ) {

                // Nothing to animate.
                return;
            }

            scrollToElement( '#white-section2wp', false, 500  );
            $( '.frip-animation-supported' ).attr( 'class', 'fript-container clickable frip-animation-supported vibrate' );
            $( '.frip-animation-supported' ).each(function( index, value ) {
                window.setTimeout(function( obj ) {
                    obj.addClass( 'animated' ).addClass( to );
                }, index * 150, $( this ) );
            });
        });
    });

    wp.customize( 'the_steam_reservations_animation', function( value ) {
        value.bind(function( to ) {
            if ( 'none' === to || '' === to ) {

                // Nothing to animate.
                return;
            }

            scrollToElement( '#white-section4wp', false, 500 );
            $( '.reservations-animation-supported' ).each(function() {
                while ( true === $( this ).hasClass( 'animated' ) ) {
                    var lastAnimationClass = $( this ).attr( 'class' ).split( ' ' ).pop();
                    $( this ).removeClass( lastAnimationClass );
                }
            });
            $( '.reservations-animation-supported' ).each(function( index, value ) {
                window.setTimeout(function( obj ) {
                    obj.addClass( 'animated' ).addClass( to );
                }, index * 350, $( this ) );
            });
        });
    });

    // WP Customizer handlers
    wp.customize( 'the_steam_logo1', function( value ) {
        value.bind(function( to ) {
            scrollToElement( 'notUsed', 'true' );
            $( '.first-logo' ).attr( 'src', to );
            window.scrollTo( 0, 0 );
        });
    });

    wp.customize( 'background-image', function( value ) {
        value.bind(function( to ) {
            scrollToElement( 'notUsed', 'true' );
            $( '.body' ).css({ 'background-image': 'url(' + to + ')' });
            window.scrollTo( 0, 0 );
        });
    });

    wp.customize( 'the_steam_first_section_msg_line1', function( value ) {
        value.bind(function( to ) {
            scrollToElement( ' .aligner ' );
            $( '#before-header-text' ).text( to );
        });
    });

    wp.customize( 'the_steam_first_section_msg_line2', function( value ) {
        value.bind(function( to ) {
            scrollToElement( ' .aligner ' );
            $( '#header-text' ).text( to );
        });
    });

    wp.customize( 'the_steam_first_section_msg_line1_color', function( value ) {
        value.bind(function( to ) {
            scrollToElement( ' .aligner ' );
            if ( 'blank' !== to ) {
                $( '#before-header-text' ).css({
                    'color': to
                });
            }
        });
    });

    wp.customize( 'the_steam_first_section_msg_line2_color', function( value ) {
        value.bind(function( to ) {
            scrollToElement( ' .aligner ' );
            if ( 'blank' !== to ) {
                $( '#header-text' ).css({
                    'color': to
                });
            }
        });
    });

    wp.customize( 'the_steam_first_section_msg_line3', function( value ) {
        value.bind(function( to ) {
            scrollToElement( ' .aligner ' );
            $( '#subheader-text' ).text( to );
        });
    });

    wp.customize( 'the_steam_first_section_msg_line3_color', function( value ) {
        value.bind(function( to ) {
            scrollToElement( ' .aligner ' );
            if ( 'blank' !== to ) {

                $( '#subheader-text' ).css({
                    'color': to
                });
            }
        });
    });

    wp.customize( 'the_steam_third_section_msg_line1', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                scrollToElement( '.second-image' );
                $( '#third-section-msg' ).text( to );
            }
        });
    });

    wp.customize( 'the_steam_third_section_msg_line1_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#third-section-msg' ).css({
                    'color': to
                });
                scrollToElement( '.second-image' );
            }
        });
    });

    wp.customize( 'the_steam_third_section_msg_line2', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                scrollToElement( '.second-image' );
                $( '#third-section-msg2' ).text( to );
            }
        });
    });

    wp.customize( 'the_steam_third_section_msg_line2_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#third-section-msg2' ).css({
                    'color': to
                });
                scrollToElement( '.second-image' );
            }
        });
    });

    wp.customize( 'the_steam_second_image', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '.second-image' );
            window.$img2src = to;
            $( '.parallax-image2' ).attr( 'src', to ).show();

            if ( 'none' === $( '.reservations-label-text' ).css( 'display' ) ) {

                // Is small screen.
                $( '#second-image-container' ).css({ 'background-image': 'url(' + window.$img2src + ')', 'background-position': 'center, center', 'background-size': 'cover', 'background-repeat': 'no-repeat' });
                $( '.parallax-image2' ).css({ 'height': '0px', 'width': '0px' }).removeAttr( 'src' );
                $( '.parallax-image2' ).removeAttr( 'alt' );
            } else {
                $( '.parallax-image2' ).css({ 'width':'100%', 'height': 'auto' }).attr( 'src', window.$img2src ).show();
                $( '#second-image-container' ).css({ 'background-image': 'none' });
            }

            if ( false !== window.isInternetExplorer || ( 49 > Number( window.getChromeVersion() ) && false === window.isBrowser( 'safari' ) && false === window.isBrowser( 'firefox' ) && false === window.isBrowser( 'opera' ) ) ) {
                updateBrowserSpecifics();
            }
        });
    });

    wp.customize( 'the_steam_fourth_section_msg_line1', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '.menu-title-aligner' );
            if ( 'blank' !== to ) {
                $( '#menu-book-title' ).text( to );
            }
        });
    });

    wp.customize( 'the_steam_fourth_section_menu_book_color', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '.food-type' );
            if ( 'blank' !== to ) {
                $( '.product-line, .product-description, .owl-carousel .owl-wrapper-outer' ).css({ 'color':to });
                $( '.under-food-type' ).css({ 'border-top-color':to });
            }
        });
    });

    wp.customize( 'the_steam_color_scheme_setting', function( value ) {
        value.bind(function( to ) {
            scrollToElement( 'notUsed', 'true' );
            if ( 'blank' !== to ) {
                $( '.above, .under, .forth-line-owly, .forth-line-owly-side' ).css({ 'color':to });
                $( '.diamond, .below-menu-hr, .diamond-above' ).css({ 'background-color':to });
            }
        });
    });

    wp.customize( 'the_steam_dishlist_color_scheme_setting', function( value ) {
        value.bind(function( to ) {
            scrollToElement( 'notUsed', 'true' );
            if ( 'blank' !== to ) {
                $( ' a.read-more-txt, .comment-form p > a, .comment-author b > a, .reply > a, .comment-metadata > a, .comment-metadata span > a, .sticky .post-title-line a, .sticky .post-title-line:first-child a:before, .sticky .post-title-line a, .post-title-line a' ).css({ 'color':to });
                $( '.post-bottom, .similar-recipes ' ).css({ 'background-color':to });
                $( '.read-more-btn'.hover ).css({ 'background-color':to });
                $( ' .read-more-btn, .trio-selector, .sticky .main-post-container ' ).css({ 'border-color':to });
                $( '  #triangle-down, .next-post, .previous-post, .triangle-right:after, .triangle-right-2:after, .triangle-left:after, .triangle-left-2:after, .square ' ).css({ 'border-top-color':to });
                $( ' .next-post, .triangle-icon-right > i, .first-column:hover #triangle-right, #triangle-right-front ' ).css({ 'border-left-color':to });
                $( ' .previous-post, .triangle-icon-left > i, .first-column:hover #triangle-left, #triangle-left-front ' ).css({ 'border-right-color':to });
                $( ' .next-post, .previous-post, .square ' ).css({ 'border-bottom-color':to });
            }
        });
    });

    wp.customize( 'the_steam_dishlist_widget_color_scheme_setting', function( value ) {
        value.bind(function( to ) {
            scrollToElement( 'notUsed', 'true' );
            if ( 'blank' !== to ) {
                $( ' .search-container input, .search-container input:focus, .widget_pages, .widget_recent_entries, .widget_recent_comments, .widget_archive, .widget_categories, .widget_categories select, .widget_meta, .widget_text, .widget_tag_cloud, .widget_calendar, .top-line, .widget_nav_menu, .widget_rss ' ).css({ 'border-color':to });
                $( ' .widget_pages ul:first-child:before, .widget_recent_entries ul:before, .widget_archive ul:before, .widget_recent_comments ul:before, .widget_categories ul:first-child:before, .widget_meta ul:before, .textwidget:before, .tagcloud:before, .widget_nav_menu:before, .widget_rss ul:before ' ).css({ 'border-top-color':to });
                $( ' .post-container ' ).css({ 'border-left-color':to });
                $( ' .post-container ' ).css({ 'border-right-color':to });
                $( ' .post-container ' ).css({ 'border-bottom-color':to });
                $( ' p.post-topitem, a.post-topitem:active, a.post-topitem:visited, a.post-topitem:hover, p.logged-in-as ' ).css({ 'color':to });
            }
        });
    });

    wp.customize( 'the_steam_fourth_section_msg_line2', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '.menu-title-aligner' );
            if ( 'blank' !== to ) {
                $( '#menu-section-under-title' ).text( to );
            }
        });
    });

    wp.customize( 'the_steam_fourth_section_msg_line1_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#menu-book-title' ).css({
                    'color': to
                });
                $( '#menu-section-under-title' ).css({
                    'color': to
                });
                scrollToElement( '.menu-title-aligner' );
            }
        });
    });

    wp.customize( 'the_steam_fifth_section_msg_line1_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#fifth-section-msg' ).css({
                    'color': to
                });
                scrollToElement( '' );
            }
        });
    });

    wp.customize( 'the_steam_fourth_image', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '.menu-title-aligner' );
            $( '.fourth-section' ).css({ 'background-image': 'url(' + to + ')' });
        });
    });

    wp.customize( 'the_steam_frontpage_menubook_filter', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '' );
            $( '.behind-menu-filter' ).css({ 'background-color': to });
        });
    });

    wp.customize( 'the_steam_navbar_filter', function( value ) {
        value.bind(function( to ) {

            $( '.navbar-default' ).style( 'background-color', to, 'important' );
        });
    });

    wp.customize( 'the_steam_navbar_filter_stacked', function( value ) {
        value.bind(function( to ) {

            $( '.navbar-default' ).style( 'background-color', to, 'important' );
        });
    });

    wp.customize( 'the_steam_navbar_text_stacked', function( value ) {
        value.bind(function( to ) {
            scrollToElement(  '#about-text' );
            $( '.stacked' ).each(function() {
 $( this ).style( 'color', to, 'important' );
 });
        });
    });

    wp.customize( 'the_steam_navbar_text_unstacked', function( value ) {
        value.bind(function( to ) {
            $( '.unstacked' ).each(function() {
 $( this ).style( 'color', to, 'important' );
 });
        });
    });

    wp.customize( 'the_steam_frontpage_map_selection', function( value ) {
        value.bind(function( to ) {
            if ( 'none' === to || '' === to ) {

                // Nothing to animate.
                return;
            }

            scrollToElement( '#map-bg' );

            if ( typeof window.frontpage_map_init === 'function' ) {
                window.map_style_index = to;
                window.frontpage_map_init();
            }
        });
    });

    wp.customize( 'the_steam_navbar_items_hover_color', function( value ) {
        value.bind(function( to ) {
            $( 'a.menu-hover' ).on( 'mouseenter', function() {
                $( '.menu-hover' ).hover(function( e ) {
$( this ).style( 'color', ( e.type === 'mouseenter' ? to : initMenuColor ), 'important' );
});

            });
        });
    });

    wp.customize( 'the_steam_dishlist_widget_color_hover_filter', function( value ) {
        value.bind(function( to ) {
            $( '.post-selector-item' ).on( 'mouseenter', function() {
                $( '.first-row-widget' ).css({ 'background-color': to });
            });
            //$( '.first-row-widget' ).trigger( 'mouseenter' );
        });
    });

    wp.customize( 'the_steam_second_section_message1', function( value ) {
        value.bind(function( to ) {
            $( '#white-section-title' ).text( to );
            scrollToElement( '.arrow-down' );
        });
    });

    wp.customize( 'the_steam_second_section_message2', function( value ) {
        value.bind(function( to ) {
            $( '#about-text' ).text( to );
            scrollToElement( '.arrow-down' );
        });
    });

    wp.customize( 'the_steam_second_section_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#white-section-title' ).css({
                    'color': to
                });

                $( '#about-text' ).css({
                    'color': to
                });

                scrollToElement( '.arrow-down' );
            }
        });
    });

    wp.customize( 'the_steam_footer_cuisine', function( value ) {
        value.bind(function( to ) {
            $( '#restaurant-cuisine' ).html( to );
            scrollToElement( '#restaurant-cuisine' );
        });
    });

    wp.customize( 'the_steam_footer_title', function( value ) {
        value.bind(function( to ) {
            $( '#footer-title' ).html( to );
            scrollToElement( '#footer-title' );
        });
    });

    wp.customize( 'the_steam_footer_subtitle_left', function( value ) {
        value.bind(function( to ) {
            $( '#left-title' ).text( to );
            scrollToElement( '#footer-title' );
        });
    });

    wp.customize( 'the_steam_footer_subtitle_left_social', function( value ) {
        value.bind(function( to ) {
            $( '#left-title-social' ).html( to );
            scrollToElement( '#footer-title' );
        });
    });

    wp.customize( 'the_steam_footer_subtitle_right', function( value ) {
        value.bind(function( to ) {
            $( '#contact-paragraph-title' ).html( to );
            scrollToElement( '#footer-title' );
        });
    });

    wp.customize( 'the_steam_footer_paragraph', function( value ) {
        value.bind(function( to ) {
            $( '#footer-text' ).html( to );
            scrollToElement( '#footer-title' );
        });
    });

    wp.customize( 'the_steam_all_header_msg_line_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#first-logo-line, #second-logo-line' ).css({
                    'color': to
                });

                $( '.line' ).css({
                    'border-color': to
                });
            }
        });
    });

    wp.customize( 'the_steam_bloglist_page_header_upper_menu_text_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '.bloglist-menu-color' ).css({
                    'color': to
                });

                $( '.menu-topitem' ).css({
                    'color': to
                });
                scrollToElement( '#large-image' );
            }
        });
    });

    wp.customize( 'the_steam_text_or_logo', function( value ) {
        value.bind(function( to ) {
            var date = new Date();
            if ( 'normal' === to ) {
                $( '.logo-text-general' ).css({
                    'display': 'block'
                });
                $( '.logo-image' ).css({
                    'display': 'none'
                });
                scrollToElement( ' .aligner ' );
            } else {
                $( '.logo-text-general' ).css({
                    'display': 'none'
                });
                $( '.logo-image' ).css({
                    'display': 'block'
                });

                $( '.first-logo' ).attr( 'src', firstLogo + '?' + date.getTime() ).load(function() {
                    this.width;
                });

                $( '.first-logo' ).css({ 'display': 'block' });
                scrollToElement( ' .aligner ' );
            }
        });
    });

    wp.customize( 'the_steam_blog_list_title', function( value ) {
        value.bind(function( to ) {
            $( '#first-logo-line' ).text( to );
        });
    });

    wp.customize( 'the_steam_curtain_image1', function( value ) {
        value.bind(function( to ) {
            $( '#curtain-image1' ).css({ 'background-image': 'url(' + to + ')' });
            scrollToElement( '.arrow-down' );
        });
    });

    wp.customize( 'the_steam_curtain_image2', function( value ) {
        value.bind(function( to ) {
            $( '#curtain-image2' ).css({ 'background-image': 'url(' + to + ')' });
            scrollToElement( '.arrow-down' );
        });
    });

    wp.customize( 'the_steam_curtain_image3', function( value ) {
        value.bind(function( to ) {
            $( '#curtain-image3' ).css({ 'background-image': 'url(' + to + ')' });
            scrollToElement( '.arrow-down' );
        });
    });

    wp.customize( 'the_steam_curtain_image4', function( value ) {
        value.bind(function( to ) {
            $( '#curtain-image4' ).css({ 'background-image': 'url(' + to + ')' });
            scrollToElement( '.arrow-down' );
        });
    });

    wp.customize( 'the_steam_fifth_section_msg_line1', function( value ) {
        value.bind(function( to ) {
            $( '#blog-section-title' ).text( to );
            scrollToElement( '.blog-image-aligner' );
        });
    });

    wp.customize( 'the_steam_fifth_section_msg_line2', function( value ) {
        value.bind(function( to ) {
            $( '#blog-section-under-title' ).text( to );
            scrollToElement( '.blog-image-aligner' );
        });
    });

    wp.customize( 'the_steam_fifth_section_msg_line1_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#blog-section-title' ).css({
                    'color': to
                });

                $( '#blog-section-under-title' ).css({
                    'color': to
                });
                scrollToElement( '.blog-image-aligner' );
            }
        });
    });

    wp.customize( 'the_steam_reservations_section_msg_line1', function( value ) {
        value.bind(function( to ) {
            $( '#reservations-title' ).text( to );
            scrollToElement( '.res-aligner' );
        });
    });

    wp.customize( 'the_steam_reservations_section_msg_line2', function( value ) {
        value.bind(function( to ) {
            $( '#reservations-under-title' ).text( to );
            scrollToElement( '.res-aligner' );
        });
    });

    wp.customize( 'the_steam_reservations_section_subtitle', function( value ) {
        value.bind(function( to ) {
            $( '.reservations-subtitle' ).text( to );
            scrollToElement( '.res-aligner' );
        });
    });

    wp.customize( 'the_steam_reservations_section_details1', function( value ) {
        value.bind(function( to ) {
            $( '.reservations-details-line1' ).text( to );
            scrollToElement( '.res-aligner' );
        });
    });

    wp.customize( 'the_steam_reservations_section_details2', function( value ) {
        value.bind(function( to ) {
            $( '.reservations-details-line2' ).text( to );
            scrollToElement( '.res-aligner' );
        });
    });

    wp.customize( 'the_steam_reservations_section_details_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '.reservations-details-line1' ).css({
                    'color': to
                });

                $( '.reservations-details-line2' ).css({
                    'color': to
                });

                $( '.reservations-subtitle' ).css({
                    'color': to
                });
                scrollToElement( '.res-aligner' );
            }
        });
    });

    wp.customize( 'the_steam_reservations_section_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#reservations-title' ).css({
                    'color': to
                });

                $( '#reservations-under-title' ).css({
                    'color': to
                });
                scrollToElement( '.res-aligner' );
            }
        });
    });

    wp.customize( 'the_steam_map_section_msg_line1', function( value ) {
        value.bind(function( to ) {
            $( '#map-restaurant-details' ).text( to );
            scrollToElement( '#map-bg' );
        });
    });

    wp.customize( 'the_steam_map_section_msg_line2', function( value ) {
        value.bind(function( to ) {
            $( '#map-restaurant-location' ).text( to );
            scrollToElement( '#map-bg' );
        });
    });

    wp.customize( 'the_steam_map_section_color', function( value ) {
        value.bind(function( to ) {
            if ( 'blank' !== to ) {
                $( '#map-restaurant-details' ).css({
                    'color': to
                });
                $( '#map-restaurant-location' ).css({
                    'color': to
                });
                scrollToElement( '#map-bg' );
            }
        });
    });

    wp.customize( 'the_steam_all_posts_page_header', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '#dishlist-header-image' );
            $( '#bloglist-header-image' ).css({ 'background-image': 'url(' + to + ')' });
        });
    });

    wp.customize( 'the_steam_all_categories_page_header', function( value ) {
        value.bind(function( to ) {
            $( '#all-categories-header' ).css({ 'background-image': 'url(' + to + ')' });
        });
    });

    wp.customize( 'the_steam_dishlist_page_header', function( value ) {
        value.bind(function( to ) {
            scrollToElement( '#dishlist-header-image' );
            $( '#dishlist-header-image' ).css({ 'background-image': 'url(' + to + ')' });
        });
    });

    function scrollToGallery() {
        scrollToElement( '#gallery-list', 0, -100 );
    }

    if ('true' !== initialSettings.galleryEnabled) {
        return;
    }

    wp.customize( 'the_steam_gallery_image0', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb1' ).length) {
                $( '#gallery-thumb1' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb1" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image1', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb2' ).length) {
                $( '#gallery-thumb2' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb2" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image2', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb3' ).length) {
                $( '#gallery-thumb3' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb3" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image3', function( value ) {
        value.bind(function( to ) {
            if ($('#gallery-thumb4' ).length) {
                $( '#gallery-thumb4' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb4" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image4', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb5' ).length) {
                $( '#gallery-thumb5' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb5" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image5', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb6' ).length) {
                $( '#gallery-thumb6' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb6" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image6', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb7' ).length) {
                $( '#gallery-thumb7' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb7" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image7', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb8' ).length) {
                $( '#gallery-thumb8' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb8" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image8', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb9' ).length) {
                $( '#gallery-thumb9' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb9" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image9', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb10' ).length) {
                $( '#gallery-thumb10' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb10" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });

    wp.customize( 'the_steam_gallery_image10', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb11' ).length) {
                $( '#gallery-thumb11' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb11" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });


    wp.customize( 'the_steam_gallery_image11', function( value ) {
        value.bind(function( to ) {
            scrollToGallery();
            if ($('#gallery-thumb12' ).length) {
                $( '#gallery-thumb12' ).attr( 'src', to );
            } else {
                if ($('.steam-gallery-list').length) {
                    $('.steam-gallery-list').append(
                        '<div class="steam-individual-thumbnail steam-thumbnail-media">' +
                        '<a class="steam-gallery-image-anchor no-load" href="' + to + '"></a>' +
                        '<div class="steam-thumb-pad">' +
                        '<div class="steam-ab-thmb"></div>' +
                        '<div class="gallery-image-container">' +
                        '<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>' +
                        '<div class="steam-gallery-img">' +
                        '<img id="gallery-thumb12" class="steam-img-thmb" src="' + to + '"/>' +
                        '<span class="steam-img-meta">' +
                        '<span class="steam-img-magnify">' +
                        '<i class="fa fa-3x fa-search" aria-hidden="true"></i>' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }
            }
        });
    });
});

