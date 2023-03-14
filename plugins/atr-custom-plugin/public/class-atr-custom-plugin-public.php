<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://theandongroup.com
 * @since      1.0.0
 *
 * @package    Atr_Custom_Plugin
 * @subpackage Atr_Custom_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Atr_Custom_Plugin
 * @subpackage Atr_Custom_Plugin/public
 * @author     Faris <faris@theandongroup.com>
 */
class Atr_Custom_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Atr_Custom_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Atr_Custom_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/atr-custom-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Atr_Custom_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Atr_Custom_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/atr-custom-plugin-public.js', array( 'jquery' ), $this->version, false );

	}

	public function ct_create_custom_post_types() {
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

	public function ct_create_subjects_hierarchical_taxonomy() {
		$labels = array(
			'name' => _x( 'Community', 'taxonomy general name' ),
			'singular_name' => _x( 'Community', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Community' ),
			'all_items' => __( 'All Community' ),
			'parent_item' => __( 'Parent Community' ),
			'parent_item_colon' => __( 'Parent Community:' ),
			'edit_item' => __( 'Edit Community' ), 
			'update_item' => __( 'Update Community' ),
			'add_new_item' => __( 'Add New Community' ),
			'new_item_name' => __( 'New Community Name' ),
			'menu_name' => __( 'Community' ),
		  );    
		 
		// Now register the taxonomy
		  register_taxonomy('Community',array('property'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'community' ),
		  ));
	}

	public function ct_create_propertylocation_taxonomy() {
		$labels = array(
			'name' => _x( 'Locations', 'taxonomy general name' ),
			'singular_name' => _x( 'Locations', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Locations' ),
			'all_items' => __( 'All Locations' ),
			'parent_item' => __( 'Parent Locations' ),
			'parent_item_colon' => __( 'Parent Locations:' ),
			'edit_item' => __( 'Edit Locations' ), 
			'update_item' => __( 'Update Locations' ),
			'add_new_item' => __( 'Add New Locations' ),
			'new_item_name' => __( 'New Locations Name' ),
			'menu_name' => __( 'Locations' ),
		);
		register_taxonomy('locations',array('property'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'locations' ),
		));
	}

 public function show_mission_slider_fn(){
	ob_start();
    $yt_iframe = get_field('ct_mission_yt_iframe');
    $youtube_thumbnail = get_field('ct_youtube_thumbnail');
	?>
<div class="pxp-services-h service_case2 pt-100 pb-100 page_service page_aboutus_mission body_color" style="">
                <div class="container">
                         <div class="pxp-services-h-container mt-0 mt-md-0">
                         <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in"><div style="display:none"><textarea class="my_iframe"><?php echo $yt_iframe;?></textarea></div><div class="iframe_video" id="third_iframe_vedio" style="margin-top: 36px; background-color:#000">
                                        <img src="<?php echo $youtube_thumbnail;?>"><a id="ct-anim-play-video" class="ct-anim-video-play-button" href="#">
                                        <span></span>
                                      </a>
                                       
                                    </div>

                                </div>
                           <div class="pxp-services-h-items pxp-animate-in ml-0 ml-lg-5 mt-4 mt-md-5 mt-lg-5 service_img_min_height" >
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
                            </div>
                           
                         </div>
                </div>
        </div>


<?php
return ob_get_clean();
 }

 public function show_explore_community_properties_home_fn() {
	ob_start();

$post_id = get_the_ID();
    $general_settings = get_option('resideo_general_settings'); 
    $comm_view_cta = get_field("view_all_cta_link",$post_id);
    
    $currency = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';

    $terms = get_terms( array(
        'taxonomy' => 'Community',
        'hide_empty' => false,
    ) );

    // The Loop
    if ( ! empty( $terms ) ) { 
    ?>
    <style type="text/css">
        .pxp-prop-card-1:hover .pxp-prop-card-1-details {
            transform: translateY(-125%) !important;
        }
    </style>
    <div class="container-fluid pxp-props-carousel-right pxp-has-intro mt-100 ">
        <div class="pxp-props-carousel-right-intro">
            <p class="pxp-text-light color_green"><?php echo get_field('explore_title'); ?></p>
            <h2 class="pxp-section-h2 heading_col"><?php echo get_field('explore_subtitle'); ?></h2> <a href="<?php echo $comm_view_cta;?>" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ec109a104a3" style="color: #333333"><?php echo get_field('explore_cta_text'); ?></a>
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
                        icl_register_string("resideo", 'SQM','SQM'); 
                        foreach ($terms as $term) {

                            $term_id = $term->term_id;
                            $name   = $term->name;
                            $bed    =  get_field('no_of_bed',$term->taxonomy . '_' . $term_id);

                            $bath   =  get_field('no_of_bath',$term->taxonomy . '_' . $term_id);

                            $area   =  get_field('area_from',$term->taxonomy . '_' . $term_id);
                            $area = explode("|", $area);

                            $area_label = $area[0];
                            $area_sqf = $area[1];


                            $price  =  get_field('price_from',$term->taxonomy . '_' . $term_id);
                            $price = explode("|", $price);

                            $price_label = $price[0];
                            $t_price = $price[1];

                            $units  =  get_field('available_units',$term->taxonomy . '_' . $term_id);
                            $units = explode("|", $units);

                            $units_label = $units[0];
                            $t_units = $units[1];
                            
                            $size   =  get_field('area_size_sqft',$term->taxonomy . '_' . $term_id);

                            $image  =  get_field('image',$term->taxonomy . '_' . $term_id);

                            $floors     =  get_field('floors',$term->taxonomy . '_' . $term_id);

                            $front_image =  get_field('community_front_image',$term->taxonomy . '_' . $term_id);
                            ?>

                            <div class="owl-item active" style="width: 288.65px; margin-right: 30px;">
                                <div class="">
                                    <?php 
                                    $community_slug = get_term_by('id', $term_id, 'Community');
                                    $link = site_url()."/single-community/?term_id=".$term_id."&community=".$community_slug->slug;

                                    if(get_locale() == 'ar'){
                                        $link = str_replace("/single-community","/ar/single-community-ar",$link);
                                    } 

                                    ?>
                                    <a href="<?php echo $link; ?>" class="pxp-prop-card-1 rounded-lg ">
                                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-size: cover;background-image: url(<?php if ($front_image != '') {
                                            echo $front_image;
                                        } else { echo $image;} ?>);"></div>
                                        <div class="pxp-prop-card-1-gradient pxp-animate">
                                            <div class="pxp-prop-card-1-details">
                                                <div class="pxp-prop-card-1-details-title">
                                                    <?php echo pll__( $name ); ?>
                                                </div>
                                                <div class="pxp-prop-card-1-details-price" style="visibility:hidden;">
                                                    <?php
                                                        if(get_locale() == 'ar'){
                                                        ?>
                                                            <p style="font-weight:300;float:right;"><?php echo pll__( $price_label ); ?> &nbsp;</p>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <p style="font-weight:300;float:left;"><?php echo pll__( $price_label ); ?> &nbsp;</p>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php echo pll__( $t_price ); ?>&nbsp;<?php echo pll__( $currency ); ?> 
                                                </div>
                                            </div>
                                            <div class="pxp-prop-card-1-details-cta text-uppercase">
                                                <div class="line" style="height: 1px;background-color: #FFFFFF;"></div>
                                                <div class="container-fluid mt-2">
                                                    <div class="row">
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__( $area_label );?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo pll__($area_sqf).' '.pll__("SQM");?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Bedrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo pll__($bed);?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Buildup Area"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $size;?>&nbsp;<?php echo pll__("SQM");?> 
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Bathrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo pll__($bath);?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__("Floors"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $floors; ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll__($units_label); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo pll__($t_units); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo pll__("View Details"); ?>
                                            </div>
                                        </div>
                                        
                                    </a>
                                </div>
                            </div>

                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
                <div class="owl-nav">
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
                            
                             <?php if(get_locale()=="ar"){ ?> 
                              <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828"><g id="Group_30" data-name="Group 30" transform="translate(-1845.086 -1586.086)"><line id="Line_2" data-name="Line 2" x1="30" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line><line id="Line_3" data-name="Line 3" x1="9" y2="9" transform="translate(1846.5 1587.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line><line id="Line_4" data-name="Line 4" x1="9" y1="9" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line></g> </svg>
                            <?php } else {?>

                            <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                                <g id="Symbol_1_1" data-name="Symbol 1 – 1" transform="translate(-1847.5 -1589.086)">
                                    <line id="Line_2" data-name="Line 2" x2="30" transform="translate(1848.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_3" data-name="Line 3" x2="9" y2="9" transform="translate(1869.5 1590.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                    <line id="Line_4" data-name="Line 4" y1="9" x2="9" transform="translate(1869.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"></line>
                                </g>
                            </svg>

                            <?php } ?>

                           
                        </div>
                    </button>
                </div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>

<?php 
}
	return ob_get_clean();
 }



 public function show_community_properties_fn(){
	ob_start();
    $term_id    = $_GET['term_id'];

    $term_id    = !empty($term_id) ? $term_id : get_the_ID();

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
    <div class="container-fluid pxp-props-carousel-right pxp-has-intro mt-100">
        <div class="pxp-props-carousel-right-intro">
            <p class="pxp-text-light color_green">UNITS SERIES</p>
            <h2 class="pxp-section-h2">EXPLORE THE RANGE OF UNITS</h2> <a href="#" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ec109a104a3" style="color: #333333">VIEW ALL PROJECTS</a>
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
                            icl_register_string("resideo",$p_price,$p_price);
                            ?>

                            <div class="owl-item active" style="width: 288.65px; margin-right: 30px;">
                                <div class="">
                                    <a href="<?php echo $link;?>" class="pxp-prop-card-1 rounded-lg ">
                                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(<?php echo $p_photo ;?>);"></div>
                                        <div class="pxp-prop-card-1-gradient pxp-animate">
                                            <div class="pxp-prop-card-1-details">
                                                <div class="pxp-prop-card-1-details-title">
                                                    <?php echo pll__($title) ;?>
                                                </div>
                                                <div class="pxp-prop-card-1-details-price">
                                                    <?php
                                                        if(get_locale() == 'ar')
                                                        {
                                                        ?>
                                                            <p style="font-weight:300;float:right;"><?php echo pll_("From"); ?> &nbsp;</p>
                                                        <?php
                                                        }
                                                        ?>
                                                    <p style="font-weight:300;float:left;"><?php echo pll_("From"); ?> &nbsp;</p>
                                                    $<?php echo pll__($p_price); ?> 
                                                </div>
                                            </div>
                                            <div class="pxp-prop-card-1-details-cta text-uppercase">
                                                <div class="line" style="height: 1px;background-color: #FFFFFF;"></div>
                                                <div class="container-fluid mt-2">
                                                    <div class="row">
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Land Area"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_size; echo pll_("SQF");?> 
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Bedrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_beds;?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Bedrooms"); ?>Buildup Area</span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['buildup_area']) && $more_details['buildup_area'] > 0 ? $more_details['buildup_area'] : 0);  echo pll_("SQF");?> 
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Bathrooms"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo $p_baths;?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Floors"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['floors_total']) && $more_details['floors_total'] > 0 ? $more_details['floors_total'] : 0); ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 p-1">
                                                            <span class="more_dtl"><?php echo pll_("Units Remaining"); ?></span></br>
                                                            <span class="more_dtl_val">
                                                                <?php echo (isset($more_details['units_remaining']) && $more_details['units_remaining'] > 0 ? $more_details['units_remaining'] : 0); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php echo pll__("View Details");?>
                                            </div>
                                        </div>
                                        
                                    </a>
                                </div>
                            </div>

                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
                <div class="owl-nav">
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
                </div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
    <?php
    }
    wp_reset_postdata();
    return ob_get_clean();
 }

 public function show_community_listing_fn()
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
                    $bd         =   get_field("no_of_bed",$tt);
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
                    $community_slug = get_term_by('id', $term_id, 'Community');
                        $link = site_url()."/single-community/?term_id=".$term_id."&community=".$community_slug->slug;
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


public function show_communities_how_we_can_help_fn()
{
    ob_start();
    $general_settings = get_option('resideo_general_settings'); 


    $currency = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';

    $terms = get_terms( array(
	    'taxonomy' => 'Community',
	    'hide_empty' => false,
	) ); 

	// The Loop
    if ( ! empty( $terms ) ) { 
    ?>


<div class="container pxp-has-intro mt-100">
    
        <p class="pxp-text-light color_green"></p>
            <h2 class="pxp-section-h2 how_we_help_you" style="padding-bottom: 30px;">
                <?php 
                   // if(get_the_ID() == '859' or get_the_ID() == '1524'){
                        echo  pll__( "FEATURED COMMUNITIES" ); 
                   // }
                   // else{
                        //echo  pll__( "FEATURED COMMUNITIES" ); 
                   // }
                ?>
            </h2> 
        <div class="row">
            <?php
            icl_register_string("resideo", 'Floors','Floors'); 
            icl_register_string("resideo", 'SQF','SQF'); 

            



            foreach ($terms as $term) {

                $term_id = $term->term_id;
                $name   = $term->name;
                $bed    =  get_field('no_of_bed',$term->taxonomy . '_' . $term_id);

                $bath   =  get_field('no_of_bath',$term->taxonomy . '_' . $term_id);

                $area   =  get_field('area_from',$term->taxonomy . '_' . $term_id);
                $area = explode("|", $area);
                $area_label = $area[0];
                $area_sqf = $area[1];

                $price  =  get_field('price_from',$term->taxonomy . '_' . $term_id);
                $price = explode("|", $price);
                $price_label = $price[0];
                $t_price = $price[1];

                $units  =  get_field('available_units',$term->taxonomy . '_' . $term_id);
                $units = explode("|", $units);
                $units_label = $units[0];
                $t_units = $units[1];
                
                $size   =  get_field('area_size_sqft',$term->taxonomy . '_' . $term_id);

                $image  =  get_field('image',$term->taxonomy . '_' . $term_id);

                $floors     =  get_field('floors',$term->taxonomy . '_' . $term_id);

                $front_image =  get_field('community_front_image',$term->taxonomy . '_' . $term_id);
                ?>
                <div class="col-md-4">
                    <?php 
                    $community_slug = get_term_by('id', $term_id, 'Community');
                        $link = site_url()."/single-community/?term_id=".$term_id."&community=".$community_slug->slug;

                        if(get_locale() == 'ar'){
                            $link = str_replace("/single-community","/ar/single-community-ar",$link);
                        } 
                    ?>
                    <a href="<?php echo $link;?>" class="pxp-prop-card-1 rounded-lg ">
                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-size: cover;background-image: url(<?php if ($front_image != '') {
                            echo $front_image;
                        } else { echo $image;} ?>);"></div>
                        <div class="pxp-prop-card-1-gradient pxp-animate">
                            <div class="pxp-prop-card-1-details">
                                <div class="pxp-prop-card-1-details-title">
                                    <?php echo pll__($name) ;?>
                                </div>
                                <div class="pxp-prop-card-1-details-price" style="visibility:hidden;">
                                    <?php
                                        if(get_locale() == 'ar'){
                                        ?>
                                            <p style="font-weight:300;float:right;"><?php echo pll__( $price_label ); ?> &nbsp;</p>
                                        <?php
                                        }
                                        else{
                                            ?>
                                            <p style="font-weight:300;float:left;"><?php echo pll__( $price_label ); ?> &nbsp;</p>
                                    <?php
                                        }
                                    ?>
                                    <?php echo $t_price; ?>&nbsp;<?php echo pll__($currency); ?> 
                                </div>
                            </div>
                            <div class="pxp-prop-card-1-details-cta text-uppercase">
                                <div class="line" style="height: 1px;background-color: #FFFFFF;"></div>
                                <div class="container-fluid mt-2">
                                    <div class="row">
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php echo pll__($area_label);?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($area_sqf).' '.pll__("SQM");;?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Bedrooms" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($bed);?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Buildup Area" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($size); ?>  <?php  echo pll__( "SQF" ); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Bathrooms" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($bath);?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php  echo pll__( "Floors" ); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($floors); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <span class="more_dtl"><?php echo pll__($units_label); ?></span></br>
                                            <span class="more_dtl_val">
                                                <?php echo pll__($t_units); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <?php echo pll__("View Details"); ?>
                            </div>
                        </div>
                        
                    </a>
                </div>
            <?php
            }
            wp_reset_postdata();
            icl_register_string("resideo", 'VIEW ALL','VIEW ALL');
            ?>
        </div>

        <?php (get_locale() == "ar") ? $cta_url = "/home-search-ar":$cta_url = "/home-search"; ?>
        <a href="<?php echo $cta_url;?>" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ec109a104a3" style="color: #333333"><?php echo pll__("VIEW ALL"); ?></a>
        <style>
        .pxp-primary-cta#cta-62ec109a104a3:after {
            border-top: 2px solid #333333;
        }
        .pxp-prop-card-1-details-cta span.more_dtl{
            font-weight: 400;
        }
        </style>
    
</div>
    <!-- ---------------------------------------------------------------------- -->
    <style type="text/css">
        .pxp-prop-card-1:hover .pxp-prop-card-1-details {
            transform: translateY(-125%) !important;
        }
    </style>
    
    <?php
    }
    wp_reset_postdata();
    return ob_get_clean();
}

public function sc_onload_popup_fn()
{
    $popup_logo = get_field('cs_popup_logo', 'option'); 
    if(get_locale() == "ar" ) {
        $popup_title = get_field('cs_popup_title_ar', 'option');
        $popup_copy = get_field('cs_popup_copy_ar', 'option'); 
        
    } else 
    {
        $popup_title = get_field('cs_popup_title', 'option');
        $popup_copy = get_field('cs_popup_copy', 'option'); 
    }
    
    $popup_form_shortcode = get_field('cs_form_shortcode', 'option');
  ob_start();
  ?>
 <div id="comingsoonModal" class="comingsoonModal">

<!-- Modal content -->
<div class="comingsoon-modal-content">
<span class="comingsoon-modal-close"></span>
<div class="cs_copy_cont">
    <!-- <img src="<?php echo get_template_directory_uri()?>/images/vyda_logo.svg"/> -->
    <img src="<?php echo $popup_logo;?>"/>
    <div>
        <h2><?php echo $popup_title;?></h2>
        <?php 
        echo $popup_copy;
        ?>
        
    </div>
</div>
<?php echo do_shortcode($popup_form_shortcode) //echo do_shortcode('[contact-form-7 id="2705" title="Coming soon vyda"]'); ?>
</div>

</div>
  <?php
  return  ob_get_clean();   
}

public function fr_testimonials_noslider()
{
ob_start();
icl_register_string("resideo", 'HOME BUYERS TESTIMONIALS','HOME BUYERS TESTIMONIALS'); 
?>
<div class="fr_ct_testim_container pt-50 pb-50 mt-20 pxp-cover">
   
	<div class="mt-4 container">
	
		<h2 class="pxp-section-h2"><?php echo pll__("HOME BUYERS TESTIMONIALS");?></h2>
	
		<div class="row">
			
					<?php 
						$args = array( 'post_type' => 'testimonial', 'posts_per_page' => 10);
						$posts = wp_get_recent_posts($args);
						?>
						 <?php foreach ($posts as $post) {?>
					   
							<div class="col-md-4 col-sm-12">
								<div>
									<?php 
										$text = get_post_meta($post['ID'], 'testimonial_text', true);
										$location = get_post_meta($post['ID'], 'testimonial_location', true);
		
										$avatar = get_post_meta($post['ID'], 'testimonial_avatar', true);

										if ($avatar != '') {
											$avatar_photo = wp_get_attachment_image_src($avatar, 'pxp-agent');
											$avatar_photo_src = $avatar_photo[0];
										} else {
											$avatar_photo_src = RESIDEO_PLUGIN_PATH . 'images/avatar-default.png';
										} ?>
									
									<div>
								<div class="pxp-testim-1-item">
									<div class="pxp-testim-1-item-avatar pxp-cover" style="background-image: url(<?php echo esc_url($avatar_photo_src); ?>)"></div>
									<div class="pxp-testim-1-item-name"><?php echo esc_html($post['post_title']); ?></div>
									<div class="pxp-testim-1-item-location"><?php echo esc_html($location); ?></div>
									<div class="pxp-testim-1-item-message"><?php echo $text; ?></div>
								</div>
							</div>
								</div>
							</div>
					   
						<?php wp_reset_postdata(); ?>
						<?php }
					?>
			
			
		</div>
	</div>
</div>
<?php
return  ob_get_clean();
}

public function people_testimonial()
{
ob_start();
?>
<div class="pxp-testim-1 pt-100 pb-100 mt-100 cust_people_info_cont pxp-cover" style="background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/12/testimbg-new.jpg);">
	<div class="pxp-testim-1-intro">
		<p class="pxp-text-light" style="color: "><?php the_field('testimonial_title');?></p>
		<h3 class="pxp-section-h2" style="color: "><?php the_field('testimonial_sub_title');?></h3><a href="<?php the_field('testimonial_cta_btn_url');?>" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-6308cf442c70f" style="color: "><?php the_field('testimonial_cta_btn_text');?></a>
	</div>
	<div class="pxp-testim-1-container mt-4 mt-md-5 mt-lg-0">
		<div class="owl-carousel pxp-testim-1-stage owl-loaded owl-drag">
			<div class="owl-stage-outer">
				<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1587px;">
					<?php 
						$args = array( 'post_type' => 'peoples', 'posts_per_page' => 10);
						$the_query = new WP_Query( $args ); 
						?>
						<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="owl-item">
								<div>
									<?php 
										$person_name = get_field('person_name');
										$person_location = get_field('person_location');
										icl_register_string("resideo", $person_name,$person_name); 
										icl_register_string("resideo", $person_location,$person_location); 

										$person_desc = get_field('person_description'); 
										if (get_locale() == 'ar') {
											$person_desc = get_field('person_description_ar');   
										}
									?>
									<div class="pxp-testim-1-item" style="min-height: 523px">
										<div class="pxp-testim-1-item-avatar pxp-cover" style="background-image: url(<?php the_field('person_image');?>">
										</div>
										<div class="pxp-testim-1-item-name"><?php echo pll__($person_name);?></div>
										<div class="pxp-testim-1-item-location"><?php echo pll__($person_location);?></div>
										<div class="pxp-testim-1-item-message"><?php echo $person_desc; ?> </div>
									</div>
								</div>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>
						<?php endif; 
					?>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php
return  ob_get_clean();
}

public function have_property_in_mind_calculator()
{
    ob_start();
    ?>
    <div class="container mt-100">
        <h2 class="pxp-section-h2"><?php echo pll__("HAVE A HOME IN MIND?"); ?></h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="pxp-single-property-section">
                    <h3 style="color: #4D858D;"><?php echo pll__( "MORTGAGE CALCULATOR" ); ?></h3>
                    <div class="pxp-calculator-view mt-3 mt-md-4">
                        <div class="row">
                            <!--<div class="col-sm-12 col-lg-4 align-self-center">
                                <div class="pxp-calculator-chart-container"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="pxp-calculator-chart" style="display: block; width: 223px; height: 223px;" width="223" height="223" class="chartjs-render-monitor"></canvas>
                                    <div class="pxp-calculator-chart-result">
                                        <div class="pxp-calculator-chart-result-sum">8,122SR</div>
                                        <div class="pxp-calculator-chart-result-label">per month</div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-sm-12 col-lg-12 align-self-center mt-3 mt-lg-0">
                                <div class="pxp-calculator-data">
                                    <div class="row justify-content-between">
                                        <div class="col-8">
                                            <div class="pxp-calculator-data-label"><?php echo pll__( "Monthly Installment"); ?><span class="fa fa-minus"></span></div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div class="pxp-calculator-data-sum" id="pxp-calculator-data-pi">5,018 &nbsp;<?php echo pll__("SR"); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="pxp-calculator-data">
                                    <div class="row justify-content-between">
                                        <div class="col-8">
                                            <div class="pxp-calculator-data-label"><span class="fa fa-minus"></span>Property Taxes</div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div class="pxp-calculator-data-sum" id="pxp-calculator-data-pt">1,068SR</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pxp-calculator-data">
                                    <div class="row justify-content-between">
                                        <div class="col-8">
                                            <div class="pxp-calculator-data-label"><span class="fa fa-minus"></span>Lorem Ipsem</div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div class="pxp-calculator-data-sum" id="pxp-calculator-data-hd">2,036SR</div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="pxp-calculator-form">
                                    
                        <input type="hidden" id="pxp-calculator-form-property-taxes" value="1,068<?php echo pll__("SR"); ?>">
                        <input type="hidden" id="pxp-calculator-form-hoa-dues" value="2,036<?php echo pll__("SR"); ?>">
                        <div style="padding-bottom: 20px;
                        margin-bottom: 20px;
                        border-bottom: 1px solid #E2E2E2;">
                            
                        </div>
                        <div>
                            <p><?php echo pll__( "Finance your home with:" ); ?></p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="">
                              <label class="form-check-label" style="margin-right: .9rem;" for="inlineRadio1"><?php echo pll__( "Amlak International" ); ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                              <label class="form-check-label" style="margin-right: .9rem;" for="inlineRadio2"><?php echo pll__( "Bidaya Home Finance" ); ?></label>
                            </div>
                        </div>
                        <div style="padding-bottom: 20px;
                        margin-bottom: 20px;
                        border-bottom: 1px solid #E2E2E2;">
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="pxp-calculator-form-term"><?php echo pll__( "Term" ); ?></label>
                                    <select class="custom-select" id="pxp-calculator-form-term">
                                        <option value="20">20 <?php echo pll__( "Years Fixed" ); ?></option>
                                        <option value="30" selected>30 <?php echo pll__( "Years Fixed" ); ?></option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="pxp-calculator-form-interest"><?php echo pll__( "Interest" ); ?></label>
                                    <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-interest" data-type="percent" value="2.75%">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="pxp-calculator-form-price"><?php echo pll__( "Home Price" ); ?></label>
                                    <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-price" data-type="currency" value="1,240,000SR">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col-7 col-sm-7 col-md-8">
                                        <div class="form-group">
                                            <label for="pxp-calculator-form-down-price"><?php echo pll__( "Down Payment" ); ?></label>
                                            <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-down-price" data-type="currency" value="">
                                        </div>
                                    </div>
                                    <div class="col-5 col-sm-5 col-md-4">
                                        <div class="form-group">
                                            <label for="pxp-calculator-form-down-percentage">&nbsp;</label>
                                            <input type="text" class="form-control pxp-form-control-transform" id="pxp-calculator-form-down-percentage" data-type="percent" value="10%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="diclaimer_btns">

                            <div class="" style="font-size: 13px;padding: 10px 0;">
                            <i class="bi-info-circle-fill"></i>
                             <strong><?php echo pll__( "Disclaimer:" ); ?> </strong> <?php 

                            if(get_locale()=="ar")
                            {
                                echo get_option('resideo_new_disclimer_ar'); 
                            }
                            else
                            {
                                echo get_option('resideo_new_disclimer');   
                            }
                            ?>
                            </div>

                            <?php (get_locale() == "ar") ? $ct_cta_contact = "/contact-us-ar":$ct_cta_contact = "/contact-us"; ?>
                            <?php (get_locale() == "ar") ? $ct_cta_finance = "/finance-your-home-ar":$ct_cta_finance = "/finance-your-home"; ?>
                            <button class="pxp-sp-top-btn" style=" background-color: #af8814; color: #fff; border: 0px solid #af8814" onclick="location.href='<?php echo $ct_cta_contact;?>'"><?php echo pll__( "ASK OUR TEAM FOR HELP" ); ?></button>
                            <button class="pxp-sp-top-btn" style=" background-color: lightgray; color: #fff; border: 0px solid #af8814" onclick="location.href='<?php echo $ct_cta_finance;?>'"><?php echo pll__( "SEE DETAILS" ); ?></button>
                        </div>
                    </div>
                </div>
                <p style="padding: 20px 0px; font-size: 13px;" class="disclaimer_style">
                    <strong><?php if($property_disclaimer != ""){ echo pll__( "Disclaimer:" );}?></strong>    
                    <?php 
                        if($property_disclaimer != ""){
                           echo $property_disclaimer; 
                        }
                     ?> 
                </p>

            </div>
        </div>
    </div>
    <?php
   return  ob_get_clean();
    
}




public function choosing_your_home()
{
    ob_start();
    icl_register_string("resideo", 'KEY POINTS:','KEY POINTS:'); 
    ?>
    <div class="pt-100 home_services_bg home-ar ct-warranty" style="<?php if (strtolower(get_field('page_slug'))=="choosing-your-home" || strtolower(get_field('page_slug'))=="howwecanhelpyou") {echo 'background: linear-gradient(90deg, #fff 50%, #7B868C 50%)';} ?> ; background-size: cover; padding-bottom: 50px;">
    <div class="container" style="padding-top: 30px;">
        <div class="row">
            <div class="col-md-6 ">
                <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 service_img_min_height pxp-in"><p class="pxp-text-light" style="color: #4D858D; font-weight: 700; "><?php echo get_field('warrenty_title'); ?></p>
                <h3 class="pxp-section-featured-h2" style=""><?php echo get_field('warrenty_sub_title'); ?></h3><div class="service_case2_intro">
                   <p style="padding-right: 20px; text-align: left;"><?php echo get_field('warrenty_description'); ?></p><p></p>
                   </div>
            </div>
            </div>
           <style type="text/css">
               .service-section-h2{
                color: #fff;
                text-transform: uppercase;
                font-weight: 700;
               }
           </style>
            <div class="col-md-6 home_services_m" style="padding: 0px 66px;">
                  <div class="pxp-testim-1-intro" style="width: 100%;">
                        <h5 class="service-section-h2"><?php echo pll__("KEY POINTS:"); ?></h5>
                    </div>
                    <div class="finance_list">
                      <ul>
                        <?php

                        
                        if( have_rows('warrenty_key_points') ):

                        
                            while( have_rows('warrenty_key_points') ) : the_row();

                        
                                $list = get_sub_field('warrenty_list');
                        ?>

                        <li><?php echo $list; ?></li>
                        <?php
                        
                            endwhile;

                        
                        else :
                          
                        endif;
                        ?>
                          
                      </ul>
                  </div>
            </div>
        </div>
    </div>
</div>
    <?php
   return  ob_get_clean();
}



public function sc_show_contact_page_fn()
{ 
    ob_start();
    icl_register_string("resideo", 'SEND US A MESSAGE','SEND US A MESSAGE'); 
    icl_register_string("resideo", 'GET IN TOUCH','GET IN TOUCH'); 

    icl_register_string("resideo", 'Call us at','Call us at'); 
    icl_register_string("resideo", 'Email us at','Email us at'); 

    ?>
    <div class="container">
        <div class="container mt-100 pb-100">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <h2 class="pxp-section-h2 pxp-in"><?php  echo pll__( "SEND US A MESSAGE" ); ?></h2>
                        <?php echo apply_shortcodes( '[contact-form-7 id="1506" title="Contact Page Form"]' );?>
                    </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="row mt-4 mt-md-5 mt-lg-0">
                                <div class="col-6">
                                    <h2 class="pxp-section-h2 pxp-in"><?php  echo pll__( "GET IN TOUCH" ); ?></h2>
                                </div>
                                <!-- <div class="col-6 text-right pxp-contact-locations-select-container" style="display: none;">
                                    <select class="custom-select pxp-contact-locations-select">
                                        <option data-lat="<?php echo get_field('latitude'); ?>" data-lng="<?php echo get_field('longitude'); ?>"><?php echo get_field('location_name'); ?></option>
                                    </select>
                                </div> -->

                            </div>
                            <!-- <div id="pxp-contact-map" class="mt-3"></div>  -->
                            <div class="ct_contactdetails mt-3 mt-md-4">
                                <p><strong><?php echo pll__( "Call us at" ).':';?> </strong><a href="tel:92-000-1769">92 000 1769</a></p>
                                <p><strong><?php echo pll__( "Email us at" ).':';?></strong> <a href="mailto:info@al-tahaluf.com">info@al-tahaluf.com</a></p>
                            </div>
                        </div>
                </div>
            </div>
     </div>
    <?php 
    return ob_get_clean();

}
}
