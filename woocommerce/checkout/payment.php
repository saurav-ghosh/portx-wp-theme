<?php
defined('ABSPATH') || exit;

if (!wp_doing_ajax()) {
    do_action('woocommerce_review_order_before_payment');
}
?>
<div id="payment" class="woocommerce-checkout-payment">
    <?php if (WC()->cart && WC()->cart->needs_payment()) : ?>
        <div class="tp-checkout-payment wc_payment_methods payment_methods methods">
            <?php
            if (!empty($available_gateways)) {
                foreach ($available_gateways as $gateway) {
                    ?>
                    <div class="tp-checkout-payment-item <?php echo esc_attr($gateway->id); ?>-payment">
                        <input 
                            id="payment_method_<?php echo esc_attr($gateway->id); ?>" 
                            type="radio" 
                            name="payment_method" 
                            value="<?php echo esc_attr($gateway->id); ?>" 
                            class="input-radio"
                            <?php checked($gateway->chosen, true); ?> 
                            data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" 
                        />

                        <label for="payment_method_<?php echo esc_attr($gateway->id); ?>">
                            <?php
                            echo wp_kses_post($gateway->get_title());
                            if ($gateway->get_icon()) {
                                echo ' ' . wp_kses_post($gateway->get_icon());
                            }
                            ?>
                        </label>

                        <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
                            <div class="tp-checkout-payment-desc payment_box payment_method_<?php echo esc_attr($gateway->id); ?>" style="<?php echo $gateway->chosen ? '' : 'display:none;'; ?>">
                                <?php $gateway->payment_fields(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                }
            } else {
                echo '<p>' . esc_html__('No available payment methods.', 'woocommerce') . '</p>';
            }
            ?>
        </div>
    <?php endif; ?>

    <div class="form-row place-order">
        <noscript>
            <?php
            printf(
                esc_html__('Since your browser does not support JavaScript, please click the %1$sUpdate Totals%2$s button before placing your order.', 'woocommerce'),
                '<em>',
                '</em>'
            );
            ?>
            <br />
            <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>">
                <?php esc_html_e('Update totals', 'woocommerce'); ?>
            </button>
        </noscript>

        <?php wc_get_template('checkout/terms.php'); ?>

        <?php do_action('woocommerce_review_order_before_submit'); ?>

        <div class="tp-checkout-btn-wrapper">
            <?php
            echo apply_filters(
                'woocommerce_order_button_html',
                '<button type="submit" class="buttons alt tp-checkout-btn w-100" name="woocommerce_checkout_place_order" id="place_order" value="' .
                esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' .
                esc_html($order_button_text) . '</button>'
            );
            ?>
        </div>

        <?php do_action('woocommerce_review_order_after_submit'); ?>

        <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
    </div>
</div>
<?php
if (!wp_doing_ajax()) {
    do_action('woocommerce_review_order_after_payment');
}
