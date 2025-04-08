# WooCommerce Custom Stock Message

# I created it with the help of Claude AI and ChatGPT

A simple WordPress function that customizes the "Out of stock" message in WooCommerce to enhance customer experience and encourage inquiries about product availability.

## Description

This plugin/function replaces the standard "Out of stock" message in WooCommerce with a custom message in Spanish that encourages customers to inquire about product restocking or special orders, potentially recovering sales that might otherwise be lost.

The custom message translates to: "Out of stock at the moment, but don't be left wondering. Ask us about restocking or special orders!"

## Installation

1. Add the code to your theme's `functions.php` file or through a custom functionality plugin.
2. No configuration is needed - it works automatically on all out-of-stock products.

## Usage

```php
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
```

## Customization

To change the message:
1. Edit the text within the single quotes after `$text =`
2. You can use HTML tags as shown in the example for styling
3. The message appears on product pages when an item is out of stock

## Requirements

- WordPress
- WooCommerce plugin activated

## License

GPL v2 or later

## Author

[Your Name/Company]

## Changelog

### 1.0.0
- Initial release
