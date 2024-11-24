<?php
/**
 * Add New System Page
 */

function qkn_add_new_system_page() {
    // Handle form submission
    if (isset($_POST['qkn_add_new_system_nonce']) && wp_verify_nonce($_POST['qkn_add_new_system_nonce'], 'qkn_add_new_system')) {
        // Sanitize and validate inputs
        $title = sanitize_text_field($_POST['title']);
        $fqdn = sanitize_text_field($_POST['fqdn']);
        $operating_system = sanitize_text_field($_POST['operating_system']);
        $ip_address_lan = sanitize_text_field($_POST['ip_address_lan']);
        $ip_address_wan = sanitize_text_field($_POST['ip_address_wan']);
        $sites = isset($_POST['sites']) ? array_map('intval', $_POST['sites']) : array();
        $status = sanitize_text_field($_POST['status']);
        $system_type = sanitize_text_field($_POST['system_type']);
        $documentation_links = sanitize_textarea_field($_POST['documentation_links']);

        // Insert new system
        $new_system = array(
            'post_title'   => $title,
            'post_type'    => 'system',
            'post_status'  => 'publish',
            'meta_input'   => array(
                'fqdn'                => $fqdn,
                'operating_system'    => $operating_system,
                'ip_address_lan'      => $ip_address_lan,
                'ip_address_wan'      => $ip_address_wan,
                'status'              => $status,
                'system_type'         => $system_type,
                'documentation_links' => $documentation_links,
            ),
        );

        $post_id = wp_insert_post($new_system);

        if ($post_id && !is_wp_error($post_id)) {
            // Set terms
            wp_set_object_terms($post_id, $sites, 'sites');
            echo '<div class="notice notice-success is-dismissible"><p>System added successfully.</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Error adding system.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Add New System</h1>
        <form id="add-new-system" method="POST" action="">
            <?php wp_nonce_field('qkn_add_new_system', 'qkn_add_new_system_nonce'); ?>

            <label for="title">Title</label>
            <input type="text" name="title" required>

            <label for="fqdn">FQDN</label>
            <input type="text" name="fqdn" required>

            <label for="operating_system">Operating System</label>
            <select name="operating_system">
                <option value="Windows">Windows</option>
                <option value="Linux">Linux</option>
                <option value="macOS">macOS</option>
            </select>

            <label for="ip_address_lan">IP Address LAN</label>
            <input type="text" name="ip_address_lan" required>

            <label for="ip_address_wan">IP Address WAN</label>
            <input type="text" name="ip_address_wan">

            <label for="sites">Sites</label>
            <?php
            $sites = get_terms(array('taxonomy' => 'sites', 'hide_empty' => false));
            if (!empty($sites)) {
                echo '<select name="sites[]" multiple>';
                foreach ($sites as $site) {
                    echo '<option value="' . esc_attr($site->term_id) . '">' . esc_html($site->name) . '</option>';
                }
                echo '</select>';
            } else {
                echo '<p>No sites found. <a href="' . admin_url('edit-tags.php?taxonomy=sites&post_type=system') . '">Add new site</a>.</p>';
            }
            ?>

            <label for="status">Status</label>
            <select name="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>

            <label for="system_type">System Type</label>
            <select name="system_type">
                <option value="Database server">Database server</option>
                <option value="Web server">Web server</option>
                <option value="Application server">Application server</option>
            </select>

            <label for="documentation_links">Documentation Links</label>
            <textarea name="documentation_links"></textarea>

            <button type="submit">Add System</button>
        </form>
    </div>
    <?php
}