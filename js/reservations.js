/**
 * Reservations
 * License: GPLv2 or later
 * Author: WDI
 * Link: http://www.webdotinc.net/thesteam
 */

// We grab them numbers by the OpenTable unofficial API

function getRestaurantName( objid, url ) {
    var xhttp = new XMLHttpRequest();

    if ( null == url ) {
        console.warn( 'AJAX request target is NULL' );
        return;
    }

    xhttp.onreadystatechange = function() {
        var restName = 0;
        if ( 4 == xhttp.readyState && 200 == xhttp.status ) {
            restName = parseRestaurantName( xhttp.responseText );
            document.getElementById( objid ).value = restName;
        }
    };
    xhttp.open( 'GET', getQueryUrl( url ), true );
    xhttp.send();
}

function getQueryUrl( restaurantId ) {
    var queryUrl = 'https://opentable.herokuapp.com/api/restaurants/';
    queryUrl += restaurantId;

    return queryUrl;
}

function parseRestaurantName( result ) {
    var res = 0;

    if ( null == result || '[]' == result || '[ ]' == result ) {
        return 0;
    }

    res = JSON.parse( result );

    if ( null !== res && undefined !== res ) {
        return res.name;
    }

    return 0;
}

jQuery( document ).ready(function( $ ) {
    'use strict';

    window.setTimeout(function() {
        if ( 'yes' === resargs.use_opentable ) {
            getRestaurantName( 'opentable-res-name', resargs.opentable_restaurant_id );
        }
    }, 2000 );

    function initializeDesktopSelectors() {
        var dateFormat = 'yes' === resargs.option_date_format_usa ? 'mm-dd-y' : 'dd-mm-y';
        Date.prototype.addHours = function( h ) {
            this.setTime( this.getTime() + ( h * 60 * 60 * 1000 ) );

            return this;
        };

        $( '#reservations-num-guests-selector' ).selectmenu().selectmenu( 'menuWidget' ).addClass( 'overflow' );
        $( '#reservations-num-guests-selector' ).selectmenu( 'option', 'width', false );
        $( '#reservations-date-selector' ).datepicker().datepicker( 'option', 'dateFormat', dateFormat ).datepicker( 'setDate', new Date() );

        $( '#reservations-hour-selector' ).timepicker({ 'timeFormat': 'H:i',  'forceRoundTime': true, 'scrollDefault': 'now' }).timepicker( 'setTime', new Date().addHours( 1 ) );
        $( '.ui-selectmenu-button' ).width( '80%' );

        $( '#reservations-hour-selector' ).on( 'click', function() {
            var pickerWidth = $( '#reservations-hour-selector' ).width() + 'px';
            var left = parseInt( $( '.ui-timepicker-wrapper' ).css( 'left' ), 10 );

            if ( ! $( '.ui-timepicker-wrapper' ).hasClass( 'hasLeft' ) ) {
                $( '.ui-timepicker-wrapper' ).css({ 'left': left + 6 + 'px' }).addClass( 'hasLeft' );
            }

            /* JQuery messes with this element so we have to update it */
            $( '.ui-timepicker-wrapper' ).css({ 'width': pickerWidth });
        });
    }

    initializeDesktopSelectors();

    function phoneValid( phone ) {
        if ( $( '#phone' ).data( 'emptyvalue' ) == phone || '' == phone ) {
            return false;
        }

        return true;
    }

    function tsVibrate() {
        if ( 'yes' === resargs.vibrate_enabled ) {
            $( '#phone' ).vibrate({
                trigger: 'touchstart',
                pattern: [20, 100, 20] /* Disabled is 0 */
            });

            $( '#phone' ).trigger( 'touchstart' );
            window.setTimeout(function() {
                $( '#phone' ).trigger( 'touchend' );
            }, 400 );
        }
    }

    function validateEmail( email ) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test( email );
    }

    /* Reservation handling for large screens - client side */
    $( '.reservations-submit' ).click(function() {
        var shouldExit = false;
        var time = $( '#reservations-hour-selector' );
        var date = $( '#reservations-date-selector' );
        var opentableRestaurantName, openTableRedirect = null;
        var dayPos = 'yes' === resargs.option_date_format_usa ? 1 : 0;
        var monthPos = 'yes' === resargs.option_date_format_usa ? 0 : 1;

        var data = {
            'action': 'the_steam_submit_reservation',
            'security': resargs.the_steam_submit_reservation_security,
            'hour':time.val().split( ':' )[0],
            'minute': time.val().split( ':' )[1],
            'day': date.val().split( '-' )[dayPos],
            'month': date.val().split( '-' )[monthPos],
            'num_pers': Number( $( '#reservations-num-guests-selector' ).val() ),
            'email': $( '#email' ).val(),
            'phone': $( '#phone' ).val(),
            'year': new Date().getFullYear()
        };

        if ( 'yes' === resargs.use_opentable ) {
            opentableRestaurantName = $( '#opentable-res-name' ).val();
            opentableRestaurantName = encodeURI( opentableRestaurantName.toLowerCase() );
            opentableRestaurantName = opentableRestaurantName.replace( /%20/g, '-' );

            if ( undefined === opentableRestaurantName ) {
                return;
            }

            openTableRedirect = 'https://www.opentable.com/r/';
            openTableRedirect += opentableRestaurantName;
            openTableRedirect += '?restref=';
            openTableRedirect += resargs.opentable_restaurant_id;
            openTableRedirect += '&datetime=' + data.year + '-' + data.month + '-' + data.day + 'T' + encodeURIComponent( String( time.val() ) );
            openTableRedirect += '&covers=' + data.num_pers + '&searchdatetime=' + data.year + '-' + data.month + '-';
            openTableRedirect += data.day + 'T' + encodeURIComponent( String( time.val() ) ) + '&partysize=' + data.num_pers;

            window.location.href = openTableRedirect;

            return;
        }

        if ('yes' === resargs.enforce_email && 'true' === resargs.secondary_field_email) {
            if ( ! validateEmail( $( '#email' ).val() ) ) {
                $( '#email' ).css({ 'color': 'red' }).effect( 'shake' );

                shouldExit = true;
            }
        }

        if ( ! phoneValid( $( '#phone' ).val() ) ) {
            $( '#phone' ).css({ 'color': 'red' }).effect( 'shake' );

            shouldExit = true;
        }

        if ( resargs.sending_msg === $( '.reservations-submit' ).text() ) {
            shouldExit = true;
        }

        if ( shouldExit ) {
            tsVibrate();

            return;
        }

        $( '.reservations-submit' ).text( resargs.sending_msg );

        jQuery.post( resargs.ajaxurl, data, function( response ) {
            $( '#reservations-space' ).html( '<h3 id="reservation-response-wrapper">' + response + '</h3>' );
            $( '#reservation-response-wrapper' ).css({
                'margin-left': 'auto',
                'margin-right': 'auto',
                'text-align': 'center',
                'margin-top': 'auto',
                'margin-bottom': 'auto',
                'max-width': '65%',
                'word-wrap': 'break-word',
                'line-height': '2em',
                'font-size': '18px'
            });
        });
    });

    /* Fill in phone and e-mail with hints */
    $(function() {
        $( 'input' ).each(function() {
            if ( '' == $( this ).val() ) {
                $( this ).val( $( this ).data( 'emptyvalue' ) );
            }
        });

    });

    $( 'input' ).focusin(function() {
        if ( 'phone' == $( this ).attr( 'id' ) || 'email' == $( this ).attr( 'id' ) ) {
            if ( $( this ).data( 'emptyvalue' ) == $( this ).val() || resargs.email_hint == $( this ).val() ) {
                $( this ).css({ 'color': '#333333' });
                $( this ).val( '' );
            }
            $( this ).siblings().addClass( 'focused' );
        }
    }).focusout(function() {
        if ( '' == $( this ).val() && ( 'phone' == $( this ).attr( 'id' ) || 'email' == $( this ).attr( 'id' ) ) ) {
            $( this ).val( $( this ).data( 'emptyvalue' ) );
            $( this ).siblings().removeClass( 'focused' );
        }
    });

    /* Allow only numbers to be typed in the phone input */
    $( '#phone' ).keydown(function( e ) {
        if ( -1 !== $.inArray( e.keyCode, [46, 8, 9, 27, 13, 110, 190]) ||
            ( 65 == e.keyCode && ( true === e.ctrlKey || true === e.metaKey ) ) ||
            ( e.keyCode >= 35 && e.keyCode <= 40 ) ) {
            return;
        }
        if ( ( e.shiftKey || ( e.keyCode < 48 || e.keyCode > 57 ) ) && ( e.keyCode < 96 || e.keyCode > 105 ) ) {
            e.preventDefault();
        }
    });

    /* Create datepicker for small screens*/
    $(function() {
        $( '#res-datepicker' ).datepicker();
    });

    $( '#res-datepicker' ).on( 'click', function() {
        $( '#ui-datepicker-div' ).css({ 'z-index':'99999' });
    });
});
