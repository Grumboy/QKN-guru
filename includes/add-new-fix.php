<?php
/**
 * Add New Fix Page
 */

function qkn_add_new_fix_page() {
    // Handle form submission
    if (isset($_POST['qkn_add_new_fix_nonce']) && wp_verify_nonce($_POST['qkn_add_new_fix_nonce'], 'qkn_add_new_fix')) {
        // Sanitize and validate inputs
        $description = sanitize_textarea_field($_POST['description']);
        $issue_type = sanitize_text_field($_POST['issue_type']);
        $severity = sanitize_text_field($_POST['severity']);
        $system_id = intval($_POST['system']);
        $info = sanitize_textarea_field($_POST['info']);
        $tags = isset($_POST['tags']) ? array_map('intval', $_POST['tags']) : array();

        // Handle file upload
        if (!empty($_FILES['attachments']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            $uploaded = media_handle_upload('attachments', 0);

            if (is_wp_error($uploaded)) {
                echo '<div class="notice notice-error is-dismissible"><p>Error uploading file.</p></div>';
                $attachment_url = '';
            } else {
                $attachment_url = wp_get_attachment_url($uploaded);
            }
        } else {
            $attachment_url = '';
        }

        // Insert new fix
        $new_fix = array(
            'post_title'   => wp_trim_words($description, 5, '...'),
            'post_type'    => 'fix',
            'post_status'  => 'publish',
            'meta_input'   => array(
                'description'   => $description,
                'issue_type'    => $issue_type,
                'severity'      => $severity,
                'system'        => $system_id,
                'info'          => $info,
                'attachments'   => $attachment_url,
            ),
        );

        $post_id = wp_insert_post($new_fix);

        if ($post_id && !is_wp_error($post_id)) {
            // Set tags
            wp_set_object_terms($post_id, $tags, 'post_tag');
            echo '<div class="notice notice-success is-dismissible"><p>Fix added successfully.</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Error adding fix.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Add New Fix</h1>
        <form id="add-new-fix" method="POST" action="" enctype="multipart/form-data">
            <?php wp_nonce_field('qkn_add_new_fix', 'qkn_add_new_fix_nonce'); ?>

            <label for="description">Description</label>
            <textarea name="description" required></textarea>

            <label for="issue_type">Issue Type</label>
            <select name="issue_type">
                <option value="Bug">Bug</option>
                <option value="Feature">Feature</option>
                <option value="Improvement">Improvement</option>
            </select>

            <label for="severity">Severity</label>
            <select name="severity">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>

            <label for="system">System</label>
            <?php
            $systems = get_posts(array('post_type' => 'system', 'numberposts' => -1));
            if (!empty($systems)) {
                echo '<select name="system">';
                foreach ($systems as $system) {
                    echo '<option value="' . esc_attr($system->ID) . '">' . esc_html($system->post_title) . '</option>';
                }
                echo '</select>';
            } else {
                echo '<p>No systems found. <a href="' . admin_url('admin.php?page=add-new-system') . '">Add new system</a>.</p>';
            }
            ?>

            <label for="info">Info</label>
            <textarea name="info"></textarea>

            <label for="attachments">Attachments</label>
            <input type="file" name="attachments">

            <label for="tags">Tags</label>
            <?php
            $tags = get_terms(array('taxonomy' => 'post_tag', 'hide_empty' => false));
            if (!empty($tags)) {
                echo '<select name="tags[]" multiple>';
                foreach ($tags as $tag) {
                    echo '<option value="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</option>';
                }
                echo '</select>';
            } else {
                echo '<p>No tags found. <a href="' . admin_url('edit-tags.php?taxonomy=post_tag') . '">Add new tag</a>.</p>';
            }
            ?>

            <button type="submit">Add Fix</button>
        </form>
    </div>
    <?php
}