<?php

// Add this code to your WordPress theme's functions.php file
function redirect_to_shop_after_add_to_cart() {
    // Get the permalink (URL) of the main WooCommerce shop page
    // wc_get_page_id('shop') returns the page ID of the shop page
    // get_permalink() converts the page ID to the full URL
    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    
    // Return the shop page URL - this will be used as the redirect destination
    return $shop_page_url;
}

// Add a filter to the 'woocommerce_add_to_cart_redirect' hook
// This hook is triggered after an item is added to the cart
// Our 'redirect_to_shop_after_add_to_cart' function will be called
// and its return value will be used as the redirect URL
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_shop_after_add_to_cart');


?>
