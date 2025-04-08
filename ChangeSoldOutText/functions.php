add_filter('woocommerce_get_availability_text', 'themeprefix_change_soldout', 10, 2 );
/**
 * Change the default "Out of stock" text in WooCommerce to a custom message
 * 
 * @param string $text The original availability text
 * @param WC_Product $product The product object
 * @return string Modified availability text
 */
function themeprefix_change_soldout( $text, $product ) {
    // Check if the product is not in stock
    if ( !$product->is_in_stock() ) {
        // Replace with custom message in Spanish
        // Translation: "Out of stock at the moment, but don't be left wondering. Ask us about restocking or special orders!"
        $text = '<p class="stock out-of-stock">Sin stock por el momento, pero no te quedes con la duda. ¡Consultanos por reposición o pedidos especiales!</p>';
    }
    // Return either the modified text or the original if product is in stock
    return $text;
}
