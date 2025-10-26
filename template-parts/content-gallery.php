<?php

$gallery_images = function_exists("get_field") ? get_field('select_gallery_image') : [];

?>

<?php if(is_single()): ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-image mb-50 transition-3'); ?>>

    <!-- Gallery Slider for Single Post -->
    <?php if (!empty($gallery_images) || has_post_thumbnail()) : ?>
        <div class="postbox__thumb w-img">
            <div class="postbox__thumb-slider p-relative">
                <div class="swiper-container postbox__thumb-slider-active">
                    <div class="swiper-wrapper">
                        <?php if (!empty($gallery_images)) : ?>
                            <?php foreach ($gallery_images as $image) : ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    <div class="postbox__meta-date">
                                        <span>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo get_the_date('d M'); ?>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif (has_post_thumbnail()) : ?>
                            <div class="swiper-slide">
                                <?php the_post_thumbnail('full'); ?>
                                <div class="postbox__meta-date">
                                    <span>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo get_the_date('d M'); ?>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Slider arrows - only show if more than one slide -->
                <?php if (count($gallery_images) > 1) : ?>
                <div class="postbox__slider-arrow-wrap">
                    <button class="postbox-arrow-prev">
                        <i class="fa-sharp fa-regular fa-arrow-left"></i>
                    </button>
                    <button class="postbox-arrow-next">
                        <i class="fa-sharp fa-regular fa-arrow-right"></i>
                    </button>
                </div>
                <?php endif; ?>
            </div>
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
                
                <!-- Category -->
                <?php 
                $categories = get_the_category(); 
                if ($categories) : ?>
                    <span>
                        <i class="fa-regular fa-location-dot"></i> 
                        <?php echo esc_html($categories[0]->name); ?>
                    </span>
                <?php endif; ?>

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

<article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-image mb-60 transition-3'); ?>>
    
    <!-- Thumbnail / Gallery -->
    <?php if (!empty($gallery_images) || has_post_thumbnail()) : ?>
        <div class="postbox__thumb w-img">
            <div class="postbox__thumb-slider p-relative">
                <div class="swiper-container postbox__thumb-slider-active">
                    <div class="swiper-wrapper">
                        <?php if (!empty($gallery_images)) : ?>
                            <?php foreach ($gallery_images as $image) : ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php elseif (has_post_thumbnail()) : ?>
                            <div class="swiper-slide">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Slider arrows - only show if more than one slide -->
                <?php if (count($gallery_images) > 1) : ?>
                <div class="postbox__slider-arrow-wrap">
                    <button class="postbox-arrow-prev">
                        <i class="fa-sharp fa-regular fa-arrow-left"></i>
                    </button>
                    <button class="postbox-arrow-next">
                        <i class="fa-sharp fa-regular fa-arrow-right"></i>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Content -->
    <div class="postbox__content">
        <div class="postbox__meta">
            <span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <i class="fa-light fa-user"></i>By <?php the_author(); ?>
            </a></span>
            
            <?php 
            $categories = get_the_category(); 
            if ($categories) : ?>
                <span>
                    <i class="fa-regular fa-location-dot"></i> <?php echo esc_html($categories[0]->name); ?>
                </span>
            <?php endif; ?>

            <span><a href="<?php comments_link(); ?>">
                <i class="fal fa-comments"></i> <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
            </a></span>
        </div>

        <h3 class="postbox__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="postbox__text">
            <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
        </div>

        <div class="tp-slide-btn-box">
            <a class="thm-btn" href="<?php the_permalink(); ?>">READ MORE</a>
        </div>
    </div>

</article>

<?php endif; ?>