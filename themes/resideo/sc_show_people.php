<?php 
function wpb_demo_shortcode() { 
  
    ob_start();
    ?>
    <div class="pxp-testim-1 pt-100 pb-100 mt-100 pxp-cover" style="background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/09/testim-bg.jpg);">
        <div class="pxp-testim-1-intro">
            <p class="pxp-text-light" style="color: ">WHAT THEY SAY ABOUT US</p>
            <h3 class="pxp-section-h2" style="color: ">HOME BUYERS TESTIMONIALS</h3><a href="http://pixelprime.co/themes/resideo-wp/demo-5/contact-us/" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-6308d99948587" style="color: ">Contact us</a></div>
        <div class="pxp-testim-1-container mt-4 mt-md-5 mt-lg-0">
            <div class="owl-carousel pxp-testim-1-stage owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1694px;">
                      
                        
                        <?php 
                        $args = array( 'post_type' => 'peoples', 'posts_per_page' => 5 );
                        $the_query = new WP_Query( $args ); 
                        ?>  
                        <?php if ( $the_query->have_posts() ) : ?>
                            
                            <?php while ( $the_query->have_posts() ) : 
                                $the_query->the_post(); 
                                $id = get_the_ID();

                                ?>
                                <div class="owl-item " >
                                    <div>
                                        <div class="pxp-testim-1-item">
                                            <div class="pxp-testim-1-item-avatar pxp-cover" style="background-image: url(<?php echo get_field('person_image'); ?>)"></div>
                                            <div class="pxp-testim-1-item-name"><?php echo get_field('person_name'); ?></div>
                                            <div class="pxp-testim-1-item-location"><?php echo get_field('person_location'); ?></div>
                                            <div class="pxp-testim-1-item-message"><?php echo get_field('person_description'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>

                    
                        <?php endif; ?>
                        
                       
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <?php    
    $tt = ob_get_clean();

      
    // Output needs to be return
    return $tt;
}
// register shortcode
add_shortcode('show_people', 'wpb_demo_shortcode');