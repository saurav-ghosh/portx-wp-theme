<?php
get_header();
?>

<section class="tp-error__area pt-120 pb-120">
      <div class="container">
         <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
               <div class="tp-error__wrapper d-flex align-items-end justify-content-center">
                  <div class="tp-error__content text-center">
                     <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/404/error.jpg' ); ?>" alt="">
                     <h4>Page Not Found</h4>
                     <p>The page requested couldn't be found. This could be a spelling error in the URL or a removed
                        page</p>
                     <a class="thm-btn " href="<?php echo esc_url( home_url( '/' ) ); ?>">BACK TO HOME</a>
                  </div>
               </div>
            </div>
         </div>
   </section>

<?php
get_footer();