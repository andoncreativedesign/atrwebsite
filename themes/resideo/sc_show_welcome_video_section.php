<?php 
function show_welcome_video_section_fn(){
    ob_start();
    ?>
    <div class="pt-100 pb-100 page_service body_color" style=" padding-bottom: 70px;">
        <div class="container">


            <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                <div class="pxp-services-h-items pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 pxp-in" style="min-height: 284px">
                    <p class="pxp-text-light" style="color: ">WELCOME TO ISHRAQ LIVING</p>
                    <h3 class="pxp-section-h2" style="color: ">WHERE HAPPINESS LIVES</h3><div>
                     <p style="padding-right: 10px; text-align: left;"></p><p>Ishraq Living project is located in a prime location in North of Riyadh, West of King Khalid international Airport and consists of four modern houses and townhouses with open spaces with Saudi traditional touch, each built start from 296 meter square of BUA.</p><p>
                     </p>
                 </div><a href="#" class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate pxp-animate-in pxp-in" id="cta-62ecef7ce8230" style="color: ">SEARCH ALL PROPERTIES</a></div>
                 <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in" style="height: 400px">
                    <div style="display:none" class="my_iframe">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/HteQt1mkRfM?autoplay=1" title="YouTube video player" allow="autoplay" frameborder="0" allowfullscreen=""></iframe>
                    </div>
                    <div class="iframe_video" style="margin-top: 36px; background-color: rgb(0, 0, 0); min-height: 382px;"><iframe width="100%" height="315" src="https://www.youtube.com/embed/HteQt1mkRfM?autoplay=1" title="YouTube video player" allow="autoplay" frameborder="0" allowfullscreen=""></iframe></div>

                </div>

            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode("show_welcome_video_section","show_welcome_video_section_fn");