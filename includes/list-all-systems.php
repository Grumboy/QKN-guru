<?php
function qkn_list_all_systems_shortcode() {
    ob_start();
    ?>
    <div class="systems-wrapper">
        <h1>All Systems</h1>
        <form role="search" method="get" id="searchform" class="search-form">
            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search systems..." />
            <button type="submit" id="searchsubmit">Search</button>
        </form>
        <table id="systemsTable" class="systems-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Site</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $args = array(
                    'post_type' => 'system',
                    'posts_per_page' => -1,
                );
                $systems = new WP_Query($args);
                if ($systems->have_posts()) :
                    while ($systems->have_posts()) : $systems->the_post(); ?>
                        <tr>
                            <td><?php the_title(); ?></td>
                            <td><?php the_excerpt(); ?></td>
                            <td><?php
                                $sites = get_the_terms(get_the_ID(), 'site');
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
                        </tr>
                    <?php endwhile;
                else : ?>
                    <tr>
                        <td colspan="3">No systems found.</td>
                    </tr>
                <?php endif; wp_reset_postdata(); ?>
            </tbody>
        </table>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('list_all_systems', 'qkn_list_all_systems_shortcode');
