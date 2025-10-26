<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

if (! defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (! empty($product_tabs)) : ?>
	<div class="row">
		<div class="productdetails-tabs mb-100">
			<div class="row">
				<div class="col-xl-10 col-lg-12 col-12">
					<div class="product-additional-tab">
						<div class="pro-details-nav mb-40">
							<!-- Tab Navigation -->
							<ul class="nav nav-tabs pro-details-nav-btn" id="myTabs" role="tablist">
								<?php $first_tab = true; ?>
								<?php foreach ($product_tabs as $key => $product_tab) : ?>
									<li class="nav-item" role="presentation">
										<button
											class="nav-links <?php echo $first_tab ? 'active' : ''; ?>"
											id="<?php echo esc_attr($key); ?>-tab"
											data-bs-toggle="tab"
											data-bs-target="#<?php echo esc_attr($key); ?>"
											type="button"
											role="tab"
											aria-controls="<?php echo esc_attr($key); ?>"
											aria-selected="<?php echo $first_tab ? 'true' : 'false'; ?>">
											<span><?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?></span>
										</button>
									</li>
									<?php $first_tab = false; ?>
								<?php endforeach; ?>
							</ul>
						</div>

						<!-- Tab Content -->
						<div class="tab-content tp-content-tab" id="myTabContent-2">
							<?php $first_tab = true; ?>
							<?php foreach ($product_tabs as $key => $product_tab) : ?>
								<div class="tab-pane fade <?php echo $first_tab ? 'show active' : ''; ?>"
									id="<?php echo esc_attr($key); ?>"
									role="tabpanel"
									aria-labelledby="<?php echo esc_attr($key); ?>-tab"
									tabindex="0">

									<div class="tp-product-details-desc-wrapper">
										<?php
										if (isset($product_tab['callback'])) {
											call_user_func($product_tab['callback'], $key, $product_tab);
										}
										?>
									</div>
								</div>
								<?php $first_tab = false; ?>
							<?php endforeach; ?>
						</div>

						<?php do_action('woocommerce_product_after_tabs'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
