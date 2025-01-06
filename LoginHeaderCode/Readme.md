# WordPress Login Header Customization

# I created it with the help of Claude AI and ChatGPT

A WordPress plugin that allows customization of the login page header by adding custom JavaScript.

## Features

- Add custom JavaScript to WordPress login page
- Support for both inline scripts and external JS files
- Easy integration with existing WordPress themes

## Installation

1. Upload the plugin files to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the functions.php file to modify the login header

## Usage

The plugin provides two methods to add JavaScript to your login page:

### Method 1: Inline JavaScript
```php
function add_login_header_script() {
    ?>
        <script>
            // Your JavaScript code here
        </script>
    <?php
}
add_action('login_head', 'add_login_header_script');
```

### Method 2: External JavaScript File (Recommended)
```php
function enqueue_login_script() {
    wp_enqueue_script('custom-login', get_template_directory_uri() . '/js/login.js');
}
add_action('login_enqueue_scripts', 'enqueue_login_script');
```

## Best Practices

- Use Method 2 (external JavaScript) for better maintenance and performance
- Keep your JavaScript code organized in separate files
- Follow WordPress coding standards

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher

## License

This project is licensed under the GPL v2 or later

## Author

[Your Name]
