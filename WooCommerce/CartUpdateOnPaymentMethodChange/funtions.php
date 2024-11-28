<?php

// Hook into WordPress footer to add custom JavaScript
// This ensures the script is added only on the frontend
add_action('wp_footer', 'custom_payment_method_js');

/**
 * Add JavaScript to automatically update cart when payment method changes
 * This improves user experience during WooCommerce checkout
 */
function custom_payment_method_js() {
    // Check if current page is the checkout page
    if (is_checkout()) {
        ?>
        <script type="text/javascript">
        jQuery(function($){
            // Listen for changes on payment method radio buttons
            $('form.checkout').on('change', 'input[name^="payment_method"]', function() {
                // Trigger WooCommerce's built-in checkout update method
                // This recalculates totals, shipping, etc. when payment method changes
                $('body').trigger('update_checkout');
            });
        });
        </script>
        <?php
    }
}


?>
