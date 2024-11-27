# WooCommerce Custom Out of Stock Text

# I created it with the help of Claude AI and ChatGPT

## Description

This WordPress plugin function customizes the default out-of-stock text in WooCommerce, replacing the standard "Sold Out" message with a more informative and friendly alternative.

## Features

- Replace default out-of-stock text
- Add custom messaging for unavailable products
- Maintain WooCommerce styling classes
- Lightweight and easy to implement

## Installation

1. Open your theme's `functions.php` file or a custom plugin file
2. Copy and paste the following code snippet:

```php
add_filter('woocommerce_get_availability_text', 'themeprefix_change_soldout', 10, 2);
function themeprefix_change_soldout( $text, $product ) {
    if ( !$product->is_in_stock() ) {
        $text = '<p class="stock out-of-stock">Momentaneamente sin stock. Próximos a ingresar.</p>';
    }
    return $text;
}
```

## How It Works

- Hooks into WooCommerce's `woocommerce_get_availability_text` filter
- Checks if a product is out of stock
- Replaces default text with a custom message
- Preserves original CSS classes for consistent styling

## Customization

You can easily modify the text by changing the message inside the function:
```php
$text = '<p class="stock out-of-stock">Your custom message here</p>';
```

## Compatibility

- WordPress: 4.0+
- WooCommerce: 3.0+
- PHP: 5.6+

## Styling

The function maintains the original CSS classes:
- `stock`: General stock status class
- `out-of-stock`: Specific to out-of-stock products

You can target these classes in your CSS to further customize the appearance:
```css
.stock.out-of-stock {
    color: red;
    font-weight: bold;
}
```

## Potential Improvements

- Add admin option to customize the out-of-stock text
- Create a more dynamic message based on product attributes
- Add translation support

## Support

If you encounter any issues or have suggestions, please [open an issue](https://github.com/yourusername/your-repo/issues) on GitHub.

## License

[MIT License](LICENSE)

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
