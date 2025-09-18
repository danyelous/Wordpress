// Hide admin bar on frontend for all logged-in users
function hide_admin_bar_from_frontend() {
    show_admin_bar(false);
}
add_action('after_setup_theme', 'hide_admin_bar_from_frontend');




// Hide admin bar on frontend for non-admin users
function hide_admin_bar_for_non_admins() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'hide_admin_bar_for_non_admins');



// Hide admin bar for everyone except administrators
function hide_admin_bar_except_admins() {
    if (!current_user_can('manage_options')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'hide_admin_bar_except_admins');
