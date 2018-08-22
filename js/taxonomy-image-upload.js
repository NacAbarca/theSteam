/**
 * Admin-map-helpers
 * License: GPLv2 or later
 * Link: www.webdotinc.com
 */
jQuery( document ).ready(function( $ ) {
    'use strict';
    $( '.taxonomy-image-upload' ).click(function( e ) {
        var customUplaoder = wp.media({
            title: taxImgUploadData.dialogTitle,
            button: {
                text: taxImgUploadData.dialogText
            },

            // True if multiple files are allowed to be selected
            multiple: false
        }).on( 'select', function() {
                var attachment = customUplaoder.state().get( 'selection' ).first().toJSON();
                $( '.taxonomy-image' ).attr( 'src', attachment.url );
                $( '.taxonomy-image-url' ).val( attachment.url );

            }).open();

        e.preventDefault();
    });
});

