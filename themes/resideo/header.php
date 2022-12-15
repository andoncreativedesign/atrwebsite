<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/custom_client.css">
  

    <?php if (function_exists('resideo_get_social_meta')) {
        resideo_get_social_meta();
    }

    wp_head(); ?>
    <script type="text/javascript">
      
        jQuery(document).ready(function(){
            jQuery(".page_service").parent().parent().css("background-color","#fff");
            jQuery(".body_color").parents('body').css("background-color","#fff");

            jQuery(".iframe_video a").on("click",function (e){  
               e.preventDefault();
               var my_iframe = jQuery(".my_iframe").html();
               var img_h = jQuery(".iframe_video img").css('height')
               my_iframe = my_iframe.split('"').join("");
               my_iframe = my_iframe.replace(/&lt;/g, '<').replace(/&gt;/g, '>') ; 
              
                jQuery(".iframe_video").css("min-height",img_h );
                jQuery(".iframe_video").html(my_iframe);

            });
            jQuery(document).on("click","#submit_1",function (){
                jQuery("#submit_1").parents('form').find('input[type=submit]').click();
            });

            jQuery(document).on("click","#submit_contact_page",function (){
                jQuery("#contact_form_btn").click()
            });
            jQuery("#search_status").css("border-radius","0px");

            <?php 
            if (get_field('contact_btn_text') !='') {?>
                jQuery("#submit_1").html("<img src='<?php echo site_url();?>/wp-content/plugins/resideo-plugin/images/loader-dark.svg' class='pxp-loader pxp-is-btn' alt='...' style='display:none'> <?php echo get_field('contact_btn_text'); ?>");
            <?php }
            ?>

            // Counter....

            jQuery('.centrally_h').each(function () {
                jQuery(this).prop('Counter',0).animate({
                    Counter: jQuery(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function (now) {
                        jQuery(this).text(Math.ceil(now));
                    }
                });
            });

            // End Counter
          
        });
    </script>

    <style type="text/css">
      
        @media (min-width: 350px) and (max-width: 980px)
        {
            .home .pxp-testim-1-intro .pxp-section-h2 {color:#fff !important;}
            .home .pxp-contact-section .pxp-section-h2 {color:#fff !important;}
           .pxp-section-h2{ color: #333 !important ; }
           .technical-spc .pxp-section-h2 {color:#fff !important;}
           .service_case2_intro{color: #fff !important;}
           .service_case2_intro p{color: #000 !important; }
           /* .service_case2_intro.ct-cyh p{ color:#fff !important;} */
           <?php if(is_home() or is_front_page()){ ?>
              .pxp-services-h-fig {height: 400px; background-size: cover; }

           <?php }else { ?> 
              /* .pxp-services-h-fig {height: 200px} */
              .pxp-services-h-fig {height: auto;}
           <?php } ?>
         
           
           .iframe_video img{ width: 100%; }
           /* .service_img_min_height{ min-height: 400px; } */
           .pxp-section-h2{ color: #333 !important; }
           .caption_new{ padding: 10px !important; }
           .com_heading { color: #fff !important; }
           .centrally_p,.centrally_p_color{color: #fff !important;}
        }
        @media screen and (max-width: 980px) {
           
           .service_case2 h3 {color:#000 !important;}
           .pxp-services-h.service_case2 .pxp-primary-cta { color:#000 !important; }
           .service_case2 .pxp-primary-cta { color:#000 !important; }
           .pxp-services-h.service_case2 {
            margin-top:0 !important;
            padding-bottom:60px;
           }
           .rtl .service_case2.page_service {
            padding-bottom:60px;
           }
           .service_case_3 .pxp-services-h-items {
            padding-right:0;
           }
           .cust_people_info_cont.mt-100 {
            margin-top:0px !important;
           }
           .cust_people_info_cont .pxp-section-h2 {
            color:#fff !important;
           }
        }
    </style>
    <?php
    if(get_field('page_slug')=="financing-your-home-ar"){ 
        ?>
            <style type="text/css">
                .pxp-section-featured-h2.pxp-in {
                    font-weight: 900;
                }
                .pxp-primary-cta.pxp-in {
                }
                .disclaimer_style{
                    padding: 65px 0px !important;
                }
                .diclaimer_btns{
                    float: right;   
                }
                .diclaimer_btns button{
                    float: right !important;
                    margin-right: 0rem !important;
                    margin-left: .6rem !important;
                }
            </style>
        <?php
    }
    if(get_field('page_slug')=="testimonials-ar" or get_field('page_slug') == 'explore-our-communities-ar'){
        ?>
            <style type="text/css">
                .pxp-text-light {
                     color: #121212; 
                }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'explore-our-communities' or get_field('page_slug') == 'explore-our-communities-ar'){

        ?>
            <style type="text/css">
                .pxp-posts-1-item-details {
                margin-top: -2.4rem !important;
            }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'explore-our-communities-ar'){
        ?>
            <style type="text/css">
               .pxp-dark-mode .pxp-is-sticky .pxp-nav > div > ul > li ul, 
               .pxp-dark-mode .pxp-is-opaque .pxp-nav > div > ul > li ul, 
               .pxp-dark-mode .pxp-no-bg .pxp-nav > div > ul > li ul, 
               .pxp-dark-mode .pxp-full .pxp-nav > div > ul > li ul {
                background-color: transparent !important;
            }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'who-we-are-ar' or get_field('page_slug') == 'howwecanhelpyouar'){
        ?>
            <style type="text/css">
                .pxp-section-h2,.pxp-dark-mode .pxp-testim-1-intro .pxp-primary-cta {
                     color: #fff; 
                }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'who-we-are-ar'){
        ?>
            <style type="text/css">
                .iframe_video{
                    margin-top: 36px !important;
                }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'home-ar'){
        ?>
            <style type="text/css">

                <?php if(get_locale()=="ar"){ ?> 
                    .pxp-props-carousel-right-arrow{
                        right: unset;
                        left: 30px !important;
                    }
                <?php } ?>

                .pxp-services-h-fig {
                    height: 400px !important;
                    background-size:100%;
                }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'home'){
      ?>
 <style type="text/css">

.pxp-services-h-fig {
    height: 400px !important;
    background-size:100%;
}
</style>
      <?php
    }
    if(get_field('page_slug') == 'partnership-ar'){


        ?>

            <style type="text/css">
               .pxp-section-h2 {
                    color: #fff;
                }
                .pxp-dark-mode .pxp-testim-1-intro, .pxp-dark-mode .pxp-testim-1-intro .pxp-primary-cta {
                    color: #fff;
                }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'testimonials-ar'){
        ?>
            <style type="text/css">
                .pxp-text-light {
                     color: #4D858D; 
                }
            </style>
        <?php
    }
    if(strtolower(get_field('page_slug'))=="who-we-are-ar"){
        ?>
            <style type="text/css">
               .pxp-services-h-items {
                    padding-right: 93px;
                }
                .pxp-section-h3{
                    color: #333;
                }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'choosing-your-home-ar'){
        ?>
            <style type="text/css">
               .service_case2_intro p{
                    padding-right: 0px !important;
                    text-align: right !important;
                    margin-right: 0px !important;
                }
                .pxp-services-h-items {
                    padding-right: 0px !important;
                }
            </style>
        <?php
    }
    if( strtolower(get_field('page_slug'))=="faqs" or strtolower(get_field('page_slug'))=="choosing-your-home" or strtolower(get_field('page_slug'))=="choosing-your-home-ar" or strtolower(get_field('page_slug'))=="financing-your-home" or strtolower(get_field('page_slug')) == 'financing-your-home-ar' or strtolower(get_field('page_slug'))=="careers" or strtolower(get_field('page_slug'))=="faqs-ar" or strtolower(get_field('page_slug'))=="careers-ar")
    {?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/pagestyle.css">
        <?php
        if (strtolower(get_field('page_slug'))=="careers-ar") {
        ?>
        <style type="text/css">
            .careers_page .pt-100{
                background: linear-gradient(90deg, #4D858D 50%, #fff 50%);
            }
        </style>
        <?php    
        }
        if (get_field('page_slug') == 'choosing-your-home-ar' or get_field('page_slug') == 'financing-your-home-ar') {
        ?>
        <style type="text/css">
            .home-ar{
                background: linear-gradient(90deg, #7B868C 50%, #fff 50%);
            }
            /* .ct_animated_timeline ul li:nth-child(even) div {
                left: -45px;
                text-align: right;
            }
            .ct_animated_timeline ul li:nth-child(odd) div {
                left: 439px;
                text-align: right;
            } */
        </style>
        <?php    
        }
        ?>
        <style type="text/css">

            .owl-carousel.owl-drag .owl-item{
                width: 350px ;
            }

            @media only screen and (min-width: 819px) {
                .pxp-section-h2{  }
                .pxp-section-featured-h2{ color: #000 !important;}
               .service_case2_intro{color: #000 ;}
               .service_case2_intro p{color: #000 !important; }
               .service_img_min_height  .pxp-section-h2{ color: #fff !important; }
                
            }
            @media only screen and (max-width: 400px){
                .pxp-content {
                    overflow: hidden;
                }
                .custom_mouse_scroll_anim {
                    bottom: 11px !important;
                }
            }
        </style>

        <script src='<?php echo site_url(); ?>/wp-content/themes/resideo/js/popper.min.js?ver=1.0' id='popper-js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/animation.gsap.js" ></script>

        
        <?php
    }

   

    if( strtolower(get_field('page_slug'))=="home" or strtolower(get_field('page_slug'))=="home-ar")
    {
        ?>
        <style type="text/css"> 
        .pxp-prop-card-1-details{ bottom: 15px; }
        .pxp-prop-card-1-details-features {
            font-size: 13px;
            opacity: 1;
            left: 22px;
            position: absolute;

        }
        .pxp-section-h2 {
            color: #FFF;
        }
        .blog_heading{
            color: #333 !important;
        }
        .heading_col{
            color: black !important;
        }
        .pxp-dark-mode .pxp-testim-1-intro, .pxp-dark-mode .pxp-testim-1-intro .pxp-primary-cta {
            color: #fff;
        }
        .pxp-testim-1-item{
            height: 382px;
        }
        #submit_1{
            color: #fff;
        }
         
         /*@media (min-width: 350px) and (max-width: 980px){}
*/
        @media (min-width: 1500px) 
        {
            .pxp-props-carousel-right-stage-1 .owl-item { width: 30% !important; }
            .pxp-props-carousel-right-stage-1 .owl-stage{ padding-right: 0px !important; } 
            .pxp-cover{ background-size: cover !important; }

        }

        </style>
        <?php
    }

    if( get_field('page_slug')=='mission-vision' or get_field('page_slug')=='mission-vision-ar')
    {
        
        ?>
        <style type="text/css"> 
            .carousel-inner{
                min-height: 400px;
            }
            .rtl .carousel-inner{
                min-height: 370px;
            }
        </style>
        <?php
    }
    if(get_the_ID() == '68'){
        ?>
            <style type="text/css">
                .pxp-props-carousel-right-arrow {
                    right: 0px !important;
                    left: auto;
                }
                .pxp-props-carousel-left-arrow{
                    left: 0px !important;
                    right: auto;
                }
            </style>
        <?php
    }
    if(get_field('page_slug') == 'single-community'){
        ?>
        <style type="text/css">
            @media screen and (max-width: 980px) {
                .iframe_video{
                    margin-top: 0px !important;
                    height: 300px !important;
                }
                .pxp-services-h-fig{
                    height: auto !important;
                }
                .pxp-props-carousel-right.pxp-has-intro {
                    /* padding-left: 34px !important; */
                }
                .page_service {
                    background: #fff !important;
                }
               .pxp-text-light{
                color: #4D858D !important;
               }

               .centrally_p,.centrally_p_color{color: #fff !important;}
               .com_text{
                color: #fff !important;
               }
            }
            @media screen and (max-width: 576px){
                /* .iframe_video img {
                    height: 304px !important;
                } */
            }
        </style>
        <?php
    }
    if(get_field('page_slug') == 'single-community-ar')
    {
        ?>
        <style type="text/css"> 
            .pxp-props-carousel-right-intro {
                padding-right: 0px !important;
            }
            .carousel-inner{
                min-height: 400px;
            }
            .mr-lg-5, .mx-lg-5 {
                 margin-right: 0rem !important; 
            }
            .pxp-section-h2{
                color: #fff;
            }
            .main_heading_style{
                color: #333 !important;
            }
            @media screen and (max-width: 980px) {
                .pxp-props-carousel-right.pxp-has-intro .pxp-props-carousel-right-container {
                    width: 100% !important;
                }
                .iframe_video{
                    margin-top: 0px !important;
                    height: 300px !important;
                }
                .pxp-services-h-fig{
                    height: 400px !important;
                }
                .pxp-props-carousel-right.pxp-has-intro {
                    padding-left: 34px !important;
                }
                .page_service {
                    background: #fff !important;
                }
               .pxp-text-light{
                color: #4D858D !important;
               }

               .centrally_p,.centrally_p_color{color: #fff !important;}
               .com_text{
                color: #fff !important;
               }
               .pxp-primary-cta{
                 color: #333 !important;
               }
            }
            @media screen and (max-width: 576px){
                /* .iframe_video img {
                    height: 304px !important;
                } */
            }
        </style>
        <?php
    }

    if( strtolower(get_field('page_slug'))=="partnership" || strtolower(get_field('page_slug')) =="partnership-ar" )
    {
        
        ?>
        <style type="text/css"> 
            .pxp-nav > div > ul > li > a{color: #4D858D}
            .pxp-nav > div > ul > li > a:hover{color: #4D858D} 
        </style>
        <?php
    }
    if( strtolower(get_field('page_slug'))=="our-history")
    {
        ?>
        <style type="text/css">
        @media (min-width: 350px) and (max-width: 980px)
        {
               
        }
        @media (max-width:  350px){
            .caption_new {
                top: 24rem;
                width: 70%;
                max-width: 600px;
                height: 150px;
            }
          
            .timeline-wrapper {
                height: 500px;
                max-height: auto;
            }
        }
        /*.timeline-wrapper {
            overflow: hidden;
        }*/

        </style>
        <?php
    }

    if( strtolower(get_field('page_slug'))=="who-we-are" or strtolower(get_field('page_slug'))=="who-we-are-ar")
    {

        if ( strtolower(get_field('page_slug'))=="who-we-are-ar") 
        {?>
            <style type="text/css">
                                    
                    .board_member_1.boardmember .boardmember_info{
                        left:35%;
                        transform: translateX(11%);
                    }
                    .board_member_2.boardmember .boardmember_info{
                        left:35%;
                        transform: translateX(5%);
                    }
                    .board_member_3.boardmember .boardmember_info{
                        left:35%;
                        transform: translateX(8%);
                    }
                    .board_member_4.boardmember .boardmember_info{
                        left:35%;
                        transform: translateX(0%);
                    }

                    .board_member_5.boardmember .boardmember_info{
                        left:40%;
                        transform: translateX(0%);
                    }
                    .board_member_6.boardmember .boardmember_info{
                        left:40%;
                        transform: translateX(0%);
                    }
                    .board_member_7.boardmember .boardmember_info{
                        left:40%;
                        transform: translateX(0%);
                    }

            </style>
        <?php 
        }
        if( strtolower(get_field('page_slug'))=="who-we-are")
        {
            ?>
            <style type="text/css">
                .pxp-testim-1{ background-size: cover !important; }
                .tooltip_area{ background-color: #fff; position: absolute; }
                @media (min-width: 1500px) 
                {
                    .pxp-cover{ background-size: cover !important; }
                }
                @media (max-width: 400px)
                {
                    /* .pxp-dark-mode .pxp-services-h {
                        height: 1100px !important;
                    } */
                    .pxp-services-h-items .pxp-primary-cta{
                        color: #fff;
                    }
                    .service_case_3_intro p{
                        color: #00000 !important;
                    }
                    /* .iframe_video{
                        margin-top: 32rem !important;
                    } */
                    .mt-60{
                        margin-top: 0px !important;
                    }
                }

            </style>
     

        <script>
        jQuery(document).ready(function(){

        
            
            jQuery('.tooltip_area').css({
                position: 'absolute'
            }).hide();
            jQuery('area').each(function(i) {
                jQuery('area').eq(i).bind('mouseover', function(e) {
                   jQuery('.tooltip_area').eq(i).css({
                        top: e.pageY-100,
                        left: e.pageX
                    }).show()
                })
                jQuery('area').eq(i).bind('mouseout', function() {
                    jQuery('.tooltip_area').hide()
                })
            });

        });
        </script>
        <?php
        }
    }


    if( strtolower(get_field('page_slug'))=="howwecanhelpyou" or strtolower(get_field('page_slug')) == 'howwecanhelpyouar')
    {
        ?> 
        <style type="text/css">
            /*.pxp-props-carousel-right-container .owl-carousel.owl-drag .owl-item{
                width: 350px !important;
            }*/
            .how_we_help_you{
                color: black !important;
            }
            @media (min-width: 1500px) 
            {
                .pxp-cover{ background-size: cover !important; }
            }
        </style>
        <?php
    }

    if( strtolower(get_field('page_slug'))=="explore-our-communities" || strtolower(get_field('page_slug'))=="explore-our-communities-ar")
    {
        ?>
        <style type="text/css">
            body{ background-color: #fff !important; }
            @media (max-width: 980px)
            {
                 .container{ width: 123% !important; }
                 .pxp-footer{width: 117% !important; background-color: #1D252C;}
                 .pxp-footer .container{background-color: #1D252C;}
                 .fix_margin_show_community_listing .pxp-cover img{ width: 100%;  }
            }
            @media (max-width: 767px)
            {
                 .container{ width: 100% !important;}
                 .pxp-footer{width: 100% !important;}
                  h1.pxp-page-header {text-align: left;}
            }
        </style>
        <?php
    }

    if( strtolower(get_field('page_slug'))=="single-community" or strtolower(get_field('page_slug'))=="single-community-ar" or is_tax('Community') )
    {
        if (is_user_logged_in()) { ?>
            <style type="text/css">
                .pswp__scroll-wrap{
                    top: 25px !important;
                }
            </style>
            <?php
        }
        ?>
        <style type="text/css"> 
        @media only screen and (max-width:  1500px){
            .pxp-text-light{
                color: #fff;
            }
        }
        @media only screen and (min-width: 1441px) and (max-width: 2500px) {
            .com_heading{
                font-size: 1.55rem !important;
            }
        }
        @media only screen and (min-width: 981px) and (max-width: 1440px) {
            .com_heading{
                font-size: 1.25rem !important;
            }
        }
        @media only screen and (max-width: 980px)
        {
            .page_service{
                background: linear-gradient(90deg, #fff 50%, #fff 50%); 
                padding-bottom: 20px !important;
            }
            .pxp-content{
                overflow: hidden;
            }
            .page-template-tpl_community .custom_mouse_scroll_anim {
                bottom: 21px !important;
            }
            .com_heading{
                font-size: .8rem !important;
            }
            .pxp-services-h-items {
                flex: 1 !important;
                padding-top: 1rem;
                padding-bottom:1rem;
                padding-left: 0 !important;
                min-height: auto !important; 
                max-height: auto;
            } 
            .pxp-services-h-items-img{
                flex: 1 !important;
                padding-top: 7rem !important;
                padding-left: 0 !important;
            }
            .page_service {
                padding-bottom: 0px;
                padding-top: 0px;
            }
            .service-txt-data{
                 margin-left: 2.5rem;
                 margin-bottom: 1.9rem;
            }
            .centrally_h{
                font-size: 3.9rem!important;
            }
          /*  .iframe_video{
                margin-top: 12rem !important;
            }*/
            .page_service1_community{
                padding-top: 10px !important;
                margin-bottom: 20px !important;
            }
            .page_service1_community.comm_map{
                padding-top: 50px !important;
            }
            .container{
                max-width: 600px !important;
            }
            .pxp-services-h-fig iframe{
                width: 100% !important;
                height: 400px !important;
            }
            .page_service_community{padding-bottom: 10px !important;}
            .container-fluid{margin-top: 10px !important;}
            .page-template-tpl_community .cus_community_bar {
                transform: translateY(-1px);
            }
        }
        @media only screen and (max-width: 575px)
        {
            .iframe_video {
                height: 199px !important;
            }
            .container{
                max-width: 475px !important;
            }/*
            .iframe_video{
                margin-top: 26rem !important;
            }*/
            #first_iframe_vedio{
                margin-top: 0rem !important;
            }
            #second_iframe_vedio{
                margin-top: 0rem !important;
            }
            #third_iframe_vedio{
                margin-top: 0rem !important;
            }
            .col-sm-12{
                text-align: center;
            }
            .service-txt-data{
                 /* margin-left: 3rem; */
                 margin:0 auto;
                 margin-bottom: 1.7rem;
            }
            .centrally_h{
                font-size: 3.8rem!important;
            }
            .pxp-footer-bottom{
                text-align: center !important;
            }
            ul{
                margin-bottom: .1rem !important;
            }
            .col-sm-12{
                margin-top: 1rem !important;
            }
            .col-md-4{width: 100%;}
            .tech_list {
                margin-top: 4px !important;
                font-size: .6rem !important;
                line-height: 20px !important;
                margin-bottom: 10px !important;
            }
            .pxp-service-h-img {
                height: 400px !important;
                width: 100% !important;
            }
            .pxp-services-h-fig iframe {
                height: 304px !important;
            }
            /* .iframe_video img {
                height: 304px !important;
            } */
            .pxp-services-h-items {
                padding-top: 1rem;
                padding-bottom: 1rem;
                padding-left: 0 !important;
                min-height: auto !important; 
                max-height: auto;
            } 
        }
        @media only screen and (max-width: 350px)
        {
            .pxp-services-h-fig .design_img{
                width: 100% !important;
                height: 200px !important;
            }
            .pxp-services-h-items .decoration-txt{
                background: red !important;
            }
            .page-template-tpl_community .custom_mouse_scroll_anim {
                bottom: 12px;
            }
            .page-template-tpl_community .cus_community_bar {
                transform: translateY(0px);
            }
            .text-white{
                margin-right: 6rem !important;
                margin-left: 4rem !important;
            }
            .page_service1_community{
                padding-top: 7px !important;
                margin-bottom: 14px !important;
            }
            .pxp-services-h-fig{
                height: auto !important;
            }
            .pxp-services-h-fig iframe{
                height: 200px !important;
            }
            .pxp-service-h-img{
                height: 200px !important;
            }
            .pxp-services-h-items {
                padding-top: 1rem;
                padding-left: 0 !important;
                min-height:250px !important; 
                max-height: auto;} 
            .page_service {
                padding-bottom: 0px;
                padding-top: 0px;
            }
         /*   .iframe_video{
                margin-top: 26rem;
            }*/
            .service-txt-data{
                 /*margin-left: 3rem;*/
                 margin-bottom: 1.5rem;
            }
            .centrally_h{
                font-size: 3.4rem!important;
            }
            .pxp-cover{
                margin-top: 20px!important;
            }
            .page_service1_community{
                padding-top: 10px !important;
                margin-bottom: 20px !important;
            }
            .page_service_community{
                padding-bottom: 10px !important;
            }
            .container-fluid{
                margin-top: 20px !important;
            }
            .technical-spc{
                /*padding-bottom: 20px!important;*/
                margin-top: 10rem !important;
            }
            .pxp-services-height{
                padding-top: .4rem !important;
                height: 284px !important;
            }
            .col-sm-12{
                text-align: center;
            }
            .pxp-footer-bottom{
                text-align: center !important;
            }
            ul{
                margin-bottom: .1rem !important;
            }
            .col-sm-12{
                margin-top: 1rem !important;
            }
            .col-md-4{width: 100%;}
            .tech_list {
                margin-top: 4px !important;
                font-size: .6rem !important;
                line-height: 20px !important;
                margin-bottom: 10px !important;
            }
        }
        @media only screen and (max-width: 349px)
        {
            .page_service1_community .container .pxp-section-h2 {
                color: #000 !important;
            }
            
        }
        </style>
        <?php
    }
    if( strtolower(get_field('page_slug'))=="partnership" or strtolower(get_field('page_slug'))=="partnership-ar")
    {
        ?>
        <style type="text/css">
            :root {
              --level-1: #8dccad;
              --level-2: #f5cc7f;
              --level-3: #7b9fe0;
              --level-4: #f27c8d;
              --black: #fff;
            }
             
            
            .container_retain ol {
              list-style: none;
            }
             
            .container_wrapper {
              /*margin: 50px 0 100px;*/
              text-align: center;
            }
             
            .container_retain {
              max-width: 1000px;
              padding: 0 10px;
              margin: 0 auto;
            }
             
            .rectangle {
              position: relative;
              padding: 20px;
            }


            .level-1 {
            width: 50%;
            margin: 0 auto 40px;
            padding: 0px;
            }

            .level-1::before {
            content: "";
            position: absolute;
            top: 92%;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 77px;
            background: var(--black);
            }


            .level-2-wrapper {
              position: relative;
              display: grid;
              grid-template-columns: repeat(4, 1fr);
            }
             
            .level-2-wrapper::before {
              content: "";
              position: absolute;
              top: 29px;
              left: 12.5%;
              width: 63.5%;
              height: 2px;
              background: var(--black);
            }
             
            .level-2-wrapper::after {
              display: none;
              content: "";
              position: absolute;
              left: -20px;
              bottom: -20px;
              width: calc(100% + 20px);
              height: 2px;
              background: var(--black);
            }
             
            .level-2-wrapper li {
              position: relative;
              top: 47%;
            }
             
            .level-2-wrapper > li::before {
              content: "";
              position: absolute;
              bottom: 100%;
              left: 50%;
              transform: translateX(-50%);
              width: 2px;
              height: 20px;
              background: var(--black);
            }
            .level-2-wrapper .left_first::before {
              content: "";
              position: absolute;
              bottom: 78%;
              left: 33%;
              transform: translateX(-50%);
              width: 2px;
              height: 67px;
              background: var(--black);
            }
            .level-2-wrapper .left_second::before {
              content: "";
              position: absolute;
              bottom: 76%;
              left: 0%;
              transform: translateX(-50%);
              width: 2px;
              height: 70px;
              background: var(--black);
            }
            .level-2-wrapper .left_third::before {
              content: "";
              position: absolute;
              bottom: 76%;
              left: 100%;
              transform: translateX(-50%);
              width: 2px;
              height: 70px;
              background: var(--black);
            }
             
             
            .level-2 {
              width: 70%;
              margin: 0 auto 40px;
              /*background: var(--level-2);*/
              padding: 0px;
            }
             
            /*.level-2::before {
              content: "";
              position: absolute;
              top: 100%;
              left: 50%;
              transform: translateX(-50%);
              width: 2px;
              height: 20px;
              background: var(--black);
            }*/
             
            .level-2::after {
              display: none;
              content: "";
              position: absolute;
              top: 50%;
              left: 0%;
              transform: translate(-100%, -50%);
              width: 20px;
              height: 2px;
              background: var(--black);
            }
            .level-2_first{
                right: 33px;
                top: 29px;
            }
            .level-2_second{
                right: 119px;
                top: 31px;  
            }
            .level-2_third{
                left: 83px;
                top: 31px;
            }
        </style>
        <?php
    }
    if( strtolower(get_field('page_slug'))=="our-history") {
        ?>
        <style type="text/css">
            .timeline-slider.slick-initialized.slick-slider .slick-list{
                overflow: visible !important;
            }
            .caption_new{

            }
            .service_img_min_height {
                min-height:auto !important;
            }
        </style>
        <?php
    }
    if( strtolower(get_field('page_slug'))=="our-history-ar") {?>
        <!-- <style type="text/css">
        .rtl .service_case2.page_service {
        padding-bottom:0;
        }
         </style> -->
   <?php }
    if( strtolower(get_field('page_slug'))=="home-search" or strtolower(get_field('page_slug'))=="home-search-ar") { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('input.property_city_search').on('keyup',function(){
                    var val = jQuery('input.property_city_search').val();
                    var cti = jQuery("#city_term_id").val();
                    var spi = jQuery("#search_property_id").val(); 
                    if (val == '' && (cti != '' || spi != '') ) {
                        jQuery("#city_term_id").val('');
                        jQuery("#search_property_id").val('');
                        jQuery('.pxp-results-filter-form input[type=submit]').click();
                    }
                })
                setTimeout(function() {
                    jQuery('input.property_city_search').typeahead({
                        listen: function () {
                            this.$element
                            .on('blur',     $.proxy(this.blur, this))
                            .on('keypress', $.proxy(this.keypress, this))
                            .on('keyup',    $.proxy(this.keyup, this))
                            .on('click',    $.proxy(this.keyup, this))
                        },
                        source: function (query, process) {
                          if(typeof xhr!=="undefined"){
                            xhr.abort();
                          }
                          xhr = jQuery.ajax({
                            url: "<?php echo site_url();?>/",
                            type: "get",
                            data: 'prod_name='+query+"&v="+Math.random()+"&lang=<?php echo get_locale();?>",
                            dataType: 'JSON',
                            async: true,
                            success: function(data){
                              var resultList = data.map(function (item) {
                                var link = { href: item.href, name: item.emp_name, realname: item.realname, type: item.type };
                                return JSON.stringify(link);                   
                              });
                              return process(resultList);
                            }
                          })
                        },  
                        matcher: function (obj) {
                          var item = JSON.parse(obj);
                          return item;
                        },
                        sorter: function (items) {
                            return items;
                        },
                        highlighter: function (link) {      
                          var item = JSON.parse(link);        
                          var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&')
                          return item.name.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                              return '<strong>' + match + '</strong>'
                          })
                        },
                        updater: function (link) {
                          var item = JSON.parse(link);
                          var name = item.name;
                          var realname = item.realname;
                          var href = item.href;
                          var type = item.type;
                          setTimeout(function (){
                            if(type == 'city'){
                                jQuery("#city_term_id").val(href);
                                jQuery("#search_property_id").val(''); 
                            } else {
                                jQuery("#city_term_id").val('');
                                jQuery("#search_property_id").val(href);
                            }
                            jQuery(".property_city_search").val(realname); 
                            jQuery('.pxp-results-filter-form input[type=submit]').click();
                          },50)  
                        }
                    })
                },3000)
            })
        </script>
        <?php
    }
    ?>
    <style type="text/css">
        <?php if(get_locale()=="ar"){ ?> 
            .pxp-props-carousel-right-arrow{
                right: unset;
            }
        <?php } ?>
    </style>
   
</head>


<?php 
$submit_url       = function_exists('resideo_get_submit_url') ? resideo_get_submit_url() : '';
$wishlist_url     = function_exists('resideo_get_wishlist_url') ? resideo_get_wishlist_url() : '';
$searches_url     = function_exists('resideo_get_searches_url') ? resideo_get_searches_url() : '';
$myproperties_url = function_exists('resideo_get_myproperties_url') ? resideo_get_myproperties_url() : '';
$myleads_url      = function_exists('resideo_get_myleads_url') ? resideo_get_myleads_url() : '';
$account_url      = function_exists('resideo_get_account_url') ? resideo_get_account_url() : ''; ?>

<body <?php body_class(); ?>>
    <?php if (!function_exists( 'wp_body_open')) {
        function wp_body_open() {
            do_action('wp_body_open');
        }
    }

    $header_class = '';
    $header_container_class = 'container';

    $template = '';
    $post_type = '';
    if (isset($post)) {
        $template = get_post_meta($post->ID, 'page_template_type', true);
        $post_type = get_post_type($post);
    }

    $property_layout_settings = get_option('resideo_property_layout_settings');
    $property_layout = isset($property_layout_settings['resideo_property_layout_field']) ? $property_layout_settings['resideo_property_layout_field'] : 'd1';

    if (((is_page_template('property-search.php') || is_page_template('community-search.php')) && ($template == 'half_map_left' || $template == 'half_map_right') && wp_script_is('gmaps', 'enqueued')) 
        || (is_page_template('idx-map-left.php') && wp_script_is('gmaps', 'enqueued'))
        || (is_page_template('idx-map-right.php') && wp_script_is('gmaps', 'enqueued'))
        || ($post_type == 'property' && $property_layout == 'd4' && wp_script_is('gmaps', 'enqueued'))) {
        $header_class = 'pxp-full';
        $header_container_class = 'pxp-container-full';
    } else {
        $post = get_post();

        if (isset($post)) {
            $header_type = get_post_meta($post->ID, 'page_header_type', true);

            if (isset($header_type) && ($header_type == '' || $header_type == 'none')) {
                $header_class = 'pxp-animate pxp-no-bg';
            } else {
                $header_class = 'pxp-animate';
            }
        } else {
            $header_class = 'pxp-animate pxp-no-bg';
        }
    } 

    $appearance_settings = get_option('resideo_appearance_settings');
    $header_bg = isset($appearance_settings['resideo_header_background_field']) ? $appearance_settings['resideo_header_background_field'] : 'transparent';
    $header_bg_class = $header_bg == 'opaque' ? 'pxp-is-opaque' : ''; ?>

    <div class="pxp-header fixed-top <?php echo esc_html($header_class); ?> <?php echo esc_html($header_bg_class); ?>">
        <div class="<?php echo esc_html($header_container_class); ?>">
            <div class="row align-items-center no-gutters">
                <div class="col-6 col-lg-2 pxp-rtl-align-right">
                    <?php $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id , 'pxp-full');
                    $logo_class = $logo !== false ? 'pxp-has-img' : '';
                    $theme_url = get_template_directory_uri();
                    $second_logo_id = get_theme_mod('resideo_second_logo');
                    $second_logo = wp_get_attachment_image_src($second_logo_id , 'pxp-full');
                    $first_logo_class = $second_logo !== false ? 'pxp-first-logo' : ''; ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="pxp-logo text-decoration-none <?php echo esc_attr($logo_class); ?>">
                        <?php $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id , 'pxp-full');

                        if ($logo !== false) {
                            // print '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="' . esc_attr($first_logo_class) . '"/>';
                            if( strtolower(get_field('page_slug'))=="partnership") {
                                print '<img src="'.$theme_url.'/images/svg_logo/property_header_logo.svg" alt="' . esc_attr(get_bloginfo('name')) . '" class="' . esc_attr($first_logo_class) . '"/>';
                            } else {
                                print '<img src="'.$theme_url.'/images/svg_logo/top_header_logo.svg" alt="' . esc_attr(get_bloginfo('name')) . '" class="' . esc_attr($first_logo_class) . '"/>';
                            }
                            if ($second_logo !== false) {
                                // print '<img src="' . esc_url($second_logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="pxp-second-logo"/>';
                                print '<img src="'.$theme_url.'/images/svg_logo/green_bg_logo.svg" alt="' . esc_attr(get_bloginfo('name')) . '" class="pxp-second-logo"/>';
                            }
                        } else {
                            print esc_html(get_bloginfo('name'));
                        } ?>
                    </a>
                </div>
                <div class="col-1 col-lg-8 text-center">
                    <div class="pxp-nav">
                        <?php wp_nav_menu(array('theme_location' => 'primary','add_a_class' => 'topmenu_link')); ?>
                    </div>
                </div>
                <div class="col-5 col-lg-2 text-right">
                    
                    <?php $auth_settings = get_option('resideo_authentication_settings');
                    $user_nav = isset($auth_settings['resideo_user_registration_field']) ? $auth_settings['resideo_user_registration_field'] : '';

                    if ($user_nav == '1' and false) {
                        if (is_user_logged_in()) {
                            global $current_user;

                            $current_user = wp_get_current_user();
                            $user_avatar  = get_the_author_meta('avatar' , $current_user->ID);
                            $avatar_src   = wp_get_attachment_image_src($user_avatar, 'pxp-thmb');
                            $is_agent     = function_exists('resideo_check_user_agent') ? resideo_check_user_agent($current_user->ID) : false;

                            if ($avatar_src !== false) { ?>
                                <a href="javascript:void(0);" class="pxp-header-user-loggedin pxp-header-user-avatar" style="background-image: url(<?php echo esc_url($avatar_src[0]); ?>)"><span class="fa fa-user-o"></span></a>
                            <?php } else { ?>
                                <a href="javascript:void(0);" class="pxp-header-user-loggedin pxp-header-user"><span class="fa fa-user-o"></span></a>
                            <?php } ?>

                            <ul class="pxp-user-menu">
                                <?php if ($is_agent === true) { ?>
                                    <li><a href="<?php echo esc_url($submit_url); ?>"><?php esc_html_e('Submit New Property', 'resideo'); ?></a></li>
                                <?php } ?>

                                <li><a href="<?php echo esc_url($wishlist_url); ?>"><?php esc_html_e('Wish List', 'resideo'); ?></a></li>
                                <li><a href="<?php echo esc_url($searches_url); ?>"><?php esc_html_e('Saved Searches', 'resideo'); ?></a></li>

                                <?php if ($is_agent === true) { ?>
                                    <li><a href="<?php echo esc_url($myproperties_url); ?>"><?php esc_html_e('My Properties', 'resideo'); ?></a></li>
                                <?php } ?>

                                <?php if ($is_agent === true) { ?>
                                    <li><a href="<?php echo esc_url($myleads_url); ?>"><?php esc_html_e('My Leads', 'resideo'); ?></a></li>
                                <?php } ?>

                                <li><a href="<?php echo esc_url($account_url); ?>"><?php esc_html_e('Account Settings', 'resideo'); ?></a></li>
                                <li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php esc_html_e('Sign Out', 'resideo'); ?></a></li>
                            </ul>
                        <?php } else { ?>
                            <a href="javascript:void(0);" class="pxp-header-user pxp-signin-trigger"><span class="fa fa-user-o"></span></a>
                        <?php }
                    } 

                    ?>
                    <?php 
                    
                    if ( function_exists( 'pll_the_languages' ) ) 
                    {
                    ?>
                     <div class="lang_hover">
                     <a href="javascript:void(0);" class="pxp-header-user-loggedin pxp-header-user  language_switch_setting" style="border:0px"><span class="fa fa-globe "></span> <span class="switch_text"><?php echo strtoupper(pll_current_language());?></span> <i class="fa fa-angle-down"></i></a><?php

                        $args   = [
                            'show_flags' => 0,
                            'show_names' => 1,
                            'echo'       => 0,
                        ];
                        echo '<ul class="pxp-user-menu">'.pll_the_languages( $args ). '</ul>';
                    ?></div><?php
                    }
                    ?>
                    <a href="javascript:void(0);" class="pxp-header-nav-trigger"><span class="fa fa-bars"></span></a>
                    <style type="text/css">
                        .language_switch_setting { 
                            border: 0px !important; 
                        }
                        .language_switch_setting:hover{ 
                            background-color: transparent !important; color: #fff; 
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>

<?php if (function_exists('resideo_get_user_modal')) {
    resideo_get_user_modal();
} ?>