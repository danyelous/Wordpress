<?php
// Agregar esta función al archivo functions.php de tu tema

// Función para detectar si es móvil
function is_mobile_device() {
    return wp_is_mobile();
}

// OPCIÓN 1: Redirección directa después del checkout exitoso
function redirect_to_whatsapp_after_checkout($order_id) {
    // Solo para móviles (opcional - quita esta condición si quieres que funcione en desktop también)
    if (!is_mobile_device()) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    // Obtener número de WhatsApp desde configuración
    $whatsapp_number = get_option('whatsapp_number', '543487639522');

    // Preparar mensaje de WhatsApp
    $message = "🛒 *Pedido Confirmado - Nicasio*\n\n";
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
    $whatsapp_url = "https://wa.me/" . $whatsapp_number . "?text=" . urlencode($message);

    // Guardar URL en sesión para usar en JavaScript
    WC()->session->set('whatsapp_redirect_url', $whatsapp_url);
}
add_action('woocommerce_thankyou', 'redirect_to_whatsapp_after_checkout');

// Agregar JavaScript para redirección automática en la página de agradecimiento
function add_whatsapp_redirect_script() {
    // Solo en la página de agradecimiento después del checkout
    if (!is_wc_endpoint_url('order-received')) {
        return;
    }

    $whatsapp_url = WC()->session->get('whatsapp_redirect_url');
    if (!$whatsapp_url) {
        return;
    }

    // Limpiar la sesión
    WC()->session->__unset('whatsapp_redirect_url');

    ?>
    <script type="text/javascript">
        // Opción A: Redirección automática después de 3 segundos
        setTimeout(function() {
            window.location.href = '<?php echo esc_js($whatsapp_url); ?>';
        }, 3000);

        // Opción B: Mostrar un botón para ir a WhatsApp (descomenta si prefieres esta opción)
        /*
        document.addEventListener('DOMContentLoaded', function() {
            var whatsappButton = document.createElement('div');
            whatsappButton.innerHTML = `
                <div style="text-align: center; margin: 20px 0; padding: 20px; background: #25d366; border-radius: 10px;">
                    <h3 style="color: white; margin: 0 0 15px 0;">¡Pedido Confirmado!</h3>
                    <p style="color: white; margin: 0 0 15px 0;">Tu pedido ha sido registrado. Ahora serás redirigido a WhatsApp para finalizar la coordinación.</p>
                    <a href="<?php echo esc_js($whatsapp_url); ?>" 
                       style="background: white; color: #25d366; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                        📱 Continuar en WhatsApp
                    </a>
                </div>
            `;
            
            // Insertar el botón al principio del contenido
            var orderReceived = document.querySelector('.woocommerce-order-received');
            if (orderReceived) {
                orderReceived.insertBefore(whatsappButton, orderReceived.firstChild);
            }
        });
        */
    </script>
    
    <style>
        /* Opcional: Agregar un contador visual */
        .whatsapp-redirect-counter {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #25d366;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: bold;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    </style>
    
    <div class="whatsapp-redirect-counter">
        Redirigiendo a WhatsApp en <span id="countdown">3</span> segundos...
    </div>
    
    <script>
        // Contador visual
        var timeLeft = 3;
        var countdownElement = document.getElementById('countdown');
        
        var timer = setInterval(function() {
            timeLeft--;
            if (countdownElement) {
                countdownElement.textContent = timeLeft;
            }
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                var counter = document.querySelector('.whatsapp-redirect-counter');
                if (counter) {
                    counter.style.display = 'none';
                }
            }
        }, 1000);
    </script>
    <?php
}
add_action('wp_footer', 'add_whatsapp_redirect_script');

// OPCIÓN 2: Redirección usando wp_redirect (más limpia)
function whatsapp_redirect_with_wp_redirect($order_id) {
    // Solo para móviles (opcional)
    if (!is_mobile_device()) {
        return;
    }

    // Solo ejecutar una vez y evitar bucles
    if (get_transient('whatsapp_redirect_' . $order_id)) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    // Marcar como procesado
    set_transient('whatsapp_redirect_' . $order_id, true, 300); // 5 minutos

    $whatsapp_number = get_option('whatsapp_number', '543487639522');

    // Preparar mensaje (mismo código que arriba)
    $message = "🛒 *Pedido Confirmado - Nicasio*\n\n";
    $message .= "📋 *Número de Pedido:* #" . $order->get_order_number() . "\n\n";
    
    // ... resto del mensaje igual que arriba ...
    
    // Crear URL de WhatsApp
    $whatsapp_url = "https://wa.me/" . $whatsapp_number . "?text=" . urlencode($message);

    // Redirección directa (descomenta si quieres usar este método)
    // wp_redirect($whatsapp_url);
    // exit;
}
// Descomenta la siguiente línea si quieres usar wp_redirect en lugar del JavaScript
// add_action('woocommerce_thankyou', 'whatsapp_redirect_with_wp_redirect');

// OPCIÓN 3: Agregar botón prominente en página de agradecimiento
function add_whatsapp_button_to_thankyou_page($order_id) {
    if (!is_mobile_device()) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    $whatsapp_number = get_option('whatsapp_number', '543487639522');
    
    // Preparar mensaje simplificado
    $message = "🛒 Hola! Mi pedido #" . $order->get_order_number() . " de Nicasio fue confirmado. Total: $" . number_format($order->get_total(), 2);
    
    $whatsapp_url = "https://wa.me/" . $whatsapp_number . "?text=" . urlencode($message);

    echo '<div style="text-align: center; margin: 30px 0; padding: 25px; background: linear-gradient(135deg, #25d366, #128c7e); border-radius: 15px; box-shadow: 0 8px 16px rgba(0,0,0,0.2);">';
    echo '<h2 style="color: white; margin: 0 0 15px 0;">¡Pedido Confirmado! 🎉</h2>';
    echo '<p style="color: white; margin: 0 0 20px 0; font-size: 16px;">Tu pedido ha sido registrado correctamente. Continúa la conversación en WhatsApp para coordinar la entrega.</p>';
    echo '<a href="' . esc_url($whatsapp_url) . '" style="background: white; color: #25d366; padding: 18px 35px; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 18px; display: inline-block; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'">';
    echo '📱 Continuar en WhatsApp';
    echo '</a>';
    echo '</div>';
}
add_action('woocommerce_thankyou', 'add_whatsapp_button_to_thankyou_page', 20);

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
    $whatsapp_number = get_option('whatsapp_number', '543487639522');
    echo '<input type="text" id="whatsapp_number" name="whatsapp_number" value="' . $whatsapp_number . '" class="regular-text" />';
    echo '<p class="description">Ingresa el número de WhatsApp con código de país (ej: 543487639522)</p>';
}

// FUNCIÓN ADICIONAL: Limpiar transients antiguos
function cleanup_whatsapp_transients() {
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_whatsapp_redirect_%' OR option_name LIKE '_transient_timeout_whatsapp_redirect_%'");
}
// Ejecutar limpieza diariamente
add_action('wp_scheduled_delete', 'cleanup_whatsapp_transients');
?>
