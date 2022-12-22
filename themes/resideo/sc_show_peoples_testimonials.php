<?php
    function people_testimonial()
    {
    ob_start();
    ?>
    <div class="pxp-testim-1 pt-100 pb-100 mt-100 cust_people_info_cont pxp-cover" style="background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/12/testimbg-new.jpg);">
        <div class="pxp-testim-1-intro">
            <p class="pxp-text-light" style="color: "><?php the_field('testimonial_title');?></p>
            <h3 class="pxp-section-h2" style="color: "><?php the_field('testimonial_sub_title');?></h3><a href="<?php the_field('testimonial_cta_btn_url');?>" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-6308cf442c70f" style="color: "><?php the_field('testimonial_cta_btn_text');?></a>
        </div>
        <div class="pxp-testim-1-container mt-4 mt-md-5 mt-lg-0">
            <div class="owl-carousel pxp-testim-1-stage owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1587px;">
                        <?php 
                            $args = array( 'post_type' => 'peoples', 'posts_per_page' => 10);
                            $the_query = new WP_Query( $args ); 
                            ?>
                            <?php if ( $the_query->have_posts() ) : ?>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <div class="owl-item">
                                    <div>
                                        <?php 
                                            $person_name = get_field('person_name');
                                            $person_location = get_field('person_location');
                                            icl_register_string("resideo", $person_name,$person_name); 
                                            icl_register_string("resideo", $person_location,$person_location); 

                                            $person_desc = get_field('person_description'); 
                                            if (get_locale() == 'ar') {
                                                $person_desc = get_field('person_description_ar');   
                                            }
                                        ?>
                                        <div class="pxp-testim-1-item" style="min-height: 523px">
                                            <div class="pxp-testim-1-item-avatar pxp-cover" style="background-image: url(<?php the_field('person_image');?>">
                                            </div>
                                            <div class="pxp-testim-1-item-name"><?php echo pll__($person_name);?></div>
                                            <div class="pxp-testim-1-item-location"><?php echo pll__($person_location);?></div>
                                            <div class="pxp-testim-1-item-message"><?php echo $person_desc; ?> </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                            <?php endif; 
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php
    return  ob_get_clean();
    }
    add_shortcode('people_testimonial_services','people_testimonial');
?>