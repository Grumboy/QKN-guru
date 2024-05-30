<?php
/**
 * Add New Fix Page
 */

function qkn_add_new_fix_page() {
    ?>
    <div class="wrap">
        <h1>Add New Fix</h1>
        <form id="add-new-fix" method="POST" action="">
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
                    echo '<option value="' . $system->ID . '">' . $system->post_title . '</option>';
                }
                echo '</select>';
            } else {
                echo '<p>No systems found.</p>';
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
                echo '<select name="tags">';
                foreach ($tags as $tag) {
                    echo '<option value="' . $tag->term_id . '">' . $tag->name . '</option>';
                }
                echo '</select>';
            } else {
                echo '<p>No tags found.</p>';
            }
            ?>

            <button type="submit">Add Fix</button>
        </form>
    </div>
    <?php
}
