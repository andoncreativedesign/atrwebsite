<?php

$return_string = 

    '<div class="row service_case_3" style="padding: 70px 0px 0px 0px; margin:0px">';
    if (get_field('page_slug')=='who-we-are-ar') {
        $return_string .=' 
        <div class="col-sm-10 col-md-10 col-lg-4 col-xl-3">';
    }
    else{
        $return_string .=' 
        <div class="col-sm-10 col-md-10 col-lg-4 col-xl-3 offset-md-1 offset-sm-1">';
    }
    $return_string .=' 
            <div class="pxp-services-h-items pxp-animate-in ml-0 mt-4 mt-md-5 mt-lg-0" style="padding-bottom: 0px">
                    <p class="pxp-text-light" style="' . esc_attr($text_color) . '; color: #4D858D;
    font-weight: 700;">' . esc_html($s_array['title']) . '</p>
                                    <h3 class="pxp-section-h2 '.(get_locale() == 'ar' ? 'pxp-section-h3' : '').'" style="' . esc_attr($text_color) . '; width: 279px">' . esc_html($s_array['subtitle']) . '</h3>';

                if ($s_array['cta_sevice_text'] != '') {
                   $return_string .=  
                    '<div class="service_case_3_intro">
                           <p style="padding-right: 10px; text-align: left;">'.html_entity_decode($s_array['cta_sevice_text']).'</p>
                    </div>';
                    }


if ($s_array['cta_link'] != '') {
    $return_string .= 
                    '<a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase pxp-animate pxp-animate-in" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>';
    if ($cta_color != '') {
        $return_string .= 
                    '<style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
    }
}
$id             = get_the_ID();
$image_map_area = get_field("image_map_area");
$people_area = get_field("people_area");

$return_string .= 
            '</div>
        </div>
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="pxp-services-h-fig pxp-cover  rounded-lg" style="height:auto;" >
                '. $people_area .'
            </div>
        </div>
    </div>


    ';

    

?>
<script type="text/javascript">
jQuery( document ).ready(function() {
  var pseudomember;
  jQuery(".boardmember").each(function() {
    jQuery(this).mouseover(function() {
      jQuery(this).addClass("removeFade")     
      pseudomember = jQuery(this).attr('data-pseudofilter');
    });
    jQuery(this).mouseout(function() {
      jQuery(this).removeClass("removeFade")
 
    });
  });
});
  </script>