# Disable Right-Click in WordPress Theme

# I created it with the help of Claude AI and ChatGPT

This project provides a simple PHP function that can be added to the `functions.php` file of your WordPress theme. It disables right-click across your website by injecting a JavaScript snippet, helping to protect your content from casual copying.

## Features
- Prevents the default browser context menu from appearing on right-click.
- Displays an optional alert message to inform users that right-click is disabled.
- Lightweight and easy to integrate into any WordPress theme.

## How to Use
1. Open your WordPress theme's `functions.php` file.
2. Copy and paste the following code into the file:

    ```php
    <?php
    // Function to disable right-click across the website
    function disable_right_click() {
        // Injecting a JavaScript snippet into the footer of the site
        echo "
        <script type='text/javascript'>
            // Add an event listener for the 'contextmenu' event (triggered by right-click)
            document.addEventListener('contextmenu', function(event) {
                // Prevent the default context menu from appearing
                event.preventDefault();
                
                // Optional: Display an alert message to inform the user
                alert('Right-click is disabled on this
