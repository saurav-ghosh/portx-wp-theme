<?php
$time_title = get_theme_mod('top_header_time_title', __('Sunday Closed', 'portx'));
$time = get_theme_mod('top_header_time', __('Mon - Sat 9.00 - 18.00', 'portx'));

$email_title = get_theme_mod('top_header_email_title', __('Email', 'portx'));
$email = get_theme_mod('top_header_email', __('portxinfo@gmail.com', 'portx'));

$phone_title = get_theme_mod('top_header_phone_title', __('Call Us', 'portx'));
$phone = get_theme_mod('top_header_phone', __('(+1) 122 456 789', 'portx'));

$cta_button_text = get_theme_mod('header_cta_button_text', __('Request a Quote', 'portx'));
$cta_button_url = get_theme_mod('header_cta_button_url', '#');

?>

<header>
  <div class="main-header d-none d-xl-block">
      <div class="tp-header__top tp-header__he pt-20 pb-20 p-relative">
        <div class="tp-header-wrap">
            <div class="container">
              <div class="row align-items-center">
                  <div class="col-xl-4">
                    <div class="main-logo ">
                        <?php portx_header_logo_black(); ?>
                    </div>
                  </div>
                  <div class="col-xl-8">
                    <div class="tp-header">
                        <div class="tp-header__right  d-flex justify-content-end">
                          <div class="tp-header__contact mr-30">
                              <div class="tp-header__contact d-flex align-items-center">
                                <span class="tp-header__icon"><i class="flaticon-clock"></i></span>
                                <div class="tp-header__icon-info ml-20">
                                    <label><?php echo esc_html($time_title); ?></label>
                                    <span><?php echo esc_html($time); ?></span>
                                </div>
                              </div>
                          </div>
                          <div class="tp-header__contact mr-30">
                              <div class="tp-header__contact d-flex align-items-center">
                                <span class="tp-header__icon"><i class="flaticon-envelope"></i></span>
                                <div class="tp-header__icon-info ml-20">
                                    <label><?php echo esc_html($email_title); ?></label>
                                    <span><a href="maito:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a></span>
                                </div>
                              </div>
                          </div>
                          <div class="tp-header__contact">
                              <div class="tp-header__contact d-flex align-items-center">
                                <span class="tp-header__icon"><i class="flaticon-telephone"></i></span>
                                <div class="tp-header__icon-info ml-20">
                                    <label><?php echo esc_html($phone_title); ?></label>
                                    <span><a href="tel:<?php echo esc_html($phone); ?>"><?php echo esc_html($phone); ?></a></span>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
      <div class="tp-header">
        <div id="header-sticky" class="header-bottom black-bg d-flex align-items-center">
            <div class="container">
              <div class="row align-items-center">
                  <div class="col-xl-8">
                    <div class="tp-header__main-menu main-menu">
                        <nav class="tp-main-menu-content">
                          <?php portx_nav_walker(); ?>
                        </nav>
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="tp-header__right text-end d-flex align-items-center justify-content-end">
                        <div class="search-img f-left mr-30">
                          <button class="search-open-btn">
                              <i class="flaticon-loupe"></i>
                          </button>
                        </div>
                        <div class="tp-header__btn">
                          <a class="tp-btn" href="<?php echo esc_url($cta_button_url); ?>"><?php echo esc_html($cta_button_text); ?></a>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <div class="mobile-header d-xl-none pt-20 pb-20">
      <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
              <div class="main-logo ">
                  <?php portx_header_logo_black(); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="mobile__menu d-flex align-items-center justify-content-end">
                  <button class="search-open-btn mr-30 d-none d-sm-block">
                    <i class="flaticon-loupe"></i>
                  </button>
                  <a class="tp-menu-bar" href="javascript:void(0)"><i class="fa-solid fa-bars"></i></a>
              </div>
            </div>
        </div>
      </div>
  </div>
</header>

