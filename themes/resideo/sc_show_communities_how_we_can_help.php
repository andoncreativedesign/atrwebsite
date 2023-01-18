<?php

function show_communities_how_we_can_help_fn()
{
    ob_start();
    $general_settings = get_option('resideo_general_settings'); 


    $currency = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';

    $terms = get_terms( array(
	    'taxonomy' => 'Community',
	    'hide_empty' => false,
	) ); 

	// The Loop
    if ( ! empty( $terms ) ) { 
    ?>


<div class="container pxp-has-intro mt-100">
    
        <p class="pxp-text-light color_green"></p>
            <h2 class="pxp-section-h2 how_we_help_you" style="padding-bottom: 30px;">
                <?php 
                   // if(get_the_ID() == '859' or get_the_ID() == '1524'){
                        echo  pll__( "FEATURED COMMUNITIES" ); 
                   // }
                   // else{
                        //echo  pll__( "FEATURED COMMUNITIES" ); 
                   // }
                ?>
            </h2> 
        <div class="row">
            <?php
            icl_register_string("resideo", 'Floors','Floors'); 
            icl_register_string("resideo", 'SQF','SQF'); 

            



            foreach ($terms as $term) {

                $term_id = $term->term_id;
                $name   = $term->name;
                $bed    =  get_field('no_of_bed',$term->taxonomy . '_' . $term_id);

                $bath   =  get_field('no_of_bath',$term->taxonomy . '_' . $term_id);

                $area   =  get_field('area_from',$term->taxonomy . '_' . $term_id);
                $area = explode("|", $area);
                $area_label = $area[0];
                $area_sqf = $area[1];

                $price  =  get_field('price_from',$term->taxonomy . '_' . $term_id);
                $price = explode("|", $price);
                $price_label = $price[0];
                $t_price = $price[1];

                $units  =  get_field('available_units',$term->taxonomy . '_' . $term_id);
                $units = explode("|", $units);
                $units_label = $units[0];
                $t_units = $units[1];
                
                $size   =  get_field('area_size_sqft',$term->taxonomy . '_' . $term_id);

                $image  =  get_field('image',$term->taxonomy . '_' . $term_id);

                $floors     =  get_field('floors',$term->taxonomy . '_' . $term_id);

                $front_image =  get_field('community_front_image',$term->taxonomy . '_' . $term_id);
                ?>
                <div class="col-md-4">
                    <?php 
                    $community_slug = get_term_by('id', $term_id, 'Community');
                        $link = site_url()."/single-community/?term_id=".$term_id."&community=".$community_slug->slug;

                        if(get_locale() == 'ar'){
                            $link = str_replace("/single-community","/ar/single-community-ar",$link);
                        } 
                    ?>
                    <a href="<?php echo $link;?>" class="pxp-prop-card-1 rounded-lg ">
                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-size: cover;background-image: url(<?php if ($front_image != '') {
                            echo $front_image;
                        } else { echo $image;} ?>);"></div>
                        <div class="pxp-prop-card-1-gradient pxp-animate">
                            <div class="pxp-prop-card-1-details">
                                <div class="pxp-prop-card-1-details-title">
                                    <?php echo pll__($name) ;?>
                                </div>
                                <div class="pxp-prop-card-1-details-price" style="visibility:hidden;">
                                    <?php
                                        if(get_locale() == 'ar'){
                                        ?>
                                            <p style="font-weight:300;float:right;"><?php echo pll__( $price_label ); ?> &nbsp;</p>
                                        <?php
                                        }
                                        else{
                                            ?>
                                            <p style="font-weight:300;float:left;"><?php echo pll__( $price_label ); ?> &nbsp;</p>
                                    <?php
                                        }
                                    ?>
                                    <?php echo $t_price; ?>&nbsp;<?php echo pll__($currency); ?> 
                                </div>
                            </div>
                            <div class="pxp-prop-card-1-details-cta text-uppercase">
                                <div class="line" style="height: 1px;background-color: #FFFFFF;"></div>
                                <div class="container-fluid mt-2">
                                    <div class="row">
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php echo pll__($area_label);?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($area_sqf).' '.pll__("SQM");;?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Bedrooms" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($bed);?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Buildup Area" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($size); ?>  <?php  echo pll__( "SQF" ); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Bathrooms" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($bath);?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Floors" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($floors); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php echo pll__($units_label); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($t_units); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <?php echo pll__("View Details"); ?>
                            </div>
                        </div>
                        
                    </a>
                </div>
            <?php
            }
            wp_reset_postdata();
            icl_register_string("resideo", 'VIEW ALL','VIEW ALL');
            ?>
        </div>

        <?php (get_locale() == "ar") ? $cta_url = "/home-search-ar":$cta_url = "/home-search"; ?>
        <a href="<?php echo $cta_url;?>" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ec109a104a3" style="color: #333333"><?php echo pll__("VIEW ALL"); ?></a>
        <style>
        .pxp-primary-cta#cta-62ec109a104a3:after {
            border-top: 2px solid #333333;
        }
        .pxp-prop-card-1-details-cta span.more_dtl{
            font-weight: 400;
        }
        </style>
    
</div>
    <!-- ---------------------------------------------------------------------- -->
    <style type="text/css">
        .pxp-prop-card-1:hover .pxp-prop-card-1-details {
            transform: translateY(-125%) !important;
        }
    </style>
    
    <?php
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode("show_communities_how_we_can_help","show_communities_how_we_can_help_fn");