<?php 
	 function create_promo_slider_posttype() {
        register_post_type( 'Promo Slider',
            array(
                'labels' => array(
                    'name' => __( 'Promo Sliders' ),
                    'singular_name' => __( 'Promo Slider' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'promo slider'),
                'show_in_rest' => true,
      
            )
        );
    }

    add_action( 'init', 'create_promo_slider_posttype' );
    function custom_post_type() 
    {
  
        $labels = array(
            'name'                => _x( 'Promo Sliders', 'Post Type General Name', 'twentytwentyone' ),
            'singular_name'       => _x( 'Promo Slider', 'Post Type Singular Name', 'twentytwentyone' ),
            'menu_name'           => __( 'Promo Sliders', 'twentytwentyone' ),
            'parent_item_colon'   => __( 'Parent Promo Slider', 'twentytwentyone' ),
            'all_items'           => __( 'All Promo Sliders', 'twentytwentyone' ),
            'view_item'           => __( 'View Promo Sliders', 'twentytwentyone' ),
            'add_new_item'        => __( 'Add New Promo Slider', 'twentytwentyone' ),
            'add_new'             => __( 'Add New', 'twentytwentyone' ),
            'edit_item'           => __( 'Edit Promo Slider', 'twentytwentyone' ),
            'update_item'         => __( 'Update Promo Slider', 'twentytwentyone' ),
            'search_items'        => __( 'Search Promo Slider', 'twentytwentyone' ),
            'not_found'           => __( 'Not Found', 'twentytwentyone' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
        );
          
        $args = array(
            'label'               => __( 'Promo Slider', 'twentytwentyone' ),
            'description'         => __( 'Promo Slider comments and reviews', 'twentytwentyone' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'taxonomies'          => array( 'genres' ),
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
	}
?>