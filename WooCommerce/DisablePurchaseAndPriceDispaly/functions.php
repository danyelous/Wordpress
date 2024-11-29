<?php

// Remove the default price display on single product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// Remove the default "Add to Cart" button on single product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

// Filter to completely remove price HTML from products
add_filter( 'woocommerce_get_price_html', 'remove_price_from_product', 10, 2 );
function remove_price_from_product( $price, $product ) {
    // Return an empty string to remove any price display
    return '';
}

// Redundant removal of price from single product page (already done above)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// Remove price from shop/archive pages product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

// Remove cart totals from the cart page
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

// Disable product purchasability globally
add_filter( 'woocommerce_is_purchasable', '__return_false' );

// Disable "Add to Cart" functionality globally
add_filter( 'woocommerce_enable_add_to_cart', '__return_false' );



?>
