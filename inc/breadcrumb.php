<?php
function portx_breadcrumb(){
  // Figure out the dynamic breadcrumb title
  if ( is_front_page() && is_home() ) {
    $title = __('Blog','portx');
  }
  elseif ( is_front_page() ) {
    $title = __('Blog','portx');
  }
  elseif ( is_home() ) {
    if ( get_option( 'page_for_posts' ) ) {
      $title = get_the_title( get_option( 'page_for_posts') );
    }
  }
  elseif ( is_single() && 'post' == get_post_type() ) {
    $title = get_the_title();
  } 
  elseif ( is_single() && 'service' == get_post_type() ) {
    $title = get_the_title();
  } 
  elseif ( is_single() && 'product' == get_post_type() ) {
    $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'portx' ) );
  } 
  elseif ( is_search() ) {
    $title = esc_html__( 'Search Results for : ', 'portx' ) . get_search_query();
  } 
  elseif ( is_404() ) {
    $title = esc_html__( '404 Page not Found', 'portx' );
  } 
  elseif ( is_archive() ) {
    $title = get_the_archive_title();
  } 
  else {
    $title = get_the_title();
  } 

  // Default background
  $bg = get_template_directory_uri() . '/assets/img/breadcrumb/breadcrumb-bg-1.jpg';

  // If using ACF field for custom breadcrumb image
  if (function_exists('get_field')) {
    $page_id = null;
    if (is_home() && get_option('page_for_posts')) {
      $page_id = get_option('page_for_posts');
    } elseif (is_singular()) {
      $page_id = get_the_ID();
    }

    if ($page_id) {
      $breadcrumb_img_custom = get_field('breadcrumb_image', $page_id);
      if ($breadcrumb_img_custom) {
        $bg = $breadcrumb_img_custom['url'];
      }
    }

    $show_hide = get_field('breadcrumb_showhide');
    if ($show_hide === false) {
      return;
    }
  }
  ?>
  
  <div class="wrapper-box p-relative">
    <div class="breadcrumb__bg breadcrumb__bg__overlay pt-130 pb-130"
         data-background="<?php echo esc_url($bg); ?>">
      <div class="container">
        <div class="row">
          <div class="col-xxl-12">
            <div class="breadcrumb__content p-relative z-index-1">
              <div class="breadcrumb__list mb-10">
                <!-- Dynamic Title -->
                <h3 class="breadcrumb__title mb-15"><?php echo portx_kses($title); ?></h3>

                <!-- Breadcrumb Trail -->
                <div class="breadcrumb__item">
                  <span><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'portx'); ?></a></span>
                  <span class="dvdr"> / </span>
                  <span class="sub-page-black">
                    <?php 
                      // If Breadcrumb NavXT is installed
                      if (function_exists('bcn_display')) {
                        bcn_display();
                      } else {
                        echo portx_kses($title);
                      }
                    ?>
                  </span>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
}
