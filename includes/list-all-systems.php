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
                $args = array(
                    'post_type' => 'system',
                    'posts_per_page' => isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );

                if (isset($_GET['title'])) {
                    $args['s'] = sanitize_text_field($_GET['title']);
                }

                $systems_query = new WP_Query($args);

                if ($systems_query->have_posts()) {
                    while ($systems_query->have_posts()) {
                        $systems_query->the_post();
                        ?>
                        <tr>
                            <td><?php the_title(); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'fqdn', true); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'operating_system', true); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'ip_address_lan', true); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'ip_address_wan', true); ?></td>
                            <td><?php
                                $sites = get_the_terms(get_the_ID(), 'sites');
                                if ($sites && !is_wp_error($sites)) {
                                    $site_names = wp_list_pluck($sites, 'name');
                                    echo implode(', ', $site_names);
                                } else {
                                    echo 'None';
                                }
                            ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'status', true); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'system_type', true); ?></td>
                            <td><?php echo get_post_meta(get_the_ID(), 'documentation_links', true); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9">No systems found</td>
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
                'total' => $systems_query->max_num_pages,
            ));
            ?>
        </div>
    </div>
    <?php
}
