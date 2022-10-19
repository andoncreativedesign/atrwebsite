<?php
/**
 * Featured posts block
 */
if (!function_exists('resideo_featured_posts_block')): 
    function resideo_featured_posts_block() {
        wp_register_script(
            'resideo-featured-posts-block',
            plugins_url('js/featured-posts.js', __FILE__),
            array('wp-blocks', 'wp-element', 'wp-components', 'wp-editor', 'wp-i18n')
        );

        wp_enqueue_style(
            'resideo-featured-posts-block-editor',
            plugins_url('css/featured-posts.css', __FILE__),
            array('wp-edit-blocks')
        );

        register_block_type('resideo-plugin/featured-posts', array(
            'editor_script' => 'resideo-featured-posts-block',
            'attributes' => array(
                'data_content' => array('type' => 'string')
            ),
            'render_callback' => 'resideo_featured_posts_shortcode'
        ));
    }
endif;
add_action('init', 'resideo_featured_posts_block');
?>