# WordPress Subscriber Restrictions

# I created it with the help of Claude AI and ChatGPT

A lightweight WordPress plugin that restricts menu items and page access based on user roles.

## Description

This plugin provides two key functions to control what subscribers can see and access on your WordPress site:

1. **Menu Item Restriction**: Limits which menu items are visible to subscribers while maintaining full visibility for administrators and editors.
2. **Page Access Control**: Redirects subscribers to the homepage if they attempt to access unauthorized pages.

## Features

- Role-based menu visibility
- Page access restrictions for subscribers
- Full access maintained for administrators and editors
- Detailed error logging for troubleshooting

## Installation

1. Download the plugin files
2. Upload to your `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Configure the allowed menu items and pages (see Configuration)

## Configuration

### Menu Item Restriction

Edit the `$allowed_items` array in the `restrict_menu_items_for_subscribers` function to include the IDs of menu items that subscribers should see:

```php
$allowed_items = ['178', '71']; // Replace with your menu item IDs
```

### Page Access Control

Edit the `$allowed_page_ids` array in the `restrict_subscriber_access` function to include the IDs of pages that subscribers should be able to access:

```php
$allowed_page_ids = array(176); // Replace with your page IDs
```

## Usage

Once activated and configured, the plugin will automatically:

1. Filter menu items displayed to subscribers
2. Redirect subscribers who attempt to access restricted pages

No additional action is required after configuration.

## Getting Menu and Page IDs

### Finding Menu Item IDs
1. Go to Appearance > Menus
2. Click on Screen Options at the top
3. Check the "CSS Classes" option
4. The ID will now be visible in the menu item properties or in the HTML source

### Finding Page IDs
Page IDs can be found in the URL when editing a page in WordPress admin (look for `post=X` in the URL) or by hovering over the "Edit" link in the Pages list.

## Debugging

The plugin includes extensive error logging. Check your WordPress debug log for entries related to menu filtering to troubleshoot any issues.

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher

## License

This project is licensed under the GPL v2 or later.

## Changelog

### 1.0.0
- Initial release
