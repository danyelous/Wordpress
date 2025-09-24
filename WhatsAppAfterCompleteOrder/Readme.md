# WooCommerce WhatsApp Checkout Integration

# I created it with the help of Claude AI and ChatGPT

A WordPress/WooCommerce integration that automatically sends order details to WhatsApp on mobile devices after checkout completion.

## 🚀 Features

- **Mobile-Only Integration**: Automatically detects mobile devices and activates WhatsApp integration
- **Automatic Order Forwarding**: Sends complete order details to WhatsApp after checkout
- **Customizable Phone Number**: Admin setting to configure WhatsApp business number
- **Comprehensive Order Details**: Includes customer info, products, totals, and payment method
- **Two Integration Methods**: Choose between real-time checkout interception or post-checkout redirect

## 📱 How It Works

When a customer completes their order on a mobile device, the system:

1. Detects the mobile device
2. Captures all order information (customer details, products, totals)
3. Formats the data into a structured WhatsApp message
4. Automatically opens WhatsApp with the pre-filled message
5. Allows immediate communication between customer and business

## 🛠️ Installation

### 1. Add to functions.php
Copy the entire code to your active theme's `functions.php` file:

```php
// Add the complete code from the provided file
```

### 2. Configure WhatsApp Number
1. Go to **WordPress Admin → Settings → General**
2. Find the "Número de WhatsApp" field
3. Enter your WhatsApp business number with country code (e.g., `543487363345`)
4. Save changes

### 3. Choose Integration Method
The code provides two integration methods:

**Method 1 (Default)**: Real-time checkout interception
- Activates automatically during checkout process

**Method 2**: Post-checkout page redirect
- Uncomment this line in the code to activate:
```php
add_action('woocommerce_thankyou', 'send_order_to_whatsapp_after_checkout');
```

## ⚙️ Configuration Options

### WhatsApp Number Format
- Include country code (e.g., Argentina: `54`)
- Include area code (e.g., `3487`)
- Include phone number (e.g., `363345`)
- Final format: `543487363345`

### Customization Variables
```php
$whatsapp_number = "543487363345"; // Change this to your number
```

## 📋 Message Format

The WhatsApp message includes:

```
🛒 *Nuevo Pedido desde ABC Motos*

👤 *Datos del Cliente:*
Nombre: [Customer Name]
Email: [Customer Email]
Teléfono: [Customer Phone]
Dirección: [Full Address]
Ciudad: [City]
Código Postal: [Postal Code]
Provincia: [State]

🛍️ *Productos Solicitados:*
• [Product Name] [Quantity] - [Price]

💰 *Total: [Order Total]*

💳 Método de pago: [Payment Method]

📝 *Notas del pedido:*
[Customer Notes if any]

✅ Este pedido también fue registrado en el sistema.
```

## 🔧 Requirements

- **WordPress** 5.0 or higher
- **WooCommerce** 3.0 or higher
- **jQuery** (included with WordPress)
- Mobile device detection (uses `wp_is_mobile()`)

## 📱 Supported Devices

- All mobile devices detected by `wp_is_mobile()`
- Works on iOS Safari, Chrome Mobile, Android browsers
- Desktop users continue with normal checkout flow

## 🎯 Use Cases

Perfect for businesses that want to:
- Provide immediate customer support after purchase
- Confirm orders via WhatsApp
- Handle special delivery instructions
- Offer personalized post-purchase service
- Maintain direct communication with mobile customers

## 🛡️ Security Features

- Mobile device verification
- Proper URL encoding for WhatsApp messages
- Safe data extraction from WooCommerce objects
- XSS protection through proper escaping

## 🔄 Integration Methods Explained

### Method 1: Checkout Interception
```javascript
$('form.checkout').on('checkout_place_order', function() {
    // Intercepts before order completion
    // Opens WhatsApp after 2-second delay
});
```

### Method 2: Post-Checkout Redirect
```php
add_action('woocommerce_thankyou', 'send_order_to_whatsapp_after_checkout');
// Activates on thank you page
// More reliable but slightly delayed
```

## 🎨 Customization

### Change Business Name
```php
var message = "🛒 *Nuevo Pedido desde TU NEGOCIO*\n\n";
```

### Modify Message Format
Edit the `prepareWhatsAppMessage()` function to customize:
- Message structure
- Emojis used
- Information included
- Language/translations

### Add Custom Fields
```php
// Add custom WooCommerce fields to the message
$custom_field = get_post_meta($order_id, 'custom_field_key', true);
$message .= "Custom Info: " . $custom_field . "\n";
```

## 🐛 Troubleshooting

### WhatsApp Not Opening
- Verify WhatsApp is installed on the device
- Check phone number format (include country code)
- Ensure mobile detection is working

### Missing Order Data
- Verify WooCommerce is active and updated
- Check jQuery is loaded on checkout page
- Confirm checkout form selectors match your theme

### Script Not Loading
- Ensure code is in active theme's `functions.php`
- Check for PHP syntax errors
- Verify `is_checkout()` returns true on checkout page

## 🔄 Updates and Maintenance

- Test after WooCommerce updates
- Verify mobile detection accuracy
- Monitor WhatsApp API changes
- Update phone number format if needed

## 📄 License

This code is provided as-is for educational and commercial use. Modify as needed for your specific requirements.

## 🤝 Contributing

Feel free to submit issues, fork the repository, and submit pull requests for improvements.

---

**Note**: This integration is designed specifically for mobile e-commerce experiences and requires WhatsApp to be installed on the customer's device.
