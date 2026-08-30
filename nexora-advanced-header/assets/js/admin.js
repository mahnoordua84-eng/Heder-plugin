/* Nexora Advanced Header - Admin JavaScript */
(function($) {
    'use strict';

    $(function() {
        // Color picker
        $('.nexora-color-picker').wpColorPicker();

        // Media uploader
        $('.nexora-media-btn').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetId = button.attr('data-target');
            var previewId = button.attr('data-preview');
            var frame = wp.media({
                title: 'Select Image',
                button: { text: 'Use This Image' },
                multiple: false
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#' + targetId).val(attachment.id);
                var preview = $('#' + previewId);
                preview.html('<img src="' + attachment.url + '" style="max-width:100%;max-height:100%;" />');
            });

            frame.open();
        });

        // Remove media
        $('.nexora-media-remove').on('click', function(e) {
            e.preventDefault();
            var targetId = $(this).attr('data-target');
            var previewId = $(this).attr('data-preview');
            $('#' + targetId).val('0');
            $('#' + previewId).empty();
        });
    });
})(jQuery);
