<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

$general_settings = get_option('resideo_general_settings');
$copyright        = isset($general_settings['resideo_copyright_field']) ? $general_settings['resideo_copyright_field'] : ''; ?>

    <div class="pxp-footer">
        <div class="container pt-100" style="padding-bottom: 25px;"><?php get_sidebar('footer'); ?><?php if ($copyright != '') { ?>
            <div class="pxp-footer-bottom mt-4 mt-md-5" style="border-top: 1px solid #4D858D; padding-top:8px">
                <div>
                    <!-- Menu for privacy and cooie policy-->
                    <!-- <a href="#" style="color: gray;">Cookies & Privacy policy</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" style="color: gray;">Terms & Conditions</a> -->
                    <?php wp_nav_menu(array('theme_location' => 'footer','container_class'=>'ct_bottom_menu'));  ?>
                </div>

                <div class="pxp-footer-copyright"><?php echo esc_html($copyright); ?></div>
            </div><?php } ?></div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>