
// Código actualizado que usa la configuración del plugin
add_action('woocommerce_single_product_summary', 'show_installments_after_price', 11);
add_action('woocommerce_after_shop_loop_item_title', 'show_installments_after_price', 11);

function show_installments_after_price() {
    global $product;
    // Verificar que el producto tenga precio y no sea de la categoría discontinuo
    if (!$product || !$product->get_price() || has_term(222, 'product_cat', $product->get_id())) {
        return;
    }
    $price = $product->get_price();

    // CAMBIO: Usar funciones del plugin en lugar de valores fijos
    $price_with_interest = $price * abc_get_interest_multiplier(); // Era: * 1.20
    $installment = $price_with_interest / abc_get_installments_number(); // Era: / 3

    $installment_formatted = wc_price($installment);
    $cuotas_numero = abc_get_installments_number(); // Era: 3

    echo '<div class="cuotas-info">
            <span >💳 ' . $cuotas_numero . ' cuotas de ' . $installment_formatted . '</span>
          </div>';
}

// JavaScript para página de inicio - ACTUALIZADO
add_action('wp_footer', 'add_installments_homepage_js');

function add_installments_homepage_js() {
    if (!is_front_page()) {
        return;
    }

    // CAMBIO: Obtener valores de la configuración
    $interest_multiplier = abc_get_interest_multiplier(); // Era: 1.20
    $installments_number = abc_get_installments_number(); // Era: 3
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('.woocommerce-Price-amount').each(function() {
            var priceText = $(this).text();
            var priceNumber = parseFloat(priceText.replace(/[^0-9.,]/g, '').replace(',', '.'));

            if (priceNumber > 0) {
                var installment = (priceNumber * <?php echo $interest_multiplier; ?>) / <?php echo $installments_number; ?>;
                var installmentFormatted = '$' + installment.toFixed(2);

                if (!$(this).next('.installments-info-homepage').length) {
                    $(this).after('<div class="installments-info-homepage"><span>💳 <?php echo $installments_number; ?> cuotas de ' + installmentFormatted + '</span></div>');
                }
            }
        });
    });
    </script>
    <?php
}

// Carrito - ACTUALIZADO
add_action('woocommerce_cart_totals_after_order_total', 'show_cart_installments');
add_action('woocommerce_review_order_after_order_total', 'show_cart_installments');

function show_cart_installments() {
    if (is_admin()) return;

    $cart_total = WC()->cart->get_total('');
    $cart_total_numeric = floatval(preg_replace('/[^0-9.,]/', '', str_replace(',', '.', $cart_total)));

    if ($cart_total_numeric > 0) {
        // CAMBIO: Usar funciones del plugin
        $installment = ($cart_total_numeric * abc_get_interest_multiplier()) / abc_get_installments_number();
        $installment_formatted = wc_price($installment);
        $cuotas_numero = abc_get_installments_number();

        echo '<tr class="cart-installments">
                <th>💳 Pago en cuotas:</th>
                <td><strong>' . $cuotas_numero . ' cuotas de ' . $installment_formatted . '</strong></td>
              </tr>';
    }
}
