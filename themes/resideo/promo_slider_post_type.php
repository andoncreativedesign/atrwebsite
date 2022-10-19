<?php 
    
    add_action( 'init', 'create_promo_slider_posttype22' );
    function create_promo_slider_posttype22() 
    {
  
        $labels = array(
            'name'                => _x( 'Why us features', 'Post Type General Name', 'twentytwentyone' ),
            'singular_name'       => _x( 'Why us features', 'Post Type Singular Name', 'twentytwentyone' ),
            'menu_name'           => __( 'Why us features', 'twentytwentyone' ),
            'parent_item_colon'   => __( 'Parent Slider', 'twentytwentyone' ),
            'all_items'           => __( 'All Why us features', 'twentytwentyone' ),
            'view_item'           => __( 'View Why us features', 'twentytwentyone' ),
            'add_new_item'        => __( 'Add New Slider', 'twentytwentyone' ),
            'add_new'             => __( 'Add New', 'twentytwentyone' ),
            'edit_item'           => __( 'Edit Slider', 'twentytwentyone' ),
            'update_item'         => __( 'Update Slider', 'twentytwentyone' ),
            'search_items'        => __( 'Search Slider', 'twentytwentyone' ),
            'not_found'           => __( 'Not Found', 'twentytwentyone' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
        );
          
        $args = array(
            'label'               => __( 'Why us features', 'twentytwentyone' ),
            'description'         => __( 'Why us features comments and reviews', 'twentytwentyone' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
           
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
      
        );

         register_post_type( 'why_us_features',
            array(
                'labels' => array(
                    'name' => __( 'Why us features' ),
                    'singular_name' => __( 'Why us features' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'why_us_features'),
                'show_in_rest' => true,
      
            )
        );


    }

function why_us_features_fn()
{
    ob_start();
    $term_id    = $_GET['term_id'];
    $term_id    = !empty($term_id) ? $term_id : get_the_ID();


    ?>
        <div class="owl-carousel owl-theme custom_owl feature_carousal_22 pxp-in owl-loaded owl-drag">
        
            <?php 
            $args = array(
            'post_type' => 'why_us_features',
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) 
            {
                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
               <!--  <div class="owl-stage-outer">
                    <div class="owl-stage" style="/*transform: translate3d(-1308px, 0px, 0px); transition: all 0s ease 0s; width: 4454px; padding-left: 100px; padding-right: 100px;*/">
                        <div class="owl-item active" style="width: 317.223px; margin-right: 10px;">
                            <div class="item"> <img src="<?php the_field('feature_icon'); ?>" style="width: 150px;background: red;" >
                                <h5><?php the_title(); ?></h5>
                                <p class="pxp-text-light pxp-in"><?php the_content(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-dots">
                    <button role="button" class="owl-dot active"><span></span></button>
                    <button role="button" class="owl-dot"><span></span></button>
                </div> -->
                <div id="carouselExampleControls" class="carousel slide text-center carousel-dark" data-mdb-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active"> 
                            <img class=" shadow-1-strong mb-4" src="<?php the_field('feature_icon'); ?>" style="width: 100px;margin-left: 8rem !important;" />
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <h3 class="mb-3 text-white"><?php the_title(); ?></h3>
                                    <h6 class="text-white" style="color: #fff !important;width: 200px"><?php the_content(); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;
            }
            ?>
        </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

    add_shortcode("why_us_features",'why_us_features_fn')
?>