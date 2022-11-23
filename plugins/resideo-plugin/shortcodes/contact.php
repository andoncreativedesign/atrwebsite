<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

/**
 * Contact shortcode
 */
if (!function_exists('resideo_contact_shortcode')): 
    function resideo_contact_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array('data_content'), $attrs));

        if (!isset($attrs['data_content'])) {
            return null;
        }

        $s_array = json_decode(urldecode($attrs['data_content']), true);

        $margin_class = $s_array['margin'] == 'yes' ? 'mt-100' : '';

        $image  = isset($s_array['image']) ? $s_array['image'] : '';
        if ($image != '') {
            $photo = wp_get_attachment_image_src($image, 'pxp-full');
            $photo_src = $photo[0];
        } else {
            $photo_src = '';
        }
        $ct_intro = get_field("ct_intro_text");
        $ct_form_intro = get_field("ct_form_intro");
        $text_color    = isset($s_array['text_color']) ? 'color: ' . $s_array['text_color'] : '';
        $form_title    = isset($s_array['form_title']) ? $s_array['form_title']: '';
        $form_subtitle = isset($s_array['form_subtitle']) ? $s_array['form_subtitle']: '';
        $form_email    = isset($s_array['form_email']) ? $s_array['form_email']: '';
        $form_position = isset($s_array['position']) ? $s_array['position']: 'right';

        $intro_column_class = 'order-1';
        $form_column_class = 'order-3';
        if ($form_position == 'left') {
            $intro_column_class = 'order-3';
            $form_column_class = 'order-1';
        }

        $nonce_field = wp_nonce_field('contact_section_form_ajax_nonce', 'contact_section_security', true, false);
        if(!isset($ct_intro))  $ct_intro= '';
        if(!isset($ct_form_intro))  $ct_form_intro= '';
        if ( is_front_page() or get_field('page_slug') == 'home-ar') {
            $return_string = 
            '
           

            <div class="pxp-contact-section pxp-cover pt-50 pb-100 contact_bg " style="background-image: url(' .$photo_src. ');">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xl-4 align-left ' . esc_attr($intro_column_class) . '">
                            <p class="pxp-text-light contact_color" style=" font-weight: 700;">' . esc_html($s_array['title']) . '</p>
                            <h2 class="pxp-section-h2 contact_color" style=" ">' . esc_html($s_array['subtitle']) . '</h2>
                           '.$ct_intro.'
                           
                        </div>
                        <div class="col-lg-1 col-xl-1 order-2">
                        </div>
                        <div class="col-lg-7 align-left ' . esc_attr($form_column_class) . '">
                        <p class="ct_form_intro">'.$ct_form_intro.'</p>
                        ';
                            $return_string .= apply_shortcodes( '[contact-form-7 id="654" title="Contact form 1"]' ) .'
                        </div>
                    </div>
                </div>
            </div>';

        
        }
        else
        {
            $return_string = 
            '
           

            <div class="pxp-contact-section pxp-cover pt-50 pb-100 " style="background-image: url(' .$photo_src. '); background-position: bottom right;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xl-4 align-left ' . esc_attr($intro_column_class) . '">
                            <p class="pxp-text-light " style=" font-weight: 700;">' . esc_html($s_array['title']) . '</p>
                            <h2 class="pxp-section-h2 " style=" ">' . esc_html($s_array['subtitle']) . '</h2>
                            '.$ct_intro.'
                        </div>
                        <div class="col-lg-1 col-xl-1 order-2">
                        </div>
                        <div class="col-lg-7 align-left ' . esc_attr($form_column_class) . '">
                        <p class="ct_form_intro">'.$ct_form_intro.'</p>';
                            $return_string .= apply_shortcodes( '[contact-form-7 id="654" title="Contact form 1"]' ) .'
                        </div>
                    </div>
                </div>
            </div>';

        
        }
        return $return_string;
    }
endif;
?>