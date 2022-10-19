<?php 

function resideo_new_register_settings() {
   add_option( 'resideo_new_disclimer', 'This is my option value.');
   add_option( 'resideo_new_disclimer_ar', 'This is my option value.');
   register_setting( 'resideo_new_options_group', 'resideo_new_disclimer', 'resideo_new_callback' );
   register_setting( 'resideo_new_options_group', 'resideo_new_disclimer_ar', 'resideo_new_callback' );
}
add_action( 'admin_init', 'resideo_new_register_settings' );


function resideo_new_register_options_page() {
  add_options_page('Resideo Custom Setting', 'Resideo Custom Setting', 'manage_options', 'resideo_new', 'resideo_new_options_page');
}
add_action('admin_menu', 'resideo_new_register_options_page');

 function resideo_new_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>Resideo Custom Setting</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'resideo_new_options_group' ); ?>

 
  <table>
  <tr valign="top">
  <th scope="row"><label for="resideo_new_disclimer">Disclimer EN</label></th>
  <td>
  	<textarea  id="resideo_new_disclimer" name="resideo_new_disclimer" style="width:400px" ><?php echo get_option('resideo_new_disclimer'); ?></textarea> </td>
  </tr>

  <tr valign="top">
  <th scope="row"><label for="resideo_new_disclimer_ar">Disclimer Ar</label></th>
  <td>
  	<textarea  id="resideo_new_disclimer_ar" name="resideo_new_disclimer_ar" style="width:400px" ><?php echo get_option('resideo_new_disclimer_ar'); ?></textarea> </td>
  </tr>


  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
}
?>