<?php 
$footer_copyright_text = get_theme_mod('footer_copyright_text',__('© Copyright 2023, Insurez. All Rights Reserved', 'insurez'));
?>

<footer>
   <div class="footer-area theme-background pt-120 pb-80 p-relative fix">
      <div class="tp-footer__right-bg wow slideInLeft   ">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/footer/footer-left-trns.png" alt="">
      </div>
      <div class="tp-footer__car">
         <img class=" tp-footer__shape-1 movingX" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/footer/footer-car.png" alt="">
      </div>
      <div class="container">
         <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
               <?php if(is_active_sidebar('footer-widget-1')) : ?>
                  <?php dynamic_sidebar('footer-widget-1'); ?>
               <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
               <?php if(is_active_sidebar('footer-widget-2')) : ?>
                  <?php dynamic_sidebar('footer-widget-2'); ?>
               <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
               <?php if(is_active_sidebar('footer-widget-3')) : ?>
                  <?php dynamic_sidebar('footer-widget-3'); ?>
               <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
               <?php if(is_active_sidebar('footer-widget-4')) : ?>
                  <?php dynamic_sidebar('footer-widget-4'); ?>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
   <div class="tp-footer__bottom  pt-25 pb-25">
      <div class="container">
         <div class="row">
            <div class="col-xxl-6 col-lg-6 col-md-7  col-12">
               <div class="tp-footer__copyright text-md-start text-center">
                  <p><?php echo portx_kses($footer_copyright_text); ?></p>
               </div>
            </div>
            <div class="col-xxl-6 col-lg-6 col-md-5  col-12">
               <?php if(has_nav_menu('policy-menu')) : ?>
               <div class="tp-footer__menu text-md-end text-center">
                  <?php wp_nav_menu(array(
                     'theme_location' => 'policy-menu',
                     'container'      => false,
                     'items_wrap'    => '<ul>%3$s</ul>',
                  )); ?>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</footer>

   <?php wp_footer(); ?>
</body>

</html>