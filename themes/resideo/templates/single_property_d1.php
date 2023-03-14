 <?php
/**
 * @package WordPress
 * @subpackage Resideo
 */


while (have_posts()) : the_post();
    $prop_id = get_the_ID();
    $user = wp_get_current_user();

    $appearance_settings = get_option('resideo_appearance_settings');
    $layout_settings = get_option('resideo_property_layout_settings');

    $fields_settings   = get_option('resideo_prop_fields_settings');
    $neighborhood_type = isset($fields_settings['resideo_p_neighborhood_t_field']) ? $fields_settings['resideo_p_neighborhood_t_field'] : '';
    $city_type         = isset($fields_settings['resideo_p_city_t_field']) ? $fields_settings['resideo_p_city_t_field'] : '';
    $neighborhoods     = get_option('resideo_neighborhoods_settings');
    $cities            = get_option('resideo_cities_settings');

    $address_arr  = array();
    $address      = '';
    $street_no    = get_post_meta($prop_id, 'street_number', true);
    $street       = get_post_meta($prop_id, 'route', true);
    $neighborhood = get_post_meta($prop_id, 'neighborhood33', true);
    $city         = get_post_meta($prop_id, 'locality33', true);
    $state        = get_post_meta($prop_id, 'administrative_area_level_1', true);
    $zip          = get_post_meta($prop_id, 'postal_code', true);

    $neighborhood_value = resideo_get_field_value($neighborhood_type, $neighborhood, $neighborhoods);
    $city_value         = resideo_get_field_value($city_type, $city, $cities);

    $address_settings = get_option('resideo_address_settings');


    	
   

    if (is_array($address_settings)) {
        echo "ADDRESSSEtings_arr";
        uasort($address_settings, "resideo_compare_position");

        $address_default = array(
            'street_number' => $street_no,
            'street'        => $street,
            'neighborhood'  => $neighborhood_value,
            'city'          => $city_value,
            'state'         => $state,
            'zip'           => $zip
        );

        foreach ($address_settings as $key => $value) {
            if ($address_default[$key] != '') {
                array_push($address_arr, $address_default[$key]);
            }
        }
    } else {
        //echo "ADDRESSSEtings_notarr";
        if ($street_no != '') array_push($address_arr, $street_no);
        if ($street != '') array_push($address_arr, $street);
        if ($neighborhood_value != '') array_push($address_arr, $neighborhood_value);
        if ($city_value != '') array_push($address_arr, $city_value);
        if ($state != '') array_push($address_arr, $state);
        if ($zip != '') array_push($address_arr, $zip);
    }

    if (count($address_arr) > 0) $address = implode(', ', $address_arr);

    $general_settings = get_option('resideo_general_settings');
    $unit             = isset($general_settings['resideo_unit_field']) ? $general_settings['resideo_unit_field'] : '';
    $currency         = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';
   
    $beds_label       = isset($general_settings['resideo_beds_label_field']) ? $general_settings['resideo_beds_label_field'] : 'BD';
    $baths_label      = isset($general_settings['resideo_baths_label_field']) ? $general_settings['resideo_baths_label_field'] : 'BA';
    $currency_pos     = isset($general_settings['resideo_currency_symbol_pos_field']) ? $general_settings['resideo_currency_symbol_pos_field'] : '';
    $locale           = isset($general_settings['resideo_locale_field']) ? $general_settings['resideo_locale_field'] : '';
    $decimals         = isset($general_settings['resideo_decimals_field']) ? $general_settings['resideo_decimals_field'] : '';
    setlocale(LC_MONETARY, $locale);

    $price       = get_post_meta($prop_id, 'property_price', true);
    $price_label = get_post_meta($prop_id, 'property_price_label', true);

    $taxes = get_post_meta($prop_id, 'property_taxes', true);
    $hoa_dues = get_post_meta($prop_id, 'property_hoa_dues', true);


    icl_register_string("resideo", 'Garages','Garages');
    icl_register_string("resideo", 'Buildup area','Buildup area');
    icl_register_string("resideo", 'Type','Type');
    icl_register_string("resideo", 'Status','Status');
    icl_register_string("resideo", 'INTERIOR','INTERIOR');
    icl_register_string("resideo", 'EXTERIOR','EXTERIOR');
    icl_register_string("resideo", 'OVERVIEW','OVERVIEW');
    icl_register_string("resideo", 'Amenities','Amenities');
    icl_register_string("resideo", 'Key Details','Key Details');
    icl_register_string("resideo", 'LOCATION','LOCATION');
    icl_register_string("resideo", 'Floor Plans','Floor Plans');
    icl_register_string("resideo", 'MORTGAGE CALCULATOR','MORTGAGE CALCULATOR');
    icl_register_string("resideo", 'Disclaimer:','Disclaimer:');
    icl_register_string("resideo", 'Term','Term');
    icl_register_string("resideo", 'Years Fixed','Years Fixed');
    icl_register_string("resideo", 'Interest','Interest');
    icl_register_string("resideo", 'Home Price','Home Price');
    icl_register_string("resideo", 'Down Payment','Down Payment');
    icl_register_string("resideo", 'Compare Floor plans','Compare Floor plans');
    icl_register_string("resideo", 'Select Floor','Select Floor');
    icl_register_string("resideo", '1st Floor','1st Floor');
    icl_register_string("resideo", '2nd Floor','2nd Floor');
    icl_register_string("resideo", '3rd Floor','3rd Floor');
    icl_register_string("resideo", 'SEE DETAILS','SEE DETAILS');
    icl_register_string("resideo", 'ASK OUR TEAM FOR HELP','ASK OUR TEAM FOR HELP');
    icl_register_string("resideo", 'Finance your home with:','Finance your home with:');
    icl_register_string("resideo", 'Amlak International','Amlak International');
    icl_register_string("resideo", 'Bidaya Home Finance','Bidaya Home Finance');
    icl_register_string("resideo", 'Monthly Installment','Monthly Installment');
    icl_register_string("resideo", 'View on google maps','View on google maps');
    icl_register_string("resideo", 'Give us call on','Give us call on');
    icl_register_string("resideo", 'Listed By','Listed By');
    icl_register_string("resideo", '1BR','1BR'); 
    icl_register_string("resideo", '500 SQF','500 SQF'); 
    icl_register_string("resideo", '2BA','2BA'); 

    if (!is_numeric($taxes)) {
        $taxes = 0;
    }

    if (!is_numeric($hoa_dues)) {
        $hoa_dues = 0;
    }
    
    if (is_numeric($price)) {
        if ($decimals == '1') {
            $price = money_format('%!i', $price);
        } else {
            $price = money_format('%!.0i', $price);
        }
    } else {
        $price_label = '';
        // $currency = '';
    }
    $beds  = get_post_meta($prop_id, 'property_beds', true);
    $baths = get_post_meta($prop_id, 'property_baths', true);
    $size  = get_post_meta($prop_id, 'property_size', true);
  
    $prop_lat = get_post_meta($prop_id, 'property_lat', true);
    $prop_lng = get_post_meta($prop_id, 'property_lng', true);
    $gallery = get_post_meta($prop_id, 'property_gallery', true);
    $photos  = explode(',', $gallery);

    $floor_plans = get_post_meta($prop_id, 'property_floor_plans', true);

    $status = wp_get_post_terms($prop_id, 'property_status');
    $type   = wp_get_post_terms($prop_id, 'property_type');
    $findCommunity = wp_get_post_terms($prop_id, 'Community');
   
    if(!empty( $findCommunity )) {

       
        $current_comm = $findCommunity[0]->term_id;
    }
   
    $custom_fields_settings = get_option('resideo_fields_settings');

    $overview = get_the_content();

    $amenities_settings = get_option('resideo_amenities_settings');
    $amenities_count = 0;

    if (is_array($amenities_settings) && count($amenities_settings) > 0) {
        foreach ($amenities_settings as $key => $value) {
            if (get_post_meta($prop_id, $key, true) == 1) {
                $amenities_count++;
            }
        }
    } 

    $video = get_post_meta($prop_id, 'property_video', true);
    $virtual_tour = get_post_meta($prop_id, 'property_virtual_tour', true);

    $lat = get_post_meta($prop_id, 'property_lat', true);
    $lng = get_post_meta($prop_id, 'property_lng', true);

    $calculator = get_post_meta($prop_id, 'property_calc', true);

    $agent_id = get_post_meta($prop_id, 'property_agent', true);
    if ($agent_id > 0) {
        $agent_email = get_post_meta($agent_id, 'agent_email', true);
        $agent_phone = get_post_meta($agent_id, 'agent_phone', true);
    }
    $agent    = $agent_id > 0 ? get_post($agent_id) : ''; 

    $top_element = isset($layout_settings['resideo_property_layout_top_field']) ? $layout_settings['resideo_property_layout_top_field'] : 'title';
    $gallery_class = $top_element == 'title' ? ' mt-md-0' : 'pxp-single-property-top'; 

    $show_print = isset($general_settings['resideo_show_print_property_field']) ? $general_settings['resideo_show_print_property_field'] : '';
    $show_report = isset($general_settings['resideo_show_report_property_field']) ? $general_settings['resideo_show_report_property_field'] : ''; 

    $sections_settings = isset($layout_settings['resideo_property_layout_order_field']) ? $layout_settings['resideo_property_layout_order_field'] : '';
    $sections = array();
    if (is_array($sections_settings)) {
        uasort($sections_settings, "resideo_compare_position");

        foreach ($sections_settings as $key => $value) {
            $sections[$key] = $sections_settings[$key];
        }
    } else {
        $sections = array(
            'key_details' => array(
                'name' => __('Key Details', 'resideo'),
                'position' => 0
            ),
            'overview' => array(
                'name' => __('Overview', 'resideo'),
                'position' => 1
            ),
            'amenities' => array(
                'name' => __('Amenities', 'resideo'),
                'position' => 2
            ),
            'video' => array(
                'name' => __('Video', 'resideo'),
                'position' => 3
            ),
            'virtual_tour' => array(
                'name' => __('Virtual Tour', 'resideo'),
                'position' => 4
            ),
            'explore_area' => array(
                'name' => __('Explore the Area', 'resideo'),
                'position' => 6
            ),
            'floor_plans' => array(
                'name' => __('Floor Plans', 'resideo'),
                'position' => 5
            ),
           
            'payment_calculator' => array(
                'name' => __('Payment Calculator', 'resideo'),
                'position' => 7
            )
        );
    } 

    $dropdown_class = 'dropdown-menu-right';
    if (is_rtl()) {
        $dropdown_class = 'dropdown-menu-left';
    } 

    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery(".fa-star-o").parent().hide();
        });
    </script>
    
    <input type="hidden" name="single_id" id="single_id" value="<?php echo esc_attr($prop_id); ?>" />
    <input type="hidden" name="lat" id="lat" value="<?php echo esc_attr($lat); ?>" />
    <input type="hidden" name="lng" id="lng" value="<?php echo esc_attr($lng); ?>" />
    <input type="hidden" name="taxes" id="taxes" value="<?php echo esc_attr($taxes); ?>" />
    <input type="hidden" name="hoa_dues" id="hoa_dues" value="<?php echo esc_attr($hoa_dues); ?>" />

    <div class="pxp-content">
        <?php if ($top_element == 'title') { ?>
            <div class="pxp-single-property-top pxp-content-wrapper mt-100" style="background-image:none">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <h2 class="pxp-sp-top-title"><?php the_title(); ?></h2>
                            <p class="pxp-sp-top-address pxp-text-light"><?php echo esc_html($address); ?></p>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="row no-gutter">
                                <div class="col-lg-4">
                                    <div class="pxp-sp-top-price mt-3 mt-md-0">
                                        <?php if ($currency_pos == 'before') {
                                            icl_register_string("resideo",$currency,$currency);
                                            echo esc_html($currency) . esc_html($price) . ' <span>' . esc_html($price_label) . '</span>';
                                        } else {
                                            echo esc_html($price) ." ". pll__($currency) . '</span>';
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="pxp-sp-top-feat mt-3 mt-md-0">
                                      <div style="font-size: 15px;">
                                        <?php if ($beds != '') { ?>
                                            <?php echo esc_html($beds); ?>&nbsp;<?php echo esc_html($beds_label); ?>&nbsp;|

                                        <?php }
                                        if ($baths != '') { ?>
                                            <?php echo esc_html($baths); ?>&nbsp;<?php echo esc_html($baths_label); ?>&nbsp;|
                                        <?php }
                                        if ($size != '') { ?>
                                            <?php echo esc_html($size); ?>&nbsp;<?php echo esc_html($unit); ?>
                                        <?php } ?>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-lg-4">
                                    <div class="pxp-sp-top-btns mt-2 mt-md-0">
                                    <?php $wishlist = get_user_meta($user->ID, 'property_wishlist', true);
                                    if (!empty($wishlist)) {
                                        if (is_user_logged_in()) {
                                            print '<input type="hidden" id="pxp-sp-top-uid" value="' . esc_attr($user->ID) . '">';

                                            if (in_array($prop_id, $wishlist) === false) {
                                                print '<a href="javascript:void(0);" class="pxp-sp-top-btn" id="pxp-sp-top-btn-save" style="display: none"><span class="fa fa-star-o"></span> ' . esc_html__('Save', 'resideo') . '</a>';
                                            } else {
                                                print '<a href="javascript:void(0);" class="pxp-sp-top-btn pxp-is-saved" id="pxp-sp-top-btn-save" style="display: none"><span class="fa fa-star"></span> ' . esc_html__('Saved', 'resideo') . '</a>';
                                            }
                                        } else {
                                            print '<a href="javascript:void(0);" data-toggle="modal" data-target="#pxp-signin-modal" class="pxp-sp-top-btn"><span class="fa fa-star-o"></span> ' . esc_html__('Save', 'resideo') . '</a>';
                                        }
                                    } else {
                                        if (is_user_logged_in()) {
                                            print '<input type="hidden" id="pxp-sp-top-uid" value="' . esc_attr($user->ID) . '">';
                                            print '<a href="javascript:void(0);" class="pxp-sp-top-btn" id="pxp-sp-top-btn-save" style="display: none"><span class="fa fa-star-o"></span> ' . esc_html__('Save', 'resideo') . '</a>';
                                        } else {
                                            print '<a href="javascript:void(0);" data-toggle="modal" data-target="#pxp-signin-modal" class="pxp-sp-top-btn"><span class="fa fa-star-o"></span> ' . esc_html__('Save', 'resideo') . '</a>';
                                        }
                                    }
                                    wp_nonce_field('wishlist_ajax_nonce', 'pxp-single-property-save-security', true); 
                                    
                                    if (function_exists('resideo_get_share_menu')) {
                                        if (is_rtl()) {
                                            resideo_get_share_menu($prop_id, 'left');
                                        } else {
                                            resideo_get_share_menu($prop_id);
                                        }
                                    } ?>

                                    <?php if ($show_print != '' || $show_report != '') { ?>
                                        <div class="dropdown">
                                            <a class="pxp-sp-top-btn" href="javascript:void(0);" role="button" id="moreOptionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-ellipsis-h mx-0"></span></a>
                                            <div class="dropdown-menu <?php echo esc_attr($dropdown_class); ?>" aria-labelledby="moreOptionsDropdown">
                                                <?php if ($show_print != '') { ?>
                                                    <a class="dropdown-item" href="javascript:void(0);" id="pxp-print-property" data-id="<?php echo esc_attr($prop_id); ?>">
                                                        <span class="fa fa-print"></span> <?php esc_html_e('Print listing', 'resideo'); ?>
                                                    </a>
                                                    <?php wp_nonce_field('print_ajax_nonce', 'securityPrintProperty', true); ?>
                                                <?php }
                                                if ($show_report != '' && function_exists('resideo_get_report_property_modal')) {
                                                    $report_modal_info          = array();
                                                    $report_modal_info['link']  = get_permalink($prop_id);
                                                    $report_modal_info['title'] = get_the_title(); ?>

                                                    <a class="dropdown-item" href="#pxp-report-property-modal" data-toggle="modal" data-target="#pxp-report-property-modal">
                                                        <span class="fa fa-flag-o"></span> <?php esc_html_e('Report problem with listing', 'resideo'); ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    <!-- <div class="exterior_interior_tab_btn">
                                        <span class="active" type="interior" style="color: #4D858D;">Interior</span> | 
                                        <span class="" type="exterior" style="color: #4D858D;">Exterior</span>
                                    </div> -->

                                </div>
                            </div>

                            
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php } ?>

        <?php if ($photos[0] != '') {
            $has_four = false;

            switch (count($photos)) {
                case 1:
                    $first_fig_class = 'pxp-is-full';
                    $fig_class = '';
                    break;
                case 2:
                    $first_fig_class = 'pxp-is-half';
                    $fig_class = 'pxp-is-half';
                    break;
                case 3:
                    $first_fig_class = 'pxp-is-half';
                    $fig_class = 'pxp-is-third';
                    break;
                case 4:
                    $first_fig_class = 'pxp-is-half';
                    $fig_class = 'pxp-is-third';
                    $has_four = true;
                    break;
                default:
                    $first_fig_class = 'pxp-is-half';
                    $fig_class = '';
                    break;
            } ?>
            <div class="pxp-single-property-gallery-container <?php echo esc_attr($gallery_class); ?>">
                <!-- interior_gallery -->
                <div class="pxp-single-property-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                    <?php 
                    for ($i = 0; $i < count($photos); $i++) {
                        $p_photo_full = wp_get_attachment_image_src($photos[$i], 'pxp-full');
                        $p_photo_gallery = wp_get_attachment_image_src($photos[$i], 'pxp-gallery');
                        $p_photo_info = resideo_get_attachment($photos[$i]);

                        if ($i == 0 || $fig_class == 'pxp-is-half') {
                            $thmb_photo = $p_photo_full;
                        } else {
                            $thmb_photo = $p_photo_gallery;
                        }

                        if ($has_four === true && ($i == 2 || $i == 3)) {
                            $fig_class = '';
                        }

                        $d_none = $i > 4 ? 'd-none' : ''; ?>

                        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="<?php if ($i == 0) echo esc_attr($first_fig_class); else echo esc_attr($fig_class); ?> <?php echo esc_attr($d_none); ?>">
                            <a href="<?php echo esc_url($p_photo_full[0]); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr($p_photo_full[1]); ?>x<?php echo esc_attr($p_photo_full[2]); ?>" class="pxp-cover" style="background-image: url(<?php echo esc_url($thmb_photo[0]); ?>);"></a>
                            <figcaption itemprop="caption description"><?php echo esc_html($p_photo_info['caption']); ?></figcaption>
                        </figure>
                        <?php 
                    }

                    $property_id = get_the_ID();
                    $e_gallery = get_field("exterior_gallery");
                    if(is_array($e_gallery) && count($e_gallery) > 0){
                        for ($i = 0; $i < count($e_gallery); $i++) {
                            $p_photo_full = wp_get_attachment_image_src($e_gallery[$i], 'pxp-full');
                            $p_photo_gallery = wp_get_attachment_image_src($e_gallery[$i], 'pxp-gallery');
                            $p_photo_info = resideo_get_attachment($e_gallery[$i]);

                            if ($i == 0 || $fig_class == 'pxp-is-half') {
                                $thmb_photo = $p_photo_full;
                            } else {
                                $thmb_photo = $p_photo_gallery;
                            }

                            if ($has_four === true && ($i == 2 || $i == 3)) {
                                $fig_class = '';
                            }

                            $d_none = $i > 4 ? 'd-none' : ''; ?>

                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="<?php if ($i == 0) echo esc_attr($first_fig_class); else echo esc_attr($fig_class); ?> <?php echo esc_attr($d_none); ?>" style="display: none;">
                                <a href="<?php echo esc_url($p_photo_full[0]); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr($p_photo_full[1]); ?>x<?php echo esc_attr($p_photo_full[2]); ?>" class="pxp-cover" style="background-image: url(<?php echo esc_url($thmb_photo[0]); ?>);"></a>
                                <figcaption itemprop="caption description"><?php echo esc_html($p_photo_info['caption']); ?></figcaption>
                            </figure>
                            <?php 
                        } 
                    }
                    ?>
                </div>
            </div>
        <?php } ?>

        <?php if ($top_element == 'gallery') { ?>
            <div class="mt-100">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <h2 class="pxp-sp-top-title"><?php the_title(); ?></h2>
                            <p class="pxp-sp-top-address pxp-text-light"><?php echo esc_html($address); ?></p>
                        </div>
                        <div class="col-sm-12 col-md-7">

                            
                            
                            <div class="pxp-sp-top-feat mt-3 mt-md-0">
                                <?php if ($beds != '') { ?>
                                    <div><?php echo esc_html($beds); ?> <span><?php echo esc_html($beds_label); ?></span></div>
                                <?php }
                                if ($baths != '') { ?>
                                    <div><?php echo esc_html($baths); ?> <span><?php echo esc_html($baths_label); ?></span></div>
                                <?php }
                                if ($size != '') { ?>
                                    <div><?php echo esc_html($size); ?> <span><?php echo esc_html($unit); ?></span></div>
                                <?php } ?>
                            </div>
                            <div class="pxp-sp-top-price mt-3 mt-md-0">
                                <?php if ($currency_pos == 'before') {
                                    echo esc_html($currency) . esc_html($price) . ' <span>' . esc_html($price_label) . '</span>';
                                } else {
                                    echo esc_html($price) . esc_html($currency) . ' <span>' . esc_html($price_label) . '</span>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="container mt-100">
            <div class="row">
                <div class="col-lg-8">
                    <?php 
                    $count_sections = 0;
                    $more_details = get_field("more_details",$prop_id);
                    foreach ($sections as $key => $value) {
                        $section_margin_class = $count_sections == 0 ? '' : 'mt-4 mt-md-5';
                        switch ($key) {
                            case 'key_details': ?>
                                <div class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                    <h3><?php echo pll__( "Key Details" ); ?></h3>
                                    <div class="row mt-3 mt-md-4">
                                        <?php if ($status) { ?>
                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php echo pll__( "Status" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value">
                                                    <?php 
                                                        $nmaeget = $status[0]->name;
                                                        icl_register_string("resideo", $nmaeget,$nmaeget);
                                                        echo pll__( $nmaeget ); 
                                                    ?>
                                                </div>
                                                </div>
                                            </div>
                                        <?php }

                                        if ($type) { ?>
                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php echo pll__( "Type" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value">
                                                    <?php 
                                                        $gettype = $type[0]->name; 
                                                        icl_register_string("resideo", $gettype,$gettype);
                                                        echo pll__( $gettype );
                                                    ?>
                                                </div>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($size) { ?>
                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php echo pll__( "Buildup area" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value"><?php if ($size != '') { ?>
                                                        <?php echo $more_details['buildup_area']; ?><?php //echo esc_html($unit); ?>
                                                    <?php }?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php echo pll__( "Land Area" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value">
                                                        <?php echo $more_details['land_area']; ?><?php //echo esc_html($unit); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($beds) { ?>
                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php  echo pll__( "Bedrooms" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value"><?php if ($beds != '') { ?>
                                                        <?php echo esc_html($beds); ?>
                                                    <?php }?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($baths) { ?>
                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php  echo pll__( "Bathrooms" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value"><?php if ($baths != '') { ?>
                                                        <?php echo esc_html($baths); ?>
                                                    <?php }?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>


                                            <?php 
                                            if($more_details['floors_total']!="")
                                            {
                                            
                                            ?>


                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php  echo pll__( "Floors" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value"><?php echo $more_details['floors_total']; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            }
                                            ?>

                                            <?php 
                                            if($more_details['garage_count']!="")
                                            {
                                            
                                            ?>
                                            <div class="col-sm-6">
                                                <div class="pxp-sp-key-details-item">
                                                    <div class="pxp-sp-kd-item-label text-uppercase"><?php echo pll__( "Garages" ); ?></div>
                                                    <div class="pxp-sp-kd-item-value"><?php echo $more_details['garage_count']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>


                                        <?php 
                                        

                                        if (is_array($custom_fields_settings)) {
                                            uasort($custom_fields_settings, "resideo_compare_position");

                                            foreach ($custom_fields_settings as $key => $value) {
                                                $cf_label = $value['label'];
                                                if (function_exists('icl_translate')) {
                                                    $cf_label = icl_translate('resideo', 'resideo_property_field_' . $value['label'], $value['label']);
                                                }

                                                $field_value = get_post_meta($prop_id, $key, true);

                                                if ($field_value != '') { ?>
                                                    <div class="col-sm-6" style="display: none;">
                                                        <div class="pxp-sp-key-details-item">
                                                            <?php if ($value['type'] == 'list_field') {
                                                                $list = explode(',', $value['list']); ?>
                                                                <div class="pxp-sp-kd-item-label text-uppercase"><?php echo esc_html($cf_label); ?></div>
                                                                <div class="pxp-sp-kd-item-value"><?php echo esc_html($list[$field_value]); ?></div>
                                                            <?php } else { ?>
                                                                <div class="pxp-sp-kd-item-label text-uppercase"><?php echo esc_html($cf_label); ?></div>
                                                                <div class="pxp-sp-kd-item-value"><?php echo esc_html($field_value); ?></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php }

                                            }
                                        } ?>
                                    </div>
                                </div>
                                <?php $count_sections++;
                            break;

                            case 'overview':?>
                                <?php if ($overview != '') { ?>
                                    <div id="overview" class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                        <h3>
                                            <a href1="#overview2" href="javascript:void(0);" class="property_section_h3 tab_seleted" ><?php echo pll__( "OVERVIEW" ); ?></a>  &nbsp; |  &nbsp; 
                                            <a href1="#interior" href="javascript:void(0);" class="property_section_h3 " ><?php echo pll__( "INTERIOR" ); ?></a>  &nbsp; | &nbsp;  
                                            <a href1="#exterior" href="javascript:void(0);" class="property_section_h3 "><?php echo pll__( "EXTERIOR" ); ?></a>
                                        </h3>
                                        <div class="mt-3 mt-md-4 intro_text_5" id="overview2" >
                                            
                                            <?php echo get_field('overview_text'); ?>
                                        </div>

                                        <div class="mt-3 mt-md-4 intro_text_5" id="interior" style="display: none;">
                                            
                                            <?php echo get_field('interior_text'); ?>
                                        </div>
                                        <div class="mt-3 mt-md-4 intro_text_5" id="exterior" style="display: none;">
                                            
                                            <?php echo get_field('exterior_text'); ?>
                                        </div>
                                    </div>
                                    <?php $count_sections++;
                                }
                         
                            break;

                            case 'amenities':
                                if ($amenities_count > 0) { ?>
                                    <div class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                        <h3><?php echo pll__( "Amenities" ); ?></h3>
                                        <div class="row mt-3 mt-md-4">
                                            <?php if (is_array($amenities_settings) && count($amenities_settings) > 0) {
                                                uasort($amenities_settings, "resideo_compare_position");
            
                                                foreach ($amenities_settings as $key => $value) {
                                                    $am_label = $value['label'];
                                                    if (function_exists('icl_translate')) {
                                                        $am_label = icl_translate('resideo', 'resideo_property_amenity_' . $value['label'], $value['label']);
                                                    }
                                                    //echo $am_label;
                                                    
                                                    if (get_post_meta($prop_id, $key, true) == 1) { ?>
                                                        <div class="col-sm-6 col-lg-4">
                                                            <div class="pxp-sp-amenities-item"><span class="<?php echo esc_attr($value['icon']); ?>"></span> <?php echo esc_html($am_label); ?></div>
                                                        </div>
                                                    <?php }
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                    <?php $count_sections++;
                                }
                            break;


                            default:
                                // Nothing to do here
                            break;
                        }
                    } ?>
                </div>

                <div class="col-lg-4">
                    <div class="addition_info">
                        <div class="addition_info_f">
                            <h2 class="text-uppercase">
                                <?php 
                                    $getheading = get_option('information_heading');
                                    icl_register_string("resideo", $getheading,$getheading);
                                    echo pll__( $getheading );
                                    // echo __(get_option('information_heading'),'resideo'); 
                                ?>
                            </h2>
                            <?php
                            if ( $agent_id > 0 && !empty(get_option('phone_number')) or 1 ) { ?>
                                <div class="mt-lg-4"> 
                                    <a href="tel:<?php echo get_option('phone_number'); ?>" class="call_div ">
                                        <?php echo pll__( "Give us call on" ); ?> <i class="fa fa-phone"></i> <?php echo get_option('phone_number'); ?>
                                    </a>
                                </div>
                                <div class="pxp-primary-cta text-uppercase mt-2 mt-md-2 mt-lg-4 "> 
                                    <?php 
                                        $getctabtntxt = get_option('cta_btn_text');
                                        icl_register_string("resideo", $getctabtntxt,$getctabtntxt);
                                        echo pll__( $getctabtntxt );
                                        // echo __(get_option('cta_btn_text'),'resideo'); 
                                    ?> 
                                </div>
                                <?php
                            } ?>
                            <p class="more_info"> 
                                <?php 
                                    $getinfodescreption = get_option('informative_desc');
                                    icl_register_string("resideo", $getinfodescreption,$getinfodescreption);
                                    echo pll__( $getinfodescreption );
                                    // echo __(get_option('informative_desc'),'resideo');
                                ?> 
                            </p>
                        </div>
                        <div class="addition_info_s">
                            <h2 class="text-uppercase">
                                <?php 
                                    //echo __(get_option('material_heading'),'resideo');
                                    $materialheading = get_option('material_heading');
                                    icl_register_string("resideo", $materialheading,$materialheading);
                                    echo pll__( $materialheading );
                                ?> 
                            </h2>
                            <div class="row iconss_wrapper addition_info_1">
                            <?php if(get_field('info_pack_text')) { ?>
                                <div class="col-md-4 first_col">
                                    <a href="<?php if(get_field('info_pack')){echo  get_field('info_pack');}else{echo " # ";}?>" style="text-decoration: none;">
                                        <div class="icon_wrapper single_property_icon"> <img src="<?php echo get_template_directory_uri(); ?>/images/Group 895.png"> </div>
                                        <div class="title_t"> <img src="<?php echo get_template_directory_uri();?>/images/ic_file_download.png" class="download_icon"> <span style="font-size: 13px;">
                                        <?php 
                                            // echo  get_field('info_pack_text');
                                            $getinfopacktxt = get_field('info_pack_text');
                                            icl_register_string("resideo", $getinfopacktxt,$getinfopacktxt);
                                            echo pll__( $getinfopacktxt );
                                        ?>
                                        </span> </div>
                                    </a>
                                </div>
                                <?php 
                            }
                            if(get_field('info_plan_text')) { ?>
                                <div class="col-md-4 second_col">
                                    <a href="<?php if(get_field('info_plans')){echo  get_field('info_plans');}else{echo " # ";}?>" style="text-decoration: none;">
                                        <div class="icon_wrapper single_property_icon"> <img src="<?php echo get_template_directory_uri()?>/images/Group 888.png"> </div>
                                        <div class="title_t"> <img src="<?php echo get_template_directory_uri();?>/images/ic_file_download.png" class="download_icon"> <span style="font-size: 13px;"><?php echo  get_field('info_plan_text');?></span> </div>
                                    </a>
                                </div>
                                <?php 
                            }
                            if(get_field('payment_plan_text')) { ?>
                                <div class="col-md-4 third_col">
                                    <a href="<?php if(get_field('payment_plan')){echo  get_field('payment_plan');}else{echo " # ";}?>" style="text-decoration: none;">
                                        <div class="icon_wrapper single_property_icon"> <img src="<?php echo get_template_directory_uri()?>/images/Group 892.png"> </div>
                                        <div class="title_t"> <img src="<?php echo get_template_directory_uri();?>/images/ic_file_download.png" class="download_icon"> <span style="font-size: 13px;"><?php echo  get_field('payment_plan_text');?></span> </div>
                                    </a>
                                </div>
                                <?php 
                            } ?>
                            </div>
                            <?php 
                                            //if ($agent_id > 0 && !empty($agent_email) or 1) { ?>
                                <!--<div class="row before_box"> <?php echo get_option('material_desc'); ?> </div>
                                <div class="subscribe_box">
                                    <div class="input-group">
                                        <input type="email" class="form-control request_box user_email" placeholder="Enter your email">
                                        <input type="hidden" class="property_id" value="<?php echo get_the_ID()?>"> <span class="input-group-btn">
                                                         <button class="btn btn-warning request_button" agent_email="zeeshangill11@gmail.com<?php //echo $agent_email; ?>" type="button">Request</button>
                                                         </span> </div>
                                </div>
                                <div class="img_loader" style="text-align: center; padding-top: 10px; display: none;"> <img src="https://wordpress-823234-2829680.cloudwaysapps.com/wp-content/plugins/resideo-plugin/images/loader-dark.svg" class="pxp-loader pxp-is-btn" alt="..."> </div>
                        </div>-->
                        <?php
                                           // } ?>
                    </div>

                    <?php if ($agent_id != '') { 
                                    $agent_avatar       = get_post_meta($agent_id, 'agent_avatar', true);
                                    $agent_avatar_photo = wp_get_attachment_image_src($agent_avatar, 'pxp-thmb');

                                    if ($agent_avatar_photo != '') {
                                        $a_photo = $agent_avatar_photo[0];
                                    } else {
                                        $a_photo = RESIDEO_LOCATION . '/images/avatar-default.png';
                                    }

                                    $show_rating = isset($general_settings['resideo_agents_rating_field']) ? $general_settings['resideo_agents_rating_field'] : '';
                                    $hide_phone = isset($appearance_settings['resideo_hide_agents_phone_field']) ? $appearance_settings['resideo_hide_agents_phone_field'] : '';

                                    $agent_email = get_post_meta($agent_id, 'agent_email', true);
                                    $agent_phone = get_post_meta($agent_id, 'agent_phone', true); ?>
                <div class="pxp-single-property-section pxp-sp-agent-section mt-4 mt-md-5 mt-lg-0" style="display:none">
                    <h3><?php echo pll__( "Term" ); ?></h3>
                    <div class="pxp-sp-agent mt-3 mt-md-4">
                        <a href="<?php echo esc_url(get_permalink($agent_id)); ?>" class="pxp-sp-agent-fig pxp-cover rounded-lg" style="background-image: url(<?php echo esc_attr($a_photo); ?>);"></a>
                        <div class="pxp-sp-agent-info">
                            <div class="pxp-sp-agent-info-name"><a href="<?php echo esc_url(get_permalink($agent_id)); ?>"><?php echo esc_attr($agent->post_title); ?></a></div>
                            <?php if ($show_rating != '') {
                                                    print resideo_display_agent_rating(resideo_get_agent_ratings($agent_id), false, 'pxp-sp-agent-info-rating');
                                                }

                                                if ($agent_email != '') { ?>
                                <div class="pxp-sp-agent-info-email">
                                    <a href="mailto:<?php echo esc_attr($agent_email); ?>">
                                        <?php echo esc_html($agent_email); ?>
                                    </a>
                                </div>
                                <?php }

                                                if ($agent_phone != '') { 
                                                    if ($hide_phone != '') { ?>
                                    <div class="pxp-sp-agent-info-show-phone" data-phone="<?php echo esc_attr($agent_phone); ?>"><span class="fa fa-phone"></span> <span class="pxp-is-number"><?php esc_html_e('Show phone number', 'resideo'); ?></span></div>
                                    <?php } else { ?>
                                        <div class="pxp-sp-agent-info-phone"><span class="fa fa-phone"></span>
                                            <?php echo esc_html($agent_phone); ?>
                                        </div>
                                        <?php }
                                                } ?>
                        </div>
                        <div class="clearfix"></div>
                        <?php if (function_exists('resideo_get_contact_agent_modal')) {
                                                $modal_info                   = array();
                                                $modal_info['link']           = get_permalink($prop_id);
                                                $modal_info['title']          = get_the_title();
                                                $modal_info['agent_email']    = $agent_email;
                                                $modal_info['agent_id']       = $agent_id;
                                                $modal_info['agent']          = $agent->post_title;
                                                $modal_info['user_id']        = '';
                                                $modal_info['user_email']     = '';
                                                $modal_info['user_firstname'] = '';
                                                $modal_info['user_lastname']  = '';

                                                if (is_user_logged_in()) {
                                                    $user_meta                    = get_user_meta($user->ID);
                                                    $modal_info['user_id']        = $user->ID;
                                                    $modal_info['user_email']     = $user->user_email;
                                                    $user_firstname               = $user_meta['first_name'];
                                                    $user_lastname                = $user_meta['last_name'];
                                                    $modal_info['user_firstname'] = $user_firstname[0];
                                                    $modal_info['user_lastname']  = $user_lastname[0];
                                                }

                                                $cta_is_sticky = isset($appearance_settings['resideo_sticky_agent_cta_field']) ? $appearance_settings['resideo_sticky_agent_cta_field'] : false;
                                                $cta_sticky_class = $cta_is_sticky == '1' ? 'pxp-is-sticky' : ''; ?>
                            <div class="pxp-sp-agent-btns mt-3 mt-md-4"> <a href="#pxp-contact-agent" class="pxp-sp-agent-btn-main <?php echo esc_attr($cta_sticky_class); ?>" data-toggle="modal" data-target="#pxp-contact-agent"><span class="fa fa-envelope-o"></span><?php esc_html_e('Contact Agent', 'resideo'); ?></a> </div>
                            <?php } ?>
                    </div>
                </div>
                <?php } ?>
                </div>
            </div>


             </div>



        </div>





        <div class="map_section mt-100">
            <div class="container " >
                <div class="row">
                    <div class="col-lg-8">

                        <?php $count_sections = 0;
                        foreach ($sections as $key => $value) {
                            $section_margin_class = $count_sections == 0 ? '' : 'mt-4 mt-md-5';
                            switch ($key) {
                               

                            

                                case 'explore_area':
                                    // https://maps.google.com/?q=<lat>,<lng>prop_lat

                                    if (wp_script_is('gmaps', 'enqueued')) { ?>
                                        <div class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h4 style="color:#4D858D; font-size:21px; font-weight: bold;">
                                                        <?php echo pll__( "LOCATION" ); ?>
                                                            
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a class="pxp-primary-cta pull-right" target="_blank" href="https://maps.google.com/?q=<?php echo $prop_lat.','.$prop_lng.'';?>"
                                                     style="color:#fff;"><?php echo pll__( "View on google maps" ); ?></a>
                                                </div>
                                            </div>
                                            <!-- <div class="pxp-sp-pois-nav mt-3 mt-md-4">
                                                <div class="pxp-sp-pois-nav-transportation text-uppercase"><?php esc_html_e('Transportation', 'resideo'); ?></div>
                                                <div class="pxp-sp-pois-nav-restaurants text-uppercase"><?php esc_html_e('Restaurants', 'resideo'); ?></div>
                                                <div class="pxp-sp-pois-nav-shopping text-uppercase"><?php esc_html_e('Shopping', 'resideo'); ?></div>
                                                <div class="pxp-sp-pois-nav-cafes text-uppercase"><?php esc_html_e('Cafes & Bars', 'resideo'); ?></div>
                                                <div class="pxp-sp-pois-nav-arts text-uppercase"><?php esc_html_e('Arts & Entertainment', 'resideo'); ?></div>
                                                <div class="pxp-sp-pois-nav-fitness text-uppercase"><?php esc_html_e('Fitness', 'resideo'); ?></div>
                                            </div> -->
                                            <div id="pxp-sp-map" class="mt-3"></div>
                                        </div>
                                        <?php $count_sections++;
                                    }
                                break;

                               

                                default:
                                    // Nothing to do here
                                break;
                            }
                        } ?>

                    </div>
                </div>
            </div>
        </div>



       




















        <div class="container mt-100">

            <div class="row">
                <div class="col-lg-8">
                    <?php $count_sections = 0;
                    foreach ($sections as $key => $value) {
                        $section_margin_class = $count_sections == 0 ? '' : 'mt-4 mt-md-5';
                        switch ($key) {
                           

                            case 'video':
                                if ($video != '') {
                                    if (function_exists('resideo_get_property_video')) { ?>
                                        <div class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                            <h3><?php esc_html_e('Video', 'resideo'); ?></h3>
                                            <div class="mt-3 mt-md-4">
                                                <?php resideo_get_property_video($video); ?>
                                            </div>
                                        </div>
                                        <?php $count_sections++;
                                    }
                                }
                            break;

                            case 'virtual_tour':
                                if ($virtual_tour != '') {
                                    if (function_exists('resideo_get_property_virtual_tour')) { ?>
                                        <div class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                            <h3><?php esc_html_e('Virtual Tour', 'resideo'); ?></h3>
                                            <div class="mt-3 mt-md-4">
                                                <?php resideo_get_property_virtual_tour($virtual_tour); ?>
                                            </div>
                                        </div>
                                        <?php $count_sections++;
                                    }
                                }
                            break;

                            case 'floor_plans':
                            //oxygensoft
                                $floor_plans_list = array();

                                if ($floor_plans != '') {
                                    $floor_plans_data = json_decode(urldecode($floor_plans));

                                    if (isset($floor_plans_data)) {
                                        $floor_plans_list = $floor_plans_data->plans;
                                    }
                                }

                                if (count($floor_plans_list) > 0) { ?>
                                    <div class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                        <h3 style="color: #4D858D;"><?php echo pll__( "Floor Plans" ); ?></h3>
                                        <div class="row ">
                                            <div class="col-lg-6">
                                                <ul class="nav nav-pills">
                                                    <?php 
                                                    $t=0;
                                                    
                                                    foreach ($floor_plans_list as $key=>$floor_plan) 
                                                    {
                                                        $t++;$class_='';if($t==1){$class_="active";}
                                                    ?>
                                                  <li class="nav-item padding_fix" >
                                                    <a class="nav-link nav-link show_img <?php echo $class_;?>" data-toggle="pill" aria-current="ss<?php echo $key; ?>" href="#ss<?php echo $key; ?>" style=" background-color: #none; color: #4D858D">
                                                        <?php 
                                                            // echo esc_attr($floor_plan->title); 
                                                            $getfloortitle = $floor_plan->title;
                                                            icl_register_string("resideo", $getfloortitle,$getfloortitle);
                                                            echo pll__( $getfloortitle );
                                                        ?>
                                                    </a>
                                                  </li>
                                              <?php }?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 detial_area" style="visibility: hidden;">
                                                <div>
                                                <?php echo pll__( "1BR" ); ?> | <?php echo pll__( "2BA" ); ?> | <?php echo pll__( "500 SQF" ); ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 no-gutter">
                                                <button class="pxp-sp-top-btn compare_floor_plan" >
                                                <?php echo pll__( "Compare Floor plans" ); ?></button>
                                            </div>
                                        </div>
                                       
                                        
                                        <div style="padding-bottom: 20px;
                                            margin-bottom: 20px;
                                            border-bottom: 1px solid #E2E2E2;">
                                                
                                            </div>
                                        <div class="tab-content">
                                        <?php foreach ($floor_plans_list as $key=>$floor_plan) {
                                            $floor_plan_image = wp_get_attachment_image_src($floor_plan->image, 'full');
                                            ?>
                                            <div style="<?php if($key==0){}else{echo 'display: none;';}?>" id="ss<?php echo $key; ?>" class="all_img pxpSPFloorPlansItemHeader<?php echo esc_attr($floor_plan->image); ?>" aria-labelledby="pxpSPFloorPlansItemHeader<?php echo esc_attr($floor_plan->image); ?>" data-parent="#pxpFloorPlans">
                                                        <?php if ($floor_plan_image != '') { ?>
                                                            <a href="<?php echo esc_url($floor_plan_image[0]); ?>" target="_blank" >
                                                                <img style="max-width:100% " class="pxp-sp-floor-plans-item-image" src="<?php echo esc_url($floor_plan_image[0]); ?>" alt="<?php echo esc_attr($floor_plan->title); ?>" >
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                        <?php }?>
                                        </div>
                                        
                                        <div class="accordion" id="pxpFloorPlans" style="display: none;">
                                            <?php foreach ($floor_plans_list as $floor_plan) {
                                                $floor_plan_image = wp_get_attachment_image_src($floor_plan->image, 'pxp-full'); ?>

                                                <div class="pxp-sp-floor-plans-item">
                                                    <div class="pxp-sp-floor-plans-item-header" id="pxpSPFloorPlansItemHeader<?php echo esc_attr($floor_plan->image); ?>">
                                                        <div class="pxp-sp-floor-plans-item-trigger collapsed" data-toggle="collapse" data-target="#pxpSPFloorPlansCollapse<?php echo esc_attr($floor_plan->image); ?>" aria-expanded="true" aria-controls="pxpSPFloorPlansCollapse<?php echo esc_attr($floor_plan->image); ?>">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="pxp-sp-floor-plans-item-title"><span class="fa fa-angle-down pxp-is-plus mr-3"></span><span class="fa fa-angle-up pxp-is-minus mr-3"></span><?php echo esc_html($floor_plan->title); ?></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="pxp-sp-floor-plans-item-info">
                                                                        <?php if ($floor_plan->beds != '') { ?>
                                                                            <div class="d-inline-block mr-2"><?php echo esc_html($floor_plan->beds); ?> <span><?php echo esc_html($beds_label); ?></span></div>
                                                                        <?php } ?>
                                                                        <?php if ($floor_plan->baths != '') { ?>
                                                                            <div class="d-inline-block mr-2"><?php echo esc_html($floor_plan->baths); ?> <span><?php echo esc_html($baths_label); ?></span></div>
                                                                        <?php } ?>
                                                                        <?php if ($floor_plan->size != '') { ?>
                                                                            <div class="d-inline-block"><?php echo esc_html($floor_plan->size); ?> <span><?php echo esc_html($unit); ?></span></div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="pxpSPFloorPlansCollapse<?php echo esc_attr($floor_plan->image); ?>" class="collapse" aria-labelledby="pxpSPFloorPlansItemHeader<?php echo esc_attr($floor_plan->image); ?>" data-parent="#pxpFloorPlans">
                                                        <?php if ($floor_plan_image != '') { ?>
                                                            <a href="<?php echo esc_url($floor_plan_image[0]); ?>" target="_blank">
                                                                <img class="pxp-sp-floor-plans-item-image" src="<?php echo esc_url($floor_plan_image[0]); ?>" alt="<?php echo esc_attr($floor_plan->title); ?>">
                                                            </a>
                                                        <?php } ?>
                                                        <p class="mt-3"><?php echo esc_html($floor_plan->description); ?></p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php $count_sections++;
                                }
                            break;

                           

                            case 'payment_calculator':
                                if ($calculator == '1') { ?>
                                   
                                    <div class="pxp-single-property-section <?php echo esc_attr($section_margin_class); ?>">
                                        <h3 style="color: #4D858D"><?php echo pll__( "MORTGAGE CALCULATOR" ); ?></h3>
                                        <div class="pxp-calculator-view mt-3 mt-md-4 mortgage_portion">
                                            <div class="row">
                                                <!--<div class="col-sm-12 col-lg-4 align-self-center">
                                                    <div class="pxp-calculator-chart-container">
                                                        <canvas id="pxp-calculator-chart"></canvas>
                                                        <div class="pxp-calculator-chart-result">
                                                            <div class="pxp-calculator-chart-result-sum"></div>
                                                            <div class="pxp-calculator-chart-result-label"><?php esc_html_e('per month', 'resideo'); ?></div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                               <div class="col-sm-12 col-lg-12 align-self-center mt-3 mt-lg-0">
                                                    <div class="pxp-calculator-data">
                                                        <div class="row justify-content-between">
                                                            <div class="col-8">
                                                                <div class="pxp-calculator-data-label"><span class="fa fa-minus"></span><?php echo pll__( "Monthly Installment" ); ?></div>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <div class="pxp-calculator-data-sum" id="pxp-calculator-data-pi"></div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                   <!-- <div class="pxp-calculator-data">
                                                        <div class="row justify-content-between">
                                                            <div class="col-8">
                                                                <div class="pxp-calculator-data-label"><span class="fa fa-minus"></span><?php esc_html_e('Property Taxes', 'resideo'); ?></div>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <div class="pxp-calculator-data-sum" id="pxp-calculator-data-pt"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pxp-calculator-data">
                                                        <div class="row justify-content-between">
                                                            <div class="col-8">
                                                                <div class="pxp-calculator-data-label"><span class="fa fa-minus"></span><?php esc_html_e('Lorem Ipsem', 'resideo'); ?></div>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <div class="pxp-calculator-data-sum" id="pxp-calculator-data-hd"></div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pxp-calculator-form mt-3 mt-md-4">
                                        <!--     <?php if ($currency_pos == 'before') {
                                                $taxes_value = $currency . money_format('%!.0i', $taxes);
                                                $hoa_dues_value = $currency . money_format('%!.0i', $hoa_dues);
                                                $price_value = $currency . $price;
                                            } else {
                                                $taxes_value = money_format('%!.0i', $taxes) . $currency;
                                                $hoa_dues_value = money_format('%!.0i', $hoa_dues) . $currency;
                                                $price_value = $price . $currency;
                                            } ?>
            
                                            <input type="hidden" id="pxp-calculator-form-property-taxes" value="<?php echo esc_attr($taxes_value); ?>">
                                            <input type="hidden" id="pxp-calculator-form-hoa-dues" value="<?php echo esc_attr($hoa_dues_value); ?>">
                                            <div style="padding-bottom: 5px;
                                            margin-bottom: 5px;">
                                                
                                            </div> -->
                                            <div>
                                                <p><?php echo pll__( "Finance your home with:" ); ?></p>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                                                  <label class="form-check-label" for="inlineRadio1"><?php echo pll__( "Amlak International" ); ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                  <label class="form-check-label" for="inlineRadio2"><?php echo pll__( "Bidaya Home Finance" ); ?></label>
                                                </div>
                                            </div>
                                            <div style="padding-bottom: 20px;
                                            margin-bottom: 20px;
                                            border-bottom: 1px solid #E2E2E2;">
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="pxp-calculator-form-term"><?php echo pll__( "Term" ); ?></label>
                                                        <select class="custom-select" id="pxp-calculator-form-term">
                                                            <option value="20">20 <?php echo pll__( "Years Fixed" ); ?></option>
                                                            <option value="30" selected>30 <?php echo pll__( "Years Fixed" ); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="pxp-calculator-form-interest"><?php echo pll__( "Interest" ); ?></label>
                                                        <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-interest" data-type="percent" readonly="true" value="2.75%">
                                                    </div>
                                                </div>
                                                <?php icl_register_string("resideo", $price_value,$price_value); ?>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="pxp-calculator-form-price"><?php echo pll__( "Home Price" ); ?></label>
                                                        <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-price" data-type="currency" readonly="true" value="<?php echo pll__($price_value); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="row">
                                                         <div class="col-5 col-sm-5 col-md-4">
                                                            <div class="form-group">
                                                                <label for="pxp-calculator-form-down-percentage"><?php echo pll__( "Down Payment" ); ?></label>
                                                                <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-down-percentage" data-type="percent" value="10%">
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-sm-7 col-md-8">
                                                            <div class="form-group">
                                                                <label for="pxp-calculator-form-down-price">&nbsp;</label>
                                                                <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-down-price" data-type="currency" readonly="true" value="">
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                             <?php
                                        $property_disclaimer = get_field('property_disclaimer');
                                        if (!empty($property_disclaimer)){
                                        ?>
                                        <!-- <div class="row mt-1">
                                            <div class="col-lg-12">
                                                <div class="alert alert-warning alert-dismissible in">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <i class="bi-info-circle-fill"></i>
                                                    <strong>Disclaimer: </strong> <?php // echo $property_disclaimer; ?>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row mt-2">
                                            <div class="col-lg-12">
                                                <div class="" style="font-size: 13px;padding: 10px 0;">
                                                    <i class="bi-info-circle-fill"></i>
                                                    <strong><?php echo pll__( "Disclaimer:" ); ?> </strong> <?php 

                                                    if(get_locale()=="ar")
                                                    {
                                                        echo get_option('resideo_new_disclimer_ar'); 
                                                    }
                                                    else
                                                    {
                                                        echo get_option('resideo_new_disclimer');   
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                     <?php (get_locale() == "ar") ? $ct_cta_contact = "/contact-us-ar":$ct_cta_contact = "/contact-us"; ?>
                            <?php (get_locale() == "ar") ? $ct_cta_finance = "/finance-your-home-ar":$ct_cta_finance = "/finance-your-home"; ?>
                                            <div class="mt-2">
                                                <button class="pxp-sp-top-btn" style=" background-color: #af8814; color: #fff; border: 0px solid #af8814"><a href="<?php echo $ct_cta_contact;?>" style="color:#fff;text-decoration:none;"><?php echo pll__( "ASK OUR TEAM FOR HELP" ); ?></a></button>
                                                <button class="pxp-sp-top-btn" style=" background-color: lightgray; color: #fff; border: 0px solid #af8814"><a href="<?php echo $ct_cta_finance;?>" style="color:#fff;text-decoration:none;"><?php echo pll__( "SEE DETAILS" ); ?></a></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $count_sections++;
                                }
                            break;

                            default:
                                // Nothing to do here
                            break;
                        }
                    } ?>
                </div>
            </div>
        </div>

        <?php $show_similar = isset($appearance_settings['resideo_similar_field']) ? $appearance_settings['resideo_similar_field'] : false;

        if ($show_similar) {
            if (function_exists('resideo_get_similar_properties')) {
                resideo_get_similar_properties();
            }
        } ?>

       <!--  <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-1"></div>
                <div class="col-sm-12 col-lg-10">
                    <?php if (comments_open() || get_comments_number()) {
                       // comments_template();
                    } ?>
                </div>
            </div>
        </div> -->
    </div>

    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div> 
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML modal fade   -->
    <div id="compare_floor_plan" class="modal fade "  tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width:100% ; margin-left:1% ;">
            <div class="modal-content" >
                
                <div class="modal-body" style="padding:0px">
                        <button type="button" class="close" data-dismiss="modal" style="padding:15px">
                        <img src="<?php echo esc_url(get_template_directory_uri().'/images/cros_icon.svg');?>" style="width: 20px;">
                            <!-- <i class="fa fa-close" style="font-size:28px;color:#4D858D"></i> -->
                        </button>
                    <style type="text/css">
                        .map_section{
                            background-color: #000;
                            padding-top:25px;
                            padding-bottom: 70px;
                        }
                        .property_section_h3 {
                            color: #18191a47; 
                            text-decoration: none !important;
                            font-weight: 400 !important;
                        }
                        .property_section_h3:hover
                        {
                            color: #4D858D 
                        }
                        .tab_seleted{
                            text-decoration: none !important; 
                            color: #4D858D  !important;
                            font-weight: 600 !important;
                        }

                        .floor_popup_left{
                            background-color: #F3F4F4; 
                            min-height: 400px; 
                            padding-top: 2.5%;
                            padding-right: 2.5%;
                            padding-left: 2.5%;
                        }
                        .floor_popup_left h2{ 
                                font-size: 21px;
                                font-weight: 600;
                                color: #4D858D;
                                padding-top: 25px;
                                max-width: 157px;
                                text-transform: uppercase;
                                padding-bottom: 15px;
                        }
                        .floor_popup_left form select {
                            padding: 6px;
                            height: 45px;
                            width: 100%; 
                            clear: both; 
                            margin-top: 20px; 
                            border: 1px solid grey;
                            min-height: 52px;
                        }
                        .floor_popup_left form select option{
                            background: #4d858d !important;
                            color: white !important;
                        }
                        .floor_image {  }
                        .floor_image .sub{ width: 49%; float:left ; padding-top: 25px; text-align: center; padding-bottom: 25px; }
                        // .floor_image .sub img{  height: 500px; }
                        .floor_image .sub1{   }
                        .floor_image .sub2{  }
                        .floor_image .sub img{  max-width: 100%;}
                        
                        @media screen and (min-width: 980px) {

                            .addition_info{ position: absolute; max-width:388px;  }
                        }
                        .show_img.active{ font-weight: 600; }
                        .compare_floor_plan{
                            float: right; 
                          
                            background-color: #af8814; 
                            color: #fff; 
                            border: 0px solid #af8814;
                            width: 190px;
                        }
                        
                        .pxp-single-property-section { padding-top: 50px ;  }
                        .addition_info{padding-top: 40px;}  
                        .exterior_interior_tab_btn span{
                            font-weight: 400 !important;
                            cursor: pointer;
                            color: #18191a47 !important;
                        }
                        .exterior_interior_tab_btn span:hover{
                            color: #4D858D !important;
                        }
                        .exterior_interior_tab_btn span.active{
                            font-weight: 600 !important;
                            color: #4D858D !important;
                        }

                        @media (min-width: 980px)
                        {
                           
                        }
                        .make_fixed{ position: fixed; top: 100}
                        .addition_info{ max-width: 360px; }
                    </style>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            
                           

                            jQuery(window).scroll(function() {
                              var scrollTop = jQuery(window).scrollTop();
                           
                              scrollTop = scrollTop+70;
                              // console.log(scrollTop);
                              if ( scrollTop > 950  && scrollTop < 3313 ) 
                              { 
                                
                                if(jQuery(window).width()>980)
                                {
                                    if(jQuery(".addition_info").css("position")!="fixed")
                                    {
                                        jQuery(".addition_info").css("position","fixed");
                                         jQuery(".addition_info").css("top","110px");
                                    }
                                    

                                }
                                else
                                {
                                    jQuery(".addition_info").css("position","static");
                                    jQuery(".addition_info").css("top","auto");
                                }
                              }
                              else
                              {
                                jQuery(".addition_info").css("position","absolute");
                                jQuery(".addition_info").css("top","auto");
                              }

                            });


                            /*jQuery(".exterior_interior_tab_btn span").click(function(){
                                if(!jQuery(this).hasClass("active")){
                                    jQuery(".exterior_interior_tab_btn span").removeClass("active")
                                    jQuery(this).addClass("active")
                                    var type = jQuery(this).attr("type")
                                    if(type == "interior"){
                                        jQuery(".interior_gallery").show();
                                        jQuery(".exterior_gallery").hide();
                                    } else if(type == "exterior"){
                                        jQuery(".exterior_gallery").show();
                                        jQuery(".interior_gallery").hide();
                                    }
                                }
                            })*/


                            jQuery("#ss0").css("color", "#4D858D");
                            jQuery("#ss0").click();

                            var selected_img_src     = jQuery("#ss0 img").attr("src");

                            jQuery(".select_floor").val(0);
                            setCookie("project_1",'', 3);
                            setCookie("project_2",'', 3);
                            
                            setTimeout(function (){
                               select_floor_fn(selected_img_src);
                            },500);
                            
                            
                            jQuery(".show_img").on("click",function(){
                                var my_id = jQuery(this).attr('href');
                                var area_ = jQuery(this).attr('aria-current');
                               
                                //jQuery(".show_img").css("color", "#000");
                                jQuery(".all_img").hide();
                                jQuery(my_id).show();
                                jQuery(".show_img").css("color", "#4D858D");


                                /*--------------------------------------------*/
                                var selected_img_src     = jQuery(my_id+" img").attr("src");
                               
                                var clean_index = my_id.split("#ss").join("");
                               
                                jQuery(".select_floor").val(clean_index);
                                setTimeout(function (){
                                   
                                   select_floor_fn(selected_img_src);
                                    
                                },500);
                            });
                            
                            jQuery(".compare_floor_plan").on("click",function (){
                                jQuery("#compare_floor_plan").modal('show');
                            });

                            function select_floor_fn(selected_img_src='')
                            {
                                var h = jQuery(window).height()-150;
                                var selected_img_src2 = selected_img_src;
                                var current_comm = jQuery("#ct_comm_name").val();
                                // jQuery(".floor_image .sub img").css("height",h+"px");
                                var select_f=jQuery(".select_floor").val();
                                jQuery.ajax({
                                    type:"POST",
                                    url:"<?php echo admin_url( 'admin-ajax.php' ); ?>",
                                    data:{
                                        action: "get_floor_images",
                                        select_f:select_f,
                                        selected_img_src:selected_img_src2,
                                        current_comm:current_comm
                                        
                                        
                                    },
                                    success: function(data) {
                                        
                                       var temp = data.split("|^***^|"); 
                                       jQuery(".project_1").html(temp[0]);
                                       jQuery(".project_2").html(temp[1]);

                                       var project_1 = getCookie("project_1");
                                       var project_2 = getCookie("project_2");
                                       if(project_1 != '' && project_1 != undefined){
                                            jQuery('.project_1 option[data_text="'+project_1+'"]').attr("selected","selected");
                                            jQuery('.project_2 option[data_text="'+project_2+'"]').attr("selected","selected");
                                       }
                                       update22();
                                       jQuery(".sub1_inner").show();
                                    }
                                })
                            }

                            jQuery(".select_floor").on("change",function (){
                                /*jQuery(".sub1_inner").hide();
                                jQuery(".sub2_inner").hide();*/
                                select_floor_fn();

                            }); 
                            function update22()
                            {
                                
                                var img         =   jQuery(".project_1 option:selected").attr('value');
                                var project_1   =   jQuery( ".project_1 option:selected" ).text();
                                setCookie("project_1",project_1, 3);
                                if(img!="")
                                {
                                  jQuery(".sub1_inner").show();
                                  jQuery(".sub1 img").attr('src',img);
                                  jQuery(".sub1 h5").html(project_1);   
                                }

                                setTimeout(function (){
                                    var img2        =   jQuery(".project_2 option:selected").attr('value');
                                    var project_2   =   jQuery( ".project_2 option:selected" ).text();
                                    setCookie("project_2",project_2, 3);
                                    if(img2!="")
                                    {
                                      jQuery(".sub2_inner").show();
                                      jQuery(".sub2 img").attr('src',img2);
                                      jQuery(".sub2 h5").html(project_2);   
                                    }
                                },500);
                            }
                            function setCookie(cname, cvalue, exdays) {
                                const d = new Date();
                                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                                let expires = "expires="+ d.toUTCString();
                                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                            }
                            function getCookie(cname) {
                                let name = cname + "=";
                                let ca = document.cookie.split(';');
                                for(let i = 0; i < ca.length; i++) {
                                    let c = ca[i];
                                    while (c.charAt(0) == ' ') {
                                        c = c.substring(1);
                                    }
                                    if (c.indexOf(name) == 0) {
                                        return c.substring(name.length, c.length);
                                    }
                                }
                                return "";
                            }
                            jQuery(".project_1").on("change",function (){ 
                                // setCookie("project_1",jQuery(".project_1 option:selected").text(), 3);
                                update22();
                                jQuery(".sub1_inner").show();
                            });
                            jQuery(".project_2").on("change",function (){ 
                                // setCookie("project_2",jQuery(".project_2 option:selected").text(), 3);
                                update22();
                                jQuery(".sub2_inner").show();
                            }); 

                            jQuery(document).on("click",".property_section_h3",function (){
                                var my_this=jQuery(this);
                                jQuery(".property_section_h3").removeClass("tab_seleted");
                                my_this.addClass("tab_seleted");
                                var id2 = my_this.attr("href1");
                                jQuery(".intro_text_5").hide();
                            
                                jQuery(id2).show();


                            }); 





                              var sticky = jQuery('.sticky');
                              var stickyrStopper = jQuery('.sticky-stopper');
                              if (!!sticky.offset()) { // make sure ".sticky" element exists

                                var generalSidebarHeight = sticky.innerHeight();
                                var stickyTop = sticky.offset().top;
                                var stickOffset = 0;
                                var stickyStopperPosition = stickyrStopper.offset().top;
                                var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
                                var diff = stopPoint + stickOffset;

                                jQuery(window).scroll(function(){ // scroll event
                                  var windowTop = jQuery(window).scrollTop(); // returns number

                                  if (stopPoint < windowTop) {
                                      sticky.css({ position: 'absolute', top: diff });
                                  } else if (stickyTop < windowTop+stickOffset) {
                                      sticky.css({ position: 'fixed', top: stickOffset });
                                  } else {
                                      sticky.css({position: 'absolute', top: 'initial'});
                                  }
                                });

                              }
                          

                            
                           
                        });
                    </script>
                    <div class="row" >
                        <div class="col-md-2 floor_popup_left" >
                            <h2><?php echo pll__( "Compare Floor plans" ); ?></h2>
                            <form>
                                <select class="select_floor">
                                    <option><?php echo pll__( "Select Floor" ); ?></option>
                                    <option value="0"><?php echo pll__( "1st Floor" ); ?></option>
                                    <option value="1"><?php echo pll__( "2nd Floor" ); ?></option>
                                    <option value="2"><?php echo pll__( "3rd Floor" ); ?></option>
                                </select>
                                <select class="project_1">
                                    <option><?php echo pll__( "Select Floor" ); ?></option>
                                </select>
                                <select class="project_2">
                                    <option><?php echo pll__( "Select Floor" ); ?></option>
                                </select>
                                <input type="hidden" name="communityname" id="ct_comm_name" value="<?php echo $current_comm;?>">
                            </form>

                        </div>
                        <div class="col-md-10">
                             
                            <div class="floor_image row">
                                <div class="sub sub1 col-md-6" >
                                    <div class="sub1_inner" style="display:none">
                                        <h5></h5>
                                        <img src="" >
                                    </div>
                                  

                                </div>
                                <div class="sub sub2 col-md-6">
                                    <div class="sub2_inner" style="display:none">
                                        <h5></h5>
                                        <img src="" >
                                    </div>
                                </div>
                                
                            </div>


                        </div>
                        

                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            setInterval(function() {
                var position = jQuery('.pswp.pswp--supports-fs.pswp--open.pswp--notouch.pswp--css_animation.pswp--svg').hasClass('pswp--open');
              //  alert(position);
                if(position == 'absolute'){
                    jQuery('.pswp.pswp--supports-fs.pswp--open.pswp--notouch.pswp--css_animation.pswp--svg').css('position','relative');
                }
            },2000)
            jQuery('.request_button').click(function () {
                var agent_email = jQuery(this).attr('agent_email')
                var user_email = jQuery('.user_email').val()
                var property_id = jQuery('.property_id').val()
                //waiting wali image ko show kar do
               
                
                if(user_email != '' && user_email != undefined){

                    if (IsEmail(user_email)) {
                         jQuery(".img_loader").css("display","block")

                        jQuery.ajax({
                            type:"POST",
                            url:"<?php echo admin_url( 'admin-ajax.php' ); ?>",
                            data:{
                                action: "agent_email_shoot",
                             
                                user_email: user_email,
                                property_id:property_id
                            },
                            success: function(data) {
                                ///yahan hide kar do 
                                jQuery(".img_loader").css("display","none")

                                var response_data = JSON.parse(data)
                                alert(response_data.data);
                            }
                        })
                    } else {
                        alert("Please enter valid email")
                    }
                } else {
                    alert("Please enter your email first.")
                }
                
                
            })
            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)) {
                    return false;
                }else{
                   return true;
                }
            }
        })
    </script>
    <style type="text/css">
        .single_property_icon{
            padding-right: 20px !important;
        }
    </style>

    <?php if (isset($modal_info)) { 
        resideo_get_contact_agent_modal($modal_info);
    }

    if (isset($report_modal_info)) {
        resideo_get_report_property_modal($report_modal_info);
    }
endwhile;
?>