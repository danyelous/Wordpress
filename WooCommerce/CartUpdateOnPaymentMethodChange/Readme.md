# WooCommerce Automatic Checkout Update

# I created it with the help of Claude AI and ChatGPT

## Description

Automatically updates the WooCommerce checkout when a customer changes payment methods, recalculating totals and ensuring a smooth checkout experience.

## Features

- Dynamically updates checkout on payment method change
- Lightweight JavaScript implementation
- Improves user experience during checkout

## Installation

1. Add to theme's `functions.php`
2. Ensure jQuery is loaded (WooCommerce typically handles this)

```php
add_action('wp_footer', 'custom_payment_method_js');
function custom_payment_method_js() {
    if (is_checkout()) {
        ?>
        <script type="text/javascript">
        jQuery(function($){
            $('form.checkout').on('change', 'input[name^="payment_method"]', function() {
                $('body').trigger('update_checkout');
            });
        });
        </script>
        <?php
    }
}
```

## Compatibility

- WordPress: 4.0+
- WooCommerce: 3.0+
- PHP: 5.6+
- jQuery: Required

## How It Works

- Listens for payment method changes
- Triggers WooCommerce's native checkout update
- Recalculates cart totals automatically

## Potential Improvements

- Add error handling
- Create more complex checkout logic if needed

## Support

[Open an issue](https://github.com/yourusername/your-repo/issues)

## License

[MIT License](LICENSE)
