<?php

/**
 * Limit WooCommerce cart to one item only
 * 
 * These functions ensure that the cart can only contain one item at a time
 * by clearing existing items when a new one is added and preventing quantity
 * modifications through both UI and programmatic means.
 */

/**
 * Force the cart to contain only one item by clearing it when a new item is added
 * Hooks into cart validation to check and clear existing items
 * 
 * @param bool $passed      Whether or not the validation passed
 * @param int  $product_id  The ID of the product being added
 * @return bool            Returns the validation status
 */
add_filter('woocommerce_add_to_cart_validation', 'force_single_item_cart', 10, 2);
function force_single_item_cart($passed, $product_id) {
    // Check if cart has items and clear it before adding new item
    if (!WC()->cart->is_empty()) {
        WC()->cart->empty_cart();
    }
    return $passed;
}

/**
 * Display a notice to users when previous items are removed from cart
 * Provides feedback to users about why their cart items disappeared
 */
add_action('woocommerce_add_to_cart', 'single_item_cart_notice');
function single_item_cart_notice() {
    // Check if WooCommerce notice function exists for compatibility
    if (function_exists('wc_add_notice')) {
        wc_add_notice(__('Previous items were removed as only one item can be purchased at a time.', 'woocommerce'), 'notice');
    }
}

/**
 * Prevent quantity modifications in cart through the UI
 * Sets both minimum and maximum quantity values to 1
 * 
 * @param array      $args     Default quantity input arguments
 * @param WC_Product $product  Product object
 * @return array              Modified quantity input arguments
 */
add_filter('woocommerce_quantity_input_args', 'limit_quantity_input_args', 10, 2);
function limit_quantity_input_args($args, $product) {
    // Force all quantity-related values to 1
    $args['max_value'] = 1;
    $args['min_value'] = 1;
    $args['input_value'] = 1;
    return $args;
}

/**
 * Force quantity to 1 even if modified programmatically
 * Provides additional security against programmatic quantity changes
 * 
 * @param array $cart_item_data  Cart item data
 * @param int   $product_id      Product ID
 * @return array                Modified cart item data
 */
add_filter('woocommerce_add_cart_item_data', 'force_single_item_quantity', 10, 2);
function force_single_item_quantity($cart_item_data, $product_id) {
    // Ensure quantity is always 1 regardless of any modifications
    $cart_item_data['quantity'] = 1;
    return $cart_item_data;
}


?>
