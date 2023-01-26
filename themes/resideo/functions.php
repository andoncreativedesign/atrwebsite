<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

if (!defined('RESIDEO_LOCATION')) {
    define('RESIDEO_LOCATION', get_template_directory_uri());
}

// add_action("init",function (){

//     if(isset($_GET['iamdev99']) and $_GET['iamdev99']=="ok")
//     {
//         $terms = get_terms(array(
//             'taxonomy' => 'Community',
//             'hide_empty' => false,
//         ));
//         print_r($terms);
//         exit;    
//     }

// });


/* Prevent themes from auto updating */
add_filter( 'auto_update_theme', '__return_false' );

add_filter( 'site_transient_update_themes', 'disable_update_themes_resideo' );
function disable_update_themes_resideo( $value ) {


$your_theme_slug = 'resideo';
if ( isset( $value ) && is_object( $value ) ) {
unset( $value->response[ $your_theme_slug ] );
}

return $value;
}

/* Disabling automatic plugin update*/
add_filter( 'auto_update_plugin', '__return_false' );



include_once('peoples_post_type.php');
include_once('disclaimer_setting.php');
/**
 * Register required plugins
 */
require_once 'libs/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'resideo_register_required_plugins');



 function wp_get_recent_posts_ar( $args = array(), $output = ARRAY_A ) {

    if ( is_numeric( $args ) ) {
        _deprecated_argument( __FUNCTION__, '3.1.0', __( 'Passing an integer number of posts is deprecated. Pass an array of arguments instead.' ) );
        $args = array( 'numberposts' => absint( $args ) );
    }

    // Set default arguments.
    $defaults = array(
        'numberposts'      => 10,
        'offset'           => 0,
        'category'         => 0,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_status'      => 'draft, publish, future, pending, private',
        'suppress_filters' => true,
    );

    $parsed_args = wp_parse_args( $args, $defaults );

    $results = get_posts( $parsed_args );

    // Backward compatibility. Prior to 3.1 expected posts to be returned in array.
    if ( ARRAY_A === $output ) {
        foreach ( $results as $key => $result ) {
            $results[ $key ] = get_object_vars( $result );
        }
        return $results ? $results : array();
    }

    return $results ? $results : false;

}

if(!function_exists('resideo_register_required_plugins')): 
    function resideo_register_required_plugins() {
        $plugins = array(
            array(
                'name'         => 'Resideo Plugin',
                'slug'         => 'resideo-plugin',
                'source'       => 'http://pixelprime.co/themes/resideo-wp/plugins/resideo-plugin-2-5-2/resideo-plugin.zip',
                'required'     => true,
                'version'      => '2.5.2',
                'external_url' => ''
            ),
        );

        $config = array(
            'id'           => 'resideo',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'has_notices'  => true,
            'dismissable'  => false,
            'dismiss_msg'  => '',
            'is_automatic' => false,
            'message'      => '',

            'strings'      => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'resideo'),
                'menu_title'                      => esc_html__('Install Plugins', 'resideo'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'resideo'),
                'updating'                        => esc_html__('Updating Plugin: %s', 'resideo'),
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'resideo'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'resideo'),
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'resideo'),
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'resideo'),
                'notice_ask_to_update_maybe'      => _n_noop('There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'resideo'),
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'resideo'),
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'resideo'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'resideo'),
                'update_link'                     => _n_noop('Begin updating plugin', 'Begin updating plugins', 'resideo'),
                'activate_link'                   => _n_noop('Begin activating plugin', 'Begin activating plugins', 'resideo'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'resideo'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'resideo'),
                'activated_successfully'          => esc_html__('The following plugin was activated successfully:', 'resideo'),
                'plugin_already_active'           => esc_html__('No action taken. Plugin %1$s was already active.', 'resideo'),
                'plugin_needs_higher_version'     => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'resideo'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %1$s', 'resideo'),
                'dismiss'                         => esc_html__('Dismiss this notice', 'resideo'),
                'notice_cannot_install_activate'  => esc_html__('There are one or more required or recommended plugins to install, update or activate.', 'resideo'),
                'contact_admin'                   => esc_html__('Please contact the administrator of this site for help.', 'resideo'),
                'nag_type'                        => 'updated',
            ),
        );

        tgmpa($plugins, $config);
    }
endif;

/**
 * Theme setup
 */
if (!function_exists('resideo_setup')):
    function resideo_setup() {
        if (function_exists('add_theme_support')) {
            add_theme_support('automatic-feed-links');
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');
            add_theme_support('custom-logo');
            add_theme_support('html5', array('style', 'script'));
            add_theme_support('responsive-embeds');
        }

        set_post_thumbnail_size(800, 600, true);
        add_image_size('pxp-thmb', 160, 160, true);
        add_image_size('pxp-icon', 200, 200, true);
        add_image_size('pxp-gallery', 800, 600, true);
        add_image_size('pxp-agent', 800, 800, true);
        add_image_size('pxp-full', 1920, 1280, true);

        if (!isset($content_width)) {
            $content_width = 1140;
        }

        load_theme_textdomain('resideo', RESIDEO_LOCATION . '/languages/');

        register_nav_menus(array(
            'primary' => esc_html__('Top primary menu', 'resideo'),
            'footer' => esc_html__('Bottom footer menu', 'resideo')
        ));
    }
endif;
add_action('after_setup_theme', 'resideo_setup');

/**
 * Load scripts
 */
if (!function_exists('resideo_load_scripts')): 
    function resideo_load_scripts() {
        global $paged;
        global $post;

        wp_enqueue_style('jquery-ui', RESIDEO_LOCATION . '/css/jquery-ui.css', array(), '1.11.0', 'all'); 
        wp_enqueue_style('fileinput', RESIDEO_LOCATION . '/css/fileinput.min.css', array(), '4.0', 'all'); 
        // wp_enqueue_style('base-font', 'https://fonts.googleapis.com/css?family=Roboto:400,700,900', array(), '1.0', 'all');
        wp_enqueue_style('base-font', 'https://fonts.googleapis.com/css?family=Cairo:400,700,900', array(), '1.0', 'all');
        wp_enqueue_style('font-awesome', RESIDEO_LOCATION . '/css/font-awesome.min.css', array(), '4.7.0', 'all');
        wp_enqueue_style('bootstrap', RESIDEO_LOCATION . '/css/bootstrap.min.css', array(), '4.3.1', 'all');
        wp_enqueue_style('datepicker', RESIDEO_LOCATION . '/css/datepicker.css', array(), '1.0', 'all');
        wp_enqueue_style('owl-carousel', RESIDEO_LOCATION . '/css/owl.carousel.min.css', array(), '2.3.4', 'all');
        wp_enqueue_style('owl-theme', RESIDEO_LOCATION . '/css/owl.theme.default.min.css', array(), '2.3.4', 'all');
        wp_enqueue_style('photoswipe', RESIDEO_LOCATION . '/css/photoswipe.css', array(), '4.1.3', 'all');
        wp_enqueue_style('photoswipe-skin', RESIDEO_LOCATION . '/css/default-skin/default-skin.css', array(), '4.1.3', 'all');
        wp_enqueue_style('resideo-style', get_stylesheet_uri(), array(), '1.0', 'all');

        // RTL styles
        wp_style_add_data('resideo-style', 'rtl', 'replace');

        // Include dsIDXpress IDX Style only if plugin is active
        if (function_exists('dsidxpress_InitWidgets')) {
            wp_enqueue_style('resideo-dsidx', RESIDEO_LOCATION . '/css/idx.css', array(), '1.0', 'all');
        }

        wp_deregister_style('common');
        wp_deregister_style('forms');

        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        wp_enqueue_script('jquery-ui', RESIDEO_LOCATION . '/js/jquery-ui.min.js', array('jquery'), '1.11.4', true);
        wp_enqueue_script('popper', RESIDEO_LOCATION . '/js/popper.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script('bootstrap', RESIDEO_LOCATION . '/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
        wp_enqueue_script('markerclusterer',    RESIDEO_LOCATION . '/js/markerclusterer.js', array(), '2.0.8', true);
        wp_enqueue_script('datepicker', RESIDEO_LOCATION . '/js/bootstrap-datepicker.js', array(), '1.0', true);
        wp_enqueue_script('numeral', RESIDEO_LOCATION . '/js/numeral.min.js', array(), '2.0.6', true);

        $resideo_gmaps_settings = get_option('resideo_gmaps_settings', '');
        
        $gmaps_key              = isset($resideo_gmaps_settings['resideo_gmaps_key_field']) ? $resideo_gmaps_settings['resideo_gmaps_key_field'] : '';
        $gmaps_lat              = isset($resideo_gmaps_settings['resideo_gmaps_lat_field']) ? $resideo_gmaps_settings['resideo_gmaps_lat_field'] : 0;
        $gmaps_lng              = isset($resideo_gmaps_settings['resideo_gmaps_lng_field']) ? $resideo_gmaps_settings['resideo_gmaps_lng_field'] : 0;
        $gmaps_zoom             = isset($resideo_gmaps_settings['resideo_gmaps_zoom_field']) ? $resideo_gmaps_settings['resideo_gmaps_zoom_field'] : 13;
        $gmaps_style            = isset($resideo_gmaps_settings['resideo_gmaps_style_field']) ? $resideo_gmaps_settings['resideo_gmaps_style_field'] : '';
        $gmaps_poi              = isset($resideo_gmaps_settings['resideo_gmaps_poi_field']) ? $resideo_gmaps_settings['resideo_gmaps_poi_field'] : '';

        if ($gmaps_key != '') {
            wp_enqueue_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key=' . $gmaps_key . '&amp;libraries=geometry&amp;libraries=places&callback=Function.prototype', array('jquery'), false, true);
        }

        wp_enqueue_script('google-video',  'https://www.youtube.com/iframe_api', array(), false, true);

        wp_enqueue_script('fileinput', RESIDEO_LOCATION . '/js/fileinput.min.js', array('jquery'), '4.0', true); 
        wp_enqueue_script('photoswipe', RESIDEO_LOCATION . '/js/photoswipe.min.js', array(), '4.1.3', true);
        wp_enqueue_script('photoswipe-ui', RESIDEO_LOCATION . '/js/photoswipe-ui-default.min.js', array(), '4.1.3', true);
if(get_locale()=="ar")
{
    wp_enqueue_script('owl-carousel',  RESIDEO_LOCATION . '/js/owl.carousel_ar.min.js', array(), time(), true);
}
else
{
   wp_enqueue_script('owl-carousel',  RESIDEO_LOCATION . '/js/owl.carousel.min.js', array(), time(), true); 
}

        
        wp_enqueue_script('chart', RESIDEO_LOCATION . '/js/Chart.min.js', array(), '2.9.3', true);
        wp_enqueue_script('sticky', RESIDEO_LOCATION . '/js/jquery.sticky.js', array('jquery'), '1.0.4', true);
        wp_enqueue_script('vibrant', RESIDEO_LOCATION . '/js/vibrant.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script('masonry', RESIDEO_LOCATION . '/js/masonry.min.js', array('jquery'), '3.3.2', true);
        wp_enqueue_script('jquery-masonry', RESIDEO_LOCATION . '/js/jquery.masonry.min.js', array('jquery'), '3.1.2b', true);
        wp_enqueue_script('numscroller', RESIDEO_LOCATION . '/js/numscroller-1.0.js', array('jquery'), '1.0', true);
        wp_enqueue_script('anime', RESIDEO_LOCATION . '/js/anime.min.js', array(), '3.2.1', true);

        wp_enqueue_script('pxp-services', RESIDEO_LOCATION . '/js/services.js', array(), '1.0', true);

        if ($gmaps_key != '') {
            wp_enqueue_script('infobox', RESIDEO_LOCATION . '/js/infobox.js', array('gmaps'), '1.1.13', true);
            wp_enqueue_script('pxp-map', RESIDEO_LOCATION . '/js/map.js', array(), '1.2', true);
            wp_enqueue_script('pxp-map-single', RESIDEO_LOCATION . '/js/single-map.js', array(), '1.0', true);
            wp_enqueue_script('pxp-map-contact', RESIDEO_LOCATION . '/js/contact-map.js', array(), '1.0', true);
        }

        $general_settings  = get_option('resideo_general_settings');
        $auto_country            = isset($general_settings['resideo_auto_country_field']) ? $general_settings['resideo_auto_country_field'] : '';
        $currency                = isset($general_settings['resideo_currency_symbol_field']) ? $general_settings['resideo_currency_symbol_field'] : '';
        $currency_pos            = isset($general_settings['resideo_currency_symbol_pos_field']) ? $general_settings['resideo_currency_symbol_pos_field'] : '';
        $map_marker_price_format = isset($general_settings['resideo_map_marker_price_format']) ? $general_settings['resideo_map_marker_price_format'] : 'short';

        $fields_settings   = get_option('resideo_prop_fields_settings');
        $city_type         = isset($fields_settings['resideo_p_city_t_field']) ? $fields_settings['resideo_p_city_t_field'] : '';
        $neighborhood_type = isset($fields_settings['resideo_p_neighborhood_t_field']) ? $fields_settings['resideo_p_neighborhood_t_field'] : '';

        $appearance_settings = get_option('resideo_appearance_settings');
        $theme_mode = isset($appearance_settings['resideo_theme_mode_field']) ? $appearance_settings['resideo_theme_mode_field'] : '';

        if ($gmaps_key != '') {
            wp_enqueue_script('pxp-map-submit', RESIDEO_LOCATION . '/js/submit-property-map.js', array(), '1.0', true);
            wp_localize_script('pxp-map-submit', 'spm_vars', 
                array(
                    'default_lat'       => $gmaps_lat,
                    'default_lng'       => $gmaps_lng,
                    'auto_country'      => $auto_country,
                    'city_type'         => $city_type,
                    'neighborhood_type' => $neighborhood_type,
                    'geocode_error'     => esc_html__('Geocode was not successful for the following reason', 'resideo'),
                    'theme_mode'        => $theme_mode,
                    'gmaps_style'       => $gmaps_style
                )
            );
        }

        wp_enqueue_script('pxp-tilt', RESIDEO_LOCATION . '/js/tilt.js', array(), '1.0', true);
        wp_enqueue_script('pxp-main', RESIDEO_LOCATION . '/js/main.js', array(), time(), true);
        wp_enqueue_script('pxp-video', RESIDEO_LOCATION . '/js/video.js', array(), '1.0', true);
        wp_enqueue_script('pxp-gallery', RESIDEO_LOCATION . '/js/gallery.js', array(), '1.0', true);
        wp_enqueue_script('pxp-payment-calculator', RESIDEO_LOCATION . '/js/payment-calculator.js', array(), '1.0', true);

        // Include dsIDXpress IDX Script only if plugin is active
        if (function_exists('dsidxpress_InitWidgets')) {
            wp_enqueue_script('resideo-dsidx-js', RESIDEO_LOCATION . '/js/idx.js', array(), '1.0', true);
        }

        // Search values
        $search_status       = isset($_GET['search_status']) ? sanitize_text_field($_GET['search_status']) : '0';
       
        // $search_address      = isset($_GET['search_address']) ? stripslashes(sanitize_text_field($_GET['search_address'])) : '';
        $search_address      = isset($_GET['search_location']) ? stripslashes(sanitize_text_field($_GET['search_location'])) : '';
        $search_street_no    = isset($_GET['search_street_no']) ? stripslashes(sanitize_text_field($_GET['search_street_no'])) : '';
        $search_street       = isset($_GET['search_street']) ? stripslashes(sanitize_text_field($_GET['search_street'])) : '';
        $search_neighborhood = isset($_GET['search_neighborhood']) ? stripslashes(sanitize_text_field($_GET['search_neighborhood'])) : '';
        $search_city         = isset($_GET['search_city']) ? stripslashes(sanitize_text_field($_GET['search_city'])) : '';
        $search_state        = isset($_GET['search_state']) ? stripslashes(sanitize_text_field($_GET['search_state'])) : '';
        $search_zip          = isset($_GET['search_zip']) ? sanitize_text_field($_GET['search_zip']) : '';
        $search_type         = isset($_GET['search_type']) ? sanitize_text_field($_GET['search_type']) : '0';
        $search_price_min    = isset($_GET['search_price_min']) ? sanitize_text_field($_GET['search_price_min']) : '';
        $search_price_max    = isset($_GET['search_price_max']) ? sanitize_text_field($_GET['search_price_max']) : '';
        $search_beds         = isset($_GET['search_beds']) ? sanitize_text_field($_GET['search_beds']) : '';
        $search_baths        = isset($_GET['search_baths']) ? sanitize_text_field($_GET['search_baths']) : '';
        $search_size_min     = isset($_GET['search_size_min']) ? sanitize_text_field($_GET['search_size_min']) : '';
        $search_size_max     = isset($_GET['search_size_max']) ? sanitize_text_field($_GET['search_size_max']) : '';
        $search_keywords     = isset($_GET['search_keywords']) ? stripslashes(sanitize_text_field($_GET['search_keywords'])) : '';
        $search_id           = isset($_GET['search_id']) ? sanitize_text_field($_GET['search_id']) : '';
        $featured            = isset($_GET['featured']) ? sanitize_text_field($_GET['featured']) : '';
        $sort                = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest';

        $sort_leads    = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '';
        $leads_page_no = get_query_var('paged');

        $amenities_settings = get_option('resideo_amenities_settings');
        $search_amenities   = array();

        if (is_array($amenities_settings) && count($amenities_settings) > 0) {
            uasort($amenities_settings, "resideo_compare_position");

            foreach ($amenities_settings as $key => $value) {
                if (isset($_GET[$key]) && esc_html($_GET[$key]) == 1) {
                    array_push($search_amenities, $key);
                }
            }
        }

        $custom_fields_settings = get_option('resideo_fields_settings');
        $search_custom_fields = array();

        if (is_array($custom_fields_settings)) {
            uasort($custom_fields_settings, "resideo_compare_position");

            foreach ($custom_fields_settings as $key => $value) {
                if ($value['search'] == 'yes' || $value['filter'] == 'yes') {
                    $field_data = array();

                    if ($value['type'] == 'interval_field') {
                        $search_field_min = isset($_GET[$key . '_min']) ? sanitize_text_field($_GET[$key . '_min']) : '';
                        $search_field_max = isset($_GET[$key . '_max']) ? sanitize_text_field($_GET[$key . '_max']) : '';
                    } else {
                        $search_field = isset($_GET[$key]) ? sanitize_text_field($_GET[$key]) : '';
                    }

                    $comparison = $key . '_comparison';
                    $comparison_value = isset($_GET[$comparison]) ? sanitize_text_field($_GET[$comparison]) : '';
                    $field_data['name'] = $key;

                    if ($value['type'] == 'interval_field') {
                        $field_data['value'] = array($search_field_min, $search_field_max);
                    } else {
                        $field_data['value'] = $search_field;
                    }

                    $field_data['compare'] = $comparison_value;
                    $field_data['type'] = $value['type'];

                    array_push($search_custom_fields, $field_data);
                }
            }
        }

        wp_localize_script('pxp-gallery', 'gallery_vars', 
            array(
                'is_rtl' => is_rtl()
            )
        );

        $user_logged_in = 0;
        $user_is_agent = 0;
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $user_logged_in = 1;
            if (function_exists('resideo_check_user_agent')) {
                if (resideo_check_user_agent($current_user->ID) === true) {
                    $user_is_agent = 1;
                } else {
                    $user_is_agent = 0;
                }
            }
        } else {
            $user_logged_in = 0;
        }

        wp_localize_script('pxp-services', 'services_vars', 
            array(
                'admin_url'           => get_admin_url(),
                'ajaxurl'             => admin_url('admin-ajax.php'),
                'theme_url'           => RESIDEO_LOCATION,
                'base_url'            => home_url(),
                'user_logged_in'      => $user_logged_in,
                'user_is_agent'       => $user_is_agent,
                'wishlist_save'       => esc_html__('Save', 'resideo'),
                'wishlist_saved'      => esc_html__('Saved', 'resideo'),
                'list_redirect'       => function_exists('resideo_get_my_properties_link') ? resideo_get_my_properties_link() : '',
                'leads'               => esc_html__('Leads', 'resideo'),
                'leads_redirect'      => function_exists('resideo_get_myleads_url') ? resideo_get_myleads_url() : '',
                'sort_leads'          => $sort_leads,
                'leads_page_no'       => $leads_page_no,
                'vs_7_days'           => esc_html__('vs last 7 days', 'resideo'),
                'vs_30_days'          => esc_html__('vs last 30 days', 'resideo'),
                'vs_60_days'          => esc_html__('vs last 60 days', 'resideo'),
                'vs_90_days'          => esc_html__('vs last 90 days', 'resideo'),
                'vs_12_months'        => esc_html__('vs last 12 months', 'resideo'),
                'leads'               => esc_html__('Leads', 'resideo'),
                'contacted'           => esc_html__('Contacted', 'resideo'),
                'not_contacted'       => esc_html__('Not contacted', 'resideo'),
                'none'                => esc_html__('None', 'resideo'),
                'fit'                 => esc_html__('Fit', 'resideo'),
                'ready'               => esc_html__('Ready', 'resideo'),
                'engaged'             => esc_html__('Engaged', 'resideo'),
                'messages_list_empty' => esc_html__('No messages.', 'resideo'),
                'wl_list_empty'       => esc_html__('No properties in wish list.', 'resideo'),
                'searches_list_empty' => esc_html__('No saved searches.', 'resideo'),
                'related_property'    => esc_html__('Related Property', 'resideo'),
                'loading_messages'    => esc_html__('Loading messages', 'resideo'),
                'loading_wl'          => esc_html__('Loading wish list', 'resideo'),
                'loading_searches'    => esc_html__('Loading saved searches', 'resideo'),
                'account_redirect'    => function_exists('resideo_get_account_url') ? resideo_get_account_url() : '',
                'theme_mode'          => $theme_mode
            )
        );
         icl_register_string("resideo",$currency,$currency);
          icl_register_string("resideo",$currency_pos,$currency_pos);
        wp_localize_script('pxp-main', 'main_vars', 
            array(
                'theme_url'         => RESIDEO_LOCATION,
                'auto_country'      => $auto_country,
                'default_lat'       => $gmaps_lat,
                'default_lng'       => $gmaps_lng,
                'city_type'         => $city_type,
                'neighborhood_type' => $neighborhood_type,
                'interest'          => esc_html__('Principal and Interest', 'resideo'),
                'taxes'             => esc_html__('Property Taxes', 'resideo'),
                'hoa_dues'          => esc_html__('HOA Dues', 'resideo'),
                'currency'          => pll__($currency),
                'currency_pos'      => pll__($currency_pos),
                'is_rtl'            => is_rtl()
            )
        );
        $search_location_term = get_term_by( 'id', $search_address, 'locations' ); 
        $searchedlocation = $search_location_term->name;  
        
        wp_localize_script('pxp-map', 'map_vars', 
            array(
                'admin_url'             => get_admin_url(),
                'ajaxurl'               => admin_url('admin-ajax.php'),
                'theme_url'             => RESIDEO_LOCATION,
                'base_url'              => home_url(),
                'default_lat'           => $gmaps_lat,
                'default_lng'           => $gmaps_lng,
                'default_zoom'          => $gmaps_zoom,
                'search_status'         => $search_status,
                'search_address'        => $searchedlocation,
                'search_street_no'      => $search_street_no,
                'search_street'         => $search_street,
                'search_neighborhood'   => $search_neighborhood,
                'search_city'           => $search_city,
                'search_state'          => $search_state,
                'search_zip'            => $search_zip,
                'search_type'           => $search_type,
                'search_price_min'      => $search_price_min,
                'search_price_max'      => $search_price_max,
                'search_beds'           => $search_beds,
                'search_baths'          => $search_baths,
                'search_size_min'       => $search_size_min,
                'search_size_max'       => $search_size_max,
                'search_keywords'       => $search_keywords,
                'search_id'             => $search_id,
                'search_amenities'      => $search_amenities,
                'search_custom_fields'  => $search_custom_fields,
                'featured'              => $featured,
                'sort'                  => $sort,
                'page'                  => $paged,
                'theme_mode'            => $theme_mode,
                'gmaps_style'           => $gmaps_style,
                'marker_price_format'   => $map_marker_price_format,
                'transportations_title' => esc_html__('Transportation', 'resideo'),
                'restaurants_title'     => esc_html__('Restaurants', 'resideo'),
                'shopping_title'        => esc_html__('Shopping', 'resideo'),
                'cafes_title'           => esc_html__('Cafes & Bars', 'resideo'),
                'arts_title'            => esc_html__('Arts & Entertainment', 'resideo'),
                'fitness_title'         => esc_html__('Fitness', 'resideo'),
                'gmaps_poi'             => $gmaps_poi
            )
        );

        wp_localize_script('pxp-map-single', 'map_single_vars', 
            array(
                'theme_mode'  => $theme_mode,
                'gmaps_style' => $gmaps_style
            )
        );

        wp_localize_script('pxp-map-contact', 'map_contact_vars', 
            array(
                'theme_mode'  => $theme_mode,
                'gmaps_style' => $gmaps_style
            )
        );

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
endif;
add_action( 'wp_enqueue_scripts', 'resideo_load_scripts' );

if (!function_exists('resideo_wp_title')) :
    function resideo_wp_title($title, $sep) {
        global $page, $paged;

        $title .= get_bloginfo('name', 'display');
        $site_description = get_bloginfo('description', 'display');

        if ($site_description && (is_home() || is_front_page() || is_archive() || is_search())) {
            $title .= " $sep $site_description";
        }

        return $title;
    }
endif;
add_filter('wp_title', 'resideo_wp_title', 10, 2);

if (!function_exists('resideo_compare_position')) :
    function resideo_compare_position($a, $b) {
        return intval($a["position"]) - intval($b["position"]);
    }
endif;

if (!function_exists('resideo_get_attachment')) :
    function resideo_get_attachment($id) {
        $attachment = get_post($id);

        return array(
            'alt'         => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
            'caption'     => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'title'       => $attachment->post_title
        );
    }
endif;

/**
 * Custom excerpt lenght
 */
if (!function_exists('resideo_custom_excerpt_length')): 
    function resideo_custom_excerpt_length($length) {
        return 30;
    }
endif;
add_filter('excerpt_length', 'resideo_custom_excerpt_length', 999);

/**
 * Custom excerpt ending
 */
function resideo_excerpt_more($more) {
    return '&#46;&#46;&#46;';
}
add_filter('excerpt_more', 'resideo_excerpt_more');

if (!function_exists('resideo_get_excerpt_by_id')): 
    function resideo_get_excerpt_by_id($post_id) {
        $the_post       = get_post($post_id);
        $the_excerpt    = $the_post->post_content;
        $excerpt_length = 30;
        $the_excerpt    = strip_tags(strip_shortcodes($the_excerpt));
        $words          = explode(' ', $the_excerpt, $excerpt_length + 1);

        if (count($words) > $excerpt_length) :
            array_pop($words);
            array_push($words, '...');
            $the_excerpt = implode(' ', $words);
        endif;

        wp_reset_postdata();

        return $the_excerpt;
    }
endif;

/**
 * Register sidebars
 */
if (!function_exists('resideo_widgets_init')): 
    function resideo_widgets_init() {
        register_sidebar(array(
            'name'          => esc_html__('Main Widget Area', 'resideo'),
            'id'            => 'pxp-main-widget-area',
            'description'   => esc_html__('The main widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        if (function_exists('dsidxpress_InitWidgets')) {
            register_sidebar(array(
                'name'          => esc_html__('IDX Properties Page Search Widget Area', 'resideo'),
                'id'            => 'pxp-idx-search-widget-area',
                'description'   => esc_html__('IDX properties page search form widget area', 'resideo'),
                'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
            ));
        }

        register_sidebar(array(
            'name'          => esc_html__('Column #1 Footer Widget Area', 'resideo'),
            'id'            => 'pxp-first-footer-widget-area',
            'description'   => esc_html__('The first column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

    
        register_sidebar(array(
            'name'          => esc_html__('Column #2 Footer Widget Area', 'resideo'),
            'id'            => 'pxp-second-footer-widget-area',
            'description'   => esc_html__('The second column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'name'          => esc_html__('Column #3 Footer Widget Area', 'resideo'),
            'id'            => 'pxp-third-footer-widget-area',
            'description'   => esc_html__('The third column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'name'          => esc_html__('Column #4 Footer Widget Area', 'resideo'),
            'id'            => 'pxp-fourth-footer-widget-area',
            'description'   => esc_html__('The fourth column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));








        register_sidebar(array(
            'name'          => esc_html__('Column #1 ar Footer Widget Area', 'resideo'),
            'id'            => 'pxp-first-footer-widget-area-ar',
            'description'   => esc_html__('The first column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

    
        register_sidebar(array(
            'name'          => esc_html__('Column #2 ar Footer Widget Area', 'resideo'),
            'id'            => 'pxp-second-footer-widget-area-ar',
            'description'   => esc_html__('The second column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'name'          => esc_html__('Column #3 ar Footer Widget Area', 'resideo'),
            'id'            => 'pxp-third-footer-widget-area-ar',
            'description'   => esc_html__('The third column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'name'          => esc_html__('Column #4 ar Footer Widget Area', 'resideo'),
            'id'            => 'pxp-fourth-footer-widget-area-ar',
            'description'   => esc_html__('The fourth column footer widget area', 'resideo'),
            'before_widget' => '<div id="%1$s" class="pxp-side-section mt-4 mt-md-5 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));




    }
endif;
add_action('widgets_init', 'resideo_widgets_init');

/**
 * Custom comments
 */

if (!function_exists('resideo_comment_ratings')): 
    function resideo_comment_ratings($comment_id) {
        if (isset($_POST['rate'])) {
            add_comment_meta($comment_id, 'rate', $_POST['rate']);
        }
    }
endif;
add_action('comment_post','resideo_comment_ratings');

if (!function_exists('resideo_comment')): 
    function resideo_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        } ?>

        <<?php echo esc_html($tag); ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

        <div class="media mt-3 mt-md-4">
            <?php if ($args['avatar_size'] != 0) {
                echo get_avatar($comment, $args['avatar_size']);
            }

            if ('div' != $args['style']) : ?>
                <div id="div-comment-<?php comment_ID() ?>" class="comment-body media-body">
            <?php endif; ?>

            <h5><?php echo get_comment_author_link(); ?> <span class="pxp-blog-post-comments-author-label"><?php esc_html_e('Author', 'resideo'); ?></span></h5>

            <div class="pxp-blog-post-comments-date">
                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php printf(esc_html__('%1$s at %2$s', 'resideo'), get_comment_date(), get_comment_time()); ?></a>
                </div>
            </div>

            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'resideo'); ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>

            <ul class="pxp-comment-ops">
                <li><?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></li>
                <li><?php edit_comment_link(esc_html__('Edit', 'resideo')); ?></li>
            </ul>

            <?php if ('div' != $args['style']) : ?>
                </div>
            <?php endif; ?>
        </div>
    <?php }
endif;

if (!function_exists('resideo_agent_review')): 
    function resideo_agent_review($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        } ?>

        <<?php echo esc_html($tag); ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

        <div class="media mt-3 mt-md-4">
            <?php if ($args['avatar_size'] != 0) {
                echo get_avatar($comment, $args['avatar_size']);
            }

            if ('div' != $args['style']) : ?>
                <div id="div-comment-<?php comment_ID() ?>" class="comment-body media-body">
            <?php endif; ?>

            <h5><?php echo get_comment_author_link(); ?></h5>

            <div class="pxp-blog-post-comments-date">
                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php printf(esc_html__('%1$s at %2$s', 'resideo'), get_comment_date(), get_comment_time()); ?></a>
                </div>
            </div>

            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e('Your review is awaiting moderation.', 'resideo'); ?></em>
                <br />
            <?php endif;

            $rate = get_comment_meta($comment->comment_ID, 'rate');

            if (isset($rate[0]) && $rate[0] != '') {
                print resideo_display_agent_rating(array('avarage' => $rate[0], 'users' => 0), false, 'pxp-agent-review-rating');
            }

            comment_text(); ?>

            <?php if ('div' != $args['style']) : ?>
                </div>
            <?php endif; ?>
        </div>
    <?php }
endif;

if(!function_exists('resideo_get_field_value')): 
    function resideo_get_field_value($field_type, $field_value, $list) {
        $field_text = '';

        if ($field_value != '') {
            if ($field_type == 'list') {
                if (is_array($list) && count($list) > 0) {
                    foreach ($list as $key => $value) {
                        if ($field_value == $key) {
                            $field_text = $value['name'];
                        }
                    }
                }
            } else {
                return $field_text = $field_value;
            }
        }

        return $field_text;
    }
endif;

/**
 * Pagination
 */
if (!function_exists('resideo_pagination')): 
    function resideo_pagination($pages = '', $range = 2) {
        $showitems = ($range * 2) + 1;

        global $paged;
        if (empty($paged)) {
            $paged = 1;
        }

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }

        if (1 != $pages) {
            echo '<ul class="pagination pxp-paginantion mt-2 mt-md-4">';

            if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
                echo '<li class="page-item"><a class="page-link" href="' . esc_url(get_pagenum_link(1)) . '"><span class="fa fa-angle-double-left"></span></a></li>';
            }

            if ($paged > 1 && $showitems < $pages) {
                echo '<li class="page-item"><a class="page-link" href="' . esc_url(get_pagenum_link($paged - 1)) . '"><span class="fa fa-angle-left"></span></a></li>';
            }

            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    if ($paged == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">' . esc_html($i) . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="' . esc_url(get_pagenum_link($i)) . '">' . esc_html($i) . '</a></li>';
                    }
                }
            }

            if ($paged < $pages && $showitems < $pages) {
                echo '<li class="page-item"><a class="page-link" href="' . esc_url(get_pagenum_link($paged + 1)) . '"><span class="fa fa-angle-right"></span></a></li>';
            }

            if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
                echo '<li class="page-item"><a class="page-link" href="' . esc_url(get_pagenum_link($pages)) . '"><span class="fa fa-angle-double-right"></span></a></li>';
            }

            echo '</ul>';
        }
    }
endif;

if (!function_exists('resideo_sanitize_item')) :
    function resideo_sanitize_item($item) {
        return sanitize_text_field($item);
    }
endif;

if (!function_exists('resideo_sanitize_multi_array')) :
    function resideo_sanitize_multi_array(&$item, $key) {
        $item = sanitize_text_field($item);
    }
endif;

if (!function_exists('money_format')) :
    function money_format($format, $number) {
        while (true) { 
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 

            if ($replaced != $number) { 
                $number = $replaced; 
            } else { 
                break; 
            }
        }

        return $number; 
    }
endif;

if (!function_exists('resideo_get_client_ip_env')): 
    function resideo_get_client_ip_env() {
        $ipaddress = '';

        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if(getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if(getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if(getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if(getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
endif;

if (!function_exists('resideo_add_dark_mode_class')): 
    function resideo_add_dark_mode_class($classes) {
        $appearance_settings = get_option('resideo_appearance_settings');
        $theme_mode = isset($appearance_settings['resideo_theme_mode_field']) ? $appearance_settings['resideo_theme_mode_field'] : '';

        if ($theme_mode == 'dark') {
            $classes[] = 'pxp-dark-mode';
        }

        return $classes;
    }
endif;
add_filter('body_class', 'resideo_add_dark_mode_class');
include_once('custom_code.php');

include_once('sc_community_detail_page_slider.php');
include_once('sc_show_communities_how_we_can_help.php');
include_once('sc_get_explore_community.php');
include_once('sc_show_community_listing.php');
include_once('sc_show_people.php');
include_once('sc_show_community_properties.php');
include_once('sc_show_design_features.php');
include_once('sc_show_welcome_video_section.php');
include_once('sc_show_explore_our_communities_home.php');
include_once('sc_show_peoples_testimonials.php');
include_once('sc_careers_page_dynamic.php');
include_once('sc_show_contact_page.php');
include_once('sc_fr_testimonials_noslider.php');
include_once('sc_show_missionslider.php');
include_once('sc_onloadpopup.php');
add_action( 'init', 'create_subjects_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it subjects for your posts
 
function create_subjects_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
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

icl_register_string("resideo", 'HAVE A HOME IN MIND?','HAVE A HOME IN MIND?');
icl_register_string("resideo", 'SR','SR');

function have_property_in_mind_calculator()
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

add_shortcode('have_property_in_mind_calculator_services','have_property_in_mind_calculator');

function finance_home_image()
{
    ob_start();
    ?>
    <div>
        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/08/yyyy.png" width="100%">
    </div>
    <?php
   return  ob_get_clean();
}
add_shortcode('finance_home_image_services','finance_home_image');

function choosing_your_home()
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
add_shortcode('choosing_your_home_services','choosing_your_home');

function faqs_home_image()
{
    ob_start();
    ?>
    <div>
        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/08/Capture1111.png" width="100%">
    </div>
    <?php
   return  ob_get_clean();
}
add_shortcode('faqs_home_image_services','faqs_home_image');





function single_register_settings() {
    add_option( 'information_heading', '');
    register_setting( 'single_options_group', 'information_heading', 'single_callback' );
    add_option( 'phone_number', '');
    register_setting( 'single_options_group', 'phone_number', 'single_callback' );
    add_option( 'cta_btn_text', '');
    register_setting( 'single_options_group', 'cta_btn_text', 'single_callback' );
    add_option( 'informative_desc', '');
    register_setting( 'single_options_group', 'informative_desc', 'single_callback' );
    add_option( 'material_heading', '');
    register_setting( 'single_options_group', 'material_heading', 'single_callback' );
    add_option( 'material_desc', '');
    register_setting( 'single_options_group', 'material_desc', 'single_callback' );
    add_option( 'property_contact_intro', '');
    register_setting( 'single_options_group', 'property_contact_intro', 'single_callback' );
    add_option( 'property_email_us', '');
    register_setting( 'single_options_group', 'property_email_us', 'single_callback' );
    add_option( 'property_call_us', '');
    register_setting( 'single_options_group', 'property_call_us', 'single_callback' );
    
}
add_action( 'admin_init', 'single_register_settings' );

function single_register_options_page() {
    add_options_page('Single Property Info', 'Single Property Info', 'manage_options', 'single', 'single_options_page');
}
add_action('admin_menu', 'single_register_options_page');

function single_options_page() {
    ?>
    <style type="text/css">
        .setting_input{
            width: 45%;
        }
    </style>
    <div>
        <h2>Single Property Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'single_options_group' ); ?>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="information_heading">Information Heading</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="information_heading" name="information_heading" value="<?php echo get_option('information_heading'); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="phone_number">Phone #</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="phone_number" name="phone_number" value="<?php echo get_option('phone_number'); ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="cta_btn_text">CTA Button Text</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="cta_btn_text" name="cta_btn_text" value="<?php echo get_option('cta_btn_text'); ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="informative_desc">Info. Description</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="informative_desc" name="informative_desc" value="<?php echo get_option('informative_desc'); ?>" rows="4">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="material_heading">Material Heading</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="material_heading" name="material_heading" value="<?php echo get_option('material_heading'); ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="material_desc">Material Description</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="material_desc" name="material_desc" value="<?php echo get_option('material_desc'); ?>" rows="4">
                    </td>
                </tr>
                
                <tr>
                    <th>
                        <label for="property_contact_intro">Contact Intro</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="property_contact_intro" name="property_contact_intro" value="<?php echo get_option('property_contact_intro'); ?>" rows="4">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="property_email_us">Email us text</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="property_email_us" name="property_email_us" value="<?php echo get_option('property_email_us'); ?>" rows="4">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="property_call_us">Call us text</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="property_call_us" name="property_call_us" value="<?php echo get_option('property_call_us'); ?>" rows="4">
                    </td>
                </tr>
                <!-- <tr>
                    <th>
                        <label for="property_call_us">Business</label>
                    </th>
                    <td>
                        <input class="setting_input" type="text" id="property_call_us" name="property_call_us" value="<?php echo get_option('property_call_us'); ?>" rows="4">
                    </td>
                </tr> -->
                
            </table>
            <?php  submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action("init","product_name_typeahead_fn");
function product_name_typeahead_fn()
{
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
   
    if( isset($_GET['prod_name']) && $_GET['prod_name'] != "") {
        $search = $_GET['prod_name'];
        
        $prodResult= array();
        $args = array (
            'taxonomy'               => 'locations',
            'order'                  => 'ASC',
            'orderby'                => 'name',
            'hide_empty'             => false,
        );
        // if ( isset($_GET['lang']) && $_GET['lang'] == "ar") {
        //     $args['meta_query'] = array(
        //         array(
        //             'key' => 'translation',
        //             'value' => $search,
        //             'compare' => 'like'
        //         )
        //     );
        // } else {
        //     $args['name__like'] = $search;
        // }
   
        $term_query = new WP_Term_Query($args);
        // print_r($term_query);
        if ( ! empty( $term_query ) && ! is_wp_error( $term_query ) ) {
            foreach ( $term_query ->terms as $term ){
                $name = $term->name;
                $id = $term->term_id;
                $trans = get_field('translation','term_'.$id);
                $send_name = (isset($_GET['lang']) && $_GET['lang'] == "ar" ? $trans : $name);

                $prodResult[] = array('emp_name'=>$send_name,'href'=>$id,'realname'=>$send_name,'type'=>'city');
                break;
            }
        }

        // if(count($prodResult) < 3) {
        //     $args2 = array (
        //                 'post_type'        => 'property',
        //                 'posts_per_page'   => '5',
        //                 'post_status'      => 'publish',
        //                 'orderby'          => 'title', 
        //                 'order'            => 'ASC',
        //                 'title_search'     => $search
        //             );
        //     if ( isset($_GET['lang']) && $_GET['lang'] == "ar") {
        //         $args2['lang'] = 'ar';
        //     }
        //     add_filter( 'posts_where', 'property_posts_where', 10, 2 );
        //     $loop = new WP_Query($args2);
        //     remove_filter('posts_where','property_posts_where');
        //     // echo $loop->request;
        //     while ( $loop->have_posts() ) {
        //         $loop->the_post();

        //         $id = get_the_ID();
        //         $title = get_the_title();
        //         $prodResult[] = array('emp_name'=>$title,'href'=>$id,'realname'=>$title,'type'=>'name');
        //     }
        // }
        echo json_encode($prodResult);
        exit;
    }
    elseif(isset($_GET['prod_name']) && $_GET['prod_name'] == ""){
        $prodResult2= array();
        $args = array (
          'taxonomy'               => 'locations',
          'order'                  => 'ASC',
          'orderby'                => 'name',
          
      );
      if ( isset($_GET['lang']) && $_GET['lang'] == "ar") {
          $args['meta_query'] = array(
              array(
                  'key' => 'translation',
                  'value' => '',
                  'compare' => 'like'
              )
          );
      }
  
      $term_query = new WP_Term_Query($args);
      // print_r($term_query);
      if ( ! empty( $term_query ) && ! is_wp_error( $term_query ) ) {
          foreach ( $term_query ->terms as $term ){
              $name = $term->name;
              $id = $term->term_id;
              $trans = get_field('translation','term_'.$id);
              $send_name = (isset($_GET['lang']) && $_GET['lang'] == "ar" ? $trans : $name);

              $prodResult2[] = array('emp_name'=>$send_name,'href'=>$id,'realname'=>$send_name,'type'=>'city');
              break;
          }
      }
    // $status_tax = array('locations');
    // $status_args = array(
    //     'orderby' => 'name',
    //     'order' = > 'ASC',
    //     'hide_empty' => false
    //     );
    // $status_terms = get_terms($status_tax,$status_args);
      echo json_encode($prodResult2);
      exit;
   }
}

function property_posts_where($where, &$wp_query) {
    global $wpdb;
    if ( $title_search = $wp_query->get( 'title_search' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $title_search ) ) . '%\'';
    }
    return $where;
}

add_action('init', function () { if(!session_id()) { session_start(); } }, 1);

add_action('wp_head', 'custom_code_in_head', 1);
function custom_code_in_head(){
    if( strtolower(get_field('page_slug'))=="single-community" or strtolower(get_field('page_slug'))=="single-community-ar")
    {
        if(isset($_GET['term_id']) && !empty($_GET['term_id']) ){
            $_SESSION['term_id'] = $_GET['term_id'];
            $community_slug = get_term_by('id', $_SESSION['term_id'], 'Community');
            //echo "tests";print_r($community_slug);
        }
        else if(isset($_SESSION['term_id']) && !empty($_SESSION['term_id']) ){
            $community_slug = get_term_by('id', $_SESSION['term_id'], 'Community');
            //echo "tests";print_r($community_slug);
            if (strtolower(get_field('page_slug')) == "single-community") {
                $url = site_url().'/single-community/?term_id='.$_SESSION['term_id'].'&community='. $community_slug->slug;
                wp_redirect($url);
            } else if (strtolower(get_field('page_slug')) == "single-community-ar") {
                $url = site_url().'/ar/single-community-ar/?term_id='.$_SESSION['term_id'].'&community='. $community_slug->slug;
                wp_redirect($url);
            }
        }
    } 
}

/*add_action('wpcf7_init', function (){
    wpcf7_add_form_tag( array('Project', 'Project*'), 'cf7_state_dropdown' , true );
});
function cf7_state_dropdown($tag) {

    $tag = new WPCF7_FormTag( $tag );

    $atts = array();

    $validation_error = wpcf7_get_validation_error( $tag->type );

    $class = wpcf7_form_controls_class( $tag->type );

    if ( $validation_error ) {
        $class .= ' wpcf7-not-valid';
    }

    $atts['class'] = $tag->get_class_option( $class );
    $atts['aria-required'] = 'true';
    $atts['aria-invalid'] = $validation_error ? 'true' : 'false';

    $atts = wpcf7_format_atts( $atts );
    $args = array(
        'post_type'        => 'property',
        'order'            => 'DESC',
        'orderby'            => 'title',
        'post_status'      => 'publish'
    );
    $the_query = new WP_Query( $args );
    $output = '';
    if ( $the_query->have_posts() ) {

        $output = '<span class="wpcf7-form-control-wrap '.sanitize_html_class( $tag->name ).'"><select name="project" id="project" '.$atts.'>';
        $output .= "<option value=\"\">Your project</option>";
        while ( $the_query->have_posts() ) {
            $output .= '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
        }
        
        $output .= "</select></span>";
        $output .= $validation_error;
    }


    return $output;
}*/
/* For adding call button next to whatsapp */
add_action( 'wp_footer', 'ct_show_call_btn' );
function ct_show_call_btn() {
   
    ?>
    <div class="ct_callBtn_cnt">
    <div class="ct_callBtn_cont">
        <a href="tel:92-000-1769" class="ct_call_toggle">
          <i class="fa fa-phone"></i>
        </a>
    </div>
    </div>
    <?php
   
}

/* for adding addiotnal class for a tag in menu. add_a_class will become a parameter in the menu register array where we can pass the values */

function add_additional_class_on_a($classes, $item, $args)
{
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);




/* OG titles */
// add_filter('og_og_title_meta', 'my_og_og_title_meta');
// function my_og_og_title_meta($title)
// {
 
//         return '<meta name="title" property="og:title" content="Al Tahaluf Real Estate company" />';
   
//     return $title;
// }
// add_filter( 'og_twitter_title_value', 'my_og_twitter_title_value' );

// function my_og_twitter_title_value($title)
// {
  
//         return __('Al Tahaluf Real Estate company', 'translate-domain');
  
//     return $title;
// }

//  add_filter('og_og_image_value', 'my_og_og_image_value');
//  function my_og_og_image_value($value) {
    
// 	$value = 'https://sigmaprivate.com/wp-content/uploads/2021/09/sigmalogo.jpg';
// 	return $value;
//  }

// add a settings page for adding popup
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Additional Settings',
        'menu_slug'     => 'theme-additional-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme popup',
        'menu_title'    => 'Popup settings',
        'parent_slug'   => 'theme-additional-general-settings',
    ));
    
    // acf_add_options_sub_page(array(
    //     'page_title'    => 'Theme Footer Settings',
    //     'menu_title'    => 'Footer',
    //     'parent_slug'   => 'theme-general-settings',
    // ));
    
}
?>