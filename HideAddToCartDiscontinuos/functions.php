// Ocultar botón "Añadir al carrito" para productos discontinuos
add_action('init', 'remove_add_to_cart_discontinued_products');

function remove_add_to_cart_discontinued_products() {
    // Para páginas de producto individual
    add_action('woocommerce_single_product_summary', 'check_discontinued_single_product', 25);

    // Para páginas de catálogo/tienda
    add_filter('woocommerce_loop_add_to_cart_link', 'remove_add_to_cart_link_discontinued', 10, 2);
}

function check_discontinued_single_product() {
    global $product;

    if (has_term(222, 'product_cat', $product->get_id())) {
        // Remover el botón de añadir al carrito
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

        // Mostrar mensaje personalizado
        echo '<div class="discontinued-notice" style="background: #f7f7f7; padding: 15px; margin: 15px 0; border-left: 4px solid #ff6b35; border-radius: 4px;">
                <strong style="color: #ff6b35;">⚠️ Producto Discontinuo</strong><br>
                <span style="color: #666;">Este producto ya no está disponible. Contáctanos para consultar alternativas.</span>
              </div>';
    }
}

function remove_add_to_cart_link_discontinued($button, $product) {
    if (has_term(222, 'product_cat', $product->get_id())) {
        return '<span class="discontinued-product" style="background: #f0f0f0; padding: 8px 12px; border-radius: 4px; color: #666; font-size: 12px;">Producto Discontinuo</span>';
    }
    return $button;
}
