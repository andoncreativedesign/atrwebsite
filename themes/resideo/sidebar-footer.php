<?php
/**
 * @package WordPress
 * @subpackage Resideo
 */

if (!is_active_sidebar('pxp-first-footer-widget-area') && 
    !is_active_sidebar('pxp-second-footer-widget-area') && 
    !is_active_sidebar('pxp-third-footer-widget-area') && 
    !is_active_sidebar('pxp-fourth-footer-widget-area')) {
        return;
} ?>

<div class="row">

    <?php  
    if(get_locale() == 'ar'){ ?>


        <?php if (is_active_sidebar('pxp-first-footer-widget-area-ar')) : ?>
        <div class="col-sm-12 col-lg-4">
            <?php dynamic_sidebar('pxp-first-footer-widget-area-ar'); ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-12 col-lg-8">
            <div class="row">
                <?php if (is_active_sidebar('pxp-second-footer-widget-area-ar')) : ?>
                    <div class="col-sm-12 col-md-4">
                        <?php dynamic_sidebar('pxp-second-footer-widget-area-ar'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('pxp-third-footer-widget-area-ar')) : ?>
                    <div class="col-sm-12 col-md-4">
                        <?php dynamic_sidebar('pxp-third-footer-widget-area-ar'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('pxp-fourth-footer-widget-area-ar')) : ?>
                    <div class="col-sm-12 col-md-4">
                        <?php dynamic_sidebar('pxp-fourth-footer-widget-area-ar'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>








        <?php



    }else{ ?>





        <?php if (is_active_sidebar('pxp-first-footer-widget-area')) : ?>
        <div class="col-sm-12 col-lg-4">
            <?php dynamic_sidebar('pxp-first-footer-widget-area'); ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-12 col-lg-8">
            <div class="row">
                <?php if (is_active_sidebar('pxp-second-footer-widget-area')) : ?>
                    <div class="col-sm-12 col-md-4">
                        <?php dynamic_sidebar('pxp-second-footer-widget-area'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('pxp-third-footer-widget-area')) : ?>
                    <div class="col-sm-12 col-md-4">
                        <?php dynamic_sidebar('pxp-third-footer-widget-area'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('pxp-fourth-footer-widget-area')) : ?>
                    <div class="col-sm-12 col-md-4">
                        <?php dynamic_sidebar('pxp-fourth-footer-widget-area'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>


    <?php } ?>

    
</div>