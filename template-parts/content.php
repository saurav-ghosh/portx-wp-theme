<?php if(is_single()): ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-image mb-50 transition-3'); ?>>

    <!-- Featured Image -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="postbox__thumb m-img p-relative">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full', ['class' => 'w-100']); ?>
                <div class="postbox__meta-date">
                    <span>
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_the_date('d M'); ?>
                        </a>
                    </span>
                </div>
            </a>
        </div>
    <?php endif; ?>

    <div class="postbox__content">
        
        <!-- Meta Info -->
        <div class="postbox__meta d-flex justify-content-between">
            <div class="postbox__info">
                <span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <i class="fa-light fa-user"></i>  <?php 
                    $author_id = get_post_field( 'post_author', get_the_ID() );

                    $author_name = get_the_author_meta('display_name', $author_id);
                    echo esc_html($author_name);
                    ?>
                </a></span>
                
                <!-- Example Category -->
                <span>
                    <i class="fa-regular fa-location-dot"></i> 
                    <?php the_category(', '); ?>
                </span>

                <span><a href="<?php comments_link(); ?>">
                    <i class="fal fa-comments"></i> <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                </a></span>
            </div>
        </div>

        <!-- Title -->
        <h3 class="postbox__title"><?php the_title(); ?></h3>

        <!-- Content -->
        <div class="postbox__text">
            <?php the_content(); ?>
        </div>

        <!-- Tags + Share -->
        <div class="postbox__details-share-wrapper">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                    <div class="postbox__details-tag tagcloud">
                        <span>Tag:</span>
                        <?php the_tags('', '', ''); ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                    <div class="postbox__details-share text-end">
                        <span>Share:</span>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>


<?php else : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-image mb-50 transition-3'); ?>>
    <div class="postbox__thumb m-img">
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
            <?php else : ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/blog-detials/blog-img.jpg'); ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </a>
    </div>

    <div class="postbox__content">
        <div class="postbox__meta">
            <span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <i class="fa-light fa-user"></i> <?php esc_html_e('By', 'portx'); ?> <?php the_author(); ?>
            </a></span>

            <?php 
            // Example category display (only first category)
            $category = get_the_category();
            if ( ! empty( $category ) ) : ?>
                <span><i class="fa-regular fa-location-dot"></i> 
                    <a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>">
                        <?php echo esc_html( $category[0]->name ); ?>
                    </a>
                </span>
            <?php endif; ?>

            <span>
                <a href="<?php comments_link(); ?>">
                    <i class="fal fa-comments"></i> 
                    <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
                </a>
            </span>
        </div>

        <h3 class="postbox__title">
            <a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="postbox__text">
            <p><?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?></p>
        </div>

        <div class="tp-slide-btn-box">
            <a class="thm-btn" href="<?php echo esc_url(get_permalink()); ?>">
                <?php esc_html_e('READ MORE', 'portx'); ?>
            </a>
        </div>
    </div>
</article>

<?php endif; ?>