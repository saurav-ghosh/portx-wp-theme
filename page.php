<?php get_header(); ?>


    <section class="tp-page-area pt-130 pb-120">
        <div class="container">
            <div class="tp-page-wrapper">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php get_footer();