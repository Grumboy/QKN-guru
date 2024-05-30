<?php
/*
Template Name: List All Systems
*/
get_header();
?>

<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . '../css/styles.css'; ?>">

<div class="systems-wrapper">
    <h1>All Systems</h1>

    <!-- Include Custom Search Form -->
    <form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>" class="search-form">
        <input type="hidden" name="post_type" value="system" />
        <label for="s">Search Systems:</label>
        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Enter keyword..." />

        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">All Categories</option>
            <?php
            $categories = get_categories();
            foreach ($categories as $category) {
                echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
            }
            ?>
        </select>

        <label for="author">Author:</label>
        <select name="author" id="author">
            <option value="">All Authors</option>
            <?php
            $authors = get_users(array('who' => 'authors'));
            foreach ($authors as $author) {
                echo '<option value="' . $author->ID . '">' . $author->display_name . '</option>';
            }
            ?>
        </select>

        <label for="from_date">From Date:</label>
        <input type="date" name="from_date" id="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>" />

        <label for="to_date">To Date:</label>
        <input type="date" name="to_date" id="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>" />

        <label for="system_type">System Type:</label>
        <select name="system_type" id="system_type">
            <option value="">All Types</option>
            <?php
            $system_types = get_terms(array('taxonomy' => 'system_type', 'hide_empty' => false));
            foreach ($system_types as $system_type) {
                echo '<option value="' . $system_type->term_id . '">' . $system_type->name . '</option>';
            }
            ?>
        </select>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">All Statuses</option>
            <?php
            $statuses = get_terms(array('taxonomy' => 'status', 'hide_empty' => false));
            foreach ($statuses as $status) {
                echo '<option value="' . $status->term_id . '">' . $status->name . '</option>';
            }
            ?>
        </select>

        <button type="submit" id="searchsubmit">Search</button>
    </form>

    <!-- Display Results -->
    <?php
    $args = array(
        'post_type' => 'system',
        'posts_per_page' => -1,
    );

    if (isset($_GET['s'])) {
        $args['s'] = sanitize_text_field($_GET['s']);
    }

    if (isset($_GET['category']) && $_GET['category'] != '') {
        $args['cat'] = intval($_GET['category']);
    }

    if (isset($_GET['author']) && $_GET['author'] != '') {
        $args['author'] = intval($_GET['author']);
    }

    if (isset($_GET['from_date']) && $_GET['from_date'] != '') {
        $args['date_query'][] = array(
            'after' => sanitize_text_field($_GET['from_date']),
        );
    }

    if (isset($_GET['to_date']) && $_GET['to_date'] != '') {
        $args['date_query'][] = array(
            'before' => sanitize_text_field($_GET['to_date']),
        );
    }

    if (isset($_GET['system_type']) && $_GET['system_type'] != '') {
        $args['tax_query'][] = array(
            'taxonomy' => 'system_type',
            'field' => 'term_id',
            'terms' => intval($_GET['system_type']),
        );
    }

    if (isset($_GET['status']) && $_GET['status'] != '') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'term_id',
            'terms' => intval($_GET['status']),
        );
    }

    $systems_query = new WP_Query($args);

    if ($systems_query->have_posts()) :
    ?>

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
            <?php while ($systems_query->have_posts()): $systems_query->the_post(); ?>
            <tr>
                <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                <td><?php echo get_post_meta(get_the_ID(), 'fqdn', true); ?></td>
                <td><?php
                    $os = get_the_terms(get_the_ID(), 'operating_system');
                    if ($os && !is_wp_error($os)) {
                        $os_names = array();
                        foreach ($os as $os_item) {
                            $os_names[] = $os_item->name;
                        }
                        echo implode(', ', $os_names);
                    } else {
                        echo 'None';
                    }
                ?></td>
                <td><?php echo get_post_meta(get_the_ID(), 'ip_address_lan', true); ?></td>
                <td><?php echo get_post_meta(get_the_ID(), 'ip_address_wan', true); ?></td>
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
<td><?php
    $status = get_the_terms(get_the_ID(), 'status');
    if ($status && !is_wp_error($status)) {
        $status_names = array();
        foreach ($status as $status_item) {
            $status_names[] = $status_item->name;
        }
        echo implode(', ', $status_names);
    } else {
        echo 'None';
    }
?></td>
<td><?php
    $system_type = get_the_terms(get_the_ID(), 'system_type');
    if ($system_type && !is_wp_error($system_type)) {
        $system_type_names = array();
        foreach ($system_type as $type) {
            $system_type_names[] = $type->name;
        }
        echo implode(', ', $system_type_names);
    } else {
        echo 'None';
    }
?></td>
<td><?php echo get_post_meta(get_the_ID(), 'documentation_links', true); ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<div class="pagination">
    <?php
    echo paginate_links(array(
        'total' => $systems_query->max_num_pages,
    ));
    ?>
</div>

<?php else : ?>
    <p>No systems found.</p>
<?php endif; wp_reset_postdata(); ?>
</div>

<!-- Include jQuery and DataTables JavaScript library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables -->
<script>
jQuery(document).ready(function($) {
    $('#systemsTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 20, 50, 100, "All"],
        "order": [[0, "asc"]]
    });
});
</script>

<?php get_footer(); ?>
