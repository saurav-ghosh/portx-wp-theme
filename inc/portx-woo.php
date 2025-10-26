<?php

// archive-product.php
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


//content-product.php
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

//content-single-product.php
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


// WPC wishlist
add_filter('woosw_button_position_archive', '__return_false');
add_filter('woosw_button_position_single', '__return_false');

// WPC Quick View
add_filter('woosq_button_position', '__return_false');

// WPC Compare
add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosc_button_position_single', '__return_false');

// Remove WooCommerce default "notes" text
add_filter('woocommerce_product_review_comment_form_args', function($args) {
    $args['comment_notes_before'] = '';
    $args['comment_notes_after']  = '';
    return $args;
});

function portx_product_custom_template()
{

    global $product;

    $product_cat = get_the_terms($product->get_id(), 'product_cat');
?>
    

    <div class="product__item p-relative transition-3 mb-50">
        <div class="product__thumb w-img p-relative fix">
            <a href="<?php echo esc_url($product->get_permalink()); ?>">
                <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="">
            </a>

            <?php if ($product->is_on_sale()) : ?>
                <div class="product__badge d-flex flex-column flex-wrap">
                    <span class="product__badge-item"><?php woocommerce_show_product_loop_sale_flash(); ?></span>
                </div>
            <?php endif; ?>

            <div class="product__action d-flex flex-column flex-wrap">
                <div class="product-action-btn">
                    <?php echo do_shortcode('[woosw]'); ?>
                    <span class="product-action-tooltip">Add To Wishlist</span>
                </div>
                <div class="product-action-btn" data-bs-toggle="modal"
                    data-bs-target="#productModal">
                    <?php echo do_shortcode('[woosq]'); ?>
                    <span class="product-action-tooltip">Quick view</span>
                </div>
                <div class="product-action-btn">
                    <?php echo do_shortcode('[woosc]'); ?>
                    <span class="product-action-tooltip">Add To Compare</span>
                </div>
            </div>
            <div class="product__add transition-3">
               <?php portx_wooc_add_to_cart(); ?>
            </div>
        </div>
        <div class="product__content">
            <div class="product__rating d-flex">
                <?php
                $average = $product->get_average_rating();
                if ($average > 0) {
                    $stars_html = '';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $average) {
                            $stars_html .= '<i class="fa-solid fa-star star filled"></i>';
                        } elseif ($i - 0.5 <= $average) {
                            $stars_html .= '<i class="fa-solid fa-star-half-stroke star half"></i>';
                        } else {
                            $stars_html .= '<i class="fa-regular fa-star star empty"></i>';
                        }
                    }
                    echo '<div class="stars-only">' . $stars_html . '</div>';
                }
                ?>
            </div>
            <h3 class="product__title">
                <a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a>
            </h3>
            <div class="product__price">
                <span class="product__ammount"><?php woocommerce_template_loop_price(); ?></span>
            </div>
        </div>
        </div>
<?php
}
add_action('woocommerce_before_shop_loop_item', 'portx_product_custom_template');


// product add to cart button
function portx_wooc_add_to_cart($args = array())
{
    global $product;

    if ($product) {
        $defaults = array(
            'quantity'   => 1,
            'class'      => implode(
                ' ',
                array_filter(
                    array(
                        'product-add-cart-btn w-100',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );

        $args = wp_parse_args($args, $defaults);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
    }

    // Cart SVG Icon
    $cart_icon = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M3.54431 4.80484L4.08701 11.2487C4.12661 11.7447 4.53251 12.1167 5.02841 12.1167H5.03201H14.8519H14.8537C15.3227 12.1167 15.7232 11.7681 15.7898 11.3053L16.6448 5.41221C16.6646 5.27205 16.6295 5.13189 16.544 5.01868C16.4594 4.90457 16.3352 4.8309 16.1948 4.81113C16.0067 4.81832 8.20092 4.80754 3.54431 4.80484ZM5.02647 13.4642C3.84117 13.4642 2.83766 12.5405 2.74136 11.359L1.91696 1.57098L0.560653 1.33738C0.192551 1.27269 -0.0531497 0.924974 0.00985058 0.557495C0.0746508 0.190017 0.430152 -0.0489788 0.790154 0.00852392L2.66216 0.331977C2.96366 0.384987 3.19316 0.634765 3.21926 0.940248L3.43076 3.45689C16.2792 3.46228 16.3206 3.46857 16.3827 3.47576C16.884 3.54854 17.325 3.80999 17.6256 4.21251C17.9262 4.61413 18.0522 5.1092 17.9802 5.60516L17.1261 11.4974C16.965 12.6187 15.9894 13.4642 14.8554 13.4642H14.8509H5.03367H5.02647Z"
        fill="currentColor"></path>
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M13.4079 8.12567H10.9131C10.5396 8.12567 10.2381 7.82379 10.2381 7.45181C10.2381 7.07984 10.5396 6.77795 10.9131 6.77795H13.4079C13.7805 6.77795 14.0829 7.07984 14.0829 7.45181C14.0829 7.82379 13.7805 8.12567 13.4079 8.12567Z"
        fill="currentColor"></path>
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M4.63943 15.9048C4.91033 15.9048 5.12903 16.1235 5.12903 16.3944C5.12903 16.6653 4.91033 16.8849 4.63943 16.8849C4.36763 16.8849 4.14893 16.6653 4.14893 16.3944C4.14893 16.1235 4.36763 15.9048 4.63943 15.9048Z"
        fill="currentColor"></path>
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M4.63859 16.2097C4.53689 16.2097 4.45409 16.2925 4.45409 16.3942C4.45409 16.5985 4.82399 16.5985 4.82399 16.3942C4.82399 16.2925 4.74029 16.2097 4.63859 16.2097ZM4.6386 17.5569C3.996 17.5569 3.474 17.0349 3.474 16.3933C3.474 15.7518 3.996 15.2307 4.6386 15.2307C5.28121 15.2307 5.80411 15.7518 5.80411 16.3933C5.80411 17.0349 5.28121 17.5569 4.6386 17.5569Z"
        fill="currentColor"></path>
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M14.7918 15.9048C15.0627 15.9048 15.2823 16.1235 15.2823 16.3944C15.2823 16.6653 15.0627 16.8849 14.7918 16.8849C14.52 16.8849 14.3013 16.6653 14.3013 16.3944C14.3013 16.1235 14.52 15.9048 14.7918 15.9048Z"
        fill="currentColor"></path>
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M14.7906 16.2098C14.6898 16.2098 14.607 16.2926 14.607 16.3943C14.6079 16.6004 14.9769 16.5986 14.976 16.3943C14.976 16.2926 14.8923 16.2098 14.7906 16.2098ZM14.7909 17.5569C14.1483 17.5569 13.6263 17.0349 13.6263 16.3933C13.6263 15.7518 14.1483 15.2307 14.7909 15.2307C15.4344 15.2307 15.9573 15.7518 15.9573 16.3933C15.9573 17.0349 15.4344 17.5569 14.7909 17.5569Z"
        fill="currentColor"></path>
    </svg>';

    // check product type 
    if ($product->is_type('simple')) {
        $btntext = esc_html__("Add to Cart", 'portx');
    } elseif ($product->is_type('variable')) {
        $btntext = esc_html__("Select Options", 'portx');
    } elseif ($product->is_type('external')) {
        $btntext = esc_html__("Buy Now", 'portx');
    } elseif ($product->is_type('grouped')) {
        $btntext = esc_html__("View Products", 'portx');
    } else {
        $btntext = esc_html__("Add to Cart", 'portx');
    }

    echo sprintf(
        '<a title="%s" href="%s" data-quantity="%s" class="%s" %s>%s %s</a>',
        $btntext,
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'product-add-cart-btn w-100'),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        $cart_icon,
        $btntext
    );
}

//single product image/gallery
function single_product_thumbnail()
{
    global $product;

    if (!$product) return;

    $main_image_id = $product->get_image_id();
    $gallery_ids = $product->get_gallery_image_ids();

    //Include main image as first
    $image_ids = $main_image_id ? array_merge([$main_image_id], $gallery_ids) : $gallery_ids;

    if (empty($image_ids)) return; // no images found
?>
    <div class="tp-shop-details__wrapper">
        <div class="tp-shop-details__tab-content-box mb-20">
            <div class="tab-content" id="nav-tabContent">
                <?php foreach ($image_ids as $index => $image_id) :
                    $img_url = wp_get_attachment_image_url($image_id, 'full');
                    $tab_id = 'nav-' . ($index + 1);
                    $is_active = $index === 0 ? 'show active' : '';
                    ?>
                    <div class="tab-pane fade <?php echo esc_attr($is_active) ?>" id="<?php echo esc_attr($tab_id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id) ?>-tab" tabindex="0">
                        <div class="tp-product-details-nav-main-thumb">
                            <img src="<?php echo esc_url($img_url); ?>" alt="">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tp-shop-details__tab-btn-box">
            <?php if (count($image_ids) > 1) : ?>
                <nav>
                    <div class="nav nav-tab" id="nav-tab" role="tablist">
                        <?php foreach ($image_ids as $index => $image_id) :
                            $thumb_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                            $tab_id = 'nav-' . ($index + 1);
                            $is_active = $index === 0 ? 'active' : '';
                        ?>
                            <button class="nav-links <?php echo esc_attr($is_active); ?>" id="<?php echo esc_attr($tab_id); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr($tab_id); ?>" type="button" role="tab" aria-controls="<?php echo esc_attr($tab_id); ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="">
                            </button>
                        <?php endforeach; ?>
                    </div>
                </nav>
            <?php endif; ?>
        </div>
    </div>
<?php
}
add_action('woocommerce_before_single_product_summary', 'single_product_thumbnail');

// Single product summary 
function single_product_summary(){
?>
<div class="tp-shop-details__right-warp">
    <h3 class="tp-shop-details__title-sm"> <?php the_title(); ?></h3>
    <div class="tp-shop-details__ratting">
        <?php woocommerce_template_single_rating(); ?>
    </div>
    <div class="tp-shop-details__text">
        <p><?php woocommerce_template_single_excerpt(); ?>
        </p>
    </div>
    <div class="tp-shop-details__price">
        <span><?php woocommerce_template_single_price(); ?></span>
    </div>
    <div class="tp-shop-details__product-info">
        <?php woocommerce_template_single_meta(); ?>
    </div>
    <div class="tp-shop-details__quantity-wrap">
        <?php woocommerce_template_single_add_to_cart(); ?>
    </div>
</div>

<?php
}
add_action('woocommerce_single_product_summary', 'single_product_summary');
