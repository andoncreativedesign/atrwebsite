<?php

/*

<div class="pxp-testim-1-intro" style="margin-top:0px">
        
   <p class="pxp-text-light text-uppercase" style="font-weight:600"> OUR FAMILY </p>
   <h3 class="pxp-section-h2 text-uppercase">OUR FAMILIES OF COMPANIESs</h3>
   <a href="#" class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-3 pxp-animate" >How it all started</a>
</div>

<div class="pxp-testim-1-container mt-4 mt-md-5 mt-lg-0">
	
	<div style="text-align: center; ">
		<img src="https://wordpress-823234-2829680.cloudwaysapps.com/wp-content/uploads/2022/07/logo_new4.png" style="width:90%;">
	</div>

</div>

*/

if (get_field('page_slug')=='FAQs' or get_field('page_slug')=='FAQs-ar') {
	$return_string = 
	'<div class="pt-100 pb-100 mt-50 pxp-cover " style="background-image: url(' . esc_url($bg_image_src) . '); background-size: cover; background-color: #fff;">'.html_entity_decode($s_array['cta_sevice_text']);


	    $return_string .=

	'</div>';
}
elseif (get_field('page_slug')=='Choosing your home' or get_field('page_slug') == 'choosing your home ar') {
	$return_string = 
	'<div class="pxp-cover " style="background-image: url(' . esc_url($bg_image_src) . '); background-size: cover; background-color: #fff;">'.html_entity_decode($s_array['cta_sevice_text']);


	    $return_string .=

	'</div>';
}
elseif (get_field('page_slug')=='Finance your home' or get_field('page_slug') == 'ar Financing your home') {
	$return_string = 
	'<div class="pxp-cover " style="background-image: url(' . esc_url($bg_image_src) . '); background-size: cover; background-color: #fff;">'.html_entity_decode($s_array['cta_sevice_text']);


	    $return_string .=

	'</div>';
}
elseif (get_field('page_slug')=='Careers') {
	$return_string = 
	'<div class="pxp-cover " style="background-image: url(' . esc_url($bg_image_src) . '); background-size: cover; background-color: #fff;">'.html_entity_decode($s_array['cta_sevice_text']);


	    $return_string .=

	'</div>';
}
elseif (get_field('page_slug')=='Careers-ar') {
	$return_string = 
	'<div class="pxp-cover" style="background-image: url(' . esc_url($bg_image_src) . '); background-size: cover; background-color: #fff;">'.html_entity_decode($s_array['cta_sevice_text']);


	    $return_string .=

	'</div>';
}
	else{
		$return_string = 
	'<div class="pxp-testim-1 pt-100 pb-100 mt-50 pxp-cover " style="background-image: url(' . esc_url($bg_image_src) . '); background-size: cover;">'.html_entity_decode($s_array['cta_sevice_text']);


	ob_start();
	?>
 
               
             
<?php if(get_field('page_slug')=='Partnership' or get_field('page_slug')=='Partnership ar'){?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/logo_animation.css">
<script src='https://wordpress-823234-2829680.cloudwaysapps.com/wp-includes/js/jquery/jquery.min.js?ver=3.6.0' id='jquery-core-js'></script>

<script src='<?php echo get_template_directory_uri()?>/js/popper.min.js?ver=1.0' id='popper-js'></script>
<script src='<?php echo get_template_directory_uri()?>/js/bootstrap.min.js?ver=4.3.1' id='bootstrap-js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/animation.gsap.js" ></script>

<script>
  var sm_controller = new ScrollMagic.Controller();
  var logo1 = document.querySelector(".atr_logo_cnt"),
      logo2 = document.querySelector(".khov_logo_cnt"),
      logo3 = document.querySelector(".ahcc_logo_cnt"),
      line1 = document.querySelector(".cmp_line_bottom"),
      line2 = document.querySelector(".cmp_line_bottom2"),
      line3 = document.querySelector(".cmp_line_bottom3"),
      line4 = document.querySelector(".cmp_line_bottom4");
   var t1 = gsap.timeline();

      t1.from(logo2,.8,{autoAlpha:0})
         .from(line1,.5,{height:0,autoAlpha:0,ease:Power1.easeOut},"-=0.2")
         .from(line4,.5,{scale:0,autoAlpha:0,ease:Power1.easeOut,transformOrgin:0},"-=0.2")
         .from(line2,.8,{height:0,autoAlpha:0,ease:Power1.easeOut},"-=0.2")
         .from(logo1,.8,{autoAlpha:0,ease:Power1.easeOut},"-=0.2")
         .from(line3,.7,{height:0,autoAlpha:0,ease:Power1.easeOut},"-=0.6")
        
        
         .from(logo3,.8,{autoAlpha:0,ease:Power1.easeOut},"-=0.5");

         var myScene = new ScrollMagic.Scene({
 
          offset: 0,
          triggerHook:"onEnter",
          triggerElement: ".khov_logo_cnt",
          })
          .setTween(t1)
          .addTo(sm_controller);
</script>
<?php } ?>










	<?php
	 $return_string .= ob_get_clean();



	    $return_string .=

	'</div>';
	}

	 


?>