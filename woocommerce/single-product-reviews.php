<?php
/**
 * Custom WooCommerce Product Reviews Template
 *
 * Copy this file to yourtheme/woocommerce/single-product-reviews.php
 *
 * @package WooCommerce\Templates
 */

defined('ABSPATH') || exit;

global $product;

if (! comments_open()) {
    return;
}
?>

<div id="reviews" class="woocommerce-Reviews">
    <div class="product-details-review">

        <!-- Reviews Title -->
        <h3 class="tp-comments-title mb-35">
            <?php
            $count = $product->get_review_count();
            if ($count && wc_review_ratings_enabled()) {
                $reviews_title = sprintf(
                    esc_html(_n('%1$s review for “%2$s”', '%1$s reviews for “%2$s”', $count, 'woocommerce')),
                    esc_html($count),
                    get_the_title()
                );
                echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product);
            } else {
                esc_html_e('Reviews', 'woocommerce');
            }
            ?>
        </h3>

        <!-- Reviews List -->
        <?php if (have_comments()) : ?>
            <div class="latest-comments mb-55">
                <ul>
                    <?php
                    wp_list_comments(array(
                        'callback' => function ($comment, $args, $depth) {
                            $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
                            ?>
                            <li>
                                <div class="comments-box d-flex">
                                    <div class="comments-avatar mr-25">
                                        <?php echo get_avatar($comment, 60); ?>
                                    </div>
                                    <div class="comments-text">
                                        <div class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
                                            <div class="avatar-name">
                                                <b><?php echo get_comment_author(); ?></b>
                                                <div class="comments-date mb-20">
                                                    <span><?php echo get_comment_date(); ?></span>
                                                </div>
                                            </div>
                                            <?php if ($rating && wc_review_ratings_enabled()) : ?>
                                                <div class="user-rating">
                                                    <ul>
                                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                            <li>
                                                                <i class="<?php echo ($i <= $rating) ? 'fas fa-star' : 'fal fa-star'; ?>"></i>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <p class="m-0"><?php comment_text(); ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    ));
                    ?>
                </ul>
            </div>

            <!-- Reviews Pagination -->
            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                <nav class="woocommerce-pagination">
                    <?php
                    paginate_comments_links(apply_filters('woocommerce_comment_pagination_args', array(
                        'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
                        'next_text' => is_rtl() ? '&larr;' : '&rarr;',
                        'type'      => 'list',
                    )));
                    ?>
                </nav>
            <?php endif; ?>

        <?php else : ?>
            <p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'woocommerce'); ?></p>
        <?php endif; ?>

        <!-- Review Form -->
        <div class="product-details-comment pb-100">
            <div class="comment-title mb-20">
                <h3><?php echo have_comments() ? esc_html__('Add a review', 'woocommerce') : sprintf(esc_html__('Be the first to review “%s”', 'woocommerce'), get_the_title()); ?></h3>
                <p><?php esc_html_e('Your email address will not be published. Required fields are marked*', 'woocommerce'); ?></p>
            </div>

            <?php
            if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) {

                $commenter = wp_get_current_commenter();
                $name_email_required = (bool) get_option('require_name_email', 1);

                $fields = array(
                    'author' => '<div class="col-xxl-6"><div class="comment-input"><input type="text" name="author" placeholder="' . esc_attr__('Your Name*', 'woocommerce') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($name_email_required ? 'required' : '') . '></div></div>',
                    'email'  => '<div class="col-xxl-6"><div class="comment-input"><input type="email" name="email" placeholder="' . esc_attr__('Your Email*', 'woocommerce') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($name_email_required ? 'required' : '') . '></div></div>',
                );

                $comment_form = array(
                    'title_reply'         => '',
                    'title_reply_to'      => esc_html__('Leave a Reply to %s', 'woocommerce'),
                    'title_reply_before'  => '<span id="reply-title" class="comment-reply-title" style="display:none;">',
                    'title_reply_after'   => '</span>',
                    'comment_notes_after' => '',
                    'fields'              => $fields,
                    'label_submit'        => esc_html__('Submit', 'woocommerce'),
                    'class_form'          => 'row comment-form',
                    'class_submit'        => 'thm-btn',
                    'submit_button'       => '<div class="col-xxl-12"><div class="comment-submit"><button type="submit" class="thm-btn">%4$s</button></div></div>',
                    'comment_field'       => '',
                );

                // Add star rating
                if (wc_review_ratings_enabled()) {
                    $comment_form['comment_field'] .= '<div class="comment-rating mb-20 d-flex">
                        <span>' . esc_html__('Overall ratings', 'woocommerce') . '</span>
                        <ul class="rating-stars" id="star-rating">
                            <input type="hidden" name="rating" id="rating" value="">
                            <li class="star" data-rating="1"><i class="fal fa-star"></i></li>
                            <li class="star" data-rating="2"><i class="fal fa-star"></i></li>
                            <li class="star" data-rating="3"><i class="fal fa-star"></i></li>
                            <li class="star" data-rating="4"><i class="fal fa-star"></i></li>
                            <li class="star" data-rating="5"><i class="fal fa-star"></i></li>
                        </ul>
                    </div>';
                }

                // Review textarea
                $comment_form['comment_field'] .= '<div class="col-xxl-12"><div class="comment-input"><textarea name="comment" placeholder="' . esc_attr__('Your review...', 'woocommerce') . '" required></textarea></div></div>';

                comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
            } else {
                echo '<p class="woocommerce-verification-required">' . esc_html__('Only logged in customers who have purchased this product may leave a review.', 'woocommerce') . '</p>';
            }
            ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.getAttribute('data-rating'));
            ratingInput.value = selectedRating;
            updateStars(selectedRating);
        });
        star.addEventListener('mouseenter', function() {
            updateStars(parseInt(this.getAttribute('data-rating')));
        });
    });

    document.getElementById('star-rating').addEventListener('mouseleave', function() {
        updateStars(selectedRating);
    });

    function updateStars(rating) {
        stars.forEach(star => {
            const value = parseInt(star.getAttribute('data-rating'));
            const icon = star.querySelector('i');
            if (value <= rating) {
                icon.className = 'fas fa-star';
            } else {
                icon.className = 'fal fa-star';
            }
        });
    }
});
</script>
