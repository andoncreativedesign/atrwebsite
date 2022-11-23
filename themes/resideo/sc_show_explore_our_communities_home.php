<?php

function show_explore_community_properties_home_fn()
{
    ob_start();
    $post_id = get_the_ID();
    $general_settings = get_option('resideo_general_settings'); 
    $comm_view_cta = get_field("view_all_cta_link",$post_id);
    
    $currency = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';

    $terms = get_terms( array(
        'taxonomy' => 'Community',
        'hide_empty' => false,
    ) );

    // The Loop
    if ( ! empty( $terms ) ) { 
    ?>
    <style type="text/css">
        .pxp-prop-card-1:hover .pxp-prop-card-1-details {
            transform: translateY(-125%) !important;
        }
    </style>
    <div class="container-fluid pxp-props-carousel-right pxp-has-intro mt-100 ">
        <div class="pxp-props-carousel-right-intro">
            <p class="pxp-text-light color_green"><?php echo get_field('explore_title'); ?></p>
            <h2 class="pxp-section-h2 heading_col"><?php echo get_field('explore_subtitle'); ?></h2> <a href="<?php echo $comm_view_cta;?>" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ec109a104a3" style="color: #333333"><?php echo get_field('explore_cta_text'); ?></a>
            <style>
            .pxp-primary-cta#cta-62ec109a104a3:after {
                border-top: 2px solid #333333;
            }
            .pxp-prop-card-1-details-cta span.more_dtl{
                font-weight: 400;
            }
            </style>
        </div>
        <div class="pxp-props-carousel-right-container mt-4 mt-md-5 mt-lg-0">
            <div class="owl-carousel pxp-props-carousel-right-stage-1 owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1972px; padding-left: 30px; padding-right: 30px;">
                        <?php
                        icl_register_string("resideo", 'SQM','SQM'); 
                        foreach ($terms as $term) {

                            $term_id = $term->term_id;
                            $name   = $term->name;
                            $bed    =  get_field('no_of_bad',$term->taxonomy . '_' . $term_id);

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

                            <div class="owl-item active" style="width: 288.65px; margin-right: 30px;">
                                <div class="">
                                    <?php 
                                    $community_slug = get_term_by('id', $term_id, 'Community');
                                    $link = site_url()."/single-community/?term_id=".$term_id."&community=".$community_slug->slug;

                                    if(get_locale() == 'ar'){
                                        $link = str_replace("/single-community","/ar/single-community-ar",$link);
                                    } 

                                    ?>
                                    <a href="<?php echo $link; ?>" class="pxp-prop-card-1 rounded-lg ">
                                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-size: cover;background-image: url(<?php if ($front_image != '') {
                                            echo $front_image;
                                        } else { echo $image;} ?>);"></div>
                                        <div class="pxp-prop-card-1-gradient pxp-animate">
                                            <div class="pxp-prop-card-1-details">
                                                <div class="pxp-prop-card-1-details-title">
                                                    <?php echo pll__( $name ); ?>
                                                </div>
                                                <div class="pxp-prop-card-1-details-price">
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
                                                    <?php echo pll__( $t_price ); ?>&nbsp;<?php echo pll__( $currency ); ?> 
                                                </div>
                                            </div>
                                            <div class="pxp-prop-card-1-details-cta text-uppercase">
                                                <div class="line" style="height: 1px;background-color: #FFFFFF;"></div>
                                                <div class="container-fluid mt-2">
                                                    <div class="row">
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__( $area_label );?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo pll__($area_sqf).' '.pll__("SQM");?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Bedrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo pll__($bed);?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Buildup Area"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $size;?>&nbsp;<?php echo pll__("SQM");?> 
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Bathrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo pll__($bath);?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Floors"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $floors; ?>
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
                            </div>

                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev disabled">
                        <div class="pxp-props-carousel-left-arrow pxp-animate">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828" class="pxp-arrow-1">
                                <g id="Group_30" data-name="Group 30" transform="translate(-1845.086 -1586.086)">
                                    <line id="Line_2" data-name="Line 2" x1="30" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_3" data-name="Line 3" x1="9" y2="9" transform="translate(1846.5 1587.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_4" data-name="Line 4" x1="9" y1="9" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                </g>
                            </svg>
                        </div>
                    </button>
                    <button type="button" role="presentation" class="owl-next">
                        <div class="pxp-props-carousel-right-arrow pxp-animate">
                            
                             <?php if(get_locale()=="ar"){ ?> 
                              <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828"><g id="Group_30" data-name="Group 30" transform="translate(-1845.086 -1586.086)"><line id="Line_2" data-name="Line 2" x1="30" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line><line id="Line_3" data-name="Line 3" x1="9" y2="9" transform="translate(1846.5 1587.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line><line id="Line_4" data-name="Line 4" x1="9" y1="9" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line></g> </svg>
                            <?php } else {?>

                            <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                                <g id="Symbol_1_1" data-name="Symbol 1 – 1" transform="translate(-1847.5 -1589.086)">
                                    <line id="Line_2" data-name="Line 2" x2="30" transform="translate(1848.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_3" data-name="Line 3" x2="9" y2="9" transform="translate(1869.5 1590.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_4" data-name="Line 4" y1="9" x2="9" transform="translate(1869.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                </g>
                            </svg>

                            <?php } ?>

                           
                        </div>
                    </button>
                </div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
    <?php
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode("show_home_explore_community","show_explore_community_properties_home_fn");