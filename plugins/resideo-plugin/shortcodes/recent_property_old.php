<?php 
switch($s_array['layout']) {
case '1':
    $return_string .= '
        <div class="container-fluid pxp-props-carousel-right ' . esc_attr($margin_class) . '">';
    if ($s_array['title'] != '') {
        $return_string .= '
            <h2 class="pxp-section-h2">' . esc_html($s_array['title']) . '</h2>';
    }
    if ($s_array['subtitle'] != '') {
        $return_string .= '
            <p class="pxp-text-light">' . esc_html($s_array['subtitle']) . '</p>';
    }
    //Oxygensoft explore-our-communities Edit
    $return_string .= '
            <div class="pxp-props-carousel-right-container mt-4 mt-md-5">
                <div class="owl-carousel pxp-props-carousel-right-stage">';

    if ($s_array['cta_label'] != '' && $s_array['cta_link'] != '') {
        $shortcode_after = '</div></div><a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a></div>
                            <style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
    } else {
        $shortcode_after = '</div></div></div>';
    }
break;
case '2':
    $return_string .= '
        <div class="container-fluid pxp-props-carousel-right pxp-has-intro ' . esc_attr($margin_class) . '">
            <div class="pxp-props-carousel-right-intro">';
    if ($s_array['title'] != '') {
        $return_string .= '
                <h2 class="pxp-section-h2">' . esc_html($s_array['title']) . '</h2>';
    }
    if ($s_array['subtitle'] != '') {
        $return_string .= '
                <p class="pxp-text-light">' . esc_html($s_array['subtitle']) . '</p>';
    }
    if ($s_array['cta_label'] != '' && $s_array['cta_link'] != '') {
        $return_string .= '
                <a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>
                <style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
    }
    $return_string .= '
            </div>
            <div class="pxp-props-carousel-right-container mt-4 mt-md-5 mt-lg-0">
                <div class="owl-carousel pxp-props-carousel-right-stage-1">';
    $shortcode_after = '</div></div></div>';
break;
case '3':
    $return_string .= '
        <div class="container ' . esc_attr($margin_class) . '">';
    if ($s_array['title'] != '') {
        $return_string .= '
            <h2 class="pxp-section-h2">' . esc_html($s_array['title']) . '</h2>';
    }
    if ($s_array['subtitle'] != '') {
        $return_string .= '
            <p class="pxp-text-light">' . esc_html($s_array['subtitle']) . '</p>';
    }
    $return_string .= '
            <div class="row mt-4 mt-md-5">';
    $shortcode_after = '</div>';
    if ($s_array['cta_label'] != '' && $s_array['cta_link'] != '') {
        $shortcode_after .= '
                <a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>
                <style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
    }
    $shortcode_after .= '</div>';

    $column_class = 'col-sm-12 col-md-6 col-lg-4';
    $card_margin_class = 'mb-4';
break;
default: 
    $return_string .= '
        <div class="container-fluid pxp-props-carousel-right ' . esc_attr($margin_class) . '">';
    if ($s_array['title'] != '') {
        $return_string .= '
            <h2 class="pxp-section-h2">' . esc_html($s_array['title']) . '</h2>';
    }
    if ($s_array['subtitle'] != '') {
        $return_string .= '
            <p class="pxp-text-light">' . esc_html($s_array['subtitle']) . '</p>';
    }

    $return_string .= '
            <div class="pxp-props-carousel-right-container mt-4 mt-md-5">
                <div class="owl-carousel pxp-props-carousel-right-stage">';

    if ($s_array['cta_label'] != '' && $s_array['cta_link'] != '') {
        $shortcode_after = '</div></div><a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a></div>
        <style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
    } else {
        $shortcode_after = '</div></div></div>';
    }
break; 
}

foreach($posts as $post) : 
$p_title = $post['post_title'];
$p_link  = get_permalink($post['ID']);

$gallery     = get_post_meta($post['ID'], 'property_gallery', true);
$photos      = explode(',', $gallery);
$first_photo = wp_get_attachment_image_src($photos[0], 'pxp-gallery');

if ($first_photo != '') {
    $p_photo = $first_photo[0];
} else {
    $p_photo = RESIDEO_PLUGIN_PATH . 'images/property-tile.png';
}

$p_price       = get_post_meta($post['ID'], 'property_price', true);
$p_price_label = get_post_meta($post['ID'], 'property_price_label', true);

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

$p_beds  = get_post_meta($post['ID'], 'property_beds', true);
$p_baths = get_post_meta($post['ID'], 'property_baths', true);
$p_size  = get_post_meta($post['ID'], 'property_size', true);


$return_string .= '
    <div class="' . esc_attr($column_class) . '">
        <a href="' . esc_url($p_link) . '" class="pxp-prop-card-1 rounded-lg ' . esc_attr($card_margin_class) . '">
            <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(' . esc_url($p_photo) . ');"></div>
            <div class="pxp-prop-card-1-gradient pxp-animate"></div>
            <div class="pxp-prop-card-1-details">
                <div class="pxp-prop-card-1-details-title">' . esc_html($p_title) . '</div>
                <div class="pxp-prop-card-1-details-price">';
if ($currency_pos == 'before') {
    $return_string .= esc_html($currency_str) . esc_html($p_price) . ' <span>' . esc_html($p_price_label) . '</span>';
} else {
    $return_string .= esc_html($p_price) . esc_html($currency_str) . ' <span>' . esc_html($p_price_label) . '</span>';
}
$return_string .= '
                </div>
                <div class="pxp-prop-card-1-details-features text-uppercase">';
if ($p_beds != '') {
    $return_string .= esc_html($p_beds) . ' ' . esc_html($beds_label) . '<span>|</span>';
}
if ($p_baths != '') {
    $return_string .= esc_html($p_baths) . ' ' . esc_html($baths_label) . '<span>|</span>';
}
if ($p_size != '') {
    $return_string .= esc_html($p_size) . ' ' . esc_html($unit);
}
$return_string .= '
                </div>
            </div>
            <div class="pxp-prop-card-1-details-cta text-uppercase">' . __('View Details', 'resideo') . '</div>
        </a>
    </div>';
endforeach;
?>