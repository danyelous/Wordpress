<?php


// Add an action hook to 'pre_get_posts', which runs before WordPress retrieves posts
// This allows us to modify the query before posts are fetched
add_action('pre_get_posts', 'hide_out_of_stock_in_search');

// Define the function that will modify the search query to hide out of stock products
function hide_out_of_stock_in_search($query) {
    // Check if the current query is a search query (is_search())
    // AND is the main query (is_main_query()) to avoid affecting other queries
    if($query->is_search() && $query->is_main_query()) {
        // Set the meta_key to '_stock_status', which is WooCommerce's internal 
        // meta field for tracking product stock status
        $query->set('meta_key', '_stock_status');
        
        // Set the meta_value to 'instock' to only show products that are currently in stock
        // This effectively filters out any products that are not in stock
        $query->set('meta_value', 'instock');
    }
}






?>
