<?php 

function sc_show_contact_page_fn()
{ 
    ob_start();
    


    icl_register_string("resideo", 'SEND US A MESSAGE','SEND US A MESSAGE'); 
    icl_register_string("resideo", 'OUR LOCATION','OUR LOCATION'); 




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
                                    <h2 class="pxp-section-h2 pxp-in"><?php  echo pll__( "OUR LOCATION" ); ?></h2>
                                </div>
                                <div class="col-6 text-right pxp-contact-locations-select-container" style="display: none;">
                                    <select class="custom-select pxp-contact-locations-select">
                                        <option data-lat="<?php echo get_field('latitude'); ?>" data-lng="<?php echo get_field('longitude'); ?>"><?php echo get_field('location_name'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div id="pxp-contact-map" class="mt-3"></div> 
                        </div>
                </div>
            </div>
    <?php 
    return ob_get_clean();

}