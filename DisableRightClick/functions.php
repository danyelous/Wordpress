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
            alert('Right-click is disabled on this site.');
        });
    </script>
    ";
}

// Hook the function into the 'wp_footer' action to ensure the script is added before the closing </body> tag
add_action('wp_footer', 'disable_right_click');
?>
