<?php
/**
 * List All Fixes Page
 */
function qkn_list_all_fixes_page() {
    ?>
    <div class="fixes-wrapper">
        <h1>All Fixes</h1>
        <form class="search-form" method="GET">
            <input type="hidden" name="page" value="qkn-fixes">
            <input type="text" name="title" placeholder="Search by title" value="<?php echo isset($_GET['title']) ? esc_attr($_GET['title']) : ''; ?>">
            <select name="posts_per_page" onchange="this.form.submit()">
                <option value="10" <?php selected(10, isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10); ?>>10</option>
                <option value="20" <?php selected(20, isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10); ?>>20</option>
                <option value="50" <?php selected(50, isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10); ?>>50</option>
                <option value="100" <?php selected(100, isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10); ?>>100</option>
                <option value="-1" <?php selected(-1, isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10); ?>>All</option>
            </select>
            <button type="submit">Search</button>
        </form>
        <table id="fixesTable" class="fixes-table" data-page-length="<?php echo isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10; ?>">
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
                $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
                $posts_per_page = isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10;

                $args = array(
                    'post_type'      => 'fix',
                    'posts_per_page' => $posts_per_page,
                    'paged'          => $paged,
                    's'              => isset($_GET['title']) ? sanitize_text_field($_GET['title']) : '',
                );

                $fixes_query = new WP_Query($args);

                if ($fixes_query->have_posts()) {
                    while ($fixes_query->have_posts()) {
                        $fixes_query->the_post();
                        ?>
                        <tr>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'description', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'issue_type', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'severity', true)); ?></td>
                            <td><?php
                                $system_id = get_post_meta(get_the_ID(), 'system', true);
                                if ($system_id) {
                                    echo esc_html(get_the_title($system_id));
                                } else {
                                    echo 'None';
                                }
                            ?></td>
                            <td><?php
                                $attachment_url = get_post_meta(get_the_ID(), 'attachments', true);
                                if ($attachment_url) {
                                    echo '<a href="' . esc_url($attachment_url) . '">View Attachment</a>';
                                } else {
                                    echo 'None';
                                }
                            ?></td>
                            <td><?php
                                $tags = get_the_terms(get_the_ID(), 'post_tag');
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
                'total'     => $fixes_query->max_num_pages,
                'current'   => $paged,
                'format'    => '?paged=%#%',
                'add_args'  => array(
                    'page'           => 'qkn-fixes',
                    'title'          => isset($_GET['title']) ? sanitize_text_field($_GET['title']) : '',
                    'posts_per_page' => $posts_per_page,
                ),
                'prev_text' => __('« Prev'),
                'next_text' => __('Next »'),
            ));
            ?>
        </div>
    </div>
    <?php
}