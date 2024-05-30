<?php
/**
 * List All Systems Page
 */

function qkn_list_all_systems_page() {
    ?>
    <div class="systems-wrapper">
        <h1>All Systems</h1>
        <form class="search-form" method="GET">
            <input type="text" name="s" placeholder="Search by title" value="<?php echo get_search_query(); ?>">
            <button type="submit">Search</button>
        </form>
        <table class="systems-table">
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
                    'posts_per_page' => 10,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );

                if (isset($_GET['s'])) {
                    $args['s'] = sanitize_text_field($_GET['s']);
                }

                $systems_query = new WP_Query($args);

                if ($systems_query->have_posts()) :
                    while ($systems_query->have_posts()) : $systems_query->the_post();
                        ?>
                        <tr>
                            <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'fqdn', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'operating_system', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'ip_address_lan', true)); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), 'ip_address_wan', true)); ?></td>
                            <td><?php
                                $sites = get_the_terms(get_the_ID(), 'sites');
                                if ($sites && !is_wp_error($sites)) {
                                    $site_names = array();
                                    foreach ($sites as $site) {
                                        $site_names[] = $site->name;
                                    }
                                    echo implode(', ', $site_names);
                                } else {
                                    echo 'None';
                                }
                                ?></td>
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
                        <td colspan="9">No systems found.</td>
                    </tr>
                <?php endif; ?>
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
