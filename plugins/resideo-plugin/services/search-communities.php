<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

if (!function_exists('resideo_search_communities')): 
    function resideo_search_communities() {
       
   //check if amenities are set
   $amenities_searched = false;
   if(             
            (isset($_GET['search_beds']) && $_GET['search_beds'] == 0) &&
            (isset($_GET['search_baths']) && $_GET['search_baths'] == 0 ) && 
            (isset($_GET['search_size_min']) && $_GET['search_size_min'] == '') &&
            (isset($_GET['search_size_max']) && $_GET['search_size_max'] == '') &&           
            (isset($_GET['search_price_min']) && $_GET['search_price_min'] == '') &&
            (isset($_GET['search_price_max']) && $_GET['search_price_max'] == '') &&
            (!isset($_GET['majlis'])) &&
            (!isset( $_GET['storage_area'])) &&
            (!isset( $_GET['maid'])) && 
            (!isset( $_GET['garage'])) 
        
    ) {
        $amenities_searched = false;
    }
    else {
        $amenities_searched = true;
    }

        if(!isset($_GET['search_location']) && !isset($_GET['search_status'])) {
            // default page view
            $terms = get_terms( array(
                'taxonomy' => 'Community',
                'hide_empty' => false,
            ) );
        
            // The Loop
            if ( ! empty( $terms ) ) { 
                  return array("communities",$terms,"case1");
            }
        }
        if((isset($_GET['search_location']) && $_GET['search_location']==0 && $_GET['search_status']==0) && $amenities_searched == false)
        {
           //when select location option and select community option is selected  and no amenities are clicked
            $terms = get_terms( array(
                'taxonomy' => 'Community',
                'hide_empty' => false,
            ) );
        
            // The Loop
            if ( ! empty( $terms ) ) { 
                  return array("communities",$terms,"case2");
            }
        }

        if(isset($_GET['search_status']) && $_GET['search_status'] != 0 && $amenities_searched == false) {
            
            $terms = get_terms( array(
                'taxonomy' => 'Community',
                'hide_empty' => false,
                'term_taxonomy_id' => $_GET['search_status'] 
            ) );
           
            // The Loop
            if ( ! empty( $terms ) ) { 
                  return array("communities",$terms,"case4");
            }
        }

        
        if(isset($_GET['search_location']) && $_GET['search_location'] != 0 && $amenities_searched == false) {
            //when location is selected and no amenities are selected, which should load the communties in that location
            $terms = get_terms( array(
                'taxonomy' => 'Community',
                'hide_empty' => false,
                'meta_query' => array(
                    array(
                       'key'       => 'ct_community_location',
                       'value'     => $_GET['search_location'],
                       'compare'   => '='
                    )
                )
            ) );
         
            // The Loop
            if ( ! empty( $terms ) ) { 
                  return array("communities",$terms,"case3");
            }
        }
      
   

       
        // if there are any filters selected it would execute the below code
        // it will fetch the properties first as the filter paramenters are applied to properties only, then 
        // find the commmunities these properties belong to and feature those communities
        // while filtering, the location selected in the dropdown is considered but not the 
        // community selected in the dropdown
        $status       = isset($_GET['search_status']) ? sanitize_text_field($_GET['search_status']) : '0';
        $location       = isset($_GET['search_location']) ? sanitize_text_field($_GET['search_location']) : '0';
        $address      = isset($_GET['search_address']) ? stripslashes(sanitize_text_field($_GET['search_address'])) : '';
        $city_term_id      = isset($_GET['city_term_id']) ? $_GET['city_term_id'] : '';
        $search_property_id      = isset($_GET['search_property_id']) ? $_GET['search_property_id'] : '';
        $street_no    = isset($_GET['search_street_no']) ? stripslashes(sanitize_text_field($_GET['search_street_no'])) : '';
        $street       = isset($_GET['search_street']) ? stripslashes(sanitize_text_field($_GET['search_street'])) : '';
        $neighborhood = isset($_GET['search_neighborhood']) ? stripslashes(sanitize_text_field($_GET['search_neighborhood'])) : '';
        $city         = isset($_GET['search_city']) ? stripslashes(sanitize_text_field($_GET['search_city'])) : '';
        $state        = isset($_GET['search_state']) ? stripslashes(sanitize_text_field($_GET['search_state'])) : '';
        $zip          = isset($_GET['search_zip']) ? sanitize_text_field($_GET['search_zip']) : '';
        $type         = isset($_GET['search_type']) ? sanitize_text_field($_GET['search_type']) : '0';
        $price_min    = isset($_GET['search_price_min']) ? sanitize_text_field($_GET['search_price_min']) : '';
        $price_max    = isset($_GET['search_price_max']) ? sanitize_text_field($_GET['search_price_max']) : '';
        $beds         = isset($_GET['search_beds']) ? sanitize_text_field($_GET['search_beds']) : '';
        $baths        = isset($_GET['search_baths']) ? sanitize_text_field($_GET['search_baths']) : '';
        $size_min     = isset($_GET['search_size_min']) ? sanitize_text_field($_GET['search_size_min']) : '';
        $size_max     = isset($_GET['search_size_max']) ? sanitize_text_field($_GET['search_size_max']) : '';
        $keywords     = isset($_GET['search_keywords']) ? stripslashes(sanitize_text_field($_GET['search_keywords'])) : '';
        $id           = isset($_GET['search_id']) ? sanitize_text_field($_GET['search_id']) : '';

        $featured            = isset($_GET['featured']) ? sanitize_text_field($_GET['featured']) : '';
        $appearance_settings = get_option('resideo_appearance_settings');
        $posts_per_page      = isset($appearance_settings['resideo_properties_per_page_field']) ? $appearance_settings['resideo_properties_per_page_field'] : 10;
        $sort                = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest';

        global $paged;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'posts_per_page' => $posts_per_page,
            'paged'          => $paged,
            's'              => $keywords,
            'post_type'      => 'property',
            'post_status'    => 'publish'
        );

        if ($sort == 'newest') {
            $args['meta_key'] = 'property_featured';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'price_lo') {
            $args['meta_key'] = 'property_price';
            $args['orderby'] = array('meta_value_num' => 'ASC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'price_hi') {
            $args['meta_key'] = 'property_price';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'beds') {
            $args['meta_key'] = 'property_beds';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'baths') {
            $args['meta_key'] = 'property_baths';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'size') {
            $args['meta_key'] = 'property_size';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        }

        if ($id != '') {
            $args['p'] = $id;
        }

        $args['tax_query'] = array('relation' => 'AND');
       
        // No neeed to check the community id as we are filtering with other fields, so we neeed to fetch all the communities that mathces the filter criteria
        // not just the ones that is selected in dropdown
        // if ($status != '0') {
        //     array_push($args['tax_query'], array(
        //         'taxonomy' => 'Community',
        //         'field'    => 'term_id',
        //         'terms'    => $status,
        //     ));
        // }

        if ($location != '0') {
            array_push($args['tax_query'], array(
                'taxonomy' => 'locations',
                'field'    => 'term_id',
                'terms'    => $location,
            ));
        }

        if ($type != '0') {
            array_push($args['tax_query'], array(
                'taxonomy' => 'property_type',
                'field'    => 'term_id',
                'terms'    => $type,
            ));
        }

        $args['meta_query'] = array('relation' => 'AND');

        $fields_settings = get_option('resideo_prop_fields_settings');
        $address_type    = isset($fields_settings['resideo_p_address_t_field']) ? $fields_settings['resideo_p_address_t_field'] : '';

       
        if ($city_term_id != '') {
            array_push($args['tax_query'], array(
                'taxonomy' => 'locations',
                'field'    => 'term_id',
                'terms'    => $city_term_id,
            ));
        }
        if ($search_property_id != '') {
           
            $args['p'] = $search_property_id;
        }

        if ($street_no != '') {
            array_push($args['meta_query'], array(
                'key'     => 'street_number',
                'value'   => $street_no,
            ));
        }

        if ($street != '') {
            array_push($args['meta_query'], array(
                'key'     => 'route',
                'value'   => $street,
            ));
        }

        if($neighborhood != '') {
            array_push($args['meta_query'], array(
                'key'     => 'neighborhood',
                'value'   => $neighborhood,
            ));
        }

        if ($city != '') {
            array_push($args['meta_query'], array(
                'key'     => 'locality',
                'value'   => $city,
            ));
        }

        if ($state != '') {
            array_push($args['meta_query'], array(
                'key'     => 'administrative_area_level_1',
                'value'   => $state,
            ));
        }

        if ($zip != '') {
            array_push($args['meta_query'], array(
                'key'     => 'postal_code',
                'value'   => $zip,
            ));
        }

        if ($price_min != '' && $price_max != '' && is_numeric($price_min) && is_numeric($price_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => array($price_min, $price_max),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ));
        } else if ($price_min != '' && is_numeric($price_min)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => $price_min,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        } else if ($price_max != '' && is_numeric($price_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => $price_max,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ));
        }

        if ($beds != '' && $beds != 0) {
            array_push($args['meta_query'], array(
                'key'     => 'property_beds',
                'value'   => $beds,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        }

        if ($baths != '' && $baths != 0) {
            array_push($args['meta_query'], array(
                'key'     => 'property_baths',
                'value'   => $baths,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        }

        if ($size_min != '' && $size_max != '' && is_numeric($size_min) && is_numeric($size_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_size',
                'value'   => array($size_min, $size_max),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ));
        } else if ($size_min != '' && is_numeric($size_min)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_size',
                'value'   => $size_min,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        } else if ($size_max != '' && is_numeric($size_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_size',
                'value'   => $size_max,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ));
        }

        if ($featured != '') {
            array_push($args['meta_query'], array(
                'key'     => 'property_featured',
                'value'   => $featured,
            ));
        }

        $amenities_settings = get_option('resideo_amenities_settings');

        if (is_array($amenities_settings) && count($amenities_settings) > 0) {
            uasort($amenities_settings, "resideo_compare_position");

            foreach ($amenities_settings as $key => $value) {
                if (isset($_GET[$key]) && esc_html($_GET[$key]) == 1) {
                    array_push($args['meta_query'], array(
                        'key'     => $key,
                        'value'   => 1
                    ));
                }
            }
        }

        $custom_fields_settings = get_option('resideo_fields_settings');

        if (is_array($custom_fields_settings)) {
            uasort($custom_fields_settings, "resideo_compare_position");

            foreach ($custom_fields_settings as $key => $value) {
                if ($value['search'] == 'yes' || $value['filter'] == 'yes') {
                    if ($value['type'] == 'interval_field') {
                        $field_min = isset($_GET[$key . '_min']) ? sanitize_text_field($_GET[$key . '_min']) : '';
                        $field_max = isset($_GET[$key . '_max']) ? sanitize_text_field($_GET[$key . '_max']) : '';
                    } else {
                        $field = isset($_GET[$key]) ? sanitize_text_field($_GET[$key]) : '';
                    }

                    $comparison       = $key . '_comparison';
                    $comparison_value = isset($_GET[$comparison]) ? sanitize_text_field($_GET[$comparison]) : '';
                    $operator         = '';
                    $value_type       = '';

                    switch ($comparison_value) {
                        case 'equal':
                            $operator = '==';
                            break;
                        case 'greater':
                            $operator = '>=';
                            break;
                        case 'smaller':
                            $operator = '<=';
                            break;
                        case 'like':
                            $operator = 'LIKE';
                            break;
                    }

                    switch ($value['type']) {
                        case 'text_field':
                            $value_type = 'CHAR';
                            break;
                        case 'numeric_field':
                            $value_type = 'NUMERIC';
                            break;
                        case 'date_field':
                            $value_type = 'DATE';
                            break;
                        case 'list_field':
                            $value_type = 'CHAR';
                            break;
                    }

                    if ($value['type'] == 'interval_field') {
                        if ($field_min != '' && $field_max != '' && is_numeric($field_min) && is_numeric($field_max)) {
                            array_push($args['meta_query'], array(
                                'key'     => $key,
                                'value'   => array($field_min, $field_max),
                                'compare' => 'BETWEEN',
                                'type' => 'NUMERIC'
                            ));
                        } else if ($field_min != '' && is_numeric($field_min)) {
                            array_push($args['meta_query'], array(
                                'key'     => $key,
                                'value'   => $field_min,
                                'compare' => '>=',
                                'type' => 'NUMERIC'
                            ));
                        } else if ($field_max != '' && is_numeric($field_max)) {
                            array_push($args['meta_query'], array(
                                'key'     => $key,
                                'value'   => $field_max,
                                'compare' => '<=',
                                'type' => 'NUMERIC'
                            ));
                        }
                    } else {
                        if ($field != '') {
                            array_push($args['meta_query'], array(
                                'key'     => $key,
                                'value'   => $field,
                                'compare' => $operator,
                                'type'    => $value_type
                            ));
                        }
                    }
                }
            }
        }

        $query = new WP_Query($args);
        
        // finding the community ids of the properties that match the query and add it to an array without duplicating. 
        // then those communties are fetched and passed

        // if location is selected  from dropdown, then only that community needs to be shown which matches
        // the filter properties selected. Otherwise it will feature all the communities based on the filters
        // =location assigned in community page needs to be considered here rather than the location taxonomy selected in 
        // property leve;
        $result_comms = array();
        while ($query->have_posts()) {
            $query->the_post();
            $prop_id = get_the_ID();
            $findCommunity = wp_get_post_terms($prop_id, 'Community');
            
            if(!empty( $findCommunity )) {            
                $current_comm = $findCommunity[0]->term_id;
                if(!in_array($current_comm , $result_comms, true)){
                    array_push($result_comms, $current_comm);
                }
            }
            

        }
        print_r($result_comms);
        
        wp_reset_postdata();
        if(count($result_comms) > 0 ) {
         $terms = get_terms( array(
            'taxonomy' => 'Community',
            'hide_empty' => false,
            'term_taxonomy_id' => $result_comms
        ) );
        }
       
        // The Loop
        if ( ! empty( $terms ) ) { 
              return array("communities",$terms,"case5");
        }
        return;
        //return array("properties",$query);


       // } //if
        
    }
endif;

// Get searched properties for map
if (!function_exists('resideo_get_searched_communities')): 
    function resideo_get_searched_communities() {
        check_ajax_referer('results_map_ajax_nonce', 'security');
        

        $search_status        = isset($_POST['search_status']) ? sanitize_text_field($_POST['search_status']) : '0';
        $search_address       = isset($_POST['search_address']) ? stripslashes(sanitize_text_field($_POST['search_address'])) : '';

        $city_term_id         = isset($_POST['city_term_id']) ? $_POST['city_term_id'] : '';
        $search_property_id   = isset($_POST['search_property_id']) ? $_POST['search_property_id'] : '';
        $search_street_no     = isset($_POST['search_street_no']) ? stripslashes(sanitize_text_field($_POST['search_street_no'])) : '';
        $search_street        = isset($_POST['search_street']) ? stripslashes(sanitize_text_field($_POST['search_street'])) : '';
        $search_neighborhood  = isset($_POST['search_neighborhood']) ? stripslashes(sanitize_text_field($_POST['search_neighborhood'])) : '';
        $search_city          = isset($_POST['search_city']) ? stripslashes(sanitize_text_field($_POST['search_city'])) : '';
        $search_state         = isset($_POST['search_state']) ? stripslashes(sanitize_text_field($_POST['search_state'])) : '';
        $search_zip           = isset($_POST['search_zip']) ? sanitize_text_field($_POST['search_zip']) : '';
        $search_type          = isset($_POST['search_type']) ? sanitize_text_field($_POST['search_type']) : '0';
        $search_price_min     = isset($_POST['search_price_min']) ? sanitize_text_field($_POST['search_price_min']) : '';
        $search_price_max     = isset($_POST['search_price_max']) ? sanitize_text_field($_POST['search_price_max']) : '';
        $search_beds          = isset($_POST['search_beds']) ? sanitize_text_field($_POST['search_beds']) : '';
        $search_baths         = isset($_POST['search_baths']) ? sanitize_text_field($_POST['search_baths']) : '';
        $search_size_min      = isset($_POST['search_size_min']) ? sanitize_text_field($_POST['search_size_min']) : '';
        $search_size_max      = isset($_POST['search_size_max']) ? sanitize_text_field($_POST['search_size_max']) : '';
        $search_keywords      = isset($_POST['search_keywords']) ? stripslashes(sanitize_text_field($_POST['search_keywords'])) : '';
        $search_id            = isset($_POST['search_id']) ? sanitize_text_field($_POST['search_id']) : '';
        $search_amenities     = isset($_POST['search_amenities']) ? $_POST['search_amenities'] : '';
        $search_custom_fields = isset($_POST['search_custom_fields']) ? $_POST['search_custom_fields'] : '';

        $featured = isset($_POST['featured']) ? sanitize_text_field($_POST['featured']) : '';

        $appearance_settings = get_option('resideo_appearance_settings');
        $posts_per_page      = isset($appearance_settings['resideo_properties_per_page_field']) ? $appearance_settings['resideo_properties_per_page_field'] : 10;
        $the_page            = isset($_POST['page']) ? sanitize_text_field($_POST['page']) : 0;
        $page                = ($the_page == 0) ? 1 : $the_page;
        $sort                = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest';

        $args = array(
            'posts_per_page' => $posts_per_page,
            'paged'          => $page,
            's'              => $search_keywords,
            'post_type'      => 'property',
            'post_status'    => 'publish',
        );

        if ($sort == 'newest') {
            $args['meta_key'] = 'property_featured';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'price_lo') {
            $args['meta_key'] = 'property_price';
            $args['orderby'] = array('meta_value_num' => 'ASC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'price_hi') {
            $args['meta_key'] = 'property_price';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'beds') {
            $args['meta_key'] = 'property_beds';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'baths') {
            $args['meta_key'] = 'property_baths';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if ($sort == 'size') {
            $args['meta_key'] = 'property_size';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        }

        if ($search_id != '') {
            $args['p'] = $search_id;
        }

        $args['tax_query'] = array('relation' => 'AND');

        if ($search_status != '0') {
            array_push($args['tax_query'], array(
                'taxonomy' => 'Community',
                'field'    => 'term_id',
                'terms'    => $search_status,
            ));
        }

        if ($city_term_id != '') {
            array_push($args['tax_query'], array(
                'taxonomy' => 'locations',
                'field'    => 'term_id',
                'terms'    => $city_term_id,
            ));
        }

        if ($search_property_id != '') {
            $args['p'] = $search_property_id;
        }

        if ($search_type != '0') {
            array_push($args['tax_query'], array(
                'taxonomy' => 'property_type',
                'field'    => 'term_id',
                'terms'    => $search_type,
            ));
        }

        $args['meta_query'] = array('relation' => 'AND');

        $fields_settings = get_option('resideo_prop_fields_settings');
        $address_type    = isset($fields_settings['resideo_p_address_t_field']) ? $fields_settings['resideo_p_address_t_field'] : '';

        if (/*$search_address != '' &&*/ $city_term_id != '') {
            /*array_push($args['meta_query'], array(
                'key'     => 'property_address',
                'value'   => $search_address,
                'compare' => 'LIKE',
            ));*/
            array_push($args['tax_query'], array(
                'taxonomy' => 'locations',
                'field'    => 'term_id',
                'terms'    => $city_term_id,
            ));
        }

        if ($search_property_id != '') {
            /*array_push($args['tax_query'], array(
                'taxonomy' => 'locations',
                'field'    => 'term_id',
                'terms'    => $search_property_id,
            ));*/
            $args['p'] = $search_property_id;
        }

        if ($search_street_no != '') {
            array_push($args['meta_query'], array(
                'key'     => 'street_number',
                'value'   => $search_street_no,
            ));
        }

        if ($search_street != '') {
            array_push($args['meta_query'], array(
                'key'     => 'route',
                'value'   => $search_street,
            ));
        }

        if ($search_neighborhood != '') {
            array_push($args['meta_query'], array(
                'key'     => 'neighborhood',
                'value'   => $search_neighborhood,
            ));
        }

        if ($search_city != '') {
            array_push($args['meta_query'], array(
                'key'     => 'locality',
                'value'   => $search_city,
            ));
        }

        if ($search_state != '') {
            array_push($args['meta_query'], array(
                'key'     => 'administrative_area_level_1',
                'value'   => $search_state,
            ));
        }

        if ($search_zip != '') {
            array_push($args['meta_query'], array(
                'key'     => 'postal_code',
                'value'   => $search_zip,
            ));
        }

        if ($search_price_min != '' && $search_price_max != '' && is_numeric($search_price_min) && is_numeric($search_price_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => array($search_price_min, $search_price_max),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ));
        } else if ($search_price_min != '' && is_numeric($search_price_min)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => $search_price_min,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        } else if ($search_price_max != '' && is_numeric($search_price_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => $search_price_max,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ));
        }

        if ($search_beds != '' && $search_beds != '0') {
            array_push($args['meta_query'], array(
                'key'     => 'property_beds',
                'value'   => $search_beds,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        }

        if ($search_baths != '' && $search_baths != '0') {
            array_push($args['meta_query'], array(
                'key'     => 'property_baths',
                'value'   => $search_baths,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        }

        if ($search_size_min != '' && $search_size_max != '' && is_numeric($search_size_min) && is_numeric($search_size_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_size',
                'value'   => array($search_size_min, $search_size_max),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ));
        } else if ($search_size_min != '' && is_numeric($search_size_min)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_size',
                'value'   => $search_size_min,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        } else if ($search_size_max != '' && is_numeric($search_size_max)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_size',
                'value'   => $search_size_max,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ));
        }

        if ($featured != '') {
            array_push($args['meta_query'], array(
                'key'     => 'property_featured',
                'value'   => $featured,
            ));
        }

        if (is_array($search_amenities)) {
            foreach($search_amenities as $amnt) {
                array_push($args['meta_query'], array(
                    'key'     => $amnt,
                    'value'   => 1
                ));
            }
        }

        if (is_array($search_custom_fields)) {
            foreach ($search_custom_fields as $field) {
                $operator   = '';
                $value_type = '';

                switch ($field['compare']) {
                    case 'equal':
                        $operator = '==';
                        break;
                    case 'greater':
                        $operator = '>=';
                        break;
                    case 'smaller':
                        $operator = '<=';
                        break;
                    case 'like':
                        $operator = 'LIKE';
                        break;
                }

                switch ($field['type']) {
                    case 'text_field':
                        $value_type = 'CHAR';
                        break;
                    case 'numeric_field':
                        $value_type = 'NUMERIC';
                        break;
                    case 'date_field':
                        $value_type = 'DATE';
                        break;
                    case 'list_field':
                        $value_type = 'CHAR';
                        break;
                }

                if ($field['type'] == 'interval_field') {
                    if ($field['value'][0] != '' && $field['value'][1] != '' && is_numeric($field['value'][0]) && is_numeric($field['value'][1])) {
                        array_push($args['meta_query'], array(
                            'key'     => $field['name'],
                            'value'   => array($field['value'][0], $field['value'][1]),
                            'compare' => 'BETWEEN',
                            'type' => 'NUMERIC'
                        ));
                    } else if ($field['value'][0] != '' && is_numeric($field['value'][0])) {
                        array_push($args['meta_query'], array(
                            'key'     => $field['name'],
                            'value'   => $field['value'][0],
                            'compare' => '>=',
                            'type' => 'NUMERIC'
                        ));
                    } else if ($field['value'][1] != '' && is_numeric($field['value'][1])) {
                        array_push($args['meta_query'], array(
                            'key'     => $field['name'],
                            'value'   => $field['value'][1],
                            'compare' => '<=',
                            'type' => 'NUMERIC'
                        ));
                    }
                } else {
                    if ($field['value'] != '') {
                        array_push($args['meta_query'], array(
                            'key'     => $field['name'],
                            'value'   => $field['value'],
                            'compare' => $operator,
                            'type'    => $value_type
                        ));
                    }
                }
            }

        }

        $resideo_general_settings = get_option('resideo_general_settings');
        $currency                 = isset($resideo_general_settings['resideo_currency_symbol_field']) ? $resideo_general_settings['resideo_currency_symbol_field'] : '';
        $currency_pos             = isset($resideo_general_settings['resideo_currency_symbol_pos_field']) ? $resideo_general_settings['resideo_currency_symbol_pos_field'] : '';
        $locale                   = isset($resideo_general_settings['resideo_locale_field']) ? $resideo_general_settings['resideo_locale_field'] : '';
        $decimals                 = isset($resideo_general_settings['resideo_decimals_field']) ? $resideo_general_settings['resideo_decimals_field'] : '';
        $beds_label               = isset($resideo_general_settings['resideo_beds_label_field']) ? $resideo_general_settings['resideo_beds_label_field'] : 'BD';
        $baths_label              = isset($resideo_general_settings['resideo_baths_label_field']) ? $resideo_general_settings['resideo_baths_label_field'] : 'BA';
        $unit                     = isset($resideo_general_settings['resideo_unit_field']) ? $resideo_general_settings['resideo_unit_field'] : '';
        setlocale(LC_MONETARY, $locale);

        $props = array();

        $query = new WP_Query($args);

        while ($query->have_posts()) {
            $query->the_post();

            $prop = new stdClass();
            
            $prop_id = get_the_ID();
            $prop->id = $prop_id;
            $prop->title = get_the_title();
            $gallery = get_post_meta($prop_id, 'property_gallery', true);
            $photos = explode(',', $gallery);
            $t_image = get_field('thumbnail_image');

            $photo_src = wp_get_attachment_image_src($photos[0], 'pxp-thmb');
            if(!empty($t_image)){
                $prop->photo = $t_image;
            }
            else if ($photo_src === false) {
                $prop->photo = RESIDEO_PLUGIN_PATH . 'images/property-small.png';
            } else {
                $prop->photo = $photo_src[0];
            }

            $prop->lat = get_post_meta($prop_id, 'property_lat', true);
            $prop->lng = get_post_meta($prop_id, 'property_lng', true);

            $price = get_post_meta($prop_id, 'property_price', true);
            $prop->price_raw = $price;
            $price_label = get_post_meta($prop_id, 'property_price_label', true);
            $prop->price_label = $price_label;
            $prop->currency = $currency;
            $prop->currency_pos = $currency_pos;

            if (is_numeric($price)) {
                if ($decimals == 1) {
                    $price = money_format('%!i', $price);
                } else {
                    $price = money_format('%!.0i', $price);
                }
                $currency_val = $currency;
            } else {
                $price_label = '';
                $currency_val = '';
            }

            if ($currency_pos == 'before') {
                $prop->price = esc_html($currency_val) . esc_html($price) . ' <span>' . esc_html($price_label) . '</span>';
            } else {
                $prop->price = esc_html($price) . esc_html($currency_val) . ' <span>' . esc_html($price_label) . '</span>';
            }

            $prop->link = get_permalink($prop_id);

            $prop->beds  = get_post_meta($prop_id, 'property_beds', true);
            $prop->beds_label = $beds_label;
            $prop->baths = get_post_meta($prop_id, 'property_baths', true);
            $prop->baths_label = $baths_label;
            $prop->size  = get_post_meta($prop_id, 'property_size', true);
            $prop->unit  = $unit;

            array_push($props, $prop);
            
        }

        wp_reset_postdata();
        wp_reset_query();

//fetching all communities
$comms = array();
$ct_communities_for_maps = get_terms( array(
    'taxonomy' => 'Community',
    'hide_empty' => false,
) );
icl_register_string("resideo", "Price from","Price from");
foreach ($ct_communities_for_maps as $term) {
    $comm = new stdClass();
   
    $comm->id     = $term->term_id;
    $comm->name   = pll__($term->name);
    $comm->lat    = get_field("ct_cord_lattitude",$term->taxonomy.'_'.$term->term_id);
    $comm->long   = get_field("ct_cord_longitude",$term->taxonomy.'_'.$term->term_id);
    $comm->tn     = get_field("community_front_image",$term->taxonomy.'_'.$term->term_id);
    $price_from   =   get_field("price_from",$term->taxonomy.'_'.$term->term_id);
    $price_from   =   explode("|", $price_from);
    $link = site_url()."/single-community/?term_id=".$comm->id."&community=".$term->slug;
    if(get_locale() == 'ar'){
       $link = str_replace("/single-community","/ar/single-community-ar",$link);
        } 
    $comm->url = $link;
    //( $price_from1 ).' '.pll__( "SAR" )
    if(count($price_from)>1)
        {
            $price_from2 = $price_from[1]; 
        }
    else
        {
            $price_from2 = $price_from[0];
        }
    
    $comm->price = pll__( 'Price from' ).' '.$price_from2.' '.pll__( "SAR" );
    array_push($comms, $comm);
}

        if (count($props) > 0) {
            echo json_encode(array('getprops'=>true, 'props'=>$props, 'comms' => $comms));
            exit();
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();
    }
endif;
add_action('wp_ajax_nopriv_resideo_get_searched_communities', 'resideo_get_searched_communities');
add_action('wp_ajax_resideo_get_searched_communities', 'resideo_get_searched_communities');
?>