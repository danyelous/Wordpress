<?php

// This code should be added to your WordPress theme's functions.php file

// Add an action to the 'pre_get_posts' hook
add_action('pre_get_posts', 'hide_out_of_stock_in_search');

// Define the function to hide out of stock products in search results
function hide_out_of_stock_in_search($query) {
    // Check if the current query is a search query and is the main query
    if($query->is_search() && $query->is_main_query()) {
        // Set the meta_key to '_stock_status' to filter by the stock status meta field
        $query->set('meta_key', '_stock_status');
        
        // Set the meta_value to 'instock' to only show products that are in stock
        $query->set('meta_value', 'instock');
    }
}


?>
