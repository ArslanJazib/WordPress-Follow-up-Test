jQuery(document).ready(function ($) {
    $('.upload_logo').click(function (e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Logo',
            multiple: false
        }).open()
            .on('select', function () {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('#theme_logo').val(image_url);
            });
    });
});