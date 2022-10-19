<?php
function community_detail_page_slider_fn()
{
    ob_start();
    exit();
    ?>
    <div class="pxp-hero vh-100">
        <div class="pxp-hero-bg pxp-cover pxp-cover-bottom" style="background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/08/Mask-Group-21.png);"></div>
        <div class="pxp-hero-opacity" style="background: rgba(0,0,0,0);"></div>
        <div class="pxp-hero-caption  pxp-no-form">
            <div class="container">
                <h1 class="text-white">ISHRAQ LIVING MINISTRY OF HOUSING PROJECT</h1>
                <p class="pxp-text-light text-white mb-0"></p>
            </div>
        </div>
    </div>
    <?php
   return  ob_get_clean();
    
}

add_shortcode('community_detail_page_slider','community_detail_page_slider_fn');