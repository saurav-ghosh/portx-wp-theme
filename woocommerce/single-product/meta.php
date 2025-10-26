<?php

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if (! defined('ABSPATH')) {
	exit;
}

global $product;

$product_cat = get_the_terms($product->get_id(), 'product_cat');
$product_tags = get_the_terms($product->get_id(), 'product_tag');

?>

<div class="tp-product-details-query">

	<?php do_action('woocommerce_product_meta_start'); ?>

	<div class="tp-product-details-query-item d-flex align-items-center">
		<span>SKU: </span>
		<p><?php echo esc_html($product->get_sku()); ?></p>
	</div>

	<?php if (!empty($product_cat)): ?>
		<div class="tp-product-details-query-item d-flex align-items-center">
			<span>Category: </span>
			<p>
				<?php if ($product_cat && !is_wp_error($product_cat)) : ?>
					<?php
					$cat_names = wp_list_pluck($product_cat, 'name');
					echo esc_html(implode(', ', $cat_names));
					?>
				<?php endif; ?>
			</p>
		</div>
	<?php endif; ?>

	<?php if (!empty($product_tags)): ?>
		<div class="tp-product-details-query-item d-flex align-items-center">
			<span>Tag: </span>
			<p>
				<?php if ($product_tags && !is_wp_error($product_tags)) : ?>
					<?php
					$tag_names = wp_list_pluck($product_tags, 'name');
					echo esc_html(implode(', ', $tag_names));
					?>
				<?php endif; ?>
			</p>
		</div>
	<?php endif; ?>
	<?php do_action('woocommerce_product_meta_end'); ?>

</div>