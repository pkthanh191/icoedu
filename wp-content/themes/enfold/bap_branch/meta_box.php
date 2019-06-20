<?php
//Meta Box Basic Info
function bap_branch_meta_box_callback($post)
{
    wp_nonce_field('branch_name_nonce', 'branch_name_nonce');
    $branch_name = get_post_meta($post->ID, 'branch_name', true);

    wp_nonce_field('branch_email_nonce', 'branch_email_nonce');
    $branch_email = get_post_meta($post->ID, 'branch_email', true);

    wp_nonce_field('branch_phone_nonce', 'branch_phone_nonce');
    $branch_phone = get_post_meta($post->ID, 'branch_phone', true);

    wp_nonce_field('branch_website_nonce', 'branch_website_nonce');
    $branch_website = get_post_meta($post->ID, 'branch_website', true);

    wp_nonce_field('branch_address_nonce', 'branch_address_nonce');
    $branch_address = get_post_meta($post->ID, 'branch_address', true);

    wp_nonce_field('branch_time_work_nonce', 'branch_time_work_nonce');
    $branch_time_work = get_post_meta($post->ID, 'branch_time_work', true);

    wp_nonce_field('branch_lat_nonce', 'branch_lat_nonce');
    $branch_lat = get_post_meta($post->ID, 'branch_lat', true);

    wp_nonce_field('branch_long_nonce', 'branch_long_nonce');
    $branch_long = get_post_meta($post->ID, 'branch_long', true);
    ?>
    <div class="w-33">
        <div class="form-group form-group-valid">
            <label for="branch_email">
                Email:
            </label>
            <input input-validate="true" data-label="Email" data-type="text" check-email="true" check-required="false"
                   check-max="191" class="input-custom w-100" id="branch_email" name="branch_email" type="text"
                   value="<?php echo $branch_email; ?>"/>
            <span class="text-message-error"></span>
        </div>
    </div>
    <div class="w-33">
        <div class="form-group form-group-valid">
            <label for="branch_phone">
                Số điện thoại:
            </label>
            <input input-validate="true" data-label="Số điện thoại" data-type="text" check-number="true"
                   check-required="false" check-max="191" class="input-custom w-100" id="branch_phone"
                   name="branch_phone" type="text" value="<?php echo $branch_phone; ?>"/>
            <span class="text-message-error"></span>
        </div>
    </div>
    <div class="w-33">
        <div class="form-group form-group-valid">
            <label for="branch_website">
                Website:
            </label>
            <input input-validate="true" data-label="Website" data-type="text" check-required="false" check-max="191"
                   class="input-custom w-100" id="branch_website" name="branch_website" type="text"
                   value="<?php echo $branch_website; ?>"/>
            <span class="text-message-error"></span>
        </div>
    </div>
    <div class="w-66">
        <div class="form-group form-group-valid">
            <label for="branch_address">
                Địa chỉ:
                <span class="text-required">*</span>
            </label>
            <textarea input-validate="true" data-label="Địa chỉ" data-type="text" check-required="true" check-max="500"
                      class="input-custom w-100" id="branch_address"
                      name="branch_address"><?php echo $branch_address; ?></textarea>
            <span class="text-message-error"></span>
        </div>
    </div>
    <div class="w-33">
        <div class="form-group form-group-valid">
            <label for="branch_time_work">
                Giờ làm việc:
            </label>
            <textarea input-validate="true" data-label="Giờ làm việc" data-type="text" check-required="false"
                      check-max="500" class="input-custom w-100" id="branch_time_work"
                      name="branch_time_work"><?php echo $branch_time_work; ?></textarea>
            <span class="text-message-error"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="first_name">
            Địa chỉ cụ thể:
            <span class="text-required">*</span>
        </label>
        <div class="w-100"
             style="float: left;width: calc(100% - 20px);border: 1px solid #efefef;padding: 10px 8px;background: #fbfbfb; margin-top: 2px;">
            <div class="pull-left" style="font-size: 12px; margin-left: 6px;">
                Sử dụng <a href="https://www.latlong.net/" target="_blank"
                           style="text-decoration: none;"><b>latlong.net</b></a> để lấy <b>Vĩ độ</b> và <b>Kinh độ</b>
                cụ thể của chi nhánh.
            </div>
            <div class="w-100 box-content-salary mT-10 bdt pT-10">
                <div class="w-33">
                    <div class="form-group form-group-valid">
                        <label for="branch_long" class="pull-left w-100 mB-5 fz-11">
                            Kinh độ(Longitude):
                            <span class="text-required">*</span>
                        </label>
                        <input input-validate="true" data-label="Kinh độ" data-type="text" check-required="true"
                               check-max="191" id="branch_long" type="text" class="input-custom" name="branch_long"
                               value="<?php echo $branch_long; ?>">
                        <span class="text-message-error"></span>
                    </div>
                </div>
                <div class="w-33">
                    <div class="form-group form-group-valid">
                        <label for="branch_lat" class="pull-left w-100 mB-5 fz-11">
                            Vĩ độ(Latitude):
                            <span class="text-required">*</span>
                        </label>
                        <input input-validate="true" data-label="Vĩ độ" data-type="text" check-required="true"
                               check-max="191" id="branch_lat" type="text" class="input-custom" name="branch_lat"
                               value="<?php echo $branch_lat; ?>">
                        <span class="text-message-error"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function bap_branch_meta_box()
{
    add_meta_box(
        'bap-branch',
        __('Thông tin chi nhánh', 'sitepoint'),
        'bap_branch_meta_box_callback',
        'branch'
    );
}

add_action('add_meta_boxes', 'bap_branch_meta_box');


function save_bap_branch_meta_box_data($post_id)
{
    if (
        !isset($_POST['branch_email_nonce']) ||
        !isset($_POST['branch_phone_nonce']) ||
        !isset($_POST['branch_website_nonce']) ||
        !isset($_POST['branch_address_nonce']) ||
        !isset($_POST['branch_time_work_nonce']) ||
        !isset($_POST['branch_lat_nonce']) ||
        !isset($_POST['branch_long_nonce'])
    ) {
        return;
    }

    if (
        !wp_verify_nonce($_POST['branch_email_nonce'], 'branch_email_nonce') ||
        !wp_verify_nonce($_POST['branch_phone_nonce'], 'branch_phone_nonce') ||
        !wp_verify_nonce($_POST['branch_website_nonce'], 'branch_website_nonce') ||
        !wp_verify_nonce($_POST['branch_address_nonce'], 'branch_address_nonce') ||
        !wp_verify_nonce($_POST['branch_time_work_nonce'], 'branch_time_work_nonce') ||
        !wp_verify_nonce($_POST['branch_lat_nonce'], 'branch_lat_nonce') ||
        !wp_verify_nonce($_POST['branch_long_nonce'], 'branch_long_nonce')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (
        !isset($_POST['branch_address']) ||
        !isset($_POST['branch_lat']) ||
        !isset($_POST['branch_long'])
    ) {
        return;
    }

    update_post_meta($post_id, 'branch_email', sanitize_text_field($_POST['branch_email']));
    update_post_meta($post_id, 'branch_phone', sanitize_text_field($_POST['branch_phone']));
    update_post_meta($post_id, 'branch_website', sanitize_text_field($_POST['branch_website']));
    update_post_meta($post_id, 'branch_address', sanitize_text_field($_POST['branch_address']));
    update_post_meta($post_id, 'branch_time_work', sanitize_text_field($_POST['branch_time_work']));
    update_post_meta($post_id, 'branch_lat', sanitize_text_field($_POST['branch_lat']));
    update_post_meta($post_id, 'branch_long', sanitize_text_field($_POST['branch_long']));
}

add_action('save_post', 'save_bap_branch_meta_box_data');