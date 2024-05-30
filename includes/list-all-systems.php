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
            <input type="text" name="fqdn" placeholder="Search by FQDN" value="<?php echo isset($_GET['fqdn']) ? esc_attr($_GET['fqdn']) : ''; ?>">
            <input type="text" name="os" placeholder="Search by OS" value="<?php echo isset($_GET['os']) ? esc_attr($_GET['os']) : ''; ?>">
            <input type="text" name="lan" placeholder="Search by LAN" value="<?php echo isset($_GET['lan']) ? esc_attr($_GET['lan']) : ''; ?>">
            <input type="text" name="wan" placeholder="Search by WAN" value="<?php echo isset($_GET['wan']) ? esc_attr($_GET['wan']) : ''; ?>">
            <input type="text" name="sites" placeholder="Search by Sites" value="<?php echo isset($_GET['sites']) ? esc_attr($_GET['sites']) : ''; ?>">
            <input type="text" name="status" placeholder="Search by Status" value="<?php echo isset($_GET['status']) ? esc_attr($_GET['status']) : ''; ?>">
            <input type="text" name="system_type" placeholder="Search by System Type" value="<?php echo isset($_GET['system_type']) ? esc_attr($_GET['system_type']) : ''; ?>">
            <button type="submit">Search</button>
            <select name="posts_per_page" onchange="this.form.submit()">
                <option value="10" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10, 10); ?>>10</option>
                <option value="20" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10, 20); ?>>20</option>
                <option value="-1" <?php selected(isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 10, -1); ?>>All</option>
            </select>
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
                    'posts_per_page' => isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 10,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );

                $meta_query = array('relation' => 'AND');

                if (isset($_GET['title'])) $args['s'] = sanitize_text_field($_GET['title']);
                if (isset($_GET['fqdn'])) $meta_query[] = array('key' => 'fqdn', 'value' => sanitize_text_field($_GET['fqdn']), 'compare' => 'LIKE');
                if (isset($_GET['os'])) $meta_query[] = array('key' => 'operating_system', 'value' => sanitize_text_field($_GET['os']), 'compare' => 'LIKE');
                if (isset($_GET['lan'])) $meta_query[] = array('key' => 'ip_address_lan', 'value' => sanitize_text_field($_GET['lan']), 'compare' => 'LIKE');
                if (isset($_GET['wan'])) $meta_query[] = array('key' => 'ip_address_wan', 'value' => sanitize_text_field($_GET['wan']), 'compare' => 'LIKE');
                if (isset($_GET['sites'])) $meta_query[] = array('key' => 'sites', 'value' => sanitize_text_field($_GET['sites']), 'compare' => 'LIKE');
                if (isset($_GET['status'])) $meta_query[] = array('key' => 'status', 'value' => sanitize_text_field($_GET['status']), 'compare' => 'LIKE');
                if (isset($_GET['system_type'])) $meta_query[] = array('key' => 'system_type', 'value' => sanitize_text_field($_GET['system_type']), 'compare' => 'LIKE');

                if (!empty($meta_query)) $args['meta_query'] = $meta_query;

                $systems_query = new WP_Query($args);

                if ($systems_query->have_posts()) :
                    while ($systems_query->have_posts()) : $systems_query->the_post();
                        $fqdn = get_post_meta(get_the_ID(), 'fqdn', true);
                        $os = get_post_meta(get_the_ID(), 'operating_system', true);
                        $lan = get_post_meta(get_the_ID(), 'ip_address_lan', true);
                        $wan = get_post_meta(get_the_ID(), 'ip_address_wan', true);
                        $sites = get_post_meta(get_the_ID(), 'sites', true);
                        $status = get_post_meta(get_the_ID(), 'status', true);
                        $system_type = get_post_meta(get_the_ID(), 'system_type', true);
                        $documentation_links = get_post_meta(get_the_ID(), 'documentation_links', true);
                        ?>
                        <tr>
                            <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            <td><?php echo esc_html($fqdn); ?></td>
                            <td><?php echo esc_html($os); ?></td>
                            <td><?php echo esc_html($lan); ?></td>
                            <td><?php echo esc_html($wan); ?></td>
                            <td><?php echo esc_html($sites); ?></td>
                            <td><?php echo esc_html($status); ?></td>
                            <td><?php echo esc_html($system_type); ?></td>
                            <td><?php echo esc_html($documentation_links); ?></td>
                        </tr>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <tr>
                        <td colspan="9">No systems found.</td>
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
                'current' => max(1, get_query_var('paged')),
            ));
            ?>
        </div>
    </div>
    <?php
}
?>
