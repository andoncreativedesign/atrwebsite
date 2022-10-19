<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

/**
 * Recent properties shortcode
 */
if (!function_exists('resideo_recent_properties_shortcode')): 
    function resideo_recent_properties_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array('data_content'), $attrs));

        if (!isset($attrs['data_content'])) {
            return null;
        }

        $s_array = json_decode(urldecode($attrs['data_content']), true);

        if (isset($s_array['number']) && is_numeric($s_array['number'])) {
            $number = $s_array['number'];
        } else {
            $number = '3';
        }

        if (isset($s_array['type']) && is_numeric($s_array['type'])) {
            $type = $s_array['type'];
        } else {
            $type = '0';
        }

        if (isset($s_array['status']) && is_numeric($s_array['status'])) {
            $status = $s_array['status'];
        } else {
            $status = '0';
        }

        $args = array(
            'numberposts'      => $number,
            'post_type'        => 'property',
            'order'            => 'DESC',
            'suppress_filters' => false,
            'post_status'      => 'publish'
        );

        if ($type != '0' && $status != '0') {
            $args['tax_query'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'property_type',
                    'field'    => 'term_id',
                    'terms'    => $type,
                ),
                array(
                    'taxonomy' => 'property_status',
                    'field'    => 'term_id',
                    'terms'    => $status,
                ),
            );
        } else if ($type != '0') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'property_type',
                    'field'    => 'term_id',
                    'terms'    => $type,
                ),
            );
        } else if ($status != '0') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'property_status',
                    'field'    => 'term_id',
                    'terms'    => $status,
                ),
            );
        }

        $posts = wp_get_recent_posts($args);

        $resideo_general_settings = get_option('resideo_general_settings');
        $beds_label               = isset($resideo_general_settings['resideo_beds_label_field']) ? $resideo_general_settings['resideo_beds_label_field'] : 'BD';
        $baths_label              = isset($resideo_general_settings['resideo_baths_label_field']) ? $resideo_general_settings['resideo_baths_label_field'] : 'BA';
        $unit                     = isset($resideo_general_settings['resideo_unit_field']) ? $resideo_general_settings['resideo_unit_field'] : '';
        $currency                 = isset($resideo_general_settings['resideo_currency_symbol_field']) ? $resideo_general_settings['resideo_currency_symbol_field'] : '';
        $currency_pos             = isset($resideo_general_settings['resideo_currency_symbol_pos_field']) ? $resideo_general_settings['resideo_currency_symbol_pos_field'] : '';
        $locale                   = isset($resideo_general_settings['resideo_locale_field']) ? $resideo_general_settings['resideo_locale_field'] : '';
        $decimals                 = isset($resideo_general_settings['resideo_decimals_field']) ? $resideo_general_settings['resideo_decimals_field'] : '';
        setlocale(LC_MONETARY, $locale);

        $return_string = '';
        $margin_class = $s_array['margin'] == 'yes' ? 'mt-100' : '';
        $shortcode_after = '';
        $column_class = '';
        $card_margin_class = '';

        $cta_color = isset($s_array['cta_color']) ? $s_array['cta_color'] : '';
        $cta_id = uniqid();

        $style = isset($s_array['style']) ? $s_array['style'] : '';
        if($style == 'new'){
          
            include_once("recent_property_new.php");
        }
        else
        {
            
            include_once("recent_property_old.php");
        }

        

        $return_string .= $shortcode_after;

        wp_reset_postdata();
        wp_reset_query();
        if($style == 'new'){
            
        }
        return $return_string;
    }
endif;
?>