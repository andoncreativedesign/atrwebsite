<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

if (!function_exists('resideo_get_filter_communities_form')):
    function resideo_get_filter_communities_form() {
        $search_submit = resideo_get_search_communities_link();

        $general_settings = get_option('resideo_general_settings');
        $fields_settings = get_option('resideo_prop_fields_settings');

        $status_f        = isset($fields_settings['resideo_p_status_f_field']) ? $fields_settings['resideo_p_status_f_field'] : '';
        $address_f       = isset($fields_settings['resideo_p_address_f_field']) ? $fields_settings['resideo_p_address_f_field'] : '';
        $city_f          = isset($fields_settings['resideo_p_city_f_field']) ? $fields_settings['resideo_p_city_f_field'] : '';
        $neighborhood_f  = isset($fields_settings['resideo_p_neighborhood_f_field']) ? $fields_settings['resideo_p_neighborhood_f_field'] : '';
        $state_f         = isset($fields_settings['resideo_p_state_f_field']) ? $fields_settings['resideo_p_state_f_field'] : '';
        $type_f          = isset($fields_settings['resideo_p_type_f_field']) ? $fields_settings['resideo_p_type_f_field'] : '';
        $price_f         = isset($fields_settings['resideo_p_price_f_field']) ? $fields_settings['resideo_p_price_f_field'] : '';
        $beds_f          = isset($fields_settings['resideo_p_beds_f_field']) ? $fields_settings['resideo_p_beds_f_field'] : '';
        $baths_f         = isset($fields_settings['resideo_p_baths_f_field']) ? $fields_settings['resideo_p_baths_f_field'] : '';
        $size_f          = isset($fields_settings['resideo_p_size_f_field']) ? $fields_settings['resideo_p_size_f_field'] : '';
        $keywords_f      = isset($fields_settings['resideo_p_keywords_f_field']) ? $fields_settings['resideo_p_keywords_f_field'] : '';
        $id_f            = isset($fields_settings['resideo_p_id_f_field']) ? $fields_settings['resideo_p_id_f_field'] : '';
        $amenities_f     = isset($fields_settings['resideo_p_amenities_f_field']) ? $fields_settings['resideo_p_amenities_f_field'] : '';
        $address_type    = isset($fields_settings['resideo_p_address_t_field']) ? $fields_settings['resideo_p_address_t_field'] : '';

        $search_status       = isset($_GET['search_status']) ? sanitize_text_field($_GET['search_status']) : '0';
        $location_selected   = isset($_GET['search_location']) ? sanitize_text_field($_GET['search_location']) : '0';
        $city_term_id        = isset($_GET['city_term_id']) ? $_GET['city_term_id'] : '';
        $search_property_id  = isset($_GET['search_property_id'])?$_GET['search_property_id']:'';

        $search_address      = isset($_GET['search_address']) ? stripslashes(sanitize_text_field($_GET['search_address'])) : '';
        $search_street_no    = isset($_GET['search_street_no']) ? stripslashes(sanitize_text_field($_GET['search_street_no'])) : '';
        $search_street       = isset($_GET['search_street']) ? stripslashes(sanitize_text_field($_GET['search_street'])) : '';
        $search_neighborhood = isset($_GET['search_neighborhood']) ? stripslashes(sanitize_text_field($_GET['search_neighborhood'])) : '';
        $search_city         = isset($_GET['search_city']) ? stripslashes(sanitize_text_field($_GET['search_city'])) : '';
        $search_state        = isset($_GET['search_state']) ? stripslashes(sanitize_text_field($_GET['search_state'])) : '';
        $search_zip          = isset($_GET['search_zip']) ? sanitize_text_field($_GET['search_zip']) : '';
        $search_type         = isset($_GET['search_type']) ? sanitize_text_field($_GET['search_type']) : '0';
        $search_price_min    = isset($_GET['search_price_min']) ? sanitize_text_field($_GET['search_price_min']) : '';
        $search_price_max    = isset($_GET['search_price_max']) ? sanitize_text_field($_GET['search_price_max']) : '';
        $search_beds         = isset($_GET['search_beds']) ? sanitize_text_field($_GET['search_beds']) : 0;
        $search_baths        = isset($_GET['search_baths']) ? sanitize_text_field($_GET['search_baths']) : 0;
        $search_size_min     = isset($_GET['search_size_min']) ? sanitize_text_field($_GET['search_size_min']) : '';
        $search_size_max     = isset($_GET['search_size_max']) ? sanitize_text_field($_GET['search_size_max']) : '';
        $search_keywords     = isset($_GET['search_keywords']) ? stripslashes(sanitize_text_field($_GET['search_keywords'])) : '';
        $search_id           = isset($_GET['search_id']) ? sanitize_text_field($_GET['search_id']) : '';

        $sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest'; ?>
        <style>
            <?php 
            if(get_locale()=="ar")
            {
                ?>  
                .custom-checkbox input[type=checkbox]{ display:none}
                <?php
            }
            ?>
        </style>
    <?php 
     icl_register_string("resideo", 'Min Price','Min Price');
     icl_register_string("resideo", 'Max Price','Max Price');
     icl_register_string("resideo", 'Min Size','Min Size');
     icl_register_string("resideo", 'Max Size','Max Size');
     icl_register_string("resideo", 'No Max','No Max');
     icl_register_string("resideo", 'No Min','No Min');
     icl_register_string("resideo", 'Any','Any');

     
    ?>
        <form class="pxp-results-filter-form " role="search" method="get" action="<?php echo esc_url($search_submit); ?>">
            <input type="hidden" name="sort" id="sort" value="<?php echo esc_attr($sort); ?>" autocomplete="off" />

            <div class="d-flex">
                <div class="pxp-content-side-search-form">
                    <div class="row pxp-content-side-search-form-row">
                        <?php 
                        /**
                         * Address field
                         */
                        if ($address_f == 'yes' || 1) { ?>
                            <div class="col-sm-5 col-md-5 col-lg-5 pxp-content-side-search-form-col">
                                <?php if($address_type == 'auto'  || 1) { 
                                        icl_register_string("resideo", 'Search...','Search...');
                                        icl_register_string("resideo", 'Search city','Search city');
                                         $locations = get_terms( array(
                                            'taxonomy' => 'locations',
                                            'hide_empty' => false,
                                        ) );
                                    ?>
                                    <!--<input type="text" class="form-control pxp-is-address property_city_search" id="filter-address-auto" name="search_address" placeholder="<?php echo pll__('Search by city...'); ?>" autocomplete="off" value="<?php echo esc_attr($search_address); ?>">-->
                                  
                                  <select class="custom-select" id="search_location" name="search_location">
                                    <option value="0"><?php echo pll__('Search city'); ?></option>
                                    <?php foreach($locations as $loc_term) {
                                        $loc_selected = ($loc_term->term_id == $location_selected) ? 'selected="selected"' : ''; 
                                        $loc_term_name = $loc_term->name;
                                        icl_register_string("resideo", $loc_term_name,$loc_term_name);
                                        ?>
                                        <option value="<?php echo esc_attr($loc_term->term_id);?>" <?php echo esc_attr($loc_selected); ?>><?php echo pll__($loc_term_name); ?></option>
                                    <?php } ?>
                                </select>
                                    <!-- <span class="fa fa-search"></span> -->
                                    <input type="hidden" id="city_term_id" name="city_term_id" value="<?php echo $city_term_id; ?>">
                                    <input type="hidden" id="search_property_id" name="search_property_id" value="<?php echo $search_property_id; ?>">
                                    <input type="hidden" id="filter_street_no_field" name="search_street_no" autocomplete="off" value="<?php echo esc_attr($search_street_no); ?>">
                                    <input type="hidden" id="filter_street_field" name="search_street" autocomplete="off" value="<?php echo esc_attr($search_street); ?>">
                                    <input type="hidden" id="filter_neighborhood_field" name="search_neighborhood" autocomplete="off" value="<?php echo esc_attr($search_neighborhood); ?>">
                                    <input type="hidden" id="filter_city_field" name="search_city" autocomplete="off" value="<?php echo esc_attr($search_city); ?>">
                                    <input type="hidden" id="filter_state_field" name="search_state" autocomplete="off" value="<?php echo esc_attr($search_state); ?>">
                                    <input type="hidden" id="filter_zip_field" name="search_zip" autocomplete="off" value="<?php echo esc_attr($search_zip); ?>">
                                <?php } else { ?>
                                    <input type="text" class="form-control pxp-is-address property_city_search" id="search_address" name="search_address" placeholder="<?php esc_attr_e('Address', 'resideo'); ?>" value="<?php echo esc_attr($search_address); ?>">
                                    <input type="hidden" id="city_term_id" name="city_term_id" value="<?php echo $city_term_id; ?>">
                                    <span class="fa fa-search"></span>
                                <?php } ?>
                            </div>
                        <?php }  
                        icl_register_string("resideo", 'or','or');?>  
                        <div class="col-sm-1 col-md-1 col-lg-1 pxp-content-side-search-form-col mb-3 mb-sm-0 text-center search_property_or_btn"> <?php echo pll__("or");?> </div>
                        <?php
                        /**
                         * Status field
                         */
                        if ($status_f == 'yes' || 1) {
                            $locations = get_terms( array(
                            'taxonomy' => 'locations',
                            'hide_empty' => false,
                        ) );
                         
                            $status_tax = array( 
                                'Community'
                            );
                            $status_args = array(
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                                'hide_empty' => false
                            ); 
                            icl_register_string("resideo", 'Select community','Select community');
                            $status_terms = get_terms($status_tax, $status_args); ?>
                            <?php //print_r($status_terms);?>
                            <div class="col-sm-6 col-md-6 col-lg-6 pxp-content-side-search-form-col mb-3 mb-sm-0">
                                <select class="custom-select" id="search_status" name="search_status">
                                    <option value="0"><?php echo pll__('Select community'); ?></option>
                                    <?php foreach($status_terms as $status_term) {
                                        $status_selected = ($status_term->term_id == $search_status) ? 'selected="selected"' : ''; 
                                        $status_term_name = $status_term->name;
                                        icl_register_string("resideo", $status_term_name,$status_term_name);
                                        ?>
                                        <option value="<?php echo esc_attr($status_term->term_id);?>" <?php echo esc_attr($status_selected); ?>><?php echo pll__($status_term_name); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <?php //if(isset($_GET['search_location'])) {?>
                <!-- <div class="d-flex">
                    <a role="button" class="pxp-adv-toggle"><span class="fa fa-sliders"></span></a>
                </div> -->
                <?php // } ?>
            </div>
            <div class="ct_filter_search_btn">
                <?php  icl_register_string("resideo", "REFINE YOUR SEARCH","REFINE YOUR SEARCH");?>
                <a role="button" href="#"><?php echo pll__("REFINE YOUR SEARCH")?></a>
            </div>
            <div class="pxp-content-side-search-form-adv mb-3">
                <div class="row pxp-content-side-search-form-row">
                    <?php
                    /**
                     * City field
                     */
                    if ($city_f == 'yes') {
                        $city_type = isset($fields_settings['resideo_p_city_t_field']) ? $fields_settings['resideo_p_city_t_field'] : '';

                        if (($address_type == 'input' && $address_f == 'yes') ||  $address_f == 'no' || $address_f == '' || $address_type == '') { ?>
                            <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                                <div class="form-group">
                                    <label for="search_city"><?php esc_html_e('City', 'resideo'); ?></label>
                                    <?php if ($city_type == 'list') {
                                        $resideo_cities_settings = get_option('resideo_cities_settings'); ?>

                                        <select class="custom-select" id="search_city" name="search_city">
                                            <option value=""><?php echo pll__('Any');//esc_html_e('Any', 'resideo'); ?></option>
                                            <?php if (is_array($resideo_cities_settings) && count($resideo_cities_settings) > 0) {
                                                uasort($resideo_cities_settings, "resideo_compare_position");

                                                foreach ($resideo_cities_settings as $key => $value) {
                                                    $city_selected = ($key == $search_city) ? 'selected="selected"' : ''; ?>
                                                    <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($city_selected); ?>><?php echo esc_html($value['name']); ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    <?php } else { ?>
                                        <input class="form-control" type="text" name="search_city" id="search_city" value="<?php echo esc_attr($search_city); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }
                    }

                    /**
                     * Neighborhood field
                     */
                    if ($neighborhood_f == 'yes') {
                        $neighborhood_type = isset($fields_settings['resideo_p_neighborhood_t_field']) ? $fields_settings['resideo_p_neighborhood_t_field'] : '';

                        if (($address_type == 'input' && $address_f == 'yes') ||  $address_f == 'no' || $address_f == '' || $address_type == '') { ?>
                            <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                                <div class="form-group">
                                    <label for="search_neighborhood"><?php esc_html_e('Neighborhood', 'resideo'); ?></label>
                                    <?php if ($neighborhood_type == 'list') {
                                        $resideo_neighborhoods_settings = get_option('resideo_neighborhoods_settings'); ?>

                                        <select class="custom-select" id="search_neighborhood" name="search_neighborhood">
                                            <option value=""><?php echo pll__('Any');//esc_html_e('Any', 'resideo'); ?></option>
                                            <?php if (is_array($resideo_neighborhoods_settings) && count($resideo_neighborhoods_settings) > 0) {
                                                uasort($resideo_neighborhoods_settings, "resideo_compare_position");

                                                foreach ($resideo_neighborhoods_settings as $key => $value) {
                                                    $neighborhood_selected = ($key == $search_neighborhood) ? 'selected="selected"' : ''; ?>
                                                    <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($neighborhood_selected); ?>><?php echo esc_html($value['name']); ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    <?php } else { ?>
                                        <input class="form-control" type="text" name="search_neighborhood" id="search_neighborhood" value="<?php echo esc_attr($search_neighborhood); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }
                    }

                    /**
                     * County/State field
                     */
                    if ($state_f == 'yes') {
                        if (($address_type == 'input' && $address_f == 'yes') ||  $address_f == 'no' || $address_f == '' || $address_type == '') { ?>
                            <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                                <div class="form-group">
                                    <label for="search_state"><?php esc_html_e('County/State', 'resideo'); ?></label>
                                    <input class="form-control" type="text" name="search_state" id="search_state" value="<?php echo esc_attr($search_state); ?>">
                                </div>
                            </div>
                        <?php }
                    }

                    /**
                    * Type field
                    */
                    if ($type_f == 'yes') {
                        $type_tax = array( 
                            'property_type'
                        );
                        $type_args = array(
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => false
                        ); 
                        $type_terms = get_terms($type_tax, $type_args); ?>

                        <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                            <div class="form-group">
                                <label for="search_type"><?php esc_html_e('Completion status', 'resideo'); ?></label>
                                <select class="custom-select" id="search_type" name="search_type">
                                    <option value="0"><?php echo pll__('Any'); //esc_html_e('Any', 'resideo'); ?></option>
                                    <?php foreach ($type_terms as $type_term) {
                                        $type_selected = ($type_term->term_id == $search_type) ? 'selected="selected"' : ''; ?>
                                        <option value="<?php echo esc_attr($type_term->term_id); ?>" <?php echo esc_attr($type_selected); ?>><?php echo esc_html($type_term->name); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } 
                    
                    /**
                     * Beds field
                     */
                    if ($beds_f == 'yes') { ?>
                        <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                            <div class="form-group">
                                <label for="search_beds"><?php echo pll__('Bedrooms');//esc_html_e('Bedrooms', 'resideo'); ?></label>
                                <select class="custom-select" name="search_beds" id="search_beds">
                                    <option value="0"><?php echo pll__('Any'); //esc_html_e('Any', 'resideo'); ?></option>
                                    <option value="1" <?php selected($search_beds, '1'); ?>>1+</option>
                                    <option value="2" <?php selected($search_beds, '2'); ?>>2+</option>
                                    <option value="3" <?php selected($search_beds, '3'); ?>>3+</option>
                                    <option value="4" <?php selected($search_beds, '4'); ?>>4+</option>
                                    <option value="5" <?php selected($search_beds, '5'); ?>>5+</option>
                                </select>
                            </div>
                        </div>
                    <?php } 
                    
                    /**
                     * Baths field
                     */
                    if ($baths_f == 'yes') { ?>
                        <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                            <div class="form-group">
                                <label for="search_baths"><?php echo pll__('Bathrooms');//esc_html_e('Bathrooms', 'resideo'); ?></label>
                                <select class="custom-select" name="search_baths" id="search_baths">
                                    <option value="0"><?php echo pll__('Any'); //esc_html_e('Any', 'resideo'); ?></option>
                                    <option value="1" <?php selected($search_baths, '1'); ?>>1+</option>
                                    <option value="2" <?php selected($search_baths, '2'); ?>>2+</option>
                                    <option value="3" <?php selected($search_baths, '3'); ?>>3+</option>
                                    <option value="4" <?php selected($search_baths, '4'); ?>>4+</option>
                                    <option value="5" <?php selected($search_baths, '5'); ?>>5+</option>
                                </select>
                            </div>
                        </div>
                    <?php }

                    /**
                     * Price field
                     */
                    if ($price_f == 'yes') {
                        $locale       = isset($general_settings['resideo_locale_field']) ? $general_settings['resideo_locale_field'] : '';
                        $currency     = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';
                        $currency_pos = isset($general_settings['resideo_currency_symbol_pos_field']) ? $general_settings['resideo_currency_symbol_pos_field'] : '';
                        $max_price    = isset($general_settings['resideo_max_price_field']) ? intval($general_settings['resideo_max_price_field']) : '';

                        $i = $max_price;
                        $price_array = array($max_price);

                        if ($max_price != '') {
                            while($i >= 200) {
                                $i = round($i / 2, -2);
                                array_unshift($price_array, $i);
                            }
                        }

                        setlocale(LC_MONETARY, $locale); 

                        /**
                     * Size field
                     */
                        if ($size_f == 'yes') {
                        $unit = isset($general_settings['resideo_unit_field']) ? $general_settings['resideo_unit_field'] : ''; ?>

                        <div class="col-sm-6 pxp-content-side-search-form-col">
                            <div class="row pxp-content-side-search-form-row">
                                <div class="col pxp-content-side-search-form-col">
                                    <label for="search_size_min"><?php echo pll__('Min Size');//esc_html_e('Min Size', 'resideo'); ?></label>
                                    <div class="input-group mb-3">
                                        <input type="number" min="0" class="form-control" id="search_size_min" name="search_size_min" value="<?php echo esc_attr($search_size_min); ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><?php echo esc_html($unit); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pxp-content-side-search-form-col">
                                    <label for="search_size_max"><?php echo pll__('Max Size'); //esc_html_e('Max Size', 'resideo'); ?></label>
                                    <div class="input-group mb-3">
                                        <input type="number" min="0" class="form-control" id="search_size_max" name="search_size_max" value="<?php echo esc_attr($search_size_max); ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><?php echo esc_html($unit); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>

                        <!-- <div class="col-sm-6 pxp-content-side-search-form-col">
                            <div class="row pxp-content-side-search-form-row">
                                <div class="col pxp-content-side-search-form-col">
                                    <div class="form-group">
                                        <label for="search_price_min"><?php echo pll__('Min Price'); ?></label>
                                        <select class="custom-select" name="search_price_min" id="search_price_min">
                                            <option value=""><?php echo pll__('No Min');  ?></option>
                                            <?php foreach ($price_array as $price) {
                                                if ($currency_pos == 'after') { ?>
                                                    <option value="<?php echo esc_attr($price); ?>" <?php selected($price, $search_price_min) ?>><?php echo esc_html(money_format('%!.0i', $price)) . pll__($currency); ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo esc_attr($price); ?>" <?php selected($price, $search_price_min) ?>><?php echo pll__($currency) . esc_html(money_format('%!.0i', $price)); ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col pxp-content-side-search-form-col">
                                    <div class="form-group">
                                        <label for="search_price_max"><?php echo pll__('Max Price');  ?></label>
                                        <select class="custom-select" name="search_price_max" id="search_price_max">
                                            <option value=""><?php echo pll__('No Max'); ?></option>
                                            <?php foreach ($price_array as $price) {
                                                if ($currency_pos == 'after') { ?>
                                                    <option value="<?php echo esc_attr($price); ?>" <?php selected($price, $search_price_max) ?>><?php echo esc_html(money_format('%!.0i', $price)) . pll__($currency); ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo esc_attr($price); ?>" <?php selected($price, $search_price_max) ?>><?php echo pll__($currency) . esc_html(money_format('%!.0i', $price)); ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <?php }
                    
                    
                    
                    
                    /**
                     * Keywords field
                     */
                    if ($keywords_f == 'yes') { ?>
                        <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                            <div class="form-group">
                                <label for="search_keywords"><?php esc_html_e('Keywords', 'resideo'); ?></label>
                                <input class="form-control" type="text" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e('Try waterfront, gym, or renovate', 'resideo'); ?>" value="<?php echo esc_attr($search_keywords); ?>">
                            </div>
                        </div>
                    <?php }

                    /**
                     * Property ID field
                     */
                    if ($id_f == 'yes') { ?>
                        <div class="col-sm-6 col-md-3 pxp-content-side-search-form-col">
                            <div class="form-group">
                                <label for="search_id"><?php esc_html_e('Property ID', 'resideo'); ?></label>
                                <input class="form-control" type="text" name="search_id" id="search_id" value="<?php echo esc_attr($search_id); ?>">
                            </div>
                        </div>
                    <?php } 
                    
                    /**
                     * Custom fields field
                     */
                    $custom_fields_settings = get_option('resideo_fields_settings');

                    if (is_array($custom_fields_settings)) {
                        uasort($custom_fields_settings, "resideo_compare_position");

                        foreach ($custom_fields_settings as $key => $value) {
                            if ($value['filter'] == 'yes') {
                                if ($value['type'] == 'date_field') { ?>
                                    <div class="col-sm-6 col-md-3 pxp-content-side-search-form-col">
                                <?php } else if ($value['type'] == 'interval_field') { ?>
                                    <div class="col-sm-6 pxp-content-side-search-form-col">
                                <?php } else { ?>
                                    <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                                <?php }

                                if ($value['type'] == 'interval_field') {
                                    $field_value_min = isset($_GET[$key . '_min']) ? sanitize_text_field($_GET[$key . '_min']) : '';
                                    $field_value_max = isset($_GET[$key . '_max']) ? sanitize_text_field($_GET[$key . '_max']) : '';
                                } else {
                                    $field_value = isset($_GET[$key]) ? sanitize_text_field($_GET[$key]) : '';
                                }

                                switch ($value['type']) {
                                    case 'date_field': ?>
                                        <div class="form-group">
                                            <label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($value['label']); ?></label>
                                            <input type="text" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($key); ?>" class="form-control date-picker" value="<?php echo esc_attr($field_value); ?>" placeholder="<?php esc_attr_e('YYYY-MM-DD', 'resideo'); ?>" />
                                        </div>
                                        <?php break;
                                    case 'list_field':
                                        $list = explode(',', $value['list']); ?>

                                        <div class="form-group">
                                            <label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($value['label']); ?></label>
                                            <select class="custom-select" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($key); ?>">
                                                <option value=""><?php echo pll__('Any'); //esc_html_e('Any', 'resideo'); ?></option>
                                                <?php for ($i = 0; $i < count($list); $i++) { ?>
                                                    <option value="<?php echo esc_attr($i); ?>" <?php selected($field_value, $i) ?>><?php echo esc_html($list[$i]); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php break;
                                    case 'interval_field': ?>
                                        <div class="row pxp-content-side-search-form-row">
                                            <div class="col pxp-content-side-search-form-col">
                                                <div class="form-group">
                                                    <label for="<?php echo esc_attr($key); ?>_min"><?php echo esc_html($value['label']) . ' ' . __('Min', 'resideo'); ?></label>
                                                    <input type="text" name="<?php echo esc_attr($key); ?>_min" id="<?php echo esc_attr($key); ?>_min" class="form-control" value="<?php echo esc_attr($field_value_min); ?>" />
                                                </div>
                                            </div>
                                            <div class="col pxp-content-side-search-form-col">
                                                <div class="form-group">
                                                    <label for="<?php echo esc_attr($key); ?>_max"><?php echo esc_html($value['label']) . ' ' . __('Max', 'resideo'); ?></label>
                                                    <input type="text" name="<?php echo esc_attr($key); ?>_max" id="<?php echo esc_attr($key); ?>_max" class="form-control" value="<?php echo esc_attr($field_value_max); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <?php break;
                                    default: ?>
                                        <div class="form-group">
                                            <label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($value['label']); ?></label>
                                            <input type="text" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($key); ?>" class="form-control" value="<?php echo esc_attr($field_value); ?>" />
                                        </div>
                                        <?php break;
                                } ?>

                                    <input type="hidden" name="<?php echo esc_attr($key); ?>_comparison" id="<?php echo esc_attr($key); ?>_comparison" value="<?php echo esc_attr($value['comparison']); ?>" />
                                </div>
                            <?php }
                        }
                    } ?>
                </div>

                <?php 
                /**
                * Amenities field
                */
                if ($amenities_f == 'yes') {
                    $amenities_settings = get_option('resideo_amenities_settings');

                    if (is_array($amenities_settings) && count($amenities_settings) > 0) {
                        uasort($amenities_settings, "resideo_compare_position"); ?>

                        <div class="form-group">
                            <label class="mb-2"><?php echo pll__('Amenities'); //esc_html_e('Amenities', 'resideo'); ?></label>
                            <div class="row pxp-content-side-search-form-row ct_amenities_search">
                                <?php foreach ($amenities_settings as $key => $value) {
                                    $am_label = $value['label'];

                                    if (function_exists('icl_translate')) {
                                        $am_label = icl_translate('resideo', 'resideo_property_amenity_' . $value['label'], $value['label']);
                                    } ?>

                                    <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox">
                                                <label><input type="checkbox" name="<?php echo esc_attr($key); ?>" value="1" 
                                                    <?php if (isset($_GET[$key]) && $_GET[$key] == 1) { ?>
                                                        checked="checked"
                                                    <?php } ?>
                                                ><span class="fa fa-check"></span> <?php echo esc_html($am_label); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }
                } 
                    icl_register_string('resideo','Apply filters','Apply filters');
                ?>

                <input type="submit" class="pxp-filter-btn" value="<?php echo pll__('Apply filters'); ?>">
            </div>
        </form>
    <?php }
endif;
?>