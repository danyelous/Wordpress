# WooCommerce Hide Out of Stock Products in Search

# I created it with the help of Claude AI and ChatGPT

A lightweight WordPress plugin that hides out of stock products from search results on your WooCommerce-powered website. This provides a better shopping experience for your customers by only showing them products they can actually purchase.

## Features

- 🔍 Automatically hides out of stock products from search results
- 🛒 Improves user experience by showing only available products
- ⚡ Lightweight and efficient implementation
- 🔌 Easy to install and activate
- 💻 No configuration required

## Installation

### Manual Installation

1. Add the following code to your theme's `functions.php` file or in a custom plugin:

```php
add_action('pre_get_posts', 'hide_out_of_stock_in_search');
function hide_out_of_stock_in_search($query) {
    if($query->is_search() && $query->is_main_query()) {
        $query->set('meta_key', '_stock_status');
        $query->set('meta_value', 'instock');
    }
}
```

### Using as a Plugin

1. Create a new file named `woocommerce-hide-out-of-stock.php`
2. Add the following code:

```php
<?php
/*
Plugin Name: WooCommerce Hide Out of Stock Products in Search
Description: Hides out of stock products from search results on your WooCommerce website
Version: 1.0
Author: Your Name
*/

add_action('pre_get_posts', 'hide_out_of_stock_in_search');
function hide_out_of_stock_in_search($query) {
    if($query->is_search() && $query->is_main_query()) {
        $query->set('meta_key', '_stock_status');
        $query->set('meta_value', 'instock');
    }
}
```

3. Upload to your `/wp-content/plugins/` directory
4. Activate the plugin through WordPress admin panel

## Usage

Once installed, the plugin will automatically:
- Hide out of stock products from the search results on your WooCommerce website
- No configuration or settings needed

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- PHP 7.0 or higher

## Customization Examples

### Exclude Specific Product Categories

```php
function hide_out_of_stock_in_search($query) {
    if($query->is_search() && $query->is_main_query()) {
        $query->set('meta_key', '_stock_status');
        $query->set('meta_value', 'instock');
        
        // Exclude products from specific categories
        $query->set('tax_query', array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array('excluded-category-slug-1', 'excluded-category-slug-2'),
                'operator' => 'NOT IN'
            )
        ));
    }
}
add_action('pre_get_posts', 'hide_out_of_stock_in_search');
```

### Exclude Specific Products

```php
function hide_out_of_stock_in_search($query) {
    if($query->is_search() && $query->is_main_query()) {
        $query->set('meta_key', '_stock_status');
        $query->set('meta_value', 'instock');
        
        // Exclude specific products
        $query->set('post__not_in', array(123, 456, 789));
    }
}
add_action('pre_get_posts', 'hide_out_of_stock_in_search');
```

## Benefits

1. Enhances user experience by only showing available products
2. Reduces frustration for customers who can't purchase out of stock items
3. Streamlines the shopping process and encourages more sales
4. Minimizes administrative overhead of managing out of stock products
5. Lightweight and efficient implementation with no performance impact

## Technical Details

The plugin uses:
- WordPress `pre_get_posts` action
- WooCommerce product stock status meta field (`_stock_status`)
- WordPress core query manipulation functions

## Compatibility

- ✅ WooCommerce Standard Search
- ✅ AJAX-powered search
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

**Q: Will this affect the cart or checkout page?**  
A: No, this plugin only modifies the search results. The cart and checkout pages will continue to display all products, including out of stock items.

**Q: Can I exclude specific products or categories from this filter?**  
A: Yes, you can add additional logic to the `hide_out_of_stock_in_search` function to exclude specific products or categories.

**Q: Does this work with AJAX-powered search?**  
A: Yes, the plugin is designed to work with both standard and AJAX-powered search functionality.

## Changelog

### 1.0.0
- Initial release
- Hides out of stock products from search results

---
⭐ If you find this useful, please star the repository!
