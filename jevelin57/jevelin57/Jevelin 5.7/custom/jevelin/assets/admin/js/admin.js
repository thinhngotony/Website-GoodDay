jQuery(document).ready(function ($) {
    "use strict";

    jQuery(document).on( 'click', '.shufflehound-licence-notice.is-dismissible', function() {
        jQuery.ajax({
            url: ajaxurl,
            data: {
                action: 'shufflehound_not_activated_remember'
            }
        });
    });
});