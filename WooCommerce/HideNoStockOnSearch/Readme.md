# WooCommerce Out of Stock Search Filter

# I created it with the help of Claude AI and ChatGPT

## Description

This WordPress plugin function modifies the default WooCommerce search behavior to exclude out-of-stock products from search results. When a user performs a search on the website, only products that are currently in stock will be displayed in the search results.

## Features

- Filters WooCommerce search results
- Automatically hides out-of-stock products
- Lightweight and performance-friendly
- Easy to implement in any WooCommerce website

## Installation

1. Open your theme's `functions.php` file or a custom plugin file
2. Copy and paste the following code snippet:

```php
add_action( 'pre_get_posts', 'hide_out_of_stock_in_search');
function hide_out_of_stock_in_search( $query ) {
    if( $query->is_search() && $query->is_main_query() ) {
        $query->set( 'meta_key', '_stock_status' );
        $query->set( 'meta_value', 'instock' );
    }
}
```

## How It Works

- Hooks into `pre_get_posts` action
- Checks if the current query is a main search query
- Adds a meta query to filter products by stock status
- Only displays products with 'instock' status in search results

## Compatibility

- WordPress: 4.0+
- WooCommerce: 3.0+
- PHP: 5.6+

## Customization

If you want to modify the behavior, you can:
- Change the meta key
- Add additional conditions
- Implement more complex filtering logic

## Potential Improvements

- Add a filter to make the in-stock requirement configurable
- Create an admin setting to enable/disable this feature
- Add logging for debugging

## Support

If you encounter any issues or have suggestions, please [open an issue](https://github.com/yourusername/your-repo/issues) on GitHub.

## License

[MIT License](LICENSE)

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
