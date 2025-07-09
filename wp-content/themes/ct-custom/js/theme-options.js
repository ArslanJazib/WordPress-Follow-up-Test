jQuery(document).ready(function ($) {
    $('.upload_logo').on('click', function (e) {
        e.preventDefault();
        let input = $('#theme_logo');
        let mediaUploader = wp.media({
            title: 'Select Logo',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            let attachment = mediaUploader.state().get('selection').first().toJSON();
            input.val(attachment.url);
        });

        mediaUploader.open();
    });

    // Add repeater row
    $('#add-social').on('click', function () {
        let index = $('#social-links-wrapper .social-link-group').length;
        $('#social-links-wrapper').append(`
            <div class="social-link-group">
                <input type="text" name="social_links[${index}][icon]" placeholder="FontAwesome Icon (e.g. fab fa-facebook-f)" style="width:45%">
                <input type="url" name="social_links[${index}][url]" placeholder="https://example.com" style="width:45%">
                <button type="button" class="remove-social button">Remove</button>
            </div>
        `);
    });

    // Remove repeater row
    $(document).on('click', '.remove-social', function () {
        $(this).closest('.social-link-group').remove();
    });
});