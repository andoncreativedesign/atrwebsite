<?php 
function get_explore_the_Community()
{ 
    ob_start();
    $term_id    = @$_GET['term_id'];
    $term_id    = !empty($term_id) ? $term_id : get_the_ID();
    $tt         = 'term_'.$term_id;
    $mp         = get_field("map_pin",$tt);
    $map_iframe = get_field("map_iframe",$tt);
    $lat        = (isset($mp['lat']) ? $mp['lat'] : '');
    $lng        = (isset($mp['lng']) ? $mp['lng'] : '');
    ?>
    <div class="pt-100 pb-100 page_service1_community body_color" style="margin-bottom: 58px; background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2022/07/contact_bg.png); background-repeat: no-repeat; background-position: top right;">
        <div class="container">


            <div class="pxp-services-h-container mt-4 mt-md-5" style="margin-top:0px !important;">
                <div class="pxp-services-h-fig pxp-cover pxp-animate-in rounded-lg pxp-in" style="height: 400px; -webkit-filter: grayscale(100%); filter: grayscale(100%);">
                    <!-- <div id="map"></div> -->
                    <!-- <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure distance on map</a></iframe> -->
                    <!-- <div class="" style="margin-top: 36px; background-color:#000">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/08/Mask-Group-62.png">
                    </div> -->
                    <?php 
                    if(!empty($map_iframe)){
                        echo $map_iframe;
                    } else { ?>
                        <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $lat.',',$lng; ?>&hl=en&z=14&amp;output=embed">
                            <a href="https://maps.google.com/maps?q=<?php echo $lat.',',$lng; ?>&hl=en;z=14&amp;output=embed" style="color:#0000FF;text-align:left" target="_blank">
                                See map bigger
                            </a>
                        </iframe>
                        <?php
                    }
                    icl_register_string("resideo","LOREM IPSUM DOLOR SIT","LOREM IPSUM DOLOR SIT");
                     ?>
                </div>
                <div class="pxp-services-h-items pxp-services-h-items-img pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 pxp-in" style="min-height: 284px; padding-left: 60px; margin-right: 0px !important">
                    <p class="pxp-text-light" style="color: "><?php echo pll__("EXPLORE THE COMMUNITY"); ?></p>
                    <h3 class="pxp-section-h2" style="color: "><?php echo pll__("LOREM IPSUM DOLOR SIT"); ?></h3>
                    <div class="row" style="padding: 15px 0px 15px 0px; display: none;">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">  
                                <div style="height: 30px; width: 30px; background-color: #4D858D; display: inline-block;"></div>
                                </div>
                                <div class="col-md-9">  
                                    <div style="display: inline-block;">
                                        <p >Qaser</p>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">  
                                <div style="height: 30px; width: 30px; background-color: black; display: inline-block;"></div>
                                </div>
                                <div class="col-md-9">  
                                    <div style="display: inline-block;">
                                        <p >Dhiya</p>
                                    </div>
                                </div>

                            </div>
                            
                        </div>

                    </div>
                    <div class="row" style="padding: 15px 0px 15px 0px; display: none;">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">  
                                <div style="height: 30px; width: 30px; background-color: #7B868C; display: inline-block;"></div>
                                </div>
                                <div class="col-md-9">  
                                    <div style="display: inline-block;">
                                        <p >Aseel</p>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">  
                                <div style="height: 30px; width: 30px; background-color: #af8814; display: inline-block;"></div>
                                </div>
                                <div class="col-md-9">  
                                    <div style="display: inline-block;">
                                        <p >Narjis</p>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                        
                    </div>
                   <a href="https://maps.google.com/maps?q=<?php echo $lat.',',$lng; ?>&hl=en;z=14" target="_blank" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate" id="cta-62ebbdb9f0542" style="color: #333333"><?php echo pll__("VIEW ON GOOGLE MAPS"); ?></a>
                </div>
            </div>
        </div>
    </div>   

    <!-- <script type="text/javascript">
        var locations = [
          ['Bondi Beach', -33.890542, 151.274856, 4]
        ];
        
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: new google.maps.LatLng(-33.92, 151.25),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        var infowindow = new google.maps.InfoWindow();

        var marker, i;
        
        for (i = 0; i < locations.length; i++) {  
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
          });
          
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
    </script> -->
    <?php 
    return ob_get_clean();

}

add_shortcode('get_explore_community','get_explore_the_Community');