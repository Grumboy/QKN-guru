<?php
/**
 * List All Fixes Page
 */

function qkn_list_all_fixes_page() {
    ?>
    <div class="fixes-wrapper">
        <h1>All Fixes</h1>
        <form class="search-form" method="GET">
            <input type="text" name="description" placeholder="Search by Description" value="<?php echo isset($_GET['description']) ? esc_attr($_GET['description']) : ''; ?>">
            <input type="text" name="issue_type" placeholder="Search by Issue Type" value="<?php echo isset($_GET['issue_type']) ? esc_attr($_GET['issue_type']) : ''; ?>">
            <input type="text" name="severity" placeholder="Search by Severity" value="<?php echo isset($_GET['severity']) ? esc_attr($_GET['severity']) : ''; ?>">
            <input type="text" name="system" placeholder="Search by System" value="<?php echo isset($_GET['system']) ? esc_attr($_GET['system']) : ''; ?>">
            <input type="text" name="tags" placeholder="Search by Tags" value="<?php echo isset($_GET['tags']) ? esc_attr($_GET['tags']) : ''; ?>">
            <button type="submit">Search</button>
            <select name="posts_per_page" onchange="this.form.submit()">
                <option value="10" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10, 10); ?>>10</option>
                <option value="20" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10, 20); ?>>20</option>
                <option value="-1" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10, -1); ?>>All</option>
            </select>
        </form>
        <table class="fixes-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Issue Type</th>
                    <th>Severity</th>
                    <th>System</th>
                    <th>Attachments</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $args = array(
                    'post_type' => 'fix',
                    'posts_per_page' => isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );

                $meta_query = array('relation' => 'AND');

                if (isset($_GET['description'])) $args['s'] = sanitize_text_field($_GET['description']);
                if (isset($_GET['issue_type'])) $meta_query[] = array('key' => 'issue_type', 'value' => sanitize_text_field($_GET['issue_type']), 'compare' => 'LIKE');
                if (isset($_GET['severity'])) $meta_query[] = array('key' => 'severity', 'value' => sanitize_text_field($_GET['severity']), 'compare' => 'LIKE');
                if (isset($_GET['system'])) $meta_query[] = array('key' => 'system', 'value' => sanitize_text_field($_GET['system']), 'compare' => 'LIKE');
                if (isset($_GET['tags'])) $meta_query[] = array('key' => 'tags', 'value' => sanitize_text_field($_GET['tags']), 'compare' => 'LIKE');

                if (!empty($meta_query)) $args['meta_query'] = $meta_query;

                $fixes_query = new WP_Query($args);

                if ($fixes_query->have_posts()) :
                    while ($fixes_query->have_posts()) : $fixes_query->the_post();
                        $description = get_the_content();
                        $issue_type = get_post_meta(get_the_ID(), 'issue_type', true);
                        $severity = get_post_meta(get_the_ID(), 'severity', true);
                        $system = get_post_meta(get_the_ID(), 'system', true);
                        $attachments = get_post_meta(get_the_ID(), 'attachments', true);
                        $tags = get_post_meta(get_the_ID(), 'tags', true);
                        ?>
                        <tr>
                            <td><?php echo wp_trim_words($description, 20); ?></td>
                            <td><?php echo esc_html($issue_type); ?></td>
                            <td><?php echo esc_html($severity); ?></td>
                            <td><?php echo esc_html($system); ?></td>
                            <td><?php echo esc_html($attachments); ?></td>
                            <td><?php echo esc_html($tags); ?></td>
                        </tr>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <tr>
                        <td colspan="6">No fixes found.</td>
                    </tr>
                    <?php
                endif;
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $fixes_query->max_num_pages,
                'current' => max(1, get_query_var('paged')),
            ));
            ?>
        </div>
    </div>
    <?php
}
?>
