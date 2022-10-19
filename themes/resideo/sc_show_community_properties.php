<?php 
function show_community_properties_fn()
{
    ob_start();
    $term_id    = $_GET['term_id'];

    $term_id    = !empty($term_id) ? $term_id : get_the_ID();

    $args = array(
    'post_type' => 'property',
    'tax_query' => array(
        array(
            'taxonomy' => 'Community',
            'terms' => $term_id,
            'field' => 'term_id',
        )
    )
    );
    $the_query = new WP_Query( $args );
    

                        // The Loop
    if ( $the_query->have_posts() ) {
    ?>
    <style type="text/css">
        .pxp-prop-card-1:hover .pxp-prop-card-1-details {
            transform: translateY(-125%) !important;
        }
    </style>
    <div class="container-fluid pxp-props-carousel-right pxp-has-intro mt-100">
        <div class="pxp-props-carousel-right-intro">
            <p class="pxp-text-light color_green">UNITS SERIES</p>
            <h2 class="pxp-section-h2">EXPLORE THE RANGE OF UNITS</h2> <a href="#" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ec109a104a3" style="color: #333333">VIEW ALL PROJECTS</a>
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
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            $post_id=get_the_ID();
                            $title=get_the_title();
                            $link = get_the_permalink($post_id);
                            $img = wp_get_attachment_image_url($post_id,'full');

                            $gallery     = get_post_meta($post_id, 'property_gallery', true);
                            $photos      = explode(',', $gallery);
                            $first_photo = wp_get_attachment_image_src($photos[0], 'pxp-gallery');
                            $thumbnail   = get_field('thumbnail_image',$post_id);

                            if (!empty($thumbnail)) {
                                $p_photo = $thumbnail;
                            } else if (isset($first_photo[0]) && $first_photo[0] != '') {
                                $p_photo = $first_photo[0];
                            } else {
                                $p_photo = RESIDEO_PLUGIN_PATH . 'images/property-tile.png';
                            }




                            $p_price       = get_post_meta($post_id, 'property_price', true);
                            $p_price_label = get_post_meta($post_id, 'property_price_label', true);

                            $currency_str = $currency;

                            if (is_numeric($p_price)) {
                                if ($decimals == '1') {
                                    $p_price = money_format('%!i', $p_price);
                                } else {
                                    $p_price = money_format('%!.0i', $p_price);
                                }
                            } else {
                                $p_price_label = '';
                                $currency_str = '';
                            }

                            $p_beds  = get_post_meta($post_id, 'property_beds', true);
                            $p_baths = get_post_meta($post_id, 'property_baths', true);
                            $p_size  = get_post_meta($post_id, 'property_size', true);
                            $more_details = get_field('more_details',$post_id);
                            icl_register_string("resideo",$p_price,$p_price);
                            ?>

                            <div class="owl-item active" style="width: 288.65px; margin-right: 30px;">
                                <div class="">
                                    <a href="<?php echo $link;?>" class="pxp-prop-card-1 rounded-lg ">
                                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(<?php echo $p_photo ;?>);"></div>
                                        <div class="pxp-prop-card-1-gradient pxp-animate">
                                            <div class="pxp-prop-card-1-details">
                                                <div class="pxp-prop-card-1-details-title">
                                                    <?php echo pll__($title) ;?>
                                                </div>
                                                <div class="pxp-prop-card-1-details-price">
                                                    <?php
                                                        if(get_locale() == 'ar')
                                                        {
                                                        ?>
                                                            <p style="font-weight:300;float:right;"><?php echo pll_("From"); ?> &nbsp;</p>
                                                        <?php
                                                        }
                                                        ?>
                                                    <p style="font-weight:300;float:left;"><?php echo pll_("From"); ?> &nbsp;</p>
                                                    $<?php echo pll__($p_price); ?> 
                                                </div>
                                            </div>
                                            <div class="pxp-prop-card-1-details-cta text-uppercase">
                                                <div class="line" style="height: 1px;background-color: #FFFFFF;"></div>
                                                <div class="container-fluid mt-2">
                                                    <div class="row">
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Land Area"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_size; echo pll_("SQF");?> 
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Bedrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_beds;?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Bedrooms"); ?>Buildup Area</span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['buildup_area']) && $more_details['buildup_area'] > 0 ? $more_details['buildup_area'] : 0);  echo pll_("SQF");?> 
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Bathrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_baths;?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Floors"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['floors_total']) && $more_details['floors_total'] > 0 ? $more_details['floors_total'] : 0); ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Units Remaining"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['units_remaining']) && $more_details['units_remaining'] > 0 ? $more_details['units_remaining'] : 0); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php echo pll__("View Details");?>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                                <g id="Symbol_1_1" data-name="Symbol 1 – 1" transform="translate(-1847.5 -1589.086)">
                                    <line id="Line_2" data-name="Line 2" x2="30" transform="translate(1848.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_3" data-name="Line 3" x2="9" y2="9" transform="translate(1869.5 1590.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_4" data-name="Line 4" y1="9" x2="9" transform="translate(1869.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                </g>
                            </svg>
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
add_shortcode("show_community_properties","show_community_properties_fn");