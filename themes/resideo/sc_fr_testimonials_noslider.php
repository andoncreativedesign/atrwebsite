<?php
    function fr_testimonials_noslider()
    {
    ob_start();
    icl_register_string("resideo", 'HOME BUYERS TESTIMONIALS','HOME BUYERS TESTIMONIALS'); 
    ?>
    <div class="fr_ct_testim_container pt-50 pb-50 mt-20 pxp-cover">
       
        <div class="mt-4 container">
        
            <h2 class="pxp-section-h2"><?php echo pll__("HOME BUYERS TESTIMONIALS");?></h2>
        
            <div class="row">
                
                        <?php 
                            $args = array( 'post_type' => 'testimonial', 'posts_per_page' => 10);
                            $posts = wp_get_recent_posts($args);
                            ?>
                             <?php foreach ($posts as $post) {?>
                           
                                <div class="col-md-4 col-sm-12">
                                    <div>
                                        <?php 
                                            $text = get_post_meta($post['ID'], 'testimonial_text', true);
                                            $location = get_post_meta($post['ID'], 'testimonial_location', true);
            
                                            $avatar = get_post_meta($post['ID'], 'testimonial_avatar', true);

                                            if ($avatar != '') {
                                                $avatar_photo = wp_get_attachment_image_src($avatar, 'pxp-agent');
                                                $avatar_photo_src = $avatar_photo[0];
                                            } else {
                                                $avatar_photo_src = RESIDEO_PLUGIN_PATH . 'images/avatar-default.png';
                                            } ?>
                                        
                                        <div>
                                    <div class="pxp-testim-1-item">
                                        <div class="pxp-testim-1-item-avatar pxp-cover" style="background-image: url(<?php echo esc_url($avatar_photo_src); ?>)"></div>
                                        <div class="pxp-testim-1-item-name"><?php echo esc_html($post['post_title']); ?></div>
                                        <div class="pxp-testim-1-item-location"><?php echo esc_html($location); ?></div>
                                        <div class="pxp-testim-1-item-message"><?php echo $text; ?></div>
                                    </div>
                                </div>
                                    </div>
                                </div>
                           
                            <?php wp_reset_postdata(); ?>
                            <?php }
                        ?>
                
                
            </div>
        </div>
    </div>
    <?php
    return  ob_get_clean();
    }
    add_shortcode('sc_fr_testimonials_noslider','fr_testimonials_noslider');
?>