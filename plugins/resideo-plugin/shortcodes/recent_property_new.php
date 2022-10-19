<?php

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
            <a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>
            <style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
}
$shortcode_after .= '</div>';

$column_class = 'col-sm-12 col-md-6 col-lg-4';
$card_margin_class = 'mb-4';

$return_string .= '
		<style type="text/css" media="screen">
			.pxp-prop-card-1-details {
			    background-color: yellowgreen !important;
			}
		</style>';

ob_start();
?>
<div class="row mt-4 mt-md-5">

	<?php


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

	$badss='';
	if ($p_beds != '') {
	    $badss .= esc_html($p_beds) . ' ' . esc_html($beds_label) . '<span>|</span>';
	}
	if ($p_baths != '') {
	    $badss .= esc_html($p_baths) . ' ' . esc_html($baths_label) . '<span>|</span>';
	}
	if ($p_size != '') {
	    $badss .= esc_html($p_size) . ' ' . esc_html($unit);
	}
	?>
	<div class="col-sm-12 col-md-6 col-lg-4">
	    <a href="<?php echo  esc_url($p_link); ?>" class="pxp-posts-1-item ">
	        <div class="pxp-posts-1-item-fig-container">
	            <div class="pxp-posts-1-item-fig pxp-cover" >
	            	<img src="<?php echo  esc_url($p_photo);?>" style="width: 100%;">
	            </div>
	        </div>
	        <div class="pxp-posts-1-item-details">
	            <div class="pxp-posts-1-item-details-category">Lorem ipsum dolor sit amet</div>
	            <div class="pxp-posts-1-item-details-title"><?php echo $p_title;?></div>
	            <div class="pxp-posts-1-item-details-date mt-2"><?php echo $badss;?></div>
	            <div class="pxp-posts-1-item-cta text-uppercase" style="color: "><?php echo $badss;?></div>
	        </div>
	    </a>
	</div>

<?php

endforeach;
?>
</div><?php


$dd = ob_get_clean();

$return_string .= $dd;

foreach($posts as $post) : 
	break;
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

//
	$return_string .= '
	    <div class=" ' . esc_attr($column_class) . '">
	        <a href="' . esc_url($p_link) . '" class="pxp-prop-card-1 rounded-lg ' . esc_attr($card_margin_class) . '">
	            <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(' . esc_url($p_photo) . ');"></div>
	            <div class="pxp-prop-card-1-gradient "></div>
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