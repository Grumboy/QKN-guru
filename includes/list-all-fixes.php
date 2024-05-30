<?php
function qkn_list_all_fixes_shortcode() {
    ob_start();
    ?>
    <div class="fixes-wrapper">
        <h1>All Fixes</h1>
        <form role="search" method="get" id="searchform" class="search-form">
            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search fixes..." />
            <button type="submit" id="searchsubmit">Search</button>
        </form>
        <table id="fixesTable" class="fixes-table">
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
                    'post_type' => 'fix',
                    'posts_per_page' => -1,
                );
                $fixes = new WP_Query($args);
                if ($fixes->have_posts()) :
                    while ($fixes->have_posts()) : $fixes->the_post(); ?>
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
                        <td colspan="3">No fixes found.</td>
                    </tr>
                <?php endif; wp_reset_postdata(); ?>
            </tbody>
        </table>
    </divContinuing>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('list_all_fixes', 'qkn_list_all_fixes_shortcode');
