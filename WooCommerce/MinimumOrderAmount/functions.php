<?php


// Function to add a dynamic message and control the place order button based on minimum order amount
function add_dynamic_place_order_message() {
    // Check if we're on the checkout page, if not, exit the function
    if ( ! is_checkout() ) return;
    
    // Set the minimum order amount in cents/pennies (60000 = $600.00)
    $minimum_order = 60000;
    
    // Start PHP output for JavaScript code
    ?>
    <script type="text/javascript">
    // Wait for jQuery to be ready and use $ safely inside this function
    jQuery(document).ready(function($) {
        
        // Define function to check total and update button/message accordingly
        function updatePlaceOrderButton() {
            // Get the total amount from the order summary, remove $ and commas, convert to float
            var total = parseFloat($('.order-total .amount bdi').text().replace('$', '').replace(',', ''));
            
            // Cache jQuery selectors for performance
            var $placeOrderButton = $('#place_order');
            var $message = $('.order-disabled-message');
            
            // Check if total is less than minimum order amount
            if (total < <?php echo $minimum_order; ?>) {
                // Add class to style the disabled button
                $placeOrderButton.addClass('disable-order-btn');
                // Disable the place order button
                $placeOrderButton.prop('disabled', true);
                
                // If message doesn't exist, add it after the button
                if ($message.length === 0) {
                    // Add message with formatted minimum amount (60000 becomes 60.000,00)
                    $placeOrderButton.after('<p class="order-disabled-message">El monto mínimo de compra es de $<?php echo number_format($minimum_order, 2, ',', '.'); ?></p>');
                }
            } else {
                // If total meets minimum, enable button
                $placeOrderButton.removeClass('disable-order-btn');
                $placeOrderButton.prop('disabled', false);
                // Remove the minimum order message
                $message.remove();
            }
        }
        
        // Run the function when page first loads
        updatePlaceOrderButton();
        
        // Run the function whenever WooCommerce updates the checkout
        // (e.g., when quantities change, coupons applied, etc.)
        $(document.body).on('updated_checkout', updatePlaceOrderButton);
    });
    </script>
    <?php
}

// Hook the function to run before the submit button in the review order section
add_action('woocommerce_review_order_before_submit', 'add_dynamic_place_order_message');



?>
