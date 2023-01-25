<?php
function sc_onload_popup_fn()
{
    $popup_logo = get_field('cs_popup_logo', 'option'); 
    if(get_locale() == "ar" ) {
        $popup_title = get_field('cs_popup_title_ar', 'option');
        $popup_copy = get_field('cs_popup_copy_ar', 'option'); 
    } else 
    {
        $popup_title = get_field('cs_popup_title', 'option');
        $popup_copy = get_field('cs_popup_copy', 'option'); 
    }
    
    $popup_form_shortcode = get_field('cs_form_shortcode', 'option');
  ob_start();
  ?>
 <div id="comingsoonModal" class="comingsoonModal">

<!-- Modal content -->
<div class="comingsoon-modal-content">
<span class="comingsoon-modal-close"></span>
<div class="cs_copy_cont">
<img src="<?php echo $popup_logo;?>"/>
    <div>
        <h2><?php echo $popup_title;?></h2>
        <?php 
        echo $popup_copy;
        ?>
        <!-- <p>We are breaking ground on our new 280-villa community residences in Riyadh's north-eastern area.
           The land area of these residences will range from 300m<sup>2</sup> to 500m<sup>2</sup>, while the built up area will vary between 360m<sup>2</sup> and 500m<sup>2</sup>.
        </p>
        <p>
        If you want to know more, please fill in your details below and our community specialists will reach out to you with more information.
        </p> -->
    </div>
</div>
<?php echo do_shortcode($popup_form_shortcode) //echo do_shortcode('[contact-form-7 id="2705" title="Coming soon vyda"]'); ?>
</div>

</div>
  <?php
  return  ob_get_clean();   
}

add_shortcode('sc_onload_popup','sc_onload_popup_fn');