<?php

/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) exit;

global $post;

$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

if (!$short_description) return;

$max_chars = 100;
$clean_text = wp_strip_all_tags($short_description); // remove HTML for counting
$is_long = strlen($clean_text) > $max_chars;
$short_text = mb_substr($clean_text, 0, $max_chars);
?>

<div class="woocommerce-product-details__short-description">
	<?php if ($is_long) : ?>
		<p style="display: inline;" id="short-desc-preview"><?php echo esc_html($short_text); ?>...</p>
		<div id="short-desc-full" style="display:none;">
			<?php echo $short_description; // Keep HTML intact, but don't wrap in <p> 
			?>
		</div>
		<span class="see-more-btn" onclick="toggleShortDesc(this)">See more</span>

		<script>
			function toggleShortDesc(btn) {
				const preview = document.getElementById('short-desc-preview');
				const full = document.getElementById('short-desc-full');

				if (full.style.display === 'none') {
					preview.style.display = 'none';
					full.style.display = 'inline';
					btn.textContent = 'See less';
				} else {
					preview.style.display = 'inline';
					full.style.display = 'none';
					btn.textContent = 'See more';
				}
			}
		</script>
	<?php else : ?>
		<?php echo $short_description; ?>
	<?php endif; ?>
</div>