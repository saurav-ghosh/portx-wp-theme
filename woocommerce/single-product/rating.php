<?php

/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $product;

if (! wc_review_ratings_enabled()) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ($rating_count > 0) : ?>

	<div class="tp-product-details-rating">
		<?php for ($i = 1; $i <= 5; $i++) : ?>
			<?php if ($average >= $i) : ?>
				<span><i class="fas fa-star"></i></span> <!-- full star -->
			<?php elseif ($average >= ($i - 0.5)) : ?>
				<span><i class="fas fa-star-half-alt"></i></span> <!-- half star -->
			<?php else : ?>
				<span><i class="far fa-star"></i></span> <!-- empty star -->
			<?php endif; ?>
		<?php endfor; ?>
	</div>
	<div class="tp-product-details-reviews">
		<span>(<?php echo esc_html($review_count); ?> Reviews)</span>
	</div>


<?php endif; ?>