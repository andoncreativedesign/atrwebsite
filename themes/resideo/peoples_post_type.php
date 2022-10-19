<?php 
	 function create_people_posttype() {
        register_post_type( 'peoples',
            array(
                'labels' => array(
                    'name' => __( 'Peoples' ),
                    'singular_name' => __( 'People' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'peoples'),
                'show_in_rest' => true,
      
            )
        );
    }

    add_action( 'init', 'create_people_posttype' );
    function custom_post_type() 
    {
  
        $labels = array(
            'name'                => _x( 'Peoples', 'Post Type General Name', 'twentytwentyone' ),
            'singular_name'       => _x( 'People', 'Post Type Singular Name', 'twentytwentyone' ),
            'menu_name'           => __( 'Peoples', 'twentytwentyone' ),
            'parent_item_colon'   => __( 'Parent People', 'twentytwentyone' ),
            'all_items'           => __( 'All Peoples', 'twentytwentyone' ),
            'view_item'           => __( 'View Peoples', 'twentytwentyone' ),
            'add_new_item'        => __( 'Add New People', 'twentytwentyone' ),
            'add_new'             => __( 'Add New', 'twentytwentyone' ),
            'edit_item'           => __( 'Edit People', 'twentytwentyone' ),
            'update_item'         => __( 'Update People', 'twentytwentyone' ),
            'search_items'        => __( 'Search People', 'twentytwentyone' ),
            'not_found'           => __( 'Not Found', 'twentytwentyone' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
        );
          
        $args = array(
            'label'               => __( 'peoples', 'twentytwentyone' ),
            'description'         => __( 'Peoples comments and reviews', 'twentytwentyone' ),
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