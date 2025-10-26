<?php

function portx_header_logo_white(){
    $logo = get_theme_mod('header_logo_white', get_template_directory_uri() . '/assets/img/logo/footer-logo.png');
    ?>
    
    <?php if(!empty($logo) ) : ?>
    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($logo); ?>" class="img-fluid" alt="<?php bloginfo('name'); ?>"></a>
    <?php endif; ?>

    <?php
}

function portx_header_logo_black(){
    $logo = get_theme_mod('header_logo_black', get_template_directory_uri() . '/assets/img/logo/black-logo.png');
    ?>
    
    <?php if(!empty($logo) ) : ?>
    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($logo); ?>" class="img-fluid" alt="<?php bloginfo('name'); ?>"></a>
    <?php endif; ?>

    <?php
}

// Nav walker for Bootstrap 5
function portx_nav_walker() {
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => false,
        'menu_class' => '',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth' => 2,
        'walker' => new bootstrap_5_wp_nav_menu_walker()
    ));
}

// Mobile menu social template
function portx_mobile_menu_socials(){

  $facebook = get_theme_mod('company_social_facebook', __('#', 'portx'));
  $twitter = get_theme_mod('company_social_twitter', __('#', 'portx'));
  $instagram = get_theme_mod('company_social_instagram', __('#', 'portx'));
  $linkedin = get_theme_mod('company_social_linkedin', __('#', 'portx'));
  ?>

  <?php if(!empty($facebook) ) : ?>
  <a href="<?php echo esc_url( $facebook ); ?>"><i class="fab fa-facebook-f"></i></a>
  <?php endif; ?>

  <?php if(!empty($twitter) ) : ?>
  <a href="<?php echo esc_url( $twitter ); ?>"><i class="fab fa-twitter"></i></a>
  <?php endif; ?>

  <?php if(!empty($instagram) ) : ?>
  <a href="<?php echo esc_url( $instagram ); ?>"><i class="fab fa-instagram"></i></a>
  <?php endif; ?>

  <?php if(!empty($linkedin) ) : ?>
  <a href="<?php echo esc_url( $linkedin ); ?>"><i class="fab fa-linkedin"></i></a>
  <?php endif; ?>

  <?php
}

// Company Social template
function portx_company_socials(){

  $facebook = get_theme_mod('company_social_facebook', __('#', 'portx'));
  $twitter = get_theme_mod('company_social_twitter', __('#', 'portx'));
  $youtube = get_theme_mod('company_social_youtube', __('#', 'portx'));  
  $linkedin = get_theme_mod('company_social_linkedin', __('#', 'portx'));
  ?>

  <?php if(!empty($facebook) ) : ?>
  <li><a href="<?php echo esc_url( $facebook ); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
  <?php endif; ?>

  <?php if(!empty($twitter) ) : ?>
  <li><a href="<?php echo esc_url( $twitter ); ?>"><i class="fa-brands fa-twitter"></i></a></li>
  <?php endif; ?>

  <?php if(!empty($youtube) ) : ?>
  <li><a href="<?php echo esc_url( $youtube ); ?>"><i class="fa-brands fa-youtube"></i></a></li>
  <?php endif; ?>

  <?php if(!empty($linkedin) ) : ?>
  <li><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa-brands fa-linkedin"></i></a></li>
  <?php endif; ?>

  <?php
}

// Post tags
function portx_post_tags() {
    $tags = get_the_tags();
    if($tags) {
        $tags = array_slice($tags, 0, 2);
        foreach($tags as $tag) {
            echo '<a href="'. esc_url( get_tag_link( $tag->term_id ) ) .'">'. esc_html( $tag->name ) .'</a>';
        }
    }
}

function portx_author_social_links( $author_id = null ) {
    if ( ! $author_id ) {
        $author_id = get_post_field('post_author', get_the_ID());
    }

    $facebook  = get_the_author_meta('facebook', $author_id);
    $twitter   = get_the_author_meta('twitter', $author_id);
    $linkedin  = get_the_author_meta('linkedin', $author_id);
    $pinterest = get_the_author_meta('pinterest', $author_id);

    if ( $facebook || $twitter || $linkedin || $pinterest ) {
        ?>
            <ul>
            <?php if ( $facebook ) : ?>
                <li><a href="<?php echo esc_url( $facebook ); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
            <?php endif; ?>
            <?php if ( $twitter ) : ?>
                <li><a href="<?php echo esc_url( $twitter ); ?>"><i class="fa-brands fa-twitter"></i></a></li>
            <?php endif; ?>
            <?php if ( $linkedin ) : ?>
                <li><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
            <?php endif; ?>
            <?php if ( $pinterest ) : ?>
                <li><a href="<?php echo esc_url( $pinterest ); ?>"><i class="fa-brands fa-pinterest-p"></i></a></li>
            <?php endif; ?>
            </ul>
        <?php
    }
}

// Posts pagination
function portx_posts_pagination() {
  $pages = paginate_links( array( 
      'type' => 'array',
      'prev_text'    => __('<i class="far fa-angle-left"></i>','portx'),
      'next_text'    => __('<i class="far fa-angle-right"></i>','portx'),
  ) );
      if( $pages ) {
      echo '<ul>';
      foreach ( $pages as $page ) {
          echo "<li>$page</li>";
      }
      echo '</ul>';
  }
}

// Filters and sanitizes HTML content
function portx_kses( $custom_html_tags = '' ) {
	$allowed_html = [
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'path'  => array( 
            'd' => true, 
            'fill' => true,  
            'stroke' => true,  
            'stroke-width' => true,  
            'stroke-linecap' => true,  
            'stroke-linejoin' => true,  
            'opacity' => true,  
        ),
		'a' => [
			'class'    => [],
			'href'    => [],
			'title'    => [],
			'target'    => [],
			'rel'    => [],
		],
         'b' => [],
         'blockquote'  =>  [
            'cite' => [],
         ],
         'cite'                      => [
            'title' => [],
         ],
         'code'                      => [],
         'del'                    => [
            'datetime'   => [],
            'title'      => [],
        ],
         'dd'                     => [],
         'div'                    => [
            'class'   => [],
            'title'   => [],
            'style'   => [],
         ],
         'dl'                     => [],
         'dt'                     => [],
         'em'                     => [],
         'h1'                     => [],
         'h2'                     => [],
         'h3'                     => [],
         'h4'                     => [],
         'h5'                     => [],
         'h6'                     => [],
         'i'                         => [
            'class' => [],
         ],
         'img'                    => [
            'alt'  => [],
            'class'   => [],
            'height' => [],
            'src'  => [],
            'width'   => [],
         ],
         'li'                     => array(
            'class' => array(),
         ),
         'ol'                     => array(
            'class' => array(),
         ),
         'p'                         => array(
            'class' => array(),
         ),
         'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
         ),
         'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
         ),
         'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
         ),
         'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
         ),
         'strike'                 => array(),
         'br'                     => array(),
         'strong'                 => array(),
	];

	return wp_kses( $custom_html_tags, $allowed_html );
}