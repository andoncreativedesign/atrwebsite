<?php
function show_design_features_fn(){
    ob_start();
    $term_id    = $_GET['term_id'];

    $term_id    = !empty($term_id) ? $term_id : get_the_ID();

    $tt         =   'term_'.$term_id;
    // $bd         =   get_field("location_distance",$tt);
    $s=0;

    if( have_rows('design_features',$tt) ):
       
        // Loop through rows.
        while( have_rows('design_features' ,$tt) ) : the_row();
            
            $heading           = get_sub_field('heading');
            $sub_heading       = get_sub_field('sub_heading');
            $description       = get_sub_field('description');
            $image             = get_sub_field('image');
            $image_gallery     = get_sub_field('image_gallery');
            if( $s%2 == 0 ) { ?>
                <div class="pt-100 pb-100 page_service_community body_color" style=" padding-bottom: 70px;">
                    <div class="container">

                        <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                            <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 pxp-in" style="min-height: 284px">
                                <p class="pxp-text-light" style="color: "><?php echo $heading; ?></p>
                                <h3 class="pxp-section-h2" style="color: "><?php echo $sub_heading; ?></h3>
                                <div>
                                     <p style="padding-right: 10px; text-align: left;"> <?php echo $description; ?></p>
                                </div>
                            </div>
                            <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in" style="height: 400px">
                                <div class="" style="margin-top: 36px; background-color:#000">
                                    <img src="<?php echo $image; ?>">
                                    <div style="width: 40px; height: 40px; background-color: #fff; position: absolute; bottom: 20px; right: 30px">
                                        <img style="padding: 12px; cursor: pointer;" id="gallery" data-toggle="modal" data-target="#exampleModal_<?php echo $s; ?>" src="<?php echo site_url(); ?>/wp-content/uploads/2022/08/ic_zoom_out_map_24px.png" style="padding: 12px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
            }
            else { ?>
                <div class="pt-100 pb-100 page_service1_community body_color" style="margin-bottom: 58px;">
                    <div class="container">

                        <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                            <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in" style="height: 400px">
                                
                                <div class="" style="margin-top: 36px; background-color:#000">
                                    <img src="<?php echo $image; ?>">
                                    <div style="width: 40px; height: 40px; background-color: #fff; position: absolute; bottom: 20px; right: 30px">
                                        <img style="padding: 12px; cursor: pointer;" id="gallery" data-toggle="modal" data-target="#exampleModal_<?php echo $s; ?>" src="<?php echo site_url(); ?>/wp-content/uploads/2022/08/ic_zoom_out_map_24px.png" style="padding: 12px;">
                                    
                                    </div>
                                </div>

                            </div>
                            <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 pxp-in" style="min-height: 284px; padding-left: 60px; margin-right: 0px !important">
                                <p class="pxp-text-light" style="color: "><?php echo $heading; ?></p>
                                <h3 class="pxp-section-h2" style="color: "><?php echo $sub_heading; ?></h3><div>
                                   <p style="padding-right: 10px; text-align: left;">
                                       <?php echo $description; ?>
                                   </p>
                               </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php 
            }
            ?>
            <div class="modal fade bd-example-modal-lg" id="exampleModal_<?php echo $s; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carouselExample_<?php echo $s; ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                <?php
                                if(is_array($image_gallery) && count($image_gallery) > 0){
                                    foreach($image_gallery as $key => $url){
                                        ?>
                                        <div class="carousel-item <?php echo ($key == 0 ? "active" : ""); ?>">
                                            <img class="d-block w-100" src="<?php echo $url; ?>">
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?php echo $image; ?>">
                                    </div>
                                    <?php
                                } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample_<?php echo $s; ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample_<?php echo $s; ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $s++;

        // End loop.
        endwhile;

    else :

    endif;
    


    return ob_get_clean();
}
add_shortcode("show_design_features","show_design_features_fn");