jQuery(function ($) {

    $('body').on('click', '.bap_upload_file_button', function (e) {
        e.preventDefault();
        console.log(wp.media.view.settings.post.id);

        var button = $(this);
        var bap_uploader = wp.media({
            title: 'Custom file',
            button: {
                text: 'Use this file'
            },
            multiple: false
        }).on('select', function () {
            var attachment = bap_uploader.state().get('selection').first().toJSON();
            $('#bap_custom_file').val(attachment.url);
        }).open();
    });
});