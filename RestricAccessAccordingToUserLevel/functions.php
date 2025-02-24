function restrict_menu_items_for_subscribers($items, $menu, $args) {
    // Get the current user's role
    $user = wp_get_current_user();
    $allowed_roles = ['administrator', 'editor'];

    // Log the current user's roles
    error_log('Current user roles: ' . print_r($user->roles, true));

    // Check if the user is an administrator or editor
    if (array_intersect($allowed_roles, $user->roles)) {
        error_log('User is admin or editor. Returning all items.');
        return $items; // Return all menu items for admins and editors
    }

    // For subscribers, allow only specific menu items
    if (in_array('subscriber', $user->roles)) {
        $allowed_items = ['178', '71']; // We'll check against menu item IDs
        $filtered_items = array();

        error_log('Processing menu items for subscriber. Total items: ' . count($items));

        foreach ($items as $item) {
            error_log('Checking menu item: ID=' . $item->ID . ', Title=' . $item->title);

            if (in_array($item->ID, $allowed_items)) {
                $filtered_items[] = $item;
                error_log('Added item to filtered list: ID=' . $item->ID . ', Title=' . $item->title);
            }
        }

        error_log('Filtered menu items for subscriber: ' . print_r($filtered_items, true));

        return $filtered_items;
    }

    error_log('User is neither admin, editor, nor subscriber. Returning all items.');
    return $items;
}
add_filter('wp_get_nav_menu_items', 'restrict_menu_items_for_subscribers', 10, 3);










//bloquea el acceso a paginas segun tipo de usuario
function restrict_subscriber_access() {
    // Check if the current user is a subscriber
    if (current_user_can('subscriber')) {
        global $post;

        // Get the current page ID
        $current_page_id = $post->ID;

        // Define the allowed page IDs
        $allowed_page_ids = array(176);

        // If the current page is not in the allowed list, redirect to homepage or a specific page
        if (!in_array($current_page_id, $allowed_page_ids)) {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('template_redirect', 'restrict_subscriber_access');
