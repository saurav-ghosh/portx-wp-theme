<?php 
$author_id = get_post_field( 'post_author', get_the_ID() );

$author_name = get_the_author_meta( 'display_name', $author_id );
$author_description = get_the_author_meta( 'description', $author_id );
$author_avatar = get_avatar_url( $author_id, array( 'size' => 100 ) );

// Optional role
$author_roles = get_userdata($author_id)->roles;
$role_label = ucfirst(str_replace('_', ' ', $author_roles[0]));

// Social links (from user meta)
$facebook = get_the_author_meta('facebook', $author_id);
$twitter  = get_the_author_meta('twitter', $author_id);
$linkedin = get_the_author_meta('linkedin', $author_id);
$vimeo    = get_the_author_meta('vimeo', $author_id);
?>

<div class="postbox-details-author d-sm-flex align-items-start">
   <div class="postbox-details-author-thumb">
      <a href="<?php echo get_author_posts_url($author_id); ?>">
         <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">
      </a>
   </div>
   <div class="postbox-details-author-content">
      <h5 class="postbox-details-author-title">
         <a href="<?php echo get_author_posts_url($author_id); ?>">
            <?php echo esc_html($author_name); ?>
         </a>
      </h5>
      <span class="author-role"><?php echo esc_html($role_label); ?></span>
      <p><?php echo esc_html($author_description); ?></p>

      <div class="postbox-details-author-social">
         <?php if($facebook): ?>
            <a href="<?php echo esc_url($facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a>
         <?php endif; ?>
         <?php if($twitter): ?>
            <a href="<?php echo esc_url($twitter); ?>"><i class="fa-brands fa-twitter"></i></a>
         <?php endif; ?>
         <?php if($linkedin): ?>
            <a href="<?php echo esc_url($linkedin); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
         <?php endif; ?>
         <?php if($vimeo): ?>
            <a href="<?php echo esc_url($vimeo); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
         <?php endif; ?>
      </div>
   </div>
</div>
