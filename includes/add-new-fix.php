<?php
function qkn_add_new_fix_shortcode() {
    ob_start();
    ?>
    <form id="add-new-fix" method="post" action="">
        <label for="fix_title">Fix Title</label>
        <input type="text" id="fix_title" name="fix_title" required>

        <label for="fix_description">Fix Description</label>
        <textarea id="fix_description" name="fix_description" required></textarea>

        <button type="submit" name="submit_fix">Add Fix</button>
    </form>
    <?php
    if (isset($_POST['submit_fix'])) {
        $title = sanitize_text_field($_POST['fix_title']);
        $description = sanitize_textarea_field($_POST['fix_description']);

        $new_fix = array(
            'post_title'    => $title,
            'post_content'  => $description,
            'post_status'   => 'publish',
            'post_type'     => 'fix',
        );

        $post_id = wp_insert_post($new_fix);

        if ($post_id) {
            echo '<p>Fix added successfully!</p>';
        } else {
            echo '<p>Failed to add fix. Please try again.</p>';
        }
    }
    return ob_get_clean();
}
add_shortcode('add_new_fix', 'qkn_add_new_fix_shortcode');
