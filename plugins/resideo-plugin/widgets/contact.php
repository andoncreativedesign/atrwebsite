<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

class Resideo_Contact_Widget extends WP_Widget {
    function __construct() {
        $widget_ops  = array('classname' => 'resideo_contact_sidebar', 'description' => __('Your contact information', 'resideo'));
        $control_ops = array('id_base' => 'resideo_contact_widget');

        parent::__construct('resideo_contact_widget', __('Resideo Contact Info', 'resideo'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array(
            'title'  => '',
            'logo'   => '',
            'line_1' => '',
            'line_2' => '',
            'line_3' => '',
            'line_4' => '',
            'line_5' => ''
        );

        $instance = wp_parse_args((array) $instance, $defaults);

        $has_logo = '';
        if ($instance['logo'] == 1) {
            $has_logo = 'checked="checked"';
        }

        $display = '
            <p>
                <label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title', 'resideo') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
            </p>
            <p>
                <input id="' . esc_attr($this->get_field_id('logo')) . '" name="' . esc_attr($this->get_field_name('logo')) . '" type="checkbox" value="1" ' . esc_attr($has_logo) . ' />
                <label for="' . esc_attr($this->get_field_id('logo')) . '">' . __('Display logo', 'resideo') . '</label>
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('line_1')) . '">' . __('Line 1', 'resideo') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('line_1')) . '" name="' . esc_attr($this->get_field_name('line_1')) . '" value="' . esc_attr($instance['line_1']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('line_2')) . '">' . __('Line 2', 'resideo') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('line_2')) . '" name="' . esc_attr($this->get_field_name('line_2')) . '" value="' . esc_attr($instance['line_2']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('line_3')) . '">' . __('Line 3', 'resideo') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('line_3')) . '" name="' . esc_attr($this->get_field_name('line_3')) . '" value="' . esc_attr($instance['line_3']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('line_4')) . '">' . __('Line 4', 'resideo') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('line_4')) . '" name="' . esc_attr($this->get_field_name('line_4')) . '" value="' . esc_attr($instance['line_4']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('line_5')) . '">' . __('Line 5', 'resideo') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('line_5')) . '" name="' . esc_attr($this->get_field_name('line_5')) . '" value="' . esc_attr($instance['line_5']) . '" />
            </p>
        '; 

        print $display;
    }


    function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title']  = sanitize_text_field($new_instance['title']);
        $instance['logo']   = isset($new_instance['logo']) ? 1 : false;
        $instance['line_1'] = sanitize_text_field($new_instance['line_1']);
        $instance['line_2'] = sanitize_text_field($new_instance['line_2']);
        $instance['line_3'] = sanitize_text_field($new_instance['line_3']);
        $instance['line_4'] = sanitize_text_field($new_instance['line_4']);
        $instance['line_5'] = sanitize_text_field($new_instance['line_5']);

        if (function_exists('icl_register_string')) {
            icl_register_string('resideo_contact_widget', 'resideo_contact_widget_title', sanitize_text_field($new_instance['title']));
            icl_register_string('resideo_contact_widget', 'resideo_contact_widget_line_1', sanitize_text_field($new_instance['phone_1']));
            icl_register_string('resideo_contact_widget', 'resideo_contact_widget_line_2', sanitize_text_field($new_instance['phone_2']));
            icl_register_string('resideo_contact_widget', 'resideo_contact_widget_line_3', sanitize_text_field($new_instance['phone_3']));
            icl_register_string('resideo_contact_widget', 'resideo_contact_widget_line_4', sanitize_text_field($new_instance['phone_4']));
            icl_register_string('resideo_contact_widget', 'resideo_contact_widget_line_5', sanitize_text_field($new_instance['phone_5']));
        }

        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $display = '';
        $title = apply_filters('widget_title', $instance['title']);

        print $before_widget;

        if ($title) {
            print $before_title . esc_html($title) . $after_title;
        }

        $logo = ! empty($instance['logo']) ? $instance['logo'] : false;

        if ($logo) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id , 'pxp-full');
            $logo_class = $logo !== false ? 'pxp-has-img' : '';

            $display .= '<a href="' . esc_url(home_url('/')) .'" class="pxp-side-logo text-decoration-none ' . $logo_class . '">';

            if ($logo !== false) {
                $theme_url = get_template_directory_uri();
                $display .= '<img src="'.$theme_url.'/images/svg_logo/footer_logo.svg" alt="' . esc_attr(get_bloginfo('name')) . '"/>';
                // $display .= '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '"/>';
            } else {
                $display .= esc_html(get_bloginfo('name'));
            }
            $display .= '</a>';
        }

        $display .= '<div class="pxp-side-address mt-4">';

        if ($instance['line_1']) {
            if (function_exists('icl_t')) {
                $info_line_1 = icl_t('resideo_contact_widget', 'contact_widget_line_1', $instance['line_1']);
            } else {
                $info_line_1 = $instance['line_1'];
            }

            $display .= '<p>' . esc_html($info_line_1) . '</p>';
        }

        if ($instance['line_2']) {
            if (function_exists('icl_t')) {
                $info_line_2 = icl_t('resideo_contact_widget', 'contact_widget_line_2', $instance['line_2']);
            } else {
                $info_line_2 = $instance['line_2'];
            }

            $display .= '<p>' . esc_html($info_line_2) . '</p>';
        }

        if ($instance['line_3']) {
            if (function_exists('icl_t')) {
                $info_line_3 = icl_t('resideo_contact_widget', 'contact_widget_line_3', $instance['line_3']);
            } else {
                $info_line_3 = $instance['line_3'];
            }

            $display .= '<p>' . esc_html($info_line_3) . '</p>';
        }
        if ($instance['line_4']) {
            if (function_exists('icl_t')) {
                $info_line_4 = icl_t('resideo_contact_widget', 'contact_widget_line_4', $instance['line_4']);
            } else {
                $info_line_4 = $instance['line_4'];
            }

            $display .= '<a href="tel:'. esc_html($info_line_4) .'" style="color: #fff;text-decoration: none;">'. esc_html($info_line_4) .'</a><br>';
        }
        if ($instance['line_5']) {
            if (function_exists('icl_t')) {
                $info_line_5 = icl_t('resideo_contact_widget', 'contact_widget_line_5', $instance['line_5']);
            } else {
                $info_line_5 = $instance['line_5'];
            }

            $display .= '<a href="mailto:'. esc_html($info_line_5) .'" style="color: #fff;text-decoration: none;">'. esc_html($info_line_5) .'</a>';
        }

        $display .= '</div>';

        print $display;
        print $after_widget;
    }
}
?>