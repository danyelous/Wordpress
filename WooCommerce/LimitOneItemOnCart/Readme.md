# WooCommerce Single Item Cart

# I created it with the help of Claude AI and ChatGPT

A WordPress plugin that limits the WooCommerce shopping cart to one item at a time. Perfect for businesses that sell services or products that should be purchased individually.

## 📋 Description

This plugin modifies the standard WooCommerce cart functionality to ensure that only one item can be in the cart at any time. When a new item is added, any existing items are automatically removed, and the customer is notified.

### Features

- Automatically removes previous items when a new item is added
- Displays a user-friendly notice when items are removed
- Prevents quantity modifications in the cart
- Secures against programmatic quantity changes
- Maintains WooCommerce compatibility

## 🚀 Installation

1. Download the plugin files
2. Add the code to your theme's `functions.php` file or in a custom plugin
3. Test the functionality by adding items to your cart

## 🔧 Usage

Once installed, the plugin works automatically. No configuration is needed. When a customer tries to add a second item to their cart:
- The first item will be removed
- The new item will be added
- A notice will inform them about the single-item limitation
- Quantity will be locked to 1

## ⚙️ Technical Details

The plugin uses the following WooCommerce hooks:
- `woocommerce_add_to_cart_validation`
- `woocommerce_add_to_cart`
- `woocommerce_quantity_input_args`
- `woocommerce_add_cart_item_data`

## 📝 Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- PHP 7.2 or higher

## ⚠️ Important Notes

This plugin is ideal for:
- Service-based businesses
- Single-product stores
- Subscription-based products
- Special event tickets
- Any business model requiring individual purchases

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is licensed under the GPL v2 or later.

## 👥 Authors

[Your Name] - Initial work

## 🔄 Changelog

### 1.0.0
- Initial release
- Basic single-item cart functionality
- User notifications
- Quantity control implementation
