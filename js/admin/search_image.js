jQuery(document).ready(function($){

    'use strict';

    // Instantiates the variable that holds the media library frame.
    var metaImageFrame;

    // Runs when the media button is clicked.
    $( 'body' ).click(function(e) {

        // Get the btn
        var btn = e.target;

        // Check if it's the upload button
        if ( !btn || !$( btn ).attr( 'data-media-uploader-target' ) ) return;

        // Get the field target
        var field = $( btn ).data( 'media-uploader-target' );


        // Prevents the default action from occuring.
        e.preventDefault();

        // Sets up the media library frame
        metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
            title: meta_image.title,
            button: { text:  'Use this file' },
        });

        // Runs when an image is selected.
        metaImageFrame.on('select', function() {

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = metaImageFrame.state().get('selection').first().toJSON();
            var image = '<img src="'+media_attachment.url+'" alt="search thumbnail" id="search_image_thumb" style="width: 250px; height: auto;" />';

            // Sends the attachment URL to our custom image input field.

            if($('#search_image_thumb').length > 0){
                $('#search_image_thumb').remove();
            }
            $( field ).val(media_attachment.id);
            $(image).insertAfter($( field ));


        });

        // Opens the media library frame.
        metaImageFrame.open();

    });

});