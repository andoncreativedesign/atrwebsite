<?php
function sc_careers_page_dynamic_fn()
{
  $join_us = get_field('join_us');
  if(get_locale() == 'ar'){
    $join_us = get_field('join_us_ar');
  }
  $nojobsnote = get_field('no_jobs_note');
  icl_register_string("resideo", $nojobsnote,$nojobsnote); 
  ob_start();
  ?>
  <div class="pxp-cover " style="background-image: url(); background-size: cover; background-color: #fff;">
    <div class="careers_page">
      <div class="pt-100 pb-100" style="<?php if (strtolower(get_field('page_slug'))=="careers") {echo 'background: linear-gradient(90deg, #fff 50%, #4D858D 50%)';}?> ; background-size: cover;">
        <div class="container" style="padding-top: 30px;">
          <div class="row">
            <div class="col-md-6">
              <div class="pxp-services-h-item-careers pxp-animate-in ml-0 mr-lg-5 mt-4 mt-md-5 mt-lg-0 service_img_min_height pxp-in">
                <?php 
                  echo $join_us;
                ?>
                
              </div>
            </div>
            <div class="col-md-6 joblisthalf">
              <div class="careers_joblist">
                <div class="accordion" id="accordionExample">
                <?php 
                if(have_rows('jobs') ): 
                  $i = 0;
                  while(have_rows('jobs') ): the_row(); 
                    $job_title = get_sub_field('job_title');
                    $job_des = get_sub_field('job_description');
                    icl_register_string("resideo", $job_title,$job_title); 
                    icl_register_string("resideo", $job_des,$job_des); 
                    
                     if($job_title != "" && $job_des != "") {
                    ?>
                    <div class="card">
                      <div class="card-header" id="heading_<?php echo $i; ?>">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i; ?>">
                          <span><?php echo pll__($job_title); ?></span>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse_<?php echo $i; ?>" class="collapse <?php echo ($i == 0 ? 'show' : ''); ?>" aria-labelledby="heading_<?php echo $i; ?>" data-parent="#accordionExample">
                        <div class="card-body">
                         <?php echo pll__($job_des); ?>
                        </div>
                      </div>
                    </div>
                    <?php
                     } else {
                         
                         echo '<span style="color:#fff;font-size:16px;">'.pll__($nojobsnote).'</span>';
                     }
                    $i++;
                  endwhile; 
                endif;
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  return  ob_get_clean();   
}

add_shortcode('careers_page_dynamic','sc_careers_page_dynamic_fn');