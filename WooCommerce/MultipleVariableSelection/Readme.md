# WooCommerce Multiple Variations Selection

# I created it with the help of Claude AI and ChatGPT

A WordPress plugin that enhances WooCommerce's variable product interface by allowing customers to select multiple variations simultaneously. It replaces the default variation selector with a user-friendly table interface that displays all available variations with their respective quantity selectors.

## Features

- Custom table interface for variable products
- Simultaneous selection of multiple variations
- Visual stock status indicators
- Plus/minus quantity buttons for easy quantity adjustment
- AJAX-based cart updates
- Responsive design
- Compatible with WooCommerce's stock management
- Supports both logged-in and guest users

## Installation

1. Download the code and place it in your theme's `functions.php` file or in a custom plugin file.
2. Ensure you have WooCommerce installed and activated.
3. The functionality will automatically apply to all variable products.

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- jQuery (included with WordPress)

## Usage

Once installed, the plugin automatically replaces the default WooCommerce variation selector on variable product pages. No additional configuration is required.

### Features Breakdown

#### For Customers
- View all available variations in a table format
- See stock status for each variation
- Easily adjust quantities using plus/minus buttons
- Add multiple variations to cart with a single click

#### For Shop Managers
- Stock levels are automatically respected
- No additional admin configuration needed
- Standard WooCommerce stock management applies

## Customization

### Modifying Column Headers

To change the column headers, modify the following lines in the `custom_variable_add_to_cart()` function:

```php
echo '<th>' . __('Tamaño', 'woocommerce') . '</th>';
echo '<th>' . __('Disponible', 'woocommerce') . '</th>';
echo '<th>' . __('Cantidad', 'woocommerce') . '</th>';
```

### Styling

The plugin includes basic CSS styling. You can customize the appearance by modifying the CSS in the `add_multiple_variations_styles()` function or by adding custom CSS to your theme.

Key CSS classes:
- `.multiple-variations-selector` - Main container
- `.variations-table` - The variations table
- `.quantity-selector` - Quantity input container
- `.stock-status` - Stock status indicator
- `.stock-status.in-stock` - In-stock indicator
- `.stock-status.out-of-stock` - Out-of-stock indicator

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Known Issues

1. The first variation is intentionally skipped in the current implementation. If you need to display all variations, remove the following code block:
```php
if ($skip_first) {
    $skip_first = false;
    continue;
}
```

2. The table headers are currently hardcoded in Spanish. Update the text in the `custom_variable_add_to_cart()` function to match your language needs.

## License

This project is licensed under the GPL v2 or later.

## Support

For support, please submit an issue on GitHub or contact the developer.

## Credits

Developed for WooCommerce variable products enhancement.

## Changelog

### 1.0.0
- Initial release
- Basic multiple variation selection functionality
- AJAX cart integration
- Stock status indicators
- Quantity selectors
