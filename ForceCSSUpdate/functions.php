/**
 * Enqueue theme styles with automatic cache-busting
 * 
 * This function forces browsers to reload the CSS file whenever it's modified
 * by using the file's modification timestamp as the version parameter.
 * This prevents caching issues during development and ensures users always
 * get the latest styles after updates.
 */
function mytheme_enqueue_styles() {
    // Get the current theme version from style.css header (not used in this implementation)
    $theme_version = wp_get_theme()->get('Version');
    
    // Get the full file system path to the main stylesheet
    $style_path = get_stylesheet_directory() . '/style.css';
    
    // Get the file modification time as a Unix timestamp
    // This timestamp changes every time the file is saved/modified
    $style_version = filemtime($style_path);
    
    // Enqueue the stylesheet with the modification time as version
    // WordPress will append "?ver=[timestamp]" to the CSS URL
    // When the file changes, the timestamp changes, forcing a fresh download
    wp_enqueue_style(
        'mytheme-style',           // Handle/ID for this stylesheet
        get_stylesheet_uri(),      // URL to the stylesheet
        array(),                   // Dependencies (none in this case)
        $style_version            // Version parameter for cache-busting
    );
}

// Hook the function to run when WordPress enqueues scripts and styles
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');
