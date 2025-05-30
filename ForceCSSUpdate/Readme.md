# WordPress CSS Cache-Busting Function

# I created it with the help of Claude AI and ChatGPT

A simple WordPress function to automatically invalidate CSS cache whenever your stylesheet is modified, ensuring users always see the latest styles.

## Overview

This function solves the common problem of browser caching preventing users from seeing CSS updates immediately. Instead of manually changing version numbers or asking users to hard-refresh, it automatically uses the file's modification timestamp as the version parameter.

## How It Works

The function uses `filemtime()` to get the last modification time of your `style.css` file and uses this timestamp as the version parameter when enqueuing the stylesheet. When WordPress loads the CSS, it will append `?ver=[timestamp]` to the URL, forcing browsers to download a fresh copy whenever the file changes.

## Installation

1. Add the function to your theme's `functions.php` file
2. The function will automatically hook into WordPress's script enqueuing system
3. No additional configuration needed

## Code Example

```php
function mytheme_enqueue_styles() {
    $theme_version = wp_get_theme()->get('Version');
    $style_path = get_stylesheet_directory() . '/style.css';
    $style_version = filemtime($style_path);
    wp_enqueue_style('mytheme-style', get_stylesheet_uri(), array(), $style_version);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');
```

## Benefits

- ✅ **Automatic cache invalidation** - No manual version bumping required
- ✅ **Development friendly** - See changes immediately during development
- ✅ **Production safe** - Users get updates without manual cache clearing
- ✅ **Performance optimized** - Browsers still cache unchanged files
- ✅ **Zero maintenance** - Works automatically once installed

## Requirements

- WordPress 3.0+
- PHP 5.2+ (for `filemtime()` function)
- Standard WordPress theme structure

## Notes

- The function targets the main `style.css` file in your theme directory
- Works with both parent and child themes
- Safe to use in production environments
- Compatible with caching plugins

## Customization

You can modify the function to work with additional CSS files by duplicating the enqueue call with different file paths and handles.

## License

This code is released under the GPL v2 or later, same as WordPress.

## Contributing

Feel free to submit issues and pull requests to improve this function.
