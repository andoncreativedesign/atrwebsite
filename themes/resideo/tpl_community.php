<?php /* Template Name: Community Dynamic */ ?>
<?php $theme_url = get_template_directory_uri(); 

global $post;
get_header();

$general_settings = get_option('resideo_general_settings'); 


$currency = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';

?>
<link rel="stylesheet" href="<?php echo $theme_url; ?>/css/colorbox.css" />
<script src="<?php echo $theme_url; ?>/js/jquery.colorbox.js"></script>
<script>
function closeGallery() {
            jQuery("#comm_gallery_previous").remove();
            jQuery("#comm_gallery_next").remove();
            jQuery("#comm_gallery_close").remove();
        }
        function openGallery() {
            
              jQuery("<div id='comm_gallery_previous'></div>").appendTo("body");
            jQuery("<div id='comm_gallery_next'></div>").appendTo("body");
            jQuery("<div id='comm_gallery_close'></div>").appendTo("body");
            jQuery("#comm_gallery_next").click(function(){
                jQuery.colorbox.next();

				})
				jQuery("#comm_gallery_previous").click(function(){
					jQuery.colorbox.prev();

				})
				jQuery("#comm_gallery_close").click(function(){
					jQuery.colorbox.close();

				})
        }
    jQuery(document).ready(function(){
        
        jQuery(".group").colorbox({rel:'group', transition:"fade", maxWidth:'95%', maxHeight:'95%',onOpen:function(){
                   openGallery();
				},
				onClosed:function(){
                    closeGallery();
                }
            
        });
    });
</script>
<style type="text/css">
     #comm_gallery_previous {position:fixed;left:0px;top:50%;color:#fff;font-size:30px;z-index:10000;}
	 #comm_gallery_next {position:fixed;right:0px;top:50%;color:#fff;font-size:30px;z-index:10000;}
	 #comm_gallery_close {position:fixed;right:0px;top:5px;color:#fff;font-size:30px;z-index:10000;}
    .custom_full_header .pxp-hero-opacity{ display: none;  }
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
    .centrally_p_h {
    margin-top:40px;
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
    .page_service1_community.comm_map {
        padding-top:100px;
    }
    
    <?php 
    
    if (get_locale()=='ar') {
        ?>
        .pxp-props-carousel-right{
            padding-left: unset !important;
        }
        .pxp-props-carousel-right.pxp-has-intro .pxp-props-carousel-right-container{
            width: 74.9% !important;
        }
        @media only screen and (max-width: 991px) {
        .pxp-props-carousel-right.pxp-has-intro.ct_communities_cont .pxp-props-carousel-right-container{
            width: 100% !important;
        }
    }
         
        .pxp-props-carousel-right-intro{
                padding-right: calc((100% - 1140px) / 2 + 15px);
        }
        .pxp-props-carousel-left-arrow{left: unset !important; right:-30px;}
        .pxp-props-carousel-right-arrow{right: unset !important; left:30px;}
        <?php
    }

   
    
    ?>
    @media only screen and (max-width: 575px) {
        .iframe_video .ct-anim-video-play-button {
            width:16px;
            height:22px;
        }
        .iframe_video .ct-anim-video-play-button:before {
            width:40px;
            height:40px;
        }
        .iframe_video .ct-anim-video-play-button:after {
            width:40px;
            height:40px;
        }
        .iframe_video .ct-anim-video-play-button span {
            border-left: 14px solid #fff;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
        }
     .page_service_community .pxp-services-h-fig > div{
            height:250px !important;
            margin-top:0 !important;
     }
     .page_service1_community .pxp-services-h-fig .pxp-service-h-img {
    height:250px !important;
     }
     .page_service_community .pxp-services-h-fig > div > img{
    height:250px !important;
     }
     .technical-spc.pt-100 {
        padding-top:30px;
     }
     .technical-spc.mt-100 {
        margin-top:0px;
     }
     .technical-spc .pxp-section-h2 {
        color:#fff !important;
     }
     .tech_list.pxp-in ul li {
      font-size:13px;
     }
     .page_service_community {
        padding-top:10px;
     }
    }
    @media only screen and (max-width: 576px) {
        .ct_communities_cont {
        max-width:540px;
    }
    }
    @media only screen and (max-width: 768px) {
        .page_service1_community .pxp-services-h-container {
   display:block;
    }
    /* .ct_communities_cont {
        max-width:720px;
    } */

    .rtl .technical-spc .row > div{
         text-align:right;
    }
    .technical-spc .row > div{
         text-align:left;
    }
    .technical-spc .tech_list ul li {
        font-size:14px;
    }
    .technical-spc .row > div:nth-child(2) {
        margin-bottom:0 !important;
        padding-bottom:0 !important;
    }
    .technical-spc .row > div:nth-child(2) .tech_list{
        margin-bottom:0 !important;
        padding-bottom:0 !important;
    }
    .technical-spc .row > div:nth-child(3) {
        margin-top:0 !important;
        padding-top:0 !important;
    }
    .technical-spc .row > div:nth-child(3) .tech_list{
        margin-top:0 !important;
        padding-top:0 !important;
    }
    }
    @media only screen and (max-width: 990px) {
    .technical-spc.mt-100 {
        margin-top:0;
    }
    .page_service_community .pxp-services-h-container {
        display:flex;
   flex-direction:column;
   align-items:baseline;
    }
    .page_service1_community.service1_interior .pxp-services-h-container {
   display:flex;
   flex-direction:column;
    }
    .page_service1_community.service1_interior .pxp-services-h-container .pxp-services-h-fig{
     order:2;
     margin-bottom:40px;
     width:100%;
    }
    .page_service1_community.service1_interior .pxp-services-h-container .pxp-services-h-items{ 
        order:1;
    }
    .ct_communities_cont {
        max-width:600px;
        padding-left:15px !important;
        padding-right:15px !important
    }
    .com_text {
        font-size:12px;
    }
}
/* @media only screen and (min-width: 768px) {
.ct_communities_cont {
        max-width:720px;
        padding-left:15px !important;
        padding-right:15px !important
    }
} */
@media only screen and (min-width: 991px) and (max-width: 1200px) { 
    .page_service_community .pxp-services-h-container {
   display:flex;
   align-items:flex-start;
    }
    .page_service1_community.service1_interior .pxp-services-h-container {
   display:flex;
   align-items:flex-start;
    }
    .page_service1_community .pxp-services-h-items .pxp-services-h-items.mr-lg-5 {
   margin-right:0px !important;
    }
}
@media only screen and (max-width: 1024px) {
    .page_service1_community.comm_map {
        padding-top:0px;
    }
    .ct_communities_cont.pxp-props-carousel-right.mt-100 {
        margin-top:100px !important;
    }
    .pxp-services-h-container {
   display:block;
    }
    .page_service1_community.comm_map .pxp-services-h-container {
   display:flex;
   flex-direction:column;
    }
    .page_service1_community.comm_map .pxp-services-h-container .pxp-services-h-items {
    order:1;
    width:100%;
    min-height:auto !important;
    }
    .page_service1_community.comm_map .pxp-services-h-container .pxp-services-h-items .pxp-primary-cta{
     margin-bottom:30px;
    }
    .page_service1_community.comm_map .pxp-services-h-container .pxp-services-h-fig {
    order:2;
    width:100%;
    }
    .page_service {
        background:none;
    }
    .page_service.pt-100 {
        padding-top:0;
    }
    .page_service .pxp-services-h-fig .iframe_video img{
        width:100%;
    }
    .page_service .pxp-services-h-fig {
        height:auto !important;
    }
    .page_service1_community {padding-top:0;margin-bottom:0 !important;}
    .page_service1_community.service1_interior .pxp-services-h-fig{
       height:auto !important;
    }
    .page_service_community .pxp-services-h-fig{
       height:auto !important;
    }
    .page_service1_community .pxp-services-h-items {
        /* padding-left:0 !important; */
        padding-top:25px;
    }
    .page_service1_community.service1_interior .pxp-services-h-items {
        padding-top:10px;
        margin-top:0px !important;
    }
    
   
    .page_service1_community.comm_map .pxp-services-h-items{
        padding-left:0 !important;
    }
    .rtl .page_service1_community.comm_map .pxp-services-h-items{
        padding-right:0 !important;
    }
    .pxp-props-carousel-right.mt-100 {
        margin-top:80px;
    }
  
    .page_service_community .pxp-services-h-items {
        min-height:auto !important;
    }
    .page_service1_community.service1_interior {
        margin-bottom:50px !important;
    }
}
@media only screen and (max-width: 990px) {
.rtl .page_service1_community.service1_interior .pxp-services-h-items{
       margin-right:0px !important;
    }
    .ct_communities_cont {
        max-width:600px;
    }
    .service1_interior .pxp-services-h-items {
        padding-left:0 !important;
    }
}
@media only screen and (max-width: 768px) {  
    .ct_communities_cont.pxp-props-carousel-right.mt-100 {
        margin-top:40px !important;
    }
    .page_service1_community.comm_map  {
      padding-top:0 !important;
    }
}
.comm_map iframe {
    border:0 !important;
    width:100%;
}

</style>
<div class="pxp-content">
    <?php while(have_posts()) : the_post();
        $post_ID     = get_the_ID();
        $header_type = get_post_meta($post_ID, 'page_header_type', true);

        $header_info                     = array();
        $header_info['post_id']          = $post_ID;
        $header_info['header_type']      = $header_type;
        $header_info['general_settings'] = $resideo_general_settings;

        if (function_exists('resideo_get_page_header')) {
            resideo_get_page_header($header_info);
        }

        $hide_page_title = get_post_meta($post_ID, 'page_title_hide', true);
        $page_margin_bottom = get_post_meta($post_ID, 'page_margin_bottom', true);

        $container_margin = 'mt-100';
        $content_wrapper_class = '';
        $page_title_margin = 'mt-100';

        if ($header_type == 'none' || $header_type == '') {
            $content_wrapper_class = 'pxp-content-wrapper mt-100';
            $container_margin = '';
            $page_title_margin = '';
        } 

        ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="<?php echo esc_attr($content_wrapper_class); ?>">
                

                <div class="">
            <?php
                $term_id    = $_GET['term_id'];
                $term       = get_term( $term_id);
               
                $community_name = $term->name;
                $contact_community_title = "INTERESTED IN <br>". $community_name. "?";
                icl_register_string("resideo",  $contact_community_title, $contact_community_title);
               $tt             =   'term_'.$term_id;
           //$term = get_queried_object();

                $price_from      =   get_field("price_from",$tt);
                $price_from      =   explode("|", $price_from);
                if(count($price_from)>1)
                {
                    $price_from2 = $price_from[1]; 
                }
                else
                {
                    $price_from2 = $price_from[1];
                }
                
                $area_from       =   get_field("area_from",$tt);
                $area_from      =   explode("|", $area_from);

                if(count($area_from)>1)
                {
                    $area_from2 = $area_from[1]; 
                }
                else
                {
                    $area_from2 = $area_from[1];
                }


                $available_units =   get_field("available_units",$tt);

                $available_units      =   explode("|", $available_units);

                if(count($available_units)>1)
                {
                    $available_units2 = $available_units[1]; 
                }
                else
                {
                    $available_units2 = $available_units[1];
                }

                $welcome_heading     =   get_field("welcome_heading",$tt);
                $welcome_sub_heading =   get_field("welcome_sub_heading",$tt);
                $welcome_description =   get_field("welcome_description",$tt);

                if (get_locale() == 'ar') {
                    $welcome_description = get_field("welcome_description_ar",$tt);   
                }
               

                $welcome_video       =   get_field("welcome_video",$tt);
                $welcome_cta_link    =   get_field("welcome_cta_link",$tt);


                $map_iframe         =   get_field("map_iframe",$tt);
                $map_heading        =   get_field("map_heading",$tt);
                $map_sub_heading    =   get_field("map_sub_heading",$tt);
                $map_cta_link       =   get_field("map_cta_link",$tt);
                $map_cta_text       =   get_field("map_cta_text",$tt);

                $centrally_heading  =   get_field("centrally_heading",$tt);
                $centrally_bg       =   get_field("centrally_bg_image",$tt);


                $tech_heading       =   get_field("tech_heading",$tt);
                $tech_list1         =   get_field("tech_list_one",$tt);
                $tech_list2         =   get_field("tech_list_two",$tt);
                $explore_title      =   get_field('explore_title');
                $explore_subtitle   =   get_field('explore_subtitle');
                $virtual_tour_tn = get_field("comm_virtualtour_thumbnail",$tt);

                icl_register_string("resideo", 'DOWNLOAD THE BROCHURE','DOWNLOAD THE BROCHURE');
                icl_register_string("resideo", 'VIEW GALLERY','VIEW GALLERY');
                icl_register_string("resideo", 'VIEW ALL PROJECTS','VIEW ALL PROJECTS');
                icl_register_string("resideo", 'SEARCH ALL PROPERTIES','SEARCH ALL PROPERTIES');
                icl_register_string("resideo", 'From','From');
                icl_register_string("resideo", 'Land Area','Land Area');
                icl_register_string("resideo", 'Units Remaining','Units Remaining');
                icl_register_string("resideo", 'View Details','View Details');
                icl_register_string("resideo", 'CONTACT US','CONTACT US');
                icl_register_string("resideo", 'INTERESTED IN ISHRAQ LIVING?','INTERESTED IN ISHRAQ LIVING?');
                icl_register_string("resideo", 'REQUEST A CALL BACK','REQUEST A CALL BACK');
                icl_register_string("resideo", 'Your name','Your name');
                icl_register_string("resideo", 'Phone number','Phone number');
                icl_register_string("resideo", 'Email','Email');

                icl_register_string("resideo", $welcome_sub_heading,$welcome_sub_heading);
                icl_register_string("resideo", $map_heading,$map_heading);                
                icl_register_string("resideo", $currency,$currency);
                icl_register_string("resideo", $centrally_heading,$centrally_heading);
                icl_register_string("resideo", $tech_heading,$tech_heading);              
                icl_register_string("resideo", $explore_title,$explore_title);     
                icl_register_string("resideo", $explore_subtitle,$explore_subtitle);
                icl_register_string("resideo", $welcome_heading,$welcome_heading);
                icl_register_string("resideo", $map_sub_heading,$map_sub_heading);



                if($price_from !="" or $area_from !="" or $available_units !="" ){ ?>
                    <div class="cus_community_bar">
                        <div class="container">
                            <div class="row">
                                <?php
                                if (get_field('page_slug')=='Single Community-ar') {
                                    $first_col = 'col-md-3';
                                    $last_col = 'col-md-5';
                                }
                                else
                                {
                                    $first_col = 'col-md-2';
                                    $last_col = 'col-md-6';   
                                }
                                if($price_from  !="" ) { 
                                    ?>
                                    <div class="<?php echo $first_col; ?>">
                                        <p class="pxp-text-light com_text">
                                            <?php
                                                // echo (isset($price_from[0]))?$price_from[0]:'Price from';
                                                $price_frm = isset($price_from[0])?$price_from[0]:'Price from';
                                               
                                                icl_register_string("resideo", $price_frm,$price_frm);
                                                echo pll__( $price_frm ); 
                                            ?>                                            
                                        </p>
                                        <h3 class="pxp-section-h2 com_heading">
                                            <?php 
                                                $price_from1 = $price_from[1] ." ".$currency; 

                                                icl_register_string("resideo", $price_from1,$price_from1);
                                                echo pll__( $price_from1 ); 
                                            ?>
                                        
                                        </h3>
                                    </div>
                                    <?php 
                                }

                                if($area_from !="" ) { ?>
                                    <div class="col-md-2">
                                        <p class="pxp-text-light com_text">
                                        <?php 
                                            // echo (isset($area_from[0]))?$area_from[0]:'Area from';
                                            $area_frm = isset($area_from[0])?$area_from[0]:'Area from';
                                            icl_register_string("resideo", $area_frm,$area_frm);
                                            echo pll__( $area_frm ); 
                                        ?>
                                    </p>
                                        <h3 class="pxp-section-h2 com_heading">
                                            <?php 
                                                $area_from1 = $area_from[1];  
                                                icl_register_string("resideo", $area_from1,$area_from1);
                                                echo pll__( $area_from1 ); 
                                            ?>
                                        </h3>
                                    </div>
                                    <?php
                                }
                                if($available_units !="" ) {
                                    ?>
                                   <div class="col-md-2">
                                        <p class="pxp-text-light com_text">
                                        <?php 
                                            // echo (isset($available_units[0]))?$available_units[0]:'Available units';
                                            $available_unts = isset($available_units[0])?$available_units[0]:'Available units';
                                            icl_register_string("resideo", $available_unts,$available_unts);
                                            echo pll__( $available_unts ); 
                                        ?>
                                        </p>
                                        <h3 class="pxp-section-h2 com_heading">
                                            <?php 
                                                $available_units1 = $available_units[1]; 
                                                icl_register_string("resideo", $available_units1,$available_units1);
                                                echo pll__( $available_units1 ); 
                                            ?></h3>
                                    </div>
                                    <?php 
                                }?>
                        
                                <div class="<?php echo $last_col; ?>" style="padding-top: 10px;">
                                    <button class="pxp-sp-top-btn" id="gallery" onclick="jQuery('.group:first').click()" style="background-color: #4D858D; color: #fff; border: 1px solid #fff; float:right; cursor: pointer;"><?php echo pll__( "VIEW GALLERY" ); ?></button>
                                </div>


                                
                                <div style="display: none">
                                    <?php
                                    $s = 0;
                                    if( get_field('gallery_pics',$tt)){
                                        while( the_repeater_field('gallery_pics',$tt) ): 
                                            $gallery_image = get_sub_field('gallery_image');
                                            if(!empty($gallery_image)){ ?>
                                                <p><a class="group" href="<?php echo $gallery_image; ?>"></a></p>
                                                <?php
                                            }
                                            $s++;
                                        endwhile;
                                    }?>
                                </div>
                        
                            </div>
                        </div>
                    </div>
                    <?php
                 }
            ?>
                    

                    <div class="pt-100 pb-100 page_service body_color" style=" padding-bottom: 70px;">
                        <div class="container">
                            
                            <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                                <div class="pxp-services-h-items pxp-animate-in mt-4 mt-md-5 mt-lg-0 pxp-in <?php echo (get_locale() == 'ar' ? 'mr-0 ml-lg-5' : 'ml-0 mr-lg-5'); ?>" style="">
                                    <p class="pxp-text-light" style="color: "><?php echo pll__( $welcome_heading ); ?></p>
                                    <h3 class="pxp-section-h2 pxp-section-new" style="color: ">
                                        <?php echo pll__( $welcome_sub_heading ); ?>
                                    </h3>
                                    <div>
                                   <p style="padding-right: 10px; text-align: left;"></p>
                                   <?php ((get_locale() == 'ar') ? $welcome_cta_link = "/home-search-ar":'')?>
                                   <p><?php echo $welcome_description; ?></p>
                                   </div><a href="<?php echo $welcome_cta_link; ?>" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in pxp-in" id="cta-6308a411ab9ef" style="color: "><?php echo pll__( "SEARCH ALL PROPERTIES" ); ?></a>
                                </div>
                                    <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in <?php echo (get_locale() == 'ar' ? 'ml-0 mr-lg-5' : ''); ?>" style="height: 400px">
                                        <div style="display:none"><textarea class="my_iframe"><?php echo $welcome_video; ?></textarea></div>
                                        <div class="iframe_video" style="margin-top: 36px; background-color:#000">
                                            <img src="<?php echo $virtual_tour_tn;?>">
                                            <a id="ct-anim-play-video" class="ct-anim-video-play-button" href="#">
                                        <span></span>
                                      </a>
                                      <span class="ct_viewvirtualtour">View the virtual tour</span>
                                        </div>

                                    </div>

                            </div>
                        </div>
                    </div>

                    <div class="pt-100 pb-100 page_service1_community comm_map body_color" style="margin-bottom: 58px; background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/07/contact_bg.png); background-repeat: no-repeat; background-position: top right;">
                        <div class="container">
                            <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                                <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in" style="height: 400px; -webkit-filter: grayscale(100%); filter: grayscale(100%);">
                                    
                                        <?php echo $map_iframe; ?>
                                </div>
                                <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 pxp-in" style="min-height: 284px; <?php echo (get_locale() == 'ar' ? 'padding-right: 60px;' : 'padding-left: 60px;'); ?> margin-right: 0px !important">
                                    <p class="pxp-text-light" style="color: ">
                                        <?php 
                                            // echo $map_heading; 
                                            echo pll__( $map_heading ); 
                                        ?>
                                            
                                    </p>
                                    <h3 class="pxp-section-h2" style="color: "><?php echo pll__( $map_sub_heading ); ?></h3>
                                    
                                   <a href="<?php echo $map_cta_link; ?>" target="_blank" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ebbdb9f0542" style="color: #333333">
                                   <?php //echo $map_cta_text;
                                        echo pll__( "View on google maps" ); 
                                   ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  explore community -->

                    <?php


    $args = array(
    'post_type' => 'property',
    'tax_query' => array(
        array(
            'taxonomy' => 'Community',
            'terms' => $term_id,
            'field' => 'term_id',
        )
    )
    );
    $the_query = new WP_Query( $args );
    

                        // The Loop
    if ( $the_query->have_posts() ) {
    ?>
    <style type="text/css">
        .pxp-prop-card-1:hover .pxp-prop-card-1-details {
            transform: translateY(-125%) !important;
        }
    </style>
    <div class="container-fluid pxp-props-carousel-right pxp-has-intro mt-100 ct_communities_cont">
        <div class="pxp-props-carousel-right-intro">
            <p class="pxp-text-light color_green"><?php echo pll__( $explore_title ); ?></p>

            <h2 class="pxp-section-h2 main_heading_style"><?php echo pll__( $explore_subtitle );?></h2> <a href="<?php echo $welcome_cta_link;?>" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ec109a104a3" style="color: #333333"><?php echo pll__( "VIEW ALL PROJECTS" ); ?></a>
            <style>
            .pxp-primary-cta#cta-62ec109a104a3:after {
                border-top: 2px solid #333333;
            }
            .pxp-prop-card-1-details-cta span.more_dtl{
                font-weight: 400;
            }
            </style>
        </div>
        <div class="pxp-props-carousel-right-container mt-4 mt-md-5 mt-lg-0">
            <div class="owl-carousel pxp-props-carousel-right-stage-1 owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1972px; padding-left: 30px; padding-right: 30px;">
                        <?php
                        $comm_props_array = Array();
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            $post_id=get_the_ID();
                            $title=get_the_title();
                            $link = get_the_permalink($post_id);
                            $img = wp_get_attachment_image_url($post_id,'full');

                            $gallery     = get_post_meta($post_id, 'property_gallery', true);
                            $photos      = explode(',', $gallery);
                            $first_photo = wp_get_attachment_image_src($photos[0], 'pxp-gallery');
                            $thumbnail   = get_field('thumbnail_image',$post_id);

                            array_push($comm_props_array,$title);
                            
                            if (!empty($thumbnail)) {
                                $p_photo = $thumbnail;
                            } else if (isset($first_photo[0]) && $first_photo[0] != '') {
                                $p_photo = $first_photo[0];
                            } else {
                                $p_photo = RESIDEO_PLUGIN_PATH . 'images/property-tile.png';
                            }




                            $p_price       = get_post_meta($post_id, 'property_price', true);
                            $p_price_label = get_post_meta($post_id, 'property_price_label', true);
                            
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

                            $p_beds  = get_post_meta($post_id, 'property_beds', true);
                            $p_baths = get_post_meta($post_id, 'property_baths', true);
                            $p_size  = get_post_meta($post_id, 'property_size', true);
                            $more_details = get_field('more_details',$post_id);
                            ?>

                            <div class="owl-item" style="width: 288.65px; margin-right: 30px;">
                                <!-- <div class=""> -->
                                    <a href="<?php echo $link;?>" class="pxp-prop-card-1 rounded-lg ">
                                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(<?php 
                                            if ($thumbnail != '') {
                                                echo $thumbnail;    
                                            }
                                            else {echo $p_photo ;}?>); background-size: cover;"></div>
                                        <div class="pxp-prop-card-1-gradient pxp-animate">
                                            <div class="pxp-prop-card-1-details">
                                                <div class="pxp-prop-card-1-details-title">
                                                    <?php echo $title ;?>
                                                </div>
                                                <div class="pxp-prop-card-1-details-price">
                                                    <?php
                                                        if(get_locale() == 'ar'){
                                                        ?><p style="font-weight:300;float:right;"><?php echo pll__( "From" ); ?> &nbsp;</p><?php
                                                        }
                                                        else
                                                        {
                                                           ?><p style="font-weight:300;float:left;"><?php echo pll__( "From" ); ?> &nbsp;</p><?php 
                                                        }
                                                    ?>
                                                    <?php 
                                                        // echo $p_price." ".$currency; 
                                                        $p_priceget = $p_price." ".$currency; 
                                                        icl_register_string("resideo", $p_price,$p_price);
                                                        icl_register_string("resideo", $currency,$currency);
                                                        echo pll__( $p_price )." ".pll__( $currency );
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="pxp-prop-card-1-details-cta text-uppercase">
                                                <div class="line" style="height: 1px;background-color: #FFFFFF;"></div>
                                                <div class="container-fluid mt-2">
                                                    <div class="row">
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__( "Land Area" ); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['land_area']) && $more_details['land_area'] > 0 ? $more_details['land_area'] : 0); ?> <?php  echo pll__( "SQF" ); ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php  echo pll__( "Bedrooms" ); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_beds;?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php  echo pll__( "Buildup Area" ); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['buildup_area']) && $more_details['buildup_area'] > 0 ? $more_details['buildup_area'] : 0); ?> <?php  echo pll__( "SQF" ); ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php  echo pll__( "Bathrooms" ); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_baths;?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php  echo pll__( "Floors" ); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['floors_total']) && $more_details['floors_total'] > 0 ? $more_details['floors_total'] : 0); ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__( "Units Remaining" ); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['units_remaining']) && $more_details['units_remaining'] > 0 ? $more_details['units_remaining'] : 0); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo pll__( "View Details" ); ?>
                                                
                                            </div>
                                        </div>
                                    </a>
                                <!-- </div> -->
                            </div>

                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
                <!-- <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev disabled">
                        <div class="pxp-props-carousel-left-arrow pxp-animate">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828" class="pxp-arrow-1">
                                <g id="Group_30" data-name="Group 30" transform="translate(-1845.086 -1586.086)">
                                    <line id="Line_2" data-name="Line 2" x1="30" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_3" data-name="Line 3" x1="9" y2="9" transform="translate(1846.5 1587.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_4" data-name="Line 4" x1="9" y1="9" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                </g>
                            </svg>
                        </div>
                    </button>
                    <button type="button" role="presentation" class="owl-next">
                        <div class="pxp-props-carousel-right-arrow pxp-animate">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                                <g id="Symbol_1_1" data-name="Symbol 1 – 1" transform="translate(-1847.5 -1589.086)">
                                    <line id="Line_2" data-name="Line 2" x2="30" transform="translate(1848.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_3" data-name="Line 3" x2="9" y2="9" transform="translate(1869.5 1590.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_4" data-name="Line 4" y1="9" x2="9" transform="translate(1869.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                </g>
                            </svg>
                        </div>
                    </button>
                </div> -->
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
    <?php
    }?>
    <!-- End Explore Community -->
    <div class="pt-100 mt-100" style="background-image: url(<?php echo $centrally_bg; ?>); background-size: cover; padding-bottom: 50px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pxp-testim-1-intro centrally_p_h">
                        <p class="pxp-text-light centrally_p" style="color: ; padding-top:20px; font-weight: 600; font-size: 20px;"><?php echo  pll__( $centrally_heading );  ?></p>
                    </div>
                </div>
            </div>
            <div class="row service-txt" style="padding: 20px;">
                <?php

                    if( have_rows('location_distance',$tt) ):


                        while( have_rows('location_distance',$tt) ) : the_row();


                            $time = get_sub_field('time');
                         
                            $time_index = get_sub_field('time_index');
                            $time_from = get_sub_field('time_from'); 

                            icl_register_string("resideo", $time_index,$time_index);
                            icl_register_string("resideo", $time_from,$time_from);
                            ?>
                            <div class="col-md-2 service-txt-data">
                                <h1 class="centrally_h"><?php echo $time; ?></h1><p class="centrally_p text-uppercase"><?php echo  pll__( $time_index ); ?></p>
                                <p class="pxp-text-light centrally_p_color" style="color: ;"><?php echo  pll__( $time_from ); ?></p>
                            </div>
                            <?php 
                        
                        endwhile;

                    
                    else :
                        
                    endif;
                ?>
                
            </div>
        </div>
    </div>
    <!-- Features -->
    <?php
    $s=0;

    if( have_rows('design_features',$tt) ):
        // Loop through rows.
        while( have_rows('design_features' ,$tt) ) : the_row();
            
            $heading           = get_sub_field('heading');
            $sub_heading       = get_sub_field('sub_heading');
            icl_register_string("resideo", $heading,$heading);
            icl_register_string("resideo", $sub_heading,$sub_heading);

            $description       = get_sub_field('description');
            if (get_locale()=='ar') {
                $description = get_sub_field('description_ar');   
            }
           

            $image             = get_sub_field('image');
            $image_gallery     = get_sub_field('image_gallery');
            if( $s%2 == 0 ) { ?>
                <div class="pt-100 pb-100 page_service_community body_color" style=" padding-bottom: 70px;">
                    <div class="container">

                        <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                            <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 pxp-in" style="min-height: 284px;<?php echo (get_locale() == 'ar' ? 'margin-left: 60px !important' : ''); ?>">
                                <p class="pxp-text-light" style="color: "><?php echo  pll__( $heading );?></p>
                                <h3 class="pxp-section-h2" style="color: "><?php echo  pll__( $sub_heading );?></h3>
                                <div>
                                     <p style="padding-right: 10px; text-align: left;"><?php echo $description; ?></p>
                                </div>
                            </div>
                            <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in" style="height: auto;">
                                <div class="" style="margin-top: 0px; background-color:#000">
                                    <img src="<?php echo $image; ?>" class="design_img">
                                    <div style="width: 40px; height: 40px; background-color: #fff; position: absolute; bottom: 20px; right: 30px">
                                        <img style="padding: 12px; cursor: pointer;" id="gallery" data-toggle="modal" onclick="jQuery('.group<?php echo $s; ?>:first').click()" src="<?php echo site_url(); ?>/wp-content/uploads/2022/08/ic_zoom_out_map_24px.png" style="padding: 12px;">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div style="display: none">
                            <?php foreach ($image_gallery as $img) { ?>
                                <p><a class="group<?php echo $s; ?>" href="<?php echo $img; ?>"></a></p>
                                <?php
                            } ?>
                        </div>
                        <script>
                            jQuery(document).ready(function(){
                                jQuery(".group<?php echo $s; ?>").colorbox({rel:'group<?php echo $s; ?>', transition:"fade", maxWidth:'95%', maxHeight:'95%',onOpen:function(){
                                     openGallery();
				},
				onClosed:function(){
				    closeGallery();
				}
                                    
                                });
                            });
                        </script>

                    </div>
                </div>
                <?php
            }
            else { ?>
                <div class="pt-100 pb-100 page_service1_community service1_interior body_color" style="margin-bottom: 58px;">
                    <div class="container">

                        <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                            <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in" style="height: auto;">
                                
                                <div class="pxp-service-h-img" style="margin-top: 0px; background-color:#000">
                                    <img src="<?php echo $image; ?>" class="pxp-service-h-img">
                                    <div style="width: 40px; height: 40px; background-color: #fff; position: absolute; bottom: 20px; right: 30px">
                                        <img style="padding: 12px; cursor: pointer;" id="gallery" data-toggle="modal" onclick="jQuery('.group<?php echo $s; ?>:first').click()" src="<?php echo site_url(); ?>/wp-content/uploads/2022/08/ic_zoom_out_map_24px.png" style="padding: 12px;">
                                    
                                    </div>
                                </div>

                            </div>
                            <div class="pxp-services-h-items pxp-services-height pxp-animate-in ml-0 mt-4 mt-md-5 mt-lg-0 pxp-in" style="min-height: 284px;<?php echo (get_locale() == 'ar' ? 'padding-left:0px; margin-right: 60px' : 'padding-left: 60px; margin-right: 0px !important'); ?>">
                                <p class="pxp-text-light" style="color: "><?php echo  pll__( $heading );?></p>
                                <h3 class="pxp-section-h2" style="color: "><?php echo  pll__( $sub_heading );?></h3><div>
                                   <p style="padding-right: 10px; text-align: left;" class="decoration-txt">
                                       <?php echo $description; ?>
                                   </p>
                               </div>
                            </div>

                        </div>

                        <div style="display: none">
                            <?php foreach ($image_gallery as $img) { ?>
                                <p><a class="group<?php echo $s; ?>" href="<?php echo $img; ?>"></a></p>
                                <?php
                            } ?>
                        </div>
                        <script>
                            jQuery(document).ready(function(){
                                jQuery(".group<?php echo $s; ?>").colorbox({rel:'group<?php echo $s; ?>', transition:"fade", maxWidth:'95%', maxHeight:'95%',onOpen:function(){
                                    openGallery();
				},
                    onClosed:function(){
                        closeGallery();
                    }
                                });
                            });
                        </script>
                        
                    </div>
                </div>
                <?php 
            }
            ?>
            <!-- <div class="modal fade bd-example-modal-lg" id="exampleModal_<?php echo $s; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carouselExample_<?php echo $s; ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                <?php
                                if(is_array($image_gallery) && count($image_gallery) > 0){
                                    foreach($image_gallery as $key => $url){
                                        ?>
                                        <div class="carousel-item <?php echo ($key == 0 ? "active" : ""); ?>">
                                            <img class="d-block w-100" src="<?php echo $url; ?>">
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?php echo $image; ?>">
                                    </div>
                                    <?php
                                } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample_<?php echo $s; ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample_<?php echo $s; ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <?php
            $s++;

        // End loop.
        endwhile;

    else :

    endif;
    ?>

    <!-- End Features -->


    <!-- Technical specification -->

    <div class="pt-100 mt-100 technical-spc" style="background-color: #7B868C; background-size: cover;">
        <div class="container" style="padding-top: 30px;">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="pxp-testim-1-intro">
                        <h5 class="pxp-section-h2" style="color: "><?php echo pll__( $tech_heading ); ?></h5>
                    </div><a href="#" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in tech_cta pxp-in" id="cta-6308a821e3ae7" style="color: #ffffff !important; margin-top: 15px !important"><?php echo pll__( "DOWNLOAD THE BROCHURE" ); ?></a><style>.pxp-primary-cta#cta-6308a821e3ae7:after { border-top: 2px solid #ffffff; }</style></div>
                <div class="col-md-4 col-sm-12">
                    <div class="tech_list">
                        <ul>
                            <?php if( have_rows('tech_list_one',$tt) ): ?>
                                
                                <?php while( have_rows('tech_list_one',$tt) ): the_row(); 
                                    $center_column = get_sub_field('center_column');
                                    icl_register_string("resideo", $center_column,$center_column);
                                    ?>
                                    <li>
                                        <?php echo pll__( $center_column ); ?>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="tech_list">
                        <ul>
                            <?php if( have_rows('tech_list_two',$tt) ): ?>
                                
                                <?php while( have_rows('tech_list_two',$tt) ): the_row(); 
                                    $right_column = get_sub_field('right_column');
                                    icl_register_string("resideo", $right_column,$right_column);
                                    ?>
                                    <li>
                                        <?php echo pll__( $right_column ); ?>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div></div>
    </div>


    <!-- End Technical specification -->


    <!-- Contact Form -->

    <div class="pxp-contact-section pxp-cover pt-50 pb-100" style="background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/07/contact_bg.png)">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-4 align-left order-1">
                    <p class="pxp-text-light" style="color: ; color: #4D858D; font-weight: 700;"><?php echo pll__( "CONTACT US" ); ?></p>
                    <h2 class="pxp-section-h2 main_heading_style" style="text-transform:uppercase; "><?php echo pll__( $contact_community_title ); ?></h2>
                </div>
                <div class="col-lg-1 col-xl-1 order-2">
                </div>
                <div class="col-lg-7 align-left order-3"><div role="form" class="wpcf7" id="wpcf7-f654-p719-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
                    <form action="/single-community/?term_id=48#wpcf7-f654-p719-o1" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="654">
                            <input type="hidden" name="_wpcf7_version" value="5.6.1">
                            <input type="hidden" name="_wpcf7_locale" value="en_US">
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f654-p719-o1">
                            <input type="hidden" name="_wpcf7_container_post" value="719">
                            <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                        </div>
                        <div class="pxp-contact-section-form mt-5 mt-lg-0">
                            <h2 class="pxp-section-h2"></h2>
                            <p></p>
                            <div class="pxp-contact-section-form-response mt-4"></div>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span class="wpcf7-form-control-wrap" data-name="your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="pxp-contact-section-form-name" aria-required="true" aria-invalid="false" placeholder="<?php echo pll__( "Your name" ); ?>"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span class="wpcf7-form-control-wrap" data-name="your-phone"><input type="text" name="your-phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="pxp-contact-section-form-phone" aria-required="true" aria-invalid="false" placeholder="<?php echo pll__( "Phone number" ); ?>"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span class="wpcf7-form-control-wrap" data-name="your-email"><input type="text" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="pxp-contact-section-form-email" aria-required="true" aria-invalid="false" placeholder="<?php echo pll__( "Email" ); ?>"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                       <span class="wpcf7-form-control-wrap" data-name="your-project">
                                          <select name="your-project" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false">
                                             <?php  foreach ($comm_props_array as $value) { ?>
                                               <option value="<?php echo $value;?>"><?php echo $value;?></option>
                                            
                                             <?php } ?>
                                            </select>
                                        </span>
                                    </div> 
                                    </div>
                                </div>
                                <p>                                    <a href="javascript:void(0);" id="submit_1" class="pxp-primary-cta text-uppercase pxp-animate mt-3 mt-md-4" style="color: ; float: right; padding-right:5px"><img src="<?php echo site_url(); ?>/wp-content/plugins/resideo-plugin/images/loader-dark.svg" class="pxp-loader pxp-is-btn" alt="..." style="display:none"> <?php echo pll__( "REQUEST A CALL BACK" ); ?></a></p>
                                <div style="display:none">
                                    <input type="submit" value="Send" class="wpcf7-form-control has-spinner wpcf7-submit ddd" id="main_submit"><span class="wpcf7-spinner"></span>
                                </div>
                            </div>
                        </div>
                        <p style="display: none !important;"><label>Δ<textarea name="_wpcf7_ak_hp_textarea" cols="45" rows="8" maxlength="100"></textarea></label><input type="hidden" id="ak_js_1" name="_wpcf7_ak_js" value="1661511711949"><script>document.getElementById( "ak_js_1" ).setAttribute( "value", ( new Date() ).getTime() );</script></p><div class="wpcf7-response-output" aria-hidden="true"></div></form></div>
                    </div>
                </div>
            </div>
        </div>

    <!-- End Contact Form -->
                    <div class="clearfix"></div>
                    <?php wp_link_pages(
                        array(
                            'before'      => '<div class="pagination pxp-paginantion mt-2 mt-md-4">',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '%',
                            'separator'   => '',
                        )
                    ); ?>
                </div>
            </div>
        </div>

        <?php 
    endwhile; ?>
</div>
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

<?php if ($page_margin_bottom == '1') {
    get_footer();
} else {
    get_footer('nospace');
} ?>

