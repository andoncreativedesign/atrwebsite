<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

/**
 * Promo slider shortcode
 */
if (!function_exists('resideo_slider_promo_shortcode')): 
    function resideo_slider_promo_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array('data_content'), $attrs));

        if (!isset($attrs['data_content'])) {
            return null;
        }

        $s_array = json_decode(urldecode($attrs['data_content']), true);

        $margin_class = $s_array['margin'] == 'yes' ? 'mt-100' : '';
        $section_class = 'pb-300';
        $caption_class = '';

        $ctas_color = isset($s_array['ctas_color']) ? $s_array['ctas_color'] : '';
        $uniq_id = uniqid();

        $interval   = isset($s_array['interval']) ? $s_array['interval'] : '';

        $data_interval = 'false';
        if ($interval != '' && $interval != '0') {
            $data_interval = intval($interval) * 1000;
        }

        switch ($s_array['position']) {
            case 'topLeft':
                $section_class = 'pb-300';
                $caption_class = '';
            break;
            case 'topRight':
                $section_class = 'pb-300';
                $caption_class = 'justify-content-end';
            break;
            case 'centerLeft':
                $section_class = 'pt-200 pb-200';
                $caption_class = '';
            break;
            case 'center':
                $section_class = 'pt-200 pb-200';
                $caption_class = 'justify-content-center';
            break;
            case 'centerRight':
                $section_class = 'pt-200 pb-200';
                $caption_class = 'justify-content-end';
            break;
            case 'bottomLeft':
                $section_class = 'pt-300';
                $caption_class = '';
            break;
            case 'bottomRight':
                $section_class = 'pt-300';
                $caption_class = 'justify-content-end';
            break;
            default:
                $section_class = 'pb-300';
                $caption_class = '';
            break;
        }
        if ( get_field('page_slug')=='Single Community' or get_field('page_slug')=='Community dynamic' or get_field('page_slug')=='Single Community-ar' or is_tax('Community')) {
            
            if(@$_GET['term_id']!="")
            {
                $term_id    = $_GET['term_id'];
                $term_id    = !empty($term_id) ? $term_id : get_the_ID();
                $term       = get_term( $term_id);
                

               $tt             =   'term_'.$term_id;


                $price_from      =   get_field("price_from",$tt);
                $area_from       =   get_field("area_from",$tt);
                $available_units =   get_field("available_units",$tt);
                
               
              
                if($price_from !="" or $area_from !="" or $available_units !="" )
                {


                    $return_string = 
                        '<div class="cus_community_bar">
                            <div class="container">
                                <div class="row">';
                            if($price_from !="" )
                            {
                                $return_string .= '<div class="col-md-2">
                                        <p class="pxp-text-light com_text">Price from</p>
                                        <h3 class="pxp-section-h2 com_heading">'.$price_from.'</h3>
                                    </div>';
                            }
                             if($area_from !="" )
                            {
                                $return_string .= '<div class="col-md-2">
                                        <p class="pxp-text-light com_text">Area from</p>
                                        <h3 class="pxp-section-h2 com_heading">'.$area_from.'</h3>
                                    </div>';
                            }
                             if($available_units !="" )
                            {
                                $return_string .= '<div class="col-md-2">
                                        <p class="pxp-text-light com_text">Available units</p>
                                        <h3 class="pxp-section-h2 com_heading">'.$available_units.'</h3>
                                    </div>';
                            }
                            
                            
                                  
                            /*$return_string .=  '
                                    <div class="col-md-6" style="padding-top: 10px;">
                                        <button class="pxp-sp-top-btn" style=" background-color: #4D858D; color: #fff; border: 1px solid #fff; float:right;">VIEW GALLERY</button>
                                    </div>';*/
                            


                            $return_string .=  '
                                    <div class="col-md-6" style="padding-top: 10px;">
                                        <button class="pxp-sp-top-btn" id="gallery" data-toggle="modal" data-target="#exampleModal" style="background-color: #4D858D; color: #fff; border: 1px solid #fff; float:right;">VIEW GALLERY</button>
                                    </div>
                                    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner"> ';
                            
                                                    $s = 0;
                                                    if( get_field('gallery_pics',$tt) ){
                                                        while( the_repeater_field('gallery_pics',$tt) ): 
                                                            $return_string .=   '
                                                            <div class="carousel-item '.($s == 0 ? "active" : "").'">
                                                                <img class="d-block w-100" src="'.get_sub_field('gallery_image').'">
                                                            </div>';
                                                            $s++;
                                                        endwhile;
                                                    }

                            $return_string .=           '</div>
                                                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';

                            $return_string .=  '
                                </div>
                            </div>
                        </div>';  
                 } 
            }
            
        }
        else
        {
            $return_string = 
                '


                <div class="owl-carousel owl-theme custom_owl feature_carousal_22">';
                    $count = 0;
                    foreach ($s_array['slides'] as $slide) {
                        $active_slide = '';
                        ob_start();
                        print_r($slide);
                        $aa = ob_get_clean();

                        $image_src = wp_get_attachment_image_src($slide['value'], 'pxp-full');
                        $return_string .= 
                                    '
                                    <div class="item">
                                        <img src="' . esc_url($image_src[0]) . '" > 
                                        <h5 >' . esc_html($slide['title']) . '</h5>
                                            <p class="pxp-text-light">' . esc_html($slide['text']) . '</p>
                                    </div>';
                        $count++;
                    }
                    

                    $return_string .= 
                '</div>';
        }
            ob_start()
            ?>
            
            <script>
             
                <?php 
                if(get_locale()=="ar")
                {
                    ?>
                    var arrow_html2 = "<div class='nav-btn prev-slide'><svg xmlns='http://www.w3.org/2000/svg' width='32.414' height='20.828' viewBox='0 0 32.414 20.828'> <g id='Group_30' data-name='Group 30' transform='translate(-1845.086 -1586.086)'> <line id='Line_2' data-name='Line 2' x1='30' transform='translate(1846.5 1596.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_3' data-name='Line 3' x1='9' y2='9' transform='translate(1846.5 1587.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_4' data-name='Line 4' x1='9' y1='9' transform='translate(1846.5 1596.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> </g> </svg></div>";

                    
                    var arrow_html = "<div class='nav-btn next-slide'><svg xmlns='http://www.w3.org/2000/svg' width='32.414' height='20.828' viewBox='0 0 32.414 20.828'> <g id='Symbol_1_1' data-name='Symbol 1 - 1' transform='translate(-1847.5 -1589.086)'> <line id='Line_2' data-name='Line 2' x2='30' transform='translate(1848.5 1599.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_3' data-name='Line 3' x2='9' y2='9' transform='translate(1869.5 1590.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_4' data-name='Line 4' y1='9' x2='9' transform='translate(1869.5 1599.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> </g> </svg></div>";



                    <?php 
                }else{
                    ?> 

                    var arrow_html = "<div class='nav-btn prev-slide'><svg xmlns='http://www.w3.org/2000/svg' width='32.414' height='20.828' viewBox='0 0 32.414 20.828'> <g id='Group_30' data-name='Group 30' transform='translate(-1845.086 -1586.086)'> <line id='Line_2' data-name='Line 2' x1='30' transform='translate(1846.5 1596.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_3' data-name='Line 3' x1='9' y2='9' transform='translate(1846.5 1587.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_4' data-name='Line 4' x1='9' y1='9' transform='translate(1846.5 1596.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> </g> </svg></div>";


                    var arrow_html2 = "<div class='nav-btn next-slide'><svg xmlns='http://www.w3.org/2000/svg' width='32.414' height='20.828' viewBox='0 0 32.414 20.828'> <g id='Symbol_1_1' data-name='Symbol 1 - 1' transform='translate(-1847.5 -1589.086)'> <line id='Line_2' data-name='Line 2' x2='30' transform='translate(1848.5 1599.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_3' data-name='Line 3' x2='9' y2='9' transform='translate(1869.5 1590.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_4' data-name='Line 4' y1='9' x2='9' transform='translate(1869.5 1599.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> </g> </svg></div>";
                    <?php 
                }
                ?>
            </script>
            <script>jQuery(document).ready(function (){
                



                jQuery('.owl-carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    responsiveClass:true,
                    navText:[arrow_html,arrow_html2],
          
                     nav:false,
                      pagination: false,
                    responsive:{
                        0:{
                            items:1,
                            nav:true,
                             loop:true
                        },
                        600:{
                            items:3,
                            nav:true,
                             loop:true
                        },
                        1000:{
                            items:4,
                            nav:true,
                            loop:true,
                            stagePadding: 100,

                        }
                    }
                })

        
            });
            </script>
            <style type="text/css">
                .owl-nav.disabled {display: block !important;}
                .owl-nav.disabled .fa{ color: #fff }
                .prev-slide *{ color:#fff }
                .owl-prev:focus{ outline: transparent; }
                .next-slide *{ color:#fff }
                .owl-next:focus{ outline: transparent; }
                .cus_community_bar{
                    background-color: #4D858D;
                    padding: 20px;
                }
                .com_text{
                    margin: 0px;
                    color: #fff;
                }
                .com_heading{
                    color: #fff;
                }
                .feature_carousal_22 .owl-dots{ display: none !important; }



            </style>
            <?php
            $tt = ob_get_clean();

            $return_string =$return_string.$tt;
            return $return_string;
        
    }
endif;
?>