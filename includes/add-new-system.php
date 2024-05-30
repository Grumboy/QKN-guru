<?php
function qkn_add_new_system_shortcode() {
    ob_start();
    ?>
    <form id="add-new-system" method="post" action="">
        <label for="system_title">System Title</label>
        <input type="text" id="system_title" name="system_title" required>

        <label for="system_description">System Description</label>
        <textarea id="system_description" name="system_description" required></textarea>

        <button type="submit" name="submit_system">Add System</button>
    </form>
    <?php
    if (isset($_POST['submit_system'])) {
        $title = sanitize_text_field($_POST['system_title']);
        $description = sanitize_textarea_field($_POST['system_description']);

        $new_system = array(
            'post_title'    => $title,
            'post_content'  => $description,
            'post_status'   => 'publish',
            'post_type'     => 'system',
        );

        $post_id = wp_insert_post($new_system);

        if ($post_id) {
            echo '<p>System added successfully!</p>';
        } else {
            echo '<p>Failed to add system. Please try again.</p>';
        }
    }
    return ob_get_clean();
}
add_shortcode('add_new_system', 'qkn_add_new_system_shortcode');
