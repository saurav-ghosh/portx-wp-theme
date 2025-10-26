<?php
defined('ABSPATH') || exit;
?>

<ul class="woocommerce-checkout-review-order-table">

	<!-- Header -->
	<li class="tp-order-info-list-header">
		<h4><?php esc_html_e('Product', 'woocommerce'); ?></h4>
		<h4><?php esc_html_e('Total', 'woocommerce'); ?></h4>
	</li>

	<?php
	do_action('woocommerce_review_order_before_cart_contents');

	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
		$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

		if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
	?>
			<li class="tp-order-info-list-desc <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
				<p>
					<?php
					echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key));
					echo ' <span>x ' . esc_html($cart_item['quantity']) . '</span>';
					echo wc_get_formatted_cart_item_data($cart_item);
					?>
				</p>
				<span>
					<?php
					echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
					?>
				</span>
			</li>
	<?php
		}
	}

	do_action('woocommerce_review_order_after_cart_contents');
	?>

	<!-- Subtotal -->
	<li class="tp-order-info-list-subtotal">
		<span><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
		<span><?php wc_cart_totals_subtotal_html(); ?></span>
	</li>

	<!-- Coupons -->
	<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
		<li class="tp-order-info-list-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
			<span><?php wc_cart_totals_coupon_label($coupon); ?></span>
			<span><?php wc_cart_totals_coupon_html($coupon); ?></span>
		</li>
	<?php endforeach; ?>

	<!-- Shipping -->
	<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
		<?php do_action('woocommerce_review_order_before_shipping'); ?>
		<li class="tp-order-info-list-shipping">
			<span><?php esc_html_e('Shipping', 'woocommerce'); ?></span>
			<div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
				<?php wc_cart_totals_shipping_html(); ?>
			</div>
		</li>
		<?php do_action('woocommerce_review_order_after_shipping'); ?>
	<?php endif; ?>

	<!-- Fees -->
	<?php foreach (WC()->cart->get_fees() as $fee) : ?>
		<li class="tp-order-info-list-fee">
			<span><?php echo esc_html($fee->name); ?></span>
			<span><?php wc_cart_totals_fee_html($fee); ?></span>
		</li>
	<?php endforeach; ?>

	<!-- Taxes -->
	<?php if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) : ?>
		<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
			<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
				<li class="tp-order-info-list-tax tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
					<span><?php echo esc_html($tax->label); ?></span>
					<span><?php echo wp_kses_post($tax->formatted_amount); ?></span>
				</li>
			<?php endforeach; ?>
		<?php else : ?>
			<li class="tp-order-info-list-tax">
				<span><?php echo esc_html(WC()->countries->tax_or_vat()); ?></span>
				<span><?php wc_cart_totals_taxes_total_html(); ?></span>
			</li>
		<?php endif; ?>
	<?php endif; ?>

	<!-- Total -->
	<?php do_action('woocommerce_review_order_before_order_total'); ?>
	<li class="tp-order-info-list-total">
		<span><?php esc_html_e('Total', 'woocommerce'); ?></span>
		<span><?php wc_cart_totals_order_total_html(); ?></span>
	</li>
	<?php do_action('woocommerce_review_order_after_order_total'); ?>

</ul>