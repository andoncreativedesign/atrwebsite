<?php 
function show_mission_slider_fn()
{
    ob_start();
    ?>
    
        <div class="pxp-services-h service_case2 pt-100 pb-100 page_service body_color" style="">
                <div class="container">
                         <div class="pxp-services-h-container mt-0 mt-md-0">
                         <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 service_img_min_height" >
                          <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                                      <ol class="carousel-indicators" style="top:0">
                                         <?php if( have_rows('vision_section') ): ?>
                                           
                                            <?php 
                                            $s=0;
                                            while( have_rows('vision_section') ): the_row(); 
                                                $title       = get_sub_field('title');
                                                $sub_title   = get_sub_field('sub_title');
                                                $text        = get_sub_field('text');
                                                $button_text = get_sub_field('button_text');
                                                $button_link = get_sub_field('button_link');
                                               
                                                ?>
                                               <li data-target="#carouselExampleIndicators3" data-slide-to="<?php echo $s;?>" class="<?php if($s=="0"){echo 'active';}?>" style="background:#C2A022">aa</li>
                                            <?php 
                                                 $s++;
                                                endwhile; ?>
                                            
                                        <?php endif; ?>
                                        
                                        
                                        
                                      </ol>
                                      <div class="carousel-inner">

                                        <?php if( have_rows('vision_section') ): ?>
                                           
                                            <?php 
                                            $s=0;
                                            while( have_rows('vision_section') ): the_row(); 
                                                $title       = get_sub_field('title');
                                                $sub_title   = get_sub_field('sub_title');
                                                $text        = get_sub_field('text');
                                                $button_text = get_sub_field('button_text');
                                                $button_link = get_sub_field('button_link');
                                                $s++;
                                                ?>
                                                <div class="carousel-item <?php if($s=="1"){echo 'active';}?>"
                                                    style="margin-top: 50px;"
                                                    >
                                                  

                                                    <p class="pxp-text-light" ><?php echo $title;?></p>
                                                    <h3 class="pxp-section-h2" ><?php echo $sub_title;?></h3>
                                                    <div class="service_case2_intro">
                                                        <?php echo $text;?>
                                                    </div>
                                                    <a href="<?php echo $button_link;?>" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in pxp-in " id="cta-62f7eec16f676" ><?php echo $button_text;?></a>

                                                </div>
                                            <?php endwhile; ?>
                                           
                                        <?php endif; ?>
                                        
                                        
                                        
                                       
                                      </div>
                                      
                                    </div>
                            </div>

                         </div>
                </div>
        </div>
    <?php
    return ob_get_clean();

    
}

add_shortcode('show_mission_slider','show_mission_slider_fn');?>