<?php
/**
 * List All Systems Page
 */

function qkn_list_all_systems_page() {
    ?>
    <div class="systems-wrapper">
        <h1>All Systems</h1>
        <form class="search-form" method="GET">
            <input type="text" name="title" placeholder="Search by title" value="<?php echo isset($_GET['title']) ? esc_attr($_GET['title']) : ''; ?>">
            <select name="posts_per_page" onchange="this.form.submit()">
                <option value="10" <?php selected(10, $_GET['posts_per_page'] ?? 10); ?>>10</option>
                <option value="20" <?php selected(20, $_GET['posts_per_page'] ?? 10); ?>>20</option>
                <option value="50" <?php selected(50, $_GET['posts_per_page'] ?? 10); ?>>50</option>
                <option value="100" <?php selected(100, $_GET['posts_per_page'] ?? 10); ?>>100</option>
                <option value="-1" <?php selected(-1, $_GET['posts_per_page'] ?? 10); ?>>All</option>
            </select>
            <button type="submit">Search</button>
        </form>
        <table id="systemsTable" class="systems-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>FQDN</th>
                    <th>OS</th>
                    <th>LAN</th>
                    <th>WAN</th>
                    <th>Sites</th>
                    <th>Status</th>
                    <th>System Type</th>
                    <th>Documentation Links</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $posts_per_page = isset($_GET['posts_per_page']) ? (int) $_GET['posts_per_page'] : 10;

                $args = array(
                    'post_type' => 'system',
                    'posts_per_page' => $posts_per_page,
                    'paged' => $paged,
                );

                if (!empty($_GET['title'])) {
                    $args['s'] = sanitize_text_field($_GET['title']);
                }

                $systems_query = new WP_Query($args);

                if ($systems_query->have_posts()) :
                    while ($systems_query->have_posts()) : $systems_query->the_post();
                        ?>
                        <tr>
                            <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'fqdn', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'os', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'lan', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'wan', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'sites', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'status', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'system_type', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'documentation_links', true)); ?></td>
                        </tr>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <tr>
                        <td colspan="9"><?php _e('No systems found.', 'text_domain'); ?></td>
                    </tr>
                    <?php
                endif;
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $systems_query->max_num_pages,
                'current' => $paged,
            ));
            ?>
        </div>
    </div>
    <?php
}
