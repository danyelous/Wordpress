

// Agregar esta función al archivo functions.php de tu tema

// Función para detectar si es móvil
function is_mobile_device() {
    return wp_is_mobile();
}

// Agregar JavaScript para interceptar el botón de Place Order en móviles
function add_whatsapp_checkout_script() {
    // Solo cargar en la página de checkout
    if (!is_checkout()) {
        return;
    }

    // Solo para dispositivos móviles
    if (!is_mobile_device()) {
        return;
    }

    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Interceptar el evento de envío del formulario de checkout
        $('form.checkout').on('checkout_place_order', function() {
            // Preparar datos para WhatsApp
            var whatsappMessage = prepareWhatsAppMessage();

            // Abrir WhatsApp después de un pequeño delay para permitir que se procese el pedido
            setTimeout(function() {
                var whatsappUrl = 'https://wa.me/543487363345?text=' + encodeURIComponent(whatsappMessage);
                // Crear un enlace temporal y hacer clic en él para forzar la apertura en nueva pestaña
                var tempLink = document.createElement('a');
                tempLink.href = whatsappUrl;
                tempLink.target = '_blank';
                tempLink.rel = 'noopener noreferrer';
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);
            }, 2000);

            // Continuar con el proceso normal del checkout
            return true;
        });

        function prepareWhatsAppMessage() {
            var message = "🛒 *Nuevo Pedido desde ABC Motos*\n\n";

            // Datos del cliente
            message += "👤 *Datos del Cliente:*\n";
            message += "Nombre: " + $('#billing_first_name').val() + " " + $('#billing_last_name').val() + "\n";
            message += "Email: " + $('#billing_email').val() + "\n";
            message += "Teléfono: " + $('#billing_phone').val() + "\n";

            // Dirección
            var address = $('#billing_address_1').val();
            if ($('#billing_address_2').val()) {
                address += ", " + $('#billing_address_2').val();
            }
            message += "Dirección: " + address + "\n";
            message += "Ciudad: " + $('#billing_city').val() + "\n";
            message += "Código Postal: " + $('#billing_postcode').val() + "\n";
            message += "Provincia: " + $('#billing_state').val() + "\n\n";

            // Productos del carrito
            message += "🛍️ *Productos Solicitados:*\n";

            $('.woocommerce-checkout-review-order-table .cart_item').each(function() {
                var productName = $(this).find('.product-name').text().trim();
                var quantity = $(this).find('.product-quantity').text().trim();
                var price = $(this).find('.product-total').text().trim();

                message += "• " + productName + " " + quantity + " - " + price + "\n";
            });

            // Total
            var total = $('.order-total .woocommerce-Price-amount').text().trim();
            message += "\n💰 *Total: " + total + "*\n\n";

            // Método de pago
            var paymentMethod = $('input[name="payment_method"]:checked').next('label').text().trim();
            if (paymentMethod) {
                message += "💳 Método de pago: " + paymentMethod + "\n\n";
            }

            // Notas adicionales
            var orderNotes = $('#order_comments').val();
            if (orderNotes) {
                message += "📝 *Notas del pedido:*\n" + orderNotes + "\n\n";
            }

            message += "✅ Este pedido también fue registrado en el sistema.";

            return message;
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'add_whatsapp_checkout_script');

// Función alternativa usando el hook después de completar el pedido
function send_order_to_whatsapp_after_checkout($order_id) {
    // Solo para móviles
    if (!is_mobile_device()) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    // Preparar mensaje de WhatsApp
    $message = "🛒 *Pedido Confirmado - ABC Motos*\n\n";
    $message .= "📋 *Número de Pedido:* #" . $order->get_order_number() . "\n\n";

    // Datos del cliente
    $message .= "👤 *Datos del Cliente:*\n";
    $message .= "Nombre: " . $order->get_billing_first_name() . " " . $order->get_billing_last_name() . "\n";
    $message .= "Email: " . $order->get_billing_email() . "\n";
    $message .= "Teléfono: " . $order->get_billing_phone() . "\n";

    // Dirección
    $message .= "Dirección: " . $order->get_billing_address_1();
    if ($order->get_billing_address_2()) {
        $message .= ", " . $order->get_billing_address_2();
    }
    $message .= "\n";
    $message .= "Ciudad: " . $order->get_billing_city() . "\n";
    $message .= "Código Postal: " . $order->get_billing_postcode() . "\n";
    $message .= "Provincia: " . $order->get_billing_state() . "\n\n";

    // Productos
    $message .= "🛍️ *Productos:*\n";
    foreach ($order->get_items() as $item) {
        $product_name = $item->get_name();
        $quantity = $item->get_quantity();
        $total = $item->get_total();
        $message .= "• " . $product_name . " (x" . $quantity . ") - $" . number_format($total, 2) . "\n";
    }

    // Total
    $message .= "\n💰 *Total: $" . number_format($order->get_total(), 2) . "*\n\n";

    // Método de pago
    $message .= "💳 Método de pago: " . $order->get_payment_method_title() . "\n\n";

    // Notas del pedido
    if ($order->get_customer_note()) {
        $message .= "📝 *Notas:* " . $order->get_customer_note() . "\n\n";
    }

    $message .= "✅ Pedido procesado correctamente en nuestro sistema.";

    // Crear URL de WhatsApp
    $whatsapp_number = "543487363345"; // Tu número de WhatsApp
    $whatsapp_url = "https://wa.me/" . $whatsapp_number . "?text=" . urlencode($message);

    // Agregar JavaScript para redirigir a WhatsApp
    ?>
    <script type="text/javascript">
        window.onload = function() {
            setTimeout(function() {
                // Crear un enlace temporal y hacer clic en él para forzar la apertura
                var tempLink = document.createElement('a');
                tempLink.href = '<?php echo $whatsapp_url; ?>';
                tempLink.target = '_blank';
                tempLink.rel = 'noopener noreferrer';
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);
            }, 1000);
        };
    </script>
    <?php
}

// Activar el hook después de que se complete el checkout (método alternativo)
// Descomenta la siguiente línea si prefieres usar este método en lugar del anterior
// add_action('woocommerce_thankyou', 'send_order_to_whatsapp_after_checkout');

// Función para personalizar el número de WhatsApp desde el admin
function add_whatsapp_settings_field() {
    add_settings_field(
        'whatsapp_number',
        'Número de WhatsApp',
        'whatsapp_number_callback',
        'general'
    );
    register_setting('general', 'whatsapp_number');
}
add_action('admin_init', 'add_whatsapp_settings_field');

function whatsapp_number_callback() {
    $whatsapp_number = get_option('whatsapp_number', '543487363345');
    echo '<input type="text" id="whatsapp_number" name="whatsapp_number" value="' . $whatsapp_number . '" class="regular-text" />';
    echo '<p class="description">Ingresa el número de WhatsApp con código de país (ej: 543487363345)</p>';
}
