<?php

function add_login_header_script() {
    ?>


		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#035a28">
		<meta name="theme-color" media="(prefers-color-scheme: light)" content="#035a28" />
		<meta name="theme-color" media="(prefers-color-scheme: dark)" content="#035a28" />

		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#035a28">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#035a28">

		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q7Y9N1P4LC"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-Q7Y9N1P4LC');
		</script>
    <?php
}
add_action('login_head', 'add_login_header_script');


function enqueue_login_script() {
    wp_enqueue_script('custom-login', get_template_directory_uri() . '/js/login.js');
}
add_action('login_enqueue_scripts', 'enqueue_login_script');


?>
