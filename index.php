<?php get_header(); ?>

<section class="postbox__area pt-120 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8">
                <div class="postbox__wrapper pr-20">
                    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                    <?php get_template_part('template-parts/content', get_post_format()); ?>

                    <?php endwhile; endif; ?>
                    
                    <div class="col-xl-12">
                      <div class="tp-pagination">
                        <nav><?php portx_posts_pagination(); ?></nav>
                      </div>
                    </div>
                </div>
            </div>
            <?php if ( is_active_sidebar('posts-sidebar') ) : ?>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="sidebar__wrapper">
                        <?php dynamic_sidebar('posts-sidebar'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>