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
            <button type="submit">Search</button>
            <select name="posts_per_page" onchange="this.form.submit()">
                <option value="10" <?php selected(10, isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10); ?>>10</option>
                <option value="20" <?php selected(20, isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10); ?>>20</option>
                <option value="50" <?php selected(50, isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10); ?>>50</option>
                <option value="100" <?php selected(100, isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10); ?>>100</option>
                <option value="-1" <?php selected(-1, isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10); ?>>All</option>
            </select>
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
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $posts_per_page = isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10;

                $args = array(
                    'post_type' => 'system',
                    'posts_per_page' => $posts_per_page,
                    'paged' => $paged,
                    's' => isset($_GET['title']) ? sanitize_text_field($_GET['title']) : '',
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        ?>
                        <tr>
                            <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'fqdn', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'os', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'lan', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'wan', true)); ?></td>
                            <td><?php
                                $sites = get_the_terms(get_the_ID(), 'sites');
                                if ($sites && !is_wp_error($sites)) {
                                    $sites_list = array();
                                    foreach ($sites as $site) {
                                        $sites_list[] = $site->name;
                                    }
                                    echo esc_html(join(', ', $sites_list));
                                } else {
                                    echo 'None';
                                }
                                ?>
                            </td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'status', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'system_type', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'documentation_links', true)); ?></td>
                        </tr>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $query->max_num_pages,
                'current' => $paged,
                'format' => '?paged=%#%',
                'show_all' => false,
                'end_size' => 2,
                'mid_size' => 1,
                'prev_next' => true,
                'prev_text' => __('« Prev'),
                'next_text' => __('Next »'),
                'type' => 'plain',
            ));
            ?>
        </div>
    </div>
    <?php
}
?>
