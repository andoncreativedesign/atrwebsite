<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

/**
 * Recent blog posts shortcode
 */
if (!function_exists('resideo_recent_posts_shortcode')): 
    function resideo_recent_posts_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array('data_content'), $attrs));

        if (!isset($attrs['data_content'])) {
            return null;
        }

        $s_array = json_decode(urldecode($attrs['data_content']), true);

        $args = array(
            'numberposts'      => '3',
            'post_type'        => 'post',
            'order'            => 'DESC',
            'suppress_filters' => false,
            'post_status'      => 'publish',
            'post__in'=>array('1811','1813','1815')
        );
        if(get_locale()=="ar")
        {

           // $posts = wp_get_recent_posts_ar($args);


            $posts =  wp_get_recent_posts($args);
           // print_r(get_post_meta('1'));exit;
        }
        else
        {
             $posts = wp_get_recent_posts($args);
        }
   

        $margin_class = $s_array['margin'] == 'yes' ? 'mt-100' : '';
        $blog_url = get_permalink(get_option('page_for_posts'));

        $cta_color = isset($s_array['cta_color']) ? $s_array['cta_color'] : '';
        $card_cta_color = isset($s_array['card_cta_color']) ? $s_array['card_cta_color'] : '';
        $cta_id = uniqid();

        $return_string = 
            '<div class="container ' . esc_attr($margin_class) . '">
                <p class="pxp-text-light color_green">' . esc_html($s_array['title']) . '</p>
                <h2 class="pxp-section-h2 blog_heading">' . esc_html($s_array['subtitle']) . '</h2>
                <div class="row mt-4 mt-md-5">';

        foreach($posts as $post) : 
            $p_title = $post['post_title'];
            $post_id = $post['ID'];
            $blog_image = get_field('blog_image', $post_id);
            $blog_title = substr(get_field('blog_title',$post_id), 0, 50);
            $blog_link = get_field('blog_url', $post_id);
            $p_link = get_permalink($post['ID']);
            $p_date = get_the_date('F j, Y', $post['ID']);

            $post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), 'pxp-gallery');

            if ($post_image != '') {
                $p_photo = $post_image[0];
            } else {
                $p_photo = false;
            }

            $categories = get_the_category($post['ID']);
            $separator = ', ';
            $output = '';
            $categories_str = '';

            if ($categories) {
                foreach ($categories as $category) {
                    $output .=  $category->cat_name . $separator;
                }
                $categories_str = trim($output, $separator);
            }

            // icl_register_string("resideo", 'No related articles','No related articles');

            $item_class = $p_photo === false ? 'pxp-no-image' : '';

            $return_string .= 
                '<div class="col-sm-12 col-md-6 col-lg-4 newsnippetellipsis">
                    <a href="' . $blog_link . '" target="_blank" class="pxp-posts-1-item ' . esc_attr($item_class) . '">
                   '.'
                        <div class="pxp-posts-1-item-fig-container">';
            icl_register_string("resideo", $blog_title,$blog_title);
            icl_register_string("resideo", $categories_str,$categories_str);
            icl_register_string("resideo", 'Read Article','Read Article');
            if ($p_photo !== false) {
                $return_string .= '
                            <div class="pxp-posts-1-item-fig pxp-cover" style="background-image2: url(); background-size:cover">
                                <img src="'. $blog_image .'" style="width:100%;">
                            </div>';
            }
            $return_string .= '
                        </div>
                        <div class="pxp-posts-1-item-details">
                            <div class="pxp-posts-1-item-details-category">' . pll__($categories_str) . '</div>
                            <div class="pxp-posts-1-item-details-title">' . pll__( $blog_title) . ' ...</div>
                            <div class="pxp-posts-1-item-details-date mt-2">' . esc_html($p_date) . '</div>
                            <div class="pxp-posts-1-item-cta text-uppercase" style="color: ' . esc_attr($card_cta_color) . '">' . pll__('Read Article', 'resideo') . '</div>
                        </div>
                    </a>
                </div>';
        endforeach;

        icl_register_string("resideo", 'Read More','Read More');
        $return_string .= '
                </div>
                <a href="https://www.linkedin.com/company/al-tahaluf-real-estate-company?trk=public_post_follow-view-profile" target="_blank" class="pxp-primary-cta text-uppercase mt-2 mt-md-4 pxp-animate" id="cta-' . esc_attr($cta_id) . '" style="margin-bottom: 50px; color: ' . esc_attr($cta_color) . '">' . pll__('Read More') . '</a>
                <style>.pxp-primary-cta#cta-' . esc_attr($cta_id) . ':after { border-top: 2px solid ' . esc_html($cta_color) . '; }</style>
            </div>';

        wp_reset_postdata();
        wp_reset_query();

        return $return_string;
    }
endif;
?>