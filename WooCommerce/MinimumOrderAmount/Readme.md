# WooCommerce Minimum Order Amount

# I created it with the help of Claude AI and ChatGPT

A WordPress plugin that adds a minimum order amount requirement to your WooCommerce checkout page. This plugin dynamically disables the checkout button and displays a warning message when the cart total is below the specified minimum amount.

## Features

- 🛡️ Enforces a minimum order amount on checkout
- 🔄 Dynamically updates when cart contents change
- 🚫 Automatically disables the order button when below minimum
- 💬 Displays a customizable warning message
- ⚡ Lightweight and performant implementation
- 🔌 Easy to install and configure

## Installation

1. Copy the code from `functions.php` to your theme's `functions.php` file or in a custom plugin
2. Adjust the minimum order amount by modifying the `$minimum_order` variable
3. Customize the warning message if needed

```php
// Define your minimum order amount (in cents/pennies)
$minimum_order = 60000; // $600.00
```

## Usage

Once installed, the plugin will automatically:
- Check the order total on the checkout page
- Disable the "Place Order" button if the total is below the minimum
- Display a warning message showing the minimum required amount
- Re-enable the button once the minimum amount is reached

## Configuration

### Changing the Minimum Amount

To change the minimum order amount, modify the `$minimum_order` variable in the function:

```php
$minimum_order = 60000; // Change this value (in cents)
```

### Customizing the Message

To change the warning message, modify this line in the JavaScript:

```php
$placeOrderButton.after('<p class="order-disabled-message">El monto mínimo de compra es de $<?php echo number_format($minimum_order, 2, ',', '.'); ?></p>');
```

### Styling

The plugin adds the following classes that you can style:
- `.disable-order-btn` - Applied to the disabled order button
- `.order-disabled-message` - Applied to the warning message

Add custom CSS to your theme to style these elements:

```css
.disable-order-btn {
    opacity: 0.5;
}

.order-disabled-message {
    color: red;
    margin-top: 10px;
}
```

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- jQuery (included with WordPress)

## Technical Details

The plugin uses:
- WordPress action hooks
- WooCommerce checkout events
- jQuery for DOM manipulation
- PHP number formatting
- WooCommerce checkout page detection

## Contributing

Feel free to submit issues and enhancement requests.

## License

This project is licensed under the [MIT License](LICENSE).

## Support

For support, please raise an issue in the GitHub repository or contact the maintainer.

## Credits

Developed for WooCommerce checkout enhancement. Feel free to modify and improve upon this code.

---
⭐ If you find this useful, please star the repository!
