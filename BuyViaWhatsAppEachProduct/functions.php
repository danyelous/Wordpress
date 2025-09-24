
// Función para agregar el botón de WhatsApp en la página del producto
function agregar_boton_whatsapp_producto() {
    global $product;

    // Verificar que estamos en una página de producto individual
    if (!is_product() || !$product) {
        return;
    }

    // Número de WhatsApp (cambiar por tu número)
    $numero_whatsapp = '543487363345';

    // Obtener datos del producto
    $nombre_producto = $product->get_name();
    $url_producto = get_permalink($product->get_id());

    // Obtener precio limpio sin HTML ni entidades
    $precio_numerico = $product->get_price();
    $precio_formateado = '$' . number_format($precio_numerico, 0, ',', '.');

    // Crear el mensaje personalizado
    $mensaje = sprintf(
        "Hola! Estoy interesado en este producto:\n\n" .
        "️ *%s*\n " .
        " Precio: %s\n" .
        " %s\n\n " .
        "¿Podes darme más información?",
        $nombre_producto,
        $precio_formateado,
        $url_producto
    );

    // Codificar el mensaje para URL
    $mensaje_codificado = urlencode($mensaje);

    // Crear la URL de WhatsApp
    $url_whatsapp = "https://wa.me/{$numero_whatsapp}?text={$mensaje_codificado}";

    // HTML del botón
    echo '<div class="whatsapp-button-container" style="margin-top: 15px;">';
    echo '<a href="' . esc_url($url_whatsapp) . '" target="_blank" class="whatsapp-button" style="
        display: inline-block;
        background-color: #25d366;
        color: white;
        padding: 12px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
        transition: background-color 0.3s ease;
    " onmouseover="this.style.backgroundColor=\'#1da851\'" onmouseout="this.style.backgroundColor=\'#25d366\'">
        <img src="https://abcmotos.com.ar/wp-content/uploads/2024/08/whatsapp.png" width="32px"> Comprar por WhatsApp
    </a>';
    echo '</div>';
}

// Hook para mostrar el botón después del formulario de agregar al carrito
add_action('woocommerce_single_product_summary', 'agregar_boton_whatsapp_producto', 35);

// CSS adicional para el botón (opcional, para mejores estilos)
function whatsapp_button_styles() {
    if (is_product()) {
        ?>
        <style>
        .whatsapp-button:hover {
            background-color: #1da851 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(37, 211, 102, 0.3);
        }

        .whatsapp-button {
            transition: all 0.3s ease !important;
        }

        @media (max-width: 768px) {
            .whatsapp-button {
                font-size: 16px;
                padding: 15px 20px;
            }
        }
        </style>
        <?php
    }
}
add_action('wp_head', 'whatsapp_button_styles');
