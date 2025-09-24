# WooCommerce WhatsApp Product Button

# I created it with the help of Claude AI and ChatGPT

A WordPress/WooCommerce plugin that adds a "Buy via WhatsApp" button to individual product pages, allowing customers to inquire about products directly through WhatsApp.

## 🚀 Features

- **Product Page Integration**: Automatically adds WhatsApp button to all WooCommerce product pages
- **Auto-Generated Messages**: Creates personalized messages with product name, price, and URL
- **Responsive Design**: Mobile-optimized button with hover effects
- **Customizable Styling**: Clean, professional button design with CSS animations
- **Easy Configuration**: Simple phone number setup
- **Direct Communication**: Opens WhatsApp with pre-filled product inquiry message

## 📱 How It Works

When a customer visits a product page:

1. The WhatsApp button appears below the "Add to Cart" form
2. Customer clicks the WhatsApp button
3. WhatsApp opens (web or app) with a pre-filled message containing:
   - Product name
   - Product price
   - Product URL
   - Friendly inquiry message
4. Customer can send the message directly to your business

## 🛠️ Installation

### 1. Add to functions.php
Copy the entire code to your active theme's `functions.php` file:

```php
// Add the complete code from the provided file
```

### 2. Configure Your WhatsApp Number
Edit this line in the code:
```php
$numero_whatsapp = '543487363345'; // Replace with your WhatsApp number
```

### 3. Update WhatsApp Icon (Optional)
Replace the icon URL with your own:
```php
<img src="https://abcmotos.com.ar/wp-content/uploads/2024/08/whatsapp.png" width="32px">
```

## ⚙️ Configuration

### WhatsApp Number Format
Use international format without spaces or special characters:
- **Argentina**: `543487363345`
- **Mexico**: `525512345678`
- **Spain**: `34612345678`
- **USA**: `15551234567`

### Button Position
The button appears after the Add to Cart form using priority `35`:
```php
add_action('woocommerce_single_product_summary', 'agregar_boton_whatsapp_producto', 35);
```

**Available positions:**
- `5` - After title
- `10` - After price
- `20` - After excerpt
- `30` - After Add to Cart form
- `35` - **Current position (recommended)**
- `40` - After product meta

## 📋 Message Template

The default WhatsApp message format:

```
Hola! Estoy interesado en este producto:

🛍️ *[Product Name]*
💰 Precio: [Formatted Price]
🔗 [Product URL]

¿Podes darme más información?
```

### Example Message:
```
Hola! Estoy interesado en este producto:

🛍️ *Yamaha FZ-25*
💰 Precio: $850.000
🔗 https://abcmotos.com.ar/producto/yamaha-fz25

¿Podes darme más información?
```

## 🎨 Styling and Appearance

### Button Design
- **Background**: WhatsApp green (#25d366)
- **Hover Effect**: Darker green (#1da851)
- **Full Width**: 100% width on product page
- **Responsive**: Larger on mobile devices
- **Animation**: Smooth hover transitions

### CSS Classes
```css
.whatsapp-button-container  /* Container wrapper */
.whatsapp-button           /* Main button class */
```

## 🔧 Requirements

- **WordPress** 5.0 or higher
- **WooCommerce** 3.0 or higher
- Active theme with `functions.php` access
- WhatsApp Business or Personal account

## 🎯 Use Cases

Perfect for businesses that want to:
- Provide personalized customer service
- Handle custom product inquiries
- Offer negotiated pricing
- Process orders outside the standard cart
- Build direct customer relationships
- Support customers who prefer WhatsApp communication

## 🛡️ Security Features

- Proper URL escaping with `esc_url()`
- Safe message encoding with `urlencode()`
- WooCommerce object validation
- Product page verification

## 🎨 Customization Options

### 1. Change Button Text
```php
echo '<img src="..." width="32px"> Tu Texto Aquí
```

### 2. Modify Message Template
```php
$mensaje = sprintf(
    "Tu mensaje personalizado:\n\n" .
    "Producto: *%s*\n" .
    "Precio: %s\n" .
    "%s",
    $nombre_producto,
    $precio_formateado,
    $url_producto
);
```

### 3. Custom Styling
Add your own CSS:
```css
.whatsapp-button {
    background-color: #your-color !important;
    border-radius: 25px;
    font-size: 18px;
}
```

### 4. Change Button Position
Modify the priority number:
```php
add_action('woocommerce_single_product_summary', 'agregar_boton_whatsapp_producto', 25);
```

### 5. Add Product Categories Filter
```php
function agregar_boton_whatsapp_producto() {
    global $product;
    
    // Only show for specific categories
    if (!has_term('motorcycles', 'product_cat', $product->get_id())) {
        return;
    }
    
    // Rest of the function...
}
```

## 📱 Mobile Optimization

The button automatically adjusts for mobile devices:
- Larger padding (15px vs 12px)
- Increased font size (16px)
- Touch-friendly dimensions
- Responsive full-width design

## 🐛 Troubleshooting

### Button Not Appearing
- Verify the code is in the active theme's `functions.php`
- Check that you're on a single product page (`is_product()`)
- Ensure WooCommerce is active and products exist

### WhatsApp Not Opening
- Verify phone number format (no spaces, include country code)
- Check that WhatsApp is installed on the device
- Test the generated URL manually

### Styling Issues
- Check for CSS conflicts with your theme
- Verify the CSS is loading (`wp_head` action)
- Use browser developer tools to debug styles

### Message Encoding Problems
- Ensure special characters are properly encoded
- Test with simple messages first
- Check `urlencode()` function is working

## 🔄 Advanced Features

### Multi-Language Support
```php
$mensaje = sprintf(
    __("Hello! I'm interested in this product:\n\n🛍️ *%s*\n💰 Price: %s\n🔗 %s\n\nCan you give me more information?", 'textdomain'),
    $nombre_producto,
    $precio_formateado,
    $url_producto
);
```

### Product Variations Support
```php
if ($product->is_type('variable')) {
    $mensaje .= "\n\nI'd like to know about available variations.";
}
```

### Stock Status Integration
```php
if (!$product->is_in_stock()) {
    $mensaje .= "\n\nI noticed it's out of stock. When will it be available?";
}
```

## 📊 Analytics Tracking

Add Google Analytics tracking:
```php
echo '<a href="' . esc_url($url_whatsapp) . '" 
      target="_blank" 
      class="whatsapp-button"
      onclick="gtag(\'event\', \'whatsapp_click\', {\'product_name\': \'' . $nombre_producto . '\'});">';
```

## 🔄 Updates and Maintenance

- Test after WooCommerce updates
- Verify WhatsApp URL format changes
- Update phone number when needed
- Monitor message delivery rates
- Check mobile compatibility regularly

## 📄 License

This code is provided as-is for educational and commercial use. Modify as needed for your specific requirements.

## 🤝 Contributing

Feel free to submit issues, fork the repository, and submit pull requests for improvements.

---

**Note**: This integration creates a seamless bridge between your WooCommerce store and WhatsApp Business communication, perfect for businesses that prioritize direct customer interaction.
