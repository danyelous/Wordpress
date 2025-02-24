# WordPress Login Customization

# I created it with the help of Claude AI and ChatGPT

A simple WordPress plugin that customizes the login page by adding theme color metadata and Google Analytics tracking.

## Features

- Sets theme colors for different browsers and color schemes
- Adds Google Analytics tracking to the WordPress login page
- Enqueues a custom JavaScript file for additional login page functionality

## Installation

1. Add this code to your theme's `functions.php` file, or
2. Create a new plugin file with this code and activate it through the WordPress admin panel

## Usage

The plugin automatically:

- Adds theme color metadata to the login page header for consistent branding across browsers
- Configures Google Analytics tracking on the login page
- Loads a custom JavaScript file (`login.js`) from your theme's `/js/` directory

## Requirements

- WordPress 4.7 or higher
- A theme with a `/js/login.js` file (or create this file)

## Customization

### Theme Colors

Modify the color hex code (`#035a28`) in each meta tag to match your brand colors.

### Google Analytics

Replace the Google Analytics measurement ID (`G-Q7Y9N1P4LC`) with your own ID.

### Custom JavaScript

Create or modify the `/js/login.js` file in your theme directory to add custom JavaScript functionality to the login page.

## License

[MIT](https://opensource.org/licenses/MIT)
