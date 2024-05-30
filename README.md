# QKN Guru Plugin

## Purpose

The QKN Guru Plugin is a custom WordPress plugin designed to manage systems and fixes effectively. It allows administrators to add and manage detailed records of systems and their associated fixes through a user-friendly interface. The plugin provides comprehensive features for listing, searching, and categorizing systems and fixes.

## Features

1. **Custom Post Types**:
    - **Systems**: Manage various systems with detailed information.
    - **Fixes**: Track fixes and issues related to the systems.

2. **Custom Taxonomies**:
    - **Sites**: Categorize systems based on their associated sites.

3. **Admin Pages**:
    - **Add New System**: Form to add a new system.
    - **List All Systems**: List and search all systems with pagination and filtering.
    - **Add New Fix**: Form to add a new fix.
    - **List All Fixes**: List and search all fixes with pagination and filtering.

## Installation

1. **Download the Plugin**:
    - Clone the repository or download the ZIP file.

2. **Upload to WordPress**:
    - Upload the plugin folder to the `/wp-content/plugins/` directory.
    - Activate the plugin through the 'Plugins' menu in WordPress.

3. **Configuration**:
    - Navigate to the 'Add New System' and 'Add New Fix' pages to start adding your records.
    - Use the 'List All Systems' and 'List All Fixes' pages to view and manage your entries.

## Usage

- **Adding Systems**:
    - Navigate to 'Add New System' in the admin menu.
    - Fill in the details and click 'Add New System'.
    
- **Listing Systems**:
    - Navigate to 'List All Systems' in the admin menu.
    - Use the search and filter options to find specific systems.

- **Adding Fixes**:
    - Navigate to 'Add New Fix' in the admin menu.
    - Fill in the details and click 'Add New Fix'.
    
- **Listing Fixes**:
    - Navigate to 'List All Fixes' in the admin menu.
    - Use the search and filter options to find specific fixes.

## Development

- **Scripts**:
    - JavaScript for handling form submissions and initializing DataTables is located in `js/scripts.js`.

- **Styles**:
    - CSS for styling the forms and tables is located in `css/styles.css`.

- **Includes**:
    - `custom-post-types.php`: Registers the custom post types.
    - `custom-taxonomies.php`: Registers the custom taxonomies.
    - `add-new-system.php`: Handles the 'Add New System' page.
    - `add-new-fix.php`: Handles the 'Add New Fix' page.
    - `list-all-systems.php`: Handles the 'List All Systems' page.
    - `list-all-fixes.php`: Handles the 'List All Fixes' page.

## Contributing

Feel free to submit pull requests and issues. Your contributions are always welcome!

## License

This plugin is open-source and licensed under the [MIT License](LICENSE).
