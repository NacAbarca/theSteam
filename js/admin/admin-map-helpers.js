/**
 * Admin-map-helpers
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */
jQuery( document ).ready(function( $ ) {
    'use strict';
    var prevMarker = null;
    var mapLatitude = document.getElementById( 'map-latitude' );
    var mapLongitude = document.getElementById( 'map-longitude' );
    var mapZoom = document.getElementById( 'map-zoom' );
    var latVals = mapLatitude.value.split( '+' );
    var longVals = mapLongitude.value.split( '+' );
    var zoomVal = mapZoom.value;
    var cnt = latVals.length;
    var markers = [];
    var map;
    var adminMap;
    var i, mNumP = 3;

    if ( 'object' !== typeof google   || 'object' !== typeof google.maps ) {
        return;
    }

    function updateHtmlList() {
        mapLongitude.value = '';
        mapLatitude.value = '';
        for ( i = 0; i < markers.length; i++ ) {
            if ( 0 === i ) {
                mapLatitude.value += markers[i].position.lat();
                mapLongitude.value += markers[i].position.lng();
            } else {
                mapLatitude.value += '+' + markers[i].position.lat();
                mapLongitude.value += '+' + markers[i].position.lng();
            }
        }
    }

    function initMapVals() {
        if ( 'Unset' == zoomVal ) {
            zoomVal = 5;
        }

        if ( ! latVals.length ) {
            latVals[0] = 40.707139681781946;
        }

        if ( ! longVals.length ) {
            longVals[0] = -74.00296211242676;
        }

        for ( i = 0; i < latVals.length; i++ ) {
            if ( undefined !== latVals[i] && undefined != longVals[i] && 'NaN' !== latVals[i] && 'NaN' !== longVals[i] ) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng( latVals[i], longVals[i] ),
                    map: map
                });

                marker.addListener( 'click', function( e ) {
                    this.setMap( null );

                    for ( i = 0; i < markers.length; i++ ) {
                        if ( this.position.lng() === markers[i].position.lng() ) {
                            markers.splice( i, 1 );
                            cnt -= 1;
                            updateHtmlList();
                        }
                    }
                });

                markers.push( marker );
            }
        }

        updateHtmlList();
    }

    function initialize() {
        var mapProp = {
            center: new google.maps.LatLng( latVals[0], longVals[0] ),
            zoom: Number( zoomVal ),
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        adminMap = document.getElementById( 'google-map-selection' );
        map = new google.maps.Map( adminMap, mapProp );

        map.addListener( 'zoom_changed', function() {
            mapZoom.value = map.getZoom();
        });

        if ( null == adminMap ) {
            console.warn( 'Admin map cannot not be loaded from google.' );
            return;
        }

        google.maps.event.trigger( map, 'resize' );
        google.maps.event.addListener( map, 'click', function( event ) {
            placeMarker( event.latLng );
        });

        initMapVals();

        function placeMarker( location ) {
            if ( cnt > mNumP - 1 ) {
                return;
            }

            var marker = new google.maps.Marker({
                position: location,
                map: map
            });

            cnt += 1;
            markers.push( marker );

            updateHtmlList();

            marker.addListener( 'click', function( e ) {
                this.setMap( null );

                for ( i = 0; i < markers.length; i++ ) {
                    if ( this.position.lng() === markers[i].position.lng() ) {
                        markers.splice( i, 1 );
                        cnt -= 1;
                        updateHtmlList();
                    }
                }
            });
        }
    }

    google.maps.event.addDomListener( window, 'load', initialize );
    $( '#location-selector' ).selectmenu();
});

