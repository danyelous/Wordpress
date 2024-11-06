# WooCommerce Shop Page Redirect

# I created it with the help of Claude AI and ChatGPT

A lightweight WordPress plugin that redirects customers back to the shop page after adding a product to their cart. This enhances the shopping experience by allowing customers to continue browsing products immediately after adding an item to their cart.

## Features

- 🔄 Automatic redirect to shop page after adding products to cart
- 🛍️ Encourages continued shopping
- ⚡ Lightweight implementation
- 🔌 Easy to install
- 💻 No configuration needed
- 🛠️ Built using WooCommerce best practices

## Installation

### Manual Installation

1. Add the following code to your theme's `functions.php` file or in a custom plugin:

```php
function redirect_to_shop_after_add_to_cart() {
    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    return $shop_page_url;
}
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_shop_after_add_to_cart');
```

### Using as a Plugin

1. Create a new file named `woocommerce-shop-redirect.php`
2. Add the following code:

```php
<?php
/*
Plugin Name: WooCommerce Shop Redirect
Description: Redirects customers to the shop page after adding products to cart
Version: 1.0
Author: Your Name
*/

function redirect_to_shop_after_add_to_cart() {
    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    return $shop_page_url;
}
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_shop_after_add_to_cart');
```

3. Upload to your `/wp-content/plugins/` directory
4. Activate the plugin through WordPress admin panel

## Usage

Once installed, the plugin works automatically:
- When a customer adds any product to their cart
- They will be redirected to the main shop page
- No configuration or settings needed

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- PHP 7.0 or higher

## Customization Examples

### Redirect to a Different Page

```php
function redirect_to_custom_page_after_add_to_cart() {
    return get_permalink(123); // Replace 123 with your page ID
}
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_custom_page_after_add_to_cart');
```

### Redirect Only for Specific Products

```php
function redirect_specific_products_after_add_to_cart($redirect_url) {
    global $product;
    if ($product && $product->get_id() == 123) { // Replace 123 with your product ID
        return get_permalink(wc_get_page_id('shop'));
    }
    return $redirect_url;
}
add_filter('woocommerce_add_to_cart_redirect', 'redirect_specific_products_after_add_to_cart');
```

## Benefits

1. Improves shopping experience
2. Encourages additional purchases
3. Streamlines the shopping flow
4. Reduces cart abandonment
5. No performance impact

## Technical Details

The plugin uses:
- WooCommerce hooks and filters
- WordPress core functions
- Standard redirect functionality

## Compatibility

- ✅ WooCommerce Standard Cart
- ✅ AJAX Add to Cart
- ✅ All WooCommerce themes
- ✅ Mobile devices

## Contributing

Contributions are welcome! Feel free to:
- Report bugs
- Suggest enhancements
- Submit pull requests

## Support

For support:
1. Create an issue in the GitHub repository
2. Provide your WordPress and WooCommerce versions
3. Describe any custom modifications to your theme

## License

This project is licensed under the [MIT License](LICENSE).

## Frequently Asked Questions

**Q: Will this work with AJAX add to cart?**  
A: Yes, the redirect works with both standard and AJAX add to cart functionality.

**Q: Can I change the redirect destination?**  
A: Yes, you can modify the function to redirect to any valid URL.

**Q: Does this affect the cart page or checkout?**  
A: No, this only affects the redirect after adding items to cart.

## Changelog

### 1.0.0
- Initial release
- Basic shop page redirect functionality

---
⭐ If you find this useful, please star the repository!
