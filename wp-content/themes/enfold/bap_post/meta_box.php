<?php
function bap_custom_meta_boxes($post_type, $post)
{
    if($post_type == 'post') {
        add_meta_box(
            'bap-meta-box',
            __('File'),
            'render_bap_meta_box',
            array('post', 'page'),
            'normal',
            'high'
        );
    }
}

add_action('add_meta_boxes', 'bap_custom_meta_boxes', 10, 2);

function render_bap_meta_box($post)
{
    $file = get_post_meta($post->ID, 'bap_custom_file', true);
    ?>
    <div class="w-100 mT-5">
        <a style="width: 100px; float: left; margin-right: 10px; text-align: center;" href="javascript:void(0)" class="bap_upload_file_button button button-secondary"><?php _e('File tài liệu'); ?></a>
        <input type="text" class="input-custom" name="bap_custom_file" id="bap_custom_file" value="<?php echo $file; ?>" style="width: calc(100% - 112px); float: left; height:27px;"/>
    </div>
    <?php
}

function bap_save_postdata($post_id)
{
    if (array_key_exists('bap_custom_file', $_POST)) {
        update_post_meta(
            $post_id,
            'bap_custom_file',
            $_POST['bap_custom_file']
        );
    }
}

add_action('save_post', 'bap_save_postdata');