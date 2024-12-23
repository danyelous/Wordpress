# WordPress REST API Endpoint Security

# I created it with the help of Claude AI and ChatGPT

A WordPress plugin that disables specific REST API endpoints for non-authenticated users to enhance site security.

## Features

- Restricts access to sensitive WordPress REST API endpoints
- Only affects non-logged-in users
- Configurable endpoint list
- Zero configuration required
- Lightweight implementation

## Installation

1. Upload `functions.php` to your theme directory
2. The protection is automatically enabled

## Protected Endpoints

- Media Library
- Users
- Posts & Pages
- Settings
- Comments
- Taxonomies
- Search
- Block Editor
- Theme Data

## Requirements

- WordPress 4.7+
- PHP 5.6+

## Security Considerations

This plugin helps prevent unauthorized access to sensitive WordPress data through the REST API. It's particularly useful for sites that don't need public API access.

## License

GPL v2 or later
