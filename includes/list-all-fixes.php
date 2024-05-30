<?php
/**
 * List All Fixes Page
 */

function qkn_list_all_fixes_page() {
    ?>
    <div class="fixes-wrapper">
        <h1>All Fixes</h1>
        <form class="search-form" method="GET">
            <input type="text" name="s" placeholder="Search by title" value="<?php echo get_search_query(); ?>">
            <button type="submit">Search</button>
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
                    'posts_per_page' => 10,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );

                if (isset($_GET['s'])) {
                    $args['s'] = sanitize_text_field($_GET['s']);
                }

                $fixes_query = new WP_Query($args);

                if ($fixes_query->have_posts()) :
                    while ($fixes_query->have_posts()) : $fixes_query->the_post();
                        ?>
                        <tr>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'description', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'issue_type', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'severity', true)); ?></td>
                            <td><?php
                                $system_id = get_post_meta(get_the_ID(), 'system', true);
                                if ($system_id) {
                                    $system = get_post($system_id);
                                    if ($system) {
                                        echo esc_html($system->post_title);
                                    } else {
                                        echo 'System not found';
                                    }
                                } else {
                                    echo 'No system assigned';
                                }
                                ?></td>
                            <td><?php
                                $attachments = get_post_meta(get_the_ID(), 'attachments', true);
                                if ($attachments) {
                                    echo '<a href="' . esc_url($attachments) . '">View Attachment</a>';
                                } else {
                                    echo 'No attachments';
                                }
                                ?></td>
                            <td><?php
                                $tags = get_the_terms(get_the_ID(), 'post_tag');
                                if ($tags && !is_wp_error($tags)) {
                                    $tag_names = array();
                                    foreach ($tags as $tag) {
                                        $tag_names[] = $tag->name;
                                    }
                                    echo implode(', ', $tag_names);
                                } else {
                                    echo 'No tags';
                                }
                                ?></td>
                        </tr>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <tr>
                        <td colspan="6">No fixes found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $fixes_query->max_num_pages,
            ));
            ?>
        </div>
    </div>
    <?php
}
