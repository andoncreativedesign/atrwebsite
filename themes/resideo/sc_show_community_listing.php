<?php 
function show_community_listing_fn()
{
    ob_start();
    ?>
    <div class="container ">
        <div class="row mt-4 mt-md-5">
            <style type="text/css" >
            .pxp-prop-card-1-details {
                background-color: yellowgreen !important;
            }
            .fix_margin_show_community_listing{ margin-top: 0px; }
            .pxp-content-wrapper{background-image: url('<?php echo get_template_directory_uri()."/images/explore_our_communities_bg.png"?>');}
            .contact_bg{ background-image: url('<?php echo get_template_directory_uri()."/images/explore_our_communities_footer_bg.png"?>') !important;} }
            .pxp-posts-1-item-details{
                text-decoration: none !important;
            }
            .pxp-posts-1-item-details:hover{
                text-decoration: none !important;
            }
            .pxp-posts-1-item-details-category,.pxp-posts-1-item-details-title,.pxp-posts-1-item-details-date{
                text-decoration: none !important;                
            }
            </style>
            <div class="row fix_margin_show_community_listing">
                
                <?php
                $terms = get_terms( 'Community', array(
                                'hide_empty' => false,
                                "orderby"=>'term_id',
                                "order"=>'asc'
                            ) );

                #print "<pre>";print_r($terms); print "</pre>";
                foreach($terms as $term)
                {

                    $term_id    =   $term->term_id;
                
                    $tt         =   'term_'.$term_id;
                    
                    $img2       =   get_field("image",$tt);
                    $c_f_image  =   get_field("community_front_image",$tt);
                    $title      =   $term->name;
                    $bd         =   get_field("no_of_bad",$tt);
                    $ba         =   get_field("no_of_bath",$tt);
                    $sq         =   get_field("area_size_sqft",$tt);

                    $before_title =   get_field("label_before_title",$tt);
                    $property_label_bed =   get_field("property_label_bed",$tt);
                    icl_register_string("resideo", $before_title,$before_title);
                    icl_register_string("resideo", $title,$title);
                    icl_register_string("resideo", $property_label_bed,$property_label_bed);
                    // icl_register_string("resideo", 'Type','Type');
                ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <?php 
                        $link = site_url()."/single-community/?term_id=".$term_id;
                        if(get_locale() == 'ar'){
                            $link = str_replace("/single-community","/ar/single-community-ar",$link);
                        } 
                    ?>
                    <a href="<?php echo $link;?>" class="listing_item">
                        <div class="pxp-posts-1-item-fig-container">
                            <div class="pxp-posts-1-item-fig pxp-cover"> 
                                <img src="<?php echo $c_f_image;?>" style="height: 370px;"> 
                            </div>
                        </div>
                        <div class="pxp-posts-1-item-details">
                            <div class="pxp-posts-1-item-details-category"><?php echo pll__($before_title); ?></div>
                            <div class="pxp-posts-1-item-details-title"><?php echo pll__($title);?></div>
                            <div class="pxp-posts-1-item-details-date mt-2"><?php echo pll__($property_label_bed);?></div>
                            <!-- <div class="pxp-posts-1-item-details-date mt-2"><?php echo $bd;?> BD<span>|</span><?php echo $ba;?> BA<span>|</span><?php echo $sq;?> SF</div> -->
                            <div class="pxp-posts-1-item-cta text-uppercase" style="color: "><?php echo $bd;?> <?php echo pll__("BD"); ?><span>|</span><?php echo $ba;?> BA<span>|</span><?php echo $sq;?> <?php echo pll__("SF"); ?></div>
                        </div>
                    </a>
                </div>
                <?php 
                }
                ?>

               
            </div>
        </div>
       
    </div>
    <?php
    return ob_get_clean();

    
}

add_shortcode('show_community_listing','show_community_listing_fn');