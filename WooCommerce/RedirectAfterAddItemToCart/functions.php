<?php 

// This code should be added to your WordPress theme's functions.php file or a custom plugin

// Define function to handle redirect after adding item to cart
function redirect_to_shop_after_add_to_cart() {
    // Get the URL of the WooCommerce shop page using WC's built-in function
    // wc_get_page_id('shop') gets the ID of the main shop page
    // get_permalink() converts the page ID into its URL
    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    
    // Return the shop URL - this will be used as the redirect destination
    return $shop_page_url;
}

// Hook the function to WooCommerce's add to cart redirect filter
// This filter runs after an item is added to cart
// When an item is added to cart, instead of the default behavior,
// it will use our function to redirect to the shop page
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_shop_after_add_to_cart');


?>
