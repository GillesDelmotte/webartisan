<?php 

    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');

    add_image_size('thumb_1184x500', 1184, 500, true);
    add_image_size('thumb_690x300', 690, 300, array( 'left', 'top' ));
    add_image_size('thumb_285x350', 285, 350, true);
?>