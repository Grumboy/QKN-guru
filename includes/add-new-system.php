<?php
/**
 * Add New System Page
 */

function qkn_add_new_system_page() {
    ?>
    <div class="wrap">
        <h1>Add New System</h1>
        <form id="add-new-system" method="POST" action="">
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
                echo '<select name="sites">';
                foreach ($sites as $site) {
                    echo '<option value="' . $site->term_id . '">' . $site->name . '</option>';
                }
                echo '</select>';
            } else {
                echo '<p>No sites found.</p>';
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
