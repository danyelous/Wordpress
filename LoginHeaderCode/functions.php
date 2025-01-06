<?php
// This function adds inline JavaScript directly in the header of the login page
function add_login_header_script() {
    ?>
        <script>
            // Your JavaScript code would go here
            // Currently this script tag is empty
        </script>
    <?php
}
// Hooks the function to 'login_head' which runs in the head section of the login page
add_action('login_head', 'add_login_header_script');

// This function properly enqueues an external JavaScript file
function enqueue_login_script() {
    // Enqueues a script named 'custom-login' from your theme's js directory
    // The file should be located at: your-theme-folder/js/login.js
    wp_enqueue_script('custom-login', get_template_directory_uri() . '/js/login.js');
}
// Hooks the function to 'login_enqueue_scripts' which is the proper way to enqueue scripts for the login page
add_action('login_enqueue_scripts', 'enqueue_login_script');
?>
