<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

/**
 * Services shortcode
 */
if (!function_exists('resideo_services_shortcode')): 
    function resideo_services_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array('data_content'), $attrs));

        if (!isset($attrs['data_content'])) {
            return null;
        }

        $s_array = json_decode(urldecode($attrs['data_content']), true);

        $return_string = '';

        $margin_class = $s_array['margin'] == 'yes' ? 'mt-100' : '';

        $bg_image = wp_get_attachment_image_src($s_array['image'], 'pxp-full');
        $bg_image_src = '';
        if ($bg_image != false) {
            $bg_image_src = $bg_image[0];
        }

        $text_color = isset($s_array['text_color']) ? 'color: ' . $s_array['text_color'] : '';
        $cta_color = isset($s_array['cta_color']) ? $s_array['cta_color'] : '';
        $cta_id = uniqid();

        switch ($s_array['layout']) {
            case '1':
                if (get_field('page_slug')=='single-community' or get_field('page_slug')=='single-community-ar' or is_tax('Community'))
                {
                    $return_string = 
                    '<div class="pt-100 pb-100 page_service1_community body_color' . esc_attr($margin_class) . '"  style="margin-bottom: 58px;">
                        <div class="container">
                            

                            <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                            <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg" style="height: 400px">
                                    <div style="display:none" ><textarea class="my_iframe">'.$s_array['youtube'].'</textarea></div>
                                    <div class="iframe_video" id="first_iframe_vedio" style="margin-top: 36px;background-color:#000">
                                        <img src="'.esc_url($bg_image_src).'">
                                    </div>

                                </div>
                            <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0" style="min-height: 284px; padding-left: 60px; margin-right: 0px !important">
                                    <p class="pxp-text-light" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</p>
                                    <h3 class="pxp-section-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</h3>';

                                if ($s_array['cta_sevice_text'] != '') {
                                   $return_string .=  
                                   '<div>
                                   <p style="padding-right: 10px; text-align: left;">'.html_entity_decode($s_array['cta_sevice_text']).'</p>
                                   </div>';
                                 }

                $service_i = 0;
                foreach ($s_array['services'] as $service) {
                    if ($service_i > 0) {
                        $item_margin = 'mt-3 mt-md-4';
                    }
                    $return_string .=  
                                    '<div class="pxp-services-h-item ' . esc_attr($item_margin) . '">
                                        <div class="media">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                            '<span class="mr-4 ' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                            '<img src="' . esc_url($image_src[0]) . '" class="mr-4" alt="' . esc_attr($service['title']) . '" />';
                        }
                    }
                    $return_string .= 
                                            '<div class="media-body">
                                                <h5 class="mt-0">' . esc_attr($service['title']) . '</h5>
                                                ' . esc_html($service['text']) . '
                                            </div>
                                        </div>
                                    </div>';
                    $service_i++;
                }
                if ($s_array['cta_link'] != '') {
                    $return_string .= 
                                    '<a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>';
                    if ($cta_color != '') {
                        $return_string .= 
                                    '<style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
                    }
                }
                //..
                $return_string .= 
                                '</div>
                                

                            </div>
                        </div>
                    </div>';
                }
                else{
                $return_string = '
                    <div class="pxp-services pxp-cover pt-100 mb-200 ' . esc_attr($margin_class) . '" style="background-image: url(' . esc_url($bg_image_src) . ');">
                        <h2 class="text-center pxp-section-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</h2>
                        <p class="pxp-text-light text-center" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</p>

                        <div class="container">
                            <div class="pxp-services-container rounded-lg mt-4 mt-md-5">';
                foreach ($s_array['services'] as $service) {
                    if ($service['link'] != '') {
                        $return_string .= 
                                '<a href="' . esc_url($service['link']) . '" class="pxp-services-item">';
                    } else {
                        $return_string .= 
                                '<div class="pxp-services-item">';
                    }
                    $return_string .= 
                                    '<div class="pxp-services-item-fig">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                        '<span class="' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                        '<img src="' . esc_url($image_src[0]) . '" alt="' . esc_html($service['title']) . '" />';
                        }
                    }
                    $service_cta_color = isset($service['ctacolor']) ? $service['ctacolor'] : '';
                    $return_string .= 
                                    '</div>
                                    <div class="pxp-services-item-text text-center">
                                        <div class="pxp-services-item-text-title">' . esc_html($service['title']) . '</div>
                                        <div class="pxp-services-item-text-sub">' . esc_html($service['text']) . '</div>
                                    </div>
                                    <div class="pxp-services-item-cta text-uppercase text-center" style="color: ' . esc_attr($service_cta_color) . '">' . esc_html($service['cta']) . '</div>';
                    if ($service['link'] != '') {
                        $return_string .= 
                                '</a>';
                    } else {
                        $return_string .= 
                                '</div>';
                    }
                }
                $return_string .= 
                                '<div class="clearfix"></div>
                            </div>
                        </div>
                    </div>';
                }
            break;
            case '2':
                $item_margin = '';
                if (get_field('page_slug') == 'home' or get_field('page_slug') == 'home-ar') {
                    
                    if (get_field('page_slug') == 'home-ar') {
                        $home_service = "home_service_ar";
                    }
                    else
                    {
                        $home_service = "home_service";
                    }
                  
                    $return_string = 
                    '<div class="pxp-services-h pt-80 pb-100 '. $home_service.' '. esc_attr($margin_class) . '" >
                        <div class="container">
                            <p class="pxp-text-light color_green" >' . esc_html($s_array['title']) . '</p>
                            <h2 class="pxp-section-featured-h2" style="' . esc_attr($text_color) . '; max-width: 450px;">' . esc_html($s_array['subtitle']) . '</h2>

                            <div class="pxp-services-h-container mt-4 mt-md-5">
                                <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg" style="background-image: url(' . esc_url($bg_image_src) . ');"></div>
                                <div class="pxp-services-h-items pxp-animate-in ml-0 ml-lg-5 mt-4 mt-md-5 mt-lg-0" >';
                $service_i = 0;
                foreach ($s_array['services'] as $service) {
                    if ($service_i > 0) {
                        $item_margin = 'mt-3 mt-md-4';
                    }
                    $return_string .= 
                                    '<div class="pxp-services-h-item ' . esc_attr($item_margin) . '">
                                        <div class="media">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                            '<span class="mr-4 ' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                            '<img src="' . esc_url($image_src[0]) . '" class="mr-4" alt="' . esc_attr($service['title']) . '" />';
                        }
                    }
                    $return_string .= 
                                            '<div class="media-body">
                                                <h5 class="mt-0">' . esc_attr($service['title']) . '</h5>
                                                ' . esc_html($service['text']) . '
                                            </div>
                                        </div>
                                    </div>';
                    $service_i++;
                }
                if ($s_array['cta_link'] != '') {
                    $return_string .= 
                                    '<a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in cta-style_arabic" id="cta-' . esc_attr($cta_id) . '" style="color: ; margin-left:100px;' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>';
                    if ($cta_color != '') {
                        $return_string .= 
                                    '<style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
                    }
                }
                $return_string .= 
                                '</div>
                            </div>
                        </div>
                    </div>';
                }
                elseif (get_field('page_slug')=='single-community' or get_field('page_slug')=='single-community-ar' or is_tax('Community'))
                {

                    $return_string = 
                    '<div class="pt-100 pb-100';
                    if ($s_array['cta_link'] != '') {
                        $return_string .= ' page_service';
                    } else{ $return_string .= ' page_service_community';} 
                    $return_string .= ' body_color' . esc_attr($margin_class) . '"  style=" padding-bottom: 70px;">
                        <div class="container">
                            

                            <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                            <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0" style="min-height: 284px">
                                    <p class="pxp-text-light" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</p>
                                    <h3 class="pxp-section-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</h3>';

                                if ($s_array['cta_sevice_text'] != '') {
                                   $return_string .=  
                                   '<div>
                                   <p style="padding-right: 10px; text-align: left;">'.html_entity_decode($s_array['cta_sevice_text']).'</p>
                                   </div>';
                                 }

                 $service_i = 0;
                 foreach ($s_array['services'] as $service) {
                    if ($service_i > 0) {
                        $item_margin = 'mt-3 mt-md-4';
                    }
                    $return_string .=  
                                    '<div class="pxp-services-h-item ' . esc_attr($item_margin) . '">
                                        <div class="media">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                            '<span class="mr-4 ' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                            '<img src="' . esc_url($image_src[0]) . '" class="mr-4" alt="' . esc_attr($service['title']) . '" />';
                        }
                    }
                    $return_string .= 
                                            '<div class="media-body">
                                                <h5 class="mt-0">' . esc_attr($service['title']) . '</h5>
                                                ' . esc_html($service['text']) . '
                                            </div>
                                        </div>
                                    </div>';
                    $service_i++;
                 }
                 if ($s_array['cta_link'] != '') {
                    $return_string .= 
                                    '<a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>';
                    if ($cta_color != '') {
                        $return_string .= 
                                    '<style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
                    }
                 }
                 //..
                 $return_string .= 
                                '</div>
                                <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg" style="height: 400px">
                                    <div style="display:none" ><textarea class="my_iframe">'.$s_array['youtube'].'</textarea></div>
                                    <div class="iframe_video" id="second_iframe_vedio" style="margin-top: 36px; background-color:#000">
                                        <img src="'.esc_url($bg_image_src).'">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>';
                }
                elseif (get_field('page_slug') == 'choosing-your-home-ar' or get_field('page_slug') == 'financing-your-home-ar' or get_field('page_slug')=="mission-vision-ar" or get_field('page_slug')=='partnership-ar' or get_field('page_slug')=='who-we-are-ar' or get_field('page_slug')=='our-history-ar' or get_field('page_slug') == 'howwecanhelpyouar' or get_field('page_slug') == 'careers-ar')
                {
                    if (get_field('page_slug')=='partnership-ar' or get_field('page_slug') == 'choosing-your-home-ar'  ) {
                        $ct_padding_bottom='ct_padding_bottom';
                    }
                    else
                    {
                        $ct_padding_bottom='';
                    }
                        
                        $return_string = 
                        '<div class="service_case2 pt-100 pb-100 page_service body_color' . esc_attr($margin_class) . '"  style="background: linear-gradient(90deg, #1D252C 50%, #fff 50%);">
                            <div class="container">';
                                    /*<img src="'. get_template_directory_uri().'/images/dots.png">*/
                                    
                                    $return_string .= '
                                

                                <div class="pxp-services-h-container mt-0 mt-md-0" >
                                <div class="pxp-services-h-items pxp-animate-in ml-0 '.(get_locale() == 'ar' ? '' : 'mr-lg-5').' mt-4 mt-md-5 mt-lg-0 service_img_min_height" style="'.(get_locale() == 'ar' ? 'padding-right: 0px; padding-left: 30px;' : '').'">';

                                if (get_field('page_slug')=="mission-vision-ar"){
                                    $return_string2 .= '<p class="pxp-text-light" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</p>
                                    <h3 class="pxp-section-h2 " style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</h3>';
                                    if ($s_array['cta_sevice_text'] != '') {
                                       $return_string2 .=  
                                       '<div class="service_case2_intro">
                                       <p style="padding-right: 10px; text-align: left;">'.html_entity_decode($s_array['cta_sevice_text']).'</p>
                                       </div>';
                                    }
                                    ob_start();
                                  ?>

                                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                      <ol class="carousel-indicators" style="top:0">
                                         <?php if( have_rows('vision_section') ): ?>
                                           
                                            <?php 
                                            $s=0;
                                            while( have_rows('vision_section') ): the_row(); 
                                                $title       = get_sub_field('title');
                                                $sub_title   = get_sub_field('sub_title');
                                                $text        = get_sub_field('text');
                                                $button_text = get_sub_field('button_text');
                                                $button_link = get_sub_field('button_link');
                                               
                                                ?>
                                               <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $s;?>" class="<?php if($s=="0"){echo 'active';}?>" style="background:#C2A022">aa</li>
                                            <?php 
                                                 $s++;
                                                endwhile; ?>
                                            
                                        <?php endif; ?>
                                        
                                        
                                        
                                      </ol>
                                      <div class="carousel-inner">

                                        <?php if( have_rows('vision_section') ): ?>
                                           
                                            <?php 
                                            $s=0;
                                            while( have_rows('vision_section') ): the_row(); 
                                                $title       = get_sub_field('title');
                                                $sub_title   = get_sub_field('sub_title');
                                                $text        = get_sub_field('text');
                                                $button_text = get_sub_field('button_text');
                                                $button_link = get_sub_field('button_link');
                                                $s++;
                                                ?>
                                                <div class="carousel-item <?php if($s=="1"){echo 'active';}?>"
                                                    style="margin-top: 50px;"
                                                    >
                                                  

                                                    <p class="pxp-text-light" ><?php echo $title;?></p>
                                                    <h3 class="pxp-section-h2" ><?php echo $sub_title;?></h3>
                                                    <div class="service_case2_intro">
                                                        <?php echo $text;?>
                                                    </div>
                                                    <a href="<?php echo $button_link;?>" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in pxp-in " id="cta-633be02f60e77" ><?php echo $button_text;?></a>
                                                </div>
                                            <?php endwhile; ?>
                                           
                                        <?php endif; ?>
                                        
                                        
                                        
                                       
                                      </div>
                                      
                                    </div>
                                  <?php
                                    $tt = ob_get_clean();

                                    $return_string .= $tt;
                                }
                                else
                                {
                                    $return_string .= '<p class="pxp-text-light" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</p>
                                    <h3 class="pxp-section-featured-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</h3>';
                                    if ($s_array['cta_sevice_text'] != '') {
                                       $return_string .=  
                                       '<div class="service_case2_intro">
                                       <p style="padding-right: 10px; text-align: left;">'.html_entity_decode($s_array['cta_sevice_text']).'</p>
                                       </div>';
                                     }
                                }
                                   
                                        

                                    

                    $service_i = 0;
                    foreach ($s_array['services'] as $service) {
                        if ($service_i > 0) {
                            $item_margin = 'mt-3 mt-md-4';
                        }
                        $return_string .=  
                                        '<div class="pxp-services-h-item ' . esc_attr($item_margin) . '">
                                            <div class="media">';
                        if ($service['isicon'] == '1') {
                            $return_string .= 
                                                '<span class="mr-4 ' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                        } else {
                            $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                            if ($image_src != false) {
                                $return_string .= 
                                                '<img src="' . esc_url($image_src[0]) . '" class="mr-4" alt="' . esc_attr($service['title']) . '" />';
                            }
                        }
                        $return_string .= 
                                                '<div 
                                                    <h5 class="mt-0">' . esc_attr($service['title']) . '</h5>
                                                    ' . esc_html($service['text']) . '
                                                </div>
                                            </div>
                                        </div>';
                        $service_i++;
                    }
                    if ($s_array['cta_link'] != '') {
                        if (get_field('page_slug')=="mission-vision" || get_field('page_slug')=="aboutus_new"){
                        }
                        else if(get_field('page_slug') !="mission-vision-ar")
                        {

                            $faqsbtn = $s_array['cta_label'];
                            icl_register_string("resideo", $faqsbtn,$faqsbtn);

                            $return_string .= 
                                        '<a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in '. $ct_padding_bottom .'" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . pll__($faqsbtn) . '</a>';
                        }

                        if ($cta_color != '') {
                            $return_string .= 
                                        '<style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
                        }
                    }
                    //..

                    $return_string .= 
                                    '</div>
                                    <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg" >'; 
                    if ($s_array['youtube'] != '') {
                        
                        $return_string .= 
                                        '<div style="display:none" ><textarea class="my_iframe">'.$s_array['youtube'].'</textarea></div>';
                                         $cust_playbtn2 = '<a id="ct-anim-play-video" class="ct-anim-video-play-button" href="#">
                                              <span></span>
                                            </a>';
                                    }
                                        
                    $return_string .= '<div class="iframe_video" id="third_iframe_vedio" style="margin-top: 36px; background-color:#000">
                                            <img src="'.esc_url($bg_image_src).'">'.$cust_playbtn2.'
                                            
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>';
                    
                }
                else
                {
                    if (get_field('page_slug')=='partnership' or get_field('page_slug')=='choosing-your-home'  ) {
                        $ct_padding_bottom='ct_padding_bottom';
                    }
                    else
                    {
                        $ct_padding_bottom='';
                    }
                    
                    $return_string = 
                    '<div class="pxp-services-h service_case2 pt-100 pb-100 page_service body_color' . esc_attr($margin_class) . '"  style="">
                        <div class="container">';
                                /*<img src="'. get_template_directory_uri().'/images/dots.png">*/
                                
                                $return_string .= '
                            

                            <div class="pxp-services-h-container mt-0 mt-md-0" >
                            <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 service_img_min_height" >';

                                if (get_field('page_slug')=="mission-vision"){
                                    $return_string2 .= '<p class="pxp-text-light" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</p>
                                    <h3 class="pxp-section-h2 " style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</h3>';
                                    if ($s_array['cta_sevice_text'] != '') {
                                       $return_string2 .=  
                                       '<div class="service_case2_intro">
                                       <p style="padding-right: 10px; text-align: left;">'.html_entity_decode($s_array['cta_sevice_text']).'</p>
                                       </div>';
                                    }
                                    ob_start();
                                  ?>

                                  <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                                      <ol class="carousel-indicators" style="top:0">
                                         <?php if( have_rows('vision_section') ): ?>
                                           
                                            <?php 
                                            $s=0;
                                            while( have_rows('vision_section') ): the_row(); 
                                                $title       = get_sub_field('title');
                                                $sub_title   = get_sub_field('sub_title');
                                                $text        = get_sub_field('text');
                                                $button_text = get_sub_field('button_text');
                                                $button_link = get_sub_field('button_link');
                                               
                                                ?>
                                               <li data-target="#carouselExampleIndicators3" data-slide-to="<?php echo $s;?>" class="<?php if($s=="0"){echo 'active';}?>" style="background:#C2A022">aa</li>
                                            <?php 
                                                 $s++;
                                                endwhile; ?>
                                            
                                        <?php endif; ?>
                                        
                                        
                                        
                                      </ol>
                                      <div class="carousel-inner">

                                        <?php if( have_rows('vision_section') ): ?>
                                           
                                            <?php 
                                            $s=0;
                                            while( have_rows('vision_section') ): the_row(); 
                                                $title       = get_sub_field('title');
                                                $sub_title   = get_sub_field('sub_title');
                                                $text        = get_sub_field('text');
                                                $button_text = get_sub_field('button_text');
                                                $button_link = get_sub_field('button_link');
                                                $s++;
                                                ?>
                                                <div class="carousel-item <?php if($s=="1"){echo 'active';}?>"
                                                    style="margin-top: 50px;"
                                                    >
                                                  

                                                    <p class="pxp-text-light" ><?php echo $title;?></p>
                                                    <h3 class="pxp-section-h2" ><?php echo $sub_title;?></h3>
                                                    <div class="service_case2_intro">
                                                        <?php echo $text;?>
                                                    </div>
                                                    <a href="<?php echo $button_link;?>" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in pxp-in " id="cta-62f7eec16f676" ><?php echo $button_text;?></a>

                                                </div>
                                            <?php endwhile; ?>
                                           
                                        <?php endif; ?>
                                        
                                        
                                        
                                       
                                      </div>
                                      
                                    </div>
                                  <?php
                                    $tt = ob_get_clean();

                                    $return_string .= $tt;
                                }
                                else
                                {
                                    $return_string .= '<p class="pxp-text-light" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</p>
                                    <h3 class="pxp-section-featured-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</h3>';
                                    if ($s_array['cta_sevice_text'] != '') {
                                       $return_string .=  
                                       '<div class="service_case2_intro">
                                       <p style="padding-right: 10px; text-align: left;">'.html_entity_decode($s_array['cta_sevice_text']).'</p>
                                       </div>';
                                     }
                                }
                                    

                                

                $service_i = 0;
                foreach ($s_array['services'] as $service) {
                    if ($service_i > 0) {
                        $item_margin = 'mt-3 mt-md-4';
                    }
                    $return_string .=  
                                    '<div class="pxp-services-h-item ' . esc_attr($item_margin) . '">
                                        <div class="media">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                            '<span class="mr-4 ' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                            '<img src="' . esc_url($image_src[0]) . '" class="mr-4" alt="' . esc_attr($service['title']) . '" />';
                        }
                    }
                    $return_string .= 
                                            '<div class="media-body">
                                                <h5 class="mt-0">' . esc_attr($service['title']) . '</h5>
                                                ' . esc_html($service['text']) . '
                                            </div>
                                        </div>
                                    </div>';
                    $service_i++;
                }
                if ($s_array['cta_link'] != '') {
                    if (get_field('page_slug')=="mission-vision" || get_field('page_slug')=="aboutus_new"){
                    }
                    else
                    {


                        $return_string .= 
                                    '<a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in '. $ct_padding_bottom .'" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '">' . esc_html($s_array['cta_label']) . '</a>';
                    }

                    if ($cta_color != '') {
                        $return_string .= 
                                    '<style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
                    }
                }
                //..
                $return_string .= 
                                '</div>
                                <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg" >'; 
                if ($s_array['youtube'] != '') {
                    $return_string .= 
                                    '<div style="display:none" ><textarea class="my_iframe">'.$s_array['youtube'].'</textarea></div>';
                                     $cust_playbtn = '<a id="ct-anim-play-video" class="ct-anim-video-play-button" href="#">
                                        <span></span>
                                      </a>';
                                }
                                    
                $return_string .= '<div class="iframe_video" id="third_iframe_vedio" style="margin-top: 36px; background-color:#000">
                                        <img src="'.esc_url($bg_image_src).'">'.$cust_playbtn.'
                                       
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>';
                }
                
                
            break;
            case '3':
                include_once("services_case3.php");
            break;
            case '4':
                include_once("services_case4.php");
            break;
            case '5':
            ?>
            <style type="text/css">
                .centrally_h{
                    display: inline;
                    font-weight: bolder;
                    font-size: 5.5rem;
                    color: #fff;
                }
                .centrally_p{
                    display: inline;
                    color: #fff;
                }
                .centrally_p_color{
                    color: #fff;
                }
                .tech_list{
                    margin-top: -84px;
                    color: #fff;
                    line-height: 30px;
                }
                .tech_cta:after{
                    border-top: 2px solid #fff !important;
                }
            </style>
            <?php
            if (get_field('page_slug')=='single-community' or get_field('page_slug')=='single-community-ar' or is_tax('Community'))
                {
                    if ($s_array['cta_link'] != '') {
                        $return_string = 
                        '<div class="pt-100 mt-100" style="background-color: #7B868C; background-size: cover; padding-bottom: 50px;">
                            <div class="container" style="padding-top: 30px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pxp-testim-1-intro" >
                                            <h5 class="pxp-section-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</h5>
                                        </div>';
                                        if ($s_array['cta_link'] != '') {
                                            $return_string .= 
                                            '<a href="' . esc_url($s_array['cta_link']) . '" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in tech_cta" id="cta-' . esc_attr($cta_id) . '" style="color: ' . esc_attr($cta_color) . '; margin-top: 15px !important">' . esc_html($s_array['cta_label']) . '</a>';
                                            if ($cta_color != '') {
                                                $return_string .= 
                                                            '<style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>';
                                            }
                                        }
                                    $return_string .=
                                    '</div>
                                    <div class="col-md-4">
                                        <div class="tech_list">
                                            <ul >
                                                <li>Double glazed windows with UPVC</li>
                                                <li>Waterproofing for foundation and footings</li>
                                                <li>Roof water proofing of foam material</li>
                                                <li>High quality lighting switches and sockets</li>
                                                <li>Power saving exhaust fans</li>
                                                <li>Provisions for split AC system with drain lines in the villa</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="tech_list">
                                            <ul>
                                                <li>High quality wash basins</li>
                                                <li>High quality water saving floor mounted toilets</li>
                                                <li>high quality Faucets</li>
                                                <li>High quality ceramic floor fr bathrooms floors and shower area walls</li>
                                                <li>Power and water saving high quality central water heater system</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
                            
                    $return_string .= 
                            '</div>
                        </div>';
                    }
                    else
                    {
                        $return_string = 
                        '<div class="pt-100 mt-100" style="background-image: url(' . esc_url($bg_image_src) . '); background-size: cover; padding-bottom: 50px">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pxp-testim-1-intro" >
                                            <p class="pxp-text-light" style="' . esc_attr($text_color) . '; padding-top:20px; font-weight: 600; font-size: 20px;">' . esc_html($s_array['title']) . '</p>
                                        </div>
                                    </div>
                                </div>';
                              $return_string 
                           .=   '<div class="row" style="padding: 20px;">';

                            $term_id    = $_GET['term_id'];
                            $term_id    = !empty($term_id) ? $term_id : get_the_ID();
                          
                            $tt         =   'term_'.$term_id;
                            $bd         =   get_field("location_distance",$tt);



                            if( have_rows('location_distance',$tt) ):

                                // Loop through rows.
                                while( have_rows('location_distance' ,$tt) ) : the_row();

                                    // Load sub field value.
                                    $time       = get_sub_field('time');
                                    $time_index = get_sub_field('time_index');
                                    $time_from  = get_sub_field('time_from');


                                    
                                    // Do something...
                                   $return_string .=  '<div class="col-md-2">
                                                            <h1 class="centrally_h">'.$time.'</h1><p class="centrally_p text-uppercase">'.$time_index.'</p>
                                                            <p class="pxp-text-light centrally_p_color" style="' . esc_attr($text_color) . ';">'.$time_from.
                                                            '</p>
                                                        </div>';
                                // End loop.
                                endwhile;


                            else :
                               
                            endif;
                                 
                            $return_string 
                                    .= '</div>';
                            
                            
                    

                    $return_string .= 
                            '</div>
                        </div>';
                    }
                }
            else{
                include_once("services_case5.php");
            }
               
            break;
            case '6':
                $section_id = uniqid();
                $return_string = 
                    '<div class="pxp-services-tabs ' . esc_attr($margin_class) . '">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2 class="pxp-section-h2 d-block d-lg-none" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</h2>
                                    <p class="pxp-text-light mt-3 mt-lg-4 d-block d-lg-none" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</p>
                                    <div class="pxp-services-tabs-items mt-4 mt-md-5 mt-lg-0">
                                        <div id="pxp-services-tabs-carousel-' . esc_attr($section_id) . '" class="carousel slide carousel-fade pxp-services-tabs-carousel" data-ride="carousel" data-interval="false">
                                            <div class="carousel-inner">';
                $count_services = 0;
                foreach ($s_array['services'] as $service) {
                    $service_bg = wp_get_attachment_image_src($service['bgvalue'], 'pxp-gallery');
                    $service_bg_src = '';
                    if ($service_bg != false) {
                        $service_bg_src = $service_bg[0];
                    }
                    $active_class = $count_services == 0 ? 'active' : '';
                    $return_string .=
                                                '<div class="carousel-item pxp-cover ' . esc_attr($active_class) . '" style="background-image: url(' . esc_url($service_bg_src) . ');"></div>';
                    $count_services++;
                }
                $return_string .= 
                                            '</div>
                                        </div>
                                        <div class="pxp-services-tabs-items-content">
                                            <div id="pxp-services-tabs-content-carousel-' . esc_attr($section_id) . '" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner">';
                $count_services = 0;
                foreach ($s_array['services'] as $service) {
                    $active_class = $count_services == 0 ? 'active' : '';
                    $return_string .=
                                                    '<div class="carousel-item ' . esc_attr($active_class) . '">';
                    if ($service['link'] != '') {
                        $return_string .= 
                                                        '<a href="' . esc_url($service['link']) . '" class="pxp-services-tabs-content-item">';
                    } else {
                        $return_string .= 
                                                        '<div class="pxp-services-tabs-content-item">';
                    }
                    $return_string .= 
                                                            '<div class="pxp-services-tabs-content-item-fig">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                                                '<span class="' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                                                '<img src="' . esc_url($image_src[0]) . '" alt="' . esc_attr($service['title']) . '" />';
                        }
                    }
                    $return_string .= 
                                                            '</div>
                                                            <div class="pxp-services-tabs-content-item-text">' . esc_html($service['text']) . '</div>';
                    if ($service['link'] != '') {
                        $service_cta_color = isset($service['ctacolor']) ? $service['ctacolor'] : '';
                        $return_string .= 
                                                            '<div class="pxp-services-tabs-content-item-cta-container">
                                                                <div class="pxp-services-tabs-content-item-cta text-uppercase" style="color: ' . esc_attr($service_cta_color) . '">
                                                                    <span>' . esc_html($service['cta']) . '</span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">';
                    if (is_rtl()) {
                        $return_string .= 
                                                                        '<g id="Group_30" data-name="Group 30" transform="translate(-1845.086 -1586.086)">
                                                                            <line id="Line_2" data-name="Line 2" x1="30" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2" style="stroke: ' . esc_attr($service_cta_color) . '"/>
                                                                            <line id="Line_3" data-name="Line 3" x1="9" y2="9" transform="translate(1846.5 1587.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2" style="stroke: ' . esc_attr($service_cta_color) . '"/>
                                                                            <line id="Line_4" data-name="Line 4" x1="9" y1="9" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2" style="stroke: ' . esc_attr($service_cta_color) . '"/>
                                                                        </g>';
                    } else {
                        $return_string .= 
                                                                        '<g id="Symbol_1_1" data-name="Symbol 1 - 1" transform="translate(-1847.5 -1589.086)">
                                                                            <line id="Line_5" data-name="Line 2" x2="30" transform="translate(1848.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2" style="stroke: ' . esc_attr($service_cta_color) . '" />
                                                                            <line id="Line_6" data-name="Line 3" x2="9" y2="9" transform="translate(1869.5 1590.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2" style="stroke: ' . esc_attr($service_cta_color) . '" />
                                                                            <line id="Line_7" data-name="Line 4" y1="9" x2="9" transform="translate(1869.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2" style="stroke: ' . esc_attr($service_cta_color) . '" />
                                                                        </g>';
                    }
                    $return_string .= 
                                                                    '</svg>
                                                                </div>
                                                            </div>';
                    }
                    if ($service['link'] != '') {
                        $return_string .= 
                                                        '</a>';
                    } else {
                        $return_string .= 
                                                        '</div>';
                    }
                    $return_string .= 
                                                    '</div>';
                    $count_services++;
                }
                $return_string .= 
                                                '</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-5">
                                    <h2 class="pxp-section-h2 d-none d-lg-block" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</h2>
                                    <p class="pxp-text-light mt-3 mt-lg-4 d-none d-lg-block" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</p>
                                    <ul class="carousel-indicators" data-id="' . esc_attr($section_id) . '">';
                $count_services = 0;
                foreach ($s_array['services'] as $service) {
                    $active_class = $count_services == 0 ? 'active' : '';
                    $return_string .=
                                        '<li data-target="#pxp-services-tabs-carousel-' . esc_attr($section_id) . '" data-slide-to="' . esc_attr($count_services) . '" class="' . esc_attr($active_class) . '">' . esc_attr($service['title']) . '</li>';
                    $count_services++;
                }
                $return_string .= 
                                    '</ul>
                                </div>
                            </div>
                        </div>
                    </div>';
            break;
            case '7':
                $return_string = 
                    '<div class="pxp-services-tilt ' . esc_attr($margin_class) . '">
                        <h2 class="text-center pxp-section-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</h2>
                        <p class="pxp-text-light text-center" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</p>

                        <div class="container mt-4 mt-md-5">
                            <div class="row justify-content-center">';
                foreach ($s_array['services'] as $service) {
                    $service_bg = wp_get_attachment_image_src($service['bgvalue'], 'pxp-gallery');
                    $service_bg_src = '';
                    if ($service_bg != false) {
                        $service_bg_src = $service_bg[0];
                    }

                    $return_string .=
                                '<div class="col-sm-12 col-md-6 col-lg-4">';
                    if ($service['link'] != '') {
                        $return_string .= 
                                    '<a href="' . esc_url($service['link']) . '" class="pxp-services-tilt-item">';
                    } else {
                        $return_string .= 
                                    '<div class="pxp-services-tilt-item">';
                    }
                    $return_string .= 
                                        '<figure class="pxp-services-tilt-item-fig pxp-cover rounded-lg" style="background-image: url(' . esc_url($service_bg_src) . ');">
                                            <figcaption class="pxp-services-tilt-item-caption">
                                                <div class="pxp-services-tilt-item-caption-icon">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                                    '<span class="' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                                    '<img src="' . esc_url($image_src[0]) . '" alt="' . esc_attr($service['title']) . '" />';
                        }
                    }
                    $return_string .= 
                                                '</div>
                                                <div class="pxp-services-tilt-item-caption-title">' . esc_html($service['title']) . '</div>
                                                <div class="pxp-services-tilt-item-caption-text">' . esc_html($service['text']) . '</div>
                                            </figcaption>
                                        </figure>';
                    if ($service['link'] != '') {
                        $return_string .= 
                                    '</a>';
                    } else {
                        $return_string .= 
                                    '</div>';
                    }
                    $return_string .= 
                                '</div>';
                }
                $return_string .=
                            '</div>
                        </div>
                    </div';
            break;
            default:
            case '1':
                $return_string = '
                    <div class="pxp-services pxp-cover pt-100 mb-200 ' . esc_attr($margin_class) . '" style="background-image: url(' . esc_url($bg_image_src) . ');">
                        <h2 class="text-center pxp-section-h2" style="' . esc_attr($text_color) . '">' . esc_html($s_array['title']) . '</h2>
                        <p class="pxp-text-light text-center" style="' . esc_attr($text_color) . '">' . esc_html($s_array['subtitle']) . '</p>

                        <div class="container">
                            <div class="pxp-services-container rounded-lg mt-4 mt-md-5">';
                foreach ($s_array['services'] as $service) {
                    if ($service['link'] != '') {
                        $return_string .= 
                                '<a href="' . esc_url($service['link']) . '" class="pxp-services-item">';
                    } else {
                        $return_string .= 
                                '<div class="pxp-services-item">';
                    }
                    $return_string .= 
                                    '<div class="pxp-services-item-fig">';
                    if ($service['isicon'] == '1') {
                        $return_string .= 
                                        '<span class="' . esc_attr($service['value']) . '" style="color: ' . esc_attr($service['color']) . '"></span>';
                    } else {
                        $image_src = wp_get_attachment_image_src($service['value'], 'pxp-icon');
                        if ($image_src != false) {
                            $return_string .= 
                                        '<img src="' . esc_url($image_src[0]) . '" alt="' . esc_html($service['title']) . '" />';
                        }
                    }
                    $service_cta_color = isset($service['ctacolor']) ? $service['ctacolor'] : '';
                    $return_string .= 
                                    '</div>
                                    <div class="pxp-services-item-text text-center">
                                        <div class="pxp-services-item-text-title">' . esc_html($service['title']) . '</div>
                                        <div class="pxp-services-item-text-sub">' . esc_html($service['text']) . '</div>
                                    </div>
                                    <div class="pxp-services-item-cta text-uppercase text-center" style="color: ' . esc_attr($service_cta_color) . '">' . esc_html($service['cta']) . '</div>';
                    if ($service['link'] != '') {
                        $return_string .= 
                                '</a>';
                    } else {
                        $return_string .= 
                                '</div>';
                    }
                }
                $return_string .= 
                                '<div class="clearfix"></div>
                            </div>
                        </div>
                    </div>';
            break;
        }

        return $return_string;
    }
endif;
?>