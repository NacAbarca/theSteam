/**
 * Blog-list
 * License: GPLv2 or later
 * Author: WDI
 * Link: www.webdotinc.com
 */
jQuery( document ).ready(function( $ ) {
    'use strict';

    // Ensure sidebar appearance is correct.
    if ( ! $( '.sidebar' ).length ) {
        $( '#main-blog-list-column' ).css({ 'margin-left':'auto', 'margin-right':'auto', 'float':'none' });
    }

});
