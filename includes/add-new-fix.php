<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if nonce is valid
    if (!isset($_POST['qkn_add_fix_nonce']) || !wp_verify_nonce($_POST['qkn_add_fix_nonce'], 'qkn_add_fix')) {
        die('Invalid nonce');
    }

    // Sanitize and prepare post data
    $post_data = array(
        'post_title'    => sanitize_text_field($_POST['fix_name']),
        'post_content'  => sanitize_textarea_field($_POST['fix_description']),
        'post_status'   => 'publish',
        'post_type'     => 'fix',
    );

    // Insert the post into the database
    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        echo 'Fix added successfully!';
    } else {
        echo 'Failed to add fix!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Fix</title>
    <?php wp_head(); ?>
</head>
<body>
    <div id="add-new-fix">
        <h1>Add New Fix</h1>
        <form action="" method="POST">
            <?php wp_nonce_field('qkn_add_fix', 'qkn_add_fix_nonce'); ?>
            <label for="fix_name">Fix Name</label>
            <input type="text" id="fix_name" name="fix_name" required>

            <label for="fix_description">Fix Description</label>
            <textarea id="fix_description" name="fix_description" required></textarea>

            <button type="submit">Add Fix</button>
        </form>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
