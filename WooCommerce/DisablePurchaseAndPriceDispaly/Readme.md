# WooCommerce Product Display Mode

# I created it with the help of Claude AI and ChatGPT

## Description

A WordPress/WooCommerce function set that completely disables product pricing and purchasing functionality, transforming your WooCommerce store into a product catalog mode.

## Features

- Remove product prices from all pages
- Disable "Add to Cart" buttons
- Prevent product purchases
- Works on single product pages and shop/archive pages
- Lightweight and easy to implement

## Installation

1. Open your theme's `functions.php` file or a custom plugin
2. Copy and paste the following code:

```php
// Remove price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_filter( 'woocommerce_get_price_html', 'remove_price_from_product', 10, 2 );
function remove_price_from_product( $price, $product ) {
    return '';
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
add_filter( 'woocommerce_is_purchasable', '__return_false' );
add_filter( 'woocommerce_enable_add_to_cart', '__return_false' );
```

## Use Cases

- Product catalogs
- Portfolio websites
- Showcase sites
- Pre-launch product pages
- Consultation-based businesses

## Compatibility

- WordPress: 4.0+
- WooCommerce: 3.0+
- PHP: 5.6+

## What This Code Removes

- Product prices on all pages
- "Add to Cart" buttons
- Ability to purchase products
- Cart total calculations

## Customization

Modify the code to selectively enable/disable specific features:
- Remove specific actions
- Add custom display logic
- Create conditional display rules

## Potential Improvements

- Add admin settings to toggle catalog mode
- Create more granular control over product display
- Add custom product inquiry forms

## Cautions

- Completely disables e-commerce functionality
- Recommended for specific use cases only
- May require additional customization

## Support

If you encounter issues or need modifications, please [open an issue](https://github.com/yourusername/your-repo/issues) on GitHub.

## License

[MIT License](LICENSE)

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss proposed modifications.
