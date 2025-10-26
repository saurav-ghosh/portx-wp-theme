<!doctype html>
<html class="no-js" lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <?php wp_head(); ?>
</head>

<!-- back to top start -->
   <div class="back-to-top-wrapper">
      <button id="back_to_top" type="button" class="back-to-top-btn">
         <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
               stroke-linejoin="round" />
         </svg>
      </button>
   </div>
   <!-- back to top end -->
   <!-- preloader to start -->
   <div id="loading">
      <div id="loading-center">
         <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
         </div>
      </div>
   </div>
   <!-- preloader to end -->
   <!--  tp-offcanvus-area-start  -->
   <div class="tpoffcanvas-area">
      <div class="tpoffcanvas">
         <div class="tpoffcanvas__close-btn">
            <button class="close-btn"><i class="fal fa-times"></i></button>
         </div>
         <div class="tpoffcanvas__logo">
            <?php portx_header_logo_black(); ?>
         </div>
         <div class="tp-main-menu-mobile"></div>
         <div class="offcanvas__btn mb-20">
            <a href="<?php echo esc_url(get_theme_mod('mobile_cta_button_url', '#')); ?>" class="tp-btn w-100"><?php echo esc_html(get_theme_mod('mobile_cta_button_text', 'Getting Started')); ?></a>
         </div>
         <div class="offcanvas__contact mb-40">
            <?php 
            $phone = get_theme_mod('top_header_phone', __('(+1) 122 456 789', 'portx'));
            $email = get_theme_mod('top_header_email', __('portxinfo@gmail.com', 'portx'));
            ?>
               <p class="offcanvas__contact-call"><a href="tel:<?php echo esc_html($phone); ?>"><?php echo esc_html($phone); ?></a></p>
               <p class="offcanvas__contact-mail"><a href="mailto:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a></p>
            </div>
         <div class="offcanvas__social">
            <?php portx_mobile_menu_socials(); ?>
         </div>
      </div>
   </div>
   <div class="body-overlay"></div>
   <!--  tp-offcanvus-area end -->
   <!-- search popup start -->
   <div class="search__popup z-index-8">
      <div class="container">
         <div class="row">
            <div class="col-xxl-12">
               <div class="search__wrapper">
                  <div class="search__top d-flex justify-content-between align-items-center">
                     <div class="search__logo">
                        <a href="index.html">
                           <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/footer-logo.png" alt="logo">
                        </a>
                     </div>
                     <div class="search__close">
                        <button type="button" class="search__close-btn search-close-btn">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" />
                              <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" />
                           </svg>
                        </button>
                     </div>
                  </div>
                  <div class="search__form">
                     <form action="#">
                        <div class="search__input">
                           <input class="search-input-field" type="text" placeholder="Type here to search...">
                           <span class="search-focus-border"></span>
                           <button type="submit">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="search-popup-overlay"></div>
   <!-- search popup end -->
   <?php get_template_part('template-parts/header'); ?>

   <!-- breadcrumb area start -->
   <?php portx_breadcrumb(); ?>