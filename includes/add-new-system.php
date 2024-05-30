<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if nonce is valid
    if (!isset($_POST['qkn_add_system_nonce']) || !wp_verify_nonce($_POST['qkn_add_system_nonce'], 'qkn_add_system')) {
        die('Invalid nonce');
    }

    // Sanitize and prepare post data
    $post_data = array(
        'post_title'    => sanitize_text_field($_POST['system_name']),
        'post_content'  => sanitize_textarea_field($_POST['system_description']),
        'post_status'   => 'publish',
        'post_type'     => 'system',
    );

    // Insert the post into the database
    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        echo 'System added successfully!';
    } else {
        echo 'Failed to add system!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New System</title>
    <?php wp_head(); ?>
</head>
<body>
    <div id="add-new-system">
        <h1>Add New System</h1>
        <form action="" method="POST">
            <?php wp_nonce_field('qkn_add_system', 'qkn_add_system_nonce'); ?>
            <label for="system_name">System Name</label>
            <input type="text" id="system_name" name="system_name" required>

            <label for="system_description">System Description</label>
            <textarea id="system_description" name="system_description" required></textarea>

            <button type="submit">Add System</button>
        </form>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
