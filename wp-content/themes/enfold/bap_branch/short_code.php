<?php
function branch_list_shortcode()
{
    $branchList = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'branch'
    ));

    ob_start();
    if ($branchList->have_posts()) :
        //while ($branchList->have_posts()) :
        //$branchList->the_post();
        ?>

    <?php //endwhile;
    endif;
    $datas = ob_get_contents();
    ob_end_clean();
    return $datas;
}

add_shortcode('bap_branch', function ($args, $content) {
    $branchList = new WP_query([
        'posts_per_page' => -1,
        'post_type' => 'branch',
    ]);
    ?>
    <?php if ($branchList->have_posts()): ?>
        <div class="w-100" id="container-branch">
            <div class="w-50">
                <div id="box-branch">
                    <?php $dataBrachList = []; $i = 0; ?>
                    <?php while ($branchList->have_posts()) : ?>
                        <?php
                            $branchList->the_post();
                            $branch_email = get_post_meta(get_the_ID(), 'branch_email', true);
                            $branch_time_work = get_post_meta(get_the_ID(), 'branch_time_work', true);
                            $branch_phone = get_post_meta(get_the_ID(), 'branch_phone', true);
                            $branch_website = get_post_meta(get_the_ID(), 'branch_website', true);
                            $branch_lat = get_post_meta(get_the_ID(), 'branch_lat', true);
                            $branch_long = get_post_meta(get_the_ID(), 'branch_long', true);
                            $branch_address = get_post_meta(get_the_ID(), 'branch_address', true);
                        ?>
                        <div class="item-branch">
                            <h2 class="title-branch"><?php the_title(); ?></h2>
                            <div class="description-branch">
                                <?php if(!empty($branch_address)): ?>
                                    <p><b>Địa chỉ:</b> <?php echo $branch_address; ?></p>
                                <?php endif; ?>
                                <?php if(!empty($branch_email)): ?>
                                    <div class="w-50">
                                        <p class="mB-5"><b>Email:</b> <?php echo $branch_email; ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($branch_phone)): ?>
                                    <div class="w-50">
                                        <p class="mB-5"><b>SĐT:</b> <?php echo $branch_phone; ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($branch_website)): ?>
                                    <p><b>Website:</b> <?php echo $branch_website; ?></p>
                                <?php endif; ?>
                                <?php if(!empty($branch_time_work)): ?>
                                    <p><b>Thời gian làm việc:</b> <?php echo $branch_time_work; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                            $dataBrachList[$i]['branch_name'] = get_the_title();
                            $dataBrachList[$i]['branch_email'] = $branch_email;
                            $dataBrachList[$i]['branch_time_work'] = $branch_time_work;
                            $dataBrachList[$i]['branch_phone'] = $branch_phone;
                            $dataBrachList[$i]['branch_website'] = $branch_website;
                            $dataBrachList[$i]['branch_lat'] = (float)$branch_lat;
                            $dataBrachList[$i]['branch_long'] = (float)$branch_long;
                            $dataBrachList[$i]['branch_address'] = $branch_address;

                            $i++;
                        ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="w-50">
                <div id="maps_branch"></div>
                <div id="popup" class="ol-popup">
                    <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                    <div id="popup-content"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var dataBrachList = '<?php echo json_encode($dataBrachList); ?>';
            dataBrachList = JSON.parse(dataBrachList);
        </script>
    <?php endif;
});