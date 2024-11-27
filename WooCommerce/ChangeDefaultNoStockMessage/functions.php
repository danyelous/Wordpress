<?php

// Add a filter to modify the default WooCommerce availability text
// 'woocommerce_get_availability_text' is the hook to change stock status text
// '10' is the priority of the filter (default)
// '2' indicates the function accepts 2 parameters
add_filter('woocommerce_get_availability_text', 'themeprefix_change_soldout', 10, 2);

/**
 * Change the default "Sold Out" text for out-of-stock products
 * 
 * @param string $text Original availability text
 * @param WC_Product $product The current WooCommerce product object
 * @return string Modified availability text
 */
function themeprefix_change_soldout( $text, $product ) {
    // Check if the product is NOT in stock
    if ( !$product->is_in_stock() ) {
        // Replace the default out-of-stock text with a custom message
        // Includes a paragraph with a custom class for styling
        $text = '<p class="stock out-of-stock">Momentaneamente sin stock. Próximos a ingresar.</p>';
    }
    
    // Return the text (either modified or original)
    return $text;
}

?>
