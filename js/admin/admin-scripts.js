/**
 * Admin-scripts
 * License: Standard License
 * License URL: https://themeforest.net/licenses/standard
 * Author: WDI
 * Link: http://www.webdotinc.net/thesteam
 */

jQuery( document ).ready(function( $ ) {
    'use strict';

    var carouselDelay = $( '#carousel-delay' );

    function updateReservationsSystemSelect() {
        var $reservationsSystemSelect = $( '#reservation-system-selector' );
        var $opentableRestaurantId = $( '#opentable-restaurant-id-fields' );
        var display;

        if ( $reservationsSystemSelect.length ) {
            display = ( 'yes' === $reservationsSystemSelect.val() ) ? 'table-row' : 'none';
            $opentableRestaurantId.css({ 'display':display });
        }
    }

    function updateFullscrenVideoSelect() {
        var $videoSelector = $( '#jumbotron-video-selector' );
        var $youtubeVideoFields = $( '#youtube-video-fields' );
        var display;

        if ( $videoSelector.length ) {
            display = ( 'youtube' === $videoSelector.val() ) ? 'table-row' : 'none';
            $youtubeVideoFields.css({ 'display':display });
        }
    }

    updateReservationsSystemSelect();
    updateFullscrenVideoSelect();

    if ($('#jumbotron-video-selector').length) {
        $('#jumbotron-video-selector').on('change', function() {updateFullscrenVideoSelect();})
    }

    if ($('#reservation-system-selector').length) {
        $('#reservation-system-selector').on('change', function() {updateReservationsSystemSelect();})
    }

    // Trigger reservation update with new properties
    $( document ).on( 'click', '.confirmedCheckbox', function( e ) {
        var data = {
            'action': 'the_steam_submit_reservations_change',
            'id': $( this ).attr( 'value' ),
            'checked': $( this ).is( ':checked' ),
            'security': adminData.the_steam_submit_reservations_change
        };

        $( '#tabs' ).loader({ 'title': 'Loading...', 'imgUrl': document.URL.substr( 0, document.URL.lastIndexOf( '/' ) ) + '/../wp-content/plugins/the_steam/img/loading[size].gif' });

        jQuery.post( adminData.the_steam_ajaxurl, data, function( response ) {
            $( '.reservations_box' ).html( response );
            $.loader.close( true );
        });
    });

    // Initialize jquery-ui tabs
    $( '#tabs' ).tabs();
    $( '#theme-settings-tabs' ).tabs();
    $( '#datepicker' ).datepicker();

    // Class has datepicker is added by JQueryUI, does not belong to us
    $( '#datepicker' ).removeClass( 'hasDatepicker' );
    $( '#datepicker' ).datepicker( 'setDate', '+0' );
    $( '#datepicker' ).datepicker( { 'onSelect':  requestUpdateAllReservationsTab } );

    function requestUpdateAllReservationsTab( dateText, inst ) {
        var data = {
            'action': 'the_steam_submit_reservations_date_change',
            'security': adminData.the_steam_submit_reservations_date_change,
            'date': dateText
        };

        $( '#tabs' ).loader({ 'title': 'Loading...', 'imgUrl': document.URL.substr( 0, document.URL.lastIndexOf( '/' ) ) + '/../wp-content/plugins/the_steam/img/loading[size].gif' });
        jQuery.post( adminData.the_steam_ajaxurl, data, function( response ) {
            $( '#all-reservations' ).html( response );
            $.loader.close( true );
        });
    }

    // Refresh reservations in view
    $( '#tabs' ).tabs({
        beforeActivate: function( event, ui ) {
            if ( 'tabs-2' == ui.newPanel.attr( 'id' ) ) {
                requestUpdateAllReservationsTab( $( '#datepicker' ).val() );
            };
        }
    });

    toggleCarouselEnabled();
    $( document ).on( 'change', '#carousel-enabled', toggleCarouselEnabled );

    function toggleCarouselEnabled() {
        var carouselEnabled = $( '#carouseleenabled' );
        var selection = carouselEnabled.val();

        if ( 'false' == selection ) {
            $( '#carousel-delay' ).prop( 'disabled', true );
        } else {
            $( '#carousel-delay' ).prop( 'disabled', false );
        }
    }

    if ( '' == carouselDelay.val() ) {
        carouselDelay.val( '5' );
    }

    carouselDelay.keydown(function( e ) {
        if ( ( 65 == e.keyCode && ( true === e.ctrlKey || true === e.metaKey ) ) || -1 !== $.inArray( e.keyCode, [46, 8, 9, 27, 13, 110, 190])  ||
            ( 35 <= e.keyCode && 40 >= e.keyCode ) ) {
            return;
        }
        if ( ( ( 48 > e.keyCode || 57 < e.keyCode ) || e.shiftKey  ) && ( 105 < e.keyCode || 96 > e.keyCode ) ) {
            e.preventDefault();
        }
    });

    $(function() {
        $( document ).tooltip();
    });

    toggleReceiveReservationConfirmation();

    $( document ).on( 'change', '#received-reservation-sendmail', toggleReceiveReservationConfirmation );

    function toggleReceiveReservationConfirmation() {
        var receivedReservationConfirmation = $( '#received-reservation-sendmail' );
        var selection = receivedReservationConfirmation.val();

        if ( 'no' == selection ) {
            $( '#received-reservation-title, #received-reservation-body' ).prop( 'disabled', true );
        } else {
            $( '#received-reservation-title, #received-reservation-body' ).prop( 'disabled', false );
        }
    }

    toggleAcceptedReservationConfirmation();

    $( document ).on( 'change', '#accepted-reservation-sendmail', toggleAcceptedReservationConfirmation );

    function toggleAcceptedReservationConfirmation() {
        var acceptedReservationConfirmation = $( '#accepted-reservation-sendmail' );
        var selection = acceptedReservationConfirmation.val();

        if ( 'no' == selection ) {
            $( '#accepted-reservation-title, #accepted-reservation-body' ).prop( 'disabled', true );
        } else {
            $( '#accepted-reservation-title, #accepted-reservation-body' ).prop( 'disabled', false );
        }
    }

    $( '.reset-default' ).click(function() {
        var resetBtn = adminData.the_steam_reset_btn;
        var cancelBtn = adminData.the_steam_cancel_btn;
        $( '#dialog-confirm' ).dialog({
            resizable: false,
            height:180,
            modal: true,
            buttons: [{
                text: resetBtn,
                click: function() {
                    var data = {
                        'action': 'the_steam_reset_settings'
                    };

                    jQuery.post( adminData.the_steam_ajaxurl, data, function( response ) {
                        $( '.reset-changes' ).html( response );
                    });
                    $( this ).dialog( 'close' );
                }
                }, {
                text: cancelBtn,
                click: function() {
                    $( this ).dialog( 'close' );
                }
            }]
        });
    });

    function importDialogResponse( response ) {
        var buttonText = response;
        if ( undefined === response || null === response ||
            '' === response ) {
            response = adminData.the_steam_server_error_1;
            buttonText = adminData.the_steam_server_error_btn_1;
        } else if ( 'Internal Server Error' === response ) {
            response = response + adminData.the_steam_server_error_2;
            buttonText = adminData.the_steam_server_error_btn_1;
        }

        $( '.import-demo-data' ).prop( 'value', buttonText );
        $( '.loading-gif' ).css({ 'display':'none' });
        $( '.confirm-import-ok > .ui-button-text' ).text( buttonText );

        if ( 'Done!' !== buttonText ) {
            $( '#import-response' ).html( '<p id="import-error-notice">' + adminData.the_steam_retry_msg + '</p>' );
            console.log( 'Import failed: ' + response );
        } else if ( $( '#import-error-notice' ).length ) {
            $( '#import-response' ).html( '<p>' + adminData.the_steam_import_finished_msg + '</p>' );
        }

        $( '.confirm-import-ok' ).prop( 'disabled', false );
        $( '#dialog-confirm-import' ).canExit = true;
        $( '#dialog-confirm-import' ).dialog( 'close' );
    }

    $( '.import-demo-data' ).click(function() {
        if ( adminData.the_steam_done_msg === $( '.import-demo-data' ).attr( 'value' ) || adminData.the_steam_importing_msg === $( '.import-demo-data' ).attr( 'value' ) ) {
            return;
        }

        $( '#dialog-confirm-import' ).dialog({
            canExit: true,
            resizable: false,
            height: 220,
            width: 450,
            beforeClose: function() {
             return $( this ).canExit;
             },
            modal: true,
            buttons: [{
                text: adminData.the_steam_ok_btn,
                class: 'confirm-import-ok',
                click: function() {
                    var data1 = {
                        'action': 'the_steam_create_demo_data_1'
                    };

                    $( '#dialog-confirm-import' ).canExit = false;
                    $( '.import-demo-data' ).prop( 'value', adminData.the_steam_importing_msg );
                    $( '.confirm-import-ok > .ui-button-text' ).text(  adminData.the_steam_please_wait_msg );
                    $( '.confirm-import-ok' ).prop( 'disabled', true );
                    $( '.loading-gif' ).css({ 'display':'inline-block' });

                    jQuery.post( adminData.the_steam_ajaxurl, data1, function( response ) {
                        console.log( 'import done - ok' );
                        importDialogResponse( response );
                    }).fail(function( xhr, status, error ) {
                        console.log( 'import debug' );
                        console.log( xhr );
                        console.log( status );
                        console.log( error );
                        importDialogResponse( error );
                    });
                }
            }, {
                text: adminData.the_steam_cancel_btn,
                click: function() {
                    $( this ).dialog( 'close' );
                }
            }]
        });
    });

    // *********************************
    $( '.create-demo-controls' ).click(function() {
        var data1 = {
            'action': 'the_steam_create_demo_controls'
        };
        jQuery.post( adminData.the_steam_ajaxurl, data1, function( response ) {
            console.log( 'import done - ok' );
            $( '.create-demo-controls' ).prop({ 'value': 'Done!' });
        }).fail(function( xhr, status, error ) {
            console.log( 'import debug' );
            console.log( xhr );
            console.log( status );
            console.log( error );
            $( '.create-demo-controls' ).prop({ 'value': 'Error occurred' });
        });
    });
    // *********************************

    $( '.export-demo-data' ).click(function() {
        var data = {
            'action': 'the_steam_export_demo_data'
        };
        if ( adminData.the_steam_done_msg === $( '.export-demo-data' ).attr( 'value' ) || adminData.the_steam_exporting_msg === $( '.export-demo-data' ).attr( 'value' ) ) {
            return;
        }

        $( '.export-demo-data' ).prop( 'value', adminData.the_steam_exporting_msg );

        jQuery.post( adminData.the_steam_ajaxurl, data, function( response ) {
            $(  '.export-demo-data'  ).prop( 'value', response );

        });
    });

    $( '#map-latitude' ).keydown(function( e ) {
        if ( -1 !== $.inArray( e.keyCode, [46, 8, 9, 27, 13, 110, 190]) ||
            ( 187 == e.keyCode && true == e.shiftKey )   || /* Plus key */
            ( 189 == e.keyCode ) ||
            ( 65 == e.keyCode && ( true === e.ctrlKey || true === e.metaKey ) ) ||
            ( 35 <= e.keyCode && 40 >= e.keyCode ) ) {
            return;
        }

        if ( ( e.shiftKey || ( 48 > e.keyCode || 57 < e.keyCode ) ) && ( 96 > e.keyCode || 105 < e.keyCode ) ) {
            e.preventDefault();
        }
    });

    $( '#map-longitude' ).keydown(function( e ) {
        if ( $.inArray( e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            ( 187 == e.keyCode && true == e.shiftKey ) ||
            ( 189 == e.keyCode ) ||
            ( 65 == e.keyCode && ( true === e.ctrlKey || true === e.metaKey ) ) ||
            ( 35 <= e.keyCode && 40 >= e.keyCode ) ) {
            return;
        }

        if ( ( e.shiftKey || ( 48 > e.keyCode || 57 < e.keyCode ) ) && ( 96 > e.keyCode || 105 < e.keyCode ) ) {
            e.preventDefault();
        }
    });
});
