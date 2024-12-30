/**
 * Custom implementation for WooCommerce variable products
 * Allows customers to select multiple variations of a product at once
 * and add them to cart simultaneously
 */

// Remove WooCommerce's default variation selection form
remove_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30);

// Add our custom implementation for variation selection
add_action('woocommerce_variable_add_to_cart', 'custom_variable_add_to_cart', 30);

/**
 * Creates a custom form for selecting multiple product variations
 * Displays a table with all available variations and quantity selectors
 */
function custom_variable_add_to_cart() {
    global $product;

    // Only proceed if this is a variable product
    if (!$product->is_type('variable')) return;

    // Get all variations of the product
    $available_variations = $product->get_available_variations();

    // Start building the HTML structure for the variations table
    echo '<div class="multiple-variations-selector">';
    echo '<table class="variations-table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>' . __('Tamaño', 'woocommerce') . '</th>'; // Size column
    echo '<th>' . __('Disponible', 'woocommerce') . '</th>'; // Availability column
    echo '<th>' . __('Cantidad', 'woocommerce') . '</th>'; // Quantity column
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Skip the first variation (appears to be intentional, possibly for design reasons)
    $skip_first = true;

    // Loop through each variation to create table rows
    foreach ($available_variations as $variation) {
        if ($skip_first) {
            $skip_first = false;
            continue;
        }

        $variation_id = $variation['variation_id'];
        $variation_obj = wc_get_product($variation_id);
        $attributes = $variation['attributes'];

        echo '<tr>';
        // Display each attribute (like size, color) for this variation
        foreach ($attributes as $attribute_name => $attribute_value) {
            $attributeTitle = ucfirst($attribute_value);
            if(!($attributeTitle == "")){
                echo '<td>' . ucfirst($attribute_value) . '</td>';
            }
        }

        // Only display the row if there's an attribute title
        if(!($attributeTitle == "")){
            // Show stock status with a colored dot indicator
            echo '<td>';
            if ($variation_obj->is_in_stock()) {
                echo '<span class="stock-status in-stock"></span>';
            } else {
                echo '<span class="stock-status out-of-stock"></span>';
            }
            echo '</td>';

            // Create quantity selector with plus/minus buttons
            echo '<td>';
            echo '<div class="quantity-selector">';
            echo '<button class="minus-btn" data-variation-id="' . $variation_id . '">-</button>';
            echo '<input type="number"
                name="variation_quantity[' . $variation_id . ']"
                value="0"
                min="0"
                max="' . $variation_obj->get_stock_quantity() . '"
                class="variation-quantity"
                data-variation-id="' . $variation_id . '">';
            echo '<button class="plus-btn" data-variation-id="' . $variation_id . '">+</button>';
            echo '</div>';
            echo '</td>';
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';

    // Add to cart button (initially disabled)
    echo '<button type="submit" class="single_add_to_cart_button button alt" disabled>' . __('Add to cart', 'woocommerce') . '</button>';

    echo '</div>';

    // jQuery functionality for handling the interface
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Handle plus/minus button clicks
        $('.plus-btn, .minus-btn').click(function(e) {
            e.preventDefault();
            var $input = $(this).siblings('input.variation-quantity');
            var currentVal = parseInt($input.val());

            // Increment/decrement within limits
            if ($(this).hasClass('plus-btn')) {
                if (currentVal < parseInt($input.attr('max'))) {
                    $input.val(currentVal + 1).trigger('change');
                }
            } else {
                if (currentVal > 0) {
                    $input.val(currentVal - 1).trigger('change');
                }
            }
        });

        // Update add to cart button state when quantities change
        $('.variation-quantity').change(function() {
            updateAddToCartButton();
        });

        // Enable/disable add to cart button based on quantities
        function updateAddToCartButton() {
            var hasQuantity = false;
            $('.variation-quantity').each(function() {
                if (parseInt($(this).val()) > 0) {
                    hasQuantity = true;
                    return false;
                }
            });

            $('.single_add_to_cart_button').prop('disabled', !hasQuantity);
        }

        // Handle add to cart button click
        $('.single_add_to_cart_button').click(function(e) {
            e.preventDefault();

            // Prepare data for AJAX request
            var data = {
                action: 'add_multiple_variations_to_cart',
                product_id: <?php echo $product->get_id(); ?>,
                variation_quantities: {}
            };

            // Collect all non-zero quantities
            $('.variation-quantity').each(function() {
                var quantity = parseInt($(this).val());
                if (quantity > 0) {
                    data.variation_quantities[$(this).data('variation-id')] = quantity;
                }
            });

            // Send AJAX request to add items to cart
            $.post(wc_add_to_cart_params.ajax_url, data, function(response) {
                if (response.success) {
                    window.location.href = wc_add_to_cart_params.cart_url;
                }
            });
        });
    });
    </script>
    <?php
}

/**
 * AJAX handler for adding multiple variations to cart
 * Processes the AJAX request sent when adding items to cart
 */
add_action('wp_ajax_add_multiple_variations_to_cart', 'handle_multiple_variations_add_to_cart');
add_action('wp_ajax_nopriv_add_multiple_variations_to_cart', 'handle_multiple_variations_add_to_cart');
function handle_multiple_variations_add_to_cart() {
    $quantities = $_POST['variation_quantities'];
    $product_id = $_POST['product_id'];

    // Add each selected variation to cart
    foreach ($quantities as $variation_id => $quantity) {
        if ($quantity > 0) {
            WC()->cart->add_to_cart($product_id, $quantity, $variation_id);
        }
    }

    wp_send_json_success();
}

/**
 * Add custom CSS styles for the variations interface
 */
add_action('wp_head', 'add_multiple_variations_styles');
function add_multiple_variations_styles() {
    ?>
    <style>
    /* Container styles */
    .multiple-variations-selector {
        margin: 20px 0;
    }
    
    /* Table styles */
    .variations-table {
        width: 100%;
        border-collapse: collapse;
    }
    .variations-table th,
    .variations-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    
    /* Quantity selector styles */
    .quantity-selector {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .quantity-selector input {
        width: 50px;
        text-align: center;
        margin: 0 5px;
    }
    
    /* Stock status indicator styles */
    .stock-status {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    .stock-status.in-stock {
        background: #7ad03a;
    }
    .stock-status.out-of-stock {
        background: #a44;
    }
    </style>
    <?php
}
