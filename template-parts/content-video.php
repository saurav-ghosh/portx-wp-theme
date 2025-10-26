<?php
$video_url = function_exists("get_field") ? get_field('paste_video_url') : "";
?>

<?php if(is_single()): ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-video mb-50 transition-3'); ?>>

    <!-- Video or Featured Image -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="postbox__thumb m-img p-relative">
            <?php if (!empty($video_url)) : ?>
                <!-- Video with play button overlay -->
                <a class="popup-video" href="<?php echo esc_url($video_url); ?>">
                    <?php the_post_thumbnail('full', ['class' => 'w-100']); ?>
                    <div class="postbox__play-btn">
                        <i class="fa-sharp fa-solid fa-play"></i>
                    </div>
                    <div class="postbox__meta-date">
                        <span>
                            <?php echo get_the_date('d M'); ?>
                        </span>
                    </div>
                </a>
            <?php else : ?>
                <!-- Regular image without video -->
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
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="postbox__content">
        
        <!-- Meta Info -->
        <div class="postbox__meta d-flex justify-content-between">
            <div class="postbox__info">
                <span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <i class="fa-light fa-user"></i> <?php 
                    $author_id = get_post_field( 'post_author', get_the_ID() );
                    $author_name = get_the_author_meta('display_name', $author_id);
                    echo esc_html($author_name);
                    ?>
                </a></span>
                
                <!-- Category -->
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

<article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-video mb-50 transition-3'); ?>>
    <div class="postbox__thumb m-img p-relative">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full'); ?>
        <?php else : ?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/blog-detials/blog-img-2.jpg'); ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>

        <?php if (!empty($video_url)) : ?>
            <div class="postbox__play-btn">
                <a class="popup-video pulse-btn" href="<?php echo esc_url($video_url); ?>">
                    <i class="fa-sharp fa-solid fa-play"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="postbox__content">
        <div class="postbox__meta">
            <span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <i class="fa-light fa-user"></i> By <?php the_author(); ?>
            </a></span>

            <?php 
            $category = get_the_category();
            if (!empty($category)) : ?>
                <span><i class="fa-regular fa-location-dot"></i> 
                    <?php echo esc_html($category[0]->name); ?>
                </span>
            <?php endif; ?>

            <span>
                <a href="<?php comments_link(); ?>">
                    <i class="fal fa-comments"></i> 
                    <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                </a>
            </span>
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

<!-- Debug: Add this temporarily to check if video URL is being retrieved -->
<?php if (current_user_can('administrator')) : ?>
    <!-- Only visible to admins -->
    <div style="display:none;" class="debug-info">
        Video URL: <?php echo esc_html($video_url); ?>
    </div>
<?php endif; ?>