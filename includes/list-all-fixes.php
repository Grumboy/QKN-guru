<?php
/**
 * List All Fixes Page
 */
function qkn_list_all_fixes_page() {
    ?>
    <div class="fixes-wrapper">
        <h1>All Fixes</h1>
        <form class="search-form" method="GET">
            <input type="text" name="title" placeholder="Search by title" value="<?php echo isset($_GET['title']) ? esc_attr($_GET['title']) : ''; ?>">
            <button type="submit">Search</button>
        </form>
        <table id="fixesTable" class="fixes-table">
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

                if (isset($_GET['title'])) {
                    $args['s'] = sanitize_text_field($_GET['title']);
                }

                $fixes_query = new WP_Query($args);

                if ($fixes_query->have_posts()) {
                    while ($fixes_query->have_posts()) {
                        $fixes_query->the_post();
                        ?>
                        <tr>
                            <td><?php the_title(); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'issue_type', true); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'severity', true); ?></td>
                            <td><?php
                                $system = get_post_meta(get_the_ID(), 'system', true);
                                if ($system) {
                                    echo get_the_title($system);
                                } else {
                                    echo 'None';
                                }
                            ?></td>
                            <td><?php
                                $attachments = get_post_meta(get_the_ID(), 'attachments', true);
                                if ($attachments) {
                                    echo '<a href="' . esc_url($attachments) . '">View Attachment</a>';
                                } else {
                                    echo 'None';
                                }
                            ?></td>
                            <td><?php
                                $tags = get_the_terms(get_the_ID(), 'tags');
                                if ($tags && !is_wp_error($tags)) {
                                    $tag_names = wp_list_pluck($tags, 'name');
                                    echo implode(', ', $tag_names);
                                } else {
                                    echo 'None';
                                }
                            ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No fixes found</td>
                    </tr>
                    <?php
                }
                wp_reset_postdata();
                ?>
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
