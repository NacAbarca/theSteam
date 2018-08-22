/**
 * Admin-map-helpers
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */
jQuery( document ).ready(function( $ ) {

    //Front page map object
    var feMapObject = document.getElementById( 'map' );
    var mapLatitudes = feMapObject.dataset.latitude.split( '+' );
    var mapLongitudes = feMapObject.dataset.longitude.split( '+' );
    var mapZoom = feMapObject.dataset.zoom;
    var bounce = google.maps.Animation.DROP;
    var frontpageMapStyles = [];
    var frontpageMapStyle0 = [
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#e0efef'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#1900ff'
                },
                {
                    'color': '#c0e8e8'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 100
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 700
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#7dcdcd'
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/25/blue-water */
    var frontpageMapStyle1 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#46bcec'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    var frontpageMapStyle2 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': 36
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 40
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                },
                {
                    'weight': 1.2
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 21
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 29
                },
                {
                    'weight': 0.2
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 18
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 19
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/15/subtle-grayscale */
    var frontpageMapStyle3 = [
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 65
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': '50'
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': '30'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': '40'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'hue': '#ffff00'
                },
                {
                    'lightness': -25
                },
                {
                    'saturation': -97
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'lightness': -25
                },
                {
                    'saturation': -100
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/1/pale-dawn */
    var frontpageMapStyle4 = [
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 33
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2e5d4'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#c5dac6'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#c5c6c6'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#e4d7c6'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#fbfaf7'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#acbcc9'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/2/midnight-commander */
    var frontpageMapStyle5 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 13
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#144b53'
                },
                {
                    'lightness': 14
                },
                {
                    'weight': 1.4
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#08304b'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#0c4152'
                },
                {
                    'lightness': 5
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#0b434f'
                },
                {
                    'lightness': 25
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#0b3d51'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#146474'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#021019'
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/13/neutral-blue */
    var frontpageMapStyle6 = [
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#193341'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#2c5a71'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#29768a'
                },
                {
                    'lightness': -37
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#406d80'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#406d80'
                }
            ]
        },
        {
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#3e606f'
                },
                {
                    'weight': 2
                },
                {
                    'gamma': 0.84
                }
            ]
        },
        {
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry',
            'stylers': [
                {
                    'weight': 0.6
                },
                {
                    'color': '#1a3541'
                }
            ]
        },
        {
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#2c5a71'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/72543/assassins-creed-iv */
    var frontpageMapStyle7 = [
        {
            'featureType': 'all',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': 36
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 40
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                },
                {
                    'weight': 1.2
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#4d6059'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#4d6059'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#4d6059'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 21
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#4d6059'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#4d6059'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#7f8d89'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#7f8d89'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#7f8d89'
                },
                {
                    'lightness': 17
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#7f8d89'
                },
                {
                    'lightness': 29
                },
                {
                    'weight': 0.2
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 18
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#7f8d89'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#7f8d89'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#7f8d89'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#7f8d89'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 19
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#2b3638'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#2b3638'
                },
                {
                    'lightness': 17
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#24282b'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#24282b'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/60/blue-gray */
    var frontpageMapStyle8 = [
        {
            'featureType': 'water',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#b5cbe4'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'stylers': [
                {
                    'color': '#efefef'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#83a5b0'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#bdcdd3'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#e3eed3'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 33
                }
            ]
        },
        {
            'featureType': 'road'
        },
        {
            'featureType': 'poi.park',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {},
        {
            'featureType': 'road',
            'stylers': [
                {
                    'lightness': 20
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/31/red-hues */

    var frontpageMapStyle9 = [
        {
            'stylers': [
                {
                    'hue': '#dd0d0d'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 100
                },
                {
                    'visibility': 'simplified'
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/58/simple-labels */
    var frontpageMapStyle10 = [
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/133/taste206 */

    var frontpageMapStyle11 = [
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#a0d6d1'
                },
                {
                    'lightness': 17
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#dedede'
                },
                {
                    'lightness': 17
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#dedede'
                },
                {
                    'lightness': 29
                },
                {
                    'weight': 0.2
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#dedede'
                },
                {
                    'lightness': 18
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#f1f1f1'
                },
                {
                    'lightness': 21
                }
            ]
        },
        {
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#ffffff'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': 36
                },
                {
                    'color': '#333333'
                },
                {
                    'lightness': 40
                }
            ]
        },
        {
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#f2f2f2'
                },
                {
                    'lightness': 19
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#fefefe'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#fefefe'
                },
                {
                    'lightness': 17
                },
                {
                    'weight': 1.2
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/4183/mostly-grayscale */
    var frontpageMapStyle12 = [
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 33
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels',
            'stylers': [
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'gamma': '0.75'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'lightness': '-37'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#f9f9f9'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '40'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '-37'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '100'
                },
                {
                    'weight': '2'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '80'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '0'
                }
            ]
        },
        {
            'featureType': 'poi.attraction',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': '-4'
                },
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#c5dac6'
                },
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '-95'
                },
                {
                    'lightness': '62'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'gamma': '1.00'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'gamma': '0.50'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'gamma': '0.50'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#c5c6c6'
                },
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'lightness': '-13'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'lightness': '0'
                },
                {
                    'gamma': '1.09'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#e4d7c6'
                },
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '47'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'lightness': '-12'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#fbfaf7'
                },
                {
                    'lightness': '77'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': '-5'
                },
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '-15'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': '47'
                },
                {
                    'saturation': '-100'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#acbcc9'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '53'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'lightness': '-42'
                },
                {
                    'saturation': '17'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'lightness': '61'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/111/the-propia-effect */
    var frontpageMapStyle13 = [
        {
            'featureType': 'landscape',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#2b3f57'
                },
                {
                    'weight': 0.1
                }
            ]
        },
        {
            'featureType': 'administrative',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#ff0000'
                },
                {
                    'weight': 0.4
                },
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'weight': 1.3
                },
                {
                    'color': '#FFFFFF'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#f55f77'
                },
                {
                    'weight': 3
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#f55f77'
                },
                {
                    'weight': 1.1
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#f55f77'
                },
                {
                    'weight': 0.4
                }
            ]
        },
        {},
        {
            'featureType': 'road.highway',
            'elementType': 'labels',
            'stylers': [
                {
                    'weight': 0.8
                },
                {
                    'color': '#ffffff'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'weight': 0.7
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'stylers': [
                {
                    'color': '#6c5b7b'
                }
            ]
        },
        {
            'featureType': 'water',
            'stylers': [
                {
                    'color': '#f3b191'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/14889/flat-pale */
    var frontpageMapStyle14 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#6195a0'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': '0'
                },
                {
                    'saturation': '0'
                },
                {
                    'color': '#f5f5f2'
                },
                {
                    'gamma': '1'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': '-3'
                },
                {
                    'gamma': '1.00'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#bae5ce'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#fac9a9'
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'color': '#4e4e4e'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#787878'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'hue': '#0a00ff'
                },
                {
                    'saturation': '-77'
                },
                {
                    'gamma': '0.57'
                },
                {
                    'lightness': '0'
                }
            ]
        },
        {
            'featureType': 'transit.station.rail',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#43321e'
                }
            ]
        },
        {
            'featureType': 'transit.station.rail',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'hue': '#ff6c00'
                },
                {
                    'lightness': '4'
                },
                {
                    'gamma': '0.75'
                },
                {
                    'saturation': '-68'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#eaf6f8'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#c7eced'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'lightness': '-49'
                },
                {
                    'saturation': '-53'
                },
                {
                    'gamma': '0.79'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/98/purple-rain */
    var frontpageMapStyle15 = [
        {
            'featureType': 'road',
            'stylers': [
                {
                    'hue': '#5e00ff'
                },
                {
                    'saturation': -79
                }
            ]
        },
        {
            'featureType': 'poi',
            'stylers': [
                {
                    'saturation': -78
                },
                {
                    'hue': '#6600ff'
                },
                {
                    'lightness': -47
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'stylers': [
                {
                    'lightness': 22
                }
            ]
        },
        {
            'featureType': 'landscape',
            'stylers': [
                {
                    'hue': '#6600ff'
                },
                {
                    'saturation': -11
                }
            ]
        },
        {},
        {},
        {
            'featureType': 'water',
            'stylers': [
                {
                    'saturation': -65
                },
                {
                    'hue': '#1900ff'
                },
                {
                    'lightness': 8
                }
            ]
        },
        {
            'featureType': 'road.local',
            'stylers': [
                {
                    'weight': 1.3
                },
                {
                    'lightness': 30
                }
            ]
        },
        {
            'featureType': 'transit',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'hue': '#5e00ff'
                },
                {
                    'saturation': -16
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'stylers': [
                {
                    'saturation': -72
                }
            ]
        },
        {}
    ];

    /* Source: https://snazzymaps.com/style/65/just-places */

    var frontpageMapStyle16 = [
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#fffffa'
                }
            ]
        },
        {
            'featureType': 'water',
            'stylers': [
                {
                    'lightness': 50
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 40
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/41/hints-of-gold */

    var frontpageMapStyle17 = [
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#252525'
                },
                {
                    'saturation': -100
                },
                {
                    'lightness': -81
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#666666'
                },
                {
                    'saturation': -100
                },
                {
                    'lightness': -55
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'hue': '#555555'
                },
                {
                    'saturation': -100
                },
                {
                    'lightness': -57
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#777777'
                },
                {
                    'saturation': -100
                },
                {
                    'lightness': -6
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#cc9900'
                },
                {
                    'saturation': 100
                },
                {
                    'lightness': -22
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#444444'
                },
                {
                    'saturation': 0
                },
                {
                    'lightness': -64
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'hue': '#555555'
                },
                {
                    'saturation': -100
                },
                {
                    'lightness': -57
                },
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/8/turquoise-water */

    var frontpageMapStyle18 = [
        {
            'stylers': [
                {
                    'hue': '#16a085'
                },
                {
                    'saturation': 0
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 100
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/64/old-dry-mud */
    var frontpageMapStyle19 = [
        {
            'featureType': 'landscape',
            'stylers': [
                {
                    'hue': '#FFAD00'
                },
                {
                    'saturation': 50.2
                },
                {
                    'lightness': -34.8
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'stylers': [
                {
                    'hue': '#FFAD00'
                },
                {
                    'saturation': -19.8
                },
                {
                    'lightness': -1.8
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'stylers': [
                {
                    'hue': '#FFAD00'
                },
                {
                    'saturation': 72.4
                },
                {
                    'lightness': -32.6
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'road.local',
            'stylers': [
                {
                    'hue': '#FFAD00'
                },
                {
                    'saturation': 74.4
                },
                {
                    'lightness': -18
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'water',
            'stylers': [
                {
                    'hue': '#00FFA6'
                },
                {
                    'saturation': -63.2
                },
                {
                    'lightness': 38
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'poi',
            'stylers': [
                {
                    'hue': '#FFC300'
                },
                {
                    'saturation': 54.2
                },
                {
                    'lightness': -14.4
                },
                {
                    'gamma': 1
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/8076/two-tone */

    var frontpageMapStyle20 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#c9323b'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#c9323b'
                },
                {
                    'weight': 1.2
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': '-1'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'lightness': '0'
                },
                {
                    'saturation': '0'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '0.01'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '0.01'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#c9323b'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#99282f'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#99282f'
                }
            ]
        },
        {
            'featureType': 'road.highway.controlled_access',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#99282f'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#99282f'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#99282f'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#99282f'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#090228'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/1556/light-and-dark */
    var frontpageMapStyle21 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#052366'
                },
                {
                    'saturation': '-70'
                },
                {
                    'lightness': '85'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'lightness': '-53'
                },
                {
                    'weight': '1.00'
                },
                {
                    'gamma': '0.98'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '-18'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#57677a'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/107/blue-ish */
    var frontpageMapStyle22 = [
        {
            'stylers': [
                {
                    'saturation': -45
                },
                {
                    'lightness': 13
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#8fa7b3'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#667780'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#333333'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#8fa7b3'
                },
                {
                    'gamma': 2
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#a3becc'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#7a8f99'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#555555'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#a3becc'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#7a8f99'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#555555'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#bbd9e9'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#525f66'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#bbd9e9'
                },
                {
                    'gamma': 2
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#a3aeb5'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/8143/camilo-florez-estilo-de-mapa-modificado */
    var frontpageMapStyle23 = [
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#ff0300'
                },
                {
                    'saturation': -100
                },
                {
                    'lightness': 129.33333333333334
                },
                {
                    'gamma': 1
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#abff00'
                },
                {
                    'saturation': 61.80000000000001
                },
                {
                    'lightness': 13.800000000000011
                },
                {
                    'gamma': 1
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#1fa661'
                },
                {
                    'weight': '0.55'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway.controlled_access',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.highway.controlled_access',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#00b7ff'
                },
                {
                    'saturation': -31.19999999999996
                },
                {
                    'lightness': 2.1803921568627374
                },
                {
                    'gamma': 1
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#00B5FF'
                },
                {
                    'saturation': -33.33333333333343
                },
                {
                    'lightness': 27.294117647058826
                },
                {
                    'gamma': 1
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit.station.bus',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#00B7FF'
                },
                {
                    'saturation': 8.400000000000006
                },
                {
                    'lightness': 36.400000000000006
                },
                {
                    'gamma': 1
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/7853/zombie-survival-map */
    var frontpageMapStyle24 = [
        {
            'featureType': 'all',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'saturation': '-100'
                },
                {
                    'invert_lightness': true
                },
                {
                    'lightness': '11'
                },
                {
                    'gamma': '1.27'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#ff0000'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'invert_lightness': true
                },
                {
                    'lightness': '-10'
                },
                {
                    'gamma': '0.54'
                },
                {
                    'saturation': '45'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'hue': '#ff0000'
                },
                {
                    'saturation': '75'
                },
                {
                    'lightness': '24'
                },
                {
                    'gamma': '0.70'
                },
                {
                    'invert_lightness': true
                }
            ]
        },
        {
            'featureType': 'poi.government',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#ff0000'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'invert_lightness': true
                },
                {
                    'lightness': '-24'
                },
                {
                    'gamma': '0.59'
                },
                {
                    'saturation': '59'
                }
            ]
        },
        {
            'featureType': 'poi.medical',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'invert_lightness': true
                },
                {
                    'hue': '#ff0000'
                },
                {
                    'saturation': '73'
                },
                {
                    'lightness': '-24'
                },
                {
                    'gamma': '0.59'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': '-41'
                }
            ]
        },
        {
            'featureType': 'poi.school',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'hue': '#ff0000'
                },
                {
                    'invert_lightness': true
                },
                {
                    'saturation': '43'
                },
                {
                    'lightness': '-16'
                },
                {
                    'gamma': '0.73'
                }
            ]
        },
        {
            'featureType': 'poi.sports_complex',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#ff0000'
                },
                {
                    'saturation': '43'
                },
                {
                    'lightness': '-11'
                },
                {
                    'gamma': '0.73'
                },
                {
                    'invert_lightness': true
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '45'
                },
                {
                    'lightness': '53'
                },
                {
                    'gamma': '0.67'
                },
                {
                    'invert_lightness': true
                },
                {
                    'hue': '#ff0000'
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'hue': '#ff0000'
                },
                {
                    'saturation': '38'
                },
                {
                    'lightness': '-16'
                },
                {
                    'gamma': '0.86'
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/8375/nc10 */
    var frontpageMapStyle25 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels',
            'stylers': [
                {
                    'hue': '#ffe500'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.landcover',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi.attraction',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi.place_of_worship',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi.school',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.station',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#9bdffb'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/69/holiday */
    var frontpageMapStyle26 = [
        {
            'featureType': 'landscape',
            'stylers': [
                {
                    'hue': '#FFB000'
                },
                {
                    'saturation': 71.66666666666669
                },
                {
                    'lightness': -28.400000000000006
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'stylers': [
                {
                    'hue': '#E8FF00'
                },
                {
                    'saturation': -76.6
                },
                {
                    'lightness': 113
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'stylers': [
                {
                    'hue': '#FF8300'
                },
                {
                    'saturation': -77
                },
                {
                    'lightness': 27.400000000000006
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'road.local',
            'stylers': [
                {
                    'hue': '#FF8C00'
                },
                {
                    'saturation': -66.6
                },
                {
                    'lightness': 34.400000000000006
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'water',
            'stylers': [
                {
                    'hue': '#00C4FF'
                },
                {
                    'saturation': 22.799999999999997
                },
                {
                    'lightness': -11.399999999999991
                },
                {
                    'gamma': 1
                }
            ]
        },
        {
            'featureType': 'poi',
            'stylers': [
                {
                    'hue': '#9FFF00'
                },
                {
                    'saturation': 0
                },
                {
                    'lightness': -23.200000000000003
                },
                {
                    'gamma': 1
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/25089/dark-electric */
    var frontpageMapStyle27 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': 36
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 40
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                },
                {
                    'weight': 1.2
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'lightness': '17'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 21
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#ff4700'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': 17
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 29
                },
                {
                    'weight': 0.2
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels',
            'stylers': [
                {
                    'invert_lightness': true
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway.controlled_access',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#3b3b3b'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 18
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#ff4700'
                },
                {
                    'lightness': '39'
                },
                {
                    'gamma': '0.43'
                },
                {
                    'saturation': '-47'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#555555'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 19
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                }
            ]
        }
    ];

    /* https://snazzymaps.com/style/6336/girly */

    var frontpageMapStyle28 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#ff6a6a'
                },
                {
                    'lightness': '0'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#ff6a6a'
                },
                {
                    'lightness': '75'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': '75'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit.station.bus',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit.station.rail',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit.station.rail',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'weight': '0.01'
                },
                {
                    'hue': '#ff0028'
                },
                {
                    'lightness': '0'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#80e4d8'
                },
                {
                    'lightness': '25'
                },
                {
                    'saturation': '-23'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/4100/mtl */
    var frontpageMapStyle29 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#3e606f'
                },
                {
                    'weight': 2
                },
                {
                    'gamma': 0.84
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry',
            'stylers': [
                {
                    'weight': 0.6
                },
                {
                    'color': '#1a3541'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#2c5a71'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#406d80'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#2c5a71'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#29768a'
                },
                {
                    'lightness': -37
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#406d80'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#193341'
                }
            ]
        }
    ];


    /* https://snazzymaps.com/style/6586/romania */
    var frontpageMapStyle30 = [
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/24358/blue */
    var frontpageMapStyle31 = [
        {
            'featureType': 'all',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#008eff'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '0'
                },
                {
                    'lightness': '0'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'saturation': '-60'
                },
                {
                    'lightness': '-20'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/2712/architectural */
    var frontpageMapStyle32 = [
        {
            'featureType': 'all',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry',
            'stylers': [
                {
                    'weight': '0.5'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'lightness': '-50'
                },
                {
                    'saturation': '-50'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'hue': '#009aff'
                },
                {
                    'saturation': '25'
                },
                {
                    'lightness': '0'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'gamma': '1'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '0'
                },
                {
                    'lightness': '100'
                },
                {
                    'gamma': '2.31'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'lightness': '20'
                },
                {
                    'gamma': '1'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '-100'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': '0'
                },
                {
                    'saturation': '45'
                },
                {
                    'gamma': '4.24'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'hue': '#00ff90'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '-100'
                },
                {
                    'color': '#f5f5f5'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#666666'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'saturation': '-25'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': '50'
                },
                {
                    'gamma': '.75'
                },
                {
                    'saturation': '100'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/1861/two-tone-with-labels */
    var frontpageMapStyle33 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'saturation': '18'
                },
                {
                    'lightness': '-55'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#4484a1'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                },
                {
                    'saturation': '28'
                },
                {
                    'lightness': '42'
                },
                {
                    'gamma': '2.01'
                },
                {
                    'weight': '1'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#aaced9'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/49/subtle-green */
    var frontpageMapStyle34 = [
        {
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': -100
                }
            ]
        },
        {
            'featureType': 'water',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': 100
                },
                {
                    'hue': '#00ffe6'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': 100
                },
                {
                    'hue': '#00ffcc'
                }
            ]
        },
        {
            'featureType': 'poi',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/25246/apple-maps-esque */
    var frontpageMapStyle35 = [
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#faf5ed'
                },
                {
                    'lightness': '0'
                },
                {
                    'gamma': '1'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#bae5a6'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'weight': '1.00'
                },
                {
                    'gamma': '1.8'
                },
                {
                    'saturation': '0'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'hue': '#ffb200'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': '0'
                },
                {
                    'gamma': '1'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#b000ff'
                },
                {
                    'saturation': '23'
                },
                {
                    'lightness': '-4'
                },
                {
                    'gamma': '0.80'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#a0daf2'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/6736/outspoken */
    var frontpageMapStyle36 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#675a4b'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#ffebc5'
                },
                {
                    'lightness': '-10'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#675a4b'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#b70046'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#675a4b'
                },
                {
                    'weight': '0.50'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#675a4b'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ff850a'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'saturation': '-71'
                },
                {
                    'lightness': '-2'
                },
                {
                    'color': '#ffebc5'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#70bfaf'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#675a4c'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#675a4b'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#675a4b'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#7ccff0'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#cfeae4'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#109579'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/7981/coy-beauty */
    var frontpageMapStyle37 = [
        {
            'featureType': 'all',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#a31645'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'weight': '3.79'
                },
                {
                    'visibility': 'on'
                },
                {
                    'color': '#ffecf0'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#a31645'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '0'
                },
                {
                    'lightness': '0'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#d89ca8'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '0'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'labels',
            'stylers': [
                {
                    'color': '#a31645'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'lightness': '84'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#d89ca8'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#fedce3'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/12903/antiqued-gold*/
    var frontpageMapStyle38 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'hue': '#ffd100'
                },
                {
                    'saturation': '44'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'saturation': '-1'
                },
                {
                    'hue': '#ff0000'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': '-16'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'hue': '#ffd100'
                },
                {
                    'saturation': '44'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '-30'
                },
                {
                    'lightness': '12'
                },
                {
                    'hue': '#ff8e00'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'saturation': '-26'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#c0b78d'
                },
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '4'
                },
                {
                    'lightness': '40'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'hue': '#ffe300'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'hue': '#ffe300'
                },
                {
                    'saturation': '-3'
                },
                {
                    'lightness': '-10'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'hue': '#ff0000'
                },
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '-5'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/1862/clean-with-labels */
    var frontpageMapStyle39 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#e85113'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'weight': 6
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#0095d9'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '4'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '3'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'weight': '1'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '3'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '2'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '3'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': 20
                },
                {
                    'color': '#efe9e4'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#f0e4d3'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'hue': '#11ff00'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'lightness': 100
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'hue': '#4cff00'
                },
                {
                    'saturation': 58
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'lightness': -100
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'lightness': 100
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#efe9e4'
                },
                {
                    'lightness': -25
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#efe9e4'
                },
                {
                    'lightness': -40
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#efe9e4'
                },
                {
                    'lightness': -10
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#efe9e4'
                },
                {
                    'lightness': -20
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#19a0d8'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'lightness': -100
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'lightness': 100
                },
                {
                    'weight': '3'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/6490/drake-dental-map */
    var frontpageMapStyle40 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#425a68'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/4105/brokka-map */
    var frontpageMapStyle41 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#736c68'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#e7e6e5'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#d4e4d3'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#f5f5f5'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#d4e4d3'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#f5f5f5'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#e7e6e5'
                },
                {
                    'gamma': '0.65'
                },
                {
                    'lightness': '0'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#aad5df'
                }
            ]
        }
    ];

    /* https://snazzymaps.com/style/7839/subtle-pink */
    var frontpageMapStyle42 = [
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'lightness': -5
                },
                {
                    'color': '#b0b0b0'
                },
                {
                    'weight': 1.7
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#FFB3B3'
                },
                {
                    'lightness': 26
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#FFB3B3'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#FFB3B3'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#FFB3B3'
                },
                {
                    'lightness': 66
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/32083/dark-yellow */
    var frontpageMapStyle43 = [
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': 36
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 40
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                },
                {
                    'weight': 1.2
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#e3b141'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#e0a64b'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#0e0d0a'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#d1b995'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 21
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#12120f'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'lightness': '-77'
                },
                {
                    'gamma': '4.48'
                },
                {
                    'saturation': '24'
                },
                {
                    'weight': '0.65'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'lightness': 29
                },
                {
                    'weight': 0.2
                }
            ]
        },
        {
            'featureType': 'road.highway.controlled_access',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#f6b044'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#4f4e49'
                },
                {
                    'weight': '0.36'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#c4ac87'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#262307'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#a4875a'
                },
                {
                    'lightness': 16
                },
                {
                    'weight': '0.16'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#deb483'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 19
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#0f252e'
                },
                {
                    'lightness': 17
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#080808'
                },
                {
                    'gamma': '3.14'
                },
                {
                    'weight': '1.07'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/145/o */
    var frontpageMapStyle44 = [
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#808080'
                },
                {
                    'lightness': -100
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#b72025'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#b72025'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': -14
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#b72025'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': -100
                },
                {
                    'weight': 0.2
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#808080'
                },
                {
                    'lightness': 33
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#808080'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.sports_complex',
            'elementType': 'geometry',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': -100
                }
            ]
        },
        {
            'featureType': 'poi',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': -9
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': -100
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'color': '#b72025'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': -100
                },
                {
                    'weight': 0.3
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': -100
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'saturation': -100
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {},
        {
            'featureType': 'road.local',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': -100
                },
                {
                    'lightness': 13
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'invert_lightness': true
                },
                {
                    'lightness': -4
                },
                {
                    'saturation': -90
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': 0.1
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#b72025'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/15/subtle-grayscale */
    var frontpageMapStyle45 = [
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#ebeae3'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#bfd74a'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.government',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.medical',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#fbd3da'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#a3cd39'
                }
            ]
        },
        {
            'featureType': 'poi.school',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#fdea9b'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#ffd200'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': 'black'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#fbad17'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#68bad2'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/15/subtle-grayscale */
    var frontpageMapStyle46 = [
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#e0efef'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#1900ff'
                },
                {
                    'color': '#8EF1DD'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.fill'
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 100
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'stylers': [
                {
                    'color': '#73D4C0'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 700
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/129/mr-blue */
    var frontpageMapStyle47 = [
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#011066'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#5580aa'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#405783'
                }
            ]
        },
        {
            'elementType': 'labels.text',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'weight': 0.5
                }
            ]
        },
        {
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#27abda'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#272664'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/1370/best-ski-pros */
    var frontpageMapStyle48 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#2c3645'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#dcdcdc'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#476653'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.landcover',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#93d09e'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#0d6f32'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#62bf85'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#95c4a7'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'color': '#334767'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#334767'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#b7b7b7'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#364a6a'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit.station.rail',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#535353'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#3fc672'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#4d6489'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/6407/moret */
    var frontpageMapStyle49 = [
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'color': '#737373'
                },
                {
                    'weight': '0.01'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '97'
                },
                {
                    'color': '#ffffff'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'lightness': '81'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.landcover',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '100'
                },
                {
                    'lightness': '100'
                },
                {
                    'gamma': '10.00'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '100'
                },
                {
                    'lightness': '100'
                },
                {
                    'gamma': '10.00'
                },
                {
                    'weight': '0.01'
                }
            ]
        },
        {
            'featureType': 'poi.attraction',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'poi.business',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'poi.government',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'poi.medical',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '100'
                },
                {
                    'lightness': '100'
                },
                {
                    'gamma': '10.00'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'poi.place_of_worship',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'poi.school',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'poi.sports_complex',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#565656'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '-70'
                },
                {
                    'lightness': '43'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#39d2ca'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/15759/e-on */
    var frontpageMapStyle50 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#767676'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#767676'
                },
                {
                    'lightness': '-23'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#acd5cb'
                },
                {
                    'visibility': 'on'
                },
                {
                    'lightness': '49'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#acd5cb'
                },
                {
                    'lightness': '49'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/1309/kingston */
    var frontpageMapStyle51 = [
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#e0efef'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#1900ff'
                },
                {
                    'color': '#c0e8e8'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 100
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 700
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.station',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.station',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#7dcdcd'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/3864/nrw-ohne-stra%C3%9Fen */
    var frontpageMapStyle52 = [
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#7f2200'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#87ae79'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#495421'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'visibility': 'on'
                },
                {
                    'weight': 4.1
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '30'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#4e4e4e'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '30'
                },
                {
                    'color': '#4e4e4e'
                },
                {
                    'weight': '1.50'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#2b2b2b'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'weight': '2.50'
                },
                {
                    'visibility': 'on'
                },
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#a4cd89'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#769E72'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#7B8758'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#EBF4A4'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#8dab68'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#5B5B3F'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ABCE83'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#EBF4A4'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#9BBF72'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#A4C67D'
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#c5eaff'
                },
                {
                    'visibility': 'on'
                },
                {
                    'weight': '1.00'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#ff0000'
                }
            ]
        }
    ];


    /* Source: https://snazzymaps.com/style/7956/wlsh */
    var frontpageMapStyle53 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#e7d5ba'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#615439'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#e7d5ba'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#e7d5ba'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#eee4d4'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#eee4d4'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#eee4d4'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'saturation': '0'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#eee4d4'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#fcefd2'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#fcefd2'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#fcefd2'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'hue': '#ffb000'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#fcefd2'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#7dacbc'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/12999/%C4%B0nturlam-style */
    var frontpageMapStyle54 = [
        {
            'featureType': 'all',
            'elementType': 'all',
            'stylers': [
                {
                    'invert_lightness': true
                },
                {
                    'saturation': 20
                },
                {
                    'lightness': 50
                },
                {
                    'gamma': 0.4
                },
                {
                    'hue': '#00ffee'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#405769'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#232f3a'
                }
            ]
        }
    ];
    /* Source: https://snazzymaps.com/style/12826/turquoise-green-mss */
    var frontpageMapStyle55 = [
        {
            'featureType': 'all',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '9'
                },
                {
                    'weight': '0.75'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#00ff35'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#728790'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#531c1c'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#9b3232'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#f4eeee'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#aeabab'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f3f4f4'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'lightness': '2'
                },
                {
                    'gamma': '1.78'
                },
                {
                    'weight': '1.43'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#8d3e3e'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#656e6e'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'hue': '#ff0000'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#f8d7d7'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#f5fbf6'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.landcover',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#b25e5e'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.landcover',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'color': '#ff0000'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#bcb7b1'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#b1cdb0'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.station.airport',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#6ccce5'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/139/shades-of-conservation */
    var frontpageMapStyle56 = [
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#008285'
                },
                {
                    'saturation': 100
                },
                {
                    'lightness': -66
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#CAFCE4'
                },
                {
                    'saturation': 85
                },
                {
                    'lightness': 0
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#61C273'
                },
                {
                    'saturation': 2
                },
                {
                    'lightness': -27
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'hue': '#B0C4C7'
                },
                {
                    'saturation': -83
                },
                {
                    'lightness': 26
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/3951/shadow-agent */
    var frontpageMapStyle57 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '-23'
                },
                {
                    'lightness': '27'
                },
                {
                    'visibility': 'on'
                },
                {
                    'gamma': '1'
                },
                {
                    'hue': '#ff1800'
                },
                {
                    'weight': '0.75'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#e74c3c'
                },
                {
                    'saturation': '-59'
                },
                {
                    'lightness': '30'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#ff1800'
                },
                {
                    'saturation': '2'
                },
                {
                    'lightness': '2'
                },
                {
                    'weight': '0.75'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '-51'
                },
                {
                    'color': '#cbcbcb'
                }
            ]
        },
        {
            'featureType': 'transit.station',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#2c3e50'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/8248/natural-colors */
    var frontpageMapStyle58 = [
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '-46'
                },
                {
                    'lightness': '-37'
                },
                {
                    'gamma': '6.00'
                },
                {
                    'weight': '6.76'
                },
                {
                    'color': '#d53535'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#090808'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'weight': '0.01'
                },
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#6fab61'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#aaa7a2'
                },
                {
                    'weight': '0.01'
                },
                {
                    'saturation': '17'
                },
                {
                    'lightness': '-20'
                },
                {
                    'gamma': '1.45'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'lightness': 100
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'hue': '#00ffdc'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'lightness': 700
                },
                {
                    'hue': '#ff0000'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#7ebeb8'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'weight': '1.43'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/4209/ohana72-red-turquise */
    var frontpageMapStyle59 = [
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'landscape.natural',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': '42'
                },
                {
                    'lightness': '-43'
                },
                {
                    'visibility': 'simplified'
                },
                {
                    'gamma': '7.59'
                },
                {
                    'weight': '0.75'
                },
                {
                    'color': '#9b2743'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#009ca6'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#9b2743'
                },
                {
                    'saturation': '-59'
                },
                {
                    'lightness': '30'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#ff1800'
                },
                {
                    'saturation': '2'
                },
                {
                    'lightness': '2'
                },
                {
                    'weight': '0.75'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'saturation': '-51'
                },
                {
                    'color': '#cbcbcb'
                }
            ]
        },
        {
            'featureType': 'transit.station',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#2c3e50'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#009ca6'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#041e42'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'color': '#475777'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'weight': '1.00'
                },
                {
                    'color': '#475777'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/2705/brown-and-blue */
    var frontpageMapStyle60 = [
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#4a403b'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#554943'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                },
                {
                    'visibility': 'off'
                },
                {
                    'weight': 4.1
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#4a403b'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#5c514a'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#6da248'
                },
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#5c514a'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#6c6561'
                },
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#3db5e6'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#3db5e6'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#359ec8'
                },
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'gamma': '1.45'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#3babd9'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'off'
                },
                {
                    'lightness': '-7'
                },
                {
                    'hue': '#ff0000'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'hue': '#00b5ff'
                },
                {
                    'saturation': '-47'
                },
                {
                    'lightness': '-37'
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#16303f'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#6795b0'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/6830/calver */
    var frontpageMapStyle61 = [
        {
            'featureType': 'all',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#f2f2f2'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'saturation': -100
                },
                {
                    'lightness': 45
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#7c9b8b'
                },
                {
                    'visibility': 'on'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/6824/266pro */
    var frontpageMapStyle62 = [
        {
            'featureType': 'administrative',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#adadad'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#000000'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#000000'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#000000'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#888888'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#10c2d3'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#00a8b8'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.landcover',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#ff0000'
                }
            ]
        },
        {
            'featureType': 'landscape.natural.terrain',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#007984'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#027781'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#ff0000'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#006977'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'color': '#ababab'
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [
                {
                    'color': '#ffffff'
                }
            ]
        }
    ];

    /* Source: https://snazzymaps.com/style/24493/nightly-red */
    var frontpageMapStyle63 = [
        {
            'featureType': 'all',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'all',
            'elementType': 'labels.text',
            'stylers': [
                {
                    'color': '#969696'
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 17
                },
                {
                    'weight': 1.2
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative.country',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'administrative.province',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.locality',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'saturation': '-100'
                },
                {
                    'lightness': '30'
                }
            ]
        },
        {
            'featureType': 'administrative.neighborhood',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'administrative.land_parcel',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'gamma': '0.00'
                },
                {
                    'lightness': '74'
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'landscape.man_made',
            'elementType': 'all',
            'stylers': [
                {
                    'lightness': '3'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#000000'
                },
                {
                    'lightness': 21
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'simplified'
                },
                {
                    'color': '#ff0000'
                },
                {
                    'saturation': '-65'
                }
            ]
        },
        {
            'featureType': 'road',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'simplified'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        },
        {
            'featureType': 'transit.line',
            'elementType': 'geometry',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#ff0000'
                },
                {
                    'saturation': '-75'
                }
            ]
        },
        {
            'featureType': 'transit.station',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#525252'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#444444'
                }
            ]
        },
        {
            'featureType': 'water',
            'elementType': 'labels',
            'stylers': [
                {
                    'visibility': 'off'
                }
            ]
        }
    ];

    frontpageMapStyles.push( frontpageMapStyle0 );
    frontpageMapStyles.push( frontpageMapStyle1 );
    frontpageMapStyles.push( frontpageMapStyle2 );
    frontpageMapStyles.push( frontpageMapStyle3 );
    frontpageMapStyles.push( frontpageMapStyle4 );
    frontpageMapStyles.push( frontpageMapStyle5 );
    frontpageMapStyles.push( frontpageMapStyle6 );
    frontpageMapStyles.push( frontpageMapStyle7 );
    frontpageMapStyles.push( frontpageMapStyle8 );
    frontpageMapStyles.push( frontpageMapStyle9 );
    frontpageMapStyles.push( frontpageMapStyle10 );
    frontpageMapStyles.push( frontpageMapStyle11 );
    frontpageMapStyles.push( frontpageMapStyle12 );
    frontpageMapStyles.push( frontpageMapStyle13 );
    frontpageMapStyles.push( frontpageMapStyle14 );
    frontpageMapStyles.push( frontpageMapStyle15 );
    frontpageMapStyles.push( frontpageMapStyle16 );
    frontpageMapStyles.push( frontpageMapStyle17 );
    frontpageMapStyles.push( frontpageMapStyle18 );
    frontpageMapStyles.push( frontpageMapStyle19 );
    frontpageMapStyles.push( frontpageMapStyle20 );
    frontpageMapStyles.push( frontpageMapStyle21 );
    frontpageMapStyles.push( frontpageMapStyle22 );
    frontpageMapStyles.push( frontpageMapStyle23 );
    frontpageMapStyles.push( frontpageMapStyle24 );
    frontpageMapStyles.push( frontpageMapStyle25 );
    frontpageMapStyles.push( frontpageMapStyle26 );
    frontpageMapStyles.push( frontpageMapStyle27 );
    frontpageMapStyles.push( frontpageMapStyle28 );
    frontpageMapStyles.push( frontpageMapStyle29 );
    frontpageMapStyles.push( frontpageMapStyle30 );
    frontpageMapStyles.push( frontpageMapStyle31 );
    frontpageMapStyles.push( frontpageMapStyle32 );
    frontpageMapStyles.push( frontpageMapStyle33 );
    frontpageMapStyles.push( frontpageMapStyle34 );
    frontpageMapStyles.push( frontpageMapStyle35 );
    frontpageMapStyles.push( frontpageMapStyle36 );
    frontpageMapStyles.push( frontpageMapStyle37 );
    frontpageMapStyles.push( frontpageMapStyle38 );
    frontpageMapStyles.push( frontpageMapStyle39 );
    frontpageMapStyles.push( frontpageMapStyle40 );
    frontpageMapStyles.push( frontpageMapStyle41 );
    frontpageMapStyles.push( frontpageMapStyle42 );
    frontpageMapStyles.push( frontpageMapStyle43 );
    frontpageMapStyles.push( frontpageMapStyle44 );
    frontpageMapStyles.push( frontpageMapStyle45 );
    frontpageMapStyles.push( frontpageMapStyle46 );
    frontpageMapStyles.push( frontpageMapStyle47 );
    frontpageMapStyles.push( frontpageMapStyle48 );
    frontpageMapStyles.push( frontpageMapStyle49 );
    frontpageMapStyles.push( frontpageMapStyle50 );
    frontpageMapStyles.push( frontpageMapStyle51 );
    frontpageMapStyles.push( frontpageMapStyle52 );
    frontpageMapStyles.push( frontpageMapStyle53 );
    frontpageMapStyles.push( frontpageMapStyle54 );
    frontpageMapStyles.push( frontpageMapStyle55 );
    frontpageMapStyles.push( frontpageMapStyle56 );
    frontpageMapStyles.push( frontpageMapStyle57 );
    frontpageMapStyles.push( frontpageMapStyle58 );
    frontpageMapStyles.push( frontpageMapStyle59 );
    frontpageMapStyles.push( frontpageMapStyle60 );
    frontpageMapStyles.push( frontpageMapStyle61 );
    frontpageMapStyles.push( frontpageMapStyle62 );
    frontpageMapStyles.push( frontpageMapStyle63 );

    if ( 'yes' === window.markerBounce ) {
        bounce = google.maps.Animation.BOUNCE;
    }

    if ( 'object' !== typeof google   || 'object' !== typeof google.maps ) {
        return;
    }

    google.maps.event.addDomListener( window, 'load', function() {
window.frontpage_map_init();
} );

    // Default values for Demo - New York
    if ( ! mapLatitudes.length ) {
        mapLatitudes[0] = 40.707139681781946;
    }

    if ( ! mapLongitudes.length ) {
        mapLongitudes[0] = -74.00296211242676;
    }

    if ( 'Unset' == mapZoom ) {
        mapZoom = 5;
    }

    window.map_style_index = null;
    window.frontpage_map_init = function() {

        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions

        if ( null === window.map_style_index ) {
            window.map_style_index = map_data.index;
        }

        var mapOptions = {
            zoom: Number( mapZoom ),
            disableDefaultUI: true,
            center: new google.maps.LatLng( mapLatitudes[0], mapLongitudes[0] ),
            styles: frontpageMapStyles[window.map_style_index]
        };

        var mapElement = document.getElementById( 'map' );
        var googleMapObject = new google.maps.Map( mapElement, mapOptions );
        var marker = [];

        for ( i = 0; i < mapLongitudes.length; i++ ) {
            marker[i] = new google.maps.Marker({
                position: new google.maps.LatLng( mapLatitudes[i], mapLongitudes[i] ),
                map: googleMapObject,
                animation: bounce
            });
        }
    };

    // Prevent unwanted panning for the map
    $( '.map-overlay' ).on( 'click', function() {
        $( '.map-overlay' ).animate({
            opacity: 0.1
        }, 250, function() {
            $( '.map-overlay' ).css({ 'display':'none' });
        });
    });

    // Map refresh button
    $( '.refresh-button' ).on( 'click', function() {
        window.frontpage_map_init();
    });
});
