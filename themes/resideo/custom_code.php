<?php
add_action('wp_ajax_agent_email_shoot', 'agent_email_shoot_fn');
add_action('wp_ajax_nopriv_agent_email_shoot', 'agent_email_shoot_fn');
function agent_email_shoot_fn() {
	


	$data = array();
	if (isset($_POST['user_email']) && !empty($_POST['user_email']) and !empty($_POST['property_id'])) {
		
		$user_email  = $_POST['user_email'];
		$prop_id     = $_POST['property_id'];


		$to = $user_email ;
		$subject = 'Document of projects';
		
		$headers = array('Content-Type: text/html; charset=UTF-8');


		$message = " Document of the project ".get_the_title($prop_id);


		if(get_field('info_pack',$prop_id)){

			$attachments[] = str_replace(site_url()."/wp-content/uploads/",WP_CONTENT_DIR, get_field('info_pack',$prop_id)) ;
		}
		if(get_field('info_plans',$prop_id)){

			$attachments[] = str_replace(site_url()."/wp-content/uploads/",WP_CONTENT_DIR, get_field('info_plans',$prop_id)) ;
		}
		if(get_field('payment_plan',$prop_id)){

			$attachments[] = str_replace(site_url()."/wp-content/uploads/",WP_CONTENT_DIR, get_field('payment_plan',$prop_id)) ;
		}


		
		
		$headers = 'From: Property <'.$to .'>' . "\r\n";

		wp_mail( $to, $subject , $message , $headers, $attachments );

		
		$data['data']= "Successfully requested.";

	} else {
		$data['data']= "Data Not Correct!";
	}
	
	
	echo json_encode($data);
	die();
}


function get_dropdown($project_name='Select project 1',$floor_index='0',$selected_img_src='', $community = '')
{
    $language =	get_locale();

	icl_register_string("resideo",$project_name,$project_name);
	echo "<option value='' data_text=''>".pll__($project_name)."</option>";
	$args = array(
	    'post_type'      => 'property',
	    'posts_per_page' => -1,
		
	);
	$args['tax_query'] = array('relation' => 'AND');
	array_push($args['tax_query'], array(
		'taxonomy' => 'Community',
		'field'    => 'term_id',
		'terms'    => $community,

	));


	$loop = new WP_Query($args);
	while ( $loop->have_posts() ) {
	    $loop->the_post();
	   
	    
	    $prop_id = get_the_ID(); 
	    
	    $floor_plans = get_post_meta($prop_id, 'property_floor_plans', true);
	  
		if ($floor_plans != '') {
			$floor_plans_data = json_decode(urldecode($floor_plans));

			if (isset($floor_plans_data)) {
				$floor_plans_list = $floor_plans_data->plans;
				
				if(isset($floor_plans_list[$floor_index]) and $floor_plans_list[$floor_index]!="")
				{
					$floor_plan22 = 	 $floor_plans_list[$floor_index];
					$floor_plan_image = wp_get_attachment_image_src($floor_plan22->image, 'full');
					$sel='';
					if($selected_img_src==$floor_plan_image[0] and $project_name=="Select project 1")
					{
						$sel='selected';
					}
					echo "<option ".$sel." value='".$floor_plan_image[0]."' data_text='".get_the_title($prop_id)."'>".get_the_title($prop_id)."</option>";
				}
				
			}
		}  
	}
}
add_action('wp_ajax_get_floor_images', 'get_floor_images_fn');
add_action('wp_ajax_nopriv_get_floor_images', 'get_floor_images_fn');
function get_floor_images_fn() {


	$select_f 			= $_POST['select_f'];
	$selected_img_src 	= $_POST['selected_img_src'];
	$current_commumity  = $_POST['current_comm'];

	//echo "LANGster".get_locale();

	get_dropdown('Select project 1', $select_f , $selected_img_src,$current_commumity );
	
	echo "|^***^|";
	get_dropdown('Select project 2', $select_f , $selected_img_src,$current_commumity  );
	
	die();
}

?>