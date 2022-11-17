<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

if (!function_exists('resideo_get_similar_properties')):
    function resideo_get_similar_properties($template = 'full') {
        global $post;

        $orig_city   = get_post_meta($post->ID, 'locality', true);
        $orig_type   = wp_get_post_terms($post->ID, 'property_type', array('fields' => 'ids'));
        $orig_status = wp_get_post_terms($post->ID, 'property_status', array('fields' => 'ids'));

        $exclude_ids = array($post->ID);

        $args = array(
            'posts_per_page'   => 10,
            'post_type'        => 'property',
            'suppress_filters' => false,
            'post_status'      => 'publish',
            'post__not_in'     => $exclude_ids
        );

        if ($orig_type && $orig_status) {
            $args['tax_query'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'property_type',
                    'field'    => 'term_id',
                    'terms'    => $orig_type[0],
                ),
                array(
                    'taxonomy' => 'property_status',
                    'field'    => 'term_id',
                    'terms'    => $orig_status[0],
                ),
            );
        }

        $args['meta_query'] = array(
            array(
                'key'   => 'locality',
                'value' => $orig_city,
            )
        );

        $similars      = new WP_Query($args);
        $similars_arr  = get_object_vars($similars);

        $resideo_general_settings = get_option('resideo_general_settings');
        $beds_label               = isset($resideo_general_settings['resideo_beds_label_field']) ? $resideo_general_settings['resideo_beds_label_field'] : 'BD';
        $baths_label              = isset($resideo_general_settings['resideo_baths_label_field']) ? $resideo_general_settings['resideo_baths_label_field'] : 'BA';
        $unit                     = isset($resideo_general_settings['resideo_unit_field']) ? $resideo_general_settings['resideo_unit_field'] : '';
        $currency                 = isset($resideo_general_settings['resideo_currency_symbol_field']) ? $resideo_general_settings['resideo_currency_symbol_field'] : '';
        $currency_pos             = isset($resideo_general_settings['resideo_currency_symbol_pos_field']) ? $resideo_general_settings['resideo_currency_symbol_pos_field'] : '';
        $locale                   = isset($resideo_general_settings['resideo_locale_field']) ? $resideo_general_settings['resideo_locale_field'] : '';
        $decimals                 = isset($resideo_general_settings['resideo_decimals_field']) ? $resideo_general_settings['resideo_decimals_field'] : '';
        setlocale(LC_MONETARY, $locale);

        $container_class = 'container mt-100';
        $list_container_margin = 'mt-4 mt-md-5';
        $card_size_class = '';
        $carousel_stage_class = '';

        if ($template == 'side') {
            $container_class = 'mt-4 mt-md-5';
            $list_container_margin = 'mt-3 mt-md-4';
            $card_size_class = 'pxp-is-small';
            $carousel_stage_class = 'pxp-is-side';
        }
        icl_register_string("resideo","Similar Homes","Similar Homes");
        if (is_array($similars_arr['posts']) && count($similars_arr['posts']) > 0) { ?>
            <div class="pxp-similar-properties <?php echo esc_attr($container_class); ?>">
                <h2 class="ct_similar_prop_h2"><?php echo pll__("Similar Homes"); ?></h2>

                <div class="pxp-similar-properties-container <?php echo esc_attr($list_container_margin); ?>">
                    <div class="owl-carousel pxp-similar-properties-stage <?php echo esc_attr($carousel_stage_class); ?>">
                        <?php foreach ($similars_arr['posts'] as $similar) :
                            $p_photo = '';
                            $p_title = $similar->post_title;
                            $p_link  = get_permalink($similar->ID);

                            $gallery     = get_post_meta($similar->ID, 'property_gallery', true);
                            $photos      = explode(',', $gallery);
                            $first_photo = wp_get_attachment_image_src($photos[0], 'pxp-gallery');
                            $thumbnail   = get_field('thumbnail_image',$similar->ID);

                            if (!empty($thumbnail)) {
                                $p_photo = $thumbnail;
                            } else if (isset($first_photo[0]) && $first_photo[0] != '') {
                                $p_photo = $first_photo[0];
                            } else {
                                $p_photo = RESIDEO_PLUGIN_PATH . 'images/property-tile.png';
                            }

                            $p_price       = get_post_meta($similar->ID, 'property_price', true);
                            $p_price_label = get_post_meta($similar->ID, 'property_price_label', true);

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

                            $p_beds  = get_post_meta($similar->ID, 'property_beds', true);
                            $p_baths = get_post_meta($similar->ID, 'property_baths', true);
                            $p_size  = get_post_meta($similar->ID, 'property_size', true); ?>

                            <div>
                                <a href="<?php echo esc_url($p_link); ?>" class="pxp-prop-card-1 rounded-lg <?php echo esc_attr($card_size_class); ?>">
                                    <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(<?php echo esc_url($p_photo); ?>); background-size: cover;"></div>
                                    <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                    <div class="pxp-prop-card-1-details">
                                        <div class="pxp-prop-card-1-details-title"><?php echo esc_html($p_title); ?></div>
                                        <div class="pxp-prop-card-1-details-price">
                                            <?php if ($currency_pos == 'before') {
                                                echo esc_html($currency_str) . esc_html($p_price) . ' <span>' . esc_html($p_price_label) . '</span>';
                                            } else {
                                                echo esc_html($p_price) . esc_html($currency_str) . ' <span>' . esc_html($p_price_label) . '</span>';
                                            } ?>
                                        </div>
                                        <div class="pxp-prop-card-1-details-features text-uppercase ">
                                            <?php if ($p_beds != '') {
                                                echo esc_html($p_beds) . ' ' . esc_html($beds_label) . '<span>|</span>';
                                            }
                                            if ($p_baths != '') {
                                                echo esc_html($p_baths) . ' ' . esc_html($baths_label) . '<span>|</span>';
                                            }
                                            if ($p_size != '') {
                                                echo esc_html($p_size) . ' ' . esc_html($unit);
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="pxp-prop-card-1-details-cta text-uppercase"><?php echo pll__("View Details"); ?></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php }
    }
endif;
?>