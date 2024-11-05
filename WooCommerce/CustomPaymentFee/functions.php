<?php

// Add a surcharge percentage when payment is made via Mercado Pago
add_action('woocommerce_cart_calculate_fees', 'custom_payment_gateway_fee', 20, 1);

// Main function to calculate and apply the fee
function custom_payment_gateway_fee($cart) {
    // Skip if we're in admin panel and not processing AJAX
    if (is_admin() && !defined('DOING_AJAX')) return;
    
    // Note: Following line was removed to allow recalculation at each step
    // if (did_action('woocommerce_cart_calculate_fees') >= 2) return;
    
    // Get the payment method chosen by the customer
    $chosen_gateway = WC()->session->get('chosen_payment_method');
    
    // Define the target Mercado Pago payment method IDs
    $target_gateway1 = 'woo-mercado-pago-basic';    // Regular Mercado Pago
    $target_gateway2 = 'woo-mercado-pago-credits';  // Mercado Pago Credits
    
    // Check if either Mercado Pago payment method is selected
    if ($chosen_gateway === $target_gateway1 || $chosen_gateway === $target_gateway2) {
        $percentage = 0.25;  // Set surcharge to 25%
        
        // Calculate the surcharge amount based on cart subtotal
        $surcharge = $cart->subtotal * $percentage;
        
        // Add the fee to the cart with label 'Recarga por Mercado Pago'
        $cart->add_fee(__('Recarga por Mercado Pago', 'woocommerce'), $surcharge, true);
    }
}

// Add action to ensure totals are recalculated when payment method changes
add_action('woocommerce_checkout_update_order_review', 'refresh_checkout_on_payment_methods_change');

// Function to force cart totals recalculation
function refresh_checkout_on_payment_methods_change($post_data) {
    WC()->cart->calculate_totals();
}



?>
