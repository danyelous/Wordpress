# WooCommerce Mercado Pago Surcharge

# I created it with the help of Claude AI and ChatGPT

A WordPress plugin that automatically adds a configurable surcharge to orders when customers choose Mercado Pago as their payment method in WooCommerce. This is particularly useful for businesses that need to offset Mercado Pago's transaction fees.

## Features

- 💰 Automatically adds surcharge for Mercado Pago payments
- 🔄 Real-time calculation and update of cart totals
- ✨ Supports both regular Mercado Pago and Mercado Pago Credits
- 🌎 Includes Spanish language support
- ⚡ Lightweight implementation
- 🔌 Easy to install and configure

## Installation

1. Ensure WooCommerce and Mercado Pago plugins are installed and activated
2. Copy the code from `functions.php` to your theme's `functions.php` file or in a custom plugin
3. Adjust the surcharge percentage by modifying the `$percentage` variable

```php
$percentage = 0.25; // 25% surcharge
```

## Usage

Once installed, the plugin will automatically:
- Detect when Mercado Pago is selected as the payment method
- Apply the configured surcharge to the order total
- Display the surcharge as a separate line item
- Update the total in real-time if payment method changes

## Configuration

### Changing the Surcharge Percentage

To modify the surcharge percentage, locate and change the `$percentage` variable:

```php
$percentage = 0.25; // Change this value (0.25 = 25%)
```

### Supported Payment Methods

The surcharge applies to these Mercado Pago payment methods:
```php
$target_gateway1 = 'woo-mercado-pago-basic';    // Regular Mercado Pago
$target_gateway2 = 'woo-mercado-pago-credits';  // Mercado Pago Credits
```

### Customizing the Surcharge Label

To change the surcharge label that appears in the cart/checkout, modify:

```php
__('Recarga por Mercado Pago', 'woocommerce')
```

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- Mercado Pago Payment Gateway for WooCommerce
- PHP 7.0 or higher

## Technical Details

The plugin uses:
- WooCommerce action hooks
- WooCommerce fee API
- Session handling for payment method detection
- Real-time cart calculations
- WordPress internationalization functions

## Important Notes

1. The surcharge is calculated based on the cart subtotal
2. The surcharge updates automatically when payment methods are switched
3. The code includes checks to prevent duplicate calculations
4. Works in both cart and checkout pages

## Compatibility

- ✅ WooCommerce Standard Checkout
- ✅ WooCommerce Block-Based Checkout
- ✅ Mercado Pago Regular Payments
- ✅ Mercado Pago Credits

## Contributing

Contributions are welcome! Feel free to:
- Report bugs
- Suggest enhancements
- Submit pull requests

## License

This project is licensed under the [MIT License](LICENSE).

## Support

For support:
1. Create an issue in the GitHub repository
2. Provide details about your WordPress and WooCommerce versions
3. Include any error messages or unexpected behavior

## Best Practices

When implementing this code:
1. Test thoroughly with different cart scenarios
2. Verify surcharge calculations
3. Ensure proper display in emails and order summaries
4. Check compatibility with your theme and other plugins

## Credits

Developed for WooCommerce and Mercado Pago integration. Feel free to modify and improve upon this code.

---
⭐ If you find this useful, please star the repository!
