// This filter modifies the available REST API endpoints
add_filter( 'rest_endpoints', 'disable_default_endpoints' );

/**
 * Removes access to specified WordPress REST API endpoints for non-logged-in users
 * 
 * @param array $endpoints List of all registered REST API endpoints
 * @return array Modified endpoints list
 */
function disable_default_endpoints( $endpoints ) {
    // List of endpoint paths to disable
    $endpoints_to_remove = array(
        '/oembed/1.0',          // oEmbed functionality
        '/wp/v2',               // Base v2 API
        '/wp/v2/media',         // Media library
        '/wp/v2/types',         // Post types
        '/wp/v2/statuses',      // Post statuses
        '/wp/v2/taxonomies',    // Taxonomy types
        '/wp/v2/tags',          // Tags
        '/wp/v2/users',         // Users
        '/wp/v2/comments',      // Comments
        '/wp/v2/settings',      // Site settings
        '/wp/v2/themes',        // Themes
        '/wp/v2/blocks',        // Blocks
        '/wp/v2/oembed',        // oEmbed v2
        '/wp/v2/posts',         // Posts
        '/wp/v2/pages',         // Pages
        '/wp/v2/block-renderer',// Block rendering
        '/wp/v2/search',        // Search
        '/wp/v2/categories'     // Categories
    );

    // Only modify endpoints for non-logged-in users
    if ( ! is_user_logged_in() ) {
        foreach ( $endpoints_to_remove as $rem_endpoint ) {
            // Check each registered endpoint against our removal list
            foreach ( $endpoints as $maybe_endpoint => $object ) {
                // Remove if endpoint path contains the string we want to disable
                if ( stripos( $maybe_endpoint, $rem_endpoint ) !== false ) {
                    unset( $endpoints[ $maybe_endpoint ] );
                }
            }
        }
    }
    
    return $endpoints;
}
