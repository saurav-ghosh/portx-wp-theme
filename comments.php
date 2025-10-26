<?php
if ( post_password_required() || ( ! have_comments() && ! comments_open() ) ) {
    return;
}

// Custom comment callback function
if ( ! function_exists( 'custom_comment_callback' ) ) {
    function custom_comment_callback( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <div class="postbox__comment-box d-flex p-relative">
                <div class="postbox__comment-avater mr-40">
                    <?php echo get_avatar( $comment, 80 ); ?>
                </div>
                <div class="postbox__comment-text">
                    <div class="postbox__comment-name">
                        <h5><?php comment_author(); ?></h5>
                        <span class="post-meta">
                            <?php comment_date( 'F j, Y' ); ?> at <?php comment_time(); ?>
                        </span>
                    </div>
                    
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation">
                            <?php esc_html_e( 'Your comment is awaiting moderation.', 'insurez' ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="comment-content">
                        <?php comment_text(); ?>
                    </div>
                    
                    <?php if ( comments_open() ) : ?>
                        <div class="postbox__comment-reply">
                            <?php 
                            comment_reply_link( array_merge( $args, array(
                                'add_below' => 'comment',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'reply_text' => esc_html__( 'Reply', 'insurez' )
                            ))); 
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </li>
        <?php
    }
}
?>

<div class="postbox__wrapper pr-20">

    <?php if ( have_comments() ) : ?>
        <h3 class="postbox__comment-title">
            <?php 
            $comment_count = get_comments_number();
            printf(
                /* translators: 1: number of comments, 2: post title */
                _n(
                    '%1$s Comment on %2$s',
                    '%1$s Comments on %2$s',
                    $comment_count,
                    'insurez'
                ),
                number_format_i18n( $comment_count ),
                get_the_title()
            );
            ?>
        </h3>
        
        <div class="postbox__comment mb-65">
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav class="comment-navigation" role="navigation">
                    <div class="comment-nav-prev"><?php previous_comments_link( esc_html__( 'Older Comments', 'insurez' ) ); ?></div>
                    <div class="comment-nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'insurez' ) ); ?></div>
                </nav>
            <?php endif; ?>
            
            <ul class="comment-list">
                <?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 80,
                    'callback'    => 'custom_comment_callback',
                    'max_depth'   => 3,
                ) );
                ?>
            </ul>
            
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav class="comment-navigation" role="navigation">
                    <div class="comment-nav-prev"><?php previous_comments_link( esc_html__( 'Older Comments', 'insurez' ) ); ?></div>
                    <div class="comment-nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'insurez' ) ); ?></div>
                </nav>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ( comments_open() ) : ?>
        <div class="postbox__comment-form">
            <h3 class="postbox__comment-form-title">
                <?php esc_html_e( 'Leave your comment', 'insurez' ); ?>
            </h3>
            
            <?php
            $commenter = wp_get_current_commenter();
            $req = get_option( 'require_name_email' );
            $aria_req = ( $req ? ' aria-required="true"' : '' );
            $html_req = ( $req ? ' required="required"' : '' );
            
            $comment_form_args = array(
                'class_form'         => 'comment-form row',
                'class_submit'       => 'tp-btn',
                'title_reply'        => '',
                'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'insurez' ),
                'cancel_reply_link'  => esc_html__( 'Cancel reply', 'insurez' ),
                'label_submit'       => esc_html__( 'Post Comment', 'insurez' ),
                'submit_button'      => '<button type="submit" class="tp-btn">%4$s</button>',
                'comment_notes_before' => '',
                'comment_notes_after'  => '',
                'format'             => 'html5',
                'fields'             => array(
                    'author' => '<div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="postbox__comment-input">
                            <input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Your Name', 'insurez' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . $html_req . ' />
                        </div>
                    </div>',
                    'email' => '<div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="postbox__comment-input">
                            <input id="email" name="email" type="email" placeholder="' . esc_attr__( 'Email address', 'insurez' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . $html_req . ' />
                        </div>
                    </div>',
                    'url' => '<div class="col-xxl-12">
                        <div class="postbox__comment-input">
                            <input id="url" name="url" type="url" placeholder="' . esc_attr__( 'Website (optional)', 'insurez' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />
                        </div>
                    </div>',
                ),
                'comment_field' => '<div class="col-xxl-12">
                    <div class="postbox__comment-input">
                        <textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Write your comment', 'insurez' ) . '" required="required"></textarea>
                    </div>
                </div>',
                'submit_field' => '<div class="col-xxl-12">
                    <div class="postbox__comment-btn">%1$s %2$s</div>
                </div>',
            );
            
            comment_form( $comment_form_args );
            ?>
        </div>
    <?php elseif ( ! comments_open() && have_comments() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'insurez' ); ?></p>
    <?php endif; ?>

</div>