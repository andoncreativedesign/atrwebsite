<?php
    function people_testimonial()
    {
        ob_start();
        icl_register_string("resideo", 'WHAT THEY SAY ABOUT US','WHAT THEY SAY ABOUT US'); 
        icl_register_string("resideo", 'HOME BUYERS TESTIMONIALS','HOME BUYERS TESTIMONIALS'); 
    ?>
    <div class="pxp-testim-1 pt-100 pb-100 mt-100 pxp-cover" style="background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/09/testim-bg.jpg);">
        <div class="pxp-testim-1-intro">
            <p class="pxp-text-light" style="color: "><?php echo pll__("WHAT THEY SAY ABOUT US"); ?></p>
            <h3 class="pxp-section-h2" style="color: "><?php echo pll__("HOME BUYERS TESTIMONIALS");?></h3><a href="http://pixelprime.co/themes/resideo-wp/demo-5/contact-us/" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-6308cf442c70f" style="color: "><?php echo pll__("Contact us"); ?></a>
        </div>
        <div class="pxp-testim-1-container mt-4 mt-md-5 mt-lg-0">
            <div class="owl-carousel pxp-testim-1-stage owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1587px;">
                        <?php 
                            $args = array( 'post_type' => 'peoples', 'posts_per_page' => 5);
                            $the_query = new WP_Query( $args ); 
                            ?>
                            <?php if ( $the_query->have_posts() ) : ?>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <div class="owl-item">
                                    <div>
                                        <div class="pxp-testim-1-item">
                                            <div class="pxp-testim-1-item-avatar pxp-cover" style="background-image: url(<?php the_field('person_image');?>">
                                            </div>
                                            <?php
                                                $person_name = get_field('person_name');
                                                $person_location = get_field('person_location');

                                                $person_desc = get_field('person_description'); 
                                                if (get_locale() == 'ar') {
                                                    $person_desc = get_field('person_description_ar');   
                                                }
                                            ?>
                                            </div>
                                            <div class="pxp-testim-1-item-name"><?php echo pll__($person_name);?></div>
                                            <div class="pxp-testim-1-item-location"><?php echo pll__($person_location);;?></div>
                                            <div class="pxp-testim-1-item-message"><?php echo $person_desc; ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                            <?php endif; 
                        ?>
                    </div>
                </div>
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                            <g id="Group_30" data-name="Group 30" transform="translate(-1845.086 -1586.086)">
                                <line id="Line_2" data-name="Line 2" x1="30" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                <line id="Line_3" data-name="Line 3" x1="9" y2="9" transform="translate(1846.5 1587.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                <line id="Line_4" data-name="Line 4" x1="9" y1="9" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                            </g>
                        </svg>
                    </button>
                    <button type="button" role="presentation" class="owl-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                            <g id="Symbol_1_1" data-name="Symbol 1 - 1" transform="translate(-1847.5 -1589.086)">
                                <line id="Line_2" data-name="Line 2" x2="30" transform="translate(1848.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                <line id="Line_3" data-name="Line 3" x2="9" y2="9" transform="translate(1869.5 1590.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                <line id="Line_4" data-name="Line 4" y1="9" x2="9" transform="translate(1869.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                            </g>
                        </svg>
                    </button>
                </div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
    <?php
    return  ob_get_clean();
    }
    add_shortcode('people_testimonial_services','people_testimonial');
?>