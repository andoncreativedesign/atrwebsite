<?php 
function wpb_promo_slider_shortcode() {  

    $s_array = json_decode(urldecode($attrs['data_content']), true);
  
    ob_start();
    ?>
          <div class="owl-carousel owl-theme custom_owl feature_carousal_22">';
            <?php 
                $count = 0;
                foreach ($s_array['slides'] as $slide) {
                    $active_slide = '';
                    print_r($slide);

                    $image_src = wp_get_attachment_image_src($slide['value'], 'pxp-full');
                    ?>
                        <div class="item">
                            <img src="<?Php esc_url($image_src[0]);?>" > 
                            <h5 ><?Php esc_html($slide['title']); ?>'</h5>
                                <p class="pxp-text-light"><?Php esc_html($slide['text']);?></p>
                        </div>';
                    <?php
                    $count++;
                }
            ?>
        </div>;

        <script>jQuery(document).ready(function (){
       
            jQuery('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                responsiveClass:true,
                navText:["<div class='nav-btn prev-slide'>"+

                "<svg xmlns='http://www.w3.org/2000/svg' width='32.414' height='20.828' viewBox='0 0 32.414 20.828'> <g id='Group_30' data-name='Group 30' transform='translate(-1845.086 -1586.086)'> <line id='Line_2' data-name='Line 2' x1='30' transform='translate(1846.5 1596.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_3' data-name='Line 3' x1='9' y2='9' transform='translate(1846.5 1587.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_4' data-name='Line 4' x1='9' y1='9' transform='translate(1846.5 1596.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> </g> </svg>"+
                "</div>","<div class='nav-btn next-slide'>"+

                "<svg xmlns='http://www.w3.org/2000/svg' width='32.414' height='20.828' viewBox='0 0 32.414 20.828'> <g id='Symbol_1_1' data-name='Symbol 1 - 1' transform='translate(-1847.5 -1589.086)'> <line id='Line_2' data-name='Line 2' x2='30' transform='translate(1848.5 1599.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_3' data-name='Line 3' x2='9' y2='9' transform='translate(1869.5 1590.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> <line id='Line_4' data-name='Line 4' y1='9' x2='9' transform='translate(1869.5 1599.5)' fill='none' stroke='#fff' stroke-linecap='round' stroke-width='2'></line> </g> </svg>"
                +"</div>"],
      
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
    
    return ob_get_clean();
}
add_shortcode('show_promo_slider', 'wpb_promo_slider_shortcode');