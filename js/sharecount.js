/**
  * Sharecount
  * License: GPLv2 or later
  * Author: WDI
  * Link: www.webdotinc.com
  */

  'use strict';

// We grab the sharecount numbers by querying facebook
function requestSharecountUpdate( objid, url ) {
    var xhttp = new XMLHttpRequest();

    if ( null == url ) {
        console.warn( 'AJAX request target is NULL' );
        return;
    }

    xhttp.onreadystatechange = function() {
        var shareCount = 0;
        if ( 4 == xhttp.readyState && 200 == xhttp.status ) {
                shareCount = parseSocialReqResult( xhttp.responseText );
                document.getElementById( objid ).innerHTML = shareCount;
            }
    };
    xhttp.open( 'GET', getQueryUrl( url ), true );
    xhttp.send();
}

function getQueryUrl( pageUrl ) {
    var queryUrl = 'https://api.facebook.com/restserver.php?&method=links.getStats&urls=';
    queryUrl += pageUrl;
    queryUrl += '&format=json-strings';

    return queryUrl;
}

function parseSocialReqResult( result ) {
    var res = 0;

    if ( null == result || '[]' == result || '[ ]' == result ) {
        return 0;
    }

    res = JSON.parse( result );

    if ( null !== res[0] && undefined !== res[0] ) {
        return res[0].share_count;
    }

    return 0;
}
